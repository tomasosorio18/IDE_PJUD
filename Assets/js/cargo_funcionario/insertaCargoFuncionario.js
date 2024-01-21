$(document).ready(function () {
    $('#agregacargofuncionario').on('click',function(){

      var txtcargo = $("#txtNombreCargo").val();

      if (txtcargo == '' ) {
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
    toastr.error("¡Escriba el nombre del cargo!");
    elem = $('#txtNombreCargo');
    elem.css('border-color', 'red');
        
      } else {
      
        $.ajax({
            type: 'post',
            url: 'Metodos/Inserta_cargo_funcionario.php',
            data: {
                "txtNombreCargo":txtcargo
            },
             success : function(response){ 

                if($.trim(response) === "1"){
                    toastr.options =
                        {
                        "closeButton" : true,
                        "progressBar" : true
                        }
                     $('#myModal-primary').modal('hide');  
                     $('#modalexito').modal('show');
                     $("#span").text("¡Cargo de funcionario agregado con exito!");                                 
                }
                if($.trim(response) === "2"){
                    toastr.options =
                        {
                        "closeButton" : true,
                        "progressBar" : true
                        }
                    toastr.error("¡Error al guardar los datos!");                                                     
                }
                if($.trim(response) === "3"){
                    toastr.options =
                        {
                        "closeButton" : true,
                        "progressBar" : true
                        }
                    toastr.warning("¡Este cargo ya existe!");                                    
                }
    
    
            }
    
    
            });

   
      }



     

 
    });

  });