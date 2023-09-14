    <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-building-o"></i> Empresa</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dados da empresa</li>
                    </ol>
                </div>
				
            </div>
			<!--Invocar erros no formulario-->
           <?php echo validation_errors(); ?>
           <?php echo $this->upload->display_errors(); ?>
          

		   <!--Invocar alertas-->
			        <div class="alerta" >
					 <?php echo $this->session->flashdata('formdata'); ?>
                       <?= $this->session->flashdata('mensagem'); ?>
					 </div>
					 
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"> <i class="fa fa-keyboard-o"></i>&nbsp; Dados da empresa</h4>
                            </div>
                            <div class="card-body">
                                <div class="table_body">
								
								<!--Inicio do formulario de adicao/actualizacao de dados da empresa-->
                                    <form  class="row" action="Add_Empresa" id="fileUploadForm"  method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                        <div class="form-group col-md-3 m-t-20 clearfix">
										<fieldset class="form-group position-relative has-icon-left">
                                            <label for="">Carregar logotipo:</label>
                                            <div class="col-md-9">
                                                <div class="file_prev inb">
                                                <?php if($empresa->logotipo){ ?>
                                                    <img src="<?php echo base_url(); ?>assets/images/<?php echo $empresa->logotipo; ?>" height="100" width="167">
                                                    <?php } else { ?>
                                                    <img src="<?php echo base_url(); ?>assets/img/ci-logo.png" height="100" width="167">
                                                <?php } ?>
                                                </div>
                                                <label for="img_url" class="custom-file-upload"><i class="fa fa-camera" aria-hidden="true"></i> Upload do Logo:</label>
                                                <input type="file" value="" class="" id="img_url" name="img_url" aria-describedby="fileHelp">
                                            </div>
											</fieldset>
									<?= form_error('img_url', '<small class="text-danger pl-3">', '</small>'); ?>			

                                        </div>
										
                                        <div class="form-group col-md-3 m-t-20 clearfix">
										<fieldset class="form-group position-relative has-icon-left">

                                            <label for="title" >Nome:</label>
                                            <input type="text" class="form-control" name="nome" value="<?php echo $empresa->nome; ?>" id="nome" placeholder="Nome da empresa..." required minlength="7" maxlength="120">
                                           		</fieldset>
										 <?= form_error('nome', '<small class="text-danger pl-3">', '</small>'); ?>			

                                        </div> 
                   
                                        <div class="form-group col-md-3 m-t-20 clearfix">
										<fieldset class="form-group position-relative has-icon-left">
                                            <label for="nuit">NUIT:</label>
                                           
                                                <input type="text" class="form-control" name="nuit" value="<?php echo $empresa->nuit; ?>" id="nuit" placeholder="N&uacute;mero de NUIT...">
                                            </fieldset>
									<?= form_error('nuit', '<small class="text-danger pl-3">', '</small>'); ?>			

                                        </div>  
                                      
                                        <div class="form-group col-md-3 m-t-20 clearfix">
										<fieldset class="form-group position-relative has-icon-left">
                                            <label for="contacto">Contacto:</label>
                                           
                                                <input type="number" class="form-control" name="contacto" value="<?php echo $empresa->contacto; ?>" id="contacto" placeholder="Contacto da empresa...">
                                          </fieldset>
										  <?= form_error('contacto', '<small class="text-danger pl-3">', '</small>'); ?>			

                                        </div> 
                                      
                                      <div class="form-group col-md-3 m-t-20 clearfix">
									  <fieldset class="form-group position-relative has-icon-left">
                                            <label for="contacto2">Contacto 2:</label>
                                           
                                                <input type="number" class="form-control" name="contacto2" value="<?php echo $empresa->contacto2; ?>" id="contacto2" placeholder="Contacto adicional da empresa...">
                                          </fieldset>
										 <?= form_error('contacto2', '<small class="text-danger pl-3">', '</small>'); ?>			

                                        </div> 
                                                                
                                        <div class="form-group col-md-3 m-t-20 clearfix">
										<fieldset class="form-group position-relative has-icon-left">
                                            <label for="email" >Email:</label>
                                           
                                                <input type="email" class="form-control" name="email" value="<?php echo $empresa->email; ?>" id="email" placeholder="Email da empresa...">
                                          </fieldset>
										 <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>			

                                        </div>  
                                      
                            
                                        <div class="form-group col-md-3 m-t-20 clearfix">
										<fieldset class="form-group position-relative has-icon-left">
                                            <label for="address">Localiza&ccedil;&atilde;o:</label>
                                     
                                                <input type="text" class="form-control" name="cidade" id="cidade" value="<?php echo $empresa->cidade; ?>" placeholder="Cidade/Prov&iacute;ncia...">
                                           </fieldset>
                                        </div>  
                                      
                                        <div class="form-group col-md-3 m-t-20 clearfix">
										<fieldset class="form-group position-relative has-icon-left">
                                            <label for="address">Bairro:</label>
                                            
                                                <input type="text" class="form-control" name="bairro" id="bairro" value="<?php echo $empresa->bairro; ?>" placeholder="Bairro...">
                                         </fieldset>
										<?= form_error('bairro', '<small class="text-danger pl-3">', '</small>'); ?>			

                                        </div>
                                      
                                      <div class="form-group clearfix col-md-3 m-t-20">
									  <fieldset class="form-group position-relative has-icon-left">
                                           <label for="avenida">Avenida:</label>
                                            
                                                <input type="text" class="form-control" name="avenida" value="<?php echo $empresa->avenida; ?>" id="avenida" placeholder="Nome da avenida...">
                                           </fieldset>
										   <?= form_error('avenida', '<small class="text-danger pl-3">', '</small>'); ?>			

                                        </div> 
                                      
                                       <div class="form-group clearfix col-md-3 m-t-20">
									   <fieldset class="form-group position-relative has-icon-left">
                                           <label for="nrcasa">Nr de casa:</label>
                                            
                                                <input type="number" class="form-control" name="nrcasa" value="<?php echo $empresa->nrcasa; ?>" id="nrcasa" placeholder="N&uacute;mero de casa...">
                                           </fieldset>
										<?= form_error('nrcasa', '<small class="text-danger pl-3">', '</small>'); ?>			

                                        </div> 
                                      
                                        <div class="form-group col-md-3 m-t-20 clearfix">
                                            <div class="col-md-9 col-md-offset-3">
                                                <input type="hidden" name="id" value="<?php echo $empresa->id_empresa; ?>"/>
                                                <button type="submit" name="submit" id="btnSubmit" class="btn btn-success">Submeter</button>
                                                <span class="flashmessage"><?php echo $this->session->flashdata('feedback'); ?></span>
                                            </div>
                                        </div>
                                        
                                    </form>
								<!--Fecho do formulario de adicao/actualizacao de dados do site-->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
  
  <!--Efeito para fecho do alerta/ da mensagem-->
<script type="text/javascript">
   $(".alerta").fadeIn('fast').delay(3000).fadeOut('fast').html(response);
     window.setTimeout(function(){location.reload()}, 2000) 
   </script> 