<?php
include '../modelo/proveedor.php';
$proveedor=new proveedor();
if($_POST['funcion']=='crear'){
    $nombre_prov=$_POST['nombre_prov'];
    $telefono=$_POST['telefono'];
    $correo=$_POST['correo'];
    $direccion=$_POST['direccion'];
    $imagen_prov='defaultimg.jpg';

    $proveedor->crear($nombre_prov,$telefono,$correo,$direccion,$imagen_prov);


}
if($_POST['funcion']=='editar'){
    $id=$_POST['id'];
    $nombre_prov=$_POST['nombre_prov'];
    $telefono=$_POST['telefono'];
    $correo=$_POST['correo'];
    $direccion=$_POST['direccion'];
   
    $proveedor->editar($id,$nombre_prov,$telefono,$correo,$direccion);


}
if($_POST['funcion']=='buscar'){
    $proveedor->buscar();
    $json=array();
    foreach ($proveedor->objetos as $objeto) {
        $json[]=array(
            'id' => $objeto->id_proveedor,
            'nombre_prov'=>$objeto->nombre_prov,
            'telefono'=>$objeto->telefono,
            'correo'=>$objeto->correo,
            'direccion'=>$objeto->direccion,
            'imagen_prov'=>'../img/prov/'.$objeto->imagen_prov);
    }
    //json encode decodifica el string
    $jsonstring = json_encode($json);
    echo $jsonstring;


}

if($_POST['funcion']=='cambiar_logo'){
    $id=$_POST['id_logoprov'];
    $imagen_prov=$_POST['imagen_prov'];
    if(($_FILES['foto']['type']=='image/jpeg')||($_FILES['foto']['type']=='image/jpg')||($_FILES['foto']['type']=='image/png')||($_FILES['foto']['type']=='image/gif')){
        $nombre_prov=uniqid().'-'.$_FILES['foto']['name'];
        // echo $nombrefoto;
        $ruta='../img/prov/'.$nombre_prov;
        move_uploaded_file($_FILES['foto']['tmp_name'],$ruta);
        $proveedor->cambiar_logo($id,$nombre_prov);
        
        if($imagen_prov!='../img/prov/defaultimg.jpg'){
            unlink($imagen_prov);
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
    $proveedor->borrar($id);
}

if($_POST['funcion']=='llenar_prov'){
    $proveedor->llenar_prov();
    $json = array();
    foreach($proveedor->objetos as $objeto){
        $json[]=array(
            'id' => $objeto->id_proveedor,
            'nombre_prov'=>$objeto->nombre_prov
        );

    }
    $jsonstring=json_encode($json);
    echo $jsonstring;

   
}
  



?>