<?php
include '../modelo/producto.php';
require_once('../vendor/autoload.php');
$producto=new producto();
session_start();
if($_POST['funcion']=='crear'){
    $nombre_producto = $_POST['nombre_producto'];
    $concentracion=$_POST['concentracion'];
    $adicional=$_POST['adicional'];
    $precio=$_POST['precio'];
    $registro=$_POST['registro'];
    $laboratorio=$_POST['laboratorio'];
    $tipo=$_POST['tipo'];
    $presentacion=$_POST['presentacion'];
    $imagen_prod='defaultimg.jpg';
    $producto->crear($nombre_producto,$concentracion,$adicional,$precio,$registro,$laboratorio,$tipo,$presentacion,$imagen_prod);

}
if($_POST['funcion']=='editar'){
    $id = $_POST['id'];
    $nombre_producto = $_POST['nombre_producto'];
    $concentracion=$_POST['concentracion'];
    $adicional=$_POST['adicional'];
    $precio=$_POST['precio'];
    $registro=$_POST['registro'];
    $laboratorio=$_POST['laboratorio'];
    $tipo=$_POST['tipo'];
    $presentacion=$_POST['presentacion'];
    $producto->editar($id,$nombre_producto,$concentracion,$adicional,$precio,$registro,$laboratorio,$tipo,$presentacion);

}
if($_POST['funcion']=='buscar'){
   $producto ->buscar();
   $json=array();
   foreach ($producto->objetos as $objeto) {
    //contar todo el stock 
    $producto->obtener_stock($objeto->id_producto);
    foreach ($producto -> objetos as $obj) {
        $total=$obj->total;
    }
    $json[]=array(
        'id'=>$objeto->id_producto,
        'nombre_producto'=>$objeto->nombre_producto,
        'concentracion'=>$objeto->concentracion,
        'adicional'=>$objeto->adicional,
        'precio'=>$objeto->precio,
        'registro'=>$objeto->registro,
        'cantidad'=>$total,
        'laboratorio'=>$objeto->laboratorio,
        'tipo'=>$objeto->tipo,
        'presentacion'=>$objeto->presentacion,
        'laboratorio_id'=>$objeto->prod_lab,
        'tipo_id'=>$objeto->prod_tip_prod,
        'presentacion_id'=>$objeto->prod_present,
        'imagen_prod'=>'../img/prod/'.$objeto->imagen_prod

    );
   }
   $jsonstring =json_encode($json);
    echo $jsonstring;
}


if($_POST['funcion']=='cambiar_img'){
    $id=$_POST['id_imgprod'];
    $imagen_prod=$_POST['imagen_prod'];
    if(($_FILES['foto']['type']=='image/jpeg')||($_FILES['foto']['type']=='image/jpg')||($_FILES['foto']['type']=='image/png')||($_FILES['foto']['type']=='image/gif')){
        $nombre_producto=uniqid().'-'.$_FILES['foto']['name'];
        // echo $nombrefoto;
        $ruta='../img/prod/'.$nombre_producto;
        move_uploaded_file($_FILES['foto']['tmp_name'],$ruta);
        $producto ->cambiar_img($id,$nombre_producto);
        
        if($imagen_prod!='../img/prod/defaultimg.jpg'){
            unlink($imagen_prod);
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
    $producto->borrar($id);
}

if($_POST['funcion']=='buscar_id'){
    $id=$_POST['id_producto'];
    $producto ->buscar_id($id);
    $json=array();
    foreach ($producto->objetos as $objeto) {
     //contar todo el stock 
     $producto->obtener_stock($objeto->id_producto);
     foreach ($producto -> objetos as $obj) {
         $total=$obj->total;
     }
     $json[]=array(
         'id'=>$objeto->id_producto,
         'nombre_producto'=>$objeto->nombre_producto,
         'concentracion'=>$objeto->concentracion,
         'adicional'=>$objeto->adicional,
         'precio'=>$objeto->precio,
         'registro'=>$objeto->registro,
         'cantidad'=>$total,
         'laboratorio'=>$objeto->laboratorio,
         'tipo'=>$objeto->tipo,
         'presentacion'=>$objeto->presentacion,
         'laboratorio_id'=>$objeto->prod_lab,
         'tipo_id'=>$objeto->prod_tip_prod,
         'presentacion_id'=>$objeto->prod_present,
         'imagen_prod'=>'../img/prod/'.$objeto->imagen_prod
 
     );
    }
    $jsonstring =json_encode($json[0]);
     echo $jsonstring;
 }
  if($_POST['funcion']=='verificarstock'){
    $error=0;
    $productos=json_decode($_POST['productos']);
    foreach ($productos as $objeto) {
        $producto->obtener_stock($objeto->id);
        foreach ($producto ->objetos as $obj) {
            $total=$obj->total;

        }
        if($total>=$objeto->numero && $objeto->numero>0){
            $error=$error+0;

        }
        else{
            $error=$error+1;
        }
    }
    echo $error;
  
   
 }

 if($_POST['funcion']=='traer_productos'){
    //echo "estoy aqui";
    $html="";
    $productos=json_decode($_POST['productos']);
    foreach ($productos as $resultado) {
        $producto->buscar_id($resultado->id);
        //var_dump($producto);

        foreach ($producto ->objetos as $objeto) {
            $subtotal=$objeto->precio*$resultado->numero;
            $producto->obtener_stock($objeto->id_producto);
            foreach ($producto ->objetos as $obj) {
                $cantidad=$obj->total;

            }
            $html.="
            <tr prodId='$objeto->id_producto' prodPrecio='$objeto->precio'>
                    <td>$objeto->nombre_producto</td>
                    <td>$cantidad</td>
                    <td class='precio'>$objeto->precio</td>
                    <td>$objeto->concentracion</td>
                    <td>$objeto->adicional</td>
                    <td>$objeto->registro</td>
                    <td>$objeto->laboratorio</td>
                    <td>$objeto->presentacion</td>
                    <td>
                        <input type='number' min='1' class='form-control cantidad_producto' value='$resultado->numero'>
                    </td>
                    <td class='subtotales'>
                    <h5>$subtotal</h5>
                    </td>
                    
                
                    <td><button class='borrar-producto btn btn-danger'><i class='fas fa-times-circle'></i></button></td>
            </tr>
            
            ";
            
        }
    }
    echo $html;
    

  
   
 }
 
 
 if($_POST['funcion']=='reporte_productos'){
    date_default_timezone_set('America/La_Paz');
    $fecha =date('Y-m-d H:i:s');
    $html='
    <header>
        <div id="logo">
            <img src="../img/logo.png" width="60" height="60">
        </div>
        <h1>REPORTE DE PRODUCTOS</h1>
        <div id="proyect">
            <div>
                <span>Fecha y Hora: </span>'.$fecha.'
            </div>
        </div>
    
    </header>
    <table>
        <thead>
            <tr>
                <th class="ser">Nro.</th>
                <th class="ser">Producto</th>
                <th class="ser">Concentración</th>
                <th class="ser">Adicional</th>
                <th class="ser">Laboratorio</th>
                <th class="ser">Presentación</th>
                <th class="ser">Tipo</th>
                <th class="ser">Registro Sanitario</th>
                <th class="ser">Stock</th>
                <th class="ser">Precio</th>
            </tr>
        </thead>
        <tbody>
                    
      
    
    ';
    $producto->reporte_producto();
    $contador=0;
    foreach ($producto ->objetos as $objeto) {
        $contador++;
        $producto->obtener_stock($objeto->id_producto);
        foreach ($producto ->objetos as $obj) {
            $cantidad=$obj->total;

        }
        $html.='
        <tr>

            <td >'.$contador.'</td>
            <td >'.$objeto->nombre_producto.'</td>
            <td >'.$objeto->concentracion.'</td>
            <td >'.$objeto->adicional.'</td>
            <td >'.$objeto->laboratorio.'</td>
            <td >'.$objeto->presentacion.'</td>
            <td >'.$objeto->tipo.'</td>
            <td >'.$objeto->registro.'</td>
            <td >'.$cantidad.'</td>
            <td >'.$objeto->precio.'</td>
        </tr>
        ';
    }
    $html.='
        </tbody>
    </table>

    ';
    $css= file_get_contents("../css/pdf.css");
    $mpdf=new \Mpdf\Mpdf();
    $mpdf ->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
    $mpdf->Output("../pdf/pdf-".$_POST['funcion'].".pdf","F");
 
   
 }
     

?>