<?php
//incluimos el conector a la base de datos;
include("../../Configuration/Connector.php");
 //requerimos la clase del generador de pdf mpdf con el autoload.php
 require_once '../../Assets/vendor/autoload.php';

 //preguntamos si el boton de generar pdf fue presionado.
 if(isset($_POST['btnpdfFM'])) 
{ 
     //si es asi traemos las variables del formulario mediante POST y las asignamos en otras variables  
    if ((isset($_POST['txtcargo2FM']))?$_POST['txtcargo2FM']:"") {
    $selectCargo2 =(isset($_POST['txtcargo2FM']))?$_POST['txtcargo2FM']:"";
          //como las variables traidas del select son las id del cargo del juez tenemos que traer el nombre del cargo del juez
        //ya que debemos mostrar el nombre del cargo y no su id, al generar el pdf.
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

if ((isset($_POST['txtJuez2FM']))?$_POST['txtJuez2FM']:"") {
    $juezid =(isset($_POST['txtJuez2FM']))?$_POST['txtJuez2FM']:"";
     //asignamos la variable del formulario a una de nombre juez
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
    $txtJuez= "Default";
}


if ((isset($_POST['txtdata2FM']))?$_POST['txtdata2FM']:"") {
    $txtdate2 = (isset($_POST['txtdata2FM']))?$_POST['txtdata2FM']:"";
    setlocale(LC_ALL,"es");
    $fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
    $strFinal= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR));
}else{
    $txtdate2= "Default";
}
if ((isset($_POST['datepickerFM']))?$_POST['datepickerFM']:"") {
    $txtdate2 = (isset($_POST['datepickerFM']))?$_POST['datepickerFM']:"";
    setlocale(LC_ALL,"es");
    $fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
    $strFinal= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR));
}else{
    $txtdate2= "Default";
}
if ((isset($_POST['txtTipo2FM']))?$_POST['txtTipo2FM']:"") {
    $selectDecreto2 = (isset($_POST['txtTipo2FM']))?$_POST['txtTipo2FM']:"";
}else{
    $selectDecreto2= "Default";
}
if ((isset($_POST['detalleFM']))?$_POST['detalleFM']:"") {
    $detalleFeriados =(isset($_POST['detalleFM']))?$_POST['detalleFM']:"";
}else{
    $detalleFeriados= "Default";
}

if ((isset($_POST['txtdecreFM']))?$_POST['txtdecreFM']:"") {
    $decrenumber =(isset($_POST['txtdecreFM']))?$_POST['txtdecreFM']:"";
}else{
    $decrenumber= "?";
}
if ((isset($_POST['funcionarioFM']))?$_POST['funcionarioFM']:""){
    $funcionarioid =(isset($_POST['funcionarioFM']))?$_POST['funcionarioFM']:"";

    try {
        $sentenciaSQL=$conexion->prepare("SELECT FUNCIONARIO_NOMBRE, FUNCIONARIO_APELLIDO from funcionario WHERE FUNCIONARIO_ID = :FUNCIONARIO_ID");
        $sentenciaSQL->bindParam(':FUNCIONARIO_ID',$funcionarioid);
        $sentenciaSQL->execute();
        $strfuncionario=$sentenciaSQL->fetch(PDO::FETCH_LAZY); 
        $FuncNombre = $strfuncionario['FUNCIONARIO_NOMBRE'];
        $FuncApellido = $strfuncionario['FUNCIONARIO_APELLIDO'];

        $txtFuncionario =  $FuncNombre." ".$FuncApellido;
    } catch (\Throwable $th) {
        $txtFuncionario="";

    }
}else{
    $txtFuncionario= "Default";

}
if ((isset($_POST['desdeFM']))?$_POST['desdeFM']:"") {
    $firstDate =(isset($_POST['desdeFM']))?$_POST['desdeFM']:"";
}else{
    $firstDate= "";
}
if ((isset($_POST['dpFM']))?$_POST['dpFM']:"") {
    $fechaD=(isset($_POST['dpFM']))?$_POST['dpFM']:"";
}else{
    $fechaD= "";
}

if ((isset($_POST['hastaFM']))?$_POST['hastaFM']:"") {
    $secondDate =(isset($_POST['hastaFM']))?$_POST['hastaFM']:"";
}else{
    $secondDate= "";
}
if ((isset($_POST['diasFM']))?$_POST['diasFM']:"") {
    $days =(isset($_POST['diasFM']))?$_POST['diasFM']:"";
}else{
    $days= "";
}
if ((isset($_POST['ndocumentoFM']))?$_POST['ndocumentoFM']:"") {
    $txtdocumento =(isset($_POST['ndocumentoFM']))?$_POST['ndocumentoFM']:"";
}else{
    $txtdocumento= "";
}
// en este codigo generamos formato de la fecha seleccionada, EJ: 2000-12-01 -> 01-12-2000.
$fechaFormato= date("d-m-Y", strtotime($txtdate2));
$fechaDesde= date("d-m-Y", strtotime($firstDate));
$fechaHasta= date("d-m-Y", strtotime($secondDate));
$fechaDili= date("d-m-Y", strtotime($fechaD));
$año = date("Y");
    try {
        $mpdf = new \Mpdf\Mpdf();

         
        // Se selecciona el pdf de origen
        $mpdf->setSourceFile('../../Assets/plantillas/FERIADOS_CLS1.pdf'); // absolute path to pdf file
        // Se importa la primera pagina del pdf
        $tplIdx = $mpdf->importPage(1);
        
        // aca se usa la pagina importada y la posiciona en punto 10,10 con un ancho de 200 mm (esta es la imagen del pdf incluido)
        $mpdf->useTemplate($tplIdx,5,-7,200);
        
         // Ahora asignamos las variables con sus respectivas posiciones en la pagina importada


// ----------------esta variable almacena el nombre del funcionario---------------------
        $mpdf->SetTextColor(0, 0, 0);
        //SetTextColor sirve para aplicar ciertos colores al texto de las variables
        $mpdf->SetFont('Arial', '', 9);
        //SetFont para seleccionar las fuentes dle texto de las variables(no hay mucha variedad)
        $mpdf->SetXY(84,147);
         //SetXY para seleccionar la posicion de la variable 
        $mpdf->Cell(0, 10, $txtFuncionario, 0, 0, 'L');
        
        //Cell es una celda que sirve para posicionar mejor la variable, cuenta con textalignment como centrado, justificado, alineado a la izq, etc 
  
// ----------------esta variable almacena los dias ---------------------
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', '', 9);
        $mpdf->SetXY(136,147);
        $mpdf->Cell(0, 10, $days, 0, 0, 'L');
// ----------------esta variable almacena la fecha Desde---------------------        
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', '', 9);
        $mpdf->SetXY(148,147);
        $mpdf->Cell(0, 10, $fechaDesde, 0, 0, 'L');
// ----------------esta variable almacena la fecha Hasta---------------------      
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', '', 9);
        $mpdf->SetXY(168,147);
        $mpdf->Cell(0, 10, $fechaHasta, 0, 0, 'L');

// ----------------esta variable almacena la fecha de las diligencias---------------------
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', '', 9);
        $mpdf->SetXY(62,147);
        $mpdf->Cell(0, 10, $fechaDili, 0, 0, 'L');

 // ----------------esta variable almacena el n documento---------------------
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', '', 9);
        $mpdf->SetXY(35,147);
        $mpdf->Cell(0, 10, $txtdocumento, 0, 0, 'L');
 // ----------------esta variable almacena el numero de decreto---------------------

         $mpdf->SetTextColor(0, 0, 0);
         $mpdf->SetFont('Arial', 'B', 18);
         $mpdf->SetXY(135,42);
         $mpdf->Cell(0, 10, $decrenumber, 0, 0, 'L');

//-------------Esta variable almacena el año actual --------------
         $mpdf->SetTextColor(0, 0, 0);
         $mpdf->SetFont('Arial', 'B', 18);
         $mpdf->SetXY(148,42);
         $mpdf->Cell(0, 10, " - " . $año, 0, 0, 'L');
        
//-------------Esta variable almacena la fecha como un string ej: Lunes 13 de Marzo --------------
        $mpdf->SetTextColor(0,0,0);
        $mpdf->SetFont('Arial', '', 10);
        $mpdf->SetXY(70,76.1);
        $mpdf->Cell(0, 10, $strFinal, 0, 0, 'L');
    
        
//-------------Esta variable almacena el nombre del juez a firmar --------------
        $mpdf->SetTextColor(0,0,0);
        $mpdf->SetFont('Arial', 'B', 12);
        $mpdf->SetXY(124,218);
        $mpdf->Cell(0, 10, $txtJuez, 0, 0, 'L');
        
        //-------------Esta variable almacena el nombre del cargo del juez a firmar --------------
        $mpdf->SetTextColor(0,0,0);
        $mpdf->SetFont('Arial', 'B', 10);
        $mpdf->SetXY(135,223);
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
        $filename = uniqid(mt_rand(), true) . " - " ."Decreto_Feriados_N".$decrenumber."-".$año.".pdf";
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

 
    
    
   






/* pdf_creator.php */






