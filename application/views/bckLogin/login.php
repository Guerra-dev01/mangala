<div class="col-lg-4 col-lg-offset-4">
    <h2>Please login</h2>
    <?php $fattr = array('class' => 'form-signin');
         echo form_open(site_url().'main/login/', $fattr); ?>
    <div class="form-group">
      <?php echo form_input(array(
          'name'=>'email', 
          'id'=> 'email', 
          'placeholder'=>'Email', 
          'class'=>'form-control', 
          'value'=> set_value('email'))); ?>
      <?php echo form_error('email') ?>
    </div>
    <div class="form-group">
      <?php echo form_password(array(
          'name'=>'password', 
          'id'=> 'password', 
          'placeholder'=>'Password', 
          'class'=>'form-control', 
          'value'=> set_value('password'))); ?>
      <?php echo form_error('password') ?>
    </div>
    
    <?php echo form_submit(array('value'=>'Entrar', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
    <?php echo form_close(); ?>
    <p>N&atilde;o possui uma conta ? Clique em <a href="<?php echo site_url();?>main/register">Registrar-se</a></p>
    <p>Clique <a href="<?php echo site_url();?>main/forgot">aqu&iacute;</a> se esqueceu a sua senha.</p>
</div>