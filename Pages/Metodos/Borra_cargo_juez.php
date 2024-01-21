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
            "UPDATE cargo_juez SET CARGO_FECHA_BAJA = :FECHA_BAJA WHERE CARGO_JUEZ_ID = :CARGO_ID;");
            $sentenciaSQL->bindParam(':FECHA_BAJA',$fecha);  
            $sentenciaSQL->bindParam(':CARGO_ID',$cargoid);  
            $sentenciaSQL->execute();
            
           try{
                $fecha = date('y-m-d');
                $bajaJueces=$conexion->prepare(
                "UPDATE juez SET JUEZ_FECHA_BAJA = :FECHA_BAJA WHERE CARGO_JUEZ_ID = :CARGO_ID;");
                $bajaJueces->bindParam(':FECHA_BAJA',$fecha);  
                $bajaJueces->bindParam(':CARGO_ID',$cargoid);  
                $bajaJueces->execute();
                echo "1";

        
           } catch(\Throwable $th) {

           }
            
    } catch (\Throwable $th) {
            echo "2";
    }
    
       ?>