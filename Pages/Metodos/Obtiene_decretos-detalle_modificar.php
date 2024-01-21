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
                <form action="Modificar_decretos.php" method="POST" enctype="multipart/form-data">
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
              
            <input type="hidden" name="txtdecreto" id="txtdecreto" value="<?php echo $selectdecreto ?>"></input>
             
            <div class="row mb-3" style="margin-top: 20px;">
              <button type="submit" id="btnModificar" name="edit" class="btn rounded-pill btn-label-success"style="height: 60px;">Editar</button>
            </div>
          </form>
                </div>
            </div>
        </div>

        <?php   if(isset($_POST['btnModificar'])){                  
                $selectdecreto = $_POST['btnModificar'];?>
                 
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
                <form onsubmit="return validateForm()" method="POST" enctype="multipart/form-data">
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
              
            <input type="hidden" name="txtdecreto" id="txtdecreto" value="<?php echo $selectdecreto ?>"></input>
             
            <div class="row mb-3" style="margin-top: 20px;">
              <button type="submit" id="btnModificar" name="edit" class="btn rounded-pill btn-label-success"style="height: 60px;">Editar</button>
            </div>
          </form>
                </div>
            </div>
        </div>
                 <script>

                 </script>
                  <?php } ?>

    </div>



