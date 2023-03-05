<?php
include 'conexion.php';
class tipo{

    var $objetos;
    //constructor instancion labo llame a la conexion pdo
    public function __construct()
    {
        $db=new conexion;
        $this->acceso=$db->pdo;
    }
    function crear($nombre_tip_prod){
        $sql="SELECT id_tip_prod,estado  FROM tipo_producto where nombre_tip_prod=:nombre_tip_prod";
        $query =$this->acceso->prepare($sql);
        $query->execute(array(':nombre_tip_prod'=>$nombre_tip_prod));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            foreach ($this->objetos as $tip) {
                $tip_id=$tip->id_tip_prod;
                $tip_estado=$tip->estado;
            }
            if ($tip_estado=='A') {
                echo 'noagregar-tipo';
            }else{
                $sql="UPDATE tipo_producto SET estado='A' where id_tip_prod=:id";
                $query =$this->acceso->prepare($sql);
                $query->execute(array(':id'=>$tip_id));
                echo 'siagregar-tipo';
            }

        }else{
            $sql="INSERT INTO tipo_producto(nombre_tip_prod) values (:nombre_tip_prod); ";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre_tip_prod'=>$nombre_tip_prod));
            echo 'siagregar-tipo';

        }
    }
    function buscar(){
        //like con el parametro de lo que se teclea en el imput
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            $sql="SELECT * FROM tipo_producto where estado='A' and  nombre_tip_prod LIKE :consulta";
            $query =$this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchall();
            return $this->objetos;

        }
        else{
            //$consulta=$_POST['consulta'];NOT LIKE que me muestre los que no son vacios
            $sql="SELECT * FROM tipo_producto where estado='A' and nombre_tip_prod NOT LIKE '' ORDER BY id_tip_prod LIMIT 25";
            $query =$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;

        }
    }


    function borrar($id){
        $sql="SELECT * FROM producto where prod_tip_prod=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $tip=$query->fetchall();
        if(!empty($tip)){
            echo 'nborrado';

        }else{
            $sql="UPDATE tipo_producto SET estado='I' where id_tip_prod =:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id));
            //echo 'borrado';
            if(!empty( $query->execute(array(':id'=>$id)))){
                echo 'borrado';
    
            }else{
                echo 'nborrado';
            }

        }

    }
    function editar($nombre_tip_prod,$id_editado){
        $sql="UPDATE tipo_producto SET nombre_tip_prod =:nombre_tip_prod where id_tip_prod =:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_editado,':nombre_tip_prod'=>$nombre_tip_prod));
        echo 'edit';
      

    }
    function llenar_tipo(){
        $sql="SELECT * FROM tipo_producto order by nombre_tip_prod asc";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchall();
        return $this->objetos;

    }


}
?>