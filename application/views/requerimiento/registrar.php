      <script>      
	  $(function() {
            var disProyecto  = Array();
			var disPersona  = Array();
            <?php foreach($proyectos as $proyecto){  ?>
    				disProyecto.push(
                  { label: "<?php echo $proyecto->nombre_proyecto; ?>", value: "<?php echo $proyecto->id_proyecto; ?>" }
                  
               );
            <?php } ?>
			<?php foreach ($personas as $persona) { ?>	
				disPersona.push(
                  { label: "<?php echo $persona->apellido_paterno.' '.$persona->apellido_materno.' '.$persona->nombres; ?>", value: "<?php echo $persona->id_persona; ?>" }
                  
               );
            <?php } ?>  
            $( "#responsable_id" ).autocomplete({
               minLength: 0,
               source: disPersona,
               focus: function( event, ui ) {
                  $( "#responsable_id" ).val( ui.item.label );
                     return false;
               },
               select: function( event, ui ) {
                  $( "#responsable_id" ).val( ui.item.label );
				  $("#id_responsable").val(ui.item.value);
                  return false;
               }
            })
				
            .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
               return $( "<li>" )
               .append( "<a>" + item.label + "<br></a>" )
               .appendTo( ul );
            };

			$( "#autoriza_id" ).autocomplete({
               minLength: 0,
               source: disPersona,
               focus: function( event, ui ) {
                  $( "#autoriza_id" ).val( ui.item.label );
                     return false;
               },
               select: function( event, ui ) {
                  $( "#autoriza_id" ).val( ui.item.label );
				  $("#id_autoriza").val(ui.item.value);
                  return false;
               }
            })
				
            .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
               return $( "<li>" )
               .append( "<a>" + item.label + "<br></a>" )
               .appendTo( ul );
            };

            $( "#proyecto_id" ).autocomplete({
               minLength: 0,
               source: disProyecto,
               focus: function( event, ui ) {
                  $( "#proyecto_id" ).val( ui.item.label );
                     return false;
               },
               select: function( event, ui ) {
				$( "#proyecto_id" ).val( ui.item.label );
				  $("#id_proyecto").val(ui.item.value);
                  return false;
               }
            })
				
            .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
               return $( "<li>" )
               .append( "<a>" + item.label + "<br></a>" )
               .appendTo( ul );
            };
         });
      </script>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="content-box">
	<div class="row">
		<div class="col-lg-12">
			<div class="element-wrapper">
				
				<div class="element-box">
				<form  id="add_caja" name="add_caja" accept-charset="utf-8" enctype="multipart/form-data" method="post">
					<h5 class="form-header"> Añadir Registro </h5>
					<div class="form-desc"> Describe todos los datos del Movimiento. </div>
					<hr>
					<div class="row">						
						<div class="col-sm-3">
						<div class="form-group">
								<label for="">Moneda</label>
								<select class="form-control select2" name="moneda" id="moneda">
									<option value="0">--Selecciones moneda--</option>
									<option value="SOLES">SOLES</option>
									<option value="DOLARES">DÓLARES</option>
								</select>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label for="">Tipo de movimiento</label>
								<select class="form-control select2" name="tipo" id="tipo">
									<option value="0">--Selecciones tipo de movimiento--</option>
									<option value="INTERNO">INTERNO</option>
									<option value="EXTERNO">EXTERNO</option>
								</select>
							</div>
						</div>
						
					</div>
					<div class="row">						
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Empresa Asociada</label>
								<a href="#" id="midtipopro" data-toggle="modal" data-target="#modal_general" onclick="modaledit(this.id);"><i class="fa fa-plus-square"></i></a>
								<select class="form-control select2" name="id_empresa" id="id_empresa">
									<option value="0">--Selecciones una empresa--</option>
									<?php foreach ($empresas as $empresa) { ?>							
									<option value="<?php echo $empresa->id_empresa;?>"><?php echo $empresa->empresa;?></option>
									<?php } ?>
								</select>
							</div>						
						</div>	
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Proyecto</label>
								<a href="#" id="midtipopro" data-toggle="modal" data-target="#modal_general" onclick="modaledit(this.id);"><i class="fa fa-plus-square"></i></a>
								<input id = "proyecto_id"class="form-control"> 
								<input type="hidden"name="id_proyecto" id="id_proyecto">
								<!--
								<<select class="form-control select2" name="id_proyecto" id="id_proyecto">
									<option value="0">--Seleccione proyecto-</option>
									<?php foreach ($proyectos as $proyecto) { ?>							
									<option value="<?php echo $proyecto->id_proyecto;?>"><?php echo $proyecto->nombre_proyecto;?></option>
									<?php } ?>
								</select>-->
							</div>		
						</div>										
					</div>	
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Persona Responsable</label>
								<a href="#" id="midtipopro" data-toggle="modal" data-target="#modal_general" onclick="modaledit(this.id);"><i class="fa fa-plus-square"></i></a>
								<input id = "responsable_id"class="form-control"><input type="hidden"name="id_responsable" id="id_responsable">
								<!--<select class="form-control select2" name="id_responsable" id="id_responsable">
									<option value="0">--Seleccione a responsable--</option>
									<?php foreach ($personas as $persona) { ?>							
									<option value="<?php echo $persona->id_persona;?>"><?php echo $persona->apellido_paterno.' '.$persona->apellido_materno.' '.$persona->nombres;?></option>
									<?php } ?>
								</select>-->
							</div>		
						</div>	
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Persona que Autoriza</label>
								<a href="#" id="midtipopro" data-toggle="modal" data-target="#modal_general" onclick="modaledit(this.id);"><i class="fa fa-plus-square"></i></a>
								<input id = "autoriza_id"class="form-control"><input type="hidden"name="id_autoriza" id="id_autoriza">
								<!--<select class="form-control select2" name="id_responsable" id="id_responsable">
									<option value="0">--Seleccione a responsable--</option>
									<?php foreach ($personas as $persona) { ?>							
									<option value="<?php echo $persona->id_persona;?>"><?php echo $persona->apellido_paterno.' '.$persona->apellido_materno.' '.$persona->nombres;?></option>
									<?php } ?>
								</select>-->
							</div>		
						</div>						
					</div>
					<div class="row">
						
						
						<div class="col-sm-2">
							<div class="form-group">
							<label for="">&nbsp;</label>
                            <button id="btn-agregar" type="button" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Agregar</button></div>
						</div>
						<div class="col-sm-7"></div>
						<div class="col-sm-3">
							<div class="form-group">
								<label for="">Total</label><input type="text" readonly="" class="form-control" name="total" id="total" value="" placeholder="Total">
							</div>
						</div>
															
					</div>		
					<div class="row" id="detalle_egreso">
						<div class="col-sm-12">
							<table id="dataTable12" style="display: block;overflow-x: auto;" class="dataTable table table-bordered table table-hover table-reponsive" width="100px">
								<thead>
									<tr>               
										<th>Desde:</th>
										<th>Hasta:</th>
										<th>DNI</th>
										<th>Appellidos y Nombres</th>
										<th>Descripcion</th> 
										<th>Días</th>
										<th>Precio</th>
										<th>Total</th>   
										
										<th></th>            
									</tr>
								</thead>
								<tbody>
								
									
									</tbody>	
							</table>
						</div>							
					</div>													
					<div class="form-buttons-w">
						<button class="btn btn-primary" type="submit" id="grabar"> Guardar - Grabar</button>
						
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
	$("form[name='add_caja']").submit(function(e) {
			var formData = new FormData($(this)[0]);
			$.ajax({
				
				url: "<?php echo base_url('requerimiento/requerimiento_add'); ?>",
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
						window.location.href="<?php echo base_url('requerimiento' ); ?>/";
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
	
$('#btn-agregar').on('click', function() {
	agregar();
});


$(document).on("click","#borrar", function(){
        $(this).closest("tr").remove();
        sumar();
    });

	$(function () {
    $(document).on('keyup', '#dias', function (event) {
		$(this).closest("tr").find("td:eq(5)").children("p").text($(this).val());				
        cantidad = $(this).val();
        precio = $(this).closest("tr").find("td:eq(6)").text();
        importe = cantidad * precio;
        $(this).closest("tr").find("td:eq(7)").children("p").text(importe.toFixed(2));
		sumar();
    });
});
$(function () {
    $(document).on('keyup', '#precio', function (event) {
		$(this).closest("tr").find("td:eq(6)").children("p").text($(this).val());
        precio = $(this).val();
        cantidad = $(this).closest("tr").find("td:eq(5)").text();
        importe = cantidad * precio;
        $(this).closest("tr").find("td:eq(7)").children("p").text(importe.toFixed(2));
		sumar();
    });
});
});
function sumar(){
	var total=0;
	$("#dataTable12 tbody tr").each(function(){
		total=total + Number($(this).find("td:eq(7)").children("p").text());
	});
	$("input[name=total]").val(total);
}
function agregar(){
      var tbody = $('#dataTable12 tbody'); 
   var fila_contenido ;
   //Agregar fila nueva. 
   
      var fila_nueva = $('<tr id="filadatos" class="filadatos table">'+
	  '<td> <input name="fecha_inicio[]" type="date"  min="2019-10-25" value="<?php echo date("Y-m-d"); ?>"></td>'+
	  '<td> <input name="fecha_fin[]" type="date"  min="2019-10-25" value="<?php echo date("Y-m-d"); ?>"></td>'+
	  '<td> <input name="dni[]" placeholder="dni" value=""></td>'+
	  '<td> <input name="datos[]" placeholder="Datos de trabajador" value=""></td>'+
	  '<td> <input name="descripcion[]" placeholder="Descripcion" value=""></td>'+
	  '<td> <input id="dias" name="dias[]" value="0" placeholder="Días"><p hidden="hidden"></p></td>'+
	  '<td> <input id="precio" name="precio[]" value="0" placeholder="Precio"><p hidden="hidden"></p></td>'+
	  '<td> <p></p></td>'+  
	  '<td> <a href="#" id="borrar" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i> </a></td>'+
	  '</tr>');
      fila_nueva.append(fila_contenido); 
      tbody.append(fila_nueva); 
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
