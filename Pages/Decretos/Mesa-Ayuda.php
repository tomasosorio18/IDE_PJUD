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
              <h5 class="card-title text-primary mb-3"> Decreto de Mesa de ayuda</h5>
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
                                        <form id="formMA">
                              
                                <div class="form-group">
                                <label for="exampleInputPassword1">Detalle</label>
                                <input type="text" class="form-control" id= "detalleMesaAyuda" name ="detalleMesaAyuda" autocomplete="off" Required>
                              
                                </div>
                                <br>
                                <div class="d-grid gap-2">


                                <input type="hidden" class="form-control" id="txtEstado" name="txtEstado" value="<?php echo $selectEstado ?>">            
                                <input type="hidden" class="form-control" id="txtdecre" name="txtdecre" value="<?php include("../Pages/Metodos/Obtiene_numero_decreto.php");?>">            
                                <input type="hidden" class="form-control" id="txtdata2" name="txtdata2" value="<?php echo $txtdate?>">            
                                <input type="hidden" class="form-control" id="txtcargo2" name="txtcargo2" value="<?php echo $selectCargo?>">            
                                <input type="hidden" class="form-control" id="txtJuez2" name="txtJuez2" value="<?php echo $selectJuez?>">            
                                <input type="hidden" class="form-control" id="txtTipo2" name="txtTipo2" value="<?php echo $decreto_tipo?>">  
                                <input type="hidden" class="form-control" id="turidMA" name="turidMA" value="<?php echo $tur_id?>">  


                                <button type="button" value="" name ="btnInsertMA" id="btnInsertMA" class="btn btn-success"><i class="fa fa-floppy-o fa-1x" aria-hidden="true"></i> Guardar Informacion</button>
                            
                                   

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
                     
                    <script src="../Assets/js/insertaMesaAyuda.js"></script>