
<?php
try {


    $sentenciaSQL=$conexion->prepare("
    SELECT CONCAT(funcionario.FUNCIONARIO_NOMBRE,' ',funcionario.FUNCIONARIO_APELLIDO) as funcionario from funcionario
    inner JOIN cargo_funcionario on funcionario.CARGO_FUNC_ID = cargo_funcionario.CARGO_FUNC_ID
    WHERE cargo_funcionario.CARGO_FUNC_ID = :FUNCIONARIO AND funcionario.FUNCIONARIO_FECHA_BAJA IS NULL;");
    $sentenciaSQL->bindParam(":FUNCIONARIO",$id_cargo);
    $sentenciaSQL->execute();
    $listaFuncionarios=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
  } catch (\Throwable $th) {
    echo '<script>
    toastr.error("Ocurrio un error en la base de datos");
    setTimeout(() => {
    location.href = "Gestion_jueces.php";
    }, 3000);
    </script>';
  }
  ?>
<?php if ($listaFuncionarios){?>
<ul class="list-unstyled d-flex align-items-center avatar-group mb--1">
<?php foreach($listaFuncionarios as $funcionarios){ ?>
    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-sm pull-up" aria-label="<?php echo $funcionarios["funcionario"]?>" data-bs-original-title="<?php echo $funcionarios["funcionario"]?>">
        <img class="rounded-circle" src="../Assets/images/user.png" style="width: 50px;height:50px;margin-bottom: 5px;">
    </li>
<?php }?>

<?php }else{?>  

<?php }?>
</ul>