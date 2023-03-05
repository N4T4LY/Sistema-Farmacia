$(document).ready(function(){
  buscar_pres();
  var funcion;
  var editt=false;
  $('#form-crear-pres').submit(e=>{
      let nombre_pres=$('#nombre-pres').val();
      let id_editado=$('#id-editpres').val();
      if(editt==false){
        funcion='crear';

      }else{
        funcion='editar';
      }
      //funcion='crear';
      $.post('../controlador/controladorPresen.php',{nombre_pres,id_editado,funcion},(response)=>{
         if(response=='siagregar-pres'){
          $('#siagregar-pres').hide('slow');
          $('#siagregar-pres').show(1000);
          $('#siagregar-pres').hide(1000);
          $('#form-crear-pres').trigger('reset');
          buscar_pres();

         }
         if(response=='noagregar-pres'){
          $('#noagregar-pres').hide('slow');
          $('#noagregar-pres').show(1000);
          $('#noagregar-pres').hide(1000);
          $('#form-crear-pres').trigger('reset');


         }
         if(response=='edit'){
          $('#edit-pres').hide('slow');
          $('#edit-pres').show(1000);
          $('#edit-pres').hide(1000);
          $('#form-crear-pres').trigger('reset');
          buscar_pres();

         }
         editt=false;

          
      })
      e.preventDefault();

  });
  function buscar_pres(consulta){
      funcion='buscar';
      $.post('../controlador/controladorPresen.php',{consulta,funcion},(response)=>{
          //console.log(response);
          const presentaciones = JSON.parse(response);
          let template='';
          presentaciones.forEach(presentacion => {
              template+=`
                  <tr presId="${presentacion.id}" presnombre="${presentacion.nombre_presen}">
                      <td>${presentacion.nombre_presen}</td>
                      
                      <td>                           
                          <button class="editar-pres btn btn-success" title="Editar la presentacion" type="button" data-toggle="modal" data-target="#crearpres"><i class="fas fa-pencil-alt"></i></button>
                          <button class="borrar-pres btn btn-danger" title="Borrar la presentacion"><i class="fas fa-trash-alt"></i></button>
                      </td>
                  
                  </tr>
              `;
          });
          $('#presentaciones').html(template);

      })
  }

  $(document).on('keyup','#buscar-presentacion',function(){
      let valor=$(this).val();
      if(valor!=''){
          buscar_pres(valor);


      }else{
          buscar_pres();

      }
  })
 

     $(document).on('click','.borrar-pres',(e)=>{
      funcion="borrar";
      const elemento = $(this)[0].activeElement.parentElement.parentElement;
      const id=$(elemento).attr('presId');
      const nombre=$(elemento).attr('presnombre');
     
      
      const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger mr-1'
          },
          buttonsStyling: false
        })
        
        swalWithBootstrapButtons.fire({
          title: 'Desea eliminar la presentacion '+nombre+' ?',
          text: "No se podra revertir esto!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Si, deseo borrar',
          cancelButtonText: 'No, cancelar',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            $.post('../controlador/controladorPresen.php',{id,funcion},(response)=>{
              editt==false;
             if(response=='borrado'){
               swalWithBootstrapButtons.fire(
              'Eliminado con exito',
              'La presentacion '+nombre+' fue eliminada correctamente',
              'success') 
              buscar_pres();
             }
             else{
              swalWithBootstrapButtons.fire(
                  'No fue eliminado',
                  'La presentacion '+nombre+' no fue borrada porque esta siendo utilizado por algun producto',
                  'error') 
                

             }
            })  
           
            
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'Cancelado',
              'La presentacion no fue eliminada :)',
              'error'
            )
            
          }
        })
    

  })

  $(document).on('click','.editar-pres',(e)=>{
   
    const elemento = $(this)[0].activeElement.parentElement.parentElement;
    const id=$(elemento).attr('presId');
    const nombre=$(elemento).attr('presnombre');
    $('#id-editpres').val(id);
    $('#nombre-pres').val(nombre);
    editt=true;
    

})




});