<link rel="stylesheet" href="../Assets/css/modal/Modal-exito.css">
<div class="modal fade" id="modalOtrosM" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header justify-content-center" id="headerSUC">
      <div class="icon-box">
      <i class="fa-regular fa-circle-check fa-beat fa-2xl" style="font-size:100px;"></i>
				</div>
        
				
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrarOtros" name="cerrarOtros"></button>
      </div>
       
      <form id="formOM">
 
      <div class="modal-body text-center">
                                <h4>Modificado con Exito!</h4>	
                                <p>Decreto otros modificado correctamente!</p>                                           
      </div>
        <div class="boton"> <button class="btn btn-success" type="submit" value="" name="btnpdfO" id="btnpdfO" data-dismiss="modal"><span>Continuar.</span></button>
        </div>
         
      
 
      </form>


    </div>
  </div>
</div>
<script>
  $('#cerrarOtros').on('click',function(){
    setTimeout(function(){location.href= 'Modificar_decretos.php';}, 1000);
   return true;
  });
</script>
