<?php
session_start();
if ($_SESSION['us_tipo'] == 1|| $_SESSION['us_tipo']==3||$_SESSION['us_tipo'] == 2) {
    include_once 'layout/header.php';
?>


    <title>Adm| Editar Datos</title>

    <!-- Google Font: Source Sans Pro -->
    <?php
    include_once 'layout/nav.php'
    ?>


    <!-- Modal -->
    <div class="animate__animated animate__fadeInDown modal fade" id="cambiocontr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cambiar contraseña</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img id="foto3" src="../img/avatar.png" class="profile-user-img img-fluid img-circle" alt="">
                    </div>
                    <div class="text-center">
                        <b>
                            <?php
                            echo $_SESSION['nombre_us'];
                            ?>
                        </b>
                    </div>
                    <div class="alert alert-success text-center" id="actualizado" style="display:none;">
                        <span><i class="fas fa-check m-1"></i>Sus contraseña fue editada correctamente</span>
                     </div>
                    <div class="alert alert-danger text-center" id="nocambios" style="display:none;">
                        <span><i class="fas fa-times m-1"></i>La contraseña actual no es correcta</span>

                    </div>
                    <form id="form-contra" action="">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-unlock"></i></span>
                            </div>
                            <input id="contAntigua" type="password" class="form-control" placeholder="Ingrese contrasena actual">

                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input id="contNueva" type="text" class="form-control" placeholder="Ingrese neuva contrasena">

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
       <div class="animate__animated animate__fadeInDown modal fade" id="cambiofoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cambiar Foto de perfil</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img id="foto1" src="../img/avatar.png" class="profile-user-img img-fluid img-circle"  alt="">
                    </div>
                    <div class="text-center">
                        <b>
                            <?php
                            echo $_SESSION['nombre_us'];
                            ?>
                        </b>
                    </div>
                    <div class="alert alert-success text-center" id="edit" style="display:none;">
                        <span><i class="fas fa-check m-1"></i>Su foto fue cambiada correctamente</span>
                     </div>
                    <div class="alert alert-danger text-center" id="nedit" style="display:none;">
                        <span><i class="fas fa-times m-1"></i>Formato Incorrecto</span>

                    </div>
                    <form id="form-foto" enctype="multipart/form-data" action="">
                        <div class="input-group mb-3 ml-5 mt-2">
                            <input type="file" name="foto" class="input-group">
                            <input type="hidden" name="funcion" value="cambiar_foto">
                          
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


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Datos Personales</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../vista/adm_listaproductos.php">Home</a></li>
                            <li class="breadcrumb-item active">Datos Personales</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-danger card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img id="foto2" src="../img/avatar.png" alt="" class="profile-user-img img-fluid img-circle">
                                    </div>
                                    <div class="text-center mt-1">
                                        <button type="button" data-toggle="modal" data-target="#cambiofoto" class="btn btn-primary btn-sm">Cambiar foto de perfil</button>
                                    </div>
                                    <input id="id_usuario" type="hidden" value="<?php echo $_SESSION['usuario'] ?>">
                                    <h3 id="nombre_us" class="profile-username text-center text-danger">Nombre </h3>
                                    <p id="apellidos_us" class="text-muted text-center">Apellidos</p>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b style="color: #DC143C;">Edad</b><a id="edad" class="float-right">12</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b style="color: #DC143C;">CI</b><a id="ci_us" class="float-right">12</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b style="color: #DC143C;">Fecha de Nacimiento</b><a id="fecha_nac" class="float-right">12</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b style="color: #DC143C;">Tipo Usuario</b>
                                            <span class="float-right" id="nombre_tipo">Administrador</span>
                                            <button data-toggle="modal" data-target="#cambiocontr" type="button" class="btn btn-block btn-outline-warning btn-sm">Cambiar contrasena</button>
                                    </ul>

                                </div>

                            </div>
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Sobre mí</h3>

                                </div>
                                <div class="card-body">
                                    <strong style="color: #DC143C;">
                                        <i class="fas fa-phone mr-1"></i>Teléfono
                                    </strong>
                                    <p class="text-muted" id="tel_us">123123</p>
                                    <strong style="color: #DC143C;">
                                        <i class="fas fa-map-marker-alt mr-1"></i>Dirección
                                    </strong>
                                    <p class="text-muted" id="direc_us">sdfasdf</p>
                                    <strong style="color: #DC143C;">
                                        <i class="fas fa-at mr-1"></i>Correo
                                    </strong>
                                    <p class="text-muted" id="email_us">sadas</p>
                                    <strong style="color: #DC143C;">
                                        <i class="fas fa-smile mr-1"></i>Género
                                    </strong>
                                    <p class="text-muted" id="genero_us">sadas</p>
                                    <strong style="color: #DC143C;">
                                        <i class="fas fa-pencil-alt mr-1"></i>Información Adicional
                                    </strong>
                                    <p class="text-muted" id="info_us">sadas</p>
                                    <button class="editar btn btn-block bg-gradient-danger">Editar</button>

                                </div>
                                <div class="card-footer">
                                    <p class="text-muted">De click al botón si desea editar sus datos</p>

                                </div>

                            </div>

                        </div>
                        <div class="col-md-9">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Editar Datos personales </h3>

                                </div>
                                <div class="card-body">
                                    <div class="alert alert-success text-center" id="editado" style="display:none;">
                                        <span><i class="fas fa-check m-1"></i>Sus datos fueron editados correctamente</span>

                                    </div>
                                    <div class="alert alert-danger text-center" id="noeditado" style="display:none;">
                                        <span><i class="fas fa-times m-1"></i>Edición deshabilitada</span>

                                    </div>
                                    <form id="form-usuario" class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="telefono" class="col-sm-2 col-form-label">Teléfono</label>
                                            <div class="col-sm-10">
                                                <input type="number" id="telefono" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="direccion" class="col-sm-2 col-form-label">Dirección</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="direccion" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="correo" class="col-sm-2 col-form-label">Correo Electrónico</label>
                                            <div class="col-sm-10">
                                                <input type="email" id="correo" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="genero" class="col-sm-2 col-form-label">Género</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="genero" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="informacion" class="col-sm-2 col-form-label">Información Adicional</label>
                                            <div class="col-sm-10">
                                                <textarea name="informacion" class="form-control" id="info" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10 float-right">
                                                <button class="btn btn-block btn-outline-warning"> Guardar </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <p class="text-muted">Revise sus datos antes de continuar</p>

                                </div>
                            </div>
                        </div>

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