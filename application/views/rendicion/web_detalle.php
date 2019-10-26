<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Lsitado de rendiciones Web a Detalle</h1>
    <p class="mb-4">La presente tabla muestra los detalles de las rendiciones web por personal seleccionado con opcines a editar y verificar <a target="_blank" href="https://datatables.net"></a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Listado de rendiciones Web a detalle</h6>
            </div>
            <form id="add_web" name="add_web" accept-charset="utf-8" enctype="multipart/form-data" method="post">
            <div class="row">
              <div class="col-sm-2">
							  <div class="form-group">
							    <label for="">&nbsp;</label>
                  <button id="btn-agregar" type="submit" class="btn btn-primary">Guardar Estado</button></div>
						  </div>
              <div class="col-sm-2">
							  <div class="form-group">
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
        </div>
        </form>
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
     $("form[name='add_web']").submit(function(e) {
			var formData = new FormData($(this)[0]);
			$.ajax({
				
				url: "<?php echo base_url('rendicion/guardar_estado'); ?>",
				type: "POST",
				data: formData,
				async: true,
				beforeSend: function(){
					$('#guardarform').attr('disabled', 'disabled');
					$('#grabar').prop('disabled', true);
				},
				success: function (msg) {
				var str=msg.split("_");
				var id=str[1];
				var status=str[0];
				
					if(status=="si")
					{
						opensuccess();

						setTimeout(function () {
						window.location.href="<?php echo base_url('rendicion' ); ?>/";
						}, 1500); //will call the function after 2 secs.
					}
					else
					{
						$('#errormsg').val(msg);
						openerror();
						return false;
					}
				},
				error: function(data, xhr,textStatus,errorThrown) {
					if(textStatus=='timeout'){
						$('#errormsg').val("Error: Tiempo de conexión agotado.");
            window.location.href="<?php echo base_url('rendicion' ); ?>/";
					 } else {
					 	$('#errormsg').val(data);
						openerror();
					 }
					//alert(JSON.stringify(errorThrown));
				},			
				complete: function() {
					$('#grabar').prop('disabled', false);
				},
				timeout: 2000,
				cache: false,
				contentType: false,
				processData: false
			});
			e.preventDefault();
			opensuccess();
		
	});
 });
 function opensuccess(){
	swal(
			'Correcto',
			'El registro se completo satisfactoriamente.',
			'success'
		);
 }
 function openerror(error){
		var errormsg = error;
		swal(
			'Error',
			'El registro no pudo llevarse a cabo. \n '+errormsg+'',
			'error'
		);
		$('#errormsg').val("");
	}
 </script>