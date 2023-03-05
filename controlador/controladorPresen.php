<?php
include '../modelo/presentacion.php';
$presentacion=new presentacion();
if($_POST['funcion']=='crear'){
    $nombre_presen= $_POST['nombre_pres'];
    $presentacion->crear($nombre_presen);

}
if($_POST['funcion']=='editar'){
    $nombre_pres = $_POST['nombre_pres'];
    $id_editado=$_POST['id_editado'];
    $presentacion->editar($nombre_pres,$id_editado);

}
if($_POST['funcion']=='buscar'){
    $presentacion->buscar();
    $json=array();
    foreach ($presentacion->objetos as $objeto) {
        $json[]=array(
            'id' => $objeto->id_presentacion,
            'nombre_presen'=>$objeto->nombre_presen
        );
           
    }
    //json encode decodifica el string
    $jsonstring = json_encode($json);
    echo $jsonstring;

}

if($_POST['funcion']=='borrar'){
$id=$_POST['id'];
$presentacion->borrar($id);
}
if($_POST['funcion']=='llenar_pres'){
    $presentacion->llenar_pres();
    $json = array();
    foreach($presentacion->objetos as $objeto){
        $json[]=array(
            'id' => $objeto->id_presentacion,
            'nombre_presen'=>$objeto->nombre_presen
        );

    }
    $jsonstring=json_encode($json);
    echo $jsonstring;

   
}
?>