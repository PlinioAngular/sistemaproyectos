<div class="container-fluid">
    <!-- Page Heading -->
    <div class="content-box">
	<div class="row">
		<div class="col-lg-12">
			<div class="element-wrapper">
				
				<div class="element-box">
				<form  id="edit_caja" name="edit_caja" accept-charset="utf-8" enctype="multipart/form-data" method="post">
					<input type="hidden" value="<?php echo $caja->id_caja; ?>" name="id_caja" id="id_caja">
                    <h5 class="form-header"> Editar Registro </h5>
					<div class="form-desc"> Modifique los datos del Movimiento. </div>
					<hr>
					<div class="row">
						<div class="col-sm-2">
							<div class="form-group">
								<label for="">¿INGRESO?</label>
								<?php if($caja->egreso==0){ ?>
								<input class="form-control form-control-sm" type="checkbox" checked="checked" name="ingreso" value="1" >
								<input type="hidden" name="movimiento_anterior" value="ingreso">
								<?php } else { ?>
									<input class="form-control form-control-sm" type="checkbox"  name="ingreso" value="1" >
									<input type="hidden" name="movimiento_anterior" value="egreso">
									<?php }  ?>
							</div>
						</div>
						<div class="col-sm-3">
						<div class="form-group">
								<label for="">Moneda</label>
								<input type="hidden" name="moneda_anterior" value="<?php echo $caja->moneda; ?>">
								<select class="form-control form-control-sm select2" name="moneda" id="moneda">
									<option value="<?php echo $caja->moneda; ?>"><?php echo $caja->moneda; ?></option>
									<option value="SOLES">SOLES</option>
									<option value="DOLARES">DÓLARES</option>
								</select>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label for="">Tipo de movimiento</label>
								<select class="form-control form-control-sm select2" name="tipo" id="tipo">
                                    <option value="<?php echo $caja->tipo; ?>"><?php echo $caja->tipo; ?></option>
									<option value="INTERNO">INTERNO</option>
									<option value="EXTERNO">EXTERNO</option>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label for="">Total</label><input type="hidden" autocomplete="off" class="form-control form-control-sm" placeholder="Total" value="<?php if($caja->ingreso==0){ echo $caja->egreso; } else { echo $caja->ingreso; } ?>" name="total" id="total">
								<input autocomplete="off" readonly="" class="form-control form-control-sm" value="<?php if($caja->ingreso==0){ echo $caja->egreso; } else { echo $caja->ingreso; } ?>" placeholder="Total" type="text" name="total2" id="total2">
								<input type="hidden" value="<?php if($caja->ingreso==0){ echo $caja->egreso; } else { echo $caja->ingreso; } ?>"  name="total_anterior">
							</div>
						</div>
					</div>
					<div class="row">						
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Empresa Asociada</label>
								<a href="#" id="midtipopro" data-toggle="modal" data-target="#modal_general" onclick="modaledit(this.id);"><i class="fas fa-info-circle"></i></a>
								<select class="form-control form-control-sm select2" name="id_empresa" id="id_empresa">
									<option value="<?php echo $caja->id_empresa;?>"><?php echo $caja->empresa;?></option>
									<?php foreach ($empresas as $empresa) { ?>							
									<option value="<?php echo $empresa->id_empresa;?>"><?php echo $empresa->empresa;?></option>
									<?php } ?>
								</select>
							</div>						
						</div>		
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Banco</label>
								<input type="hidden" name="banco_anterior" value="<?php echo $caja->id_banco; ?>">
								<a href="#" id="midtipopro" data-toggle="modal" data-target="#modal_general" onclick="modaledit(this.id);"><i class="fas fa-info-circle"></i></a>
								<select class="form-control form-control-sm select2" name="id_banco" id="id_banco">	
                                <option value="<?php echo $caja->id_banco;?>"><?php echo $caja->banco;?></option>								
								</select>
							</div>						
						</div>					
					</div>	
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Persona Responsable</label>
								<a href="#" id="midtipopro" data-toggle="modal" data-target="#modal_general" onclick="modaledit(this.id);"><i class="fas fa-info-circle"></i></a>
								<select class="form-control form-control-sm select2" name="id_responsable" id="id_responsable">
									<option value="<?php echo $caja->id_res;?>"><?php echo $caja->ap_res.' '.$caja->am_res.' '.$caja->nom_res;?></option>
									<?php foreach ($personas as $persona) { ?>							
									<option value="<?php echo $persona->id_persona;?>"><?php echo $persona->apellido_paterno.' '.$persona->apellido_materno.' '.$persona->nombres;?></option>
									<?php } ?>
								</select>
							</div>		
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Beneficiario</label>
								<a href="#" id="midtipopro" data-toggle="modal" data-target="#modal_general" onclick="modaledit(this.id);"><i class="fas fa-info-circle"></i></a>
								<select class="form-control form-control-sm select2" name="id_beneficiario" id="id_beneficiario">
                                <option value="<?php echo $caja->id_ben;?>"><?php echo $caja->ap_ben.' '.$caja->am_ben.' '.$caja->nom_ben;?></option>
									<?php foreach ($personas as $persona) { ?>							
									<option value="<?php echo $persona->id_persona;?>"><?php echo $persona->apellido_paterno.' '.$persona->apellido_materno.' '.$persona->nombres;?></option>
									<?php } ?>
								</select>
							</div>		
						</div>	
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Persona que Autoriza</label>
								<a href="#" id="midtipopro" data-toggle="modal" data-target="#modal_general" onclick="modaledit(this.id);"><i class="fas fa-info-circle"></i></a>
								<select class="form-control form-control-sm select2" name="id_autoriza" id="id_autoriza">
									<option value="<?php echo $caja->id_aut;?>"><?php echo $caja->ap_aut.' '.$caja->am_aut.' '.$caja->nom_aut;?></option>
									<?php foreach ($personas as $persona) { ?>							
									<option value="<?php echo $persona->id_persona;?>"><?php echo $persona->apellido_paterno.' '.$persona->apellido_materno.' '.$persona->nombres;?></option>
									<?php } ?>
								</select>
							</div>		
						</div>	
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Proyecto</label>
								<a href="#" id="midtipopro" data-toggle="modal" data-target="#modal_general" onclick="modaledit(this.id);"><i class="fas fa-info-circle"></i></a>
								<select class="form-control form-control-sm select2" name="id_proyecto" id="id_proyecto">
									<option value="0">--Seleccione proyecto-</option>
									<?php foreach ($proyectos as $proyecto) { ?>							
									<option value="<?php echo $proyecto->id_proyecto;?>"><?php echo $proyecto->nombre_proyecto;?></option>
									<?php } ?>
								</select>
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
                                    <?php foreach($detalles_caja as $detalle_caja) { ?>
                                    <tr id="filadatos" class="filadatos table">
                                        <td><input type="hidden" name="id_detalle_caja[]" value="<?php echo $detalle_caja->id_detalle_caja; ?>"><input name="fechas[]" type="date" value="<?php echo date('Y-m-d',strtotime($detalle_caja->fecha)); ?>"></td>
                                        <td><input name="periodos[]" value="<?php echo $detalle_caja->periodo; ?>" placeholder="Periodo"></td>
                                        <td> <select name="proyectos[]">
									            <option value="<?php echo $detalle_caja->id_proyecto; ?>"><?php echo $detalle_caja->nombre_proyecto; ?></option>
									            <?php foreach ($proyectos as $proyecto) { ?>							
									            <option value="<?php echo $proyecto->id_proyecto;?>"><?php echo $proyecto->nombre_proyecto;?></option>
									            <?php } ?>
								                </select></td>
                                        <td> <input name="lugares[]" value="<?php echo $detalle_caja->lugar; ?>" placeholder="Lugar"></td>
                                        <td> <input autocomplete="off" name="montos[]" value="<?php echo $detalle_caja->monto; ?>" type="text" id="monto"><p hidden="hidden"><?php echo $detalle_caja->monto; ?></p></td>
                                        <td> <input autocomplete="off" name="detalles[]" value="<?php echo $detalle_caja->detalle; ?>" placeholder="Detalle"></td>
                                        <td> <select name="clasificaciones[]" ><option value="<?php echo $detalle_caja->id_clasificacion; ?>"><?php echo $detalle_caja->clasificacion; ?></option>
                                    <?php foreach($clasificaciones as $clasificacion){ ?><option value="<?php echo $clasificacion->id_clasificacion; ?>"><?php echo $clasificacion->clasificacion; ?></option><?php } ?></select></td>
	  
	                                    <td> <a href="#" id="borrar" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i> </a></td>
                                    </tr>
                                    <?php } ?>	
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
	$("form[name='edit_caja']").submit(function(e) {
			var formData = new FormData($(this)[0]);
			$.ajax({
				
				url: "<?php echo base_url('caja/caja_edit'); ?>",
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
	  '<td> <input name="fechas[]" type="date"></td>'+
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