$(document).ready(function () {
    $('#btnRespaldo').on('click',function(){
      
        $.ajax({
            type: 'post',
            url: 'Metodos/Genera_respaldo.php',
            data: {
            },
             success : function(response){

                if($.trim(response) === "1"){  
                    toastr.options =
                    {
                    "closeButton" : true,
                    "progressBar" : true
                    }
                toastr.success("¡Decreto generado con exito!");                              
                }
                if($.trim(response) === "2"){
                    toastr.options =
                        {
                        "closeButton" : true,
                        "progressBar" : true
                        }
                    toastr.error("¡Error al generar respaldo!");
                                                 
                }    
            }
            });
    });
  });