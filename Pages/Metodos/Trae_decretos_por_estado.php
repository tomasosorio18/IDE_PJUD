<?php
include("../../Configuration/Connector.php");
$año = Date("Y");
$sentenciaPB = $conexion->prepare("
SELECT decreto.DECRETO_ESTADO as decreto_estado, 
COUNT(DISTINCT decreto.ID) AS cantidad, 
MONTH(DECRETO_FECHA_EMISION) AS mes 
FROM decreto 
WHERE decreto.DECRETO_ANIO = :DECRETO_ANIO AND decreto.DECRETO_ESTADO = 'Publico'
and not decreto.DECRETO_DETALLE = 'Anulado' 
GROUP BY mes,decreto_estado ORDER BY `cantidad` DESC;");
$sentenciaPB->bindParam(":DECRETO_ANIO", $año);
$sentenciaPB->execute();
$datospublicos = $sentenciaPB->fetchAll(PDO::FETCH_ASSOC);

$dataPB = array();

$monthNames = [
    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
];

foreach ($datospublicos as $datoPB) {
    $datoPB['mes'] = $monthNames[$datoPB['mes'] - 1];
    $dataPB[] = $datoPB;
}

$sentenciaPV = $conexion->prepare("
SELECT decreto.DECRETO_ESTADO as decreto_estado, 
COUNT(DISTINCT decreto.ID) AS cantidad, 
MONTH(DECRETO_FECHA_EMISION) AS mes 
FROM decreto 
WHERE decreto.DECRETO_ANIO = :DECRETO_ANIO AND decreto.DECRETO_ESTADO = 'Reservado'
and not decreto.DECRETO_DETALLE = 'Anulado' 
GROUP BY mes,decreto_estado ORDER BY `cantidad` DESC;");
$sentenciaPV->bindParam(":DECRETO_ANIO", $año);
$sentenciaPV->execute();
$datosprivados = $sentenciaPV->fetchAll(PDO::FETCH_ASSOC);
$dataPV = array();

foreach ($datosprivados as $datoPV) {
    $datoPV['mes'] = $monthNames[$datoPV['mes'] - 1];
    $dataPV[] = $datoPV;
}

$response = [
    'publicos' => $dataPB,
    'privados' => $dataPV
];

echo json_encode($response);
?>