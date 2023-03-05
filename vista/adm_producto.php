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

      


    <!-- Modal -->
    <div class="modal fade" id="crearstock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Crear Stock</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="siagregar-stock" style="display:none;">
                            <span><i class="fas fa-check m-1"></i>El producto se agregó correctamente</span>
                        </div>
                       
                        <form id="form-crearstock">
                        <div class="form-group">
                                <label for="nombre_prod_stock">Producto: </label>
                                <label id="nombre_prod_stock">Nombre del producto </label>
                            </div>
                            <div class="form-group">
                                <label for="proveedor">Proveedor: </label>
                                <select name="proveedor" id="proveedor" class="form-control select2" style="width: 100%"></select>
                               
                            </div>
                            <div class="form-group">
                                <label for="cantidad">Cantidad: </label>
                                <input id="cantidad" type="text" class="form-control" placeholder="Ingrese la cantidad" required>
                            </div>
                            <div class="form-group">
                                <label for="vencimiento">Vencimiento: </label>
                                <input id="vencimiento" type="date" class="form-control" placeholder="Ingrese informacion adicional" required>
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


    <!-- Modal logo -->
   <div class="modal fade" id="cambiologo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cambiar Logo de Producto</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img id="logoactual" src="../img/prod/defaultimg.jpg" class="profile-user-img img-fluid img-circle" alt="">
                    </div>
                    <div class="text-center">
                        <b id="nombre_logo">
                           
                        </b>
                    </div>
                    <div class="alert alert-success text-center" id="edit" style="display:none;">
                        <span><i class="fas fa-check m-1"></i>Su logo fue cambiado correctamente</span>
                     </div>
                    <div class="alert alert-danger text-center" id="nedit" style="display:none;">
                        <span><i class="fas fa-times m-1"></i>Formato Incorrecto</span>

                    </div>
                    <form id="form-logo" enctype="multipart/form-data" >
                        <div class="input-group mb-3 ml-5 mt-2">
                            <input type="file" name="foto" class="input-group">
                            <input type="hidden" name="funcion" id="funcion">
                            <input type="hidden" name="id_imgprod" id="id_imgprod">
                            <input type="hidden" name="imagen_prod" id="imagen_prod">
                          
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
    <div class="modal fade" id="crearproducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Crear producto</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
          
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="siagregar-prod" style="display:none;"> <span><i class="fas fa-check m-1"></i>El producto se agrego correctamente</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noagregar-prod" style="display:none;">
                            <span><i class="fas fa-times m-1"></i>El producto ya existe</span>

                        </div>
                        <div class="alert alert-success text-center" id="edit-prod" style="display:none;">
                            <span><i class="fas fa-check m-1"></i>Se edito correctamente</span>

                        </div>
                
                        <form id="form-crearprod">
                            <div class="form-group">
                                <label for="nombre_producto">Nombre</label>
                                <input id="nombre_producto" type="text" class="form-control" placeholder="Ingrese nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="concentracion">Concentración</label>
                                <input id="concentracion" type="text" class="form-control" placeholder="Ingrese la concentracion" required>
                            </div>
                            <div class="form-group">
                                <label for="adicional">Adicional</label>
                                <input id="adicional" type="text" class="form-control" placeholder="Ingrese informacion adicional" required>
                            </div>
                            <div class="form-group">
                                <label for="precio">Precio</label>
                                <input id="precio" type="number" step="any" class="form-control" value="0" placeholder="Ingrese el precio" required>
                            </div>
                            <div class="form-group">
                                <label for="registro">Registro Sanitario</label>
                                <input id="registro" type="date" class="form-control" placeholder="Ingrese Registro Sanitario" required>
                            </div>
                            <div class="form-group">
                                <label for="laboratorio">Laboratorio</label>
                                <select name="laboratorio" id="laboratorio" class="form-control select2" style="width: 100%"></select>
                               
                            </div>
                            <div class="form-group">
                                <label for="tipo">Tipo</label>
                                <select name="tipo" id="tipo" class="form-control select2" style="width: 100%"></select>
                               
                            </div>
                        
                            <div class="form-group">
                                <label for="presentacion">Presentación</label>
                                <select name="presentacion" id="presentacion" class="form-control select2" style="width: 100%"></select>
                               
                            </div>
                            <input type="hidden" id="id_edit_prod">
                        
                        

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
                        <h1>Gestión de Productos <button id="boton-crear" type="button" data-toggle="modal" data-target="#crearproducto" class="btn bg-gradient-primary ml-2">Crear Producto</button> 
                        <button type="button" id="boton-reporte"  class="btn bg-gradient-success ml-2">Reporte de producto</button> 
                    </h1>
                                                
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_listaproductos.php">Home</a></li>
                            <li class="breadcrumb-item active">Gestión de productos</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
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


    </div>
    <!-- /.content-wrapper -->



<?php
    include_once 'layout/footer.php';
} else {
    header('Location: ../index.php');
}
?>
<script src="../js/producto.js"></script>
<!-- <script src="../js/gestion_producto.js"></script> -->