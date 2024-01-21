<?php
//incluimos el conector a la base de datos;
include("../../Configuration/Connector.php");
 //requerimos la clase del generador de pdf mpdf con el autoload.php
 require_once '../../Assets/vendor/autoload.php';
?>

<?php
 //preguntamos si el boton de generar pdf fue presionado.
 if(isset($_POST['btnpdfRM']))
{
    //si es asi traemos las variables del formulario mediante POST y las asignamos en otras variables  
    if ((isset($_POST['txtcargo2RM']))?$_POST['txtcargo2RM']:"") {
        $selectCargo2 =(isset($_POST['txtcargo2RM']))?$_POST['txtcargo2RM']:"";
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

    if ((isset($_POST['txtJuez2RM']))?$_POST['txtJuez2RM']:"") {
        $juezid =(isset($_POST['txtJuez2RM']))?$_POST['txtJuez2RM']:"";
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
    

if ((isset($_POST['txtdata2RM']))?$_POST['txtdata2RM']:"") {
    $txtdate2 = (isset($_POST['txtdata2RM']))?$_POST['txtdata2RM']:"";
    setlocale(LC_ALL,"es");
    $fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
    $strFinal= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR));
}else{
    $txtdate2= "Default";
}
if ((isset($_POST['datepickerRM']))?$_POST['datepickerRM']:"") {
    $txtdate2 = (isset($_POST['datepickerRM']))?$_POST['datepickerRM']:"";
    setlocale(LC_ALL,"es");
    $fechaSTR= strftime("%A, %d de %B de %Y", strtotime($txtdate2));
    $strFinal= ucfirst(iconv("ISO-8859-1","UTF-8",$fechaSTR));
}else{
    $txtdate2= "Default";
}

if ((isset($_POST['txtTipo2RM']))?$_POST['txtTipo2RM']:"") {
    $selectDecreto2 = (isset($_POST['txtTipo2RM']))?$_POST['txtTipo2RM']:"";
}else{
    $selectDecreto2= "Default";
}
if ((isset($_POST['detalleReceptorRM']))?$_POST['detalleReceptorRM']:"") {
    $detalleReceptor =(isset($_POST['detalleReceptorRM']))?$_POST['detalleReceptorRM']:"";
}else{
    $selectReceptor= "Default";
}

if ((isset($_POST['txtdecreRM']))?$_POST['txtdecreRM']:"") {
    $decrenumber =(isset($_POST['txtdecreRM']))?$_POST['txtdecreRM']:"";
}else{
    $decrenumber= "Default";
}
if (isset($_POST['selectReceptor'])) {
    $valoresSelectReceptor = $_POST['selectReceptor'];

    for ($i = 0; $i <= 14; $i++) {
        ${"txtReceptor$i"} = isset($valoresSelectReceptor[$i]) ? $valoresSelectReceptor[$i] : "";

        try {
            if (!empty(${"txtReceptor$i"})) {
                $sentenciaSQL = $conexion->prepare("SELECT RECEPTOR_NOMBRE, RECEPTOR_APELLIDO from receptor WHERE RECEPTOR_ID = :RECEPTOR_ID");
                $sentenciaSQL->bindParam(':RECEPTOR_ID', ${"txtReceptor$i"});
                $sentenciaSQL->execute();
                $strReceptor = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

                if ($strReceptor) {
                    ${"txtReceptor$i"} = $strReceptor['RECEPTOR_NOMBRE'] . " " . $strReceptor['RECEPTOR_APELLIDO'];
                } else {
                    ${"txtReceptor$i"} = "";
                }
            }
        } catch (\Throwable $th) {
            ${"txtReceptor$i"} = "";
        }
    }
}


$año = date("Y");

    try {
        $mpdf = new \Mpdf\Mpdf();
        // Se selecciona el pdf de origen
        $mpdf->setSourceFile('../../Assets/plantillas/RECEPTORES_CLS4.pdf'); // absolute path to pdf file
        // Se importa la primera pagina del pdf
        $tplIdx = $mpdf->importPage(1);
        // aca se usa la pagina importada y la posiciona en punto 10,10 con un ancho de 200 mm (esta es la imagen del pdf incluido)
        $mpdf->useTemplate($tplIdx,5,-7,200);

        // Ahora asignamos las variables con sus respectivas posiciones en la pagina importada

        // ----------------esta variable almacena el nombre del receptor 1---------------------
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'B', 9);
        $mpdf->SetXY(35,148);
        $mpdf->Cell(0, 10, $txtReceptor0, 0, 0, 'L');
        
        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'B', 9);
        $mpdf->SetXY(35,156);
        $mpdf->Cell(0, 10, $txtReceptor1, 0, 0, 'L');

        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'B', 9);
        $mpdf->SetXY(35,164);
        $mpdf->Cell(0, 10, $txtReceptor2, 0, 0, 'L');

        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'B', 9);
        $mpdf->SetXY(35,172);
        $mpdf->Cell(0, 10, $txtReceptor3, 0, 0, 'L');

        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'B', 9);
        $mpdf->SetXY(35,180);
        $mpdf->Cell(0, 10, $txtReceptor4, 0, 0, 'L');

        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'B', 9);
        $mpdf->SetXY(35,188);
        $mpdf->Cell(0, 10, $txtReceptor5, 0, 0, 'L');

        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'B', 9);
        $mpdf->SetXY(35,197.6);
        $mpdf->Cell(0, 10, $txtReceptor6, 0, 0, 'L');

        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'B', 9);
        $mpdf->SetXY(114,148);
        $mpdf->Cell(0, 10, $txtReceptor7, 0, 0, 'L');

        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'B', 9);
        $mpdf->SetXY(114,156);
        $mpdf->Cell(0, 10, $txtReceptor8, 0, 0, 'L');

        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'B', 9);
        $mpdf->SetXY(114,164);
        $mpdf->Cell(0, 10, $txtReceptor9, 0, 0, 'L');

        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'B', 9);
        $mpdf->SetXY(114,172);
        $mpdf->Cell(0, 10, $txtReceptor10, 0, 0, 'L');

        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'B', 9);
        $mpdf->SetXY(114,181);
        $mpdf->Cell(0, 10, $txtReceptor11, 0, 0, 'L');

        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'B', 9);
        $mpdf->SetXY(114,190);
        $mpdf->Cell(0, 10, $txtReceptor12, 0, 0, 'L');

        $mpdf->SetTextColor(0, 0, 0);
        $mpdf->SetFont('Arial', 'B', 9);
        $mpdf->SetXY(114,197.8);
        $mpdf->Cell(0, 10, $txtReceptor13, 0, 0, 'L');

         $mpdf->SetTextColor(0, 0, 0);
         $mpdf->SetFont('Arial', 'B', 18);
         $mpdf->SetXY(130,27);
         $mpdf->Cell(0, 10, $decrenumber, 0, 0, 'L');

         $mpdf->SetTextColor(0, 0, 0);
         $mpdf->SetFont('Arial', 'B', 18);
         $mpdf->SetXY(144,27);
         $mpdf->Cell(0, 10," - " . $año, 0, 0, 'L');
        
         $mpdf->SetTextColor(100,149,237);
         $mpdf->SetFont('Arial', 'B', 12);
         $mpdf->SetXY(103,39.5);
         $mpdf->Cell(0, 10, $strFinal, 0, 0, 'L');
        
        $mpdf->SetTextColor(0,0,0);
        $mpdf->SetFont('Arial', '', 10);
        $mpdf->SetXY(70,48.6);
        $mpdf->Cell(0, 10, $strFinal, 0, 0, 'L');
    
        
        $mpdf->SetTextColor(0,0,0);
        $mpdf->SetFont('Arial', 'B', 11);
        $mpdf->SetXY(111,257);
        $mpdf->Cell(0, 10, $txtJuez, 0, 0, 'L');
        
        $mpdf->SetTextColor(0,0,0);
        $mpdf->SetFont('Arial', 'B', 10);
        $mpdf->SetXY(122,262);
        $mpdf->Cell(0, 10, $cargo, 0, 0, 'L');
        
       

    $mpdf->Output('filename.pdf', \Mpdf\Output\Destination::INLINE);

    } catch (\Throwable $th) {
        echo"error al generar pdf";
    }

   

    try {
        // Generamos el año actual para la comparación
        $año = date("Y");
    
        // Asignamos el nombre del archivo con una ID única y aleatoria
        $filename = uniqid(mt_rand(), true) . " - " ."Decreto_Receptores_N".$decrenumber."-".$año.".pdf";
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






