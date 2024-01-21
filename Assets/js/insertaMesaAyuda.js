$(document).ready(function () {
    // Listen to submit event on the <form> itself!
    $('#btnInsertMA').on('click',function(){
      elem = $("#detalleMesaAyuda");
      var txtdecre = $("#txtdecre").val();
      var detalleMesaAyuda = $("#detalleMesaAyuda").val();
      var txtdata2 = $("#txtdata2").val();
      var etxtcargo2 = $("#txtcargo2").val();
      var txtJuez2 = $("#txtJuez2").val();
      var txtTipo2 = $("#txtTipo2").val();
      var txtEstado = $("#txtEstado").val();
      var turidMA = $("#turidMA").val();

      if(detalleMesaAyuda == ''){
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
    toastr.error("¡Falta rellenar el detalle!");

    elem.css('border-color', 'red');
               
      }else{ 
        elem.css('border-color', '');
        
        $.ajax({
            type: 'post',
            url: 'Metodos/Inserta_Mesa-Ayuda.php',
            data: {
                'txtdecre':txtdecre,
                'detalleMesaAyuda':detalleMesaAyuda,
                'txtdata2':txtdata2,
                'txtcargo2':etxtcargo2,
                'txtJuez2':txtJuez2,
                'txtTipo2':txtTipo2,
                'txtEstado':txtEstado,
                'turidMA':turidMA
            },
             success : function(response){
                if($.trim(response) === "1"){

                  $('#modalMesaAyuda').modal('show');
    //                                        
                }
                if($.trim(response) === "2"){
                    toastr.options =
                        {
                        "closeButton" : true,
                        "progressBar" : true
                        }
                    toastr.error("¡Error al guardar los datos!");  
                  
    //                                        
                }
                if($.trim(response) === "3"){
                    toastr.options =
                        {
                        "closeButton" : true,
                        "progressBar" : true
                        }
                    toastr.warning("¡Este decreto ya ha sido ingresado!");
                  
                   
    //                                       
                }
    
    
            }
    
            });

      }



 
    

 
    });

  });