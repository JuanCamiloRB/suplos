<?php
$host = 'localhost';
$bd = 'Intelcost_bienes';
$user = 'root';
$pass = '';

try {
    $conx = mysqli_connect($host,$user,$pass,$bd);
    // echo "Conexion establecida";
} catch (Exception $e) {
    echo "Hubo un error en la conexion " + $e;
}