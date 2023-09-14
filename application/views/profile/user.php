
<div class="row justify-content-center">
<div class="col-md-12" >
<h5><b><?=$title;?></b></h5>
<div class="card p-2 shadow-sm border-bottom-primary">
<?=$this->breadcrumbs->show();?>
<?= $this->session->flashdata('pesan'); ?>
    <div class="card-header bg-white">
    
        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
            Perfil <?= userdata('role');?>
        </h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2 mb-4 mb-md-0">
                <img src="<?= base_url() ?>assets/img/avatar/<?= userdata('foto'); ?>" alt="" class="img-thumbnail rounded mb-2">
                <a href="<?= base_url('profile/setting'); ?>" class="btn btn-sm btn-block btn-primary"><i class="fa fa-edit"></i> Editar perfil</a>
                <a href="<?= base_url('profile/ubahpassword'); ?>" class="btn btn-sm btn-block btn-primary"><i class="fa fa-lock"></i> Alterar senha</a>
            </div>
            <div class="col-md-10">
                <table class="table">
                    <tr>
                        <th width="200">Username:</th>
                        <td><?= userdata('username'); ?></td>
                    </tr>
                    <tr>
                        <th width="200">Nome:</th>
                        <td><?= userdata('nama'); ?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><?= userdata('email'); ?></td>
                    </tr>
                    <tr>
                        <th>Contacto:</th>
                        <td><?= userdata('no_telp'); ?></td>
                    </tr>
                    <tr>
                        <th>Papel:</th>
                        <td class="text-capitalize"><?php if(userdata('role') =='Admin') { echo "Administrador(a)";} else if (userdata('role') =='Tec. Administrativo(a)') {echo "T&eacute;cnico Administrativo";} else{echo 'Funcion&aacute;rio(a)';} ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>