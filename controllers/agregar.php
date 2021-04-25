<?php
require '../conexion/conx.php';

// Guardamos los datos recibidos por post
$Id_json = $_POST['Id_json'];
$Direccion = $_POST['Direccion'];
$Ciudad = $_POST['Ciudad'];
$Telefono = $_POST['Telefono'];
$Codigo_Postal = $_POST['Codigo_Postal'];
$Tipo = $_POST['Tipo'];
$Precio = $_POST['Precio'];
$Precio = str_replace("$", "", $Precio);
$Precio = str_replace(",", "", $Precio);
if (!empty($Id_json) || !empty($Direccion) || !empty($Ciudad) || !empty($Telefono) || !empty($Codigo_Postal) || !empty($Tipo) || !empty($Precio)) {
    // Creamos la consulta
    $mysqli = new mysqli($host,$user,$pass,$bd);
    $consulta_ciudad = mysqli_query($conx, "SELECT id FROM ciudades WHERE nombre='$Ciudad'");
$row = mysqli_fetch_array($consulta_ciudad);
$ciudad_id = $row['id'];

if (!$ciudad_id) {
    echo "error:no_existe_ciudad_seleccionada";
    return;
}

$consulta_tipo = mysqli_query($conx, "SELECT id FROM tipos WHERE nombre='$Tipo'");
$row = mysqli_fetch_array($consulta_tipo);
$tipo_id = $row['id'];

if (!$tipo_id) {
    echo "error:no_existe_tipo_seleccionado";
    exit;
}

$consulta_bien = mysqli_query($conx, "SELECT id FROM bienes WHERE id='$Id_json'");
if (mysqli_num_rows($consulta_bien) > 0) {
    echo "duplicado";
    exit;
}
    $sql=("INSERT INTO bienes (`id`, `direccion`, `ciudad`, `telefono`, `codigo_postal`,`tipo`, `precio`) VALUES ('$Id_json', '$Direccion', '$ciudad_id', '$Telefono', '$Codigo_Postal', '$tipo_id', '$Precio')");
    // Guardamos en la base de datos
    if (mysqli_query($mysqli, $sql)) {
        echo "<script> alert('Datos guardados correctamente')
        window.location.href = '../#tabs-2';
        </script>";
    } else {
        echo "<script> alert('Hubo un error al guardar los datos, intente nuevamente')
        window.location.href = '../';
        </script>";
    }
} else {
    echo "<script> alert('Hubo un error al procesar los datos, intente nuevamente')
    window.location.href = '../';
    </script>";
}
mysqli_close($conx);