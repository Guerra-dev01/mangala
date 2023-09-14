 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
    
	    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('login_model');
		$this->load->library('session'); 
        $this->load->model('dashboard_model'); 
        $this->load->model('user_model'); 
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
	
	//Inicializacao do formulario de definicao de dados do site
    public function Settings(){
        if($this->session->userdata('user_login_access') != False) { 
        $data['settingsvalue'] = $this->settings_model->GetSettingsValue();
		$data['logs']=$this->rat_model->listar_logs();
        $this->template->load('templates/dashboard', 'backend/settings',$data);
        }
    else{
		redirect(base_url() , 'refresh');
	}            
    }
	
	// Adicao e/ou actualizao de dados do site
    public function Add_Settings(){ 
        if($this->session->userdata('user_login_access') != False) { 
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $copyright = $this->input->post('copyright');
        $contact = $this->input->post('contact');
        $currency = $this->input->post('currency');
        $symbol = $this->input->post('symbol');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $address2 = $this->input->post('address2');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
          
        // Validacao de titulo do site
        $this->form_validation->set_rules('title', 'title','trim|required|min_length[5]|max_length[60]|xss_clean');
          
        // Validacao da descricao do site
        $this->form_validation->set_rules('description', 'description', 'trim|required|min_length[20]|max_length[512]|xss_clean');
          
        // Validacao de enderecos
        $this->form_validation->set_rules('address', 'address', 'trim|min_length[5]|max_length[600]|xss_clean');
        $this->form_validation->set_rules('address2', 'address2', 'trim|min_length[5]|max_length[600]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
			//echo validation_errors();
			set_mensagem('Falha na defini&ccedil;&atilde;o dos dados do Site. Verifique se preencheu o formul&aacute;rio devidamente!', false);  
			redirect('settings/Settings');
			} else {

            if($_FILES['img_url']['name']){
			$settings = $this->settings_model->GetSettingsValue();
            $file_name = $_FILES['img_url']['name'];
			$fileSize = $_FILES["img_url"]["size"]/1024;
			$fileType = $_FILES["img_url"]["type"];
            
			$checkimage = "./assets/images/$settings->sitelogo";

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
                     redirect('settings/Settings');
			}
			else {
				if(file_exists($checkimage)){
            	unlink($checkimage);
				}
                $path = $this->upload->data();
                $img_url =$path['file_name'];
                $data = array();
                $data = array(
                    'sitelogo' => $img_url,
                    'sitetitle' => $title,
                    'description' => $description,
                    'copyright' => $copyright,
                    'contact' => $contact,
					'currency' => $currency,
					'symbol' => $symbol,
					'system_email'=>$email,
                    'address'=>$address,
					'address2'=>$address2
                );
            $success = $this->settings_model->SettingsUpdate($id,$data);
			  set_mensagem ('Dados actualizados!');
              redirect("settings/Settings");
              		         
			}
        } else {
                $data = array();
                $data = array(
                    'sitetitle' => $title,
                    'description' => $description,
                    'copyright' => $copyright,
                    'contact' => $contact,
					'currency' => $currency,
                    'symbol' => $symbol,
					'system_email'=>$email,
                    'address'=>$address,
					'address2'=>$address2,
                );
            $success = $this->settings_model->SettingsUpdate($id,$data);
			set_mensagem('Dados actualizados!');
               
                redirect("settings/Settings");
              	
    
            }
		}
      
        }
    else{
		set_mensagem('Falha na adi&ccedil;&atilde;o ou actualiza&ccedil;&atilde;o!', false);
		redirect(base_url() , 'refresh');
     
	}
}
}