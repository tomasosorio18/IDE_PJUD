<?php
//incluimos el conector a la base de datos;
include("../../Configuration/Connector.php");
//requerimos la clase del generador de pdf mpdf con el autoload.php
require_once '../../Assets/vendor/autoload.php';

// --------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------



 if(isset($_POST['btnpdfPSjefeU']))
{ 
    if ((isset($_POST['txtcargo2PSM']))?$_POST['txtcargo2PSM']:"") {
        $selectCargo2 =(isset($_POST['txtcargo2PSM']))?$_POST['txtcargo2PSM']:"";
        try {
            $sentenciaSQL=$conexion->prepare("SELECT CARGO_JUEZ_NOMBRE from cargo_juez WHERE CARGO_JUEZ_ID = :CARGO_JUEZ_ID");
            $sentenciaSQL->bindParam(':CARGO_JUEZ_ID',$selectCargo2);
            $sentenciaSQL->execute();
            $strCargo=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
            $cargo = $strCargo['CARGO_JUEZ_NOMBRE'];
        } catch (\Throwable $th) {
           $cargo="";
        }
    }else{
        $cargo= "Default";
    }
        
    
    if ((isset($_POST['txtJuez2PSM']))?$_POST['txtJuez2PSM']:"") {
        $juezid =(isset($_POST['txtJuez2PSM']))?$_POST['txtJuez2PSM']:"";
        try {
            $sentenciaSQL=$conexion->prepare("SELECT JUEZ_NOMBRE, JUEZ_APELLIDO from juez WHERE JUEZ_ID = :JUEZ_ID");
            $sentenciaSQL->bindParam(':JUEZ_ID',$juezid);
            $sentenciaSQL->execute();
            $strjuez=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
            $juezNombre = $strjuez['JUEZ_NOMBRE'];
            $juezApellido= $strjuez['JUEZ_APELLIDO'];
            
            $txtJuez = $juezNombre." ".$juezApellido;
        } catch (\Throwable $th) {
           $txtJuez="";
        }
    }else{
        $txtJuez="Default";
    } 
    
    
    if ((isset($_POST['txtdata2PSM']))?$_POST['txtdata2PSM']:"") {
        $txtdate2 = (isset($_POST['txtdata2PSM']))?$_POST['txtdata2PSM']:"";
        setlocale(LC_ALL,"es");
        $fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
        $strFinal= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR));
    }else{
        $txtdate2= "Default";
    }
    if ((isset($_POST['datepickerPSM']))?$_POST['datepickerPSM']:"") {
        $txtdate2 = (isset($_POST['datepickerPSM']))?$_POST['datepickerPSM']:"";
        setlocale(LC_ALL,"es");
        $fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
        $strFinal= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR));
    }else{
        $txtdate2= "Default";
    }
    
    if ((isset($_POST['txtTipo2PSM']))?$_POST['txtTipo2PSM']:"") {
        $selectDecreto2 = (isset($_POST['txtTipo2PSM']))?$_POST['txtTipo2PSM']:"";
    }else{
        $selectDecreto2= "Default";
    }
    
    if ((isset($_POST['txtdecrePSM']))?$_POST['txtdecrePSM']:"") {
        $decrenumber =(isset($_POST['txtdecrePSM']))?$_POST['txtdecrePSM']:"";
    }else{
        $decrenumber= "?";
    }
    
        
    if ((isset($_POST['datepicker2PSM']))?$_POST['datepicker2PSM']:"") {
        $fechaResolucion =(isset($_POST['datepicker2PSM']))?$_POST['datepicker2PSM']:"";
    }else{
        $fechaResolucion= "FechaR";
    }
    
    
    
    if ((isset($_POST['txtdiasPSM']))?$_POST['txtdiasPSM']:"") {
        $days =(isset($_POST['txtdiasPSM']))?$_POST['txtdiasPSM']:"";
    }else{
        $days= "dias";
    }
    
    
    
    if ((isset($_POST['txtResolucionPSM']))?$_POST['txtResolucionPSM']:"") {
        $txtResolucion =(isset($_POST['txtResolucionPSM']))?$_POST['txtResolucionPSM']:"";
    }else{
        $txtResolucion= "Resolucion";
    }

    if ((isset($_POST['txtAusentePSM']))?$_POST['txtAusentePSM']:""){
        $ausenteid =(isset($_POST['txtAusentePSM']))?$_POST['txtAusentePSM']:"";
        try {
            $sentenciaSQL=$conexion->prepare("SELECT FUNCIONARIO_NOMBRE, FUNCIONARIO_APELLIDO from funcionario WHERE FUNCIONARIO_ID = :FUNCIONARIO_ID");
            $sentenciaSQL->bindParam(':FUNCIONARIO_ID',$ausenteid);
            $sentenciaSQL->execute();
            $strfuncionario=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
            $FuncNombre = $strfuncionario['FUNCIONARIO_NOMBRE'];
            $FuncApellido = $strfuncionario['FUNCIONARIO_APELLIDO'];
    
            $txtAusente =  $FuncNombre." ".$FuncApellido;
        } catch (\Throwable $th) {
            $txtAusente="";
    
        }
    }else{
        $txtAusente= "Default";
    }

    if ((isset($_POST['txtSubrogantePSM']))?$_POST['txtSubrogantePSM']:""){
        $subroganteid =(isset($_POST['txtSubrogantePSM']))?$_POST['txtSubrogantePSM']:"";
        try {
            $sentenciaSQL=$conexion->prepare("SELECT FUNCIONARIO_NOMBRE, FUNCIONARIO_APELLIDO from funcionario WHERE FUNCIONARIO_ID = :FUNCIONARIO_ID");
            $sentenciaSQL->bindParam(':FUNCIONARIO_ID',$subroganteid);
            $sentenciaSQL->execute();
            $strfuncionario=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
            $FuncNombre = $strfuncionario['FUNCIONARIO_NOMBRE'];
            $FuncApellido = $strfuncionario['FUNCIONARIO_APELLIDO'];
    
            $txtSubrogante =  $FuncNombre." ".$FuncApellido;
        } catch (\Throwable $th) {
            $txtSubrogante="err";
    
        }
    }else{
        $txtSubrogante= "Default";
    }

    if ((isset($_POST['selectcargoSubrogantePSM']))?$_POST['selectcargoSubrogantePSM']:"") {
        $cargoSub =(isset($_POST['selectcargoSubrogantePSM']))?$_POST['selectcargoSubrogantePSM']:"";
        try {
            $sentenciaSQL=$conexion->prepare("SELECT CARGO_FUNC_NOMBRE from cargo_funcionario WHERE CARGO_FUNC_ID = :CARGO_FUNC_ID");
            $sentenciaSQL->bindParam(':CARGO_FUNC_ID',$cargoSub);
            $sentenciaSQL->execute();
            $strCargo=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
            $txtcargoSub = $strCargo['CARGO_FUNC_NOMBRE'];
        } catch (\Throwable $th) {
            $txtcargoSub="";
        }
    }else{
        $txtcargoSub= "Default";
    }

      if ((isset($_POST['txtSubroganteMFEPSM']))?$_POST['txtSubroganteMFEPSM']:"") {
        $subroganteMFEid =(isset($_POST['txtSubroganteMFEPSM']))?$_POST['txtSubroganteMFEPSM']:"";
        try {
            $sentenciaSQL=$conexion->prepare("SELECT FUNCIONARIO_NOMBRE, FUNCIONARIO_APELLIDO from funcionario WHERE FUNCIONARIO_ID = :FUNCIONARIO_ID");
            $sentenciaSQL->bindParam(':FUNCIONARIO_ID',$subroganteMFEid);
            $sentenciaSQL->execute();
            $strfuncionario=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
            $FuncNombre = $strfuncionario['FUNCIONARIO_NOMBRE'];
            $FuncApellido = $strfuncionario['FUNCIONARIO_APELLIDO'];
    
            $txtSubroganteMFE =  $FuncNombre." ".$FuncApellido;
        } catch (\Throwable $th) {
            $txtSubroganteMFE="";
    
        }
    }else{
        $txtSubroganteMFE= "No ingresado";
    }


    if ((isset($_POST['selectcargoMFEPSM']))?$_POST['selectcargoMFEPSM']:"") {
        $cargoMFE =(isset($_POST['selectcargoMFEPSM']))?$_POST['selectcargoMFEPSM']:"";
        try {
            $sentenciaSQL=$conexion->prepare("SELECT CARGO_FUNC_NOMBRE from cargo_funcionario WHERE CARGO_FUNC_ID = :CARGO_FUNC_ID");
            $sentenciaSQL->bindParam(':CARGO_FUNC_ID',$cargoMFE);
            $sentenciaSQL->execute();
            $strCargo=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
            $txtcargoMFE = $strCargo['CARGO_FUNC_NOMBRE'];
        } catch (\Throwable $th) {
            $txtcargoMFE="";
        }
    }else{
        $txtcargoMFE= "No ingresado";
    }

  



    $fechaFormato= date("d-m-Y", strtotime($txtdate2));
    $fechaDesde= date("d-m-Y", strtotime($fechaResolucion));
    $fechaHasta= date("d-m-Y", strtotime($secondDate));
    $año = date("Y");
        try {
            $mpdf = new \Mpdf\Mpdf();
    
            // set the sourcefile
            // $mpdf->SetImportUse(); // <--- not needed for mPDF version 8.0+
            $mpdf->setSourceFile('../../Assets/plantillas/PERMISO-SUBROGANCIA-JEFE_UNIDAD-CLS.pdf'); // absolute path to pdf file
            
            // import page 1
            $tplIdx = $mpdf->importPage(1);
            
            // use the imported page and place it at point 10,10 with a width of 200 mm   (This is the image of the included pdf)
            $mpdf->useTemplate($tplIdx,5,-7,200);
            
            // now write some text above the imported page
            $mpdf->SetTextColor(0, 0, 0);
            $mpdf->SetFont('Arial', 'b', 8);
            $mpdf->SetXY(26,123);
            $mpdf->Cell(0, 10, $txtAusente, 0, 0, 'L');
    
    
            $mpdf->SetTextColor(0, 0, 0);
            $mpdf->SetFont('Arial', 'b', 9);
            $mpdf->SetXY(45,168.6);
            $mpdf->Cell(0, 10, $txtSubrogante, 0, 0, 'L');

            $mpdf->SetTextColor(0, 0, 0);
            $mpdf->SetFont('Arial', 'b', 9);
            $mpdf->SetXY(100,168.6);
            $mpdf->Cell(0, 10," - " . $txtcargoSub . " Titular.", 0, 0, 'L');

            $mpdf->SetTextColor(0, 0, 0);
            $mpdf->SetFont('Arial', 'b', 9);
            $mpdf->SetXY(45,186.7);
            $mpdf->Cell(0, 10, $txtSubroganteMFE, 0, 0, 'L');

            $mpdf->SetTextColor(0, 0, 0);
            $mpdf->SetFont('Arial', 'b', 9);
            $mpdf->SetXY(100,186.7);
            $mpdf->Cell(0, 10," - " . $txtcargoMFE . " Titular.", 0, 0, 'L');
    
            $mpdf->SetTextColor(0, 0, 0);
            $mpdf->SetFont('Arial', 'b', 10);
            $mpdf->SetXY(136,123);
            $mpdf->Cell(0, 10, $days, 0, 0, 'L');
            
            $mpdf->SetTextColor(0, 0, 0);
            $mpdf->SetFont('Arial', 'b', 9);
            $mpdf->SetXY(78,123);
            $mpdf->Cell(0, 10, $fechaDesde, 0, 0, 'L');
    
            $mpdf->SetTextColor(0, 0, 0);
            $mpdf->SetFont('Arial', 'b', 10);
            $mpdf->SetXY(107,123);
            $mpdf->Cell(0, 10, $txtResolucion, 0, 0, 'L');
    
             $mpdf->SetTextColor(0, 0, 0);
             $mpdf->SetFont('Arial', 'B', 18);
             $mpdf->SetXY(133,42);
             $mpdf->Cell(0, 10, $decrenumber, 0, 0, 'L');
    
             $mpdf->SetTextColor(0, 0, 0);
             $mpdf->SetFont('Arial', 'B', 18);
             $mpdf->SetXY(149,42);
             $mpdf->Cell(0, 10, " - " . $año, 0, 0, 'L');
            
            $mpdf->SetTextColor(0,0,0);
            $mpdf->SetFont('Arial', '', 10);
            $mpdf->SetXY(70,64.1);
            $mpdf->Cell(0, 10, $strFinal, 0, 0, 'L');
        
            
            $mpdf->SetTextColor(0,0,0);
            $mpdf->SetFont('Arial', 'B', 12);
            $mpdf->SetXY(133,222);
            $mpdf->Cell(0, 10, $txtJuez, 0, 0, 'L');
            
            $mpdf->SetTextColor(0,0,0);
            $mpdf->SetFont('Arial', 'B', 10);
            $mpdf->SetXY(134,227);
            $mpdf->Cell(0, 10, $cargo, 0, 0, 'L');
    
    
            
           
    
        $mpdf->Output('filename.pdf', \Mpdf\Output\Destination::INLINE);
    
        } catch (\Throwable $th) {
            echo"error al generar pdf";
        }
    
     
    
        try {
            // Generamos el año actual para la comparación
            $año = date("Y");
        
            // Asignamos el nombre del archivo con una ID única y aleatoria
            $filename = uniqid(mt_rand(), true) . " - " ."Decreto_Permisos-Subrogancia_JU_N".$decrenumber."-".$año.".pdf";
            $path = 'C:/xampp/htdocs/IDE_PJUD/Assets/Decretos_originales/'.$filename;
        
            // Verificar si el archivo ya existe
            if (file_exists($path)) {
                // Si el archivo ya existe, lo eliminamos
                unlink($path);
            }
        
            // Guardamos el nuevo archivo y procedemos con la inserción en la base de datos
            $mpdf->Output($path, 'F');
        
            // Preparamos la consulta para insertar en la tabla adjunto_inicial
            $sentenciaSQL = $conexion->prepare("INSERT INTO adjunto_inicial (ADJUNTO_INI_ID, ADJUNTO_INI_NOMBRE) 
            VALUES (:ADJUNTO_INI_ID, :ADJUNTO_INI_NOMBRE) 
            ON DUPLICATE KEY UPDATE ADJUNTO_INI_NOMBRE = VALUES(ADJUNTO_INI_NOMBRE);");
            
            $idArchivo = intval($decrenumber) * 10000 + intval($año);
            $sentenciaSQL->bindParam(':ADJUNTO_INI_ID', $idArchivo ,PDO::PARAM_INT);
            $sentenciaSQL->bindParam(':ADJUNTO_INI_NOMBRE', $filename,PDO::PARAM_STR);
            $sentenciaSQL->execute();
        
    // Luego actualizamos la tabla decreto con la información del archivo adjunto
            $sentenciaSQL = $conexion->prepare("UPDATE decreto SET ADJUNTO_INI_ID = :ADJUNTO_INI_ID WHERE DECRETO_N_CORRELATIVO = :DECRETO_N_CORRELATIVO AND DECRETO_ANIO = :DECRETO_ANIO");
            $sentenciaSQL->bindParam(':ADJUNTO_INI_ID', $idArchivo ,PDO::PARAM_INT);
            $sentenciaSQL->bindParam(':DECRETO_N_CORRELATIVO', $decrenumber,PDO::PARAM_INT);
            $sentenciaSQL->bindParam(':DECRETO_ANIO', $año,PDO::PARAM_STR);
            $sentenciaSQL->execute();
        } catch (\Throwable $th) {
            echo "Error al guardar pdf!";
        }

}


// --------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------


 
if(isset($_POST['btnpdfPSjuezJ']))
{    if ((isset($_POST['txtcargo2PSM']))?$_POST['txtcargo2PSM']:"") {
    $selectCargo2 =(isset($_POST['txtcargo2PSM']))?$_POST['txtcargo2PSM']:"";
    try {
        $sentenciaSQL=$conexion->prepare("SELECT CARGO_JUEZ_NOMBRE from cargo_juez WHERE CARGO_JUEZ_ID = :CARGO_JUEZ_ID");
        $sentenciaSQL->bindParam(':CARGO_JUEZ_ID',$selectCargo2);
        $sentenciaSQL->execute();
        $strCargo=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
        $cargo = $strCargo['CARGO_JUEZ_NOMBRE'];
    } catch (\Throwable $th) {
       $cargo="";
    }
}else{
    $cargo= "Default";
}
    

if ((isset($_POST['txtJuez2PSM']))?$_POST['txtJuez2PSM']:"") {
    $juezid =(isset($_POST['txtJuez2PSM']))?$_POST['txtJuez2PSM']:"";
    try {
        $sentenciaSQL=$conexion->prepare("SELECT JUEZ_NOMBRE, JUEZ_APELLIDO from juez WHERE JUEZ_ID = :JUEZ_ID");
        $sentenciaSQL->bindParam(':JUEZ_ID',$juezid);
        $sentenciaSQL->execute();
        $strjuez=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
        $juezNombre = $strjuez['JUEZ_NOMBRE'];
        $juezApellido= $strjuez['JUEZ_APELLIDO'];
        
        $txtJuez = $juezNombre." ".$juezApellido;
    } catch (\Throwable $th) {
       $txtJuez="";
    }
}else{
    $txtJuez="Default";
} 



if ((isset($_POST['txtdata2PSM']))?$_POST['txtdata2PSM']:"") {
    $txtdate2 = (isset($_POST['txtdata2PSM']))?$_POST['txtdata2PSM']:"";
    setlocale(LC_ALL,"es");
    $fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
    $strFinal= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR));
}else{
    $txtdate2= "Default";
}
if ((isset($_POST['datepickerPSM']))?$_POST['datepickerPSM']:"") {
    $txtdate2 = (isset($_POST['datepickerPSM']))?$_POST['datepickerPSM']:"";
    setlocale(LC_ALL,"es");
    $fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
    $strFinal= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR));
}else{
    $txtdate2= "Default";
}

if ((isset($_POST['txtTipo2PSM']))?$_POST['txtTipo2PSM']:"") {
    $selectDecreto2 = (isset($_POST['txtTipo2PSM']))?$_POST['txtTipo2PSM']:"";
}else{
    $selectDecreto2= "Default";
}

if ((isset($_POST['txtdecrePSM']))?$_POST['txtdecrePSM']:"") {
    $decrenumber =(isset($_POST['txtdecrePSM']))?$_POST['txtdecrePSM']:"";
}else{
    $decrenumber= "?";
}


if ((isset($_POST['datepicker2PSM']))?$_POST['datepicker2PSM']:"") {
    $fechaResolucion =(isset($_POST['datepicker2PSM']))?$_POST['datepicker2PSM']:"";
}else{
    $fechaResolucion= "FechaR";
}



if ((isset($_POST['txtdiasPSM']))?$_POST['txtdiasPSM']:"") {
    $days =(isset($_POST['txtdiasPSM']))?$_POST['txtdiasPSM']:"";
}else{
    $days= "dias";
}



if ((isset($_POST['txtResolucionPSM']))?$_POST['txtResolucionPSM']:"") {
    $txtResolucion =(isset($_POST['txtResolucionPSM']))?$_POST['txtResolucionPSM']:"";
}else{
    $txtResolucion= "Resolucion";
}

if ((isset($_POST['txtAusentePSM']))?$_POST['txtAusentePSM']:""){
    $ausenteid =(isset($_POST['txtAusentePSM']))?$_POST['txtAusentePSM']:"";
    try {
        $sentenciaSQL=$conexion->prepare("SELECT FUNCIONARIO_NOMBRE, FUNCIONARIO_APELLIDO from funcionario WHERE FUNCIONARIO_ID = :FUNCIONARIO_ID");
        $sentenciaSQL->bindParam(':FUNCIONARIO_ID',$ausenteid);
        $sentenciaSQL->execute();
        $strfuncionario=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
        $FuncNombre = $strfuncionario['FUNCIONARIO_NOMBRE'];
        $FuncApellido = $strfuncionario['FUNCIONARIO_APELLIDO'];

        $txtAusente =  $FuncNombre." ".$FuncApellido;
    } catch (\Throwable $th) {
        $txtAusente="";

    }
}else{
    $txtAusente= "Default";
}

if ((isset($_POST['txtSubrogantePSM']))?$_POST['txtSubrogantePSM']:""){
    $subroganteid =(isset($_POST['txtSubrogantePSM']))?$_POST['txtSubrogantePSM']:"";
    try {
        $sentenciaSQL=$conexion->prepare("SELECT FUNCIONARIO_NOMBRE, FUNCIONARIO_APELLIDO from funcionario WHERE FUNCIONARIO_ID = :FUNCIONARIO_ID");
        $sentenciaSQL->bindParam(':FUNCIONARIO_ID',$subroganteid);
        $sentenciaSQL->execute();
        $strfuncionario=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
        $FuncNombre = $strfuncionario['FUNCIONARIO_NOMBRE'];
        $FuncApellido = $strfuncionario['FUNCIONARIO_APELLIDO'];

        $txtSubrogante =  $FuncNombre." ".$FuncApellido;
    } catch (\Throwable $th) {
        $txtSubrogante="err";

    }
}else{
    $txtSubrogante= "Default";
}

if ((isset($_POST['selectcargoSubrogantePSM']))?$_POST['selectcargoSubrogantePSM']:"") {
    $cargoSub =(isset($_POST['selectcargoSubrogantePSM']))?$_POST['selectcargoSubrogantePSM']:"";
    try {
        $sentenciaSQL=$conexion->prepare("SELECT CARGO_FUNC_NOMBRE from cargo_funcionario WHERE CARGO_FUNC_ID = :CARGO_FUNC_ID");
        $sentenciaSQL->bindParam(':CARGO_FUNC_ID',$cargoSub);
        $sentenciaSQL->execute();
        $strCargo=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
        $txtcargoSub = $strCargo['CARGO_FUNC_NOMBRE'];
    } catch (\Throwable $th) {
        $txtcargoSub="";
    }
}else{
    $txtcargoSub= "Default";
}

$fechaFormato= date("d-m-Y", strtotime($txtdate2));
$fechaDesde= date("d-m-Y", strtotime($fechaResolucion));
$fechaHasta= date("d-m-Y", strtotime($secondDate));
$año = date("Y");
    try {
        $mpdf = new \Mpdf\Mpdf();

        // set the sourcefile
        // $mpdf->SetImportUse(); // <--- not needed for mPDF version 8.0+
        $mpdf->setSourceFile('../../Assets/plantillas/PERMISO-SUBROGANCIA-JUEZ-CLS.pdf'); // absolute path to pdf file
        
        // import page 1
        $tplIdx = $mpdf->importPage(1);
        
        // use the imported page and place it at point 10,10 with a width of 200 mm   (This is the image of the included pdf)
        $mpdf->useTemplate($tplIdx,5,-7,200);
        
        // now write some text above the imported page
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 8);
        $mpdf->SetXY(23,133);
        $mpdf->Cell(0, 10, $txtAusente, 0, 0, 'L');


        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 9);
        $mpdf->SetXY(123,166.6);
        $mpdf->Cell(0, 10, $txtSubrogante, 0, 0, 'L');

        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 10);
        $mpdf->SetXY(132,133);
        $mpdf->Cell(0, 10, $days, 0, 0, 'L');
        
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 9);
        $mpdf->SetXY(73,133);
        $mpdf->Cell(0, 10, $fechaDesde, 0, 0, 'L');

        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 10);
        $mpdf->SetXY(103,133);
        $mpdf->Cell(0, 10, $txtResolucion, 0, 0, 'L');

         $mpdf->SetTextColor(0, 0, 0);
         $mpdf->SetFont('Arial', 'B', 18);
         $mpdf->SetXY(133,42);
         $mpdf->Cell(0, 10, $decrenumber, 0, 0, 'L');

         $mpdf->SetTextColor(0, 0, 0);
         $mpdf->SetFont('Arial', 'B', 18);
         $mpdf->SetXY(149,42);
         $mpdf->Cell(0, 10," - " . $año, 0, 0, 'L');
        
        $mpdf->SetTextColor(0,0,0);
        $mpdf->SetFont('Arial', '', 10);
        $mpdf->SetXY(70,74.6);
        $mpdf->Cell(0, 10, $strFinal, 0, 0, 'L');
    
        
        $mpdf->SetTextColor(0,0,0);
        $mpdf->SetFont('Arial', 'B', 12);
        $mpdf->SetXY(119,205);
        $mpdf->Cell(0, 10, $txtJuez, 0, 0, 'L');
        
        $mpdf->SetTextColor(0,0,0);
        $mpdf->SetFont('Arial', 'B', 10);
        $mpdf->SetXY(132,210);
        $mpdf->Cell(0, 10, $cargo, 0, 0, 'L');
    
        
       

    $mpdf->Output('filename.pdf', \Mpdf\Output\Destination::INLINE);

    } catch (\Throwable $th) {
        echo"error al generar pdf";
    }

 
 
    try {
        // Generamos el año actual para la comparación
        $año = date("Y");
    
        // Asignamos el nombre del archivo con una ID única y aleatoria
        $filename = uniqid(mt_rand(), true) . " - " ."Decreto_Permisos-Subrogancia_J_N".$decrenumber."-".$año.".pdf";
        $path = 'C:/xampp/htdocs/IDE_PJUD/Assets/Decretos_originales/'.$filename;
    
        // Verificar si el archivo ya existe
        if (file_exists($path)) {
            // Si el archivo ya existe, lo eliminamos
            unlink($path);
        }
    
        // Guardamos el nuevo archivo y procedemos con la inserción en la base de datos
        $mpdf->Output($path, 'F');
    
        // Preparamos la consulta para insertar en la tabla adjunto_inicial
        $sentenciaSQL = $conexion->prepare("INSERT INTO adjunto_inicial (ADJUNTO_INI_ID, ADJUNTO_INI_NOMBRE) 
        VALUES (:ADJUNTO_INI_ID, :ADJUNTO_INI_NOMBRE) 
        ON DUPLICATE KEY UPDATE ADJUNTO_INI_NOMBRE = VALUES(ADJUNTO_INI_NOMBRE);");
        
        $idArchivo = intval($decrenumber) * 10000 + intval($año);
        $sentenciaSQL->bindParam(':ADJUNTO_INI_ID', $idArchivo ,PDO::PARAM_INT);
        $sentenciaSQL->bindParam(':ADJUNTO_INI_NOMBRE', $filename,PDO::PARAM_STR);
        $sentenciaSQL->execute();
    
// Luego actualizamos la tabla decreto con la información del archivo adjunto
        $sentenciaSQL = $conexion->prepare("UPDATE decreto SET ADJUNTO_INI_ID = :ADJUNTO_INI_ID WHERE DECRETO_N_CORRELATIVO = :DECRETO_N_CORRELATIVO AND DECRETO_ANIO = :DECRETO_ANIO");
        $sentenciaSQL->bindParam(':ADJUNTO_INI_ID', $idArchivo ,PDO::PARAM_INT);
        $sentenciaSQL->bindParam(':DECRETO_N_CORRELATIVO', $decrenumber,PDO::PARAM_INT);
        $sentenciaSQL->bindParam(':DECRETO_ANIO', $año,PDO::PARAM_STR);
        $sentenciaSQL->execute();
    } catch (\Throwable $th) {
        echo "Error al guardar pdf!";
    }



}


// --------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------


if(isset($_POST['btnpdfPSjuezJP']))
{ if ((isset($_POST['txtcargo2PSM']))?$_POST['txtcargo2PSM']:"") {
    $selectCargo2 =(isset($_POST['txtcargo2PSM']))?$_POST['txtcargo2PSM']:"";
    try {
        $sentenciaSQL=$conexion->prepare("SELECT CARGO_JUEZ_NOMBRE from cargo_juez WHERE CARGO_JUEZ_ID = :CARGO_JUEZ_ID");
        $sentenciaSQL->bindParam(':CARGO_JUEZ_ID',$selectCargo2);
        $sentenciaSQL->execute();
        $strCargo=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
        $cargo = $strCargo['CARGO_JUEZ_NOMBRE'];
    } catch (\Throwable $th) {
       $cargo="";
    }
}else{
    $cargo= "Default";
}
    

if ((isset($_POST['txtJuez2PSM']))?$_POST['txtJuez2PSM']:"") {
    $juezid =(isset($_POST['txtJuez2PSM']))?$_POST['txtJuez2PSM']:"";
    try {
        $sentenciaSQL=$conexion->prepare("SELECT JUEZ_NOMBRE, JUEZ_APELLIDO from juez WHERE JUEZ_ID = :JUEZ_ID");
        $sentenciaSQL->bindParam(':JUEZ_ID',$juezid);
        $sentenciaSQL->execute();
        $strjuez=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
        $juezNombre = $strjuez['JUEZ_NOMBRE'];
        $juezApellido= $strjuez['JUEZ_APELLIDO'];
        
        $txtJuez = $juezNombre." ".$juezApellido;
    } catch (\Throwable $th) {
       $txtJuez="";
    }
}else{
    $txtJuez="Default";
} 


if ((isset($_POST['txtdata2PSM']))?$_POST['txtdata2PSM']:"") {
    $txtdate2 = (isset($_POST['txtdata2PSM']))?$_POST['txtdata2PSM']:"";
    setlocale(LC_ALL,"es");
    $fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
    $strFinal= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR));
}else{
    $txtdate2= "Default";
}
if ((isset($_POST['datepickerPSM']))?$_POST['datepickerPSM']:"") {
    $txtdate2 = (isset($_POST['datepickerPSM']))?$_POST['datepickerPSM']:"";
    setlocale(LC_ALL,"es");
    $fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
    $strFinal= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR));
}else{
    $txtdate2= "Default";
}

if ((isset($_POST['txtTipo2PSM']))?$_POST['txtTipo2PSM']:"") {
    $selectDecreto2 = (isset($_POST['txtTipo2PSM']))?$_POST['txtTipo2PSM']:"";
}else{
    $selectDecreto2= "Default";
}

if ((isset($_POST['txtdecrePSM']))?$_POST['txtdecrePSM']:"") {
    $decrenumber =(isset($_POST['txtdecrePSM']))?$_POST['txtdecrePSM']:"";
}else{
    $decrenumber= "?";
}


if ((isset($_POST['datepicker2PSM']))?$_POST['datepicker2PSM']:"") {
    $fechaResolucion =(isset($_POST['datepicker2PSM']))?$_POST['datepicker2PSM']:"";
}else{
    $fechaResolucion= "FechaR";
}



if ((isset($_POST['txtdiasPSM']))?$_POST['txtdiasPSM']:"") {
    $days =(isset($_POST['txtdiasPSM']))?$_POST['txtdiasPSM']:"";
}else{
    $days= "dias";
}



if ((isset($_POST['txtResolucionPSM']))?$_POST['txtResolucionPSM']:"") {
    $txtResolucion =(isset($_POST['txtResolucionPSM']))?$_POST['txtResolucionPSM']:"";
}else{
    $txtResolucion= "Resolucion";
}

if ((isset($_POST['txtAusentePSM']))?$_POST['txtAusentePSM']:""){
    $ausenteid =(isset($_POST['txtAusentePSM']))?$_POST['txtAusentePSM']:"";
    try {
        $sentenciaSQL=$conexion->prepare("SELECT FUNCIONARIO_NOMBRE, FUNCIONARIO_APELLIDO from funcionario WHERE FUNCIONARIO_ID = :FUNCIONARIO_ID");
        $sentenciaSQL->bindParam(':FUNCIONARIO_ID',$ausenteid);
        $sentenciaSQL->execute();
        $strfuncionario=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
        $FuncNombre = $strfuncionario['FUNCIONARIO_NOMBRE'];
        $FuncApellido = $strfuncionario['FUNCIONARIO_APELLIDO'];

        $txtAusente =  $FuncNombre." ".$FuncApellido;
    } catch (\Throwable $th) {
        $txtAusente="";

    }
}else{
    $txtAusente= "Default";
}

if ((isset($_POST['txtSubrogantePSM']))?$_POST['txtSubrogantePSM']:""){
    $subroganteid =(isset($_POST['txtSubrogantePSM']))?$_POST['txtSubrogantePSM']:"";
    try {
        $sentenciaSQL=$conexion->prepare("SELECT FUNCIONARIO_NOMBRE, FUNCIONARIO_APELLIDO from funcionario WHERE FUNCIONARIO_ID = :FUNCIONARIO_ID");
        $sentenciaSQL->bindParam(':FUNCIONARIO_ID',$subroganteid);
        $sentenciaSQL->execute();
        $strfuncionario=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
        $FuncNombre = $strfuncionario['FUNCIONARIO_NOMBRE'];
        $FuncApellido = $strfuncionario['FUNCIONARIO_APELLIDO'];

        $txtSubrogante =  $FuncNombre." ".$FuncApellido;
    } catch (\Throwable $th) {
        $txtSubrogante="err";

    }
}else{
    $txtSubrogante= "Default";
}

if ((isset($_POST['selectcargoSubrogantePSM']))?$_POST['selectcargoSubrogantePSM']:"") {
    $cargoSub =(isset($_POST['selectcargoSubrogantePSM']))?$_POST['selectcargoSubrogantePSM']:"";
    try {
        $sentenciaSQL=$conexion->prepare("SELECT CARGO_FUNC_NOMBRE from cargo_funcionario WHERE CARGO_FUNC_ID = :CARGO_FUNC_ID");
        $sentenciaSQL->bindParam(':CARGO_FUNC_ID',$cargoSub);
        $sentenciaSQL->execute();
        $strCargo=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
        $txtcargoSub = $strCargo['CARGO_FUNC_NOMBRE'];
    } catch (\Throwable $th) {
        $txtcargoSub="";
    }
}else{
    $txtcargoSub= "Default";
}

  if ((isset($_POST['txtSubroganteMFEPSM']))?$_POST['txtSubroganteMFEPSM']:"") {
    $subroganteMFEid =(isset($_POST['txtSubroganteMFEPSM']))?$_POST['txtSubroganteMFEPSM']:"";
    try {
        $sentenciaSQL=$conexion->prepare("SELECT FUNCIONARIO_NOMBRE, FUNCIONARIO_APELLIDO from funcionario WHERE FUNCIONARIO_ID = :FUNCIONARIO_ID");
        $sentenciaSQL->bindParam(':FUNCIONARIO_ID',$subroganteMFEid);
        $sentenciaSQL->execute();
        $strfuncionario=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
        $FuncNombre = $strfuncionario['FUNCIONARIO_NOMBRE'];
        $FuncApellido = $strfuncionario['FUNCIONARIO_APELLIDO'];

        $txtSubroganteMFE =  $FuncNombre." ".$FuncApellido;
    } catch (\Throwable $th) {
        $txtSubroganteMFE="";

    }
}else{
    $txtSubroganteMFE= "No ingresado";
}


if ((isset($_POST['selectcargoMFEPSM']))?$_POST['selectcargoMFEPSM']:"") {
    $cargoMFE =(isset($_POST['selectcargoMFEPSM']))?$_POST['selectcargoMFEPSM']:"";
    try {
        $sentenciaSQL=$conexion->prepare("SELECT CARGO_FUNC_NOMBRE from cargo_funcionario WHERE CARGO_FUNC_ID = :CARGO_FUNC_ID");
        $sentenciaSQL->bindParam(':CARGO_FUNC_ID',$cargoMFE);
        $sentenciaSQL->execute();
        $strCargo=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
        $txtcargoMFE = $strCargo['CARGO_FUNC_NOMBRE'];
    } catch (\Throwable $th) {
        $txtcargoMFE="";
    }
}else{
    $txtcargoMFE= "No ingresado";
}

$fechaFormato= date("d-m-Y", strtotime($txtdate2));
$fechaDesde= date("d-m-Y", strtotime($fechaResolucion));
$fechaHasta= date("d-m-Y", strtotime($secondDate));
$año = date("Y");
    try {
        $mpdf = new \Mpdf\Mpdf();

        // set the sourcefile
        // $mpdf->SetImportUse(); // <--- not needed for mPDF version 8.0+
        $mpdf->setSourceFile('../../Assets/plantillas/PERMISO-SUBROGANCIA-JUEZ_JP-CLS.pdf'); // absolute path to pdf file
        
        // import page 1
        $tplIdx = $mpdf->importPage(1);
        
        // use the imported page and place it at point 10,10 with a width of 200 mm   (This is the image of the included pdf)
        $mpdf->useTemplate($tplIdx,5,-7,200);
        
        // now write some text above the imported page
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 8);
        $mpdf->SetXY(23,134);
        $mpdf->Cell(0, 10, $txtAusente, 0, 0, 'L');


        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 9);
        $mpdf->SetXY(137,167);
        $mpdf->Cell(0, 10, $txtSubrogante, 0, 0, 'L');

        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 10);
        $mpdf->SetXY(132,134);
        $mpdf->Cell(0, 10, $days, 0, 0, 'L');
        
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 9);
        $mpdf->SetXY(73,134);
        $mpdf->Cell(0, 10, $fechaDesde, 0, 0, 'L');

        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 10);
        $mpdf->SetXY(103,134);
        $mpdf->Cell(0, 10, $txtResolucion, 0, 0, 'L');

         $mpdf->SetTextColor(0, 0, 0);
         $mpdf->SetFont('Arial', 'B', 18);
         $mpdf->SetXY(133,42);
         $mpdf->Cell(0, 10, $decrenumber, 0, 0, 'L');

         $mpdf->SetTextColor(0, 0, 0);
         $mpdf->SetFont('Arial', 'B', 18);
         $mpdf->SetXY(149,42);
         $mpdf->Cell(0, 10," - " . $año, 0, 0, 'L');
        
        $mpdf->SetTextColor(0,0,0);
        $mpdf->SetFont('Arial', '', 10);
        $mpdf->SetXY(70,75.6);
        $mpdf->Cell(0, 10, $strFinal, 0, 0, 'L');
    
        
        $mpdf->SetTextColor(0,0,0);
        $mpdf->SetFont('Arial', 'B', 12);
        $mpdf->SetXY(119,205);
        $mpdf->Cell(0, 10, $txtJuez, 0, 0, 'L');
        
        $mpdf->SetTextColor(0,0,0);
        $mpdf->SetFont('Arial', 'B', 10);
        $mpdf->SetXY(132,210);
        $mpdf->Cell(0, 10, $cargo, 0, 0, 'L');
        

    $mpdf->Output('filename.pdf', \Mpdf\Output\Destination::INLINE);

    } catch (\Throwable $th) {
        echo"error al generar pdf";
    }

 
    try {
        // Generamos el año actual para la comparación
        $año = date("Y");
    
        // Asignamos el nombre del archivo con una ID única y aleatoria
        $filename = uniqid(mt_rand(), true) . " - " ."Decreto_Permisos-Subrogancia_JP_N".$decrenumber."-".$año.".pdf";
        $path = 'C:/xampp/htdocs/IDE_PJUD/Assets/Decretos_originales/'.$filename;
    
        // Verificar si el archivo ya existe
        if (file_exists($path)) {
            // Si el archivo ya existe, lo eliminamos
            unlink($path);
        }
    
        // Guardamos el nuevo archivo y procedemos con la inserción en la base de datos
        $mpdf->Output($path, 'F');
    
        // Preparamos la consulta para insertar en la tabla adjunto_inicial
        $sentenciaSQL = $conexion->prepare("INSERT INTO adjunto_inicial (ADJUNTO_INI_ID, ADJUNTO_INI_NOMBRE) 
        VALUES (:ADJUNTO_INI_ID, :ADJUNTO_INI_NOMBRE) 
        ON DUPLICATE KEY UPDATE ADJUNTO_INI_NOMBRE = VALUES(ADJUNTO_INI_NOMBRE);");
        
        $idArchivo = intval($decrenumber) * 10000 + intval($año);
        $sentenciaSQL->bindParam(':ADJUNTO_INI_ID', $idArchivo ,PDO::PARAM_INT);
        $sentenciaSQL->bindParam(':ADJUNTO_INI_NOMBRE', $filename,PDO::PARAM_STR);
        $sentenciaSQL->execute();
    
// Luego actualizamos la tabla decreto con la información del archivo adjunto
        $sentenciaSQL = $conexion->prepare("UPDATE decreto SET ADJUNTO_INI_ID = :ADJUNTO_INI_ID WHERE DECRETO_N_CORRELATIVO = :DECRETO_N_CORRELATIVO AND DECRETO_ANIO = :DECRETO_ANIO");
        $sentenciaSQL->bindParam(':ADJUNTO_INI_ID', $idArchivo ,PDO::PARAM_INT);
        $sentenciaSQL->bindParam(':DECRETO_N_CORRELATIVO', $decrenumber,PDO::PARAM_INT);
        $sentenciaSQL->bindParam(':DECRETO_ANIO', $año,PDO::PARAM_STR);
        $sentenciaSQL->execute();
    } catch (\Throwable $th) {
        echo "Error al guardar pdf!";
    }



// --------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------


}
if(isset($_POST['btnpdfPSadm']))
{ if ((isset($_POST['txtcargo2PSM']))?$_POST['txtcargo2PSM']:"") {
    $selectCargo2 =(isset($_POST['txtcargo2PSM']))?$_POST['txtcargo2PSM']:"";
    try {
        $sentenciaSQL=$conexion->prepare("SELECT CARGO_JUEZ_NOMBRE from cargo_juez WHERE CARGO_JUEZ_ID = :CARGO_JUEZ_ID");
        $sentenciaSQL->bindParam(':CARGO_JUEZ_ID',$selectCargo2);
        $sentenciaSQL->execute();
        $strCargo=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
        $cargo = $strCargo['CARGO_JUEZ_NOMBRE'];
    } catch (\Throwable $th) {
       $cargo="";
    }
}else{
    $cargo= "Default";
}
    

if ((isset($_POST['txtJuez2PSM']))?$_POST['txtJuez2PSM']:"") {
    $juezid =(isset($_POST['txtJuez2PSM']))?$_POST['txtJuez2PSM']:"";
    try {
        $sentenciaSQL=$conexion->prepare("SELECT JUEZ_NOMBRE, JUEZ_APELLIDO from juez WHERE JUEZ_ID = :JUEZ_ID");
        $sentenciaSQL->bindParam(':JUEZ_ID',$juezid);
        $sentenciaSQL->execute();
        $strjuez=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
        $juezNombre = $strjuez['JUEZ_NOMBRE'];
        $juezApellido= $strjuez['JUEZ_APELLIDO'];
        
        $txtJuez = $juezNombre." ".$juezApellido;
    } catch (\Throwable $th) {
       $txtJuez="";
    }
}else{
    $txtJuez="Default";
} 


if ((isset($_POST['txtdata2PSM']))?$_POST['txtdata2PSM']:"") {
    $txtdate2 = (isset($_POST['txtdata2PSM']))?$_POST['txtdata2PSM']:"";
    setlocale(LC_ALL,"es");
    $fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
    $strFinal= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR));
}else{
    $txtdate2= "Default";
}
if ((isset($_POST['datepickerPSM']))?$_POST['datepickerPSM']:"") {
    $txtdate2 = (isset($_POST['datepickerPSM']))?$_POST['datepickerPSM']:"";
    setlocale(LC_ALL,"es");
    $fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
    $strFinal= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR));
}else{
    $txtdate2= "Default";
}

if ((isset($_POST['txtTipo2PSM']))?$_POST['txtTipo2PSM']:"") {
    $selectDecreto2 = (isset($_POST['txtTipo2PSM']))?$_POST['txtTipo2PSM']:"";
}else{
    $selectDecreto2= "Default";
}

if ((isset($_POST['txtdecrePSM']))?$_POST['txtdecrePSM']:"") {
    $decrenumber =(isset($_POST['txtdecrePSM']))?$_POST['txtdecrePSM']:"";
}else{
    $decrenumber= "?";
}


if ((isset($_POST['datepicker2PSM']))?$_POST['datepicker2PSM']:"") {
    $fechaResolucion =(isset($_POST['datepicker2PSM']))?$_POST['datepicker2PSM']:"";
}else{
    $fechaResolucion= "FechaR";
}



if ((isset($_POST['txtdiasPSM']))?$_POST['txtdiasPSM']:"") {
    $days =(isset($_POST['txtdiasPSM']))?$_POST['txtdiasPSM']:"";
}else{
    $days= "dias";
}



if ((isset($_POST['txtResolucionPSM']))?$_POST['txtResolucionPSM']:"") {
    $txtResolucion =(isset($_POST['txtResolucionPSM']))?$_POST['txtResolucionPSM']:"";
}else{
    $txtResolucion= "Resolucion";
}

if ((isset($_POST['txtAusentePSM']))?$_POST['txtAusentePSM']:""){
    $ausenteid =(isset($_POST['txtAusentePSM']))?$_POST['txtAusentePSM']:"";
    try {
        $sentenciaSQL=$conexion->prepare("SELECT FUNCIONARIO_NOMBRE, FUNCIONARIO_APELLIDO from funcionario WHERE FUNCIONARIO_ID = :FUNCIONARIO_ID");
        $sentenciaSQL->bindParam(':FUNCIONARIO_ID',$ausenteid);
        $sentenciaSQL->execute();
        $strfuncionario=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
        $FuncNombre = $strfuncionario['FUNCIONARIO_NOMBRE'];
        $FuncApellido = $strfuncionario['FUNCIONARIO_APELLIDO'];

        $txtAusente =  $FuncNombre." ".$FuncApellido;
    } catch (\Throwable $th) {
        $txtAusente="";

    }
}else{
    $txtAusente= "Default";
}

if ((isset($_POST['txtSubrogantePSM']))?$_POST['txtSubrogantePSM']:""){
    $subroganteid =(isset($_POST['txtSubrogantePSM']))?$_POST['txtSubrogantePSM']:"";
    try {
        $sentenciaSQL=$conexion->prepare("SELECT FUNCIONARIO_NOMBRE, FUNCIONARIO_APELLIDO from funcionario WHERE FUNCIONARIO_ID = :FUNCIONARIO_ID");
        $sentenciaSQL->bindParam(':FUNCIONARIO_ID',$subroganteid);
        $sentenciaSQL->execute();
        $strfuncionario=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
        $FuncNombre = $strfuncionario['FUNCIONARIO_NOMBRE'];
        $FuncApellido = $strfuncionario['FUNCIONARIO_APELLIDO'];

        $txtSubrogante =  $FuncNombre." ".$FuncApellido;
    } catch (\Throwable $th) {
        $txtSubrogante="err";

    }
}else{
    $txtSubrogante= "Default";
}

if ((isset($_POST['selectcargoSubrogantePSM']))?$_POST['selectcargoSubrogantePSM']:"") {
    $cargoSub =(isset($_POST['selectcargoSubrogantePSM']))?$_POST['selectcargoSubrogantePSM']:"";
    try {
        $sentenciaSQL=$conexion->prepare("SELECT CARGO_FUNC_NOMBRE from cargo_funcionario WHERE CARGO_FUNC_ID = :CARGO_FUNC_ID");
        $sentenciaSQL->bindParam(':CARGO_FUNC_ID',$cargoSub);
        $sentenciaSQL->execute();
        $strCargo=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
        $txtcargoSub = $strCargo['CARGO_FUNC_NOMBRE'];
    } catch (\Throwable $th) {
        $txtcargoSub="";
    }
}else{
    $txtcargoSub= "Default";
}

  if ((isset($_POST['txtSubroganteMFEPSM']))?$_POST['txtSubroganteMFEPSM']:"") {
    $subroganteMFEid =(isset($_POST['txtSubroganteMFEPSM']))?$_POST['txtSubroganteMFEPSM']:"";
    try {
        $sentenciaSQL=$conexion->prepare("SELECT FUNCIONARIO_NOMBRE, FUNCIONARIO_APELLIDO from funcionario WHERE FUNCIONARIO_ID = :FUNCIONARIO_ID");
        $sentenciaSQL->bindParam(':FUNCIONARIO_ID',$subroganteMFEid);
        $sentenciaSQL->execute();
        $strfuncionario=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
        $FuncNombre = $strfuncionario['FUNCIONARIO_NOMBRE'];
        $FuncApellido = $strfuncionario['FUNCIONARIO_APELLIDO'];

        $txtSubroganteMFE =  $FuncNombre." ".$FuncApellido;
    } catch (\Throwable $th) {
        $txtSubroganteMFE="";

    }
}else{
    $txtSubroganteMFE= "No ingresado";
}


if ((isset($_POST['selectcargoMFEPSM']))?$_POST['selectcargoMFEPSM']:"") {
    $cargoMFE =(isset($_POST['selectcargoMFEPSM']))?$_POST['selectcargoMFEPSM']:"";
    try {
        $sentenciaSQL=$conexion->prepare("SELECT CARGO_FUNC_NOMBRE from cargo_funcionario WHERE CARGO_FUNC_ID = :CARGO_FUNC_ID");
        $sentenciaSQL->bindParam(':CARGO_FUNC_ID',$cargoMFE);
        $sentenciaSQL->execute();
        $strCargo=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
        $txtcargoMFE = $strCargo['CARGO_FUNC_NOMBRE'];
    } catch (\Throwable $th) {
        $txtcargoMFE="";
    }
}else{
    $txtcargoMFE= "No ingresado";
}

$fechaDesde= date("d-m-Y", strtotime($fechaResolucion));
$año = date("Y");
    try {
        $mpdf = new \Mpdf\Mpdf();

        // set the sourcefile
        // $mpdf->SetImportUse(); // <--- not needed for mPDF version 8.0+
        $mpdf->setSourceFile('../../Assets/plantillas/PERMISO-SUBROGANCIA-ADM.pdf'); // absolute path to pdf file
        
        // import page 1
        $tplIdx = $mpdf->importPage(1);
        
        // use the imported page and place it at point 10,10 with a width of 200 mm   (This is the image of the included pdf)
        $mpdf->useTemplate($tplIdx,5,-7,200);
        
        // now write some text above the imported page
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 8);
        $mpdf->SetXY(25,128);
        $mpdf->Cell(0, 10, $txtAusente, 0, 0, 'L');


        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 9);
        $mpdf->SetXY(64,184.6);
        $mpdf->Cell(0, 10, $txtSubrogante, 0, 0, 'L');
        
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 9);
        $mpdf->SetXY(120,184.4);
        $mpdf->Cell(0, 10," - " . $txtcargoSub . " Titular.", 0, 0, 'L');


        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 10);
        $mpdf->SetXY(136,128);
        $mpdf->Cell(0, 10, $days, 0, 0, 'L');
        
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 9);
        $mpdf->SetXY(78,128);
        $mpdf->Cell(0, 10, $fechaDesde, 0, 0, 'L');

        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 10);
        $mpdf->SetXY(107,128);
        $mpdf->Cell(0, 10, $txtResolucion, 0, 0, 'L');

         $mpdf->SetTextColor(0, 0, 0);
         $mpdf->SetFont('Arial', 'B', 18);
         $mpdf->SetXY(133,42);
         $mpdf->Cell(0, 10, $decrenumber, 0, 0, 'L');

         $mpdf->SetTextColor(0, 0, 0);
         $mpdf->SetFont('Arial', 'B', 18);
         $mpdf->SetXY(149,42);
         $mpdf->Cell(0, 10," - " . $año, 0, 0, 'L');
        
        $mpdf->SetTextColor(0,0,0);
        $mpdf->SetFont('Arial', '', 10);
        $mpdf->SetXY(70,70.6);
        $mpdf->Cell(0, 10, $strFinal, 0, 0, 'L');
    
        
        $mpdf->SetTextColor(0,0,0);
        $mpdf->SetFont('Arial', 'B', 12);
        $mpdf->SetXY(130,237);
        $mpdf->Cell(0, 10, $txtJuez, 0, 0, 'L');
        
        $mpdf->SetTextColor(0,0,0);
        $mpdf->SetFont('Arial', 'B', 10);
        $mpdf->SetXY(132,243);
        $mpdf->Cell(0, 10, $cargo, 0, 0, 'L');
       

    $mpdf->Output('filename.pdf', \Mpdf\Output\Destination::INLINE);

    } catch (\Throwable $th) {
        echo"error al generar pdf";
    }

    try {
        $año = date("Y");
        $filename = uniqid(mt_rand(), true) . " - " ."Decreto_Permisos-Subrogancia_ADM_N".$decrenumber."-".$año.".pdf";
        $mpdf->Output('C:/xampp/htdocs/PJUD/Assets/Decretos_originales/'.$filename, 'F');

      
        $sentenciaSQL = $conexion->prepare("UPDATE decreto SET ARCHIVO_ADJUNTO = :ARCHIVO_ADJUNTO WHERE N_DECRETO = :N_DECRETO AND ANIO = :ANIO");

        $sentenciaSQL->bindParam(':ARCHIVO_ADJUNTO',$filename);
        $sentenciaSQL->bindParam(':N_DECRETO',$decrenumber);
        $sentenciaSQL->bindParam(':ANIO',$año);
        $sentenciaSQL->execute();
    } catch (\Throwable $th) {
        echo "error al guardar pdf!";
    }
  
    try {
        // Generamos el año actual para la comparación
        $año = date("Y");
    
        // Asignamos el nombre del archivo con una ID única y aleatoria
        $filename = uniqid(mt_rand(), true) . " - " ."Decreto_Permisos-Subrogancia_ADM_N".$decrenumber."-".$año.".pdf";
        $path = 'C:/xampp/htdocs/IDE_PJUD/Assets/Decretos_originales/'.$filename;
    
        // Verificar si el archivo ya existe
        if (file_exists($path)) {
            // Si el archivo ya existe, lo eliminamos
            unlink($path);
        }
    
        // Guardamos el nuevo archivo y procedemos con la inserción en la base de datos
        $mpdf->Output($path, 'F');
    
        // Preparamos la consulta para insertar en la tabla adjunto_inicial
        $sentenciaSQL = $conexion->prepare("INSERT INTO adjunto_inicial (ADJUNTO_INI_ID, ADJUNTO_INI_NOMBRE) 
        VALUES (:ADJUNTO_INI_ID, :ADJUNTO_INI_NOMBRE) 
        ON DUPLICATE KEY UPDATE ADJUNTO_INI_NOMBRE = VALUES(ADJUNTO_INI_NOMBRE);");
        
        $idArchivo = intval($decrenumber) * 10000 + intval($año);
        $sentenciaSQL->bindParam(':ADJUNTO_INI_ID', $idArchivo ,PDO::PARAM_INT);
        $sentenciaSQL->bindParam(':ADJUNTO_INI_NOMBRE', $filename,PDO::PARAM_STR);
        $sentenciaSQL->execute();
    
// Luego actualizamos la tabla decreto con la información del archivo adjunto
        $sentenciaSQL = $conexion->prepare("UPDATE decreto SET ADJUNTO_INI_ID = :ADJUNTO_INI_ID WHERE DECRETO_N_CORRELATIVO = :DECRETO_N_CORRELATIVO AND DECRETO_ANIO = :DECRETO_ANIO");
        $sentenciaSQL->bindParam(':ADJUNTO_INI_ID', $idArchivo ,PDO::PARAM_INT);
        $sentenciaSQL->bindParam(':DECRETO_N_CORRELATIVO', $decrenumber,PDO::PARAM_INT);
        $sentenciaSQL->bindParam(':DECRETO_ANIO', $año,PDO::PARAM_STR);
        $sentenciaSQL->execute();
    } catch (\Throwable $th) {
        echo "Error al guardar pdf!";
    }

}