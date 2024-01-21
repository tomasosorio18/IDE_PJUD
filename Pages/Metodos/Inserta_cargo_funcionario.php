<?php include("../../Configuration/Connector.php");?>
<?php  

if ((isset($_POST['txtNombreCargo']))?$_POST['txtNombreCargo']:"") {
    $cargo =(isset($_POST['txtNombreCargo']))?$_POST['txtNombreCargo']:"";

}else{
    $cargo= "Default";
}

$ifCargoExists = ifCargoFuncExists($cargo);
if ($ifCargoExists) {
   echo "3";
} else {
    try {
        $sentenciaSQL=$conexion->prepare(
            "INSERT INTO cargo_funcionario(CARGO_FUNC_NOMBRE) VALUES (:CARGO_FUNC_NOMBRE);");
            $sentenciaSQL->bindParam(':CARGO_FUNC_NOMBRE',$cargo);  
            $sentenciaSQL->execute();
            
            echo "1";
    } catch (\Throwable $th) {
            echo "2";
    }
    
    }    ?>

<?php
function ifCargoFuncExists($cargo){
    include("../../Configuration/Connector.php");
    $select = $conexion->prepare('SELECT * from cargo_funcionario WHERE cargo_funcionario.CARGO_FUNC_NOMBRE = :CARGO_FUNC_NOMBRE AND  cargo_funcionario.CARGO_FECHA_BAJA IS NULL');
    $select->bindParam(":CARGO_FUNC_NOMBRE" ,$cargo);
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