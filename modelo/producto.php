<?php
include 'conexion.php';
class producto{

    var $objetos;
    //constructor instancion labo llame a la conexion pdo
    public function __construct()
    {
        $db=new conexion;
        $this->acceso=$db->pdo;
    }
    function crear($nombre_producto,$concentracion,$adicional,$precio,$registro,$laboratorio,$tipo,$presentacion,$imagen_prod){
        $sql="SELECT id_producto,estado FROM producto where nombre_producto=:nombre_producto and concentracion=:concentracion and adicional=:adicional and registro=:registro and prod_lab=:laboratorio and prod_tip_prod=:tipo and prod_present=:presentacion";
        $query =$this->acceso->prepare($sql);
        $query->execute(array(':nombre_producto'=>$nombre_producto,
                                ':concentracion'=>$concentracion,
                                ':adicional'=>$adicional,
                                ':registro'=>$registro,
                                ':laboratorio'=>$laboratorio,
                                ':tipo'=>$tipo,
                                ':presentacion'=>$presentacion));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            //echo 'noagregar-prod';
            foreach ($this->objetos as $prod) {
                $prod_id_producto=$prod->id_producto;
                $prod_estado=$prod->estado;
            }
            if ($prod_estado=='A') {
                echo 'noagregar-prod';
            }else{
                $sql="UPDATE producto SET estado='A' where id_producto=:id";
                $query =$this->acceso->prepare($sql);
                $query->execute(array(':id'=>$prod_id_producto));
                echo 'siagregar-prod';
            }

        }else{
            $sql="INSERT INTO producto(nombre_producto,concentracion,adicional, precio, registro,prod_lab,prod_tip_prod,prod_present,imagen_prod) values (:nombre_producto,:concentracion,:adicional,:precio,:registro,:laboratorio,:tipo,:presentacion,:imagen_prod) ";
            $query =$this->acceso->prepare($sql);
            $query->execute(array(':nombre_producto'=>$nombre_producto,
                                  ':concentracion'=>$concentracion,
                                  ':adicional'=>$adicional,
                                  ':precio'=>$precio,
                                  ':registro'=>$registro,
                                  ':laboratorio'=>$laboratorio,
                                  ':tipo'=>$tipo,
                                  ':presentacion'=>$presentacion,
                                  ':imagen_prod'=>$imagen_prod
        ));
            echo 'siagregar-prod';


        }
    }
    //verificamos si son iguales, se debe evitar de almacenar prods iguales, para eso me sirve el id diferente id para que me permita sobreescribir el prod
    function editar($id,$nombre_producto,$concentracion,$adicional,$precio,$registro,$laboratorio,$tipo,$presentacion){
        $sql="SELECT id_producto FROM producto where id_producto!=:id and nombre_producto=:nombre_producto and concentracion=:concentracion and adicional=:adicional and registro=:registro and prod_lab=:laboratorio and prod_tip_prod=:tipo and prod_present=:presentacion";
        $query =$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,
                                ':nombre_producto'=>$nombre_producto,
                                ':concentracion'=>$concentracion,
                                ':adicional'=>$adicional,
                                ':registro'=>$registro,
                                ':laboratorio'=>$laboratorio,
                                ':tipo'=>$tipo,
                                ':presentacion'=>$presentacion));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'nedit';

        }else{
            $sql="UPDATE producto SET nombre_producto=:nombre_producto , concentracion=:concentracion , adicional=:adicional , registro=:registro , prod_lab=:laboratorio , prod_tip_prod=:tipo , prod_present=:presentacion, precio=:precio where id_producto=:id ";
            $query =$this->acceso->prepare($sql);
            $query->execute(array(
                                  ':id'=>$id,
                                  ':nombre_producto'=>$nombre_producto,
                                  ':concentracion'=>$concentracion,
                                  ':adicional'=>$adicional,
                                  ':precio'=>$precio,
                                  ':registro'=>$registro,
                                  ':laboratorio'=>$laboratorio,
                                  ':tipo'=>$tipo,
                                  ':presentacion'=>$presentacion
                                  
        ));
            echo 'edit';

        }
    }
    function buscar(){
        //like con el parametro de lo que se teclea en el imput
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            $sql="SELECT id_producto, nombre_producto, concentracion,adicional,precio,registro,laboratorio.nombre_lab as laboratorio,tipo_producto.nombre_tip_prod as tipo,presentacion.nombre_presen as presentacion,imagen_prod,prod_lab,prod_tip_prod,prod_present FROM producto
            JOIN laboratorio on prod_lab=id_laboratorio
            JOIN tipo_producto on prod_tip_prod=id_tip_prod
            JOIN presentacion on prod_present=id_presentacion  where producto.estado='A' and nombre_producto LIKE :consulta LIMIT 25";
            $query =$this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchall();
            return $this->objetos;

        }
        else{
            //$consulta=$_POST['consulta'];NOT LIKE que me muestre los que no son vacios
            $sql="SELECT id_producto, nombre_producto, concentracion,adicional,precio,registro, laboratorio.nombre_lab as laboratorio,tipo_producto.nombre_tip_prod as tipo,presentacion.nombre_presen as presentacion,imagen_prod,prod_lab,prod_tip_prod,prod_present FROM producto
            JOIN laboratorio on prod_lab=id_laboratorio
            JOIN tipo_producto on prod_tip_prod=id_tip_prod
            JOIN presentacion on prod_present=id_presentacion where producto.estado='A'  and nombre_producto NOT LIKE '' order by nombre_producto LIMIT 25";
            $query =$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;

        }
    }
     function cambiar_img($id,$nombre_producto){
        $sql="UPDATE producto SET imagen_prod=:nombre where id_producto=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':nombre'=>$nombre_producto));


    } 

    function borrar($id){
        $sql="SELECT * FROM stock where stock_id_prod=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));

        $stock=$query->fetchall();
        if(!empty($stock)){
            echo 'no borrado';

        }else{
            $sql="UPDATE  producto SET estado='I' where id_producto=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id));
            if(!empty($query->execute(array(':id'=>$id)))){
                echo 'borrado';
    
            }else{
                echo 'noborrado';
    
            }
          

        }



    }

    function obtener_stock($id){
        $sql="SELECT SUM(cantidad) as total FROM stock where stock_id_prod=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos=$query->fetchall();
        return $this->objetos;

    }
    function buscar_id($id){
        $sql="SELECT id_producto, nombre_producto, concentracion,adicional,precio,registro, laboratorio.nombre_lab as laboratorio,tipo_producto.nombre_tip_prod as tipo,presentacion.nombre_presen as presentacion,imagen_prod,prod_lab,prod_tip_prod,prod_present FROM producto
        JOIN laboratorio on prod_lab=id_laboratorio
        JOIN tipo_producto on prod_tip_prod=id_tip_prod
        JOIN presentacion on prod_present=id_presentacion where id_producto=:id";
        $query =$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos=$query->fetchall();
        return $this->objetos;

    }

    function reporte_producto(){
        
            //$consulta=$_POST['consulta'];NOT LIKE que me muestre los que no son vacios
            $sql="SELECT id_producto, nombre_producto, concentracion,adicional,precio,registro, laboratorio.nombre_lab as laboratorio,tipo_producto.nombre_tip_prod as tipo,presentacion.nombre_presen as presentacion,imagen_prod,prod_lab,prod_tip_prod,prod_present FROM producto
            JOIN laboratorio on prod_lab=id_laboratorio
            JOIN tipo_producto on prod_tip_prod=id_tip_prod
            JOIN presentacion on prod_present=id_presentacion and nombre_producto NOT LIKE '' order by nombre_producto";
            $query =$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;

        
    }

    

 
 
}
?>