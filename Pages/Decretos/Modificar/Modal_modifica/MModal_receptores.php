<link rel="stylesheet" href="../Assets/css/modal/Modal-exito.css">
<div class="modal fade" id="modalReceptorR" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header justify-content-center" id="headerSUC">
       <div class="icon-box">
         <i class="fa-regular fa-circle-check fa-beat fa-2xl" style="font-size:100px;"></i>
				</div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrarReceptor" name="cerrarReceptor"></button>
      </div>
       
      <form id="formRM" method="POST" target="_blank" action="PDF/PDF_Receptores.php" enctype="multipart/form-data">

      <div class="modal-body text-center">
                                <h4>Modificado con exito!</h4>	
                                <p>Decreto de receptores generado correctamente, presione el boton para generar un nuevo informe.</p>

                                
                                <input type="hidden" class="form-control" id="txtEstadoRM" name="txtEstadoRM">            
                                <input type="hidden" class="form-control" id="txtdecreRM" name="txtdecreRM" value="<?php echo $decreto;?>">            
                                <input type="hidden" class="form-control" id="txtdata2RM" name="txtdata2RM" >            
                                <input type="hidden" class="form-control" id="txtcargo2RM" name="txtcargo2RM">            
                                <input type="hidden" class="form-control" id="txtJuez2RM" name="txtJuez2RM" >            
                                <input type="hidden" class="form-control" id="txtTipo2RM" name="txtTipo2RM">                     
                          
      </div>

      <div class="boton"> <button class="btn btn-success" type="submit" value="" name="btnpdfRM" id="btnpdfRM" data-dismiss="modal"><span>Generar informe!</span> <i class="fa-solid fa-print"></i></button>
        </div>
   

 
      </form>


    </div>
  </div>
</div>
<script>
  $('#cerrarReceptor').on('click',function(){
    setTimeout(function(){location.href= 'Diseño_decretos.php';}, 1000);
   return true;
  });
</script>