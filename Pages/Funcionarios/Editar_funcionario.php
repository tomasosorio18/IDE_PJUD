<?php 
	session_start();
	include_once('../../Configuration/Connector.php');  

	if(isset($_POST['editar']) and $_POST['apellido'] != "" and $_POST['nombre'] != ""){
	
		try{
			$id = $_GET['id'];
			$nombres = $_POST['nombre'];
			$apellido = $_POST['apellido'];
			$cargo = $_POST['selectCargo'];
		

			$sentenciaSQL=$conexion->prepare("UPDATE funcionario SET FUNCIONARIO_NOMBRE= '$nombres', FUNCIONARIO_APELLIDO ='$apellido',CARGO_FUNC_ID = '$cargo' WHERE FUNCIONARIO_ID = '$id'");
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
		
	}else{
		$message="empty";
	}

	header('location: ../Gestion_funcionarios.php?message='. $message);

?>