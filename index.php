<?php
// Este es el archivo con el que vemos los bienes guardados
require 'controllers/ver.php';
// Leemos y traemos los datos del .json
$datos = file_get_contents("./data-1.json");
$inmuebles = json_decode($datos, true);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/customColors.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/index.css" media="screen,projection"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Formulario</title>
</head>

<body>
<video src="img/video.mp4" id="vidFondo"></video>

<div class="contenedor">
    <div class="card rowTitulo">
      <h1>Bienes Intelcost</h1>
    </div>
    <div class="colFiltros">
      <form action="" method="post" id="formulario">
        <div class="filtrosContenido">
          <div class="tituloFiltros">
            <h5>Filtros</h5>
          </div>
          <div class="filtroCiudad input-field">
            <p><label for="selectCiudad">Ciudad:</label><br></p>
            <select name="ciudad" id="selectCiudad">
              <option value="" selected>Elige una ciudad</option>
              <!-- Imprimimos las ciudades -->
              <?php
              // Arreglamos el array con ciudades unicas
              for ($i = 0; $i <= 1; $i++) {
                foreach ($inmuebles as $ciudad) {
                  $ciudades[] = $ciudad["Ciudad"];
                }
              }
              $ciudades = array_unique($ciudades);
              // Imprimimo las cidades en el select
              foreach ($ciudades as $ciudad) {
                echo "" ?>
                <option value="<?php echo $ciudad ?>"><?php echo $ciudad ?></option>
              <?php } ?>
              <!-- Fin de las ciudades -->
            </select>
          </div>
          <div class="filtroTipo input-field">
            <p><label for="selecTipo">Tipo:</label></p>
            <br>
            <select name="tipo" id="selectTipo">
              <option value="">Elige un tipo</option>
              <!-- Imprimimos las tipos -->
              <?php
              // Arreglamos el array con tipos unicos
              for ($i = 0; $i <= 1; $i++) {
                foreach ($inmuebles as $tipo) {
                  $tipos[] = $tipo["Tipo"];
                }
              }
              $tipos = array_unique($tipos);
              // Imprimimo los tipos en el select
              foreach ($tipos as $tipo) {
                echo "" ?>
                <option value="<?php echo $tipo ?>"><?php echo $tipo ?></option>
              <?php } ?>
              <!-- Fin de los tipos -->
            </select>
          </div>
          <div class="filtroPrecio">
            <label for="rangoPrecio">Precio:</label>
            <input type="text" id="rangoPrecio" name="precio" value="" />
          </div>
          <div class="botonField">
            <input type="button" class="btn white" value="Buscar" id="submitButton" onclick="obtenerDatos();">
          </div>
        </div>
      </form>
    </div>
    <div id="tabs" style="width: 75%;">
        <ul>
            <li><a href="#tabs-1">Bienes disponibles</a></li>
            <li><a href="#tabs-2">Mis bienes</a></li>
            <li><a href="#tabs-3">Reportes</a></li>
        </ul>
        <div id="tabs-1">
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Resultados de la búsqueda: <span id="numResultados"></span></h5>
            <div class="divider">
            </div>
            <!-- Estilo de la tarjeta agregado -->
            <div class="tarjeta">
              <div class="row">
                <!-- Agregamos los datos del .json -->
                <?php
                foreach ($inmuebles as $inmueble) {
                  echo "" ?>
                  <div id="<?php echo $inmueble["Id"] ?>">
                    <div class="col s4 imagen">
                      <img  alt="" src="./img/home.jpg" width="130px">
                    </div>
                    <div class="col s8">
                      Direccion: <?php echo $inmueble["Direccion"] ?><br>
                      Ciudad: <?php echo $inmueble["Ciudad"] ?><br>
                      Telefono: <?php echo $inmueble["Telefono"] ?><br>
                      Codigo_Postal: <?php echo $inmueble["Codigo_Postal"] ?><br>
                      Tipo: <?php echo $inmueble["Tipo"] ?><br>
                      Precio: <?php echo $inmueble["Precio"] ?><br>
                      <form action="./controllers/agregar.php" method="post">
                        <input style="display: none;" type="text" name="Id_json" id="Id_json" value="<?php echo $inmueble["Id"] ?>">
                        <input style="display: none;" type="text" name="Direccion" id="Direccion" value="<?php echo $inmueble["Direccion"] ?>">
                        <input style="display: none;" type="text" name="Ciudad" id="Ciudad" value="<?php echo $inmueble["Ciudad"] ?>">
                        <input style="display: none;" type="text" name="Telefono" id="Telefono" value="<?php echo $inmueble["Telefono"] ?>">
                        <input style="display: none;" type="text" name="Codigo_Postal" id="Codigo_Postal" value="<?php echo $inmueble["Codigo_Postal"] ?>">
                        <input style="display: none;" type="text" name="Tipo" id="Tipo" value="<?php echo $inmueble["Tipo"] ?>">
                        <input style="display: none;" type="text" name="Precio" id="Precio" value="<?php echo $inmueble["Precio"] ?>">
                        <input class="btn waves-effect waves-light float-right " style="width: 50%;" type="submit" name="action"  value="Guardar">
                      </form>
                    </div>
                  </div>
                  <hr>
                <?php
                }
                ?>
              </div>
            </div>
            <!-- Final de datos .json -->
            <!-- Mostrando datos de busqueda -->
            <div id="busqueda">
              <!-- Se insertan los datos desde js -->
            </div>
            <!-- Final de datos de busqueda -->
          </div>
        </div>
      </div>

      <div id="tabs-2">
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Bienes guardados:</h5>
            <div class="divider"></div>
            <!-- Agregamos datos desde la BD  -->
            <div class="tarjeta">
              <div class="row">
                <?php
                if (is_array($resultados) || is_object($resultados))
                {
                foreach ($resultados as $resultado) {
                  echo "" ?>
                  <div id="<?php echo $resultado["id"] ?>">
                    <div class="col s4 imagen">
                      <img style="float: right;" alt="" src="./img/home.jpg" width="130px">
                    </div>
                    <div class="col s8">
                      Direccion: <?php echo $resultado["direccion"] ?><br>
                      Ciudad: <?php echo $resultado["ciudad"] ?><br>
                      Telefono: <?php echo $resultado["telefono"] ?><br>
                      Codigo_Postal: <?php echo $resultado["codigo_postal"] ?><br>
                      Tipo: <?php echo $resultado["tipo"] ?><br>
                      Precio: <?php echo $resultado["precio"] ?><br>
                      <form action="./controllers/eliminar.php" method="post">
                        <input style="display: none;" type="num" name="id" id="id" value="<?php echo $resultado["id"] ?>">
                        <input class="btn waves-effect waves-light float-right " style="width: 50%;" type="submit" name="action"  value="Eliminar">
                      </form>
                    </div>
                  </div>
                  <hr>
                <?php
                }
              }
                ?>
              </div>
            </div>
            <!-- Final de datos BD -->
          </div>
        </div>
      </div>
        <div id="tabs-3">
            <div class="colContenido" id="divReportes">
                <div class="tituloContenido card" style="justify-content: center;">
                    <h5>Exportar reporte:</h5>
                    <div class="divider"></div>

                    <div class="containerReporte">
                        <div class="tituloFiltros">
                            <h5>Filtros</h5>
                        </div>

                        <form action="views/reporte.php" method="post">
                        <div class="filtroCiudad input-field">
                              <p><label for="selectCiudad">Ciudad:</label><br></p>
                              <select name="ciudad" id="selectCiudad">
                                <option value="" selected>Elige una ciudad</option>
                                <!-- Imprimimos las ciudades -->
                                <?php
                                // Arreglamos el array con ciudades unicas
                                for ($i = 0; $i <= 1; $i++) {
                                  foreach ($inmuebles as $ciudad) {
                                    $ciudades[] = $ciudad["Ciudad"];
                                  }
                                }
                                $ciudades = array_unique($ciudades);
                                // Imprimimo las cidades en el select
                                foreach ($ciudades as $ciudad) {
                                  echo "" ?>
                                  <option value="<?php echo $ciudad ?>"><?php echo $ciudad ?></option>
                                <?php } ?>
                                <!-- Fin de las ciudades -->
                              </select>
                            </div>
                            <br>
                            <div class="filtroTipo input-field">
                                <p><label for="selecTipo">Tipo:</label></p>
                                <br>
                                <select name="tipo" id="selectTipo">
                                  <option value="">Elige un tipo</option>
                                  <!-- Imprimimos las tipos -->
                                  <?php
                                  // Arreglamos el array con tipos unicos
                                  for ($i = 0; $i <= 1; $i++) {
                                    foreach ($inmuebles as $tipo) {
                                      $tipos[] = $tipo["Tipo"];
                                    }
                                  }
                                  $tipos = array_unique($tipos);
                                  // Imprimimo los tipos en el select
                                  foreach ($tipos as $tipo) {
                                    echo "" ?>
                                    <option value="<?php echo $tipo ?>"><?php echo $tipo ?></option>
                                  <?php } ?>
                                  <!-- Fin de los tipos -->
                                </select>
                              </div>
                            <div class="botonField">
                                <input type="submit" class="btn white" value="GENERAR EXCEL">
                                <!-- <input type="button" class="btn white" value="GENERAR EXCEL" id="submitReporte">-->
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
        </div>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/buscador.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#tabs").tabs();
      });
    </script>
</body>

</html>