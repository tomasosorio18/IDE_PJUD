<?php

$host="localhost";
$bd="pjud_bd";
$usuario="root";
$contraseña="";


try {
    $conexion=new PDO("mysql:host=localhost:3308;dbname=$bd",$usuario,$contraseña);
    if($conexion){
        }
} catch (Exception $ex) {
    echo $ex->getMessage();
}

?>