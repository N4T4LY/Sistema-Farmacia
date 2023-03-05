<?php
session_start();
require_once('../vendor/autoload.php');
if ($_SESSION['us_tipo'] == 3||$_SESSION['us_tipo'] == 1||$_SESSION['us_tipo'] == 2) {
    include_once 'layout/header.php';
?>

    <title>Adm| Gestión de Ventas</title>

    <?php
    include_once 'layout/nav.php'
    ?>

<div class="modal fade" id="vista_venta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Registro de ventas</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="codigo_venta">Código Venta:</label>
                            <span id="codigo_venta"></span>
                        </div>
                        <div class="form-group">
                            <label for="fecha">Fecha:</label>
                            <span id="fecha"></span>
                        </div>
                        <div class="form-group">
                            <label for="cliente">Cliente:</label>
                            <span id="cliente"></span>
                        </div>
                        <div class="form-group">
                            <label for="ci">CI:</label>
                            <span id="ci"></span>
                        </div>
                        <div class="form-group">
                            <label for="vendedor">Vendedor:</label>
                            <span id="vendedor"></span>
                        </div>
                        <div class="card-body p-0 table-responsive">

                            <table class="table table-hover text-nowrap">
                                <thead class="table-success">
                                    <tr>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Producto</th>
                                        <th>Concentracion</th>
                                        <th>Adicional</th>
                                        <th>Registro</th>
                                        <th>Laboratorio</th>
                                        <th>Presentacion</th>
                                        <th>Tipo</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody id="registros" class="table-warning">
    
                                </tbody>
                            </table>
                        </div>
                        <div class="float-right input-group-append">
                            <h3 class="m-3">Total:</h3>
                            <h3 class="m-3" id="total"></h3>

                        </div>
                    </div>
                    <div class="card-footer">
                        
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
                        <h1>Gestión de Ventas </h1>
                                                
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_listaproductos.php">Home</a></li>
                            <li class="breadcrumb-item active">Gestión de ventas</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section>
            <div class="container-fluid">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Consultas</h3>
  
                    </div>
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                <div class="inner">
                                    <h3 id="venta_dia_vendedor">0</h3>

                                    <p>Venta del día por vendedor</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                <div class="inner">
                                    <h3 id="venta_diaria">0</h3>

                                    <p>Venta Diaria</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3 id="venta_mensual">0</h3>

                                    <p>Venta Mensual</p>
                                </div>
                                <div class="icon">
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                                <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3 id="venta_anual">0</h3>

                                    <p>Venta Anual</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-signal"></i>
                                </div>
                                <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                  </div>
                       
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>


        </section>

        <section>
            <div class="container-fluid">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Buscar Venta</h3>
                        

                    </div>
                    <div class="card-body p-0 table-responsive">
                        <table id="tabla_venta" class="display table table-hover text-nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>CI</th>
                                    <th>Total</th>
                                    <th>Vendedor</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>    
                            <tbody>
                            </tbody>                       
                        </table>
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
<script src="../js/datatables.js"></script>
<script src="../js/venta.js"></script>
<!-- <script src="../js/gestion_producto.js"></script> -->