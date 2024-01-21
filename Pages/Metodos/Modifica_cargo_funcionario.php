<?php include("../../Configuration/Connector.php");?>
<?php  

if ((isset($_POST['txtEditaCargo']))?$_POST['txtEditaCargo']:"") {
    $cargo =(isset($_POST['txtEditaCargo']))?$_POST['txtEditaCargo']:"";

}else{
    $cargo= "Default";
}

if ((isset($_POST['cargoid']))?$_POST['cargoid']:"") {
    $cargoid =(isset($_POST['cargoid']))?$_POST['cargoid']:"";

}else{
    $cargoid= "Default";
}

$ifCargoExists = ifCargoFuncExists($cargo);
if ($ifCargoExists) {
   echo "3";
} else {
    try {
        $sentenciaSQL=$conexion->prepare(
            "UPDATE cargo_funcionario SET CARGO_FUNC_NOMBRE = :CARGO_FUNC_NOMBRE WHERE CARGO_FUNC_ID = :CARGO_ID;");
            $sentenciaSQL->bindParam(':CARGO_FUNC_NOMBRE',$cargo);  
            $sentenciaSQL->bindParam(':CARGO_ID',$cargoid);  
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