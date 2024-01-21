$(document).ready(function () {   
    // Listen to submit event on the <form> itself!
    $('#btnInsertPS').on('click',function(){
    
      var txtdecre = $("#txtdecre").val();
      var detallePS = $("#detallePermisossubrogacion").val();
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
      var turidPS = $("#turidPS").val();
 
  

      if (detallePS == '' ) {
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
    toastr.error("¡Falta rellenar el detalle!");
    elem = $('#detallePermisossubrogacion');
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
            url: 'Metodos/Inserta_Permiso-Subrogancia.php',
            data: {
                'txtdecre':txtdecre,
                'detallePermisossubrogacion':detallePS,  
                'txtdata2':txtdata2,
                'txtcargo2':etxtcargo2,
                'txtJuez2':txtJuez2,
                'txtTipo2':txtTipo2,
                'txtEstado':txtEstado,
                'txtAusente':txtAusente,
                'turidPS':turidPS
            },
             success : function(response){
                if($.trim(response) === "1"){
                    toastr.options =
                        {
                        "closeButton" : true,
                        "progressBar" : true
                        }
                        $("#selectcargoMFEPSM").val(selectcargoMFE);
                        $("#txtSubroganteMFEPSM").val(txtSubroganteMFE);
                        $("#selectcargoSubrogantePSM").val(selectcargoSubrogante);
                        $("#txtSubrogantePSM").val(txtSubrogante);    
                        $("#txtdiasPSM").val(txtdias);
                        $("#datepicker2PSM").val(datepicker2);   
                        $("#txtResolucionPSM").val(txtResolucion);
                        $("#txtAusentePSM").val(txtAusente);
                        $("#detallePermisossubrogacionPSM").val(detallePS);
                        $('#modalPS').modal('show');
   
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
                    // $("#btnpdfP").prop('disabled', true);
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
                    // $("#btnpdfP").prop('disabled', true);
                   
    //                                       
                }
    
    
            }
    
            });
      }

 
      

 
    });

  });