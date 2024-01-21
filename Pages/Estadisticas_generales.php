<?php
//se inicia la sesion
session_start();
//se pregunta si existe la variable 'logeado' en las SESSIONS
if (isset($_SESSION['logeado'])) {
    $id= $_SESSION['id'];
    $email=$_SESSION['name'];
    $apellido=$_SESSION['apellido'];
    $rol= $_SESSION['rol'];
    $letra_nombre =mb_substr($email, 0, 1);
    $letra_Apellido =mb_substr($apellido, 0, 1);

    $_SESSION['iniciales'] = $letra_nombre . $letra_Apellido;
  
    session_write_close();
} else {
    // Ya que el nombre no esta asignado en una session, el usuario no esta logeado
    // Y esta intentando ingresar sin autorizacion
    // Asi que limpiamos todas las variables de session y lo enviamos al login.
    session_unset();
    session_write_close();
    $url = "../Index.php?sesion=permisos";
    header("Location: $url");
}
if ($_SESSION['rol']== 2) {
// si el rol almecenado en la variable SESSION es 1, quiere decir que el rol que posee es de administrador y como
// este menu es unicamente para usuarios, debemos redireccionarlo al login
    session_unset();
    session_write_close();
    session_destroy();
    header('Location: ../Index.php?sesion=permisos');
}
?>
<!-- incluimos la conexion con la bd  -->
<?php
//incluimos la conexion con la bd 
include("../Configuration/Connector.php");
include("Metodos/Trae_datos_usuario.php");?>

<?php
// esta funcion permite asignarle un titulo a cada pagina, mediante el include de la cabecera, sin tener que traer todo el html
$PageTitle="Estadisticas generales";

function customPageHeader(){?>
  <!--Arbitrary HTML Tags-->
<?php } ?>
<?php
include("Layouts/Cabecera_admin.php")
?>


                    <div class="row">
                      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Estadisticas /</span> Estadisticas de decretos</h4>
                  
                    <div class="col-lg-6 col-12 mb-4" >
                        <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title mb-0">
                                <h5 class="card-title text-primary">Cantidad de decretos por mes</h5>
                                <h6 class="card-subtitle text-muted">Muestra la cantidad de decretos que se generan por mes.</h6>
                            </div>
                            
                            <div class="card-header-elements ms-auto py-0 dropdown">
                            <button type="button" class="btn dropdown-toggle hide-arrow p-0" id="heat-chart-dd" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="heat-chart-dd">
                                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                            </div>
                            </div>
                        </div>
                        <div class="card-body">
                            
                        <div id="chart-container">
                        <canvas id="myGraph" ></canvas>
                        </div>

                        </div>
                        </div>
                    </div> 

                    <div class="col-lg-6 col-12 mb-4">
                        <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title mb-0">
                                <h5 class="card-title text-primary">Cantidad de decretos por estado.</h5>
                                <h6 class="card-subtitle text-muted">Muestra la cantidad de decretos que se generan por estado.</h6>
                            </div>
                            
                            <div class="card-header-elements ms-auto py-0 dropdown">
                            <button type="button" class="btn dropdown-toggle hide-arrow p-0" id="heat-chart-dd" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="heat-chart-dd">
                                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                            </div>
                            </div>
                        </div>
                        <div class="card-body">
                            
                        <div id="chart-container">
                        <canvas id="myGraph2" ></canvas>
                        </div>

                        </div>
                        </div>
                    </div> 
                    <div class="col-lg-6 col-6 mb-4">
                        <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title mb-0">
                                <h5 class="card-title text-primary">cantidad de decretos por tipo</h5>
                                <h6 class="card-subtitle text-muted">Muestra la cantidad de decretos que se generan por tipo.</h6>
                            </div>
                            
                            <div class="card-header-elements ms-auto py-0 dropdown">
                            <button type="button" class="btn dropdown-toggle hide-arrow p-0" id="heat-chart-dd" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="heat-chart-dd">
                                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                            </div>
                            </div>
                        </div>
                        <div class="card-body">
                            
                        <div id="chart-container">
                        <canvas id="graphCanvas" style="width: 100px;height: 100px;" ></canvas>
                        </div>

                        </div>
                        </div>
                    </div> 
                    <div class="col-lg-6 col-12 mb-4" >
                        <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title mb-0">
                                <h5 class="card-title text-primary">Por cargos de jueces</h5>
                                <h6 class="card-subtitle text-muted">Muestra cual es el cargo que mas decretos firma a lo largo del año.</h6>
                            </div>
                            
                            <div class="card-header-elements ms-auto py-0 dropdown">
                            <button type="button" class="btn dropdown-toggle hide-arrow p-0" id="heat-chart-dd" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="heat-chart-dd">
                                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                            </div>
                            </div>
                        </div>
                        <div class="card-body">
                            
                        <div id="chart-container"style="height: 630px;">
                        <canvas id="myGraph4"  ></canvas>
                        </div>

                        </div>
                        </div>
                    </div> 
                    <div class="col-lg-6 col-12 mb-4">
                        <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title mb-0">
                                <h5 class="card-title text-primary"><span class="badge rounded-pill bg-label-warning">Proximamente...</span> Cantidad de decretos por tribunal.</h5> 
                                <h6 class="card-subtitle text-muted">Muestra la cantidad de decretos que se generan por tribunal.</h6>
                            </div>
                           
                            <div class="card-header-elements ms-auto py-0 dropdown">
                            <button type="button" class="btn dropdown-toggle hide-arrow p-0" id="heat-chart-dd" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="heat-chart-dd">
                                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                            </div>
                            </div>
                        </div>
                        <div class="card-body">
                            
                        <div id="chart-container">
                        <canvas id="myGraph3" ></canvas>
                        </div>

                        </div>
                        </div>
                    </div> 

          
                    </div>

                    <script>
$(document).ready(function(){
  $.ajax({
    url: "Metodos/Trae_datos_estadistica.php",
    method:"POST",
			data:{action:'fetch'},
			dataType:"JSON",
    success: function(data) {
    
      var decreto_nombre = [];
      var cantidad = [];

      // Recorre el arreglo de datos y agrega los valores correspondientes a los arreglos respectivos
      for(var count = 0; count < data.length; count++)
				{
					decreto_nombre.push(data[count].decreto_nombre);
					cantidad.push(data[count].cantidad);
				
				}

      var chartdata = {
        labels: decreto_nombre,
        datasets : [
          {
            label: 'Cantidad de decretos',
            backgroundColor : [
                        "#fca8a2",
                        "#a2e1fc",
                        "#a9fcaf",
                        "#f0adef",
                        "#fff9c2",
                        "#d0f5f4",
                        "#f54a45",
                        "#9d45f5",
                        "#4c54ed",
                        "#4e9c3b",
                        "#ff9c2b"

                    ],
            borderColor: 'rgba(200, 200, 200, 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: cantidad
          }
        ]
      };

      var ctx = $("#graphCanvas");

      var barGraph = new Chart(ctx, {
        type: 'doughnut',
        data: chartdata
      });
    },
    error: function(data) {
     
    }
  });
});
</script>

<script>
$(document).ready(function(){
  $.ajax({
    url: "Metodos/Trae_decretos_por_mes.php",
    method:"POST",
			data:{action:'fetch'},
			dataType:"JSON",
    success: function(data) {
      console.log(data);
      
      var mes = [];
      var cantidad = [];

      // Recorre el arreglo de datos y agrega los valores correspondientes a los arreglos respectivos
      for(var count = 0; count < data.length; count++)
				{
					mes.push(data[count].mes);
					cantidad.push(data[count].cantidad);
				
				}

      var chartdata = {
        labels: mes,
        datasets : [
          {
            label: 'Mes',
            backgroundColor : [
                        "#fca8a2",
                        "#a2e1fc",
                        "#a9fcaf",
                        "#f0adef",
                        "#fff9c2",
                        "#d0f5f4",
                        "#f54a45",
                        "#9d45f5",
                        "#4c54ed",
                        "#4e9c3b",
                        "#ff9c2b"

                    ],
            borderColor: 'rgba(200, 200, 200, 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: cantidad
          }
        ]
      };

      var ctx = $("#myGraph");

      var barGraph = new Chart(ctx, {
        type: 'line',
        data: chartdata,
        options: {
                                  scales: {
                                      y: {
                                          beginAtZero: true
                                      }
                                  }
                              }
      });
    },
    error: function(data) {
      console.log(data);
    }
  });
});
</script>

<script>
$(document).ready(function(){
  $.ajax({
    url: "Metodos/Trae_decretos_por_estado.php",
    method: "POST",
    data: { action: 'fetch' },
    dataType: "JSON",
    success: function(response) {
      console.log(response);

      var data1 = response.publicos;
      var data2 = response.privados;

      var decreto_estado1 = [];
      var cantidad1 = [];
      var mes1 = {};
      var decreto_estado2 = [];
      var cantidad2 = [];
      var mes2 = {};

      for(var count = 0; count < data1.length; count++) {
        decreto_estado1.push(data1[count].decreto_estado);
        cantidad1.push(data1[count].cantidad);
        mes1[data1[count].mes] = data1[count].mes; // Utilizamos un objeto para almacenar los meses únicos
      }

      for(var count = 0; count < data2.length; count++) {
        decreto_estado2.push(data2[count].decreto_estado);
        cantidad2.push(data2[count].cantidad);
        mes2[data2[count].mes] = data2[count].mes;
      }

      var uniqueMonths = Object.values({...mes1, ...mes2}); // Obtenemos los meses únicos

      var chartdata = {
        labels: uniqueMonths, // Utilizamos los meses únicos como etiquetas
        datasets: [
          {
            label: 'Publicos',
            backgroundColor: "#05deff",
            borderColor: 'rgba(200, 200, 200, 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: getChartData(uniqueMonths, data1) // Función para obtener los datos correctos
          },
          {
            label: 'Reservado',
            backgroundColor: "#ffde05",
            borderColor: 'rgba(200, 200, 200, 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: getChartData(uniqueMonths, data2) // Función para obtener los datos correctos
          }
        ]
      };

      var ctx = $("#myGraph2");

      var barGraph = new Chart(ctx, {
        type: 'bar',
        data: chartdata,
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    },
    error: function(data) {
      console.log(data);
    }
  });
});

// Función para obtener los datos correspondientes a los meses únicos
function getChartData(uniqueMonths, data) {
  var chartData = [];
  for (var i = 0; i < uniqueMonths.length; i++) {
    var month = uniqueMonths[i];
    var found = data.find(item => item.mes === month);
    if (found) {
      chartData.push(found.cantidad);
    } else {
      chartData.push(0);
    }
  }
  return chartData;
}
</script>


<script>
$(document).ready(function(){
  $.ajax({
    url: "Metodos/Trae_cargos_por_decretos.php",
    method:"POST",
			data:{action:'fetch'},
			dataType:"JSON",
    success: function(data) {
    
      var cargo = [];
      var cantidad = [];

      // Recorre el arreglo de datos y agrega los valores correspondientes a los arreglos respectivos
      for(var count = 0; count < data.length; count++)
				{
					cargo.push(data[count].cargo);
					cantidad.push(data[count].cantidad);
				
				}

      var chartdata = {
        labels: cargo,
        datasets : [
          {
            label: 'Cantidad de decretos',
            backgroundColor : [                 
                        "#a9fcaf"


                    ],
            borderColor: 'rgba(200, 200, 200, 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: cantidad
          }
        ]
      };

      var ctx = $("#myGraph4");

      var barGraph = new Chart(ctx, {
        type: 'bar',
        data: chartdata,
        options: {
          indexAxis: 'y',
          scales: {
            y: {
              beginAtZero: true
            }
          },
          
        }
      });
    },
    error: function(data) {
     
    }
  });
});
</script>








<?php if($_SESSION['rol'] == 1){
include("Layouts/Pie_admin.php");}else{
include("Layouts/Pie_user.php");
        }
