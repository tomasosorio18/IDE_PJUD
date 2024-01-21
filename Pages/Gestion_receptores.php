<?php
//se inicia la sesion
session_start();
//se pregunta si existe la variable 'logeado' en las SESSIONS
if (isset($_SESSION['logeado'])) {
    $email=$_SESSION['name'];
    $apellido=$_SESSION['apellido'];
    $rol= $_SESSION['rol'];
    $id= $_SESSION['id'];
    $letra_nombre =mb_substr($email, 0, 1);
    $letra_Apellido =mb_substr($apellido, 0, 1);

    $_SESSION['iniciales'] = $letra_nombre . $letra_Apellido;
  
    session_write_close();
} else {
    // Ya que el nombre no esta asignado en una session, el usuario no esta logeado
    // Y esta intentando ingresar sin autorizacion
    // Asi que limpiamos todas las variables de session y lo enviamos al login.
    session_unset();
    session_write_close();
    $url = "../Index.php?sesion=permisos";
    header("Location: $url");
}
?>
<?php include("../Configuration/Connector.php");
include("Metodos/Trae_datos_usuario.php");?>
<?php $PageTitle="Gestion de receptores";

function customPageHeader(){?>
  <!--Arbitrary HTML Tags-->
<?php }

if ($_SESSION['rol']== 2) {
    // si el rol almecenado en la variable SESSION es 1, quiere decir que el rol que posee es de administrador y como
    // este menu es unicamente para usuarios, debemos redireccionarlo al login
        session_unset();
        session_write_close();
        session_destroy();
        header('Location: ../Index.php?sesion=permisos');
    }else{
        include("Layouts/Cabecera_admin.php");
    }
    
?>

<?php
$txtNombreReceptor = (isset($_POST['txtNombreReceptor']))?$_POST['txtNombreReceptor']:"";
$txtApellidoReceptor = (isset($_POST['txtApellidoReceptor']))?$_POST['txtApellidoReceptor']:"";
$accion = (isset($_POST['accion']))?$_POST['accion']:"";
$txtID= (isset($_POST['txtID']))?$_POST['txtID']:"";

//usamos este switch para multiples casos
switch ($accion) {
    //en caso de que el valor del boton de id/name accion sea: 'agregar' que haga lo sgte.
    case 'guardar':
  // aplicamos un try catch que señala un bloque de instrucciones a intentar ( try ), y especifica una respuesta si se produce una excepción ( catch ).
         try {
           // intentamos preparar un consulta para traer los receptores, gracias a la variable conexion traida del conector.php encargada de realizar la conexion con la base de datos
            $sentenciaSQL=$conexion->prepare("INSERT INTO receptor (RECEPTOR_NOMBRE,RECEPTOR_APELLIDO) VALUES (:RECEPTOR_NOMBRE,:RECEPTOR_APELLIDO); ");
            //una vez preparada la consulta procedemos a asignar variables a la consulta
            $sentenciaSQL->bindParam(':RECEPTOR_NOMBRE',$txtNombreReceptor);
            $sentenciaSQL->bindParam(':RECEPTOR_APELLIDO',$txtApellidoReceptor);
            //ahora procedemos a ejecutar la consulta
            $sentenciaSQL->execute();
            // en caso de que todo salga bien llamamos un echo con el toastr que vendria siendo la ventanita verde que sale arriba.
          echo '<script>
          toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
          toastr.success("¡Receptor agregado correctamente!");
          setTimeout(() => {
          location.href = "Gestion_receptores.php";
          }, 3000);
          </script>';
  
         } catch (\Throwable $th) {
        // si tenemos algun problema al realziar la consulta hacemos un echo trayendo el toastr de error
          echo '<script>
          toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
          toastr.error("Ocurrio un error al agregar un receptor");
          setTimeout(() => {
          location.href = "Gestion_receptores.php";
          }, 3000);
          </script>';
         }
           
  
        break;
  
  }
?>

<?php
try {
    $sentenciaSQL=$conexion->prepare("SELECT RECEPTOR_ID, RECEPTOR_NOMBRE, RECEPTOR_APELLIDO FROM `receptor`
    WHERE RECEPTOR_FECHA_BAJA IS NULL;");
    $sentenciaSQL->execute();
    $listaReceptores=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
  } catch (\Throwable $th) {
    echo '<script>
    toastr.error("Ocurrio un error en la base de datos");
    setTimeout(() => {
    location.href = "Gestion_receptores.php";
    }, 3000);
    </script>';
  }


?>
    
<!-- incluimos la conexion con la bd  -->
<?php include("../Configuration/Connector.php");?>
  <!-- ---------------TOAST DE ERRORES  ------------------>
  <script>
		<?php if ($_GET["message"]=="exito") { ?>
		toastr.options =
		{
		  "closeButton" : true,
		  "progressBar" : true
		}
			  toastr.success("Editado con exito!");
			  setTimeout(() => {
        location.href = "Gestion_receptores.php";
        }, 1500);
              
                
		<?php }?>

        

		<?php if ($_GET["message"]=="error") { ?>
		toastr.options =
		{
		  "closeButton" : true,
		  "progressBar" : true
		}
			  toastr.error("Error al editar receptores!");
			  setTimeout(() => {
        location.href = "Gestion_receptores.php";
        }, 1500);
              
                
		<?php }?>

        <?php if ($_GET["message"]=="empty") { ?>
		toastr.options =
		{
		  "closeButton" : true,
		  "progressBar" : true
		}
			  toastr.warning("Campos vacios!");
			  setTimeout(() => {
        location.href = "Gestion_receptores.php";
        }, 1500);
              
                
		<?php }?>

	  </script>

      <script>

<?php if ($_GET["msg"]=="exito") { ?>
		toastr.options =
		{
		  "closeButton" : true,
		  "progressBar" : true
		}
			  toastr.success("Eliminado con exito!");
			  setTimeout(() => {
        location.href = "Gestion_receptores.php";
        }, 1500);
              
                
		<?php }?>


   <?php if ($_GET["msg"]=="error") { ?>
		toastr.options =
		{
		  "closeButton" : true,
		  "progressBar" : true
		}
			  toastr.error("Error al borrar receptor!");
			  setTimeout(() => {
        location.href = "Gestion_receptores.php";
        }, 1500);
              
                
		<?php }?>
      </script>
<!-- ---------------FIN TOAST DE ERRORES  ------------------>
<div class="row">
                      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Gestion de personal /</span> Gestion de receptores</h4>
                        <div class="col-12 col-lg-4 order-2 order-md-3 order-lg-2 mb-2">
                            <div class="card">
                                <div class="d-flex align-items-end row">      
                                    <div class="col-md-11">
                                            <div class="card-body">
                                                <h5 class="card-title text-primary">Gestion de receptores</h5>
                                                <h6 class="card-subtitle text-muted">Permite agregar/modificar/eliminar un receptores.</h6>
                                            </div>
                                        <div class="card-body">
                                            <form method="POST" enctype="multipart/form-data">

                                                <div class="mb-3">
                                                <label for="exampleFormControlSelect1" class="form-label">Ingrese nombre del receptor:</label>
                                                    <input type="text" required ="true" class="form-control"name="txtNombreReceptor" id="txtNombreReceptor" autocomplete="off" placeholder="Ingrese nombre del receptor"onkeydown="preventNumberInput(event)" onkeyup="preventNumberInput(event)">                                       
                                                </div>

                                                <div class="mb-3">
                                                <label for="exampleFormControlSelect1" class="form-label">Ingrese apellido del receptor:</label>
                                                    <input type="text" required ="true" class="form-control" name="txtApellidoReceptor" id="txtApellidoReceptor" autocomplete="off" placeholder="Ingrese apellido del receptor"onkeydown="preventNumberInput(event)" onkeyup="preventNumberInput(event)">                                       
                                                </div>

                                                <div class="row mb-3">
                                                <button type="submit" name="accion" value="guardar" class="btn rounded-pill btn-label-success" style="height: 60px;">Guardar</button>
                                                </div>
                                            </form>
                                         
                                        </div>
                                    </div>

                                    <div class="col-sm-5 text-center text-sm-left">                      
                                    </div>
                                </div>
                           </div>
                        </div>        


                        <div class="col-12 col-lg-6 order-2 order-md-3 order-lg-2 mb-2">
                            <div class="card">
                                <div class="d-flex align-items-end row">      
                                    <div class="col-md-11">
                                            <div class="card-body">
                                                <h5 class="card-title text-primary">Tabla de receptores</h5>
                                                <h6 class="card-subtitle text-muted">Muestra informacion de todos los receptores</h6>
                                            </div>
                                        <div class="card-body">
                                        <div class="table-responsive text-nowrap">
                                        <table class="table table-light" id="table">
                                           <thead class="thead-inverse">
                                                <tr>
                                                    <th hidden>ID</th>
                                                    <th>Nombre</th>                  
                                                    <th>Apellido</th>                                  
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($listaReceptores as $receptores){ ?>
                                                <tr>
                                                    <!-- mostramos el contenido de receptores junto con el dato entre corchetes para indicar que dato trar de la bd -->
                            
                                                    <td scope="row" hidden><?php echo $funcionarios['RECEPTOR_ID'];?></td>
                                                    <td><?php echo $receptores['RECEPTOR_NOMBRE'];?></td>   
                                                    <td><?php echo $receptores['RECEPTOR_APELLIDO'];?></td> 

                                                    <td>
                                                    <!-- Colocamos un link para dirigir a una pantalla modal con la id del receptor -->

                                                        <div class="row">
                                                            <div class="col-6">
                                                            <a href="#" data-bs-target="#edit_<?php echo $receptores['RECEPTOR_ID']; ?>" data-bs-toggle="modal" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-edit"></span> Editar</a>
                                                            </div>
                                                           <div class="col-6">
                                                           <a href="#" data-bs-target="#delete_<?php echo $receptores['RECEPTOR_ID']; ?>" data-bs-toggle="modal" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Borrar</a>
                                                           </div>
                                                    
                                                </div>
                                                    
                                                
                                                    </td>
                                                    <!-- incluimos la pantalla modal  -->
                                                    <?php include('Receptores/Modal_receptor.php'); ?>
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                         </table>
                                        </div>
                                        
                                         
                                        </div>
                                    </div>

                                    <div class="col-sm-5 text-center text-sm-left">                      
                                    </div>
                                </div>
                           </div>
                        </div>                
                    </div>
   <!-- script para los datatable -->
<script>
    var myTable = document.querySelector("#table");
    var dataTable = new DataTable(myTable,{
        perPage:6,
        perPageSelect:[3,6,9,12,1000]
    });

// or


</script>
<!-- Funcion para evitar que el se digiten numeros en el campo de texto del nombre del funcionario -->
<script>
function preventNumberInput(e){
    var keyCode = (e.keyCode ? e.keyCode : e.which);
    if (keyCode > 47 && keyCode < 58 || keyCode > 95 && keyCode < 107 ){
        e.preventDefault();
    }
}
</script>
<!-- incluimos el pie de pagina para no escribir codigo de mas -->                 
<?php 

//traemos el pie con el include
include("Layouts/Pie_admin.php");
?>