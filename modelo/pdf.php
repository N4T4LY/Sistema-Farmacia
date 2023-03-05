<?php
include_once 'venta.php';
include_once 'ventaProducto.php';
function getHtml($id_venta){
    $venta=new venta();
    $venta_producto =new ventaProducto();
    $venta->buscar_id($id_venta);
    $venta_producto->ver($id_venta);
    $plantilla='
    <body>
    <header class="heads">
    <div id="logo">
        <img src="../img/logo.png" widht="60" height="60">
    </div>
    <h1>COMPROBANTE DE PAGO</h1>
    <div id="info" class="heads">
        <div id="negocio">Farmacia La Glorieta</div>
        <div>Calle Otero de la Vega #435, <br/> La Paz, Bolivia </div> 
        <div>78848883 </div>
    </div>';
    foreach($venta->objetos as $objeto){

        $plantilla.='
       <div id="proyecto">
        
            <div><span>Código de Venta: </span>'.$objeto->id_venta.'</div>
            <div><span>Cliente: </span>'.$objeto->cliente.'</div>
            <div><span>CI: </span>'.$objeto->ci.'</div>
            <div><span>Fecha y Hora: </span>'.$objeto->fecha.'</div>
            <div><span>Vendedor: </span>'.$objeto->vendedor.'</div>
           
        </div>        
        ';
    }

    $plantilla.='
    </header >
        <main>
            <table>
            <thead>
            <tr>
                <th class="ser">Producto</th>
                <th class="ser">Concentracion</th>
                <th class="ser">Adicional</th>
                <th class="ser">Laboratorio</th>
                <th class="ser">Presentacion</th>
                <th class="ser">Tipo</th>
                <th class="ser">Cantidad</th>
                <th class="ser">Precio</th>
                <th class="ser">Subtotal</th>
            </tr>
            </thead>
            <tbody>    
                
     ';
     foreach($venta_producto->objetos as $objeto){
        $plantilla.='
        
                <tr>
                    <td class="serv">'.$objeto->producto.'</td>
                    <td class="serv">'.$objeto->concentracion.'</td>
                    <td class="serv">'.$objeto->adicional.'</td>
                    <td class="serv">'.$objeto->laboratorio.'</td>
                    <td class="serv">'.$objeto->presentacion.'n</td>
                    <td class="serv">'.$objeto->tipo.'</td>
                    <td class="serv">'.$objeto->cantidad.'</td>
                    <td class="serv">'.$objeto->precio.'</td>
                    <td class="serv">'.$objeto->subtotal.'</td>
                </tr> ';
    }
    $calculos = new venta();
    $calculos->buscar_id($id_venta);
    foreach ($calculos -> objetos as $objeto) {
        $iva=$objeto->total*0.13;
        $sub=$objeto->total-$iva;
        $plantilla.='
        
                <tr>
                    <td colspan="8" class="grtotal">SUBTOTAL</td>
                    <td class="grtotal">'.$sub.'</td>
                   
                </tr>
                <tr>
                    <td colspan="8" class="grtotal">IVA(13%)</td>
                    <td class="grtotal">'.$sub.'</td>
                   
                </tr>
                <tr>
                    <td colspan="8" class="grtotal">TOTAL</td>
                    <td class="grtotal">'.$objeto->total.'</td>
                   
                </tr>
         ';

    }
    $plantilla.='

         </tbody>
         </table>
         </br>
         </br>
         <div id="nota">
         
            <div><span>NOTICE:<span></div>
            <div class="not">Presentar este comprobante de pago para cualquier reclamo o devolución</div>
            <div class="not">El reclamo procederá dentro de las 24 horas de haber hecho la compra</div>
            <div class="not">Si el producto se encuentra dañado o abierto, la devolución no procederá</div>
            <div class="not">Revise su combio antes de salir del establecimiento</div>
        </div>
       
        </main>
        </body>
               
         ';


    return $plantilla;
}

?>