<link rel="stylesheet" href="../Assets/css/modal/Modal-exito.css">
<div class="modal fade" id="modalReceptor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <h4>Generado!</h4>	
                                <p>Decreto de receptores generado correctamente, presione el boton para generar un informe.</p>

                                
                                <input type="hidden" class="form-control" id="txtEstadoRM" name="txtEstadoRM" value="<?php echo $selectEstado ?>">            
                                <input type="hidden" class="form-control" id="txtdecreRM" name="txtdecreRM" value="<?php include("../Pages/Metodos/Obtiene_numero_decreto.php");?>">            
                                <input type="hidden" class="form-control" id="txtdata2RM" name="txtdata2RM" value="<?php echo $txtdate?>">            
                                <input type="hidden" class="form-control" id="txtcargo2RM" name="txtcargo2RM" value="<?php echo $selectCargo?>">            
                                <input type="hidden" class="form-control" id="txtJuez2RM" name="txtJuez2RM" value="<?php echo $selectJuez?>">            
                                <input type="hidden" class="form-control" id="txtTipo2RM" name="txtTipo2RM" value="<?php echo $decreto_tipo?>">                     
                          
      </div>

      <div class="boton"> <button class="btn btn-success" type="submit" value="" name="btnpdfRM" id="btnpdfRM" data-dismiss="modal"><span>Generar informe!</span> <i class="fa-solid fa-print"></i></button>
        </div>
   

 
      </form>


    </div>
  </div>
</div>
<script>
  $('#cerrarReceptor').on('click',function(){
    setTimeout(function(){location.href= 'Modificar_decretos.php';}, 1000);
   return true;
  });
</script>