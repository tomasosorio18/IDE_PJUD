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


    $nombre_archivo = 'prueba.txt';
    $contenido = "Añade esto al archivo\n";
    
    // Primero vamos a asegurarnos de que el archivo existe y es escribible.
    if (is_writable($nombre_archivo)) {
    
        // En nuestro ejemplo estamos abriendo $nombre_archivo en modo de adición.
        // El puntero al archivo está al final del archivo
        // donde irá $contenido cuando usemos fwrite() sobre él.
        if (!$gestor = fopen($nombre_archivo, 'a')) {
             echo "No se puede abrir el archivo ($nombre_archivo)";
             exit;
        }
    
        // Escribir $contenido a nuestro archivo abierto.
        if (fwrite($gestor, $contenido) === FALSE) {
            echo "No se puede escribir en el archivo ($nombre_archivo)";
            exit;
        }
    
        echo "Éxito, se escribió ($contenido) en el archivo ($nombre_archivo)";
    
        fclose($gestor);
    
    } else {
        echo "El archivo $nombre_archivo no es escribible";
    }
    
//traemos el pie con el include
if($_SESSION['rol'] == 1){
    include("Layouts/Pie_admin.php");}else{include("Layouts/Pie_user.php");}

?>