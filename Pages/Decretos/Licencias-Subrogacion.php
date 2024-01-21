<div class="col-12 col-lg-4 order-2 order-md-3 order-lg-2 mb-2">
                            <div class="card">

                                <div class="d-flex align-items-end row">      
                                    <div class="col-md-12">
                                    <?php if ($selectEstado == "Publico") {?><span class="badge bg-label-info me-1" style="width: 100%; height:100%; border-radius: 0 0 0 0; margin-top:5px;">Publico </span> <?php }else{?><span class="badge bg-label-warning me-1"style="width: 100%; height:100%; border-radius: 0 0 0 0; margin-top:5px;">Reservado </span> <?php } ?>
                                         <div class="card-header flex-grow-0">
        <div class="d-flex">
          <div class="avatar flex-shrink-0 me-3">
          <button type="button" class="btn rounded-pill btn-icon btn-info"><b><?php include("Metodos/Obtiene_numero_decreto.php")?></b></button>
          </div>
          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-1">
            <div class="me-2">
              <h5 class="card-title text-primary mb-3">Licencias - Subrogacion</h5>
              <h6 class="card-subtitle text-muted">Decreto número: <span class="badge rounded-pill bg-info" ;><?php include("Metodos/Obtiene_numero_decreto.php");?></span><?php echo " del año " . $año; ?></small>
            </div>
            <?php if ($selectEstado == "Publico") {?>
              <div class="avatar avatar-md border-5 border-light-info rounded-circle mx-auto mb-2" style="height: 50px; width: 50px; ">
              <span class="avatar-initial rounded-circle bg-label-info">
              <i class="fa-duotone fa-file-powerpoint" style="--fa-primary-color: #4482ee; --fa-secondary-color: #4482ee;"></i>
              </span>
            </div>
             
            <?php }else{?>
              <div class="avatar avatar-md border-5 border-light-warning rounded-circle mx-auto mb-2" style="height: 50px; width: 50px;">
              <span class="avatar-initial rounded-circle bg-label-warning">
              <i class="fa-duotone fa-file-lock" style="--fa-primary-color: #ffcd1a; --fa-secondary-color: #ffcd1a;"></i>
              </span>
              </div>
           <?php } ?>
          </div>
        </div>
      </div>
                        <div class="card-body">
                                        <form id="formLS" method="POST" action="" enctype="multipart/form-data" onsubmit="return validateForm2()">
                                <div class = "form-group">
                                <label for="exampleFormControlSelect1" class="form-label">Autoriza Ausentarse:</label>
                                <select class="form-control" id="txtAusente" name="txtAusente">
                                 <?php                         
                                 
                                 foreach($listaFunc as $funcionarios) { ?>
                                 <option value="none" selected disabled hidden>Seleccione Funcionario</option>
                                 <option value='<?php echo $funcionarios["FUNCIONARIO_ID"] ?> '><?php echo $funcionarios["FUNCIONARIO_NOMBRE"]." ".$funcionarios["FUNCIONARIO_APELLIDO"];?></option> 
                                 
                                  <?php }?>
                                 </select>

                                   </div>

                                <div class="form-group">
                                <label for="exampleFormControlSelect1" class="form-label">Autoriza resolucion</label>
                                <input type="text" class="form-control" id="txtResolucion" name="txtResolucion" autocomplete="off" Required>
                                </div>

                                <div class="form-group">
                                <label for="exampleFormControlSelect1" class="form-label">Fecha Resolucion.</label>
                                <input type="text" class="form-control" id="datepicker2" name="datepicker2" autocomplete="off" Required>
                                </div>
                            
                                <div class="form-group">
                                <label for="exampleFormControlSelect1" class="form-label">Dias</label>
                                <input type="text" class="form-control" id="txtdias" name="txtdias" autocomplete="off" Required>
                                </div>     
                        
                                <div class = "form-group">
                                <label for="exampleFormControlSelect1" class="form-label">Subrogante:</label>
                                    <select class="form-control" id="txtSubrogante" name="txtSubrogante">
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
                                        <select name="selectcargoSubroganteVista" id="selectcargoSubroganteVista" class="select2 form-select select2-hidden-accessible" disabled data-select2-id="select2Disabled" tabindex="-1" aria-hidden="true" style="cursor: not-allowed;">
                                            <option value="none" selected disabled hidden>Seleccione un subrogante para visualizar su cargo</option>
                                        </select>
                                        <select name="selectcargoSubrogante" id="selectcargoSubrogante" class="select2 form-select select2-hidden-accessible" hidden data-select2-id="select2Disabled" tabindex="-1" aria-hidden="true" style="cursor: not-allowed;">
                                            <option value="none" selected disabled hidden>Seleccione un subrogante para visualizar su cargo</option>
                                        </select>
                                    </div>
                                </div>


                                <div class = "form-group">
                                <label for="exampleFormControlSelect1" class="form-label">Subrog. Ministro FE:</label>
                                <select class="form-control" id="txtSubroganteMFE" name="txtSubroganteMFE">
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
                                        <select name="selectcargoMFEVista" id="selectcargoMFEVista" class="select2 form-select select2-hidden-accessible" disabled data-select2-id="select2Disabled" tabindex="-1" aria-hidden="true" style="cursor: not-allowed;">
                                            <option value="none" selected disabled hidden>Seleccione un MFE para visualizar su cargo</option>
                                        </select>
                                        <select name="selectcargoMFE" id="selectcargoMFE" class="select2 form-select select2-hidden-accessible" hidden data-select2-id="select2Disabled" tabindex="-1" aria-hidden="true" style="cursor: not-allowed;">
                                            <option value="none" selected disabled hidden>Seleccione un MFE para visualizar su cargo</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                <label for="exampleInputPassword1" class="form-label">Detalle</label>
                                <input type="text" class="form-control" id= "detalleLicenciassubrogacion"name ="detalleLicenciassubrogacion" autocomplete="off" Required>
                                </div>
                                <br>
                                <div class="d-grid gap-2">


                                <input type="hidden" class="form-control" id="txtEstado" name="txtEstado" value="<?php echo $selectEstado ?>">            
                                <input type="hidden" class="form-control" id="txtdecre" name="txtdecre" value="<?php include("../Pages/Metodos/Obtiene_numero_decreto.php");?>">            
                                <input type="hidden" class="form-control" id="txtdata2" name="txtdata2" value="<?php echo $txtdate?>">            
                                <input type="hidden" class="form-control" id="txtcargo2" name="txtcargo2" value="<?php echo $selectCargo?>">            
                                <input type="hidden" class="form-control" id="txtJuez2" name="txtJuez2" value="<?php echo $selectJuez?>">            
                                <input type="hidden" class="form-control" id="txtTipo2" name="txtTipo2" value="<?php echo $decreto_tipo?>">            
                                <input type="hidden" class="form-control" id="turidLS" name="turidLS" value="<?php echo $tur_id?>">            

                                <button type="button" value="" name ="btnInsertLSS" id="btnInsertLSS" class="btn btn-success"><i class="fa fa-floppy-o fa-1x" aria-hidden="true"></i> Guardar Informacion</button>
                            
                                   

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
                     
                    <script src="../Assets/js/insertaLSubrogancia.js"></script>