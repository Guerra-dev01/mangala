<?php

	class Dashboard_model extends CI_Model{


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

//Metodo para listar usuarios
    public function getUsers()
    {
        $this->db->order_by('id_usuario');
        return $this->db->get('tblusuarios')->result_array();
    }

    //Metodo para retornar denunciantes femininos
    public function getDenunciantes_Femininos()
    {

        $sql = "SELECT * FROM tbldenucias WHERE sexo='Feminino' ORDER BY id_denucias DESC";
        $query=$this->db->query($sql);
        $result = $query->result();
        return count($result);

    }


    //Metodo para retornar contagem de denuncias
    public function contagem_denuncias()
    {

        $sql = "SELECT * FROM tbldenucias";
        $query=$this->db->query($sql);
        $result = $query->result();
        return count($result);

   
    }

   //Metodo para retornar denunciantes masculinos
    public function getDenunciantes_Masculinos()
    {
        $sql = "SELECT * FROM tbldenucias WHERE sexo='Masculino' ORDER BY id_denucias DESC";
        $query=$this->db->query($sql);
        $result = $query->result();
        return count($result);
      
    }
      
      //Metodo para retornar denuncias por user
    public function contagem_denunciasUser($id)
    {
        $sql = "SELECT * FROM tbldenucias WHERE id_usuario='$id' ORDER BY id_denucias DESC";
        $query=$this->db->query($sql);
        $result = $query->result();
        return count($result);
      
    }
	
     //Leitura/Lista de 'todas' DENUNCIAS
     public function listarTodasDenuncias(){
        $this->db->select('*','u.nome','d.nome_distrito','p.nome_provincia','cd.tipo','td.tipo_denucia');
        $this->db->join('tblprovincia p', 'p.id_provincia= dd.provincia_id');
        $this->db->join('tbldistrito d', 'd.id_distrito= dd.cod_cid');
        $this->db->join('tblcategoriadenucia cd', 'td.cid_categoria= dd.idCatdenucia');
        $this->db->join('tbltipodenucia td', 'td.id_tipo_denucia= dd.idTipodenucia');
        $this->db->join('tblusuarios u', 'u.id_usuario= dd.id_usuario');
        $this->db->order_by('dd.id_denucias');
        $this->db->group_by('dd.id_denucias');
        return $this->db->get('tbldenucias dd')->result();
    }

    // Tabela de linha para relatorios de denuncias por distrito
    public function denuncias_distrito() {
        $query = $this->db->query("SELECT *,  year(tbldenucias.created_at) as ano, MONTH(tbldenucias.created_at) as mes, tbldistrito.nome_distrito as dist, tblprovincia.nome_provincia as prov, count(id_denucias) AS num FROM tbldenucias 
        JOIN tbldistrito, tblprovincia where tbldenucias.cod_prov=tblprovincia.id_provincia and tbldenucias.cod_cid=tbldistrito.id_distrito 
        group by dist");
        // print_r($query->result());
        return $query->result();
    }

     // Tabela de linha para relatorios de denuncias por idade
     public function denuncias_idade() {
	
        $query = $this->db->query("SELECT *, year(dd.created_at) as ano, MONTH(dd.created_at) as mes, ano_nascimento as idade, p.nome_provincia as prov, d.nome_distrito as dist, count(id_denucias) AS num 
		FROM tbldenucias as dd
        join tblprovincia as p,tbldistrito as d
		where dd.cod_prov=p.id_provincia and dd.cod_cid=d.id_distrito 
        group by idade
		");
        // print_r($query->result());
        return $query->result();
    }


      //Metodo para retornar tipos de denuncias
      public function contagem_tipodenuncias()
      {
          $sql = "SELECT * FROM tbltipodenucia";
          $query=$this->db->query($sql);
          $result = $query->result();
          return count($result);
       }
  
    
      
      // Denuncias nos ultimos 7 dias
      public function denuncias_7dias()
      {

        $sql = "SELECT COUNT(id_denucias) FROM tbldenucias WHERE created_at BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() group by id_denucias";  // BETWEEN DATE_SUB(NOW(), INTERVAL 15 DAY) AND NOW()
        $query=$this->db->query($sql);
        $result = $query->result();
        return count($result);

      }

       // Denuncias nos ultimos 7 dias por User
      public function denuncias_7diasUser($id)
      {

        $sql = "SELECT COUNT(id_denucias) FROM tbldenucias WHERE id_usuario='$id'and created_at BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() group by id_denucias";  // BETWEEN DATE_SUB(NOW(), INTERVAL 15 DAY) AND NOW()
        $query=$this->db->query($sql);
        $result = $query->result();
        return count($result);

      }
      
         // Denuncias nos ultimos 30 dias por User
      public function denuncias_30diasUser($id)
      {

        $sql = "SELECT COUNT(id_denucias) FROM tbldenucias WHERE id_usuario='$id' and created_at BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW() group by id_denucias";  // BETWEEN DATE_SUB(NOW(), INTERVAL 15 DAY) AND NOW()
        $query=$this->db->query($sql);
        $result = $query->result();
        return count($result);

      }
      
     // Denunciantes
     public function total_denunciantes()
     {

       $sql = "SELECT * FROM tblusuarios;";
       $query=$this->db->query($sql);
       $result = $query->result();
       return count($result);

     }



 

	public function UpdateTododata($id,$data){
		$this->db->where('id', $id);
		$this->db->update('to-do_list',$data);		
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
            $searchProv = $dadoPostado['searcProv'];
       


            ## Procura
            $search_arr = array();
            $searchQuery = "";
       
            if($searchAno != ''){
               $search_arr[] = " ano='".$searchAno."' ";
            }
            if ($searchMes != ''){
               $search_arr[] = " mes='".$searchMes."' ";
            }
        

            if ($searchMes != ''){
                $search_arr[] = " prov='".$searchProv."' ";
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
                "id_usuario"=>$record->username,
                "idTipodenucia"=>$record->tipo_denucia,
                "idcatdenucia"=>$record->tipo,
                "cod_prov"=>$record->prov,
                "cod_cid"=>$record->dist,
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

            ## Response
            $resultado = array(
              "draw" => intval($draw),
              "iTotalRecords" => $totalRecords,
              "iTotalDisplayRecords" => $totalRecordwithFilter,
              "aaData" => $data
            );

            return $resultado; 
          }

          // Retornar notas de acordo com o ano lectivo
          public function getAnoDenuncia(){

           ## Procura de registos
           $this->db->distinct();

           $query = $this->db->query("SELECT year(data) as ano from tbldenucias group by ano ");
        
           $records = $query->result();

            $data = array();

            foreach($records as $record ){
               $data[] = $record->ano;
            }

            return $data;
          }

          // Retornar notas de acordo com o semestre lectivo
          public function getMesDenuncia(){

        ## Procura de registos
        $this->db->distinct();

        $query = $this->db->query("SELECT MONTHNAME(data) as mes from tbldenucias group by mes ");
     
        $records = $query->result();

         $data = array();

         foreach($records as $record ){
            $data[] = $record->mes;
         }

         return $data;
       }

        // Retornar denuncias por idade ou distritp em funcao de provincia
        public function getDenunciaMesIdade_Prov(){

            ## Procura de registos
            $this->db->distinct();

            $query = $this->db->query("SELECT tblprovincia.nome_provincia as prov FROM tbldenucias join tblprovincia group by prov");
     
            $records = $query->result();

             $data = array();

             foreach($records as $record ){
                $data[] = $record->prov;
             }

             return $data;
           }

        // Retornar denuncias por idade ou distritp em funcao de provincia
        public function getDenunciaMesDist_Prov(){

            ## Procura de registos
            $this->db->distinct();

            $query = $this->db->query("SELECT tbldistrito.nome_distrito as dist FROM tbldenucias join tbldistrito group by dist");
     
            $records = $query->result();

             $data = array();

             foreach($records as $record ){
                $data[] = $record->dist;
             }

             return $data;
           }


    }
?>