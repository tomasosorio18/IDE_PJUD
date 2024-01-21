
<div class="modal fade" id="edit_<?php echo $decretos['DECRETO_N_CORRELATIVO']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Menu Adjunto Firmado</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     





      <div class="modal-body">
        
        <div class = "form-group">
        <a type="button" class="btn btn-success" href="Informe_decretos.php?file_id=<?php echo $decretos['DECRETO_N_CORRELATIVO']?>&anio=<?php echo $selectAño?>">Descargar</a>
        <a type="button" target="_blank" class="btn btn-primary" href="Informe_decretos.php?file_id_view=<?php echo $decretos['DECRETO_N_CORRELATIVO'] ?>&anio=<?php echo $selectAño?>">Visualizar</a>
        <a type="button" class="btn btn-danger" href="Informe_decretos.php?file_id_delete=<?php echo $decretos['DECRETO_N_CORRELATIVO'] ?>&anio=<?php echo $selectAño?>">Eliminar</a>
     
                    
        </div>
      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
       </div>



    </div>
  </div>
</div> 


<div class="modal fade" id="anular_<?php echo $decretos['DECRETO_N_CORRELATIVO']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-warning">
    <div class="modal-content">
      <div class="modal-header justify-content-center" id="headerWar">
        <div class="icon-box">
            
            <i class="fa-solid fa-triangle-exclamation fa-beat fa-2xl"style="font-size:100px;"></i>
      
				</div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    

      <div class="modal-body">                            
        <div class="alert alert-warning" role="alert">
                            <i class="fa fa-exclamation-triangle"></i> ¿Esta seguro que desea anular el decreto N_ <?php echo $decretos['DECRETO_N_CORRELATIVO']?>?
        </div>
      </div>

        <div class="boton">
          <a type="button" class="btn btn-danger" href="Informe_decretos.php?decreto_id=<?php echo $decretos['DECRETO_N_CORRELATIVO']?>&anio=<?php echo $selectAño?>">Anular decreto.<i class="fa-solid fa-print"></i></a></button>
        </div>
     


  </div>
</div>
