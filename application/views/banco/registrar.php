<div class="container-fluid">
    <!-- Page Heading -->
    <div class="content-box">
	<div class="row">
		<div class="col-lg-12">
			<div class="element-wrapper">
				
				<div class="element-box">
				<form id="add_banco" name="add_banco" accept-charset="utf-8" enctype="multipart/form-data" method="post">
					<h5 class="form-header"> Añadir Banco </h5>
					<div class="form-desc"> Ingrese los datos del Banco </div>
					<div class="row">
						<div class="col-sm-6">
						<div class="form-group">
								<label for="">Nombre Banco</label><input autocomplete="off" class="form-control" placeholder="Nombre banco" type="text" name="banco" id="banco">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Empresa Asociada</label>
								<a href="#" id="midtipopro" data-toggle="modal" data-target="#modal_general" onclick="modaledit(this.id);"><i class="typcn typcn-plus"></i></a>
								<select class="form-control select2" name="id_empresa" id="id_empresa">
									<?php foreach ($empresas as $empresa) { ?>							
									<option value="<?php echo $empresa->id_empresa;?>"><?php echo $empresa->empresa;?></option>
									<?php } ?>
								</select>
							</div>						
						</div>						
					</div>	
					<div class="row">
						<div class="col-sm-6">
						<div class="form-group">
								<label for="">Cuenta soles</label><input autocomplete="off" class="form-control" placeholder="Num. Cuenta en soles" type="text" name="cuenta_soles" id="cuenta_soles">
							</div>
						</div>
						<div class="col-sm-6">
						<div class="form-group">
								<label for="">Cuenta Dólares</label><input autocomplete="off" class="form-control" placeholder="Num. Cuenta en dólares" type="text" name="cuenta_dolares" id="cuenta_dolares">
							</div>
						</div>											
					</div>		
					<div class="row">
						<div class="col-sm-5">
						<div class="form-group">
								<label for="">Monto soles</label><input autocomplete="off" class="form-control" placeholder="Total Soles" type="text" name="monto_soles" id="monto_soles">
							</div>
						</div>
						<div class="col-sm-5">
						<div class="form-group">
								<label for="">Monto Dólares</label><input autocomplete="off" class="form-control" placeholder="Total dólares" type="text" name="monto_dolares" id="monto_dolares">
							</div>
						</div>	
						<div class="col-sm-2">
						<div class="form-group">
								<label for="">Tipo de cambio</label><input autocomplete="off" class="form-control" placeholder="Tipo de cambio" type="text" name="cambio" id="cambio">
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
		$("form[name='add_banco']").submit(function(e) {
			var formData = new FormData($(this)[0]);
			$.ajax({
				
				url: "<?php echo base_url('banco/banco_add'); ?>",
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
						window.location.href="<?php echo base_url('banco' ); ?>/";
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