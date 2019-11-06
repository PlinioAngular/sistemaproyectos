<div class="container-fluid">
    <!-- Page Heading -->
    <div class="content-box">
	<div class="row">
		<div class="col-lg-12">
			<div class="element-wrapper">
				
				<div class="element-box">
				<form  id="edit_rendicion" name="edit_rendicion" accept-charset="utf-8" enctype="multipart/form-data" method="post">
                <input type="hidden" id="id_rendicion" name="id_rendicion" value="<?php echo $datos->id_rendicion; ?>">
					<h5 class="form-header"> Editar Registro </h5>
					<div class="form-desc"> Modifique los datos de la rendición </div>
					<hr>
					<div class="row">						
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Responsable</label>
								<input type="text" readonly="" class="form-control" value="<?php echo $datos->apellido_paterno.' '.$datos->apellido_materno.' '.$datos->nombres; ?>">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Detalle</label>
								<input type="text" readonly="" class="form-control" value="<?php echo $datos->detalle; ?>">
							</div>
						</div>
						
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Persona que Autoriza</label>
								<a href="#" id="midtipopro" data-toggle="modal" data-target="#modal_general" onclick="modaledit(this.id);"><i class="fas fa-info-circle"></i></a>
								<select class="form-control select2" name="id_autoriza" id="id_autoriza">
									<option value="<?php echo $datos->id_auto; ?>"><?php echo $datos->ap_aut.' '.$datos->am_aut.' '.$datos->nom_aut; ?></option>
									<?php foreach ($personas as $persona) { ?>							
									<option value="<?php echo $persona->id_persona;?>"><?php echo $persona->apellido_paterno.' '.$persona->apellido_materno.' '.$persona->nombres;?></option>
									<?php } ?>
								</select>
							</div>		
						</div>	
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Proyecto</label>
								<input type="text" readonly="" class="form-control" value="<?php echo $datos->nombre_proyecto; ?>">
							</div>
						</div>															
					</div>	
					<div class="row">
						<div class="col-sm-3">
							<div class="form-group">
								<label for="">Egreso</label>
								<input type="hidden" name="id_detalle_caja" id="id_detalle_caja" value="<?php echo $datos->id_detalle_caja; ?>"><input type="text" readonly="" class="form-control" id="egreso" name="egreso" value="<?php echo $datos->monto; ?>">
							</div>
						</div>	
						<div class="col-sm-3">
							<div class="form-group">
								<label for="">Gasto Total</label>
								<input type="text" readonly="" class="form-control" value="<?=$datos->gasto; ?>" name="total" id="total" value="" placeholder="Total">
							</div>
						</div>	
						<div class="col-sm-2">
							<div class="form-group">
								<label for="">Saldo</label>
								<input type="text" readonly="" class="form-control" name="saldo" id="saldo" value="<?=$datos->monto-$datos->gasto; ?>" placeholder="Saldo">
							</div>
						</div>	
                        <div class="col-sm-2">
							<div class="form-group">
								<label for="">Tto.</label>
								<select class="form-control select2" name="tratamiento">}
										<option value="0">SIN ALTERAR</option>
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
							<label for="">&nbsp;</label>
                            <button id="btn-agregar" type="button" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Agregar</button></div>
						</div>

					</div>
							
					
						
					<div class="row" id="detalle_egreso">
						<div class="col-sm-12">
							<table id="dataTable12" style="display: block;overflow-x: auto;" class="dataTable table table-bordered table table-hover table-reponsive" width="100px">
								<thead>
									<tr>               
										<th>Fecha</th>
										<th>Periodo</th>
										<th>RUC</th>
										<th>Comprobante</th>
										<th>Serie</th>
										<th>Número</th>
										<th>Proyecto</th>
										<th>Clasificación</th>
										<th>Tipo de Actividad</th>
										<th>Descripción</th>
										<th>Cantidad</th>
										<th>Precio</th>
										<th>Total</th>
										<th></th>            
									</tr>
								</thead>
								<tbody>
                                    <?php foreach($detalles_rendicion as $detalle_rendicion) { ?>
                                    <tr id="filadatos" class="filadatos table">
                                        <td><input type="hidden" name="id_detalle_rendicion[]" value="<?php echo $detalle_rendicion->id_detalle_rendicion; ?>"><p style="visibility:hidden;display:none;"><?=$detalle_rendicion->id_detalle_rendicion ?></p><input name="fechas[]" type="date" value="<?php echo date('Y-m-d',strtotime($detalle_rendicion->fecha)); ?>"></td>
                                        <td><input name="periodos[]" value="<?php echo $detalle_rendicion->periodo; ?>" placeholder="Periodo"></td>
                                        <td><input name="ruc[]" value="<?php echo $detalle_rendicion->ruc; ?>" placeholder="RUC"></td>
                                        <td> <select name="comprobantes[]">
									            <option value="<?php echo $detalle_rendicion->id_comprobante; ?>"><?php echo $detalle_rendicion->comprobante; ?></option>
									            <?php foreach ($comprobantes as $comprobante) { ?>							
									            <option value="<?php echo $comprobante->id_comprobante;?>"><?php echo $comprobante->comprobante;?></option>
									            <?php } ?>
								                </select></td>
                                        <td><input name="serie[]" value="<?php echo $detalle_rendicion->serie; ?>" placeholder="Serie"></td>
                                        <td><input name="numero[]" value="<?php echo $detalle_rendicion->numero_comprobante; ?>" placeholder="Número"></td>
                                        <td> <select name="proyectos[]">
									            <option value="<?php echo $detalle_rendicion->id_proyecto; ?>"><?php echo $detalle_rendicion->nombre_proyecto; ?></option>
									            <?php foreach ($proyectos as $proyecto) { ?>							
									            <option value="<?php echo $proyecto->id_proyecto;?>"><?php echo $proyecto->nombre_proyecto;?></option>
									            <?php } ?>
								                </select></td>
                                        <td> <select name="clasificaciones[]">
									            <option value="<?php echo $detalle_rendicion->id_clasificacion ?>"><?php echo $detalle_rendicion->clasificacion; ?></option>
									            <?php foreach ($clasificaciones as $clasificacion) { ?>							
									            <option value="<?php echo $clasificacion->id_clasificacion;?>"><?php echo $clasificacion->clasificacion;?></option>
									            <?php } ?>
								        </select></td>       
                                        <td> <select name="tipo_actividad[]">
									            <option value="<?php echo $detalle_rendicion->id_tipo_actividad ?>"><?php echo $detalle_rendicion->tipo_actividad; ?></option>
									            <?php foreach ($tipos_actividad as $tipo_actividad) { ?>							
									            <option value="<?php echo $tipo_actividad->id_tipo_actividad;?>"><?php echo $tipo_actividad->tipo_actividad;?></option>
									            <?php } ?>
								        </select></td>     
                                        <td> <input autocomplete="off" name="detalles[]" value="<?php echo $detalle_rendicion->descripcion;?>" placeholder="Detalle"></td>
	                                    <td> <input id="cantidad" name="cantidad[]" value="<?php echo $detalle_rendicion->cantidad;?>" placeholder="Cantidad"><p hidden="hidden"></p></td>
	                                    <td> <input id="precio" name="precio[]" value="<?php echo $detalle_rendicion->precio;?>" placeholder="Precio"><p hidden="hidden"></p></td>
	                                    <td> <p><?php echo $detalle_rendicion->precio*$detalle_rendicion->cantidad;?></p></td>	  
	                                     <td> <a href="#" id="borrar" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i> </a></td>
                                    </tr>
                                    <?php } ?>	
								</tbody>	
							</table>
						</div>							
					</div>													
					<div class="form-buttons-w">
						<button class="btn btn-primary" type="submit" id="grabar"> Guardar - Grabar</button>
						<input  id="id_eliminar" name="id_eliminar" value="" type="hidden" hidden="" readonly="">
						<input  id="errormsg" name="errormsg" value="" type="hidden" hidden="" readonly="">
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
</div> 
</div>
<script type="text/javascript">
$(document).ready(function() {
		$("form[name='edit_rendicion']").submit(function(e) {
			var formData = new FormData($(this)[0]);
			$.ajax({
				
				url: "<?php echo base_url('rendicion/rendicion_edit'); ?>",
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
						openerror();
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

	function agregar(){
		var formData = new FormData($("#edit_rendicion")[0]);
			$.ajax({
				
				url: "<?php echo base_url('rendicion/agregar_detalle'); ?>",
				type: "POST",
				data:formData,
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
						add_columna(id);
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
						openerror();
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
	}
	function add_columna(id){
		var tbody = $('#dataTable12 tbody'); 
   var fila_contenido ;
   //Agregar fila nueva. 
   
      var fila_nueva = $('<tr id="filadatos" class="filadatos table">'+
	  '<td><input type="hidden" name="id_detalle_rendicion[]" value="'+id+'"><p style="visibility:hidden;display:none;">'+id+'</p> <input name="fechas[]" type="date"></td>'+
	  '<td> <input name="periodos[]" value="" placeholder="Periodo"></td>'+
	  '<td> <input name="ruc[]" value="" placeholder="RUC"></td>'+
	  '<td> <select name="comprobantes[]"><option>Seleccione un comprobante</option>'+
	'<?php foreach($comprobantes as $comprobante){ ?><option value="<?php echo $comprobante->id_comprobante; ?>"><?php echo $comprobante->comprobante; ?></option><?php } ?></select></td>'+
	  '<td> <input name="serie[]" value="" placeholder="Serie"></td>'+
	  '<td> <input name="numero[]" value="" placeholder="Número"></td>'+
	  '<td> <select name="proyectos[]"><option value=""></option>'+
      <?php foreach ($proyectos as $proyecto) { ?>							
									'<option value="<?php echo $proyecto->id_proyecto;?>"><?php echo $proyecto->nombre_proyecto;?></option>'+
									<?php } ?>'</select></td>'+
		'<td> <select name="clasificaciones[]"><option>Seleccione una clasificación</option>'+
		'<?php foreach($clasificaciones as $clasificacion){ ?><option value="<?php echo $clasificacion->id_clasificacion; ?>"><?php echo $clasificacion->clasificacion; ?></option><?php } ?></select></td>'+
		'<td> <select name="tipo_actividad[]"><option>Seleccione una tipo</option>'+
		'<?php foreach($tipos_actividad as $tipo_actividad){ ?><option value="<?php echo $tipo_actividad->id_tipo_actividad; ?>"><?php echo $tipo_actividad->tipo_actividad; ?></option><?php } ?></select></td>'+
		'<td> <input autocomplete="off" name="detalles[]" value="" placeholder="Detalle"></td>'+
	  '<td> <input id="cantidad" name="cantidad[]" value="0" placeholder="Cantidad"><p hidden="hidden"></p></td>'+
	  '<td> <input id="precio" name="precio[]" value="0" placeholder="Precio"><p hidden="hidden"></p></td>'+
	  '<td> <p></p></td>'+  
	  
	  '<td> <a href="#" id="borrar" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i> </a></td>'+
	  '</tr>');
      fila_nueva.append(fila_contenido); 
      tbody.append(fila_nueva); 
	}
	

$('#btn-agregar').on('click', function() {
	swal({
  		title: "¿Está segura(o) de hacer la modificación?",
  		text: "Al aceptar se agregará un registro a la rendición!",
  		icon: "warning",
  		buttons: true,
  		dangerMode: true,
		})
		.then((willDelete) => {
  		if (willDelete) {
    		agregar();
  		} else {
    	swal("El registró no se modificó!");
  		}
});
	

});
function eliminar(id){
	var formData = new FormData($("#edit_rendicion")[0]);
			$.ajax({
				
				url: "<?php echo base_url('rendicion/eliminar_detalle'); ?>",
				type: "POST",
				data:formData,
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

						 //will call the function after 2 secs.
					}
					else
					{
						$('#errormsg').val(msg);
						openerror(msg);
						return false;
					}
				},
				error: function(data, xhr,textStatus,errorThrown) {
					if(textStatus=='timeout'){
						$('#errormsg').val("Error: Tiempo de conexión agotado.");
						openerror();
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
}
$(document).on("click","#borrar", function(){
	var tr = $(this).closest("tr").find("td:eq(0)").children("p").text();
	$("#id_eliminar").val(tr);
	swal({
  		title: "¿Está segura(o) de hacer la modificación?",
  		text: "Al aceptar se agregará un registro a la rendición!",
  		icon: "warning",
  		buttons: true,
  		dangerMode: true,
		})
		.then((willDelete) => {
  		if (willDelete) {
			$(this).closest("tr").remove();
			eliminar(tr);			
        	sumar();
  		} else {
    	swal("El registró no se modificó!");
  		}
		});
	
    });

$(function () {
    $(document).on('keyup', '#cantidad', function (event) {
		$(this).closest("tr").find("td:eq(10)").children("p").text($(this).val());				
        cantidad = $(this).val();
        precio = $(this).closest("tr").find("td:eq(11)").text();
        importe = cantidad * precio;
        $(this).closest("tr").find("td:eq(12)").children("p").text(importe.toFixed(2));
		sumar();
    });
});
$(function () {
    $(document).on('keyup', '#precio', function (event) {
		$(this).closest("tr").find("td:eq(11)").children("p").text($(this).val());
        precio = $(this).val();
        cantidad = $(this).closest("tr").find("td:eq(10)").text();
        importe = cantidad * precio;
        $(this).closest("tr").find("td:eq(12)").children("p").text(importe.toFixed(2));
		sumar();
    });
});
});

function sumar(){
	var total=0;
	$("#dataTable12 tbody tr").each(function(){
		total=total + Number($(this).find("td:eq(12)").children("p").text());
	});
	$("input[name=total]").val(total);
	egreso=$("#egreso").val();
	saldo=egreso-total;
	$("input[name=saldo]").val(saldo);
}
 function opensuccess(){
	swal(
			'Correcto',
			'El registro se completo satisfactoriamente.',
			'success'
		);
 }
 function openerror(msg){
		var errormsg = msg;
		swal(
			'Error',
			'El registro no pudo llevarse a cabo. \n '+errormsg+'',
			'error'
		);
		$('#errormsg').val("");
	}
</script>