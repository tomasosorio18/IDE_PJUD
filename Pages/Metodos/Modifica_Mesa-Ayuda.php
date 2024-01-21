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
 
if ((isset($_POST['txtdata2']))?$_POST['txtdata2']:"") {
    $txtdate2 = (isset($_POST['txtdata2']))?$_POST['txtdata2']:"";
    setlocale(LC_ALL,"es");

$fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
}else{
    $txtdate2= "Default";
}
if ((isset($_POST['turidMA']))?$_POST['turidMA']:"") {
    $turidMA = (isset($_POST['turidMA']))?$_POST['turidMA']:"";
}else{
    $turidMA= "Default";
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
if ((isset($_POST['selectFunc']))?$_POST['selectFunc']:""){
    $txtFunc =(isset($_POST['selectFunc']))?$_POST['selectFunc']:"";
}else{
    $txtFunc= "";
} 

   try {
    $sentenciaSQL=$conexion->prepare(
        "UPDATE decreto SET JUEZ_ID = :JUEZ_ID,
        DECRETO_TIPO_ID = :DECRETO_TIPO_ID,
        DECRETO_FECHA_EMISION = :DECRETO_FECHA_EMISION,
        TUR_ID = :TUR_ID, 
        DECRETO_DETALLE = :DECRETO_DETALLE,
        DECRETO_EMITIDA_POR = :DECRETO_EMITIDA_POR,
        DECRETO_ESTADO = :DECRETO_ESTADO,
        DECRETO_ANIO = :DECRETO_ANIO WHERE DECRETO_N_CORRELATIVO = :DECRETO_N_CORRELATIVO AND DECRETO_ANIO = :DECRETO_ANIO;");
        $sentenciaSQL->bindParam(':DECRETO_N_CORRELATIVO',$decrenumber,PDO::PARAM_INT);   
        $sentenciaSQL->bindParam(':JUEZ_ID',$selectJuez2,PDO::PARAM_INT);
        $sentenciaSQL->bindParam(':DECRETO_TIPO_ID',$selectDecreto2,PDO::PARAM_INT);
        $sentenciaSQL->bindParam(':DECRETO_FECHA_EMISION',$txtdate2,PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':DECRETO_DETALLE',$detalleMesaAyuda,PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':TUR_ID',$turidMA);
        $sentenciaSQL->bindParam(':DECRETO_EMITIDA_POR',$INICIALES);
        $sentenciaSQL->bindParam(':DECRETO_ESTADO',$txtEstado,PDO::PARAM_STR);
        $sentenciaSQL->bindParam(':DECRETO_ANIO',$año,PDO::PARAM_STR);

      
        $resultado=$sentenciaSQL->execute();
        
        echo $resultado;
   } catch (\Throwable $th) {
    echo $decrenumber . " ". $selectJuez2 ." ". $selectDecreto2 ." ". $txtdate2 ." ". $detalleMesaAyuda ." ". $turidMA ." ". $INICIALES ." ".$txtEstado ." ".$año;
   }
           
  






?> 

