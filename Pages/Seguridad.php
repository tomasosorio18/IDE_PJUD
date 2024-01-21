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
$PageTitle="Seguridad de perfil";

function customPageHeader(){?>
  <!--Arbitrary HTML Tags-->
<?php } ?>
<?php
if($_SESSION['rol'] == 1){
    include("Layouts/Cabecera_admin.php");}else{include("Layouts/Cabecera_user.php");}

?>

<?php   include("Modales_general/Modal_error.php");
                          include("Modales_general/Modal_exito.php");
                          include("Modales_general/Modal_alerta_generico.php"); ?>
<div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">
                <span class="text-muted fw-light">Home /</span> Seguridad
              </h4>
            <div class="row">
                <div class="col-12">
                  <div class="card mb-4">
                    <h5 class="card-header text-primary">Cambiar contraseña</h5>
                    <div class="card-body">
                      <form id="">
                        <div class="row">
                          <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                            <label class="form-label" for="currentPassword">Contraseña actual</label>
                            <div class="input-group input-group-merge has-validation">
                              <input class="form-control" type="password" name="contraseña_actual" id="contraseña_actual" placeholder="Ingrese su contraseña actual">
                              <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                            <label class="form-label" for="newPassword">Contraseña Nueva</label>
                            <div class="input-group input-group-merge has-validation">
                              <input class="form-control" type="password" id="contraseña_nueva" name="contraseña_nueva" placeholder="Ingrese su nueva contraseña">
                              <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                          </div>
              
                          <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                            <label class="form-label" for="confirmPassword">Confirmar nueva contraseña</label>
                            <div class="input-group input-group-merge has-validation">
                              <input class="form-control" type="password" name="confirmar_contraseña" id="confirmar_contraseña" placeholder="Confirme su nueva contraseña">
                              <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                          </div>
                          <input type="hidden" id="id" name="id" value="<?php echo $id;?>"></input>
                          <div class="col-12 mb-4">
                            <p class="fw-medium mt-2">La contraseña debe ser:</p>
                            <ul class="ps-3 mb-0">
                              <li class="mb-1">
                                Minimo de 8 caracteres - mientras más, mejor   
                              </li>
                              <li class="mb-1">Al menos una letra en mayuscula</li>
                              <li>Al menos un simbolo o número</li>
                            </ul>
                          </div>
                          <div class="col-12 mt-1">
                            <button type="button" id="btnCambiaPass" name="btnCambiaPass" class="btn btn-primary me-2">Guardar cambios</button>
                          </div>
                        </div>
                      <input type="hidden"></form>
                    </div>
                  </div>
                </div>
              </div>
       </div>

       <script>
                             $(document).ready(function () {
                              $('#btnCambiaPass').on('click',function(){
                                 
                                var actual_contraseña = $("#contraseña_actual").val();
                                var nueva_contraseña = $("#contraseña_nueva").val();
                                var confirmar_contraseña = $("#confirmar_contraseña").val();
                                var id = $("#id").val();
                                elem = $('#contraseña_nueva');
                                elem2 = $('#confirmar_contraseña');

                                if(nueva_contraseña.length < 8 ){   
                                  elem.css('border-color', 'red');                               
                                  elem2.css('border-color', 'red'); 
                                  toastr.options =
                                              {
                                              "closeButton" : true,
                                              "progressBar" : true
                                              }
                                              toastr.error("¡La contraseña nueva debe ser de un minimo de 8 caracteres!");

                                }else if(nueva_contraseña.search(/[0-9]/) < 0 && nueva_contraseña.search(/[^a-zA-Z0-9]/) < 0){
                                  elem.css('border-color', 'red'); 
                                  elem2.css('border-color', 'red'); 
                                  toastr.options =
                                              {
                                              "closeButton" : true,
                                              "progressBar" : true
                                              }
                                              toastr.error("¡La contraseña debe contener al menos un número o un simbolo!");
                                }else if(nueva_contraseña.search(/[A-Z]/) < 0){
                                  elem.css('border-color', 'red'); 
                                  elem2.css('border-color', 'red'); 
                                  toastr.options =
                                              {
                                              "closeButton" : true,
                                              "progressBar" : true
                                              }
                                              toastr.error("¡La contraseña debe contener al menos una mayuscula!");
                                }else if(confirmar_contraseña != nueva_contraseña){
                                  elem = $('#contraseña_nueva');
                                  elem.css('border-color', 'red'); 
                                  elem2 = $('#confirmar_contraseña');
                                  elem2.css('border-color', 'red'); 
                                  toastr.options =
                                              {
                                              "closeButton" : true,
                                              "progressBar" : true
                                              }
                                              toastr.error("¡Las contraseñas no coincidien!");

                                  }else{
                                  elem.css('border-color', '');
                                  elem2.css('border-color', '');

                                  $.ajax({

                                  type: 'post',
                                  url: 'Metodos/Actualiza_contrasena.php',
                                  data: {
                                  'contrasena_actual': actual_contraseña,
                                  'contrasena_nueva': nueva_contraseña,
                                  'id':id
                                  },
                                  success : function(response){

                                      if($.trim(response) === "1"){
                                          toastr.options =
                                              {
                                              "closeButton" : true,
                                              "progressBar" : true
                                              }     
                                              toastr.success("¡Contraseña actualizada correctamente!"); 
                                              $('#span').empty().append("¡Contraseña actualizada correctamente!");           
                                          $('#modalexito').modal('show');
                                      }
                                      if($.trim(response) === "2"){
                                          toastr.options =
                                              {
                                              "closeButton" : true,
                                              "progressBar" : true
                                              }
                                              toastr.error("¡Error al actualizar contraseña!");   
                                              $('#span').empty().append("¡Error al actualizar datos!");
                                              $('#modalerror').modal('show');                                
                                      }
                                      if($.trim(response) === "3"){
                                          toastr.options =
                                              {
                                              "closeButton" : true,
                                              "progressBar" : true
                                              }
                                          toastr.error("¡Contraseña incorrecta!"); 
                                          elem3 = $('#contraseña_actual');
                                          elem3.css('border-color', 'red');
                                          $('#span').empty().append("¡La contraseña proporcionada es incorrecta!");
                                          $('#modalerror').modal('show'); 
                                                                    
                                      }
                                  }
                                  });
                                }

                            
                                });
                             });
                          </script>

       <?php 
//traemos el pie con el include
if($_SESSION['rol'] == 1){
    include("Layouts/Pie_admin.php");}else{include("Layouts/Pie_user.php");}

?>