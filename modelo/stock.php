<?php
include 'conexion.php';
class stock{

    var $objetos;
    //constructor instancion labo llame a la conexion pdo
    public function __construct()
    {
        $db=new conexion;
        $this->acceso=$db->pdo;
    }
    function crear($id_producto,$proveedor,$cantidad,$vencimiento){
        $sql="INSERT INTO stock(cantidad,vencimiento,stock_id_prod,stock_id_prov) values (:cantidad,:vencimiento,:id_producto,:id_proveedor)";
        $query =$this->acceso->prepare($sql);
        $query->execute(array(':cantidad'=>$cantidad,':vencimiento'=>$vencimiento,':id_producto'=>$id_producto,':id_proveedor'=>$proveedor));
        echo 'agregar';

    }

    function buscar(){
        //like con el parametro de lo que se teclea en el imput
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            $sql="SELECT id_stock,cantidad,vencimiento,concentracion,adicional,registro,nombre_producto,nombre_lab,nombre_tip_prod, nombre_presen, nombre_prov,imagen_prod FROM stock join proveedor ON stock_id_prov=id_proveedor JOIN producto on stock_id_prod=id_producto join laboratorio on prod_lab=id_laboratorio JOIN tipo_producto ON prod_tip_prod=id_tip_prod JOIN presentacion on prod_present=id_presentacion and nombre_producto LIKE :consulta ORDER by nombre_producto LIMIT 25";
            $query =$this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchall();
            return $this->objetos;
    
        }
        else{
            //$consulta=$_POST['consulta'];NOT LIKE que me muestre los que no son vacios
            $sql="SELECT id_stock,cantidad,vencimiento,concentracion,adicional,registro, nombre_producto,nombre_lab,nombre_tip_prod, nombre_presen, nombre_prov,imagen_prod  FROM stock 
            join proveedor ON stock_id_prov=id_proveedor
            JOIN producto on stock_id_prod=id_producto
            join laboratorio on prod_lab=id_laboratorio
            JOIN tipo_producto ON prod_tip_prod=id_tip_prod
            JOIN presentacion on prod_present=id_presentacion
            and nombre_producto NOT LIKE '' ORDER by nombre_producto LIMIT 25";
            $query =$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
    
        }
    }

    function editar($id,$cantidad){
        $sql="UPDATE stock SET cantidad=:cantidad where id_stock=:id";
        $query =$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':cantidad'=>$cantidad));
        echo 'edit';


    }
    function borrar($id){
        $sql="DELETE FROM  stock where id_stock=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'borrado';

        }else{
            echo 'noborrado';

        }

    }
}
