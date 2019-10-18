<div class="container-fluid">
    <!-- Page Heading -->
    <div class="content-box">
	<div class="row">
		<div class="col-lg-12">
			<div class="element-wrapper">				
				<div class="element-box">
				<form id="edit_persona" name="edit_persona" accept-charset="utf-8" enctype="multipart/form-data" method="post">
					<input type="hidden" id="id_persona" name="id_persona" value="<?php echo $persona->id_persona; ?>">
                    <h5 class="form-header"> Añadir persona </h5>
					<div class="form-desc"> Describe todas las características de la persona. </div>
					<div class="row">
						<div class="col-sm-6">
						<div class="form-group">
								<label for="">Apellido Paterno</label><input value="<?php echo $persona->apellido_paterno; ?>" autocomplete="off" class="form-control" placeholder="Apellido Paterno" type="text" name="apellido_paterno" id="apellido_paterno">
							</div>
						</div>
						<div class="col-sm-6">
						<div class="form-group">
								<label for="">Apellido Materno</label><input value="<?php echo $persona->apellido_materno; ?>" autocomplete="off" class="form-control" placeholder="Apellido Materno" type="text" name="apellido_materno" id="apellido_materno">
							</div>
						</div>						
					</div>	
					<div class="row">
						<div class="col-sm-6">
						<div class="form-group">
								<label for="">Nombres</label><input value="<?php echo $persona->nombres; ?>" autocomplete="off" class="form-control" placeholder="Apellido Paterno" type="text" name="nombres" id="nombres">
							</div>
						</div>
						<div class="col-sm-3">
						<div class="form-group">
								<label for="">DNI</label><input value="<?php echo $persona->dni; ?>" autocomplete="off" class="form-control" placeholder="DNI" type="text" name="dni" id="dni">
							</div>
						</div>	
						<div class="col-sm-3">
						<div class="">
								<label for="">Fecha de Nacimiento</label><input value="<?php  echo date('Y-m-d',strtotime($persona->fecha_nacimiento)); ?>" autocomplete="off" class="form-control" type="date" name="fecha_nacimiento" id="fecha_nacimiento">
							</div>
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
		$("form[name='edit_persona']").submit(function(e) {
			var formData = new FormData($(this)[0]);
			$.ajax({
				
				url: "<?php echo base_url('persona/persona_edit'); ?>",
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
						window.location.href="<?php echo base_url('persona' ); ?>/";
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
});
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