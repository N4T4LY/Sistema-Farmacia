<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
  
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/css/style.css">
<link rel="stylesheet" type="text/css" href="css/css/all.min.css">
</head>

<?php
session_start();
if(!empty($_SESSION['us_tipo'])){
    header('Location: controlador/ControladorLogin.php');
}
else{
    session_destroy();


?>
<body>
    <img class="wave" src="img/wave.png" alt="">
    <div class="contenedor">
        <div class="img">
            <img src="img/bg.png" alt="">
        </div>
        <div class="contenido-login">
            <form action="controlador/ControladorLogin.php" method="post">
                <img src="img/logo.png" alt="">
                <h2 >FARMACIA LA GLORIETA</h2>
                <div class="input-div ci">
                    <div class="i">
                        <i class="fas fa-user"></i>
                        
                    </div>
                    <div class="div">
                        <h5>CI</h5>
                        <input type="text" name="user" class="input" >

                    </div>
                </div>
                <div class="input-div pass">
                        <div class="i">
                            <i class="fas fa-lock"> </i>
                            
                        </div>
                        <div class="div">
                            <h5>Contraseña</h5>
                            <input type="password" name="pass" class="input">
                        </div>

                    </div>

               
               <!--  <a href="vista/recuperar.php">Recuperar contraseña</a> -->
               
                <input type="submit" class="btn" value="Iniciar Sesion">

            </form>

        </div>
    </div>
</body>
<script src="js/login.js"></script>
</html>
<?php
}?>