<?php
session_start();
if($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==3||$_SESSION['us_tipo']==2){
    include_once 'layout/header.php';
?>


  <title>Administrador | ListaProd</title>

  <!-- Google Font: Source Sans Pro -->
  <?php
  include_once 'layout/nav.php'
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="animate__animated animate__pulse">Lista de Productos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Lista de productos</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
            <div class="container-fluid">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Stock en riesgo</h3>
                       

                    </div>
                    <div class="card-body p-0 table-responsive">
                      <table class="animate__animated animate__fadeIn table table-hover text-nowrap">
                        <thead class="table-sucess">
                          <tr>
                            <th>Cod</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Laboratorio</th>
                            <th>Presentacion</th>
                            <th>Proveedor</th>
                            <th>Mes</th>
                            <th>Dia</th>
                          </tr>
                         
                        </thead>
                        <tbody id="stocks" class="table-active">
                            
                        </tbody>
                      </table>
                      


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
                        <h3 class="card-title">Buscar producto</h3>
                        <div class="input-group">
                            <input type="text" id="buscar-producto" class="form-control float-left" placeholder="Ingrese nombre del producto">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>

                    </div>
                    <div class="card-body pb-0">
                        <div id="productos" class="row">

                        </div>


                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>


        </section>



    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 

<?php
include_once 'layout/footer.php';
}
else{
    header('Location: ../index.php');
   
}
?>
<script src="../js/listaProductos.js"></script>

<script src="../js/carrito.js"></script>