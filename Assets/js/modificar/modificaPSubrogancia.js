$(document).ready(function () {
    $('#btnInsertPS').on('click',function(){
    
      var txtdecre = $("#txtdecrePS").val();
      var detallePS = $("#detallePermisossubrogacionPS").val();
      var txtdata2 = $(".fechaPS").val();
      var txtcargo2 = $(".cargoPS").val();
      var txtJuez2 = $(".selectJuezPS").val();
      var txtTipo2 = $("#txtTipo2PS").val();
      var txtEstado = $("#txtEstadoPS").val();
      var txtAusente = $("#txtAusentePS").val();

      var txtResolucion = $("#txtResolucionPS").val();
      var datepicker2 = $(".fechaResPS").val();
      var txtSubrogante = $(".txtSubrogantePS").val();
      var selectcargoSubrogante = $(".cargoSubPS").val();
      var txtSubroganteMFE = $(".txtSubroganteMFSPS").val();
      var selectcargoMFE = $(".cargoMFEPS").val();
      var turidPS = $("#turidPS").val();
      var txtdias = $("#txtdiasPS").val();

      if (detallePS == '' ) {
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
    toastr.error("¡Falta rellenar el detalle!");
    elem = $('#detallePermisossubrogacionPS');
    elem.css('border-color', 'red');


}else if(!$("#txtAusentePS").val()){
        
    toastr.error("¡Falta seleccionar al funcionario!");
    elem2 = $('#txtAusentePS');
    elem2.css('border-color', 'red');

} else if(!$(".fechaPS").val()) {
toastr.error("¡Falta seleccionar la fecha!");
elem3 = $('.fechaPS');
elem3.css('border-color', 'red');

}else if(!$(".cargoPS").val()){
toastr.error("¡Falta seleccionar el cargo!");
elem4 = $('.cargoPS');
elem4.css('border-color', 'red');

} else if(!$(".selectJuezPS").val()){
toastr.error("¡Falta seleccionar al juez!");
elem5 = $('.selectJuezPS');
elem5.css('border-color', 'red');

}else if(!$("#txtEstadoPS").val()){
toastr.error("¡Falta seleccionar el estado!");
elem6 = $('#txtEstadoPS');
elem6.css('border-color', 'red');
        
      } else {
        $.ajax({
            type: 'post',
            url: 'Metodos/Modifica_Permisos-Subrogancia.php',
            data: {
                'txtdecre':txtdecre,
                'detallePermisossubrogacionPS':detallePS,
                'txtdata2':txtdata2,
                'txtcargo2':txtcargo2,
                'txtJuez2':txtJuez2,
                'txtTipo2':txtTipo2,
                'txtEstado':txtEstado,
                'txtAusente':txtAusente,
                'turidPS':turidPS
            },
             success : function(response){
                if($.trim(response) === "1"){
                    $("#txtEstadoPSM").val(txtEstado);
                    $("#txtcargo2PSM").val(txtcargo2);
                    $("#txtJuez2PSM").val(txtJuez2);
                    $("#selectcargoMFEPSM").val(selectcargoMFE);
                    $("#txtSubroganteMFEPSM").val(txtSubroganteMFE);
                    $("#selectcargoSubrogantePSM").val(selectcargoSubrogante);
                    $("#txtSubrogantePSM").val(txtSubrogante);    
                    $("#txtdiasPSM").val(txtdias);
                    $("#datepicker2PSM").val(datepicker2);   
                    $("#txtResolucionPSM").val(txtResolucion);
                    $("#txtAusentePSM").val(txtAusente);
                    $("#detallePermisossubrogacionPSM").val(detallePS);
                    $("#txtdata2PSM").val(txtdata2);
                    $('#modalPSM').modal('show');          
                }
                if($.trim(response) === "2"){
                    toastr.options =
                        {
                        "closeButton" : true,
                        "progressBar" : true
                        }
                    toastr.error("¡Error al modificar decreto!");          
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