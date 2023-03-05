<?php
include 'conexion.php';
class proveedor{

    var $objetos;
    //constructor instancion labo llame a la conexion pdo
    public function __construct()
    {
        $db=new conexion;
        $this->acceso=$db->pdo;
    }
    function crear($nombre_prov,$telefono,$correo,$direccion,$imagen_prov){
        $sql="SELECT id_proveedor,estado FROM proveedor where nombre_prov=:nombre_prov and telefono=:telefono and correo=:correo and direccion=:direccion";
        $query =$this->acceso->prepare($sql);
        $query->execute(array(':nombre_prov'=>$nombre_prov,
                              ':telefono'=>$telefono,
                              ':correo'=>$correo,
                              ':direccion'=>$direccion));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            foreach ($this->objetos as $prov) {
                $prov_id=$prov->id_proveedor;
                $prov_estado=$prov->estado;
            }
            if ($prov_estado=='A') {
                echo 'noagregar';
            }else{
                $sql="UPDATE proveedor SET estado='A' where id_proveedor=:id";
                $query =$this->acceso->prepare($sql);
                $query->execute(array(':id'=>$prov_id));
                echo 'siagregar';
            }


        }else{
            $sql="INSERT INTO proveedor(nombre_prov,telefono,correo,direccion,imagen_prov) values (:nombre_prov,:telefono,:correo,:direccion,:imagen_prov) ";
            $query =$this->acceso->prepare($sql);
            $query->execute(array(':nombre_prov'=>$nombre_prov,
                                  ':telefono'=>$telefono,
                                  ':correo'=>$correo,
                                  ':direccion'=>$direccion,
                                  ':imagen_prov'=>$imagen_prov
        ));
            echo 'siagregar';

        }
        

    }
    function buscar(){
        //like con el parametro de lo que se teclea en el imput
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            $sql="SELECT * FROM proveedor where estado='A' and nombre_prov LIKE :consulta";
            $query =$this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchall();
            return $this->objetos;

        }
        else{
            //$consulta=$_POST['consulta'];NOT LIKE que me muestre los que no son vacios
            $sql="SELECT * FROM proveedor  where estado='A' and nombre_prov NOT LIKE '' ORDER BY id_proveedor desc LIMIT 25";
            $query =$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;

        }
    }
    function cambiar_logo($id,$nombre_prov){
        $sql="UPDATE proveedor SET imagen_prov=:nombre_prov where id_proveedor=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':nombre_prov'=>$nombre_prov));


    } 

    function borrar($id){
        $sql="SELECT * FROM stock where stock_id_prov=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $stock=$query->fetchall();
        if(!empty($stock)){
            echo 'nborrado';

        }else{
            $sql="UPDATE proveedor SET estado='I' where id_proveedor=:id";
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

    function editar($id,$nombre_prov,$telefono,$correo,$direccion){
        $sql="SELECT id_proveedor FROM proveedor where id_proveedor!=:id and nombre_prov=:nombre_prov";
        $query =$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,
                                ':nombre_prov'=>$nombre_prov
                                                            
                             ));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'nedit';

        }else{
            $sql="UPDATE proveedor SET nombre_prov=:nombre_prov, telefono=:telefono , correo=:correo, direccion=:direccion where id_proveedor=:id";
            $query =$this->acceso->prepare($sql);
            $query->execute(array(
                ':id'=>$id,
                ':nombre_prov'=>$nombre_prov,
                ':telefono'=>$telefono,
                ':correo'=>$correo,
                ':direccion'=>$direccion
                
                                  
        ));
            echo 'edit';

        }

    }

    function llenar_prov(){
        $sql="SELECT * FROM proveedor order by nombre_prov asc";
        $query =$this->acceso->prepare($sql);
        $query->execute();
        $this->objetos=$query->fetchall();
        return $this->objetos;


    }
}
 
?>