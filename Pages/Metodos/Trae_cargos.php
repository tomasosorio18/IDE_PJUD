<?php session_start();?>
<?php include("../../Configuration/Connector.php");?>
<?php


if(isset($_GET['selectJuez'])) {
        $selectJuez = $_GET['selectJuez'];
    try {
        $sentenciaSQL=$conexion->prepare(
        "SELECT cargo_juez.CARGO_JUEZ_NOMBRE, cargo_juez.CARGO_JUEZ_ID FROM cargo_juez INNER JOIN juez on cargo_juez.CARGO_JUEZ_ID = juez.CARGO_JUEZ_ID  WHERE JUEZ_ID = :JUEZ_ID");
        $sentenciaSQL->bindParam(':JUEZ_ID',$selectJuez,PDO::PARAM_INT);   
        $sentenciaSQL->execute();
        $juezCargo = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $juezCargoNombre = $juezCargo["CARGO_JUEZ_NOMBRE"];
        echo "<option value='$juezCargo[CARGO_JUEZ_ID]' >" . $juezCargo['CARGO_JUEZ_NOMBRE']."</option>";
} catch (\Throwable $th) {
        echo "2";
}

 }


 if(isset($_GET['txtSubrogante'])) {
        $selectFunc = $_GET['txtSubrogante'];
        try {
                $sentenciaSQL=$conexion->prepare(
                "SELECT cargo_funcionario.CARGO_FUNC_NOMBRE, cargo_funcionario.CARGO_FUNC_ID FROM cargo_funcionario 
                INNER JOIN funcionario on cargo_funcionario.CARGO_FUNC_ID = funcionario.CARGO_FUNC_ID  
                WHERE FUNCIONARIO_ID = :FUNCIONARIO_ID;");
                $sentenciaSQL->bindParam(':FUNCIONARIO_ID',$selectFunc,PDO::PARAM_INT);   
                $sentenciaSQL->execute();
                $subroganteCargo = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
                $subroganteCargoNombre = $subroganteCargo["CARGO_FUNC_NOMBRE"];
                echo "<option value='$subroganteCargo[CARGO_FUNC_ID]' >" . $subroganteCargo['CARGO_FUNC_NOMBRE']."</option>";
        } catch (\Throwable $th) {
                echo "2";
        }

    }

    if(isset($_GET['txtSubroganteMFE'])) {
        $selectMFE = $_GET['txtSubroganteMFE'];
        try {
                $sentenciaSQL=$conexion->prepare(
                "SELECT cargo_funcionario.CARGO_FUNC_NOMBRE, cargo_funcionario.CARGO_FUNC_ID FROM cargo_funcionario 
                INNER JOIN funcionario on cargo_funcionario.CARGO_FUNC_ID = funcionario.CARGO_FUNC_ID  
                WHERE FUNCIONARIO_ID = :FUNCIONARIO_ID;");
                $sentenciaSQL->bindParam(':FUNCIONARIO_ID',$selectMFE,PDO::PARAM_INT);   
                $sentenciaSQL->execute();
                $MFECargo = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
                $subroganteCargoNombre = $subroganteCargo["CARGO_FUNC_NOMBRE"];
                echo "<option value='$MFECargo[CARGO_FUNC_ID]' >" . $MFECargo['CARGO_FUNC_NOMBRE']."</option>";
        } catch (\Throwable $th) {
                echo "2";
        }

    }
?>