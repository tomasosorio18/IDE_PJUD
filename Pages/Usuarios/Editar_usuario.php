<?php
	session_start();
	include_once('../../Configuration/Connector.php');

	if(isset($_POST['editar'])){
	
		try{
			$id = $_GET['id'];
			$permiso = $_POST['selectPermiso'];
		

			$sentenciaSQL=$conexion->prepare("UPDATE tribunal_usu_rol SET ROL_ID = '$permiso' WHERE USUARIO_ID = '$id'");
			//if-else statement in executing our query
			$sentenciaSQL->execute();

			header('location: ../Gestion_roles.php?message=success');


		}
		catch(PDOException $e){
			header('location: ../Gestion_roles.php?message=error');
		}

		//Cerrar la conexión
		
	}
	else{
		$_SESSION['message2'] = 'Complete el formulario de edición';
	}

	

?>