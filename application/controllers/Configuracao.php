<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracao extends CI_Controller
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
		$this->load->model('rat_model');
		  $this->load->library('rat');
        $this->load->model('configuracao_model');
        $this->load->model('settings_model');
        $this->load->library('session');
    }

    public function index()
    {
        # Redirecionamento ao dashboard apos autenticacao
        if ($this->session->userdata('user_login_access') == 1)
            redirect('dashboard/Dashboard');
        $data = array();
       
        $this->load->view('login');
    }


    /*.......Controlo de incializacao dos itens do modulo de CONFIGURACOES......*/

    //Inicializacao do perfil
    public function Perfil()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $data['perfil'] = $this->configuracao_model->listarTodosPerfis();
			$data['logs']=$this->rat_model->listar_logs();
          $this->template->load('templates/dashboard','backend/perfil',$data);
            } else {
            redirect(base_url(), 'refresh');
        }
    }

    //Inicializacao da Provincia
    public function Provincia()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $data['provincia'] = $this->configuracao_model->listarTodasProvincias();
			$data['logs']=$this->rat_model->listar_logs();
                    $this->template->load('templates/dashboard','backend/provincia',$data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }
    
    //Inicializacao do Distrito

    public function Distrito()
    {
        if ($this->session->userdata('user_login_access') != False) {
			$id=$this->input->get('id_distrito');
            $data['distrito'] = $this->configuracao_model->listarTodosDistritos();
            $data['distprov'] = $this->configuracao_model->listarTodasProvincias();
			$provfiltro = $this->configuracao_model->filtrarProvporDistrito();

            $data['provfiltro'] = $provfiltro;
			$data['logs']=$this->rat_model->listar_logs();
            $this->template->load('templates/dashboard','backend/distrito',$data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }
        
    //Inicializacao de Tipos de Denuncia

    public function TipoDenuncia()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $data['tipodenuncia'] = $this->configuracao_model->listarTodosTiposDenuncias();
			$data['logs']=$this->rat_model->listar_logs();
            $this->template->load('templates/dashboard','backend/tipodenuncia',$data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }



/*.......Controlo de Adicao e actualizacao de dados para itens do modulo de CONFIGURACOES......*/

    //Controlo da Adicao e actualizacao de perfil
   public function AdicionarPerfil()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id = $this->input->post('codPerfil');
            $nome = $this->input->post('papel');
 $dt = date('y-m-d H:i:s');            
 $this->form_validation->set_error_delimiters();
            $this->form_validation->set_rules('papel', 'Perfil', 'trim|required');
            $this->form_validation->set_message('required', 'O campo %s é obrigat&oacute;rio!');
             if ($this->form_validation->run() == FALSE) {
                //echo validation_errors();
               set_mensagem('Falha no registo do perfil. Verifique se escolheu um perfil !', false);
                redirect("configuracao/Perfil");
            } else {
                $data = array();
                $data = array(
                    'papel' => $nome,
					'created_at'=>$dt
                   
                );
                if (empty($id)) {
                   
                    $success = $this->configuracao_model->Adicionar_Perfil($data);
                    set_mensagem('Perfil adicionado com sucesso!', true);
					
					// Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'POST',
			  'message'=>"Um perfil foi adicionado pelo Super Admin"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
                    redirect('configuracao/Perfil');
                } else {
                    $success = $this->configuracao_model->Actualizar_Perfil($id, $data);
                set_mensagem('Perfil actualizado com sucesso!',true);
                 //  echo "Perfil actualizado com sucesso!";
				 
				 // Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'UPDATE',
			  'message'=>"Um perfil actualizado pelo Super Admin"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
                           redirect('configuracao/Perfil');

                }
                
            }
        } else {
			// Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'POST/UPDATE',
			  'message'=>"Uma tentativa falhada do Super Admin para registo dum perfil"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
	
			  set_mensagem ('Falha no registo dum perfil!', false);
			  redirect('configuracao/Perfil');
            redirect(base_url(), 'refresh');
        }
    }


    //Controlo de Adicao e actualizacao de Provincias e emails de denuncia
    public function AdicionarProvincia()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id     = $this->input->post('id_provincia');
            $prov  = $this->input->post('provincia');
            $email = $this->input->post('email');
          
            
           $this->form_validation->set_error_delimiters();
            $this->form_validation->set_rules('provincia', 'Prov&iacute;ncia', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_message('required', 'O campo %s é obrigat&oacute;rio!');
                
               
    
            if ($this->form_validation->run() == FALSE) {
                //echo validation_errors();
                  set_mensagem('Falha no registo dos dados da prov&iacute;ncia. Tente novamente!', false);
                redirect("configuracao/Provincia");
            } else {
                $data = array();
                $data = array(
                    'nome_provincia' => $prov,
                    'email' =>$email,
                      'created_at'=> date('y-m-d H:i:s') 					
                );
                if (empty($id)) {
                       
                    $success = $this->configuracao_model->Adicionar_Provincia($data);
                    set_mensagem ('Dados da prov&iacute;ncia adicionados!');
					
						// Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'POST',
			  'message'=>"Dados duma prov&iacute;ncia foram adicionados pelo Super Admin"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
                  redirect("configuracao/Provincia");
                  
                } else {
                    $success = $this->configuracao_model->Actualizar_Provincia($id, $data);
					    set_mensagem ('Dados da prov&iacute;ncia actualizados!');
						
					// Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'UPDATE',
			  'message'=>"Dados duma prov&iacute;ncia foram actualizados pelo Super Admin"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
                
               
                     redirect("configuracao/Provincia");
                }
                    
            }
        } else {
			// Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'POST/UPDATE',
			  'message'=>"Uma tentativa falhada do Super Admin para registo duma prov&iacute;ncia"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
	
			  set_mensagem ('Falha no registo dos dados da prov&iacute;ncia!', false);
			    redirect("configuracao/Provincia");
            redirect(base_url(), 'refresh');
        }
    }
    

// Controlo de Adicao e actualizacao de Distritos
public function AdicionarDistrito()
{
    if ($this->session->userdata('user_login_access') != False) {
        $id   = $this->input->post('id_distrito');
        $dist = $this->input->post('distrito');
        $prov = $this->input->post('provincia');

            
       $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('provincia', 'Provincia', 'trim|required');
        $this->form_validation->set_rules('distrito', 'Distrito', 'trim|required');
        $this->form_validation->set_message('required', 'O campo %s é obrigat&oacute;rio!');
                
               
    
        if ($this->form_validation->run() == FALSE) {
           // echo validation_errors();
	set_mensagem('Falha no registo dos dados do distrito. Verifique os dados e tente novamente!', false);

                  
            redirect("configuracao/Distrito");
        } else {
            $data = array();
            $data = array(
                'nome_distrito' => $dist,
                'provincia_id' =>$prov,
                 'created_at'=> date('y-m-d H:i:s')				
            );
            if (empty($id)) {
                $success = $this->configuracao_model->Adicionar_Distrito($data);
               set_mensagem ('Dados do distrito adicionados!');
			   
			   // Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'POST',
			  'message'=>"Um distrito foi adicionado pelo Super Admin"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
                 redirect("configuracao/Distrito");
              
            } else {
                
                $success = $this->configuracao_model->Actualizar_Distrito($id, $data);
                 set_mensagem ('Dados do distrito actualizados!');
				 
				 // Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'UPDATE',
			  'message'=>"Dados dum distrito foram actualizados pelo Super Admin"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
                            redirect("configuracao/Distrito");

            }
                    
        }
    } else {
		// Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'POST/UPDATE',
			  'message'=>"Uma tentativa falhada do Super Admin para registo dum distrito"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
		
		 set_mensagem ('Falha no registo dos dados do distrito!', false);
		 redirect('configuracao/Distrito');
        redirect(base_url(), 'refresh');
    } 
}


// Actualizacao de dados do distrito

public function ActualizarDistrito(){
    if($this->session->userdata('user_login_access') != False) {    
              $id   = $this->input->post('id_distrito');
        $dist = $this->input->post('distrito');
        $prov = $this->input->post('provincia');

            
       $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('provincia', 'Provincia', 'trim|required');
        $this->form_validation->set_rules('distrito', 'Distrito', 'trim|required');
        $this->form_validation->set_message('required', 'O campo %s é obrigat&oacute;rio!');


        if ($this->form_validation->run() == FALSE) {
               //echo validation_errors();
	set_mensagem('Falha na actualiza&ccedil;&atilde;o dos dados do distrito. Certifique-se que preencheu todos os campos obrigat&oacute;rios', false);
              redirect("configuracao/Distrito");
       
			} else {
            $distrito= $this->configuracao_model->getDadoDistrito($id);
           
                $data = array();
                $data = array(
                 'id_distrito'=>$id,
                 'nome_distrito'=>$dist,
                
                'provincia_id'=> $prov
            
                 
                );
                if($id){
				
			   // Actualizar log 
			/* $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$user,
			  'date_time'=>$stl,
			  'code'=>'UPDATE',
			  'message'=>"Uma nova den&uacute;ncia foi alterada"
			  );*/
            $success = $this->configuracao_model->Actualizar_Distrito($id, $data);
					/*$success = $this->rat_model->set_message($insert_data);*/

            set_mensagem('Dados do distrito foram actualizados!');        
                  redirect('configuracao/Distrito'); 

                }
			}
       
        }
		
		
		
		
        }
        


// Controlo de Adicao e actualizacao de tipo de denuncia
public function AdicionarTipoDenuncia()
{
    if ($this->session->userdata('user_login_access') != False) {
        $id = $this->input->post('id_tipo_denucia');
        $tipo = $this->input->post('tipo');

       $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('tipo', 'Tipo de den&uacute;ncia', 'trim|required');
        $this->form_validation->set_message('required', 'O campo %s é obrigat&oacute;rio!');
            
           
        if ($this->form_validation->run() == FALSE) {
            //echo validation_errors();
			set_mensagem('Falha no registo do tipo de den&uacute;ncia. Verifique os dados e tente novamente!', false);
			// Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'POST',
			  'message'=>"Houve falha no registo de tipo de den&uacute;ncia"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
			 redirect("configuracao/TipoDenuncia");
        } else {
            $data = array();
            $data = array(
                'tipo_denucia' => $tipo,
				'created_at'=> date('y-m-d H:i:s')
                   
            );
            if (empty($id)) {
                   
                $success = $this->configuracao_model->Adicionar_TipoDenuncia($data);

               set_mensagem('Tipo de den&uacute;ncia adicionado!');
			   
			   	// Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'POST',
			  'message'=>"Um tipo de den&uacute;ncia foi adicionado pelo Suoer Admin"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
                 redirect("configuracao/TipoDenuncia");

            } else {
                $success = $this->configuracao_model->Actualizar_TipoDenuncia($id, $data);
            
               set_mensagem ('Tipo de den&uacute;ncia actualizado!');
			   	// Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'UPDATE',
			  'message'=>"Um tipo de den&uacute;ncia foi alterado pelo Super Admin"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
                redirect("configuracao/TipoDenuncia");

            }
                
        }
    } else {
		// Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'UPDATE',
			  'message'=>"Uma tentativa falhada do Super Admin para registo de tipo de den&uacute;ncia"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
		 set_mensagem ('Falha no registo do tipo de den&uacute;ncia!', false);
		 redirect('configuracao/TipoDenuncia');
        redirect(base_url(), 'refresh');
    }
}


// Actualizacao de tipos de denuncias

public function ActualizarTipoDenuncia(){
    if($this->session->userdata('user_login_access') != False) {    
               $id = $this->input->post('id_tipo_denucia');
        $tipo = $this->input->post('tipo');

       $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('tipo', 'Tipo de den&uacute;ncia', 'trim|required');
        $this->form_validation->set_message('required', 'O campo %s é obrigat&oacute;rio!');
      
        if ($this->form_validation->run() == FALSE) {
               //echo validation_errors();
	set_mensagem('Falha na actualiza&ccedil;&atilde;o do tipo de den&uacute;ncia. Certifique-se que preencheu todos os campos obrigat&oacute;rios', false);
              redirect("configuracao/TipoDenuncia");
       
			} else {
            $distrito= $this->configuracao_model->getDadoTipoDenuncia($id);
           
                $data = array();
                $data = array(
                 'id_tipo_denucia'=>$id,
                 'tipo'=>$tipo
              
                );
                if($id){
				
			   // Actualizar log 
			/* $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$user,
			  'date_time'=>$stl,
			  'code'=>'UPDATE',
			  'message'=>"Uma nova den&uacute;ncia foi alterada"
			  );*/
            $success = $this->configuracao_model->Actualizar_TipoDenuncia($id, $data);
					/*$success = $this->rat_model->set_message($insert_data);*/

            set_mensagem('Tipo de den&uacute;ncia foi actualizado!');        
                  redirect('configuracao/TipoDenuncia'); 

                }
			}
       
        }
		
		
		
		
        }
     
    
/*.......Controlo para retornar dados para itens do modulo de CONFIGURACOES......*/

// Retornar Perfil por ID
    public function PerfilporID()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id= $this->input->get('codPerfil');
            $data['dadoperfil'] = $this->configuracao_model->getDadoPerfil($id);
            echo json_encode($data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

  
 
    // Retornar Provincia por ID
    public function ProvinciaporID()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id= $this->input->get('id_provincia');
            $data['dadoprovincia'] = $this->configuracao_model->getDadoProvincia($id);
            echo json_encode($data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }


    // Retornar Distrito por ID
    public function DistritoporID()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id= $this->input->get('id_distrito');
            $data['dadodistrito'] = $this->configuracao_model->getDadoDistrito($id);
            echo json_encode($data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

// Retornar Distrito por ID
public function TipoDenunciaporID()
{
    if ($this->session->userdata('user_login_access') != False) {
        $id= $this->input->get('id_tipo_denucia');
        $data['dadotipodenuncia'] = $this->configuracao_model->getDadoTipoDenuncia($id);
        echo json_encode($data);
    } else {
        redirect(base_url(), 'refresh');
    }
}

 /*.......Controlo para eliminacao de dados para itens do modulo de CONFIGURACOES......*/


    //Eliminar perfil
    public function EliminarPerfil()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id      = $this->input->get('codPerfil');
            $success = $this->configuracao_model->EliminarPerfil($id);
           // echo "Perfil eliminado com sucesso!";
			set_mensagem('Perfil eliminado com sucesso!',true);
			
			// Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'DELETE',
			  'message'=>"Um perfil foi eliminado pelo Super Admin"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
		redirect('configuracao/Perfil');
        } else {
			
			// Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'DELETE',
			  'message'=>"Uma tentativa falhada de excluir perfil pelo Super Admin"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
		set_mensagem('Falha ao eliminar o perfil!!',false);
		redirect('configuracao/Perfil');
           // redirect(base_url(), 'refresh');
        }
    }

    //Eliminar Provincia
    public function EliminarProvincia()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id      = $this->input->get('id_provincia');
            $success = $this->configuracao_model->EliminarProvincia($id);
            //echo "Dados da Prov&iacute;ncia eliminados com sucesso!";
			set_mensagem('Dados da Prov&iacute;ncia eliminados com sucesso!',true);
			
			// Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'DELETE',
			  'message'=>"Dados duma prov&iacute;ncia foram eliminados pelo Super Admin"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
		redirect('configuracao/Provincia');
			
        } else {
			// Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'DELETE',
			  'message'=>"Uma tentativa falhada de excluir uma prov&iacute;ncia pelo Super Admin"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
		set_mensagem('Falha ao eliminar dados da prov&iacute;ncia!!',false);
		redirect('configuracao/Provincia');
            //redirect(base_url(), 'refresh');
        }
    }

     //Eliminar Distrito
     public function EliminarDistrito()
     {
         if ($this->session->userdata('user_login_access') != False) {
             $id      = $this->input->get('id_distrito');
             $success = $this->configuracao_model->EliminarDistrito($id);
             //echo "Dados do Distrito eliminados com sucesso!";
			 set_mensagem ('Dados do Distrito eliminados com sucesso!',true);
			 
			 // Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'DELETE',
			  'message'=>"Dados dum distrito foram eliminados pelo Super Admin"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
		redirect('configuracao/Distrito');
         } else {
			 // Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'DELETE',
			  'message'=>"Uma tentativa falhada de excluir um distrito pelo Super Admin"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
		set_mensagem('Falha ao eliminar dados do distrito!',false);
		redirect('configuracao/Distrito');
             //redirect(base_url(), 'refresh');
         }
     }
 
//Eliminar Tipo de Denuncia
public function EliminarTipoDenuncia()
{
    if ($this->session->userdata('user_login_access') != False) {
        $id      = $this->input->get('id_tipo_denucia');
        $success = $this->configuracao_model->EliminarTipoDenuncia($id);
		
			   	// Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'DELETE',
			  'message'=>"Um tipo de den&uacute;ncia foi excluido pelo Super Admin"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
        set_mensagem ("Tipo de den&uacute;ncia eliminado com sucesso!");
		redirect('configuracao/TipoDenuncia'); 
		
    } else {
		 // Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$this->session->userdata('login_user_id'),
			  'date_time'=>date('Y-m-d H:i:s'),
			  'code'=>'DELETE',
			  'message'=>"Uma tentativa falhada de excluir um tipo de den&uacute;ncia pelo Super Admin"
			  );
			  
				
		$success = $this->rat_model->set_message($insert_data);
		set_mensagem('Falha ao eliminar dados do tipo de den&uacute;ncia!',false);
		redirect('configuracao/TipoDenuncia');
        //redirect(base_url(), 'refresh');
    }
}



}
