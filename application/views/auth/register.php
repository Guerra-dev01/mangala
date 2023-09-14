
      <div class="card border-grey border-lighten-3 px-2 py-2 m-0" style="max-height:auto;">
        <div class="card-header border-0">
          <div class="card-title text-center">
            <img src="<?=base_url();?>assets/img/logotipo.png" alt="branding logo">
          </div>
          <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Criar conta</span>
          </h6>
        </div>
        
        <div class="card-content" >
          <div class="card-body">
          <?= $this->session->flashdata('pesan'); ?>
            <?= form_open('', ['class' => 'user']); ?>
            <form class="form-horizontal form-simple" action="<?= base_url('register') ?>">
            <fieldset class="form-group position-relative has-icon-left mb-1" style="top:-30px">
            <input value="<?= set_value('nama'); ?>" type="text" name="nama" class="form-control form-control-user" placeholder="Seu nome">            
                <div class="form-control-position">
                <i class="fa fa-user" aria-hidden="true"></i>
                </div>
                <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
              </fieldset>

              <fieldset class="form-group position-relative has-icon-left mb-1" style="top:-30px">
              <input autofocus="autofocus" autocomplete="off" value="<?= set_value('username'); ?>" type="text" name="username" class="form-control form-control-lg input-lg" placeholder="Nome de Utilizador (Username)">
                <div class="form-control-position">
                <i class="fa fa-user" aria-hidden="true"></i>
                </div>
                <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
              </fieldset>

              <div class="row form-group" >
              
              <div class="col-md-6" style="top:-30px">
              <fieldset class="form-group position-relative has-icon-left">
              <input type="password" name="password" class="form-control form-control-user" placeholder="Senha">
               
                <div class="form-control-position">
                <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
              </fieldset>
             
              </div>
              
              <div class="col-md-6" style="top:-30px">
              <fieldset class="form-group position-relative has-icon-left">
              <input type="password" name="password2" class="form-control form-control-user" placeholder="Repita a senha">     
                <div class="form-control-position">
                <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <?= form_error('password2', '<small class="text-danger">', '</small>'); ?>
              </fieldset>
              </div>
             
              <?= form_error('password2', '<small class="text-danger">', '</small>'); ?>
              </div>
              
              <fieldset class="form-group position-relative has-icon-left mb-1"  style="top:-50px">
              <input value="<?= set_value('email'); ?>" type="text" name="email" class="form-control form-control-user" placeholder="Seu email">         
                <div class="form-control-position">
                  <i class="fa fa-envelope" aria-hidden="true"></i>
                </div>
                <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
              </fieldset>
             
              <fieldset class="form-group position-relative has-icon-left mb-1" style="top:-50px;">
              <input value="<?= set_value('no_telp'); ?>" type="text" name="no_telp" class="form-control form-control-user" placeholder="Seu contacto">             
                <div class="form-control-position">
                <i class="fa fa-phone-square" aria-hidden="true"></i>
                </div>
                <?= form_error('no_telp', '<small class="text-danger">', '</small>'); ?>
              </fieldset>

              <fieldset class="form-group position-relative has-icon-left mb-1" style="top:-50px;">
              <button type="submit" class="btn btn-outline-info btn-block" style="color:black;"><i class="fa fa-unlock" aria-hidden="true"></i> Criar </button>
              </fieldset>
            </form>
            <?= form_close(); ?>
          </div>
          <fieldset class="form-group position-relative has-icon-left mb-1" style="top:-70px;">
          <p class="text-center">J&aacute; tem conta ? <a href="<?= base_url('auth') ?>" class="card-link">Login</a></p>
          </fieldset>
        </div>
      </div>
   