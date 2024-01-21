<?php
//se inicia la sesion
session_start();
//se pregunta si existe la variable 'logeado' en las SESSIONS
if (isset($_SESSION['logeado'])) {
    $id=$_SESSION['id'];
    $email=$_SESSION['name'];
    $apellido=$_SESSION['apellido'];
    $rol= $_SESSION['rol'];
    $letra_nombre =mb_substr($email, 0, 1);
    $letra_Apellido =mb_substr($apellido, 0, 1);
    $tribunal_id = $_SESSION['tribunal'];
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
    exit;
}

if ($_SESSION['rol']== 1) {
    // si el rol almecenado en la variable SESSION es 2, quiere decir que el rol que posee es de usuario y como
    // este menu es unicamente para administrador, debemos redireccionarlo al login
        session_unset();
        session_write_close();
        session_destroy();
        header('Location: ../index.php?sesion=permisos');
    }
?>



<!-- Asignamos el valor de la variable POST,que trae la informacion del selectbox del año  -->
<?php $selectAño = (isset($_POST['selectAño']))?$_POST['selectAño']:""; ?>

<!-- incluimos la conexion con la bd  -->
<?php
//incluimos la conexion con la bd 
include("../Configuration/Connector.php");
include("Metodos/Trae_datos_usuario.php");?>

<?php include ("Metodos/Descarga_Archivo.php");?>
<!-- incluimos el php de VisualizaArchivo  -->
<?php include ("Metodos/Visualiza_Archivo.php");?> 


<?php $PageTitle="Informe de decretos";

function customPageHeader(){?>
  <!--Arbitrary HTML Tags-->
<?php }

if($_SESSION['rol'] == 1){
    include("Layouts/Cabecera_admin.php");}else{include("Layouts/Cabecera_user.php");}

?>
<?php include ("Metodos/Elimina_Archivo.php");?>
<!-- incluimos el php de anula_decreto  -->
<?php include ("Metodos/Anula_decreto.php");?>


<?php 
//traemos el año actual
$año = date("Y");
//traemos los años disponibles en los decretos para rellenar el select
$sentenciaSQL=$conexion->prepare("SELECT DECRETO_ANIO from decreto GROUP BY DECRETO_ANIO;");
$sentenciaSQL->execute();
$listaAno= $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>  

                    <div class="row">
                      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Decretos /</span> Informe de decretos</h4>
                        <div class="col-12 col-lg-6 order-2 order-md-3 order-lg-2 mb-2">
                            <div class="card card-action">
                                <div class="d-flex align-items-end row">      
                                    <div class="col-md-11">
                                            <div class="card-header d-flex justify-content-between">
                                            <div class="card-title mb-0">
                                                 <h5 class="card-title text-primary">Informe de decretos</h5>
                                                 <h6 class="card-subtitle text-muted">Muestra un informe completo de todos los decretos generados segun el año seleccionado.</h6>
                                              </div>
                                            </div>
                                        <div class="card-body">
                                            <form method="POST" onsubmit="return validateForm()">

                                                <div class="mb-3">
                                                  <label for="exampleFormControlSelect1" class="form-label">Seleccione un año para filtrar</label>
                                                    <select class="form-select" id="selectAño" name="selectAño" required>
                                                    <?php 
                                                    if($listaAno){
                                                    foreach($listaAno as $anos) { ?>
                                                        <option value="none" selected disabled hidden>Seleccione un año</option>
                                                        <option value='<?php echo $anos["DECRETO_ANIO"] ?> '><?=$anos["DECRETO_ANIO"]?></option> 
                                                    <?php }
                                                    }else{
                                                     ?> <option value='none'><?php echo "No hay decretos en el año correspondiente";?></option> <?php   
                                                    }?>
                                                    </select>                                       
                                                </div>

                                                <div class="row mb-3">
                                                <button type="submit" id="btnAño" name="btnAño" class="btn rounded-pill btn-label-info" style="height: 60px;"><i class="fa-regular fa-calendar-days"style="margin-right:5px"></i> Seleccionar año </button>
                                                </div>

                                            </form>
                                         
                                        </div>
                                    </div>

                                    <div class="col-sm-5 text-center text-sm-left">                      
                                    </div>
                                </div>
                           </div>
                        </div>    
                    </div>
<?php 
                  
                  if(isset($_POST['btnAño'])){                  
                  
                  include("Metodos/Obtiene_decretos_basico.php");
                  
                  
                  
                  }                 
?>








<script>
  function validateForm() {    
  if (document.getElementById('selectAño').value== "none")
  {
    toastr.options =
                    {
                    "closeButton" : true,
                    "progressBar" : true
                    }
                toastr.error("¡Seleccione un año!");    
      document.getElementById('selectAño').style.borderColor = "red"; 
      return false; 
  }    
}
</script> 
<script>
$(document).ready(function(){
$('#table').DataTable({
    dom: 'lrtip',
    "language": {
        "decimal": ",",
        "thousands": ".",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoPostFix": "",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "loadingRecords": "Cargando...",
        "lengthMenu": "Mostrar _MENU_ registros",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
        },
        "processing": "Procesando...",
        "search": "Buscar:",
        "searchPlaceholder": "Término de búsqueda",
        "zeroRecords": "No se encontraron resultados",
        "emptyTable": "Ningún dato disponible en esta tabla",
    }  
});
});	
</script>
<?php 
//traemos el pie con el include
include("Layouts/Pie_user.php");
?>