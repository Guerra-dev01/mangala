<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relatorios_model extends CI_Model {

   //Retornar dados da tabela de dados
   function getRelotorios($dadoPostado){

     $resultado = array();

     ## Leitura
     $draw = $dadoPostado['draw'];
     $start = $dadoPostado['start'];
     $rowperpage = $dadoPostado['length']; // linhas por pagina
     $columnIndex = $dadoPostado['order'][0]['column']; // Inice da coluna
     $columnName = $dadoPostado['columns'][$columnIndex]['data']; // Nome da coluna
     $columnSortOrder =$dadoPostado['order'][0]['dir']; // ascendente or descendente
     $searchValue = $dadoPostado['search']['value']; // procura de valor

     // Filtro personalizado 
     $searchAno = $dadoPostado['searchAno'];
     $searchSemestre = $dadoPostado['searchSemestre'];

     ## Procura
     $search_arr = array();
     $searchQuery = "";
     if($searchValue != ''){
        $search_arr[] = " (
         semestre like '%".$searchValue."%' or 
         ano_lectivo like'%".$searchValue."%' ) ";
     }
     if($searchAno != ''){
        $search_arr[] = " ano_lectivo='".$searchAno."' ";
     }
     if ($searchSemestre != ''){
        $search_arr[] = " semestre='".$searchSemestre."' ";
     }
     
     if(count($search_arr) > 0){
        $searchQuery = implode(" and ",$search_arr);
     }

     ## Total de colunas sem filtrar
     $this->db->select('count(*) as allcount');
     $records = $this->db->get('relatorio')->result();
     $totalRecords = $records[0]->allcount;

    ## Total de colunas sem filtrar
     $this->db->select('count(*) as allcount');
     if($searchQuery != '')
     $this->db->where($searchQuery);
     $records = $this->db->get('relatorio')->result();
     $totalRecordwithFilter = $records[0]->allcount;

     ## Procura de dados registados
     $this->db->select('*');
     if($searchQuery != '')
     $this->db->where($searchQuery);
     $this->db->order_by($columnName, $columnSortOrder);
     $this->db->limit($rowperpage, $start);
     $records = $this->db->get('relatorio')->result();

     $data = array();

     foreach($records as $record ){

       $data[] = array( 
         "codRel"=>$record->codRel,
         "user_id"=>$record->nama,
         "tipo"=>$record->tipo,
         "descricao"=>$record->descricao,
         "data"=>$record->cod_Disc,
         "nivel"=>$record->nivel,
         "ano_lectivo"=>$record->ano_lectivo,
         "semestre"=>$record->semestre,
         "anexo"=>$record->anexo  
       ); 
     }

     ## Resultado
     $resultado = array(
       "draw" => intval($draw),
       "iTotalRecords" => $totalRecords,
       "iTotalDisplayRecords" => $totalRecordwithFilter,
       "aaData" => $data
     );

     return $resultado; 
   }

   // Metodo pra retornar anos lectivos
   public function getAnoLectivo(){

     ## Procura de registos por ano
     $this->db->distinct();
     $this->db->select('ano_lectivo');
     $this->db->order_by('ano_lectivo','asc');
     $this->db->group_by(array("ano_lectivo"));
     $records = $this->db->get('relatorio')->result();

     $data = array();

     foreach($records as $record ){
        $data[] = $record->ano_lectivo;
     }

     return $data;
   }

    // Metodo para retornar registo de relatorios por semestres
    public function getSemestreLectivo(){

      ## Procura de registos de relatorios por semestre
      $this->db->distinct();
      $this->db->select('semestre');
      $this->db->order_by('semestre','asc');
      $this->db->group_by(array("semestre"));
      $records = $this->db->get('relatorio')->result();
 
      $data = array();
 
      foreach($records as $record ){
         $data[] = $record->semestre;
      }
 
      return $data;
    }
 

}
