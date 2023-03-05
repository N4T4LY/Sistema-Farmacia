<?php
include_once 'conexion.php';
class ventaProducto{

    var $objetos;
    //constructor instancion labo llame a la conexion pdo
    public function __construct()
    {
        $db=new conexion;
        $this->acceso=$db->pdo;
    }
    
    function ver($id){
        $sql="SELECT venta_producto.precio as precio, cantidad, producto.nombre_producto as producto, concentracion, adicional, registro,laboratorio.nombre_lab as laboratorio, presentacion.nombre_presen as presentacion, tipo_producto.nombre_tip_prod as tipo, subtotal
        FROM venta_producto
        JOIN producto on producto_id_producto=id_producto and venta_id_venta=:id
        JOIN laboratorio on prod_lab=id_laboratorio
        JOIN tipo_producto on prod_tip_prod=id_tip_prod
        JOIN presentacion on prod_present=id_presentacion
        ";
            $query =$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id));
            $this->objetos=$query->fetchall();
            return $this->objetos;
    }


    function borrar($id_venta){
        $sql="DELETE FROM venta_producto where venta_id_venta=:id_venta";
        $query =$this->acceso->prepare($sql);
        $query->execute(array(':id_venta'=>$id_venta));
    }

   
}

?>
