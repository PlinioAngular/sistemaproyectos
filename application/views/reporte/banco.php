<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Listado de Movimiento de Caja</h1>
    <p class="mb-4">La siguiente tabla muestra los datos de los movimientos por proyecto dentro de <a target="_blank" href="http://sistemas.sattelital.com.pe/">Grupo Satelital</a> a la fecha indicada con opción a editar y esocger dentro de un rango.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Listado de Egresos</h6>
            </div><hr>
            
            <div class="card-body">
              
                <div class="table-responsive">
                <table class="table table-bordered" style="display: block;overflow-x: auto;" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Banco</th>                        
                      <th>Empresa</th>  
                      <th>Monto Soles</th> 
                      <th>Monto Dólares</th> 
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Banco</th>                        
                      <th>Empresa</th>  
                      <th>Monto Soles</th> 
                      <th>Monto Dólares</th>  
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
           "url":"<?php echo base_url('reporterendicion/ajax_banco'); ?> "
           },
           "dom": '<"top"i>rt<"bottom"flp><"clear">',
         "language": {
             "lengthMenu": "Mostrar _MENU_ registros por pagina",
             "sProcessing":     "Procesando...",
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
         },
         dom: 'Bfrtip',
         buttons: [  {
            extend: 'excelHtml5',
            title: 'Detalle Caja',
            autoFilter: true,
            sheetName: 'Saldo'
        }
         ],
         
     });
     
 });
 
 </script>