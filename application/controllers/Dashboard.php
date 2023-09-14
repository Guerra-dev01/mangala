 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	    function __construct() {
        parent::__construct();
        date_default_timezone_set('Africa/Harare');

      // verifica_login();

        $this->load->model('login_model');
        $this->load->model('dashboard_model'); 
         $this->load->model('user_model');
        $this->load->library('session');
       $this->load->model('settings_model');
        	 $this->load->model('rat_model');
		  $this->load->library('rat');
        $this->load->model('configuracao_model');
 
    }
    
	public function index()
	{

        $data['title'] = "Dashboard";

   /*.....Metodos para retornar dados na dashboard do SuperAdmin/Admin.....*/

        $data['denucte_masc'] = $this->dashboard_model->getDenunciantes_Masculinos();
        $data['denucte_fem'] = $this->dashboard_model->getDenunciantes_Femininos();
           
        $data['denuncias']=$this->dashboard_model->contagem_denuncias();
        $data['tpdenuncias']=$this->dashboard_model->contagem_tipodenuncias();
        $data['denuncias_7dias']=$this->dashboard_model->denuncias_7dias();
        $data['usuarios']=$this->dashboard_model->total_denunciantes();
		$data['logs']=$this->rat_model->listar_logs();
       
    

        // Grafico de linha para relatorios de denuncias por mes
      $query = $this->db->query("SELECT monthname(created_at) as mes, COUNT(id_denucias) as total
			    FROM tbldenucias
                GROUP BY mes
      ");

       $record = $query->result();
      //$record = [];
      foreach($record as $r)
      {
        $data['mes'][] = $r->mes;
        
        $data['total'][] = (int) $r->total;
      }


        // Grafico de linha para relatorios de denuncias por provincia
     $query = $this->db->query("SELECT tblprovincia.nome_provincia as prov,
     COUNT(id_denucias) as totalp
    FROM tbldenucias
    join tblprovincia
    where tbldenucias.cod_prov=tblprovincia.id_provincia 
    GROUP BY prov
  ");

 $record = $query->result();
 //$data = [];
  foreach($record as $r)
  {
    $data['prov'][] = $r->prov;
    $data['totalp'][] = (int) $r->totalp;
  }

  $data['denuciasdist']=$this->dashboard_model->denuncias_distrito();
  $data['denuciasidade']=$this->dashboard_model->denuncias_idade();
  

// Filtro de denuncias por idades
  $ano = $this->dashboard_model->getAnoDenuncia();

  $data['ano'] = $ano;

  $mes = $this->dashboard_model->getMesDenuncia();

  $data['mes'] = $mes;

  $mes1 = $this->dashboard_model->getMesDenuncia();

  $data['mes1'] = $mes1;

  // Para filtro de denuncias idade-provincia
  $prov1 = $this->dashboard_model->getDenunciaMesIdade_Prov();

  $data['prov1'] = $prov1;

  // Para filtro de denuncias distrito-provincia
  $prov = $this->dashboard_model->getDenunciaMesIdade_Prov();

  $data['prov'] = $prov;

        // Para filtro de denuncias distrito-idade
     $dist = $this->dashboard_model->getDenunciaMesDist_Prov();

    $data['dist'] = $dist;
  
      
      /*..............Metodos para retornar dados na dashboard do User Denunciante.................*/
       $id=$this->session->userdata('user_login_id');
	//$data['denuncias']=$this->denuncia_model->listarDenunciasporUser($id);
      
        $data['denuncias_7diasUser']=$this->dashboard_model->denuncias_7diasUser($id);
        $data['denuncias_30diasUser']=$this->dashboard_model->denuncias_30diasUser($id);
        $data['denunciasUser']=$this->dashboard_model->contagem_denunciasUser($id);

        $this->template->load('templates/dashboard', 'dashboard', $data);
    }
	
	
	}
    
        
