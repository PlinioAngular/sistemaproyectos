<div class="container-fluid">
    <!-- Page Heading -->
    <div class="content-box">
	<div class="row">
		<div class="col-lg-12">
			<div class="element-wrapper">				
				<div class="element-box">
				<form id="edit_clasificacion" name="edit_clasificacion" accept-charset="utf-8" enctype="multipart/form-data" method="post">
					<input type="hidden" id="id_clasificacion" name="id_clasificacion" value="<?php echo $clasificacion->id_clasificacion; ?>">
                    <h5 class="form-header"> Añadir clasificacion de Ropa </h5>
					<div class="form-desc"> Describe todas las características del producto. </div>
					<div class="row">
						<div class="col-sm-4">
						<div class="form-group">
								<label for="">clasificacion de ropa</label><input autocomplete="off" value="<?php echo $clasificacion->clasificacion; ?>" class="form-control" placeholder="clasificacion" type="text" name="clasificacion" id="clasificacion">
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
		$("form[name='edit_clasificacion']").submit(function(e) {
			var formData = new FormData($(this)[0]);
			$.ajax({
				
				url: "<?php echo base_url('clasificacion/clasificacion_edit'); ?>",
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
						window.location.href="<?php echo base_url('clasificacion' ); ?>/";
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