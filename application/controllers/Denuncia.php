<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Denuncia extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('login_model');
        $this->load->library('session');
        $this->load->model('dashboard_model');
        $this->load->model('user_model');
        $this->load->model('configuracao_model');
        $this->load->model('denuncia_model');
        $this->load->library('form_validation');
		 $this->load->library('session');
		 $this->load->model('rat_model');
		  $this->load->library('rat');
        $this->load->model('settings_model');
        
    }

 //Inicializacao da pagina de denuncias
    public function index()
    {
        

        if ($this->session->userdata('user_login_access') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($this->session->userdata('user_login_access') == 1)
          $data= array();
	     $this->Denuncia();
    }
    
	
//Redirecionamento a tabela de dados de denuncias
   public function Denuncia(){
      $data['title'] = "Den&uacute;cias registadas";

  
     if($this->session->userdata('user_login_access') != False) {
      
// Filtro de denuncias por ano
  $ano = $this->denuncia_model->getHorarioDenuncia();

  $data['ano'] = $ano;

// Filtro de denuncias por mes
  $mes = $this->denuncia_model->getMesDenuncia();

  $data['mes'] = $mes;
  
  // Filtro de denuncias por user
  $usuario= $this->denuncia_model->getUserDenuncia();

  $data['usuario'] = $usuario;
  
  //Redirecionar o user para a sua dashboard com base no seu perfil
      if(!is_denunciante()){
              $data['denuncia'] =$this->denuncia_model->listarTodasDenuncias();
              $data['provincia']=$this->denuncia_model->listarLocaisDenuncias();
              $data['distrito']=$this->denuncia_model->listarDistritosDenuncias();
			   //$data['distrito']=$this->listarDistritosDenuncias();
              $data['categoria1']=$this->denuncia_model->listarCategoriasDenuncias1();
              $data['categoria']=$this->denuncia_model->listarCategoriasDenuncias();
              $data['user']=$this->denuncia_model->listarUsers();
              $data['tipo']=$this->denuncia_model->listarTiposDenuncias();
			  $data['logs']=$this->rat_model->listar_logs();
              $this->template->load('templates/dashboard', 'denuncia/dados', $data);  
    }
      else  if(is_denunciante())

    {
   
      $id=$this->session->userdata('user_login_id');
       $this->db->select('tbldenucias.*, p.nome_provincia, d.nome_distrito, u.id_usuario, u.nome as user, cd.*, td.*');
        $this->db->join('tblprovincia p', 'p.id_provincia= tbldenucias.cod_prov');
        $this->db->join('tbldistrito d', 'd.id_distrito= tbldenucias.cod_cid');
        $this->db->join('tblcategoriadenucia cd', 'cd.id_categoria= tbldenucias.idcatdenucia');
        $this->db->join('tbltipodenucia td', 'td.id_tipo_denucia= tbldenucias.idTipodenucia');
        $this->db->join('tblusuarios u', 'u.id_usuario= tbldenucias.id_usuario');
      $this->db->where('tbldenucias.id_usuario', $this->session->userdata('user_login_id'));
      $denunciasporuser = $this->db->get('tbldenucias');

      if($denunciasporuser->num_rows() > 0){
        $data['denunciaporuser']=$denunciasporuser->result_array();
		$data['provincia']=$this->denuncia_model->listarLocaisDenuncias();
        $data['distrito']=$this->denuncia_model->listarDistritosDenuncias();
	   // $data['distrito']=$this->distritosporProvincia();
         $data['categoria1']=$this->denuncia_model->listarCategoriasDenuncias1();
         $data['categoria']=$this->denuncia_model->listarCategoriasDenuncias();
         $data['user']=$this->denuncia_model->listarUsers();
         $data['tipo']=$this->denuncia_model->listarTiposDenuncias();
       $this->template->load('templates/dashboard','denuncia/dadosUser', $data);  
       }else{
        //return false;

        //Se o denunciante ainda nao tiver feito nenhuma denuncia no sistema
        set_mensagem('Ainda n&atilde;o possui nenhuma den&uacute;ncia no sistema! Use o sistema para denunciar',false);
        //$this->adicionar();
		$data['title']='Minhas den&uacute;ncias';
		$data['denunciaporuser']=$denunciasporuser->result_array();
		$data['provincia']=$this->denuncia_model->listarLocaisDenuncias();
       $data['distrito']=$this->denuncia_model->listarDistritosDenuncias();
		//$data['distrito']=$this->distritosporProvincia();
         $data['categoria1']=$this->denuncia_model->listarCategoriasDenuncias1();
         $data['categoria']=$this->denuncia_model->listarCategoriasDenuncias();
         $data['user']=$this->denuncia_model->listarUsers();
         $data['tipo']=$this->denuncia_model->listarTiposDenuncias();
		$this->template->load('templates/dashboard','denuncia/dadosUser', $data);
       }
       
    }
    }
	else{
    redirect(base_url() , 'refresh');
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

  //Funcao para validacao de entradas no formulario
    private function validarDados()
    {
 
       $this->form_validation->set_rules('idTipodenucia', 'Tipo de denuncia', 'required|trim');
       $this->form_validation->set_rules('id_usuario', 'Usu&aacute;rio', 'required|trim');
       $this->form_validation->set_rules('idcatdenucia', 'Categoria de denuncia', 'required|trim');
       $this->form_validation->set_rules('cod_prov', 'Prov&iacute;ncia', 'required|trim');
       $this->form_validation->set_rules('cod_cid', 'Distrito', 'required|trim');
       
        $this->form_validation->set_rules('localizacao', 'Localiza&ccedil;&atilde;o', 'required|trim');
        $this->form_validation->set_rules('assunto', 'Assunto', 'required');
        //$this->form_validation->set_rules('descricao', 'Descricao', 'required');
		$this->form_validation->set_rules('sexo', 'Sexo', 'required');
		$this->form_validation->set_rules('ano_nascimento', 'Idade', 'required');
         $this->form_validation->set_message('required', 'O campo %s é obrigat&oacute;rio!');  
  
       $this->form_validation->set_message('is_unique', 'Este registo para %s já existe. Por favor, escolha outro.'); 
       $this->form_validation->set_message('is_numeric', 'O campo %s só pode conter caracteres numéricos.'); 

       $this->form_validation->set_message('customAlpha', 'O campo %s só pode conter caracteres alfanuméricos, acentos, espacos, underlines e hífens.');
      
    }
  
  //Adicionar nova denuncia
  public function adicionar(){ 
     
    if($this->session->userdata('user_login_access') != False) {     
               $id = $this->input->post('id_denucias');

             $tipo = $this->input->post('idTipodenucia');
             $user = $this->input->post('id_usuario');
             $cat = $this->input->post('idcatdenucia');
             $prov = $this->input->post('cod_prov');
             $bairro = $this->input->post('cod_cid');
             $dencte = $this->input->post('nome');
           
             $idade = $this->input->post('ano_nascimento');
  
             $dist = $this->input->post('localizacao');
             $cont = $this->input->post('contacto');
               $email = $this->input->post('email');

             $sexo = $this->input->post('sexo');
             $ds = date('y-m-d');
             $st1 = date('y-m-d H:i:s');

             $hr = date('H:i:s');
             $ass = $this->input->post('assunto');
             $desc = $this->input->post('descricao');
            	   
        
        $this->form_validation->set_error_delimiters();
         
               
        // Validar entradas do formulario
        $this->validarDados();

        if ($this->form_validation->run() == FALSE) {
         //   echo validation_errors();
			set_mensagem('Falha no registo da den&uacute;ncia. Certifique-se que preencheu todos os campos obrigat&oacute;rios', false);
         
	    $this->Denuncia();
			} else {
            if($_FILES['imagem']['name']){
            $file_name = $_FILES['imagem']['name'];
			$fileSize = $_FILES["imagem"]["size"]/1024;
			$fileType = $_FILES["imagem"]["type"];
			$new_file_name='';
            $new_file_name .= $id;

            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./assets/denuncias/media",
                'allowed_types' => "gif|jpg|jpeg|png|pdf|doc|docx|mp3|mp4|3gp|avi|mpeg",
                'overwrite' => False,
                'max_size' => "20240000", // Tamanho maximo do ficheiro
                //'max_height' => "800",
              //  'max_width' => "800"
			      'create_thumb' => TRUE,
                  'maintain_ratio' => TRUE
            );
    
            $this->load->library('Upload', $config);
            $this->upload->initialize($config); 
           		
            if (!$this->upload->do_upload('imagem')) {
              // $this->upload->display_errors();
			set_mensagem('Falha no upload do ficheiro. Verifique o seu tipo e/ou tamanho', false);

			   $this->Denuncia();
                   #redirect('denuncia/Denuncia'); 
         
			}
   
			else {         
                $path = $this->upload->data();
                $img = $path['file_name'];
                $data = array();
                $data = array(
                 'id_denucias'=>$id,
                 'idTipodenucia'=>$tipo,
                
                'id_usuario'=>$user,
                'idcatdenucia'=> $cat,
                'cod_prov'=> $prov,
                'cod_cid'=>$bairro,
                 'nome'=>$dencte,
                 'email'=> $email,
                'ano_nascimento'=> $idade,

                'localizacao'=>$dist,
                'contacto'=> $cont,

                'sexo'=>$sexo,
							
                'created_at'=>$st1,

                'assunto'=> $ass,
                'descricao'=>$desc,
                'imagem'=>$img    
                );

                if(empty($id)){
					// Insert log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$user,
			  'date_time'=>$stl,
			  'code'=>'Adicionar',
			  'message'=>"Uma nova den&uacute;ncia foi submetida"
			  );
			  
					  $success = $this->denuncia_model->Adicionar_Denuncia($data);
					  $success1 = $this->rat_model->set_message($insert_data);
                   set_mensagem('Den&uacute;ncia adicionada!');  
                       redirect('denuncia/Denuncia'); 
           
                } else {
            // Actualizar log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$user,
			  'date_time'=>$stl,
			  'code'=>'Actualizar',
			  'message'=>"Uma nova den&uacute;ncia foi alterada"
			  );
          $success = $this->denuncia_model->Actualizar_Denuncia($id,$data); 
		  $success1 = $this->rat_model->set_message($insert_data);
          set_mensagem('Den&uacute;ncia actualizada!');
                   redirect('denuncia/Denuncia');  

                }
			}
        } else {
                $data = array();
                $data = array(
                'id_denucias'=>$id,

                 'idTipodenucia'=>$tipo,
                
                'id_usuario'=>$user,
                'idcatdenucia'=> $cat,
                'cod_prov'=> $prov,
                'cod_cid'=>$bairro,
                 'nome'=>$dencte,
                 'email'=> $email,
                'ano_nascimento'=> $idade,

                'localizacao'=>$dist,
                'contacto'=> $cont,

               'created_at'=>$st1,

                'assunto'=> $ass,
                'descricao'=>$desc
               
                );
				  
                if(empty($id)){
						// Insert log 
			$st1 = date('y-m-d H:i:s');

			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$id,
			  'date_time'=>$stl,
			  'code'=>'POST',
			  'message'=>"Uma nova den&uacute;ncia foi submetida"
			  );
               $success = $this->denuncia_model->Adicionar_Denuncia($data);
			   $success1 = $this->rat_model->set_message($insert_data);
            set_mensagem('Den&uacute;ncia adicionada!'); 
               redirect('denuncia/Denuncia'); 
                } else {
    
			  // Actualizar log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$user,
			  'date_time'=>$stl,
			  'code'=>'UPDATE',
			  'message'=>"Uma nova den&uacute;ncia foi alterada"
			  );

             $success = $this->denuncia_model->Actualizar_Denuncia($id,$data); 
             $success1 = $this->rat_model->set_message($insert_data);
            set_mensagem('Den&uacute;ncia actualizada!');
                   redirect('denuncia/Denuncia');  
			   
                }
              
              
            }
            }
      
        }
    else{
			   // Error log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$user,
			  'date_time'=>$stl,
			  'code'=>'ERRO',
			  'message'=>"Houve falha no registo duma den&uacute;ncia"
			  );
		$success = $this->rat_model->set_message($insert_data);
		set_mensagem('Falha no registo da den&uacute;ncia!', false);
		redirect(base_url() , 'refresh');
	       }
        }
           
		
  // Actualizacao de denuncias

public function actualizar(){
    if($this->session->userdata('user_login_access') != False) {    
              $id = $this->input->post('id_denucias');

             $tipo = $this->input->post('idTipodenucia');
             $user = $this->input->post('id_usuario');
             $cat = $this->input->post('idcatdenucia');
             $prov = $this->input->post('cod_prov');
             $dist = $this->input->post('cod_cid');
             $dencte = $this->input->post('nome');
           
             $idade = $this->input->post('ano_nascimento');
  
             $bairro = $this->input->post('localizacao');
             $cont = $this->input->post('contacto');
               $email = $this->input->post('email');

             $sexo = $this->input->post('sexo');
             $ds = date('y-m-d');
                   $st1 = date('y-m-d H:i:s');

             $hr = date('H:i:s');
             $ass = $this->input->post('assunto');
             $desc = $this->input->post('descricao');
            	   
        
             $this->form_validation->set_error_delimiters();
         
               
        // Validar entradas do formulario
        $this->validarDados();


        if ($this->form_validation->run() == FALSE) {
               //echo validation_errors();
	set_mensagem('Falha na actualiza&ccedil;&atilde;o da den&uacute;ncia. Certifique-se que preencheu todos os campos obrigat&oacute;rios', false);
              $this->Denuncia();
       
			} else {
            if($_FILES['imagem']['name']){
            $file_name = $_FILES['imagem']['name'];
			$fileSize = $_FILES["imagem"]["size"]/1024;
			$fileType = $_FILES["imagem"]["type"];
			$new_file_name='';
            $new_file_name .= $id;

            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./assets/denuncias/media",
                'allowed_types' => "gif|jpg|jpeg|png|pdf|doc|docx|mp3|mp4|3gp|avi|mpeg",
                'overwrite' => False,
                'max_size' => "20240000", // Tamanho maximo do ficheiro
                //'max_height' => "600",
                //'max_width' => "600"
            );
    
            $this->load->library('Upload', $config);
            $this->upload->initialize($config);                
            if (!$this->upload->do_upload('imagem')) {
               // echo $this->upload->display_errors();
set_mensagem('Falha na actualiza&ccedil;&atilde;o do ficheiro. Verifique o seu tipo e/ou tamanho', false);           
 $this->Denuncia();

			}
   
			else {
            $denuncia= $this->denuncia_model->retornarDenuncia($id);
            $verficarmd = "./assets/denuncias/media/$denuncia->imagem";                 
                if(file_exists($verficarmd)){
            	unlink($verficarmd);
				}
                $path = $this->upload->data();
                $img = $path['file_name'];
                $data = array();
                $data = array(
                      'id_denucias'=>$id,
                 'idTipodenucia'=>$tipo,
                
                'id_usuario'=>$user,
                'idcatdenucia'=> $cat,
                'cod_prov'=> $prov,
                'cod_cid'=>$dist,
                 'nome'=>$dencte,
                 'email'=> $email,
                'ano_nascimento'=> $idade,

                'localizacao'=>$bairro,
                'contacto'=> $cont,

                'sexo'=>$sexo,
                'updated_at'=>$st1,
             
                'assunto'=> $ass,
                'descricao'=>$desc,
                'imagem'=>$img  
                );
                if($id){
				
			   // Actualizar log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$user,
			  'date_time'=>$stl,
			  'code'=>'UPDATE',
			  'message'=>"Uma nova den&uacute;ncia foi alterada"
			  );
            $success = $this->denuncia_model->Actualizar_Denuncia($id, $data);
					$success = $this->rat_model->set_message($insert_data);

            set_mensagem('Dados da den&uacute;ncia actualizados!');        
                  redirect('denuncia/Denuncia'); 

                }
			}
        } else {
                $data = array();
                $data = array(
                 'id_denucias'=>$id,
                 'idTipodenucia'=>$tipo,
                
                'id_usuario'=>$user,
                'idcatdenucia'=> $cat,
                'cod_prov'=> $prov,
                'cod_cid'=>$dist,
                 'nome'=>$dencte,
                 'email'=> $email,
                'ano_nascimento'=> $idade,

                'localizacao'=>$bairro,
                'contacto'=> $cont,

                'sexo'=>$sexo,
                'updated_at'=>$stl,
   
                'assunto'=> $ass,
                'descricao'=>$desc
                //'imagem'=>$img  
                );
                if($id){
					
					  // Actualizar log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$user,
			  'date_time'=>$stl,
			  'code'=>'UPDATE',
			  'message'=>"Uma nova den&uacute;ncia foi alterada"
			  );
           $success = $this->denuncia_model->Actualizar_Denuncia($id, $data);
		   	$success = $this->rat_model->set_message($insert_data);

               set_mensagem('Dados da den&uacute;ncia actualizados!');          
                       redirect('denuncia/Denuncia'); 

                }
            }
        }
        }
        
    else{
		// Error log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$user,
			  'date_time'=>$stl,
			  'code'=>'ERRO',
			  'message'=>"Houve falha no registo duma den&uacute;ncia"
			  );
		$success = $this->rat_model->set_message($insert_data);
		set_mensagem('Falha no registo da den&uacute;ncia. Verifique os dados!', false);  
		redirect(base_url() , 'refresh');
	       }        
		}
  
  
  // Retornar Denuncia por ID
public function retornarDenuncia()
{
    if ($this->session->userdata('user_login_access') != False) {
        $id= $this->input->get('id_denuncias');
        $data['retornarDenuncia'] = $this->denuncia_model->retornarDenuncia($id);
        echo json_encode($data);
    } else {
        redirect(base_url(), 'refresh');
    }
}

//Retornar distritos
public function distritosporProvincia() { 

      $id=$this->input->post('provincia_id',true);
       $data = $this->denuncia_model->listarDistritosDenuncias($id);//$this->db->where("provincia_id",$id)->get("tbldistrito")->result();
       echo json_encode($data);
   }
   
  //Excluir uma denuncia
   public function EliminarDenuncia()
     {
		 
         if ($this->session->userdata('user_login_access') != False) {
			 
			  
           $id = $this->input->get('id_denucias');
		   $uid = $this->session->userdata('user_login_id');
           $success = $this->denuncia_model->EliminarDenuncia($id);
		   
		   if(!is_denunciante()){
			      // Delete log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$uid,
			  'date_time'=>$stl,
			  'code'=>'DELETE',
			  'message'=>"Uma den&uacute;ncia foi eliminada"
			  );
			  $success = $this->rat_model->set_message($insert_data);
           set_mensagem ('Den&uacute;ncia eliminada com sucesso!');
		   
                  redirect('denuncia/Denuncia');
           }
		   else{
			    // Delete log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$uid,
			  'date_time'=>$stl,
			  'code'=>'DELETE',
			  'message'=>"Uma den&uacute;ncia foi eliminada"
			  );
			  $success = $this->rat_model->set_message($insert_data);
			set_mensagem ('Den&uacute;ncia eliminada com sucesso!');
		   
                  redirect('denuncia/Denuncia');   

		   }
         } else {
			 // Delete log 
			 $insert_data=[];
			 $insert_data=array(
			  'user_id'=>$uid,
			  'date_time'=>$stl,
			  'code'=>'DELETE',
			  'message'=>"Houve falha ao excluir duma den&uacute;ncia"
			  );
			  $success = $this->rat_model->set_message($insert_data);
       set_mensagem ('Falha na exclus&atilde;o da den&uacute;ncia!', false);
             redirect(base_url(), 'refresh');
         }
     }
  
  
}
