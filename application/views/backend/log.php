
         <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-file" aria-hidden="true"></i> Notifica&ccedil;&otilde;es de actividades</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Logs</li>
                    </ol>
                </div>
            </div>
            <div class="message"></div>
			<!--Invocar alertas-->
		   <div class="alerta">
            <?php echo $this->session->flashdata('mensagem'); ?>
		   </div>
            <div class="container-fluid">
                <div class="row m-b-10"> 
                    <div class="col-12">
                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"><i class="fa fa-file-o" aria-hidden="true"></i> Notifica&ccedil;&otilde;es de actividades</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="log" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                 <th>Utilizador(a)</th>
												 <th>Perfil do Utilizador</th>
                                                <th>Ac&ccedil;&atilde;o </th>
                                                 <th>Mensagem</th>
                                                  <th>Registo</th>

                                                <th>Ac&ccedil;&atilde;o</th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                           <?php $no=1; foreach($logs as $l): ?>
                                            <tr>
                                              <td><?php echo $no++; ?></td>
                                               <td><?php echo $l['nome']; ?></td>
											   <td><?php echo $l['papel']; ?></td>
                                               <td><?php echo $l['code']; ?></td>
                                               <td><?php echo $l['message']; ?></td>
                                               
                                               <td><?php echo $l['date_time']; ?></td>
                                             <td>													  
											 <a onclick="confirm('Deseja realmente eliminar esta notifica&ccedil;&atilde;o?')" href="EliminarLog?id=<?php echo $l['id'];?>" title="Excluir"  class="btn btn-sm btn-danger waves-effect waves-light deleteden" data-id="<?php echo $l['id']; ?>"><i class="fa fa-trash-o"></i></a> 
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
				
<!-- Script pra actualizar dados de Utilizadores -->

<script type="text/javascript">

   $(document).ready(function() {
            var table = $('#log').DataTable({
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
	
	<!--Efeito para fecho do alerta/ da mensagem-->
<script type="text/javascript">
   $(".alerta").fadeIn('fast').delay(5000).fadeOut('fast').html(response);
     window.setTimeout(function(){location.reload()}, 4000) 
   </script> 