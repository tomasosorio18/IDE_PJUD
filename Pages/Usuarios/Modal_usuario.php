<div class="modal fade" id="edit_<?php echo $members['USUARIO_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Permisos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form method="POST" action="Usuarios/Editar_usuario.php?id=<?php echo $members['USUARIO_ID']; ?>">

      <div class="modal-body">
        <div class = "form-group">
                  
                 <b> <label for="exampleInputEmail1"><?php echo $members['USUARIO_NOMBRE'];?></label></b>
                  <label for="exampleInputEmail1"> actualmente tiene permisos de:</label>
                  <b><label for="exampleInputEmail1"><?php echo $members['ROL_NOMBRE'];?></label></b>
                  <br>
                
                 
                  <div class="form-group">
                  <br>
                  <label for="exampleInputEmail1">Seleccione nuevo permiso:</label>
                         
                    <select class="form-control" id="selectPermiso"name="selectPermiso"> 

                    <?php try {
                        $sentenciaSQL=$conexion->prepare("SELECT * FROM rol;");
                        $sentenciaSQL->execute();
                        $listaPermisos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
                   
                    
                    foreach($listaPermisos as $permisos) { ?>
                      <option value='<?php echo $permisos["ROL_ID"] ?> '><?=$permisos["ROL_NOMBRE"]?></option> 
                      <?php }
                      
                      
                    } catch (\Throwable $th) {
                        echo '<script>
                        toastr.error("Ocurrio un error en la base de datos");
                        setTimeout(() => {
                        location.href = "Gestion_roles.php";
                        }, 3000);
                        </script>';
                      } ?>
                    </select>
                    
                  </div>
                  
        </div>
      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        <button type="submit" id="editar" name="editar" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Cambiar</a>
			
      </div>

 
      </form>


    </div>
  </div>
</div>
