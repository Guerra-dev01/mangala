<?php

    class Denuncia_model extends CI_Model {


    function __consturct(){
    parent::__construct();
    $this->load->database();

	
    }

// Modelos de metodos CRUD para tabelas da base de dados
public function get($table, $data = null, $where = null)
{
    if ($data != null) {
        return $this->db->get_where($table, $data)->row_array();
    } else {
        return $this->db->get_where($table, $where)->result_array();
    }
}
   

public function update($table, $pk, $id, $data)
{
    $this->db->where($pk, $id);
    return $this->db->update($table, $data);
}

public function insert($table, $data, $batch = false)
{
    return $batch ? $this->db->insert_batch($table, $data) : $this->db->insert($table, $data);
}

public function delete($table, $pk, $id)
{
    return $this->db->delete($table, [$pk => $id]);
  
}
/* ....... CRUD de DENUNCIAS............*/ 

    //Registo de DENUNCIA
    public function Adicionar_Denuncia($data){
        $this->db->insert('tbldenucias', $data);
    }

      // Retornar todos os dados
       public function listarTodosDados($dados,$tabela,$where)
       {
        $query= $this->db->select($dados)       
                         ->from($tabela)
                         ->where($where)
                         ->get();
           return $query->result_array();     
       }
      
    //Leitura/Lista de 'todas' DENUNCIAS
    public function listarTodasDenuncias(){
        $this->db->select('dd.*, p.nome_provincia, d.nome_distrito, u.nome as user, cd.*, td.*');
        $this->db->join('tblprovincia p', 'p.id_provincia= dd.cod_prov');
        $this->db->join('tbldistrito d', 'd.id_distrito= dd.cod_cid');
        $this->db->join('tblcategoriadenucia cd', 'cd.id_categoria= dd.idcatdenucia');
        $this->db->join('tbltipodenucia td', 'td.id_tipo_denucia= dd.idTipodenucia');
        $this->db->join('tblusuarios u', 'u.id_usuario= dd.id_usuario');
        $this->db->order_by('dd.id_denucias');
       // $this->db->group_by('dd.id_denucias');
        return $this->db->get('tbldenucias dd')->result_array();
    }

      //Leitura/Lista de 'todas' DENUNCIAS
    public function listarTodasDenuncias1(){
        $this->db->select('dd.*, p.nome_provincia, d.nome_distrito, u.nome as user, cd.*, td.*');
        $this->db->join('tblprovincia p', 'p.id_provincia= dd.cod_prov');
        $this->db->join('tbldistrito d', 'd.id_distrito= dd.cod_cid');
        $this->db->join('tblcategoriadenucia cd', 'cd.id_categoria= dd.idcatdenucia');
        $this->db->join('tbltipodenucia td', 'td.id_tipo_denucia= dd.idTipodenucia');
        $this->db->join('tblusuarios u', 'u.id_usuario= dd.id_usuario');
        $this->db->order_by('dd.id_denucias');
       // $this->db->group_by('dd.id_denucias');
        return $this->db->get('tbldenucias dd')->result();
    }


      //Leitura/Lista de DENUNCIAS por Denunciante
    public function listarDenunciasporUser($id){
         $this->db->select('dd.*, p.nome_provincia, d.nome_distrito, u.id_usuario, u.nome as user, cd.*, td.*');
        $this->db->join('tblprovincia p', 'p.id_provincia= dd.cod_prov');
        $this->db->join('tbldistrito d', 'd.id_distrito= dd.cod_cid');
        $this->db->join('tblcategoriadenucia cd', 'cd.id_categoria= dd.idcatdenucia');
        $this->db->join('tbltipodenucia td', 'td.id_tipo_denucia= dd.idTipodenucia');
        $this->db->join('tblusuarios u', 'u.id_usuario= dd.id_usuario');
      $this->db->where('dd.id_usuario',$id);
      $denuncias = $this->db->get('tbldenucias dd')->result_array();
    }

 //Leitura/Lista de Categorias de denuncia(ntes)/tipo
 public function listarCategoriasDenuncias(){
    $this->db->distinct();
   $this->db->select('*','cd.tipo');
   //$this->db->order_by('dd.id_denucias');
  $this->db->group_by('cd.tipo');
   return $this->db->get('tblcategoriadenucia cd')->result();
}
      
       //Leitura/Lista de Categorias de denuncia(ntes)
 public function listarCategoriasDenuncias1(){
   // $this->db->distinct();
   $this->db->select('*');
   return $this->db->get('tblcategoriadenucia')->result();
}

//Leitura/Lista de Utilizadores
public function listarUsers(){
    $this->db->distinct();
   $this->db->select('*','u.nome');
   //$this->db->order_by('dd.id_denucias');
  $this->db->group_by('u.nome');
   return $this->db->get('tblusuarios u')->result();
}


     //Leitura/Lista de Tipos de denuncia
     public function listarTiposDenuncias(){
        $this->db->distinct();
       $this->db->select('*','cd.tipo_denucia');
       //$this->db->order_by('dd.id_denucias');
      $this->db->group_by('cd.tipo_denucia');
       return $this->db->get('tbltipodenucia cd')->result();
    }

     //Leitura/Lista de Cat de denuncia
     public function listarCatDenunciasID(){
        //$this->db->distinct();
       $this->db->select('cd.id_categoria');
       //$this->db->order_by('dd.id_denucias');
      $this->db->group_by('cd.id_categoria');
       return $this->db->get('tblcategoriadenucia cd')->result();
    }

    //Listar todos os tipos de denuncias
    public function listarTodosTiposDenuncias(){
        $sql = "SELECT * FROM tbltipodenucia";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
         
    //Listar todos os provincias de denuncias
    public function listarLocaisDenuncias(){
         $this->db->select('*');
     
        $this->db->order_by('nome_provincia','ASC');
       
        return $this->db->get('tblprovincia')->result();
    }

    //Listar todos os distritos de denuncias
    public function listarDistritosDenuncias(){
         
        $this->db->select('*');
        $this->db->join('tblprovincia tp', 'td.provincia_id= tp.id_provincia');
        $this->db->order_by('nome_distrito','ASC');
       
        return $this->db->get('tbldistrito td')->result();
    }

    //Retornar determinado perfil
    public function getDadoPerfil($id){
        $sql = "SELECT * FROM tbperfil WHERE codPerfil = '$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }

    //Retornar determinada Provincia
    public function getDadoProvincia($id){
        $sql = "SELECT * FROM tblprovincia WHERE id_provincia = '$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }

     //Retornar determinado Distrito
     public function getDadoDistrito($id){
        $sql = "SELECT * FROM tbldistrito WHERE id_distrito = '$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }

     //Retornar determinado tipo de denuncia
     public function getDadoTipoDenuncia($id){
        $sql = "SELECT * FROM tbltipodenucia WHERE id_tipo_denucia = '$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
      
      //Retornar determinada denuncia
public function retornarDenuncia($id)
  {
        $sql = "SELECT * FROM tbldenucias WHERE id_denucias = '$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
      
    /*....... Actualizacao de dados de denuncias............*/ 

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

// Actualizar dados de denuncia
public function Actualizar_Denuncia($id, $data){
    $this->db->where('id_denucias', $id);
    $this->db->update('tbldenucias', $data);         
}

// Actualizar dados do tipo de denuncia
public function Actualizar_TipoDenuncia($id, $data){
    $this->db->where('id_tipo_denucia', $id);
    $this->db->update('tbltipodenucia', $data);         
}

/*....... Eliminacao de dados da denuncia............*/ 

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

        //Eliminar denuncia
         public function EliminarDenuncia($id){
            $this->db->delete('tbldenucias',array('id_denucias'=> $id));  
        }
      
        // FUNCAO QUE IMPLEMENTA FILTROS DE DENUNCIAS

        function getDenuncias($dadoPostado){

            $resultado = array();

            ## Leitura de valor filtrado
            $draw = $dadoPostado['draw'];
            $start = $dadoPostado['start'];
            $rowperpage = $dadoPostado['length']; // colunas por pagina
            $columnIndex = $dadoPostado['order'][0]['column']; // Indice da coluna
            $columnName = $dadoPostado['columns'][$columnIndex]['data']; // Nome da coluna
            $columnSortOrder =$dadoPostado['order'][0]['dir']; // ascedente or descendente
            $searchValue = $dadoPostado['search']['value']; // Valor a retornar

            // Fltro personalizado 
            $searchAno = $dadoPostado['searchAno'];
            $searchMes = $dadoPostado['searchMes'];
            $searchUser = $dadoPostado['searchUser'];
           
            ## Procura
            $search_arr = array();
            $searchQuery = "";
           
            if($searchAno != ''){
               $search_arr[] = " ano='".$searchAno."' ";
            }
            if ($searchMes != ''){
               $search_arr[] = " mes='".$searchMes."' ";
            }
            

            if($searchUser != ''){
             $search_arr[] = " like '%".$searchUser."%' ";
          }
            if(count($search_arr) > 0){
               $searchQuery = implode(" and ",$search_arr);
            }

            ## Total de registos sem filtrar
            $this->db->select('count(*) as allcount');
            $records = $this->db->get('tbldenucias')->result();
            $totalRecords = $records[0]->allcount;

            ## Total de registos sem filtro
            $this->db->select('count(*) as allcount');
            if($searchQuery != '')
            $this->db->where($searchQuery);
            $records = $this->db->get('tbldenucias')->result();
            $totalRecordwithFilter = $records[0]->allcount;

            ## Procura de registos
            $this->db->select('*');
            if($searchQuery != '')
            $this->db->where($searchQuery);
            $this->db->order_by($columnName, $columnSortOrder);
            $this->db->limit($rowperpage, $start);
            $records = $this->db->get('tbldenucias')->result();

            $data = array();

            foreach($records as $record ){

              $data[] = array( 
                "id_denucias"=>$record->id_denucias,
                "id_usuario"=>$record->user,
                "idTipodenucia"=>$record->tipo_denucia,
                "idcatdenucia"=>$record->tipo,
                "cod_prov"=>$record->nome_provincia,
                "cod_cid"=>$record->nome_distrito,
                "nome"=>$record->nome,
                "email"=>$record->email,
                "ano_nascimento"=>$record->ano,
                "localizaco"=>$record->localizacao,
                "contacto"=>$record->contacto,
                "sexo"=>$record->sexo,
                "data"=>$record->data,
                "assunto"=>$record->assunto     
              ); 
            }

            ## Resposta
            $resultado = array(
              "draw" => intval($draw),
              "iTotalRecords" => $totalRecords,
              "iTotalDisplayRecords" => $totalRecordwithFilter,
              "aaData" => $data
            );

            return $resultado; 
          }

          // Retornar denuncias de acordo com horario
          public function getHorarioDenuncia(){

           ## Procura de registos
           $this->db->distinct();

           $query = $this->db->query("SELECT year(created_at) as ano 
		   from tbldenucias 
		  /* order by ano*/
		   group by ano");
            
           $records = $query->result();

            $data = array();

            foreach($records as $record ){
               $data[] = $record->ano;
            }

            return $data;
          }

          // Retornar denuncia de acordo com o semestre
          public function getMesDenuncia(){

        ## Procura de registos
        $this->db->distinct();

        $query = $this->db->query("SELECT MONTHNAME(created_at) as mes 
		from tbldenucias 
		/*order by mes */
		group by mes");
         
        $records = $query->result();

         $data = array();

         foreach($records as $record ){
            $data[] = $record->mes;
         }

         return $data;
       }
    
	  // Retornar denuncia por usuario
          public function getUserDenuncia(){

        ## Procura de registos
        $this->db->distinct();

        $query = $this->db->query("SELECT u.nome as user 
		from tbldenucias as dd
		join tblprovincia as p ON p.id_provincia= dd.cod_prov
        join tbldistrito as d ON d.id_distrito= dd.cod_cid
        join tblcategoriadenucia as cd ON cd.id_categoria= dd.idcatdenucia
        join tbltipodenucia as td ON td.id_tipo_denucia= dd.idTipodenucia
        join tblusuarios as u ON u.id_usuario= dd.id_usuario
		/*order by user*/
		group by user");
         
        $records = $query->result();

         $data = array();

         foreach($records as $record ){
            $data[] = $record->user;
         }

         return $data;
       }

    }
?>    