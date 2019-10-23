<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables area</h6>
            </div>
            <div class="row">
              <div class="col-sm-2">
							  <div class="form-group">
							    <label for="">&nbsp;</label>
                  <button id="btn-agregar" type="submit" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Guardar Estado</button></div>
						  </div>
              <div class="col-sm-2">
							  <div class="form-group">
								  <label for="">Tto.</label>
								  <select class="form-control select2" name="tratamiento">
										<option value="1">SALDO DIRECTO</option>
										<option value="3">REPOSICION</option>
										<option value="5">VUELTO</option>
										<option value="7">DEVOLUCION</option>
                    <option value="6">DESCUENTO</option>
										<option value="4">SALDO POR RENDIR</option>
								  </select>
							  </div>
						  </div>	
              <div class="col col-sm-10"></div>
               
              </div>
            <div class="card-body">
              <form>
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>VB</th> 
                      <th>Responsable</th>                        
                      <th>Egreso</th> 
                      <th>Rendido</th> 
                      <th>Saldo</th> 
                      <th>Detalle</th>                   
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>VB</th> 
                      <th>Responsable</th>                        
                      <th>Egreso</th> 
                      <th>Rendido</th> 
                      <th>Saldo</th> 
                      <th>Detalle</th>   
                    </tr>
                  </tfoot>
                  <tbody>
                               
                  </tbody>
                </table>
              </div>
              </form>
        </div>
    </div>
</div>
</div>
</div>
</div>
<script>
$(document).ready(function () {
  var id=<?php echo $id; ?>;
 $('#dataTable').DataTable({
         "ajax":{
           "data":{'id':id},
           "type":"post",
           "url":"<?php echo base_url('rendicion/ajax_web_detalle'); ?> "
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