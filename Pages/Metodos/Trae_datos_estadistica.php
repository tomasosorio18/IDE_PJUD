<?php include("../../Configuration/Connector.php");?>
<?php 
$año = Date("Y");
$sentenciaSQL= $conexion->prepare("SELECT tipo_decreto.DECRETO_TIPO_NOMBRE as decreto_nombre, COUNT(DISTINCT decreto.ID) AS cantidad FROM decreto 
inner JOIN tipo_decreto ON decreto.DECRETO_TIPO_ID = tipo_decreto.DECRETO_TIPO_ID
WHERE decreto.DECRETO_ANIO= :ANIO AND NOT decreto.DECRETO_DETALLE = 'Anulado'
GROUP BY decreto_nombre ORDER BY `cantidad` DESC;");
      $sentenciaSQL->bindParam(":ANIO",$año);
      $sentenciaSQL->execute();
      $datos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$data = array();
foreach ($datos as $dato) {
	$data[] = $dato;
}
echo json_encode($data);
?>