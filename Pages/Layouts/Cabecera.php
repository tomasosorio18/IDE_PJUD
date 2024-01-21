<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= isset($PageTitle) ? $PageTitle : "Default Title"?></title>
    <!-- Additional tags here -->
    <?php if (function_exists('customPageHeader')){
      customPageHeader();
    }?>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../Assets/images/pjud_icon.png"/>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Icon Font Stylesheet -->


    <!-- Libraries Stylesheet -->
    <link href="../Assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="../Assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../Assets/css/admin/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../Assets/css/admin/style.css" rel="stylesheet">


    <script src="../Assets/js/jquery-3.6.3.js"></script>
    

    <link href="../Assets/css/toastr.min.css" rel="stylesheet">
<script src="../Assets/js/toastr.min.js"></script>

 

    
    <!-- ---------------------INICIO CDN VARIOS ------------------- -->

<script src="../Assets/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="../Assets/css/bootstrap-datepicker3.css">

<script src="../Assets/js/jquery-ui.js"></script>
<link rel="stylesheet" href="../Assets/css/jquery-ui.css">

<link href="../Assets/css/vanilla-dataTables.css" rel="stylesheet" type="text/css">
<script src="../Assets/js/vanilla-dataTables.js" type="text/javascript"></script>

<link href="../Assets/datatables/datatables.min.css" rel="stylesheet" type="text/css">
<link href="../Assets/datatables/DataTables-1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css">

<!-- ---------------------FIN CDN VARIOS ------------------- -->


</head>

<body>
<div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- INICIO SPINNER -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only"></span>
            </div>
        </div>
        <!-- FIN SPINNER -->

        <!-- INICIO SIDEBAR -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="Home-admin.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-university me-2"></i>PJUD</h3>
                </a>
               
                <div class="navbar-nav w-100">
                    <a href="Home-admin.php" class="nav-item nav-link active"><i class="fa fa-home me-2"></i>Home</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-users me-2"></i>G. de Personal</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="Funcionarios.php" class="dropdown-item">Funcionarios</a>
                            <a href="Jueces.php" class="dropdown-item">Jueces</a>
                            <a href="Receptores.php" class="dropdown-item">Receptores</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-scale-balanced me-2"></i>G. de Decretos</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="Decreto.php" class="dropdown-item">Diseño de decretos</a>
                            <a href="Informe_Decreto.php" class="dropdown-item">Informe de decretos</a>
                            <a href="Modificar_Decretos2.php" class="dropdown-item">Modificar decretos</a>
                            <a href="Subir_Decretos.php" class="dropdown-item">Subir decretos</a> 
                        </div>
                    </div>
                    <div class="nav-item dropdown">   
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-network-wired me-2"></i>G. de Cargos</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="#" class="dropdown-item">G. Cargo Subrogante</a>
                            <a href="#" class="dropdown-item">G. Cargo MFE</a>
                       
                        </div>
                    </div>
                    <div class="nav-item dropdown">             
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-chart-line me-2"></i>Estadisticas</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="#" class="dropdown-item">Estadisticas de Decretos</a>
                            <a href="#" class="dropdown-item">Estadisticas de Usuarios</a>
                            <a href="#" class="dropdown-item">Estadisticas de Funcionarios</a>
                            <a href="#" class="dropdown-item">Estadisticas de Jueces</a>
                        </div>
                    </div> 
                    <a href="#" class="nav-item nav-link"><i class="fa-solid fa-file-shield me-2"></i>Respaldar Info.</a>
                    <a href="#" class="nav-item nav-link"><i class="fa-solid fa-circle-info me-2"></i>Acerca de nos.</a>
                </div>
            </nav>
        </div> 
        <!-- FIN SIDEBAR -->


        <!-- INICIO CONTENIDO -->
        <div class="content">
            <!-- INICIO NAVBAR -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="Home-admin.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-university"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
               
                <div class="navbar-nav align-items-center ms-auto">
                    
               

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="../Assets/images/user.png" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">Mi cuenta</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">           
                            
                            <a href="Test.php" class="dropdown-item text-center"><i class="fa fa-unlock-alt"></i>  Gestion de Permisos</a>
                            <hr class="dropdown-divider">
                            <a href="../auth/logout.php" class="dropdown-item"><i class="fa fa-sign-out"></i>  Cerrar sesion</a>
                        </div>
                    </div>

                </div>
            </nav>
          