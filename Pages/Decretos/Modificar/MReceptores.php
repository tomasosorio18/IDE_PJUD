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
              <h5 class="card-title text-primary mb-3"> Decreto de Receptores</h5>
              <h6 class="card-subtitle text-muted">Decreto número: <span class="badge rounded-pill bg-info" ;><?php if(basename($_SERVER['SCRIPT_NAME']) == 'Diseño_decretos.php'){ include("Metodos/Obtiene_numero_decreto.php");} else { echo $decreto;}?></span><?php echo " del año " . $año; ?></small>
            </div>
          </div>
        </div>
      </div>
                        <div class="card-body">
                                        <form id="formR" method="POST" target="_blank" action="Generate_pdf/pdfFeriados.php" enctype="multipart/form-data" onsubmit="return validateForm2()">

                                        <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">FECHA:</label>

                                    <input type="text" required ="true" class="form-control fechaR" id="datepicker" name="datepicker" autocomplete="off" placeholder="Seleccione fecha">                                       
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">FIRMA:</label>

                                        <select class="form-select selectJuezR" name="selectJuez" id="selectJuez" required>
                                            <?php foreach($listaJuez as $jueces) { ?>
                                            <option value="none" selected disabled hidden>Seleccione un juez</option>
                                            <option value='<?php echo $jueces["JUEZ_ID"]?> '><?=$jueces["JUEZ_NOMBRE"]. " ". $jueces["JUEZ_APELLIDO"] ?></option> 
                                            <?php }?>
                                        </select>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">CARGO:</label>

                                        <div class="position-relative">
                                            <select name="selectCargoVista" id="selectCargoVista" class="select2 form-select select2-hidden-accessible cargoR" disabled data-select2-id="select2Disabled" tabindex="-1" aria-hidden="true" style="cursor: not-allowed;">
                                                <option value="none" selected disabled hidden>Seleccione un juez para visualizar su cargo</option>
                                            </select>
                                        </div>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">ESTADO DECRETO:</label>

                                    <select class="form-select" name="txtEstadoR" id="txtEstadoR" required>                                                  
                                        <option value="none" selected disabled hidden>Seleccione un tipo de decreto</option>
                                        <option value="Reservado">Reservado</option> 
                                        <option value="Publico">Publico</option> 
                                    </select>
                                </div>
                                             
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
                                    <input type="text" class="form-control" id= "detalleReceptorR"name ="detalleReceptorR" autocomplete="off" Required>
                                </div>
                        

                                <br>
                                <div class="d-grid gap-2">
                                   
                                <input type="hidden" class="form-control" id="txtdecreR" name="txtdecreR" value="<?php echo $decreto;?>">                    
                                <input type="hidden" class="form-control" id="txtTipo2R" name="txtTipo2R" value="<?php echo $decretotipo?>">            
                                <input type="hidden" class="form-control" id="turidRM" name="turidRM" value="<?php echo $tur_id?>">            

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

                    <script src="../Assets/js/modificar/modificaReceptor.js"></script>