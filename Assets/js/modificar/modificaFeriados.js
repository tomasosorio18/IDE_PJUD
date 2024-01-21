$(document).ready(function () {
    // Listen to submit event on the <form> itself!
    $('#btnInsertF').on('click',function(){
       
      var txtdecre = $("#txtdecreF").val();
      var detalleFeriados = $("#detalleFeriadosF").val();
      var txtdata2 = $(".fechaF").val();
      var txtcargo2 = $(".cargoF").val();
      var txtJuez2 = $(".selectJuezF").val();
      var txtTipo2 = $("#txtTipo2F").val();
      var selectFunc = $("#selectFuncF").val();
      var txtEstado = $("#txtEstadoF").val();
      
      
 
      var Desde = $(".desdeF").val();
      var Hasta = $(".hastaF").val();
      var Dias = $(".diasF").val();
      var Ndocumento = $("#txtdocumentoF").val();
      var FechaD = $(".fechaDilF").val();
      var turidF = $("#turidF").val();


 
   
      if (detalleFeriados == '' ) {
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
    toastr.error("¡Falta rellenar el detalle!");
    elem = $('#detalleFeriadosF');
    elem.css('border-color', 'red');


      } else if (!$('#selectFuncF').val() ) {
        
        toastr.error("¡Falta seleccionar al funcionario!");
        elem2 = $('#selectFuncF');
        elem2.css('border-color', 'red');
      } else if(!$(".fechaF").val()) {
        toastr.error("¡Falta seleccionar la fecha!");
        elem3 = $('.fechaF');
        elem3.css('border-color', 'red');

      }else if(!$(".cargoF").val()){
        toastr.error("¡Falta seleccionar el cargo!");
        elem4 = $('.cargoF');
        elem4.css('border-color', 'red');

      } else if(!$(".selectJuezF").val()){
        toastr.error("¡Falta seleccionar al juez!");
        elem5 = $('.selectJuezF');
        elem5.css('border-color', 'red');

      
      } else {

        $.ajax({
            type: 'post',
            url: 'Metodos/ModificaFeriados.php',
            data: {
                'txtdecre':txtdecre,
                'detalleFeriados':detalleFeriados,
                'txtdata2':txtdata2,
                'txtcargo2':txtcargo2,
                'txtJuez2':txtJuez2,
                'txtTipo2':txtTipo2,
                'selectFunc':selectFunc,
                'txtEstado':txtEstado,
                'turidF':turidF
            },
             success : function(response){ 
                if($.trim(response) === "1"){
                
                        $("#txtEstadoFM").val(txtEstado);
                        $("#txtcargo2FM").val(txtcargo2);
                        $("#txtJuez2FM").val(txtJuez2);
                        $("#desdeFM").val(Desde);
                        $("#hastaFM").val(Hasta);
                        $("#diasFM").val(Dias);
                        $("#ndocumentoFM").val(Ndocumento);
                        $("#dpFM").val(FechaD);
                        $("#funcionarioFM").val(selectFunc);
                        $("#txtdata2FM").val(txtdata2);
                        $('#modalFeriadoM').modal('show');
    //                                        
                }
                if($.trim(response) === "2"){
                    toastr.options =
                        {
                        "closeButton" : true,
                        "progressBar" : true
                        }
                    toastr.error("¡Error al modificar el decreto!");
                    $("#btnpdfF").prop('disabled', true);
    //                                        
                }
                if($.trim(response) === "3"){
                    toastr.options =
                        {
                        "closeButton" : true,
                        "progressBar" : true
                        }
                    toastr.warning("¡Este decreto ya ha sido ingresado!");

                    $("#btnpdfF").prop('disabled', true);
                   
    //                                       
                }
    
    
            }
    
    
            });

   
      }



     

 
    });

  });