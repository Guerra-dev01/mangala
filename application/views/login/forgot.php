
         <?php $this->load->view('login/header'); ?>

				<!-- Coluna aninhada do corpo do cartao (Card Body)-->
				<div class="row" style="top:-30px; height:413px">
                  
				<!--<div class="col-lg-6 d-none d-lg-block" style="left:30px; top:60px;">
						<!--<img src="<?php //base_url('assets/images/mangala/logo-mangala8.png'); ?>" class="img-fluid">-->
                        <!--<img src="<?php echo base_url();?>assets/images/mangala/logo3.png" alt="Mangala" class="dark-logo" style="width:50px;"/>-->

					<!--</div>-->
					     
					<div class="col-lg-12">
                        
						 <!--Invocar alertas-->
			        <div class="alerta" >
                       <?= $this->session->flashdata('mensagem'); ?>
					 </div>

               <?php //if (validation_errors()): ?>
                  <!-- <div class="alert">
				   
                    <?php //echo validation_errors(); ?>
                     </div>-->
					 
                 <?php //endif; ?>
						<div class="p-5">
                         
							<div class="text-center">
                      <div>                        
                    <img src="<?php echo base_url();?>assets/images/mangala/logo3.png" alt="Mangala" class="dark-logo" style="width:50px;"/>
                      </div>

								<h1 class="h5 text-gray-900 mb-4">Esqueceu a senha? Redefina a sua senha!</h1>
							   </div>
							   <hr>
							   <br>
							   <!--Inicio do formulario para recuperacao de senha-->
							<?php $fattr = array('class' => 'form-signin');
                             echo form_open(base_url().'login/forgot/', $fattr); ?>
							<div class="form-group">
							
							<!--Entrada do email/username do usuario-->
								<fieldset class="form-group position-relative has-icon-left">

									<input style="padding-left:30px; " value="<?= set_value('username'); ?>" type="text" class="form-control form-control-user" id="username" name="username" placeholder=" Insira o seu email" >
									<div class="form-control-position">
										<i class="fa fa-envelope" aria-hidden="true"></i>
										</div>
									  </fieldset>
									  <?php echo form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>			

								</div>
	
							<div class="form-group row">
								<div class="col-sm-6 mb-3 mb-sm-0" >
								<fieldset class="form-group position-relative has-icon-left" style="padding-left: 300px; position:middle">

                               <!--Botao para recuperacao de senha-->
								     <button  style="width:200px; background-color: green;" type="submit" class="btn btn-primary btn-user btn-block" name="submit">
											<i class="fa fa-handshake" aria-hidden="true" style="color:#fff" ></i>
											Recuperar senha
										</button>
										
									 </fieldset>
								</div>
								</div>
								
								<hr>
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
							<!--Fecho do formulario para recuperacao de senha-->
							
						</div>
					</div>
				</div>
        <?php $this->load->view('login/header'); ?>


