
<style>
 .hidden{

  display: none;

}
.show{

  display: block;

}
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
  
  /*.none {
    display:none;
  }*/
  
  td.details-control
  {
  text-align:center;
    color:forestgreen;
    cursor: pointer;
  }
  
   tr.shown td.details-control
  {
  text-align:center;
    color:red;
  }
  .encExp_button {
  border:none;
   color:#fff;
   background:#1976d2;
     cursor:pointer;
  }
  
  
  th.text-center{
  text-align:center;
  }    
 .modal {
  padding: 0 !important; 
   

}

.modal .modal-dialog {
  width: 90%;
  max-width: none;

  height: 100%;
  margin: 65px;
    bottom:16px;
  /*padding-left:80px;*/
 
}
.modal .modal-content {
  height: 95%;
 
  border: 0;
 
  border-radius: 0;
 bottom:25px;
    top:-30px;
  

}
  .modal .modal-content-edit {
  height: 95%;
 
  border: 0;
 
  border-radius: 0;
  bottom:25px;
    top:-30px;
  

}
.modal .modal-body {
  overflow-y: auto;
   
}
    
    
    
</style>

<!--Breadcrumb-->
         <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-bullhorn"></i> Den&uacute;ncias</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Lista de Den&uacute;ncias</li>
                    </ol>
                </div>
            </div>
			
           <!--Invocar alertas-->
			        <div class="alerta" >
                       <?= $this->session->flashdata('mensagem'); ?>
					 </div>
					 
            <!-- Contentor da pagina: Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">

            <div class="row m-b-10"> 
    <div class="col-12">
    <?php if(is_denunciante()):?>

<button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#denunciamodel" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Adicionar Den&uacute;ncia</a></button>       
      <?php endif; ?>
	  
	  <?php if(!is_denunciante()):?>
	  <button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="#<?php echo base_url(); ?>configuracao/Tipodenuncia" class="text-white"><i class="" aria-hidden="true"></i> Ver tipos de den&uacute;ncias</a></button>
        <?php endif; ?>
    </div>
</div>



<div class="row">
<div class="col-12">
    <div class="card card-outline-info">
        <div class="card-header">
            <h4 class="m-b-0 text-white"> <i class="fa fa-bullhorn"></i> Lista de Den&uacute;ncias</h4>
        </div>
        
        <div class="card-body">
          <button class="encExp_button" id="bt-expandir-linhas" type="button">Expandir todas den&uacute;ncias</button>
          <button class="encExp_button" id="bt-encolher-linhas" type="button">Encolher todas den&uacute;ncias</button>
             <hr>
			 <div class="row">

                    <!--........................Filtro da denuncias.....................-->


                                                     <!--Coluna de filtro (dropdown) de denuncias por user-->

                                                     <div class="col-6">
                                                                <div class="btn-group submitter-group float-right" style="padding-right:250px">
                                           
                                                                <select class="custom-select" id="filtro_denusr" onchange="Filtro_denusr(this)">
                                                                        <option value="">Selecione: Todos Utilizadores</option>
                                                                        <?php foreach ($usuario as $usr) {

                                                                   echo "<option value='".$usr."'>".$usr."</option>";
                                                                        }
                                                                                         
                                                                         ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                </div>
												<br>
						<!--Tabela de dados de den&uacute;ncia-->
            <div class="table-responsive">
                <table id="denuncias" class="display nowrap table dt-responsive table-hover table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                           <th></th>
                            <th>#</th>
                            <th>Utilizador/Denunciante</th>
                            <th>Tipo </th>
                            <th>Para</th>                       
                            <th>Assunto</th>
							<th>V&iacute;tima(terceiro)</th>
							<th>Sexo</th>
							<th>Contacto</th>
							<th>Prov&iacute;ncia</th>
                            <th>Distrito</th>
                            <th>Local</th>                       
                            <th>Submiss&atilde;o</th>
							<th>Descri&ccedil;&atilde;o</th>
							<th>Prova</th>                     
                        <th class="text-center">Ac&ccedil;&otilde;es</th>
                            

          
                        </tr>
                    </thead>
                  
                    <tbody>
                     <?php $no=1; foreach($denuncia as $d): ?>
                                            <tr>
											    <td></td>
                                              <td><?php echo $no++; ?></td>
                                               <td><?php echo $d['user']; ?></td>
                                               <td><?php echo $d['tipo_denucia']; ?></td>
                                               <td><?php echo $d['tipo']; ?></td>
                                               <td><?php echo $d['assunto']; ?></td>                                    
                                                <td><?php echo $d['nome']; ?></td>
                                               <td><?php echo $d['sexo']; ?></td>
											     <td><?php echo $d['contacto']; ?></td>                                    
                                                <td><?php echo $d['nome_provincia']; ?></td>
                                              
											    <td><?php echo $d['nome_distrito']; ?></td>
												<td><?php echo $d['localizacao']; ?></td>
											    <td><?php echo $d['created_at']; ?></td>
                                                <td><?php echo $d['descricao']; ?></td>
												 <td><?php echo $d['imagem']; ?></td>
                                                
                                                <td class="jsgrid-align-center ">
                                                       <?php echo anchor('assets/denuncias/media/'.$d['imagem'],'<i class="btn btn-info btn-circle btn-sm fa fa-eye" style="size: 14px; font:14px; position:center; width:12px; height: 10px;"></i>');?>
                                                     <?php if(is_denunciante()): ?>
													 <a href="" title="Editar"  class="btn btn-sm btn-primary waves-effect waves-light actualizarden" data-toggle="modal" data-target="#editdenunciamodel<?php echo $d['id_denucias'];?>" data-id="<?php echo $d['id_denucias']; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                                       <?php endif;?>
													   <a onclick="confirm('Deseja realmente eliminar esta den&uacute;ncia ?')" href="EliminarDenuncia?id_denucias=<?php echo $d['id_denucias'];?>" title="Excluir"  class="btn btn-sm btn-danger waves-effect waves-light deleteden" data-id="<?php echo $d['id_denucias']; ?>"><i class="fa fa-trash-o"></i></a> 
                                                       
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
</div>
</div>
 
<!--SCRIPT DA PAGINA-->

<!--Script para filtros e formatacao da tabela de dados de denuncias-->
<script type="text/javascript">
    $(document).ready( function () { 
	

    /*.............Filtro de denuncias por user...................*/
    $.fn.dataTable.ext.search.push(
        function( settings, searchData, index, rowData, counter ) {
          var searchVal = $('#filtro_denusr').val();

      
    //Retorna todas denuncias caso o filtro de denuncias por user nao seja acionado
            if (searchVal === '') {
            return true;
          }
      
    //Retorna apenas tuplas que satisfacam a condicao de procura

          if (searchVal === rowData[2])   {
            return true;
          }
      
    //Nada eh retornado se a condicao de filtro nao for satisfeita.
          return false;
        });


    $('.filter-checkbox').on('change', function() {
        var val = $(this).val();
        var checked = $(this).prop('checked');
        var index = filtered.indexOf(val);

        if (checked && index === -1) {
          filtered.push(val);
        } else if (!checked && index > -1) {
          filtered.splice(index, 14); // Numero de colunas da tabela de dados
        }
        table.draw();
      });

	
	
	// Tabela denuncias - Formatacao
        var table = $('#denuncias').DataTable({
			
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
		
         initComplete: function() {
                    this.api().columns([1,2,3,4,5]).every(function () {
                            var column = this;
                            var htmltagselect = $('<select><option value="">Selecionar</option></select>')
                                .appendTo($(column.footer()).empty())
                                .on('change', function () {
                                    var searchval = $.fn.dataTable.util.escapeRegex($(this).val());
 
                                    column.search(searchval?'^'+searchval+'$':searchval,true).draw();
                                   
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
                [5, 10, 25, 50, 100, "Todos"]
            ],
           
            "language": {
                    "lengthMenu": "Mostrar _MENU_ registos",
                    "zeroRecords": "Nenhum registo filtrado!",
                    "info": "P&aacute;gina _PAGE_ de _PAGES_",
                    "infoEmpty": "Sem registos dispon&iacute;veis!",
                    "infoFiltered": "(filtrado de _MAX_ registos)",
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
      
     // Manipular "expandir todas linhas"
    $('#bt-expandir-linhas').on('click', function(){
       table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
   
    });

    // Manipular "encolher toidas linhas"
   
      $('#bt-encolher-linhas').on('click', function(){
		  
		   table.rows('.parent').nodes().to$().find('td:first-child').trigger('click');
        
         });

  
 

    });
         
 
    /*...Funcao que implementa o Filtro de denuncias/user.....*/

    function Filtro_denusr(filtro2) { 

$('#denuncias').DataTable().draw();  // Metodo  para correr o plugin de procura

}    
</script>

<!-- Script pra actualizar dados duma denuncia -->

<script type="text/javascript">
                   $(document).ready(function () {
                                         $(".actualizarden").click(function (e){ // 
                                              e.preventDefault(e);
											  
                                                // retornar ID do registo via atributo
                                                 var iid = $(this).data('id_denucias');
                                                $('#denunciaform').trigger("reset");
                                                $('#denunciamodel').modal('show');
                                                $.ajax({
                                                    url: 'retornarDenuncia?id_denucias=' + iid,
                                                    method: 'GET',
                                                    data: '',
                                                    dataType: 'json',
                                                }).done(function (response) {
                                                    console.log(response);
                                               //   alert(response);
											   
                                                    // Popular campos do formulario com dados recuperados do servidor
													$('#denunciaform').find('[name="id_usuario"]').val(response.retornarDenuncia.id_usuario).end();
                                                    $('#denunciaform').find('[name="cod_prov"]').val(response.retornarDenuncia.id_provincia).end();
                                                     $('#denunciaform').find('[name="cod_cid"]').val(response.retornarDenuncia.id_distrito).end();
                                                      $('#denunciaform').find('[name="idCatdenucia"]').val(response.retornarDenuncia.idCatdencia).end();
                                                      $('#denunciaform').find('[name="idTipodenucia"]').val(response.retornarDenuncia.idTipodenucia).end();
                                                     $('#denunciaform').find('[name="nome"]').val(response.retornarDenuncia.nome).end();
                                                    $('#denunciaform').find('[name="email"]').val(response.retornarDenuncia.email).end();
                                                    $('#denunciaform').find('[name="ano_nascimento"]').val(response.retornarDenuncia.ano_nascimento).end();
                                                   $('#denunciaform').find('[name="contacto"]').val(response.retornarDenuncia.contacto).end();
                                                    $('#denunciaform').find('[name="localizacao"]').val(response.retornarDenuncia.localizacao).end();
                                                    $('#denunciaform').find('[name="sexo"]').val(response.retornarDenuncia.email).end();
                                                   $('#denunciaform').find('[name="assunto"]').val(response.retornarDenuncia.assunto).end();
                                                    $('#denunciaform').find('[name="descricao"]').val(response.retornarDenuncia.descricao).end();
                                                    $('#denunciaform').find('[name="imagem"]').val(response.retornarDenuncia.imagem).end();
                                                                                              
												});
                                            });
                                        });
</script>

<!-- Script pra eliminacao duma denuncia na tabela de dados -->

<script type="text/javascript">
                                       $(document).ready(function () {
                                           $(".deleteden").click(function (e) 
                                              {
                                                e.preventDefault(e);
                                                // Get the record's ID via attribute  
                                                var iid = $(this).attr('data-id');
                                                $.ajax({
                                                    url: 'EliminarDenuncia?id_denucias=' + iid,
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

<!-- Script pra esconder/mostrar inputs do formulario -->
<script type="text/javascript">        
  $('.idcatdenucia').change(function(){
        var responseID = $(this).val();
        if(responseID =="2"){
            $('#cod_prov').removeClass("hidden");
            $('#cod_prov').addClass("show");
            $('#idTipodenucia').removeClass("hidden");
            $('#idTipodenucia').addClass("show");
            $('#cod_cid').removeClass("hidden");
            $('#cod_cid').addClass("show");
            $('#localizacao').removeClass("hidden");
            $('#localizacao').addClass("show");
            $('#assunto').removeClass("hidden");
            $('#assunto').addClass("show");
            $('#descricao').removeClass("hidden");
            $('#descricao').addClass("show");
            $('#imagem').removeClass("hidden");
            $('#imagem').addClass("show");
            $('#sexo').removeClass("show");
            $('#sexo').addClass("hidden");
            $('#ano_nascimento').removeClass("show");
            $('#ano_nascimento').addClass("hidden");
            $('#contacto').removeClass("show");
            $('#contacto').addClass("hidden");
            $('#nome').removeClass("show");
            $('#nome').addClass("hidden");
            $('#botoes').removeClass("hidden");
            $('#botoes').addClass("show");
        } 
        else if(responseID =="3"){
            $('#cod_prov').removeClass("hidden");
            $('#cod_prov').addClass("show");
            $('#cod_cid').removeClass("hidden");
            $('#cod_cid').addClass("show");
            $('#idTipodenucia').removeClass("hidden");
            $('#idTipodenucia').addClass("show");
            $('#localizacao').removeClass("hidden");
            $('#localizacao').addClass("show");
            $('#assunto').removeClass("hidden");
            $('#assunto').addClass("show");
            $('#descricao').removeClass("hidden");
            $('#descricao').addClass("show");
            $('#imagem').removeClass("hidden");
            $('#imagem').addClass("show");
            $('#sexo').removeClass("hidden");
            $('#sexo').addClass("show");
            $('#ano_nascimento').removeClass("hidden");
            $('#ano_nascimento').addClass("show");
            $('#contacto').removeClass("hidden");
            $('#contacto').addClass("show");
            $('#nome').removeClass("hidden");
            $('#nome').addClass("show");
            $('#botoes').removeClass("hidden");
            $('#botoes').addClass("show");
        }
        
        else{
           $('#cod_prov').removeClass("hidden");
            $('#cod_prov').addClass("show");
            $('#cod_cid').removeClass("hidden");
            $('#cod_cid').addClass("show");
            $('#idTipodenucia').removeClass("hidden");
            $('#idTipodenucia').addClass("show");
            $('#localizacao').removeClass("hidden");
            $('#localizacao').addClass("show");
            $('#assunto').removeClass("hidden");
            $('#assunto').addClass("show");
            $('#descricao').removeClass("hidden");
            $('#descricao').addClass("show");
            $('#imagem').removeClass("hidden");
            $('#imagem').addClass("show");
            $('#sexo').removeClass("hidden");
            $('#sexo').addClass("show");
            $('#ano_nascimento').removeClass("hidden");
            $('#ano_nascimento').addClass("show");
            $('#contacto').removeClass("hidden");
            $('#contacto').addClass("show");
            $('#nome').removeClass("hidden");
            $('#nome').addClass("show");
            $('#botoes').removeClass("hidden");
            $('#botoes').addClass("show");
        }
        
    });
</script>


<!--Efeito para fecho do alerta/ da mensagem-->
<script type="text/javascript">
   $(".alerta").fadeIn('fast').delay(5000).fadeOut('fast').html(response);
     window.setTimeout(function(){location.reload()}, 4000) 
   </script>   