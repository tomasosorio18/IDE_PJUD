<?php
include("../Configuration/Connector.php");

if (isset($_GET['file_id_delete'])) {
    $id = $_GET['file_id_delete'];
    $año = $_GET['anio'];
    // fetch file to download from database


try {
    $sentenciaSQL=$conexion->prepare("SELECT adjunto_firmado.ADJUNTO_FIRMA_NOMBRE from adjunto_firmado
    INNER JOIN decreto on adjunto_firmado.ADJUNTO_FIRMA_ID = decreto.ADJUNTO_FIRMA_ID
    WHERE decreto.ADJUNTO_FIRMA_ID = :ADJUNTO_FIRMA_ID;");
    $adjuntoFid = $id . $año;
    $sentenciaSQL->bindParam(':ADJUNTO_FIRMA_ID',$adjuntoFid);
    $sentenciaSQL->execute();
    $file=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

    $filepath = '../Assets/Decretos_subidos/' . $file["ADJUNTO_FIRMA_NOMBRE"];
     
    if(file_exists($filepath) && is_file($filepath) ){

        unlink("../Assets/Decretos_subidos/". $file['ADJUNTO_FIRMA_NOMBRE']);

    }else{
       
        echo '<script>
        toastr.options =
          {
          "closeButton" : true,
          "progressBar" : true
          }
        toastr.warning("Este archivo ya ha sido eliminado");
        setTimeout(() => {
        location.href = "Informe_decretos.php";
        }, 3000);
        </script>';
    }

    
    $sentenciaSQL=$conexion->prepare("UPDATE decreto SET ADJUNTO_FIRMA_ID = null WHERE DECRETO_N_CORRELATIVO = :DECRETO_N_CORRELATIVO AND DECRETO_ANIO = :DECRETO_ANIO");
    $sentenciaSQL->bindParam(":DECRETO_N_CORRELATIVO",$id);
    $sentenciaSQL->bindParam(':DECRETO_ANIO',$año);
    $sentenciaSQL->execute();

} catch (\Throwable $th) {
    echo '<script>
    toastr.options =
      {
      "closeButton" : true,
      "progressBar" : true
      }
    toastr.error("Ocurrio un error al eliminar el adjunto");
    setTimeout(() => {
    location.href = "Informe_decretos.php";
    }, 3000);
    </script>';
}
if ($sentenciaSQL->execute() === false )  {
                
            
    echo '<script>
    toastr.options =
      {
      "closeButton" : true,
      "progressBar" : true
      }
    toastr.error("Ocurrio un error al eliminar el adjunto");
    setTimeout(() => {
    location.href = "Informe_decretos.php";
    }, 3000);
    </script>';
    
} else {
echo '<script>
    toastr.options =
      {
      "closeButton" : true,
      "progressBar" : true
      }
    toastr.success("Adjunto eliminado con exito");
    setTimeout(() => {
        location.href = "Informe_decretos.php";
        }, 1000);</script>';

}

}

if (isset($_GET['file_id_delete2'])) {
    $id = $_GET['file_id_delete2'];
    $año2 = $_GET['anio2'];
    // fetch file to download from database


try {
    $sentenciaSQL=$conexion->prepare("SELECT adjunto_inicial.ADJUNTO_INI_NOMBRE from adjunto_inicial 
    INNER JOIN decreto on adjunto_inicial.ADJUNTO_INI_ID = decreto.ADJUNTO_INI_ID
    WHERE decreto.ADJUNTO_INI_ID = :ADJUNTO_INI_ID;");
    $adjuntoIid = $id . $año2;
    $sentenciaSQL->bindParam(':ADJUNTO_INI_ID',$adjuntoIid);
    $sentenciaSQL->execute();
    $file=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

    unlink("../Assets/Decretos_originales/". $file['ADJUNTO_INI_NOMBRE']);

    $sentenciaSQL=$conexion->prepare("UPDATE decreto SET ADJUNTO_INI_ID = null WHERE DECRETO_N_CORRELATIVO = :DECRETO_N_CORRELATIVO AND DECRETO_ANIO = :DECRETO_ANIO");
    $sentenciaSQL->bindParam(":DECRETO_N_CORRELATIVO",$id);
    $sentenciaSQL->bindParam(':DECRETO_ANIO',$año2);
    $sentenciaSQL->execute();

} catch (\Throwable $th) {
    echo "error";
}
if ($sentenciaSQL->execute() === false )  {
                
            
    echo '<script>
    toastr.options =
      {
      "closeButton" : true,
      "progressBar" : true
      }
    toastr.error("Ocurrio un error al eliminar el adjunto");
    setTimeout(() => {
    location.href = "Informe_decretos.php";
    }, 3000);
    </script>';
    
} else {
echo '<script>
    toastr.options =
      {
      "closeButton" : true,
      "progressBar" : true
      }
    toastr.success("Adjunto eliminado con exito");
    setTimeout(() => {
        location.href = "Informe_decretos.php";
        }, 1000);</script>';

}
}