$(document).ready(function() {
    $(document).on('shown.bs.modal', '.modal', function() {
        var eventAttached = false;

        if (!eventAttached) {
            $('.btn-save', this).on('click', function() {
                var currentModal = $(this).closest('.modal');
                var cargoid = $(this).closest('.modal').find('.hiddenCargoid').val();
                var txtcargo = $(this).closest('.modal').find("#txtEditaCargo").val();
                if (txtcargo == '' ) {
                    toastr.options =
                    {
                    "closeButton" : true,
                    "progressBar" : true
                    }
                toastr.error("¡Escriba el nombre del cargo!");
                elem = $(this).closest('.modal').find("#txtEditaCargo")
                elem.css('border-color', 'red');
                    
                  } else {
                  
                    $.ajax({
                        type: 'post',
                        url: 'Metodos/Modifica_cargo_funcionario.php',
                        data: {
                            "txtEditaCargo":txtcargo,
                            "cargoid":cargoid
                        },
                         success : function(response){ 
                            
                            if($.trim(response) === "1"){
                                toastr.options =
                                    {
                                    "closeButton" : true,
                                    "progressBar" : true
                                    }
                                    currentModal.modal('hide'); // Cierra el modal actual
                                    currentModal.on('hidden.bs.modal', function() {
                                        $('#modalexito').modal('show'); // Abre el segundo modal después de que se cierre el primero
                                        $("#span").text("¡Cargo de funcionario modificado con exito!");
                                    });                     
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

            eventAttached = true;
        }
    });

    $(document).on('hidden.bs.modal', '.modal', function() {
        $('.btn-save', this).off('click');
    });
});