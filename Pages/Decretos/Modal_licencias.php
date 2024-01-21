<link rel="stylesheet" href="../Assets/css/modal/Modal-exito.css">
<div class="modal fade" id="modalLicencia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <h4>Generado!</h4>	
                                <p>Decreto de licencias generado correctamente, presione el boton para generar un informe.</p>
                                <input type="hidden" class="form-control" id="txtEstadoLM" name="txtEstadoLM" value="<?php echo $selectEstado ?>">            
                                <input type="hidden" class="form-control" id="txtdecreLM" name="txtdecreLM" value="<?php include("../Pages/Metodos/Obtiene_numero_decreto.php");?>">            
                                <input type="hidden" class="form-control" id="txtdata2LM" name="txtdata2LM" value="<?php echo $txtdate?>">            
                                <input type="hidden" class="form-control" id="txtcargo2LM" name="txtcargo2LM" value="<?php echo $selectCargo?>">            
                                <input type="hidden" class="form-control" id="txtJuez2LM" name="txtJuez2LM" value="<?php echo $selectJuez?>">            
                                <input type="hidden" class="form-control" id="txtTipo2LM" name="txtTipo2LM" value="<?php echo $decreto_tipo?>"> 

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
    setTimeout(function(){location.href= 'Diseño_decretos.php';}, 1000);
   return true;
  });
</script>