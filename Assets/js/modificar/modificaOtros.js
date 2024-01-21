$(document).ready(function () {
  // Listen to submit event on the <form> itself!
  $('#btnInsertO').on('click',function(){
  
    var txtdecre = $("#txtdecreO").val();
    var detalleOtros = $("#detalleOtrosO").val();
    var txtdata2 = $(".fechaO").val();
    var etxtcargo2 = $(".cargoO").val();
    var txtJuez2 = $(".selectJuezO").val();
    var txtTipo2 = $("#txtTipo2O").val();
    var txtEstado = $("#txtEstadoO").val();
    var turidO = $("#turidOM").val();

    if(detalleOtros == ''){
      toastr.options =
      {
      "closeButton" : true,
      "progressBar" : true
      }
  toastr.error("¡Falta rellenar el detalle!");
  elem = $('#detalleOtrosO');
  elem.css('border-color', 'red');
             
    }else{ 
      
      $.ajax({
          type: 'post',
          url: 'Metodos/ModificaOtros.php',
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
                   
                      $('#modalOtrosM').modal('show');
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
              }
  
  
          }
  
          });

    }




  


  });

});