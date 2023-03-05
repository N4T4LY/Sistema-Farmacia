<?php
include '../modelo/cliente.php';
$cliente = new cliente();

if($_POST['funcion']=='buscar'){
    $cliente->buscar();
   
    foreach ($cliente->objetos as $objeto) {
         $json[]=array(
            'id' => $objeto->id_cliente,
            'nombre_cli'=>$objeto->nombre_cli.' '.$objeto->apellidos,
            'ci'=>$objeto->ci,
            'imagen'=>'../img/defaultus.jpg'
        );
    }
    //json encode decodifica el string
    $jsonstring = json_encode($json);
    echo $jsonstring;


}

if($_POST['funcion']=='crear'){
    $nombre_cli=$_POST['nombre_cli'];
    $apellidos=$_POST['apellidos'];
    $ci=$_POST['ci'];
    $imagen='defaultus.jpg';
    
    $cliente->crear($nombre_cli,$apellidos,$ci,$imagen);


}

if($_POST['funcion']=='editar'){
    $nombre_cli=$_POST['nombre_cli'];
    $apellidos=$_POST['apellidos'];
    $ci=$_POST['ci'];
    $imagen='defaultus.jpg';
    
    $cliente->crear($nombre_cli,$apellidos,$ci,$imagen);


}


?>