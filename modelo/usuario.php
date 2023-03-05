<?php
include_once 'conexion.php';
class usuario{
    var $objetos;
    public function __construct()
    {
        $db = new conexion();
        $this->acceso=$db->pdo;
    }
    function loguearse($ci,$pass){
        $sql="SELECT * FROM usuario inner join tipo_us on us_tipo=id_tipo_us where ci_us=:ci ";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':ci'=>$ci));
       $objetos= $query->fetchall();
        foreach ($objetos as $objeto) {
            $contrasena_actual=$objeto->contrasena_us;
        }//strpos()
        if(strpos($contrasena_actual,'$2y$10$')===0){
            if(password_verify($pass,$contrasena_actual)){
                return "logueado";
 
            }

        }
        else{
            if($pass==$contrasena_actual){
                
                return "logueado";

            }
           

        }

    }

    function obtener_datos_logueado($ci){
        $sql="SELECT * FROM usuario join tipo_us on us_tipo=id_tipo_us and ci_us=:ci";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':ci'=>$ci));
        $this->objetos= $query->fetchall();
        return $this->objetos;

    }

    
    function obtener_datos($id){
        $sql="SELECT * FROM usuario join tipo_us on us_tipo=id_tipo_us and id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos= $query->fetchall();
        return $this->objetos;

    }
    function editar($id_usuario,$telefono,$direccion,$correo,$genero,$info){
        $sql="UPDATE usuario SET tel_us=:telefono,direc_us=:direccion,email_us=:correo,genero_us=:genero,info_us=:info where id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,':telefono'=>$telefono,':direccion'=>$direccion,':correo'=>$correo,':genero'=>$genero,':info'=>$info));
    }
    function cambiar_contra($id_usuario,$contAntigua,$contNueva){
        $sql="SELECT * FROM usuario WHERE id_usuario=:id ";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario));
        $this->objetos=$query->fetchall();
        foreach ($this->objetos as $objeto) {
            $contrasena_actual=$objeto->contrasena_us;
        }//strpos()
        if(strpos($contrasena_actual,'$2y$10$')===0){
            if(password_verify($contAntigua,$contrasena_actual)){
                $pass=password_hash($contNueva,PASSWORD_BCRYPT,['cost'=>10]);
                $sql="UPDATE usuario SET contrasena_us=:contNueva where id_usuario=:id";
                $query=$this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id_usuario,'contNueva'=>$contNueva));
                echo 'actualizado';
    

            }else{
                echo 'nocambios';

            }

        }
        else{
            if($contAntigua==$contrasena_actual){
                $pass=password_hash($contNueva,PASSWORD_BCRYPT,['cost'=>10]);
                $sql="UPDATE usuario SET contrasena_us=:contNueva where id_usuario=:id";
                $query=$this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id_usuario,'contNueva'=>$pass));
                echo 'actualizado';

            }
            else{
                echo 'nocambios';

            }

        }


       /*  if(!empty($this->objetos)){
            $sql="UPDATE usuario SET contrasena_us=:contNueva where id_usuario=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_usuario,'contNueva'=>$contNueva));
            echo 'actualizado';

        }
        else{
            echo 'nocambios';
        } */
    }
    function cambiar_foto($id_usuario,$nombrefoto){
        $sql="SELECT avatar FROM usuario WHERE id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario));
        $this->objetos=$query->fetchall();
        
            $sql="UPDATE usuario SET avatar=:nombrefoto where id_usuario=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id_usuario,':nombrefoto'=>$nombrefoto));
           
            return $this->objetos;
      
    }
    function buscar_us(){
        //like con el parametro de lo que se teclea en el imput
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            $sql="SELECT * FROM usuario join tipo_us on us_tipo=id_tipo_us where nombre_us LIKE :consulta";
            $query =$this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos=$query->fetchall();
            return $this->objetos;

        }
        else{
            //$consulta=$_POST['consulta'];
            $sql="SELECT * FROM usuario join tipo_us on us_tipo=id_tipo_us where nombre_us NOT LIKE '' ORDER BY id_usuario LIMIT 25";
            $query =$this->acceso->prepare($sql);
            $query->execute();
            $this->objetos=$query->fetchall();
            return $this->objetos;

        }
    }

    function crear($nombre,$apellido,$fechanac,$ci,$contra,$tipo,$avatar){
        $sql="SELECT id_usuario FROM usuario where ci_us=:ci";
        $query =$this->acceso->prepare($sql);
        $query->execute(array(':ci'=>$ci));
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noagregar';

        }else{
            $sql="INSERT INTO usuario(nombre_us, apellidos_us,fecha_nac,ci_us,contrasena_us,us_tipo,avatar) VALUES (:nombre,:apellido,:fechanac,:ci,:contra,:tipo,:avatar);";
            $query =$this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre,
                                  ':apellido'=>$apellido,
                                  ':fechanac'=>$fechanac,
                                  ':ci'=>$ci,
                                  ':contra'=>$contra,
                                  ':tipo'=>$tipo,
                                  ':avatar'=>$avatar
        ));
            echo 'siagregar';

        }
    }
   

    function ascender($contra,$id_ascen,$id_usuario){
        $sql="SELECT * FROM usuario where id_usuario=:id_usuario";
        $query =$this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario));
        $this->objetos=$query->fetchall();
        foreach ($this->objetos as $objeto) {
            $contrasena_actual=$objeto->contrasena_us;
        }//strpos()
        if(strpos($contrasena_actual,'$2y$10$')===0){
            if(password_verify($contra,$contrasena_actual)){
                $tipo=1;
                $sql="UPDATE usuario SET us_tipo=:tipo where id_usuario=:id";
                $query =$this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id_ascen,':tipo'=>$tipo));

                echo 'ascendido';
              
    

            }
            else{
                echo 'noascendido';
            }

        }
        else{
            if($contra==$contrasena_actual){
                
                $$tipo=1;
                $sql="UPDATE usuario SET us_tipo=:tipo where id_usuario=:id";
                $query =$this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id_ascen,':tipo'=>$tipo));

                echo 'ascendido';

            }
            else{
                echo 'noascendido';
            }
           

        }
    }


    function descender($contra,$id_descen,$id_usuario){
        $sql="SELECT * FROM usuario where id_usuario=:id_usuario";
        $query =$this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario));
        $this->objetos=$query->fetchall();
        foreach ($this->objetos as $objeto) {
            $contrasena_actual=$objeto->contrasena_us;
        }//strpos()
        if(strpos($contrasena_actual,'$2y$10$')===0){
            if(password_verify($contra,$contrasena_actual)){
                $tipo=2;
                $sql="UPDATE usuario SET us_tipo=:tipo where id_usuario=:id";
                $query =$this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id_descen,':tipo'=>$tipo));

                echo 'descendido';
              
    

            }
            else{
                echo 'nodescendido';
            }

        }
        else{
            if($contra==$contrasena_actual){
                
                $$tipo=2;
                $sql="UPDATE usuario SET us_tipo=:tipo where id_usuario=:id";
                $query =$this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id_ascen,':tipo'=>$tipo));

                echo 'descendido';

            }
            else{
                echo 'nodescendido';
            }
           

        }
    }





    function borrar($contra,$id_borrado,$id_usuario){
        $sql="SELECT * FROM usuario where id_usuario=:id_usuario";
        $query =$this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario));
        $this->objetos=$query->fetchall();
        foreach ($this->objetos as $objeto) {
            $contrasena_actual=$objeto->contrasena_us;
        }//strpos()
        if(strpos($contrasena_actual,'$2y$10$')===0){
            if(password_verify($contra,$contrasena_actual)){
                $sql="DELETE FROM usuario where id_usuario=:id";
                $query =$this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id_borrado));

                echo 'borrado';
              
    

            }
            else{
                echo 'noborrado';
            }

        }
        else{
            if($contra==$contrasena_actual){
                
                $sql="DELETE FROM usuario where id_usuario=:id";
                $query =$this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id_borrado));
        
                echo 'borrado';

            }
            else{
                echo 'noborrado';
            }
           

        }

    }

    function devolver_avatar($id_usuario){
        $sql="SELECT avatar FROM usuario where id_usuario=:id_usuario";
        $query =$this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario));
        $this->objetos=$query->fetchall();
        return $this->objetos;

    }

    function verificar($email,$ci){
        $sql="SELECT * FROM usuario where email_us=:email and ci_us=:ci";
        $query =$this->acceso->prepare($sql);
        $query->execute(array(':email'=>$email,':ci'=>$ci));
        $this->objetos=$query->fetchall();
        if (!empty($this->objetos)) {
            if($query->rowCount()==1){
                echo 'encontrado';

            }else{
                echo 'noencontrado';

            }
        }else{
            echo 'noencontrado';
        }
       /*  return $this->objetos; */
    }

    function reemplazar($codigo,$email,$ci){
        $sql="UPDATE usuario SET contrasena_us=:codigo where email_us=:email and ci_us=:ci";
        $query =$this->acceso->prepare($sql);
        $query->execute(array(':codigo'=>$codigo,':email'=>$email,':ci'=>$ci));

        //echo 'reemplazado';

    }
}
?>