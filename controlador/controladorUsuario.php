<?php
include_once '../modelo/usuario.php';
$usuario=new usuario();
session_start();
$id_usuario=$_SESSION['usuario'];
$tipo_usuario=$_SESSION['us_tipo'];
if($_POST['funcion']=='buscar_usuario'){
    $json=array();
    $fecha_actual=new DateTime();
    $usuario->obtener_datos($_POST['dato']);
    foreach ($usuario->objetos as $objeto) {
        $nacimiento=new DateTime($objeto->fecha_nac);
        $fecha_nac=$nacimiento->diff($fecha_actual);
        $edad_anios=$fecha_nac->y;
        $json[]=array(
            'nombre'=>$objeto->nombre_us,
            'apellidos'=>$objeto->apellidos_us,
            'edad'=>$edad_anios,
            'ci'=>$objeto->ci_us,
            'nacim'=>$objeto->fecha_nac,
            'tipo'=>$objeto->nombre_tipo,
            'telefono'=>$objeto->tel_us,
            'direccion'=>$objeto->direc_us,
            'correo'=>$objeto->email_us,
            'genero'=>$objeto->genero_us,
            'info'=>$objeto->info_us,
            'avatar'=>'../img/'.$objeto->avatar,
            'tipo_usuario'=>$objeto->us_tipo
        );
    }
    $jsonstring =json_encode($json[0]);
    echo $jsonstring;

}

if($_POST['funcion']=='capturar_datos'){
    $json=array();
    $id_usuario=$_POST['id_usuario'];
    $usuario->obtener_datos($id_usuario);
    foreach ($usuario->objetos as $objeto) {
        $json[]=array(
            'telefono'=>$objeto->tel_us,
            'direccion'=>$objeto->direc_us,
            'correo'=>$objeto->email_us,
            'genero'=>$objeto->genero_us,
            'info'=>$objeto->info_us
        );
    }
    $jsonstring =json_encode($json[0]);
    echo $jsonstring;

}

if($_POST['funcion']=='editar_usuario'){
    $id_usuario=$_POST['id_usuario'];
    $telefono=$_POST['telefono'];
    $direccion=$_POST['direccion'];
    $correo=$_POST['correo'];
    $genero=$_POST['genero'];
    $info=$_POST['info'];
    $usuario->editar($id_usuario,$telefono,$direccion,$correo,$genero,$info);
   echo 'editado';

}

if($_POST['funcion']=='cambiar_contra'){
    $id_usuario=$_POST['id_usuario'];
    $contAntigua=$_POST['contAntigua'];
    $contNueva=$_POST['contNueva'];
    $usuario->cambiar_contra($id_usuario,$contAntigua,$contNueva);
    

}

if($_POST['funcion']=='cambiar_foto'){
    if(($_FILES['foto']['type']=='image/jpeg')||($_FILES['foto']['type']=='image/jpg')||($_FILES['foto']['type']=='image/png')||($_FILES['foto']['type']=='image/gif')){
        $nombrefoto=uniqid().'-'.$_FILES['foto']['name'];
        // echo $nombrefoto;
        $ruta='../img/'.$nombrefoto;
        move_uploaded_file($_FILES['foto']['tmp_name'],$ruta);
        $usuario ->cambiar_foto($id_usuario,$nombrefoto);
        foreach ($usuario->objetos as $objeto) {
            unlink('../img/'.$objeto->avatar);
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

if($_POST['funcion']=='gestbuscar_usuario'){
    $json=array();
    $fecha_actual=new DateTime();
    //recorrer 
    $usuario->buscar_us();
    foreach ($usuario->objetos as $objeto) {
        $nacimiento=new DateTime($objeto->fecha_nac);
        $fecha_nac=$nacimiento->diff($fecha_actual);
        $edad_anios=$fecha_nac->y;
        $json[]=array(
            'id'=>$objeto->id_usuario,
            'nombre'=>$objeto->nombre_us,
            'apellidos'=>$objeto->apellidos_us,
            'edad'=>$edad_anios,
            'ci'=>$objeto->ci_us,
            'nacim'=>$objeto->fecha_nac,
            'tipo'=>$objeto->nombre_tipo,
            'telefono'=>$objeto->tel_us,
            'direccion'=>$objeto->direc_us,
            'correo'=>$objeto->email_us,
            'genero'=>$objeto->genero_us,
            'info'=>$objeto->info_us,
            'avatar'=>'../img/'.$objeto->avatar,
            'tipo_usuario'=>$objeto->us_tipo

        );
    }
    //muchos usuarios
    $jsonstring =json_encode($json);
    echo $jsonstring;

}


if($_POST['funcion']=='crear_usuario'){
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $fechanac=$_POST['fechanac'];
    $ci=$_POST['ci'];
    $contra=$_POST['contra'];
    $tipo=2;
    $avatar='defaultus.jpg';
    $usuario->crear($nombre,$apellido,$fechanac,$ci,$contra,$tipo,$avatar);

}



if($_POST['funcion']=='ascender'){
    $contra=$_POST['contra'];
    $id_ascen=$_POST['id_usuario'];
    $usuario->ascender($contra,$id_ascen,$id_usuario);
    
}

if($_POST['funcion']=='descender'){
    $contra=$_POST['contra'];
    $id_descen=$_POST['id_usuario'];
    $usuario->descender($contra,$id_descen,$id_usuario);
    
}
if($_POST['funcion']=='borrar_usuario'){
    $contra=$_POST['contra'];
    $id_borrado=$_POST['id_usuario'];
    $usuario->borrar($contra,$id_borrado,$id_usuario);
    
}

if($_POST['funcion']=='devolver_avatar'){
    
    $usuario->devolver_avatar($id_usuario);
    $json=array();
    foreach ($usuario ->objetos as $objeto) {
        $json=$objeto;
    }
    $jsonstring =json_encode($json);
    echo $jsonstring;
    
}

if($_POST['funcion']=='tipo_usuario'){
    
    echo $tipo_usuario;
    
}



?>