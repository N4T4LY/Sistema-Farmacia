$(document).ready(function(){
    buscar_cliente();
    var funcion;

    function buscar_cliente(consulta) {
        funcion='buscar';
        $.post('../controlador/controladorCliente.php',{consulta,funcion},(response)=>{
            console.log(response);
            
            const clientes=JSON.parse(response);
            let template='';
            clientes.forEach(cliente => {
                template+=`
                <div cliId="${cliente.id_cliente}" cliNombre="${cliente.nombre_cli}" cliAp="${cliente.apellidos}" cliCi="${cliente.ci}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                 <h1 class="badge badge-success">cliente</h1>
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>${cliente.nombre_cli}</b></h2>
                     
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-idcard"></i></span> CI: ${cliente.ci}</li>
                       
                      
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${cliente.imagen}" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                   
                    
                    <button class="borrar btn btn-sm btn-danger" title="Borrar cliente">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                   
                  </div>
                </div>
              </div>
            </div>

                `;
            });
            $('#clientes').html(template);
 
        });
        
    }
    $(document).on('keyup','#buscar_cliente',function(){
        let valor=$(this).val();
        if(valor!=''){
            buscar_cliente(valor);

        }else{
            buscar_cliente();

        }
        
    });

    $('#form-crear').submit(e=>{
        let nombre_cli=$('#nombre_cli').val();
        let apellidos=$('#apellidos').val();
        let ci=$('#ci').val();
        //console.log(nombre_cli+apellidos+ci);
        funcion="crear";
        $.post('../controlador/controladorCliente.php',{nombre_cli,apellidos,ci,funcion},(response)=>{
           console.log(response);
            if (response=='siagregar') {
                $('#add-cli').hide('slow');
                $('#add-cli').show(1000);
                $('#add-cli').hide(1000);
                $('#form-crear').trigger('reset');
                buscar_cliente();
            }
            if (response=='noagregar') {
                $('#noadd-cli').hide('slow');
                $('#noadd-cli').show(1000);
                $('#noadd-cli').hide(1000);
                $('#form-crear').trigger('reset');
                
                
            }
        })
      
        e.preventDefault();

    });
    $(document).on('click','.editar',(e)=>{
        let elemento =$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        //console.log(elemento);
        let nombre_cli=$(elemento).attr('cliNombre');
        let apellidos=$(elemento).attr('cliAp');
        let ci=$(elemento).attr('cliCi');
        let id=$(elemento).attr('cliId');
        $('#nombre_clie').val(nombre_cli);
       
        $('#cie').val(ci);
        $('#id_edit_cli').val(id);



    });

    $('#form-editar').submit(e=>{
        let id=$('#id_edit_cli').val();
        let nombre_cli=$('#nombre_clie').val();
        let ci=$('#cie').val();
        //console.log(nombre_cli+apellidos+ci);
        funcion="editar";
        $.post('../controlador/controladorCliente.php',{id,nombre_cli,apellidos,ci,funcion},(response)=>{
           console.log(response);
            if (response=='edit') {
                $('#editar-cli').hide('slow');
                $('#editar-cli').show(1000);
                $('#editar-cli').hide(1000);
                $('#form-editar').trigger('reset');
                buscar_cliente();
            }
            if (response=='noedit') {
                $('#neditar-cli').hide('slow');
                $('#neditar-cli').show(1000);
                $('#neditar-cli').hide(1000);
                $('#form-editar').trigger('reset');
                
                
            }
        })
      
        e.preventDefault();

    });
    
});

