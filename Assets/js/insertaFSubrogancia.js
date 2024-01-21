$(document).ready(function () {
  
    // Listen to submit event on the <form> itself!
    $('#btnInsertFS').on('click',function(){ 
    
      var txtdecre = $("#txtdecre").val();
      var detalleFS = $("#detalleFeriadossubrogacion").val();
      var txtdata2 = $("#txtdata2").val();
      var etxtcargo2 = $("#txtcargo2").val();
      var txtJuez2 = $("#txtJuez2").val();
      var txtTipo2 = $("#txtTipo2").val();
      var txtEstado = $("#txtEstado").val();
      var txtAusente = $("#txtAusente").val();
      
      var txtResolucion = $("#txtResolucion").val();
      var datepicker2 = $("#datepicker2").val();
      var Desde = $("#firstDate").val();
      var Hasta = $("#secondDate").val();
      var txtSubrogante = $("#txtSubrogante").val();
      var selectcargoSubrogante = $("#selectcargoSubrogante").val();
      var txtSubroganteMFE = $("#txtSubroganteMFE").val();
      var selectcargoMFE = $("#selectcargoMFE").val();
      var turidFS = $("#turidFS").val();

      if (detalleFS == '' ) {
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
    toastr.error("¡Falta rellenar el detalle!");
    elem = $('#detalleFeriadossubrogacion');
    elem.css('border-color', 'red');


      } else if (!$("#txtAusente").val() ) {
        
        toastr.error("¡Falta seleccionar al funcionario!");
        elem2 = $('#txtAusente');
        elem2.css('border-color', 'red');
      
      } else if (!$("#firstDate").val() ) {       
        toastr.error("¡Falta ingresar la fecha desde!");
        elem3 = $('#firstDate');
        elem3.css('border-color', 'red');

      } else if (!$("#secondDate").val() ) {
        toastr.error("¡Falta ingresar la fecha hasta!");
        elem4 = $('#secondDate');
        elem4.css('border-color', 'red');

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
        url: 'Metodos/Inserta_Feriado-Subrogancia.php',
        data: {
            'txtdecre':txtdecre,
            'detalleFeriadossubrogacion':detalleFS,
            'txtdata2':txtdata2,
            'txtcargo2':etxtcargo2,
            'txtJuez2':txtJuez2,
            'txtTipo2':txtTipo2,
            'txtEstado':txtEstado,
            'txtAusente':txtAusente,
            'turidFS':turidFS,
        },
         success : function(response){
            if($.trim(response) === "1"){

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
              $('#modalFS').modal('show');

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