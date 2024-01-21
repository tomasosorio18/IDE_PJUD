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
              <h5 class="card-title text-primary mb-3"> Decreto de Licencias - Subrogacion</h5>
              <h6 class="card-subtitle text-muted">Decreto número: <span class="badge rounded-pill bg-info" ;><?php if(basename($_SERVER['SCRIPT_NAME']) == 'Diseño_decretos.php'){ include("Metodos/Obtiene_numero_decreto.php");} else { echo $decreto;}?></span><?php echo " del año " . $año; ?></small>
            </div>
          </div>
        </div> 
      </div>
                        <div class="card-body">
                                        <form id="formLS" method="POST" action="" enctype="multipart/form-data" onsubmit="return validateForm2()">
                                         <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">FECHA:</label>

                                    <input type="text" required ="true" class="form-control fechaLS" id="datepicker" name="datepicker" autocomplete="off" placeholder="Seleccione fecha">                                       
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">FIRMA:</label>

                                        <select class="form-select selectJuezLS" name="selectJuez" id="selectJuez" required>
                                            <?php foreach($listaJuez as $jueces) { ?>
                                            <option value="none" selected disabled hidden>Seleccione un juez</option>
                                            <option value='<?php echo $jueces["JUEZ_ID"]?> '><?=$jueces["JUEZ_NOMBRE"]. " ". $jueces["JUEZ_APELLIDO"] ?></option> 
                                            <?php }?>
                                        </select>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">CARGO:</label>

                                        <div class="position-relative">
                                            <select name="selectCargoVista" id="selectCargoVista" class="select2 form-select select2-hidden-accessible cargoLS" disabled data-select2-id="select2Disabled" tabindex="-1" aria-hidden="true" style="cursor: not-allowed;">
                                                <option value="none" selected disabled hidden>Seleccione un juez para visualizar su cargo</option>
                                            </select>
                                        </div>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">ESTADO DECRETO:</label>

                                    <select class="form-select" name="txtEstadoLS" id="txtEstadoLS" required>                                                  
                                        <option value="none" selected disabled hidden>Seleccione un tipo de decreto</option>
                                        <option value="Reservado">Reservado</option> 
                                        <option value="Publico">Publico</option> 
                                    </select>
                                </div>
                                <div class = "form-group">
                                <label for="exampleFormControlSelect1" class="form-label">Autoriza Ausentarse:</label>
                                <select class="form-control" id="txtAusenteLS" name="txtAusenteLS">
                                 <?php                         
                                 
                                 foreach($listaFunc as $funcionarios) { ?>
                                 <option value="none" selected disabled hidden>Seleccione Funcionario</option>
                                 <option value='<?php echo $funcionarios["FUNCIONARIO_ID"] ?> '><?php echo $funcionarios["FUNCIONARIO_NOMBRE"]." ".$funcionarios["FUNCIONARIO_APELLIDO"];?></option> 
                                 
                                  <?php }?>
                                 </select>

                                   </div>

                                <div class="form-group">
                                <label for="exampleFormControlSelect1" class="form-label">Autoriza resolucion</label>
                                <input type="text" class="form-control" id="txtResolucionLS" name="txtResolucionLS" autocomplete="off" Required>
                                </div>

                                <div class="form-group">
                                <label for="exampleFormControlSelect1" class="form-label">Fecha Resolucion.</label>
                                <input type="text" class="form-control fechaResLS" id="datepicker2" name="datepicker2" autocomplete="off" Required>
                                </div>
                            
                                <div class="form-group">
                                <label for="exampleFormControlSelect1" class="form-label">Dias</label>
                                <input type="text" class="form-control" id="txtdiasLS" name="txtdiasLS" autocomplete="off" Required>
                                </div>     
                        
                                <div class = "form-group">
                                <label for="exampleFormControlSelect1" class="form-label">Subrogante:</label>
                                    <select class="form-control txtSubroganteLS" id="txtSubrogante" name="txtSubrogante">
                                        <?php                              
                                        foreach($listaFunc as $funcionarios) { ?>
                                        <option value="none" selected disabled hidden>Seleccione un subrogante</option>
                                        <option value='<?php echo $funcionarios["FUNCIONARIO_ID"] ?> '><?php echo $funcionarios["FUNCIONARIO_NOMBRE"]." ".$funcionarios["FUNCIONARIO_APELLIDO"];?></option> 
                                 
                                  <?php }?>
                                   </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1" class="form-label">Cargo Subrogante:</label>
                                    <div class="position-relative">
                                        <select name="selectcargoSubroganteVista" id="selectcargoSubroganteVista" class="select2 form-select select2-hidden-accessible cargoSubLS" disabled data-select2-id="select2Disabled" tabindex="-1" aria-hidden="true" style="cursor: not-allowed;">
                                            <option value="none" selected disabled hidden>Seleccione un subrogante para visualizar su cargo</option>
                                        </select> 
                                    </div>
                                </div>


                                <div class = "form-group">
                                <label for="exampleFormControlSelect1" class="form-label">Subrog. Ministro FE:</label>
                                <select class="form-control txtSubroganteMFSLS" id="txtSubroganteMFE" name="txtSubroganteMFE">
                                 <?php                              
                                 foreach($listaFunc as $funcionarios) { ?>
                                 <option value="none" selected disabled hidden>Seleccione un MFE:</option>
                                 <option value='<?php echo $funcionarios["FUNCIONARIO_ID"] ?> '><?php echo $funcionarios["FUNCIONARIO_NOMBRE"]." ".$funcionarios["FUNCIONARIO_APELLIDO"];?></option> 
                                 
                                  <?php }?>
                                 </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1" class="form-label">Cargo MINISTRO FE:</label> 
                                    <div class="position-relative">
                                        <select name="selectcargoMFEVista" id="selectcargoMFEVista" class="select2 form-select select2-hidden-accessible cargoMFELS" disabled data-select2-id="select2Disabled" tabindex="-1" aria-hidden="true" style="cursor: not-allowed;">
                                            <option value="none" selected disabled hidden>Seleccione un MFE para visualizar su cargo</option>
                                        </select>
    
                                    </div>
                                </div>

                                <div class="form-group">
                                <label for="exampleInputPassword1" class="form-label">Detalle</label>
                                <input type="text" class="form-control" id= "detalleLicenciassubrogacionLS"name ="detalleLicenciassubrogacionLS" autocomplete="off" Required>
                                </div>
                                <br>
                                <div class="d-grid gap-2">


              
                                <input type="hidden" class="form-control" id="txtEstadoLS" name="txtEstadoLS" value="<?php echo $selectEstado ?>">            
                                <input type="hidden" class="form-control" id="txtdecreLS" name="txtdecreLS" value="<?php echo $decreto;?>">                    
                                <input type="hidden" class="form-control" id="txtTipo2LS" name="txtTipo2LS" value="<?php echo $decretotipo?>">            
                                <input type="hidden" class="form-control" id="turidLS" name="turidLS" value="<?php echo $tur_id?>">              

                                <button type="button" value="" name ="btnInsertLS" id="btnInsertLS" class="btn btn-success"><i class="fa fa-floppy-o fa-1x" aria-hidden="true"></i> Guardar Informacion</button>
                            
                                   

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
                     
                    <script src="../Assets/js/modificar/modificaLSubrogancia.js"></script>