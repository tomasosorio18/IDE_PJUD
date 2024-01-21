
<?php
try {


    $sentenciaSQL=$conexion->prepare("
    SELECT CONCAT(juez.JUEZ_NOMBRE,' ',juez.JUEZ_APELLIDO) as juez from juez
    inner JOIN cargo_juez on juez.CARGO_JUEZ_ID = cargo_juez.CARGO_JUEZ_ID
    WHERE cargo_juez.CARGO_JUEZ_ID = :JUEZ AND juez.JUEZ_FECHA_BAJA IS NULL;");
    $sentenciaSQL->bindParam(":JUEZ",$id_cargo);
    $sentenciaSQL->execute();
    $listaJueces=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
  } catch (\Throwable $th) {
    echo '<script>
    toastr.error("Ocurrio un error en la base de datos");
    setTimeout(() => {
    location.href = "Gestion_jueces.php";
    }, 3000);
    </script>';
  }
  ?>
<?php if ($listaJueces){?>
<ul class="list-unstyled d-flex align-items-center avatar-group mb--1">
<?php foreach($listaJueces as $jueces){ ?>
    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-sm pull-up" aria-label="<?php echo $jueces["juez"]?>" data-bs-original-title="<?php echo $jueces["juez"]?>">
        <img class="rounded-circle" src="../Assets/images/user.png" style="width: 50px;height:50px;margin-bottom: 5px;">
    </li>
<?php }?>

<?php }else{?>  

<?php }?>
</ul>