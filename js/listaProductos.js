$(document).ready(function () {
    $('#carrito').show();
    buscar_producto();
    mostrar_stockriesgo(); 
    function buscar_producto(consulta) {
        funcion = "buscar";
        $.post('../controlador/controladorProducto.php', { consulta, funcion }, (response) => {
          //console.log(response);
          const productos = JSON.parse(response);
          let template = '';
          productos.forEach(producto => {
            template += `
                    <div prodId="${producto.id}"prodCantidad="${producto.cantidad}"prodNombre="${producto.nombre_producto}"prodPrecio="${producto.precio}" prodConcentracion="${producto.concentracion}" prodAdicional="${producto.adicional}" prodRegistro="${producto.registro}" prodLabo="${producto.laboratorio_id}" prodTipo="${producto.tipo_id}" prodPresentacion="${producto.presentacion_id}" prodImagen="${producto.imagen_prod}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                  <div class="card bg-light d-flex flex-fill">
                    <div class="card-header text-muted border-bottom-0">
                    <i class="fas fa-lg fa-cubes mr-1"></i>${producto.cantidad}
                    </div>
                    <div class="card-body pt-0">
                      <div class="row">
                        <div class="col-7">
                        <h2 class="lead"><b>Codigo ${producto.id}</b></h2>
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
                       
                        <button class="agregar-carrito btn btn-sm btn-primary">
                          <i class="fas fa-plus-square mr-2"></i>Agregar al carrito
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

      function mostrar_stockriesgo() {
        funcion ="buscar";
        $.post('../controlador/controladorStock.php',{funcion},(response)=>{
            const stocks=JSON.parse(response);
            let template='';
            stocks.forEach(stock => {
                if(stock.estado=='warning'){
                    template+=`
                    <tr class="table-warning">
                        <td>${stock.id}</td>
                        <td>${stock.nombre_producto}</td>
                        <td>${stock.cantidad}</td>
                        <td>${stock.laboratorio}</td>
                        <td>${stock.presentacion}</td>
                        <td>${stock.proveedor}</td>
                        <td>${stock.mes}</td>
                        <td>${stock.dia}</td>
    
                    
                    </tr>
                    `;

                }
                if(stock.estado=='danger'){
                    template+=`
                    <tr class="table-danger">
                        <td>${stock.id}</td>
                        <td>${stock.nombre_producto}</td>
                        <td>${stock.cantidad}</td>
                        <td>${stock.laboratorio}</td>
                        <td>${stock.presentacion}</td>
                        <td>${stock.proveedor}</td>
                        <td>${stock.mes}</td>
                        <td>${stock.dia}</td>
    
                    
                    </tr>
                    `;
                    
                }
               
                
            });
            $('#stocks').html(template);

        })
        
      }
    
})