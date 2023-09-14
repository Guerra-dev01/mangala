
<div class="card border-grey border-lighten-3 px-2 py-2 m-0">
    <div class="card-header border-0 pb-0">
      <div class="card-title text-center">
       <img src="<?=base_url();?>assets/img/logotipo.png" alt="branding logo">
      </div>
      <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span> Um email ser&aacute; enviado para redifinir a sua senha</span></h6>
    </div>
    <div class="card-content">
      <div class="card-body">
      <?php $fattr = array('class' => 'form-signin');
         echo form_open(site_url().'auth/forgot/', $fattr); ?>
          <fieldset class="form-group position-relative has-icon-left">
            <input type="email" class="form-control" id="email" name="email" value="<?=set_value('email')?>"placeholder="Seu Email">
            <div class="form-control-position">
            <i class="fa fa-envelope" aria-hidden="true"></i>
            </div>
            <?php echo form_error('email') ?>
          </fieldset>
          <button type="submit" class="btn btn-outline-info btn-lg btn-block" value="submit"><i class="fa fa-unlock" aria-hidden="true"></i> Recuperar
            Senha</button>
       
        <?php form_close(); ?>
      </div>
    </div>
    <div class="card-footer border-0">
      <p class="float-sm-left text-center"><a href="<?= base_url('auth') ?>" class="card-link">Login</a></p>
      <p class="float-sm-right text-center">Novo(a) no SIGEMFUB ? <a href="<?=base_url('register') ?>" class="card-link">Criar
          Conta</a></p>
    </div>
  </div>
