$(document).ready(function () {

    $('#btnInsertD').on('click',function(){

      var txtdecre = $("#txtdecreD").val();
      var detalleDesignacion = $("#detalleDesignacionD").val();
      var txtdata2 = $(".fechaD").val();
      var etxtcargo2 = $(".cargoD").val();
      var txtJuez2 = $(".selectJuezD").val();
      var txtTipo2 = $("#txtTipo2D").val();
      var txtEstado = $("#txtEstadoD").val();
      var turidD = $("#turidD").val();

      if(detalleDesignacion == ''){
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
    toastr.error("¡Falta rellenar el detalle!");
    elem = $('#detalleDesignacionD');
    elem.css('border-color', 'red');
} else if(!$(".fechaD").val()) {
    toastr.error("¡Falta seleccionar la fecha!");
    elem3 = $('.fechaD');
    elem3.css('border-color', 'red');

  }else if(!$(".cargoD").val()){
    toastr.error("¡Falta seleccionar el cargo!");
    elem4 = $('.cargoD');
    elem4.css('border-color', 'red');

  } else if(!$(".selectJuezD").val()){
    toastr.error("¡Falta seleccionar al juez!");
    elem5 = $('.selectJuezD');
    elem5.css('border-color', 'red');

  }else if(!$("#txtEstadoD").val()){
    toastr.error("¡Falta seleccionar el estado!");
    elem6 = $('#txtEstadoD');
    elem6.css('border-color', 'red');
               
      }else{      
        $.ajax({
            type: 'post',
            url: 'Metodos/ModificaDesignacion.php',
            data: {
                'txtdecre':txtdecre,
                'detalleDesignacion':detalleDesignacion,
                'txtdata2':txtdata2,
                'txtcargo2':etxtcargo2,
                'txtJuez2':txtJuez2,
                'txtTipo2':txtTipo2,
                'txtEstado':txtEstado,
                'turidD':turidD
            },
             success : function(response){
        
                if($.trim(response) === "1"){
                    toastr.options =
                        {
                        "closeButton" : true,
                        "progressBar" : true
                        }
                        
                        $('#modalDesignacionM').modal('show');
   
                }
                if($.trim(response) === "2"){
                    toastr.options =
                        {
                        "closeButton" : true,
                        "progressBar" : true
                        }
                    toastr.error("¡Error al modificar el decreto!");                                    
                }
                if($.trim(response) === "3"){
                    toastr.options =
                        {
                        "closeButton" : true,
                        "progressBar" : true
                        }
                    toastr.warning("¡Este decreto ya ha sido ingresado!");
                                                       
                }
    
    
            }
    
            });

      }



 
    

 
    });

  });