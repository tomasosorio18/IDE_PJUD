<?php include("../../Configuration/Connector.php");?>
<?php  

if ((isset($_POST['borraCargoid']))?$_POST['borraCargoid']:"") {
    $cargoid =(isset($_POST['borraCargoid']))?$_POST['borraCargoid']:"";

}else{
    $cargoid= "Default";
}

    try {
        $fecha = date('y-m-d');
        $sentenciaSQL=$conexion->prepare(
            "UPDATE cargo_funcionario SET CARGO_FECHA_BAJA = :FECHA_BAJA WHERE CARGO_FUNC_ID = :CARGO_ID;");
            $sentenciaSQL->bindParam(':FECHA_BAJA',$fecha);  
            $sentenciaSQL->bindParam(':CARGO_ID',$cargoid);  
            $sentenciaSQL->execute();
            
            try{
                $fecha = date('y-m-d');
                $bajaFuncionarios=$conexion->prepare(
                "UPDATE funcionario SET FUNCIONARIO_FECHA_BAJA = :FECHA_BAJA WHERE CARGO_FUNC_ID = :CARGO_ID;");
                $bajaFuncionarios->bindParam(':FECHA_BAJA',$fecha);  
                $bajaFuncionarios->bindParam(':CARGO_ID',$cargoid);  
                $bajaFuncionarios->execute();
                echo "1";

        
           } catch(\Throwable $th) {

           }
            
    } catch (\Throwable $th) {
            echo "2";
    }
    
       ?>