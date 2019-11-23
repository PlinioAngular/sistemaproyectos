<script>
$(function(){
	var disCuenta  = Array();
            
			<?php foreach ($cuentas as $cuenta) { ?>	
				disCuenta.push(
                  { label: "<?php echo $cuenta->cuenta.'_'.$cuenta->descripcion; ?>", value: "<?php echo $cuenta->id_cuenta; ?>" }
                  
               );
            <?php } ?>  
            $( "#cuenta" ).autocomplete({
               minLength: 0,
               source: disCuenta,
               focus: function( event, ui ) {
                  $( "#cuenta" ).val( ui.item.label );
                     return false;
               },
               select: function( event, ui ) {
				   var cuenta=ui.item.label;
				   var split=cuenta.split('_');
				   var id=split[0];
				   var desc=split[1];
                  $( "#cuenta" ).val( id );
				  $("#cuenta_id").val(ui.item.value);
				  $("#cuenta_descripcion").val(desc);
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
<div class="container-fluid" >
    <!-- Page Heading -->
    <div class="content-box">
	<div class="row">
		<div class="col-lg-12">
			<div class="element-wrapper">
				
				<div class="element-box">
				<form  id="edit_compra_venta" name="edit_compra_venta" accept-charset="utf-8" enctype="multipart/form-data" method="post" >
					<h5 class="form-header"> Añadir Registro </h5><input type="hidden" name="id_compra_venta" value="<?php echo $compraventa->id_compra_venta; ?>">
					<div class="row">						
						<div class="col-sm-3">
						<div class="form-group">
								<label for=""><b>Tipo de Registro</b></label>
								<select class="form-control form-control-sm select2" name="tipo_registro" id="tipo_registro">
									<option value="<?php echo $compraventa->tipo_registro; ?>"><?php echo $compraventa->tipo_registro; ?></option>
									<option value="VENTA">VENTA</option>
									<option value="COMPRA">COMPRA</option>
								</select>
							</div>
						</div>						
					</div><hr>
                    <div class="row">
						
						<div class="col-sm-5">
						<div class="form-group">
								<label for=""><b>Tipo de Operación</b></label>
								<select class="form-control form-control-sm select2" name="tipo_operacion" id="tipo_operacion">
									<option value="<?php echo $compraventa->id_tipo_operacion; ?>"><?php echo $compraventa->tipo_operacion; ?></option>
									<?php foreach($operaciones as $operacion) { ?>
									<option value="<?php echo $operacion->id_tipo_operacion; ?> "><?php echo $operacion->tipo_operacion; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
                        <div class="col-sm-3">
						<div class="form-group">
								<label for=""><b>CUO</b></label>
								<input class="form-control form-control-sm" placeholder="CUO" name="cuo" id="cuo" value="<?php echo $compraventa->cuo; ?>">
							</div>
						</div>
                        <div class="col-sm-2">
						<div class="form-group">
								<label for=""><b>Periodo</b></label>
								<input class="form-control form-control-sm" name="periodo" id="periodo" placeholder="Periodo" value="<?php echo $compraventa->periodo; ?>">
							</div>
						</div>
						
					</div><hr>
					<div class="row">						
                    <div class="col-sm-3">
						<div class="form-group">
								<label for=""><b>Fecha de Registro</b></label><input class="form-control form-control-sm" type="date" name="fecha_registro" id="fecha_registro" value="<?php echo date('Y-m-d',strtotime($compraventa->fecha_registro)); ?>">
							</div>
						</div>	
						<div class="col-sm-3">
						<div class="form-group">
								<label for=""><b>Fecha de Emisión</b></label><input  class="form-control form-control-sm" type="date" name="fecha_emision" id="fecha_emision" value="<?php echo date('Y-m-d',strtotime($compraventa->fecha_emision)); ?>">
							</div>
						</div>
                        <div class="col-sm-3">
						<div class="form-group">
								<label for=""><b>Fecha de Vencimiento</b></label><input  class="form-control form-control-sm" type="date" name="fecha_vencimiento" id="fecha_vencimiento" value="<?php echo date('Y-m-d',strtotime($compraventa->fecha_vencimiento)); ?>">
							</div>
						</div>				
					</div>	
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for=""><b>Razon Social</b></label><input type ="hidden" id="id_empresa" name="id_empresa">
								<a href="#" id="midtipopro" data-toggle="modal" data-target="#modal_general" onclick="modaledit(this.id);"><i class="fa fa-plus-square"></i></a>
								<input class="form-control form-control-sm" name="razon_social" id="razon_social" placeholder="Razon Social" value="<?php echo $compraventa->empresa; ?>">
								
							</div>		
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label for=""><b>RUC</b></label>
								<input class="form-control form-control-sm" name="ruc" id="ruc" placeholder="RUC">
							</div>		
						</div>	
					</div>
					<div class="row">
                        <div class="col-sm-5">
						    <div class="form-group">
								<label for=""><b>Tipo de documento</b></label>
								<select class="form-control form-control-sm select2" name="comprobante" id="comprobante">
									<option value="<?php echo $compraventa->id_comprobante; ?>"><?php echo $compraventa->comprobante; ?></option>
									<?php foreach($comprobantes as $comprobante) { ?>
									<option value="<?php echo $comprobante->id_comprobante; ?> "><?php echo $comprobante->comprobante; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label for=""><b>Serie</b></label>
								<input class="form-control form-control-sm" name="serie" id="serie" placeholder="Serie" value="<?php echo $compraventa->serie; ?>">
							</div>		
						</div>	
                        <div class="col-sm-4">
							<div class="form-group">
								<label for=""><b>Número</b></label>
								<input class="form-control form-control-sm" name="numero" id="numero" placeholder="Número" value="<?php echo $compraventa->numero; ?>">
							</div>		
						</div>	                      
															
					</div>		
                    <div class="row">
                        <div class="col-sm-3">
							<div class="form-group">
								<label for=""><b>Moneda</b></label>
								<select class="form-control form-control-sm select2" name="moneda" id="moneda">
									<option value="<?php echo $compraventa->moneda; ?>"><?php echo $compraventa->moneda; ?></option>
									<option value="SOLES">SOLES</option>
									<option value="DOLARES">DÓLARES</option>
								</select>
							</div>
						</div>
                        <div class="col-sm-3">
							<div class="form-group">
								<label for=""><b>Tipo de Cambio</b></label>
								<input class="form-control form-control-sm" name="tipo_cambio" id="tipo_cambio" placeholder="Tipo de Cambio" value="<?php echo $compraventa->tipo_cambio; ?>">
							</div>		
						</div>	

                    </div>
                    <div class="row">
                        <div class="col-sm-3">
							<div class="form-group">
								<label for=""><b>Sub total</b></label>
								<input class="form-control form-control-sm" placeholder="Sub total" name="sub_total" id="sub_total" value="<?php echo $compraventa->sub_total; ?>">
							</div>		
						</div>	
                        <div class="col-sm-3">
							<div class="form-group">
								<label for=""><b>IGV</b></label>
								<input class="form-control form-control-sm" name="igv" id="igv" placeholder="IGV" value="<?php echo $compraventa->igv; ?>">
							</div>		
						</div>	
                        <div class="col-sm-3">
							<div class="form-group">
								<label for=""><b>No Gravada</b></label>
								<input class="form-control form-control-sm" name="gravada" id="gravada" placeholder="Gravada" value="<?php echo $compraventa->gravada; ?>">
							</div>		
						</div>	
                        <div class="col-sm-3">
							<div class="form-group">
								<label for=""><b>ISC</b></label>
								<input class="form-control form-control-sm" name="isc" id="isc" placeholder="ISC" value="<?php echo $compraventa->isc; ?>">
							</div>		
						</div>	
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
							<div class="form-group">
								<label for=""><b>Total</b></label>
								<input class="form-control form-control-sm" name="total" id="total" placeholder="Total" value="<?php echo $compraventa->total; ?>">
							</div>		
						</div>
                        <div class="col-sm-8">
							<div class="form-group">
								<label for=""><b>Glosa</b></label>
								<input class="form-control form-control-sm" name="glosa" id="glosa" placeholder="Glosa" value="<?php echo $compraventa->glosa; ?>">
							</div>		
						</div>
                    </div><hr>
					<div class="row">
                        <div class="col-sm-3">
							<div class="form-group">
								<label for=""><b>N° de Detracción</b></label>
								<input class="form-control form-control-sm" name="num_detraccion" id="num_detraccion" placeholder="Número detracción" value="<?php echo $compraventa->numero_detraccion; ?>">
							</div>		
						</div>	
                        <div class="col-sm-3">
						    <div class="form-group">
								<label for=""><b>Fecha de Detracción</b></label><input value="<?= date('Y-m-d',strtotime($compraventa->fecha_detraccion))?>" class="form-control form-control-sm" type="date" name="fecha_detraccion" id="fecha_detraccion">
							</div>
						</div>
                        <div class="col-sm-3">
							<div class="form-group">
								<label for=""><b>Cod. Detracción</b></label>
								<input class="form-control form-control-sm" name="cod_detraccion" id="cod_detraccion" placeholder="Cod. Detracción" value="<?php echo $compraventa->codigo_detraccion; ?>">
							</div>		
						</div>
                        <div class="col-sm-3">
							<div class="form-group">
								<label for=""><b>Monto Detracción</b></label>
								<input class="form-control form-control-sm" name="monto_detraccion" id="monto_detraccion" placeholder="Monto Detracción" value="<?php echo $compraventa->monto_detraccion; ?>">
							</div>		
						</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-2">
							<div class="form-group">
								<label for=""><b>Código cuenta</b></label><input type="hidden" id="cuenta_id">
								<input id="cuenta" class="form-control form-control-sm" name="cuenta" placeholder="Cuenta">
							</div>		
						</div>
                        <div class="col-sm-4">
							<div class="form-group">
								<label for=""><b>Descripción Cuenta</b></label>
								<input id="cuenta_descripcion" class="form-control form-control-sm" name="cuenta_descripcion" placeholder="Descripción Cuenta">
							</div>		
						</div>
                        <div class="col-sm-1">
							<div class="form-group">
								<label for=""><b>D/H</b></label>
								<select id="debe_haber" class="form-control form-control-sm">
									<option value="DEBE">DEBE</option>
									<option value="HABER">HABER</option>
								</select>
							</div>		
						</div>
                        <div class="col-sm-2">
							<div class="form-group">
								<label for=""><b>Importe</b></label>
								<input id="importe" class="form-control form-control-sm" placeholder="Importe" name="importe">
							</div>		
						</div>
                        <div class="col-sm-2">
							<div class="form-group">
								<label for=""><b>Centro Costo</b></label>
								<input class="form-control form-control-sm" placeholder="Centro Costo" name="centro_costo" id="centro_costo">
							</div>		
						</div>
						<div class="col-sm-1">
							<div class="form-group">
							<label for="">&nbsp;</label>
                            <button id="btn-agregar" type="button" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span></button></div>
						</div>
                    </div>
					<div class="row" id="detalle_egreso">
						<div class="col-sm-9">
							<table id="dataTable12" style="display: block;overflow-x: auto;" class="dataTable table table-bordered table table-hover table-reponsive" width="100px">
								<thead>
									<tr>               
										<th>#</th>
										<th>Cuenta</th>
										<th>Descripcion</th>
										<th>Debe</th>
										<th>Haber</th>   
									</tr>
								</thead>
								<tbody>	
                                <?php foreach($detalles as $detalle){ ?>
                                    <tr id="filadatos" class="filadatos table">
                                    <td> #<input type="hidden" name="id_detalle_compra_venta[]" value="<?php echo $detalle->id_detalle_compra_venta; ?>"></td>
                                    <td> <input id="id_cuenta" name="id_cuenta[]" type="hidden" value="<?php echo $detalle->id_cuenta; ?>"><?php echo $detalle->cuenta; ?></td>
                                    <td> <?php echo $detalle->descripcion; ?></td>
                                    <td> <input id="debe" name="debe[]" type="hidden" value="<?php echo $detalle->debe; ?>"><?php echo $detalle->debe; ?></td>
                                    <td> <input id="haber" name="haber[]" type="hidden" value="<?php echo $detalle->haber; ?>"><?php echo $detalle->haber; ?></td>  
                                    <td> <button id="borrar" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i> </button></td>
                                    </tr>
                                <?php } ?>						
									
								</tbody>	
							</table>
						</div>	
                        <div class="col-sm-3">
							<div class="form-group">
								<input class="form-control form-control-sm" placeholder="RUC">
							</div>		
						</div>						
					</div>			<hr>										
					<div class="form-buttons-w">
						<button class="btn btn-primary" type="submit" id="grabar"> Guardar - Grabar</button>
						
						<input  id="errormsg" name="errormsg" value="" type="hidden" hidden="" readonly="">
					</div>
				</form><hr>
				</div>
			</div>
		</div>
	</div>
</div> 
</div>
<script>
$(document).ready(function() {
	$("form[name='edit_compra_venta']").submit(function(e) {
			var formData = new FormData($(this)[0]);
			$.ajax({
				
				url: "<?php echo base_url('contabilidad/compra_edit'); ?>",
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
						window.location.href="<?php echo base_url('contabilidad' ); ?>/";
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
$(function(){
	$('#sub_total').inputmask('Regex', {regex: "^[0-9]{1,15}(\\.\\d{1,2})?$"});
});
$(document).on("click","#borrar", function(){
        $(this).closest("tr").remove();
    });
	$("#btn-agregar").on('click',function(){
		agregar2();
	});
	 function agregar2() {
		 var id_cuenta=$("#cuenta_id").val();
		 var importe_debe=0;
		 var importe_haber=0;
		 var cuenta=$("#cuenta").val();
		 var descripcion_cuenta=$("#cuenta_descripcion").val();
		 var debe_haber=$("#debe_haber").val();
		 if(debe_haber=="DEBE"){
			importe_debe=$("#importe").val();
		 }else if (debe_haber=="HABER"){
			importe_haber=$("#importe").val();
		 }
		 
    var tbody = $('#dataTable12 tbody'); 
    
   var fila_contenido ;
   //Agregar fila nueva. 
   
      var fila_nueva = $('<tr id="filadatos" class="filadatos table">'+
	  '<td> #</td>'+
	  '<td> <input id="id_cuenta" name="id_cuenta[]" type="hidden" value="'+id_cuenta+'">'+cuenta+'</td>'+
	  '<td> '+descripcion_cuenta+'</td>'+
	  '<td> <input id="debe" name="debe[]" type="hidden" value="'+importe_debe+'">'+importe_debe+'</td>'+
	  '<td> <input id="haber" name="haber[]" type="hidden" value="'+importe_haber+'">'+importe_haber+'</td>'+	  
	  '<td> <button id="borrar" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i> </button></td>'+
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
