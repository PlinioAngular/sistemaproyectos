<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Lsitado de rendiciones Web a Detalle</h1>
    <p class="mb-4">La presente tabla muestra los detalles de las rendiciones web por personal seleccionado con opcines a editar y verificar <a target="_blank" href="https://datatables.net"></a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Listado de rendiciones Web a detalle</h6>
            </div><hr>
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
			 
			 <div class="col-sm-2">
				<div class="form-group">
					<input type="text" readonly="" class="form-control" name="saldo" id="saldo" value="" placeholder="Saldo">
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
					  <th>Moneda</th> 
                      <th>Revisar</th>                   
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>VB</th> 
                      <th>Responsable</th>                        
                      <th>Egreso</th> 
                      <th>Rendido</th> 
                      <th>Saldo</th> 
					  <th>Moneda</th> 
                      <th>Revisar</th>   
                    </tr>
                  </tfoot>
                  <tbody>
				  <?php foreach($data as $dato) { ?>
				  <tr>
				  	<?php if($dato->vb=="SI") { ?>
					<td> <input type="hidden" name="proyecto[]" value="<?php echo $dato->id_proyecto; ?>"><?php echo $dato->vb; ?><input type="hidden" name="vb[]" value="<?php echo $dato->vb; ?>"><input type="hidden" name="id_detalle_caja[]" value="<?php echo $dato->id_detalle_caja; ?>"><input type="hidden"  name="id_rendicion[]" value="<?php echo $dato->id_rendicion; ?>"></td>
					<input type="hidden" name="id_responsable" value="<?php echo $dato->id_persona; ?>"><input type="hidden" name="moneda" value="<?php echo $dato->moneda; ?>"><input type="hidden" name="id_autoriza" value="<?php echo $dato->id_autoriza; ?>">
					<?php } else { ?>
					<td><?php echo $dato->vb; } ?></td>						
					<td><?php echo $dato->apellido_paterno.' '.$dato->apellido_materno.' '.$dato->nombres; ?></td>
					<td><?php echo $dato->egreso; ?></td>			
					<td><?php echo '<p>'.$dato->rendido.'</p>'; ?></td>			
					<td><?php if($dato->vb=="SI"){ echo '<p>'.$dato->saldo.'</p>'; }else{echo $dato->saldo; } ?></td>
					<td><?php echo $dato->moneda; ?></td>		
					<td><a href="<?php echo  base_url('rendicion/editar/').md5($dato->id_detalle_caja); ?>" class="btn btn-info btn-circle btn-sm">
						<i class="fas fa-edit"></i></td>
				</tr>
					<?php } ?>                               
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
 $('#dataTable').DataTable({
        
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
	 sumar();
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
 function sumar(){
	var total=0.00;
	$("#dataTable tbody tr").each(function(){
		total+= Number($(this).find("td:eq(4)").children("p").text());
	});
	$("input[name=saldo]").val(total);
}
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