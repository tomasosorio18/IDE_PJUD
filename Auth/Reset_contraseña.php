<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/PHPMailer-master/src/Exception.php';
require '../Assets/PHPMailer-master/src/PHPMailer.php';
require '../Assets/PHPMailer-master/src/SMTP.php';


if(isset($_POST["btnRestablece"])){
$selector = bin2hex(random_bytes(8));
$token = random_bytes(32);
$url = "http://Localhost\IDE_PJUD\Auth\Crear_nueva_contraseña.php?selector=". $selector. "&validator=" . bin2hex($token);
$expira = date("U")  + 1800;

include("../Configuration/Connector.php");
$correo = $_POST["txtEmail"];
$SentenciaSQL = $conexion->prepare("SELECT * FROM usuario WHERE USUARIO_CORREO = :CORREO");
$SentenciaSQL->bindParam(":CORREO", $correo);
$SentenciaSQL->execute();
if($SentenciaSQL->rowCount() > 0){

    $Sentencia2SQL=$conexion->prepare("INSERT INTO reset_contrasena (RC_CORREO,RC_TOKEN,RC_EXPIRA_EN,RC_SELECTOR) VALUES (:CORREO,:TOKEN,:EXPIRA_EN,:SELECTOR);");
    $hashedToken= password_hash($token,PASSWORD_DEFAULT);
    $Sentencia2SQL->bindParam(":CORREO",$correo);
    $Sentencia2SQL->bindParam(":TOKEN",$hashedToken);
    $Sentencia2SQL->bindParam(":EXPIRA_EN",$expira);
    $Sentencia2SQL->bindParam(":SELECTOR",$selector);
    $Sentencia2SQL->execute();
    if($Sentencia2SQL->rowCount() > 0){

        $phpmailer = new PHPMailer();
        try {
        //Server settings                 //Enable verbose debug output
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.gmail.com';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 587;
        $phpmailer->Username = 'juanperez.00a5@gmail.com';
        $phpmailer->Password = 'nbbacdlwddjykxbi';
   
        $phpmailer-> addAddress('nthingelse@gmail.com');
        $phpmailer->isHTML(true);                                  //Set email format to HTML
        $phpmailer->Subject = 'Reestablece tu contraseña.';
        $phpmailer->Body = 'Recibimos una solicitud de reestablecimiento de contraseña <b>Si no solicitó el restablecimiento de esta, ignore este correo.</b>' .'<br>'. '<p>Aquí esta el link para reestablecer tu contraseña: </br>' . '<a href="' . $url . '">' . $url . '</a></p>';


    
        $phpmailer->send();
        header("Location: Olvide_contraseña.php?reset=success");
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
    }
  
    }else{
    header("Location: Olvide_contraseña.php?reset=sql");
    }
}else{
    header("Location: Olvide_contraseña.php?reset=error");
}

  

} else {
    header("Location: Olvide_contraseña.php?reset=error");
}




