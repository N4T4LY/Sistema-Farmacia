$(document).ready(function () {
    calcularTotal();
    contar_productos();
    //console.log(contador);
    recuperarls_carrito();
    recuperarls_carrito_compra();
    
    $(document).on('click','.agregar-carrito',(e)=>{
        
            const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
            const id = $(elemento).attr('prodId');
            const nombre_producto = $(elemento).attr('prodNombre');
            const concentracion = $(elemento).attr('prodConcentracion');
            const adicional = $(elemento).attr('prodAdicional');
            const precio = $(elemento).attr('prodPrecio');
            const registro = $(elemento).attr('prodRegistro');
            const laboratorio = $(elemento).attr('prodLabo');
            const tipo = $(elemento).attr('prodTipo');
            const presentacion = $(elemento).attr('prodPresentacion');
            const imagen_prod = $(elemento).attr('prodImagen');
            const cantidad = $(elemento).attr('prodCantidad');
            //console.log(id+' '+nombre+' '+precio);
            
            const producto={
                id: id,
                nombre_producto:nombre_producto,
                concentracion: concentracion,
                adicional: adicional,
                precio: precio,
                laboratorio: laboratorio,
                tipo: tipo,
                registro:registro,
                presentacion:presentacion,
                imagen_prod:imagen_prod,
                cantidad:cantidad,
                numero:1
                
            }
            //verificacion del objeto en el storage
            let id_producto;
            let productos;
            productos=recuperarLS();
            productos.forEach(prod => {
                if (prod.id===producto.id) {
                    id_producto=prod.id;
                }
                
            });
            if (id_producto===producto.id) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El producto ya fue ingresado!',
                    
                  })
                
            }
            else{
                template=`
                <tr prodId="${producto.id}">
                    <td>${producto.id}</td>
                    <td>${producto.nombre_producto}</td>
                    <td>${producto.concentracion}</td>
                    <td>${producto.adicional}</td>
                    <td>${producto.registro}</td>
                    <td>${producto.precio}</td>
                    <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                </tr>
                `;
                $('#lista').append(template);
                agregarLS(producto);
                let contador;
                /* contador=  */contar_productos();
                //console.log(contador);

            }
  
    })
    $(document).on('click','.borrar-producto',(e)=>{
        
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('prodId');
        elemento.remove();
      
        eliminar_productols(id);
       /*  contador=  */contar_productos();
       // console.log(contador);
       calcularTotal();

      
        //console.log(elemento);
 
})

$(document).on('click','#vaciar-carrito',(e)=>{
      $('#lista').empty();
      eliminarls();
      contador= contar_productos();
      console.log(contador);

})

$(document).on('click','#procesar-pedido',(e)=>{
    procesar_pedido();
})
$(document).on('click','#procesar-compra',(e)=>{
    procesar_compra();
})

function recuperarLS() {
    //hacer comparacion estricta que afecta al producto comparado ent=0 '0' ===compara los tipos tambien
    let productos;
    if(localStorage.getItem('productos')===null){
        productos=[];


    }else{
        //se obtiene los productos almacenados en el localstorage pero en objetos
        productos=JSON.parse(localStorage.getItem('productos'))
    }
    return productos
    
}
function agregarLS(producto) {
    let productos;
    productos=recuperarLS();
    productos.push(producto);
    //stringfy recibo objeto y devuelve string json
    localStorage.setItem('productos',JSON.stringify(productos))

    
}
function recuperarls_carrito() {
    let productos,id_producto;
    productos = recuperarLS();
    funcion="buscar_id";
    productos.forEach(producto => {
        id_producto=producto.id;
        $.post('../controlador/controladorProducto.php',{funcion,id_producto},(response)=>{
            //console.log(response);
            let template_carrito='';
            let json =JSON.parse(response);
            template_carrito=`
                <tr prodId="${json.id}">
                    <td>${json.id}</td>
                    <td>${json.nombre_producto}</td>
                    <td>${json.concentracion}</td>
                    <td>${json.adicional}</td>
                    <td>${json.registro}</td>
                    <td>${json.precio}</td>
                    <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                </tr>
            `;
            $('#lista').append(template_carrito);

        })
      
        
    });
    
}
function eliminar_productols(id){
    let productos;
    productos = recuperarLS();
    productos.forEach(function(producto,indice){
        if (producto.id===id) {
            //splice eliminar elementos medienate submindice, indice y cantidad
            productos.splice(indice,1);
        }
        
    });
    //luego se guarda nuevamente al storage
    localStorage.setItem('productos',JSON.stringify(productos))

}
function eliminarls(){
    localStorage.clear();
}

function contar_productos() {
    let productos;
    let contador=0;
    productos=recuperarLS();
    productos.forEach(producto => {
        contador++;
        
    });
    $('#contador').html(contador);
    
}
function procesar_pedido() {
    //si el carro esta vacio no podra ir a la sgte pagina
    let productos;
    productos=recuperarLS();
    if (productos.length===0) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'El carrito esta vacio!',
            
          })
        
        
    }
    else{
        location.href='../vista/adm_compra.php';
    }
}


async function recuperarls_carrito_compra() {
    let productos;
    productos = recuperarLS();
    //console.log(productos);
    funcion="traer_productos";
    const response = await fetch('../controlador/controladorProducto.php', {
        method:'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:'funcion='+funcion+'&&productos='+JSON.stringify(productos)
    })
    let resultado = await response.text();
    $('#lista-compra').append(resultado);
 
}

$(document).on('click','#actualizar',(e)=>{
    let productos,precios;
    precios=document.querySelectorAll('.precio');
    productos=recuperarLS();
    productos.forEach(function(producto,indice){
        producto.precio=precios[indice].textContent;

    });
    localStorage.setItem('productos',JSON.stringify(productos));
    calcularTotal();
})
$('#cp').keyup((e)=>{
    let id,numero,producto,productos,montos,precio;
    producto=$(this)[0].activeElement.parentElement.parentElement;
    id=$(producto).attr('prodId');
    precio=$(producto).attr('prodPrecio');
    numero= producto.querySelector('input').value;
    montos= document.querySelectorAll('.subtotales');
    productos=recuperarLS();
    productos.forEach(function(prod,indice) {
        if(prod.id===id){
            prod.numero=numero;
            prod.precio=precio;
            montos[indice].innerHTML=`<h5>${numero*precio}</h5>`;
        }
      
    });
    localStorage.setItem('productos',JSON.stringify(productos));
    calcularTotal();

})
function calcularTotal() {
    let productos,subtotal,con_iva,total_sin_descuento,pago,vuelto,descuento;
    let total=0,iva=0.13;
    productos=recuperarLS();
    productos.forEach(producto => {
        let subtotal_producto=Number(producto.precio*producto.numero);
        total=total+subtotal_producto;
    });
    pago=$('#pago').val();
    descuento=$('#descuento').val();
    
    total_sin_descuento=total.toFixed(2)
    con_iva=parseFloat(total*iva).toFixed(2);
    subtotal=parseFloat(total-con_iva).toFixed(2);

    total=total-descuento;
    vuelto=pago-total;
    $('#subtotal').html(subtotal);
    $('#con_iva').html(con_iva);
    $('#total_sin_descuento').html(total_sin_descuento);
    $('#total').html(total.toFixed(2));
    $('#vuelto').html(vuelto.toFixed(2));

    //console.log(total);
    
}
 function procesar_compra() {
    let nombre,ci;
    nombre=$('#cliente').val();
    ci=$('#ci').val();
    if(recuperarLS().length == 0){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'No hay productos suficientes!',
           
          }).then(function(){
            location.href='../vista/adm_listaproductos.php'
          })

    }
    else if(nombre==''){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Necesitamos un nombre de cliente!',
           
          })

    }
    else{
        verificar_stock().then(error=>{
            //console.log(error);
            if (error==0) {
                registrar_compra(nombre,ci);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Se realizó la compra exitosamente',
                    showConfirmButton: false,
                    timer: 1500
                  }).then(function(){
                    eliminarls();
                    location.href='../vista/adm_listaproductos.php'
                  })
        
                
            }
            else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'no existe stock en algun producto',
                   
                  })

            }
        });
    }
  
}
 
async function verificar_stock() {
    let productos;
    
    funcion='verificarstock';
    productos=recuperarLS();
    const response = await fetch('../controlador/controladorProducto.php', {
        method:'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:'funcion='+funcion+'&&productos='+JSON.stringify(productos)
    })
    let error = await response.text();
 
   return error;
 
}
function registrar_compra(nombre,ci) {
    funcion='registrarcompra';
    let total=$('#total').get(0).textContent;
    let productos=recuperarLS();
    let json=JSON.stringify(productos); 
    $.post('../controlador/controladorCompra.php',{funcion,total,nombre,ci,json},(response=>{
        console.log(response);
    }))  
}
    
})