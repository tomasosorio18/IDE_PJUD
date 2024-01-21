<?php include("../../Configuration/Connector.php");?>
<?php  

if ((isset($_POST['txtNombreCargo']))?$_POST['txtNombreCargo']:"") {
    $cargo =(isset($_POST['txtNombreCargo']))?$_POST['txtNombreCargo']:"";

}else{
    $cargo= "Default";
}

$ifCargoExists = ifCargoJuezExists($cargo);
if ($ifCargoExists) {
   echo "3";
} else {
    try {
        $sentenciaSQL=$conexion->prepare(
            "INSERT INTO cargo_juez(CARGO_JUEZ_NOMBRE) VALUES (:CARGO_JUEZ_NOMBRE);");
            $sentenciaSQL->bindParam(':CARGO_JUEZ_NOMBRE',$cargo);  
            $sentenciaSQL->execute();
            
            echo "1";
    } catch (\Throwable $th) {
            echo "2";
    }
    
    }    ?>

<?php
function ifCargoJuezExists($cargo){
    include("../../Configuration/Connector.php");
    $select = $conexion->prepare('SELECT * from cargo_juez WHERE cargo_juez.CARGO_JUEZ_NOMBRE = :CARGO_JUEZ_NOMBRE AND  cargo_juez.CARGO_FECHA_BAJA IS NULL');
    $select->bindParam(":CARGO_JUEZ_NOMBRE" ,$cargo);
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