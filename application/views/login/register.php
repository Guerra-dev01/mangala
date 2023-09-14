<?php $this->load->view('login/header'); ?>

				<!-- Coluna aninhada do corpo do cartao (Card Body)-->
				<div class="row " style="overflow-y:auto; padding:0 !important">
				<!--<div class="col-lg-6 d-none d-lg-block" style="left:30px; top:60px;">
						<img src="<?= base_url('assets/images/mangala/logo-mangala8.png'); ?>" class="img-fluid">
					</div>-->
					<div class="col-lg-12">
                        <!--<?php //if (validation_errors()): ?>
                   <div class="alert alert-info">
                   <?php //echo validation_errors(); ?>
                     </div>
                 <?php //endif; ?>-->
				 
				    <!--Invocar alertas-->
			        <div class="alerta" >
                       <?= $this->session->flashdata('mensagem'); ?>
					 </div>
					 
						<div class="p-5">
							<div class="text-center" style="vertical-align:middle">
								<h1 class="h4 text-gray-900 mb-4">Cria&ccedil;&atilde;o de conta</h1>
							</div>
							<hr>
							

							<form class="user" method="POST" action="">
								<div class="form-group">
								<fieldset class="form-group position-relative has-icon-left">

									<input style="padding-left:30px;" value="<?= set_value('nome'); ?>" type="text" class="form-control form-control-user" id="nome" placeholder="Nome Completo (*)" name="nome" >
									<div class="form-control-position">
										<i class="fa fa-user" aria-hidden="true"></i>
										</div>
									  </fieldset>
									  <?= form_error('nome', '<small class="text-danger pl-3">', '</small>'); ?>			

								</div>


								<div class="form-group">
									<input hidden style="padding-left:30px;" value="<?= set_value('codPerfil',1); ?>" type="text" class="form-control form-control-user" id="codPerfil" placeholder="Denunciante" name="codPerfil" >								
							
									<?= form_error('codPerfil', '<small class="text-danger pl-3">', '</small>'); ?>			

								</div>
								
				 <!--Invocar dados da base de dados da provincia para o registo-->
								<?php      
					  $this->load->model('configuracao_model');
					   $provincia =$this->db->get('tblprovincia')->result();
					   
					              ?>

								<div class="form-group row">
									<div class="col-sm-6 mb-3 mb-sm-0">
									<fieldset class="form-group position-relative has-icon-left">
									
														<select   style="padding-left:30px;" name="cod_prov" id="cod_prov" class="custom-select">
															<option  value="" selected disabled>Selecione a sua Prov&iacute;ncia (<span style="color:red">*</span>)</option>
															<?php foreach ($provincia as $value) : ?>
																<option <?= set_select('cod_prov', $value->id_provincia) ?> value="<?=  $value->id_provincia ?>"><?=  $value->nome_provincia ?></option>
															<?php endforeach; ?>											
														</select>
														<div class="form-control-position">
											               <i class="fa fa-map-marker" aria-hidden="true"></i>
											           </div>
											
										  </fieldset>
										  <?= form_error('cod_prov', '<small class="text-danger pl-3">', '</small>'); ?>	
									</div>

									<div class="col-sm-6" >
									<fieldset class="form-group position-relative has-icon-left">

									<input style="padding-left:30px;" value="<?= set_value('usuario'); ?>" type="text" class="form-control form-control-user" id="usuario" placeholder="Nome de Utilizador (*)" name="usuario">
									<div class="form-control-position">
										<i class="fa fa-user" aria-hidden="true"></i>
										</div>
									  </fieldset>
									  <?= form_error('usuario', '<small class="text-danger pl-3">', '</small>'); ?>			
                             </div>
								</div>


								<div class="form-group">
								<fieldset class="form-group position-relative has-icon-left">

									<input style="padding-left:30px;" type="email" class="form-control form-control-user" id="email" placeholder="Email (*)" name="email" value="<?= set_value('email'); ?>">
											
										<div class="form-control-position">
										<i class="fa fa-envelope" aria-hidden="true"></i>
										</div>
									  </fieldset>
									  <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>			
								</div>

								<div class="form-group row">
									<div class="col-sm-6 mb-3 mb-sm-0">
									<fieldset class="form-group position-relative has-icon-left">

										<input style="padding-left:30px;" type="password" class="form-control form-control-user" id="password" placeholder="Senha (*)" name="password">
										<div class="form-control-position">
											<i class="fa fa-key" aria-hidden="true"></i>
											</div>
										  </fieldset>
										 <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>			

									</div>

									<div class="col-sm-6" >
									<fieldset class="form-group position-relative has-icon-left">

										<input  style="padding-left:30px;" type="password" class="form-control form-control-user" id="senha2" placeholder="Repetir Senha (*)" name="senha2">
										<div class="form-control-position">
										
										<i class="fa fa-key" aria-hidden="true"></i>
										</div>
									  </fieldset>
									<?= form_error('senha2', '<small class="text-danger pl-3">', '</small>'); ?>			

									  </div>
								</div>
								

							<hr>

							<div class="form-group row">
								<div class="col-sm-6 mb-3 mb-sm-0" style="padding-left:180px;">
								<fieldset class="form-group position-relative has-icon-left">

								     <button  style="width:200px;" type="submit" class="btn btn-primary btn-user btn-block" name="registar">
											Criar conta
										</button>
								
									  </fieldset>
								</div>
								</form>

								<div class="col-sm-6"  style="float:right">
								<fieldset class="form-group position-relative has-icon-left">

								<a class="small" href="<?= base_url('login'); ?>">J&aacute; possui uma conta? Inicie sess&atilde;o!</a>
									<div class="form-control-position">
									
								  </fieldset></div>
							</div>
							
						</div>
					</div>
				</div>
				</div>
<?php $this->load->view('login/header'); ?>