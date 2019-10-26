<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Listado de Tipo de Actividad</h1>
    <p class="mb-4">La presente tabla muestra los datos de los distintos tipos de actividad dentro del <a target="_blank" href="http://sistemas.sattelital.com.pe/">Grupo Satelital</a> con opciones a registrar, editar y dar de baja. <a target="_blank" href="https://datatables.net"></a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Grupo Satelital</h6>
            </div><hr>
            <div class="row">
              <div class="col col-sm-10"></div>
                <div class="col col-sm-2">
                <a class="btn btn-primary" href="<?php echo base_url(); ?>tipo_actividad/registrar">Agregar TipoActividad</a>
                </div>
                </div>
            <div class="card-body">
              
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Área</th>                        
                      <th>Acciones</th>                    
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Área</th>                     
                      <th>Acciones</th>   
                    </tr>
                  </tfoot>
                  <tbody>
                            
                  </tbody>
                </table>
              </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<script>
$(document).ready(function () {
 $('#dataTable').DataTable({
         "ajax":{
           "type":"post",
           "url":"<?php echo base_url('tipo_actividad/ajax'); ?> "
           },
         "language": {
             "lengthMenu": "Mostrar _MENU_ registros por pagina",
             "zeroRecords": "No se encontraron resultados en su busqueda",
             "searchPlaceholder": "Buscar registros",
             "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
             "infoEmpty": "No existen registros",
             "infoFiltered": "(filtrado de un total de _MAX_ registros)",
             "search": "Buscar:",
             "paginate": {
                 "first": "Primero",
                 "last": "Último",
                 "next": "Siguiente",
                 "previous": "Anterior"
             },
         }
     });
     
 });
 </script>