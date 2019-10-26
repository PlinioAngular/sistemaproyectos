
      
      <!-- Javascript -->
	  
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

			$( "#beneficiario_id" ).autocomplete({
               minLength: 0,
               source: disPersona,
               focus: function( event, ui ) {
                  $( "#beneficiario_id" ).val( ui.item.label );
                     return false;
               },
               select: function( event, ui ) {
                  $( "#beneficiario_id" ).val( ui.item.label );
				  $("#id_beneficiario").val(ui.item.value);
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
                  var id_proyecto=ui.item.value ;
                  var nombre_proyecto=ui.item.label ;
                  agregar(id_proyecto,nombre_proyecto);
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
						<div class="col-sm-2">
							<div class="form-group">
								<label for="">¿INGRESO?</label>
								<input class="form-control" type="checkbox" name="ingreso" value="1" >
							</div>
						</div>
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
						<div class="col-sm-4">
							<div class="form-group">
								<label for="">Total</label><input type="hidden" autocomplete="off" class="form-control" placeholder="Total"  name="total" id="total"><input autocomplete="off" readonly="" class="form-control" placeholder="Total" type="text" name="total2" id="total2">
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
								<label for="">Banco</label>
								<a href="#" id="midtipopro" data-toggle="modal" data-target="#modal_general" onclick="modaledit(this.id);"><i class="fa fa-plus-square"></i></a>
								<select class="form-control select2" name="id_banco" id="id_banco">									
								</select>
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
								<label for="">Beneficiario</label>
								<a href="#" id="midtipopro" data-toggle="modal" data-target="#modal_general" onclick="modaledit(this.id);"><i class="fa fa-plus-square"></i></a>
								<input id = "beneficiario_id"class="form-control"><input type="hidden"name="id_beneficiario" id="id_beneficiario">
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
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Proyecto</label>
								<a href="#" id="midtipopro" data-toggle="modal" data-target="#modal_general" onclick="modaledit(this.id);"><i class="fa fa-plus-square"></i></a>
								<input id = "proyecto_id"class="form-control"><!--
								<<select class="form-control select2" name="id_proyecto" id="id_proyecto">
									<option value="0">--Seleccione proyecto-</option>
									<?php foreach ($proyectos as $proyecto) { ?>							
									<option value="<?php echo $proyecto->id_proyecto;?>"><?php echo $proyecto->nombre_proyecto;?></option>
									<?php } ?>
								</select>-->
							</div>		
						</div>
															
					</div>		
					<div class="row" id="detalle_egreso">
						<div class="col-sm-12">
							<table id="dataTable12" style="display: block;overflow-x: auto;" class="dataTable table table-bordered table table-hover table-reponsive" width="100px">
								<thead>
									<tr>               
										<th>Fecha</th>
										<th>Periodo</th>
										<th>Proyecto</th>
										<th>Lugar</th>
										<th>Monto</th>
										<th>Detalle</th>   
										<th>Clasificación</th> 
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
				
				url: "<?php echo base_url('caja/caja_add'); ?>",
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
						window.location.href="<?php echo base_url('caja' ); ?>/";
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
	$('#id_empresa').on('change', function() {
		$("#id_banco").prop('disabled', true);
    //alert( $(this).find(":selected").val() );
	// Guardamos el select de bancos
	var bancos = $("#id_banco");

	// Guardamos el select de empresas
	var empresas = $(this);
	if($(this).val() != '')
        {
            $.ajax({
                data: { id : empresas.val() },
                url:   '<?php echo base_url('banco/mostrar_banco_id'); ?>',
                type:  'POST',
                dataType: 'json',
                beforeSend: function () 
                {
                    empresas.prop('disabled', true);
                },
                success:  function (r) 
                {
                    empresas.prop('disabled', false);

                    // Limpiamos el select
                    bancos.find('option').remove();
					bancos.append('<option value="">--Seleccione un banco--</option>');
                    $(r).each(function(i, v){ // indice, valor
                        bancos.append('<option value="' + v['id_banco'] + '">' + v['banco'] + '</option>');
                    })

                    bancos.prop('disabled', false);
                },
                error: function()
                {
                    alert('Ocurrio un error en el servidor ...');
                    empresas.prop('disabled', false);
                }
            });
        }
        else
        {
            bancos.find('option').remove();
            bancos.prop('disabled', true);
        }
});

$('#id_proyecto').on('change', function() {
	var proyecto=document.getElementById("id_proyecto");
	
  
    var selectedOption = this.options[proyecto.selectedIndex];
    var nombre_proyecto=selectedOption.text;
	var id_proyecto=selectedOption.value;
    var tbody = $('#dataTable12 tbody'); 
   var fila_contenido ;
   //Agregar fila nueva. 
   
      var fila_nueva = $('<tr id="filadatos" class="filadatos table">'+
	  '<td> <input name="fechas[]" type="date" value=""></td>'+
	  '<td> <input name="periodos[]" value="" placeholder="Periodo"></td>'+
	  '<td> <select name="proyectos[]"><option value="'+id_proyecto+'">'+nombre_proyecto+'</option>'+
      <?php foreach ($proyectos as $proyecto) { ?>							
									'<option value="<?php echo $proyecto->id_proyecto;?>"><?php echo $proyecto->nombre_proyecto;?></option>'+
									<?php } ?>'</select></td>'+
	  '<td> <input name="lugares[]" value="" placeholder="Lugar"></td>'+
	  '<td> <input autocomplete="off" name="montos[]" type="text" id="monto"><p hidden="hidden"></p></td>'+
	  '<td> <input autocomplete="off" name="detalles[]" value="" placeholder="Detalle"></td>'+
	  '<td> <select name="clasificaciones[]"><option>Seleccione una clasificación</option>'+
'<?php foreach($clasificaciones as $clasificacion){ ?><option value="<?php echo $clasificacion->id_clasificacion; ?>"><?php echo $clasificacion->clasificacion; ?></option><?php } ?></select></td>'+
	  
	  '<td> <a href="#" id="borrar" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i> </a></td>'+
	  '</tr>');
      fila_nueva.append(fila_contenido); 
      tbody.append(fila_nueva); 

});

$(document).on("click","#borrar", function(){
        $(this).closest("tr").remove();
        sumar();
    });

$(function () {
    $(document).on('keyup', '#monto', function (event) {

        $(this).closest("tr").find("td:eq(4)").children("p").text($(this).val());
		sumar();
    });
});
});

function agregar(id,nombre){
      var tbody = $('#dataTable12 tbody'); 
   var fila_contenido ;
   //Agregar fila nueva. 
   
      var fila_nueva = $('<tr id="filadatos" class="filadatos table">'+
	  '<td> <input name="fechas[]" type="date" value="<?php echo date("Y-m-d"); ?>"></td>'+
	  '<td> <input name="periodos[]" placeholder="Periodo" value="<?php echo date("m-Y"); ?>"></td>'+
	  '<td> <select name="proyectos[]"><option value="'+id+'">'+nombre+'</option>'+
      <?php foreach ($proyectos as $proyecto) { ?>							
									'<option value="<?php echo $proyecto->id_proyecto;?>"><?php echo $proyecto->nombre_proyecto;?></option>'+
									<?php } ?>'</select></td>'+
	  '<td> <input name="lugares[]" value="" placeholder="Lugar"></td>'+
	  '<td> <input autocomplete="off" name="montos[]" type="text" id="monto"><p hidden="hidden"></p></td>'+
	  '<td> <input autocomplete="off" name="detalles[]" value="" placeholder="Detalle"></td>'+
	  '<td> <select name="clasificaciones[]"><option>Seleccione una clasificación</option>'+
	  '<?php foreach($clasificaciones as $clasificacion){ ?><option value="<?php echo $clasificacion->id_clasificacion; ?>"><?php echo $clasificacion->clasificacion; ?></option><?php } ?></select></td>'+
	    
	  '<td> <a href="#" id="borrar" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i> </a></td>'+
	  '</tr>');
      fila_nueva.append(fila_contenido); 
      tbody.append(fila_nueva); 
    }

function sumar(){
	var total=0;
	$("#dataTable12 tbody tr").each(function(){
		total=total + Number($(this).find("td:eq(4)").children("p").text());
	});
	$("input[name=total]").val(total);
	$("input[name=total2]").val(total);
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
