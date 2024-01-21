<?php 
	session_start();
	include_once('../../Configuration/Connector.php');  

	if(isset($_POST['editar'])and $_POST['apellido'] != "" and $_POST['nombre'] != ""){
	
		try{
			$id = $_GET['id'];
			$nombres = $_POST['nombre'];
			$apellido = $_POST['apellido'];
		

			$sentenciaSQL=$conexion->prepare("UPDATE receptor SET RECEPTOR_NOMBRE= '$nombres', RECEPTOR_APELLIDO ='$apellido' WHERE RECEPTOR_ID = '$id'");
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
		$message ="empty";
	}

	header('location: ../Gestion_receptores.php?message='.$message);

?>