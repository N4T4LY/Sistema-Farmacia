<?php
session_start();
if ($_SESSION['us_tipo'] == 1 || $_SESSION['us_tipo'] == 3) {
    include_once 'layout/header.php';
?>


    <title>Adm| Editar Datos</title>

    <!-- Google Font: Source Sans Pro -->
    <?php
    include_once 'layout/nav.php'
    ?>
 <!-- Modal descender y ascender-->
 <div class="modal fade" id="confirmar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmar Acción</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img id="foto3" src="../img/defaultus.jpg" class="profile-user-img img-fluid img-circle" alt="">
                    </div>
                    <div class="text-center">
                        <b>
                            <?php
                            echo $_SESSION['nombre_us'];
                            ?>
                        </b>
                    </div>
                    <span>Ingrese su contraseña para continuar</span>
                    <div class="alert alert-success text-center" id="confirmado" style="display:none;">
                        <span><i class="fas fa-check m-1"></i>El usuario fue modificado correctamente</span>
                     </div>
                    <div class="alert alert-danger text-center" id="rechazado" style="display:none;">
                        <span><i class="fas fa-times m-1"></i>La contraseña no es correcta</span>

                    </div>
                    <form id="form-confirmar" action="">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-unlock"></i></span>
                            </div>
                            <input id="contAntigua" type="password" class="form-control" placeholder="Ingrese contrasena actual">
                            <input type="hidden" id="id_us">
                            <input type="hidden" id="funcion">

                        </div>
               
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn bg-gradient-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="crearusuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Crear usuario</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="siagregar" style="display:none;">
                            <span><i class="fas fa-check m-1"></i>El usuario se agrego correctamente</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noagregar" style="display:none;">
                            <span><i class="fas fa-times m-1"></i>El CI ya existe</span>

                        </div>
                        <form id="form-crear">
                            <div class="form-group">
                                <label for="nombre">Nombres</label>
                                <input id="nombre" type="text" class="form-control" placeholder="Ingrese nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido">Apellidos</label>
                                <input id="apellido" type="text" class="form-control" placeholder="Ingrese apellido" required>
                            </div>
                            <div class="form-group">
                                <label for="fechanac">Fecha Nacimiento</label>
                                <input id="fechanac" type="date" class="form-control" placeholder="Ingrese fecha de nacimiento" required>
                            </div>
                            <div class="form-group">
                                <label for="ci">CI</label>
                                <input id="ci" type="text" class="form-control" placeholder="Ingrese CI" required>
                            </div>
                            <div class="form-group">
                                <label for="contra">Contraseña</label>
                                <input id="contra" type="password" class="form-control" placeholder="Ingrese contrasena" required>
                            </div>


                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cancelar</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Gestión de usuarios <button id="boton-crear" type="button" data-toggle="modal" data-target="#crearusuario" class="btn bg-gradient-primary ml-2">Crear usuario</button> </h1>
                        <!--identific tipo de usuario-->
                        <input type="hidden" id="tipo_usuario" value="<?php echo $_SESSION['us_tipo'] ?>">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_listaproductos.php">Home</a></li>
                            <li class="breadcrumb-item active">Gestión usuario</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section>
            <div class="container-fluid">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Buscar usuario</h3>
                        <div class="input-group">
                            <input type="text" id="buscar" class="form-control float-left" placeholder="Ingrese nombre de usuario">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>

                    </div>
                    <div class="card-body pb-0">
                        <div id="usuarios" class="row">

                        </div>


                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>


        </section>


    </div>
    <!-- /.content-wrapper -->



<?php
    include_once 'layout/footer.php';
} else {
    header('Location: ../index.php');
}
?>
<script src="../js/usuario.js"></script>
<script src="../js/gestion_usuario.js"></script>