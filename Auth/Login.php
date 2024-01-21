<?php
use Phppot\Member;
$loginResult="";
if (! empty($_POST["login-btn"])) {
    require_once __DIR__ . '../../Classes/Member.php';
    $member = new Member();
    $loginResult = $member->loginMember();
}
?>


<HTML>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<HEAD>
<TITLE>Sistema de Decretos economicos</TITLE>

 
 
<!--===============================================================================================-->	
<link rel="icon" type="image/png" href="Assets/images/pjud_icon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-solid.css">
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-regular.css">
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-light.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Assets/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Assets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="Assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Assets/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="Assets/css/main.css">

	<link href="Assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="Assets/js/bootstrap.bundle.min.js"></script>
    <script src="Assets/vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
    <link href="Assets/css/toastr.min.css" rel="stylesheet">
	<script src="Assets/js/toastr.min.js"></script>
<!--===============================================================================================-->
  



</HEAD>
<BODY>


<!-- Script para mostrar las alertas -->
<script>
		<?php if ($_GET["sesion"]=="sesionfin") { ?>
		toastr.options =
		{
		  "closeButton" : true,
		  "progressBar" : true
		}
			  toastr.info("Sesion Finalizada!");
			  setTimeout(() => {
        location.href = "index.php";
        }, 1500);
              
                
		<?php }?>

		<?php if ($_GET["sesion"]=="permisos") { ?>
		toastr.options =
		{
		  "closeButton" : true,
		  "progressBar" : true
		}
			  toastr.warning("Acceso denegado por permisos!");
			  setTimeout(() => {
        location.href = "index.php";
        }, 1500);
              
                
		<?php }?>

	  </script>








<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">

<!-- {{-- ............................................inicio del FORMULARIO........................................................... --}} -->



                <form name="sign-up" action="" method="post"
					onsubmit="return signupValidation()">       
					<span class="login100-form-title p-b-26" style="color: darkblue">
						Bienvenido
					</span>
					
                   
                    <img class="p-b-48" src="Assets/images/pjud.png" style="height: 140px;
                    width: 140px;margin-left:70px;">


             
 <!-- {{-- ............................................Aqui van los inputs del correo........................................................... --}} -->



					<div class="wrap-input100 validate-input">
						<input class="input100" type="email" name="email" id="email">
						<span class="focus-input100 required error" data-placeholder="ingrese su correo"></span>
					</div>
<!-- {{-- ............................................Aqui van los inputs del contraseña........................................................... --}} -->



					<div class="wrap-input100 validate-input">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="login-password" id="login-password">
						<span class="focus-input100 required error" data-placeholder="ingrese su contraseña"></span>
					</div>
<!-- {{-- ............................................Aqui van los botoners de inicio sesion........................................................... --}} -->


                <?php if($loginResult == "Empty"){?>
					<link rel="stylesheet" href="Assets/css/modal/Modal-danger.css">
					<?php include("Pages/Modales_general/Modal_error.php");
					
					echo "<script type='text/javascript'>
					$(document).ready(function(){
						$('#modalerror').modal('show');
						$('#span').empty().append('¡Campos vacios!');
					});
					</script>";
					?>
	
				<?php }?>
				<?php if($loginResult == "Error"){?>
					<link rel="stylesheet" href="Assets/css/modal/Modal-danger.css">
					<?php include("Pages/Modales_general/Modal_error.php");
					
					echo "<script type='text/javascript'>
					$(document).ready(function(){
						$('#modalerror').modal('show');
						$('#span').empty().append('¡Correo o contraseña incorrectos!');
					});
					</script>";
					?>
	
				<?php }?>
			
                   <a href="Auth/Olvide_contraseña.php" style="color:dodgerblue; display: flex;justify-content: center;align-items: center;"> ¡Olvide mi contraseña!</a>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type='submit' class="login100-form-btn" name="login-btn"
							id="login-btn" value="Login">
								Iniciar sesion
							</button>
						</div>
					</div>
<!-- {{-- ............................................Aqui van los botones para el registro........................................................... --}} -->



					<div class="text-center p-t-115">
						<span class="txt1">
							¿No tienes una cuenta?
						</span>

						<a class="txt2" href="Auth/Registro.php">
							¡Registrate!
						</a>
					</div>
                   


 <!-- {{-- ...........................................FIN FORMULARIO........................................................... --}}         -->
 
 

				</form>
			</div>
		</div>
	</div>
	
<!-- Script para validar el correo y contraseña -->





<!--==============================SCRIPTS VARIOS PARA EL FUNCIONAMIENTO DE LA PAGINA=================================================================-->
	
<script src="Assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="Assets/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="Assets/vendor/bootstrap/js/popper.js"></script>
	<script src="Assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="Assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="Assets/vendor/daterangepicker/moment.min.js"></script>

<!--===============================================================================================-->
	<script src="Assets/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="Assets/js/main.js"></script>
</BODY>
</HTML>