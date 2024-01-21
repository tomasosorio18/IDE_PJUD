<link rel="stylesheet" href="../Assets/css/modal/Modal-exito.css">
<div class="modal fade" id="modalFSM" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header justify-content-center" id="headerSUC">
      <div class="icon-box">
      <i class="fa-regular fa-circle-check fa-beat fa-2xl" style="font-size:100px;"></i>
				</div>
        
				
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrarFeriadosS" name="cerrarFeriadosS"></button>
      </div>
       
      <form id="formFSM" method="POST" target="_blank" action="PDF/PDF_Feriados_subrogancia.php" enctype="multipart/form-data">

      <div class="modal-body text-center">
                                <h4>Modificado con exito!</h4>	 
                                <p>Decreto de feriados-subrogancia modificado correctamente, presione el boton para generar un nuevo informe.</p> 
                                <input type="hidden" class="form-control" id="txtEstadoFSM" name="txtEstadoFSM">            
                                <input type="hidden" class="form-control" id="txtdecreFSM" name="txtdecreFSM" value="<?php echo $decreto;?>">            
                                <input type="hidden" class="form-control" id="txtdata2FSM" name="txtdata2FSM">            
                                <input type="hidden" class="form-control" id="txtcargo2FSM" name="txtcargo2FSM" >            
                                <input type="hidden" class="form-control" id="txtJuez2FSM" name="txtJuez2FSM" >            
                                <input type="hidden" class="form-control" id="txtTipo2FSM" name="txtTipo2FSM">  
                                    
                                <input type="hidden" id="selectcargoMFEFSM" name="selectcargoMFEFSM" autocomplete="off" Required>                
                                <input type="hidden" id="txtSubroganteMFEFSM" name="txtSubroganteMFEFSM" autocomplete="off" Required>
                                <input type="hidden" id="selectcargoSubroganteFSM" name="selectcargoSubroganteFSM" autocomplete="off" Required>
                                <input type="hidden" id= "txtSubroganteFSM" name ="txtSubroganteFSM" autocomplete="off" Required>      
                                <input type="hidden" id="DesdeFSM" name="DesdeFSM" autocomplete="off" Required>                   
                                <input type="hidden" id="HastaFSM" name="HastaFSM" autocomplete="off" Required>
                                <input type="hidden" id= "datepicker2FSM" name ="datepicker2FSM" autocomplete="off" Required>
                                <input type="hidden" id= "txtResolucionFSM" name ="txtResolucionFSM" autocomplete="off" Required> 
                                <input type="hidden" id= "txtAusenteFSM" name ="txtAusenteFSM" autocomplete="off" Required>
                                <input type="hidden" id= "detalleFeriadossubrogacionFSM" name ="detalleFeriadossubrogacionFSM" autocomplete="off" Required>
                              
                            
                                




      </div> 
            <div class="demo-inline-spacing">
               <button class="btn1 btn-success " type="submit" value="" name="btnpdfFSjefeU" id="btnpdfFSjefeU"><span>Informe Jefe Unidad</span> <i class="fa-solid fa-print"></i></button>
               <button class="btn2 btn-success " type="submit" value="" name="btnpdfFSjuezJ" id="btnpdfFSjuezJ"><span>Informe Juez J. 347</span> <i class="fa-solid fa-print"></i></button>
            </div>
            <div class="demo-inline-spacing">
              <button class="btn3 btn-success" type="submit" value="" name="btnpdfFSjuezJP" id="btnpdfFSjuezJP"><span>Informe Juez JP. 347</span> <i class="fa-solid fa-print"></i></button>
              <button class="btn4 btn-success" type="submit" value="" name="btnpdfFSadm" id="btnpdfFSadm"><span>Informe Adm. 478</span> <i class="fa-solid fa-print"></i></button>
            </div>
       
         
        
         
          
          

         
      
 
      </form>


    </div>
  </div>
</div>
<script>
  $('#cerrarFeriadosS').on('click',function(){
    setTimeout(function(){location.href= 'Diseño_decretos.php';}, 1000);
   return true;
  });
</script>
