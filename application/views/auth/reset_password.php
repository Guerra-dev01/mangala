
<div class="card border-grey border-lighten-3 px-2 py-2 m-0">
    <div class="card-header border-0 pb-0">
      <div class="card-title text-center">
       <img src="<?=base_url();?>assets/img/logotipo.png" alt="branding logo">
      </div>
      <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">    
      </h6>
    </div>
    <div class="card-content">
    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
      <span><b>Ol&aacute;<span><?php echo $nama;?>,</span>insira 2x a sua nova senha</b>
        </span></p>
      <div class="card-body">
      <?= $this->session->flashdata('pesan'); ?>
      <?= form_open('', ['class' => 'user']); ?>

      <?php 
          $fattr = array('class' => 'user');
         echo form_open(site_url().'auth/reset_password/token/'.$token, $fattr); ?>

          <fieldset class="form-group position-relative has-icon-left">
            <input type="password" class="form-control" id="password" name="password" value="<?=set_value('password')?>"placeholder="Senha">
            <div class="form-control-position">
            <i class="fa fa-key" aria-hidden="true"></i>
            </div>
            <?= form_error('password', '<small class="text-danger">', '</small>'); ?>

          </fieldset>

          <fieldset class="form-group position-relative has-icon-left">
            <input type="password" class="form-control" id="passconf" name="passconf" value="<?=set_value('passconf')?>"placeholder="Confirmar senha">
            <div class="form-control-position">
            <i class="fa fa-key" aria-hidden="true"></i>
            </div>
            <?= form_error('passconf', '<small class="text-danger">', '</small>'); ?>
          </fieldset>
          <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">    
          </h6>
          <button type="submit" class="btn btn-outline-info btn-lg btn-block" value="submit"><i class="fa fa-unlock" aria-hidden="true"></i> Redefinir senha</button>
       
        <?php form_close(); ?>
      </div>
    </div>
    <div class="card-footer border-0">
      <p class="float-sm-left text-center"><a href="<?= base_url('auth') ?>" class="card-link">Login</a></p>
      <p class="float-sm-right text-center">Novo(a) no SIGEMFUB ? <a href="<?php echo site_url('register');?>" class="card-link">Criar
          Conta</a></p>
    </div>
  </div>
