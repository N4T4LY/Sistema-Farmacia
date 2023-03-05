<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- icon -->
<link rel="icon" href="../img/logo.png" type="image/png">   
<!-- Font Awesome -->
<link rel="stylesheet" href="../css/animate.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="../css/datatables.css">   
<!-- Font Awesome -->
<link rel="stylesheet" href="../css/compra.css">   
<!-- Font Awesome -->
 <link rel="stylesheet" href="../css/main.css">  
<!-- Font Awesome -->
  <link rel="stylesheet" href="../css/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/css/adminlte.min.css">
   <!-- sweet -->
   <link rel="stylesheet" href="../css/sweetalert2.css">
     <!-- select2 -->
     <link rel="stylesheet" href="../css/select2.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../vista/adm_listaproductos.php" class="nav-link">Home</a>
      </li>
    
     
      <li class="nav-item dropdown" id="carrito" style="display:none">
          <img src="../img/carrito.png" class="imagen-carrito nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
           <span id="contador" class="contador badge badge-danger"></span>
          </img>
          <div  class="dropdown-menu" aria-labelledby="navbarDropdown">
         <!--  <ul class="dropdown-menu"> -->
            <table class="carro table card-body p-0 table-responsive">
              <thead class="table-success">
                <tr>
                  <th>Código</th>
                  <th>Nombre</th>
                  <th>Concentración</th>
                  <th>Adicional</th>
                  <th>Registro</th>
                  <th>Precio</th>
                  <th>Eliminar</th>
                </tr>

              </thead>
              <tbody id="lista">

              </tbody>
            </table>
            <a href="#" id="procesar-pedido" class="btn btn-danger btn-block">Procesar Compra</a>
            <a href="#" id="vaciar-carrito" class="btn btn-primary btn-block">Vaciar Carrito</a>
          <!-- </ul> -->
          </div>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <a href="../controlador/logout.php">Cerrar sesión</a>
        </li>
    <!--   <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li> -->
     
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../vista/adm_listaproductos.php" class="brand-link">
      <img src="../img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">LA GLORIETA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image" >
          <img id="foto4" src="../img/avatar.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="editar_datos.php" class="d-block">
            <?php
            echo   $_SESSION['nombre_us'];
           
           
           
            ?>


          </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        
        <li class="nav-header">USUARIO</li>
         
         <li class="nav-item">
           <a href="editar_datos.php" class="nav-link">
             <i class="nav-icon fas fa-user-cog"></i>
             <p>
               Datos Personales
             </p>
           </a>
         </li>
         <li id="gestion_usuario" class="nav-item">
           <a href="adm_usuario.php" class="nav-link">
             <i class="nav-icon fas fa-users"></i>
             <p>
                Gestión de usuarios
             </p>
           </a>
         </li>
         <!-- <li id="gestion_cliente" class="nav-item">
           <a href="adm_cliente.php" class="nav-link">
             <i class="nav-icon fas fa-user-friends"></i>
             <p>
                Gestión de clientes
             </p>
           </a>
         </li> -->

         <li class="nav-header">VENTAS</li>

          <li class="nav-item">
            <a href="adm_venta.php" class="nav-link">
              <i class="nav-icon fas fa-notes-medical"></i>
              <p>
                Listado de ventas
              </p>
            </a>
          </li>
         

          <li class="nav-header">INVENTARIO</li>

          <li id="gestion_producto" class="nav-item">
            <a href="adm_producto.php" class="nav-link">
              <i class="nav-icon fas fa-pills"></i>
              <p>
                Gestión de productos
              </p>
            </a>
          </li>
         
         
          <li id="gestion_atributo" class="nav-item">
            <a href="adm_atributo.php" class="nav-link">
              <i class="nav-icon fas fa-vials"></i>
              <p>
                Gestión de atributos
              </p>
            </a>
          </li>
          <li id="gestion_stock" class="nav-item">
            <a href="adm_stock.php" class="nav-link">
              <i class="nav-icon fas fa-cubes"></i>
              <p>
                Gestión de stock
              </p>
            </a>
          </li>
          <li class="nav-header">COMPRAS</li>

            <li id="gestion_proveedor" class="nav-item">
              <a href="adm_proveedor.php" class="nav-link">
                <i class="nav-icon fas fa-truck"></i>
                <p>
                  Gestión de Proveedor
                </p>
              </a>
            </li>
         

        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <?php
  include '../alerta.php';
  ?>