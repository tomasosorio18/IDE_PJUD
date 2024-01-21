<?php
//se inicia la sesion
session_start();
// aca se pregunta si la variable de SESSIONS tiene asignado un estado logeado como true
if (isset($_SESSION['logeado']) && $_SESSION['logeado'] == true) {
    //si es asi traemos la variable name y apellido almacenada en SESSIONS
    $email=$_SESSION['name'];
    $apellido=$_SESSION['apellido'];
    $rol= $_SESSION['rol'];
    $id= $_SESSION['id'];
    // aca obtenemos las iniciales del nombre y apellido
    $letra_nombre =mb_substr($email, 0, 1);
    $letra_Apellido =mb_substr($apellido, 0, 1);
     // y las almacenamos en la variable SESSIONS
    $_SESSION['iniciales'] = $letra_nombre . $letra_Apellido;

    session_write_close();
} else {
  // Si la variable SESSION no tiene un estado logeado o lo tiene falso, quiere decir que un usuario
  //quiere acceder a la pagina sin autenticarse, por lo que debemos redireccionarlo a que se loguee
    session_unset();
    session_write_close();
    $url = "../Index.php?sesion=permisos";
    header("Location: $url");
}

if ($_SESSION['rol']== 2) {
// si el rol almecenado en la variable SESSION es 2, quiere decir que el rol que posee es de usuario y como
// este menu es unicamente para administrador, debemos redireccionarlo al login
    session_unset();
    session_write_close();
    session_destroy();
    header('Location: ../Index.php?sesion=permisos');
}
?>
<?php 
//esta funcion permite asignarle un titulo a cada pagina, mediante el include de la cabecera, sin tener que traer todo el html
$PageTitle="Gestion Permisos";

function customPageHeader(){?>
  <!--Arbitrary HTML Tags-->
<?php }?>

<?php include("../Configuration/Connector.php");
include("Metodos/Trae_datos_usuario.php");?>


 <?php
 //incluimos la cabecera del admin para ahorrarnos codigo   
 include("Layouts/Cabecera_admin.php");
    ?>



<?php 
//sentencia para traer los datos de los miembros registrados
try {
  $sentenciaSQL=$conexion->prepare("SELECT usuario.USUARIO_ID,usuario.USUARIO_NOMBRE, usuario.USUARIO_APELLIDO, usuario.USUARIO_CORREO, rol.ROL_NOMBRE, rol.ROL_ID FROM tribunal_usu_rol
  INNER JOIN rol ON tribunal_usu_rol.ROL_ID = rol.ROL_ID
  INNER JOIN usuario ON tribunal_usu_rol.USUARIO_ID = usuario.USUARIO_ID;");
  $sentenciaSQL->execute();
  $listaMember=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
} catch (\Throwable $th) {
  echo '<script>
  toastr.error("Ocurrio un error en la base de datos");
  setTimeout(() => {
  location.href = "Gestion_Roles.php";
  }, 3000);
  </script>';
} ?>

<script>
    //alertas varias. En caso de que el mensaje traido de get sea sucess k envie una alerta de exito.
		<?php if ($_GET["message"] == "success") { ?>
		toastr.options =
		{
		  "closeButton" : true,
		  "progressBar" : true
		}
			  toastr.success("Permiso actualizado correctamente");
                
		<?php }else{?>
            toastr.options =
            {
              "closeButton" : true,
              "progressBar" : true
            }
            toastr.error("Error al cambiar el permiso");
                 <?php }?>

	  </script>

<br>

<div class="container">
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Menu Administrador /</span> Editar roles</h4>
    <div class="row">
      
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title text-primary">Gestion de cargos de usuario</h5>
                <h6 class="card-subtitle text-muted">Permite modificar los cargos de cualquier usuario.</h6></div>
                <div class="card-body">
              <!-- inicio de la tabla -->
                <table id="table" class="table table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th> 
                            <th>Apellido</th> 
                            <th>Email</th> 
                            <th>Permiso</th> 
                            <th>Acciones</th>

                        </tr>
                        </thead>
                        <tbody>
                        <!-- Con este foreach recorremos el array retornado de la basededatos para rellenar la tabla de forma dinamica -->
                        <?php foreach($listaMember as $members){ ?>
                            <tr>
                                <td scope="row"><?php echo $members['USUARIO_ID'];?></td>
                                <td><?php echo $members['USUARIO_NOMBRE'];?></td>
                                <td><?php echo $members['USUARIO_APELLIDO'];?></td>
                                <td><?php echo $members['USUARIO_CORREO'];?></td>       
                                <td>
                                
                                <?php
                                //preguntamos si el rol es de admin para colocar ciertas etiquetas de estilos.
                                if($members['ROL_ID'] == 1){
                                    ?>
                                    <span class="badge rounded-pill bg-success"><?php echo $members['ROL_NOMBRE'] ?></span>
                                 <?php   
                                }else{
                                    ?>
                                    <span class="badge rounded-pill bg-warning"><?php echo $members['ROL_NOMBRE'] ?></span>
                                    <?php
                                }
                                
                                  
                                 ?>
                            
                            
                                </td>   
                                <td>
                                 <!-- Colocamos un link para dirigir a una pantalla modal con la id del miembro -->
                                 <a href="#" data-bs-target="#edit_<?php echo $members['USUARIO_ID']; ?>" data-bs-toggle="modal" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-edit"></span>Cambiar permiso</a>
							    
                              
                               
                                </td>
                                <!-- incluimos la pantalla modal  -->
                                 <?php include('Usuarios/Modal_usuario.php'); ?>
                                    

                                
                            </tr>
                            <?php }?>
                        </tbody>
                  </table>
                  
                  
                </div>
         
            </div>
        </div>





        
    </div>
</div>


















     <!-- Scripts para datatable -->
        <script>
    var myTable = document.querySelector("#table");
    var dataTable = new DataTable(myTable,{
        perPage:6,
        perPageSelect:[3,6,9,12]
    });

// or


</script>

<?php 
//traemos el pie con el include
include("Layouts/Pie_admin.php");
?>