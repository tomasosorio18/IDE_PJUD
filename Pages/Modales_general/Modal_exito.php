<link rel="stylesheet" href="../Assets/css/modal/modal-exito.css">
 
<div id="modalexito" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-confirm">
      <div class="modal-content">
        <div class="modal-header justify-content-center" id="headerSUC">
          <div class="icon-box">
          <i class="fa-regular fa-circle-check fa-beat fa-2xl" style="color: #ffffff;"></i>
          </div>
          <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body text-center">
          <h4>Accion realizada con exito!</h4>	
        
            <div id="span" class="alert alert-success">
             ¡Agregado con exito!
            </div>
        <br>
          <button id="btnAceptar" class="btn rounded-pill btn-success" style="margin-right: 5px;" data-bs-dismiss="modal"><span>Aceptar.</span></button>
        </div>
      </div>
    </div>
  </div>   
  
  <script>
      $(document).ready(function () {
    $('#btnAceptar').on('click',function(){
      location.href = window.location.pathname;
    });
  });
  </script>