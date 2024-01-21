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
    
<!-- incluimos la conexion con la bd  -->
<?php
//incluimos la conexion con la bd 
include("../Configuration/Connector.php");
include("Metodos/Trae_datos_usuario.php");?>


<?php $PageTitle="Modificar decretos";

function customPageHeader(){?>
  <!--Arbitrary HTML Tags-->
<?php }

if($_SESSION['rol'] == 1){
    include("Layouts/Cabecera_admin.php");}else{include("Layouts/Cabecera_user.php");}

?>

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
$anio = date("Y");

if($_SESSION['rol'] == 1){
    $sentenciaSQL=$conexion->prepare("SELECT DECRETO_N_CORRELATIVO FROM decreto WHERE decreto.DECRETO_ANIO = :DECRETO_ANIO  AND NOT DECRETO_DETALLE = 'ANULADO' order by DECRETO_N_CORRELATIVO asc");
    $sentenciaSQL->bindParam(":DECRETO_ANIO",$anio);
    $sentenciaSQL->execute();
    $listadecretos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC); 

}else{
    $sentenciaSQL=$conexion->prepare("SELECT DECRETO_N_CORRELATIVO FROM decreto WHERE decreto.DECRETO_ANIO = :DECRETO_ANIO  AND NOT DECRETO_DETALLE = 'ANULADO' AND NOT decreto.DECRETO_ESTADO= 'Reservado' order by DECRETO_N_CORRELATIVO asc");
    $sentenciaSQL->bindParam(":DECRETO_ANIO",$anio);
    $sentenciaSQL->execute();
    $listadecretos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);   
}



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




<div class="row">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Decretos /</span> Modificar decretos</h4>
    <div class="col-12 col-lg-6 order-2 order-md-3 order-lg-2 mb-2">
        <div class="card">
            <div class="d-flex align-items-end row">      
                <div class="col-md-11">
                    <div class="card-header d-flex justify-content-between">
                        <div class="card-title mb-0">
                            <h5 class="card-title text-primary">Modificar decretos </h5>
                            <h6 class="card-subtitle text-muted">Permite modificar algun decreto ya emitido no anulado.</h6>
                        </div>
                    </div>

                    <div class="card-body">
                                                <form method="POST" onsubmit="return validateForm()">
                                                    <div class="mb-3">
                                                    <label for="exampleFormControlSelect1" class="form-label">¿Que decreto desea modificar?</label>
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
                        
                            if(isset($_POST['btnDecreto'])){ 
                                $decreto = $_POST['selectdecreto'];
                                $año = Date("Y");
                                $sentenciaSQL=$conexion->prepare("SELECT tipo_decreto.DECRETO_TIPO_ID,tipo_decreto.DECRETO_TIPO_NOMBRE,decreto.DECRETO_FECHA_EMISION,decreto.ADJUNTO_FIRMA_ID,decreto.DECRETO_DETALLE FROM decreto INNER JOIN tipo_decreto on decreto.DECRETO_TIPO_ID = tipo_decreto.DECRETO_TIPO_ID WHERE decreto.DECRETO_N_CORRELATIVO = :DECRETO_N_CORRELATIVO AND decreto.DECRETO_ANIO = :ANIO order by decreto.DECRETO_N_CORRELATIVO asc;");
                                $sentenciaSQL->bindParam(":DECRETO_N_CORRELATIVO",$decreto);
                                $sentenciaSQL->bindParam(":ANIO",$anio);
                                $sentenciaSQL->execute();
                                $listadecretos=$sentenciaSQL->fetch(PDO::FETCH_LAZY);   
                                $decretotipo = $listadecretos['DECRETO_TIPO_ID'];

                                include("Decretos/Modificar/Modal_modifica/MModal_feriados.php");
                                include("Decretos/Modificar/Modal_modifica/MModal_permisos.php");
                                include("Decretos/Modificar/Modal_modifica/MModal_receptores.php");
                                include("Decretos/Modificar/Modal_modifica/MModal_licencias.php");
                                include("Decretos/Modificar/Modal_modifica/MModal_ps.php");
                                include("Decretos/Modificar/Modal_modifica/MModal_ls.php");
                                include("Decretos/Modificar/Modal_modifica/MModal_otros.php");
                                include("Decretos/Modificar/Modal_modifica/MModal_designacion.php");
                                include("Decretos/Modificar/Modal_modifica/MModal_mesa-ayuda.php");
                                include("Decretos/Modificar/Modal_modifica/MModal_curso-academia.php");
                                include("Decretos/Modificar/Modal_modifica/MModal_fs.php"); 
                                
                        switch ($decretotipo) {
                            case 1: include("Decretos/Modificar/MFeriados.php");
                            break;
                            case 2: include("Decretos/Modificar/MLicencias.php");
                            break;
                            case 3: include("Decretos/Modificar/MReceptores.php");
                            break;
                            case 4: include("Decretos/Modificar/MPermisos.php");
                            break;
                            case 5: include("Decretos/Modificar/MPermisos-Subrogacion.php");
                            break;
                            case 6: include("Decretos/Modificar/MLicencias-Subrogacion.php");
                            break;
                            case 7: include("Decretos/Modificar/MOtros.php");
                            break;
                            case 8: include("Decretos/Modificar/MDesignacion.php");
                            break;
                            case 9: include("Decretos/Modificar/MMesa-ayuda.php");
                            break;
                            case 10: include("Decretos/Modificar/MCurso-Academia.php");
                            break;
                            case 11: include("Decretos/Modificar/MFeriados_Subrogacion.php");
                            break;
                                ?>
                               
                                <?php }
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


<script>
  function validateForm2() {  
    event.preventDefault();   
  }
</script> 









<script src="../Assets/js/traeCargos.js"></script>


<?php if($_SESSION['rol'] == 1){
include("Layouts/Pie_admin.php");}else{include("Layouts/Pie_user.php");}
?>