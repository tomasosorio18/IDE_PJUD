$(document).ready(function () {
    $('#btnInsertP').on('click',function(){
       
   
  
      var txtdecre = $("#txtdecreP").val();
      var detallePermisos = $("#detallePermisosP").val();
      var txtdata2 = $(".fechaP").val();
      var txtcargo2 = $(".cargoP").val();
      var txtJuez2 = $(".selectJuezP").val();
      var txtTipo2 = $("#txtTipo2P").val();
      var selectFunc = $("#selectFuncP").val();
      var txtEstado = $("#txtEstadoP").val();

      var Desde = $(".desdeP").val();
      var Hasta = $(".hastaP").val();
      var Dias = $(".diasP").val();
      var Ndocumento = $("#txtdocumentoP").val();
      var FechaD = $(".fechaDilP").val();
      var turidP = $("#turidP").val();
 
      if (detallePermisos == '' ) {
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
    toastr.error("¡Falta rellenar el detalle!");
    elem = $('#detallePermisosP');
    elem.css('border-color', 'red');


  } else if (!$('#selectFuncP').val() ) {
        
    toastr.error("¡Falta seleccionar al funcionario!");
    elem2 = $('#selectFuncP');
    elem2.css('border-color', 'red');
  } else if(!$(".fechaP").val()) {
    toastr.error("¡Falta seleccionar la fecha!");
    elem3 = $('.fechaP');
    elem3.css('border-color', 'red');

  }else if(!$(".cargoP").val()){
    toastr.error("¡Falta seleccionar el cargo!");
    elem4 = $('.cargoP');
    elem4.css('border-color', 'red');

  } else if(!$(".selectJuezP").val()){
    toastr.error("¡Falta seleccionar al juez!");
    elem5 = $('.selectJuezP');
    elem5.css('border-color', 'red');

  }else if(!$("#txtEstadoP").val()){
    toastr.error("¡Falta seleccionar el estado!");
    elem6 = $('#txtEstadoP');
    elem6.css('border-color', 'red');
  } else {

        $.ajax({
            type: 'post',
            url: 'Metodos/ModificaPermisos.php',
            data: {
                'txtdecre':txtdecre,
                'detallePermisosP':detallePermisos,
                'txtdata2':txtdata2,
                'txtcargo2':txtcargo2,
                'txtJuez2':txtJuez2,
                'txtTipo2':txtTipo2,
                'selectFunc':selectFunc,
                'txtEstado':txtEstado,
                'turidP': turidP

            },
             success : function(response){
                if($.trim(response) === "1"){
                  $("#txtdata2PM").val(txtdata2);
                  $("#txtEstadoPM").val(txtEstado);
                  $("#txtcargo2PM").val(txtcargo2);
                  $("#txtJuez2PM").val(txtJuez2);
                  $("#desdePM").val(Desde);
                  $("#hastaPM").val(Hasta);
                  $("#diasPM").val(Dias);
                  $("#ndocumentoPM").val(Ndocumento);
                  $("#dpPM").val(FechaD);
                  $("#funcionarioPM").val(selectFunc); 
                  $('#modalPermisosP').modal('show');
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