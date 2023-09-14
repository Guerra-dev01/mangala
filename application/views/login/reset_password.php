
         <?php $this->load->view('login/header'); ?>

				<!-- Coluna aninhada do corpo do cartao (Card Body)-->
				<div class="row" style="top:-30px; height:455px">
				<div class="col-lg-6 d-none d-lg-block" style="left:30px; top:60px;">
						<!--<img src="<?= base_url('assets/images/mangala/logo-mangala8.png'); ?>" class="img-fluid">-->
					</div>
					     
					<div class="col-lg-12">
					
                        <?php //if (validation_errors()): ?>
						 <!--Invocar alertas-->
			        <div class="alerta" >
                       <?= $this->session->flashdata('mensagem'); ?>
					 </div>
					 
                  <!-- <div class="alerta">
				   
                    <?php //echo validation_errors(); ?>
                     </div>-->
					 
                 <?php // endif; ?>
						<div class="p-5">
							<div class="text-center">
								<h1 class="h4 text-gray-900 mb-4">Redefina a sua senha!</h1>
							   </div>
							   <hr>
							   
							   <!--Inicio do formulario para redifinicao de senha-->
							<?php
                          $fattr = array('class' => 'login');
                             echo form_open(base_url().'login/reset_password/token/'.$token, $fattr); ?>
							 
							 
							 <!--Entrada da nova senha do usuario-->
							<div class="form-group">
							
							
								<fieldset class="form-group position-relative has-icon-left">

                          <input type="password" class="form-control" id="password" name="password" value="<?=set_value('password')?>" placeholder="Nova senha">
									<div class="form-control-position">
										<i class="fa fa-key" aria-hidden="true"></i>
										</div>
									  </fieldset>
									  <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>			

								</div>
	
	                            <div class="form-group">
							
							<!--Confirmacao da nova senha do usuario-->
								<fieldset class="form-group position-relative has-icon-left">

                          <input type="password" class="form-control" id="passconf" name="passconf" value="<?=set_value('passconf')?>" placeholder="Confirmar senha">
									<div class="form-control-position">
										<i class="fa fa-key" aria-hidden="true"></i>
										</div>
									  </fieldset>
									  <?= form_error('passconf', '<small class="text-danger pl-3">', '</small>'); ?>			

								</div>
                          <hr>
							<div class="form-group row">
								<div class="col-sm-6 mb-3 mb-sm-0">
                              

								<fieldset class="form-group position-relative has-icon-left"  style="padding-left: 300px; position:middle">

                         <!--Botao para recuperacao de senha-->
								     <button  style="width:200px; font:16px; background-color:green" type="submit" class="btn btn-primary btn-user btn-block" name="submit">
									 <i class="fa fa-handshake" aria-hidden="true" style="color:#fff" ></i>
											Redefinir senha
										</button>
								
										
										
									  </fieldset>
								</div>
                          </div>
								 
								 <div class="form-group row">
								<div class="col-sm-6 mb-3 mb-sm-0">
								<fieldset class="form-group position-relative has-icon-left" >
                                 
                                 <p class="float-sm-left" > J&aacute; possui uma conta!? Fa&ccedil;a <a href="<?= base_url('login') ?>" class="card-link">Login</a></p>
								</fieldset>
	 
							 </div>
							 <div class="col-sm-6 mb-3 mb-sm-0">
							<p class="float-sm-right" style="float:right">Novo(a) no Mangala ? <a href="<?=base_url('login/register') ?>" class="card-link">Criar

                                     Conta</a></p>
						      </div>
							  </div>
							<?php form_close(); ?>
							<!--Fecho do formulario para redifinicao de senha-->
							
						</div>
					</div>
				</div>
        <?php $this->load->view('login/header'); ?>


