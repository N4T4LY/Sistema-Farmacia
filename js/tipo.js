$(document).ready(function(){
    buscar_tipo();
    var funcion;
    var editt=false;
    $('#form-crear-tipo').submit(e=>{
        let nombre_tipo=$('#nombre-tipo').val();
        let id_editado=$('#id-edittipo').val();
        if(editt==false){
          funcion='crear';

        }else{
          funcion='editar';
        }
        //funcion='crear';
        $.post('../controlador/controladorTipo.php',{nombre_tipo,id_editado,funcion},(response)=>{
           if(response=='siagregar-tipo'){
            $('#siagregar-tipo').hide('slow');
            $('#siagregar-tipo').show(1000);
            $('#siagregar-tipo').hide(1000);
            $('#form-crear-tipo').trigger('reset');
            buscar_tipo();

           }
           if(response=='noagregar-tipo'){
            $('#noagregar-tipo').hide('slow');
            $('#noagregar-tipo').show(1000);
            $('#noagregar-tipo').hide(1000);
            $('#form-crear-tipo').trigger('reset');


           }
           if(response=='edit'){
            $('#edit-tipo').hide('slow');
            $('#edit-tipo').show(1000);
            $('#edit-tipo').hide(1000);
            $('#form-crear-tipo').trigger('reset');
            buscar_tipo();

           }
           editt=false;

            
        })
        e.preventDefault();

    });
    function buscar_tipo(consulta){
        funcion='buscar';
        $.post('../controlador/controladorTipo.php',{consulta,funcion},(response)=>{
            //console.log(response);
            const tipos = JSON.parse(response);
            let template='';
            tipos.forEach(tipo => {
                template+=`
                    <tr tipoId="${tipo.id}" tiponombre="${tipo.nombre_tip_prod}">
                        <td>${tipo.nombre_tip_prod}</td>
                        
                        <td>                           
                            <button class="editar-tipo btn btn-success" title="Editar el tipo" type="button" data-toggle="modal" data-target="#creartipo"><i class="fas fa-pencil-alt"></i></button>
                            <button class="borrar-tipo btn btn-danger" title="Borrar tipo"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    
                    </tr>
                `;
            });
            $('#tipos').html(template);

        })
    }

    $(document).on('keyup','#buscar-tipo',function(){
        let valor=$(this).val();
        if(valor!=''){
            buscar_tipo(valor);


        }else{
            buscar_tipo();

        }
    })
   

       $(document).on('click','.borrar-tipo',(e)=>{
        funcion="borrar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('tipoId');
        const nombre=$(elemento).attr('tiponombre');
       
        
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger mr-1'
            },
            buttonsStyling: false
          })
          
          swalWithBootstrapButtons.fire({
            title: 'Desea eliminar el tipo '+nombre+' ?',
            text: "No se podra revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, deseo borrar',
            cancelButtonText: 'No, cancelar',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
              $.post('../controlador/controladorTipo.php',{id,funcion},(response)=>{
                editt==false;
               if(response=='borrado'){
                 swalWithBootstrapButtons.fire(
                'Eliminado con exito',
                'el tipo '+nombre+' fue eliminado correctamente',
                'success') 
                buscar_tipo();
               }
               else{
                swalWithBootstrapButtons.fire(
                    'No fue eliminado',
                    'el tipo '+nombre+' no fue borrado porque esta siendo utilizado por algun producto',
                    'error') 
                  

               }
              })  
             
              
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {
              swalWithBootstrapButtons.fire(
                'Cancelado',
                'El tipo no fue eliminado :)',
                'error'
              )
              
            }
          })
      

    })

    $(document).on('click','.editar-tipo',(e)=>{
     
      const elemento = $(this)[0].activeElement.parentElement.parentElement;
      const id=$(elemento).attr('tipoId');
      const nombre=$(elemento).attr('tiponombre');
      $('#id-edittipo').val(id);
      $('#nombre-tipo').val(nombre);
      editt=true;
      

  })




});