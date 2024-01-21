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

if ((isset($_POST['txtJuez2']))?$_POST['txtJuez2']:"") {
    $selectJuez2 =(isset($_POST['txtJuez2']))?$_POST['txtJuez2']:"";

}else{
    $juez= "Default";
}

if ((isset($_POST['turidMA']))?$_POST['turidMA']:"") {
    $turidMA = (isset($_POST['turidMA']))?$_POST['turidMA']:"";
}else{
    $turidMA= "Default";
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
if ((isset($_POST['detalleMesaAyuda']))?$_POST['detalleMesaAyuda']:"") {
    $detalleMesaAyuda =(isset($_POST['detalleMesaAyuda']))?$_POST['detalleMesaAyuda']:"";
}else{
    $detalleMesaAyuda= "Default";
}

if ((isset($_POST['txtdecre']))?$_POST['txtdecre']:"") {
    $decrenumber =(isset($_POST['txtdecre']))?$_POST['txtdecre']:"";
}else{
    $decrenumber= "Default";
}

$isDecretoExists = isDecretoExists($decrenumber);
if ($isDecretoExists) {
   echo "3";
} else {
    try {
        $sentenciaSQL=$conexion->prepare(
            "INSERT INTO decreto(
                DECRETO_N_CORRELATIVO,
                JUEZ_ID,
                DECRETO_TIPO_ID,
                DECRETO_FECHA_EMISION,
                TUR_ID,
                FUNCIONARIO_ID,
                ADJUNTO_INI_ID,
                ADJUNTO_FIRMA_ID,
                DECRETO_DETALLE,
                DECRETO_EMITIDA_POR,
                DECRETO_ESTADO,
                DECRETO_ANIO) VALUES (
                    :DECRETO_N_CORRELATIVO,
                    :JUEZ_ID,
                    :DECRETO_TIPO_ID,
                    :DECRETO_FECHA_EMISION,
                    :TUR_ID,
                    null,
                    null,
                    null,
                    :DECRETO_DETALLE,
                    :DECRETO_EMITIDA_POR,
                    :DECRETO_ESTADO,
                    :DECRETO_ANIO);");
            $sentenciaSQL->bindParam(':DECRETO_N_CORRELATIVO',$decrenumber,PDO::PARAM_INT);   
            $sentenciaSQL->bindParam(':JUEZ_ID',$selectJuez2,PDO::PARAM_INT);
            $sentenciaSQL->bindParam(':DECRETO_TIPO_ID',$selectDecreto2,PDO::PARAM_INT);
            $sentenciaSQL->bindParam(':DECRETO_FECHA_EMISION',$txtdate2,PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':DECRETO_DETALLE',$detalleMesaAyuda,PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':TUR_ID',$turidMA,PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':DECRETO_EMITIDA_POR',$INICIALES);
            $sentenciaSQL->bindParam(':DECRETO_ESTADO',$txtEstado,PDO::PARAM_STR);
            $sentenciaSQL->bindParam(':DECRETO_ANIO',$año,PDO::PARAM_STR);

            $sentenciaSQL->execute();
            
            echo "1";
    } catch (\Throwable $th) {
            echo "2";
    }


}

?>

<?php
function isDecretoExists($number){
    $año = date("Y");
    include("../../Configuration/Connector.php");
    $select = $conexion->prepare('SELECT DECRETO_N_CORRELATIVO, DECRETO_ANIO FROM decreto WHERE DECRETO_N_CORRELATIVO = :DECRETO_N_CORRELATIVO AND DECRETO_ANIO = :DECRETO_ANIO');
    $select->bindParam(":DECRETO_N_CORRELATIVO" ,$number);
    $select->bindParam(":DECRETO_ANIO" ,$año);
    $select->execute();
    $row=$select->fetch(PDO::FETCH_LAZY);
    if( ! $row)
    {
        
        $selects = false;
    }else{
       
        $selects =true;
    }

return $selects;
 }