<?php include("../../Configuration/Connector.php");?>
<?php  

if ((isset($_POST['nombre']))?$_POST['nombre']:"") {
    $nombre =(isset($_POST['nombre']))?$_POST['nombre']:"";

}else{
    $nombre= "Default";
}
if ((isset($_POST['id']))?$_POST['id']:"") {
    $id =(isset($_POST['id']))?$_POST['id']:"";

}else{
    $id= "Default";
}
if ((isset($_POST['apellido']))?$_POST['apellido']:"") {
    $apellido =(isset($_POST['apellido']))?$_POST['apellido']:"";

}else{
    $apellido= "Default";
}

if ((isset($_POST['correo']))?$_POST['correo']:"") {
    $correo =(isset($_POST['correo']))?$_POST['correo']:"";

}else{
    $correo= "Default";
}

function ifCorreoExists($correo, $id) {
    include("../../Configuration/Connector.php");
    $select = $conexion->prepare('SELECT * FROM usuario WHERE USUARIO_CORREO = :USUARIO_CORREO AND USUARIO_ID <> :USUARIO_ID');
    $select->bindParam(":USUARIO_CORREO", $correo);
    $select->bindParam(":USUARIO_ID", $id);
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        return false; // El correo no está en uso por otro usuario
    } else {
        return true; // El correo está en uso por otro usuario
    }
}

try {
    $select = $conexion->prepare('SELECT * FROM usuario WHERE USUARIO_ID = :USUARIO_ID');
    $select->bindParam(":USUARIO_ID", $id);
    $select->execute();
    $dato = $select->fetch(PDO::FETCH_ASSOC);
    // Obtén el correo actual del usuario desde la base de datos
    $correo_usuario_actual = $dato["USUARIO_CORREO"]; // Aquí debes obtener el correo actual del usuario

    if ($correo != $correo_usuario_actual) {
        // Si el nuevo correo es diferente al correo actual, verifica si está en uso
        $ifCorreoExists = ifCorreoExists($correo, $id);

        if ($ifCorreoExists) {
            echo "3"; // Indicador de que el correo está ocupado por otro usuario
            exit();
        }
    }

    // Si el nuevo correo no está en uso o si no ha cambiado, procede con la actualización
    $sentenciaSQL = $conexion->prepare(
        "UPDATE usuario SET USUARIO_NOMBRE = :USUARIO_NOMBRE, USUARIO_APELLIDO = :USUARIO_APELLIDO, USUARIO_CORREO = :USUARIO_CORREO WHERE USUARIO_ID = :USUARIO_ID;"
    );

    $sentenciaSQL->bindParam(':USUARIO_ID', $id);  
    $sentenciaSQL->bindParam(':USUARIO_CORREO', $correo);  
    $sentenciaSQL->bindParam(':USUARIO_APELLIDO', $apellido);  
    $sentenciaSQL->bindParam(':USUARIO_NOMBRE', $nombre);  
    $sentenciaSQL->execute();

    echo "1"; // Éxito en la actualización

} catch (\Throwable $th) {
    echo "2"; // Error en la actualización
}
