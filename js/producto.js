$(document).ready(function () {
  var funcion;
  //bandera de cambio de modal de crear prod a editar
  var editt = false;
  $('.select2').select2();
  llenar_labo();
  llenar_tipo();
  llenar_pres();
  buscar_producto();
  llenar_prov();

  function llenar_prov() {
    funcion = "llenar_prov";
    $.post('../controlador/controladorProveedor.php', { funcion }, (response) => {
      //console.log(response);
      const proveedores = JSON.parse(response);
      let template = '';
      proveedores.forEach(proveedor => {
        template += `
              <option value="${proveedor.id}">${proveedor.nombre_prov}</option>

              `;

      });
      $('#proveedor').html(template);
    })
  }
  function llenar_labo() {
    funcion = "llenar_labo";
    $.post('../controlador/controladorLabo.php', { funcion }, (response) => {
      //console.log(response);
      const laboratorios = JSON.parse(response);
      let template = '';
      laboratorios.forEach(laboratorio => {
        template += `
                <option value="${laboratorio.id}">${laboratorio.nombre_lab}</option>

                `;

      });
      $('#laboratorio').html(template);
    })
  }
  function llenar_tipo() {
    funcion = "llenar_tipo";
    $.post('../controlador/controladorTipo.php', { funcion }, (response) => {
      //console.log(response);
      const tipos = JSON.parse(response);
      let template = '';
      tipos.forEach(tipo => {
        template += `
                <option value="${tipo.id}">${tipo.nombre_tip_prod}</option>

                `;

      });
      $('#tipo').html(template);
    })
  }
  function llenar_pres() {
    funcion = "llenar_pres";
    $.post('../controlador/controladorPresen.php', { funcion }, (response) => {
      //console.log(response);
      const presentaciones = JSON.parse(response);
      let template = '';
      presentaciones.forEach(presentacion => {
        template += `
                <option value="${presentacion.id}">${presentacion.nombre_presen}</option>

                `;

      });
      $('#presentacion').html(template);
    })
  }
  $('#form-crearprod').submit(e => {
    let id = $('#id_edit_prod').val();
    let nombre_producto = $('#nombre_producto').val();
    let concentracion = $('#concentracion').val();
    let adicional = $('#adicional').val();
    let precio = $('#precio').val();
    let registro = $('#registro').val();
    let laboratorio = $('#laboratorio').val();
    let tipo = $('#tipo').val();
    let presentacion = $('#presentacion').val();
    //console.log(nombre_producto+" "+concentracion+" "+adicional+" "+precio+" "+registro+" "+laboratorio+" "+tipo+" "+presentacion);
    //cuando inicia la pag editt es falso luego aqui id es vacio como es vacio ira a crear y de ahi ira al controlador para crear el producto
    if (editt == true) {
      funcion = "editar";
    }
    else {
      funcion = "crear";
    }
    $.post('../controlador/controladorProducto.php', { funcion, id, nombre_producto, concentracion, adicional, precio, registro, laboratorio, tipo, presentacion }, (response) => {
      console.log(response);
      if (response == 'siagregar-prod') {
        $('#siagregar-prod').hide('slow');
        $('#siagregar-prod').show(1000);
        $('#siagregar-prod').hide(2000);
        $('#form-crearprod').trigger('reset');
        $('#laboratorio').val('').trigger('change');
        $('#tipo').val('').trigger('change');
        $('#presentacion').val('').trigger('change');
        buscar_producto();
      }
      if (response == 'edit') {
        $('#edit-prod').hide('slow');
        $('#edit-prod').show(1000);
        $('#edit-prod').hide(2000);
        $('#form-crearprod').trigger('reset');
        $('#laboratorio').val('').trigger('change');
        $('#tipo').val('').trigger('change');
        $('#presentacion').val('').trigger('change');
        //cuando se agrega se vuelve a hacer la consulta y se muestra el valor agregado
        buscar_producto();
      }
      if (response == 'noagregar-prod') {
        $('#noagregar-prod').hide('slow');
        $('#noagregar-prod').show(1000);
        $('#noagregar-prod').hide(2000);
        $('#form-crearprod').trigger('reset');
      }
      if (response == 'nedit') {
        $('#noagregar-prod').hide('slow');
        $('#noagregar-prod').show(1000);
        $('#noagregar-prod').hide(2000);
        $('#form-crearprod').trigger('reset');
      }
      edit = false;



    });
    e.preventDefault();
  });
  function buscar_producto(consulta) {
    funcion = "buscar";
    $.post('../controlador/controladorProducto.php', { consulta, funcion }, (response) => {
      //console.log(response);
      const productos = JSON.parse(response);
      let template = '';
      productos.forEach(producto => {
        template += `
                <div prodId="${producto.id}" prodNombre="${producto.nombre_producto}" prodPrecio="${producto.precio}" prodConcentracion="${producto.concentracion}" prodAdicional="${producto.adicional}" prodRegistro="${producto.registro}" prodLabo="${producto.laboratorio_id}" prodTipo="${producto.tipo_id}" prodPresentacion="${producto.presentacion_id}" prodImagen="${producto.imagen_prod}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                <i class="fas fa-lg fa-cubes mr-1"></i>${producto.cantidad}
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>${producto.nombre_producto}</b></h2>
                      <h4 class="lead"><b>${producto.precio} Bs.</b></h4>
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> Concentracion: ${producto.concentracion}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span> Adicional: ${producto.adicional}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-calendar-day"></i></span> Registro Sanitario: ${producto.registro}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-flask"></i></span> Laboratorio: ${producto.laboratorio}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-plus-circle"></i></span> Tipo: ${producto.tipo}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-pills"></i></span> Presentacion: ${producto.presentacion}</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${producto.imagen_prod}" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <button class="imagen_prod btn btn-sm bg-teal" type="button" data-toggle="modal" data-target="#cambiologo">
                      <i class="fas fa-image"></i>
                    </button>
                    <button class="editar btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#crearproducto">
                      <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="stock btn btn-sm btn-primary"type="button" data-toggle="modal" data-target="#crearstock">
                      <i class="fas fa-plus-square"></i>
                    </button>
                    <button class="borrar btn btn-sm btn-danger">
                    <i class="fas fa-trash-alt"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
                
                `;

      });
      $('#productos').html(template);
    });


  }
  $(document).on('keyup', '#buscar-producto', function () {
    let valor = $(this).val();
    if (valor !== "") {
      buscar_producto(valor);
      //console.log(valor);
    }
    else {
      buscar_producto();
      //console.log(valor);
    }
  });
  $(document).on('click', '.imagen_prod', (e) => {
    funcion = "cambiar_img";
    const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
    const id = $(elemento).attr('prodId');
    const imagen_prod = $(elemento).attr('prodImagen');
    const nombre = $(elemento).attr('prodNombre');
    //console.log(id+' '+imagen_prod);
    $('#funcion').val(funcion);
    $('#id_imgprod').val(id);
    $('#imagen_prod').val(imagen_prod);
    $('#logoactual').attr('src', imagen_prod);
    $('#nombre_logo').html(nombre);
  });

  $(document).on('click', '.stock', (e) => {

    const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
    const id = $(elemento).attr('prodId');

    const nombre = $(elemento).attr('prodNombre');
    //console.log(id+' '+imagen_prod);
    $('#id_stock_prod').val(id);

    $('#nombre_prod_stock').html(nombre);
  });

  $('#form-logo').submit(e => {
    let formData = new FormData($('#form-logo')[0]);
    $.ajax({
      url: '../controlador/controladorProducto.php',
      type: 'POST',
      data: formData,
      cache: false,
      processData: false,
      contentType: false

    }).done(function (response) {
      console.log(response);
      const json = JSON.parse(response);
      if (json.alert == 'edit') {
        $('#logoactual').attr('src', json.ruta);
        $('#edit').hide('slow');
        $('#edit').show(1000);
        $('#edit').hide(2000);
        $('#form-logo').trigger('reset');
        buscar_producto();
      }
      else {
        $('#nedit').hide('slow');
        $('#nedit').show(1000);
        $('#nedit').hide(2000);
        $('#form-logo').trigger('reset');
      }
    });
    e.preventDefault();
  });
  $(document).on('click', '.editar', (e) => {
    const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
    const id = $(elemento).attr('prodId');
    const nombre = $(elemento).attr('prodNombre');
    const concentracion = $(elemento).attr('prodConcentracion');
    const adicional = $(elemento).attr('prodAdicional');
    const precio = $(elemento).attr('prodPrecio');
    const registro = $(elemento).attr('prodRegistro');
    const laboratorio = $(elemento).attr('prodLabo');
    const tipo = $(elemento).attr('prodTipo');
    const presentacion = $(elemento).attr('prodPresentacion');
    //console.log(laboratorio+' '+tipo+' '+presentacion);

    $('#id_edit_prod').val(id);
    $('#nombre_producto').val(nombre);
    $('#concentracion').val(concentracion);
    $('#adicional').val(adicional);
    $('#precio').val(precio);
    $('#registro').val(registro);
    //trigger para cambiar la seleccion
    $('#laboratorio').val(laboratorio).trigger('change');
    $('#tipo').val(tipo).trigger('change');
    $('#presentacion').val(presentacion).trigger('change');
    editt = true;

  });

  $(document).on('click', '.borrar', (e) => {
    funcion = "borrar";
    const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
    const id = $(elemento).attr('prodId');
    const nombre = $(elemento).attr('prodnombre');
    const imagen = $(elemento).attr('prodImagen');

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger mr-1'
      },
      buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
      title: 'Desea eliminar el laboratorio ' + nombre + ' ?',
      text: "No se podra revertir esto!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Si, deseo borrar',
      cancelButtonText: 'No, cancelar',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        $.post('../controlador/controladorProducto.php', { id, funcion }, (response) => {
          console.log(response);
          editt == false;
          if (response == 'borrado') {
            swalWithBootstrapButtons.fire(
              'Eliminado con exito',
              'El producto ' + nombre + ' fue eliminado correctamente',
              'success')
            buscar_producto();
          }
          else {
            swalWithBootstrapButtons.fire(
              'No fue eliminado',
              'El producto ' + nombre + ' no fue borrado porque tiene stock disponible',
              'error')


          }
        })


      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Cancelado',
          'El producto no fue eliminado :)',
          'error'
        )

      }
    })


  })
  $('#form-crearstock').submit(e => {
    let id_producto = $('#id_stock_prod').val();
    let proveedor = $('#proveedor').val();
    let cantidad = $('#cantidad').val();
    let vencimiento = $('#vencimiento').val();
    funcion = 'crear'
    $.post('../controlador/controladorStock.php', { funcion, vencimiento, cantidad, proveedor, id_producto }, (response) => {
      $('#siagregar-stock').hide('slow');
      $('#siagregar-stock').show(1000);
      $('#siagregar-stock').hide(2000);
      $('#form-crearstock').trigger('reset');
      buscar_producto();
    });


    e.preventDefault();

  });
  $(document).on('click','#boton-reporte',(e)=>{
    mostrar_loader("generarReportePDF");
    funcion='reporte_productos';
    //console.log(funcion);
    $.post('../controlador/controladorProducto.php',{funcion},(response)=>{
      console.log(response);
      if (response=="") {
        cerrar_loader("exito_reporte");

        window.open('../pdf/pdf-'+funcion+'.pdf','_blank');
        
      }else{
        cerrar_loader("error_reporte");

      }
    
    });

  });

  function mostrar_loader(mensaje) {
    var texto=null;
    var mostrar=false;
    switch (mensaje) {
        case 'generarReportePDF':
            texto='Se esta generando el reporte en formato PDF, por favor espere...';
            mostrar=true;
            break;
    
    }
    if(mostrar){
        Swal.fire({
          
            title: 'Generando reporte',
            text: texto,
            showConfirmButton:false
           
          })

    }
}
function cerrar_loader(mensaje) {
    var tipo=null;
    var texto=null;
    var mostrar=false;
    switch (mensaje) {
        case 'exito_reporte':
            tipo='success';
            texto='el reporte fue generado correctamente';
            mostrar=true;
            break;
        case 'error_reporte':
            tipo='error';
            texto='El reporte no pudo generarse, comunicarse con el personal de sistemas';
            mostrar=true;
            break;
        

        default:
            swal.close();
            break;
    
    }
    if(mostrar){
        Swal.fire({
            position:'center',
            icon: tipo,
            text: texto,
            showConfirmButton:false
           
          })

    }
}



})
