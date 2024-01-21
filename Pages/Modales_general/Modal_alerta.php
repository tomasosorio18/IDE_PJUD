<link rel="stylesheet" href="../Assets/css/modal/Modal-warning.css">

<div id="myModal-warning" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-warning">
      <div class="modal-content">
        <div class="modal-header justify-content-center" id="headerWar">
          <div class="icon-box">
          <i class="fa-solid fa-power-off fa-beat fa-2xl" style="color: #ffffff;"></i>
          </div>
          <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body text-center">
          <h4>Cerrar sesion</h4>	
          <!-- <p>Ocurrio un error al procesar la infraccion!.</p> -->
            <div class="alert alert-warning">
            ¿Esta seguro que desea cerrar sesion?
            </div>
        <br>
          <button class="btn rounded-pill btn-secondary" data-bs-dismiss="modal"><span>Cancelar.</span> <i class="fa-solid fa-ban"></i></button>
          <a href="../Auth/Logout.php" class="btn rounded-pill btn-warning"><span>Cerrar sesión.</span> <i class="fa-solid fa-circle-check"></i></a>
        </div>
      </div>
    </div>
  </div>     