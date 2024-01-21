<?php
//se inicia la sesion
session_start();
//se pregunta si existe la variable 'logeado' en las SESSIONS
if (isset($_SESSION['logeado']) & $_SESSION['logeado'] = true) {
    $id=$_SESSION['id'];
    $email=$_SESSION['name'];
    $apellido=$_SESSION['apellido'];
    $rol= $_SESSION['rol'];
    $letra_nombre =mb_substr($email, 0, 1);
    $letra_Apellido =mb_substr($apellido, 0, 1);

  
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

?>
<!-- incluimos la conexion con la bd  -->
<?php
//incluimos la conexion con la bd 
include("../Configuration/Connector.php");
include("Metodos/Trae_datos_usuario.php");?>

<?php
// esta funcion permite asignarle un titulo a cada pagina, mediante el include de la cabecera, sin tener que traer todo el html
$PageTitle="Perfil";

function customPageHeader(){?>
  <!--Arbitrary HTML Tags-->
<?php } ?>
<?php
if($_SESSION['rol'] == 1){
    include("Layouts/Cabecera_admin.php");}else{include("Layouts/Cabecera_user.php");}

?>

<?php 
$idusuario = $id;
$sentencia= $conexion->prepare("SELECT usuario.USUARIO_ID, usuario.USUARIO_NOMBRE,usuario.USUARIO_APELLIDO, usuario.USUARIO_CORREO, usuario.USUARIO_CREADO_EN, tribunal.TRIBUNAL_NOMBRE, rol.ROL_NOMBRE FROM usuario 
INNER JOIN tribunal_usu_rol on usuario.USUARIO_ID = tribunal_usu_rol.USUARIO_ID
INNER JOIN tribunal on tribunal_usu_rol.TRIBUNAL_ID = tribunal.TRIBUNAL_ID
INNER JOIN rol on tribunal_usu_rol.ROL_ID = rol.ROL_ID
WHERE usuario.USUARIO_ID = :USUARIO_ID");
$sentencia->bindParam(':USUARIO_ID',$idusuario);
$sentencia->execute();
$datos = $sentencia->fetch(PDO::FETCH_LAZY);
$nombre_usuario= $datos["USUARIO_NOMBRE"];
$apellido_usuario = $datos["USUARIO_APELLIDO"];
$correo_usuario = $datos["USUARIO_CORREO"];
$fecha_usuario = $datos["USUARIO_CREADO_EN"];
$tribunal = $datos["TRIBUNAL_NOMBRE"];
$rol_usuario = $datos["ROL_NOMBRE"];
$letra_nombre =mb_substr($nombre_usuario, 0, 1);
$letra_Apellido =mb_substr($apellido_usuario, 0, 1);
?>



<div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
      <div class="layout-container">          
        <!-- Layout container --> 
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">
                <span class="text-muted fw-light">Home /</span> Perfil
              </h4>
            <div class="row">
                <div class="col-6">
                  <div class="card mb-4">
                    <h5 class="card-header text-primary">Detalles del perfil</h5>
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="../Assets/images/user.png" alt="user-avatar" class="d-block rounded mb-4"height="100" width="100" id="uploadedAvatar">
                        <div class="button-wrapper">
                         
                           <h4><?php echo $nombre_usuario ." ". $apellido_usuario?> <b><?php echo "(".$letra_nombre . $letra_Apellido.") ";?></b>
                           <?php if ($rol_usuario == "Administrador"){
                            ?><span class="badge bg-label-warning me-1"><?php echo $rol_usuario;?></span>
                            <?php }else{?>
                              <span class="badge bg-label-info me-1"><?php echo $rol_usuario;?></span>
                           <?php }?>
                            
                           </h4>
                 
                    

                      
                        </div>
                      </div>
                       <hr class="my-0">
                        <small class="text-muted text-uppercase">Acerca de mi</small>
                        <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3"><i class="bx bx-user"></i><span class="fw-medium mx-2">Nombre Completo:</span> <span><b><?php echo $nombre_usuario ." ". $apellido_usuario;?></b></span></li>
                        <li class="d-flex align-items-center mb-3"><i class="bx bx-check"></i><span class="fw-medium mx-2">Estado:</span> <span><b>Activo</b></span></li>
                        <li class="d-flex align-items-center mb-3"><i class="bx bx-star"></i><span class="fw-medium mx-2">Rol:</span> <span><b><?php echo $rol_usuario;?></b></span></li>
                        <li class="d-flex align-items-center mb-3"><i class="bx bx-flag"></i><span class="fw-medium mx-2">Tribunal:</span> <span><b><?php echo $tribunal;?></b></span></li>
                        <li class="d-flex align-items-center mb-3"><i class="fa-regular fa-location-dot"></i><span class="fw-medium mx-2">Creado en:</span> <span><b><?php echo $fecha_usuario;?></b></span></li>
                        </ul>
                        <small class="text-muted text-uppercase">Contacto</small>
                        <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3"><i class="bx bx-envelope"></i><span class="fw-medium mx-2">Correo:</span> <span><b><?php echo $correo_usuario;?></b></span></li>
                        </ul>          
                    </div>
                    </div>
                </div>
              </div>
       </div>
      </div>
    </div>

    <?php 
//traemos el pie con el include
if($_SESSION['rol'] == 1){
    include("Layouts/Pie_admin.php");}else{include("Layouts/Pie_user.php");}

?>