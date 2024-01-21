$(document).ready(function(){
    $('#div_final').hide();
    $('#selectdecreto').change(function(){
        var decreto =document.getElementById("selectdecreto").value;
        var anio = document.getElementById("txtanio").value;
 
        $.ajax({
            type: 'get',
            url: 'Trae_Decreto.php',
            data: {
                'decreto':decreto
            },
             success : function(response){
    
    
               var datos = JSON.parse(response);
                
               $('#date').val(datos.fecha);
                $('#txtjuez').val(datos.txtjuez);
                $('#txtdecreto').val(datos.txtdecreto);

               if(datos.adjuntoFinal === null){
                $('#div_final').hide();
               }else{
                $("#aaa").attr("href", "Modificar_Decretos.php?file_id=" + decreto + "&anio=" + anio);
                $('#div_final').show();
                
               }
              
    
    
        }
    
    
          });

    });
    
    
    
    });
    