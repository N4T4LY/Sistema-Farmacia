<?php
include_once'../modelo/usuario.php';
session_start();
$user = $_POST['user'];
$pass = $_POST['pass'];
$usuario=new usuario();

if(!empty($_SESSION['us_tipo'])){
    switch($_SESSION['us_tipo']){
        case 1:
            header('Location: ../vista/adm_listaproductos.php');
            break;
        case 2:
            header('Location: ../vista/adm_listaproductos.php')    ;
            break;
        case 3:
            header('Location: ../vista/adm_listaproductos.php')    ;
        break;
    }
}
else{
    
    
    /**verificacion de tipo de us */
    if(!empty($usuario->loguearse($user,$pass)=="logueado")){

        $usuario->obtener_datos_logueado($user);
        foreach($usuario->objetos as $objeto){
            $_SESSION['usuario']=$objeto->id_usuario;
            $_SESSION['us_tipo']=$objeto->us_tipo;
            $_SESSION['nombre_us']=$objeto->nombre_us;
            
        }
        switch($_SESSION['us_tipo']){
            case 1:
                header('Location: ../vista/adm_listaproductos.php');
                break;
            case 2:
                header('Location: ../vista/adm_listaproductos.php')    ;
                break;
            case 3:
                header('Location: ../vista/adm_listaproductos.php')    ;
            break;
        }
    }
    else{
      
            
            if((time()-$_SESSION['time'])>60){
                header('Location: ../index.php');
                //header('Location: ../controlador/logout.php');
        
            }
    
            
      
        

        
    }
}

?>