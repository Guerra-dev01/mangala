
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
                    <h3 class="text-themecolor"><i class="mdi mdi-account-box"></i> Perfil</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Perfil</li>
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
                        <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#perfilmodel" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Adicionar Perfil</a></button>
                         <?php endif ?>
                    </div>
                </div>  
				
				<!--Tabela de dados com lista de perfis registados-->
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"> Lista de Perfis</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="perfil" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Perfil</th>
                                                <th>Ac&ccedil;&otilde;es</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php $no = 1; foreach($perfil as $value): ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $value->papel ?></td>
                                                <td class="jsgrid-align-center ">
                                                    <a href="" title="Edit" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> hidden <?php } ?> class="btn btn-sm btn-primary waves-effect waves-light actualizarperfil" data-id="<?php echo $value->codPerfil; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                                    <a onclick="confirm('Deseja realmente eliminar este perfil?')" href="#" title="Delete" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> hidden <?php } ?> class="btn btn-sm btn-danger waves-effect waves-light deleteperfil" data-id="<?php echo $value->codPerfil; ?>"><i class="fa fa-trash-o"></i></a>
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
				
				<!--Modal view para adicionar/actualizar perfil-->
                        <div class="modal fade" id="perfilmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Adi&ccedil;&atilde;o de Perfil</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post" action="AdicionarPerfil" id="perfilform" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        
                                            <div class="form-group">
                                                <label class="control-label">Nome do Perfil</label>
                                                <input type="text" name="papel" class="form-control" id="recipient-name1" minlength="4" maxlength="25" value="" required>
                                            </div>
                                                                                
                                        
                                    </div>
                                    <div class="modal-footer">
                                    <input type="hidden" name="codPerfil" value="" class="form-control" id="recipient-name1">                                       
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-success">Submeter</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
						
						
	<!--SCRIPTS da pagina de configuracao do PERFIL-->					
                <script>

                
                </script> 
				
<!--Script para actualizar perfil-->				
<script type="text/javascript">
                                        $(document).ready(function () {
                                            $(".actualizarperfil").click(function (e) {
                                                e.preventDefault(e);
                                                // Get the record's ID via attribute  
                                                var iid = $(this).attr('data-id');
                                                $('#perfilform').trigger("reset");
                                                $('#perfilmodel').modal('show');
                                                $.ajax({
                                                    url: 'PerfilporID?codPerfil=' + iid,
                                                    method: 'GET',
                                                    data: '',
                                                    dataType: 'json',
                                                }).done(function (response) {
                                                    console.log(response);
                                                    // Popular o formulado de actualizacao do perfil
													$('#perfilform').find('[name="codPerfil"]').val(response.dadoperfil.codPerfil).end();
                                                    $('#perfilform').find('[name="papel"]').val(response.dadoperfil.papel).end();
                                                   
												});
                                            });
                                        });
</script>

<!--Script para excluir um perfil-->
<script type="text/javascript">
                                        $(document).ready(function () {
                                            $(".deleteperfil").click(function (e) {
                                                e.preventDefault(e);
                                                // retornar dados com base no ID do atributo 
                                                var iid = $(this).attr('data-id');
                                                $.ajax({
                                                    url: 'EliminarPerfil?codPerfil=' + iid,
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
   $(".alerta").fadeIn('fast').delay(3000).fadeOut('fast').html(response);
     window.setTimeout(function(){location.reload()}, 2000) 
   </script>     

<!-- Script pra retornar/listar perfis de Utilizadores -->

<script type="text/javascript">

   $(document).ready(function() {
            var table = $('#perfil').DataTable({
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
