<div class="modal fade" id="delete_<?php echo $receptores['RECEPTOR_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Receptor</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p class="text-center">¿Esta seguro que desea borrar al siguiente receptor?:</p>
				<h2 class="text-center"> Sr(a) <b><?php echo $receptores['RECEPTOR_NOMBRE']. " " . $receptores['RECEPTOR_APELLIDO']  ?></b></h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a href="Receptores/Borrar_receptor.php?id=<?php echo $receptores['RECEPTOR_ID']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>Eliminar</a>
        
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="edit_<?php echo $receptores['RECEPTOR_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar receptor</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     
      <form method="POST" action="Receptores/Editar_receptor.php?id=<?php echo $receptores['RECEPTOR_ID']; ?>">

      <div class="modal-body">
        <div class = "col-lg-12">         
                  <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">NOMBRE RECEPTOR:</label>
                    <input type="text" class="form-control" name="nombre" value="<?php echo $receptores['RECEPTOR_NOMBRE']; ?>">
                  </div>
                  <div class="mb-12">
                    <label for="exampleFormControlSelect1" class="form-label">APELLIDO RECEPTOR:</label>
                    <input type="text" class="form-control" name="apellido" value="<?php echo $receptores['RECEPTOR_APELLIDO']; ?>">
                  </div>
         
        </div>
      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" name="editar" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Actualizar</a>
			
      </div>

 
      </form>


    </div>
  </div>
</div>
