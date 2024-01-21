<?php 
$sentenciaSQL=$conexion->prepare("SELECT 
decreto.DECRETO_N_CORRELATIVO,
juez.JUEZ_NOMBRE,
juez.JUEZ_APELLIDO,
cargo_juez.CARGO_JUEZ_NOMBRE, 
tipo_decreto.DECRETO_TIPO_NOMBRE,
funcionario.FUNCIONARIO_NOMBRE,
funcionario.FUNCIONARIO_APELLIDO,
decreto.DECRETO_FECHA_EMISION,
adjunto_inicial.ADJUNTO_INI_NOMBRE,
adjunto_firmado.ADJUNTO_FIRMA_NOMBRE,
decreto.DECRETO_DETALLE,
decreto.DECRETO_EMITIDA_POR
FROM decreto
LEFT JOIN adjunto_inicial on decreto.ADJUNTO_INI_ID = adjunto_inicial.ADJUNTO_INI_ID
LEFT JOIN adjunto_firmado on decreto.ADJUNTO_FIRMA_ID = adjunto_firmado.ADJUNTO_FIRMA_ID
INNER JOIN juez on decreto.JUEZ_ID = juez.JUEZ_ID
INNER JOIN tipo_decreto on decreto.DECRETO_TIPO_ID = tipo_decreto.DECRETO_TIPO_ID
LEFT JOIN funcionario on decreto.FUNCIONARIO_ID = funcionario.FUNCIONARIO_ID
LEFT JOIN cargo_juez on juez.CARGO_JUEZ_ID = cargo_juez.CARGO_JUEZ_ID
INNER JOIN tribunal_usu_rol on decreto.TUR_ID = tribunal_usu_rol.TUR_ID
INNER JOIN tribunal on tribunal_usu_rol.TRIBUNAL_ID = tribunal.TRIBUNAL_ID
WHERE decreto.DECRETO_ANIO = :DECRETO_ANIO AND tribunal_usu_rol.TRIBUNAL_ID = :TRIBUNAL_ID AND decreto.DECRETO_ESTADO = 'Publico'
ORDER BY decreto.DECRETO_N_CORRELATIVO;
");
//asignamos las variables a la consulta
$sentenciaSQL->bindParam(":DECRETO_ANIO",$selectAño);
$sentenciaSQL->bindParam(":TRIBUNAL_ID",$tribunal_id);
$sentenciaSQL->execute();
$listaDecretos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    
    ?>     
    <div class="row">
        <div class="col-md-12 col-lg-12 mt-3">
            <div class="card">
                <div class="card-header flex-grow-0">
                    <div class="d-flex">
                        <div class="avatar flex-shrink-0 me-3">
                            <button type="button" class="btn rounded-pill btn-icon btn-info"><b><?php echo $selectAño; ?></b></button>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-1">
                            <div class="me-2">
                                <h5 class="card-title text-primary mb-3">Informe de decretos del año: <b><span class="badge bg-label-info me-1"><?php echo $selectAño; ?></span></b></h5>
                                <h6 class="card-subtitle text-muted">Muestra un informe completo de todos los decretos del año seleccionado.</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">


                        <style>
                            .table td.fit, 
                            .table th.fit {
                                white-space: nowrap;
                                width: 1%;
                            }
                        </style>
                        <table class="table table-striped table-inverse table-responsive" id="table">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>N° decreto</th>
                                    <th>Cargo juez</th>
                                    <th>Juez</th>
                                    <th>Tipo decreto</th>
                                    <th>Fecha Emision</th>
                                    <th hidden>Anular</th>
                                    <th hidden>Anular</th>
                                    <th>Adjunto Original</th>
                                    <th hidden>Anular</th>
                                    <th>Adjunto Final</th>
                                    <th>Campo Detalle</th>
                                    <th>Emitida por</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($listaDecretos as $decretos){ ?>
                                    <tr >
                                                    <!-- luego rellenamos las filas de la tabla gracias al array recorrido -->
                                        <td><b><?php echo $decretos['DECRETO_N_CORRELATIVO'];?></b></td>
                                        <td><?php echo $decretos['CARGO_JUEZ_NOMBRE'];?></td>
                                        <td><?php echo $decretos['JUEZ_NOMBRE']. " ". $decretos['JUEZ_APELLIDO'];?></td>
                                        <td><?php echo $decretos['DECRETO_TIPO_NOMBRE'];?></td>
                                        <td><?php echo $decretos['DECRETO_FECHA_EMISION'];?></td>
                                        <td hidden><?php echo $selectAño;?></td>
                                        <td hidden><?php echo $decretos['ADJUNTO_INI_NOMBRE'];?></td>
                                        <td>
                                                <?php if($decretos['ADJUNTO_INI_NOMBRE']){?>
                                                <a href="#" data-bs-target="#modal_<?php echo $decretos['DECRETO_N_CORRELATIVO']; ?>" data-bs-toggle="modal"><span class="glyphicon glyphicon-edit"></span><img src="../Assets/images/adjunto_original.png" style="width: 40px; height: 40px; margin-left:30px;" alt=""></a>
                                                <?php }?>
                                        </td>
                                        <td hidden><?php echo $decretos['ADJUNTO_FIRMA_NOMBRE'];?></td>
                                        <td><?php if($decretos['ADJUNTO_FIRMA_NOMBRE']){?>
                                                <a href="#" data-bs-target="#edit_<?php echo $decretos['DECRETO_N_CORRELATIVO']; ?>" data-bs-toggle="modal"><span class="glyphicon glyphicon-edit"></span><img src="../Assets/images/adjunto.png" style="width: 40px; height: 40px; margin-left:30px;" alt=""></a>

                                                <?php }?>
                                        </td>
                                        <td><?php      $detalle = $decretos['DECRETO_DETALLE'];
                                                        if($detalle == "ANULADO"){ ?> <span class="badge bg-label-dark"><?php echo $detalle; ?> </span><?php }else{ echo $detalle; }
                                                        
                                      ?></td>
                                        <td><b>
                                                        <?php echo $decretos['DECRETO_EMITIDA_POR'];?>
                                                        </b>
                                        </td>      
                                                    <!-- incluimos las dos ventanas modales -->
                                                    
                                                    <?php include('Adjuntos/Modal_AI_User.php'); ?>  
                                                    <?php include('Adjuntos/Modal_AF_User.php'); ?>
                                                    
                                    </tr>
                                                <?php }?>
                            </tbody>
                        </table>
                    </div>      
                </div>
            </div>
        </div>
    </div>

    