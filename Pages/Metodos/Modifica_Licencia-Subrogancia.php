<?php session_start();
$INICIALES= $_SESSION['iniciales'];
?>
<?php include("../../Configuration/Connector.php");?>
<?php  

$año = date("Y"); 

if ((isset($_POST['txtcargo2']))?$_POST['txtcargo2']:"") {
    $selectCargo2 =(isset($_POST['txtcargo2']))?$_POST['txtcargo2']:"";

}else{
    $cargo= "Default";
}
if ((isset($_POST['txtEstado']))?$_POST['txtEstado']:"") {
    $txtEstado =(isset($_POST['txtEstado']))?$_POST['txtEstado']:"";

}else{
    $txtEstado= "Default";
}

if ((isset($_POST['txtAusente']))?$_POST['txtAusente']:"") {
    $txtAusente =(isset($_POST['txtAusente']))?$_POST['txtAusente']:"";

}else{
    $txtAusente= "Default";
}

if ((isset($_POST['txtJuez2']))?$_POST['txtJuez2']:"") {
    $selectJuez2 =(isset($_POST['txtJuez2']))?$_POST['txtJuez2']:"";

}else{
    $juez= "Default";
}
if ((isset($_POST['turidLS']))?$_POST['turidLS']:"") {
    $turidLS= (isset($_POST['turidLS']))?$_POST['turidLS']:"";
}else{
    $turidLS= "Default";
}
if ((isset($_POST['txtdata2']))?$_POST['txtdata2']:"") {
    $txtdate2 = (isset($_POST['txtdata2']))?$_POST['txtdata2']:"";
    setlocale(LC_ALL,"es");

$fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
}else{
    $txtdate2= "Default";
}

if ((isset($_POST['txtTipo2']))?$_POST['txtTipo2']:"") {
    $selectDecreto2 = (isset($_POST['txtTipo2']))?$_POST['txtTipo2']:""; 
}else{
    $selectDecreto2= "Default";
} 
if ((isset($_POST['detalleLicenciassubrogacion']))?$_POST['detalleLicenciassubrogacion']:"") {
    $detalleLS =(isset($_POST['detalleLicenciassubrogacion']))?$_POST['detalleLicenciassubrogacion']:"";
}else{
    $detalleLS= "Default";
}

if ((isset($_POST['txtdecre']))?$_POST['txtdecre']:"") {
    $decrenumber =(isset($_POST['txtdecre']))?$_POST['txtdecre']:"";
}else{
    $decrenumber= "Default";
}
    try {
            $sentenciaSQL=$conexion->prepare(
            "UPDATE decreto SET JUEZ_ID = :JUEZ_ID,
            DECRETO_TIPO_ID = :DECRETO_TIPO_ID,
            DECRETO_FECHA_EMISION = :DECRETO_FECHA_EMISION,
            FUNCIONARIO_ID= :FUNCIONARIO_ID,TUR_ID = :TUR_ID, 
            DECRETO_DETALLE = :DECRETO_DETALLE,
            DECRETO_EMITIDA_POR = :DECRETO_EMITIDA_POR,
            DECRETO_ESTADO = :DECRETO_ESTADO,
            DECRETO_ANIO = :DECRETO_ANIO WHERE DECRETO_N_CORRELATIVO = :DECRETO_N_CORRELATIVO AND DECRETO_ANIO = :DECRETO_ANIO;");
            $sentenciaSQL->bindParam(':DECRETO_N_CORRELATIVO',$decrenumber,PDO::PARAM_INT);   
            $sentenciaSQL->bindParam(':JUEZ_ID',$selectJuez2,PDO::PARAM_INT);
            $sentenciaSQL->bindParam(':DECRETO_TIPO_ID',$selectDecreto2,PDO::PARAM_INT);
            $sentenciaSQL->bindParam(':DECRETO_FECHA_EMISION',$txtdate2,PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':FUNCIONARIO_ID',$txtAusente,PDO::PARAM_INT);
            $sentenciaSQL->bindParam(':DECRETO_DETALLE',$detalleLS,PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':TUR_ID',$turidLS);
            $sentenciaSQL->bindParam(':DECRETO_EMITIDA_POR',$INICIALES);
            $sentenciaSQL->bindParam(':DECRETO_ESTADO',$txtEstado,PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':DECRETO_ANIO',$año,PDO::PARAM_STR);

          
            $sentenciaSQL->execute();
            
            echo "1";
          
    } catch (\Throwable $th) {
        echo $decrenumber . " ". $selectJuez2 ." ". $selectDecreto2 ." ". $txtdate2 ." ". $txtAusente ." ". $detalleLS ." ". $turidLS ." ". $INICIALES ." ".$txtEstado ." ".$año;
    }






?> 

