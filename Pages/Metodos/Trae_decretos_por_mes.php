<?php include("../../Configuration/Connector.php");?>

<?php 
$año = Date("Y");
$sentenciaSQL= $conexion->prepare("SELECT MONTH(DECRETO_FECHA_EMISION) AS mes, COUNT(*) AS cantidad FROM decreto WHERE not decreto.DECRETO_DETALLE = 'Anulado' AND decreto.DECRETO_ANIO = :ANIO
GROUP BY mes ORDER BY mes;");
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
$monthNames = [
    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
];

// Arreglo con los números de los meses (ejemplo)
foreach ($datos as $dato) {
	$data[] = $dato;
}


for ($i = 0; $i < count($data); $i++) {
    $numMes = $data[$i]['mes'];
    $data[$i]['mes'] = $monthNames[$numMes - 1];
}

echo json_encode($data);

?>