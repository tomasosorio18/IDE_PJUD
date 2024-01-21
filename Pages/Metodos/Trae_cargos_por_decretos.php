<?php include("../../Configuration/Connector.php");?>
<?php 
$año = Date("Y");
$sentenciaSQL= $conexion->prepare("
SELECT cargo_juez.CARGO_JUEZ_NOMBRE as cargo, 
COUNT(DISTINCT decreto.ID) AS cantidad
FROM decreto 
INNER JOIN juez ON decreto.JUEZ_ID = juez.JUEZ_ID
INNER JOIN cargo_juez on juez.CARGO_JUEZ_ID =cargo_juez.CARGO_JUEZ_ID
WHERE decreto.DECRETO_ANIO = :ANIO AND juez.JUEZ_FECHA_BAJA IS NULL AND NOT decreto.DECRETO_DETALLE = 'Anulado' 
GROUP BY cargo ORDER BY `cantidad` DESC;");
      $sentenciaSQL->bindParam(":ANIO",$año);
      $sentenciaSQL->execute();
      $datos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$data = array();


// $nombres_meses = array(
//     '02' ='Febrero',
//     '03' ='Marzo',
//     '04' ='Abril',
//     '05' = 'Mayo',
//     '06'= 'Junio',
//     '07'= 'Julio',
//     '08'= 'Agosto',
//     '09'= 'Septiembre',
//     '10'= 'Octubre',
//     '11' = 'Noviembre',
//     '12' = 'Diciembre'
// );

// Arreglo con los números de los meses (ejemplo)
foreach ($datos as $dato) {
	$data[] = $dato;
}



echo json_encode($data);

?>