<?php
session_start();
if ($_SESSION['us_tipo'] == 1 || $_SESSION['us_tipo'] == 3) {
    include_once 'layout/header.php';
?>


    <title>Adm| Gestión de proveedores</title>

    <!-- Google Font: Source Sans Pro -->
    <?php
    include_once 'layout/nav.php'
    ?>
    <!-- Modal logo -->
   <div class="modal fade" id="cambiologo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cambiar Logo de Laboratorio</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img id="logoactual" src="../img/avatar.png" class="profile-user-img img-fluid img-circle" alt="">
                    </div>
                    <div class="text-center">
                        <b id="nombre_logo">
                           
                        </b>
                    </div>
                    <div class="alert alert-success text-center" id="edit_prov" style="display:none;">
                        <span><i class="fas fa-check m-1"></i>Su logo fue cambiado correctamente</span>
                     </div>
                    <div class="alert alert-danger text-center" id="nedit_prov" style="display:none;">
                        <span><i class="fas fa-times m-1"></i>Formato Incorrecto</span>

                    </div>
                    <form id="form-logo" enctype="multipart/form-data" >
                        <div class="input-group mb-3 ml-5 mt-2">
                            <input type="file" name="foto" class="input-group">
                            <input type="hidden" name="funcion" id="funcion">
                            <input type="hidden" name="id_logoprov" id="id_logoprov">
                            <input type="hidden" name="imagen_prov" id="imagen_prov">
                          
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
    <div class="modal fade" id="crearproveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Crear proveedor</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="siagregar-prov" style="display:none;">
                            <span><i class="fas fa-check m-1"></i>El proveedor se agrego correctamente</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noagregar-prov" style="display:none;">
                            <span><i class="fas fa-times m-1"></i>El proveedor ya existe</span>
                        </div>
                        <div class="alert alert-success text-center" id="edit-prov" style="display:none;">
                            <span><i class="fas fa-times m-1"></i>El proveedor se modifico correctamente</span>

                        </div>
                        <form id="form-crear">
                            <div class="form-group">
                                <label for="nombre_prov">Nombre</label>
                                <input id="nombre_prov" type="text" class="form-control" placeholder="Ingrese nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Telefono</label>
                                <input id="telefono" type="number" class="form-control" placeholder="Ingrese telefono" required>
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo Electronico</label>
                                <input id="correo" type="email" class="form-control" placeholder="Ingrese correo electronico">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input id="direccion" type="text" class="form-control" placeholder="Ingrese direccion" required>
                            </div>
                            <input type="hidden" id="id_edit_prov">
                  
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
                        <h1>Gestión de Proveedores <button  type="button" data-toggle="modal" data-target="#crearproveedor" class="btn bg-gradient-primary ml-2">Crear proveedor</button> </h1>
                        
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_listaproductos.php">Home</a></li>
                            <li class="breadcrumb-item active">Gestión proveedor</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section>
            <div class="container-fluid">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Buscar proveedor</h3>
                        <div class="input-group">
                            <input type="text" id="buscar_proveedor" class="form-control float-left" placeholder="Ingrese nombre de proveedor">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>

                    </div>
                    <div class="card-body pb-0">
                        <div id="proveedores" class="row">

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
<script src="../js/proveedor.js"></script>
