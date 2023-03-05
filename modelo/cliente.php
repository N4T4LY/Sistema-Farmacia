<?php
include 'conexion.php';
class cliente{

    var $objetos;
    //constructor instancion labo llame a la conexion pdo
    public function __construct()
    {
        $db=new conexion;
        $this->acceso=$db->pdo;
    }

    function buscar(){
        //like con el parametro de lo que se teclea en el imput
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            $sql="SELECT * FROM cliente where estado='A' and nombre_cli  LIKE :consulta";
            $query =$this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchall();
            return $this->objetos;

        }
        else{
            //$consulta=$_POST['consulta'];NOT LIKE que me muestre los que no son vacios
            $sql="SELECT * FROM cliente  where estado='A' and nombre_cli NOT LIKE '' ORDER BY id_cliente desc LIMIT 25";
            $query =$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;

        }
    }

    function crear($nombre_cli,$apellidos,$ci,$imagen){
        $sql="SELECT id_cliente,estado FROM cliente where nombre_cli=:nombre_cli and apellidos=:apellidos and ci=:ci ";
        $query =$this->acceso->prepare($sql);
        $query->execute(array(':nombre_cli'=>$nombre_cli,
                              ':apellidos'=>$apellidos,
                              ':ci'=>$ci
                              ));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            foreach ($this->objetos as $cli) {
                $cli_id=$cli->id_cliente;
                $cli_estado=$cli->estado;
            }
            if ($cli_estado=='A') {
                echo 'noagregar';
            }else{
                $sql="UPDATE cliente SET estado='A' where id_cliente=:id";
                $query =$this->acceso->prepare($sql);
                $query->execute(array(':id'=>$cli_id));
                echo 'siagregar';
            }


        }else{
            $sql="INSERT INTO cliente(nombre_cli,apellidos,ci,imagen) values (:nombre_cli,:apellidos,:ci,:imagen) ";
            $query =$this->acceso->prepare($sql);
            $query->execute(array(':nombre_cli'=>$nombre_cli,
                                  ':apellidos'=>$apellidos,
                                  ':ci'=>$ci,
                                  ':imagen'=>$imagen
        ));
            echo 'siagregar';

        }
        

    }

}



?>    