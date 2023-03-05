$(document).ready(function(){
    var editt=false;
    var funcion;
    buscar_prov();
    $('#form-crear').submit(e=>{
        let id=$('#id_edit_prov').val();
        let nombre_prov=$('#nombre_prov').val();
        let telefono=$('#telefono').val();
        let correo=$('#correo').val();
        let direccion=$('#direccion').val();
        if(editt==true){
            funcion="editar";
        }
        else{
            funcion="crear";
        }
        
        $.post('../controlador/controladorProveedor.php',{id,nombre_prov,telefono,correo,direccion,funcion},(response)=>{
            console.log(response);
            if (response=='siagregar') {
                $('#siagregar-prov').hide('slow');
                $('#siagregar-prov').show(1000);
                $('#siagregar-prov').hide(1000);
                $('#form-crear').trigger('reset');
                buscar_prov();
            }
            if (response=='noagregar' || response=='nedit') {
                $('#noagregar-prov').hide('slow');
                $('#noagregar-prov').show(1000);
                $('#noagregar-prov').hide(1000);
                $('#form-crear').trigger('reset');
                
                
            }
            if (response=='edit') {
                $('#edit-prov').hide('slow');
                $('#edit-prov').show(1000);
                $('#edit-prov').hide(1000);
                $('#form-crear').trigger('reset');
                buscar_prov();
                
            }
            editt=false;
        });
        e.preventDefault();

    });
    function buscar_prov(consulta) {
        funcion='buscar';
        $.post('../controlador/controladorProveedor.php',{consulta,funcion},(response)=>{
            //console.log(response);
            const proveedores=JSON.parse(response);
            let template='';
            proveedores.forEach(proveedor => {
                template+=`
                <div provId="${proveedor.id}" provNombre="${proveedor.nombre_prov}" provTelefono="${proveedor.telefono}" provCorreo="${proveedor.correo}" provDireccion="${proveedor.direccion}" provImg="${proveedor.imagen_prov}"class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                 <h1 class="badge badge-success">Proveedor</h1>
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>${proveedor.nombre_prov}</b></h2>
                     
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Direccion: ${proveedor.direccion}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telefono: ${proveedor.telefono}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> Correo Electronico: ${proveedor.correo}</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${proveedor.imagen_prov}" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <button class="imagen_prov btn btn-sm btn-info" title="Editar Logo" type="button" data-toggle="modal" data-target="#cambiologo">
                      <i class="fas fa-image"></i>
                    </button>
                    <button class="editar btn btn-sm btn-success" title="Editar Proveedor" type="button" data-toggle="modal" data-target="#crearproveedor">
                      <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="borrar btn btn-sm btn-danger" title="Borrar Proveedor">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                   
                  </div>
                </div>
              </div>
            </div>

                `;
            });
            $('#proveedores').html(template);

        });
        
    }
    $(document).on('keyup','#buscar_proveedor',function(){
        let valor=$(this).val();
        if(valor!=''){
            buscar_prov(valor);

        }else{
            buscar_prov();

        }
        
    });
    $(document).on('click','.imagen_prov',(e)=>{
        funcion="cambiar_logo";
        const elemento =$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id=$(elemento).attr('provId');
        //console.log(id);
        const nombre_prov=$(elemento).attr('provNombre');
        const imagen_prov=$(elemento).attr('provImg');
        $('#logoactual').attr('src',imagen_prov);
        $('#nombre_logo').html(nombre_prov);
        $('#id_logoprov').val(id);
        $('#funcion').val(funcion);
        $('#imagen_prov').val(imagen_prov);
        
     });

     $(document).on('click','.editar',(e)=>{
        const elemento =$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id=$(elemento).attr('provId');
        //console.log(id);
        const nombre_prov=$(elemento).attr('provNombre');
        const telefono=$(elemento).attr('provTelefono');
        const correo=$(elemento).attr('provCorreo');
        const direccion=$(elemento).attr('provDireccion');
        $('#id_edit_prov').val(id);
        $('#nombre_prov').val(nombre_prov);
        $('#telefono').val(telefono);
        $('#correo').val(correo);
        $('#direccion').val(direccion);
        editt=true;
     });

     $('#form-logo').submit(e=>{
        let formData = new FormData($('#form-logo')[0]);
         $.ajax({
            url:'../controlador/controladorProveedor.php',
            type:'POST',
            data:formData,
            cache:false,
            processData:false,
            contentType:false

        }).done(function(response){
            console.log(response);
            const json=JSON.parse(response);
            if(json.alert=='edit'){
                $('#logoactual').attr('src',json.ruta);
                $('#edit_prov').hide('slow');
                $('#edit_prov').show(1000);
                $('#edit_prov').hide(2000);
                $('#form-logo').trigger('reset');   
                buscar_prov();  
            }
            else{
                $('#nedit_prov').hide('slow');
                $('#nedit_prov').show(1000);
                $('#nedit_prov').hide(2000);
                $('#form-logo').trigger('reset');     
            } 
        });
        e.preventDefault(); 
    }); 

    $(document).on('click','.borrar',(e)=>{
        funcion="borrar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id=$(elemento).attr('provId');
        const nombre_prov=$(elemento).attr('provNombre');
        const imagen_prov=$(elemento).attr('provImg');
        
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger mr-1'
            },
            buttonsStyling: false
          })
          
          swalWithBootstrapButtons.fire({
            title: 'Desea eliminar el proveedor '+nombre_prov+' ?',
            text: "No se podra revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, deseo borrar',
            cancelButtonText: 'No, cancelar',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
              $.post('../controlador/controladorProveedor.php',{id,funcion},(response)=>{
                //editt==false;
               if(response=='borrado'){
                 swalWithBootstrapButtons.fire(
                'Eliminado con exito',
                'El proveedor '+nombre_prov+' fue eliminado correctamente',
                'success') 
                buscar_prov();
               }
               else{
                swalWithBootstrapButtons.fire(
                    'No fue eliminado',
                    'El proveedor '+nombre_prov+' no fue borrado porque esta siendo utilizado por algun stock',
                    'error') 
                  

               }
              })  
             
              
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {
              swalWithBootstrapButtons.fire(
                'Cancelado',
                'El proveedor no fue eliminado :)',
                'error'
              )
              
            }
          })
      

    })
    


});