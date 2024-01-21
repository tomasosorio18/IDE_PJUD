$(document).ready(function () {
    // Listen to submit event on the <form> itself!
    $('#btnInsertCA').on('click',function(){
    
      var txtdecre = $("#txtdecre").val();
      var detalleCursoAcademia = $("#detalleCursoAcademia").val();
      var txtdata2 = $("#txtdata2").val();
      var txtcargo2 = $("#txtcargo2").val();
      var txtJuez2 = $("#txtJuez2").val();
      var txtTipo2 = $("#txtTipo2").val();
      var txtFunc = $("#selectFunc").val();
      var txtEstado = $("#txtEstado").val();

      var Desde = $("#firstDate").val();
      var turid = $("#turidCA").val();
      var Hasta = $("#secondDate").val();
      var Nresolucion = $("#txtresolucion").val();
      var Ciudad = $("#selectCiudad").val();
      var Curso = $("#txtCurso").val();
   

      if (detalleCursoAcademia == '' ) {
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
    toastr.error("¡Falta rellenar el detalle!");
    elem = $('#detalleCursoAcademia');
    elem.css('border-color', 'red');
 

      } else if (!$("#selectFunc").val() ) {
        
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

      } else if (!$("#txtresolucion").val() ) { 
        toastr.error("¡Falta ingresar el número de resolucion");
        elem5 = $('#txtresolucion');
        elem5.css('border-color', 'red');

      } else if (!$("#txtCurso").val() ) { 
        toastr.error("¡Falta ingresar el nombre del curso");
        elem6 = $('#txtCurso');
        elem6.css('border-color', 'red');

      } else if (!$("#selectCiudad").val() ) { 
        toastr.error("¡Falta seleccionar la ciudad!");
        elem7 = $('#selectCiudad');
        elem7.css('border-color', 'red');
        
      } else {
        $.ajax({
          type: 'post',
          url: 'Metodos/Inserta_Curso-Academia.php',
          data: {
              'txtdecre':txtdecre,
              'detalleCursoAcademia':detalleCursoAcademia,
              'txtdata2':txtdata2,
              'txtcargo2':txtcargo2,
              'txtJuez2':txtJuez2,
              'txtTipo2':txtTipo2,
              'txtFunc':txtFunc,
              'txtEstado':txtEstado,
              'turidCA':turid
          },
           success : function(response){
              
              if($.trim(response) === "1"){
        
                  $("#desdeCAM").val(Desde);
                  $("#hastaCAM").val(Hasta);
                  $("#nresolucionCAM").val(Nresolucion);
                  $("#txtcursoCAM").val(Curso);
                  $("#ciudadCAM").val(Ciudad);
                  $("#turidCAM").val(turidCA);
                  $("#detalleCAM").val(detalleCursoAcademia);
                  $("#funcionarioCAM").val(txtFunc);

                  $('#modalCurso-Academia').modal('show');
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