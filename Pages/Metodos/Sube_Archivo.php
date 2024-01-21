<?php include("../Configuration/Connector.php");

$anio = date("Y");
$selectdecreto = (isset($_POST['txtdecreto']))?$_POST['txtdecreto']:"";
if (isset($_POST['save'])) {

    $filename = uniqid(mt_rand(), true) . " - " . $_FILES['myfile']['name'];

    // destination of the file on the server
    $destination = '../Assets/Decretos_subidos/';

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    $f = basename($_FILES["myfile"]["name"]);
    $f = uniqid(mt_rand(), true) ." ". $anio. "-" . $selectdecreto . "." . $extension;
    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['pdf'])) {
        echo '<script>
        toastr.options =
          {
          "closeButton" : true,
          "progressBar" : true
          }
        toastr.error("La extension del archivo debe ser PDF");

      
        </script>';
    } elseif ($_FILES['myfile']['size'] > 10000000) { // file shouldn't be larger than 1Megabyte
        echo '<script>
        toastr.options =
          {
          "closeButton" : true,
          "progressBar" : true
          }
        toastr.error("El tamaño del archivo es demasiado grande");
        setTimeout(() => {
          location.href = "Subir_decretos.php";
          }, 3000);
        </script>';
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination . $f)) {
          
            $FechaActual= date("Y-m-d");
            $año = date("Y");
            $idArchivoADD = intval($selectdecreto) * 10000 + intval($año);

            $consulta_existencia = $conexion->prepare("SELECT ADJUNTO_FIRMA_NOMBRE FROM ADJUNTO_FIRMADO WHERE ADJUNTO_FIRMA_ID = :ID");
            $consulta_existencia->bindParam(':ID', $idArchivoADD);
            $consulta_existencia->execute();
            $archivo_existente = $consulta_existencia->fetch(PDO::FETCH_LAZY);

            if ($archivo_existente) {
              $filepath = '../Assets/Decretos_subidos/' . $archivo_existente["ADJUNTO_FIRMA_NOMBRE"];
          
              if (file_exists($filepath) && is_file($filepath)) {
                unlink($destination . $archivo_existente["ADJUNTO_FIRMA_NOMBRE"]);
              }
          } else {
              // Manejo en caso de que no se encuentren resultados
             
          }
          
            $sentenciaADD = $conexion->prepare("INSERT INTO ADJUNTO_FIRMADO(ADJUNTO_FIRMA_ID,ADJUNTO_FIRMA_NOMBRE,ADJUNTO_FIRMA_FECHA) VALUES (:ADJUNTO_FIRMA_ID,:ADJUNTO_FIRMA_NOMBRE,:ADJUNTO_FIRMA_FECHA) ON DUPLICATE KEY UPDATE ADJUNTO_FIRMA_NOMBRE = :ADJUNTO_NUEVO, ADJUNTO_FIRMA_FECHA = :FECHA_NUEVA");
           
            $sentenciaADD->bindParam(':ADJUNTO_FIRMA_ID',$idArchivoADD);
            $sentenciaADD->bindParam(':ADJUNTO_FIRMA_NOMBRE',$f);
            $sentenciaADD->bindParam(':ADJUNTO_NUEVO',$f);
            $sentenciaADD->bindParam(':FECHA_NUEVA',$FechaActual);
            $sentenciaADD->bindParam(':ADJUNTO_FIRMA_FECHA',$FechaActual);

            if ($sentenciaADD->execute() === false )  {
                
            
                echo '<script>
                toastr.options =
                  {
                  "closeButton" : true,
                  "progressBar" : true
                  }
                toastr.error("Ocurrio un error al subir un archivo");
                setTimeout(() => {
                  location.href = "Subir_Decretos.php";
                  }, 3000);
               </script>';
                
            }else{

                $sentenciaUPD = $conexion->prepare("UPDATE decreto SET ADJUNTO_FIRMA_ID = :ADJUNTO_FIRMA_ID WHERE DECRETO_N_CORRELATIVO = :DECRETO_N_CORRELATIVO AND DECRETO_ANIO = :DECRETO_ANIO");
                $idArchivo = intval($selectdecreto) * 10000 + intval($año);
                $sentenciaUPD->bindParam(':ADJUNTO_FIRMA_ID',$idArchivo);
                $sentenciaUPD->bindParam(':DECRETO_N_CORRELATIVO',$selectdecreto);
                $sentenciaUPD->bindParam(':DECRETO_ANIO',$anio);
               
                if ($sentenciaUPD->execute() === false )  {
                    
                
                    echo '<script>
                    toastr.options =
                      {
                      "closeButton" : true,
                      "progressBar" : true
                      }
                    toastr.error("Ocurrio un error al subir un archivo");
                    setTimeout(() => {
                      location.href = "Subir_decretos.php";
                      }, 3000);
                   </script>';
                    
                }else{
                  echo '<script>
                toastr.options =
                  {
                  "closeButton" : true,
                  "progressBar" : true
                  }
                toastr.success("¡Archivo subido correctamente!");
                setTimeout(() => {
                  location.href = "Subir_decretos.php";
                  }, 1500);
               </script>';
                } 
            }

         
        } else {
            echo '<script>
                toastr.options =
                  {
                  "closeButton" : true,
                  "progressBar" : true
                  }
                toastr.success("¡Archivo no se encuentra!");
                setTimeout(() => {
                  location.href = "Subir_decretos.php";
                  }, 1500);
               </script>';
            
        }
    }
}