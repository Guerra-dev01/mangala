<?php

	class User_model extends CI_Model{


	function __consturct(){
	parent::__construct();
	
	}

 // Retornar User com base nas suas credenciais
     public function getUserForLogin($credential){	
	 

    return $this->db->get_where('tbllogin', $credential);
	
	}
  
  
  //Modelo para registo de Utilizadores
      
           //Usuarios (tabela principal)
     public function tblusuarios($data1)
    {
        $this->db->insert('tblusuarios', $data1);
        return $this->db->insert_id();
    }
         
      //Login (tabela secundaria)
public function tbllogin($data)
{
    $this->db->insert('tbllogin', $data);
    return $this->db->insert_id();
}

      //Listar todos os perfis
    public function listarTodosPerfis(){
        $sql = "SELECT * FROM tbperfil";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

     //Listar todas as provincias
    public function listarTodasProvincias(){

	   $this->db->select('*');
     
        $this->db->order_by('nome_provincia','ASC');
       
        return $this->db->get('tblprovincia')->result();
    }

    //Listar todos os Distritos
    public function listarTodosDistritos(){
        
        $this->db->select('*');
        $this->db->join('tblprovincia tp', 'td.provincia_id= tp.id_provincia');
        $this->db->order_by('nome_distrito','ASC');
       
        return $this->db->get('tbldistrito td')->result();
    }
	
	//Listar todos os Distritos por provincia
    public function listarDistritosProvincia($id){
        
        $this->db->select('*');
        $this->db->join('tblprovincia tp', 'td.provincia_id= tp.id_provincia');
		$this->db->where('provincia_id',$id);
        $this->db->order_by('nome_distrito','ASC');
       
        return $this->db->get('tbldistrito td')->result();
    }
	
  //Selecao de Utilizador (Activo)
    public function utilselect(){
 	$query = $this->db->get('tblusuarios');
	$result = $query->result();
	return $result;
	}

  
  //Selecionar  Utilizador por ID
    public function utilselectPorID($id){
     
    $sql = "SELECT u.*, d.*, p.id_provincia, p.nome_provincia, pf.*, lg.* FROM tblusuarios as u join tblprovincia as p, tbldistrito as d, tbperfil as pf, tbllogin as lg WHERE u.id_usuario='$id'";
    $query=$this->db->query($sql);
	  $result = $query->row();
	  return $result;
	}

 public function GetBasic($id){
      $sql = "SELECT tblusuarios.*,
      tbperfil.*,
      tblprovincia.id_provincia,
	  tblprovincia.nome_provincia,
	  tbllogin.id_usuario,
	  tbllogin.username
      FROM tblusuarios
      LEFT JOIN tbllogin ON tblusuarios.id_usuario=tbllogin.id_usuario
	  LEFT JOIN tbperfil ON tblusuarios.id_perfil=tbperfil.codPerfil
      LEFT JOIN tblprovincia ON tblusuarios.cod_prov=tblprovincia.id_provincia
      WHERE tblusuarios.id_usuario='$id'";
        $query=$this->db->query($sql);
		$result = $query->row();
		return $result;          
    }
	
  //Retornar Utilizador por cada de cadastro
  public function utilselectPorData($data){
    $sql = "SELECT  d.*, p.*, pf.*, lg.* FROM tblusuarios join tblprovincia as p, tbldistrito as d, tbperfil as pf, tbllogin WHERE created_at ='$data'";
    $query=$this->db->query($sql);
	$result = $query->row();
	return $result;
	}


  //Retornar Utilizador Inactivo
    public function getUtilInactivo(){
      $sql = "SELECT  d.*, p.*, pf.*, lg.* FROM tblusuarios join tblprovincia as p, tbldistrito as d, tbperfil as pf, tbllogin as lg WHERE status='Inactivo(a)'";
      $query=$this->db->query($sql);
       $result = $query->result();
		   return $result;
	}

//Retornar Utilizador por Senha
  public function GetUserID($id){
        $sql = "SELECT id_usuario, password FROM tbllogin WHERE id_usuario='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
	
  //Verificar a existencia de email
    public function VerificarEmail($email) {
		//$user = $this->db->dbprefix('tblusuarios');

        $sql = "SELECT tblusuarios.email, tbllogin.username FROM tblusuarios join tblprovincia, tbldistrito, tbperfil, tbllogin WHERE tblusuarios.email='$email' and tblusuarios.email=tbllogin.username";
		$result=$this->db->query($sql);
        if ($result->row()) {
            return $result->row();
        } else {
            return false;
        }
    }

    //Retornar dados do Utilizador por ID

      public function GetUserInfo($id){
        $this->db->select('u.*, tp.*, lg.*, p.id_provincia, p.nome_provincia');
        $this->db->join('tblprovincia p','u.cod_prov=p.id_provincia');
        $this->db->join('tbperfil tp','u.id_perfil=tp.codPerfil');
       //$this->db->join('tbldistrito d','u.cod_cid=d.id_distrito');

        $this->db->join('tbllogin lg','lg.id_usuario=u.id_usuario');
       

          $query=$this->db->get('tblusuarios u',['id_usuario'=>$id]);
		  
      $result = $query->row();
     return $result; 
	  
   	  
      } 
            
     
    //ACTUALIZACAO DE DADOS DO UTILIZADOR
    public function Actualizar_User($id,$data){
		$this->db->where('id_usuario', $id);
		$this->db->update('tblusuarios',$data);        
    }
	
	//ACTUALIZACAO DE DADOS DO Login
    public function Actualizar_Login($id,$data){
		$this->db->where('id_usuario', $id);
		$this->db->update('tbllogin',$data);        
    }


  
     //Retornar dados do Utilizador por ID
    public function getDadosUtilizador($id){
      $sql = "SELECT usr.*, tp.*, p.id_provincia, p.nome_provincia, l.*
      FROM tblusuarios as usr
      JOIN tbperfil as tp ON usr.id_perfil=tp.codPerfil
	  JOIN tbprovincia as p ON usr.cod_prov=p.id_provincia
	  LEFT JOIN tbllogin as l ON usr.id_usuario=l.id_usuario     
      WHERE id_usuario='$id'";
        $query=$this->db->query($sql);
		$result = $query->row();
		return $result;          
    }

//Retornar dados do Distrito
     public function getDadoDistrito($id){
        $sql = "SELECT *, p.id_provincia, p.nome_provincia FROM tbldistrito join tblprovincia as p WHERE provincia_id = '$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
	
    //Selecao/Identificaco de perfil do Utilizador
	public function perfilselect(){
  	$query = $this->db->get('tbperfil');
  	$result = $query->result();
  	return $result;
	}
  
  //ELIMINAR UTILIZADOR
    public function Delete_Utilizador($id){
      $this->db->delete('tblusuarios',array('id_usuario'=> $id));
  }

 // Inserir redes sociais

    public function Insert_Media($data){
      $this->db->insert('social_media',$data);
    }
    
    //Retornar redes sociais
    public function GetSocialValue($id){
      $sql = "SELECT * FROM social_media as sm join tblusuarios as u WHERE sm.id_usuario=u.id_usuario and sm.id_usuario='$id'";
      $query = $this->db->query($sql);
      $result = $query->row();
      return $result; 
  }

  // Actualizar actualizar redes sociais
  public function Update_Media($id,$data){
    $this->db->where('id', $id);
    $this->db->update('social_media',$data);        
    }  
	
	//Reset de password
	 public function Reset_Password($id,$data1){
		$this->db->where('id_usuario', $id);
		$this->db->update('tbllogin',$data1);        
    }
	
	 //Eliminar User
         public function EliminarUsuario($id){
            $this->db->delete('tblusuarios',array('id_usuario'=> $id));  
        }
    }
?>