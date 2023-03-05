$(document).ready(function(){
    buscar_lab();
    var funcion;
    var editt=false;
    $('#form-crear-labo').submit(e=>{
        let nombre_labo=$('#nombre-labo').val();
        let id_editado=$('#id-editlabo').val();
        if(editt==false){
          funcion='crear';

        }else{
          funcion='editar';
        }
        //funcion='crear';
        $.post('../controlador/controladorLabo.php',{nombre_labo,id_editado,funcion},(response)=>{
          console.log(response); 
          if(response=='siagregar-labo'){
            $('#siagregar-labo').hide('slow');
            $('#siagregar-labo').show(1000);
            $('#siagregar-labo').hide(1000);
            $('#form-crear-labo').trigger('reset');
            buscar_lab();

           }
           if(response=='noagregar-labo'){
            $('#noagregar-labo').hide('slow');
            $('#noagregar-labo').show(1000);
            $('#noagregar-labo').hide(1000);
            $('#form-crear-labo').trigger('reset');


           }
           if(response=='edit'){
            $('#edit-labo').hide('slow');
            $('#edit-labo').show(1000);
            $('#edit-labo').hide(1000);
            $('#form-crear-labo').trigger('reset');
            buscar_lab();

           }
           editt=false;

            
        })
        e.preventDefault();

    });
    function buscar_lab(consulta){
        funcion='buscar';
        $.post('../controlador/controladorLabo.php',{consulta,funcion},(response)=>{
            //console.log(response);
            const laboratorios = JSON.parse(response);
            let template='';
            laboratorios.forEach(laboratorio => {
                template+=`
                    <tr labId="${laboratorio.id}" labnombre="${laboratorio.nombre_lab}" labimg="${laboratorio.imagen_labo}">
                        <td>${laboratorio.nombre_lab}</td>
                        <td><img src="${laboratorio.imagen_labo}" class = "img-fluid rounded" width="70" height="70"></td>
                        <td>
                        <button class="imagen btn btn-info" title="Cambiar logo de laboratorio" type="button" data-toggle="modal" data-target="#cambiologo"><i class="far fa-image"></i></button>
                        <button class="editar btn btn-success" title="Editar el laboratorio" type="button" data-toggle="modal" data-target="#crearlabo"><i class="fas fa-pencil-alt"></i></button>
                        <button class="borrar btn btn-danger" title="Borrar laboratorio"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    
                    </tr>
                `;
            });
            $('#laboratorios').html(template);

        })
    }

    $(document).on('keyup','#buscar-laboratorio',function(){
        let valor=$(this).val();
        if(valor!=''){
            buscar_lab(valor);


        }else{
            buscar_lab();

        }
    })
    $(document).on('click','.imagen',(e)=>{
        funcion="cambiar_logo";
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('labId');
        const nombre=$(elemento).attr('labnombre');
        const imagen=$(elemento).attr('labimg');
        //console.log(id+nombre+imagen);
        $('#logoactual').attr('src',imagen);
        $('#nombre_logo').html(nombre);
        $('#funcion').val(funcion);
        $('#id_logolab').val(id);

    })

    $('#form-logo').submit(e=>{
        let formData=new FormData($('#form-logo')[0]);
        $.ajax({
            url:'../controlador/controladorLabo.php',
            type:'POST',
            data:formData,
            cache:false,
            processData:false,
            contentType:false

        }).done(function(response){
          //console.log(response);
          const json =JSON.parse(response);
          if(json.alert=='edit'){
            $('#logoactual').attr('src',json.ruta)
            $('#form-logo').trigger('reset');
            $('#edit').hide('slow');
            $('#edit').show(1000);
            $('#edit').hide(2000);
           
            buscar_lab();

          } else{
            $('#nedit').hide('slow');
            $('#nedit').show(1000);
            $('#nedit').hide(2000);
            $('#form-logo').trigger('reset');
            

          } 
        
        });
        e.preventDefault();

    })

    $(document).on('click','.borrar',(e)=>{
        funcion="borrar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('labId');
        const nombre=$(elemento).attr('labnombre');
        const imagen=$(elemento).attr('labimg');
        
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger mr-1'
            },
            buttonsStyling: false
          })
          
          swalWithBootstrapButtons.fire({
            title: 'Desea eliminar el laboratorio '+nombre+' ?',
            text: "No se podra revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, deseo borrar',
            cancelButtonText: 'No, cancelar',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
              $.post('../controlador/controladorLabo.php',{id,funcion},(response)=>{
                editt==false;
               if(response=='borrado'){
                 swalWithBootstrapButtons.fire(
                'Eliminado con exito',
                'el laboratorio '+nombre+' fue eliminado correctamente',
                'success') 
                buscar_lab();
               }
               else{
                swalWithBootstrapButtons.fire(
                    'No fue eliminado',
                    'el laboratorio '+nombre+' no fue borrado porque esta siendo utilizado por algun producto',
                    'error') 
                  

               }
              })  
             
              
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {
              swalWithBootstrapButtons.fire(
                'Cancelado',
                'El laboratorio no fue eliminado :)',
                'error'
              )
              
            }
          })
      

    })

    $(document).on('click','.editar',(e)=>{
     
      const elemento = $(this)[0].activeElement.parentElement.parentElement;
      const id=$(elemento).attr('labId');
      const nombre=$(elemento).attr('labnombre');
      $('#id-editlabo').val(id);
      $('#nombre-labo').val(nombre);
      editt=true;
      

  })




});