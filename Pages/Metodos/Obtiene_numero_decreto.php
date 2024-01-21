<?php
$año = date("Y");


$sentenciaSQL=$conexion->prepare("SELECT DECRETO_N_CORRELATIVO, DECRETO_ANIO FROM `decreto` WHERE DECRETO_ANIO = :DECRETO_ANIO
ORDER BY DECRETO_N_CORRELATIVO DESC");
$sentenciaSQL->bindParam(":DECRETO_ANIO",$año);
$sentenciaSQL->execute();
$data=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

if($data){
    $añobd=$data['DECRETO_ANIO'];
    if($añobd == $año){
        $id2= $data['DECRETO_N_CORRELATIVO'];
        $id= $id2 + 1;
        echo $id;}
}else{
    echo $id = 1;
}

  ?>