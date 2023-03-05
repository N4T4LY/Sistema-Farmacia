$(document).ready(function(){
    var funcion='';
    var id_usuario=$('#id_usuario').val();
    var edit=false;
    //console.log(id_usuario);
    buscar_usuario(id_usuario);

    function buscar_usuario(dato) {
        funcion='buscar_usuario';
        $.post('../controlador/controladorUsuario.php',{dato,funcion},(response)=>{
           //console.log(response);
            let nombre='';
            let apellidos='';
            let edad='';
            let ci='';
            let nacim='';
            let tipo='';
            let telefono='';
            let direccion='';
            let correo='';
            let genero='';
            let info='';
            
            const usuario=JSON.parse(response); 
            nombre+=`${usuario.nombre}`;
            apellidos+=`${usuario.apellidos}`;
            edad+=`${usuario.edad}`;
            ci+=`${usuario.ci}`;
            nacim+=`${usuario.nacim}`;
            if(usuario.tipo=='root'){
                tipo+=`<h1 class="badge badge-danger">${usuario.tipo}</h1>`;
              }
              if(usuario.tipo=='administrador'){
                tipo+=`<h1 class="badge badge-warning">${usuario.tipo}</h1>`;
              }
              if(usuario.tipo=='auxiliar'){
                tipo+=`<h1 class="badge badge-info">${usuario.tipo}</h1>`;
              }

            //tipo+=`${usuario.tipo}`;
            telefono+=`${usuario.telefono}`;
            direccion+=`${usuario.direccion}`;
            correo+=`${usuario.correo}`;
            genero+=`${usuario.genero}`;
            info+=`${usuario.info}`;
            $('#nombre_us').html(nombre);
            $('#apellidos_us').html(apellidos);
            $('#edad').html(edad);
            $('#ci_us').html(ci);
            $('#fecha_nac').html(nacim);
            $('#nombre_tipo').html(tipo);
            $('#tel_us').html(telefono);
            $('#direc_us').html(direccion);
            $('#email_us').html(correo);
            $('#genero_us').html(genero);
            $('#info_us').html(info);
            //console.log(response);
            $('#foto2').attr('src',usuario.avatar);
            $('#foto1').attr('src',usuario.avatar);
            $('#foto3').attr('src',usuario.avatar);
            $('#foto4').attr('src',usuario.avatar);


      


        })
        
    }

    $(document).on('click','.editar',(e)=>{
        funcion='capturar_datos';
        edit=true;
        $.post('../controlador/controladorUsuario.php',{funcion,id_usuario},(response)=>{
            console.log(response);
            const usuario= JSON.parse(response);
            $('#telefono').val(usuario.telefono);
            $('#direccion').val(usuario.direccion);
            $('#correo').val(usuario.correo);
            $('#genero').val(usuario.genero);
            $('#info').val(usuario.info);
        })
        

    });
    $('#form-usuario').submit(e=>{
        if(edit==true){
            let telefono=$('#telefono').val();
            let direccion=$('#direccion').val();
            let correo=$('#correo').val();
            let genero=$('#genero').val();
            let info=$('#info').val();
            funcion='editar_usuario';
            $.post('../controlador/controladorUsuario.php',{id_usuario,funcion,telefono,direccion,correo,genero,info},(response)=>{
                if(response=='editado'){
                    $('#editado').hide('slow');
                    $('#editado').show(1000);
                    $('#editado').hide(2000);
                    $('#form-usuario').trigger('reset');

                }
                edit = false;
                buscar_usuario(id_usuario);    
            })


        }else{
            $('#noeditado').hide('slow');
            $('#noeditado').show(1000);
            $('#noeditado').hide(1000);
            $('#form-usuario').trigger('reset');

        }
        e.preventDefault();
    });

    $('#form-contra').submit(e=>{
        let contAntigua=$('#contAntigua').val();
        let contNueva=$('#contNueva').val();
        //console.log(contAntigua+contNueva);
        funcion='cambiar_contra';
        $.post('../controlador/controladorUsuario.php',{id_usuario,funcion,contAntigua,contNueva},(response)=>{
           // console.log(response);
           if (response=='actualizado') {
            $('#actualizado').hide('slow');
            $('#actualizado').show(1000);
            $('#actualizado').hide(2000);
            $('#form-contra').trigger('reset');
           }
           else{
            $('#nocambios').hide('slow');
            $('#nocambios').show(1000);
            $('#nocambios').hide(2000);
            $('#form-contra').trigger('reset');

           }
        })
        e.preventDefault();
    })
    $('#form-foto').submit(e=>{
        let datofoto=new FormData($('#form-foto')[0]);
        $.ajax({
            url:'../controlador/controladorUsuario.php',
            type:'POST',
            data:datofoto,
            cache:false,
            processData:false,
            contentType:false

        }).done(function(response){
            //console.log(response);
            const json=JSON.parse(response);
            if(json.alert=='edit'){
                $('#foto1').attr('src',json.ruta);
                $('#edit').hide('slow');
                $('#edit').show(1000);
                $('#edit').hide(2000);
                $('#form-foto').trigger('reset');
                buscar_usuario(id_usuario);


            }else{
                $('#nedit').hide('slow');
                $('#nedit').show(1000);
                $('#nedit').hide(2000);
                $('#form-foto').trigger('reset');


            }

          
            
        
        });
        e.preventDefault();

    })
    
})
