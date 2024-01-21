<?php
//se inicia la sesion
session_start();
//se pregunta si existe la variable 'logeado' en las SESSIONS
if (isset($_SESSION['logeado'])) {
    $email=$_SESSION['name'];
    $id= $_SESSION['id'];
    $apellido=$_SESSION['apellido'];
    $rol= $_SESSION['rol'];
    $letra_nombre =mb_substr($email, 0, 1);
    $letra_Apellido =mb_substr($apellido, 0, 1);
    $anio = Date("Y");
    $_SESSION['iniciales'] = $letra_nombre . $letra_Apellido;
    $iniciales = $_SESSION['iniciales'];
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

//incluimos la conexion con la bd 
include("../Configuration/Connector.php");
include("Metodos/Trae_datos_usuario.php");

if($_SESSION['rol'] == 1){
    include("Layouts/Cabecera_admin.php");}else{include("Layouts/Cabecera_user.php");}

?>


<?php
// esta funcion permite asignarle un titulo a cada pagina, mediante el include de la cabecera, sin tener que traer todo el html
$PageTitle="Estadisticas de usuario";

function customPageHeader(){?>
  <!--Arbitrary HTML Tags-->
<?php } ?>

                    <div class="row">
                      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Estadisticas /</span> Estadisticas de usuario</h4>
                  
                    <div class="col-md-6 col-lg-6 col-xl-4 order-0 mb-4">
                        <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between pb-0">
                            <div class="card-title mb-0">
                            <h5 class="m-0 me-2 card-title text-primary">Cantidad de decretos generados </h5>
                            <small class="text-muted">Decretos generados por usted este año <?php echo $anio;?></small>
                            </div>
                            <div class="dropdown">
                            <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                            </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-6">
                            <div class="d-flex flex-column align-items-center gap-1">
                                <h2 class="mb-2" id="cantidad"></h2>
                                <span style="text-align: center;">Decretos generados. </span>
                            </div>
                            <div id="orderStatisticsChart" style="width: 350px; height:300px;margin-left:20px;margin-top:30px;"></div>
                            </div>
                            
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 mb-4">
                        <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title mb-0">
                                <h5 class="card-title text-primary">Decretos generados por usted en cada mes.</h5> 
                                <h6 class="card-subtitle text-muted">Muestra la cantidad de decretos que usted ha generado por mes .</h6>
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
                        <div id="myChart2" ></div>
                        </div>

                        </div>
                        </div>
                    </div> 
                    <div class="col-lg-6 col-12 mb-4">
                        <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title mb-0">
                                <h5 class="card-title text-primary"><span class="badge rounded-pill bg-label-warning">Proximamente...</span> Promedio de decretos en su tribunal</h5> 
                                <h6 class="card-subtitle text-muted">Muestra el promedio de decretos del presente año en su tribunal.</h6>
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
    url: "Metodos/Trae_decretos_por_responsable.php",
    method:"POST",
			data:{action:'fetch'},
    success: function(data) {
    

        const response = JSON.parse(data);
   
        // Extrae las etiquetas y series del objeto de respuesta
        const labels = response.labels;
        const series = response.series;
    

        let sum = 0;

        // iterate over each item in the array
        for (let i = 0; i < series.length; i++ ) {
        sum += series[i];
        }

        $("#cantidad").append(sum);



        const options = {
          labels: labels,
          series: series,
          colors: ["#e25668","#e256ae","#cf56e2","#8a56e2","#5668e2","#56aee2","#56e2cf","#56e289","#aee256","#e2cf56","#e28956"],
          chart: {
            height: '800px',
          type: 'donut',
        },
        legend: {
                show: true,
                position: 'bottom',
                horizontalAlign: 'left'
            },
            plotOptions: {
                pie: {
                donut: {
                    labels: {
                    show: true,
                    value: {
                fontSize: '1.5rem',
                fontFamily: 'Public Sans',
                color: "#1371d6",
                offsetY: -15,
              },
                    name: {
                offsetY: 20,
                fontFamily: 'Public Sans'
              },
                    total: {
                show: true,
                fontSize: '0.8125rem',
                color: "#1371d6",
                fontWeight: "bold",
                label: 'Anual',
              }
                    }
                }
                }
                        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 100
            },                    
          }
        }],
        dataLabels: {
            enabled: false,
            },
        };

        var chart = new ApexCharts(document.querySelector("#orderStatisticsChart"), options);
        chart.render();
      


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
    url: "Metodos/Trae_responsable_por_mes.php",
    method:"POST",
	data:{action:'fetch'},
    success: function(data) {
    

        const response = JSON.parse(data);
   
        // Extrae las etiquetas y series del objeto de respuesta
        const labels = response.labels;
        const series = response.series;
    
        var options = {
          series: [{
            name: "Desktops",
            data: series
        }],
          chart: {
          height: 350,
          type: 'line',
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'straight'
        },
        grid: {
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        xaxis: {
          categories: labels,
        }
        };

        var chart = new ApexCharts(document.querySelector("#myChart2"), options);
        chart.render();


    },
      error: function(data) {
        console.log(data);
    }
    });
  });
  
</script>










<?php if($_SESSION['rol'] == 1){
include("Layouts/Pie_admin.php");}else{
include("Layouts/Pie_user.php");
        }
