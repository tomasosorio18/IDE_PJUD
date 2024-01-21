<div class="col-12 col-lg-4 order-2 order-md-3 order-lg-2 mb-2">
                            <div class="card">

                                <div class="d-flex align-items-end row">      
                                    <div class="col-md-11">
                                         <div class="card-header flex-grow-0">
        <div class="d-flex">
          <div class="avatar flex-shrink-0 me-3">
          <button type="button" class="btn rounded-pill btn-icon btn-info"><b><?php if(basename($_SERVER['SCRIPT_NAME']) == 'Diseño_decretos.php'){ include("Metodos/Obtiene_numero_decreto.php");} else { echo $decreto;}?></b></button>
          </div>
          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-1">
            <div class="me-2">
              <h5 class="card-title text-primary mb-3"> Decreto Otros</h5>
              <h6 class="card-subtitle text-muted">Decreto número: <span class="badge rounded-pill bg-info" ;><?php if(basename($_SERVER['SCRIPT_NAME']) == 'Diseño_decretos.php'){ include("Metodos/Obtiene_numero_decreto.php");} else { echo $decreto;}?></span><?php echo " del año " . $año; ?></small>
            </div>
          </div>
        </div>
      </div>
                        <div class="card-body">
                                        <form id="formO" method="POST" target="_blank" action="" enctype="multipart/form-data" onsubmit="return validateForm2()">
                                        <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">FECHA:</label>

                                    <input type="text" required ="true" class="form-control fechaO" id="datepicker" name="datepicker" autocomplete="off" placeholder="Seleccione fecha">                                       
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">FIRMA:</label>

                                        <select class="form-select selectJuezO" name="selectJuez" id="selectJuez" required>
                                            <?php foreach($listaJuez as $jueces) { ?>
                                            <option value="none" selected disabled hidden>Seleccione un juez</option>
                                            <option value='<?php echo $jueces["JUEZ_ID"]?> '><?=$jueces["JUEZ_NOMBRE"]. " ". $jueces["JUEZ_APELLIDO"] ?></option> 
                                            <?php }?>
                                        </select>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">CARGO:</label>

                                        <div class="position-relative">
                                            <select name="selectCargoVista" id="selectCargoVista" class="select2 form-select select2-hidden-accessible cargoO" disabled data-select2-id="select2Disabled" tabindex="-1" aria-hidden="true" style="cursor: not-allowed;">
                                                <option value="none" selected disabled hidden>Seleccione un juez para visualizar su cargo</option>
                                            </select>
                                        </div>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">ESTADO DECRETO:</label>

                                    <select class="form-select" name="txtEstadoO" id="txtEstadoO" required>                                                  
                                        <option value="none" selected disabled hidden>Seleccione un tipo de decreto</option>
                                        <option value="Reservado">Reservado</option> 
                                        <option value="Publico">Publico</option> 
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Detalle</label>
                                <input type="text" class="form-control" id= "detalleOtrosO" name ="detalleOtrosO" autocomplete="off" Required>
                              
                                </div>
                                <br>
                                <div class="d-grid gap-2">


                                       
                                <input type="hidden" class="form-control" id="txtdecreO" name="txtdecreO" value="<?php echo $decreto;?>">                     
                                <input type="hidden" class="form-control" id="txtTipo2O" name="txtTipo2O" value="<?php echo $decretotipo?>">            
                                <input type="hidden" class="form-control" id="turidOM" name="turidOM" value="<?php echo $tur_id?>">  
                                <button type="button" value="" name ="btnInsertO" id="btnInsertO" class="btn btn-success"><i class="fa fa-floppy-o fa-1x" aria-hidden="true"></i> Guardar Informacion</button>
                            
                                   

                               </div>
                                  </form>
                                           
                                         
                        </div>
                    </div>

                                    <div class="col-sm-5 text-center text-sm-left">                      
                                    </div>
                                </div>
                           </div>
                        </div>                       
                    </div>
                     
                    <script src="../Assets/js/modificar/modificaOtros.js"></script>