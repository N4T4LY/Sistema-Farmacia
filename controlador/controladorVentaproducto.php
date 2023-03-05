<?php
include_once '../modelo/ventaProducto.php';

$venta_producto=new ventaProducto();
if($_POST['funcion']=='ver'){
    $id=$_POST['id'];
    $venta_producto->ver($id);
    $json=array();
    foreach ($venta_producto ->objetos as $objeto) {
        $json[]=$objeto;                
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;

}



?>