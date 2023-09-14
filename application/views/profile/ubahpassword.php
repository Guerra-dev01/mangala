<div class="row justify-content-center">
    <div class="col-md-12">
    <h5><b><?=$title;?></b></h5>
        <div class="card shadow-sm border-bottom-primary">
        <?=$this->breadcrumbs->show();?>
            <div class="card-header bg-white py-3">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Formul&aacute;rio para altera&ccedil;&atilde;o de senha
                </h4>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open(); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="password_lama">Senha actual</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('password_lama'); ?>" name="password_lama" id="password_lama" type="password" class="form-control" placeholder="Senha actual">
                        <?= form_error('password_lama', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <hr>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="password_baru">Nova senha</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('password_baru'); ?>" name="password_baru" id="password_baru" type="password" class="form-control" placeholder="Nova senha">
                        <?= form_error('password_baru', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="konfirmasi_password">Confirmar senha</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('konfirmasi_password'); ?>" name="konfirmasi_password" id="konfirmasi_password" type="password" class="form-control" placeholder="Confirmar a nova senha">
                        <?= form_error('konfirmasi_password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Alterar</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>