$(document).ready(function () {
    var funcion;
 
    buscar_stock();
   
  
    
    function buscar_stock(consulta) {
      funcion = "buscar";
      $.post('../controlador/controladorStock.php', { consulta, funcion }, (response) => {
        //console.log(response);
        const stocks = JSON.parse(response);
        let template = '';
        stocks.forEach(stock => {
          template += `
                  <div stockId="${stock.id}" stockCantidad="${stock.cantidad}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">`;
                  if(stock.estado=='light'){
                    template += `<div class="card bg-light d-flex flex-fill">`;
                  }
                  if(stock.estado=='danger'){
                    template += `<div class="card bg-danger d-flex flex-fill">`;
                  }
                  if(stock.estado=='warning'){
                    template += `<div class="card bg-warning d-flex flex-fill">`;
                  }

                  template += `<div class="card-header border-bottom-0">
                  <h6>Codigo: ${stock.id}</h6>
                  <i class="fas fa-lg fa-cubes mr-1"></i>${stock.cantidad}
                  </div>
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-7">
                        <h2 class="lead"><b>${stock.nombre_producto}</b></h2>
                       
                      <ul class="ml-4 mb-0 fa-ul">
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> Concentracion: ${stock.concentracion}</li>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span> Adicional: ${stock.adicional}</li>
                          <li class="small"><span class="fa-li"><i class="fas fa-calendar"></i></span> Registro Sanitario: ${stock.registro}</li>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-flask"></i></span> Laboratorio: ${stock.laboratorio}</li>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-plus-circle"></i></span> Tipo: ${stock.tipo}</li>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-pills"></i></span> Presentacion: ${stock.presentacion}</li>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg  fa-calendar-times"></i></span> Vencimiento: ${stock.vencimiento}</li>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-truck"></i></span> Proveedor: ${stock.proveedor}</li>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar-alt"></i></span> Anio: ${stock.anio}</li>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar-alt"></i></span> Mes: ${stock.mes}</li>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar-day"></i></span> Dia: ${stock.dia}</li>
                         
                        </ul>
                      </div>
                      <div class="col-5 text-center">
                        <img src="${stock.imagen_prod}" alt="user-avatar" class="img-circle img-fluid">
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="text-right">
                     
                      <button class="editar btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#editarstock">
                        <i class="fas fa-pencil-alt"></i>
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
        $('#stocks').html(template);
      });
  
  
    }
    $(document).on('keyup', '#buscar-stock', function () {
      let valor = $(this).val();
      if (valor !== "") {
        buscar_stock(valor);
        //console.log(valor);
      }
      else {
        buscar_stock();
        //console.log(valor);
      }
    });

    $(document).on('click', '.editar', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('stockId');
        const cantidad = $(elemento).attr('stockCantidad');
      
        //console.log(laboratorio+' '+tipo+' '+presentacion);
    
        $('#id_stock_prod').val(id);
        $('#cantidad').val(cantidad);
        $('#codigo_stock').html(id);
       
        //editt = true;
    
      });

      $('#form-editarstock').submit(e=>{
        let id = $('#id_stock_prod').val();
        let cantidad = $('#cantidad').val();
        funcion="editar";
        $.post('../controlador/controladorStock.php',{id,cantidad,funcion},(response)=>{
            if(response=='edit'){
                $('#editar-stock').hide('slow');
                $('#editar-stock').show(1000);
                $('#editar-stock').hide(2000);
                $('#form-editarstock').trigger('reset');

            }
            buscar_stock();
        })
        e.preventDefault();
      })

      $(document).on('click', '.borrar', (e) => {
        funcion = "borrar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('stockId');
        
        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger mr-1'
          },
          buttonsStyling: false
        })
    
        swalWithBootstrapButtons.fire({
          title: 'Desea eliminar el stock ' + id + ' ?',
          text: "No se podra revertir esto!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Si, deseo borrar',
          cancelButtonText: 'No, cancelar',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            $.post('../controlador/controladorStock.php', { id, funcion }, (response) => {
              
              if (response == 'borrado') {
                swalWithBootstrapButtons.fire(
                  'Eliminado con exito',
                  'El stock ' + id + ' fue eliminado correctamente',
                  'success')
                buscar_stock();
              }
              else {
                swalWithBootstrapButtons.fire(
                  'No fue eliminado',
                  'El stock ' + id + ' no fue borrado porque esta siendo utilizado ',
                  'error')
    
    
              }
            })
    
    
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'Cancelado',
              'El stock no fue eliminado :)',
              'error'
            )
    
          }
        })
    
    
      })
   
  })
  