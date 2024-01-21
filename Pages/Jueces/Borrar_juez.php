<?php
	session_start();
	include_once('../../Configuration/Connector.php');

	if(isset($_GET['id'])){

   
    

		try{
			$fecha = date('y-m-d');
			$idjuez= $_GET['id'];
			$sentenciaSQL=$conexion->prepare ("UPDATE juez SET JUEZ_FECHA_BAJA = :FECHA_BAJA WHERE JUEZ_ID = :ID;");
			$sentenciaSQL->bindParam(':FECHA_BAJA',$fecha);
			$sentenciaSQL->bindParam(":ID",$idjuez);
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
		$msg="empty";
	}

	header('location: ../Gestion_jueces.php?msg='.$msg);

?>