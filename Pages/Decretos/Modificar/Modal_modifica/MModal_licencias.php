<link rel="stylesheet" href="../Assets/css/modal/Modal-exito.css">
<div class="modal fade" id="modalLicenciaL" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header justify-content-center" id="headerSUC">
        <div class="icon-box">
           <i class="fa-regular fa-circle-check fa-beat fa-2xl" style="font-size:100px;"></i>
				</div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrarLicencias" name="cerrarLicencias"></button>
      </div>
      
      <form id="formL" method="POST" target="_blank" action="PDF/PDF_Licencias.php" enctype="multipart/form-data">

      <div class="modal-body text-center">
                                <h4>Modificado con exito!</h4>	
                                <p>Decreto de licencias modificado correctamente, presione el boton para generar un nuevo informe.</p>
                                <input type="hidden" class="form-control" id="txtEstadoLM" name="txtEstadoLM">            
                                <input type="hidden" class="form-control" id="txtdecreLM" name="txtdecreLM" value="<?php echo $decreto;?>">            
                                <input type="hidden" class="form-control" id="txtdata2LM" name="txtdata2LM">            
                                <input type="hidden" class="form-control" id="txtcargo2LM" name="txtcargo2LM">            
                                <input type="hidden" class="form-control" id="txtJuez2LM" name="txtJuez2LM">            
                                <input type="hidden" class="form-control" id="txtTipo2LM" name="txtTipo2LM"> 

                                <input type="hidden" class="form-control" id="desdeLM" name="desdeLM" autocomplete="off" Required>
                               
                                <input type="hidden" class="form-control" id="hastaLM" name="hastaLM" autocomplete="off" Required>
                                    
                                <input type="hidden" class="form-control" id="diasLM" name="diasLM" autocomplete="off" Required>
                      
                                <input type="hidden" class="form-control" id="ndocumentoLM" name="ndocumentoLM" autocomplete="off" Required>

                                <input type="hidden" class="form-control" id="dpLM" name="dpLM" autocomplete="off" Required>

                                <input type="hidden" class="form-control" id= "detalleLM" name ="detalleLM" autocomplete="off" Required>
                                <input type="hidden" class="form-control" id= "funcionarioLM" name ="funcionarioLM" autocomplete="off" Required>                   

      </div>
      <div class="boton"> <button class="btn btn-success" type="submit" value="" name="btnpdfL" id="btnpdfL" data-dismiss="modal"><span>Generar informe!</span> <i class="fa-solid fa-print"></i></button>
        </div>
 
      </form>


    </div>
  </div>
</div>

<script>
  $('#cerrarLicencias').on('click',function(){
    setTimeout(function(){location.href= 'Modificar_decretos.php';}, 1000);
   return true;
  });
</script>