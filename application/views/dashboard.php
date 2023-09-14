

<div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-braille" style="color:#1976d2"></i>&nbsp; Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
               <!--Invocar alertas-->
			        <div class="alerta" >
                       <?= $this->session->flashdata('mensagem'); ?>
					 </div>

<!--.........................Container fluid/ Con...................................-->
            <!-- ============================================================== -->
  <?php //if (!is_denunciante()):?>  
  <div class="container-fluid">
    <!-- ============================================================== -->
                
                <div class="row">
                    <?php  
                    $denuncias =$this->dashboard_model->contagem_denuncias();  
                    $tpdenuncias =$this->dashboard_model->contagem_tipodenuncias();
                   $denuncias_7dias=$this->dashboard_model-> denuncias_7dias();
                   $usuarios=$this->dashboard_model->total_denunciantes();
                    $id=$this->session->userdata('user_login_id');
	               $denuncias_7diasUser=$this->dashboard_model->denuncias_7diasUser($id);
                     $denuncias_30diasUser=$this->dashboard_model->denuncias_30diasUser($id);
                     $denunciasUser=$this->dashboard_model->contagem_denunciasUser($id);
                    ?>

                 
 <!--...........Caixa/Coluna 1: Ultimas denuncias.......................-->
                        <div class="col-xl-3 col-6 mb-4">
                    
                        <div class="card">
                       
                            <div class="card-body">                          
                            <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                       <?php if(!is_denunciante()):?>
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Den&uacute;ncias (Total)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $denuncias; ?></div>
                                       <?php endif; ?>
                                       <?php if(is_denunciante()):?>
                                       <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Minhas den&uacute;ncias</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $denunciasUser; ?></div>
                                      <?php endif; ?>
                                    </div>
                                    <div class="round align-self-center round-info" style="background-color:#ef5350"><i class="fa fa-bullhorn" ></i></div>
                                </div>
                                <hr>
                                <a href="<?php echo base_url(); ?>denuncia/Denuncia" class="text-muted m-b-0"><i class="fa fa-tasks" aria-hidden="true"></i> 
                                  <?php if(is_denunciante()): ?>Gerir den&uacute;ncias<?php endif; ?>
                                  <?php if(!is_denunciante()): ?>Ver den&uacute;ncias<?php endif; ?>
                              
                                  </a>
                            </div>             

                        </div>
                    </div>

    <!--...........Caixa/Coluna 2: Ultimas 7 denuncias.......................-->
                    <div class="col-xl-3 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">                        
                                <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                              <?php if(!is_denunciante()): ?>
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Den&uacute;ncias <br> (7 dias)</div>
                                                <div class="h5 mb-0 font-weight-bold text-red-800"><?php echo $denuncias_7dias; ?></div>
                                              <?php endif; ?>
                                                <?php if(is_denunciante()): ?>
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Den&uacute;ncias <br> (7 dias)</div>
                                                <div class="h5 mb-0 font-weight-bold text-red-800"><?php echo $denuncias_7diasUser; ?></div>
                                              <?php endif; ?>
                                            </div>

                                 <div class="round align-self-center round-info"><i class="fa fa-bullhorn"></i></div>
                                </div>
                                            <hr>
                                            <a href="<?php echo base_url(); ?>denuncia/Denuncia" class="text-muted m-b-0"><i class="fa fa-eye" aria-hidden="true"></i> Ver detalhes</a>                                            </div>
                                    </div>
                                </div>
                            
                  
    <!--...........Caixa/Coluna 2: Ultimas 30 denuncias.......................-->
                  <?php if(is_denunciante()):?>
                    <div class="col-xl-3 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">                        
                                <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                              
                                                <?php if(is_denunciante()): ?>
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Den&uacute;ncias <br> (30 dias)</div>
                                                <div class="h5 mb-0 font-weight-bold text-red-800"><?php echo $denuncias_30diasUser; ?></div>
                                              <?php endif; ?>
                                            </div>

                                 <div class="round align-self-center round-info" style="background-color:#67bb6a"><i class="fa fa-bullhorn"></i></div>
                                </div>
                                            <hr>
                                            <a href="<?php echo base_url(); ?>denuncia/Denuncia" class="text-muted m-b-0"><i class="fa fa-eye" aria-hidden="true"></i> Ver detalhes</a>                                            </div>
                                    </div>
                                </div>
                        <?php endif; ?>
         <!--..........Caixa/Coluna 3: Utilizadores....................-->
                  <?php if(is_superAdmin()):?>
                    <div class="col-xl-3 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Denunciantes <br> (Utilizadores) </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $usuarios; ?></div>
                                    </div>

                                    <div class="round align-self-center round-info" style="background-color:#67bb6a"><i class="fa fa-users"></i></div>

                                </div>
                                <hr>
                                <a href="<?php echo base_url(); ?>user/User" class="text-muted m-b-0"><i class="fa fa-tasks" aria-hidden="true"></i> Gerir Utilizadores</a>
                            </div>
                        </div>
                    </div>
                  <?php endif;?>
                   

        <!--.................Caixa/Coluna 4: Tipos de denuncias..............-->
                  <?php if(!is_denunciante()):?>
                    <div class="col-sm-3 col-6 mb-4">
                    
                        <div class="card">
                       
                            <div class="card-body">                          
                            <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Den&uacute;ncias <br> (Tipos)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $tpdenuncias; ?></div>
                                    </div>
                                    <div class="round align-self-center round-info" style="background-color:#ef5350"><i class="fa fa-bullhorn" ></i></div>
                                </div>
                                <hr>
                                <a href="<?php echo base_url(); ?>configuracao/TipoDenuncia" class="text-muted m-b-0"><i class="fa fa-eye" aria-hidden="true"></i> Ver tipos de den&uacute;ncias</a>
                            </div>             

                        </div>
                    </div>
                 
                  </div> 
                
        <?php endif;?>


    <!-- ============================================================== -->
            </div> 
  
  
  <!--...................Area de dados estatisticos na dashboard........................-->
   <?php if (is_superAdmin()):?>
            <div class="container-fluid">
                <?php 
                //$notice = $this->notice_model->GetNoticelimit(); 
                //$running = $this->dashboard_model->GetRunningProject(); 
                $userid = $this->session->userdata('user_login_id');
               // $todolist = $this->dashboard_model->GettodoInfo($userid);              
                 
                $denuncias =$this->dashboard_model->contagem_denuncias();               
                ?>


                     
<!--...............Grafico de Denuncias Mensais........................-->
                <div class="row">
                    
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Den&uacute;ncias Mensais <?= date('Y'); ?></h4>
								
								
								
                               <div class="chart-area">
                                        <div class="chartjs-size-monitor">
                                            <div class="chartjs-size-monitor-expand">
                                                <div class=""></div>
                                            </div>
                                            <div class="chartjs-size-monitor-shrink">
                                                <div class=""></div>
                                            </div>
                                        </div>
                                        <canvas id="myChart" width="669" height="320" class="chartjs-render-monitor" style="display: block; width: 669px; height: 320px;"></canvas>
                                    </div>
									
				
									
									
                                </div>
                            </div>
                                               
                    </div>

<!--..............Grafico circular: Distribuicao de Denunciantes por Sexo..................-->
                     <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header bg-primary py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-white">Distribui&ccedil;&atilde;o de Denunciantes por Sexo</h6>
                            </div>
                          
                            <div class="card-body">
                                <div class="chart-pie pt-4 pb-2">
                                    <div class="chartjs-size-monitor">
                                        <div class="chartjs-size-monitor-expand">
                                            <div class=""></div>
                                        </div>
                                        <div class="chartjs-size-monitor-shrink">
                                            <div class=""></div>
                                        </div>
                                    </div>
                                    <canvas id="myPieChart" width="302" height="245" class="chartjs-render-monitor" style="display: block; width: 302px; height: 245px;"></canvas>
                                </div>
                                <div class="mt-4 text-center small">
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-success"></i> Feminino
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-danger"></i> Masculino
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                
<!--............Grafico de denuncias por provincia........................-->
                <div class="row">
                     <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Den&uacute;ncias por Prov&iacute;ncia</h4>
                                <div class="chart-area">
                                        <div class="chartjs-size-monitor">
                                            <div class="chartjs-size-monitor-expand">
                                                <div class=""></div>
                                            </div>
                                            <div class="chartjs-size-monitor-shrink">
                                                <div class=""></div>
                                            </div>
                                        </div>
                                        <canvas id="myChart1" width="669" height="320" class="chartjs-render-monitor" style="display: block; width: 669px; height: 320px;"></canvas>
                                    </div>
                                </div>
                            </div>
                                               
                    </div>
                   
                </div> 

<!--..................Grafico de denuncias por distrito.............-->
<div class="row">
    <div class="col-sm-12"> <!--lg-->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"> Den&uacute;ncias por Distrito</h4>
            </div>
            <div class="card-body">
            <br>
                <div class="row">

                    <!--........................Filtros da denuncia por distrito.....................-->


                                                    <!--Coluna de filtro (dropdown) de denuncias por ano-->
                                                    <div class="col-2">
                                                        <div class="btn-group submitter-group float-right">
                                       
                                                            <select class="custom-select" id="filtro_ano" onchange="Filtro_ano(this)">
                                                                <option value="">Todos anos</option>
                                                                <?php foreach ($ano as $ac) {

                                                           echo "<option value='".$ac."'>".$ac."</option>";
                                                                }
                                                                                         
                                                                 ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                  <!--Coluna de filtro (dropdown) de denuncias por mes-->

                                                   <div class="col-3">
                                                            <div class="btn-group submitter-group float-right">
                                           
                                                            <select class="custom-select" id="filtro_mes" onchange="Filtro_mes(this)">
                                                                    <option value="">Todos meses</option>
                                                                    <?php foreach ($mes as $mes) {

                                                               echo "<option value='".$mes."'>".$mes."</option>";
                                                                    }
                                                                                         
                                                                     ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                     <!--Coluna de filtro (dropdown) de denuncias distrito-provincia-->

                                                     <div class="col-4">
                                                                <div class="btn-group submitter-group float-right">
                                           
                                                                <select class="custom-select" id="filtro_prov" onchange="Filtro_prov(this)">
                                                                        <option value="">Todas prov&iacute;ncias</option>
                                                                        <?php foreach ($prov as $prov) {

                                                                   echo "<option value='".$prov."'>".$prov."</option>";
                                                                        }
                                                                                         
                                                                         ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                </div>
                                                <br>
                
                <div class="table-responsive slimScrollDiv" style="height:600px;overflow-y:scroll">
                    <table  id="den_dist" class="table table-hover table-bordered earning-box ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Distrito</th>
                                <th>Ano</th>
                                <th>M&ecirc;s</th>
                                <th>Prov&iacute;ncia</th>
                                <th>Nº de Den&uacute;ncias</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php $no=1; foreach($denuciasdist as $value): ?>
                            <tr class="scrollbar" style="vertical-align:top">
                            <td><?php echo $no++;?></td>

                                <td style="width:250px"><?php echo $value->dist;?></td>
                                <td><?php echo $value->ano?></td>
                                <td><?php echo $value->mes?></td>
                                <td><?php echo $value->nome_provincia?></td>

                                <!--<td><mark><a href="<?php //echo base_url(); ?>assets/images/notice/<?php //echo $value->file_url ?>" target="_blank"><?php //echo $value->file_url ?></a></mark>
                                </td>-->
                                <td style="width:150px"><?php echo $value->num ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<!--..................Tabela de denuncias por idade.............-->
<div class="row">
                    <div class="col-sm-12"> 
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> Den&uacute;ncias por Idade</h4>
                            </div>
                            <div class="card-body">
                                <br>
                            <div class="row">

                                <!--........................Filtros da denuncia por idade.....................-->


                                                                <!--Coluna de filtro (dropdown) de denuncias etarias por ano-->
                                                                <div class="col-2">
                                                                    <div class="btn-group submitter-group float-right">
                                       
                                                                        <select class="custom-select" id="filtro_ano1" onchange="Filtro_ano1(this)">
                                                                            <option value="">Todos anos</option>
                                                                            <?php foreach ($ano as $ac) {

                                                                       echo "<option value='".$ac."'>".$ac."</option>";
                                                                            }
                                                                                         
                                                                             ?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                              <!--Coluna de filtro (dropdown) de denuncias etarias por mes-->

                                                               <div class="col-3">
                                                                        <div class="btn-group submitter-group float-right">
                                           
                                                                        <select class="custom-select" id="filtro_mes1" onchange="Filtro_mes1(this)">
                                                                                <option value="">Todos meses</option>
                                                                                <?php foreach ($mes1 as $mes1) {

                                                                           echo "<option value='".$mes1."'>".$mes1."</option>";
                                                                                }
                                                                                         
                                                                                 ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                 <!--Coluna de filtro (dropdown) de denuncias idade-provincia-->

                                                                 <div class="col-3">
                                                                            <div class="btn-group submitter-group float-right">
                                           
                                                                            <select class="custom-select" id="filtro_prov1" onchange="Filtro_prov1(this)">
                                                                                    <option value="">Todas prov&iacute;ncias</option>
                                                                                    <?php foreach ($prov1 as $prov1) {

                                                                               echo "<option value='".$prov1."'>".$prov1."</option>";
                                                                                    }
                                                                                         
                                                                                     ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                <!--Coluna de filtro (dropdown) de denuncias idade-distrito-->

                                                                <div class="col-4">
                                                                            <div class="btn-group submitter-group float-right">
                                           
                                                                            <select class="custom-select" id="filtro_dist" onchange="Filtro_dist(this)">
                                                                                    <option value="">Todos distritos</option>
                                                                                    <?php foreach ($dist as $d) {

                                                                               echo "<option value='".$d."'>".$d."</option>";
                                                                                    }
                                                                                         
                                                                                     ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                            </div>
                                                            <br>
                                <div class="table-responsive slimScrollDiv" style="height:600px;overflow-y:scroll">
                                    <table id="den_idade" class="table table-hover table-bordered earning-box ">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Idade (do Denunciante)</th>
                                                <th>Ano</th>
                                                <th>M&ecirc;s</th>
                                                <th>Prov&iacute;ncia</th>
                                                <th>Distrito</th>
                                               <th>Nº de Den&uacute;ncias</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php $no=1; foreach($denuciasidade as $value): ?>
                                            <tr class="scrollbar" style="vertical-align:top">
                                               <td><?php echo $no++;?></td>
                                                <td><?php echo number_format($value->idade).'&nbsp;anos';?></td>
                                                <td><?php echo $value->ano?></td>
                                                <td><?php echo $value->mes?></td>
                                                <td><?php echo $value->nome_provincia?></td>
                                                <td><?php echo $value->nome_distrito?></td>
                                               
                                                <td style="width:100px"><?php echo $value->num ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
			
			<?php endif; ?>
</div>

<!---...............................SCRIPTS...........................................-->

<!--...................... Script de denuncias por idade...............-->
<script>

$(document).ready( function () {
/*.............Filtro de notas de Denuncias por idade....................*/
   $.fn.dataTable.ext.search.push(
    function( settings, searchData, index, rowData, counter ) {
        var searchVal = $('#filtro_ano1').val();

// Retorna todas as notas caso o filtro por ano nao seja acionado
      if (searchVal === '') {
        return true;
      }
      
// Retorna apenas tuplas que satisfacam a condicao de denuncias etarias por ano civil
      if (searchVal === rowData[2])   {
        return true; //true;
      }
      
    //Resultado de filtro se a condicao de filtro nao for satisfeita.
      return false;
    });


/*.............Filtro de denuncias etarias e anuais...................*/
    $.fn.dataTable.ext.search.push(
    function( settings, searchData, index, rowData, counter ) {
      var searchVal = $('#filtro_mes1').val();

      
//Retorna todas as notas caso o filtro de denunciaa por mesnao seja acionado
        if (searchVal === '') {
        return true;
      }
      
//Retorna apenas tuplas que satisfacam a condicao de procura

      if (searchVal === rowData[3])   {
        return true;
      }
      
//Nao retorna nada se a condicao de filtro nao for satisfeita.
      return false;
    });


    /*.............Filtro de denuncias distrito-idade...................*/
    $.fn.dataTable.ext.search.push(
        function( settings, searchData, index, rowData, counter ) {
          var searchVal = $('#filtro_dist').val();

      
    //Retorna todas as notas caso o filtro de denunciaa por idade-distrito nao seja acionado
            if (searchVal === '') {
            return true;
          }
      
    //Retorna apenas tuplas que satisfacam a condicao de procura

          if (searchVal === rowData[5])   {
            return true;
          }
      
    //Nao retorna nada se a condicao de filtro nao for satisfeita.
          return false;
        });

    /*.............Filtro de denuncias etarias e anuais por provincia...................*/
    $.fn.dataTable.ext.search.push(
        function( settings, searchData, index, rowData, counter ) {
          var searchVal = $('#filtro_prov1').val();

      
    //Retorna todas as notas caso o filtro de denunciaa por mesnao seja acionado
            if (searchVal === '') {
            return true;
          }
      
    //Retorna apenas tuplas que satisfacam a condicao de procura

          if (searchVal === rowData[4])   {
            return true;
          }
      
    //Nao retorna nada se a condicao de filtro nao for satisfeita.
          return false;
        });

    $('.filter-checkbox').on('change', function() {
        var val = $(this).val();
        var checked = $(this).prop('checked');
        var index = filtered.indexOf(val);

        if (checked && index === -1) {
          filtered.push(val);
        } else if (!checked && index > -1) {
          filtered.splice(index, 7); // Numero de colunas da tabela de dados
        }
        table.draw();
      });


/*..............Definicao das funcionalidades da tabela de dados................*/

    var table = $('#den_idade').DataTable({

        "columnDefs": [
          {
            "targets": [2,3,4,5], //Colunas ocultas
            "orderable": false,
            "visible": false,
        
//Com searchable habilitado, o filtro de coluna de Observacao nao funciona
//Com searchable desabilitado, o filtro de colunas consegue procurar dados de colunas ocultas
             "searchable": false
          }
        ],
        
      /*initComplete: function () {
          $.fn.dataTable.ext.search.push(
            function(settings, searchData, index, rowData, counter) {
                    // Nao retorna tuplas se nada for selecionado 
                    if (filtered.length === 0) {
                    return false;
                }

                if (filtered.includes(searchData[4])) { // Indice da coluna que contem as variaveis de filtro acionadas por botoes radio
                     return true;
                }
                return false;
            }
          );
        },*/
        buttons: ['copy', 'csv', 'print', 'excel', 'pdf'],
       dom: "<'row px-2 px-md-4 pt-2'<'col-md-3'l><'col-md-5 text-center'B><'col-md-4'f>>" +
            "<'row'<'col-md-12'tr>>" +
            "<'row px-2 px-md-4 py-3'<'col-md-5'i><'col-md-7'p>>",
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "All"]
        ],
        /*columnDefs: [{
            targets: -1,
            orderable: false,
            searchable: false
        }],*/

        "language": {
                "lengthMenu": "Mostrar _MENU_ registos",
                "zeroRecords": "Nenhum registo filtrado!",
                "info": "P&aacute;gina _PAGE_ de _PAGES_",
                "infoEmpty": "Sem registos dispon&iacute;veis!",
                "infoFiltered": "(filtrada de _MAX_ registos)",
                "sInfoPostFix":  "",
                "sSearch":       "Procurar:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "Primeiro",
                    "sPrevious": "Anterior",
                    "sNext":     "Pr&oacute;ximo",
                    "sLast":     "&Uacute;ltimo"
            }
        }, 
        "buttons": {
            "print": "Imprimir",
            "copy": "Copiar",
            "copyTitle": "Copiar para &aacute;rea de transfer&ecirc;ncia",
            "copySuccess": {
                "_": "%d linhas copiadas",
                "1": "1 linha copiada"
            },
            "collection": "Ac&ccedil;&otilde;es <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"><\/span>",
            "colvis": "Visibilidade da coluna",
            "colvisRestore": "Restaurar a visibilidade",
            "copyKeys": "Pressione a tecla <i>ctrl<\/i> ou <i>⌘<\/i> + <i>C<\/i> do sistema <br \/>para copiar para a área de transferência.<br \/><br \/>. Para cancelar, clique nesta mensagem ou pressione escape.",
            "csv": "CSV",
            "excel": "Excel",
            "pageLength": {
                "-1": "Mostrar todas as linhas",
                "_": "%d linhas mostradas"
            },
            "pdf": "PDF"
        }
      });
      
       table.buttons().container().appendTo('#dataTable_wrapper .col-md-5:eq(0)');

    });

 /*............Funcao que implementa o Filtro de denuncias distritais por idade e ano.....*/
    function Filtro_ano1(filtro) { 
  
      $('#den_idade').DataTable().draw();  // Metodo  para correr o plugin de procura
    } 


/*...Funcao que implementa o Filtro de denuncias distritais por mes.....*/

    function Filtro_mes1(filtro1) { 
  
  $('#den_idade').DataTable().draw();  // Metodo  ara correr o plugin de procura

} 

    /*...Funcao que implementa o Filtro de denuncias idade-provincia.....*/

    function Filtro_prov1(filtro2) { 

$('#den_idade').DataTable().draw();  // Metodo  ara correr o plugin de procura

} 

    /*...Funcao que implementa o Filtro de denuncias idade-distrito.....*/

    function Filtro_dist(filtro3) { 

$('#den_idade').DataTable().draw();  // Metodo  ara correr o plugin de procura

} 


</script>       



<!--......................Script de denuncias por distrito...........................................-->
<script>

$(document).ready( function () {
/*.............Filtro de notas de Denuncias por distrito....................*/
   $.fn.dataTable.ext.search.push(
    function( settings, searchData, index, rowData, counter ) {
        var searchVal = $('#filtro_ano').val();

// Retorna todas as notas caso o filtro por ano nao seja acionado
      if (searchVal === '') {
        return true;
      }
      
// Retorna apenas tuplas que satisfacam a condicao de denuncias por distrito e ano
      if (searchVal === rowData[2])   {
        return true; //true;
      }
      
    //Resultado de filtro se a condicao de filtro nao for satisfeita.
      return false;
    });


/*.............Filtro de notas de denuncias por mes e distrito....................*/
    $.fn.dataTable.ext.search.push(
    function( settings, searchData, index, rowData, counter ) {
      var searchVal = $('#filtro_mes').val();

      
//Retorna todas as notas caso o filtro por semestre nao seja acionado
        if (searchVal === '') {
        return true;
      }
      
//Retorna apenas tuplas que satisfacam a condicao de procura

      if (searchVal === rowData[3])   {
        return true;
      }
      
//Nao retorna nada se a condicao de filtro nao for satisfeita.
      return false;
    });


    /*.............Filtro de notas de denuncias por mes e distrito-provincia...................*/
    $.fn.dataTable.ext.search.push(
        function( settings, searchData, index, rowData, counter ) {
          var searchVal = $('#filtro_prov').val();

      
    //Retorna todas as notas caso o filtro por semestre nao seja acionado
            if (searchVal === '') {
            return true;
          }
      
    //Retorna apenas tuplas que satisfacam a condicao de procura

          if (searchVal === rowData[4])   {
            return true;
          }
      
    //Nao retorna nada se a condicao de filtro nao for satisfeita.
          return false;
        });


    $('.filter-checkbox').on('change', function() {
        var val = $(this).val();
        var checked = $(this).prop('checked');
        var index = filtered.indexOf(val);

        if (checked && index === -1) {
          filtered.push(val);
        } else if (!checked && index > -1) {
          filtered.splice(index, 6); // Numero de colunas da tabela de dados
        }
        table.draw();
      });


/*..............Definicao das funcionalidades da tabela de dados................*/

    var table = $('#den_dist').DataTable({

        "columnDefs": [
          {
            "targets": [2,3,4], //Colunas ocultas
            "orderable": false,
            "visible": false,
        
//Com searchable habilitado, o filtro de coluna de Observacao nao funciona
//Com searchable desabilitado, o filtro de colunas consegue procurar dados de colunas ocultas
             "searchable": false
          }
        ],
        
      /*initComplete: function () {
          $.fn.dataTable.ext.search.push(
            function(settings, searchData, index, rowData, counter) {
                    // Nao retorna tuplas se nada for selecionado 
                    if (filtered.length === 0) {
                    return false;
                }

                if (filtered.includes(searchData[4])) { // Indice da coluna que contem as variaveis de filtro acionadas por botoes radio
                     return true;
                }
                return false;
            }
          );
        },*/
      buttons: ['copiar', 'csv', 'print', 'excel', 'pdf'],
       dom: "<'row px-2 px-md-4 pt-2'<'col-md-3'l><'col-md-5 text-center'B><'col-md-4'f>>" +
            "<'row'<'col-md-12'tr>>" +
            "<'row px-2 px-md-4 py-3'<'col-md-5'i><'col-md-7'p>>",
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "All"]
        ],
        /*columnDefs: [{
            targets: -1,
            orderable: false,
            searchable: false
        }],*/

        "language": {
                "lengthMenu": "Mostrar _MENU_ registos",
                "zeroRecords": "Nenhum registo filtrado!",
                "info": "P&aacute;gina _PAGE_ de _PAGES_",
                "infoEmpty": "Sem registos dispon&iacute;veis!",
                "infoFiltered": "(filtrada de _MAX_ registos)",
                "sInfoPostFix":  "",
                "sSearch":       "Procurar:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "Primeiro",
                    "sPrevious": "Anterior",
                    "sNext":     "Pr&oacute;ximo",
                    "sLast":     "&Uacute;ltimo"
            }
        }, 
     buttons: {
            'print': 'Imprimir',
            'copy': 'Copiar',
            'copyTitle': 'Copiar para &aacute;rea de transfer&ecirc;ncia',
            'copySuccess': {
                '_': '%d linhas copiadas',
                '1': '1 linha copiada'
            },
            "collection": "Ac&ccedil;&otilde;es <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"><\/span>",
            "colvis": "Visibilidade da coluna",
            "colvisRestore": "Restaurar a visibilidade",
            "copyKeys": "Pressione a tecla <i>ctrl<\/i> ou <i>⌘<\/i> + <i>C<\/i> do sistema <br \/>para copiar para a área de transferência.<br \/><br \/>. Para cancelar, clique nesta mensagem ou pressione escape.",
            "csv": "CSV",
            "excel": "Excel",
            "pageLength": {
                "-1": "Mostrar todas as linhas",
                "_": "%d linhas mostradas"
            },
            "pdf": "PDF"
        }
      });
      
       table.buttons().container().appendTo('#dataTable_wrapper .col-md-5:eq(0)');

    });

 /*............Funcao que implementa o Filtro de denuncias por distrito.....*/
    function Filtro_ano(filtro) { 
  
      $('#den_dist').DataTable().draw();  // Metodo  para correr o plugin de procura
    } 


/*...Funcao que implementa o Filtro de denuncias distritais por mes.....*/

    function Filtro_mes(filtro1) { 
  
  $('#den_dist').DataTable().draw();  // Metodo  ara correr o plugin de procura

} 

/*...Funcao que implementa o Filtro de denuncias distrito-provincia.....*/

function Filtro_prov(filtro2) { 

$('#den_dist').DataTable().draw();  // Metodo  ara correr o plugin de procura

} 




</script>       

