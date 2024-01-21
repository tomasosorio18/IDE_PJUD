$(document).ready(function () {
  
  // Listen to submit event on the <form> itself!
  $('#btnInsertFS').on('click',function(){ 
  
    var txtdecre = $("#txtdecreFS").val();
    var detalleFS = $("#detalleFeriadossubrogacionFS").val();
    var txtdata2 = $(".fechaFS").val();
    var txtcargo2 = $(".cargoFS").val();
    var txtJuez2 = $(".selectJuezFS").val();
    var txtTipo2 = $("#txtTipo2FS").val();
    var txtEstado = $("#txtEstadoFS").val();
    var txtAusente = $("#txtAusenteFS").val();
    
    var txtResolucion = $("#txtResolucionFS").val();
    var datepicker2 = $(".fechaResF").val();
    var Desde = $(".desdeFS").val();
    var Hasta = $(".hastaFS").val();
    var txtSubrogante = $(".txtSubroganteFS").val();
    var selectcargoSubrogante = $(".cargoSubFS").val();
    var txtSubroganteMFE = $(".txtSubroganteMFSFS").val();
    var selectcargoMFE = $(".cargoMFEFS").val();
    var turidFS = $("#turidFS").val();

    if (detalleFS == '' ) {
      toastr.options =
      {
      "closeButton" : true,
      "progressBar" : true
      }
  toastr.error("¡Falta rellenar el detalle!");
  elem = $('#detalleFeriadossubrogacionFS');
  elem.css('border-color', 'red');


    } else if (!$("#txtAusenteFS").val() ) {
      
      toastr.error("¡Falta seleccionar al funcionario!");
      elem2 = $('#txtAusenteFS');
      elem2.css('border-color', 'red');
      
    } else {
       
    $.ajax({
      type: 'post',
      url: 'Metodos/Modifica_Feriado-Subrogancia.php',
      data: {
          'txtdecre':txtdecre,
          'detalleFeriadossubrogacion':detalleFS,
          'txtdata2':txtdata2,
          'txtcargo2':txtcargo2,
          'txtJuez2':txtJuez2,
          'txtTipo2':txtTipo2,
          'txtEstado':txtEstado,
          'txtAusente':txtAusente,
          'turidFS':turidFS,
      },
       success : function(response){
          
          if($.trim(response) === "1"){
            $("#txtEstadoFSM").val(txtEstado);
            $("#txtcargo2FSM").val(txtcargo2);
            $("#txtJuez2FSM").val(txtJuez2);
            $("#selectcargoMFEFSM").val(selectcargoMFE);
            $("#txtSubroganteMFEFSM").val(txtSubroganteMFE);
            $("#selectcargoSubroganteFSM").val(selectcargoSubrogante);
            $("#txtSubroganteFSM").val(txtSubrogante);    
            $("#DesdeFSM").val(Desde);
            $("#HastaFSM").val(Hasta);
            $("#datepicker2FSM").val(datepicker2);   
            $("#txtResolucionFSM").val(txtResolucion);
            $("#txtAusenteFSM").val(txtAusente);
            $("#detalleFeriadossubrogacionFSM").val(detalleFS);
            $("#txtdata2FSM").val(txtdata2);
            
            $('#modalFSM').modal('show');

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