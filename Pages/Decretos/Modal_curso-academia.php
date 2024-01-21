<link rel="stylesheet" href="../Assets/css/modal/Modal-exito.css">
<div class="modal fade" id="modalCurso-Academia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header justify-content-center" id="headerSUC">
        <div class="icon-box">
            <i class="fa-regular fa-circle-check fa-beat fa-2xl" style="font-size:100px;"></i>
				</div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrarCurso" name="cerrarCurso"></button>
      </div>
      
      <form id="formCA" method="POST" target="_blank" action="PDF/PDF_Curso_Academia.php" enctype="multipart/form-data">

      <div class="modal-body text-center">
                                <h4>Generado!</h4>	
                                <p>Decreto de Curso academia generado correctamente, presione el boton para generar un informe.</p>
                                <input type="hidden" class="form-control" id="txtEstadoCAM" name="txtEstadoCAM" value="<?php echo $selectEstado ?>">            
                                <input type="hidden" class="form-control" id="txtdecreCAM" name="txtdecreCAM" value="<?php include("../Pages/Metodos/Obtiene_numero_decreto.php");?>">            
                                <input type="hidden" class="form-control" id="txtdata2CAM" name="txtdata2CAM" value="<?php echo $txtdate?>">            
                                <input type="hidden" class="form-control" id="txtcargo2CAM" name="txtcargo2CAM" value="<?php echo $selectCargo?>">            
                                <input type="hidden" class="form-control" id="txtJuez2CAM" name="txtJuez2CAM" value="<?php echo $selectJuez?>">            
                                <input type="hidden" class="form-control" id="txtTipo2CAM" name="txtTipo2CAM" value="<?php echo $decreto_tipo?>"> 
                                <input type="hidden" class="form-control" id="turidCAM" name="turidCAM" autocomplete="off" Required>      
                                <input type="hidden" class="form-control" id="desdeCAM" name="desdeCAM" autocomplete="off" Required>                       
                                <input type="hidden" class="form-control" id="hastaCAM" name="hastaCAM" autocomplete="off" Required>                      
                                <input type="hidden" class="form-control" id="nresolucionCAM" name="nresolucionCAM" autocomplete="off" Required>
                                <input type="hidden" class="form-control" id="txtcursoCAM" name="txtcursoCAM" autocomplete="off" Required>
                                <input type="hidden" class="form-control" id= "detalleCAM" name ="detalleCAM" autocomplete="off" Required>
                                <input type="hidden" class="form-control" id= "ciudadCAM" name ="ciudadCAM" autocomplete="off" Required>
                                <input type="hidden" class="form-control" id= "funcionarioCAM" name ="funcionarioCAM" autocomplete="off" Required>
                              
                          

      </div>
        <div class="demo-inline-spacing">
               <button class="btn1 btn-success " type="submit" value="" name="btnpdfCAP" id="btnpdfCAP"><span>Informe Curso Academia Presencial</span> <i class="fa-solid fa-print"></i></button>
               <button class="btn2 btn-success " type="submit" value="" name="btnpdfCAO" id="btnpdfCAO"><span>Informe Curso Academia En-Linea</span> <i class="fa-solid fa-print"></i></button>
        </div>

                                      
        
      
      </form>


    </div>
  </div>
</div>
<script>
  $('#cerrarCurso').on('click',function(){
    setTimeout(function(){location.href= 'Diseño_decretos.php';}, 1000);
   return true;
  });
</script>
