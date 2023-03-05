<?php
include '../modelo/tipo.php';
$tipo=new tipo();
if($_POST['funcion']=='crear'){
    $nombre_tip_prod= $_POST['nombre_tipo'];
    $tipo->crear($nombre_tip_prod);

}
if($_POST['funcion']=='editar'){
    $nombre_tip_prod = $_POST['nombre_tipo'];
    $id_editado=$_POST['id_editado'];
    $tipo->editar($nombre_tip_prod,$id_editado);

}
if($_POST['funcion']=='buscar'){
    $tipo->buscar();
    $json=array();
    foreach ($tipo->objetos as $objeto) {
        $json[]=array(
            'id' => $objeto->id_tip_prod,
            'nombre_tip_prod'=>$objeto->nombre_tip_prod
        );
           
    }
    //json encode decodifica el string
    $jsonstring = json_encode($json);
    echo $jsonstring;

}

if($_POST['funcion']=='borrar'){
$id=$_POST['id'];
$tipo->borrar($id);
}

if($_POST['funcion']=='llenar_tipo'){
    $tipo->llenar_tipo();
    $json = array();
    foreach($tipo->objetos as $objeto){
        $json[]=array(
            'id' => $objeto->id_tip_prod,
            'nombre_tip_prod'=>$objeto->nombre_tip_prod
        );

    }
    $jsonstring=json_encode($json);
    echo $jsonstring;

   
}
?>