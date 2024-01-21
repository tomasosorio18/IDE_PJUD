<?php
//incluimos el conector a la base de datos;
include("../../Configuration/Connector.php");
//requerimos la clase del generador de pdf mpdf con el autoload.php
require_once '../../Assets/vendor/autoload.php';

// --------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------



 if(isset($_POST['btnpdfLSjefeU']))
{ 
    if ((isset($_POST['txtcargo2LSM']))?$_POST['txtcargo2LSM']:"") {
        $selectCargo2 =(isset($_POST['txtcargo2LSM']))?$_POST['txtcargo2LSM']:"";
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
        
    
    if ((isset($_POST['txtJuez2LSM']))?$_POST['txtJuez2LSM']:"") {
        $juezid =(isset($_POST['txtJuez2LSM']))?$_POST['txtJuez2LSM']:"";
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
    
    
    if ((isset($_POST['txtdata2LSM']))?$_POST['txtdata2LSM']:"") {
        $txtdate2 = (isset($_POST['txtdata2LSM']))?$_POST['txtdata2LSM']:"";
        setlocale(LC_ALL,"es");
        $fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
        $strFinal= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR));
    }else{
        $txtdate2= "Default";
    }
    if ((isset($_POST['datepickerLSM']))?$_POST['datepickerLSM']:"") {
        $txtdate2 = (isset($_POST['datepickerLSM']))?$_POST['datepickerLSM']:"";
        setlocale(LC_ALL,"es");
        $fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
        $strFinal= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR));
    }else{
        $txtdate2= "Default";
    }
    
    if ((isset($_POST['txtTipo2LSM']))?$_POST['txtTipo2LSM']:"") {
        $selectDecreto2 = (isset($_POST['txtTipo2LSM']))?$_POST['txtTipo2LSM']:"";
    }else{
        $selectDecreto2= "Default";
    }
    
    if ((isset($_POST['txtdecreLSM']))?$_POST['txtdecreLSM']:"") {
        $decrenumber =(isset($_POST['txtdecreLSM']))?$_POST['txtdecreLSM']:"";
    }else{
        $decrenumber= "?";
    }
    
        
    if ((isset($_POST['datepicker2LSM']))?$_POST['datepicker2LSM']:"") {
        $fechaResolucion =(isset($_POST['datepicker2LSM']))?$_POST['datepicker2LSM']:"";
    }else{
        $fechaResolucion= "FechaR";  
    }
    
    
    
    if ((isset($_POST['txtdiasLSM']))?$_POST['txtdiasLSM']:"") {
        $days =(isset($_POST['txtdiasLSM']))?$_POST['txtdiasLSM']:"";
    }else{
        $days= "dias";
    }
    
    
    
    if ((isset($_POST['txtResolucionLSM']))?$_POST['txtResolucionLSM']:"") {
        $txtResolucion =(isset($_POST['txtResolucionLSM']))?$_POST['txtResolucionLSM']:"";
    }else{
        $txtResolucion= "Resolucion";
    }

    if ((isset($_POST['txtAusenteLSM']))?$_POST['txtAusenteLSM']:""){
        $ausenteid =(isset($_POST['txtAusenteLSM']))?$_POST['txtAusenteLSM']:"";
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

    if ((isset($_POST['txtSubroganteLSM']))?$_POST['txtSubroganteLSM']:""){
        $subroganteid =(isset($_POST['txtSubroganteLSM']))?$_POST['txtSubroganteLSM']:"";
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

    if ((isset($_POST['selectcargoSubroganteLSM']))?$_POST['selectcargoSubroganteLSM']:"") {
        $cargoSub =(isset($_POST['selectcargoSubroganteLSM']))?$_POST['selectcargoSubroganteLSM']:"";
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

      if ((isset($_POST['txtSubroganteMFELSM']))?$_POST['txtSubroganteMFELSM']:"") {
        $subroganteMFEid =(isset($_POST['txtSubroganteMFELSM']))?$_POST['txtSubroganteMFELSM']:"";
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


    if ((isset($_POST['selectcargoMFELSM']))?$_POST['selectcargoMFELSM']:"") {
        $cargoMFE =(isset($_POST['selectcargoMFELSM']))?$_POST['selectcargoMFELSM']:"";
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
            $mpdf->setSourceFile('../../Assets/plantillas/LICENCIA_MEDICA_JEFE_UNIDAD_CLS.pdf'); // absolute path to pdf file
            
            // import page 1
            $tplIdx = $mpdf->importPage(1);
            
            // use the imported page and place it at point 10,10 with a width of 200 mm   (This is the image of the included pdf)
            $mpdf->useTemplate($tplIdx,5,-7,200);
            
            // now write some text above the imported page
            $mpdf->SetTextColor(0, 0, 0);
            $mpdf->SetFont('Arial', 'b', 8);
            $mpdf->SetXY(26,107.4);
            $mpdf->Cell(0, 10, $txtAusente, 0, 0, 'L');
    
    
            $mpdf->SetTextColor(0, 0, 0);
            $mpdf->SetFont('Arial', 'b', 9);
            $mpdf->SetXY(45,155.6);
            $mpdf->Cell(0, 10, $txtSubrogante, 0, 0, 'L');

            $mpdf->SetTextColor(0, 0, 0);
            $mpdf->SetFont('Arial', 'b', 9);
            $mpdf->SetXY(105,155.6);
            $mpdf->Cell(0, 10," - " . $txtcargoSub . " Titular.", 0, 0, 'L');

            $mpdf->SetTextColor(0, 0, 0);
            $mpdf->SetFont('Arial', 'b', 9);
            $mpdf->SetXY(27,173.7);
            $mpdf->Cell(0, 10, $txtSubroganteMFE, 0, 0, 'L');

            $mpdf->SetTextColor(0, 0, 0);
            $mpdf->SetFont('Arial', 'b', 9);
            $mpdf->SetXY(87,173.7);
            $mpdf->Cell(0, 10," - " . $txtcargoMFE . " Titular.", 0, 0, 'L');
    
            $mpdf->SetTextColor(0, 0, 0);
            $mpdf->SetFont('Arial', 'b', 10);
            $mpdf->SetXY(128,107.4);
            $mpdf->Cell(0, 10, $days, 0, 0, 'L');
            
            $mpdf->SetTextColor(0, 0, 0);
            $mpdf->SetFont('Arial', 'b', 9);
            $mpdf->SetXY(78,107.4);
            $mpdf->Cell(0, 10, $fechaDesde, 0, 0, 'L');
    
            $mpdf->SetTextColor(0, 0, 0);
            $mpdf->SetFont('Arial', 'b', 10);
            $mpdf->SetXY(101,107.4);
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
            $mpdf->SetXY(121,222);
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
            $filename = uniqid(mt_rand(), true) . " - " ."Decreto_Licencias-Subrogancia_JU_N".$decrenumber."-".$año.".pdf";
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


 
if(isset($_POST['btnpdfLSjuezJ']))
{    if ((isset($_POST['txtcargo2LSM']))?$_POST['txtcargo2LSM']:"") {
    $selectCargo2 =(isset($_POST['txtcargo2LSM']))?$_POST['txtcargo2LSM']:"";
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
    

if ((isset($_POST['txtJuez2LSM']))?$_POST['txtJuez2LSM']:"") {
    $juezid =(isset($_POST['txtJuez2LSM']))?$_POST['txtJuez2LSM']:"";
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



if ((isset($_POST['txtdata2LSM']))?$_POST['txtdata2LSM']:"") {
    $txtdate2 = (isset($_POST['txtdata2LSM']))?$_POST['txtdata2LSM']:"";
    setlocale(LC_ALL,"es");
    $fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
    $strFinal= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR));
}else{
    $txtdate2= "Default";
}
if ((isset($_POST['datepickerLSM']))?$_POST['datepickerLSM']:"") {
    $txtdate2 = (isset($_POST['datepickerLSM']))?$_POST['datepickerLSM']:"";
    setlocale(LC_ALL,"es");
    $fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
    $strFinal= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR));
}else{
    $txtdate2= "Default";
}

if ((isset($_POST['txtTipo2LSM']))?$_POST['txtTipo2LSM']:"") {
    $selectDecreto2 = (isset($_POST['txtTipo2LSM']))?$_POST['txtTipo2LSM']:"";
}else{
    $selectDecreto2= "Default";
}

if ((isset($_POST['txtdecreLSM']))?$_POST['txtdecreLSM']:"") {
    $decrenumber =(isset($_POST['txtdecreLSM']))?$_POST['txtdecreLSM']:"";
}else{
    $decrenumber= "?";
}


if ((isset($_POST['datepicker2LSM']))?$_POST['datepicker2LSM']:"") {
    $fechaResolucion =(isset($_POST['datepicker2LSM']))?$_POST['datepicker2LSM']:"";
}else{
    $fechaResolucion= "FechaR";
}



if ((isset($_POST['txtdiasLSM']))?$_POST['txtdiasLSM']:"") {
    $days =(isset($_POST['txtdiasLSM']))?$_POST['txtdiasLSM']:"";
}else{
    $days= "dias";
}



if ((isset($_POST['txtResolucionLSM']))?$_POST['txtResolucionLSM']:"") {
    $txtResolucion =(isset($_POST['txtResolucionLSM']))?$_POST['txtResolucionLSM']:"";
}else{
    $txtResolucion= "Resolucion";
}

if ((isset($_POST['txtAusenteLSM']))?$_POST['txtAusenteLSM']:""){
    $ausenteid =(isset($_POST['txtAusenteLSM']))?$_POST['txtAusenteLSM']:"";
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

if ((isset($_POST['txtSubroganteLSM']))?$_POST['txtSubroganteLSM']:""){
    $subroganteid =(isset($_POST['txtSubroganteLSM']))?$_POST['txtSubroganteLSM']:"";
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

if ((isset($_POST['selectcargoSubroganteLSM']))?$_POST['selectcargoSubroganteLSM']:"") {
    $cargoSub =(isset($_POST['selectcargoSubroganteLSM']))?$_POST['selectcargoSubroganteLSM']:"";
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
 
    // Se selecciona el pdf de origen
    // $mpdf->SetImportUse(); // <--- not needed for mPDF version 8.0+
    $mpdf->setSourceFile('../../Assets/plantillas/LICENCIA-SUBROGACION_J_CLS.pdf'); // absolute path to pdf file
    
    // Se importa la primera pagina del pdf
    $tplIdx = $mpdf->importPage(1);
    
    // aca se usa la pagina importada y la posiciona en punto 10,10 con un ancho de 200 mm (esta es la imagen del pdf incluido)
    $mpdf->useTemplate($tplIdx,5,-7,200);
    
    // Ahora asignamos las variables con sus respectivas posiciones en la pagina importada
    $mpdf->SetTextColor(0, 0, 0);
    //Set color sirve para aplicar ciertos colores al texto de las variables
    $mpdf->SetFont('Arial', 'b', 8);
    //SetFont para seleccionar las fuentes dle texto de las variables(no hay mucha variedad)
    $mpdf->SetXY(22,107.4);
    //SetXY para seleccionar la posicion de la variable 
    $mpdf->Cell(0, 10, $txtAusente, 0, 0, 'L');
    //Cell es una celda que sirve para posicionar mejor la variable, cuenta con textalignment como centrado, justificado, alineado a la izq, etc 

    $mpdf->SetTextColor(0, 0, 0);
    $mpdf->SetFont('Arial', 'b', 9);
    $mpdf->SetXY(101,162);
    $mpdf->Cell(0, 10, $txtSubrogante, 0, 0, 'L');

    $mpdf->SetTextColor(0, 0, 0);
    $mpdf->SetFont('Arial', 'b', 10);
    $mpdf->SetXY(132,107.4);
    $mpdf->Cell(0, 10, $days, 0, 0, 'L');
    
    $mpdf->SetTextColor(0, 0, 0);
    $mpdf->SetFont('Arial', 'b', 9);
    $mpdf->SetXY(74,107.4);
    $mpdf->Cell(0, 10, $fechaDesde, 0, 0, 'L');

    $mpdf->SetTextColor(0, 0, 0);
    $mpdf->SetFont('Arial', 'b', 10);
    $mpdf->SetXY(102,107.4);
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
    $mpdf->SetXY(70,63.8);
    $mpdf->Cell(0, 10, $strFinal, 0, 0, 'L');

    
    $mpdf->SetTextColor(0,0,0);
    $mpdf->SetFont('Arial', 'B', 12);
    $mpdf->SetXY(122,223);
    $mpdf->Cell(0, 10, $txtJuez, 0, 0, 'L');
    
    $mpdf->SetTextColor(0,0,0);
    $mpdf->SetFont('Arial', 'B', 10);
    $mpdf->SetXY(132,227.8);
    $mpdf->Cell(0, 10, $cargo, 0, 0, 'L');
   

    
   

$mpdf->Output('filename.pdf', \Mpdf\Output\Destination::INLINE);

} catch (\Throwable $th) {
    echo"error al generar pdf";
}




    try {
        // Generamos el año actual para la comparación
        $año = date("Y");
    
        // Asignamos el nombre del archivo con una ID única y aleatoria
        $filename = uniqid(mt_rand(), true) . " - " ."Decreto_Licencias-Subrogancia_J_N".$decrenumber."-".$año.".pdf";
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


if(isset($_POST['btnpdfLSjuezJP']))
{ if ((isset($_POST['txtcargo2LSM']))?$_POST['txtcargo2LSM']:"") {
    $selectCargo2 =(isset($_POST['txtcargo2LSM']))?$_POST['txtcargo2LSM']:"";
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
    

if ((isset($_POST['txtJuez2LSM']))?$_POST['txtJuez2LSM']:"") {
    $juezid =(isset($_POST['txtJuez2LSM']))?$_POST['txtJuez2LSM']:"";
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


if ((isset($_POST['txtdata2LSM']))?$_POST['txtdata2LSM']:"") {
    $txtdate2 = (isset($_POST['txtdata2LSM']))?$_POST['txtdata2LSM']:"";
    setlocale(LC_ALL,"es");
    $fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
    $strFinal= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR));
}else{
    $txtdate2= "Default";
}
if ((isset($_POST['datepickerLSM']))?$_POST['datepickerLSM']:"") {
    $txtdate2 = (isset($_POST['datepickerLSM']))?$_POST['datepickerLSM']:"";
    setlocale(LC_ALL,"es");
    $fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
    $strFinal= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR));
}else{
    $txtdate2= "Default";
}

if ((isset($_POST['txtTipo2LSM']))?$_POST['txtTipo2LSM']:"") {
    $selectDecreto2 = (isset($_POST['txtTipo2LSM']))?$_POST['txtTipo2LSM']:"";
}else{
    $selectDecreto2= "Default";
}

if ((isset($_POST['txtdecreLSM']))?$_POST['txtdecreLSM']:"") {
    $decrenumber =(isset($_POST['txtdecreLSM']))?$_POST['txtdecreLSM']:"";
}else{
    $decrenumber= "?";
}


if ((isset($_POST['datepicker2LSM']))?$_POST['datepicker2LSM']:"") {
    $fechaResolucion =(isset($_POST['datepicker2LSM']))?$_POST['datepicker2LSM']:"";
}else{
    $fechaResolucion= "FechaR";
}



if ((isset($_POST['txtdiasLSM']))?$_POST['txtdiasLSM']:"") {
    $days =(isset($_POST['txtdiasLSM']))?$_POST['txtdiasLSM']:"";
}else{
    $days= "dias";
}



if ((isset($_POST['txtResolucionLSM']))?$_POST['txtResolucionLSM']:"") {
    $txtResolucion =(isset($_POST['txtResolucionLSM']))?$_POST['txtResolucionLSM']:"";
}else{
    $txtResolucion= "Resolucion";
}

if ((isset($_POST['txtAusenteLSM']))?$_POST['txtAusenteLSM']:""){
    $ausenteid =(isset($_POST['txtAusenteLSM']))?$_POST['txtAusenteLSM']:"";
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

if ((isset($_POST['txtSubroganteLSM']))?$_POST['txtSubroganteLSM']:""){
    $subroganteid =(isset($_POST['txtSubroganteLSM']))?$_POST['txtSubroganteLSM']:"";
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

if ((isset($_POST['selectcargoSubroganteLSM']))?$_POST['selectcargoSubroganteLSM']:"") {
    $cargoSub =(isset($_POST['selectcargoSubroganteLSM']))?$_POST['selectcargoSubroganteLSM']:"";
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

  if ((isset($_POST['txtSubroganteMFELSM']))?$_POST['txtSubroganteMFELSM']:"") {
    $subroganteMFEid =(isset($_POST['txtSubroganteMFELSM']))?$_POST['txtSubroganteMFELSM']:"";
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


if ((isset($_POST['selectcargoMFELSM']))?$_POST['selectcargoMFELSM']:"") {
    $cargoMFE =(isset($_POST['selectcargoMFELSM']))?$_POST['selectcargoMFELSM']:"";
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

    // Se selecciona el pdf de origen
    // $mpdf->SetImportUse(); // <--- not needed for mPDF version 8.0+
    $mpdf->setSourceFile('../../Assets/plantillas/LICENCIA-SUBROGACION_JP_CLS.pdf'); // absolute path to pdf file
    
    // Se importa la primera pagina del pdf
    $tplIdx = $mpdf->importPage(1);
    
    // aca se usa la pagina importada y la posiciona en punto 10,10 con un ancho de 200 mm (esta es la imagen del pdf incluido)
    $mpdf->useTemplate($tplIdx,5,-7,200);
    
    // Ahora asignamos las variables con sus respectivas posiciones en la pagina importada
    $mpdf->SetTextColor(0, 0, 0);
    $mpdf->SetFont('Arial', 'b', 8);
    $mpdf->SetXY(22,107.4);
    $mpdf->Cell(0, 10, $txtAusente, 0, 0, 'L');


    $mpdf->SetTextColor(0, 0, 0);
    $mpdf->SetFont('Arial', 'b', 9);
    $mpdf->SetXY(101,162);
    $mpdf->Cell(0, 10, $txtSubrogante, 0, 0, 'L');

    $mpdf->SetTextColor(0, 0, 0);
    $mpdf->SetFont('Arial', 'b', 10);
    $mpdf->SetXY(132,107.4);
    $mpdf->Cell(0, 10, $days, 0, 0, 'L');
    
    $mpdf->SetTextColor(0, 0, 0);
    $mpdf->SetFont('Arial', 'b', 9);
    $mpdf->SetXY(74,107.4);
    $mpdf->Cell(0, 10, $fechaDesde, 0, 0, 'L');

    $mpdf->SetTextColor(0, 0, 0);
    $mpdf->SetFont('Arial', 'b', 10);
    $mpdf->SetXY(102,107.4);
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
    $mpdf->SetXY(70,63.8);
    $mpdf->Cell(0, 10, $strFinal, 0, 0, 'L');

    
    $mpdf->SetTextColor(0,0,0);
    $mpdf->SetFont('Arial', 'B', 12);
    $mpdf->SetXY(122,223);
    $mpdf->Cell(0, 10, $txtJuez, 0, 0, 'L');
    
    $mpdf->SetTextColor(0,0,0);
    $mpdf->SetFont('Arial', 'B', 10);
    $mpdf->SetXY(132,227.8);
    $mpdf->Cell(0, 10, $cargo, 0, 0, 'L');

$mpdf->Output('filename.pdf', \Mpdf\Output\Destination::INLINE);

} catch (\Throwable $th) {
    echo"error al generar pdf";
}



    try {
        // Generamos el año actual para la comparación
        $año = date("Y");
    
        // Asignamos el nombre del archivo con una ID única y aleatoria
        $filename = uniqid(mt_rand(), true) . " - " ."Decreto_Licencias-Subrogancia_JP_N".$decrenumber."-".$año.".pdf";
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
if(isset($_POST['btnpdfLSadm']))
{ if ((isset($_POST['txtcargo2LSM']))?$_POST['txtcargo2LSM']:"") {
    $selectCargo2 =(isset($_POST['txtcargo2LSM']))?$_POST['txtcargo2LSM']:"";
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
    

if ((isset($_POST['txtJuez2LSM']))?$_POST['txtJuez2LSM']:"") {
    $juezid =(isset($_POST['txtJuez2LSM']))?$_POST['txtJuez2LSM']:"";
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


if ((isset($_POST['txtdata2LSM']))?$_POST['txtdata2LSM']:"") {
    $txtdate2 = (isset($_POST['txtdata2LSM']))?$_POST['txtdata2LSM']:"";
    setlocale(LC_ALL,"es");
    $fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
    $strFinal= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR));
}else{
    $txtdate2= "Default";
}
if ((isset($_POST['datepickerLSM']))?$_POST['datepickerLSM']:"") {
    $txtdate2 = (isset($_POST['datepickerLSM']))?$_POST['datepickerLSM']:"";
    setlocale(LC_ALL,"es");
    $fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
    $strFinal= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR));
}else{
    $txtdate2= "Default";
}

if ((isset($_POST['txtTipo2LSM']))?$_POST['txtTipo2LSM']:"") {
    $selectDecreto2 = (isset($_POST['txtTipo2LSM']))?$_POST['txtTipo2LSM']:"";
}else{
    $selectDecreto2= "Default";
}

if ((isset($_POST['txtdecreLSM']))?$_POST['txtdecreLSM']:"") {
    $decrenumber =(isset($_POST['txtdecreLSM']))?$_POST['txtdecreLSM']:"";
}else{
    $decrenumber= "?";
}


if ((isset($_POST['datepicker2LSM']))?$_POST['datepicker2LSM']:"") {
    $fechaResolucion =(isset($_POST['datepicker2LSM']))?$_POST['datepicker2LSM']:"";
}else{
    $fechaResolucion= "FechaR";
}



if ((isset($_POST['txtdiasLSM']))?$_POST['txtdiasLSM']:"") {
    $days =(isset($_POST['txtdiasLSM']))?$_POST['txtdiasLSM']:"";
}else{
    $days= "dias";
}



if ((isset($_POST['txtResolucionLSM']))?$_POST['txtResolucionLSM']:"") {
    $txtResolucion =(isset($_POST['txtResolucionLSM']))?$_POST['txtResolucionLSM']:"";
}else{
    $txtResolucion= "Resolucion";
}

if ((isset($_POST['txtAusenteLSM']))?$_POST['txtAusenteLSM']:""){
    $ausenteid =(isset($_POST['txtAusenteLSM']))?$_POST['txtAusenteLSM']:"";
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

if ((isset($_POST['txtSubroganteLSM']))?$_POST['txtSubroganteLSM']:""){
    $subroganteid =(isset($_POST['txtSubroganteLSM']))?$_POST['txtSubroganteLSM']:"";
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

if ((isset($_POST['selectcargoSubroganteLSM']))?$_POST['selectcargoSubroganteLSM']:"") {
    $cargoSub =(isset($_POST['selectcargoSubroganteLSM']))?$_POST['selectcargoSubroganteLSM']:"";
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

  if ((isset($_POST['txtSubroganteMFELSM']))?$_POST['txtSubroganteMFELSM']:"") {
    $subroganteMFEid =(isset($_POST['txtSubroganteMFELSM']))?$_POST['txtSubroganteMFELSM']:"";
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


if ((isset($_POST['selectcargoMFELSM']))?$_POST['selectcargoMFELSM']:"") {
    $cargoMFE =(isset($_POST['selectcargoMFELSM']))?$_POST['selectcargoMFELSM']:"";
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

    // Se selecciona el pdf de origen
    // $mpdf->SetImportUse(); // <--- not needed for mPDF version 8.0+
    $mpdf->setSourceFile('../../Assets/plantillas/LICENCIA MEDICA_ADM_CLS.pdf'); // absolute path to pdf file
    
    // Se importa la primera pagina del pdf
    $tplIdx = $mpdf->importPage(1);
    
    // aca se usa la pagina importada y la posiciona en punto 10,10 con un ancho de 200 mm (esta es la imagen del pdf incluido)
    $mpdf->useTemplate($tplIdx,5,-7,200);
    
    // Ahora asignamos las variables con sus respectivas posiciones en la pagina importada
    $mpdf->SetTextColor(0, 0, 0);
    $mpdf->SetFont('Arial', 'b', 8);
    $mpdf->SetXY(25,107.4);
    $mpdf->Cell(0, 10, $txtAusente, 0, 0, 'L');


    $mpdf->SetTextColor(0, 0, 0);
    $mpdf->SetFont('Arial', 'b', 9);
    $mpdf->SetXY(30,167);
    $mpdf->Cell(0, 10, $txtSubrogante, 0, 0, 'L');
    
    $mpdf->SetTextColor(0, 0, 0);
    $mpdf->SetFont('Arial', 'b', 9);
    $mpdf->SetXY(108,167);
    $mpdf->Cell(0, 10," - " . $txtcargoSub . " Titular.", 0, 0, 'L');

    
    $mpdf->SetTextColor(0, 0, 0);
    $mpdf->SetFont('Arial', 'b', 9);
    $mpdf->SetXY(30,190.7);
    $mpdf->Cell(0, 10, $txtSubroganteMFE, 0, 0, 'L');

    $mpdf->SetTextColor(0, 0, 0);
    $mpdf->SetFont('Arial', 'b', 9);
    $mpdf->SetXY(108,190.7);
    $mpdf->Cell(0, 10," - " . $txtcargoMFE . " Titular.", 0, 0, 'L');


    $mpdf->SetTextColor(0, 0, 0);
    $mpdf->SetFont('Arial', 'b', 10);
    $mpdf->SetXY(128,107.4);
    $mpdf->Cell(0, 10, $days, 0, 0, 'L');
    
    $mpdf->SetTextColor(0, 0, 0);
    $mpdf->SetFont('Arial', 'b', 9);
    $mpdf->SetXY(78,107.4);
    $mpdf->Cell(0, 10, $fechaDesde, 0, 0, 'L');

    $mpdf->SetTextColor(0, 0, 0);
    $mpdf->SetFont('Arial', 'b', 10);
    $mpdf->SetXY(102,107.4);
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
    $mpdf->SetXY(70,64.2);
    $mpdf->Cell(0, 10, $strFinal, 0, 0, 'L');

    
    $mpdf->SetTextColor(0,0,0);
    $mpdf->SetFont('Arial', 'B', 12);
    $mpdf->SetXY(122,228);
    $mpdf->Cell(0, 10, $txtJuez, 0, 0, 'L');
    
    $mpdf->SetTextColor(0,0,0);
    $mpdf->SetFont('Arial', 'B', 10);
    $mpdf->SetXY(135,234);
    $mpdf->Cell(0, 10, $cargo, 0, 0, 'L');
   

$mpdf->Output('filename.pdf', \Mpdf\Output\Destination::INLINE);

} catch (\Throwable $th) {
    echo"error al generar pdf";
}


    try {
        // Generamos el año actual para la comparación
        $año = date("Y");
    
        // Asignamos el nombre del archivo con una ID única y aleatoria
        $filename = uniqid(mt_rand(), true) . " - " ."Decreto_Licencias-Subrogancia_ADM_N".$decrenumber."-".$año.".pdf";
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