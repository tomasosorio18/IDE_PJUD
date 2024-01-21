<?php include("../../Configuration/Connector.php");?>
<?php  

if ((isset($_POST['contrasena_actual']))?$_POST['contrasena_actual']:"") {
    $contrasena_actual =(isset($_POST['contrasena_actual']))?$_POST['contrasena_actual']:"";

}else{
    $contrasena_actual= "Default";
}
if ((isset($_POST['contrasena_nueva']))?$_POST['contrasena_nueva']:"") {
    $contrasena_nueva =(isset($_POST['contrasena_nueva']))?$_POST['contrasena_nueva']:"";
}else{
    $contrasena_nueva= "Default";
}
if ((isset($_POST['id']))?$_POST['id']:"") {
    $id =(isset($_POST['id']))?$_POST['id']:"";

}else{
    $id= "Default";
}


try {
    $select = $conexion->prepare('SELECT * FROM usuario WHERE USUARIO_ID = :USUARIO_ID');
    $select->bindParam(":USUARIO_ID", $id);
    $select->execute();
    $dato = $select->fetch(PDO::FETCH_ASSOC);
    // Obtén el correo actual del usuario desde la base de datos
    $contraseña_bd = $dato["USUARIO_CONTRASENA"]; // Aquí debes obtener el correo actual del usuario

    $contraseña_correcta = 0;
            if (password_verify($contrasena_actual, $contraseña_bd)) {
                $contraseña_correcta = 1;
            }

    if($contraseña_correcta == 1){
        if (! empty($contrasena_nueva)) {

            // PHP's password_hash is the best choice to use to store passwords
            // do not attempt to do your own encryption, it is not safe
            $hashedPassword = password_hash($contrasena_nueva, PASSWORD_DEFAULT); 

            $sentenciaSQL = $conexion->prepare(
                "UPDATE usuario SET USUARIO_CONTRASENA = :USUARIO_CONTRASENA WHERE USUARIO_ID = :USUARIO_ID;");
        
            $sentenciaSQL->bindParam(':USUARIO_ID', $id);  
            $sentenciaSQL->bindParam(':USUARIO_CONTRASENA', $hashedPassword);  
            $sentenciaSQL->execute();
        
            echo "1"; // Éxito en la actualización
        }else{
            $hashedPassword= "Default";
        }

    }else{
        echo "3";
    }
 

} catch (\Throwable $th) {
    echo "2"; // Error en la actualización
}
