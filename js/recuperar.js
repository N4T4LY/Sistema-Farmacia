$(document).ready(function () {
    $('#aviso').hide();
    $('#aviso1').hide();
    $('#form-recuperar').submit(e=>{
        $('#aviso').hide();
        $('#aviso1').hide();
        mostrar_loader('recuperar_pass');
        let email = $('#email-recuperar').val();
        let ci = $('#ci-recuperar').val();
        
        if(email==''||ci==''){
            $('#aviso').show();
            $('#aviso').text('Rellene todos los campos');
            cerrar_loader("");
          }else{
            $('#aviso').hide();
            let funcion='verificar';
            $.post('../controlador/controladorRecuperar.php',{funcion,email,ci},(response)=>{
                
                //console.log(response);
                if(response=='encontrado'){

                    let funcion='recuperar';
                    $('#aviso').hide();
                    $.post('../controlador/controladorRecuperar.php',{funcion,email,ci},(response2)=>{
                        //console.log(response2);
                        $('#aviso').hide();
                        $('#aviso1').hide();
                        //console.log(response2);
                           if (response2=='enviado') {
                            cerrar_loader('exito_envio');
                            $('#aviso1').show();
                            $('#aviso1').text('se restableció la contraseña');
                            $('#form-recuperar').trigger('reset');                
                        }
                        else{
                            cerrar_loader('error_envio');
                            $('#aviso').show();
                            $('#aviso').text('no se pudo restablecer');
                            $('#form-recuperar').trigger('reset');

                        }  
                  })
                }else{ 
                    cerrar_loader('error_usuario');
                    $('#aviso').hide();
                    $('#aviso1').hide();
                    $('#aviso').show();
                    $('#aviso').text('El correo y el ci no se encuentran asocioados o no estan registrados en el sistema');
                }
            })
        }
        e.preventDefault();
    })
    
    function mostrar_loader(mensaje) {
        var texto=null;
        var mostrar=false;
        switch (mensaje) {
            case 'recuperar_pass':
                texto='Se esta enviando el correo, por favor espere...';
                mostrar=true;
                break;
        
        }
        if(mostrar){
            Swal.fire({
              
                title: 'Enviando correo',
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
            case 'exito_envio':
                tipo='success';
                texto='el correo fue enviado correctamente';
                mostrar=true;
                break;
            case 'error_envio':
                tipo='error';
                texto='El correo no pudo enviarse, por favor intente de nuevo';
                mostrar=true;
                break;
            case 'error_usuario':
                tipo='error';
                texto='El usuario ingresado no fue encontrado';
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