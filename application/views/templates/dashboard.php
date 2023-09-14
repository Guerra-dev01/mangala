<!DOCTYPE html>
<html lang="en">
<?php
setlocale(LC_TIME, 'pt', 'portuguese');

date_default_timezone_set('Africa/Harare');
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	
    <!--Responsividade da tela -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="ReStart">


    <!-- Icone Favicon-->
    <?php $settingsvalue = $this->settings_model->GetSettingsValue(); ?>
    <link rel="icon" type="image/ico" sizes="16x16" href="<?php echo base_url(); ?>assets/images/favicn.ico">
    <title><?php echo $settingsvalue->sitetitle; ?></title>
    
   <!--Estilo para formularios-->
    <link href="<?= base_url('assets/'); ?>css/form.css" rel="stylesheet" type="text/css">

	<!-- Estilo botao para deslizar a pagina para cima -->
    <link href="#<?php echo base_url(); ?>assets/css/scrolltotop.css" rel="stylesheet">
	
		<!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Estilo para datatables -->
    <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet">
	 <link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet">
	
	
	<!--Fontes de Icones "Material Design"-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/2.0.46/css/materialdesignicons.min.css" rel="stylesheet">
    
	<!-- Morris CSS -->
	<link href="<?php echo base_url(); ?>assets/plugins/morrisjs/morris.css" rel="stylesheet">
   
   <!-- CSS Personalizado-->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>assets/css/print.css" rel="stylesheet" media='print'>
	
	<!--Estilo para alertas com toastr-->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

	
    <!-- Estilos para temas de cores -->
    <link href="<?php echo base_url(); ?>assets/css/colors/blue.css" id="theme" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
   
   <!-- Estilos para plugins de Datas (DaterangePicker) -->
    <link href="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
     <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <link href="<?php echo base_url(); ?>assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />   
    <link href="<?php echo base_url(); ?>assets/plugins/calendar/dist/fullcalendar.css" rel="stylesheet" type="text/css" />   
</head>

<body class="fix-header fix-sidebar card-no-border">
<!-- Invocacao da funcao para retornar o Utilizador em sessao e a data-->
        <?php 
            $id = $this->session->userdata('user_login_id');
           $infobasica = $this->user_model->GetBasic($id); 
           $data['logs']=$this->rat_model->listar_logs();
		  // $data['logs']=$logs;
            $year =  date('y');
            $y = substr( $year, -2);
            $date = date("m/d/$y");
    
        ?>
		
	<!--Preloader de paginas-->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
	
	<!--Inicio do embrulho da pagina principal-->
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header" style="background: rgb(0,0,0); background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(79,6,101,1) 0%, rgba(174,17,20,1) 100%);">
                    <a class="navbar-brand" href="<?php echo base_url(); ?>"  style="padding-top:10px;">
                    <b>
                        <img src="<?php echo base_url();?>assets/images/mangala/logo3.png" alt="Mangala" class="dark-logo" style="width:50px;"/>
                        </b>
                        <!-- Logo text -->
                        <!--<span>
                         <img src="<?php echo base_url(); ?>assets/images/<?php echo $settingsvalue->sitelogo; ?>" alt="Mangala" class="dark-logo" height="60px" width="100px" />-->
                         <!--<strong> Mangala </strong>-->
                        <!-- </span>--> </a>
                </div>

 <!--Inicio da barra de navegacao superior expansivo-->
<div class="navbar-collapse">


            <ul class="navbar-nav mr-auto mt-md-0">
                <!-- Notificacoes  -->
                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                <?php if(is_superAdmin()):?>
				<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell"></i>
                        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                    </a>
					
			
                    <div class="dropdown-menu mailbox scale-up-left">
                        <ul>
                            <li>
                                <div class="drop-title">Notifica&ccedil;&otilde;es</div>
                            </li>
                               <li>
                                <div class="message-center">
                                    <!-- Mensagens de logs -->
                                   <?php $no=1; foreach($logs as $l): ?>
                                   <a href="#">
                                        <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                        <div class="mail-contnet">
                                            <h5><?php echo $no++ ?>-<?php echo $l['nome']; ?></h5> <span class="mail-desc"><?php echo $l['message']; ?></span> <span class="time"><?php echo $l['date_time']; ?></span> </div>
                                    </a>
                                    <?php endforeach; ?>
                                </div>
                                </li>
                            <li>
                                <a href="<?php echo base_url(); ?>rat/Listar_logs" class="nav-link text-center" href="javascript:void(0);"> <strong>Ver todas as notifica&ccedil;&otilde;es</strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                    </div>
					
                </li>
				<?php endif; ?>
            </ul>
			
			<!--Info do user em sessao-->
            <ul class="navbar-nav my-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url(); ?>assets/images/users/user.png" alt="Genit" class="profile-pic" style="height:40px;width:40px;border-radius:50px" /></a>
                    <div class="dropdown-menu dropdown-menu-right scale-up">
                        <ul class="dropdown-user">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img"><img src="<?php echo base_url(); ?>assets/images/users/user.png" alt="user"></div>
                                    <div class="u-text">
                                        <h4><?php echo $infobasica->nome; ?></h4>
                                        <p class="text-muted"><?php  echo $infobasica->username;?></p>
                                     </div>
									 </div>

                            </li>

                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo base_url(); ?>user/view?I=<?php echo base64_encode($infobasica->id_usuario); ?>"><i class="ti-user"></i> Meu Perfil</a></li>
                            <?php if(is_superAdmin()): ?>
                                    
                            <li><a href="<?php echo base_url(); ?>settings/Settings"><i class="ti-settings"></i> Defini&ccedil;&atilde;o do sistema</a></li> 
                            <li><a href="<?php echo base_url(); ?>rat/Listar_logs"><i class="fa fa-file"></i> Logs de actividades</a></li>
							
							<?php endif; ?>
                            <li><a href="#<?php echo base_url(); ?>login/logout" data-toggle="modal" data-target="#logoutModal"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
						 
                    </div>
                </li>
            </ul>
        </div>
		<!--Fecho da barra de navegacao expansiva-->
    </nav>
</header>


<!--..................... Menu lateral...........................-->

<aside class="left-sidebar" style="background: rgb(0,0,0);
    background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(79,6,101,1) 0%, rgba(174,17,20,1) 100%);">
	
    <!-- Inicio do scroll do Sidebar-->
    <div class="scroll-sidebar">
	
        <!-- Perfil do Utiliador -->
                <?php 
                $id = $this->session->userdata('user_login_id');
                $infobasica = $this->user_model->GetBasic($id); 
                ?>                
                
        <!-- Fecho do texto do perfil do Utilizador-->
       
	   <!-- Inicio da navegacao do Sidebar-->
        <nav class="sidebar-nav" style="background: rgb(0,0,0); background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(79,6,101,1) 0%, rgba(174,17,20,1) 100%);" >
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
				   
                <li> <a href="<?php echo base_url(); ?>"><i class="mdi mdi-gauge" style="color:#1976d2"></i><span class="hide-menu">Dashboard </span></a></li>
				
			
						 
       <?php if (is_superAdmin()): ?>						
              <li> <a href="<?php echo base_url()?>user/User"><i class="mdi mdi-account-multiple" style="color:#1976d2"></i><span class="hide-menu">Utilizadores <span class="hide-menu"></a></li>
       <?php endif; ?>
	   
	    <?php if (!is_superAdmin()): ?>						
       <li>   <a href="<?php echo base_url(); ?>user/view?I=<?php echo base64_encode($infobasica->id_usuario); ?>"><i class="ti-user" style="color:#1976d2"></i> <span class="hide-menu">Meu Perfil<span class="hide-menu"></a></li>
       <?php endif; ?>
	   
                         
                  <?php if (!is_denunciante()): ?>
                <li> <a href="<?php echo base_url();?>denuncia/Denuncia"><i class="fa fa-bullhorn" style="color:#1976d2"></i><span class="hide-menu">Den&uacute;ncias <span class="hide-menu"></a></li>
				<?php endif; ?> 
		 <?php if (is_denunciante()): ?>	
				 <li> <a href="<?php echo base_url();?>denuncia/Denuncia"><i class="fa fa-bullhorn" style="color:#1976d2"></i><span class="hide-menu">Minhas Den&uacute;ncias <span class="hide-menu"></a></li>
         <?php endif; ?> 
              
                     
        <?php if (is_superAdmin()): ?>					 
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-settings" style="color:#1976d2"></i><span class="hide-menu">Configura&ccedil;&otilde;es</span></a>
                    <ul aria-expanded="false" class="collapse" style="background: rgb(0,0,0); background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(79,6,101,1) 0%, rgba(174,17,20,1) 100%);">
                        <li><a href="<?php echo base_url(); ?>configuracao/Perfil" > <i class="mdi mdi-account-box"></i> Perfil</a></li>
                        <li><a href="<?php echo base_url(); ?>configuracao/Provincia" > <i class="mdi mdi-map-marker-radius" ></i> Prov&iacute;ncias</a></li>
                        <li><a href="<?php echo base_url(); ?>configuracao/Distrito" > <i class="mdi mdi-map-marker"></i> Distritos </a></li>
                        <li><a href="<?php echo base_url(); ?>configuracao/TipoDenuncia"> <i class="fa fa-bullhorn"></i> Tipos de den&uacute;ncias </a></li>
                        <li><a href="<?php echo base_url(); ?>empresa/Empresa" > <i class="mdi mdi-home-modern"></i> Dados da empresa </a></li>
                    </ul>
                </li>
        <?php endif; ?>        
                <li> <a href="<?php echo base_url()?>sobre/Sobre" ><i class="mdi mdi-information"  style="color:#1976d2"></i><span class="hide-menu">Sobre <span class="hide-menu"></a></li>
                        
            </ul>
        </nav>
        <!-- Fecho da navegacao do Sidebar -->
    </div>
	
    <!-- Fecho do Scroll do Sidebar-->
</aside>

<!--.....................Area de conteudo..................................-->
<?=$contents; ?>


<!--...........................Area Inferior...............................-->

</div>

<!--Fecho do embrulho da pagina principal-->

<!--Inicio do rodape (footer) -->
            <footer class="footer">Mangala © <?php echo date('Y')?> | Desenvolvido(a) por OASIS IT </footer>
<!--Fecho do rodape-->
        </div>

    </div>

<!-- Botao pra  subir a pagina-->
   <button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top">
  <i class="fa fa-arrow-up"></i>
   </button>

    <!-- Inicio Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deseja mesmo encerrar esta sess&atilde;o?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">Clique em "Logout" para encerrar a sess&atilde;o</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-danger" href="<?= base_url(); ?>login/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Fecho do Logout Modal-->

<!------------------------------------- SCRIPTS/ JAVASCRIPT--------------------------------------------------------------->


    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>

    <?php if ($this->uri->segment(1) == 'dashboard') : ?>


<!-- Chart js (Graficos)-->
<!--<script src="<?=base_url();?>assets/js/loader.js_0.1.2/loader.js" ></script>-->
<script src="<?= base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>-->

<!--Tradutor de dados chart.js-->
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>


<!--Script para botao para deslizar a pagina para cima-->
<script type="text/javascript">
let mybutton = document.getElementById("btn-back-to-top");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
scrollFunction();
};

function scrollFunction() {
if (
document.body.scrollTop > 20 ||
document.documentElement.scrollTop > 20
) {
mybutton.style.display = "block";
} else {
mybutton.style.display = "none";
}
}
// When the user clicks on the button, scroll to the top of the document
mybutton.addEventListener("click", backToTop);

function backToTop() {
document.body.scrollTop = 0;
document.documentElement.scrollTop = 0;
}
</script>

<script>
$(function() {
            $('.date').datepicker({
                uiLibrary: 'bootstrap4',
                format: 'yyyy-mm-dd'
            });
        });
		
  // === Denuncias por provincia===
  const labels = <?php echo json_encode($prov); ?>;
  const data = {
    labels: labels,
    datasets: [{
      label: 'Denúncias registadas',
      data: <?php echo json_encode($totalp);?>,
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(201, 203, 207, 0.2)'
      ],
      borderColor: [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)'
      ],
      borderWidth: 1
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {
      scales: {
        
        y: {
          beginAtZero: true
        }
      }
    },
  };

  var myChart1 = new Chart(
    document.getElementById('myChart1'),
    config
  );
</script>


<script>
  // === Denuncias por mes ===
  //import "moment-with-locales.min.js";
  //moment.locale('pt-BR');


  const labels1 =<?php echo json_encode($mes); ?>;
  const data1 = {
    labels: labels1,
    datasets: [{
      label: 'Denúncias registadas',
      data: <?php echo json_encode($total); ?>,
      backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
       'rgba(255, 159, 64, 0.2)',
       'rgba(255, 205, 86, 0.2)',
       'rgba(75, 192, 192, 0.2)',
       'rgba(54, 162, 235, 0.2)',
       'rgba(153, 102, 255, 0.2)',
       'rgba(201, 203, 207, 0.2)'
      ],
      borderColor: [
     'rgb(255, 99, 132)',
     'rgb(255, 159, 64)',
     'rgb(255, 205, 86)',
     'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
      ],
	  /* borderWidth: 1
            }]
          };

          const config1 = {
            type: 'bar',
            data: data1,
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            },
          };

          var myChart = new Chart(
            document.getElementById('myChart'),
            config1*/
      borderWidth: 1
    }]
  };

  const config1 = {
    type: 'line',
    data: data1,
    options: {
        
      scales: {
        x: {
           
		   
		   
		   
        type: 'time',
        time: {
unit: 'month'
        },
            ticks : {

// Definicao de Locale e idioma:
callback: (value, index, ticks) => {
 const date = new Date(value);
 return new Intl.DateTimeFormat('pt-PT', {
month: 'short'

 }).format(date)

}
}

},
      y: {
          beginAtZero: true
        }
      }
    },
  };
  var myChart = new Chart(
    document.getElementById('myChart'),
    config1
  );

 

</script>

<!--Formatacao de numeros-->
<script type="text/javascript">
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };

        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    // Script do diagrama circular (funcionarios/sexo)
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Feminino", "Masculino"],
            datasets: [{
                data: [<?=$denucte_fem;?>, <?= $denucte_masc; ?>],
                backgroundColor: ['#1BC88A', '#e74a3b'],
                hoverBackgroundColor: ['#5a5c69', '#5a5c69'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });
</script>

<script>
    $(function() {
        $( "#ano" ).datepicker({dateFormat: 'yy'});
    });​


</script>


<?php endif; ?>

    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>
	
    <!--Wave Effects -->
    <script src="<?php echo base_url(); ?>assets/js/waves.js"></script>
	
    <!--Estilo para Menu do sidebar -->
    <script src="<?php echo base_url(); ?>assets/js/sidebarmenu.js"></script>
	
    <!--stickey kit -->
    <script src="<?php echo base_url(); ?>assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
	
    <!-- JavaScript personalizado -->
    <script src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>

    <!-- ============================================================== -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <!-- ============================================================== -->
   
   <!--sparkline JavaScript -->
    <script src="<?php echo base_url(); ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
	
    <!--morris JavaScript -->
    <script src="<?php echo base_url(); ?>assets/plugins/raphael/raphael-min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/morrisjs/morris.js"></script>


  <!--..... JavaScript para datetimepicker............-->
    <!-- <script src="<?php echo base_url(); ?>assets/js/dashboard1.js"></script> -->
   
 <script src="<?php echo base_url(); ?>assets/plugins/moment/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>  
   
    <script src="<?php echo base_url(); ?>assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

    <!-- Editable -->
    <script src="<?php echo base_url(); ?>assets/plugins/jsgrid/db.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jsgrid/dist/jsgrid.min.js"></script>
   
   <!-- JavaScript para dados de tabela (de dados) -->

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/multiselect/js/jquery.multi-select.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>  
   
   <!-- Inicio - JavaScript para exportacao apenas -->
    <script src="<?php echo base_url(); ?>assets/export/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/export/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/export/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/export/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/export/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>assets/export/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/export/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

   
    <!-- JavaScript para Plugin de relogio  -->
    <script src="<?php echo base_url(); ?>assets/plugins/clockpicker/dist/jquery-clockpicker.min.js"></script> 
	
    <!-- Date range Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>     
    <!-- end - This is for export functionality only -->
    <script src="<?php echo base_url(); ?>assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/multiselect/js/jquery.multi-select.js"></script>
    
       <!-- CALENDARIO -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/calendar/dist/fullcalendar.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/calendar/dist/cal-init.js"></script>

    <script type="text/javascript">
        $(function () {
            $('.mydatetimepicker').datepicker({
            format: "mm-yyyy",
            viewMode: "years", 
            minViewMode: "months"   
            });
        });
        $(function () {
            $('.mydatetimepickerFull').datepicker({
            format: "yyyy-mm-dd"   
            });
        });
    </script>      
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Ordem POR GRUPO
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $(function () {
  $("#datepicker").datepicker({ 
        autoclose: true, 
        todayHighlight: true
  }).datepicker('update', new Date());
});
    jQuery('.mydatepicker, #datepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });        
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    $('#single-input').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'
    });
    $('#single-input').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'
    });
    $('.clockpicker').clockpicker({
        donetext: 'Done',
    }).find('input').change(function() {
        console.log(this.value);
    });
    $('#check-minutes').click(function(e) {
        // Paragem de propagacao
        e.stopPropagation();
        input.clockpicker('show').clockpicker('toggleView', 'minutes');
    });



    
    $(function() {
    $('#datetimepicker2').datetimepicker({
      language: 'en',
      pick12HourFormat: true
    });
  });
  
    $(".select2").select2();
    </script>
	
	<!--Javascript para formularios-->
<script type="text/javascript">
$('form').each(function() {
    $(this).validate({
    submitHandler: function(form) {
        var formval = form;
        var url = $(form).attr('action');

        // Create an FormData object
        var data = new FormData(formval);
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            // url: "crud/Add_userInfo",
            url: url,
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (response) {
                console.log(response);            
                $(".message").fadeIn('fast').delay(3000).fadeOut('fast').html(response);
                $('form').trigger("reset");
                window.setTimeout(function(){location.reload()},3000);
            },
            error: function (e) {
                console.log(e);
            }
        });
    }
});
});

    </script>     

    <script src="<?php echo base_url(); ?>assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

<!--JavaScript para alertas com toastr-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script type="text/javascript">

<?php if($this->session->flashdata('success')){ ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
<?php }else if($this->session->flashdata('error')){  ?>
    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
<?php }else if($this->session->flashdata('warning')){  ?>
    toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
<?php }else if($this->session->flashdata('info')){  ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
<?php } ?>

</script>


</body>

</html>
