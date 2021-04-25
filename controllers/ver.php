<?php
require 'conexion/conx.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET'){
    return false;
  }
  $sql = 'SELECT * FROM bienes';
  $resultados = mysqli_query($conx,$sql);
  $consulta_bienes = mysqli_query($conx,
      "SELECT
         bienes.*, 
         ciudades.nombre as nombre_ciudad,
         tipos.nombre as nombre_tipo
      FROM bienes 
      INNER JOIN ciudades ON ciudades.id = bienes.ciudad 
      INNER JOIN tipos ON tipos.id = bienes.tipo");
  if (mysqli_num_rows($consulta_bienes) < 0) {
      echo "no_results";
      exit;
  }
  
  /**
  * @return {Array[map]} bienes guardados JSON
  */
  $data = array();
  while ($row = mysqli_fetch_array($consulta_bienes)) {
      $data['data'][] = $row;
  }
  //echo json_encode($data);