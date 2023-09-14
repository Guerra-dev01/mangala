<?php

	class Empresa_model extends CI_Model{


	function __consturct(){
	parent::__construct();
	
	}
    public function GetEmpresaValue(){
		$empresa = $this->db->dbprefix('tbldadosempresa');
        $sql = "SELECT * FROM $empresa";
		$query=$this->db->query($sql);
		$result = $query->row();
		return $result;	        
    }
      
    public function EmpresaUpdate($id,$data){
		$this->db->where('id_empresa', $id);
		$this->db->update('tbldadosempresa',$data);		
	}        
    }