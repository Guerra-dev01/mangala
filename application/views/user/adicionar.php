
      <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Breadcrumb e botao para encolher/expandir a barra lateral -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-users" aria-hidden="true"></i> Utilizadores</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Novo Utilizador</li>
                    </ol>
                </div>
            </div>
            <div class="message"></div>
		
            <div class="container-fluid">
                <div class="row m-b-10"> 
                    <div class="col-12">
                        <button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="<?php echo base_url(); ?>user/User" class="text-white"><i class="" aria-hidden="true"></i> Lista de Utilizadores</a></button>
                        <button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="<?php echo base_url(); ?>configuracao/Perfil" class="text-white"><i class="" aria-hidden="true"></i> Lista de perfis</a></button>
                    </div>
                </div>
               <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"><i class="fa fa-user-o" aria-hidden="true"></i> Adicionar novo Utilizador <span class="pull-right " ></span></h4>
                            </div>
                            <?php echo validation_errors(); ?>
                               <?php echo $this->upload->display_errors(); ?>
                               
                               <?php echo $this->session->flashdata('formdata'); ?>
                               <?php echo $this->session->flashdata('feedback'); ?>
							   
							      <!--Invocar alertas-->
			        <div class="alerta" >
                       <?= $this->session->flashdata('mensagem'); ?>
					 </div>
					 
                            <div class="card-body">

                                <form class="row" method="post" action="AdicionarUser" enctype="multipart/form-data">
								
                                    <div class="form-group col-md-3 m-t-20">
									<fieldset class="form-group position-relative has-icon-left">
                                        <input type="text" name="nome" class="form-control form-control-line" placeholder="Nome completo(*)" minlength="2" required > 
                                    <div class="form-control-position">
										<i class="fa fa-user" aria-hidden="true"></i>
										</div>
									</fieldset>
									<?php echo form_error('nome', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
                                   
                                    
                                    
                                    <div class="form-group col-md-3 m-t-20">
									<fieldset class="form-group position-relative has-icon-left">
                                        <select name="perfil" id="perfil" class="form-control custom-select" required>
                                             <option value="" selected disabled>Atribua um perfil (<span style="color:red">*</span>)...</option>
											 <?php foreach ($perfil as $value) : ?>
                                            <option <?= set_select('id_perfil', $value->codPerfil) ?> value="<?= $value->codPerfil ?>"><?= $value->papel;?></option>
                                        <?php endforeach; ?>
                                        </select>
										<div class="form-control-position" style="top:-4px">
										<i class="fa fa-user" aria-hidden="true"></i>
										</div>
										</fieldset>
									<?php echo form_error('perfil', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
									
                                    <div class="form-group col-md-3 m-t-20">
									<fieldset class="form-group position-relative has-icon-left">
                                        <select name="sexo" id="sexo" class="form-control custom-select" required>
                                            <option>Sexo(<span style="color:red">*</span>)...</option>
                                            <option value="Masculino"><i class="fa fa-mars" aria-hidden="true"></i> Masculino</option>
                                            <option value="Feminino"><i class="fa fa-venus" aria-hidden="true"></i> Feminino</option>
                                        </select>
										<div class="form-control-position" style="top:-4px">
										<i class="fa fa-transgender" aria-hidden="true"></i>
										</div>
										</fieldset>
									<?php echo form_error('sexo', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                   
                                   
                                    <div class="form-group col-md-3 m-t-20">
									<fieldset class="form-group position-relative has-icon-left">
                                     <input type="text" name="usuario" class="form-control form-control-line" value="" placeholder="Nome do Utilizador (*)"> 
                                    <div class="form-control-position">
										<i class="fa fa-user" aria-hidden="true"></i>
										</div>
									</fieldset>
									<?php echo form_error('usuario', '<small class="text-danger pl-3">', '</small>'); ?>			

									</div>
									
									<div class="form-group col-md-3 m-t-20">
                                       <fieldset class="form-group position-relative has-icon-left">
                                        <input type="password" name="senha" class="form-control form-control-line" value="" placeholder="Senha do usu&aacute;rio(*)"> 
                                    <div class="form-control-position">
										<i class="fa fa-key" aria-hidden="true"></i>
										</div>
									</fieldset>
									<?php echo form_error('senha', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
									
									<div class="form-group col-md-3 m-t-20">
									<fieldset class="form-group position-relative has-icon-left">
                                        <input type="password" name="senha2" class="form-control form-control-line" value="" placeholder="Confirmar senha(*)"> 
                                    <div class="form-control-position">
										<i class="fa fa-key" aria-hidden="true"></i>
										</div>
									</fieldset>
									<?php echo form_error('senha2', '<small class="text-danger pl-3">', '</small>'); ?>
									
									</div>
									
                                    <div class="form-group col-md-3 m-t-20">
									<fieldset class="form-group position-relative has-icon-left">
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email do Utilizador (*)" minlength="5" required > 
                                    <div class="form-control-position">
										<i class="fa fa-envelope" aria-hidden="true"></i>
										</div>
										</fieldset>
									<?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
									
									</div>
									
									<div class="form-group col-md-3 m-t-20">
									<fieldset class="form-group position-relative has-icon-left">
                                    <select name="provincia" id="provincia" class="form-control custom-select" required>
                                    <option value="" selected disabled>Selecione a prov&iacute;ncia (<span style="color:red">*</span>)...</option>
                                                    
                                       <?php foreach ($provincia as $value) : ?>
                                            <option <?= set_select('cod_prov', $value->id_provincia) ?> value="<?= $value->id_provincia ?>"><?= $value->nome_provincia;?></option>
                                        <?php endforeach; ?>
                                    </select>  
									<div class="form-control-position" style="top:-4px">
										<i class="fa fa-map-marker" aria-hidden="true"></i>
										</div>
									</fieldset>
									<?php echo form_error('provincia', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
									
									<div class="form-group col-md-3 m-t-20">
									<fieldset class="form-group position-relative has-icon-left">
                                    <select name="distrito" id="distrito" class="form-control custom-select" required>
									
                                    <option value="" selected disabled>Selecione o distrito (<span style="color:red">*</span>)...</option>
                                    </select>
									<div class="form-control-position" style="top:-4px">
										<i class="fa fa-map-marker" aria-hidden="true"></i>
									</div>
									</fieldset>
									<?php echo form_error('distrito', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
									
									 <div class="form-group col-md-3 m-t-20">
									 <fieldset class="form-group position-relative has-icon-left">
                                        <input type="number" name="contacto" class="form-control form-control-line" value="" minlength="5" placeholder="Contacto do usu&aacute;rio(*)"> 
                                    <div class="form-control-position">
										<i class="fa fa-phone" aria-hidden="true"></i>
										</div>
										</fieldset>
									<?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
								    </div>
									
									<div class="form-group col-md-3 m-t-20">
									<fieldset class="form-group position-relative has-icon-left">
                                        <input type="number" name="idade" class="form-control form-control-line" value="" min="23" placeholder="Idade do usu&aacute;rio(*)"> 
                                    </fieldset>
									<?php echo form_error('idade', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
									
                                    <div class="form-group col-md-3 m-t-20">
									<fieldset class="form-group position-relative has-icon-left">
                                        <input type="text" id="bairro" name="bairro" class="form-control" placeholder="Bairro do Usu&aacute;rio(*)" required > 
                                    <div class="form-control-position">
										<i class="fa fa-map-marker" aria-hidden="true"></i>
									</div>
									</fieldset>
									<?php echo form_error('bairro', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
									
									<div class="form-group col-md-3 m-t-20">
									<fieldset class="form-group position-relative has-icon-left">
                                        <label>Status: (<span style="color:red">*</span>): </label>
                                        <select name="status" id="status" class="form-control custom-select" required>
                                            <option>Status...</option>
                                            <option value="Activo(a)">Activo(a)</option>
                                            <option value="Inactivo(a)">Inactivo(a)</option>
                                        </select>
										<div class="form-control-position" style="top:25px">
										<i class="fa fa-exclamation" aria-hidden="true"></i>
										</div>
										</fieldset>
									<?php echo form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
									
                                    <div class="form-group col-md-6 m-t-20">
									<fieldset class="form-group position-relative has-icon-left">
                                        <label>Avatar/Foto de perfil (<span style="color:red">Opcional</span>):</label>
                                        <input type="file" name="avatar" class="form-control" value=""> 
										
									</fieldset>
									<?php echo form_error('avatar', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
									
                                    <div class="form-actions col-md-12">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Salvar</button>
                                        <button type="button" onclick="location.href='<?php echo base_url();?>user/User'" class="btn btn-danger"><i class="fa fa-window-close"></i> Cancelar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


<script type="text/javascript">
		$(document).ready(function(){

			$('#provincia').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo base_url('user/distritosporProvincia');?>",
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
						
                        $('#distrito').html(html);

                    }
                });
				
                return false;
            }); 
            
		});
	</script>