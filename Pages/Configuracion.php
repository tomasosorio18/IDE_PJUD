<?php
//se inicia la sesion
session_start();
//se pregunta si existe la variable 'logeado' en las SESSIONS
if (isset($_SESSION['logeado']) & $_SESSION['logeado'] = true) {
    $id= $_SESSION['id'];
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
$PageTitle="Configuracion de perfil";

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
$usuario_id = $datos["USUARIO_ID"];
$nombre_usuario= $datos["USUARIO_NOMBRE"];
$apellido_usuario = $datos["USUARIO_APELLIDO"];
$correo_usuario = $datos["USUARIO_CORREO"];
$fecha_usuario = $datos["USUARIO_CREADO_EN"];
$tribunal = $datos["TRIBUNAL_NOMBRE"];
$rol_usuario = $datos["ROL_NOMBRE"];
$letra_nombre =mb_substr($nombre_usuario, 0, 1);
$letra_Apellido =mb_substr($apellido_usuario, 0, 1);
?>

<div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">
                <span class="text-muted fw-light">Perfil /</span> Configuración perfil
              </h4>
            <div class="row">
                <div class="col-12">
                  <div class="card mb-4">
                    <h5 class="card-header text-primary">Detalles del perfil</h5>
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="../Assets/images/user.png" alt="user-avatar" class="d-block rounded" height="120" width="120" id="uploadedAvatar">
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Subir una foto</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input type="file" id="upload" class="account-file-input" hidden="" accept="image/png, image/jpeg">
                          </label>
                          <button type="button" class="btn btn-label-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Eliminar foto</span>
                          </button>
              
                          <p class="text-muted mb-0">Solo se permiten formatos JPG, PNG. Con un tamaño maximo de 800K</p>
                        </div>
                      </div>
                    </div>
                    <hr class="my-0">
                    <div class="card-body">
                    
                      <form id="formulario" action="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                        <input type="hidden" id="id" name="id" value="<?php echo $usuario_id;?>" autofocus="">
                          <div class="mb-3 col-md-6 fv-plugins-icon-container">
                            <label for="firstName" class="form-label">Nombre</label>
                            <input class="form-control" type="text" id="nombre" name="nombre" value="<?php echo $nombre_usuario;?>" autofocus="">
                          <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                          <div class="mb-3 col-md-6 fv-plugins-icon-container">
                            <label for="lastName" class="form-label">Apellido</label>
                            <input class="form-control" type="text" name="apellido" id="apellido" value="<?php echo $apellido_usuario;?>">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Correo</label>
                            <input class="form-control" type="text" id="correo" name="correo" value="<?php echo $correo_usuario;?>" placeholder="@example.com">
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">Tribunal</label>
                            <input type="text" class="form-control" id="organization" name="organization" value="<?php echo $tribunal;?>" disabled>
                          </div>            
                        </div>
                      
                        <div class="mt-2">
                          <button type="button" id="btnGuardaCambios" name="btnGuardaCambios" class="btn btn-primary me-2">Guardar cambios</button>
                        </div>
                    </form>
                         
                  <?php   include("../Pages/Modales_general/Modal_error.php");
                          include("../Pages/Modales_general/Modal_exito.php");
                          include("../Pages/Modales_general/Modal_alerta_generico.php"); ?>
                  
                    
                          <script>
                             $(document).ready(function () {
                              $('#btnGuardaCambios').on('click',function(){

                                var nombre = $("#nombre").val();
                                var apellido = $("#apellido").val();
                                var correo = $("#correo").val();
                                var id = $("#id").val();

                              $.ajax({
                                  type: 'post',
                                  url: 'Metodos/Modifica_Datos_Usuario.php',
                                  data: {
                                  'nombre': nombre,
                                  'apellido': apellido,
                                  'correo': correo,
                                  'id': id
                                  },
                                  success : function(response){
                                      
                                      if($.trim(response) === "1"){
                                          toastr.options =
                                              {
                                              "closeButton" : true,
                                              "progressBar" : true
                                              }     
                                              toastr.success("¡Datos actualizados!"); 
                                              $('#span').empty().append("¡Datos actualizados!");           
                                          $('#modalexito').modal('show');
                                      }
                                      if($.trim(response) === "2"){
                                          toastr.options =
                                              {
                                              "closeButton" : true,
                                              "progressBar" : true
                                              }
                                              toastr.error("¡Error al actualizar datos!");   
                                              $('#span').empty().append("¡Error al actualizar datos!");
                                              $('#modalerror').modal('show');                                
                                      }
                                      if($.trim(response) === "3"){
                                          toastr.options =
                                              {
                                              "closeButton" : true,
                                              "progressBar" : true
                                              }
                                          toastr.warning("¡Este correo ya ha esta ocupado!"); 
                                          $('#alerta').empty().append("¡Este correo ya ha esta ocupado!");
                                          $('#modalalerta').modal('show'); 
                                                                    
                                      }
                                  }
                                  });
                                });
                             });
                          </script>
                 
                    </div>
                    <!-- /Account -->
                  </div>
                </div>
              </div>
       </div>
       <?php 
//traemos el pie con el include
if($_SESSION['rol'] == 1){
    include("Layouts/Pie_admin.php");}else{include("Layouts/Pie_user.php");}

?>