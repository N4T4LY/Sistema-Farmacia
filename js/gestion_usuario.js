$(document).ready(function(){
    var tipo_usuario = $('#tipo_usuario').val();
    if(tipo_usuario==2){
      $('#boton-crear').hide();
    }
    //console.log(tipo_usuario);
    buscar_datos();
    var funcion;
    function buscar_datos(consulta) {
        funcion='gestbuscar_usuario';
        //peticion ayax
        $.post('../controlador/controladorUsuario.php',{consulta,funcion},(response)=>{
            //console.log(response)
            const usuarios = JSON.parse(response);
            let template='';
            usuarios.forEach(usuario=>{
              //interpolacion: agregar variables en el template
                template+=`
                <div usuarioid="${usuario.id}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">`;
                if(usuario.tipo_usuario==3){
                  template+=`<h1 class="badge badge-danger">${usuario.tipo}</h1>`;
                }
                if(usuario.tipo_usuario==2){
                  template+=`<h1 class="badge badge-warning">${usuario.tipo}</h1>`;
                }
                if(usuario.tipo_usuario==1){
                  template+=`<h1 class="badge badge-info">${usuario.tipo}</h1>`;
                }

                 // ${usuario.tipo}
                template+=`</div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>${usuario.nombre} ${usuario.apellidos}</b></h2>
                      <p class="text-muted text-sm"><b>Sobre mi: </b> ${usuario.info} </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-id-card"></i></span> CI: ${usuario.ci}</li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-birthday-cake"></i></span> Edad: ${usuario.edad}</li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-birthday-cake"></i></span> Fecha Nacimiento: ${usuario.nacim}</li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Direccion: ${usuario.direccion}</li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telefono #: ${usuario.telefono}</li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-fa-at"></i></span> Correo: ${usuario.correo}</li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-smile"></i></span> Genero: ${usuario.genero}</li>
              
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${usuario.avatar}" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">`;
                  if(tipo_usuario==3){
                    if(usuario.tipo_usuario!=3){
                      template+=
                      `<button class="borrar-usuario btn btn-danger mr-1 type="button" data-toggle="modal" data-target="#confirmar"">
                      <i class="fas fa-window-close mr-1"></i>Eliminar
                      </button>`;

                    }
                    if(usuario.tipo_usuario==2){
                      template+=
                      `<button class="ascender btn btn-primary ml-1" type="button" data-toggle="modal" data-target="#confirmar">
                      <i class="fas fa-sort-amount-up mr-1"></i>Ascender
                      </button>`;

                    }

                    if(usuario.tipo_usuario==1){
                      template+=
                      `<button class="descender btn btn-secondary ml-1"type="button" data-toggle="modal" data-target="#confirmar">
                      <i class="fas fa-sort-amount-down mr-1"></i>Descender
                      </button>`;

                    }

                  }else{
                    //solo ver los botones de eliminar de auxiliares y no de root ni administrador
                    if(tipo_usuario==1 && usuario.tipo_usuario!=1 && usuario.tipo_usuario!=3){
                      template+=
                      `<button class="borrar-usuario btn btn-danger type="button" data-toggle="modal" data-target="#confirmar"">
                      <i class="fas fa-window-close mr-1"></i>Eliminar
                      </button>`;

                    }

                  }
                  
                  template+=`
                    
                  </div>
                </div>
              </div>
            </div>
                `;
            })
            $('#usuarios').html(template);

        });
        
    }
    $(document).on('keyup','#buscar',function(){
        let valor = $(this).val();
        if (valor!=="") {
            buscar_datos(valor);
            //console.log(valor);
        }
        else{
            buscar_datos();
           // console.log(valor);
        }
    });
    //evento del formulario del modal para crear us
    $('#form-crear').submit(e=>{
      let nombre = $('#nombre').val();
      let apellido = $('#apellido').val();
      let fechanac = $('#fechanac').val();
      let ci = $('#ci').val();
      let contra = $('#contra').val();
      funcion='crear_usuario';
      $.post('../controlador/controladorUsuario.php',{nombre,apellido,fechanac,ci,contra,funcion},(response)=>{
        if(response=='siagregar'){
          $('#siagregar').hide('slow');
          $('#siagregar').show(1000);
          $('#siagregar').hide(2000);
          $('#form-crear').trigger('reset');
          buscar_datos();

        }
        else{
          $('#noagregar').hide('slow');
          $('#noagregar').show(1000);
          $('#noagregar').hide(2000);
          $('#form-crear').trigger('reset');


        }

      });
      //anular evento de refrescar pag
      e.preventDefault();
    });
    $(document).on('click','.ascender',(e)=>{
      //acceder al elemento padre encima del elemento para conseguir el id
      const elemento=$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
      //console.log(elemento);
      const id=$(elemento).attr('usuarioId');
      //console.log(id);
      funcion='ascender';
      $('#id_us').val(id);
      $('#funcion').val(funcion);
    });
    $(document).on('click','.descender',(e)=>{
      //acceder al elemento padre encima del elemento para conseguir el id
      const elemento=$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
      //console.log(elemento);
      const id=$(elemento).attr('usuarioId');
      //console.log(id);
      funcion='descender';
      $('#id_us').val(id);
      $('#funcion').val(funcion);
    });

    $(document).on('click','.borrar-usuario',(e)=>{
      //acceder al elemento padre encima del elemento para conseguir el id
      const elemento=$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
      //console.log(elemento);
      const id=$(elemento).attr('usuarioId');
      //console.log(id);
      funcion='borrar_usuario';
      $('#id_us').val(id);
      $('#funcion').val(funcion);
    });

    $('#form-confirmar').submit(e=>{
      let contra=$('#contAntigua').val();
      let id_usuario=$('#id_us').val();
      let funcion=$('#funcion').val();
      $.post('../controlador/controladorUsuario.php',{contra,id_usuario,funcion},(response)=>{
        if(response=='ascendido'|| response=='descendido'|| response=='borrado'){
          $('#confirmado').hide('slow');
          $('#confirmado').show(1000);
          $('#confirmado').hide(2000);
          $('#form-confirmar').trigger('reset');

        }else{
          $('#rechazado').hide('slow');
          $('#rechazado').show(1000);
          $('#rechazado').hide(2000);
          $('#form-confirmar').trigger('reset');

          

        }
        buscar_datos();

      });

      e.preventDefault();
    });
})