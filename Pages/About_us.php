<?php
//se inicia la sesion
session_start();
// aca se pregunta si la variable de SESSIONS tiene asignado un estado logeado como true
if (isset($_SESSION['logeado']) && $_SESSION['logeado'] == true) {
    //si es asi traemos la variable name y apellido almacenada en SESSIONS
    $id = $_SESSION['id'];
    $email=$_SESSION['name'];
    $apellido=$_SESSION['apellido'];
    $rol= $_SESSION['rol'];
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
 if($_SESSION['rol'] == 1){
    include("Layouts/Cabecera_admin.php");}else{include("Layouts/Cabecera_user.php");}

?>




    <div class="row">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Estadisticas /</span>Acerca de mi</h4>

        <div class="col-lg-6 col-12 mb-4" >
      
                    </div> 
    </div>



<?php 
//traemos el pie con el include
if($_SESSION['rol'] == 1){
    include("Layouts/Pie_admin.php");}else{include("Layouts/Pie_user.php");}

?>
