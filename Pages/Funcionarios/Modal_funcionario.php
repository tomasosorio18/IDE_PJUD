<div class="modal fade" id="delete_<?php echo $funcionarios['FUNCIONARIO_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Funcionario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p class="text-center">¿Esta seguro de borrar al siguiente funcionario?:</p>
				<h2 class="text-center"> Sr(a) <b><?php echo $funcionarios['FUNCIONARIO_NOMBRE']. " " . $funcionarios['FUNCIONARIO_APELLIDO']  ?></b></h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a href="Funcionarios/Borrar_funcionario.php?id=<?php echo $funcionarios['FUNCIONARIO_ID']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>Eliminar</a>
        
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="edit_<?php echo $funcionarios['FUNCIONARIO_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar funcionario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     
      <form method="POST" action="Funcionarios/Editar_funcionario.php?id=<?php echo $funcionarios['FUNCIONARIO_ID']; ?>">

      <div class="modal-body">
        <div class = "col-lg-12">         
                  <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">NOMBRE FUNCIONARIO:</label>
                    <input type="text" class="form-control" name="nombre" value="<?php echo $funcionarios['FUNCIONARIO_NOMBRE']; ?>">
                  </div>
                  <div class="mb-12">
                    <label for="exampleFormControlSelect1" class="form-label">APELLIDO FUNCIONARIO:</label>
                    <input type="text" class="form-control" name="apellido" value="<?php echo $funcionarios['FUNCIONARIO_APELLIDO']; ?>">
                  </div>
                  
                  <div class="mb-12">
                    <label for="exampleFormControlSelect1" class="form-label">CARGO FUNCIONARIO:</label>
                            <select class="form-select" id="selectCargo"name="selectCargo"> 

                            <?php try {
                                $sentenciaSQL=$conexion->prepare("SELECT * FROM cargo_funcionario;");
                                $sentenciaSQL->execute();
                                $listaCargos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


                            foreach($listaCargos as $cargos) { ?>
                            <option value='<?php echo $cargos["CARGO_FUNC_ID"] ?> '><?=$cargos["CARGO_FUNC_NOMBRE"]?></option> 
                            <?php }
                            
                            
                            } catch (\Throwable $th) {
                                echo '<script>
                                toastr.error("Ocurrio un error en la base de datos");
                                setTimeout(() => {
                                location.href = "Gestion_funcionarios.php";
                                }, 3000);
                                </script>';
                            } ?>
                            </select>
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
