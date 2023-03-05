<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      
    </div>
    <strong></strong> 
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>
<!-- sweet alert -->
<script src="../js/sweetalert2.js"></script>
<!-- select2 -->
<script src="../js/select2.js"></script>

<!-- AdminLTE for demo purposes -->
 <!-- <script src="../js/demo.js"></script>   -->
</body>
<script>
  let funcion = 'devolver_avatar';
  $.post('../controlador/controladorUsuario.php',{funcion},(response)=>{
    //console.log(response);
    const avatar=JSON.parse(response);
    $('#foto4').attr('src','../img/'+avatar.avatar);
  })
  funcion='tipo_usuario';
  $.post('../controlador/controladorUsuario.php',{funcion},(response)=>{
    //console.log(response);
    if (response==1) {
      $('#gestion_stock').hide();
      
    }else if(response==2){
      $('#gestion_lote').hide();
      $('#gestion_usuario').hide();
      $('#gestion_producto').hide();
      $('#gestion_atributo').hide();
      $('#gestion_proveedor').hide();
    }
    
  })

</script>
</html>