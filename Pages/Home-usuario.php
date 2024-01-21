<?php
//se inicia la sesion
session_start();
//se pregunta si existe la variable 'logeado' en las SESSIONS
if (isset($_SESSION['logeado'])) {
    $id = $_SESSION['id'];
    $email=$_SESSION['name'];
    $apellido=$_SESSION['apellido'];
    $rol= $_SESSION['rol'];
    $letra_nombre =mb_substr($email, 0, 1);
    $letra_Apellido =mb_substr($apellido, 0, 1);
    $tribunal_id = $_SESSION['tribunal'];
    $tur_id = $_SESSION['tur_id'];
    $_SESSION['iniciales'] = $letra_nombre . $letra_Apellido;
  
    session_write_close();
} else {
    // Ya que el nombre no esta asignado en una session, el usuario no esta logeado
    // Y esta intentando ingresar sin autorizacion
    // Asi que limpiamos todas las variables de session y lo enviamos al login.
    session_unset();
    session_write_close();
    $url = "../Index.php?sesion=permisos";
    header("Location: $url");
}
if ($_SESSION['rol']== 1) {
// si el rol almecenado en la variable SESSION es 1, quiere decir que el rol que posee es de administrador y como
// este menu es unicamente para usuarios, debemos redireccionarlo al login
    session_unset();
    session_write_close();
    session_destroy();
    header('Location: ../Index.php?sesion=permisos');
}
?>
<!-- incluimos la conexion con la bd  -->
<?php include("../Configuration/Connector.php");?>
<!-- ------------------------------------------------ -->
<?php include("../Pages/Metodos/Trae_contadores.php");?>
<?php include("Metodos/Trae_datos_usuario.php");?>


<?php
// esta funcion permite asignarle un titulo a cada pagina, mediante el include de la cabecera, sin tener que traer todo el html
$PageTitle="Menu Administrador";

function customPageHeader(){?>
  <!--Arbitrary HTML Tags-->
<?php } ?>
<?php
include("Layouts/Cabecera_user.php");
?>
 <!-- --------------------------------------------------INICIO BODY---------------------------------------- -->
<!-- --------------------------------------------------INICIO BIENVENIDA----------------------------------------  -->

<div class="row">
  <div class="col-lg-12 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
         <div class="card-body">
            <h5 class="card-title text-primary">Bienvenido,  <?php echo $nombre_usuario." ".$apellido_usuario?></h5>
            <p class="mb-4">
              Actualmente usted posee el rol de <span class="badge bg-label-primary me-1">Usuario</span> 
            </p>
            <p>Puedes acceder a tu informacion personal gracias al menu de configuracion o seguridad!</p>
            <a href="Configuracion.php" class="btn rounded-pill btn-label-primary" style="height: 50px;">Configurar Perfil</a>
      
          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <img
              src="../Assets/images/userbasic.png"
              height="200"
              alt="View Badge User"
              data-app-dark-img="illustrations/man-with-laptop-dark.png"
              data-app-light-img="illustrations/man-with-laptop-light.png"
            />
        </div>
        </div>
    </div>
  </div>
</div>



                  <div class="row mb-5">

                     <!-- ---------------------------------INICIO-LICENCIAS---------------------------------------------- -->
                    <div class="col-md-6 col-lg-3 mb-3">
                      <div class="card card-border-shadow-primary h-100">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                            <i class="fa-solid fa-hospital fa-beat fa-2xl" style="color: #1371d6;"></i>
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="javascript:void(0);">Ver mas</a>
                                <a class="dropdown-item" href="javascript:void(0);">Eliminar</a>
                              </div>
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Decretos de licencias</span>
                          <h3 class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i><?php 
                                  if($cantidad_licencias){
                                    echo $cantidad_licencias['cantidad_decreto'];
                                  }else{
                                    echo 0;
                                  }
                                
                                ?></h3>
                        </div>
                      </div>
                    </div>
                      <!-- ---------------------------------FIN-LICENCIAS--------------------------------------------- -->
                      <!-- ---------------------------------INICIO-FERIADOS---------------------------------------------- -->

                      <div class="col-md-6 col-lg-3 mb-3">
                          <div class="card card-border-shadow-primary h-100">
                            <div class="card-body">
                              <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                <i class="fa-regular fa-calendar-days fa-beat fa-2xl"style="color: #1371d6;"></i>
                             
                                </div>
                                <div class="dropdown">
                                  <button
                                    class="btn p-0"
                                    type="button"
                                    id="cardOpt6"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                  >
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                  </button>
                                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                    <a class="dropdown-item" href="javascript:void(0);">Ver mas</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Eliminar</a>
                                  </div>
                                </div>
                              </div>
                              <span class="fw-semibold d-block mb-1" >Decretos de feriados</span>
                              <h3 class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i><?php 
                                  if($cantidad_feriados){
                                    echo $cantidad_feriados['cantidad_decreto'];
                                  }else{
                                    echo 0;
                                  }
                                
                                ?></h3>
                            </div>
                          </div>
                        </div>
                              <!-- ---------------------------------FIN-FERIADOS---------------------------------------------- -->
                              <!-- ---------------------------------INICIO-RECEPTORES--------------------------------------------- -->
                        <div class="col-md-6 col-lg-3 mb-3">
                          <div class="card card-border-shadow-primary h-100">
                            <div class="card-body">
                              <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                <i class="fa-solid fa-clipboard-list fa-beat fa-2xl"style="color: #1371d6;"></i>
                           
                                </div>
                                <div class="dropdown">
                                  <button
                                    class="btn p-0"
                                    type="button"
                                    id="cardOpt6"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                  >
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                  </button>
                                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                    <a class="dropdown-item" href="javascript:void(0);">Ver mas</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Eliminar</a>
                                  </div>
                                </div>
                              </div>
                              <span class="fw-semibold d-block mb-1" >Decretos de receptores</span>
                              <h3 class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> <?php 
                                  if($cantidad_receptor){
                                    echo $cantidad_receptor['cantidad_decreto'];
                                  }else{
                                    echo 0;
                                  }
                                
                                ?></h3>
                            </div>
                          </div>
                        </div>
                          <!-- ---------------------------------FIN-RECEPTORES---------------------------------------------- -->
                          <!-- ---------------------------------INICIO-PERMISOS---------------------------------------------- -->
                    <div class="col-md-6 col-lg-3 mb-3">
                      <div class="card card-border-shadow-primary h-100">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                            <i class="fa-solid fa-address-card fa-beat fa-2xl"style="color: #1371d6;"></i>
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt6"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                <a class="dropdown-item" href="javascript:void(0);">Ver mas</a>
                                <a class="dropdown-item" href="javascript:void(0);">Eliminar</a>
                              </div>
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1" >Decretos de permisos</span>
                        
                          <h3 class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i><?php 
                                  if($cantidad_permisos){
                                    echo $cantidad_permisos['cantidad_decreto'];
                                  }else{
                                    echo 0;
                                  }    
                                ?></h3>
                        </div>
                      </div>
                    </div>
                        <!-- ---------------------------------FIN-PERMISOS---------------------------------------------- -->
                          <!-- ---------------------------------INICIO-OTROS---------------------------------------------- -->
                    <div class="col-md-6 col-lg-3 mb-3">
                      <div class="card card-border-shadow-primary h-100">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">  
                            <i class="fa-solid fa-message-dots fa-beat fa-2xl"style="color: #1371d6;"></i>
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt6"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                <a class="dropdown-item" href="javascript:void(0);">Ver mas</a>
                                <a class="dropdown-item" href="javascript:void(0);">Eliminar</a>
                              </div>
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1" >Decretos de otros</span>
                          <h3 class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> <?php 
                                  if($cantidad_otros){
                                    echo $cantidad_otros['cantidad_decreto'];
                                  }else{
                                    echo 0;
                                  }
                                
                                ?></h3>
                        </div>
                      </div>
                    </div>
                          <!-- ---------------------------------FIN-OTROS---------------------------------------------- -->
                          <!-- ---------------------------------INICIO-PERMISO-SUBROGACION---------------------------------------------- -->

                    <div class="col-md-6 col-lg-3 mb-3">
                      <div class="card card-border-shadow-primary h-100">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                            <i class="fa-solid fa-right-left fa-beat fa-2xl"style="color: #1371d6;"></i>
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt6"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                <a class="dropdown-item" href="javascript:void(0);">Ver mas</a>
                                <a class="dropdown-item" href="javascript:void(0);">Eliminar</a>
                              </div>
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1" >Decretos de Permisos subrogacion</span>
                          <h3 class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i><?php 
                                  if($cantidad_pSubrogacion){
                                    echo $cantidad_pSubrogacion['cantidad_decreto'];
                                  }else{
                                    echo 0;
                                  }
                                
                                ?></h3>
                        </div>
                      </div>
                    </div>
                          <!-- ---------------------------------FIN-PERMISO-SUBROGACION----------------------------------------------- -->
                          <!-- ---------------------------------INICIO-LICENCIAS-SUBROGACION---------------------------------------------- -->
                    <div class="col-md-6 col-lg-3 mb-3">
                      <div class="card card-border-shadow-primary h-100">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                            <i class="fa-solid fa-hand-holding-medical fa-beat fa-2xl"style="color: #1371d6;"></i>
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt6"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                <a class="dropdown-item" href="javascript:void(0);">Ver mas</a>
                                <a class="dropdown-item" href="javascript:void(0);">Eliminar</a>
                              </div>
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1" >Decretos de Licencias subrogacion</span>
                          <h3 class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> <?php 
                                  if($cantidad_lSubrogacion){
                                    echo $cantidad_lSubrogacion['cantidad_decreto'];
                                  }else{
                                    echo 0;
                                  }
                                
                                ?></h3>
                        </div>
                      </div>
                    </div>
                          <!-- ---------------------------------FIN-LICENCIAS-SUBROGACION----------------------------------------------- -->
                          <!-- ---------------------------------INICIO-DESIGNACION---------------------------------------------- -->
                    <div class="col-md-6 col-lg-3 mb-3">
                      <div class="card card-border-shadow-primary h-100">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                            <i class="fa-solid fa-people-arrows fa-beat fa-2xl"style="color: #1371d6;"></i>
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt6"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                <a class="dropdown-item" href="javascript:void(0);">Ver mas</a>
                                <a class="dropdown-item" href="javascript:void(0);">Eliminar</a>
                              </div>
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1" >Decretos de Designacion</span>
                          <h3 class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> <?php 
                                  if($cantidad_Designacion){
                                    echo $cantidad_Designacion['cantidad_decreto'];
                                  }else{
                                    echo 0;
                                  }
                                
                                ?></h3>
                        </div>
                      </div>
                    </div>
                    <!-- ---------------------------------FIN-DESIGNACION----------------------------------------------- -->
                          <!-- ---------------------------------INICIO-MESA AYUDA---------------------------------------------- -->
                    <div class="col-md-6 col-lg-3 mb-3">
                      <div class="card card-border-shadow-primary h-100">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                            
                            <i class="fa-solid fa-handshake fa-beat fa-2xl"style="color: #1371d6;"></i>
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt6"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                <a class="dropdown-item" href="javascript:void(0);">Ver mas</a>
                                <a class="dropdown-item" href="javascript:void(0);">Eliminar</a>
                              </div>
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1" >Decretos de Mesa ayuda</span>
                          <h3 class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i><?php 
                                  if($cantidad_MA){
                                    echo $cantidad_MA['cantidad_decreto'];
                                  }else{
                                    echo 0;
                                  }
                                
                                ?></h3>
                        </div>
                      </div>
                    </div>

                    <!-- ---------------------------------FIN-MESA AYUDA----------------------------------------------- -->
                          <!-- ---------------------------------INICIO-CURSO ACADEMIA---------------------------------------------- -->
                    <div class="col-md-6 col-lg-3 mb-3">
                      <div class="card card-border-shadow-primary h-100">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                            <i class="fa-solid fa-award fa-beat fa-2xl"style="color: #1371d6;"></i>
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt6"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                <a class="dropdown-item" href="javascript:void(0);">Ver mas</a>
                                <a class="dropdown-item" href="javascript:void(0);">Eliminar</a>
                              </div>
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1" >Decretos de Curso academia</span>               
                          <h3 class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> <?php 
                                  if($cantidad_CA){
                                    echo $cantidad_CA['cantidad_decreto'];
                                  }else{
                                    echo 0;
                                  }
                                
                                ?></h3>
                        </div>
                      </div>
                    </div>

                      <!-- ---------------------------------FIN-CURSO ACADEMIA----------------------------------------------- -->
             <!-- ---------------------------------INICIO-FERIADO SUBROGACION---------------------------------------------- -->
             <div class="col-md-6 col-lg-3 mb-3">
                      <div class="card card-border-shadow-primary h-100">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                            <i class="fa-regular fa-calendar-circle-user fa-beat fa-2xl"style="color: #1371d6;"></i>
                            
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt6"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                <a class="dropdown-item" href="javascript:void(0);">Ver mas</a>
                                <a class="dropdown-item" href="javascript:void(0);">Eliminar</a>
                              </div>
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1" >Decretos de Feriado subrogacion</span>               
                          <h3 class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> <?php 
                                  if($cantidad_FS){
                                    echo $cantidad_FS['cantidad_decreto'];
                                  }else{
                                    echo 0;
                                  }
                                
                                ?></h3>
                        </div>
                      </div>
                    </div>

                      <!-- ---------------------------------FIN-FERIADO SUBROGACION----------------------------------------------- -->

                    <!-- /cierre row 1 -->

    <script>
      <?php if ($_GET["sesion"]=="sesioninicio") { ?>
      toastr.options =
      {
        "closeButton" : true,
        "progressBar" : true
      }
          toastr.info("Bienvenido, sesion iniciada!");      
      <?php }?>
	  </script>

<?php if($_SESSION['rol'] == 1){
include("Layouts/Pie_admin.php");}else{
include("Layouts/Pie_user.php");
        }
