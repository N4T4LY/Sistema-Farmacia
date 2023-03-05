<?php
session_start();
if ($_SESSION['us_tipo'] == 1 || $_SESSION['us_tipo'] == 3) {
    include_once 'layout/header.php';
?>


    <title>Adm| Gestión de clientes</title>

    <!-- Google Font: Source Sans Pro -->
    <?php
    include_once 'layout/nav.php'
    ?>

     

   
    <!-- Modal -->
    <div class="modal fade" id="crearcliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Crear cliente</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="add-cli" style="display:none;">
                            <span><i class="fas fa-check m-1"></i>El cliente se agrego correctamente</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noadd-cli" style="display:none;">
                            <span><i class="fas fa-times m-1"></i>El cliente ya existe</span>
                        </div>
                        
                        <form id="form-crear">
                            <div class="form-group">
                                <label for="nombre_cli">Nombre</label>
                                <input id="nombre_cli" type="text" class="form-control" placeholder="Ingrese nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="apellidos">Apellidos</label>
                                <input id="apellidos" type="text" class="form-control" placeholder="Ingrese apellidos" required>
                            </div>
                            <div class="form-group">
                                <label for="ci">CI</label>
                                <input id="ci" type="number" class="form-control" placeholder="Ingrese CI">
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
                        <h1>Gestión de clientes <button  type="button" data-toggle="modal" data-target="#crearcliente" class="btn bg-gradient-primary ml-2">Crear cliente</button> </h1>
                        
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_listaproductos.php">Home</a></li>
                            <li class="breadcrumb-item active">Gestión cliente</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section>
            <div class="container-fluid">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Buscar cliente</h3>
                        <div class="input-group">
                            <input type="text" id="buscar_cliente" class="form-control float-left" placeholder="Ingrese nombre de cliente">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>

                    </div>
                    <div class="card-body pb-0">
                        <div id="clientes" class="row">

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
<script src="../js/cliente.js"></script>
