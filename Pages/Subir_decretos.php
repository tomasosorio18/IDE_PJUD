<?php
//se inicia la sesion
session_start();
//se pregunta si existe la variable 'logeado' en las SESSIONS
if (isset($_SESSION['logeado'])) {
    $email=$_SESSION['name'];
    $id=$_SESSION['id'];
    $apellido=$_SESSION['apellido'];
    $rol= $_SESSION['rol'];
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
    
<!-- incluimos la conexion con la bd  -->
<?php
//incluimos la conexion con la bd 
include("../Configuration/Connector.php");
include("Metodos/Trae_datos_usuario.php");?>


<?php $PageTitle="Subir decretos";

function customPageHeader(){?>
  <!--Arbitrary HTML Tags-->
<?php }

if($_SESSION['rol'] == 1){
    include("Layouts/Cabecera_admin.php");}else{include("Layouts/Cabecera_user.php");}

?>



<?php 
$anio = date("Y");

if($_SESSION['rol'] == 1){
    $sentenciaSQL=$conexion->prepare("SELECT DECRETO_N_CORRELATIVO FROM decreto WHERE decreto.DECRETO_ANIO = :DECRETO_ANIO  AND NOT DECRETO_DETALLE = 'ANULADO' order by DECRETO_N_CORRELATIVO asc");
    $sentenciaSQL->bindParam(":DECRETO_ANIO",$anio);
    $sentenciaSQL->execute();
    $listadecretos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC); 
}else{
    $sentenciaSQL=$conexion->prepare("SELECT DECRETO_N_CORRELATIVO FROM decreto WHERE decreto.DECRETO_ANIO = :DECRETO_ANIO  AND NOT DECRETO_DETALLE = 'ANULADO' AND NOT decreto.DECRETO_ESTADO = 'Reservado' order by DECRETO_N_CORRELATIVO asc");
    $sentenciaSQL->bindParam(":DECRETO_ANIO",$anio);
    $sentenciaSQL->execute();
    $listadecretos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC); 
    }
  ?>

<?php include("Metodos/Sube_Archivo.php");?>

<div class="row">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Decretos /</span> Subir decretos</h4>
    <div class="col-12 col-lg-6 order-2 order-md-3 order-lg-2 mb-2">
        <div class="card">
            <div class="d-flex align-items-end row">      
                <div class="col-md-11">
                    <div class="card-header d-flex justify-content-between">
                        <div class="card-title mb-0">
                            <h5 class="card-title text-primary">Subir decretos economicos</h5>
                            <h6 class="card-subtitle text-muted">Permite subir un decreto firmado.</h6>
                        </div>
                    </div>

                    <div class="card-body">
                                                <form method="POST" onsubmit="return validateForm()">

                                                    <div class="mb-3">
                                                    <label for="exampleFormControlSelect1" class="form-label">¿A que decreto desea adjuntar un archivo?</label>
                                                        <select class="form-select" id="selectdecreto" name="selectdecreto" required>
                                                        <?php 
                                                        if($listadecretos){
                                                        foreach($listadecretos as $decretos) { ?>
                                                            <option value="none" selected disabled hidden>Seleccione un decreto</option>
                                                            <option value='<?php echo $decretos["DECRETO_N_CORRELATIVO"] ?> '><?="Decreto N°: " . $decretos["DECRETO_N_CORRELATIVO"]?></option> 
                                                        <?php }
                                                        }else{
                                                        ?> <option value='none'><?php echo "No hay decretos en el año correspondiente";?></option> <?php   
                                                        }?>
                                                        </select>                                       
                                                    </div>

                                                    <div class="row mb-3">
                                                    <button type="submit" id="btnDecreto" name="btnDecreto" class="btn rounded-pill btn-label-info" style="height: 60px;"><i class="fa-solid fa-scale-balanced" style="margin-right:5px"></i> Seleccionar decreto </button>
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
if (isset($_POST['selectdecreto']) || isset($_GET['correlativo'])) {
  // Si el valor del input se envió a través del formulario, utilízalo.
  if (isset($_POST['selectdecreto']) && !empty($_POST['selectdecreto'])) {
    $selectdecreto = $_POST['selectdecreto'];
  } elseif (isset($_GET['correlativo']) && !empty($_GET['correlativo'])) {
      // Si no se envió el input pero hay un valor GET, utilízalo.
      $selectdecreto = $_GET['correlativo'];
  } else {
    $selectdecreto = ""; // Define un valor por defecto si es necesario.
  }

  include("Metodos/Obtiene_decretos-detalle.php");
}?>

<script>
  function validateForm() {    
  if (document.getElementById('selectdecreto').value== "none")
  {
    toastr.options =
                    {
                    "closeButton" : true,
                    "progressBar" : true
                    }
                toastr.error("¡Seleccione un decreto!");    
      document.getElementById('selectdecreto').style.borderColor = "red"; 
      return false; 
  }    
}
</script> 














<?php if($_SESSION['rol'] == 1){
include("Layouts/Pie_admin.php");}else{include("Layouts/Pie_user.php");}
?>