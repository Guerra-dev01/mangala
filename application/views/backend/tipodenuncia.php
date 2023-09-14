
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
                    <h3 class="text-themecolor"><i class="fa fa-bullhorn"></i> Tipos de den&uacute;ncias</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Tipos de den&uacute;ncias</li>
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
         	
						<?php if(is_superAdmin()):?>
                        <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#tipodenunciamodel" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Adicionar Tipo de Den&uacute;ncia</a></button>
                        <?php endif ?>
						<?php if(!is_denunciante()):?>
						<button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="#<?php echo base_url(); ?>denuncia/Denuncia" class="text-white"><i class="" aria-hidden="true"></i> Ver Den&uacute;ncias</a></button>
                        <?php endif ?>
                    </div>
                </div>  
				
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Tipos de den&uacute;ncias</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="tipodenuncia" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tipo</th>
                                                <th>Ac&ccedil;&otilde;es</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php $no = 1; foreach($tipodenuncia as $value): ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $value->tipo_denucia ?></td>
                                                <td class="jsgrid-align-center ">
                                                    <a href="" title="Edit" <?php if(!is_superAdmin()){ ?> hidden <?php } ?> class="btn btn-sm btn-primary waves-effect waves-light actualizartpdenuncia1" data-toggle="modal" data-target="#edittipodenunciamodel<?php echo $value->id_tipo_denucia;?>" data-id="<?php echo $value->id_tipo_denucia; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                                    <a onclick="confirm('Deseja realmente eliminar este perfil?')" href="#" title="Delete" <?php if(!is_superAdmin()){ ?> hidden <?php } ?> class="btn btn-sm btn-danger waves-effect waves-light deletetpdenuncia" data-id="<?php echo $value->id_tipo_denucia; ?>"><i class="fa fa-trash-o"></i></a>
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
				
				<!--Modal view com formulario para registo de tipos de denuncias-->
                        <div class="modal fade" id="tipodenunciamodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Registo de Tipo de Den&uacute;ncia</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post" action="AdicionarTipoDenuncia" id="tipodenunciaform" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        
                                            <div class="form-group">
                                                <label class="control-label">Tipo de Den&uacute;ncia:</label>
                                                <input type="text" name="tipodenuncia" class="form-control" id="recipient-name1" minlength="5" maxlength="100" value="" required>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                    <input type="hidden" name="id_tipo_denucia" value="" class="form-control" id="recipient-name1">                                       
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-success">Submeter</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
						
						<!--Modal view com formulario para actualizacao de tipo de denuncia-->
						<?php $no=1; foreach($tipodenuncia as $value): $no++; ?>
                        <div class="modal fade" id="edittipodenunciamodel<?php echo $value->id_tipo_denucia;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Actualiza&ccedil;&atilde;o de Tipo de Den&uacute;ncia</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post" action="ActualizarTipoDenuncia" id="edittipodenunciaform" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        
                                            <div class="form-group">
                                                <label class="control-label">Tipo de Den&uacute;ncia:</label>
                                                <input type="text" name="tipodenuncia" class="form-control" id="recipient-name1" minlength="5" maxlength="100" value="<?=set_value('tipo', $value->tipo_denucia); ?>" required>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                    <input type="hidden" name="id_tipo_denucia" value="<?php echo $value->id_tipo_denucia; ?>" class="form-control" id="recipient-name1">                                       
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-success">Submeter</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
						<?php endforeach;?>
						
<!--.........SCRIPTS da pagina de configuracao de tipos de denuncias........-->
                <script>

                
                </script>  

<!--Script para actualizar tipo de denuncia-->				
<script type="text/javascript">
                                        $(document).ready(function () {
                                            $(".actualizartpdenuncia").click(function (e) {
                                                e.preventDefault(e);
                                                // Get the record's ID via attribute  
                                                var iid = $(this).attr('data-id');
                                                $('#tipodenunciaform').trigger("reset");
                                                $('#tipodenunciamodel').modal('show');
                                                $.ajax({
                                                    url: 'TipoDenunciaporID?codTipoDenuncia=' + iid,
                                                    method: 'GET',
                                                    data: '',
                                                    dataType: 'json',
                                                }).done(function (response) {
                                                    console.log(response);
                                                    // Populate the form fields with the data returned from server
													$('#tipodenunciaform').find('[name="id_tipo_denucia"]').val(response.dadotipodenuncia.id_tipo_denucia).end();
                                                    $('#tipodenunciaform').find('[name="tipodenuncia"]').val(response.dadotipodenuncia.tipo_denucia).end();
                                                   
												});
                                            });
                                        });
</script>

<!--Script para excluir tipo de denuncia-->	
<script type="text/javascript">
                                        $(document).ready(function () {
                                            $(".deletetpdenuncia").click(function (e) {
                                                e.preventDefault(e);
                                                // retornar registo baseado no ID 
                                                var iid = $(this).attr('data-id');
                                                $.ajax({
                                                    url: 'EliminarTipoDenuncia?codTipoDenuncia=' + iid,
                                                    method: 'GET',
                                                    data: 'data',
                                                }).done(function (response) {
                                                    console.log(response);
                                                    $(".message").fadeIn('fast').delay(500).fadeOut('fast').html(response);//3000 default
                                                    window.setTimeout(function(){location.reload()}, 400) //2000 default
                                                    
												});
                                            });
                                        });
</script>   

<!--Efeito para fecho do alerta/ da mensagem-->
<script type="text/javascript">
   $(".alerta").fadeIn('fast').delay(5000).fadeOut('fast').html(response);
     window.setTimeout(function(){location.reload()}, 4000) 
   </script>                            


<!-- Script pra retornar/listar tipos de denuncias -->

<script type="text/javascript">

   $(document).ready(function() {
            var table = $('#tipodenuncia').DataTable({
				 responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [ {
            className: 'dtr-control',
            orderable: false,
            targets:   0
        } ],
        order: [ 1, 'asc' ],
		
                  initComplete: function() {
                    this.api().columns([1,2,3,4,5]).every(function () {
                            var column = this;
                            var htmltagselect = $('<select><option value="">Selecionar</option></select>')
                                .appendTo($(column.footer()).empty())
                                .on('change', function () {
                                    var searchval = $.fn.dataTable.util.escapeRegex($(this).val());
 
                                    column.search(searchval?'^'+searchval+'$':searchval,true).draw();
                                   //column.search(searchval ? '^' + searchchval + '$' : '', true).draw();
                                });
 
                            column.data().unique().each(function(d,j){
                                    htmltagselect.append('<option value="'+ d +'">'+ d +'</option>');
                                });
                        });
                },

                buttons: ['copy', 'csv', 'print', 'excel', 'pdf'],
                dom: "<'row px-2 px-md-4 pt-2'<'col-md-3'l><'col-md-5 text-center'B><'col-md-4'f>>" +
                    "<'row'<'col-md-12'tr>>" +
                    "<'row px-2 px-md-4 py-3'<'col-md-5'i><'col-md-7'p>>",
                lengthMenu: [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "All"]
                ],
                columnDefs: [{
                    targets: -1,
                    orderable: false,
                    searchable: false
                }],

                "language": {
                    "lengthMenu": "Mostrar _MENU_ registos",
                    "zeroRecords": "Nenhum registo encontrado!",
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

    </script>  