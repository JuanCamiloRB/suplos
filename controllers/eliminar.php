<?php
require '../conexion/conx.php';

$id = $_POST['id'];

if(!empty($id)){
    $sql = "DELETE FROM bienes WHERE id = $id";
    if(mysqli_query($conx, $sql)){
        echo "<script> alert('Registro eliminado')
        window.location.href = '../#tabs-2';
        </script>";
    }else{
        echo "<script> alert('Hubo un error al eliminar los datos, intente nuevamente')
    window.location.href = '../#tabs-2';
    </script>";
    }
} else {
    echo "<script> alert('Hubo un error al procesar los datos, intente nuevamente')
    window.location.href = '../#tabs-2';
    </script>";
}