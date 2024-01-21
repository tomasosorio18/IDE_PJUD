$(document).ready(function () {
    // Listen to submit event on the <form> itself!
    $('#btnInsertCA').on('click',function(){

      var txtdecre = $("#txtdecreCA").val();
      var detalleCA = $("#detalleCA").val();
      var txtdata2 = $(".fechaCA").val();
      var txtcargo2 = $(".cargoCA").val();
      var txtJuez2 = $(".selectJuezCA").val();
      var txtTipo2 = $("#txtTipo2CA").val(); 
      var selectFunc = $(".selectFuncCA").val();
      var txtEstado = $("#txtEstadoCA").val();

       
      var Desde = $(".desdeCA").val();
      var Hasta = $(".hastaCA").val();
      var Nresolucion = $("#txtresolucionCA").val();
      var Ciudad = $("#selectCiudadCA").val();
      var Curso = $("#txtCursoCA").val();
      var turidCA = $("#turidCA").val();
     alert(txtdecre);

      if (detalleCA == '' ) {
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
    toastr.error("¡Falta rellenar el detalle!");
    elem = $('#detalleCA');
    elem.css('border-color', 'red');
 

      } else if (!$(".selectFuncCA").val() ) {
        
        toastr.error("¡Falta seleccionar al funcionario!");
        elem2 = $('.selectFuncCA');
        elem2.css('border-color', 'red');
        
      } else if(!$(".fechaCA").val()) {
        toastr.error("¡Falta seleccionar la fecha!");
        elem3 = $('.fechaCA');
        elem3.css('border-color', 'red');

      }else if(!$(".cargoCA").val()){
        toastr.error("¡Falta seleccionar el cargo!");
        elem4 = $('.cargoCA');
        elem4.css('border-color', 'red');

      } else if(!$(".selectJuezCA").val()){
        toastr.error("¡Falta seleccionar al juez!");
        elem5 = $('.selectJuezCA');
        elem5.css('border-color', 'red');

      }else if(!$("#txtEstadoCA").val()){
        toastr.error("¡Falta seleccionar el estado!");
        elem6 = $('#txtEstadoCA');
        elem6.css('border-color', 'red');

      }else{
 
        $.ajax({
            type: 'post',
            url: 'Metodos/ModificaCursoAcademia.php',
            data: {
                'txtdecre':txtdecre,
                'detalleCursoAcademia':detalleCA,
                'txtdata2':txtdata2,
                'txtcargo2':txtcargo2,
                'txtJuez2':txtJuez2,
                'txtTipo2':txtTipo2,
                'selectFunc':selectFunc,
                'txtEstado':txtEstado,
                'turidCAM': turidCA
            },
             success : function(response){

                if($.trim(response) === "1"){
                    toastr.options =
                        {
                        "closeButton" : true,
                        "progressBar" : true
                        }
                        
                        $("#txtEstadoCAM").val(txtEstado);
                        $("#txtcargo2CAM").val(txtcargo2);
                        $("#txtJuez2CAM").val(txtJuez2);
                        $("#desdeCAM").val(Desde);
                        $("#hastaCAM").val(Hasta);
                        $("#nresolucionCAM").val(Nresolucion);
                        $("#detalleCAM").val(detalleCAM);
                        $("#txtcursoCAM").val(Curso);
                        $("#ciudadCAM").val(Ciudad);
                        $("#funcionarioCAM").val(selectFunc);
                        $("#txtdata2CAM").val(txtdata2);
                        $('#modalCurso-AcademiaM').modal('show');
    //                                        
                }
                if($.trim(response) === "2"){
                    toastr.options =
                        {
                        "closeButton" : true,
                        "progressBar" : true
                        }
                    toastr.error("¡Error al modificar el decreto!");
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