<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Listado de Personal</h1>
    <p class="mb-4">La presente tabla muestra los datos de personal dentro del <a target="_blank" href="http://sistemas.sattelital.com.pe/">Grupo Satelital</a> con opciones a registrar, editar y dar de baja<a target="_blank" href="https://datatables.net"></a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Grupo Satelital</h6>
            </div><hr>
            <div class="row">
              <div class="col col-sm-10"></div>
                <div class="col col-sm-2">
                <?php if($condicion==1){ ?>
                <a class="btn btn-primary" href="<?php echo base_url(); ?>requerimiento/registrar">Agregar Requerimiento</a>
                <?php } ?>
                </div>
                </div>
            <div class="card-body">
              
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Solicitante</th>                        
                        <th>Fecha</th>     
                        <th>Proyecto</th> 
                        <th>Monto</th> 
                        <th>Estado</th> 
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Solicitante</th>                        
                        <th>Fecha</th>     
                        <th>Proyecto</th> 
                        <th>Monto</th> 
                        <th>Estado</th> 
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
           "data":{condicion:'<?php echo $condicion; ?>'},
           "type":"post",
           "url":"<?php echo base_url('requerimiento/ajax'); ?> "
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
 function estado(id,accion){
  swal({
  		title: "¿Está segura(o) de hacer la modificación?",
  		text: "Al aceptar se cancelará un registro a la rendición!",
  		icon: "warning",
  		buttons: true,
  		dangerMode: true,
		})
		.then((willDelete) => {
  		if (willDelete) {
        window.location.href="<?php echo base_url('requerimiento/estado' ); ?>/"+id+"/"+accion;		
  		} else {
    	swal("El registró no se modificó!");
  		}
		});
 }
function opensuccess(){
	swal(
			'Correcto',
			'El registro se completo satisfactoriamente.',
			'success'
		);
 }
 function openerror(){
		var errormsg = $('#errormsg').val();
		swal(
			'Error',
			'El registro no pudo llevarse a cabo. \n '+errormsg+'',
			'error'
		);
		$('#errormsg').val("");
	}
 </script>