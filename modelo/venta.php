<?php
include_once 'conexion.php';
class venta{

    var $objetos;
    //constructor instancion labo llame a la conexion pdo
    public function __construct()
    {
        $db=new conexion;
        $this->acceso=$db->pdo;
    }
    function crear($nombre,$ci,$total,$fecha,$vendedor){
        $sql="INSERT INTO venta(fecha,cliente,ci,total,vendedor) values(:fecha,:cliente,:ci,:total,:vendedor);";
        $query =$this->acceso->prepare($sql);
        $query->execute(array(':fecha'=>$fecha,':cliente'=>$nombre,':ci'=>$ci,':total'=>$total,':vendedor'=>$vendedor,
                              
    ));
       // echo 'siagregar';
    }
    function ultima_venta(){
        $sql="SELECT MAX(id_venta) as ultima_venta FROM venta";
            $query =$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
    }
    function borrar($id_venta){
        $sql="DELETE FROM venta where id_venta=:id_venta";
        $query =$this->acceso->prepare($sql);
        $query->execute(array(':id_venta'=>$id_venta));
           

    }
    function buscar(){
        $sql="SELECT id_venta, fecha,cliente,ci,total, CONCAT(usuario.nombre_us,' ',usuario.apellidos_us) as vendedor FROM venta join usuario on vendedor=id_usuario";
            $query =$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
    }

    function venta_dia_vendedor($id_usuario){
        $sql="SELECT ROUND(SUM(total),2) as venta_dia_vendedor FROM `venta` WHERE vendedor=:id_usuario and date(fecha)=date(curdate())";
            $query =$this->acceso->prepare($sql);
            $query->execute(array(':id_usuario'=>$id_usuario));
            $this->objetos=$query->fetchall();
            return $this->objetos;
    }

    function venta_diaria(){
        $sql="SELECT ROUND(SUM(total),2) as venta_diaria FROM `venta` WHERE  date(fecha)=date(curdate())";
            $query =$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
    }

    function venta_mensual(){
        $sql="SELECT ROUND(SUM(total),2) as venta_mensual FROM `venta` WHERE  year(fecha)=year(curdate()) and month(fecha)=month(curdate())";
            $query =$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
    }

    function venta_anual(){
        $sql="SELECT ROUND(SUM(total),2) as venta_anual FROM `venta` WHERE year(fecha)=year(curdate())";
            $query =$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;
    }
    function buscar_id($id_venta){
        $sql="SELECT id_venta, fecha,cliente,ci,total, CONCAT(usuario.nombre_us,' ',usuario.apellidos_us) as vendedor FROM venta join usuario on vendedor=id_usuario and id_venta=:id_venta";
            $query =$this->acceso->prepare($sql);
            $query->execute(array(':id_venta'=>$id_venta));
            $this->objetos=$query->fetchall();
            return $this->objetos;
    }


    
}
?>