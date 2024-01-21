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
              <h5 class="card-title text-primary mb-3"> Decreto de Feriados - Subrogacion</h5>
              <h6 class="card-subtitle text-muted">Decreto número: <span class="badge rounded-pill bg-info" ;><?php if(basename($_SERVER['SCRIPT_NAME']) == 'Diseño_decretos.php'){ include("Metodos/Obtiene_numero_decreto.php");} else { echo $decreto;}?></span><?php echo " del año " . $año; ?></small>
            </div>
          </div>
        </div>
      </div>
                        <div class="card-body">
                                        <form id="">
                                        <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">FECHA:</label>

                                    <input type="text" required ="true" class="form-control fechaFS" id="datepicker" name="datepicker" autocomplete="off" placeholder="Seleccione fecha">                                       
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">FIRMA:</label>

                                        <select class="form-select selectJuezFS" name="selectJuez" id="selectJuez" required>
                                            <?php foreach($listaJuez as $jueces) { ?>
                                            <option value="none" selected disabled hidden>Seleccione un juez</option>
                                            <option value='<?php echo $jueces["JUEZ_ID"]?> '><?=$jueces["JUEZ_NOMBRE"]. " ". $jueces["JUEZ_APELLIDO"] ?></option> 
                                            <?php }?>
                                        </select>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">CARGO:</label>

                                        <div class="position-relative">
                                            <select name="selectCargoVista" id="selectCargoVista" class="select2 form-select select2-hidden-accessible cargoFS" disabled data-select2-id="select2Disabled" tabindex="-1" aria-hidden="true" style="cursor: not-allowed;">
                                                <option value="none" selected disabled hidden>Seleccione un juez para visualizar su cargo</option>
                                            </select>
                                        </div>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">ESTADO DECRETO:</label>

                                    <select class="form-select" name="txtEstadoFS" id="txtEstadoFS" required>                                                  
                                        <option value="none" selected disabled hidden>Seleccione un tipo de decreto</option>
                                        <option value="Reservado">Reservado</option> 
                                        <option value="Publico">Publico</option> 
                                    </select>
                                </div>
                                <div class = "form-group">
                                <label for="exampleFormControlSelect1" class="form-label">Autoriza Ausentarse:</label>
                                <select class="form-control" id="txtAusenteFS" name="txtAusenteFS">
                                 <?php                         
                                 
                                 foreach($listaFunc as $funcionarios) { ?>
                                 <option value="none" selected disabled hidden>Seleccione Funcionario</option>
                                 <option value='<?php echo $funcionarios["FUNCIONARIO_ID"] ?> '><?php echo $funcionarios["FUNCIONARIO_NOMBRE"]." ".$funcionarios["FUNCIONARIO_APELLIDO"];?></option> 
                                 
                                  <?php }?>
                                 </select>

                                   </div>

                                <div class="form-group">
                                <label for="exampleFormControlSelect1" class="form-label">Autoriza resolucion</label>
                                <input type="text" class="form-control" id="txtResolucionFS" name="txtResolucionFS" autocomplete="off" Required>
                                </div>

                                <div class="form-group">
                                <label for="exampleFormControlSelect1" class="form-label">Fecha Resolucion.</label>
                                <input type="text" class="form-control fechaResF" id="datepicker2" name="datepicker2" autocomplete="off" Required>
                                </div>
                              
                                <div class="form-group">
                                <label for="exampleInputPassword1">Desde</label>
                                <input type="text" class="form-control desdeFS" id="firstDate" name="firstDate" autocomplete="off" Required>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Hasta</label>
                                <input type="text" class="form-control hastaFS" id="secondDate" name="secondDate" autocomplete="off" Required>
                                </div>  
                        
                                <div class = "form-group">
                                <label for="exampleFormControlSelect1" class="form-label">Subrogante:</label>
                                    <select class="form-control txtSubroganteFS" id="txtSubrogante" name="txtSubrogante">
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
                                        <select name="selectcargoSubroganteVista" id="selectcargoSubroganteVista" class="select2 form-select select2-hidden-accessible cargoSubFS" disabled data-select2-id="select2Disabled" tabindex="-1" aria-hidden="true" style="cursor: not-allowed;">
                                            <option value="none" selected disabled hidden>Seleccione un subrogante para visualizar su cargo</option>
                                        </select>

                                    </div>
                                </div>


                                <div class = "form-group">
                                <label for="exampleFormControlSelect1" class="form-label">Subrog. Ministro FE:</label>
                                <select class="form-control txtSubroganteMFSFS" id="txtSubroganteMFE" name="txtSubroganteMFE">
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
                                        <select name="selectcargoMFEVista" id="selectcargoMFEVista" class="select2 form-select select2-hidden-accessible cargoMFEFS" disabled data-select2-id="select2Disabled" tabindex="-1" aria-hidden="true" style="cursor: not-allowed;">
                                            <option value="none" selected disabled hidden>Seleccione un MFE para visualizar su cargo</option>
                                        </select>
    
                                    </div>
                                </div>
 
                                <div class="form-group">
                                <label for="exampleInputPassword1" class="form-label">Detalle</label>
                                <input type="text" class="form-control" id= "detalleFeriadossubrogacionFS"name ="detalleFeriadossubrogacionFS" autocomplete="off" Required>
                                </div>
                                <br>
                                <div class="d-grid gap-2">


                                <input type="hidden" class="form-control" id="txtEstadoFS" name="txtEstadoFS" value="<?php echo $selectEstado ?>">            
                                <input type="hidden" class="form-control" id="txtdecreFS" name="txtdecreFS" value="<?php echo $decreto;?>">                    
                                <input type="hidden" class="form-control" id="txtTipo2FS" name="txtTipo2FS" value="<?php echo $decretotipo?>">            
                                <input type="hidden" class="form-control" id="turidFS" name="turidFS" value="<?php echo $tur_id?>">            

                                <button type="button" value="" name ="btnInsertFS" id="btnInsertFS" class="btn btn-success"><i class="fa fa-floppy-o fa-1x" aria-hidden="true"></i> Guardar Informacion</button>
                            
                                   

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
                     
                    <script src="../Assets/js/modificar/modificaFSubrogancia.js"></script>