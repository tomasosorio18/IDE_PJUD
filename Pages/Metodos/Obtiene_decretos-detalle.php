<?php 
$anio = date("Y");
$sentenciaSQL=$conexion->prepare("SELECT decreto.DECRETO_N_CORRELATIVO,
decreto.ADJUNTO_FIRMA_ID,
juez.JUEZ_NOMBRE,
juez.JUEZ_APELLIDO,
cargo_juez.CARGO_JUEZ_NOMBRE, 
tipo_decreto.DECRETO_TIPO_NOMBRE,
decreto.DECRETO_FECHA_EMISION,
adjunto_inicial.ADJUNTO_INI_NOMBRE,
adjunto_firmado.ADJUNTO_FIRMA_NOMBRE,
decreto.DECRETO_DETALLE,
decreto.DECRETO_EMITIDA_POR
FROM decreto
LEFT JOIN adjunto_inicial on decreto.ADJUNTO_INI_ID = adjunto_inicial.ADJUNTO_INI_ID
LEFT JOIN adjunto_firmado on decreto.ADJUNTO_FIRMA_ID = adjunto_firmado.ADJUNTO_FIRMA_ID
INNER JOIN juez on decreto.JUEZ_ID = juez.JUEZ_ID
INNER JOIN tipo_decreto on decreto.DECRETO_TIPO_ID = tipo_decreto.DECRETO_TIPO_ID
LEFT JOIN cargo_juez on juez.CARGO_JUEZ_ID = cargo_juez.CARGO_JUEZ_ID
WHERE decreto.DECRETO_N_CORRELATIVO = :DECRETO_N_CORRELATIVO AND decreto.DECRETO_ANIO = :DECRETO_ANIO
ORDER BY decreto.DECRETO_N_CORRELATIVO;
");
//asignamos las variables a la consulta
$sentenciaSQL->bindParam(":DECRETO_N_CORRELATIVO",$selectdecreto);
$sentenciaSQL->bindParam(":DECRETO_ANIO",$anio);
$sentenciaSQL->execute();
$Detalle_Decretos=$sentenciaSQL->fetch(PDO::FETCH_LAZY);?> 

<style>
.file-upload {
  background-color: #ffffff;
  width: 100%;
  margin-top: 30px;
  margin-left: 2px;
  pointer-events: auto;
  position: relative;
  display: inline-block;
}

.file-upload-btn:active {
  border: 0;
  transition: all .2s ease;
}

.file-upload-content {
  display: none;
  text-align: center;
}

.file-upload-input {
  position: absolute;
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  outline: none;
  opacity: 0;
  cursor: pointer;
}

.image-upload-wrap {
  margin-top: 20px;
  border: 4px dashed #147ac9;
  background-color: rgb(239, 239, 239);
  position: relative;
}

.image-dropping,
.image-upload-wrap:hover {
  background-color: #a4c5de;
  border: 4px dashed #ffffff;
}

.image-title-wrap {
  padding: 0 15px 15px 15px;
  color: #222;
  
}

.drag-text {
  text-align: center;
  margin-top: 50px;
  margin-bottom: 50px;
  
}

.file-upload-image {
  max-height: 200px;
  max-width: 200px;
  margin: auto;
  padding: 20px;
}

.remove-image {
  width: 120px;
  padding: 10px;
  color: #fff;
  background: #cd4535;
  border: none;
  margin-left: 30px;
  border-radius: 4px;
  border-bottom: 4px solid #b02818;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 700;
  float: right;
  position: absolute;
}

.remove-image:hover {
  background: #c13b2a;
  color: #ffffff;
  transition: all .2s ease;
  cursor: pointer;
}

.remove-image:active {
  border: 0;
  transition: all .2s ease;
}

.icons {
  color: #147ac9;
  opacity: 0.55;
  text-align: center;
  pointer-events: none;
  position: absolute;
  top: 70%; /* Ajusta esta propiedad para cambiar la posición vertical de los iconos */
  left: 50%;
  margin-bottom: 120px;
  transform: translate(-50%, -50%);
  z-index: 1; /* Agrega un índice z para elevar los iconos sobre el texto */
}

.drag-text h3 {
  color: #130f40;
  font-weight: 600;
  font-size: 1.1em;
  letter-spacing: -1px;
  margin: 0; /* Modifica los márgenes para evitar el espacio innecesario */
  padding: 20px; /* Agrega espacio interno para separar el texto de los iconos */
  opacity: 0.65;
  pointer-events: none;
  text-align: center;
  margin-bottom: 120px;
  position: relative;
  z-index: 0; /* Coloca el texto debajo de los iconos */
}

.file-upload-overlay {
  position: relative;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: auto;
}

</style>

<style>
  .uploaded {
  width: 100%;
  margin: 10px;
  background-color: #a4c5de;
  border-radius: 10px;
  display: flex;
  flex-direction: row;
  justify-content: flex-start;
  align-items: center;
}
.file {
  display: flex;
  flex-direction: column;
}
.file__name {
  display: flex;
  flex-direction: row;
  align-items: baseline;
  width: 100%;
  line-height: 0;
  font-weight: 600;
  color: #0d1e45;
  font-size: 18px;
  letter-spacing: 1.5px;
}
.fa-times:hover {
  cursor: pointer;
  opacity: 0.8;
}
</style>

<div class="row">
        <div class="col-md-6 col-lg-6 mt-3">
            <div class="card">
                <div class="card-header flex-grow-0">
                    <div class="d-flex">
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-1">
                            <div class="me-2">
                                <h5 class="card-title text-primary mb-3">Subir decreto: </h5>
                                <h6 class="card-subtitle text-muted">Permite adjuntar un documento a un decreto emitido.</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                <form action="Subir_decretos.php" method="POST" enctype="multipart/form-data">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label" for="formtabs-first-name">N° Correlativo:</label>
                <input readonly type="text" id="formtabs-first-name" class="form-control" value="<?php echo "Numero: ". $Detalle_Decretos['DECRETO_N_CORRELATIVO']; ?>">
              </div>
              <div class="col-md-6">
                <label class="form-label" for="formtabs-first-name">Fecha Emisión:</label>
                <input readonly type="text" id="formtabs-first-name" class="form-control" value="<?php echo $Detalle_Decretos['DECRETO_FECHA_EMISION']; ?>">
              </div>
            </div>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label" for="formtabs-first-name">Nombre Juez:</label>
                <input readonly type="text" id="formtabs-first-name" class="form-control" value="<?php echo $Detalle_Decretos['JUEZ_NOMBRE'] . " " .$Detalle_Decretos['JUEZ_APELLIDO'] ; ?>">
              </div>
              <div class="col-md-6">
                <label class="form-label" for="formtabs-first-name">Cargo:</label>
                <input readonly type="text" id="formtabs-first-name" class="form-control" value="<?php echo $Detalle_Decretos['CARGO_JUEZ_NOMBRE']; ?>">
              </div>
            </div>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label" for="formtabs-first-name">Detalle:</label>
                <input readonly type="text" id="formtabs-first-name" class="form-control" value="<?php echo $Detalle_Decretos['DECRETO_DETALLE']; ?>">
              </div>
              <div class="col-md-6">
                <label class="form-label" for="formtabs-first-name">Tipo de decreto:</label>
                <input readonly type="text" id="formtabs-first-name" class="form-control" value="<?php echo $Detalle_Decretos['DECRETO_TIPO_NOMBRE']; ?>">
              </div>
             
              </div>
              <?php if ($Detalle_Decretos['ADJUNTO_FIRMA_ID']) {?>
              <div class="row g-3">
              <div class="col-md-6">
              <label class="form-label" for="formtabs-first-name">Adjunto Firmado:</label>
              <?php echo '<a href="Subir_Decretos.php?file_id='. $selectdecreto . '&anio=' . $anio.'"><div class="demo-inline-spacing" style="margin-left:5px;margin-top:-3px"><img src="../Assets/images/adjunto.png" style="width: 40px; height: 40px; margin-left:30px;"><span class="badge badge-center rounded-pill bg-success"><i class="fa-solid fa-check"></i></span></img></div></a>';?>
              </div>
              </div>

              <?php }else{?>
                <div class="row g-3">
              <div class="col-md-6">
              <label class="form-label" for="formtabs-first-name">Adjunto Firmado:</label>
              <div class="demo-inline-spacing" style="margin-left:5px;margin-top:-3px">
              <img src="../Assets/images/adjunto.png" style="width: 40px; height: 40px;"><span class="badge badge-center rounded-pill bg-danger"><i class="fa-solid fa-xmark"></i></span> </img>

              </div>
              </div>
              
              </div>
              <?php } ?>
        
             <div class="file-upload">
                <div class="image-upload-wrap">
                  <div class="icons fa-4x">
                      <i class="fa-solid fa-file-excel fa-beat-fade"></i>
                      <i class="fa-solid fa-file-word fa-beat-fade"></i>
                      <i class="fa-solid fa-file-pdf fa-beat-fade"></i>
                  </div>
                  <div class="file-upload-overlay"></div>
                  <input class="file-upload-input" id="myfile" name="myfile" type='file' onchange="readURL(this);" accept=".pdf,.doc,.xlsx" required/>
                  <div class="drag-text">
                     <h3>¡Arrastra tu archivo aquí o presiona para buscarlo!</h3>
                  </div>
                </div>
                <div class="file-upload-content">
                  <div class="uploaded" id="pdf">
                    <div class="fa-3x">   
                      <i class="fa fa-file-pdf" style="margin-left: 10px; padding: 15px;font-size: 40px;color: #0d1e45;"></i>
                    </div>   
                    <div class="file">
                      <div class="file__name">
                        <p id="pdftext" style="margin-left: 10px;"></p>
                        <div class="image-title-wrap">
                          <button type="button" onclick="removeUpload()" class="remove-image">Eliminar<span class="image-title"></span></button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="uploaded" id="excel">
                  <div><i class="fa fa-file-excel"style="margin-left: 10px; padding: 15px;font-size: 40px;color: #0d1e45;"></i></div>               
                    <div class="file">
                      <div class="file__name">
                        <p id="xlstext" style="margin-left: 10px;"></p>
                        <div class="image-title-wrap">
                          <button type="button" onclick="removeUpload()" class="remove-image">Eliminar<span class="image-title"></span></button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="uploaded" id="word">
                  <div><i class="fa fa-file-word"style="margin-left: 10px; padding: 15px;font-size: 40px;color: #0d1e45;"></i></div>  
                    <div class="file">
                      <div class="file__name">
                        <p id="doctext" style="margin-left: 10px;"></p>

                        <div class="image-title-wrap">
                          <button type="button" onclick="removeUpload()" class="remove-image">Eliminar<span class="image-title"></span></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
              
            <input type="hidden" name="txtdecreto" id="txtdecreto" value="<?php echo $selectdecreto ?>"></input>
             
            <div class="row mb-3" style="margin-top: 20px;">
              <button type="submit" id="btnSubir" name="save" class="btn rounded-pill btn-label-success"style="height: 60px;">Adjuntar archivo</button>
            </div>
          </form>
                </div>
            </div>
        </div>
    </div>
<script>
function readURL(input) {
  if (input.files && input.files[0]) {
    var file = input.files[0];
    var extension = file.name.split('.').pop().toLowerCase(); // Obtiene la extensión del archivo
    var reader = new FileReader();
    var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '')
    reader.onload = function(e) {
      $('.image-upload-wrap').hide();

     // $('.file-upload-image').attr('src', e.target.result);
     if (extension === 'pdf') {
      $('.file-upload-content').show();
      $('#excel').hide();// Oculta el div para excel
      $('#word').hide();  // Oculta el div para word
      // $("#excel").empty();
      // $("#word").empty();
      $('#pdf').show(); // Muestra el div para pdf
      $('#pdftext').empty().text(filename)
    } else if (extension === 'doc' || extension === 'docx') {
      $('.file-upload-content').show();   
      $('#pdf').hide(); // Oculta el div para pdf
      $('#excel').hide(); // Oculta el div para excel
      // $("#pdf").empty();
      // $("#excel").empty();
      $('#word').show(); // Muestra el div para documentos
      $('#doctext').empty().text(filename)
    } else if (extension === 'xls' || extension === 'xlsx') {
      $('.file-upload-content').show();
      $('#pdf').hide(); // Oculta el div para pdf
      $('#word').hide(); // Oculta el div para word
      // $("#pdf").empty();
      // $("#word").empty();
      $('#excel').show(); // Muestra el div para documentos
      $('#xlstext').empty().text(filename)
    }else{
      // Si no se reconoce la extensión, ocultar ambos divs
      $('.file-upload-content').show();
      $('#pdf').hide();
      $('#excel').hide();
      $('#word').hide();
    }
     
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload();
  }
}

function removeUpload() {
  // Limpiar el input de carga de archivos y restablecerlo
  $('.file-upload-input').val(''); // Elimina el archivo seleccionado
  $('.file-upload-content').hide(); // Oculta cualquier contenido relacionado con la carga
  // Restaurar la visibilidad del área de carga
  $('.image-upload-wrap').show();
}

</script>


