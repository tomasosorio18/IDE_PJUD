$(document).ready(function () {
  // Listen to submit event on the <form> itself!
  $('#btnInsertR').on('click',function(){

    var txtdecre = $("#txtdecreR").val();
    var detalleReceptor = $("#detalleReceptorR").val();
    var txtdata2 = $(".fechaR").val();
    var txtcargo2 = $(".cargoR").val();
    var txtJuez2 = $(".selectJuezR").val();
    var txtTipo2 = $("#txtTipo2R").val();
    var txtEstado = $("#txtEstadoR").val();
    var turidR = $("#turidRM").val();


    if(detalleReceptor == ''){
      toastr.options =
      {
      "closeButton" : true,
      "progressBar" : true
      }
  toastr.error("¡Falta rellenar el detalle!");
  elem = $('#detalleReceptorR');
  elem.css('border-color', 'red');
             
    }else{ 

      $.ajax({
          type: 'post',
          url: 'Metodos/ModificaReceptores.php',
          data: {
              'txtdecre':txtdecre,
              'detalleReceptor':detalleReceptor,
              'txtdata2':txtdata2,
              'txtcargo2':txtcargo2,
              'txtJuez2':txtJuez2,
              'txtTipo2':txtTipo2,
              'txtEstado':txtEstado,
              'turidR':turidR
          },
           success : function(response){
        
              if($.trim(response) === "1"){
                  toastr.options =
                      {
                      "closeButton" : true,
                      "progressBar" : true
                      }

                      let valoresSelect = [];

                      // Itera a través de los elementos select dentro del contenedor ".wrapper"
                          $('.wrapper select').each(function() {
                          // Obtén el valor del select actual y agrégalo al array
                          let valor = $(this).val();
                          valoresSelect.push(valor);                    
                          });

                          generarYAsignarInputs(valoresSelect);
                          $("#txtdata2RM").val(txtdata2);
                          $("#txtEstadoRM").val(txtEstado);
                          $("#txtcargo2RM").val(txtcargo2);
                          $("#txtJuez2RM").val(txtJuez2);
                          $('#modalReceptorR').modal('show');
                          elem.css('border-color', '');
  //               
              }
              if($.trim(response) === "2"){
                  toastr.options =
                      {
                      "closeButton" : true,
                      "progressBar" : true
                      }
                  toastr.error("¡Error al guardar los datos!");
                  $("#btnpdfR").prop('disabled', true);
                  // setTimeout(() => {
                  //     location.href = "Decreto.php";
                  //     }, 3000);
  //                                        
              }
              if($.trim(response) === "3"){
                  toastr.options =
                      {
                      "closeButton" : true,
                      "progressBar" : true
                      }
                  toastr.warning("¡Este decreto ya ha sido ingresado!");
                  // setTimeout(() => {
                  //     location.href = "Decreto.php";
                  //     }, 3000);
                  $("#btnpdfR").prop('disabled', true);
                 
  //                                       
              }
  
  
          }
  
          });
  

    }


  

  });

});

function generarYAsignarInputs(valoresSelect) {
  // Recorre los valores en el array
  
  for (let i = 0; i < valoresSelect.length; i++) {
      // Genera un nuevo input dinámicamente
      let nuevoInput = $('<input>');

      // Asigna un nombre al input basado en el índice
      nuevoInput.attr('name', 'selectReceptor['+i+']');
      nuevoInput.attr('id', 'selectReceptor['+i+']');
      nuevoInput.attr('hidden', true);

      // Asigna el valor del array al input
      nuevoInput.val(valoresSelect[i]);

      // Agrega el nuevo input al formulario o contenedor deseado
      $('#formRM').append(nuevoInput); 
  }
}