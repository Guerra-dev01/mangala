    <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-cogs"></i> Empresa</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dados da empresa</li>
                    </ol>
                </div>
            </div>
           <?php echo validation_errors(); ?>
           <?php echo $this->upload->display_errors(); ?>
           <?php echo $this->session->flashdata('formdata'); ?>
           <?php echo $this->session->flashdata('feedback'); ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"> Dados da empresa</h4>
                            </div>
                            <div class="card-body">
                                <div class="table_body">
                                    <form  class="row" action="actualizar" id="fileUploadForm"  method="post" enctype="multipart/form-data" accept-charset="utf-8">
     
                                            <div class="row">
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
                                
                                    <div class="form-group col-md-3 m-t-20" id="idTipodenucia">
                                        <!--<label>Employee Code </label>-->
                                        <select  id="idTipodenucia" name="idTipodenucia" class="form-control custom-select">
                                        <option value="" selected disabled>Tipo de den&uacute;ncia</option>
                                                    
                                                        <?php foreach ($tipo as $value) : ?>
                                                            <option <?= set_select('idTipodenucia', $value->id_tipo_denucia) ?> value="<?= $value->id_tipo_denucia ?>"><?= $value->tipo_denucia?></option>
                                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3 m-t-20" id="cod_prov">
                                        <!--<label>Department</label>-->
                                        <select id="cod_prov" name="cod_prov" id="cod_prov"  value="" class="form-control custom-select">
                                           <option value="" selected disabled>Selecione a sua localiza&ccedil;&atilde;o</option>                                     
                                                    <?php foreach ($provincia as $value) : ?>
                                                        <option <?= set_select('cod_prov', $value->id_provincia) ?> value="<?= $value->id_provincia ?>"><?= $value->nome_provincia?></option>
                                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                  
                                     <div class="form-group col-md-3 m-t-20" id="localizacao">
                                        <!--<label>First Name</label>-->
                                        <input type="text" id="localizacao" name="localizacao" class="form-control form-control-line" placeholder="Local de ocorr&ecirc;ncia"> 
                                    </div>

                                    <div class="form-group col-md-3 m-t-20" id="cod_cid">
                                        <!--<label>Designation </label>-->
                                        <select id="cod_cid" name="cod_cid" value="" class="form-control custom-select">
                                           <option value="cod_cid" selected disabled>Selecione o distrito</option>                                     
                                                    <?php foreach ($distrito as $value) : ?>
                                                        <option <?= set_select('cod_cid', $value->id_distrito) ?> value="<?= $value->id_distrito ?>"><?= $value->nome_distrito?></option>
                                                        <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <?php //if (Terceiro()):?>
                                    <div class="form-group col-md-3 m-t-20" id="sexo">
                                    <select id="sexo" name="sexo" style="color:gray;">
                                 <option value="none" <?=set_select('sexo', 'none', true);?> >Selecione o seu sexo</option>
                                 <option value="Masculino" <?=set_select('sexo', 'Masculino');?>>Masculino</option>
                                 <option value="Feminino" <?=set_select('sexo', 'Feminino');?> >Feminino</option>
                                   </select>
                                   </div>

                                    <div class="form-group col-md-3 m-t-20" id="nome">
                                        <!--<label>First Name</label>-->
                                        <input type="text" id="nome" name="nome" class="form-control form-control-line" placeholder="Nome do denunciante"> 
                                    </div>

                                    
                                   <div class="form-group col-md-3 m-t-20" id="ano_nascimento">
                                        <!--<label>First Name</label>-->
                                        <input type="number" id="ano_nascimento" name="ano_nascimento" class="form-control form-control-line" placeholder="Idade do denunciante"> 
                                    </div>

                                   <div class="form-group col-md-3 m-t-20" id="contacto">
                                        <!--<label>First Name</label>-->
                                        <input type="number" name="contacto" class="form-control form-control-line" placeholder="Contacto do denunciante"> 
                                    </div>
                                    <?php //endif; ?>

                                    <div class="form-group col-md-4 m-t-20" id="assunto" >
                                        <!--<label>Role </label>-->
                                        <input type="text" id="assunto" name="assunto" class="form-control form-control-line" placeholder="Assunto" > 
                                    </div>
                                    

                                    <div class="form-group col-md-5 m-t-20" id="descricao">
                                        <label>Descri&ccedil;&atilde;o da den&uacute;ncia:</label>
                                        <textarea type="text" id="descricao" name="descricao" class="form-control form-control-line" placeholder="Descri&ccedil;&atilde;o da den&uacute;ncia" rows="4" cols="50"> </textarea>

                                    </div>

                                    <div class="form-group col-md-5 m-t-20" id="imagem">
                                        <label>Prova(s): </label>
                                        <input multiple="" type="file" name="imagem" id="imagem" class="form-control" value=""> 
                                          </div>                                 
                                                                                
                                        
                                    </div>
                                      
                                        <div class="form-group col-md-3 m-t-20 clearfix">
                                            <div class="col-md-9 col-md-offset-3">
                                                <input type="hidden" name="id" value="<?php echo $empresa->id_empresa; ?>"/>
                                                <button type="submit" name="submit" id="btnSubmit" class="btn btn-success">Submeter</button>
                                                <span class="flashmessage"><?php echo $this->session->flashdata('feedback'); ?></span>
                                            </div>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
  
<