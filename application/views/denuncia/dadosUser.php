
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
    
</style>
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
            <!-- Container fluid  -->
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


<?php
  $id=$this->session->userdata('user_login_id');
	$data['denunciaporuser']=$this->denuncia_model->listarDenunciasporUser($id);
 ?>
 
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
            <div class="table-responsive">
                <table id="denuncias" class="display nowrap table dt-responsive table-hover table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                           <th></th>
                            <th>#</th>
                            <!--<th>Utilizador/Denunciante</th>-->
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
                            <!--<th>Accionar</th>-->
                           
                        <th class="text-center">Ac&ccedil;&otilde;es</th>
                            

          
                        </tr>
                    </thead>
                  
                    <tbody>
                     <?php $no=1; foreach($denunciaporuser as $d): ?>
                                            <tr>
											    <td></td>
                                              <td><?php echo $no++; ?></td>
                                               <!--<td><?php echo $d['user']; ?></td>-->
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
                                                   
													 <a href="" title="Editar"  class="btn btn-sm btn-primary waves-effect waves-light actualizarden" data-toggle="modal" data-target="#editdenunciamodel<?php echo $d['id_denucias'];?>" data-id="<?php echo $d['id_denucias']; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                                       
													   <a onclick="confirm('Deseja realmente eliminar este perfil?')" href="EliminarDenuncia?id_denucias=<?php echo $d['id_denucias'];?>" title="Excluir"  class="btn btn-sm btn-danger waves-effect waves-light deleteden" data-id="<?php echo $d['id_denucias']; ?>"><i class="fa fa-trash-o"></i></a> 
                                                       
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
    <div class="modal fade" id="denunciamodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" style=" overflow-y:auto; padding: 0 !important; ">
                            <div class="modal-dialog modal-xl modal-dialog-denunciaadd" role="document" style=" width: 90%; max-width: none; height: 100%; margin: 65px; bottom:16px;">
                                <div class="modal-content modal-content-denunciaadd" style="height: 95%; border: 0; border-radius: 0; bottom:25px; top:-30px;">
                                  
                                    <!--Cabecalho do formulario modal-->
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Nova Den&uacute;ncia</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post" action="adicionar" id="denunciaform" enctype="multipart/form-data">
                                      
                                <!--Corpo do formulario modal-->                              
                                    <div class="modal-body modal-body-denunciaadd" style="overflow-y: auto;">
                                        <div class="row">
                                          <div  hidden class="form-group col-md-3 m-t-20">
										  <input value="<?= set_value('id_usuario', $this->session->userdata('user_login_id')); ?>" name="id_usuario" id="id_usuario" type="text" class="form-control" style="width:300px;" placeholder="Identificador do Utilizador...">          
                                   
                                    </div>


                                <div class="form-group col-md-3 m-t-20">
								<fieldset class="form-group position-relative has-icon-left">
                                    <select  id="idcatdenucia" name="idcatdenucia" class="form-control custom-select">
                                  
                               <option value="none" <?php set_select('idcatdenucia', 'none', true);?> >Selecione a Categoria (<span style="color:red">*</span>)</option>
                                 <option value="2" <?php set_select('idcatdenucia', '2');?>>Proprio</option>
                                 <option value="3" <?php set_select('idcatdenucia', '3');?>>Terceiro</option>
                              
                                    </select> 
                                 </fieldset>
									<?= form_error('idcatdenucia', '<small class="text-danger pl-3">', '</small>'); ?>
																		
                               									
                                </div>
                                
								
                                    <div class="form-group col-md-3 m-t-20" >
									<fieldset class="form-group position-relative has-icon-left">
                                        <select  id="idTipodenucia" name="idTipodenucia" class="form-control custom-select">
                                        <option value="" selected disabled>Tipo de den&uacute;ncia (<span style="color:red">*</span>)</option>
                                                    
                                                        <?php foreach ($tipo as $value) : ?>
                                                            <option <?= set_select('idTipodenucia', $value->id_tipo_denucia) ?> value="<?= $value->id_tipo_denucia ?>"><?= $value->tipo_denucia?></option>
                                                            <?php endforeach; ?>
                                        </select>
										</fieldset>
									<?= form_error('idTipodenucia', '<small class="text-danger pl-3">', '</small>'); ?>
									
                                    </div>
									

                                    <div class="form-group col-md-3 m-t-20" id="cod_prov">
									<fieldset class="form-group position-relative has-icon-left">
                                        <select name="cod_prov" id="cod_prov" value="" class="form-control custom-select">
                                           <option value="" selected disabled>Selecione a sua localiza&ccedil;&atilde;o (<span style="color:red">*</span>)</option>                                     
                                                    <?php foreach ($provincia as $value) : ?>
                                                        <option <?= set_select('cod_prov', $value->id_provincia) ?> value="<?= $value->id_provincia ?>"><?= $value->nome_provincia?></option>
                                                        <?php endforeach; ?>
                                        </select>
										</fieldset>
									<?= form_error('cod_prov', '<small class="text-danger pl-3">', '</small>'); ?>
									
                                    </div>
                                  
								     <div class="form-group col-md-3 m-t-20">
									<fieldset class="form-group position-relative has-icon-left">
                                        <select name="cod_cid" id="cod_cid" value="" class="form-control custom-select">
										
                                           <option value="" selected disabled>Selecione o distrito (<span style="color:red">*</span>)</option>                                     

                                        </select>
										 </fieldset>
									      <?= form_error('cod_cid', '<small class="text-danger pl-3">', '</small>'); ?>

                                    </div>
									
                                     <div class="form-group col-md-3 m-t-20" id="localizacao">
									 <fieldset class="form-group position-relative has-icon-left">
                                        <input type="text" name="localizacao" class="form-control form-control-line" placeholder="Local de ocorr&ecirc;ncia(*)"> 
                                     </fieldset>
									<?= form_error('localizacao', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>



                                  <div class="form-group col-md-3 m-t-20"  id="ano_nascimento">
								  <fieldset class="form-group position-relative has-icon-left">
                                        <input type="number"  name="ano_nascimento" class="form-control form-control-line" placeholder="Sua idade ou da v&iacute;tima (*)"> 
                                   </fieldset>
									<?= form_error('ano_nascimento', '<small class="text-danger pl-3">', '</small>'); ?>

								   </div> 
								   
								   <div class="form-group col-md-3 m-t-20"  id="sexo">
								   <fieldset class="form-group position-relative has-icon-left">
                                    <select  name="sexo" style="color:gray;">
                                 <option value="none" <?=set_select('sexo', '', true);?> >Selecione o seu sexo (<span style="color:red">*</span>)</option>
                                 <option value="Masculino" <?=set_select('sexo', 'Masculino');?>>Masculino</option>
                                 <option value="Feminino" <?=set_select('sexo', 'Feminino');?> >Feminino</option>
                                   </select>
								   
								   </fieldset>
									<?= form_error('sexo', '<small class="text-danger pl-3">', '</small>'); ?>

                                   </div>
								   
								   <!--Inicio: Inputs adicionais para adicionar denuncia para terceiros-->
                             
							  
							 
							  <div class="form-group col-md-3 m-t-20"  id="nome" style="display:none">
							  <fieldset class="form-group position-relative has-icon-left">
                                        <input type="text"  name="nome" class="form-control form-control-line" placeholder="Nome da v&iacute;tima"> 
                                </fieldset>
								<?= form_error('nome', '<small class="text-danger pl-3">', '</small>'); ?>

									</div>
     

                                   <div class="form-group col-md-3 m-t-20" id="contacto" style="display:none">
                                      <fieldset class="form-group position-relative has-icon-left">  
										<input type="number"  name="contacto" class="form-control form-control-line" placeholder="Contacto da v&iacute;tima"> 
                                    </fieldset>
									<?= form_error('contacto', '<small class="text-danger pl-3">', '</small>'); ?>

									</div>
									
									 <!--Fecho: Inputs adicionais para adicionar denuncia para terceiros-->

                                    <div class="form-group col-md-4 m-t-20">
									<fieldset class="form-group position-relative has-icon-left">
									<label>Assunto da den&uacute;ncia (<span style="color:red">*</span>):</label>
                                        <input type="text"  id="assunto"  name="assunto" class="form-control form-control-line" placeholder="Assunto da den&uacute;ncia" > 
                                    </fieldset>
									<?= form_error('assunto', '<small class="text-danger pl-3">', '</small>'); ?>

									</div>
                                    
                                    <div class="form-group col-md-4 m-t-20" id="descricao">
									<fieldset class="form-group position-relative has-icon-left">

                                        <label>Descri&ccedil;&atilde;o da den&uacute;ncia (<span style="color:red">*</span>):</label>
                                        <textarea type="text" name="descricao" class="form-control form-control-line" placeholder="Descri&ccedil;&atilde;o da den&uacute;ncia (*)" rows="4" cols="50"> </textarea>
                                    </fieldset>
									<?= form_error('descricao', '<small class="text-danger pl-3">', '</small>'); ?>

                                    </div>

                                    <div class="form-group col-md-4 m-t-20" id="imagem">
									<fieldset class="form-group position-relative has-icon-left">
                                        <label>Prova(s): </label>
                                        <input multiple="" type="file" name="imagem" class="form-control" value=""> 
                                          </div>                                 
 	                                </fieldset>
									<?= form_error('imagem', '<small class="text-danger pl-3">', '</small>'); ?>

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

   

<!--Modal para editar/actualizar dados duma denuncia-->
<?php $no=1; foreach($denunciaporuser as $d): $no++; ?>
    <div class="modal fade" id="editdenunciamodel<?php echo $d['id_denucias'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" style=" padding: 0 !important;">
  
                            <div class="modal-dialog modal-xl modal-dialog-denunciaedit" role="document" style=" width: 90%; max-width: none; height: 100%; margin: 65px; bottom:16px;">
                                <div class="modal-content modal-body-denunciaedit" style="height: 95%; border: 0; border-radius: 0; bottom:25px; top:-30px;">
                                  
                                    <!--Cabecalho do formulario modal-->
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Actualizar Den&uacute;ncia</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post" action="actualizar" id="editdenunciaform" enctype="multipart/form-data">
                                   
                                <!--Corpo do formulario modal-->                              
                                    <div class="modal-body modal-body-denunciaedit" style="overflow-y: auto;">
                                        <div class="row">
										
                                          <div hidden class="form-group col-md-3 m-t-20">
                                    <select name="id_usuario" id="id_usuario" class="form-control custom-select" required>
									
                                    <option value="" selected disabled>Utilizador</option>
                                                    
                                       <?php foreach ($user as $value) : ?>
                                            <option <?= $d['id_usuario'] == $value->id_usuario ? 'selected' : ''; ?><?= set_select('id_usuario', $value->id_usuario) ?> value="<?= $value->id_usuario ?>"><?= $value->nome?></option>
                                        <?php endforeach; ?>
                                    </select>  
                                    </div>

                                <div class="form-group col-md-3 m-t-20 idcatdenuncia"  id="idcatdenuncia">
								<fieldset class="form-group position-relative has-icon-left">
                                        
                                    <select id="idcatdenucia" name="idcatdenucia" class="form-control custom-select">
                                <option value="none" <?php set_select('idcatdenucia', 'none', true);?> >Selecione a Categoria</option>
                                     
                               <option value="2" <?=$d['idcatdenucia'] == '2' ? 'selected' : ''; ?> <?=set_select('idcatdenucia', '2'); ?> >Proprio</option>
                                <option value="3" <?=$d['idcatdenucia'] == '3' ? 'selected' : ''; ?> <?=set_select('idcatdenucia', '3'); ?> >Terceiro</option>
                             
                                    </select> 
                                </fieldset>	
								<?= form_error('idcatdenucia', '<small class="text-danger pl-3">', '</small>'); ?>
								
                                </div>
                                
                                    <div class="form-group col-md-3 m-t-20" id="idTipodenucia">
                                        <fieldset class="form-group position-relative has-icon-left">
                                        <select  id="idTipodenucia" name="idTipodenucia" class="form-control custom-select">
                                          
                                        <option value="" selected disabled>Tipo de den&uacute;ncia</option>
                                                    
                                                        <?php foreach ($tipo as $value) : ?>
                                           <option <?= $d['idTipodenucia'] == $value->id_tipo_denucia ? 'selected' : ''; ?><?= set_select('idTipodenucia', $value->id_tipo_denucia) ?> value="<?= $value->id_tipo_denucia ?>"><?= $value->tipo_denucia?></option>
                                                            <?php endforeach; ?>
                                        </select>
										 </fieldset>	
								<?= form_error('idTipodenucia', '<small class="text-danger pl-3">', '</small>'); ?>
										
                                    </div>

                                    <div class="form-group col-md-3 m-t-20">
									<fieldset class="form-group position-relative has-icon-left">
                                        
                                        <select id="cod_prov" name="cod_prov" value="" class="form-control custom-select">
                                           
                                           <option value="" selected disabled>Selecione a sua prov&iacute;ncia</option>                                     
                                                    <?php foreach ($provincia as $value) : ?>
                                            <option <?= $d['cod_prov'] == $value->id_provincia ? 'selected' : ''; ?> <?= set_select('cod_prov', $value->id_provincia) ?> value="<?= $value->id_provincia ?>"><?= $value->nome_provincia ?></option>

                                          <?php endforeach; ?>
                                        </select>
											 </fieldset>	
								<?= form_error('cod_prov', '<small class="text-danger pl-3">', '</small>'); ?>
									
                                    </div>
									
									
									 <div class="form-group col-md-3 m-t-20">
									<fieldset class="form-group position-relative has-icon-left">
                                        
                                        <select id="cod_cid" name="cod_cid" value="" class="form-control custom-select">
											<option value="" selected disabled>Selecione o distriro</option>
                                                    <?php foreach ($distrito as $value) : ?>
													
                                            <option <?= $d['cod_cid'] == $value->id_distrito ? 'selected' : ''; ?> <?= set_select('cod_cid', $value->id_distrito) ?> value="<?= $value->id_distrito ?>"><?= $value->nome_distrito ?></option>

                                          <?php endforeach; ?>                                   
                                             
                                        </select>
									</fieldset>	
								    <?= form_error('cod_cid', '<small class="text-danger pl-3">', '</small>'); ?>
									
                                    </div>
                                  
                                     <div class="form-group col-md-3 m-t-20 hidden" id="localizacao">
									 <fieldset class="form-group position-relative has-icon-left">
                                        
                                        <input type="text" id="localizacao" name="localizacao" value="<?=set_value('localizacao', $d['localizacao']); ?>" class="form-control form-control-line" placeholder="Local de ocorr&ecirc;ncia"> 
                                     </fieldset>	
								<?= form_error('localizacao', '<small class="text-danger pl-3">', '</small>'); ?>
									
									</div>

                                   

                                    <div class="form-group col-md-3 m-t-20 hidden" id="sexo">
									<fieldset class="form-group position-relative has-icon-left">
                                    <select id="sexo" name="sexo" style="color:gray;">
                                    
                                 <option value="none" <?=set_select('sexo', 'none', true);?> >Selecione o seu sexo</option>
                                 
                                      <option value="Masculino" <?= $d['sexo'] == 'Masculino' ? 'selected' : ''; ?> <?= set_select('sexo', 'Masculino'); ?> >Masculino</option>
                                     <option value="Feminino" <?= $d['sexo'] == 'Feminino' ? 'selected' : ''; ?> <?= set_select('sexo', 'Feminino'); ?> >Feminino</option>  
                                   </select>
								   </fieldset>	
								<?= form_error('sexo', '<small class="text-danger pl-3">', '</small>'); ?>
									
                                   </div>

                                    <div class="form-group col-md-3 m-t-20 hidden" id="nome">
									<fieldset class="form-group position-relative has-icon-left">
                                        <input type="text" id="nome" name="nome" value="<?=set_value('nome', $d['nome']); ?>" class="form-control form-control-line" placeholder="Nome do denunciante"> 
                                    </fieldset>	
								<?= form_error('nome', '<small class="text-danger pl-3">', '</small>'); ?>
									
									</div>

                                    
                                   <div class="form-group col-md-3 m-t-20 hidden" id="ano_nascimento">
								   <fieldset class="form-group position-relative has-icon-left">
                                       
                                        <input type="number" id="ano_nascimento" name="ano_nascimento" value="<?=set_value('ano_nascimento', $d['ano_nascimento']); ?>" class="form-control form-control-line" placeholder="Idade do denunciante"> 
                                    </fieldset>	
								<?= form_error('ano_nascimento', '<small class="text-danger pl-3">', '</small>'); ?>
									
									</div>

                                   <div class="form-group col-md-3 m-t-20 hidden" id="contacto">
								   <fieldset class="form-group position-relative has-icon-left">
                                        
                                        <input type="number" name="contacto" value="<?=set_value('contacto', $d['contacto']); ?>" class="form-control form-control-line" placeholder="Contacto do denunciante"> 
                                    </fieldset>	
								<?= form_error('contacto', '<small class="text-danger pl-3">', '</small>'); ?>
									
									</div>
                                    

                                    <div class="form-group col-md-6 m-t-20" id="assunto" >
									  
                                        <input type="text" id="assunto" name="assunto" value="<?=set_value('assunto', $d['assunto']); ?>" class="form-control form-control-line" placeholder="Assunto" > 
                                   
									</div>
                                    

                                    <div class="form-group col-md-6 m-t-20" id="descricao">
									
                                        <label>Descri&ccedil;&atilde;o da den&uacute;ncia:</label>
                                        <textarea type="text" id="descricao" name="descricao" value="<?=set_value('descricao', $d['descricao']); ?>" class="form-control form-control-line" placeholder="Descri&ccedil;&atilde;o da den&uacute;ncia" rows="4" cols="50"> </textarea>
                                
                                    </div>

                                    <div class="form-group col-md-6 m-t-20" id="imagem">
									
                                        <label>Prova(s): </label>
                                        <input multiple="" type="file" name="imagem" id="imagem" value="<?=set_value('imagem', $d['imagem']); ?>" class="form-control"> 
                                     
										  </div>                                 
                                     
                                    </div>
                                    
                                     
                                    <div class="modal-footer">
                                    <input type="hidden" name="id_denucias" value="<?php echo $d['id_denucias']; ?>" class="form-control" id="recipient-name1">                                       
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
										
                                        <button type="submit" class="btn btn-success">Submeter</button>
                                    </div>
                                       </div>
                                   
                                    </form>
      <!--Fecho do formulario modal--> 
                                </div>
                            </div>
                        </div>
<?php endforeach; ?>
<!--SCRIPT DA PAGINA-->

<!--Script para a formatacao da tabela de dados de denuncias-->
<script type="text/javascript">
    $(document).ready( function () { 
        var table = $('#denuncias').DataTable({
		
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

$(function () {
	
	$('#idcatdenucia').change(function () {
		if($(this).val() =='3'){
	   //$('#sexo').show();	
		//$('#ano_nascimento').show();
        $('#contacto').show();
        $('#nome').show();
		}else{
	   // $('#sexo').hide();	
		//$('#ano_nascimento').hide();
        $('#contacto').hide();
        $('#nome').hide();
		}
		
		
	});
});


</script>
<!--Efeito para fecho do alerta/ da mensagem-->
<script type="text/javascript">
   $(".alerta").fadeIn('fast').delay(5000).fadeOut('fast').html(response);
     window.setTimeout(function(){location.reload()}, 4000) 
   </script>  

<script type="text/javascript">
		$(document).ready(function(){

			$('#cod_prov').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo base_url('denuncia/distritosporProvincia');?>",
                    method : "POST",
                    data : {provincia_id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
							
                            html += '<option value='+data[i].id_provincia+'>'+data[i].nome_distrito+'</option>';
                        }
						
                        $('#cod_cid').html(html);

                    }
                });
				
                return false;
            }); 
            
		});
	</script>   