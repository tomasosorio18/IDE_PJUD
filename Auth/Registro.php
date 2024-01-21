
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<TITLE>Registro de usuario</TITLE>
<link rel="icon" type="image/png" href="Assets/images/pjud_icon.png"/>
<link href="../Assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../Assets/js/bootstrap.bundle.min.js"></script>
    <script src="../Assets/vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
    <link href="../Assets/css/toastr.min.css" rel="stylesheet">
	<script src="../Assets/js/toastr.min.js"></script>

    <link rel="stylesheet" href="../Assets/css/style.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-solid.css">
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-regular.css">
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-light.css">
</HEAD>
<BODY style="
    padding-top: 19px;
">











	<div class="main">

<section class="signup">
    <!-- <img src="images/signup-bg.jpg" alt=""> -->
    <div class="container">
        <div class="signup-content">
            <form method="POST" action='' class="signup-form" name="sign-up" onsubmit="return signupValidation()">
            
                <h2 class="form-title" style="color: darkblue">Crear una nueva cuenta</h2>
             
                <?php   
    if (! empty($registrationResponse["status"])) {
        ?>
                    <?php
        if ($registrationResponse["status"] == "error") {
            ?>
				    
        
                    <input type="hidden" id="message" name="message" value=" <?php echo $registrationResponse["message"]; ?>"></input>           
                    <link rel="stylesheet" href="Assets/css/modal/Modal-danger.css">
                    <?php include("../Pages/Modales_general/Modal_error.php");
					
                    echo "<script type='text/javascript'>
                    $(document).ready(function(){
                        var message = $('#message').val();
                        $('#modalerror').modal('show');
                        $('#span').empty().append('" . $registrationResponse["message"] . "'); // Concatenar el valor PHP aquí
                    });
                </script>";
        } else if ($registrationResponse["status"] == "success") {
            ?>
                  
                    <div class="alert alert-success" role="alert">
                    <?php echo $registrationResponse["message"]; ?>
                    </div>
                    <?php
        }
        ?>
				<?php
    }
    ?>



                <div class="form-group">
                            <input type="text" class="form-input" name="nombre" id="nombre" placeholder="Ingrese su nombre" required="TRUE"/>
                        </div>
   
                        <div class="form-group">
                            <input type="text" class="form-input" name="apellido" id="apellido" placeholder="Ingrese su apellido" required="TRUE"/>
                        </div>
              


                    

                   

                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Ingrese su correo"required="TRUE"/>
                        </div>

                             
                       
                        <div class="" id="error-msg" role="alert"></div>

                        <div class="form-group">
                            <input type="password" class="form-input" name="signup-password" id="signup-password" placeholder="Ingrese su contraseña" required="TRUE"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>

                               
                        
                     

                        <div class="form-group">
                            <input type="password" class="form-input" name="confirm-password" id="confirm-password" placeholder="Repita su contraseña" required="TRUE"/>
                        </div>
                              
                        <div class="form-group">
                           <select class="form-input" name="selecttribunal" id="selecttribunal" required="TRUE">
                                <option value="none">Seleccione un juzgado.</option>
                                <option value="1">Juzgado de Cobranza Laboral y Previsional de Valparaíso</option>
                                <option value="2">Juzgado de Cobranza Laboral y Previsional de Concepción</option>
                                <option value="3">Juzgado de Cobranza Laboral y Previsional de San Miguel</option>
                                <option value="4">Juzgado de Cobranza Laboral y Previsional de Santiago</option>
                           </select>
                        </div>
                              
                      
                       
                        <div class="form-group">
                            <input type="submit" class="form-submit" name="signup-btn"
							id="signup-btn" value="Sign up"/>
                        </div>
            </form>
            <p class="loginhere">
                ¿Ya tienes una cuenta? <a href="../index.php" class="loginhere-link" style="color: darkblue">Inicia sesión aquí</a>
            </p>
        </div>
    </div>
</section>

</div>

<script>
function signupValidation() {
	var valid = true;

	$("#email").removeClass("error-field");
	$("#email").removeClass("error-field");
	$("#password").removeClass("error-field");
	$("#confirm-password").removeClass("error-field");
    
    


	var email = $("#email").val();
	var Password = $('#signup-password').val();
    var ConfirmPassword = $('#confirm-password').val();
    
	var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

	$("#email-info").html("").hide();

	if (email == "") {
		$("#email-info").html("El correo es obligatorio").css("color", "#ee0000").show();
		$("#email").addClass("error-field");
        toastr.options =
                    {
                        "closeButton" : true,
                        "progressBar" : true
                    }
        toastr.danger("¡El correo es obligatorio!");
		valid = false;
	} else if (email.trim() == "") {
		$("#email-info").html("Direccion de correo invalida.").css("color", "#ee0000").show();
		$("#email").addClass("error-field");
        toastr.options =
                    {
                        "closeButton" : true,
                        "progressBar" : true
                    }
        toastr.danger("¡Direccion de correo invalida!");
		valid = false;
	} else if (!emailRegex.test(email)) {
		$("#email-info").html("Direccion de correo invalida.").css("color", "#ee0000")
				.show();
		$("#email").addClass("error-field");
        toastr.options =
                    {
                        "closeButton" : true,
                        "progressBar" : true
                    }
        toastr.danger("¡Direccion de correo invalida!");
		valid = false;
	}
	if (Password.trim() == "") {
		$("#signup-password-info").html("La contraseña es obligatoria.").css("color", "#ee0000").show();
		$("#signup-password").addClass("error-field");
        toastr.options =
                    {
                        "closeButton" : true,
                        "progressBar" : true
                    }
        toastr.danger("¡La contraseña es obligatoria.");
		valid = false;
	}
	if (ConfirmPassword.trim() == "") {
		$("#confirm-password-info").html("La contraseña es obligatoria.").css("color", "#ee0000").show();
		$("#confirm-password").addClass("error-field");
        toastr.options =
                    {
                        "closeButton" : true,
                        "progressBar" : true
                    }
        toastr.danger("¡La contraseña es obligatoria.");
		valid = false;
	}
	if(Password != ConfirmPassword){
        $("#error-msg").html("Ambas contraseñas deben ser iguales.").addClass("alert alert-danger");
        toastr.options =
                    {
                        "closeButton" : true,
                        "progressBar" : true
                    }
        toastr.danger("¡Ambas contraseñas deben ser iguales.!.");
        valid=false;
    }
    if(document.getElementById('selecttribunal').value== "none"){
        $("#error-msg").html("¡Seleccione un juzgado!.").addClass("alert alert-danger");
        toastr.options =
                    {
                        "closeButton" : true,
                        "progressBar" : true
                    }
        toastr.danger("¡Seleccione un juzgado!.");
        valid=false;
    }
	if (valid == false) {
		$('.error-field').first().focus();
        e.preventDefault();
		valid = false;
	}
	return valid;
}
</script>


<?php
                // use Phppot\Member;
                // if (! empty($_POST["signup-btn"])) {
                //     require_once __DIR__ . '../../Classes/Member.php';
                //     $member = new Member();
                //     $registrationResponse = $member->registerMember();
                // }
                ?> 


<script>
		<?php if ($registrationResponse["status"] == "success") { ?>
		toastr.options =
		{
		  "closeButton" : true,
		  "progressBar" : true
		}
			  toastr.success("Registrado de forma exitosa!");
              toastr.options.onHidden = function(){
                window.location.href("/index.php");
              }
		<?php }
        
        if ($registrationResponse["status"] == "error") { ?>
            toastr.options =
            {
              "closeButton" : true,
              "progressBar" : true
            }
                  toastr.error("Hubo un error al registrar.");
                  toastr.options.onHidden = function(){
                    window.location.reload();
                  }
        

        <?php } ?>

	  </script>
</BODY>
</HTML>
