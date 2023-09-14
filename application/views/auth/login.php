<div class="card border-grey border-lighten-3 px-1 py-1 m-0">
  <div class="card-header border-0">
    <div class="card-title text-center">
    <img src="<?=base_url();?>assets/img/logotipo.png" alt="branding logo">
    </div>
  </div>
  <div class="card-content">
            
    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
      <span><b>Fa&ccedil;a Login com dados da sua conta</b>
        </span></p>
    <div class="card-body">
    <?= $this->session->flashdata('pesan'); ?>
      <?= form_open('', ['class' => 'user']); ?>
      <form class="form-horizontal" action="<?=base_url('auth')?>" novalidate>
        <fieldset class="form-group position-relative has-icon-left">
        <input autofocus="autofocus" autocomplete="off" value="<?= set_value('username'); ?>" type="text" name="username" class="form-control form-control-user" placeholder="Usu&aacute;rio">
         <!-- <input type="text" class="form-control" id="user-name" placeholder="Digite seu Email" required>-->
          <div class="form-control-position">
            <i class="fa fa-user" aria-hidden="true"></i>
          </div>
          <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
        </fieldset>
        
        <fieldset class="form-group position-relative has-icon-left">
        <input type="password" name="password" class="form-control form-control-user" placeholder="Senha">
        <!--<input type="password" class="form-control" id="user-password" placeholder="Digite sua senha" required>-->
          <div class="form-control-position">
            <i class="fa fa-key" aria-hidden="true"></i>
          </div>
          <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
        </fieldset>

        <div class="form-group row">
          <div class="col-sm-6 col-12 text-center text-sm-left pr-0">
            <fieldset>
              <input type="checkbox" id="remember-me" class="chk-remember">
              <label for="remember-me"> Lembrar de mim</label>
            </fieldset>
          </div>
          <div class="col-sm-6 col-12 float-sm-left text-center text-sm-right"><a href="<?= base_url('forgot');?>"
              class="card-link">Esqueceu a senha?</a></div>
        </div>
        <button type="submit" class="btn btn-outline-info btn-block" value="submit"><i class="fa fa-unlock" aria-hidden="true"></i>
          Login</button>
      </form>
      <?= form_close(); ?>
    </div>
    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1"><span><b>Novo no Sistema?</b>
        </span></p>
    <div class="card-body">
      <a href="<?= base_url('register') ?>" class="btn btn-outline-danger btn-block"><i class="fa fa-address-card-o" aria-hidden="true"></i>
        Registe-se</a>
    </div>
    
  </div>
</div>