<link rel="stylesheet" href="../Assets/css/modal/Modal-exito.css">
<div class="modal fade" id="modalPermiso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header justify-content-center" id="headerSUC">
      <div class="icon-box">
      <i class="fa-regular fa-circle-check fa-beat fa-2xl" style="font-size:100px;"></i>
				</div>
        
				
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrarPermisos" name="cerrarPermisos"></button>
      </div>
       
      <form id="formP" method="POST" target="_blank" action="PDF/PDF_Permisos.php" enctype="multipart/form-data">

      <div class="modal-body text-center">
                                <h4>Generado!</h4>	
                                <p>Decreto de permisos generado correctamente, presione el boton para generar un informe.</p>
                                <input type="hidden" class="form-control" id="txtEstadoPM" name="txtEstadoPM" value="<?php echo $selectEstado ?>">            
                                <input type="hidden" class="form-control" id="txtdecrePM" name="txtdecrePM" value="<?php include("../Pages/Metodos/Obtiene_numero_decreto.php");?>">            
                                <input type="hidden" class="form-control" id="txtdata2PM" name="txtdata2PM" value="<?php echo $txtdate?>">            
                                <input type="hidden" class="form-control" id="txtcargo2PM" name="txtcargo2PM" value="<?php echo $selectCargo?>">            
                                <input type="hidden" class="form-control" id="txtJuez2PM" name="txtJuez2PM" value="<?php echo $selectJuez?>">            
                                <input type="hidden" class="form-control" id="txtTipo2PM" name="txtTipo2PM" value="<?php echo $decreto_tipo?>"> 

                                <input type="hidden" class="form-control" id="desdePM" name="desdePM" autocomplete="off" Required>
                               
                                <input type="hidden" class="form-control" id="hastaPM" name="hastaPM" autocomplete="off" Required>
                                    
                                <input type="hidden" class="form-control" id="diasPM" name="diasPM" autocomplete="off" Required>
                      
                                <input type="hidden" class="form-control" id="ndocumentoPM" name="ndocumentoPM" autocomplete="off" Required>

                                <input type="hidden" class="form-control" id="dpPM" name="dpPM" autocomplete="off" Required>

                                <input type="hidden" class="form-control" id= "detallePM" name ="detallePM" autocomplete="off" Required>
                                <input type="hidden" class="form-control" id= "funcionarioPM" name ="funcionarioPM" autocomplete="off" Required>
                              
                            
                                




      </div>
        <div class="boton"> <button class="btn btn-success" type="submit" value="" name="btnpdfP" id="btnpdfP" data-dismiss="modal"><span>Generar informe!</span> <i class="fa-solid fa-print"></i></button>
        </div>
         
      
 
      </form>


    </div>
  </div>
</div>
<script>
  $('#cerrarPermisos').on('click',function(){
    setTimeout(function(){location.href= 'Diseño_decretos.php';}, 1000);
   return true;
  });
</script>
