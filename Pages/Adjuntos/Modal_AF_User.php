
<div class="modal fade" id="edit_<?php echo $decretos['DECRETO_N_CORRELATIVO']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Menu Adjunto Firmado</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     





      <div class="modal-body">
        
        <div class = "form-group">
        <a type="button" class="btn btn-success" href="Informe_decretos_usuario.php?file_id=<?php echo $decretos['DECRETO_N_CORRELATIVO']?>&anio=<?php echo $selectAño?>">Descargar</a>
        <a type="button" target="_blank" class="btn btn-primary" href="Informe_decretos_usuario.php?file_id_view=<?php echo $decretos['DECRETO_N_CORRELATIVO'] ?>&anio=<?php echo $selectAño?>">Visualizar</a>
       
     
                    
        </div>
      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
       </div>



    </div>
  </div>
</div> 

