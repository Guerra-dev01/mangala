
                     <div class="page-wrapper">
                     <div class="message">
                      
					 </div>
					
					 
               <div class="row page-titles">
                <div class="col-md-5 align-self-center">
				
				<!--Invocar funcoes que retornam dados do user/perfil-->
                <?php
               $id = $this->session->userdata('user_login_id');
              
                   $data['infobasica'] = $this->user_model->GetUserInfo($id);
             
                   $data['userpass'] = $this->user_model->GetUserID($id);
                   $data['userpass']=$userpass; 
				   $data['socialmedia'] = $this->user_model->GetSocialValue($id);
                 ?>

                    <h3 class="text-themecolor"><i class="fa fa-users" style="color:#1976d2"></i> <?php  echo $infobasica->nome; ?></h3>
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
               
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card">

                            <!-- Tabs de Navegacao-->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab" style="font-size: 14px;"> Dados Pessoais </a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#social" role="tab" style="font-size: 14px;"> Social Media</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#password" role="tab" style="font-size: 14px;">Alterar senha</a> </li>
                              
                            </ul>


                            <!--......................... Paineis de Tabulacao ...................................-->

                             <!--Segunda Tab - Dados pessoais do Utilizador -->

                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card">
				                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30">
                                   <?php //if(!empty($infobasica->avatar)){ ?>
                                    <!--<img src="<?php echo base_url(); ?>assets/images/users/<?php echo $infobasica->avatar; ?>" class="img-circle" width="150" />-->
                                    <?php /*} else { */?>
                                    <img src="<?php echo base_url(); ?>assets/images/users/user.png" class="img-circle" width="150" alt="<?php  echo $infobasica->nome; ?>" title="<?php echo $infobasica->nome;?>"/>                              
                                    <?php /*} */?>
                                    <h4 class="card-title m-t-10"><?php echo $infobasica->nome;?></h4>
                                    <h6 class="card-subtitle" value='<?php echo $infobasica->id_perfil; ?>'><?php echo $infobasica->papel; ?></h6>
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> <small class="text-muted">Email:</small>
                                <h6><?php echo $infobasica->email; ?></h6> 
                                
                                <small class="text-muted p-t-30 db"> Redes sociais</small>
                                <br/>
                                <a class="btn btn-circle btn-secondary" href="#<?php if(!empty($socialmedia->skype_id)) echo $socialmedia->facebook ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a class="btn btn-circle btn-secondary" href="#<?php if(!empty($socialmedia->skype_id)) echo $socialmedia->twitter ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                                <a class="btn btn-circle btn-secondary" href="#<?php if(!empty($socialmedia->skype_id)) echo $socialmedia->skype_id ?>" target="_blank"><i class="fa fa-skype"></i></a>
                                <a class="btn btn-circle btn-secondary" href="#<?php if(!empty($socialmedia->google_Plus)) echo $socialmedia->google_Plus ?>" target="_blank"><i class="fa fa-google"></i></a>
                            </div>
                        </div>                                                    
                                                </div>
												<!--Formulario de actualizacao de dados do Utilizador-->
                                                <div class="col-md-8">
				                                <form class="row" action="Actualizar" method="post" enctype="multipart/form-data">                        

				                                    <div class="form-group col-md-4 m-t-10">
													 <fieldset class="form-group position-relative has-icon-left">
				                                        <label>Nome:</label>
				                                        <input type="text" class="form-control form-control-line" placeholder="Nome do Utilizador" id="nome" name="nome" value="<?php echo $infobasica->nome; ?>" minlength="3" required> 
				                                     <div class="form-control-position" style="top:30px">
										            <i class="fa fa-user" aria-hidden="true"></i>
										            </div>
													 </fieldset>
													<?= form_error('nome', '<small class="text-danger pl-3">', '</small>'); ?>

													</div>
				                                  

                                                   <?php if(is_denunciante()){ ?>  <?php } else { ?> 
                                                    <div class="form-group col-md-4 m-t-10">
													<fieldset class="form-group position-relative has-icon-left">
                                                        <label>Perfil:</label>
                                                        <select name="perfil" <?php if(!is_superAdmin()){ ?> readonly <?php } ?>class="form-control custom-select" required >
				                                        
                                                  <option value="none" <?=set_select('id_perfil', 'none', true);?> >Escolha o perfil</option>
													 <?php foreach ($perfil as $value) : ?>
																<option <?= $infobasica->id_perfil == $value->codPerfil ? 'selected' : ''; ?><?=set_select('id_perfil', $value->codPerfil) ?> value="<?= $value->codPerfil ?>"><?= $value->papel; ?></option>
															<?php endforeach; ?>
															
															
                                                        </select>
														<div class="form-control-position" style="top:25px">
										            <i class="fa fa-user" aria-hidden="true"></i>
										            </div>
														</fieldset>
														<?= form_error('perfil', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                    <?php } ?>
													
													
                                                    <div class="form-group col-md-4 m-t-10">
													<fieldset class="form-group position-relative has-icon-left">
                                                        <label>Sexo: </label>
                                                        <select name="sexo" id="sexo" class="form-control custom-select" required >
				                                           <option value="none" <?=set_select('sexo', 'none', true);?> >Selecione o sexo</option>
                                 
                                      <option value="Masculino" <?= $infobasica ->sexo == 'Masculino' ? 'selected' : ''; ?> <?= set_select('sexo', 'Masculino'); ?> >Masculino</option>
                                     <option value="Feminino" <?= $infobasica ->sexo == 'Feminino' ? 'selected' : ''; ?> <?= set_select('sexo', 'Feminino'); ?> >Feminino</option>  
                                                        </select>
														<div class="form-control-position" style="top:25px">
										            <i class="fa fa-transgender" aria-hidden="true"></i>
										            </div>
														</fieldset>
													<?= form_error('sexo', '<small class="text-danger pl-3">', '</small>'); ?>

                                                    </div>
                                                    
													
                                                    
                                                    <div class="form-group col-md-4 m-t-10">
													<fieldset class="form-group position-relative has-icon-left">
                                                        <label>Status: </label>
                                                        <select name="status" <?php if(!is_superAdmin()){ ?> readonly <?php } ?> class="form-control custom-select" required >
				                                            <option value="<?php echo $infobasica->status; ?>"><?php echo $infobasica->status; ?></option>
                                                 			<option value="Activo(a)" <?= $infobasica ->status == 'Activo(a)' ? 'selected' : ''; ?> <?= set_select('status', 'Activo(a)'); ?> >Activo(a)</option>
                                                             <option value="Inactivo(a)" <?= $infobasica ->status == 'Inactivo(a)' ? 'selected' : ''; ?> <?= set_select('status', 'Inactivo(a)'); ?> >Inactivo(a)</option>  
                                                        </select>
														<div class="form-control-position" style="top:25px">
									                	<i class="fa fa-exclamation" aria-hidden="true"></i>
										                </div>
													 </fieldset>
													 <?= form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>

                                                    </div>
                                                    				                                    
				                                   
				                              
				                                    <div class="form-group col-md-4 m-t-10">
													<fieldset class="form-group position-relative has-icon-left">
				                                        <label>Cadastro: </label>
				                                        <input type="text" <?php if(!is_superAdmin()){ ?> readonly <?php } ?> id="created_at" name="created_at" class="form-control" value="<?php echo $infobasica->created_at; ?>" placeholder="Data e horas de cadastro"> 
				                                    <div class="form-control-position" style="top:30px">
										            <i class="fa fa-edit" aria-hidden="true"></i>
										             </div>
													</fieldset>
													 <?= form_error('created_at', '<small class="text-danger pl-3">', '</small>'); ?>
													</div>
				                                   
				                                    <div class="form-group col-md-4 m-t-10">
													<fieldset class="form-group position-relative has-icon-left">
				                                        <label>Email: </label>
				                                        <input type="email" id="email" name="email" class="form-control"  value="<?php echo $infobasica->email; ?>" placeholder="email@mail.com" minlength="7" required> 
				                                    <div class="form-control-position" style="top:30px">
										       <i class="fa fa-envelope" aria-hidden="true"></i>
										        </div>
													</fieldset>
													 <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
													</div>

                                                    <div class="form-group col-md-4 m-t-10">
													<fieldset class="form-group position-relative has-icon-left">
                                                        <label><i class="fa fa-map-marker" aria-hidden="true"></i> Morada: </label>
													<select name="provincia" class="form-control custom-select" required>
                                                    <option value="<?php echo $infobasica->cod_prov; ?>"><?php echo $infobasica->nome_provincia; ?></option>
                                                  <option value="none" <?=set_select('cod_prov', 'none', true);?> >Escolha uma prov&iacute;ncia</option>
													 <?php foreach ($provincia as $value) : ?>
																<option <?= $infobasica->cod_prov == $value->id_provincia ? 'selected' : ''; ?><?= set_select('cod_prov', $value->id_provincia) ?> value="<?=  $value->id_provincia ?>"><?=  $value->nome_provincia ?></option>
															<?php endforeach; ?>
													
													</select>
													<div class="form-control-position" style="top:27px">
										            <i class="fa fa-map-marker" aria-hidden="true"></i>
										            </div>
													</fieldset>
													</fieldset>
													 <?= form_error('provincia', '<small class="text-danger pl-3">', '</small>'); ?>
													</div>
													
													
				                                    <div class="form-group col-md-12 m-t-10">
													<fieldset class="form-group position-relative has-icon-left">
                                                    <?php if(!empty($infobasica->avatar)){ ?>
                                                    <img src="<?php echo base_url(); ?>assets/images/users/<?php echo $infobasica->avatar; ?>" class="img-circle" width="150" />
                                                    <?php } else { ?>
                                                    <img src="<?php echo base_url(); ?>assets/images/users/user.png" class="img-circle" width="150" alt="<?php echo $infobasica->nome ?>" title="<?php echo $infobasica->nome; ?>"/>                                   
                                                    <?php } ?>
                                                        <label>Foto/Avatar: </label>
                                                        <input type="file" name="avatar" class="form-control" value=""> 
														</fieldset>
													 <?= form_error('avatar', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                   
				                                    <div class="form-actions col-md-12">
                                                        <input type="hidden" name="user" value="<?php echo $infobasica->id_usuario; ?>">
				                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
				                                        <button  type="button" onclick="location.href='<?php echo base_url();?>dashboard'" class="btn btn-danger"><i class="fa fa-window-close"></i> Cancelar</button>
				                                    </div>
				                                   
				                                </form>
                                                </div>
                                        </div>
				                        </div>
                                    </div>
                                </div>

                                     <!--Segunda Tab - Redes Sociais -->
                                  <div class="tab-pane" id="social" role="tabpanel">
                                    <div class="card-body">
				                                <form class="row" action="Save_Social" method="post" enctype="multipart/form-data">
				                                    <div class="form-group col-md-6 m-t-20">
													<fieldset class="form-group position-relative has-icon-left">
				                                        <label>Facebook:</label>
				                                        <input type="url" class="form-control" name="facebook" value="<?php if(!empty($socialmedia->facebook)) echo $socialmedia->facebook ?>" placeholder="Conta do facebook"> 
				                                    <div class="form-control-position" style="top:27px">
									                	<i class="fa fa-facebook" aria-hidden="true"></i>
										                </div>
													</fieldset>
													 <?= form_error('facebook', '<small class="text-danger pl-3">', '</small>'); ?>
													
													</div>
													
				                                    <div class="form-group col-md-6 m-t-20">
													<fieldset class="form-group position-relative has-icon-left">
				                                        <label>Twitter:</label>
				                                        <input type="text" class="form-control"  name="twitter" value="<?php if(!empty($socialmedia->twitter)) echo $socialmedia->twitter ?>" placeholder="Conta do twitter"> 
				                                    <div class="form-control-position" style="top:27px">
									                	<i class="fa fa-twitter" aria-hidden="true"></i>
										                </div>
													</fieldset>
													 <?= form_error('twitter', '<small class="text-danger pl-3">', '</small>'); ?>
													
													</div>
													
				                                    <div class="form-group col-md-6 m-t-20">
													<fieldset class="form-group position-relative has-icon-left">
				                                        <label>Google +:</label>
				                                        <input type="text" id="" name="google" class="form-control " value="<?php if(!empty($socialmedia->google_plus)) echo $socialmedia->google_plus ?>" placeholder="Conta do google+"> 
				                                    <div class="form-control-position" style="top:27px">
									                	<i class="fa fa-google" aria-hidden="true"></i>
										                </div>
													</fieldset>
													 <?= form_error('google', '<small class="text-danger pl-3">', '</small>'); ?>
													
													</div>
													
				                                    <div class="form-group col-md-6 m-t-20">
													<fieldset class="form-group position-relative has-icon-left">
				                                        <label>Skype:</label>
				                                        <input type="text" id="" name="skype"  class="form-control " value="<?php if(!empty($socialmedia->skype_id)) echo $socialmedia->skype_id ?>" placeholder="Conta do skype"> 
				                                    <div class="form-control-position" style="top:27px">
									                	<i class="fa fa-skype" aria-hidden="true"></i>
										                </div>
													</fieldset>
													 <?= form_error('skype', '<small class="text-danger pl-3">', '</small>'); ?>
													
													
													</div>
				                               
				                                    <div class="form-actions col-md-12">
                                                    <input type="hidden" name="uid" value="<?php echo $infobasica->id_usuario; ?>">                                                   
                                                    <input type="hidden" name="id" value="<?php if(!empty($socialmedia->id)) echo $socialmedia->id ?>">                                                   
				                                        <button type="submit" class="btn btn-success pull-right"> <i class="fa fa-check"></i> Guardar</button>
				                                    </div>
				                                 
				                                </form>
                                    </div>
                                </div>
								

                                 <!--Terceira Tab - Actualizacao de senha do Utilizador-->
                                <div class="tab-pane" id="password" role="tabpanel">
                                    <div class="card-body">
				                                <form class="row" action="Reset_Password" method="post" enctype="multipart/form-data">
				                                    <div class="form-group col-md-6 m-t-20">
													<fieldset class="form-group position-relative has-icon-left">
				                                        <label>Senha antiga:</label>
				                                        <input type="text" class="form-control" name="antiga" value="" placeholder="Senha antiga"  minlength="4" required> 
				                                    <div class="form-control-position" style="top:27px">
									                	<i class="fa fa-key" aria-hidden="true"></i>
										                </div>
													</fieldset>
													 <?= form_error('antiga', '<small class="text-danger pl-3">', '</small>'); ?>
													</div>
													
				                                    <div class="form-group col-md-6 m-t-20">
													<fieldset class="form-group position-relative has-icon-left">
				                                        <label>Nova senha:</label>
				                                        <input type="text" class="form-control" name="nova1" value="" placeholder="Nova senha" minlength="4" required > 
				                                    <div class="form-control-position" style="top:27px">
									                	<i class="fa fa-key" aria-hidden="true"></i>
										                </div>
													</fieldset>
													 <?= form_error('nova1', '<small class="text-danger pl-3">', '</small>'); ?>
													</div>
													
				                                    <div class="form-group col-md-6 m-t-20">
													<fieldset class="form-group position-relative has-icon-left">
				                                        <label>Confirmar senha:</label>
				                                        <input type="text" id="nova2" name="nova2" value="" class="form-control" placeholder="Confirmar nova senha" minlength="4" required > 
				                                    <div class="form-control-position" style="top:27px">
									                	<i class="fa fa-key" aria-hidden="true"></i>
										                </div>
													</fieldset>
													 <?= form_error('nova2', '<small class="text-danger pl-3">', '</small>'); ?>
													</div>
													
				                                    <div class="form-actions col-md-12"> 
                                                    <input type="hidden" name="uid" value="<?php echo $infobasica->id_usuario; ?>">
                      												
				                                        <button type="submit" class="btn btn-success pull-right"> <i class="fa fa-check"></i> Guardar</button>
				                                    </div>
				                                </form>
                                    </div>
                                </div>
                         
                            </div>
                        </div>
                    </div>

                    <!--....... Colunas...............-->
                </div>
                
<!--Efeito para fecho do alerta/ da mensagem-->
<script type="text/javascript">
   $(".alerta").fadeIn('fast').delay(3000).fadeOut('fast').html(response);
     window.setTimeout(function(){location.reload()}, 2000) 
   </script> 