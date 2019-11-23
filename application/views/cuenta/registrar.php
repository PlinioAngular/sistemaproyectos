<div class="container-fluid">
    <!-- Page Heading -->
    <div class="content-box">
	<div class="row">
		<div class="col-lg-12">
			<div class="element-wrapper">
				
				<div class="element-box">
				<form id="add_area" name="add_area" accept-charset="utf-8" enctype="multipart/form-data" method="post">
					<h5 class="form-header"> Añadir Cuenta </h5>
					<div class="form-desc"></div>
					<div class="row">
						<div class="col-sm-3">
							<div class="form-group">
								<label for="">Cógido</label><input autocomplete="off" class="form-control form-control-sm" placeholder="Nombre:" type="text" name="area" id="area">
							</div>
						</div>	
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Descripción</label><input autocomplete="off" class="form-control form-control-sm" placeholder="Nombre:" type="text" name="area" id="area">
							</div>
						</div>	
					</div>
					<div class="row">					
						<div class="col-6">
						<label for="">Destino Automático</label>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
									<label for="">Debe:</label><input autocomplete="off" class="form-control form-control-sm" placeholder="Debe" type="text" name="area" id="area">
									</div>
								</div>	
							</div>
							<div class="row">
							<div class="col-sm-6">
									<div class="form-group">
									<label for="">Haber:</label><input autocomplete="off" class="form-control form-control-sm" placeholder="Haber" type="text" name="area" id="area">
									</div>
								</div>
							</div>
						</div>
						<div class="col-6">.
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
									<label for="">Situación:</label><input autocomplete="off" class="form-control form-control-sm" placeholder="Nombre:" type="text" name="area" id="area">
									</div>
								</div>	
							</div>
							<div class="row">
							<div class="col-sm-6">
									<div class="form-group">
									<label for="">Resultado</label><input autocomplete="off" class="form-control form-control-sm" placeholder="Nombre:" type="text" name="area" id="area">
									</div>
								</div>
							</div>
						</div>	
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
							<label for="">Nivel:</label><input autocomplete="off" class="form-control form-control-sm" placeholder="Nombre:" type="text" name="area" id="area">
							</div>
						</div>	
						<div class="col-sm-1">Centro
							<div class="form-group">
							<label for="">SI</label>
							<input  type="radio" name="centro_costo" value="male"> 						
							</div>
						</div>
						<div class="col-sm-1"> de Costo 
							<div class="form-group">
							<label for="">NO</label>
							<input type="radio" name="centro_costo" value="female">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
							<label for="">Tipo:</label><input autocomplete="off" class="form-control form-control-sm" placeholder="Nombre:" type="text" name="area" id="area">
							</div>
						</div>
						<div class="col-sm-1">Presupuesto
							<div class="form-group">
							<label for="">SI</label>
							<input  type="radio" name="presupuecto" value="male"> 						
							</div>
						</div>
						<div class="col-sm-1"> . 
							<div class="form-group">
							<label for="">NO</label>
							<input type="radio" name="presupuecto" value="female">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
							<label for="">Análisis:</label><input autocomplete="off" class="form-control form-control-sm" placeholder="Nombre:" type="text" name="area" id="area">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
							<label for="">Cuenta cierre:</label><input autocomplete="off" class="form-control form-control-sm" placeholder="Nombre:" type="text" name="area" id="area">
							</div>
						</div>
					</div>
					<div class="row">
										
						
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
		$("form[name='add_area']").submit(function(e) {
			var formData = new FormData($(this)[0]);
			$.ajax({
				
				url: "<?php echo base_url('area/area_add'); ?>",
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
						window.location.href="<?php echo base_url('area' ); ?>/";
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