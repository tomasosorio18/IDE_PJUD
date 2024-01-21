<?php 
$anio = Date("Y");
$sentenciaSQL=$conexion->prepare("SELECT 
decreto.DECRETO_N_CORRELATIVO,
juez.JUEZ_NOMBRE,
juez.JUEZ_APELLIDO,
cargo_juez.CARGO_JUEZ_NOMBRE, 
tipo_decreto.DECRETO_TIPO_NOMBRE,
decreto.DECRETO_FECHA_EMISION,
adjunto_firmado.ADJUNTO_FIRMA_NOMBRE,
decreto.DECRETO_EMITIDA_POR
FROM decreto
LEFT JOIN adjunto_firmado on decreto.ADJUNTO_FIRMA_ID = adjunto_firmado.ADJUNTO_FIRMA_ID
INNER JOIN juez on decreto.JUEZ_ID = juez.JUEZ_ID
INNER JOIN tipo_decreto on decreto.DECRETO_TIPO_ID = tipo_decreto.DECRETO_TIPO_ID
LEFT JOIN funcionario on decreto.FUNCIONARIO_ID = funcionario.FUNCIONARIO_ID
LEFT JOIN cargo_juez on juez.CARGO_JUEZ_ID = cargo_juez.CARGO_JUEZ_ID
INNER JOIN tribunal_usu_rol on decreto.TUR_ID = tribunal_usu_rol.TUR_ID
INNER JOIN tribunal on tribunal_usu_rol.TRIBUNAL_ID = tribunal.TRIBUNAL_ID
WHERE decreto.DECRETO_ANIO = :ANIO AND tribunal_usu_rol.TRIBUNAL_ID = :TRIBUNAL_ID AND adjunto_firmado.ADJUNTO_FIRMA_NOMBRE IS NULL
ORDER BY decreto.DECRETO_N_CORRELATIVO;
");
//asignamos las variables a la consulta
$sentenciaSQL->bindParam(":ANIO",$anio);
$sentenciaSQL->bindParam(":TRIBUNAL_ID",$tribunal_id);
$sentenciaSQL->execute();
$listaDecretos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    
    ?>     

                    <div class="table-responsive">


                        <style>
                            .table td.fit, 
                            .table th.fit {
                                white-space: nowrap;
                                width: 1%;
                            }
                        </style>
                        <table class="table table_borderless table-responsive" id="table">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Sin firmar</th>
                                    <th>N° decreto</th>
                                    <th>Cargo juez</th>
                                    <th>Juez</th>
                                    <th>Tipo decreto</th>
                                    <th>Fecha Emision</th>
                                    <th>¡Ir a firmar!</th>
                             
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($listaDecretos as $decretos){ ?>
                                    <tr >
                                                    <!-- luego rellenamos las filas de la tabla gracias al array recorrido -->
                                        <td><?php if(!$decretos['ADJUNTO_FIRMA_NOMBRE']){ ?> <img src="../Assets/images/warningicon.png" style="width: 40px; height: 40px; margin-left:30px;" alt=""><?php } ?></td>
                                        <td><b><?php echo $decretos['DECRETO_N_CORRELATIVO'];?></b></td>
                                        <td><?php echo $decretos['CARGO_JUEZ_NOMBRE'];?></td>
                                        <td><?php echo $decretos['JUEZ_NOMBRE']. " ". $decretos['JUEZ_APELLIDO'];?></td>
                                        <td><?php echo $decretos['DECRETO_TIPO_NOMBRE'];?></td>
                                        <td><?php echo $decretos['DECRETO_FECHA_EMISION'];?></td>
                                        <td><?php if(!$decretos['ADJUNTO_FIRMA_NOMBRE']){?>
                                            <a href="Subir_decretos.php?correlativo=<?php echo $decretos['DECRETO_N_CORRELATIVO'] ?>"><span class="glyphicon glyphicon-edit"></span><img src="../Assets/images/subiricon.png" style="width: 40px; height: 40px; margin-left:30px;" alt=""></a>
                                               <?php }?>
                                        </td>

                              

    
                                                    
                                    </tr>
                                                <?php }?>
                            </tbody>
                        </table>
                    </div>      
   
                    <script>
  function validateForm() {    
  if (document.getElementById('selectAño').value== "none")
  {
    toastr.options =
                    {
                    "closeButton" : true,
                    "progressBar" : true
                    }
                toastr.error("¡Seleccione un año!");    
      document.getElementById('selectAño').style.borderColor = "red"; 
      return false; 
  }    
}
</script> 
<script>
$(document).ready(function(){
$('#table').DataTable({
    dom: 'lrtip',
    "language": {
        "decimal": ",",
        "thousands": ".",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoPostFix": "",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "loadingRecords": "Cargando...",
        "lengthMenu": "Mostrar _MENU_ registros",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
        },
        "processing": "Procesando...",
        "search": "Buscar:",
        "searchPlaceholder": "Término de búsqueda",
        "zeroRecords": "No se encontraron resultados",
        "emptyTable": "Ningún dato disponible en esta tabla",
    }  
});
});	
</script>