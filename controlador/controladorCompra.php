<?php
include '../modelo/venta.php';
//se usa el include one para usar otro modelo extra
include_once '../modelo/conexion.php';
$venta=new venta();
session_start();
$vendedor= $_SESSION['usuario'];
if ($_POST['funcion']=='registrarcompra') {
    $total=$_POST['total'];
    $nombre=$_POST['nombre'];
    $ci=$_POST['ci'];
    $productos=json_decode($_POST['json']);
   //print_r($productos);
   date_default_timezone_set('America/La_Paz');
   $fecha=date('Y-m-d H:i:s');

   $venta->crear($nombre,$ci,$total,$fecha,$vendedor);
   $venta->ultima_venta();
   foreach ($venta -> objetos as $objeto) {
    $id_venta=$objeto->ultima_venta;
    echo $id_venta;
   }
   //pdo gracias a esto usamos transacciones
   try {
        $db=new conexion();
        $conexion =$db->pdo;
        $conexion->beginTransaction();
        foreach ($productos as $prod ) {
            $numero=$prod->numero;
            while ($numero!=0) {
                //de stck busco el id de algun producto y escoge la fecha de vencimiento mas cercana (devuelve fecha) se compara el stock de los demas prods
                $sql="SELECT * FROM stock where vencimiento=(SELECT MIN(vencimiento) FROM stock where stock_id_prod=:id) and stock_id_prod=:id";
                $query =$conexion->prepare($sql);
                $query->execute(array(':id'=>$prod->id));
                $stock=$query->fetchall();
                foreach ($stock as $stock) {
                    if ($numero<$stock->cantidad) {
                        $sql="INSERT INTO detalle_venta(det_cantidad,det_vencimiento,id__det_stock,id__det_prod,stock_id_prov,id_det_venta) values ('$numero','$stock->vencimiento','$stock->id_stock','$prod->id','$stock->stock_id_prov','$id_venta') ";
                        $conexion->exec($sql);
                        $conexion->exec("UPDATE stock SET cantidad= cantidad-'$numero' where id_stock='$stock->id_stock'");
                            $numero=0;
                    }
                    if ($numero==$stock->cantidad) {
                        $sql="INSERT INTO detalle_venta(det_cantidad,det_vencimiento,id__det_stock,id__det_prod,stock_id_prov,id_det_venta) values ('$numero','$stock->vencimiento','$stock->id_stock','$prod->id','$stock->stock_id_prov','$id_venta') ";
                        $conexion->exec($sql);
                        $conexion->exec("UPDATE stock SET cantidad= cantidad-'$numero' where id_stock='$stock->id_stock'");
                           
                        $conexion->exec("DELETE FROM stock where id_stock='$stock->id_stock'");
                            $numero=0;
                    }
                    if ($numero>$stock->cantidad) {
                        $sql="INSERT INTO detalle_venta(det_cantidad,det_vencimiento,id__det_stock,id__det_prod,stock_id_prov,id_det_venta) values ('$stock->cantidad','$stock->vencimiento','$stock->id_stock','$prod->id','$stock->stock_id_prov','$id_venta') ";
                        $conexion->exec($sql);
                        
                        $conexion->exec("DELETE FROM stock where id_stock='$stock->id_stock'");
                        $numero=$numero-$stock->cantidad;
                    }
                   
                }
            }
            $subtotal=$prod->numero*$prod->precio;
            $conexion->exec("INSERT INTO venta_producto(precio,cantidad,subtotal,producto_id_producto,venta_id_venta) values('$prod->precio','$prod->numero','$subtotal','$prod->id','$id_venta')");
        }
        $conexion->commit();
        
   } catch (Exception $error) {
    
        $conexion->rollBack();
        $venta->borrar($id_venta);
        echo $error->getMessage();
   }


}
?>