<?php
include 'conexion.php';
class presentacion{

    var $objetos;
    //constructor instancion labo llame a la conexion pdo
    public function __construct()
    {
        $db=new conexion;
        $this->acceso=$db->pdo;
    }
    function crear($nombre_presen){
        $sql="SELECT id_presentacion,estado FROM presentacion where nombre_presen=:nombre_presen";
        $query =$this->acceso->prepare($sql);
        $query->execute(array(':nombre_presen'=>$nombre_presen));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            foreach ($this->objetos as $pre) {
                $pre_id=$pre->id_presentacion;
                $pre_estado=$pre->estado;
            }
            if ($pre_estado=='A') {
                echo 'noagregar-pres';
            }else{
                $sql="UPDATE presentacion SET estado='A' where id_presentacion=:id";
                $query =$this->acceso->prepare($sql);
                $query->execute(array(':id'=>$pre_id));
                echo 'siagregar-pres';
            }


        }else{
            $sql="INSERT INTO presentacion(nombre_presen) values (:nombre_presen); ";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre_presen'=>$nombre_presen));
            echo 'siagregar-pres';

        }
    }
    function buscar(){
        //like con el parametro de lo que se teclea en el imput
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            $sql="SELECT * FROM presentacion where estado='A' and nombre_presen LIKE :consulta";
            $query =$this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchall();
            return $this->objetos;

        }
        else{
            //$consulta=$_POST['consulta'];NOT LIKE que me muestre los que no son vacios
            $sql="SELECT * FROM presentacion where estado='A' and nombre_presen NOT LIKE '' ORDER BY id_presentacion LIMIT 25";
            $query =$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;

        }
    }


    function borrar($id){
        $sql="SELECT * FROM producto where prod_present=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $pre=$query->fetchall();
        if(!empty($pre)){
            echo 'nborrado';

        }else{
            $sql="UPDATE presentacion SET estado='I' where id_presentacion=:id";
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
    function editar($nombre_presen,$id_editado){
        $sql="UPDATE presentacion SET nombre_presen =:nombre_presen where id_presentacion =:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_editado,':nombre_presen'=>$nombre_presen));
        echo 'edit';
      

    }
    function llenar_pres(){
        $sql="SELECT * FROM presentacion  order by nombre_presen asc";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchall();
        return $this->objetos;

    }

}
?>