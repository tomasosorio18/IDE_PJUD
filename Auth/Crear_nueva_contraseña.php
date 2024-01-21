<HTML>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<HEAD>
<TITLE>Cree su nueva contraseña</TITLE>

 
 
<!--===============================================================================================-->	
<link rel="icon" type="image/png" href="../Assets/images/pjud_icon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-solid.css">
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-regular.css">
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-light.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Assets/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Assets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../Assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Assets/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="../Assets/css/main.css">

	<link href="../Assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../Assets/js/bootstrap.bundle.min.js"></script>
    <script src="../Assets/vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
    <link href="../Assets/css/toastr.min.css" rel="stylesheet">
	<script src="../Assets/js/toastr.min.js"></script>
<!--===============================================================================================-->
</HEAD>
<script>
		<?php if ($_GET["reset"]=="success") { ?>
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
</script>
<BODY>


<!-- Script para mostrar las alertas -->

<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">

<!-- {{-- ............................................inicio del FORMULARIO........................................................... --}} -->



					<form name="login" action="Reset_contraseña.php" method="post">      
					<span class="login100-form-title p-b-26" style="color: darkblue">
						Restablecer contraseña
					</span>					
                    <img class="p-b-48" src="../Assets/images/pjud.png" style="height: 140px;
                    width: 140px;margin-left:70px;">


             
 <!-- {{-- ............................................Aqui van los inputs del correo........................................................... --}} -->



					<div class="wrap-input100 validate-input">
						<input class="input100" type="email" name="txtEmail" id="txtEmail">
						<span class="focus-input100 required error" data-placeholder="ingrese su correo"></span>
					</div>
<!-- {{-- ............................................Aqui van los inputs del contraseña........................................................... --}} -->


<!-- {{-- ............................................Aqui van los botoners de inicio sesion........................................................... --}} -->


					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type='submit' class="login100-form-btn" name="btnRestablece"
							id="btnRestablece" value="Restablecer">
								¡Restablecer mi contraseña!
							</button>
						</div>
					</div>
<!-- {{-- ............................................Aqui van los botones para el registro........................................................... --}} -->



					<div class="text-center p-t-115">


					<a id="" name="" href="../Index.php" style="color:dodgerblue">Volver</a>
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