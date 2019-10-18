<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Listado de Movimiento de Caja</h1>
    <p class="mb-4">La siguiente tabla muestra los datos de los movimientos por proyecto a la fecha indicada <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables cliente</h6>
            </div><br>
            <div class="row">
              <div class="col col-sm-2">
                <input value="<?php echo date('Y-m-d',strtotime(date('Y/m/d'))); ?>" type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
              </div>
              <div class="col col-sm-8">
                
              </div>
              <div class="col col-sm-2">
                <a class="btn btn-primary" href="<?php echo base_url(); ?>caja/registrar">Agregar Registro</a>
              </div>
            </div>
            <div class="card-body">
              
                <div class="table-responsive">
                <table class="table table-bordered" style="display: block;overflow-x: auto;" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Fecha</th>                        
                      <th>Periodo</th>     
                      <th>Proyecto</th> 
                      <th>Monto</th> 
                      <th>Detalle</th> 
                      <th>Banco</th> 
                      <th>Clasificacion</th> 
                      <th>Responsable</th>                
                      <th>Beneficiario</th> 
                      <th>Autoriza</th> 
                      <th>Registra</th> 
                      <th>Acciones</th> 
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Fecha</th>                        
                      <th>Periodo</th>     
                      <th>Proyecto</th> 
                      <th>Monto</th> 
                      <th>Detalle</th> 
                      <th>Banco</th> 
                      <th>Clasificacion</th> 
                      <th>Responsable</th>                
                      <th>Beneficiario</th> 
                      <th>Autoriza</th> 
                      <th>Registra</th>
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
 var fecha_inicio=$('#fecha_inicio').val();
 $('#dataTable').DataTable({
         "ajax":{
           "data":{'fecha_inicio':fecha_inicio},
           "type":"post",
           "url":"<?php echo base_url('caja/ajax'); ?> "
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
     $("#fecha_inicio").on('change',function(){
      var fecha_inicio=$('#fecha_inicio').val();
      $('#dataTable').dataTable().fnClearTable();
    $('#dataTable').dataTable().fnDestroy();
    $('#dataTable').DataTable({
         "ajax":{
           "data":{'fecha_inicio':fecha_inicio},
           "type":"post",
           "url":"<?php echo base_url('caja/ajax'); ?> "
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
 });
 </script>