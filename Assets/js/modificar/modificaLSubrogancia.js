$(document).ready(function () {
  
  // Listen to submit event on the <form> itself!
  $('#btnInsertLS').on('click',function(){
   
    var txtdecre = $("#txtdecreLS").val();
    var detalleLS = $("#detalleLicenciassubrogacionLS").val();
    var txtdata2 = $(".fechaLS").val();
    var txtcargo2 = $(".cargoLS").val();
    var txtJuez2 = $(".selectJuezLS").val();
    var txtTipo2 = $("#txtTipo2LS").val();
    var txtEstado = $("#txtEstadoLS").val();
    var txtAusente = $("#txtAusenteLS").val();

    var txtResolucion = $("#txtResolucionLS").val();
    var datepicker2 = $(".fechaResLS").val();
    var txtSubrogante = $(".txtSubroganteLS").val();
    var selectcargoSubrogante = $(".cargoSubLS").val();
    var txtSubroganteMFE = $(".txtSubroganteMFSLS").val();
    var selectcargoMFE = $(".cargoMFELS").val();
    var turidLS = $("#turidLS").val();
    var txtdias = $("#txtdiasLS").val();


    if (detalleLS == '' ) {
      toastr.options =
      {
      "closeButton" : true,
      "progressBar" : true
      }
  toastr.error("¡Falta rellenar el detalle!");
  elem = $('#detalleLicenciassubrogacionLS');
  elem.css('border-color', 'red');


    } else if (!$("#txtAusenteLS").val() ) {
      
      toastr.error("¡Falta seleccionar al funcionario!");
      elem2 = $('#txtAusente');
      elem2.css('border-color', 'red');
      
    } else {
      
    $.ajax({
      type: 'post',
      url: 'Metodos/Modifica_Licencia-Subrogancia.php',
      data: {
          'txtdecre':txtdecre,
          'detalleLicenciassubrogacion':detalleLS,
          'txtdata2':txtdata2,
          'txtcargo2':txtcargo2,
          'txtJuez2':txtJuez2,
          'txtTipo2':txtTipo2,
          'txtEstado':txtEstado,
          'txtAusente':txtAusente,
          'turidLS':turidLS
      },
       success : function(response){
       
          if($.trim(response) === "1"){
                  $("#txtEstadoLSM").val(txtEstado);
                  $("#txtcargo2LSM").val(txtcargo2);
                  $("#txtJuez2LSM").val(txtJuez2);
                  $("#selectcargoMFELSM").val(selectcargoMFE);
                  $("#txtSubroganteMFELSM").val(txtSubroganteMFE);
                  $("#selectcargoSubroganteLSM").val(selectcargoSubrogante);
                  $("#txtSubroganteLSM").val(txtSubrogante);    
                  $("#txtdiasLSM").val(txtdias);
                  $("#datepicker2LSM").val(datepicker2);   
                  $("#txtResolucionLSM").val(txtResolucion);
                  $("#txtAusenteLSM").val(txtAusente);
                  $("#detallePermisossubrogacionLSM").val(detalleLS);
                  $("#txtdata2LSM").val(txtdata2);
                  $('#modalLSM').modal('show');
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
              toastr.warning("¡Este decreto ya ha sido ingresado!");

                                    
          }


      }

      });

    }








  });

});