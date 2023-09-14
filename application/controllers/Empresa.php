 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Controller {
    
	    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('login_model');
        $this->load->model('dashboard_model'); 
         $this->load->model('user_model'); 
        $this->load->library('form_validation');
        $this->load->library('session'); 
        $this->load->model('empresa_model'); 
		 $this->load->model('rat_model');
		  $this->load->library('rat');
         $this->load->model('settings_model'); 

    }
    public function index(){
		#Redirect para dashboard apos autenticacao
        if ($this->session->userdata('user_login_access') == 1)
            redirect('dashboard/Dashboard');
            $data=array();
     			$this->load->view('login');        
    }
	
	//Inicializacao do formulario para adicao/actualizacao de dados da empresa
    public function Empresa(){
        if($this->session->userdata('user_login_access') != False) { 
        $data['empresa'] = $this->empresa_model->GetEmpresaValue();
		$data['logs']=$this->rat_model->listar_logs();
        $this->template->load('templates/dashboard', 'backend/empresa',$data);
        }
    else{
		redirect(base_url() , 'refresh');
	}            
    }
	
	//Entradas e validacao do formulario para adicao/actualizacao de dados da empresa
    public function Add_Empresa(){ 
        if($this->session->userdata('user_login_access') != False) { 
        $id = $this->input->post('id');
        $nome = $this->input->post('nome');
        $nuit = $this->input->post('nuit');
        $cont = $this->input->post('contacto');
        $cont1 = $this->input->post('contacto2');
        $email = $this->input->post('email');
        $cid = $this->input->post('cidade');
        $bairro = $this->input->post('bairro');
        $avenida = $this->input->post('avenida');
        $nrcasa = $this->input->post('nrcasa');
        
        $this->form_validation->set_error_delimiters();
          
        // Validacao do nome
        $this->form_validation->set_rules('nome', 'Nome','trim|required|min_length[5]|max_length[60]|xss_clean');
          
        // Validacao da cidade
        $this->form_validation->set_rules('cidade', 'Cidade', 'trim|required|min_length[4]|max_length[11]|xss_clean');
          
        // Validacao de enderecos
        $this->form_validation->set_rules('avenida', 'Avenida', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nrcasa', 'N&uacute;mero de casa', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
			//echo validation_errors();
		set_mensagem('Falha no registo dos dados da empresa. Certifique-se que preencheu todos os campos (obrigat&oacute;rios)!', false); 
        redirect('empresa/Empresa');		

			} else {

            if($_FILES['img_url']['name']){
			$settings = $this->settings_model->GetSettingsValue();
            $file_name = $_FILES['img_url']['name'];
			$fileSize = $_FILES["img_url"]["size"]/1024;
			$fileType = $_FILES["img_url"]["type"];
            
			$checkimage = "./assets/images/$empresa->logotipo";

            $config = array(
                'file_name' => $file_name,
                'upload_path' => "./assets/images/",
                'allowed_types' => "gif|jpg|png|jpeg|svg",
                'overwrite' => False,
                'max_size' => "13038", // Tamanho maximo da imagem do logotipo em MB
                'max_height' => "850",
                'max_width' => "850"
            );
    
            $this->load->library('Upload', $config);
            $this->upload->initialize($config);                
            if (!$this->upload->do_upload('img_url')) {
            //echo $this->upload->display_errors();
					set_mensagem('Falha no upload da imagem. Verifique o tamanho (n&atilde;o superior a 2Mb) ou tipo de imagem!', false);  
                     redirect('empresa/Empresa');
			}
			else {
				if(file_exists($checkimage)){
            	unlink($checkimage);
				}
                $path = $this->upload->data();
                $img_url =$path['file_name'];
                $data = array();
                $data = array(
                    'logotipo' => $img_url,
                    'nome' => $nome,
                    'nuit' => $nuit,
                    'contacto' => $cont,
                    'contacto2' => $cont1,
					'bairro' => $bairro,
					'avenida' => $avenida,
					'email'=>$email,
                    'cidade'=>$cid,
					'nrcasa'=>$nrcasa
                );
            $success = $this->settings_model->EmpresaUpdate($id,$data);
			    set_mensagem ('Dados actualizados!');
               
                redirect("empresa/Empresa");
                      
			}
        } else {
                $data = array();
                $data = array(
                  'nome' => $nome,
                    'nuit' => $nuit,
                    'contacto' => $cont,
                    'contacto2' => $cont1,
					'bairro' => $bairro,
					'avenida' => $avenida,
					'email'=>$email,
                    'cidade'=>$cid,
					'nrcasa'=>$nrcasa
                );
            $success = $this->empresa_model->EmpresaUpdate($id,$data);
			set_mensagem ('Dados actualizados!');
            redirect("empresa/Empresa");
          
            }
		}
        
        }
    else{
		set_mensagem ('Falha no registo dos dados da empresa. Verifique-os!', false);
		redirect(base_url() , 'refresh');
     
	}
}
}