<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Listado de Egresos a Rendir por Persona</h1>
    <p class="mb-4">La presente tabla muestra el egreso total a rendir por persona dentro del <a target="_blank" href="http://sistemas.sattelital.com.pe/">Grupo Satelital</a> pudiendo escoger ver a detalle <a target="_blank" href="https://datatables.net"></a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Personas con Pendientes</h6>
            </div>
            <div class="row">
              <div class="col col-sm-10"></div>
                
                </div>
            <div class="card-body">
              
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      
                      <th>Responsable</th>                        
                      <th>Total</th> 
                      <th>Detalle</th>                   
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      
                      <th>Responsable</th>                        
                      <th>Total</th> 
                      <th>Detalle</th>    
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
 var fecha_inicio=$('#fecha_inicio').val();
 $('#dataTable').DataTable({
         "ajax":{
           "type":"post",
           "url":"<?php echo base_url('rendicion/ajax'); ?> "
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