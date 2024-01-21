$(document).ready(function () {
    $('#btnInsertP').on('click',function(){
      var detallePermisos = $("#detallePermisoss").val();
      var txtdecre = $("#txtdecre").val();
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
      var Detalle = $("#detallePermisoss").val();
      var turidP = $("#turidP").val();

      if (detallePermisos == '' ) {
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
    toastr.error("¡Falta rellenar el detalle!");
    elem = $('#detallePermisoss');
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
            url: 'Metodos/Inserta_Permisos.php',
            data: {
                'txtdecre':txtdecre,
                'detallePermisos':detallePermisos,
                'txtdata2':txtdata2,
                'txtcargo2':etxtcargo2,
                'txtJuez2':txtJuez2,
                'txtTipo2':txtTipo2,
                'selectFunc':selectFunc,
                'txtEstado':txtEstado,
                'turidP':turidP 
            },
             success : function(response){
                if($.trim(response) === "1"){
                    toastr.options =
                        {
                        "closeButton" : true,
                        "progressBar" : true
                        }
                      
                        $("#desdePM").val(Desde);
                        $("#hastaPM").val(Hasta);
                        $("#diasPM").val(Dias);
                        $("#ndocumentoPM").val(Ndocumento);
                        $("#dpPM").val(FechaD);
                        $("#detallePM").val(Detalle);
                        $("#funcionarioPM").val(selectFunc);
                        $('#modalPermiso').modal('show');

                    
    //                                        
                }
                if($.trim(response) === "2"){
                    toastr.options =
                        {
                        "closeButton" : true,
                        "progressBar" : true
                        }
                    toastr.error("¡Error al guardar los datos!");
                    $("#btnpdfP").prop('disabled', true);
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
                    $("#btnpdfP").prop('disabled', true);
                   
    //                                       
                }
    
    
            }
    
            });
      }

     
 
   

 
    });

  });