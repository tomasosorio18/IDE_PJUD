<?php
//se inicia la sesion
session_start();
//se pregunta si existe la variable 'logeado' en las SESSIONS
if (isset($_SESSION['logeado'])) {
    $id= $_SESSION['id'];
    $email=$_SESSION['name'];
    $apellido=$_SESSION['apellido'];
    $rol= $_SESSION['rol'];
    $letra_nombre =mb_substr($email, 0, 1);
    $letra_Apellido =mb_substr($apellido, 0, 1);
    $tribunal_id = $_SESSION['tribunal'];
    $tur_id = $_SESSION['tur_id'];
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
<?php
//incluimos la conexion con la bd 
include("../Configuration/Connector.php");
include("Metodos/Trae_datos_usuario.php");?>
<?php $PageTitle="Decretos";

function customPageHeader(){?>
  <!--Arbitrary HTML Tags-->
<?php }

if($_SESSION['rol'] == 1){
    include("Layouts/Cabecera_admin.php");}else{include("Layouts/Cabecera_user.php");}

?>
    



<!-- -----------------INICIO DATEPICKER SCRIPT-------------------------------- --> 
<script>
   $(function() {
    $("#datepicker").datepicker({
         currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        constrainInput: false
    });
});
  </script>


<script>
   $(function() {
    $("#datepicker1").datepicker({
         currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        constrainInput: false
    });
});
  </script>
  <script>
   $(function() {
    $("#datepicker2").datepicker({
         currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        constrainInput: false
    });
});
  </script>


  <script>
     $(function(){
    $("#firstDate").datepicker({
      currentText: 'Hoy',
      monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],	
      monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
      dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
      dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
      dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
				}); 
			$("#secondDate").datepicker({
            currentText: 'Hoy',
      monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],	
      monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
      dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
      dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
      dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
           onSelect: function () {
              myfunc();
      			}
				}); 
      
       function myfunc(){
       var start= $("#firstDate").datepicker("getDate");
    	var end= $("#secondDate").datepicker("getDate");
   		days = (end - start) / (1000 * 60 * 60 * 24);
      
       $('#days').val(Math.round(days + 1 ));
       }});
 
  </script>
<?php 
$año = date("Y");

$accion = (isset($_POST['accion']))?$_POST['accion']:"";
$decreto_tipo = (isset($_POST['selectDecreto']))?$_POST['selectDecreto']:"";
$txtdate = (isset($_POST['fecha']))?$_POST['fecha']:"";
$selectCargo = (isset($_POST['selectCargo']))?$_POST['selectCargo']:"";
$selectJuez = (isset($_POST['selectJuez']))?$_POST['selectJuez']:"";
$selectEstado= (isset($_POST['customRadioSvg']))?$_POST['customRadioSvg']:"";


//-----   Aca hacemos unas consultas a la bdd para traer toda la informacion necesario para los select/combobox -------------------->


$sentenciaSQL=$conexion->prepare("SELECT * FROM `juez` WHERE JUEZ_FECHA_BAJA IS NULL");
$sentenciaSQL->execute();
$listaJuez=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL=$conexion->prepare("SELECT * FROM `tipo_decreto`");
$sentenciaSQL->execute();
$listaDecreto=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL=$conexion->prepare("SELECT * FROM `funcionario` WHERE FUNCIONARIO_FECHA_BAJA IS NULL");
$sentenciaSQL->execute();
$listaFunc=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL=$conexion->prepare("SELECT * FROM `receptor` WHERE RECEPTOR_FECHA_BAJA IS NULL");
$sentenciaSQL->execute();
$listaReceptores=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL=$conexion->prepare("SELECT * FROM `cargo_subrogante`");
$sentenciaSQL->execute();
$listaCargos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- ------- cierre consultas  ------------------ -->

<!-- -----------------CIERRE DATEPICKER SCRIPT-------------------------------- --> 
                    <div class="row">
                      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Decretos /</span> Diseño de decretos</h4>
                        <div class="col-12 col-lg-4 order-2 order-md-3 order-lg-2 mb-2">
                            <div class="card">
                                <div class="d-flex align-items-end row">      
                                    <div class="col-md-11">
                                           <div class="card-header d-flex justify-content-between">
                                              <div class="card-title mb-0">
                                                 <h5 class="card-title text-primary">Diseño de decretos economicos</h5>
                                                 <h6 class="card-subtitle text-muted">Permite generar un decreto economico reservado.</h6>
                                              </div>
                                           </div>

                                        <div class="card-body">
                                            <form method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                                                <div class="mb-3">
                                                <label for="exampleFormControlSelect1" class="form-label">FECHA:</label>
                                                    <input type="text" required ="true" class="form-control" id="datepicker" name="fecha" autocomplete="off" placeholder="Seleccione fecha">                                       
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlSelect1" class="form-label">FIRMA:</label>
  
                                                    <select class="form-select" name="selectJuez" id="selectJuez" required>
                                                    <?php foreach($listaJuez as $jueces) { ?>
                                                    <option value="none" selected disabled hidden>Seleccione un juez</option>
                                                    <option value='<?php echo $jueces["JUEZ_ID"]?> '><?=$jueces["JUEZ_NOMBRE"]. " ". $jueces["JUEZ_APELLIDO"] ?></option> 
                                                    <?php }?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlSelect1" class="form-label">CARGO:</label>

                                                    <div class="position-relative">
                                                        <select name="selectCargoVista" id="selectCargoVista" class="select2 form-select select2-hidden-accessible" disabled data-select2-id="select2Disabled" tabindex="-1" aria-hidden="true" style="cursor: not-allowed;">
                                                        <option value="none" selected disabled hidden>Seleccione un juez para visualizar su cargo</option>
                                                        </select>
                                                        <select name="selectCargo" id="selectCargo" class="select2 form-select select2-hidden-accessible" hidden data-select2-id="select2Disabled" tabindex="-1" aria-hidden="true" style="cursor: not-allowed;">
                                                        <option value="none" selected disabled hidden>Seleccione un juez para visualizar su cargo</option>
                                                        </select>
                                                    </div>
                                                      
          

                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlSelect1" class="form-label">TIPO DECRETO:</label>
  
                                                    <select class="form-select" name="selectDecreto" id="selectDecreto" required>
                                                    <?php foreach($listaDecreto as $tipodecreto) { ?>
                                                        <option value="none" selected disabled hidden>Seleccione un tipo de decreto</option>
                                                        <option value='<?php echo $tipodecreto["DECRETO_TIPO_ID"] ?> '><?=$tipodecreto["DECRETO_TIPO_NOMBRE"]?></option> 
                                                    <?php }?>
                                                    </select>
                                                </div>

                                              <!-- Preguntamos si se posee un rol de administrador -->
                                                <?php if ($_SESSION['rol'] == 1) {?>
                                                      

                                                    <div class="row">
                                                        <div class="col-md mb-md-0 mb-2">
                                                            <div class="form-check custom-option custom-option-icon">
                                                            <label class="form-check-label custom-option-content" for="customRadioSvg1">
                                                                <span class="custom-option-body">
                                                                <div class="avatar avatar-md border-5 border-light-warning rounded-circle mx-auto mb-2" style="height: 50px; width: 50px;">
                                                                <span class="avatar-initial rounded-circle bg-label-warning"><i class="fa-duotone fa-file-lock fa-beat" style="--fa-primary-color: #ffcd1a; --fa-secondary-color: #ffcd1a;"></i></span>
                                                                </div> 
                                                                <span class="custom-option-title"> Reservado </span>
                                                                <small> Visibile para usuarios con un rol avanzado </small>
                                                                </span>
                                                                <input name="customRadioSvg" class="form-check-input" type="radio" value="Privado" id="customRadioSvg1">
                                                            </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md">
                                                            <div class="form-check custom-option custom-option-icon">
                                                            <label class="form-check-label custom-option-content" for="customRadioSvg2">
                                                                <span class="custom-option-body">
                                                                <div class="avatar avatar-md border-5 border-light-info rounded-circle mx-auto mb-2" style="height: 50px; width: 50px;">
                                                                <span class="avatar-initial rounded-circle bg-label-info"><i class="fa-duotone fa-file-powerpoint fa-beat" style="--fa-primary-color: #4482ee; --fa-secondary-color: #4482ee;"></i></span>
                                                                </div>
                                                                <span class="custom-option-title"> Público </span>
                                                                <small>Visible para todo tipo de usuarios</small>
                                                                </span>
                                                                <input name="customRadioSvg" class="form-check-input" type="radio" value="Publico" id="customRadioSvg2">
                                                            </label>
                                                            </div>
                                                        </div>
                                                    </div>


                                                <?php } else {?>

                                                    <div class="col-md">
                                                            <div class="form-check custom-option custom-option-icon checked">
                                                            <label class="form-check-label custom-option-content" for="customRadioSvg2">
                                                                <span class="custom-option-body">
                                                                <div class="avatar avatar-md border-5 border-light-info rounded-circle mx-auto mb-2" style="height: 50px; width: 50px;">
                                                                <span class="avatar-initial rounded-circle bg-label-info"><i class="fa-duotone fa-file-powerpoint fa-beat" style="--fa-primary-color: #4482ee; --fa-secondary-color: #4482ee;"></i></span>
                                                                </div>
                                                                <span class="custom-option-title"> Público </span>
                                                                <small>Visible para todo tipo de usuarios</small>
                                                                </span>
                                                                <input name="customRadioSvg" class="form-check-input" type="radio" value="Publico" id="customRadioSvg2">
                                                            </label>
                                                            </div>
                                                        </div>

                                                    <?php }?>


<br>
                                                <div class="row mb-3">
                                                <button name="accion" value="agregar" type="submit" class="btn rounded-pill btn-label-info" style="height: 60px;" >Continuar</button>
                                                </div>
                                            </form>
                                         
                                        </div>
                                    </div>

                                    <div class="col-sm-5 text-center text-sm-left">                      
                                    </div>
                                </div>
                           </div>
                        </div>    
                        
                        <?php include("Decretos/Modal_feriados.php");?>
                        <?php include("Decretos/Modal_permisos.php");?>
                        <?php include("Decretos/Modal_receptores.php");?>
                        <?php include("Decretos/Modal_licencias.php");?> 
                        <?php include("Decretos/Modal_ps.php");?> 
                        <?php include("Decretos/Modal_ls.php");?> 
                        <?php include("Decretos/Modal_otros.php");?> 
                        <?php include("Decretos/Modal_designacion.php");?> 
                        <?php include("Decretos/Modal_mesa-ayuda.php");?> 
                        <?php include("Decretos/Modal_curso-academia.php");?> 
                        <?php include("Decretos/Modal_fs.php");?> 
                        <?php 
                        
                            if(isset($_POST['accion'])){   
                        switch ($decreto_tipo) {
                            case 1: include("Decretos/Feriados.php");
                            break;
                            case 2: include("Decretos/Licencias.php");
                            break;
                            case 3: include("Decretos/Receptores.php");
                            break;
                            case 4: include("Decretos/Permisos.php");
                            break;
                            case 5: include("Decretos/Permisos-Subrogacion.php");
                            break;
                            case 6: include("Decretos/Licencias-Subrogacion.php");
                            break;
                            case 7: include("Decretos/Otros.php");
                            break;
                            case 8: include("Decretos/Designacion.php");
                            break;
                            case 9: include("Decretos/Mesa-ayuda.php");
                            break;
                            case 10: include("Decretos/Curso-Academia.php");
                            break;
                            case 11: include("Decretos/Feriados-Subrogacion.php");
                            break;
                                ?>
                               
                                <?php }
                                }?>

                    </div>



                    <script>
  function validateForm() {    
  if (document.getElementById('selectJuez').value== "none")
  {
    toastr.options =
                    {
                    "closeButton" : true,
                    "progressBar" : true
                    }
                toastr.error("¡Seleccione un juez!");
                
      document.getElementById('selectJuez').style.borderColor = "red"; 
      return false; 
  }else{
   document.getElementById('selectJuez').style.borderColor = ""; 
  }
  if(document.getElementById('selectCargo').value== "none"){
   toastr.options =
                    {
                    "closeButton" : true,
                    "progressBar" : true
                    }
                toastr.error("¡Seleccione un cargo!");
                
      document.getElementById('selectCargo').style.borderColor = "red"; 
      return false; 


  }else{
   document.getElementById('selectCargo').style.borderColor = ""; 
  }
  
  if(document.getElementById('selectDecreto').value== "none"){
   toastr.options =
                    {
                    "closeButton" : true,
                    "progressBar" : true
                    }
                toastr.error("¡Seleccione un tipo de decreto!");
                
      document.getElementById('selectDecreto').style.borderColor = "red"; 
      return false; 


  }else{
   document.getElementById('selectDecreto').style.borderColor = ""; 
  } 
  const radios = document.querySelectorAll('input[name="customRadioSvg"]');
    let algunoSeleccionado = false;

    radios.forEach(radio => {
        if (radio.checked) {
            algunoSeleccionado = true;
        }
    });

    if (!algunoSeleccionado) {
        toastr.options =
                    {
                    "closeButton" : true,
                    "progressBar" : true
                    }
                toastr.error("¡Seleccione un estado de decreto!");
        return false;
    }
    return true; // Si todo está bien, permite enviar el formulario
 
}
</script> 

<script>
    document.querySelectorAll('input[name="customRadioSvg"]').forEach(radio => {
    radio.addEventListener('change', function() {
        if (this.checked) {
            // Elimina la clase "checked" de todos los elementos
            document.querySelectorAll('.custom-option').forEach(option => {
                option.classList.remove('checked');
            });

            // Agrega la clase "checked" al elemento padre del radio seleccionado
            this.closest('.custom-option').classList.add('checked');
        }
    });
});
</script>

<script src="../Assets/js/traeCargos.js"></script>
<?php 
//traemos el pie con el include
if($_SESSION['rol'] == 1){
    include("Layouts/Pie_admin.php");}else{include("Layouts/Pie_user.php");}

?>