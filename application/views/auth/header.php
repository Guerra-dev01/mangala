
  <!DOCTYPE html>
  <!--..................................................
  Login SGB - Sistema de Gestao de Funcionarios Bolseiros
  Author: Aurelio Guerra
  Representing: OasisIT
  Licenca: Oasis IT
 .......................................................-->

  <html class="loading" lang="en" data-textdirection="ltr">

    <!--.................................INICIO: Head.................................................-->
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta name="autor" content="Laissone">
      <title>Tela de login SIGEMFUB</title>

      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">
      
      <!--Estilo Fonte Awesome-->
      <link rel="stylesheet" href="<?=base_url();?>assets/css/font-awesome-4.7.0/css/font-awesome.min.css">
      

      <!-- INICIO: Vendor CSS-->
      <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/vendor/css/vendor.min.css">
      <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/vendor/css/forms/icheck/icheck.css">
      <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/vendor/css/forms/icheck/custom.css">
      <!-- FIM: Vendor CSS-->

      <!-- INICIO: CSS Personalizado -->
      <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/loginBg.css">
      <!-- FECHO: CSS Personalizado-->

    </head>
     <!--..................................FIM: Head......................................................-->

    <!--...............................................INICIO: Body....................................................-->
    <body class="vertical-layout vertical-menu 1-column  bg-full-screen-image blank-page" data-open="click" data-menu="vertical-menu" data-col="1-column">
    <?php
        $arr = $this->session->flashdata(); 
        if(!empty($arr['flash_message'])){
            $html = '<div class="bg-warning container flash-message">';
            $html .= $arr['flash_message']; 
            $html .= '</div>';
            echo $html;
        }
    ?>

    <!--.....................INICIO: Conteudo (Content)................................-->
      <div class="app-content content" style="vertical-align: middle;padding-top: 40px;">
     
        <div class="content-overlay"></div>
        <div class="content-wrapper">
      
          <div class="content-header row">
          
          </div>
          <div class="content-body">
          
            <section class="row flexbox-container">
    <div class="col-12 d-flex align-items-center justify-content-center">
      <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">