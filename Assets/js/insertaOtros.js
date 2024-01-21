$(document).ready(function () {
    // Listen to submit event on the <form> itself!
    $('#btnInsertO').on('click',function(){
    
      var txtdecre = $("#txtdecre").val();
      var detalleOtros = $("#detalleOtros").val();
      var txtdata2 = $("#txtdata2").val();
      var etxtcargo2 = $("#txtcargo2").val();
      var txtJuez2 = $("#txtJuez2").val();
      var txtTipo2 = $("#txtTipo2").val();
      var txtEstado = $("#txtEstado").val();
      var turidO = $("#turidO").val();

      if(detalleOtros == ''){
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
    toastr.error("¡Falta rellenar el detalle!");
    elem = $('#detalleOtros');
    elem.css('border-color', 'red');
               
      }else{ 
        
        $.ajax({
            type: 'post',
            url: 'Metodos/Inserta_Otros.php',
            data: {
                'txtdecre':txtdecre,
                'detalleOtros':detalleOtros,
                'txtdata2':txtdata2,
                'txtcargo2':etxtcargo2,
                'txtJuez2':txtJuez2,
                'txtTipo2':txtTipo2,
                'txtEstado':txtEstado,
                'turidO':turidO,
            },
             success : function(response){
                if($.trim(response) === "1"){
                     
                        $('#modalOtros').modal('show');
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
                    setTimeout(() => {
                        location.href = "Decreto.php";
                        }, 3000);
                    $("#btnpdfP").prop('disabled', true);
                   
    //                                       
                }
    
    
            }
    
            });

      }



 
    

 
    });

  });