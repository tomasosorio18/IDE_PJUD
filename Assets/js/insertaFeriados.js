$(document).ready(function () {
 
    $("#btnInsertF").prop('disabled', false);
    // Listen to submit event on the <form> itself!
    $('#btnInsertF').on('click',function(){
       
        
  
      var txtdecre = $("#txtdecre").val();
      var detalleFeriados = $("#detalleFeriados").val();
      var txtdata2 = $("#txtdata2").val();
      var etxtcargo2 = $("#txtcargo2").val(); 
      var txtJuez2 = $("#txtJuez2").val();
      var txtTipo2 = $("#txtTipo2").val();
      var selectFunc = $("#selectFunc").val();
      var txtEstado = $("#txtEstado").val();

      var Desde = $("#firstDate").val();
      var Hasta = $("#secondDate").val();
      var Dias = $("#days").val();
      var Ndocumento = $("#txtdocumento").val();
      var FechaD = $("#datepicker2").val();
      var Detalle = $("#detalleFeriados").val();
      var turidF = $("#turidF").val();

      if (detalleFeriados == '' ) {
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
    toastr.error("¡Falta rellenar el detalle!");
    elem = $('#detalleFeriados');
    elem.css('border-color', 'red');


      } else if (!$('#selectFunc').val() ) {
        
        toastr.error("¡Falta seleccionar al funcionario!");
        elem2 = $('#selectFunc');
        elem2.css('border-color', 'red');

      } else if (!$("#firstDate").val() ) {       
        toastr.error("¡Falta ingresar la fecha desde!");
        elem3 = $('#firstDate');
        elem3.css('border-color', 'red');

      } else if (!$("#secondDate").val() ) {
        toastr.error("¡Falta ingresar la fecha hasta!");
        elem4 = $('#secondDate');
        elem4.css('border-color', 'red');

      } else if (!$("#txtdocumento").val() ) { 
        toastr.error("¡Falta ingresar el número de documento");
        elem5 = $('#txtdocumento');
        elem5.css('border-color', 'red');

      } else if (!$("#datepicker2").val() ) { 
        toastr.error("¡Falta ingresar la fecha de diligencias");
        elem6 = $('#datepicker2');
        elem6.css('border-color', 'red');
        
      } else {

        $.ajax({
            type: 'post',
            url: 'Metodos/Inserta_Feriados.php',
            data: {
                'txtdecre':txtdecre,
                'detalleFeriados':detalleFeriados,
                'txtdata2':txtdata2,
                'txtcargo2':etxtcargo2,
                'txtJuez2':txtJuez2,
                'txtTipo2':txtTipo2,
                'selectFunc':selectFunc,
                'txtEstado':txtEstado,
                'turidF':turidF
            },
             success : function(response){ 
               
                if($.trim(response) === "1"){
                    toastr.options =
                        {
                        "closeButton" : true,
                        "progressBar" : true
                        }


                    $("#desdeFM").val(Desde);
                    $("#hastaFM").val(Hasta);
                    $("#diasFM").val(Dias);
                    $("#ndocumentoFM").val(Ndocumento);
                    $("#dpFM").val(FechaD);
                    $("#detalleFM").val(Detalle);
                    $("#funcionarioFM").val(selectFunc);

                    $('#modalFeriado').modal('show');
                    
    //                                        
                }
                if($.trim(response) === "2"){
                    toastr.options =
                        {
                        "closeButton" : true,
                        "progressBar" : true
                        }
                    toastr.error("¡Error al guardar los datos!");
                    $("#btnpdfF").prop('disabled', true);
                    // setTimeout(() => {
                    //     location.href = "Diseño_decretos.php";
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
                    //     location.href = "Diseño_decretos.php";
                    //     }, 3000);
                    $("#btnpdfF").prop('disabled', true);
                   
    //                                       
                }
    
    
            }
    
    
            });

   
      }



     

 
    });

  });