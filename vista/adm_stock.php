<?php
session_start();
if ($_SESSION['us_tipo'] == 3) {
    include_once 'layout/header.php';
?>


    <title>Adm| Gestión de Stock</title>

    <!-- Google Font: Source Sans Pro -->
    <?php
    include_once 'layout/nav.php'
    ?>

    <!-- Modal -->
    <div class="modal fade" id="editarstock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Editar Stock</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="editar-stock" style="display:none;">
                            <span><i class="fas fa-check m-1"></i>El producto se edito correctamente</span>
                        </div>
                       
                        <form id="form-editarstock">
                        <div class="form-group">
                                <label for="codigo_stock">Código stock: </label>
                                <label id="codigo_stock">código stock</label>
                            </div>
                            
                            <div class="form-group">
                                <label for="cantidad">Cantidad: </label>
                                <input id="cantidad" type="text" class="form-control" placeholder="Ingrese la cantidad" required>
                            </div>
                           
                          <input type="hidden" id="id_stock_prod">
 
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
                        <h1>Gestión de Stock </h1>
                                                
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_listaproductos.php">Home</a></li>
                            <li class="breadcrumb-item active">Gestión de stock</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section>
            <div class="container-fluid">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Buscar stock</h3>
                        <div class="input-group">
                            <input type="text" id="buscar-stock" class="form-control float-left" placeholder="Ingrese nombre del producto">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>

                    </div>
                    <div class="card-body pb-0">
                        <div id="stocks" class="row">

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
<script src="../js/stock.js"></script>
<!-- <script src="../js/gestion_producto.js"></script> -->