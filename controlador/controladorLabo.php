<?php
include '../modelo/laboratorio.php';
$laboratorio=new laboratorio();
if($_POST['funcion']=='crear'){
    $nombre_lab = $_POST['nombre_labo'];
    $imagen_labo='defaultimg.jpg';
    $laboratorio->crear($nombre_lab,$imagen_labo);

}
if($_POST['funcion']=='editar'){
    $nombre_lab = $_POST['nombre_labo'];
    $id_editado=$_POST['id_editado'];
    $laboratorio->editar($nombre_lab,$id_editado);

}
if($_POST['funcion']=='buscar'){
    $laboratorio->buscar();
    $json=array();
    foreach ($laboratorio->objetos as $objeto) {
        $json[]=array(
            'id' => $objeto->id_laboratorio,
            'nombre_lab'=>$objeto->nombre_lab ,
            'imagen_labo'=>'../img/lab/'.$objeto->imagen_labo);
    }
    //json encode decodifica el string
    $jsonstring = json_encode($json);
    echo $jsonstring;

}
if($_POST['funcion']=='cambiar_logo'){
    $id=$_POST['id_logolab'];
    if(($_FILES['foto']['type']=='image/jpeg')||($_FILES['foto']['type']=='image/jpg')||($_FILES['foto']['type']=='image/png')||($_FILES['foto']['type']=='image/gif')){
        $nombre_lab=uniqid().'-'.$_FILES['foto']['name'];
        // echo $nombrefoto;
        $ruta='../img/lab/'.$nombre_lab;
        move_uploaded_file($_FILES['foto']['tmp_name'],$ruta);
        $laboratorio ->cambiar_logo($id,$nombre_lab);
        foreach ($laboratorio->objetos as $objeto) {
            if($objeto->imagen_labo!='defaultimg.jpg'){
                unlink('../img/lab/'.$objeto->imagen_labo);
            }
            
        }
        $json=array();
        $json[]=array(
            'ruta'=>$ruta,
            'alert'=>'edit'
        );
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;

    }else{
        $json=array();
        $json[]=array(
            'ruta'=>$ruta,
            'alert'=>'noedit'
        );
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;



    }
    
}

if($_POST['funcion']=='borrar'){
$id=$_POST['id'];
$laboratorio->borrar($id);
}

if($_POST['funcion']=='llenar_labo'){
    $laboratorio->llenar_labo();
    $json = array();
    foreach($laboratorio->objetos as $objeto){
        $json[]=array(
            'id' => $objeto->id_laboratorio,
            'nombre_lab'=>$objeto->nombre_lab
        );

    }
    $jsonstring=json_encode($json);
    echo $jsonstring;

   
}
?>