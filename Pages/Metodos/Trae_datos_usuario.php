<?php
//  traemos la cantidad de decretos de cierto tipo, que fueron emitidos
$sentenciaSQL=$conexion->prepare("SELECT * FROM usuario INNER JOIN tribunal_usu_rol on usuario.USUARIO_ID = tribunal_usu_rol.USUARIO_ID
WHERE usuario.USUARIO_ID = :USUARIO_ID AND tribunal_usu_rol.TUR_FECHA_FIN IS NULL; ");
$sentenciaSQL->bindParam(":USUARIO_ID",$id);
$sentenciaSQL->execute();


$datos_usuario = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

if ($datos_usuario) {
    $nombre_usuario = $datos_usuario["USUARIO_NOMBRE"];
    $apellido_usuario = $datos_usuario["USUARIO_APELLIDO"];
    $correo_usuario = $datos_usuario["USUARIO_CORREO"];
    $tribunal_usuario = $datos_usuario["USUARIO_CORREO"];
    $Letra_Nombre =mb_substr($nombre_usuario, 0, 1);
    $Letra_Apellido =mb_substr($apellido_usuario, 0, 1);
    $Iniciales = $Letra_Nombre . $Letra_Apellido;
} else {
    // Manejar el caso en que no se encontraron datos
    // Por ejemplo, mostrar un mensaje de error o tomar una acción predeterminada
    echo "No se encontraron datos para este usuario.";
}


 ?>