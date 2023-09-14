<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Relatorio extends CI_Controller
{
    
    //Construtor para inicializacao de bibliotecas, metodos e modelos de dados
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->model('Relatorios_model', 'relatorio');

        $this->load->library('form_validation');
        $this->load->library('breadcrumbs');
    }


    // Metodo para inicializacao de dados de relatorios na tabela de dados
    public function index()
    {
      
        $this->tabelaRelatorios();
        
    }

    // Metodo para retornar dados de relatorios de bolseiros na tabela de dados em funcao do papel do Utilizador
    public function tabelaRelatorios(){
        $data['title'] = "Relat&oacute;rios";
        $ano_lectivo = $this->relatorio->getAnoLectivo();

        $data['ano_lectivo'] = $ano_lectivo;

        $sl= $this->relatorio->getSemestreLectivo();

        $data['semestre'] = $sl;

    //Invoca a funcao que retorna relatorios de funcionarios da base de dados
    $rel = $this->admin->getRelatorio();

    $data['relatoriospf'] = $rel;

       if(!is_bolseiro()){
        $data['relatorio'] = $this->admin->getRelatorio1();
        $this->breadcrumbs->admin_push('Dashboard', 'dashboard');
        $this->breadcrumbs->admin_push('Relat&oacute;rios', 'relatorios');
        $this->breadcrumbs->admin_push('Lista', 'relatorio/data');
        $this->template->load('templates/dashboard', 'relatorio/data', $data);
    }
      else

    {
      $id=$this->session->userdata('user');
      $this->db->select('*'); 
      $this->db->join('user u', 'relatorio.user_id = u.id_user');
     $this->db->where('relatorio.user_id',$this->session->userdata('login_session')['user']);
      $relatorio = $this->db->get('relatorio');


      if($relatorio->num_rows() > 0){
        $data['relatorio']=$relatorio->result_array();
        $this->breadcrumbs->admin_push('Dashboard', 'dashboard');
        $this->breadcrumbs->admin_push('Relat&oacute;rios', 'relatorio');
        $this->breadcrumbs->admin_push('Lista', 'relatorio/dataBolseiros');
           $this->template->load('templates/users','relatorio/dataBolseiros', $data);  
       }else{
        //return false;
        
            //Se ainda o Funcionario nao tiver nenhum relatorio no sistema
            set_pesan('Ainda n&atilde;o submeteu nenhum relat&oacute;rio pedag&oacute;gico nem de progresso de forma&ccedil;&atilde;o! Submeta seu relat&oacute;rio',false);
          $this->add();
          
       }
     
      
    }
    }


 // funcao personalizada para espacos, acentos, hifens e underlines
 public function customAlpha($str) 
 {
     if ( !preg_match("/^[a-záàâãéèíìêõôóòúùçÇÁÀÃÂÉÈÍÌÕÔÓÒ .,\-]+$/i",$str) )
     {
         return false;
     }
     else{

        return true;
     }
 }


// Metodo para validar atributos da tabela Relatorios
    private function _validasi()
    {
        $this->form_validation->set_rules('tipo', 'Tipo de relat&oacute;rio', 'required'); 
        $this->form_validation->set_rules('user_id', 'Funcion&aacute;rio', 'required');
    $this->form_validation->set_rules('descricao', 'Descri&ccedil;&atilde;o do relat&oacute;rio', 'required|callback_customAlpha');
    $this->form_validation->set_rules('data_envio', 'Data de envio', 'required');
    $this->form_validation->set_rules('ano_lectivo', 'Ano lectivo', 'required|is_numeric');
    $this->form_validation->set_rules('semestre', 'Semestre lectivo', 'required|is_numeric');

   $this->form_validation->set_message('is_numeric', 'O campo %s só pode conter caracteres numéricos!');   
    $this->form_validation->set_message('required', 'O campo %s é obrigatorio!');
    $this->form_validation->set_message('customAlpha', 'O campo %s só pode conter caracteres alfanuméricos, acentos, espacos, underlines e hífens.');
   

    }


    // Metodo para adicionar dados na tabela Relatorios a partir do formulario
    public function add()
    {
     
    $this->breadcrumbs->admin_push('Dashboard', 'dashboard');
    $this->breadcrumbs->admin_push('Relatorios', 'relatorio');
    $this->breadcrumbs->admin_push('Adicionar relatorio', 'relatorio/add');
    

    if ($this->form_validation->run() == false) {
        $data['title'] = "Submiss&atilde;o de Relat&oacute;rio";
            
        $data['user'] = $this->admin->get('user');
           

        $this->template->load('templates/users', 'relatorio/add', $data);
    }
    

    if (isset($_POST['submeter'])){
        $this->_validasi();
     
      $config['upload_path']          = './assets/uploads/docs';
      $config['allowed_types']        = 'pdf|doc|docx';
      $config['max_size']             = 2048; //Tamanho maximo do ficheiro: 2 MB
      $config['encrypt_name']         = TRUE;
    

     $this->load->library('upload');

     $this->upload->initialize($config);

      //Validacao para carregamento/Upload do Ficheiro/Documento
      if(!empty($_FILES['doc'])){
      $this->upload->do_upload('doc');
      $dados = $this->upload->data();
      $doc = $dados['file_name'];
      }
        

            if ($this->form_validation->run()) {
           
            $user =$this->input->post('user_id',TRUE);
            $tipo =$this->input->post('tipo',TRUE);
            $desc =$this->input->post('descricao',TRUE);
            $envio =$this->input->post('data_envio',TRUE);
            $sem =$this->input->post('semestre',TRUE);
            $al =$this->input->post('ano_lectivo',TRUE);

             
             $input=['user_id'=>$user,'tipo'=>$tipo, 'ano_lectivo'=>$al, 'semestre'=>$sem, 'descricao'=>$desc,'doc'=>$doc, 'data_envio'=>$envio];
              
              $insert = $this->admin->insert('relatorio',$input);
              if($insert){
                set_pesan('Dados registados com sucesso!');
                redirect('relatorio');
              }

            } 
                else {

                    set_pesan('Algo correu mal!');
                    redirect('relatorio/add');
                }
            
        }
         
    }

  // Metodo para actualizar de dados da tabela Relatorios  
    public function edit($getId)
    {
     //Nao permite edicao  
    }


 // Metodo para  eliminacao de dados da tabela Relatorios  
    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('relatorio', 'codRel', $id)) {
            set_pesan('Dados eliminados com sucesso!');
        } else {
            set_pesan('Algo deu errado!', false);
        }
        redirect('relatorio');
    }

}
