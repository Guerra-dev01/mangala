<div class="row justify-content-center">
    <div class="col-md-12">
    <h5><b><?=$title;?></b></h5>
        <div class="card shadow-sm border-bottom-primary">
        <?=$this->breadcrumbs->show();?>
            <div class="card-header bg-white py-3">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Formul&aacute;rio para actualiza&ccedil;&atilde;o de perfil
                </h4>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open_multipart('', [], ['id_user' => $user['id_user']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="foto">Foto</label>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-3">
                                <img src="<?= base_url() ?>assets/img/avatar/<?= $user['foto']; ?>" alt="<?= $user['nama']; ?>" class="rounded-circle shadow-sm img-thumbnail">
                            </div>
                            <div class="col-9">
                                <input type="file" name="foto" id="foto">
                                <?= form_error('foto', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="username">Username</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-user"></i></span>
                            </div>
                            <input value="<?= set_value('username', $user['username']); ?>" name="username" id="username" type="text" class="form-control" placeholder="Username...">
                        </div>
                        <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <hr>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nama">Nome:</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-user"></i></span>
                            </div>
                            <input value="<?= set_value('nama', $user['nama']); ?>" name="nama" id="nama" type="text" class="form-control" placeholder="Nama Anda...">
                        </div>
                        <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="email">Email:</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-envelope"></i></span>
                            </div>
                            <input value="<?= set_value('email', $user['email']); ?>" name="email" id="email" type="text" class="form-control" placeholder="Email...">
                        </div>
                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="no_telp">Contacto</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-phone"></i></span>
                            </div>
                            <input value="<?= set_value('no_telp', $user['no_telp']); ?>" name="no_telp" id="no_telp" type="number" class="form-control" placeholder="Nomor Telepon...">
                        </div>
                        <?= form_error('no_telp', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <hr>
                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="reset" class="btn btn-danger">Reiniciar</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>