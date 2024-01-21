<?php
	session_start();
	include_once('../../Configuration/Connector.php');

	if(isset($_GET['id'])){

   
        $fecha = date("y-m-d");

		try{
			$sentenciaSQL=$conexion->prepare ("UPDATE receptor SET RECEPTOR_FECHA_BAJA='$fecha' WHERE RECEPTOR_ID = '".$_GET['id']."'");
			//if-else statement in executing our query
			if( $sentenciaSQL->execute() ){
				$msg ="exito";
			}else{
				$msg ="error";
			}
		}
		catch(PDOException $e){
			$msg ="error";
		}

		//Cerrar conexión
	

	}
	else{
		$msg ="empty";
	}

	header('location: ../Gestion_receptores.php?msg='.$msg);

?>