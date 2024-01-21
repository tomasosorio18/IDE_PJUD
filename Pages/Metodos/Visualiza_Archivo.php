<?php
include("../Configuration/Connector.php");
// connect to the database

if (isset($_GET['file_id_view'])) {
    $id = $_GET['file_id_view'];
    $año = $_GET['anio'];
    // fetch file to download from database
   

    $sentenciaSQL=$conexion->prepare("SELECT adjunto_firmado.ADJUNTO_FIRMA_NOMBRE from adjunto_firmado
    INNER JOIN decreto on adjunto_firmado.ADJUNTO_FIRMA_ID = decreto.ADJUNTO_FIRMA_ID
    WHERE decreto.ADJUNTO_FIRMA_ID = :ADJUNTO_FIRMA_ID;");
    $adjuntoFid = $id . $año;
    $sentenciaSQL->bindParam(':ADJUNTO_FIRMA_ID',$adjuntoFid);
    $sentenciaSQL->execute();
    $file=$sentenciaSQL->fetch(PDO::FETCH_LAZY);


    
    $filepath = '../Assets/Decretos_subidos/' . $file["ADJUNTO_FIRMA_NOMBRE"];

    if (file_exists($filepath) && is_file($filepath)) {
        header("Pragma: public"); // required
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false); // required for certain browsers
        header("Content-Type: application/pdf");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: ". filesize('../Assets/Decretos_subidos/' . $file['ADJUNTO_FIRMA_NOMBRE']));
        
        //This part of code prevents files from being corrupted after download
        ob_clean();
        flush();
        
        readfile('../Assets/Decretos_subidos/' . $file['ADJUNTO_FIRMA_NOMBRE']);

        // Now update downloads count
        exit;
    }

}

if (isset($_GET['file_id_view2'])) {
    $id = $_GET['file_id_view2'];
    $año2 = $_GET['anio2'];
    // fetch file to download from database
  

    $sentenciaSQL=$conexion->prepare("SELECT adjunto_inicial.ADJUNTO_INI_NOMBRE from adjunto_inicial 
    INNER JOIN decreto on adjunto_inicial.ADJUNTO_INI_ID = decreto.ADJUNTO_INI_ID
    WHERE decreto.ADJUNTO_INI_ID = :ADJUNTO_INI_ID;");
    $adjuntoIid = $id . $año2;
    $sentenciaSQL->bindParam(':ADJUNTO_INI_ID',$adjuntoIid);
    $sentenciaSQL->execute();
    $file=$sentenciaSQL->fetch(PDO::FETCH_LAZY);


    
    $filepath = '../Assets/Decretos_originales/' . $file["ADJUNTO_INI_NOMBRE"];

    if (file_exists($filepath) && is_file($filepath)) {
        header("Pragma: public"); // required
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false); // required for certain browsers
        header("Content-Type: application/pdf");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: ". filesize('../Assets/Decretos_originales/' . $file['ADJUNTO_INI_NOMBRE']));
        
        //This part of code prevents files from being corrupted after download
        ob_clean();
        flush();
        
        readfile('../Assets/Decretos_originales/' . $file['ADJUNTO_INI_NOMBRE']);

        // Now update downloads count
        exit;
    }else{
        echo '<script>
        toastr.options =
          {
          "closeButton" : true,
          "progressBar" : true
          }
        toastr.error("' . $filepath . '");
        setTimeout(() => {
        location.href = "Informe_decretos.php";
        }, 3000);
        </script>';
    }

}
