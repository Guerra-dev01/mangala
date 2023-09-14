
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
         <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="mdi mdi-map-marker"></i> Den&uacute;ncias</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Lista de Den&uacute;ncias</li>
                    </ol>
                </div>
            </div>
 
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">

            <div class="row m-b-10"> 
    <div class="col-12">
    <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
                        
        <?php } else { ?>
<button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#denunciamodel" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Adicionar Den&uacute;ncia</a></button>       
      <!--<button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="#<?php echo base_url(); ?>leave/Application" class="text-white"><i class="" aria-hidden="true"></i> Ver Distritos</a></button>-->
        <?php } ?>
    </div>
</div>



<div class="row">
<div class="col-12">
    <div class="card card-outline-info">
        <div class="card-header">
            <h4 class="m-b-0 text-white"> Lista de Den&uacute;ncias</h4>
        </div>
        
        <div class="card-body">
          <button class="encExp_button" id="bt-expandir-linhas" type="button">Expandir todas den&uacute;ncias</button>
          <button class="encExp_button" id="bt-encolher-linhas" type="button">Encolher todas den&uacute;ncias</button>
             <hr>
            <div class="table-responsive">
                <table id="denuncias" class="display nowrap table dt-responsive table-hover table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                          <!--<th></th>-->
                            <!--<th>#</th>--> <!--id_denucias-->
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
                            <th>Submiss&atilde;&atilde;o</th>
							<th>Descri&ccedil;&atilde;o</th>
							<th>Prova</th>
                            <!--<th>Accionar</th>-->
                           
                        <th class="text-center">Ac&ccedil;&otilde;es</th>
                            

          
                        </tr>
                    </thead>
                  
                    <tbody>
                     <?php /*$no=1;*/ foreach($denuncia as $value): ?>
                                            <tr>
											  <!-- <th></th>-->
                                              <!--<td><?php echo $no++; ?></td>-->
                                               <td><?php echo $value->user; ?></td>
                                               <td><?php echo $value->tipo_denucia; ?></td>
                                               <td><?php echo $value->tipo; ?></td>
                                               <td><?php echo $value->assunto; ?></td>                                    
                                                <td><?php echo $value->nome; ?></td>
                                               <td><?php echo $value->sexo; ?></td>
											     <td><?php echo $value->contacto; ?></td>                                    
                                                <td><?php echo $value->nome_provincia; ?></td>
                                              
											    <td><?php echo $value->nome_distrito; ?></td>
												<td><?php echo $value->localizacao; ?></td>
											    <td><?php echo $value->created_at; ?></td>
                                                <td><?php echo $value->descricao; ?></td>
												 <td><?php echo $value->imagem; ?></td>
                                                
                                                <td class="jsgrid-align-center ">
                                                       <?= anchor('assets/denuncias/media/'.$value ->imagem,'<a href="#" title="Ver prova"><i class="btn btn-info btn-circle btn-sm fa fa-eye" style="size: 14px; font:14px; position:center; width:12px; height: 10px;"></i></a>');?>
                                                       <a href="" title="Editar"  class="btn btn-sm btn-primary waves-effect waves-light actualizarden" data-toggle="modal" data-target="#editdenunciamodel" data-id="<?php echo $value->id_denucias; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                                       <a onclick="confirm('Deseja realmente eliminar este perfil?')" href="#" title="Excluir"  class="btn btn-sm btn-danger waves-effect waves-light deleteden" data-id="<?php echo $value->id_denucias; ?>"><i class="fa fa-trash-o"></i></a> 
                                                   
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
   
<!--Modal para adicionar dados de denuncias-->
    <div class="modal fade" id="denunciamodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content ">
                                  
                                    <!--Cabecalho do formulario modal-->
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Nova Den&uacute;ncia</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post" action="adicionar" id="denunciaform" enctype="multipart/form-data">
                                      
                                <!--Corpo do formulario modal-->                              
                                    <div class="modal-body">
                                        <div class="row">
                                          <div class="form-group col-md-3 m-t-20">
                                    <select name="id_usuario" id="id_usuario" class="form-control custom-select" required>
									
                                    <option value="" selected disabled>Utilizador</option>
                                                    
                                       <?php foreach ($user as $value) : ?>
                                            <option <?= set_select('id_usuario', $value->id_usuario) ?> value="<?= $value->id_usuario ?>"><?= $value->nome?></option>
                                        <?php endforeach; ?>
                                    </select>  
                                    </div>

                                <div class="form-group col-md-3 m-t-20"  id="idCatdenucia">
                                        <!--<label>Categoria </label>-->
                                    <select id="idCatdenucia" name="idCatdenucia" class="form-control custom-select idCatdenucia">
                                    <!--<option value="" selected disabled>Categoria de den&uacute;ncia</option>-->
                                                    
                                                 <!-- <?php //foreach ($dadosdenuncia as $value) : ?>
                                                        <option <?= set_select('idCatdenucia', $value->id_categoria) ?> value="<?= $value->id_categoria ?>"><?= $value->tipo?></option>
                                                        <?php //endforeach; ?>-->
                                <option value="none" <?php set_select('idCatdenucia', 'none', true);?> >Selecione a Categoria</option>
                                 <option value="2" <?php set_select('idCatdenucia', '2');?>>Proprio</option>
                                 <option value="3" <?php set_select('idCatdenucia', '3');?>>Terceiro</option>
                              
                                    </select>                                    
                                </div>
                                
                                    <div class="form-group col-md-3 m-t-20" id="idTipodenucia">
                                        <!--<label>Employee Code </label>-->
                                        <select  id="idTipodenucia" name="idTipodenucia" class="form-control custom-select">
                                        <option value="" selected disabled>Tipo de den&uacute;ncia</option>
                                                    
                                                        <?php foreach ($tipo as $value) : ?>
                                                            <option <?= set_select('idTipodenucia', $value->id_tipo_denucia) ?> value="<?= $value->id_tipo_denucia ?>"><?= $value->tipo_denucia?></option>
                                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3 m-t-20" id="cod_prov">
                                        <!--<label>Department</label>-->
                                        <select id="cod_prov" name="cod_prov" id="cod_prov"  value="" class="form-control custom-select">
                                           <option value="" selected disabled>Selecione a sua localiza&ccedil;&atilde;o</option>                                     
                                                    <?php foreach ($provincia as $value) : ?>
                                                        <option <?= set_select('cod_prov', $value->id_provincia) ?> value="<?= $value->id_provincia ?>"><?= $value->nome_provincia?></option>
                                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                  
                                     <div class="form-group col-md-3 m-t-20" id="localizacao">
                                        <!--<label>First Name</label>-->
                                        <input type="text" id="localizacao" name="localizacao" class="form-control form-control-line" placeholder="Local de ocorr&ecirc;ncia"> 
                                    </div>

                                    <div class="form-group col-md-3 m-t-20" id="cod_cid">
                                        <!--<label>Designation </label>-->
                                        <select id="cod_cid" name="cod_cid" value="" class="form-control custom-select">
										
                                           <option value="cod_cid" selected disabled>Selecione o distrito</option>                                     
                                                    <?php foreach ($distrito as $value) : ?>
                                                        <option <?= set_select('cod_cid', $value->id_distrito) ?> value="<?= $value->id_distrito ?>"><?= $value->nome_distrito?></option>
                                                        <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <?php //if (Terceiro()):?>
                                    <div class="form-group col-md-3 m-t-20 hidden" id="sexo">
                                    <select id="sexo" name="sexo" style="color:gray;">
                                 <option value="none" <?=set_select('sexo', 'none', true);?> >Selecione o seu sexo</option>
                                 <option value="Masculino" <?=set_select('sexo', 'Masculino');?>>Masculino</option>
                                 <option value="Feminino" <?=set_select('sexo', 'Feminino');?> >Feminino</option>
                                   </select>
                                   </div>

                                    <div class="form-group col-md-3 m-t-20 hidden" id="nome">
                                        <!--<label>First Name</label>-->
                                        <input type="text" id="nome" name="nome" class="form-control form-control-line" placeholder="Nome do denunciante"> 
                                    </div>

                                    
                                   <div class="form-group col-md-3 m-t-20 hidden" id="ano_nascimento">
                                        <!--<label>First Name</label>-->
                                        <input type="number" id="ano_nascimento" name="ano_nascimento" class="form-control form-control-line" placeholder="Idade do denunciante"> 
                                    </div>

                                   <div class="form-group col-md-3 m-t-20 hidden" id="contacto">
                                        <!--<label>First Name</label>-->
                                        <input type="number" name="contacto" class="form-control form-control-line" placeholder="Contacto do denunciante"> 
                                    </div>
                                    <?php //endif; ?>

                                    <div class="form-group col-md-6 m-t-20" id="assunto" >
                                        <!--<label>Role </label>-->
                                        <input type="text" id="assunto" name="assunto" class="form-control form-control-line" placeholder="Assunto" > 
                                    </div>
                                    

                                    <div class="form-group col-md-6 m-t-20" id="descricao">
                                        <label>Descri&ccedil;&atilde;o da den&uacute;ncia:</label>
                                        <textarea type="text" id="descricao" name="descricao" class="form-control form-control-line" placeholder="Descri&ccedil;&atilde;o da den&uacute;ncia" rows="4" cols="50"> </textarea>

                                    </div>

                                    <div class="form-group col-md-6 m-t-20" id="imagem">
                                        <label>Prova(s): </label>
                                        <input multiple="" type="file" name="imagem" id="imagem" class="form-control" value=""> 
                                          </div>                                 
                                                                                
                                        
                                    </div>
                                    
                                     <!--Fecho do formulario modal--> 
                                    <div class="modal-footer">
                                    <input type="hidden" name="id_denucias" value="" class="form-control" id="recipient-name1">                                       
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-success">Submeter</button>
                                    </div>
                                       </div>
                                   
                                    </form>
                                </div>
                            </div>
                        </div>

   

<!--SCRIPT DA PAGINA-->

<!--Script para a formatacao da tabela de dados de denuncias-->
<script type="text/javascript">
    $(document).ready( function () { 
        var table = $('#denuncias').DataTable({
			responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        columnDefs: [ {
            className: 'dtr-control',
            orderable: false,
			searchable:false,
            targets:   0
        } ],
        order: [ 1, 'asc' ],
		
        /*  "ajax": {
                    "url": "datatableDenuncias1",
                    "type": "POST",
                     'datatype': 'json'
                 
                },*/
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
           /* "columnDefs": [
              {
              //  "targets": [2,3,4,5], //Colunas ocultas
             //   "orderable": false,
                "visible": false,
        
    //Com searchable habilitado, o filtro de coluna de Observacao nao funciona
    //Com searchable desabilitado, o filtro de colunas consegue procurar dados de colunas ocultas
                 "searchable": false
              }
            ],*/
          
          /*'columns':[
            {
             "className":'details-control',
               "orderable": false,
               "data":null,
                "defaultContent":'',
                 "render":function(){
                 return '<i class="fa fa-plus-square" aria-hidden="true"></i>'
                 },
              
            },
            {'data':'id_denucias'},
            {'data':'Utilizador'},
            {'data':'Tipo'},
            {'data':'Categoria'},
            {'data':'Assunto'},
             {
              "className":'button-left',
               "orderable": false,
                data: "id_denucias",
                "defaultContent":'',
                 "render":function(data, type, row, meta){
                //  console.log(data);
                
              return '<div class="text-center"><a href="" title="Edit" class="btn btn-success text-white actualizarden" data-toggle="modal" data-target="#denunciamodel" onclick="funcaoEdit('+data+')" data-id="'+data+'"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Editar</a>&nbsp;<a href="<?php echo base_url('denuncia/EliminarDenuncia?id_denucias=');?>'+ data +'" class="btn btn-danger text-white deleteden" onClick="funcaoDelete('+ data +')" data-id="'+ data +'"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete</a></div>';
               
                 }
           }
                                              
          ],*/
       
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
      // Enumerar todas as tuplas
       /* table.rows().every(function(){
            // // Se uma tupla tem detalhes visiveis
            if(!this.child.isShown()){
                // Expandir/abrir a tupla
                this.child(format(this.data())).show(); //(format(this.data()))
                $(this.node()).addClass('shown');
            }
        });*/
    });

    // Manipular "encolher toidas linhas"
   
      $('#bt-encolher-linhas').on('click', function(){
		  
		   table.rows('.parent').nodes().to$().find('td:first-child').trigger('click');
        // Enumerar todas as tuplas
        /*table.rows().every(function(){
            // Se uma tupla tem detalhes visiveis
            if(this.child.isShown()){
                // Encolher detalhes
                this.child.hide();
                $(this.node()).removeClass('shown');
            }
        });*/
         });

        //});
  
  
     // Para retorno das linhas de detalhes escondidas na tabela de denuncias
/*function format(d) {
     
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
     /* '<tr>'+
            '<td>#:</td>'+
            '<td>'+ d.id_denucias +'</td>'+*/
       /* '</tr>'+ 
        '<tr>'+
            '<td>Denunciante:</td>'+
            '<td>'+ d.Nome +'</td>'+
        '</tr>'+
      '<tr>'+
            '<td>Prov&iacute;ncia:</td>'+
            '<td>'+ d.Provincia +'</td>'+
        '</tr>'+
       '<tr>'+
            '<td>Distrito:</td>'+
            '<td>'+ d.Distrito +'</td>'+
        '</tr>'+
      '<tr>'+
            '<td>Local:</td>'+
            '<td>'+ d.Local +'</td>'+
        '</tr>'+
       '<tr>'+
            '<td>Contacto:</td>'+
            '<td>'+ d.Contacto +'</td>'+
        '</tr>'+
      '<tr>'+
            '<td>Sexo:</td>'+
            '<td>'+ d.Sexo +'</td>'+
        '</tr>'+
      '<tr>'+
            '<td>Descri&ccedil;&atilde;o da den&uacute;ncia:</td>'+
            '<td>'+ d.Detalhes +'</td>'+
        '</tr>'+
      '<tr>'+
            '<td>Prova(s):</td>'+
            '<td>'+ d.Prova +'</td>'+
        '</tr>'
        
  }*/

   // Adicionar event listener para expandir and fechar as linhas de detalhes das denuncias
  /* $('#denuncias tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var tdi = tr.find("i.fa");
        var row = table.row(tr);

        if (row.child.isShown()) {
            // para fechar a tupla caso esteja aberta
            row.child.hide();
            tr.removeClass('shown');
            tdi.first().removeClass('fa-minus-square');
            tdi.first().addClass('fa-plus-square');
        }
        else {
            // Para abrir a tupla
            row.child(format(row.data())).show();
            tr.addClass('shown');
            tdi.first().removeClass('fa-plus-square');
            tdi.first().addClass('fa-minus-square');         
        }
    })*/


    });
       
</script>

<!-- Script pra actualizar dados duma denuncia -->

<script type="text/javascript">
                   $(document).ready(function () {
                                         $("#a.actualizarden").click(function (e){ // 
                                              e.preventDefault(e);
											  
                                                // retornar ID do registo via atributo
                                                 var iid = $(this).attr('data-id');
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
  $('.idCatdenucia').change(function(){
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
        
        else   if(responseID =="none"){
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
        //console.log(responseID);
    });
</script>


