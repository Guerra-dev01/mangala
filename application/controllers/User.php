<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('dashboard_model');
        $this->load->model('user_model');
        $this->load->model('settings_model');
        $this->load->library('session');
		$this->load->library('form_validation');
		 $this->load->model('rat_model');
		  $this->load->library('rat');


        $this->load->model('login_model');
      
        $this->load->model('configuracao_model');
      
  
    }
    
    public function index()
    {
      

        if ($this->session->userdata('user_login_access') != 1){
            redirect(base_url() . 'login', 'refresh');
        }
        if ($this->session->userdata('user_login_access') == 1)
        {
         $data= array();
        redirect('user/User');
        }
    }

    public function User()
    {
        $data['title'] = "Utilizadores registados";
   
     if($this->session->userdata('user_login_access') != False) { 
        $data['user'] = $this->user_model->utilselect();
		$data['logs']=$this->rat_model->listar_logs();
        $this->template->load('templates/dashboard', 'user/data', $data);
    }
else{
    redirect(base_url() , 'refresh');
} }


//Metdo que inicializa o formulario para adicao de novo usuario
   public function Adicionar(){
        if($this->session->userdata('user_login_access') != False) { 
		 $data['provincia']=$this->user_model->listarTodasProvincias();
              $data['distrito']=$this->user_model->listarTodosDistritos();
              $data['perfil']=$this->user_model->listarTodosPerfis();
			  

        $this->template->load('templates/dashboard', 'user/adicionar', $data);

        }
    else{
		redirect(base_url() , 'refresh');
	}            
    }


// Adicao de novo usuario
	public function AdicionarUser(){     
    if($this->session->userdata('user_login_access') != False) {     
    $uid = $this->input->post('user');    
     
	$nome = $this->input->post('nome');
	
	$role = $this->input->post('perfil');
	
	$senha = $this->input->post('senha');
		
	$datacad = $this->input->post('created_at');	
	$sexo = $this->input->post('sexo');
	$cont = $this->input->post('contacto');
	$prov = $this->input->post('provincia');
	$dist= $this->input->post('distrito');
	$local= $this->input->post('bairro');
    $idade= $this->input->post('idade');
    $status= $this->input->post('status');

	
	$username = $this->input->post('usuario');	
  
	$email = $this->input->post('email');	
	$password = md5($senha);	
	$confirm = $this->input->post('senha2');	
		
       
        $this->form_validation->set_error_delimiters();
      
		/*validando campo de Email*/
        $this->form_validation->set_rules('email', 'Email','trim|required|min_length[7]|max_length[100]|xss_clean');
       

        if ($this->form_validation->run() == FALSE) {
            //echo validation_errors();
			  set_mensagem('Falha no registo do Utilizador. Tente novamente!', false);
			 $data['provincia']=$this->user_model->listarTodasProvincias();
              $data['distrito']=$this->user_model->listarTodosDistritos();
              $data['perfil']=$this->user_model->listarTodosPerfis();
			  
			   $this->template->load('templates/dashboard', 'user/adicionar', $data);
			
			} else {
            if($this->user_model->VerificarEmail($email) && $password != $confirm){
                $this->session->set_flashdata('formdata','Email existente ou senha inv&aacute;lida. Verifique');
                echo "Email existente ou senha inv&aacute;lida. Verifique!";
            } else {
            if($_FILES['avatar']['name']){
            $file_name = $_FILES['avatar']['name'];
			$fileSize = $_FILES["avatar"]["size"]/1024;
			$fileType = $_FILES["avatar"]["type"];
			$new_file_name='';
            //$new_file_name .= $usrrand;

            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./assets/images/users",
                'allowed_types' => "gif|jpg|png|jpeg",
                'overwrite' => False,
                'max_size' => "20240000", // Tamanho max para foto do perfil (avatar)
                'max_height' => "800",
                'max_width' => "800"
            );
    
            $this->load->library('Upload', $config);
            $this->upload->initialize($config);                
            if (!$this->upload->do_upload('avatar')) {
               // echo $this->upload->display_errors();
			   set_mensagem('Falha no upload da imagem. Tente novamente!', false);
				redirect('user/adicionar');
			}
   
			else {
                $path = $this->upload->data();
				$dt = date('Y-m-d H:i:s');
                $hora = date("H:i:s"); 
                $avatar = $path['file_name'];
                $data = array();
				
                $data = array(
      
                   'cod_prov'=> $prov,
                   'cod_cid'=> $dist,
                   'localizacao'=> $local,
                   'ano_nascimento'=> $idade,
                    'id_usuario' => $uid,
                    'usuario' => $username,
                    'nome' => $nome,
  					'email' => $email,
					'id_perfil'=>$role,
				    'sexo'=>$sexo,
                   'status'=>'Activo*a)',
                    'contacto'=>$cont,
                    'created_at' =>$dt,
                    'avatar'=>$avatar
                   
                );
				
			     $user= $this->input->post("email");
	
              $id= $this->user_model->tblusuarios($data);
			    $data1 = array();
				$data1 = array(

                  'id_usuario' => $id,
                  'password' => $password,
                  'username' => $email,
                  'nome' => $nome,
				 'statusid'=>'1',
				 'status'=>'Activo(a)',
				  'id_perfil'=>$role,
				  'avatar'=>$avatar,
				  'created_at' =>$dt
                   );
			
				$this->user_model->tbllogin($data1);
				 	 set_mensagem('Dados adicionados!');	   
                    redirect('user/User'); 	
		   
                if($uid){
            $success = $this->user_model->Actualizar_User($uid,$data); 
			$success1 = $this->user_model->Actualizar_Login($id,$data1); 
            
            set_mensagem('Dados actualizados!');	
			redirect('user/User'); 
                } 
			}
        } else {
               	$dt = date('Y-m-d H:i:s');
                $data = array();
				
                $data = array(
      
                   'cod_prov'=> $prov,
                   'cod_cid'=> $dist,
                   'localizacao'=> $local,
                   'ano_nascimento'=> $idade,
                    'id_usuario' => $uid,
                    'usuario' => $username,
                    'nome' => $nome,
                     'status'=>'Activo(a)',
					'email' => $email,
					'id_perfil'=>$role,
				    'sexo'=>$sexo,
                    'contacto'=>$cont,
				    'created_at' =>$dt
       
                );
				
			    $user= $this->input->post("email");
	
             $id= $this->user_model->tblusuarios($data);
			    $data1 = array();
				$data1 = array(

                 'id_usuario' =>$id,
                  'password' => $password,
                  'username' => $user,
                  'nome' => $nome,
				  'status' => 'Activo(a)',
				  	  
				  'id_perfil'=>$role,
				  'created_at' =>$dt

                );
			$this->user_model->tbllogin($data1);
				 	 set_mensagem('Dados adicionados!');	   
           redirect('user/User');
		   
                if($uid){
				
            $success = $this->user_model->Actualizar_User($uid,$data); 
			$success1 = $this->user_model->Actualizar_Login($id,$data1); 
            set_mensagem('Dados actualizados!');	     
             redirect('user/User'); 
                }
				redirect('user/User'); 
            }
            }
        }
        }
    else{
		set_mensagem('Falha na adi&ccedil;&atilde;o ou actualiza&ccedil;&atilde;o!', false);
		redirect(base_url() , 'refresh');
	       }        
		}


  //Retornar distritos
public function distritosporProvincia() { 

      $id=$this->input->post('provincia_id',true);
       $data = $this->user_model->listarDistritosProvincia($id);//$this->db->where("provincia_id",$id)->get("tbldistrito")->result();
       echo json_encode($data);
   }
	
// Actualizacao de dados do usuario  
	public function Actualizar(){
    if($this->session->userdata('user_login_access') != False) {    
       $uid = $this->input->post('user');    
     
	$nome = $this->input->post('nome');
	
	$role = $this->input->post('perfil');
	
	$senha = $this->input->post('senha');
		
	$datacad = $this->input->post('created_at');	
	$sexo = $this->input->post('sexo');
	$cont = $this->input->post('contacto');
	$prov = $this->input->post('provincia');
	$dist= $this->input->post('distrito');
	$local= $this->input->post('bairro');
    $idade= $this->input->post('idade');
    $status= $this->input->post('status');

	
	$username = $this->input->post('usuario');	
  
	$email = $this->input->post('email');	
	$password = md5($senha);	
	$confirm = $this->input->post('senha2');	
		
        $this->form_validation->set_error_delimiters();
    $this->form_validation->set_rules('email', 'Email','trim|required|min_length[7]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
			
            //echo validation_errors();
      set_mensagem('Falha ao actualizar os dados. Verifique os dados e tente novamente!', false);
	  
		redirect("user/view?I=" .base64_encode($uid));
			} else {
            if($_FILES['avatar']['name']){
            $file_name = $_FILES['avatar']['name'];
			$fileSize = $_FILES["avatar"]["size"]/1024;
			$fileType = $_FILES["avatar"]["type"];
			$new_file_name='';
           // $new_file_name .= $id;

            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./assets/images/users",
                'allowed_types' => "gif|jpg|png|jpeg",
                'overwrite' => False,
                'max_size' => "20240000", // Tamanho max para avatar: 2 MB(2048 Kb)
                'max_height' => "600",
                'max_width' => "600"
            );
    
            $this->load->library('Upload', $config);
            $this->upload->initialize($config);                
            if (!$this->upload->do_upload('image_url')) {
                //echo $this->upload->display_errors();
				set_mensagem('Falha no upload da imagem. Tente novamente!', false);
                redirect("user/view?I=" .base64_encode($uid));
			}
   
			else {
            $user = $this->user_model->getDadosUtilizador($uid);
            $checkimage = "./assets/images/users/$user->avatar";                 
                if(file_exists($checkimage)){
            	unlink($checkimage);
				}
                $path = $this->upload->data();
				$dt = date('Y-m-d H:i:s');
                $avatar= $path['file_name'];
                $data = array();
				
                $data = array(
      
                   'cod_prov'=> $prov,
                   'cod_cid'=> $dist,
                   'localizacao'=> $local,
                   'ano_nascimento'=> $idade,
                    'nome' => $nome,
                   
					'email' => $email,
				
					'id_perfil'=>$role,
				    'sexo'=>$sexo,
                   
					'status'=>$status,
					'update_at' =>$dt,
                  
                    'avatar'=>$avatar
                   
                );
				
			    $user= $this->input->post("email");
	
			    $data1 = array();
				$data1 = array(
                  'password' => $password,
                  'username' => $user,
                  'nome' => $nome,
				  'id_perfil'=>$role,
				  'avatar'=>$avatar,
				  'status'=>$status,
				  
				   'updated_at' =>$dt
				     
                );
		
                if($uid){
           $success = $this->user_model->Actualizar_User($uid,$data); 
			$success1 = $this->user_model->Actualizar_Login($uid,$data1); 
             
		  set_mensagem('Dados actualizados!',true);
           			
              redirect("user/view?I=" .base64_encode($uid)); 
                }
			}
        } else {
                $data = array();
				$dt = date('Y-m-d H:i:s');
                $data = array(
      
                   'cod_prov'=> $prov,
                   'cod_cid'=> $dist,
                   'localizacao'=> $local,
                   'ano_nascimento'=> $idade,
                    'nome' => $nome,
                   	'email' => $email,
					'id_perfil'=>$role,
				    'sexo'=>$sexo,
                   	'status'=>$status,
					'updated_at' =>$dt
      
                   
                );
				
			    $user= $this->input->post("email");
				    $data1 = array();
				$data1 = array(
                  'password' => $password,
                  'username' => $user,
                  'nome' => $nome,
				  'id_perfil'=>$role,
				  'updated_at' =>$dt,
				  'status'=>$status
				  

                );
		 
                if($uid){
             $success = $this->user_model->Actualizar_User($uid,$data); 
			$success1 = $this->user_model->Actualizar_Login($uid,$data1); 
                      set_mensagem('Dados actualizados!');			
              redirect("user/view?I=" .base64_encode($uid)); 
                }
            }
        }
        }
        
    else{
		set_mensagem('Falha na actualiza&ccedil;&atilde;o!', false);
		redirect("user/view?I=" .base64_encode($uid)); 
		redirect(base_url() , 'refresh');
	       }        
		}
  
  
  // Vista do perfil do Usuario (tabbeb panel)
    public function view(){
        if($this->session->userdata('user_login_access') != False) {
        $id = base64_decode($this->input->get('I'));
        $data['infobasica'] = $this->user_model->GetBasic($id);
         $data['userpass'] = $this->user_model->GetUserID($id);
        $data['logs']=$this->rat_model->listar_logs();
        $data['provincia'] = $this->user_model->listarTodasProvincias();
        $data['perfil1'] = $this->configuracao_model->getDadoPerfil($id);
		$data['perfil'] = $this->user_model->listarTodosPerfis();
		$data['socialmedia'] = $this->user_model->GetSocialValue($id);
		
     
      
             $this->template->load('templates/dashboard','backend/user_view', $data);

        }
    else{
		redirect("user/view?I=".base64_encode($id));
		redirect(base_url() , 'refresh');
	}  

    }


  
   
    public function Save_Social(){
        if($this->session->userdata('user_login_access') != False) {
        $id = $this->input->post('id');
        $uid = $this->input->post('uid');
        $facebook = $this->input->post('facebook');
        $twitter = $this->input->post('twitter');
        $google = $this->input->post('google');
        $skype = $this->input->post('skype');
        
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('facebook', 'company_name', 'trim|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
			} else {
            $data = array();
                $data = array(
                    'codUtil' => $uid,
                    'facebook' => $facebook,
                    'twitter' => $twitter,
                    'google_plus' => $google,
                    'skype_id' => $skype
                );
            if(empty($id)){
                $success = $this->user_model->Insert_Media($data);
                set_mensagem('Dados adicionados!');
            } else {
                $success = $this->user_model->Update_Media($id,$data);
				set_mensagem('Dados actualizados!');
                
            }
                       
        }
        }
    else{
		set_mensagem('Falha na adi&ccedil;&atilde;o ou actualiza&ccedil;&atilde;o!', false);
		redirect("user/view?I=" .base64_encode($id)); 
		redirect(base_url() , 'refresh');
	}        
    }
   
    // Alteracao de senha de senha
    public function Reset_Password_Hr(){
        if($this->session->userdata('user_login_access') != False) {
        $id = $this->input->post('uid');
        $onep = $this->input->post('nova1');
        $twop = $this->input->post('nova2');
            if($onep == $twop){
                $data = array();
                $data = array(
                    'password'=> md5($onep),
                    'status'=>'Activo(a)'
                );
        $success = $this->user_model->Reset_Password($id,$data);
       	set_mensagem('Senha actualizada com sucesso!');
        redirect("user/view?I=" .base64_encode($id));
	   
            } else {
        
		set_mensagem('Por favor, insira uma senha v&aacute;lida!', false);
       redirect("user/view?I=" .base64_encode($id)); 
               
            }

        }
    else{
		redirect(base_url() , 'refresh');
	}        
    }
   
    public function Reset_Password(){
        if($this->session->userdata('user_login_access') != False) {
        $id = $this->input->post('uid');
		
        $oldp = md5($this->input->post('antiga'));
        $onep = $this->input->post('nova1');
        $twop = $this->input->post('nova2');
        $pass = $this->user_model->GetUserID($id);
        if($pass->password == $oldp){
            if($onep == $twop){
                $data = array();
                $data = array(
                    'password'=> md5($onep)
                                  );
        $success = $this->user_model->Reset_Password($id,$data);
        		set_mensagem('Senha actualizada!');
		redirect("user/view?I=".base64_encode($id));
	            } 
			else {
 	     set_mensagem('Por favor, insira uma senha v&aacute;lida!', false);
        redirect("user/view?I=".base64_encode($id));
       
               
            }
        } 
			
			else {
      	        set_mensagem('Por favor, insira uma senha v&aacute;lida!', false);
             redirect("user/view?I=".base64_encode($id));

               
            }
        } 
        
    else{
		set_mensagem('Falha na actualiza&ccedil;&atilde;o da senha!', false);
		redirect("user/view?I=".base64_encode($id));
		redirect(base_url() , 'refresh');
	}        
    }
	
	//Eliminar User
public function EliminarUser()
{
    if ($this->session->userdata('user_login_access') != False) {
        $id      = $this->input->get('id_usuario');
        $success = $this->user_model->EliminarUsuario($id);
		
			   	// Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'DELETE',
			  'message'=>"Um Utilizador foi excluido pelo Super Admin"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
        	set_mensagem('O Utilizador foi excluido com sucesso!');
			redirect('user/User'); 
			
    } else {
		 // Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'DELETE',
			  'message'=>"Uma tentativa falhada de excluir um Utilizador pelo Super Admin"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
		set_mensagem('Falha ao eliminar dados do Utilizador!',false);
		redirect('user/User'); 
        redirect(base_url(), 'refresh');
    }
}
   

}