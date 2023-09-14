<?php

    class Configuracao_model extends CI_Model {


    function __consturct(){
    parent::__construct();
	
    }

/* ....... Adicao de dados para os itens de menu do modulo CONFIGURACOES............*/ 
    //Adicionar Perfil
    public function Adicionar_Perfil($data){
        $this->db->insert('tbperfil', $data);
    }

    //Adicionar Provincia
    public function Adicionar_Provincia($data){
        $this->db->insert('tblprovincia', $data);
    }

     //Adicionar Distrito
     public function Adicionar_Distrito($data){
        $this->db->insert('tbldistrito', $data);
    }

    //Adicionar Tipo de denuncia
    public function Adicionar_TipoDenuncia($data){
        $this->db->insert('tbltipodenucia', $data);
    }


/*....... Leitura de dados para os itens de menu do modulo CONFIGURACOES............*/ 

    //Listar todos os perfis
    public function listarTodosPerfis(){
        $sql = "SELECT * FROM tbperfil";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

     //Listar todas as provincias
    public function listarTodasProvincias(){
    $sql = "SELECT * FROM tblprovincia";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
    }


    //Listar todos os Distritos
    public function listarTodosDistritos(){
        //$this->db->distinct();
        $this->db->select('*');
        $this->db->join('tblprovincia tp', 'td.provincia_id= tp.id_provincia');
        $this->db->order_by('td.nome_distrito');
       $this->db->group_by('td.nome_distrito');
        return $this->db->get('tbldistrito td')->result();
    }

        public function listarTodosDistritos1(){
        $this->db->distinct();
        $this->db->select('*');
        $this->db->join('tblprovincia tp', 'td.provincia_id= tp.id_provincia');
        $this->db->order_by('id_distrito');
       // $this->db->group_by('tp.nome_prov');
        return $this->db->get('tbldistrito td')->result();
    }
      
 //Listar Distritos Distinctos
 public function listarTodasProvincias1(){
   $this->db->distinct();
    $this->db->select('tp.nome_provincia');
    //$this->db->join('tblprovincia tp', 'td.provincia_id= tp.id_provincia');
   // $this->db->order_by('td.id_distrito');
    $this->db->group_by('tp.nome_provincia');
    return $this->db->get('tblprovincia tp')->result();

}

    //Listar todos os tipos de denuncias
    public function listarTodosTiposDenuncias(){
        $sql = "SELECT * FROM tbltipodenucia";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }


    //Retornar dado do perfil
    public function getDadoPerfil($id){
        $sql = "SELECT * FROM tbperfil WHERE codPerfil = '$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }

    //Retornar dados da Provincia
    public function getDadoProvincia($id){
        $sql = "SELECT * FROM tblprovincia WHERE id_provincia = '$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }

     //Retornar dados do Distrito
     public function getDadoDistrito($id){
        $sql = "SELECT d.*, p.id_provincia, p.nome_provincia FROM tbldistrito as d 
		join tblprovincia as p 
		WHERE d.provincia_id=p.id_provincia and d.id_distrito = '$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }

//Retornar dados do DistritoporProv
     public function getDadoDistritoProv($id){
        $sql = "SELECT *, p.id_provincia, p.nome_provincia FROM tbldistrito join tblprovincia as p WHERE provincia_id='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
     //Retornar dados de tipos de denuncias
     public function getDadoTipoDenuncia($id){
        $sql = "SELECT * FROM tbltipodenucia WHERE id_tipo_denucia = '$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }

    /*....... Actualizacao de dados para os itens de menu do modulo CONFIGURACOES............*/ 

    // Actualizar perfil
    public function Actualizar_Perfil($id, $data){
        $this->db->where('codPerfil', $id);
        $this->db->update('tbperfil', $data);         
    }

    // Actualizar dados da provincia
    public function Actualizar_Provincia($id, $data){
        $this->db->where('id_provincia', $id);
        $this->db->update('tblprovincia', $data);         
    }

   // Actualizar dados do Distrito
    public function Actualizar_Distrito($id, $data){
    $this->db->where('id_distrito', $id);
    $this->db->update('tbldistrito', $data);         
}

// Actualizar dados do tipo de denuncia
public function Actualizar_TipoDenuncia($id, $data){
    $this->db->where('id_tipo_denucia', $id);
    $this->db->update('tbltipodenucia', $data);         
}

/*....... Eliminacao de dados para os itens de menu do modulo CONFIGURACOES............*/ 

    //Eliminar Perfil
    public function EliminarPerfil($id){
        $this->db->delete('tbperfil',array('codPerfil'=> $id));  
    }

     //Eliminar Provincia
     public function EliminarProvincia($id){
        $this->db->delete('tblprovincia',array('id_provincia'=> $id));  
    }

     //Eliminar Distrito
     public function EliminarDistrito($id){
        $this->db->delete('tbldistrito',array('id_distrito'=> $id));  
    }

         //Eliminar Tipo de denuncia
         public function EliminarTipoDenuncia($id){
            $this->db->delete('tbltipodenucia',array('id_tipo_denucia'=> $id));  
        }
		
		
		 // Filtrar provincia por distrito
          public function filtrarProvporDistrito(){

           ## Procura de registos
           $this->db->distinct();

           $query = $this->db->query("SELECT p.nome_provincia as np from tbldistrito as d
		   join tblprovincia as p
		   where d.provincia_id=p.id_provincia
		   group by np");
        
           $records = $query->result();

            $data = array();

            foreach($records as $record ){
               $data[] = $record->np;
            }

            return $data;
          }

    }
?>    