<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8" />

    <title><?= isset($PageTitle) ? $PageTitle : "Default Title"?></title>
    <!-- Additional tags here -->
    <?php if (function_exists('customPageHeader')){ 
      customPageHeader();
    }?>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Font awesome -->
    <link rel="icon" type="image/png" href="../Assets/images/pjud_icon.png"/>
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-solid.css">
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-regular.css">
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-light.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"rel="stylesheet"/>
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->

    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />


    <!-- Page CSS -->
   
    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../Assets/js/config.js"></script>
    
    <script src="../Assets/js/jquery-3.6.3.js"></script>
    

    <link href="../Assets/css/toastr.min.css" rel="stylesheet">
    <script src="../Assets/js/toastr.min.js"></script>
    <!-- ---------------------INICIO CDN VARIOS ------------------- -->
    <script src="../Assets/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../Assets/css/bootstrap-datepicker3.css">

<script src="../Assets/js/jquery-ui.js"></script>
<link rel="stylesheet" href="../Assets/css/jquery-ui.css">

<script src="../Assets/vendor/libs/apex-charts/apexcharts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="../Assets/css/vanilla-dataTables.css" rel="stylesheet" type="text/css">
<script src="../Assets/js/vanilla-dataTables.js" type="text/javascript"></script>

<link href="../Assets/datatables/datatables.min.css" rel="stylesheet" type="text/css">
<link href="../Assets/datatables/DataTables-1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="Assets/css/modal/Modal-warning.css">
<!-- ---------------------FIN CDN VARIOS ------------------- -->
<?php include("Modales_general/Modal_alerta.php"); ?>
  </head>

      
  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      
      <div class="layout-container">
     
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
              <div class="app-brand demo">
                <a href="home-admin.php" class="app-brand-link">
                  <span class="app-brand-logo demo">
                  <img src="../Assets/images/pjud_icon.png" alt class="w-px-40 h-auto" />
                  </span>
                  <span class="app-brand-text demo menu-text fw-bolder ms-3">PJUD</span>
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                  <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
              </div>

              <div class="menu-inner-shadow"></div>

         

              <ul class="menu-inner py-1">
                <!-- Dashboard -->
                <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'Home-admin.php'){echo 'menu-item active'; }else { echo 'menu-item'; } ?>">
                  <a href="Home-admin.php" class="menu-link">
                    <i class="menu-icon tf-icons fa fa-home me-2"></i>
                    <div data-i18n="Analytics">Home</div>
                  </a>
                </li>

                <!-- Layouts -->
                <li class="menu-header small text-uppercase">
                  <span class="menu-header-text">Decretos</span>
                </li>
                <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'Diseño_decretos.php' or basename($_SERVER['SCRIPT_NAME']) == 'Informe_decretos.php' or basename($_SERVER['SCRIPT_NAME']) == 'Modificar_decretos.php' or basename($_SERVER['SCRIPT_NAME']) == 'Subir_decretos.php'){echo 'menu-item active'; }else { echo 'menu-item'; } ?>">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons fa-solid fa-scale-balanced me-2"></i>
                    <div data-i18n="Layouts">Gestion de decretos</div>
                  </a>

                  <ul class="menu-sub">
                    <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'Diseño_decretos.php'){echo 'menu-item active'; }else { echo 'menu-item'; } ?>">
                      <a href="Diseño_decretos.php" class="menu-link">
                        <div data-i18n="Without menu">Diseño de decretos</div>
                      </a>
                    </li>
                    <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'Informe_decretos.php'){echo 'menu-item active'; }else { echo 'menu-item'; } ?>">
                      <a href="Informe_decretos.php" class="menu-link">
                        <div data-i18n="Without navbar">Informe de decretos</div>
                      </a>
                    </li>
                    <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'Modificar_decretos.php'){echo 'menu-item active'; }else { echo 'menu-item'; } ?>">
                      <a href="Modificar_decretos.php" class="menu-link">
                        <div data-i18n="Container">Modificar decretos</div>
                      </a>
                    </li>
                    <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'Subir_decretos.php'){echo 'menu-item active'; }else { echo 'menu-item'; } ?>">
                      <a href="Subir_decretos.php" class="menu-link">
                        <div data-i18n="Fluid">Subir decretos</div>
                      </a>
                    </li>     
                  </ul>
                </li>

                <li class="menu-header small text-uppercase">
                  <span class="menu-header-text">Personal</span>
                </li>
                <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'Gestion_jueces.php' or basename($_SERVER['SCRIPT_NAME']) == 'Gestion_receptores.php' or basename($_SERVER['SCRIPT_NAME']) == 'Gestion_funcionarios.php'){echo 'menu-item active'; }else { echo 'menu-item'; } ?>">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons fa fa-users me-2"></i>
                    <div data-i18n="Account Settings">Gestion de personal</div>
                  </a>
                  <ul class="menu-sub">
                    <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'Gestion_jueces.php'){echo 'menu-item active'; }else { echo 'menu-item'; } ?>">
                      <a href="Gestion_jueces.php" class="menu-link">
                        <div data-i18n="Account">Gestion de Jueces</div>
                      </a>
                    </li>
                    <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'Gestion_receptores.php'){echo 'menu-item active'; }else { echo 'menu-item'; } ?>">
                      <a href="Gestion_receptores.php" class="menu-link">
                        <div data-i18n="Notifications">Gestion de Receptores</div>
                      </a>
                    </li>
                    <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'Gestion_funcionarios.php'){echo 'menu-item active'; }else { echo 'menu-item'; } ?>">
                      <a href="Gestion_funcionarios.php" class="menu-link">
                        <div data-i18n="Connections">Gestion de Funcionarios</div>
                      </a>
                    </li>
                  </ul>
                </li>
            
                <li class="menu-header small text-uppercase">
                  <span class="menu-header-text">Cargos</span>
                </li>
                <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'Gestion_cargos_juez' or basename($_SERVER['SCRIPT_NAME']) == 'Gestion_cargos_funcionarios.php'){echo 'menu-item active'; }else { echo 'menu-item'; } ?>">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons fa-solid fa-network-wired me-2"></i>
                    <div data-i18n="Account Settings">Gestion de cargos.</div>
                  </a>
                  <ul class="menu-sub">
                    <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'Gestion_cargos_juez.php'){echo 'menu-item active'; }else { echo 'menu-item'; } ?>">
                      <a href="Gestion_cargos_juez.php" class="menu-link">
                        <div data-i18n="Account">Cargo Jueces
                        </div>
                      </a>
                    </li>
                    <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'Gestion_cargos_funcionarios.php'){echo 'menu-item active'; }else { echo 'menu-item'; } ?>">
                      <a href="Gestion_cargos_funcionarios.php" class="menu-link">
                        <div data-i18n="Notifications">Cargo Funcionarios</div>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="menu-header small text-uppercase">
                  <span class="menu-header-text">Graficos</span>
                </li>
                <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'Estadisticas_usuario.php' or basename($_SERVER['SCRIPT_NAME']) == 'Estadisticas_generales.php'){echo 'menu-item active'; }else { echo 'menu-item'; } ?>">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons fa-solid fa-chart-line me-2"></i>
                    <div data-i18n="Account Settings">Estadisticas</div>
                  </a>
                  <ul class="menu-sub">
                    <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'Estadisticas_usuario.php'){echo 'menu-item active'; }else { echo 'menu-item'; } ?>">
                      <a href="Estadisticas_usuario.php" class="menu-link">
                        <div data-i18n="Account">Estadisticas del usuario.
                        </div>
                      </a>
                    </li>
                    <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'Estadisticas_generales.php'){echo 'menu-item active'; }else { echo 'menu-item'; } ?>">
                      <a href="Estadisticas_generales.php" class="menu-link">
                        <div data-i18n="Notifications">Estadisticas generales</div>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'Respaldo.php'){echo 'menu-item active'; }else { echo 'menu-item'; } ?>">
                  <a href="Respaldo.php" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-floppy-disk me-2"></i>
                    <div data-i18n="Analytics">Respaldos</div>
                  </a>
                </li>

                <li class="<?php if(basename($_SERVER['SCRIPT_NAME']) == 'About_us.php'){echo 'menu-item active'; }else { echo 'menu-item'; } ?>">
                  <a href="About_us.php" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-circle-info me-2"></i>
                    <div data-i18n="Analytics">Acerca de mi <span class="badge rounded-pill bg-label-warning">Prox..</span></div>
                  </a>
                </li>
                <!-- Misc -->
              </ul>
            </aside>
        <!-- / Menu LATERAL-->
        <!-- Layout container -->
        <div class="layout-page">
              <!-- -------------------------------------------------------------------Navbar----------------------------------------------------------------------------------- -->

            <nav
              class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
              id="layout-navbar">
              <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                  <i class="bx bx-menu bx-sm"></i>
                </a>
              </div>

              <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                <!-- Search -->
                <div class="navbar-nav align-items-center">
                  <div class="nav-item d-flex align-items-center">
                    <i class="fa-solid fa-magnifying-glass fs-4 lh-0"></i>
                    <input
                      type="text"
                      class="form-control border-0 shadow-none"
                      placeholder="Buscar..."
                      aria-label="Buscar..."
                    />
                  </div>
                </div>
                <!-- /Search -->

                <ul class="navbar-nav flex-row align-items-center ms-auto">
                  <!-- Place this tag where you want the button to render. -->
                  <li class="nav-item">
                  <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="Test.php">
                  <i class="fa-regular fa-flask-vial fa-lg"></i>
                  </a>
                </li>
                  <li class="nav-item">
                  <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class='bx bx-bell bx-sm' ></i>
                  </a>
                </li>
                <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
              <i class='bx bx-grid-alt bx-sm'></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end py-0">
              <div class="dropdown-menu-header border-bottom">
                <div class="dropdown-header d-flex align-items-center py-3">
                  <h5 class="text-body mb-0 me-auto">Atajos</h5>
                  <a href="javascript:void(0)" class="dropdown-shortcuts-add text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="Add shortcuts"><i class="bx bx-sm bx-plus-circle"></i></a>
                </div>
              </div>
              <div class="dropdown-shortcuts-list scrollable-container">
                <div class="row row-bordered overflow-visible g-0">
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                      <i class="bx bx-calendar fs-4"></i>
                    </span>
                    <a href="Diseño_decretos.php" class="stretched-link">Decretos</a>
                    <small class="text-muted mb-0">Diseñar decretos</small>
                  </div>
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                      <i class="bx bx-food-menu fs-4"></i>
                    </span>
                    <a href="Informe_decretos.php" class="stretched-link">Informe</a>
                    <small class="text-muted mb-0">Informe decretos</small>
                  </div>
                </div>
                <div class="row row-bordered overflow-visible g-0">
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                      <i class="bx bx-user fs-4"></i>
                    </span>
                    <a href="Perfil.php" class="stretched-link">Perfil</a>
                    <small class="text-muted mb-0">Perfil del usuario</small>
                  </div>
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                      <i class="bx bx-check-shield fs-4"></i>
                    </span>
                    <a href="Gestion_roles.php" class="stretched-link">Roles</a>
                    <small class="text-muted mb-0">Gestion de roles</small>
                  </div>
                </div>
                <div class="row row-bordered overflow-visible g-0">
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                    <i class="fa-solid fa-floppy-disk fa-lg"></i>
                    </span>
                    <a href="#" class="stretched-link">Respaldar</a>
                    <small class="text-muted mb-0">Respaldar datos</small>
                  </div>
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                      <i class="bx bx-cog fs-4"></i>
                    </span>
                    <a href="#" class="stretched-link">Configuracion</a>
                    <small class="text-muted mb-0">Configuracion de la cuenta</small>
                  </div>
                </div>
                <div class="row row-bordered overflow-visible g-0">
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                      <i class="bx bx-help-circle fs-4"></i>
                    </span>
                    <a href="pages-faq.html" class="stretched-link">FAQs</a>
                    <small class="text-muted mb-0">FAQs & Articles</small>
                  </div>
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                      <i class="bx bx-window-open fs-4"></i>
                    </span>
                    <a href="modal-examples.html" class="stretched-link">Modals</a>
                    <small class="text-muted mb-0">Useful Popups</small>
                  </div>
                </div>
              </div>
            </div>
          </li>
                <li class="nav-item" style="margin-right: 30px;">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="bx bx-sm bx-sun"></i>
                    <div class="notification bg-primary rounded-circle"></div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                  <li>
                    <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                      <span class="align-middle"><i class='bx bx-sun me-2'></i>Claro</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                      <span class="align-middle"><i class="bx bx-moon me-2"></i>Oscuro</span>
                    </a>
                  </li>
                 </ul>
                </li>
                  <!-- User -->
                  <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                      <div class="avatar avatar-online">
                        <img src="../Assets/images/user.png" alt class="w-px-40 h-auto rounded-circle" />
                      </div>
                    </a>
                            


                    <ul class="dropdown-menu dropdown-menu-end">
                      <li>
                        <a class="dropdown-item" href="Perfil.php">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar avatar-online">
                                <img src="../Assets/images/user.png" alt class="w-px-40 h-auto rounded-circle" />
                              </div>
                            </div>
                            <div class="flex-grow-1">
                          <span class="fw-semibold d-block"><?php echo $nombre_usuario." ".$apellido_usuario." (<b>" . $Letra_Nombre . $Letra_Apellido . ")</b>";?></span>
                          <span class="badge bg-label-warning me-1"><?php if ($rol == 1){ echo "Administrador";}else{ echo "Usuario";};?></span>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                      </li>
                      <li>
                        <a class="dropdown-item" href="Perfil.php">
                          <i class="fa-solid fa-user me-2"></i>
                          <span class="align-middle">Mi perfil</span>
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="Configuracion.php">
                
                          <i class="fa-solid fa-gear me-2"></i>
                          <span class="align-middle">Configuracion</span>
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="Seguridad.php">
                
                        <i class="fa-solid fa-shield-quartered me-2"></i>
                          <span class="align-middle">Seguridad</span>
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="Gestion_roles.php">
                        <i class="fa-solid fa-key me-2"></i>
                          <span class="align-middle">Roles</span>
                        </a>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                      </li>
                      <li>
                        <a class="dropdown-item" href="/" data-bs-target="#myModal-warning" data-bs-toggle="modal">
                          
                          <i class="fa-solid fa-power-off me-2"></i>
                          <span class="align-middle">Cerrar sesion</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <!--/ User -->
                </ul>
              </div>
            </nav>
                <!-- / CIERRE Navbar -->
            <div class="content-wrapper">
              
                <div class="container-xxl flex-grow-1 container-p-y">
                








    
