
         <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-users" aria-hidden="true"></i> Utilizadores</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Lista de Utilizadores</li>
                    </ol>
                </div>
            </div>
            <div class="message"></div>
			<!--Invocar alertas-->
			        <div class="alerta" >
                       <?= $this->session->flashdata('mensagem'); ?>
					 </div>
					 
            <div class="container-fluid">
                <div class="row m-b-10"> 
                    <div class="col-12">
                        <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a href="<?php echo base_url(); ?>user/Adicionar" class="text-white"><i class="" aria-hidden="true"></i> Adicionar Utilizador</a></button>
                        <button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="<?php echo base_url(); ?>configuracao/Perfil" class="text-white"><i class="" aria-hidden="true"></i>  Lista de Perfis</a></button>
                    </div>
                </div>
				  
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"><i class="fa fa-user-o" aria-hidden="true"></i> Utilizadores</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="user" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                               <th>Utilizador</th>
                                                <th>Email </th>
                                                  <th>Estado</th>
                                                  <th>Cadastro</th>
                                                <th>Ac&ccedil;&atilde;o</th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                           <?php $no=1; foreach($user as $value): ?>
                                            <tr>
                                              <td><?php echo $no++; ?></td>
                                               <td><?php echo $value->nome; ?></td>
                                               <td><?php echo $value->email; ?></td>
                                                <td><?php echo $value->status; ?></td>
                                               <td><?php echo $value->created_at; ?></td>
                                                
                                                <td class="jsgrid-align-center ">
                                                        
                                                        <a href="<?php echo base_url(); ?>user/view?I=<?php echo base64_encode($value->id_usuario); ?>" title="Edit" class="btn btn-sm btn-primary waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                                                        <a onclick="confirm('Deseja realmente eliminar este perfil?')" href="EliminarUser?id_usuario=<?php echo $value->id_usuario;?>" title="Delete" <?php if($this->session->userdata('perfil') !=='2'){ ?> hidden <?php } ?> class="btn btn-sm btn-danger waves-effect waves-light deleteuser" data-id="<?php echo $value->id_usuario; ?>"><i class="fa fa-trash-o"></i></a>
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
            var table = $('#user').DataTable({
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
   $(".alerta").fadeIn('fast').delay(3000).fadeOut('fast').html(response);
     window.setTimeout(function(){location.reload()}, 2000) 
   </script> 
   
   <!--Para excluir dados duma provincia-->
<script type="text/javascript">
                                        $(document).ready(function () {
                                            $(".deleteuser").click(function (e) {
                                                e.preventDefault(e);
                                                
                                                // retornar ID do registo via atributo  
                                                var iid = $(this).attr('data-id');
                                                $.ajax({
                                                    url: 'EliminarUser?id_usuario=' + iid,
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