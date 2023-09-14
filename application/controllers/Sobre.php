<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sobre extends CI_Controller
{
    
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('login_model');
        $this->load->model('dashboard_model');
         $this->load->model('user_model');
        $this->load->library('session');
			$this->load->model('rat_model');
		  $this->load->library('rat');
        $this->load->model('configuracao_model');
        $this->load->model('settings_model');
       ;
       

    }

    public function index()
    {
        # Redirecionamento a pagina de info sobre Mangala
          if ($this->session->userdata('user_login_access') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($this->session->userdata('user_login_access') == 1)
          $data= array();
        redirect('sobre/Sobre');
    }


    /*.......Controlo de incializacao da pagina de info sobre Mangala......*/

    //Inicializacao do perfil
    public function Sobre()
    {
        if ($this->session->userdata('user_login_access') != False) {
          
		   $data['logs']=$this->rat_model->listar_logs();
          $this->template->load('templates/dashboard','backend/sobre', $data);
         
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    



}
