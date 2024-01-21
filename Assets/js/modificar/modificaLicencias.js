$(document).ready(function () {
    // Listen to submit event on the <form> itself!
    $('#btnInsertL').on('click',function(){
      var txtdecre = $("#txtdecreL").val();
      var detalleLicencias= $("#detalleLicenciasL").val();
      var txtdata2 = $(".fechaL").val();
      var txtcargo2 = $(".cargoL").val();
      var txtJuez2 = $(".selectJuezL").val();
      var txtTipo2 = $("#txtTipo2L").val();
      var selectFunc = $("#selectFuncL").val();
      var txtEstado = $("#txtEstadoL").val();

      var Desde = $(".desdeL").val();
      var Hasta = $(".hastaL").val();
      var Dias = $(".diasL").val();
      var Ndocumento = $("#txtdocumentoL").val();
      var FechaD = $(".fechaDilL").val();
      var turidL = $("#turidL").val();
 
      if (detalleLicencias == '' ) {
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
    toastr.error("¡Falta rellenar el detalle!");
    elem = $('#detalleLicenciasL');
    elem.css('border-color', 'red');


      } else if (!$('#selectFuncL').val() ) {
        
        toastr.error("¡Falta seleccionar al funcionario!");
        elem2 = $('#selectFuncL');
        elem2.css('border-color', 'red');
      } else if(!$(".fechaL").val()) {
        toastr.error("¡Falta seleccionar la fecha!");
        elem3 = $('.fechaL');
        elem3.css('border-color', 'red');

      }else if(!$(".cargoL").val()){
        toastr.error("¡Falta seleccionar el cargo!");
        elem4 = $('.cargoL');
        elem4.css('border-color', 'red');

      } else if(!$(".selectJuezL").val()){
        toastr.error("¡Falta seleccionar al juez!");
        elem5 = $('.selectJuezL');
        elem5.css('border-color', 'red');

      }else if(!$("#txtEstadoL").val()){
        toastr.error("¡Falta seleccionar el estado!");
        elem6 = $('#txtEstadoL');
        elem6.css('border-color', 'red');
      } else {

        $.ajax({
            type: 'post',
            url: 'Metodos/ModificaLicencias.php',
            data: {
                'txtdecre':txtdecre,
                'detalleLicencias':detalleLicencias,
                'txtdata2':txtdata2,
                'txtcargo2':txtcargo2,
                'txtJuez2':txtJuez2,
                'txtTipo2':txtTipo2,
                'selectFunc':selectFunc,
                'txtEstado':txtEstado,
                'turidL':turidL
            },
             success : function(response){ 
          
                if($.trim(response) === "1"){
 
                  $("#txtEstadoLM").val(txtEstado);
                  $("#txtcargo2LM").val(txtcargo2);
                  $("#txtJuez2LM").val(txtJuez2);
                  $("#desdeLM").val(Desde);
                  $("#hastaLM").val(Hasta);
                  $("#diasLM").val(Dias);
                  $("#ndocumentoLM").val(Ndocumento);
                  $("#dpLM").val(FechaD);
                  $("#txtdata2LM").val(txtdata2);
                  $("#funcionarioLM").val(selectFunc);

                  $('#modalLicenciaL').modal('show');
                                        
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