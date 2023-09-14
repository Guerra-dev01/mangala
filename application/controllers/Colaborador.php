<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Colaborador extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
        $this->load->library('breadcrumbs');
    }

    public function index()
    {
        $data['title'] = "Funcion&aacute;rios";
        $data['colaborador'] = $this->admin->getColaborador();
        $this->breadcrumbs->admin_push('Dashboard', 'dashboard');
        $this->breadcrumbs->admin_push('Funcion&aacute;rios', 'colaborador');
        $this->breadcrumbs->admin_push('Funcion&aacute;rios', 'colaborador/data');
        $this->template->load('templates/dashboard', 'colaborador/data', $data);
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


   
      // funcao para controlar seleccao de apenas funcionarios bolseiros
      public function selecaoFuncBolseiro(){

        $this->db->select('u.id_user,u.nama,u.role');
       // $this->db->join('user u', 'c.user_id= u.id_user');
       // $this->db->join('disciplina d', 'n.cod_Disc= d.codDisc');
        //$this->db->join('curso c', 'n.cod_Curso= c.codCurso');
        $this->db->where('u.role=','Func. Bolseiro');
        $this->db->order_by('u.id_user');
        $this->db->group_by('u.nama');
        return $this->db->get('user u')->result();

        }

    // funcao para controlar seleccao de apenas emails de funcionarios bolseiros
    public function selecaoFuncBolseiroporEmail(){

        $this->db->select('u.id_user,u.email,u.nama,u.role');
       // $this->db->join('user u', 'c.user_id= u.id_user');
       // $this->db->join('disciplina d', 'n.cod_Disc= d.codDisc');
        //$this->db->join('curso c', 'n.cod_Curso= c.codCurso');
        $this->db->where('u.role=','Func. Bolseiro');
        $this->db->order_by('u.id_user');
        $this->db->group_by('u.email');
        return $this->db->get('user u')->result();

        }

    //Calculo tempo de trabalho  
    public function calculoTempoServico(){
        $data1 = date("Y-m-d");
      //  $data2 = date("Y-m-d",strtotime($_POST['inicio']));
        $data2 = $this->input->post('inicio',true);

       // $data1 = new DateTime('');
       // $data2 = $this->input->post('inicio',true);
    
       $duracao= abs(strtotime($data2) - strtotime($data1));

       $anos = floor($duracao / (365*60*60*24));
       $meses = floor(($duracao- $anos * 365*60*60*24) / (30*60*60*24));
       $dias = floor(($duracao - $anos * 365*60*60*24 - $meses*30*60*60*24)/ (60*60*24));
        }
   
    // funcao para controlar escolha do Func. Bolseiro
    public function verificarUser()
    {
        $usr = $this->input->post('user_id',true);

        if($usr < 3){
            return false;
            //set_pesan('O Utilizador escolhido n&atilde;o &eacute; um Funcion&eacute;rio Bolseiro!',false);
        }
        else{

            return true;
         }
    }

    private function _validasi()
    {
       

        $this->form_validation->set_rules('user_id', 'Funcion&aacute;rio (Bolseiro)', 'required|is_unique[colaborador.user_id]');
        $this->form_validation->set_rules('funcao', 'Funcao do Colaborador', 'required|trim|callback_customAlpha');
        $this->form_validation->set_rules('idade', 'Idade do colaborador', 'required|integer');
        $this->form_validation->set_rules('email', 'Email do Utilizador/Funcion&aacute;rio', 'required|is_unique[colaborador.email]');
        $this->form_validation->set_rules('sexo', 'Sexo do Colaborador', 'required');
        $this->form_validation->set_rules('inicio', 'Data de ingresso do Colaborador', 'required');
        $this->form_validation->set_rules('estado', 'Estado de actividade do colaborador', 'required');
        //$this->form_validation->set_rules('tempo_serv', 'Tempo de servico do colaborador', 'required|integer');   
        $this->form_validation->set_message('required', 'O campo %s é obrigatorio!'); 
        $this->form_validation->set_message('integer', 'O campo %s deve conter um número inteiro!'); 
        $this->form_validation->set_message('is_unique', 'Este registo para %s já existe. Por favor, escolha outro.'); 
       
         $this->form_validation->set_message('verificarUnicidadeEmail', 'Este registo para %s já existe. Por favor, escolha outro.');
         $this->form_validation->set_message('customAlpha', 'O campo %s só pode conter caracteres alfanuméricos, acentos, espacos, underlines e hífens.');
         $this->form_validation->set_message('is_unique[colaborador.user_id]', 'O Funcion&aacute;rio deve ser &uacute;nico!');

    }

    public function add()
    {
        $this->breadcrumbs->admin_push('Dashboard', 'dashboard');
        $this->breadcrumbs->admin_push('Funcion&aacute;rios', 'colaborador');
        $this->breadcrumbs->admin_push('Adicionar Funcion&aacute;rio', 'colaborador/add');
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Adi&ccedil;&atilde;o de Dados do Funcion&aacute;rio";
            $data['user'] = $this->admin->get('user');
            $data['users'] = $this->selecaoFuncBolseiro();
            $data['duracao'] = $this-> calculoTempoServico();
            $data['users_email'] = $this->selecaoFuncBolseiroporEmail();


            // Gestao do ID do colaborador (Funcionario)
            $cod = $this->admin->getMax('colaborador', 'codColab');
            $cod_dig = substr($cod, -4, 4);
            $cod_dig++;
            $num = str_pad($cod_dig, 4, '0', STR_PAD_LEFT);
            $data['codColab'] = 'CO' . $num;

            $this->template->load('templates/dashboard', 'colaborador/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('colaborador', $input);

            if ($insert) {
                set_pesan('Dados registados com sucesso!');
                redirect('colaborador');
            } else {
                set_pesan('Algo correu mal!');
                redirect('colaborador/add');
            }
        }
    }
    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->breadcrumbs->admin_push('Dashboard', 'dashboard');
        $this->breadcrumbs->admin_push('Funcion&aacute;rios', 'colaborador');
        $this->breadcrumbs->admin_push('Editar Dados do Funcion&aacute;rio', 'colaborador/edit/'.$getId);
        
        $this->form_validation->set_rules('user_id', 'Funcion&aacute;rio (Bolseiro)', 'required|callback_verificarUser');
            $this->form_validation->set_rules('funcao', 'Funcao do Colaborador', 'required|trim|callback_customAlpha');
            $this->form_validation->set_rules('idade', 'Idade do colaborador', 'required|integer');
            $this->form_validation->set_rules('email', 'Email do Utilizador/Funcion&aacute;rio', 'required');
            $this->form_validation->set_rules('sexo', 'Sexo do Colaborador', 'required');
            $this->form_validation->set_rules('inicio', 'Data de ingresso do Colaborador', 'required');
            $this->form_validation->set_rules('estado', 'Estado de actividade do colaborador', 'required');
           // $this->form_validation->set_rules('tempo_serv', 'Tempo de servico do colaborador', 'required|integer' );   
            $this->form_validation->set_message('required', 'O campo %s é obrigatorio!'); 
            $this->form_validation->set_message('integer', 'O campo %s deve conter um número inteiro!'); 
            $this->form_validation->set_message('is_unique', 'Este registo para %s já existe. Por favor, escolha outro.'); 
       
             $this->form_validation->set_message('verificarUnicidadeEmail', 'Este registo para %s já existe. Por favor, escolha outro.');
             $this->form_validation->set_message('customAlpha', 'O campo %s só pode conter caracteres alfanuméricos, acentos, espacos, underlines e hífens.');
             $this->form_validation->set_message('verificarUser', 'Selecione somente nome de %s.');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Actualiza&ccedil;&atilde;o de Dados do Funcion&aacute;rio";
            $data['user'] = $this->admin->get('user');
            $data['users'] = $this->selecaoFuncBolseiro();
            $data['duracao'] = $this-> calculoTempoServico();
            $data['users_email'] = $this->selecaoFuncBolseiroporEmail();

            $data['colaborador'] = $this->admin->get('colaborador', ['codColab' => $id]);
            $this->template->load('templates/dashboard', 'colaborador/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('colaborador', 'codColab', $id, $input);

            if ($update) {
                set_pesan('Dados actualizados com sucesso!');
                redirect('colaborador');
            } else {
                set_pesan('Algo correu mal!');
                redirect('colaborador/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('colaborador','codColab', $id) ){ //'codColab', $id
            set_pesan('Dados eliminados com sucesso!');
        } else {
            set_pesan('Algo deu errado!', false);
        }
        redirect('colaborador');
    }
}
