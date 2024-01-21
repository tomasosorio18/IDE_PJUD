<!-- modal_edita_cargo_juez.php  -->
<link rel="stylesheet" href="../Assets/css/modal/Modal-info.css">

<div id="myModal-info_<?php echo $cargos["cargoid"]; ?>" class="modal fade" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-confirm">
      <div class="modal-content">
        <div class="modal-header justify-content-center" id="headerINF">
          <div class="icon-box">
          <i class="fa-solid fa-pen-to-square fa-beat fa-2xl" style="color: #ffffff;"></i>
          </div>
          <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body text-center">
          <h4>Modificar un cargo de juez</h4>	
         
            <div class="alert alert-info">
            ¡Eliga un nuevo nombre para su nuevo cargo de juez!
            </div>
            <div class="row g-3">
              <div class="d-flex align-items-center justify-content-center">
                <div class="col-md-6"> 
                    <label class="form-label" for="formtabs-first-name">Nombre del cargo del juez:</label>
                    <input type="hidden" class ="hiddenCargoid" id="hiddenCargoid" name="cargoid" value="<?php echo $cargos["cargoid"]; ?>">
                    <input type="text" name="txtEditaCargo" id="txtEditaCargo" class="form-control" placeholder="Ingrese nombre cargo"> 
                </div>
                </div>
            </div>

        <br>
          <button class="btn rounded-pill btn-danger" style="margin-right: 5px;" data-bs-dismiss="modal"><span>Cancelar.</span></button>
          <button type="button" class="btn-save btn rounded-pill btn-info"><i class="fa-solid fa-pen-to-square fa-beat fa-2xl"style="margin-right: 5px;"></i> Editar</a>
        </div>
      </div>
    </div>
  </div>     



 