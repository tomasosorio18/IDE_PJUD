<link rel="stylesheet" href="../Assets/css/modal/Modal-exito.css">
<div class="modal fade" id="modalPS" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header justify-content-center" id="headerSUC">
      <div class="icon-box">
      <i class="fa-regular fa-circle-check fa-beat fa-2xl" style="font-size:100px;"></i>
				</div>
        
				
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrarPermisosS" name="cerrarPermisosS"></button>
      </div>
       
      <form id="formPSM" method="POST" target="_blank" action="PDF/PDF_Permisos_subrogancia.php" enctype="multipart/form-data">

      <div class="modal-body text-center">
                                <h4>Generado!</h4>	
                                <p>Decreto de permisos-subrogancia generado correctamente, presione el boton para generar un informe.</p>
                                <input type="hidden" class="form-control" id="txtEstadoPSM" name="txtEstadoPSM" value="<?php echo $selectEstado ?>">            
                                <input type="hidden" class="form-control" id="txtdecrePSM" name="txtdecrePSM" value="<?php include("../Pages/Metodos/Obtiene_numero_decreto.php");?>">            
                                <input type="hidden" class="form-control" id="txtdata2PSM" name="txtdata2PSM" value="<?php echo $txtdate?>">            
                                <input type="hidden" class="form-control" id="txtcargo2PSM" name="txtcargo2PSM" value="<?php echo $selectCargo?>">            
                                <input type="hidden" class="form-control" id="txtJuez2PSM" name="txtJuez2PSM" value="<?php echo $selectJuez?>">            
                                <input type="hidden" class="form-control" id="txtTipo2PSM" name="txtTipo2PSM" value="<?php echo $decreto_tipo?>"> 
                                    
                                <input type="hidden" class="form-control" id="selectcargoMFEPSM" name="selectcargoMFEPSM" autocomplete="off" Required>                
                                <input type="hidden" class="form-control" id="txtSubroganteMFEPSM" name="txtSubroganteMFEPSM" autocomplete="off" Required>
                                <input type="hidden" class="form-control" id="selectcargoSubrogantePSM" name="selectcargoSubrogantePSM" autocomplete="off" Required>
                                <input type="hidden" class="form-control" id= "txtSubrogantePSM" name ="txtSubrogantePSM" autocomplete="off" Required>
                                <input type="hidden" class="form-control" id= "txtdiasPSM" name ="txtdiasPSM" autocomplete="off" Required>
                                <input type="hidden" class="form-control" id= "datepicker2PSM" name ="datepicker2PSM" autocomplete="off" Required>
                                <input type="hidden" class="form-control" id= "txtResolucionPSM" name ="txtResolucionPSM" autocomplete="off" Required>
                                <input type="hidden" class="form-control" id= "txtAusentePSM" name ="txtAusentePSM" autocomplete="off" Required>
                                <input type="hidden" class="form-control" id= "detallePermisossubrogacionPSM" name ="detallePermisossubrogacionPSM" autocomplete="off" Required>
                              
                            
                                




      </div>
            <div class="demo-inline-spacing">
              <button class="btn1 btn-success" type="submit" value="" name="btnpdfPSjefeU" id="btnpdfPSjefeU" data-dismiss="modal"><span>Informe Jefe Unidad</span> <i class="fa-solid fa-print"></i></button>
              <button class="btn2 btn-success" type="submit" value="" name="btnpdfPSjuezJ" id="btnpdfPSjuezJ"><span>Informe Juez J. 347</span> <i class="fa-solid fa-print"></i></button>
            </div>
            <div class="demo-inline-spacing">
              <button class="btn3 btn-success" type="submit" value="" name="btnpdfPSjuezJP" id="btnpdfPSjuezJP"><span>Informe Juez JP. 347</span> <i class="fa-solid fa-print"></i></button>
              <button class="btn4 btn-success" type="submit" value="" name="btnpdfPSadm" id="btnpdfPSadm"><span>Informe Adm. 478</span> <i class="fa-solid fa-print"></i></button>
            </div>
         
 
      </form>


    </div>
  </div>
</div>
<script>
  $('#cerrarPermisosS').on('click',function(){
    setTimeout(function(){location.href= 'Diseño_decretos.php';}, 1000);
   return true;
  });
</script>
