        <aside class="left-sidebar" style="background: rgb(0,0,0);
            background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(79,6,101,1) 0%, rgba(174,17,20,1) 100%);">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                        <?php 
                        $id = $this->session->userdata('user_login_id');
                        $basicinfo = $this->employee_model->GetBasic($id); 
                        ?>                
                
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav" style="background: rgb(0,0,0); background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(79,6,101,1) 0%, rgba(174,17,20,1) 100%);" >
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li> <a href="<?php echo base_url(); ?>" style="color:#1976d2"><i class="mdi mdi-gauge" style="color:red"></i><span class="hide-menu">Dashboard </span></a></li>
                                                                  
                        <li> <a href="<?php echo base_url()?>employee/Utilizadores" style="color:#1976d2"><i class="mdi mdi-account-multiple" style="color:red"></i><span class="hide-menu">Utilizadores <span class="hide-menu"></a></li>

                        

                        <li> <a href="#<?php echo base_url()?>denuncia/Denuncia" style="color:#5c4ac7"><i class="fa fa-bullhorn" style="color:red"></i><span class="hide-menu">Den&uacute;ncias <span class="hide-menu"></a></li>

                        
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false" style="color:#1976d2"><i class="mdi mdi-settings"  style="color:red"></i><span class="hide-menu">Configura&ccedil;&otilde;es <!--Leave --></span></a>
                            <ul aria-expanded="false" class="collapse" style="background: rgb(0,0,0); background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(79,6,101,1) 0%, rgba(174,17,20,1) 100%);">
                                <li><a href="<?php echo base_url(); ?>configuracao/Perfil" style="color:#fff"> <i class="mdi mdi-account-box" style="color:red"></i><!--Holiday--> Perfil</a></li>
                                <li><a href="<?php echo base_url(); ?>configuracao/Provincia" style="color:#fff"> <i class="mdi mdi-map-marker-radius" style="color:red"></i><!--Leave Type--> Prov&iacute;ncias</a></li>
                                <li><a href="<?php echo base_url(); ?>configuracao/Distrito" style="color:#fff"> <i class="mdi mdi-map-marker" style="color:red"></i><!--Leave Application--> Distritos </a></li>
                                <li><a href="<?php echo base_url(); ?>configuracao/TipoDenuncia" style="color:#fff"> <i class="fa fa-bullhorn" style="color:red"></i><!--Earned Leave--> Tipos de den&uacute;ncias </a></li>
                                <li><a href="#<?php echo base_url(); ?>configuracao/DadosEmpresa" style="color:#fff"> <i class="mdi mdi-home-modern" style="color:red"></i><!--Report--> Dados da empresa </a></li>
                            </ul>
                        </li>
                        
                        <li> <a href="#<?php echo base_url()?>notice/All_notice" style="color:#1976d2"><i class="mdi mdi-information"  style="color:red"></i><span class="hide-menu">Sobre <span class="hide-menu"></a></li>
                        <!--<li> <a href="<?php echo base_url(); ?>settings/Settings" ><i class="mdi mdi-settings"></i><span class="hide-menu">Settings <span class="hide-menu"></a></li>-->
                        
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>