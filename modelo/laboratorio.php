<?php
include 'conexion.php';
class laboratorio{

    var $objetos;
    //constructor instancion labo llame a la conexion pdo
    public function __construct()
    {
        $db=new conexion;
        $this->acceso=$db->pdo;
    }
    function crear($nombre_lab,$imagen_labo){
        $sql="SELECT id_laboratorio,estado FROM laboratorio where nombre_lab=:nombre_lab";
        $query =$this->acceso->prepare($sql);
        $query->execute(array(':nombre_lab'=>$nombre_lab));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            foreach ($this->objetos as $lab) {
                $lab_id=$lab->id_laboratorio;
                $lab_estado=$lab->estado;
            }
            if ($lab_estado=='A') {
                echo 'noagregar-prod';
            }else{
                $sql="UPDATE laboratorio SET estado='A' where id_laboratorio=:id";
                $query =$this->acceso->prepare($sql);
                $query->execute(array(':id'=>$lab_id));
                echo 'siagregar-prod';
            }

            

        }else{
            $sql="INSERT INTO laboratorio(nombre_lab,imagen_labo) values (:nombre_lab,:imagen_labo) ";
            $query =$this->acceso->prepare($sql);
            $query->execute(array(':nombre_lab'=>$nombre_lab,
                                  ':imagen_labo'=>$imagen_labo
        ));
            echo 'siagregar-labo';

        }
    }
    function buscar(){
        //like con el parametro de lo que se teclea en el imput
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            $sql="SELECT * FROM laboratorio  where estado='A' and nombre_lab LIKE :consulta";
            $query =$this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchall();
            return $this->objetos;

        }
        else{
            //$consulta=$_POST['consulta'];NOT LIKE que me muestre los que no son vacios
            $sql="SELECT * FROM laboratorio  where estado='A' and nombre_lab NOT LIKE '' ORDER BY id_laboratorio LIMIT 25";
            $query =$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;

        }
    }

    function cambiar_logo($id,$nombre_lab){
        $sql="SELECT imagen_labo FROM laboratorio WHERE id_laboratorio=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos=$query->fetchall();
        
            $sql="UPDATE laboratorio SET imagen_labo=:nombre_lab where id_laboratorio=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':nombre_lab'=>$nombre_lab));
           
            return $this->objetos;
      
    }

    function borrar($id){
        $sql="SELECT * FROM producto where prod_lab=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $prod=$query->fetchall();
        if(!empty($prod)){
            echo 'nborrado';

        }else{
            $sql="UPDATE laboratorio SET estado='I' where id_laboratorio=:id";
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
    function editar($nombre_lab,$id_editado){
        $sql="UPDATE laboratorio SET nombre_lab=:nombre_lab where id_laboratorio=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_editado,':nombre_lab'=>$nombre_lab));
        echo 'edit';
      

    }

    function llenar_labo(){
        $sql="SELECT * FROM laboratorio order by nombre_lab asc";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchall();
        return $this->objetos;

    }

}
?>