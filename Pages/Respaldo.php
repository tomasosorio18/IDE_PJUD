<?php
//se inicia la sesion
session_start();
// aca se pregunta si la variable de SESSIONS tiene asignado un estado logeado como true
if (isset($_SESSION['logeado']) && $_SESSION['logeado'] == true) {
    //si es asi traemos la variable name y apellido almacenada en SESSIONS
    $email=$_SESSION['name'];
    $apellido=$_SESSION['apellido'];
    $rol= $_SESSION['rol'];
    $id=$_SESSION['id'];
    // aca obtenemos las iniciales del nombre y apellido
    $letra_nombre =mb_substr($email, 0, 1);
    $letra_Apellido =mb_substr($apellido, 0, 1);
     // y las almacenamos en la variable SESSIONS
    $_SESSION['iniciales'] = $letra_nombre . $letra_Apellido;

    session_write_close();
} else {
  // Si la variable SESSION no tiene un estado logeado o lo tiene falso, quiere decir que un usuario
  //quiere acceder a la pagina sin autenticarse, por lo que debemos redireccionarlo a que se loguee
    session_unset();
    session_write_close();
    $url = "../Index.php?sesion=permisos";
    header("Location: $url");
}

if ($_SESSION['rol']== 2) {
// si el rol almecenado en la variable SESSION es 2, quiere decir que el rol que posee es de usuario y como
// este menu es unicamente para administrador, debemos redireccionarlo al login
    session_unset();
    session_write_close();
    session_destroy();
    header('Location: ../Index.php?sesion=permisos');
}
?>
<?php 
//esta funcion permite asignarle un titulo a cada pagina, mediante el include de la cabecera, sin tener que traer todo el html
$PageTitle="Respaldo";

function customPageHeader(){?>
  <!--Arbitrary HTML Tags-->
<?php }?>

<?php
//incluimos la conexion con la bd 
include("../Configuration/Connector.php");
include("Metodos/Trae_datos_usuario.php");?>

 <?php
 //incluimos la cabecera del admin para ahorrarnos codigo   
 include("Layouts/Cabecera_admin.php");
    ?>


<div class="row">
                      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Estadisticas /</span> Respaldo</h4>
                  
                    <div class="col-lg-6 col-12 mb-4" >
                        <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title mb-0">
                                <h5 class="card-title text-primary">¡Genera un respaldo!</h5>
                                <h6 class="card-subtitle text-muted">Permite descargar un archivo de respaldo de la base de datos actual.</h6>
                            </div>
                            
                            <div class="card-header-elements ms-auto py-0 dropdown">
                            <button type="button" class="btn dropdown-toggle hide-arrow p-0" id="heat-chart-dd" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="heat-chart-dd">
                                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                            </div>
                            </div>
                        </div>
                        <div class="card-body">
                            
                        <div class="col-lg mb-md-0 mb-4">
          <div class="card border-primary border shadow-none">
            <div class="card-body position-relative">
              <div class="position-absolute end-0 me-4 top-0 mt-4">
                <span class="badge bg-label-primary">Nuevo</span>
              </div>
              <div class="my-3 pt-2 text-center">

              <div class="avatar avatar-md border-5 border-light-info rounded-circle mx-auto mb-2" style="height: 100px; width: 100px;">
                <span class="avatar-initial rounded-circle bg-label-primary"><i class="fa-duotone fa-floppy-disk-circle-arrow-right fa-beat fa-2xl" style="--fa-primary-color: #2629ba; --fa-secondary-color: #696cff; --fa-secondary-opacity: 1;"></i></span>
              </div>
            
              </div>
              <h3 class="card-title text-center text-capitalize mb-1">Respaldo completo</h3>
              <p class="text-center">Respalda toda la base de datos en un archivo .sql</p>
              <div class="text-center">      
              </div>

              <ul class="ps-3 my-4 list-unstyled">
                <li class="mb-2"><span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i class="bx bx-check bx-xs"></i></span> Respaldo de todas las tablas</li>
                <li class="mb-2"><span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i class="bx bx-check bx-xs"></i></span> Respaldo de todos los usuarios</li>
                <li class="mb-2"><span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i class="bx bx-check bx-xs"></i></span> Respaldo de todos los datos</li>
                <li class="mb-2"><span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i class="bx bx-check bx-xs"></i></span> Respaldos de decretos</li>
                <li class="mb-0"><span class="badge badge-center w-px-20 h-px-20 rounded-pill bg-label-primary me-2"><i class="bx bx-check bx-xs"></i></span> Respaldo en archivo .sql</li>
              </ul>
              <form method="POST"action="Metodos/Genera_respaldo.php">
              <div class="row mb-3">
                <button type="submit" class="btn rounded-pill btn-label-primary" id="btnRespaldo" name="btnRespaldo"> Generar respaldo de la base de datos.</button>
              </div>
              </form>

                

            </div>
          </div>
        </div>

                        </div>
                        </div>
                    </div> 
     
                    </div>

 

                

















<?php 
//traemos el pie con el include
include("Layouts/Pie_admin.php");
?>