<style>
.hidden{
display: none;

}
.show{
display: block;

}
</style>

      <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-university" aria-hidden="true"></i> Den&uacute;ncias</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Den&uacute;ncias</li>
                    </ol>
                </div>
            </div>

            <div class="message"></div>
    <?php //$degvalue = $this->employee_model->getdesignation(); ?>
    <?php //$depvalue = $this->employee_model->getdepartment(); ?>
    
            <div class="container-fluid">
                <div class="row m-b-10"> 
                   <!-- <div class="col-12">
                        <button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="<?php echo base_url(); ?>employee/Employees" class="text-white"><i class="" aria-hidden="true"></i>  Lista/a></button>
                        <button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="<?php echo base_url(); ?>employee/Disciplinary" class="text-white"><i class="" aria-hidden="true"></i>  Disciplinary List</a></button>
                    </div>-->
                </div>
               <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"><i class="fa fa-user-o" aria-hidden="true"></i> Nova den&uacute;ncia <span class="pull-right " ></span></h4>
                            </div>
                            <?php echo validation_errors(); ?>
                               <?php echo $this->upload->display_errors(); ?>
                               
                               <?php echo $this->session->flashdata('formdata'); ?>
                               <?php echo $this->session->flashdata('feedback'); ?>
                            <div class="card-body">
                           
                                <form class="row" method="post" action="adicionar" enctype="multipart/form-data">
                                    <div class="form-group col-md-3 m-t-20">
                                    <select name="id_usuario" class="form-control custom-select" required>
                                    <option value="" selected disabled>Utilizador</option>
                                                    
                                       <?php foreach ($user as $value) : ?>
                                            <option <?= set_select('id_usuario', $value->id_usuario) ?> value="<?= $value->id_usuario ?>"><?= $value->nome?></option>
                                        <?php endforeach; ?>
                                    </select>  
                                    </div>

                                <div class="form-group col-md-3 m-t-20">
                                        <!--<label>Categoria </label>-->
                                    <select id="idCatdenucia" name="idCatdenucia" class="form-control custom-select idCatdenucia">
                                    <!--<option value="" selected disabled>Categoria de den&uacute;ncia</option>-->
                                                    
                                                 <!-- <?php //foreach ($dadosdenuncia as $value) : ?>
                                                        <option <?= set_select('idCatdenucia', $value->id_categoria) ?> value="<?= $value->id_categoria ?>"><?= $value->tipo?></option>
                                                        <?php //endforeach; ?>-->
                                <option value="none" <?php set_select('idCatdenucia', 'none', true);?> >Selecione a Categoria</option>
                                 <option value="2" <?php set_select('idCatdenucia', '2');?>>Proprio</option>
                                 <option value="3" <?php set_select('idCatdenucia', '3');?>>Terceiro</option>
                              
                                    </select>                                    
                                </div>
                                
                                    <div class="form-group col-md-3 m-t-20 hidden" id="idTipodenucia">
                                        <!--<label>Employee Code </label>-->
                                        <select  id="idTipodenucia" name="idTipodenucia" class="form-control custom-select">
                                        <option value="" selected disabled>Tipo de den&uacute;ncia</option>
                                                    
                                                        <?php foreach ($tipo as $value) : ?>
                                                            <option <?= set_select('idTipodenucia', $value->id_tipo_denucia) ?> value="<?= $value->id_tipo_denucia ?>"><?= $value->tipo_denucia?></option>
                                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3 m-t-20 hidden" id="cod_prov">
                                        <!--<label>Department</label>-->
                                        <select id="cod_prov" name="cod_prov" id="cod_prov"  value="" class="form-control custom-select">
                                           <option value="" selected disabled>Selecione a sua localiza&ccedil;&atilde;o</option>                                     
                                                    <?php foreach ($provincia as $value) : ?>
                                                        <option <?= set_select('cod_prov', $value->id_provincia) ?> value="<?= $value->id_provincia ?>"><?= $value->nome_provincia?></option>
                                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                  
                                     <div class="form-group col-md-3 m-t-20 hidden" id="localizacao">
                                        <!--<label>First Name</label>-->
                                        <input type="text" id="localizacao" name="localizacao" class="form-control form-control-line" placeholder="Local de ocorr&ecirc;ncia"> 
                                    </div>

                                    <div class="form-group col-md-3 m-t-20 hidden" id="cod_cid">
                                        <!--<label>Designation </label>-->
                                        <select id="cod_cid" name="cod_cid" value="" class="form-control custom-select">
                                           <option value="cod_cid" selected disabled>Selecione o distrito</option>                                     
                                                    <?php foreach ($distrito as $value) : ?>
                                                        <option <?= set_select('cod_cid', $value->id_distrito) ?> value="<?= $value->id_distrito ?>"><?= $value->nome_distrito?></option>
                                                        <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <?php //if (Terceiro()):?>
                                    <div class="form-group col-md-3 m-t-20 hidden" id="sexo">
                                    <select id="sexo" name="sexo" style="color:gray;">
                                 <option value="none" <?=set_select('sexo', 'none', true);?> >Selecione o seu sexo</option>
                                 <option value="Masculino" <?=set_select('sexo', 'Masculino');?>>Masculino</option>
                                 <option value="Feminino" <?=set_select('sexo', 'Feminino');?> >Feminino</option>
                                   </select>
                                   </div>

                                    <div class="form-group col-md-3 m-t-20 hidden" id="nome">
                                        <!--<label>First Name</label>-->
                                        <input type="text" id="nome" name="nome" class="form-control form-control-line" placeholder="Nome do denunciante"> 
                                    </div>

                                    
                                   <div class="form-group col-md-3 m-t-20 hidden" id="ano_nascimento">
                                        <!--<label>First Name</label>-->
                                        <input type="number" id="ano_nascimento" name="ano_nascimento" class="form-control form-control-line" placeholder="Idade do denunciante"> 
                                    </div>

                                   <div class="form-group col-md-3 m-t-20 hidden" id="contacto">
                                        <!--<label>First Name</label>-->
                                        <input type="number" name="contacto" class="form-control form-control-line" placeholder="Contacto do denunciante"> 
                                    </div>
                                    <?php //endif; ?>

                                    <div class="form-group col-md-4 m-t-20 hidden" id="assunto" >
                                        <!--<label>Role </label>-->
                                        <input type="text" id="assunto" name="assunto" class="form-control form-control-line" placeholder="Assunto" > 
                                    </div>
                                    

                                    <div class="form-group col-md-5 m-t-20 hidden" id="descricao">
                                        <label>Descri&ccedil;&atilde;o da den&uacute;ncia:</label>
                                        <textarea type="text" id="descricao" name="descricao" class="form-control form-control-line" placeholder="Descri&ccedil;&atilde;o da den&uacute;ncia" rows="4" cols="50"> </textarea>

                                    </div>

                                    <div class="form-group col-md-5 m-t-20 hidden" id="imagem">
                                        <label>Prova(s): </label>
                                        <input multiple="" type="file" name="imagem" id="imagem" class="form-control" value=""> 
                                    </div>
                                    
                                    

                                    <div class="form-actions col-md-12 hidden" id="botoes">
                                           <input type="hidden" name="id_denucias" id="id_denucias" value="" class="form-control">                                       
                                        <button type="submit" name="submeter" class="btn btn-success"> <i class="fa fa-check"></i> Submeter</button>
                                        <button onclick="location.href='<?php echo base_url();?>denuncia/Denuncia'" type="button" name="cancelar" class="btn btn-danger">Cancelar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
<script>
                $('.idCatdenucia').change(function(){
        var responseID = $(this).val();
        if(responseID =="2"){
            $('#cod_prov').removeClass("hidden");
            $('#cod_prov').addClass("show");
            $('#idTipodenucia').removeClass("hidden");
            $('#idTipodenucia').addClass("show");
            $('#cod_cid').removeClass("hidden");
            $('#cod_cid').addClass("show");
            $('#localizacao').removeClass("hidden");
            $('#localizacao').addClass("show");
            $('#assunto').removeClass("hidden");
            $('#assunto').addClass("show");
            $('#descricao').removeClass("hidden");
            $('#descricao').addClass("show");
            $('#imagem').removeClass("hidden");
            $('#imagem').addClass("show");
            $('#sexo').removeClass("show");
            $('#sexo').addClass("hidden");
            $('#idade').removeClass("show");
            $('#idade').addClass("hidden");
            $('#contacto').removeClass("show");
            $('#contacto').addClass("hidden");
            $('#nome').removeClass("show");
            $('#nome').addClass("hidden");
            $('#botoes').removeClass("hidden");
            $('#botoes').addClass("show");
        } 
        else if(responseID =="3"){
            $('#cod_prov').removeClass("hidden");
            $('#cod_prov').addClass("show");
            $('#cod_cid').removeClass("hidden");
            $('#cod_cid').addClass("show");
            $('#idTipodenucia').removeClass("hidden");
            $('#idTipodenucia').addClass("show");
            $('#localizacao').removeClass("hidden");
            $('#localizacao').addClass("show");
            $('#assunto').removeClass("hidden");
            $('#assunto').addClass("show");
            $('#descricao').removeClass("hidden");
            $('#descricao').addClass("show");
            $('#imagem').removeClass("hidden");
            $('#imagem').addClass("show");
            $('#sexo').removeClass("hidden");
            $('#sexo').addClass("show");
            $('#idade').removeClass("hidden");
            $('#idade').addClass("show");
            $('#contacto').removeClass("hidden");
            $('#contacto').addClass("show");
            $('#nome').removeClass("hidden");
            $('#nome').addClass("show");
            $('#botoes').removeClass("hidden");
            $('#botoes').addClass("show");
        }
        
        else{
            $('#cod_prov').removeClass("show");
            $('#cod_prov').addClass("hidden");
            $('#idTipodenucia').removeClass("show");
            $('#idTipodenucia').addClass("hidden");
            $('#localizacao').removeClass("show");
            $('#localizacao').addClass("hidden");
            $('#assunto').removeClass("show");
            $('#assunto').addClass("hidden");
            $('#descricao').removeClass("show");
            $('#descricao').addClass("hidden");
            $('#imagem').removeClass("show");
            $('#imagem').addClass("hidden");
            $('#sexo').removeClass("show");
            $('#sexo').addClass("hidden");
            $('#idade').removeClass("show");
            $('#idade').addClass("hidden");
            $('#contacto').removeClass("show");
            $('#contacto').addClass("hidden");
            $('#nome').removeClass("show");
            $('#nome').addClass("hidden");
            $('#botoes').removeClass("show");
            $('#botoes').addClass("hidden");
        }
        console.log(responseID);
    });
    </script>