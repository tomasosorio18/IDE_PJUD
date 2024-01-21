$(document).ready(function () {
  
    // Listen to submit event on the <form> itself!
    $('#btnInsertLSS').on('click',function(){
      var txtdecre = $("#txtdecre").val();
      var detalleLS = $("#detalleLicenciassubrogacion").val();
      var txtdata2 = $("#txtdata2").val();
      var etxtcargo2 = $("#txtcargo2").val();
      var txtJuez2 = $("#txtJuez2").val();
      var txtTipo2 = $("#txtTipo2").val();
      var txtEstado = $("#txtEstado").val();
      var txtAusente = $("#txtAusente").val();

      var txtResolucion = $("#txtResolucion").val();
      var datepicker2 = $("#datepicker2").val();
      var txtdias = $("#txtdias").val();
      var txtSubrogante = $("#txtSubrogante").val();
      var selectcargoSubrogante = $("#selectcargoSubrogante").val();
      var txtSubroganteMFE = $("#txtSubroganteMFE").val();
      var selectcargoMFE = $("#selectcargoMFE").val();
      var turidLS = $("#turidLS").val();

  

      if (detalleLS == '' ) {
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
    toastr.error("¡Falta rellenar el detalle!");
    elem = $('#detalleLicenciassubrogacion');
    elem.css('border-color', 'red');


  } else if (!$("#txtAusente").val() ) {
        
    toastr.error("¡Falta seleccionar al funcionario!");
    elem2 = $('#txtAusente');
    elem2.css('border-color', 'red');
  
  } else if (!$("#txtdias").val() ) {       
    toastr.error("¡Falta ingresar los dias!");
    elem3 = $('#txtdias');
    elem3.css('border-color', 'red');

  } else if (!$("#txtResolucion").val() ) { 
    toastr.error("¡Falta ingresar el número de resolucion");
    elem5 = $('#txtResolucion');
    elem5.css('border-color', 'red');

  } else if (!$("#datepicker2").val() ) { 
    toastr.error("¡Falta ingresar la fecha de diligencias");
    elem6 = $('#datepicker2');
    elem6.css('border-color', 'red');
  
  } else if (!$("#txtSubrogante").val() ) { 
    toastr.error("¡Falta seleccionar al subrogante");
    elem7 = $('#txtSubrogante');
    elem7.css('border-color', 'red');

  } else if (!$("#txtSubroganteMFE").val() ) { 
    toastr.error("¡Falta seleccionar al ministro de fe");
    elem8 = $('#txtSubroganteMFE');
    elem8.css('border-color', 'red');
        
      } else {
        
      $.ajax({
        type: 'post',
        url: 'Metodos/Inserta_Licencia-Subrogancia.php',
        data: {
            'txtdecre':txtdecre,
            'detalleLicenciassubrogacion':detalleLS,
            'txtdata2':txtdata2,
            'txtcargo2':etxtcargo2,
            'txtJuez2':txtJuez2,
            'txtTipo2':txtTipo2,
            'txtEstado':txtEstado,
            'txtAusente':txtAusente,
            'turidLS':turidLS
        },
         success : function(response){
            if($.trim(response) === "1"){
              
                toastr.options =
                    {
                    "closeButton" : true,
                    "progressBar" : true
                    }
                    $("#selectcargoMFELSM").val(selectcargoMFE);
                    $("#txtSubroganteMFELSM").val(txtSubroganteMFE);
                    $("#selectcargoSubroganteLSM").val(selectcargoSubrogante);
                    $("#txtSubroganteLSM").val(txtSubrogante);    
                    $("#txtdiasLSM").val(txtdias);
                    $("#datepicker2LSM").val(datepicker2);   
                    $("#txtResolucionLSM").val(txtResolucion);
                    $("#txtAusenteLSM").val(txtAusente);
                    $("#detallePermisossubrogacionLSM").val(detalleLS);
             
                    $('#modalLS').modal('show');

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
                // $("#btnpdfLSadm").prop('disabled', true);
                // $("#btnpdfLSjefeU").prop('disabled', true);
                // $("#btnpdfLSjuezJ").prop('disabled', true);
                // $("#btnpdfLSjuezJP").prop('disabled', true);
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
                //     $("#btnpdfLSadm").prop('disabled', true);
                //     $("#btnpdfLSjefeU").prop('disabled', true);
                //     $("#btnpdfLSjuezJ").prop('disabled', true);
                //     $("#btnpdfLSjuezJP").prop('disabled', true);
               
//                                       
            }


        }

        });

      }





    });

  });