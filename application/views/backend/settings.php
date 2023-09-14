    <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-cogs"></i> Defini&ccedil;&otilde;es</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Defini&ccedil;&otilde;es</li>
                    </ol>
                </div>
            </div>
			
           <?php echo validation_errors(); ?>
           <?php echo $this->upload->display_errors(); ?>
		   
		    <!--Invocar alertas-->
		   <div class="alerta">
           <?php echo $this->session->flashdata('formdata'); ?>
           <?php echo $this->session->flashdata('mensagem'); ?>
		   </div>
		
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"> Defini&ccedil;&otilde;es do sistema</h4>
                            </div>
                            <div class="card-body">
                                <div class="table_body">
								
								<!--Inicio do formulario de adicao/actualizacao de dados do site-->
                                    <form  class="row" action="Add_Settings" id="fileUploadForm"  method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                        <div class="form-group col-md-3 m-t-20 clearfix">
										<fieldset class="form-group position-relative has-icon-left">
                                            <label for="">Carregar logotipo:</label>
                                            <div class="col-md-9">
                                                <div class="file_prev inb">
                                                <?php if($settingsvalue->sitelogo){ ?>
                                                    <img src="<?php echo base_url(); ?>assets/images/<?php echo $settingsvalue->sitelogo; ?>" height="100" width="167">
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
                                            <label for="title" >T&iacute;tulo do Site:</label>
                                           
                                                <input type="text" class="form-control" name="title" value="<?php echo $settingsvalue->sitetitle; ?>" id="title" placeholder="T&iacute;tulo..." required minlength="7" maxlength="120">
                                           </fieldset>
										  <?= form_error('title', '<small class="text-danger pl-3">', '</small>'); ?>

                                        </div> 
                                      
                                      <div class="form-group col-md-3 m-t-20 clearfix">
									  <fieldset class="form-group position-relative has-icon-left">
                                        <label>Descri&ccedil;&atilde;o do Site:</label>
                                          <textarea class="form-control" id="description" value="<?php echo $settingsvalue->description; ?>" name="description" rows="6" required minlength="20" maxlength="512"><?php echo $settingsvalue->description; ?></textarea>
                                       </fieldset>
										  <?= form_error('contact', '<small class="text-danger pl-3">', '</small>'); ?>

									   </div>
                                  
                                      
                                        <div class="form-group col-md-3 m-t-20 clearfix">
										<fieldset class="form-group position-relative has-icon-left">
                                            <label for="copyright">Copyright:</label>
                                           
                                                <input type="text" class="form-control" name="copyright" value="<?php echo $settingsvalue->copyright; ?>" id="copyright" placeholder="Direitos autorais (Copyright)...">
                                            </fieldset>
										  <?= form_error('copyright', '<small class="text-danger pl-3">', '</small>'); ?>

                                        </div>  
                                      
                                        <div class="form-group col-md-3 m-t-20 clearfix">
										<fieldset class="form-group position-relative has-icon-left">
                                            <label for="contact">Contacto:</label>
                                           
                                                <input type="number" class="form-control" name="contact" value="<?php echo $settingsvalue->contact; ?>" id="contact" placeholder="Contacto...">
                                          </fieldset>
										  <?= form_error('contact', '<small class="text-danger pl-3">', '</small>'); ?>

                                        </div> 
                                                                
                                        <div class="form-group col-md-3 m-t-20 clearfix">
										<fieldset class="form-group position-relative has-icon-left">

                                            <label for="currency" >Abreviatura:</label>
                                           
                                                <input type="text" class="form-control" name="currency" value="<?php echo $settingsvalue->currency; ?>" id="currency" placeholder="Abreviatura do pa&iacute;s...">
                                          </fieldset>
										  <?= form_error('currency', '<small class="text-danger pl-3">', '</small>'); ?>

                                        </div>  
                                      
                                        <div class="form-group clearfix col-md-3 m-t-20">
										<fieldset class="form-group position-relative has-icon-left">

                                           <label for="currency">S&iacute;mbolo:</label>
                                            
                                                <input type="text" class="form-control" name="symbol" value="<?php echo $settingsvalue->symbol; ?>" id="symbol" placeholder="S&iacute;mbolo nacional...">
                                           </fieldset>
										   <?= form_error('symbol', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div> 
                                      
                                        <div class="form-group col-md-3 m-t-20 clearfix">
										<fieldset class="form-group position-relative has-icon-left">

                                            <label for="email">Email:</label>
                                            
                                                <input type="text" class="form-control" name="email" id="email" value="<?php echo $settingsvalue->system_email; ?>" placeholder="Email do sistema...">
                                            </fieldset>
											<?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>   
                                      
                                        <div class="form-group col-md-3 m-t-20 clearfix">
										<fieldset class="form-group position-relative has-icon-left">
                                            <label for="address">Endere&ccedil;o:</label>
                                     
                                                <input type="text" class="form-control" name="address" id="address" value="<?php echo $settingsvalue->address; ?>" placeholder="Endere&ccedil;o...">
                                           </fieldset>
										   <?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>  
                                      
                                        <div class="form-group col-md-3 m-t-20 clearfix">
										 <fieldset class="form-group position-relative has-icon-left">
                                            <label for="address2">Outro Endere&ccedil;o:</label>
                                            
                                                <input type="text" class="form-control" name="address2" id="address2" value="<?php echo $settingsvalue->address2; ?>" placeholder="Outro/Novo endere&ccedil;o...">
                                         </fieldset>
										 <?= form_error('address2', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                      
                                        <div class="form-group col-md-3 m-t-20 clearfix">
                                            <div class="col-md-9 col-md-offset-3">
                                                <input type="hidden" name="id" value="<?php echo $settingsvalue->id; ?>"/>
                                                <button type="submit" name="submit" id="btnSubmit" class="btn btn-success"><i class="fa fa-check"></i> Submeter</button>

                                                <span class="flashmessage"><?php echo $this->session->flashdata('feedback'); ?></span>
                                            </div>
                                        </div>
										
										<div class="form-group col-md-3 m-t-20 clearfix">
                                    
									<button  type="button" onclick="location.href='<?php echo base_url();?>dashboard'" class="btn btn-danger"><i class="fa fa-window-close"></i> Cancelar</button>

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
   $(".alerta").fadeIn('fast').delay(5000).fadeOut('fast').html(response);
     window.setTimeout(function(){location.reload()}, 4000) 
   </script> 