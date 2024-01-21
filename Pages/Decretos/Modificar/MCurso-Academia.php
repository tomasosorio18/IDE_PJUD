<div class="col-12 col-lg-4 order-2 order-md-3 order-lg-2 mb-2">
                            <div class="card">

                                <div class="d-flex align-items-end row">      
                                    <div class="col-md-11">
                                         <div class="card-header flex-grow-0">
                                            <div class="d-flex">
                                            <div class="avatar flex-shrink-0 me-3">
                                            <button type="button" class="btn rounded-pill btn-icon btn-info"><b><?php echo $decreto;?></b></button>
                                            </div>
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-1">
                                                <div class="me-2">
                                                <h5 class="card-title text-primary mb-3"> Decreto de Curso Academia</h5>
                                                <h6 class="card-subtitle text-muted">Decreto número: <span class="badge rounded-pill bg-info" ;><?php echo $decreto;?></span><?php echo " del año " . $año; ?></small>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                        <div class="card-body">
                                        <form id="formCA">

                                        <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">FECHA:</label>

                                    <input type="text" required ="true" class="form-control fechaCA" id="datepicker" name="datepicker" autocomplete="off" placeholder="Seleccione fecha">                                       
                                </div> 

                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">FIRMA:</label>

                                        <select class="form-select selectJuezCA" name="selectJuez" id="selectJuez" required>
                                            <?php foreach($listaJuez as $jueces) { ?>
                                            <option value="none" selected disabled hidden>Seleccione un juez</option>
                                            <option value='<?php echo $jueces["JUEZ_ID"]?> '><?=$jueces["JUEZ_NOMBRE"]. " ". $jueces["JUEZ_APELLIDO"] ?></option> 
                                            <?php }?>
                                        </select>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">CARGO:</label>

                                        <div class="position-relative">
                                            <select name="selectCargoVista" id="selectCargoVista" class="select2 form-select select2-hidden-accessible cargoCA" disabled data-select2-id="select2Disabled" tabindex="-1" aria-hidden="true" style="cursor: not-allowed;">
                                                <option value="none" selected disabled hidden>Seleccione un juez para visualizar su cargo</option>
                                            </select>
                                        </div>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">ESTADO DECRETO:</label>

                                    <select class="form-select" name="txtEstadoCA" id="txtEstadoCA" required>                                                  
                                        <option value="none" selected disabled hidden>Seleccione un tipo de decreto</option>
                                        <option value="Reservado">Reservado</option> 
                                        <option value="Publico">Publico</option> 
                                    </select>
                                </div>
                                <div class = "form-group">
                                <label for="exampleInputEmail1">Funcionario:</label>

                                <select class="form-control selectFuncCA" id="selectFunc" name="selectFunc">
                                 <?php                         
                                 
                                 foreach($listaFunc as $funcionarios) { ?>
                                 <option value="none" selected disabled hidden>Seleccione Funcionario</option>
                                 <option value='<?php echo $funcionarios["FUNCIONARIO_ID"] ?> '><?php echo $funcionarios["FUNCIONARIO_NOMBRE"]." ".$funcionarios["FUNCIONARIO_APELLIDO"];?></option> 
                                 
                                  <?php }?>
                                 </select>

                                   </div>

                                   <div class="form-group">
                                        <label for="exampleInputPassword1">Nombre Curso</label>
                                        <input type="text" class="form-control" id="txtCursoCA" name="txtCursoCA" autocomplete="off" Required>
                                   </div>

                                   <div class = "form-group">
                                        <label for="exampleInputEmail1">Ciudad:</label>
                                        <select class="form-control" id="selectCiudadCA" name="selectCiudadCA">      
                                            <option value="none" selected disabled hidden>Seleccione una ciudad</option>
                                            <option value="Talcahuano">Talcahuano</option>
                                            <option value="Concepcion">Concepcion</option>
                                            <option value="Coronel">Coronel</option>
                                            <option value="Hualpen">Hualpen</option>
                                            <option value="Chiguayante">Chiguayante</option>
                                            <option value="San Pedro">San Pedro</option>
                                            <option value="Tome">Tome</option>
                                            <option value="Lota">Lota</option>
                                            <option value="Penco">Penco</option>
                                            <option value="Hualqui">Hualqui</option>
                                            <option value="Santa Juana">Santa Juana</option>
                                            <option value="Florida">Florida</option>
                                            <option value="Online">Online</option>
                                        </select>
                                   </div>

                                <div class="form-group">
                                <label for="exampleInputPassword1">Desde</label>
                                <input type="text" class="form-control desdeCA" id="firstDate" name="firstDate" autocomplete="off" Required>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Hasta</label>
                                <input type="text" class="form-control hastaCA" id="secondDate" name="secondDate" autocomplete="off" Required>
                                </div>
                                                   
                                <div class="form-group">
                                <label for="exampleInputPassword1">N° Resolucion</label>
                                <input type="text" class="form-control" id="txtresolucionCA" name="txtresolucionCA" autocomplete="off" Required>
                                </div>
                               
                                <div class="form-group">
                                <label for="exampleInputPassword1">Detalle</label>
                                <input type="text" class="form-control" id= "detalleCA" name ="detalleCA" autocomplete="off" Required>
                              
                                </div>
                                <br>
                                <div class="d-grid gap-2">
  
                                <input type="hidden" class="form-control" id="txtdecreCA" name="txtdecreCA" value="<?php echo $decreto?>">            
                                <input type="hidden" class="form-control" id="txtTipo2CA" name="txtTipo2CA" value="<?php echo $decretotipo?>">            
                                <input type="hidden" class="form-control" id="turidCA" name="turidCA" value="<?php echo $tur_id?>">            
                                <button type="button" value="" name ="btnInsertCA" id="btnInsertCA" class="btn btn-success"><i class="fa fa-floppy-o fa-1x" aria-hidden="true"></i> Guardar Informacion</button>
                            
                                   

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
                    <script src="../Assets/js/modificar/modificaCursoAcademia.js"></script>
           