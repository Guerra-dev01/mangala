 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rat extends CI_Controller {


    function __construct() {
        parent::__construct();
        $this->load->database();
         $this->load->model('login_model');
        $this->load->model('dashboard_model');
        $this->load->model('user_model');
		//$this->load->library('rat');
        $this->load->model('rat_model');
        $this->load->model('settings_model');
        $this->load->library('session');
    }
    
	public function index()
	{
		#Redirecionar o user apos autenticacao
        if ($this->session->userdata('user_login_access') == 1)
            redirect('dashboard/Dashboard');
            $data=array();
           
			$this->load->view('login');
	}
	
	// Metodo para listar notificacoes/logs de actividades
    public function Listar_logs(){
        if($this->session->userdata('user_login_access') != False) {
        $data['logs'] = $this->rat_model->listar_logs();
        $this->template->load('templates/dashboard', 'backend/log', $data);
        }
    else{
		redirect(base_url() , 'refresh');
	}        
    }
   //Excluir log de actividade/notificacao
   public function EliminarLog()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id      = $this->input->get('id');
            $success = $this->rat_model->EliminarLog($id);
            set_mensagem('Notifica&ccedil;&atilde;o de actividade excluida com sucesso',true);
			redirect('rat/Listar_logs');
        } else {
			set_mensagem('Falha ao excluir a notifica&ccedil;&atilde;o de actividade!',false);
			redirect('rat/Listar_logs');
            redirect(base_url(), 'refresh');
        }
    }
    
}