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
              <h5 class="card-title text-primary mb-3"> Decreto de Receptores</h5>
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
                                        <form id="formR" method="POST" target="_blank" action="Generate_pdf/pdfFeriados.php" enctype="multipart/form-data" onsubmit="return validateForm2()">
                                             
                                              <div class="wrapper">
                                               <div class="element">
                                                
                                                    <div class="form-group"> 
                                                      <label for="exampleFormControlSelect1" id="receptor1">Receptor 1:</label>
                                                      <div style="display: flex; align-items: center;">
                                                        <select name="selectReceptor[1]" id="selectReceptor[1]" class="form-select">
                                                            <?php foreach($listaReceptores as $receptores) { ?>
                                                            <option value="none" selected disabled hidden>Seleccione un receptor</option>
                                                            <option value='<?php echo $receptores["RECEPTOR_ID"] ?> '><?=$receptores["RECEPTOR_NOMBRE"] ." ". $receptores["RECEPTOR_APELLIDO"] ?></option>      
                                                            <?php }?>
                                                        </select>     
                                                      <button type="button" class="btn rounded-pill btn-outline-danger" id="eliminaReceptor" style="margin-left: 10px;"><span class="align-middle"></span><i class="fa-sharp fa-solid fa-xmark"></i></span></button>                                                       
                                                      </div>
                                                     
                                                    </div>                                             
                                                </div>
                                                <div class="results"></div>
                                                <button type="button"  id="añadeReceptor" class="btn rounded-pill btn-primary" style="margin-top: 15px; margin-bottom:15px;"><i class="fa-solid fa-plus"></i></span> Añadir</button>
                                             </div>

                                <div class="form-group mb-3">
                                    <label for="exampleInputPassword1">Detalle</label>
                                    <input type="text" class="form-control" id= "detalleReceptor"name ="detalleReceptor" autocomplete="off" Required>
                                </div>
                        

                                <br>
                                <div class="d-grid gap-2">


                                <input type="hidden" class="form-control" id="txtEstado" name="txtEstado" value="<?php echo $selectEstado ?>">            
                                <input type="hidden" class="form-control" id="txtdecre" name="txtdecre" value="<?php include("../Pages/Metodos/Obtiene_numero_decreto.php");?>">            
                                <input type="hidden" class="form-control" id="txtdata2" name="txtdata2" value="<?php echo $txtdate?>">            
                                <input type="hidden" class="form-control" id="txtcargo2" name="txtcargo2" value="<?php echo $selectCargo?>">            
                                <input type="hidden" class="form-control" id="txtJuez2" name="txtJuez2" value="<?php echo $selectJuez?>">            
                                <input type="hidden" class="form-control" id="txtTipo2" name="txtTipo2" value="<?php echo $decreto_tipo?>">            
                                <input type="hidden" class="form-control" id="turidR" name="turidR" value="<?php echo $tur_id?>">            

                                <button type="button" value="" name ="btnInsertR" id="btnInsertR" class="btn btn-success"><i class="fa fa-floppy-o fa-1x" aria-hidden="true"></i> Guardar Informacion</button>
                                
                                   

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

                    <script>
                          $('.wrapper').on('click', '#eliminaReceptor', function() {
                                  let $elements = $('#eliminaReceptor').closest('.wrapper').find('.element');
                                  
                                  // Verifica si hay más de un elemento .element antes de eliminar
                                  if ($elements.length > 1) {
                                    $elements.not(':first').last().remove();
                                  } else {
                                    // Muestra el "toast" o mensaje de advertencia cuando intentas eliminar el único select
                                    toastr.warning("¡No puedes eliminar el primer select box!");
                                    
                                  }
                                });
                          $('.wrapper').on('click', '#añadeReceptor', function() {
                              // Encuentra todos los elementos select dentro del div con clase "wrapper"
                              let $selects = $('.wrapper').find('select');

                              // Obtiene el último ID de select existente
                              let lastId = $selects.last().attr('id');
                              let lastIndex = parseInt(lastId.match(/\d+/)[0]);

                              // Clona el primer elemento con la clase ".element"
                              let $clone = $('.wrapper').find('.element').first().clone();

                              // Incrementa el índice del nuevo select clonado
                              lastIndex++;
                              
                              if(lastIndex <= 14){
                              // Actualiza el name e ID del nuevo select
                              $clone.find('select').attr('name', 'selectReceptor[' + lastIndex + ']');
                              $clone.find('select').attr('id', 'selectReceptor[' + lastIndex + ']');
                              $clone.find('label').attr('id', 'receptor' + lastIndex).text('Receptor ' + lastIndex + ':');
                              // Agrega el nuevo elemento clonado a ".results"
                              $('.results').append($clone);
                            }else{
                              toastr.warning("¡Has llegado al limite de receptores!");

                            }
                         
                            
                          });
                    </script>

                    <script src="../Assets/js/insertaReceptores.js"></script>