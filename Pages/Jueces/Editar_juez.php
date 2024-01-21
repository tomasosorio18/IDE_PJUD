<?php 
	session_start();
	include_once('../../Configuration/Connector.php'); 

	if(isset($_POST['editar']) and $_POST['apellido'] != "" and $_POST['nombre'] != ""){
	
		try{
			$id = $_GET['id'];
			$nombres = $_POST['nombre'];
			$apellido = $_POST['apellido'];
			$cargo = $_POST['selectCargo'];
		

			$sentenciaSQL=$conexion->prepare("UPDATE juez SET JUEZ_NOMBRE= '$nombres', JUEZ_APELLIDO ='$apellido',CARGO_JUEZ_ID = '$cargo' WHERE JUEZ_ID = '$id'");
			//if-else statement in executing our query
			if( $sentenciaSQL->execute() ){
				$message ="exito";
			}else{
				$message ="error";
			}

		}
		catch(PDOException $e){
			$message ="error";
		}

		//Cerrar la conexión
		
	}
	else{
		$message="empty";
	}

	header('location: ../Gestion_jueces.php?message='.$message);

?>