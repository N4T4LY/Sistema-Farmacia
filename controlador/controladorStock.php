<?php
include '../modelo/stock.php';
$stock = new stock();
if($_POST['funcion']=='crear'){
    $id_producto=$_POST['id_producto'];
    $proveedor=$_POST['proveedor'];
    $cantidad=$_POST['cantidad'];
    $vencimiento=$_POST['vencimiento'];
    $stock->crear($id_producto,$proveedor,$cantidad,$vencimiento);

}
if($_POST['funcion']=='editar'){
    $id_stock=$_POST['id'];
    $cantidad=$_POST['cantidad'];
    $stock->editar($id_stock,$cantidad);

}

if($_POST['funcion']=='buscar'){
    $stock->buscar();
    $json=array();
    //fechavencimiento implementar metodo diff
    date_default_timezone_set('America/La_Paz');
    //$hoy = date('Y-m-d');
    $hoy = date('Y-m-d H:i:s');
    $fecha_actual=new DateTime($hoy);
    foreach ($stock->objetos as $objeto) {
        $vencimiento= new DateTime( $objeto->vencimiento);
        $diferencia=$vencimiento->diff($fecha_actual);
        $anio = $diferencia->y;
        $mes = $diferencia->m;
        $dia = $diferencia->d;
        $verificado=$diferencia->invert;
        if($verificado==0){
            $estado='danger';
            $anio = $anio*(-1);
            $mes=$mes*(-1);
            $dia=$dia*(-1);
        }else{
            if( $anio>=1){
                $estado='light';
            }else{
                if( $mes>3){
                    $estado='light';
                }
        
                if( $mes<=3){
                    if( $mes==0){
                        $estado='danger';
                    }
                    $estado='warning';
                }

            }

           
        }
        

        $json[] = array(
            'id' => $objeto->id_stock,
            'nombre_producto' => $objeto->nombre_producto,
            'concentracion' => $objeto->concentracion,
            'adicional' => $objeto->adicional,
            'registro' => $objeto->registro,
            'vencimiento' => $objeto->vencimiento,
            'proveedor' => $objeto->nombre_prov,
            'cantidad' => $objeto->cantidad,
            'laboratorio' => $objeto->nombre_lab,
            'tipo' => $objeto->nombre_tip_prod,
            'presentacion' => $objeto->nombre_presen,
            'imagen_prod' => '../img/prod/' . $objeto->imagen_prod,
            'anio'=>$anio,
            'mes'=>$mes,
            'dia'=>$dia,
            'estado'=>$estado
            
            

        );
    }
   $jsonstring =json_encode($json);
    echo $jsonstring;

}

if($_POST['funcion']=='borrar'){
    $id=$_POST['id'];
    $stock->borrar($id);
}

?>