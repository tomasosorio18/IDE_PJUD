$(document).ready(function(){
    $("#selectJuez").change(function(){
        var selectid = $("#selectJuez").val();

        $.ajax({
            url: 'Metodos/Trae_cargos.php',
            method: 'GET',
            data: {'selectJuez' : selectid},
            success: function(response) {
                if (response == "2"){  
                    
                    toastr.error("¡Error al traer datos!");
                }else{
                  
                    $('#selectCargoVista').html(response); 
                    $("#selectCargo").html(response);
                }
            }   
          });
    });
    $("#txtSubrogante").change(function(){
        var selectsid = $("#txtSubrogante").val();

        $.ajax({
            url: 'Metodos/Trae_cargos.php',
            method: 'GET',
            data: {'txtSubrogante' : selectsid},
            success: function(response) {
                if (response == "2"){  
                    
                    toastr.error("¡Error al traer datos!");
                }else{
                  
                    $('#selectcargoSubroganteVista').html(response); 
                    $("#selectcargoSubrogante").html(response);
                }
            }   
          });
    });
    $("#txtSubroganteMFE").change(function(){
        var selectMFEid = $("#txtSubroganteMFE").val();

        $.ajax({
            url: 'Metodos/Trae_cargos.php',
            method: 'GET',
            data: {'txtSubroganteMFE' : selectMFEid},
            success: function(response) {
                if (response == "2"){  
                    
                    toastr.error("¡Error al traer datos!");
                }else{
                  
                    $('#selectcargoMFEVista').html(response); 
                    $("#selectcargoMFE").html(response);
                }
            }   
          });
    });

});