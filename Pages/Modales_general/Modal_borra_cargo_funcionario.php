<!-- modal_edita_cargo_juez.php  -->
<link rel="stylesheet" href="../Assets/css/modal/Modal-danger.css">

<div id="myModal-danger_<?php echo $cargos["cargoid"];?>" class="modal fade" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-confirm">
      <div class="modal-content">
        <div class="modal-header justify-content-center" id="headerDAN">
          <div class="icon-box">
          <i class="fa-solid fa-trash fa-beat fa-2xl" style="color: #ffffff;"></i>
          </div>
          <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body text-center">
          <h4>Dar de baja un cargo de funcionario.</h4>	
          <input type="hidden" class ="borraCargoid" id="borraCargoid" name="borracargoid" value="<?php echo $cargos["cargoid"]; ?>">
            <div class="alert alert-danger">
            Esta a punto de dar de baja el cargo de nombre: <br>
            "<b style="white-space: pre-wrap;line-height: 1.5;"><?php echo $cargos["CARGO_FUNC_NOMBRE"];?></b>" <br>junto con todos los funcionarios pertenecientes al cargo, ¿Esta seguro?
            </div>
        <br>
          <button class="btn rounded-pill btn-secondary" style="margin-right: 5px;" data-bs-dismiss="modal"><span>Cancelar.</span></button>
          <button type="button" class="btn-delete btn rounded-pill btn-danger"><i class="fa-solid fa-trash fa-beat fa-lg" style="margin-right: 5px;"></i> Dar de baja</a>
        </div>
      </div>
    </div>
  </div>     



 