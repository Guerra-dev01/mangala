<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public $status; 
    public $roles;
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
		$this->load->model('login_model','login');
		$this->load->model('user_model');
         $this->load->library('session');
		 $this->load->model('rat_model');
		  $this->load->library('rat');
		 $this->load->helper('url');
		 $this->load->library('form_validation');

		$this->load->model('dashboard_model');
		
       $this->status = $this->config->item('status'); 
		$this->statusid = $this->config->item('statusid'); 
        $this->roles = $this->config->item('roles');
	}
    
	public function index()
	{
		#Redirecionar o user aodashboard apos autenticacao
		if ($this->session->userdata('user_login_access') == 1){
         set_mensagem('Seja bem-vindo ao Mangala. A sua plataforma de den&uacute;ncias!');
			redirect(base_url() . 'dashboard');
      
        }
      
			$data=array();
			
			$this->load->view('login');
	}
	

/*...................Metodo que valida o Login .........................*/
public function Login_Auth(){	
	$response = array();
  
	//Recepcao de entrada de email/username e senha para login
	$email = $this->input->post('username');
    $pass=$this->input->post('password');
	$password = md5($pass);
	$remember = $this->input->post('remember');
  
	#Validacao das credenciais de login
	$this->load->library('form_validation');
	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	$this->form_validation->set_rules('username', 'Email do Utilizador', 'trim|xss_clean|required|min_length[7]');
	$this->form_validation->set_rules('password', 'Senha', 'trim|xss_clean|required|min_length[6]');
	
	if($this->form_validation->run() == FALSE){
      set_mensagem('Email inv&aacute;lido ou senha inv&aacute;lida. Verifique!',false);
		redirect(base_url() . 'login', 'refresh');		
	}
	else{
		//Validando o login
     
		$login_status = $this->validate_login($email, $password);
		$response['login_status'] = $login_status;
      
		if ($login_status == 'success') {
				
        $stl=date('y-m-d H:i:s');				
			   // Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('user_login_id'),
			  'date_time'=>$stl,
			  'code'=>'Login',
			  'message'=>"Utilizador(a) efectuou Login no Mangala"
			  );
			  
				
			$success = $this->rat_model->set_message($insert_data);
			
			// Recordar a sessao do user:
			if($remember){
				setcookie('username',$email,time() + (86400 * 30));
				setcookie('password',$this->input->post('password'),time() + (86400 * 30));
				redirect(base_url() . 'login', 'refresh');
        		
			} else {
				if(isset($_COOKIE['username']))
				{
					setcookie('username','');
				}
				if(isset($_COOKIE['password']))
				{
					setcookie('password','');
				}        		
				redirect(base_url() . 'login', 'refresh');
			}
        }
		
		else{
						
			   // Insert log 
			    $stl=date('y-m-d H:i:s');
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('user_login_id'),
			  'date_time'=>$stl,
			  'code'=>'Login',
			  'message'=>"Falha no Login dum(a) Utilizador(a) no Mangala"
			  );
			  
				
			$success = $this->rat_model->set_message($insert_data);
             set_mensagem('Email inv&aacute;lido ou senha inv&aacute;lida. Verifique!',false);
			 
			redirect(base_url() . 'login', 'refresh');
		}
	
	}
	}
	//Validando o pedido para login
	function validate_login($email = '', $password = '') {
		$credential = array('username' => $email, 'password' => $password, 'status' => 'Activo(a)');
        

    // Procurar a existencia das credenciais do user
		$query = $this->user_model->getUserForLogin($credential);
		
		//Se forem encontradas:
		if ($query->num_rows() > 0) {
			$row = $query->row();
			
			
			//Guardar esses dados da sessao:
			$this->session->set_userdata('user_login_access', '1');
		  
			$this->session->set_userdata('user_login_id', $row->id_usuario);
			$this->session->set_userdata('login', $row->id);

			$this->session->set_userdata('nome', $row->nome);
		
			$this->session->set_userdata('username', $row->username);
			$this->session->set_userdata('avatar', $row->avatar);			
			$this->session->set_userdata('feedback', '');
			$this->session->set_userdata('formdata', '');

			$this->session->set_userdata('perfil', $row->id_perfil);

			return 'success';
		}
	}

	/*Registo de Utilizadores */
	public function register()
	{

		
$this->form_validation->set_rules('nome', 'Nome', 'required|trim');
$this->form_validation->set_rules('cod_prov', 'Provincia', 'required|trim');
$this->form_validation->set_rules('codPerfil', 'Perfil', 'required|trim');



$this->form_validation->set_rules('usuario', 'Usu&aacute;rio', 'trim|is_unique[tblusuarios.usuario]|alpha_numeric',
array(
'is_unique[tblusuarios.usuario]', 'Este registo para %s já existe. Por favor, escolha outro.',
'is_unique', 'Este registo para %s já existe. Por favor, escolha outro.',
'alpha_numeric', 'O campo %s só pode conter caracteres alfanuméricos.' 
));
   

$this->form_validation->set_rules('password', 'Senha', 'required|min_length[4]|trim',
array('required', 'O campo %s  é obrigatorio.',
'min_length[4]','O campo %s deve ter no mínimo %s caracteres.',
'min_length','O campo %s deve ter no mínimo %s caracteres.'
)


);
$this->form_validation->set_rules('senha2', 'Confirma&ccedil;&atilde;o da Senha', 'required|trim|min_length[4]|matches[password]',
array(
	'min_length[4]', 'O campo %s deve ter no minimo 4 caracteres.',
	'min_length', 'O campo %s deve ter no minimo 4 caracteres.',
	'matches[password]', 'O campo %s deve ser igual ao campo %s.',
	'matches', 'O campo %s deve ser igual ao campo %s.'
));

$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tblusuarios.email]',
array('required', 'O campo %s  é obrigatorio.',
'valid_email', 'O campo %s deve conter um email válido.',
'is_unique[tblusuarios.email]','Este registo para %s já existe. O email deve ser &uacute;nico',
'is_unique','Este registo para %s já existe. Por favor, escolha outro.'

));
$this->form_validation->set_message('required', 'O campo %s  é obrigat&oacute;rio.');

		if ($this->form_validation->run() == false) {
			$data['title']='Registo de Utilizadores';
			$this->load->view('login/register', $data);
		} else {
         if (isset($_POST['registar']))
         {
         $dt = date('Y-m-d H:i:s');
       

        $data1 = array(
              
          'nome' => htmlspecialchars($this->input->post('nome', true)),
          'usuario' => htmlspecialchars($this->input->post('usuario ', true)),
          'email' => htmlspecialchars($this->input->post('email', true)),
          'sexo' => htmlspecialchars($this->input->post('sexo', true)),   
          'contacto' => htmlspecialchars($this->input->post('contacto', true)),
          'cod_prov'=> htmlspecialchars($this->input->post('cod_prov', true)),
          'cod_cid'=> htmlspecialchars($this->input->post('codDistrito', true)),
          'localizacao'=> htmlspecialchars($this->input->post('bairro', true)),
          'ano_nascimento'=> htmlspecialchars($this->input->post('idade', true)),

          'id_perfil'=> '5',
          'created_at' =>$dt,
         'status'=>'Activo(a)',
          'avatar'=>"./assets/images/users/user.png"
            );

          if ($this->form_validation->run() == false) {
			  
				   // Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$id,
			  'date_time'=>$dt,
			  'code'=>'Cadastro',
			  'message'=>"Falha no cadastro no Mangala dum(a) Utilizador(a)"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
		
			$data['title']='Registo de Utilizadores';
			$this->load->view('login/register', $data);
		}
            else
            {
               $user= $this->input->post("email");
              
               $id= $this->user_model->tblusuarios($data1);
                $data2 = array(
                  'id_usuario' => $id,
                 'password' => md5($this->input->post("password")),
                  'username' => $user,
                  'nome' => htmlspecialchars($this->input->post('nome', true)),
				  'status' => 'Activo(a)',
				  'id_perfil'=>'5',
				  'avatar'=>"./assets/images/users/user.png",
				   'created_at' =>$dt
            );
                $this->user_model->tbllogin($data2);
				
				
				   // Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$id,
			  'date_time'=>$dt,
			  'code'=>'Cadastro',
			  'message'=>"Um(a) Utilizador(a) fez um cadastro no Mangala"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
		
		// Invocacao do metodo que valida o login apos registo para redirecionar user a dashboard
	        $this->validate_loginAposRegisto();
			
		
             set_mensagem('Seja bem-vindo ao Mangala, a sua plataforma de den&uacute;ncias!');
                redirect('dashboard');      
        }
         }
        }
	
}

// Validacao de login apos registo do user
	function validate_loginAposRegisto() {
		$email = $this->input->post("email");
		$password = md5($this->input->post("password"));
		
		$credential = array('username' => $email, 'password' => $password, 'status' => 'Activo(a)');
        

    // Procurar a existencia das credenciais do user
		$query = $this->user_model->getUserForLogin($credential);
		
		//Se forem encontradas as credenciais:
		if ($query->num_rows() > 0) {
			$row = $query->row();
			
			
			//Guardar esses dados da sessao:
			$this->session->set_userdata('user_login_access', '1');
		  
			$this->session->set_userdata('user_login_id', $row->id_usuario);
			$this->session->set_userdata('login', $row->id);

			$this->session->set_userdata('nome', $row->nome);
		
			$this->session->set_userdata('username', $row->username);
			$this->session->set_userdata('avatar', $row->avatar);			
			$this->session->set_userdata('feedback', '');
			$this->session->set_userdata('formdata', '');

			$this->session->set_userdata('perfil', $row->id_perfil);
		}
	}

  
	/*Logout metodo*/
	function logout() {
		// Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'LOGOUT',
			  'message'=>"Um(a) Utilizador(a) fez Logout no Mangala"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
		
		$this->session->sess_destroy();
		   
		$this->session->set_flashdata('feedback', 'Sess&atilde;o terminada.');

		redirect(base_url(), 'refresh');
	}
  
    function recuperacao_senhacomEmail(){
		 
//Email de confirmacao
	/*public function confirm_mail_send($email,$randcode){
		$config = Array( 
		'protocol' => 'smtp', 
		'smtp_host' => 'ssl://smtp.googlemail.com', 
		'smtp_port' => 465, 
		'smtp_user' => 'mail.imojenpay.com', 
		'smtp_pass' => ''
		); 		  
		 $from_email = "imojenpay@imojenpay.com"; 
		 $to_email = $email; 
   
		 //Load email library 
		 $this->load->library('email',$config); 
   
		 $this->email->from($from_email, 'Dotdev'); 
		 $this->email->to($to_email);
		 $this->email->subject('Confirm Your Account'); 
		 $message	 =	"Confirm Your Account";
		 $message	.=	"Click Here : ".base_url()."Confirm_Account?C=" . $randcode.'</br>'; 
		 $this->email->message($message); 
   
		 //Send mail 
		 if($this->email->send()){ 
			$this->session->set_flashdata('feedback','Kindly check your email To reset your password');
		 }
		 else {
		 $this->session->set_flashdata("feedback","Error in sending Email."); 
		 }			
	}
  
	public function verification_confirm(){
		$verifycode = $this->input->get('C');
		$userinfo = $this->login_model->GetuserInfoBycode($verifycode);
		if($userinfo){
			$data = array();
			$data = array(
				'status'=>'ACTIVO(A)',
				'confirm_code' => 0
			);
			$this->login_model->UpdateStatus($verifycode,$data);
			if($this->db->affected_rows()){
			$this->session->set_flashdata('feedback','Your Account has been confirmed!! now login');
			$this->load->view('login');
			}			
		} else {
			$this->session->set_flashdata('feedback','Sorry your account has not been varified');
			$this->load->view('login');  			
		}
	}
  
  // Recuperacao de senha com envio de Email
	public function forgotten_page(){
		$data=array();
		$data['settingsvalue'] = $this->dashboard_model->GetSettingsValue();
		$this->load->view('auth/forgot_password',$data);
	}
	public function forgot_password(){
		$email = $this->input->post('email');
		$checkemail = $this->login_model->Does_email_exists($email);
		if($checkemail){
			$randcode = md5(uniqid());
			$data=array();
			$data=array(
				'forgotten_code'=>$randcode
			);
			$updatedata = $this->login_model->UpdateKey($data,$email);
			$updateaffect = $this->db->affected_rows();
			if($updateaffect){
			$email=$this->input->post('email');	
			$this->send_mail($email,$randcode);
			$this->session->set_flashdata('feedback','Kindly check your email' .' '.$email. 'To reset your password');
			redirect('Retriev');				
			} else {
				
			}
		} 
		else {
			$this->session->set_flashdata('feedback','Please enter a valid email address!');
			redirect('Retriev');
		}
	}
	  public function send_mail($email,$randcode) {
		$config = Array( 
		'protocol' => 'smtp', 
		'smtp_host' => 'ssl://smtp.googlemail.com', 
		'smtp_port' => 25, 
		'smtp_user' => 'mail.imojenpay.com', 
		'smtp_pass' => ''
		); 		  
		 $from_email = "imojenpay@imojenpay.com"; 
		 $to_email = $email; 
   
		 //Load email library 
		 $this->load->library('email',$config); 
   
		 $this->email->from($from_email, 'Dotdev'); 
		 $this->email->to($to_email);
		 $this->email->subject('Reset your password!!Dotdev'); 
		  $message	=	"Your or someone request to reset your password" ."<br />";
		  $message	=	"Click  Here : ".base_url()."Reset_password?p=" . $randcode."<br />"; 
		 $this->email->message($message); 
   
		 //Send mail 
		 if($this->email->send()){ 
			$this->session->set_flashdata('feedback','Kindly check your email To reset your password');
		 }
		 else {
		 $this->session->set_flashdata("feedback","Error in sending Email."); 
		 }	
	  }
  
  function Reset_View(){
		$this->load->helper('form');
		$reset_key = $this->input->get('p');
		if($this->login_model->Does_Key_exists($reset_key)){
		$data['key']= $reset_key;
		$this->load->view('auth/reset_page',$data);
		} 
		else {
			$this->session->set_flashdata('feedback','Please enter a valid email address!');
			redirect('Retriev');
		}
	}
  
  
	public function Reset_password_validation(){
		$password = $this->input->post('password');
		$confirm = $this->input->post('confirm');
		$key = $this->input->post('reset_key');
		$userinfo = $this->login_model->GetUserInfo($key);
		
		if($password == $confirm){
			if($userinfo->password != sha1($password)){
			$data=array();
			$data = array(
				'forgotten_code'=> 0,
				'password'=>sha1($password)
				);
		$update = $this->login_model->UpdatePassword($key,$data);
		if($this->db->affected_rows()){
			$data['message'] = 'Successfully Updated your password!!';
			$this->load->view('login',$data);
		}
		} else {
			$this->session->set_flashdata('feedback','You enter your old password.Please enter new password');
			redirect('Reset_password?p='.$key);			
		}
		} else {
			$this->session->set_flashdata('feedback','Password does not match');
			redirect('Reset_password?p='.$key);
		}
	}	
	*/
		
	}
	
	
	/*...............RECUPERACAO DE SENHA SEM ENVIO DE EMAIL.....................*/
	
	//Caso o user tenha se esquecido da senha:

  public function validarEmail(){
	   $this->form_validation->set_rules('username', 'Email', 'required|valid_email[tbllogin.username]'); 
	     $this->form_validation->set_message('required', 'O campo %s é obrigat&oacute;rio!'); 
		     $this->form_validation->set_message('valid_email', 'O campo %s deve conter um email válido.'); 
    $this->form_validation->set_message('valid_email[tbllogin.username]', 'O campo %s deve conter um email válido.'); 
 
	  
  }
    public function forgot()
    {
            
       
           $this->validarEmail();
			  
        if($this->form_validation->run() == FALSE) {
			 
            $data['title']='Senha esquecida';
            $this->load->view('login/forgot', $data);
			
        }else{
            $email = $this->input->post('username');  
            $clean = $this->security->xss_clean($email);
            $userInfo = $this->login->getUserInfoByEmail($clean);
                
            if(!$userInfo){
			
			// Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'Senha esquecida',
			  'message'=>"Utilizador(a) inseriu Email inv&aacute;lido para recuperar senha"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
                set_mensagem('Email n&atilde;o encontrado!', false);
               
                redirect('login');
            }   
                
            if($userInfo->status != 'Activo(a)'){  //Para conta inactiva......'Inactivo(a)'...$this->status[Inactivo(a)]
               // $this->session->set_flashdata('feedback','Sua conta encontra-se inactiva!');
				// Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'Senha esquecida',
			  'message'=>"A conta do(a) Utilizador(a) encontra-se inactiva. Sem possibilidade de recuperar senha"
			  );
			  			
		$success = $this->rat_model->set_message($insert_data);
				
				set_mensagem('Sua conta encontra-se inactiva', false);
                redirect('login');
            }
           
		   
            //construcao do token		
            $token = $this->login->insertToken($userInfo->id_usuario);                        
            $qstring = $this->base64url_encode($token);                  
            $url = site_url() . 'login/reset_password/token/' . $qstring;
            $link = '<a href="' . $url . '">' . $url . '</a>'; 
                
            $message = '';                     
            $message .= '<strong>Uma redefini&ccedil;&atilde;o de senha foi solicitada!</strong><br>';
            $message .= '<strong>Por favor, clique neste link:</strong> ' . $link .'<strong> para redifinir a sua senha! </strong>';             

            echo $message; //Envia mensagem via email
			
		// Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'Senha esquecida',
			  'message'=>"Um link foi gerado para o(a) Utilizador(a) alterar sua senha"
			  );
			  			
		$success = $this->rat_model->set_message($insert_data);
            exit;
                
        }
            
    }
	
	
// Reset de senha

public function reset_password()
{
    $token = $this->base64url_decode($this->uri->segment(4));                  
    $cleanToken = $this->security->xss_clean($token);

    $user_info = $this->login->isTokenValid($cleanToken); // Falso ou o array eh nulo;               

    if(!$user_info){
		// Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'Senha esquecida',
			  'message'=>"Um link gerado para o(a) Utilizador(a) alterar sua senha expirou ou ficou invalidado."
			  );
			  			
		$success = $this->rat_model->set_message($insert_data);
        set_mensagem('O token &eacute; inv&aacute;lido ou expirou',false);
        redirect('login');
    } 
// Guardar senha relacionando user ao link (token) para reset de senha
    $data = array(
        'password'=>$user_info->password, 
        'token'=>$this->base64url_encode($token)
    );

    $this->form_validation->set_rules('password', 'Senha', 'required|min_length[4]');
  
  
    $this->form_validation->set_rules('passconf', 'Confirma&ccedil;&atilde;o da senha', 'required|matches[password]');  
   $this->form_validation->set_message('required', '%s é obrigat&oacute;ria!'); 
   $this->form_validation->set_message('min_length','%s deve ter no m&iacute;nimo 4 caracteres!'); 
  $this->form_validation->set_message('min_length[4]','%s deve ter no m&iacute;nimo 4 caracteres!'); 
 
   $this->form_validation->set_message('matches[password]','%s deve ser igual a %s!'); 
   $this->form_validation->set_message('matches','%s deve ser igual a %s!'); 
  

    if ($this->form_validation->run() == FALSE) {   
        $data['title']='Actualiza&ccedil&atilde;o de senha';
        $this->load->view('login/reset_password', $data);
       
    }else{
                    
        $this->load->library('password');    
        $post = $this->input->post(NULL, TRUE);                
        $data = $this->security->xss_clean($post); 
       $pass =  $this->input->post('password');
        $hashed = md5($pass); 
        $cleanPost['password'] = $hashed;
        $cleanPost['user_id'] = $user_info->id_usuario;
        unset($cleanPost['passconf']); 
      
        if(!$this->login->updatePassword($cleanPost)){  

         // Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'Senha esquecida',
			  'message'=>"O(A) utilizador(a) n&atilde;o conseguiu alterar sua senha."
			  );
			  			
		$success = $this->rat_model->set_message($insert_data);	
            set_mensagem('Ocorreu um problema na actualiza&ccedil;&atilde;o da sua senha',false);
           
        }else{
			  // Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'Senha esquecida',
			  'message'=>"A senha do(a) Utilizador(a) foi redefinida com sucesso."
			  );
			  			
		$success = $this->rat_model->set_message($insert_data);	
           set_mensagem('Sua senha foi redefinida. Use a sua nova senha para entrar no sistema.',true);
        }
        redirect('login');                
    }
}

// Configuracao de url do token
    public function base64url_encode($data) { 
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
      } 
  
      public function base64url_decode($data) { 
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
      } 
	
}