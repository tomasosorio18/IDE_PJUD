<link rel="stylesheet" href="../Assets/css/modal/Modal-exito.css">
<div class="modal fade" id="modalFeriado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header justify-content-center" id="headerSUC">
        <div class="icon-box">
            <i class="fa-regular fa-circle-check fa-beat fa-2xl" style="font-size:100px;"></i>
				</div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrarFeriados" name="cerrarFeriados"></button>
      </div>
      
      <form id="formR" method="POST" target="_blank" action="PDF/PDF_Feriados.php" enctype="multipart/form-data">
 
      <div class="modal-body text-center"> 
                                <h4>Generado!</h4>	  
                                <p>Decreto de feriados generado correctamente, presione el boton para generar un informe.</p>
                                <input type="hidden" class="form-control" id="txtEstadoFM" name="txtEstadoFM" value="<?php echo $selectEstado ?>">            
                                <input type="hidden" class="form-control" id="txtdecreFM" name="txtdecreFM" value="<?php include("../Pages/Metodos/Obtiene_numero_decreto.php");?>">            
                                <input type="hidden" class="form-control" id="txtdata2FM" name="txtdata2FM" value="<?php echo $txtdate?>">            
                                <input type="hidden" class="form-control" id="txtcargo2FM" name="txtcargo2FM" value="<?php echo $selectCargo?>">            
                                <input type="hidden" class="form-control" id="txtJuez2FM" name="txtJuez2FM" value="<?php echo $selectJuez?>">            
                                <input type="hidden" class="form-control" id="txtTipo2FM" name="txtTipo2FM" value="<?php echo $decreto_tipo?>"> 

                                <input type="hidden" class="form-control" id="desdeFM" name="desdeFM" autocomplete="off" Required>
                               
                                <input type="hidden" class="form-control" id="hastaFM" name="hastaFM" autocomplete="off" Required>
                                    
                                <input type="hidden" class="form-control" id="diasFM" name="diasFM" autocomplete="off" Required>
                      
                                <input type="hidden" class="form-control" id="ndocumentoFM" name="ndocumentoFM" autocomplete="off" Required>

                                <input type="hidden" class="form-control" id="dpFM" name="dpFM" autocomplete="off" Required>

                                <input type="hidden" class="form-control" id= "detalleFM" name ="detalleFM" autocomplete="off" Required>
                                <input type="hidden" class="form-control" id= "funcionarioFM" name ="funcionarioFM" autocomplete="off" Required>
                              
                          

      </div>

      <div class="boton"> <button class="btn btn-success" type="submit" value="" name="btnpdfFM" id="btnpdfFM" data-dismiss="modal"><span>Generar informe</span> <i class="fa-solid fa-print"></i></button>
        </div>
      
      </form>


    </div>
  </div>
</div>
<script>
  $('#cerrarFeriados').on('click',function(){
    setTimeout(function(){location.href= 'Diseño_decretos.php';}, 1000);
   return true;
  });
</script>
