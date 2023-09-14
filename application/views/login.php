<?php $this->load->view('login/header'); ?>

<!-- Coluna aninhada no corpo do cartao -->
<div class="row">
    <div class="col-lg-6 d-none d-lg-block" style="left:30px; top:45px;">
        <img src="<?= base_url('assets/images/mangala/logo-mangala8.png'); ?>" class="img-fluid">
    </div>
    <hr>
    <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">In&iacute;cio de Sess&atilde;o</h1>
                <?php if(!empty($this->session->flashdata('feedback'))){ ?>
                <div class="message">
                <?php echo $this->session->flashdata('feedback')?>
                </div>
                <?php }?> 
              
                <!--Invocar alertas-->
			        <div class="alerta" >
                       <?= $this->session->flashdata('mensagem'); ?>
					 </div>
            </div>
            <hr>
            <form class="form-horizontal form-material" method="post" id="loginform" action="login/Login_Auth">
                <div class="form-group">
			    <fieldset class="form-group position-relative has-icon-left">

                <input class="form-control" name="username" value="<?php if(isset($_COOKIE['username'])) { echo $_COOKIE['username']; } ?>" type="text" required placeholder="Email">
                <div class="form-control-position">
				  <i class="fa fa-user" aria-hidden="true"></i>
				   </div>
				</fieldset>
				</div>
				
                <div class="form-group">
				 <fieldset class="form-group position-relative has-icon-left">
                <input class="form-control" name="password" value="<?php if(isset($_COOKIE['password'])) { echo $_COOKIE['password']; } ?>" type="password" required placeholder="Password">
                  <div class="form-control-position">
				  <i class="fa fa-key" aria-hidden="true"></i>
				   </div>
				 </fieldset>
				</div>

                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <div class="custom-control custom-checkbox small">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Lembrar de mim</label>
                        </div>
                    </div>
                    <div class="col-sm-6" >
                    <a class="small" href="<?= base_url('login/forgot'); ?>" style="float:right;">Esqueceu senha?</a>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-login btn-block text-uppercase waves-effect waves-light">
                     <i class="fa fa-unlock" aria-hidden="true"></i> Entrar
                </button>
            </form>
            
            <hr>
            <div class="text-center">
                <a class="small" href="<?= base_url('login/register'); ?>">Crie uma conta!</a>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('login/header'); ?>