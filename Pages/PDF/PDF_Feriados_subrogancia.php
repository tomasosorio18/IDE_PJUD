<?php
//incluimos el conector a la base de datos;
include("../../Configuration/Connector.php");
 //requerimos la clase del generador de pdf mpdf con el autoload.php
 require_once '../../Assets/vendor/autoload.php';

// --------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------



 if(isset($_POST['btnpdfFSjefeU']))
{ 
    if ((isset($_POST['txtcargo2FSM']))?$_POST['txtcargo2FSM']:"") {
        $selectCargo2 =(isset($_POST['txtcargo2FSM']))?$_POST['txtcargo2FSM']:"";
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
    
     
    if ((isset($_POST['txtJuez2FSM']))?$_POST['txtJuez2FSM']:"") {
        $juezid =(isset($_POST['txtJuez2FSM']))?$_POST['txtJuez2FSM']:"";
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
    
    if ((isset($_POST['txtdata2FSM']))?$_POST['txtdata2FSM']:"") {
        $txtdate2 = (isset($_POST['txtdata2FSM']))?$_POST['txtdata2FSM']:"";
        setlocale(LC_ALL,"es");
        $fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
        $strFinal= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR));
    }else{
        $txtdate2= "Default";
    }
    
    if ((isset($_POST['txtTipo2FSM']))?$_POST['txtTipo2FSM']:"") {
        $selectDecreto2 = (isset($_POST['txtTipo2FSM']))?$_POST['txtTipo2FSM']:"";
    }else{
        $selectDecreto2= "Default";
    }
    
    if ((isset($_POST['txtdecreFSM']))?$_POST['txtdecreFSM']:"") {
        $decrenumber =(isset($_POST['txtdecreFSM']))?$_POST['txtdecreFSM']:"";
    }else{
        $decrenumber= "?";
    }
    
    
    if ((isset($_POST['txtAusenteFSM']))?$_POST['txtAusenteFSM']:""){
        $ausenteid =(isset($_POST['txtAusenteFSM']))?$_POST['txtAusenteFSM']:"";
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
    
    
    if ((isset($_POST['datepicker2FSM']))?$_POST['datepicker2FSM']:"") {
        $fechaResolucion =(isset($_POST['datepicker2FSM']))?$_POST['datepicker2FSM']:"";
        setlocale(LC_ALL,"es");
        $fechaReSTR= strftime("%d de %B de %Y", strtotime($fechaResolucion));
        $strfechaRe= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaReSTR));
    }else{
        $fechaResolucion= "FechaR";
    }

    if ((isset($_POST['DesdeFSM']))?$_POST['DesdeFSM']:"") {
        $fechaDesde =(isset($_POST['DesdeFSM']))?$_POST['DesdeFSM']:"";
        setlocale(LC_ALL,"es");
        $fechaSTR1= strftime("%A, %d de %B de %Y", strtotime($fechaDesde));
        $strDesde= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR1));
    }else{
        $fechaDesde= "FechaR";
    }
    
    if ((isset($_POST['HastaFSM']))?$_POST['HastaFSM']:"") {
        $fechaHasta =(isset($_POST['HastaFSM']))?$_POST['HastaFSM']:"";
        setlocale(LC_ALL,"es");
        $fechaSTR2= strftime("%A, %d de %B de %Y", strtotime($fechaHasta));
        $strHasta= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR2));
    }else{
        $fechaHasta= "FechaR";
    }
    

    
    
    if ((isset($_POST['txtResolucionFSM']))?$_POST['txtResolucionFSM']:"") {
        $txtResolucion =(isset($_POST['txtResolucionFSM']))?$_POST['txtResolucionFSM']:"";
    }else{
        $txtResolucion= "Resolucion";
    }
    
    if ((isset($_POST['txtSubroganteFSM']))?$_POST['txtSubroganteFSM']:""){
        $subroganteid =(isset($_POST['txtSubroganteFSM']))?$_POST['txtSubroganteFSM']:"";
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

    if ((isset($_POST['selectcargoSubroganteFSM']))?$_POST['selectcargoSubroganteFSM']:"") {
        $cargoSub =(isset($_POST['selectcargoSubroganteFSM']))?$_POST['selectcargoSubroganteFSM']:"";
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

    if ((isset($_POST['txtSubroganteMFEFSM']))?$_POST['txtSubroganteMFEFSM']:"") {
        $subroganteMFEid =(isset($_POST['txtSubroganteMFEFSM']))?$_POST['txtSubroganteMFEFSM']:"";
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


    if ((isset($_POST['selectcargoMFEFSM']))?$_POST['selectcargoMFEFSM']:"") {
        $cargoMFE =(isset($_POST['selectcargoMFEFSM']))?$_POST['selectcargoMFEFSM']:"";
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
            $mpdf->setSourceFile('../../Assets/plantillas/FERIADO-SUBROGACION_JEFEU_CLS.pdf'); // absolute path to pdf file
            
            // Se importa la primera pagina del pdf
            $tplIdx = $mpdf->importPage(1);
            
            // aca se usa la pagina importada y la posiciona en punto 10,10 con un ancho de 200 mm (esta es la imagen del pdf incluido)
            $mpdf->useTemplate($tplIdx,5,-7,200);
            
            // Ahora asignamos las variables con sus respectivas posiciones en la pagina importada

            // ----------------esta variable trae el nombre del funcionario ausente---------------------
            $mpdf->SetTextColor(0, 0, 0);
            //SetTextColor sirve para aplicar ciertos colores al texto de las variables
            $mpdf->SetFont('Arial', 'b', 9);
            //SetFont para seleccionar las fuentes dle texto de las variables(no hay mucha variedad)
            $mpdf->SetXY(58,108.7);
            //SetXY para seleccionar la posicion de la variable 
            $mpdf->Cell(0, 10, $txtAusente, 0, 0, 'L');
            //Cell es una celda que sirve para posicionar mejor la variable, cuenta con textalignment como centrado, justificado, alineado a la izq, etc 
    
            // ----------------esta variable trae el nombre del funcionario que subroga---------------------
            $mpdf->SetTextColor(0, 0, 0);
            $mpdf->SetFont('Arial', 'b', 9);
            $mpdf->SetXY(59,173.7);
            $mpdf->Cell(0, 10, $txtSubrogante, 0, 0, 'L');

            // ----------------esta variable trae el cargo del funcionario ausente---------------------
            $mpdf->SetTextColor(0, 0, 0);
            $mpdf->SetFont('Arial', 'b', 9);
            $mpdf->SetXY(124,173.7);
            $mpdf->Cell(0, 10," - " . $txtcargoSub . " Titular.", 0, 0, 'L');

            // ----------------esta variable trae el nombre del funcionario ministro de fe---------------------
            $mpdf->SetTextColor(0, 0, 0);
            $mpdf->SetFont('Arial', 'b', 9);
            $mpdf->SetXY(59,197.2);
            $mpdf->Cell(0, 10, $txtSubroganteMFE, 0, 0, 'L');

             // ----------------esta variable trae el cargo del funcionario ministro de fe---------------------
            $mpdf->SetTextColor(0, 0, 0);
            $mpdf->SetFont('Arial', 'b', 9);
            $mpdf->SetXY(124,197.2);
            $mpdf->Cell(0, 10," - " . $txtcargoMFE . " Titular.", 0, 0, 'L');

             // ----------------esta variable trae la fecha desde como un string ej: martes 13 de marzo---------------------
            $mpdf->SetTextColor(0, 0, 0);
            $mpdf->SetFont('Arial', 'b', 9);
            $mpdf->SetXY(38,117.4);
            $mpdf->Cell(0, 10, $strDesde, 0, 0, 'L');

      // ----------------esta variable trae la fecha hasta como un string ej: martes 13 de marzo---------------------
            $mpdf->SetTextColor(0, 0, 0);
            $mpdf->SetFont('Arial', 'b', 9);
            $mpdf->SetXY(97,117.4);
            $mpdf->Cell(0, 10," y hasta el " . $strHasta, 0, 0, 'L');
        
// ----------------esta variable trae la fecha de las diligencias como un string ej: martes 13 de marzo---------------------
            $mpdf->SetTextColor(0, 0, 0);
            $mpdf->SetFont('Arial', 'b', 9);
            $mpdf->SetXY(127,99.6);
            $mpdf->Cell(0, 10, $strfechaRe, 0, 0, 'L');

// ----------------esta variable trae n de resolucion---------------------
            $mpdf->SetTextColor(0, 0, 0);
            $mpdf->SetFont('Arial', 'b', 9);
            $mpdf->SetXY(79,99.3);
            $mpdf->Cell(0, 10, $txtResolucion, 0, 0, 'L');

// ----------------esta variable trae n° de decreto---------------------  
             $mpdf->SetTextColor(0, 0, 0);
             $mpdf->SetFont('Arial', 'B', 18);
             $mpdf->SetXY(123,41);
             $mpdf->Cell(0, 10, $decrenumber, 0, 0, 'L');

 // ----------------esta variable trae n de resolucion---------------------   
             $mpdf->SetTextColor(0, 0, 0);
             $mpdf->SetFont('Arial', 'B', 18);
             $mpdf->SetXY(133,41);
             $mpdf->Cell(0, 10, " - " . $año, 0, 0, 'L');

// ----------------esta variable trae la fecha actual como un string ej: martes 13 de marzo---------------------            
            $mpdf->SetTextColor(0,0,0);
            $mpdf->SetFont('Arial', '', 10);
            $mpdf->SetXY(70,80.3);
            $mpdf->Cell(0, 10, $strFinal, 0, 0, 'L');
        
// ----------------esta variable trae el nombre del juez a firmar---------------------           
            $mpdf->SetTextColor(0,0,0);
            $mpdf->SetFont('Arial', 'B', 12);
            $mpdf->SetXY(117,228);
            $mpdf->Cell(0, 10, $txtJuez, 0, 0, 'L');

// ----------------esta variable trae el cargo del juez a firmar---------------------
            $mpdf->SetTextColor(0,0,0);
            $mpdf->SetFont('Arial', 'B', 10);
            $mpdf->SetXY(128,232);
            $mpdf->Cell(0, 10, $cargo, 0, 0, 'L');
    
    
            
           
    //Aqui se genera el pdf siendo el primer campo el nombre del archivo
    // El Destination al ser INLINE quiere decir que el pdf sera mostrado en una nueva pestaña
    // contiene varias opciones, desde descargar, forzar descarga, o el mismo inline, vease la documentacion de OUTPUT DE MPDF
        $mpdf->Output('filename.pdf', \Mpdf\Output\Destination::INLINE);
    
        } catch (\Throwable $th) {
            echo"error al generar pdf"; 
        }
  
        try {
            // Generamos el año actual para la comparación
            $año = date("Y");
        
            // Asignamos el nombre del archivo con una ID única y aleatoria
            $filename = uniqid(mt_rand(), true) . " - " ."Decreto_Feriado-Subrogancia_JU_N".$decrenumber."-".$año.".pdf";
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


 
if(isset($_POST['btnpdfFSjuezJ']))
{ 
    
    if ((isset($_POST['txtcargo2FSM']))?$_POST['txtcargo2FSM']:"") {
        $selectCargo2 =(isset($_POST['txtcargo2FSM']))?$_POST['txtcargo2FSM']:"";
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
    
     
    if ((isset($_POST['txtJuez2FSM']))?$_POST['txtJuez2FSM']:"") {
        $juezid =(isset($_POST['txtJuez2FSM']))?$_POST['txtJuez2FSM']:"";
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
    
    if ((isset($_POST['txtdata2FSM']))?$_POST['txtdata2FSM']:"") {
        $txtdate2 = (isset($_POST['txtdata2FSM']))?$_POST['txtdata2FSM']:"";
        setlocale(LC_ALL,"es");
        $fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
        $strFinal= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR));
    }else{
        $txtdate2= "Default";
    }
    
    if ((isset($_POST['txtTipo2FSM']))?$_POST['txtTipo2FSM']:"") {
        $selectDecreto2 = (isset($_POST['txtTipo2FSM']))?$_POST['txtTipo2FSM']:"";
    }else{
        $selectDecreto2= "Default";
    }
    
    if ((isset($_POST['txtdecreFSM']))?$_POST['txtdecreFSM']:"") {
        $decrenumber =(isset($_POST['txtdecreFSM']))?$_POST['txtdecreFSM']:"";
    }else{
        $decrenumber= "?";
    }
    
    
    if ((isset($_POST['txtAusenteFSM']))?$_POST['txtAusenteFSM']:""){
        $ausenteid =(isset($_POST['txtAusenteFSM']))?$_POST['txtAusenteFSM']:"";
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
    
    
    if ((isset($_POST['datepicker2FSM']))?$_POST['datepicker2FSM']:"") {
        $fechaResolucion =(isset($_POST['datepicker2FSM']))?$_POST['datepicker2FSM']:"";
        setlocale(LC_ALL,"es");
        $fechaReSTR= strftime("%d de %B de %Y", strtotime($fechaResolucion));
        $strfechaRe= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaReSTR));
    }else{
        $fechaResolucion= "FechaR";
    }

    if ((isset($_POST['DesdeFSM']))?$_POST['DesdeFSM']:"") {
        $fechaDesde =(isset($_POST['DesdeFSM']))?$_POST['DesdeFSM']:"";
        setlocale(LC_ALL,"es");
        $fechaSTR1= strftime("%A, %d de %B de %Y", strtotime($fechaDesde));
        $strDesde= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR1));
    }else{
        $fechaDesde= "FechaR";
    }
    
    if ((isset($_POST['HastaFSM']))?$_POST['HastaFSM']:"") {
        $fechaHasta =(isset($_POST['HastaFSM']))?$_POST['HastaFSM']:"";
        setlocale(LC_ALL,"es");
        $fechaSTR2= strftime("%A, %d de %B de %Y", strtotime($fechaHasta));
        $strHasta= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR2));
    }else{
        $fechaHasta= "FechaR";
    }
    

    
    
    if ((isset($_POST['txtResolucionFSM']))?$_POST['txtResolucionFSM']:"") {
        $txtResolucion =(isset($_POST['txtResolucionFSM']))?$_POST['txtResolucionFSM']:"";
    }else{
        $txtResolucion= "Resolucion";
    }
    
    if ((isset($_POST['txtSubroganteFSM']))?$_POST['txtSubroganteFSM']:""){
        $subroganteid =(isset($_POST['txtSubroganteFSM']))?$_POST['txtSubroganteFSM']:"";
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

    if ((isset($_POST['selectcargoSubroganteFSM']))?$_POST['selectcargoSubroganteFSM']:"") {
        $cargoSub =(isset($_POST['selectcargoSubroganteFSM']))?$_POST['selectcargoSubroganteFSM']:"";
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

    if ((isset($_POST['txtSubroganteMFEFSM']))?$_POST['txtSubroganteMFEFSM']:"") {
        $subroganteMFEid =(isset($_POST['txtSubroganteMFEFSM']))?$_POST['txtSubroganteMFEFSM']:"";
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


    if ((isset($_POST['selectcargoMFEFSM']))?$_POST['selectcargoMFEFSM']:"") {
        $cargoMFE =(isset($_POST['selectcargoMFEFSM']))?$_POST['selectcargoMFEFSM']:"";
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
        $mpdf->setSourceFile('../../Assets/plantillas/FERIADO-SUBROGACION_J_CLS.pdf'); // absolute path to pdf file
        
        // Se importa la primera pagina del pdf
        $tplIdx = $mpdf->importPage(1);
        
        // aca se usa la pagina importada y la posiciona en punto 10,10 con un ancho de 200 mm (esta es la imagen del pdf incluido)
        $mpdf->useTemplate($tplIdx,5,-7,200);
        
        // Ahora asignamos las variables con sus respectivas posiciones en la pagina importada

        // ----------------esta variable trae el nombre del funcionario ausente---------------------
        $mpdf->SetTextColor(0, 0, 0);
        //Set color sirve para aplicar ciertos colores al texto de las variables
        $mpdf->SetFont('Arial', 'b', 9);
        //SetFont para seleccionar las fuentes dle texto de las variables(no hay mucha variedad)
        $mpdf->SetXY(47,104.7);
        //SetXY para seleccionar la posicion de la variable 
        $mpdf->Cell(0, 10, $txtAusente, 0, 0, 'L');
        //Cell es una celda que sirve para posicionar mejor la variable, cuenta con textalignment como centrado, justificado, alineado a la izq, etc 

// ----------------esta variable trae el nombre del juez---------------------
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 9);
        $mpdf->SetXY(47,155.6);
        $mpdf->Cell(0, 10, $txtSubrogante, 0, 0, 'L');

     
 // ----------------esta variable trae la fecha desde como un string ej: martes 13 de marzo---------------------
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 9);
        $mpdf->SetXY(31,116);
        $mpdf->Cell(0, 10, $strDesde, 0, 0, 'L');

 // ----------------esta variable trae la fecha hasta como un string ej: martes 13 de marzo---------------------
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 9);
        $mpdf->SetXY(90,116);
        $mpdf->Cell(0, 10, " y hasta el ".$strHasta, 0, 0, 'L');
        
 // ----------------esta variable trae el n de resolucion---------------------
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 9);
        $mpdf->SetXY(129,91.8);
        $mpdf->Cell(0, 10, $txtResolucion, 0, 0, 'L');

 // ----------------esta variable trae el n de decreto---------------------
         $mpdf->SetTextColor(0, 0, 0);
         $mpdf->SetFont('Arial', 'B', 18);
         $mpdf->SetXY(122,42.4);
         $mpdf->Cell(0, 10, $decrenumber, 0, 0, 'L');

// ----------------esta variable trae el año actual---------------------        
         $mpdf->SetTextColor(0, 0, 0);
         $mpdf->SetFont('Arial', 'B', 18);
         $mpdf->SetXY(130,42.4);
         $mpdf->Cell(0, 10," - " . $año, 0, 0, 'L');

// ----------------esta variable trae la fecha actual como un string ej: martes 13 de marzo---------------------          
        $mpdf->SetTextColor(0,0,0);
        $mpdf->SetFont('Arial', '', 9);
        $mpdf->SetXY(70,71.8);
        $mpdf->Cell(0, 10, $strFinal, 0, 0, 'L');
    
// ----------------esta variable trae el nombre del juez a firmar---------------------        
        $mpdf->SetTextColor(0,0,0);
        $mpdf->SetFont('Arial', 'B', 12);
        $mpdf->SetXY(101,198);
        $mpdf->Cell(0, 10, $txtJuez, 0, 0, 'L');

// ----------------esta variable trae el cargo del juez a firmar---------------------        
        $mpdf->SetTextColor(0,0,0);
        $mpdf->SetFont('Arial', 'B', 10);
        $mpdf->SetXY(113,202.6);
        $mpdf->Cell(0, 10, $cargo, 0, 0, 'L');
     
// ----------------esta variable trae la fecha de la resolucion como un string ej: martes 13 de marzo---------------------        
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 9);
        $mpdf->SetXY(50,98.4);
        $mpdf->Cell(0, 10, $strfechaRe, 0, 0, 'L');

        
       
//Aqui se genera el pdf siendo el primer campo el nombre del archivo
// El Destination al ser INLINE quiere decir que el pdf sera mostrado en una nueva pestaña
// contiene varias opciones, desde descargar, forzar descarga, o el mismo inline, vease la documentacion de OUTPUT DE MPDF
    $mpdf->Output('filename.pdf', \Mpdf\Output\Destination::INLINE);

    } catch (\Throwable $th) {
        echo"error al generar pdf";
    }

   
    try {
        // Generamos el año actual para la comparación
        $año = date("Y");
    
        // Asignamos el nombre del archivo con una ID única y aleatoria
        $filename = uniqid(mt_rand(), true) . " - " ."Decreto_LICENCIA-Subrogancia_J_N".$decrenumber."-".$año.".pdf";
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


if(isset($_POST['btnpdfFSjuezJP']))
{ if ((isset($_POST['txtcargo2FSM']))?$_POST['txtcargo2FSM']:"") {
    $selectCargo2 =(isset($_POST['txtcargo2FSM']))?$_POST['txtcargo2FSM']:"";
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

 
if ((isset($_POST['txtJuez2FSM']))?$_POST['txtJuez2FSM']:"") {
    $juezid =(isset($_POST['txtJuez2FSM']))?$_POST['txtJuez2FSM']:"";
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

if ((isset($_POST['txtdata2FSM']))?$_POST['txtdata2FSM']:"") {
    $txtdate2 = (isset($_POST['txtdata2FSM']))?$_POST['txtdata2FSM']:"";
    setlocale(LC_ALL,"es");
    $fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
    $strFinal= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR));
}else{
    $txtdate2= "Default";
}

if ((isset($_POST['txtTipo2FSM']))?$_POST['txtTipo2FSM']:"") {
    $selectDecreto2 = (isset($_POST['txtTipo2FSM']))?$_POST['txtTipo2FSM']:"";
}else{
    $selectDecreto2= "Default";
}

if ((isset($_POST['txtdecreFSM']))?$_POST['txtdecreFSM']:"") {
    $decrenumber =(isset($_POST['txtdecreFSM']))?$_POST['txtdecreFSM']:"";
}else{
    $decrenumber= "?";
}


if ((isset($_POST['txtAusenteFSM']))?$_POST['txtAusenteFSM']:""){
    $ausenteid =(isset($_POST['txtAusenteFSM']))?$_POST['txtAusenteFSM']:"";
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


if ((isset($_POST['datepicker2FSM']))?$_POST['datepicker2FSM']:"") {
    $fechaResolucion =(isset($_POST['datepicker2FSM']))?$_POST['datepicker2FSM']:"";
    setlocale(LC_ALL,"es");
    $fechaReSTR= strftime("%d de %B de %Y", strtotime($fechaResolucion));
    $strfechaRe= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaReSTR));
}else{
    $fechaResolucion= "FechaR";
}

if ((isset($_POST['DesdeFSM']))?$_POST['DesdeFSM']:"") {
    $fechaDesde =(isset($_POST['DesdeFSM']))?$_POST['DesdeFSM']:"";
    setlocale(LC_ALL,"es");
    $fechaSTR1= strftime("%A, %d de %B de %Y", strtotime($fechaDesde));
    $strDesde= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR1));
}else{
    $fechaDesde= "FechaR";
}

if ((isset($_POST['HastaFSM']))?$_POST['HastaFSM']:"") {
    $fechaHasta =(isset($_POST['HastaFSM']))?$_POST['HastaFSM']:"";
    setlocale(LC_ALL,"es");
    $fechaSTR2= strftime("%A, %d de %B de %Y", strtotime($fechaHasta));
    $strHasta= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR2));
}else{
    $fechaHasta= "FechaR";
}




if ((isset($_POST['txtResolucionFSM']))?$_POST['txtResolucionFSM']:"") {
    $txtResolucion =(isset($_POST['txtResolucionFSM']))?$_POST['txtResolucionFSM']:"";
}else{
    $txtResolucion= "Resolucion";
}

if ((isset($_POST['txtSubroganteFSM']))?$_POST['txtSubroganteFSM']:""){
    $subroganteid =(isset($_POST['txtSubroganteFSM']))?$_POST['txtSubroganteFSM']:"";
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

if ((isset($_POST['selectcargoSubroganteFSM']))?$_POST['selectcargoSubroganteFSM']:"") {
    $cargoSub =(isset($_POST['selectcargoSubroganteFSM']))?$_POST['selectcargoSubroganteFSM']:"";
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

if ((isset($_POST['txtSubroganteMFEFSM']))?$_POST['txtSubroganteMFEFSM']:"") {
    $subroganteMFEid =(isset($_POST['txtSubroganteMFEFSM']))?$_POST['txtSubroganteMFEFSM']:"";
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


if ((isset($_POST['selectcargoMFEFSM']))?$_POST['selectcargoMFEFSM']:"") {
    $cargoMFE =(isset($_POST['selectcargoMFEFSM']))?$_POST['selectcargoMFEFSM']:"";
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
        $mpdf->setSourceFile('../../Assets/plantillas/FERIADO-SUBROGACION_JP_CLS.pdf'); // absolute path to pdf file
        
        // Se importa la primera pagina del pdf
        $tplIdx = $mpdf->importPage(1);
        
        // aca se usa la pagina importada y la posiciona en punto 10,10 con un ancho de 200 mm (esta es la imagen del pdf incluido)
        $mpdf->useTemplate($tplIdx,5,-7,200);
        
        // Ahora asignamos las variables con sus respectivas posiciones en la pagina importada

// ----------------esta variable trae el nombre del funcionario ausente---------------------        
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 9);
        $mpdf->SetXY(47,104.7);
        $mpdf->Cell(0, 10, $txtAusente, 0, 0, 'L');

// ----------------esta variable trae el nombre del juez---------------------
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 9);
        $mpdf->SetXY(47,155.6);
        $mpdf->Cell(0, 10, $txtSubrogante, 0, 0, 'L');

     
// ----------------esta variable trae la fecha desde como un string ej: martes 13 de marzo---------------------        
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 9);
        $mpdf->SetXY(31,116);
        $mpdf->Cell(0, 10, $strDesde, 0, 0, 'L');

// ----------------esta variable trae la fecha hasta como un string ej: martes 13 de marzo---------------------                
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 9);
        $mpdf->SetXY(90,116);
        $mpdf->Cell(0, 10, " y hasta el ".$strHasta, 0, 0, 'L');
        
// ----------------esta variable trae el n de resolucion---------------------    
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 9);
        $mpdf->SetXY(129,91.8);
        $mpdf->Cell(0, 10, $txtResolucion, 0, 0, 'L');

// ----------------esta variable trae el n de decreto---------------------   
         $mpdf->SetTextColor(0, 0, 0);
         $mpdf->SetFont('Arial', 'B', 18);
         $mpdf->SetXY(122,42.4);
         $mpdf->Cell(0, 10, $decrenumber, 0, 0, 'L');

// ----------------esta variable trae el año actual---------------------        
         $mpdf->SetTextColor(0, 0, 0);
         $mpdf->SetFont('Arial', 'B', 18);
         $mpdf->SetXY(130,42.4);
         $mpdf->Cell(0, 10," - " . $año, 0, 0, 'L');

// ----------------esta variable trae la fecha actual como un string ej: martes 13 de marzo---------------------                 
        $mpdf->SetTextColor(0,0,0);
        $mpdf->SetFont('Arial', '', 10);
        $mpdf->SetXY(70,71.8);
        $mpdf->Cell(0, 10, $strFinal, 0, 0, 'L');
    
// ----------------esta variable trae el nombre del juez a firmar---------------------        
        $mpdf->SetTextColor(0,0,0);
        $mpdf->SetFont('Arial', 'B', 12);
        $mpdf->SetXY(101,198);
        $mpdf->Cell(0, 10, $txtJuez, 0, 0, 'L');

// ----------------esta variable trae el cargo del juez a firmar---------------------            
        $mpdf->SetTextColor(0,0,0);
        $mpdf->SetFont('Arial', 'B', 10);
        $mpdf->SetXY(113,202.6);
        $mpdf->Cell(0, 10, $cargo, 0, 0, 'L');
        
// ----------------esta variable trae la fecha de la resolucion como un string ej: martes 13 de marzo---------------------                
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 9);
        $mpdf->SetXY(50,98.4);
        $mpdf->Cell(0, 10, $strfechaRe, 0, 0, 'L');



    $mpdf->Output('filename.pdf', \Mpdf\Output\Destination::INLINE);

    } catch (\Throwable $th) {
        echo"error al generar pdf";
    }

  

    try {
        // Generamos el año actual para la comparación
        $año = date("Y");
    
        // Asignamos el nombre del archivo con una ID única y aleatoria
        $filename = uniqid(mt_rand(), true) . " - " ."Decreto_Feriado-Subrogancia_JP_N".$decrenumber."-".$año.".pdf";
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
if(isset($_POST['btnpdfFSadm']))
{if ((isset($_POST['txtcargo2FSM']))?$_POST['txtcargo2FSM']:"") {
    $selectCargo2 =(isset($_POST['txtcargo2FSM']))?$_POST['txtcargo2FSM']:"";
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

 
if ((isset($_POST['txtJuez2FSM']))?$_POST['txtJuez2FSM']:"") {
    $juezid =(isset($_POST['txtJuez2FSM']))?$_POST['txtJuez2FSM']:"";
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

if ((isset($_POST['txtdata2FSM']))?$_POST['txtdata2FSM']:"") {
    $txtdate2 = (isset($_POST['txtdata2FSM']))?$_POST['txtdata2FSM']:"";
    setlocale(LC_ALL,"es");
    $fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
    $strFinal= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR));
}else{
    $txtdate2= "Default";
}

if ((isset($_POST['txtTipo2FSM']))?$_POST['txtTipo2FSM']:"") {
    $selectDecreto2 = (isset($_POST['txtTipo2FSM']))?$_POST['txtTipo2FSM']:"";
}else{
    $selectDecreto2= "Default";
}

if ((isset($_POST['txtdecreFSM']))?$_POST['txtdecreFSM']:"") {
    $decrenumber =(isset($_POST['txtdecreFSM']))?$_POST['txtdecreFSM']:"";
}else{
    $decrenumber= "?";
}


if ((isset($_POST['txtAusenteFSM']))?$_POST['txtAusenteFSM']:""){
    $ausenteid =(isset($_POST['txtAusenteFSM']))?$_POST['txtAusenteFSM']:"";
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


if ((isset($_POST['datepicker2FSM']))?$_POST['datepicker2FSM']:"") {
    $fechaResolucion =(isset($_POST['datepicker2FSM']))?$_POST['datepicker2FSM']:"";
    setlocale(LC_ALL,"es");
    $fechaReSTR= strftime("%d de %B de %Y", strtotime($fechaResolucion));
    $strfechaRe= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaReSTR));
}else{
    $fechaResolucion= "FechaR";
}

if ((isset($_POST['DesdeFSM']))?$_POST['DesdeFSM']:"") {
    $fechaDesde =(isset($_POST['DesdeFSM']))?$_POST['DesdeFSM']:"";
    setlocale(LC_ALL,"es");
    $fechaSTR1= strftime("%A, %d de %B de %Y", strtotime($fechaDesde));
    $strDesde= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR1));
}else{
    $fechaDesde= "FechaR";
}

if ((isset($_POST['HastaFSM']))?$_POST['HastaFSM']:"") {
    $fechaHasta =(isset($_POST['HastaFSM']))?$_POST['HastaFSM']:"";
    setlocale(LC_ALL,"es");
    $fechaSTR2= strftime("%A, %d de %B de %Y", strtotime($fechaHasta));
    $strHasta= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR2));
}else{
    $fechaHasta= "FechaR";
}




if ((isset($_POST['txtResolucionFSM']))?$_POST['txtResolucionFSM']:"") {
    $txtResolucion =(isset($_POST['txtResolucionFSM']))?$_POST['txtResolucionFSM']:"";
}else{
    $txtResolucion= "Resolucion";
}

if ((isset($_POST['txtSubroganteFSM']))?$_POST['txtSubroganteFSM']:""){
    $subroganteid =(isset($_POST['txtSubroganteFSM']))?$_POST['txtSubroganteFSM']:"";
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

if ((isset($_POST['selectcargoSubroganteFSM']))?$_POST['selectcargoSubroganteFSM']:"") {
    $cargoSub =(isset($_POST['selectcargoSubroganteFSM']))?$_POST['selectcargoSubroganteFSM']:"";
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

if ((isset($_POST['txtSubroganteMFEFSM']))?$_POST['txtSubroganteMFEFSM']:"") {
    $subroganteMFEid =(isset($_POST['txtSubroganteMFEFSM']))?$_POST['txtSubroganteMFEFSM']:"";
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


if ((isset($_POST['selectcargoMFEFSM']))?$_POST['selectcargoMFEFSM']:"") {
    $cargoMFE =(isset($_POST['selectcargoMFEFSM']))?$_POST['selectcargoMFEFSM']:"";
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
        $mpdf->setSourceFile('../../Assets/plantillas/FERIADO-SUBROGACION_ADM_CLS.pdf'); // absolute path to pdf file
        
        // Se importa la primera pagina del pdf
        $tplIdx = $mpdf->importPage(1);
        
        // aca se usa la pagina importada y la posiciona en punto 10,10 con un ancho de 200 mm (esta es la imagen del pdf incluido)
        $mpdf->useTemplate($tplIdx,5,-7,200);
        
        // Ahora asignamos las variables con sus respectivas posiciones en la pagina importada

// ----------------esta variable trae el nombre del funcionario ausente---------------------  
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 9);
        $mpdf->SetXY(53,101.8);
        $mpdf->Cell(0, 10, " : " . $txtAusente, 0, 0, 'L');

// ----------------esta variable trae el nombre del funcionario ausente---------------------  
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 9);
        $mpdf->SetXY(58,184);
        $mpdf->Cell(0, 10, $txtSubrogante, 0, 0, 'L');
        
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 9);
        $mpdf->SetXY(130,184);
        $mpdf->Cell(0, 10," - " . $txtcargoSub . "     Titular.", 0, 0, 'L');

        
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 9);
        $mpdf->SetXY(38,170);
        $mpdf->Cell(0, 10, $strDesde, 0, 0, 'L');

        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 9);
        $mpdf->SetXY(102,170);
        $mpdf->Cell(0, 10, " y hasta el " . $strHasta, 0, 0, 'L');



        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 8);
        $mpdf->SetXY(137,108.4);
        $mpdf->Cell(0, 10, $strDesde, 0, 0, 'L');

        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 8);
        $mpdf->SetXY(56,114.7);
        $mpdf->Cell(0, 10, $strHasta, 0, 0, 'L');
        
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 8.2);
        $mpdf->SetXY(125,88.6);
        $mpdf->Cell(0, 10, $strfechaRe, 0, 0, 'L');


        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'b', 9);
        $mpdf->SetXY(80,88.4);
        $mpdf->Cell(0, 10, $txtResolucion, 0, 0, 'L');

         $mpdf->SetTextColor(0, 0, 0);
         $mpdf->SetFont('Arial', 'B', 18);
         $mpdf->SetXY(123,34);
         $mpdf->Cell(0, 10, $decrenumber, 0, 0, 'L');

         $mpdf->SetTextColor(0, 0, 0);
         $mpdf->SetFont('Arial', 'B', 18);
         $mpdf->SetXY(139,34);
         $mpdf->Cell(0, 10," - " . $año, 0, 0, 'L');
        
        $mpdf->SetTextColor(0,0,0);
        $mpdf->SetFont('Arial', '', 10);
        $mpdf->SetXY(70,64.5);
        $mpdf->Cell(0, 10, $strFinal, 0, 0, 'L');
    
        
        $mpdf->SetTextColor(0,0,0);
        $mpdf->SetFont('Arial', 'B', 12);
        $mpdf->SetXY(113,229);
        $mpdf->Cell(0, 10, $txtJuez, 0, 0, 'L');
        
        $mpdf->SetTextColor(0,0,0);
        $mpdf->SetFont('Arial', 'B', 10);
        $mpdf->SetXY(125,234);
        $mpdf->Cell(0, 10, $cargo, 0, 0, 'L');


        
       

    $mpdf->Output('filename.pdf', \Mpdf\Output\Destination::INLINE);

    } catch (\Throwable $th) {
        echo"error al generar pdf";
    }


    try {
        // Generamos el año actual para la comparación
        $año = date("Y");
    
        // Asignamos el nombre del archivo con una ID única y aleatoria
        $filename = uniqid(mt_rand(), true) . " - " ."Decreto_Feriado-Subrogancia_ADM_N".$decrenumber."-".$año.".pdf";
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