<?php include("../../Configuration/Connector.php");
session_start();
//se pregunta si existe la variable 'logeado' en las SESSIONS
if (isset($_SESSION['logeado'])) {
    $email=$_SESSION['name'];
    $apellido=$_SESSION['apellido'];
    $rol= $_SESSION['rol'];
    $letra_nombre =mb_substr($email, 0, 1);
    $letra_Apellido =mb_substr($apellido, 0, 1);
    $anio = Date("Y");
    $_SESSION['iniciales'] = $letra_nombre . $letra_Apellido;
    $iniciales = $_SESSION['iniciales'];
    session_write_close();
} else {
    // Ya que el nombre no esta asignado en una session, el usuario no esta logeado
    // Y esta intentando ingresar sin autorizacion
    // Asi que limpiamos todas las variables de session y lo enviamos al login.
    session_unset();
    session_write_close();
    $url = "../Index.php?sesion=permisos";
    header("Location: $url");
}
?>
<?php 
$anio = Date("Y");
$sentenciaSQL= $conexion->prepare("
SELECT tipo_decreto.DECRETO_TIPO_NOMBRE as tipo_de_decreto, COUNT(DISTINCT decreto.ID) AS cantidad FROM `decreto`
INNER JOIN tipo_decreto on decreto.DECRETO_TIPO_ID = tipo_decreto.DECRETO_TIPO_ID
WHERE decreto.DECRETO_ANIO = :ANIO and decreto.DECRETO_EMITIDA_POR = :RESPONSABLE and not decreto.DECRETO_DETALLE = 'Anulado'
GROUP BY tipo_de_decreto ORDER BY `cantidad` DESC;");
$sentenciaSQL->bindParam(":ANIO",$anio);
$sentenciaSQL->bindParam(":RESPONSABLE",$iniciales);
$sentenciaSQL->execute();
$datos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$labels = [];
$series = [];

foreach ($datos as $dato) {
    $labels[] = $dato['tipo_de_decreto'];
    $series[] = $dato['cantidad'];
}

// Ahora tienes dos arrays: $labels y $series, que contienen las etiquetas y series respectivamente
// Puedes pasar estos datos a ApexCharts

$dataForApexCharts = [
    'labels' => $labels,
    'series' => $series
];

echo json_encode($dataForApexCharts);
// echo json_encode($data);
?>