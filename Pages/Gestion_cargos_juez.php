<?php
//se inicia la sesion
session_start();
//se pregunta si existe la variable 'logeado' en las SESSIONS
if (isset($_SESSION['logeado'])) {
    $email=$_SESSION['name'];
    $apellido=$_SESSION['apellido'];
    $rol= $_SESSION['rol'];
    $letra_nombre =mb_substr($email, 0, 1);
    $letra_Apellido =mb_substr($apellido, 0, 1);
    $id=$_SESSION['id'];
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
<?php $PageTitle="Gestion de cargos de jueces";

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

try {
    $sentenciaSQL=$conexion->prepare("SELECT cargo_juez.CARGO_JUEZ_NOMBRE, COUNT(juez.CARGO_JUEZ_ID) as cantidad, cargo_juez.CARGO_JUEZ_ID AS cargoid 
    FROM cargo_juez
    LEFT JOIN juez ON juez.CARGO_JUEZ_ID = cargo_juez.CARGO_JUEZ_ID
    WHERE juez.JUEZ_FECHA_BAJA IS NULL AND cargo_juez.CARGO_FECHA_BAJA IS NULL
    GROUP BY cargo_juez.CARGO_JUEZ_NOMBRE, cargo_juez.CARGO_JUEZ_ID
    ORDER BY cantidad DESC;");
    $sentenciaSQL->execute();
    $listaCargos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
} catch (\Throwable $th) {
    echo '<script>
    toastr.error("Ocurrio un error en la base de datos");
    setTimeout(() => {
    location.href = "Gestion_jueces.php";
    }, 3000);
    </script>';
}

?>

<!-- incluimos la conexion con la bd  -->
<?php include("../Configuration/Connector.php");?>
<?php include("Modales_general/Modal_agrega_cargo_juez.php");?>
<?php include("Modales_general/Modal_exito.php");?>



<div class="row">
                      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Gestion de cargos /</span> Gestion de cargos de jueces</h4>

                      <?php foreach($listaCargos as $cargos){ ?>
                        <div class="col-12 col-lg-4 order-2 order-md-3 order-lg-2 mb-2">
                            <div class="card" style="word-wrap: break-word;">
                                <div class="d-flex align-items-end row">      
                                    <div class="col-md-11">
                                            <div class="card-body">
                                                <h5 class="card-title text-primary"><?php echo $cargos["CARGO_JUEZ_NOMBRE"];?></h5>
                                                 <div class="d-flex align-items-center justify-content-between mb-2"> 
                                                 <h6 class="card-subtitle text-muted">Actualmente con <?php echo $cargos['cantidad'] . " miembro(s)."; ?></h6>
                                                      <?php $id_cargo = $cargos["cargoid"];?>
                                                     <?php include("Metodos/Trae_juez_por_cargo.php"); ?>
                                                </div>
                                                </div>
                                        <div class="card-body">
                                        <input type="hidden" id="cargo_nombre" value="<?php echo $cargos["CARGO_JUEZ_NOMBRE"];?>">
                                        <span class="badge rounded-pill bg-label-warning mb-1" style="text-align: center;white-space: pre-wrap;line-height: 1.5;">Para dar de baja un cargo asegurese de que el cargo no tenga miembros activos.</span> <span class="badge rounded-pill bg-label-danger mb-5"style="text-align: center;white-space: pre-wrap;line-height: 1.5;"><b>¡De lo contrario, se dara de baja el o los jueces pertenecientes!</b> </span>
                                        <div style="display: flex; justify-content: center;">
                                        <button type="button" class="btn rounded-pill btn-label-info" data-bs-target="#myModal-info_<?php echo $cargos["cargoid"];?>" data-bs-toggle="modal" style="height: 60px;"><i class="fa-solid fa-pen-to-square fa-beat fa-2xl"style="margin-right: 5px;"></i>Editar cargo</button>  
                                        <button type="button" class="btn rounded-pill btn-label-danger" data-bs-target="#myModal-danger_<?php echo $cargos["cargoid"];?>" data-bs-toggle="modal" style="height: 60px;"><i class="fa-solid fa-trash fa-beat fa-lg" style="margin-right: 5px;"></i>Dar de baja</button>                                                                     
                                        </div>  
                                         </div>
                                    </div>

                                    <div class="col-sm-5 text-center text-sm-left">                      
                                    </div>
                                </div>
                                <?php include("Modales_general/Modal_edita_cargo_juez.php");?> 
                                <?php include("Modales_general/Modal_borra_cargo_juez.php");?> 
                           </div>
                        </div>  
                        
                    
                        <?php } ?>



                        <div class="col-12 col-lg-4 order-2 order-md-3 order-lg-2 mb-2">
                            <div class="card" style="word-wrap: break-word;">
                                <div class="d-flex align-items-end row">      
                                    <div class="col-md-11">
                                            <div class="card-body">
                                                <h5 class="card-title text-primary">¡Agrega un cargo nuevo!</h5>
                                                <h6 class="card-subtitle text-muted">¡Presiona el boton de abajo para agregar un cargo de juez nuevo!</h6>
                                                </div>
                                        <div class="card-body">
                                         
                                           <div style="display: flex; justify-content: center;">  
                                            <button type="button" id="btnAñade_cargo" name="btnAñade_cargo" data-bs-target="#myModal-primary" data-bs-toggle="modal" class="btn rounded-pill btn-label-primary"style="height: 60px;"><i class="fa-solid fa-plus fa-beat fa-lg" style="margin-right: 5px;"></i>Agregar cargo nuevo</button>  
                                           </div>
                                                                     
                                        </div>
                                    </div>

                                    <div class="col-sm-5 text-center text-sm-left">                      
                                    </div>
                                </div>
                           </div>
                        </div>  
                    </div>
<script src="../Assets/js/cargo_juez/modificaCargoJuez.js"></script>   
<script src="../Assets/js/cargo_juez/borraCargoJuez.js"></script>                   
<!-- Funcion para evitar que el se digiten numeros en el campo de texto del nombre del juez -->
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