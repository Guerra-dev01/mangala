<?php

	class Login_model extends CI_Model{
   public $status; 
    public $roles;

	function __consturct(){
	parent::__construct();
       $this->status = $this->config->item('status');
        $this->roles = $this->config->item('roles');
	
	}

	//Identificacao de user para login
	public function getUserForLogin($credential){			
    return $this->db->get_where('tbllogin', $credential);
	}


   // Retornar User por Email
    public function getUserInfoByEmail($email)
    {
        $q = $this->db->get_where('tbllogin', array('username' => $email, 'status' => 'Activo(a)'));  
        if($this->db->affected_rows() > 0){
            $row = $q->row();
            return $row;
        }else{
            error_log('Sem registo de Utilizador com este email: ('.$email.')');
            return false;
        }
    }

   //Insercao de token
    public function insertToken($user_id)
    {   
        $token = substr(md5(rand()), 0, 30); 
        $date = date('Y-m-d');
            
        $string = array(
                'token'=> $token,
                'user_id'=>$user_id,
                'created_at'=>$date
            );
        $query = $this->db->insert_string('tokens', $string);
        $this->db->query($query);
        return $token . $user_id;
            
    }


    //Metodo para verificar a validade do token
    public function isTokenValid($token)
    {
       $tkn = substr($token,0,30);
       $uid = substr($token,30);      
           
        $q = $this->db->get_where('tokens', array(
            'tokens.token' => $tkn, 
            'tokens.user_id' => $uid), 1);                         
                   
        if($this->db->affected_rows() > 0){
            $row = $q->row();             
                
            $created = $row->created_at;
            $createdTS = strtotime($created);
            $today = date('Y-m-d'); 
            $todayTS = strtotime($today);
                
            if($createdTS != $todayTS){
                return false;
            }
                
            $user_info = $this->getUserInfo($row->user_id);
            return $user_info;
                
        }else{
            return false;
        }
            
    }  

//Metodo para retornar info do Utilizador
    public function getUserInfo($id)
    {
        $q = $this->db->get_where('tbllogin', array('id_usuario' => $id, 'status'=>'Activo(a)'));  
        if($this->db->affected_rows() > 0){
            $row = $q->row();
            return $row;
        }else{
            error_log('Nenhum Utilizador encontrado getUserInfo('.$id.')');
            return false;
        }
    }
	
 //Metodo para actualizar ou redefinir a senha
    public function updatePassword($post)
    {   
        $this->db->join('tokens','tokens.user_id=tbllogin.id_usuario');
        $this->db->where('id_usuario', $post['user_id']);
        $this->db->update('tbllogin', array('password' => $post['password'])); 
        $success = $this->db->affected_rows(); 
            
        if(!$success){
            error_log('N&atilde;o foi poss&iacute;vel actualizar a sua senha updatePassword('.$post['user_id'].')');
            return false;
        }        
        return true;
    } 
	
}
?>