<link rel="stylesheet" href="../Assets/css/modal/Modal-primary.css">

<div id="myModal-primary" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-confirm">
      <div class="modal-content">
        <div class="modal-header justify-content-center" id="headerPRM">
          <div class="icon-box">
          <i class="fa-regular fa-circle-plus fa-beat fa-2xl" style="color: #ffffff;"></i>
          </div>
          <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body text-center">
          <h4>Agregar un nuevo cargo de juez</h4>	
        
            <div class="alert alert-primary">
            ¡Eliga un nombre para su nuevo cargo de juez!
            </div>
            <div class="row g-3">
              <div class="d-flex align-items-center justify-content-center">
                <div class="col-md-6"> 
                    <label class="form-label" for="formtabs-first-name">Nombre del cargo del juez:</label>
                    <input type="text" name="txtNombreCargo" id="txtNombreCargo" class="form-control" placeholder="Ingrese nombre cargo"> 
                </div>
                </div>
            </div>

        <br>
          <button class="btn rounded-pill btn-danger" style="margin-right: 5px;" data-bs-dismiss="modal"><span>Cancelar.</span></button>
          <button type="text" class="btn rounded-pill btn-primary" name="agregacargojuez" id="agregacargojuez"><span> Agregar</span></a>
        </div>
      </div>
    </div>
  </div>     

  <script src="../Assets/js/cargo_juez/insertaCargoJuez.js"></script>   