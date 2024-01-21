$(document).ready(function () {
  // Listen to submit event on the <form> itself!
  $('#btnInsertMA').on('click',function(){
    elem = $("#detalleMAM");

    var txtdecre = $("#txtdecreMA").val();
    var detalleMesaAyuda = $("#detalleMAM").val();
    var txtdata2 = $(".fechaMA").val();
    var txtcargo2 = $(".cargoMA").val();
    var txtJuez2 = $(".selectJuezMA").val();
    var txtTipo2 = $("#txtTipo2MA").val();
    var txtEstado = $("#txtEstadoMA").val();
    var turidMA = $("#turidMAM").val();

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
          url: 'Metodos/Modifica_Mesa-Ayuda.php',
          data: {
              'txtdecre':txtdecre,
              'detalleMesaAyuda':detalleMesaAyuda,
              'txtdata2':txtdata2,
              'txtcargo2':txtcargo2,
              'txtJuez2':txtJuez2,
              'txtTipo2':txtTipo2,
              'txtEstado':txtEstado,
              'turidMA':turidMA
          },
           success : function(response){
              if($.trim(response) === "1"){

                $('#modalMesaAyudaM').modal('show');
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