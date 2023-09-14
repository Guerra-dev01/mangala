<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rat_model extends CI_Model
{
    private $_rat_table;
    public function __construct()
    {
        parent::__construct();
        $this->load->config('rat', TRUE);
        $this->_rat_table = $this->config->item('table_name','rat');
        if(empty($this->_rat_table)) $this->_rat_table = 'rat';
        $this->_verify_table();
    }

    private function _verify_table()
    {
        if(!$this->db->table_exists($this->_rat_table))
        {
            show_error('Sem tabela de logs na base de dados...');
        }
    }

    public function set_message($insert_data)
    {
        if($this->db->insert($this->_rat_table,$insert_data))
        {
            return TRUE;
        }
        else
        {
            show_error('Os logs... devem aparecer... ou repare a tabela de dados...');
        }
        return FALSE;
    }

    public function get_messages($where = NULL, $order_by = NULL, $limit = NULL)
    {
        if(isset($where) && !empty($where)) $this->db->where($where);
        if(isset($order_by)) $this->db->order_by($order_by);
        if(isset($limit))
        {
            if(is_array($limit))
            {
                $this->db->limit($limit[0],$limit[1]);
            }
            else
            {
                $this->db->limit($limit);
            }
        }
        $query = $this->db->get($this->_rat_table);
        if($query->num_rows()>0)
        {
            return $query->result();
        }
        return FALSE;
    }

	    //Retornar dados para o log de actividade
  public function listar_logs(){

      $sql = "SELECT r.*, u.id_usuario, u.nome, l.*, t.* FROM rat as r 
	   JOIN tblusuarios as u ON u.id_usuario=r.user_id
	   JOIN tbllogin as l ON l.id_usuario=r.user_id  
       LEFT JOIN tbperfil as t ON t.codPerfil=u.id_perfil 	   
       WHERE u.id_usuario=r.user_id and l.id_usuario=u.id_usuario 
	   ORDER BY r.date_time DESC";
        $query=$this->db->query($sql);
		$result = $query->result_array(); //row()
		return $result;          
  }
  
  
    public function delete_messages($where=NULL)
    {
        if(isset($where) && !empty($where)) $this->db->where($where);
        $this->db->delete($this->_rat_table);
        return TRUE;
    }
	
  //Eliminar notificacao/log
         public function EliminarLog($id){
            $this->db->delete('rat',array('id'=> $id));  
        }
      
}