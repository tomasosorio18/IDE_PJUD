<?php
include("../Configuration/Connector.php");


    if (isset($_GET['decreto_id'])) {
        $id = $_GET['decreto_id'];
        $año = $_GET['anio'];
	
            try{
              
    
    
                $sentenciaSQL=$conexion->prepare("UPDATE decreto SET DECRETO_DETALLE = 'ANULADO', ADJUNTO_INI_ID = NULL, ADJUNTO_FIRMA_ID = NULL, DECRETO_ESTADO = 'Publico' WHERE DECRETO_N_CORRELATIVO = :DECRETO_N_CORRELATIVO AND DECRETO_ANIO = :DECRETO_ANIO");
                $sentenciaSQL->bindParam(":DECRETO_N_CORRELATIVO", $id);
                $sentenciaSQL->bindParam(":DECRETO_ANIO", $año);
                if($sentenciaSQL->execute()){
                    echo '<script>
                    toastr.options =
                    {
                    "closeButton" : true,
                    "progressBar" : true
                    }
                    toastr.success("¡Decreto anulado!");
                    setTimeout(() => {
                        location.href = "Informe_decretos.php";
                        }, 1000);</script>';
                }else{
                    echo '<script>
                    toastr.options =
                      {
                      "closeButton" : true,
                      "progressBar" : true
                      }
                    toastr.warning("Error al anular decreto");
                    setTimeout(() => {
                    location.href = "Informe_decretos.php";
                    }, 3000);
                    </script>';
                }
    
          
    
    
            }
            catch(PDOException $e){
                echo '<script>
                toastr.options =
                  {
                  "closeButton" : true,
                  "progressBar" : true
                  }
                toastr.warning("Error !");
                setTimeout(() => {
                location.href = "Informe_Decreto.php";
                }, 3000);
                </script>';
            }
    
            //Cerrar la conexión
            
  



    }
	

	

?>