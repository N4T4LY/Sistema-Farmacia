<?php
session_start();
if($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==3){
    include_once 'layout/header.php';
?>


  <title>Administrador | Caracteristicas</title>

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
                            <input type="hidden" name="id_logolab" id="id_logolab">
                          
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

  <!-- Modal labo-->
  <div class="modal fade" id="crearlabo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Crear laboratorio</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="siagregar-labo" style="display:none;">
                            <span><i class="fas fa-check m-1"></i>El laboratorio se agrego correctamente</span>
                        </div>
                        <div class="alert alert-success text-center" id="edit-labo" style="display:none;">
                            <span><i class="fas fa-check m-1"></i>El laboratorio se actualizo correctamente</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noagregar-labo" style="display:none;">
                            <span><i class="fas fa-times m-1"></i>El laboratorio ya existe</span>

                        </div>
                        <form id="form-crear-labo">
                            <div class="form-group">
                                <label for="nombre-labo">Nombre</label>
                                <input id="nombre-labo" type="text" class="form-control" placeholder="Ingrese nombre" required>
                                <input id="id-editlabo" type="hidden" >
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

      <!-- Modal tipo -->
  <div class="modal fade" id="creartipo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Crear tipo</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="siagregar-tipo" style="display:none;">
                            <span><i class="fas fa-check m-1"></i>El tipo se agrego correctamente</span>
                        </div>
                        <div class="alert alert-success text-center" id="edit-tipo" style="display:none;">
                            <span><i class="fas fa-check m-1"></i>El tipo se actualizo correctamente</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noagregar-tipo" style="display:none;">
                            <span><i class="fas fa-times m-1"></i>El tipo ya existe</span>

                        </div>
                        <form id="form-crear-tipo">
                            <div class="form-group">
                                <label for="nombre-tipo">Nombre</label>
                                <input id="nombre-tipo" type="text" class="form-control" placeholder="Ingrese nombre" required>
                                <input id="id-edittipo" type="hidden">
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

         <!-- Modal presentacion -->
  <div class="modal fade" id="crearpres" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Crear Presentación</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="siagregar-pres" style="display:none;">
                            <span><i class="fas fa-check m-1"></i>La presentación se agrego correctamente</span>
                        </div>
                        <div class="alert alert-success text-center" id="edit-pres" style="display:none;">
                            <span><i class="fas fa-check m-1"></i>La presentación se actualizo correctamente</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noagregar-pres" style="display:none;">
                            <span><i class="fas fa-times m-1"></i>La presentación ya existe</span>

                        </div>
                        <form id="form-crear-pres">
                            <div class="form-group">
                                <label for="nombre-pres">Nombre</label>
                                <input id="nombre-pres" type="text" class="form-control" placeholder="Ingrese nombre" required>
                                <input id="id-editpres" type="hidden">
                            </div>
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
            <h1>Gestión de las caracteristicas de los productos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Gestión de caracteristicas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a href="#laboratorio" class="nav-link active" data-toggle="tab">Laboratorio</a></li>
                                <li class="nav-item"><a href="#tipo" class="nav-link"  data-toggle="tab">Tipo</a></li>
                                <li class="nav-item"><a href="#presentacion" class="nav-link"  data-toggle="tab">Presentacion</a></li>
                            </ul>

                        </div>
                        <div class="card-body p-0">
                            <div class="tab-content" >
                                <div class="tab-pane active" id='laboratorio'>
                                    <div class="card card-danger">
                                        <div class="card-header">
                                            <div class="card-title">Buscar Laboratorio <button type="button" data-toggle="modal" data-target="#crearlabo" class="btn bg-gradient-primary btn-sm m-2">Crear laboratorio</button></div>
                                            <div class="input-group">
                                                <input id="buscar-laboratorio" type="text" class="form-control float-left" placeholder='Ingrese nombre'>
                                                <div class="input-group-append">
                                                    <button class="btn btn-default"><i class="fas fa-search"></i></button>

                                                </div>

                                            </div>
                                           
                                        </div>
                                        <div class="card-body p-0 table-responsive">
                                            <table class="table table-hover text-nowrap">
                                                <thead class="table-danger">
                                                    <tr>
                                                        <th>Laboratorio</th>
                                                        <th>Logo</th>
                                                        <th>Acciones</th>
                                                    </tr>

                                                </thead>
                                                <tbody class="table-active" id="laboratorios">



                                                </tbody>

                                            </table>
                                        </div>
                                        <div class="card footer"></div>
                                    </div>
                                </div>
                                <div class="tab-pane" id='tipo'>
                                    <div class="card card-danger">
                                        <div class="card-header">
                                            <div class="card-title">Buscar Tipo de medicamento <button type="button" data-toggle="modal" data-target="#creartipo" class="btn bg-gradient-primary btn-sm m-2">Crear tipo</button></div>
                                            <div class="input-group">
                                                <input id="buscar-tipo" type="text" class="form-control float-left" placeholder='Ingrese nombre'>
                                                <div class="input-group-append">
                                                    <button class="btn btn-default"><i class="fas fa-search"></i></button>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="card-body p-0 table-responsive">
                                            <table class="table table-hover text-nowrap">
                                                <thead class="table-danger">
                                                    <tr>
                                                        <th>Tipo</th>
                                                        <th>Acciones</th>
                                                    </tr>

                                                </thead>
                                                <tbody class="table-active" id="tipos">



                                                </tbody>

                                            </table>
                                        </div>

                                        <div class="card footer"></div>
                                    </div>
                                </div>
                                <div class="tab-pane" id='presentacion'>
                                    <div class="card card-danger">
                                        <div class="card-header">
                                            <div class="card-title">Buscar Presentación <button type="button" data-toggle="modal" data-target="#crearpres" class="btn bg-gradient-primary btn-sm m-2">Crear presentacion</button></div>
                                            <div class="input-group">
                                                <input id="buscar-presentacion" type="text" class="form-control float-left" placeholder='Ingrese nombre'>
                                                <div class="input-group-append">
                                                    <button class="btn btn-default"><i class="fas fa-search"></i></button>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="card-body">
                                        <div class="card-body p-0 table-responsive">
                                            <table class="table table-hover text-nowrap">
                                                <thead class="table-danger">
                                                    <tr>
                                                        <th>Presentación</th>
                                                        <th>Acciones</th>
                                                    </tr>

                                                </thead>
                                                <tbody class="table-active" id="presentaciones">



                                                </tbody>

                                            </table>
                                        </div>


                                        </div>
                                        <div class="card footer"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
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
<script src="../js/laboratorio.js"></script>
<script src="../js/tipo.js"></script>
<script src="../js/presentacion.js"></script>