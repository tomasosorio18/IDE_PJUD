$(document).ready(function() {
    $(document).on('shown.bs.modal', '.modal', function() {
        var eventAttached = false;
        if (!eventAttached) {
            $('.btn-delete', this).on('click', function() {
                var currentModal = $(this).closest('.modal');
                var cargoid = $(this).closest('.modal').find('.borraCargoid').val(); 
                       
                    $.ajax({
                        type: 'post',
                        url: 'Metodos/Borra_cargo_funcionario.php',
                        data: {
                            "borraCargoid":cargoid
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
                                        $("#span").text("¡Cargo de funcionario dado de baja con exito!");
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
            
               
                  
            });

            eventAttached = true;
        }
    });

    $(document).on('hidden.bs.modal', '.modal', function() {
        $('.btn-save', this).off('click');
    });
});