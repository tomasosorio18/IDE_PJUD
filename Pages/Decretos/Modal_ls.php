<link rel="stylesheet" href="../Assets/css/modal/Modal-exito.css">
<div class="modal fade" id="modalLS" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header justify-content-center" id="headerSUC">
      <div class="icon-box">
      <i class="fa-regular fa-circle-check fa-beat fa-2xl" style="font-size:100px;"></i>
				</div>
        
				
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrarLicenciasS" name="cerrarLicenciasS"></button>
      </div>
       
      <form id="formLSM" method="POST" target="_blank" action="PDF/PDF_Licencias_subrogancia.php" enctype="multipart/form-data">

      <div class="modal-body text-center">
                                <h4>Generado!</h4>	
                                <p>Decreto de licencias-subrogancia generado correctamente, presione el boton para generar un informe.</p>
                                <input type="hidden" class="form-control" id="txtEstado" name="txtEstadoLSM" value="<?php echo $selectEstado ?>">            
                                <input type="hidden" class="form-control" id="txtdecre" name="txtdecreLSM" value="<?php include("../Pages/Metodos/Obtiene_numero_decreto.php");?>">            
                                <input type="hidden" class="form-control" id="txtdata2" name="txtdata2LSM" value="<?php echo $txtdate?>">            
                                <input type="hidden" class="form-control" id="txtcargo2" name="txtcargo2LSM" value="<?php echo $selectCargo?>">            
                                <input type="hidden" class="form-control" id="txtJuez2" name="txtJuez2LSM" value="<?php echo $selectJuez?>">            
                                <input type="hidden" class="form-control" id="txtTipo2" name="txtTipo2LSM" value="<?php echo $decreto_tipo?>"> 
                                    
                                <input type="hidden" class="form-control" id="selectcargoMFELSM" name="selectcargoMFELSM" autocomplete="off" Required>                
                                <input type="hidden" class="form-control" id="txtSubroganteMFELSM" name="txtSubroganteMFELSM" autocomplete="off" Required>
                                <input type="hidden" class="form-control" id="selectcargoSubroganteLSM" name="selectcargoSubroganteLSM" autocomplete="off" Required>
                                <input type="hidden" class="form-control" id= "txtSubroganteLSM" name ="txtSubroganteLSM" autocomplete="off" Required>
                                <input type="hidden" class="form-control" id= "txtdiasLSM" name ="txtdiasLSM" autocomplete="off" Required>
                                <input type="hidden" class="form-control" id= "datepicker2LSM" name ="datepicker2LSM" autocomplete="off" Required>
                                <input type="hidden" class="form-control" id= "txtResolucionLSM" name ="txtResolucionLSM" autocomplete="off" Required> 
                                <input type="hidden" class="form-control" id= "txtAusenteLSM" name ="txtAusenteLSM" autocomplete="off" Required>
                                <input type="hidden" class="form-control" id= "detalleLicenciassubrogacionLSM" name ="detalleLicenciassubrogacionLSM" autocomplete="off" Required>
                              
                            
                                




      </div> 
            <div class="demo-inline-spacing">
               <button class="btn1 btn-success " type="submit" value="" name="btnpdfLSjefeU" id="btnpdfLSjefeU"><span>Informe Jefe Unidad</span> <i class="fa-solid fa-print"></i></button>
               <button class="btn2 btn-success " type="submit" value="" name="btnpdfLSjuezJ" id="btnpdfLSjuezJ"><span>Informe Juez J. 347</span> <i class="fa-solid fa-print"></i></button>
            </div>
            <div class="demo-inline-spacing">
              <button class="btn3 btn-success" type="submit" value="" name="btnpdfLSjuezJP" id="btnpdfLSjuezJP"><span>Informe Juez JP. 347</span> <i class="fa-solid fa-print"></i></button>
              <button class="btn4 btn-success" type="submit" value="" name="btnpdfLSadm" id="btnpdfLSadm"><span>Informe Adm. 478</span> <i class="fa-solid fa-print"></i></button>
            </div>
       
         
        
         
          
          

         
      
 
      </form>


    </div>
  </div>
</div>
<script>
  $('#cerrarLicenciasS').on('click',function(){
    setTimeout(function(){location.href= 'Diseño_decretos.php';}, 1000);
   return true;
  });
</script>
