
<style>
    .fc-fri {
        background-color: #FFEB3B;
    }
    .fc-event, .fc-event-dot {
        background-color: #FF5722;
    }
    .fc-event {
        border: 0;
    }
    .fc-day-grid-event {
        margin: 0;
        padding: 0;
    }
    .dayWithEvent {
        background: #FFEB3B;
        cursor: pointer;
    }
</style>
         <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="mdi mdi-map-marker"></i> Distritos</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Distritos</li>
                    </ol>
                </div>
				
            </div>
                   <!--Invocar alertas-->
			        <div class="alerta" >
                       <?= $this->session->flashdata('mensagem'); ?>
					 </div>

            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">


                <div class="row m-b-10"> 
                    <div class="col-12">
                    <?php //if($this->session->userdata('perfil')=='Super Admin'){ ?>
                        
                        <?php //} else { ?>
						<?php if(is_superAdmin()):?>
                        <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#distritomodel" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Adicionar Distrito</a></button>
                        
						<button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="#<?php echo base_url(); ?>configuracao/Provincia" class="text-white"><i class="" aria-hidden="true"></i> Ver Prov&iacute;ncias</a></button>
                        <?php endif; ?>
                    </div>
                </div>  
				
				<!--Tabela de dados com lista de distritos-->
                <div class="row">
				
				                                                           
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"> Lista de Distritos</h4>
                            </div>
                            <div class="card-body">
							   <!--Coluna de filtro (dropdown) de distritos por provincia-->

                                                               <div class="col-5" 
                                                                        <div class="btn-group submitter-group float-right" >
                                           
                                                                        <select class="custom-select" id="filtro_provf" onchange="Filtro_provf(this)">
                                                                                <option value="">Selecione: Todas prov&iacute;ncias</option>
                                                                                <?php foreach ($provfiltro as $provf) {

                                                                           echo "<option value='".$provf."'>".$provf."</option>";
                                                                                }
                                                                                         
                                                                                 ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
																	
                                <div class="table-responsive ">
                                    <table id="distrito" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Distrito</th>
                                                <th>Prov&iacute;ncia</th>
                                                <th>Ac&ccedil;&otilde;es</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php $no = 1; foreach($distrito as $value): ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $value->nome_distrito; ?></td>
                                                <td><?php echo $value->nome_provincia; ?></td>
                                                <td class="jsgrid-align-center">
                                                    <a href="" title="Edit" <?php if($this->session->userdata('perfil') !=='2'){ ?> hidden <?php } ?> class="btn btn-sm btn-primary waves-effect waves-light actualizardist1" data-toggle="modal" data-target="#editdistritomodel<?php echo $value->id_distrito;?>" data-id="<?php echo $value->id_distrito; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                                    <a onclick="confirm('Deseja realmente eliminar este perfil?')" href="#" title="Delete" <?php if($this->session->userdata('perfil')!=='2'){ ?> hidden <?php } ?> class="btn btn-sm btn-danger waves-effect waves-light deletedist" data-id="<?php echo $value->id_distrito; ?>"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				
				<!--Inicio do modal view com formulario para registo de distritos-->
                        <div class="modal fade" id="distritomodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Registo de Distrito</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post" action="AdicionarDistrito" id="distritoform" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        
                                            <div class="form-group">
                                                <label class="control-label">Distrito:</label>
                                                <input type="text" name="distrito" id="distrito" class="form-control" id="recipient-name1" minlength="3" maxlength="25" value="" required>
                                            </div>

                                      <div class="form-group">
                                            <label class="control-label">Prov&iacute;ncia:</label>                                          
                                            <div class="input-group">
                                                <select name="provincia" id="provincia" class="custom-select">
                                                    <option value="" selected disabled>Por favor, selecione</option>
                                                    
                                                    <?php foreach ($distprov as $value) : ?>
                                                        <option <?= set_select('provincia_id', $value->id_provincia); ?> value="<?= $value->id_provincia; ?>"><?= $value->nome_provincia; ?></option>
                                                        <?php endforeach; ?>

                                                </select>
                                     
                                    </div>
                                      </div>       
                                        
                                    </div>
                                    <div class="modal-footer">
                                    <input type="hidden" name="id_distrito" value="" class="form-control" id="recipient-name1">                                       
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-success">Submeter</button>
                                    </div>
                                    </form>
				<!--Fecho do modal view com formulario para registo de distritos-->
                                </div>
                            </div>
                        </div>
						
						
						<!--Inicio do modal view com formulario para editar/actualizar de distritos-->
						<?php $no=1; foreach($distrito as $value): $no++; ?>
                        <div class="modal fade" id="editdistritomodel<?php echo $value->id_distrito;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Actualiza&ccedil;&atilde;o de Dados do Distrito</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post" action="ActualizarDistrito" id="editdistritoform" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        
                                            <div class="form-group">
                                                <label class="control-label">Distrito:</label>
                                                <input type="text" name="distrito"  class="form-control" id="recipient-name1" minlength="3" maxlength="25" value="<?=set_value('nome_distrito', $value->nome_distrito); ?>" required>
                                            </div>

                                      <div class="form-group">
                                            <label class="control-label">Prov&iacute;ncia:</label>                                          
                                            <div class="input-group">
                                                <select name="provincia" id="provincia" class="custom-select">
                                                    <option value="" selected disabled>Por favor, selecione</option>
                                                    
                                              <?php foreach ($distprov as $value1) : ?>
													
                                            <option <?= $value->provincia_id == $value1->id_provincia ? 'selected' : ''; ?> <?= set_select('provincia_id', $value1->id_provincia) ?> value="<?= $value1->id_provincia ?>"><?= $value1->nome_provincia ?></option>

                                          <?php endforeach; ?>  

                                                </select>
                                     
                                    </div>
                                      </div>       
                                        
                                    </div>
                                    <div class="modal-footer">
                                    <input type="hidden" name="id_distrito" value="<?php echo $value->id_distrito; ?>" class="form-control" id="recipient-name1">                                       
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-success">Submeter</button>
                                    </div>
                                    </form>
				<!--Fecho do modal view com formulario para editar/actualizar de distritos-->
                                </div>
                            </div>
                        </div>
             
			 <?php endforeach; ?>
			 
<!--.................SCRIPTS da pagina de DISTRITOS.........................-->			 
  
<!--Actualizacao de dados dum distrito-->				
<script type="text/javascript">
                                        $(document).ready(function () {
                                            $(".actualizardist").click(function (e) {
                                                e.preventDefault(e);

                                                // retornar ID do registo via atributo                                                var iid = $(this).attr('data-id');
                                                $('#distritoform').trigger("reset");
                                                $('#distritomodel').modal('show');
                                                $.ajax({
                                                    url: 'DistritoporID?id_distrito=' + iid,
                                                    method: 'GET',
                                                    data: '',
                                                    dataType: 'json',
                                                }).done(function (response) {
                                                    console.log(response);
													
                                                    // Popular campos do formulario com dados recuperados do servidor
													$('#distritoform').find('[name="id_distrito"]').val(response.dadodistrito.id_distrito).end();
                                                    $('#distritoform').find('[name="distrito"]').val(response.dadodistrito.nome_distrito).end();
                                                    $('#distritoform').find('[name="provincia"]').val(response.dadodistrito.provincia_id).end();
                                     
												});
                                            });
                                        });
</script>

<!--Exclusao de distritos-->
<script type="text/javascript">
                                        $(document).ready(function () {
                                            $(".deletedist").click(function (e) {
                                                e.preventDefault(e);
                                              
                                                // retornar ID do registo via atributo  
                                                var iid = $(this).attr('data-id');
                                                $.ajax({
                                                    url: 'EliminarDistrito?id_distrito=' + iid,
                                                    method: 'GET',
                                                    data: 'data',
                                                }).done(function (response) {
                                                    console.log(response);
                                                    $(".message").fadeIn('fast').delay(3000).fadeOut('fast').html(response);
                                                    window.setTimeout(function(){location.reload()}, 2000) 
                                               
												});
                                            });
                                        });
</script>                              

<!--Efeito para fecho do alerta/ da mensagem-->
<script type="text/javascript">
   $(".alerta").fadeIn('fast').delay(3000).fadeOut('fast').html(response);
     window.setTimeout(function(){location.reload()}, 2000) 
   </script> 
   
   
   <!-- Script pra retornar/listar dados de distritos-->


<!--......................Script de denuncias por distrito...........................................-->
<script>

$(document).ready( function () {
/*.............Filtro de distritos por cada provincia....................*/
   $.fn.dataTable.ext.search.push(
    function( settings, searchData, index, rowData, counter ) {
        var searchVal = $('#filtro_provf').val();

// Retorna tudo caso o filtro nao seja acionado
      if (searchVal === '') {
        return true;
      }
      
// Retorna apenas tuplas que satisfacam a condicao
      if (searchVal === rowData[2])   {
        return true; 
      }
      
    //Resultado de filtro se a condicao.
      return false;
    });

    $('.filter-checkbox').on('change', function() {
        var val = $(this).val();
        var checked = $(this).prop('checked');
        var index = filtered.indexOf(val);

        if (checked && index === -1) {
          filtered.push(val);
        } else if (!checked && index > -1) {
          filtered.splice(index, 3); // Numero de colunas da tabela de dados
        }
        table.draw();
      });


/*..............Definicao das funcionalidades da tabela de dados................*/

    var table = $('#distrito').DataTable({

        "columnDefs": [
          {
            "targets": [2], //Colunas ocultas
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




 /*............Funcao que implementa o Filtro de distritos por provincia.....*/
    function Filtro_provf(filtro) { 
  
      $('#distrito').DataTable().draw();  // Metodo  para correr o plugin de procura
    } 
     

</script>       
