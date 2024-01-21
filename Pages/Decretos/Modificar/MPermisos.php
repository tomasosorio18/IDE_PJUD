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
              <h5 class="card-title text-primary mb-3"> Decreto de Permisos</h5>
              <h6 class="card-subtitle text-muted">Decreto número: <span class="badge rounded-pill bg-info" ;><?php if(basename($_SERVER['SCRIPT_NAME']) == 'Diseño_decretos.php'){ include("Metodos/Obtiene_numero_decreto.php");} else { echo $decreto;}?></span><?php echo " del año " . $año; ?></small>
            </div>
          </div>
        </div>
      </div>
                        <div class="card-body">
                                        <form id="formP" method="POST" target="_blank" action="Generate_pdf/pdfPermisos.php" enctype="multipart/form-data" onsubmit="return validateForm2()">
                                        <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">FECHA:</label>

                                    <input type="text" required ="true" class="form-control fechaP" id="datepicker" name="datepicker" autocomplete="off" placeholder="Seleccione fecha">                                       
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">FIRMA:</label>
                                        <select class="form-select selectJuezP" name="selectJuez" id="selectJuez" required>
                                            <?php foreach($listaJuez as $jueces) { ?>
                                            <option value="none" selected disabled hidden>Seleccione un juez</option>
                                            <option value='<?php echo $jueces["JUEZ_ID"]?> '><?=$jueces["JUEZ_NOMBRE"]. " ". $jueces["JUEZ_APELLIDO"] ?></option> 
                                            <?php }?>
                                        </select>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">CARGO:</label>

                                        <div class="position-relative">
                                            <select name="selectCargoVista" id="selectCargoVista" class="select2 form-select select2-hidden-accessible cargoP" disabled data-select2-id="select2Disabled" tabindex="-1" aria-hidden="true" style="cursor: not-allowed;">
                                                <option value="none" selected disabled hidden>Seleccione un juez para visualizar su cargo</option>
                                            </select>
                                        </div>
                                </div> 

                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">ESTADO DECRETO:</label>

                                    <select class="form-select" name="txtEstadoP" id="txtEstadoP" required>                                                  
                                        <option value="none" selected disabled hidden>Seleccione un tipo de decreto</option>
                                        <option value="Reservado">Reservado</option> 
                                        <option value="Publico">Publico</option> 
                                    </select>
                                </div>
                                <div class = "form-group">
                                <label for="exampleInputEmail1">Funcionario:</label>

                                <select class="form-control" id="selectFuncP" name="selectFuncP">
                                 <?php                         
                                 
                                 foreach($listaFunc as $funcionarios) { ?>
                                 <option value="none" selected disabled hidden>Seleccione Funcionario</option>
                                 <option value='<?php echo $funcionarios["FUNCIONARIO_ID"] ?> '><?php echo $funcionarios["FUNCIONARIO_NOMBRE"]." ".$funcionarios["FUNCIONARIO_APELLIDO"];?></option> 
                                 
                                  <?php }?>
                                 </select>

                                   </div>

                                <div class="form-group">
                                <label for="exampleInputPassword1">Fecha Desde</label>
                                <input type="text" class="form-control desdeP" id="firstDate" name="firstDate" autocomplete="off" Required>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Fecha Hasta</label>
                                <input type="text" class="form-control hastaP" id="secondDate" name="secondDate" autocomplete="off" Required>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Dias / Jornada</label>
                                <input type="text" class="form-control diasP" id="days" name="days" autocomplete="off" Required>
                                </div>                          
                                <div class="form-group">
                                <label for="exampleInputPassword1">N° Documento</label>
                                <input type="text" class="form-control" id="txtdocumentoP" name="txtdocumentoP" autocomplete="off" Required>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Fecha D.</label>
                                <input type="text" class="form-control fechaDilP" id="datepicker2" name="datepicker2" autocomplete="off" Required>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Detalle</label>
                                <input type="text" class="form-control" id= "detallePermisosP" name ="detallePermisosP" autocomplete="off" Required>
                              
                                </div>
                                <br>
                                <div class="d-grid gap-2">

      
                                <input type="hidden" class="form-control" id="txtdecreP" name="txtdecreP" value="<?php echo $decreto;?>">                       
                                <input type="hidden" class="form-control" id="txtTipo2P" name="txtTipo2P" value="<?php echo $decretotipo?>">            
                                <input type="hidden" class="form-control" id="turidP" name="turidP" value="<?php echo $tur_id?>">            

                                <button type="button" value="" name ="btnInsertP" id="btnInsertP" class="btn btn-success"><i class="fa fa-floppy-o fa-1x" aria-hidden="true"></i> Guardar Informacion</button>
                            
                                   

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
                     
                    <script src="../Assets/js/modificar/modificaPermisos.js"></script>