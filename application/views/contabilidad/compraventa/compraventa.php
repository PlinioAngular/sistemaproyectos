<script>
$(function(){
	var disCuenta  = Array();
	var disProyecto  = Array();
            
			<?php foreach ($cuentas as $cuenta) { ?>	
				disCuenta.push(
                  { label: "<?php echo $cuenta->cuenta.'_'.$cuenta->descripcion.'_'.$cuenta->centro_costo; ?>", value: "<?php echo $cuenta->id_cuenta; ?>" }
                  
               );
			<?php } ?> 
			<?php foreach ($proyectos as $proyecto) { ?>	
				disProyecto.push(
                  { label: "<?php echo $proyecto->centro_costo.'_'.$proyecto->nombre_proyecto; ?>", value: "<?php echo $proyecto->id_proyecto; ?>" }
                  
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
				   var cc=split[2];
				   if(cc=="SI"){
					document.getElementById("cc").style.visibility = "visible";
				   }
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
			
			$( "#centro_costo" ).autocomplete({
               minLength: 0,
               source: disProyecto,
               focus: function( event, ui ) {
                  $( "#centro_costo" ).val( ui.item.label );
                     return false;
               },
               select: function( event, ui ) {
				   var cuenta=ui.item.label;
				   
                  $( "#centro_costo" ).val( cuenta );
				  $("#cc_id").val(ui.item.value);
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
<script>
$(function(){
	$("#comprobante").select2();
});
</script>
<div class="container-fluid" style="background:#eef0f2;">
    <!-- Page Heading -->
    <div class="content-box">
	<div class="row">
		<div class="col-lg-12">
			<div class="element-wrapper">
				
				<div class="element-box">
				<form  id="add_compra_venta" name="add_compra_venta" accept-charset="utf-8" enctype="multipart/form-data" method="post" >
					<h5 class="form-header"> Añadir Registro </h5>
					<div class="row">						
						<div class="col-sm-3">
						<div class="form-group">
								<label for=""><b>Tipo de Registro</b></label>
								<select class="form-control form-control-sm select2" name="tipo_registro" id="tipo_registro">
									<option value="0">--Selecciones Tipo--</option>
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
									<option value="0">--Selecciones Tipo--</option>
									<?php foreach($operaciones as $operacion) { ?>
									<option value="<?php echo $operacion->id_tipo_operacion; ?> "><?php echo $operacion->tipo_operacion; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
                        <div class="col-sm-3">
						<div class="form-group">
								<label for=""><b>CUO</b></label>
								<input class="form-control form-control-sm" placeholder="CUO" name="cuo" id="cuo">
							</div>
						</div>
                        <div class="col-sm-2">
						<div class="form-group">
								<label for=""><b>Periodo</b></label>
								<input class="form-control form-control-sm" name="periodo" id="periodo" placeholder="Periodo">
							</div>
						</div>
						
					</div><hr>
					<div class="row">						
                    <div class="col-sm-3">
						<div class="form-group">
								<label for=""><b>Fecha de Registro</b></label><input value="<?= date('Y-m-d')?>" class="form-control form-control-sm" type="date" name="fecha_registro" id="fecha_registro">
							</div>
						</div>	
						<div class="col-sm-3">
						<div class="form-group">
								<label for=""><b>Fecha de Emisión</b></label><input value="<?= date('Y-m-d')?>" class="form-control form-control-sm" type="date" name="fecha_emision" id="fecha_emision">
							</div>
						</div>
                        <div class="col-sm-3">
						<div class="form-group">
								<label for=""><b>Fecha de Vencimiento</b></label><input value="<?= date('Y-m-d')?>" class="form-control form-control-sm" type="date" name="fecha_vencimiento" id="fecha_vencimiento">
							</div>
						</div>				
					</div>	
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for=""><b>Razon Social</b></label><input type ="hidden" id="id_empresa" name="id_empresa">
								<a href="#" id="midtipopro" data-toggle="modal" data-target="#modal_general" onclick="modaledit(this.id);"><i class="fa fa-plus-square"></i></a>
								<input class="form-control form-control-sm" name="razon_social" id="razon_social" placeholder="Razon Social">
								
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
									<option value="0">--Selecciones Tipo--</option>
									<?php foreach($comprobantes as $comprobante) { ?>
									<option value="<?php echo $comprobante->id_comprobante; ?> "><?php echo $comprobante->comprobante; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label for=""><b>Serie</b></label>
								<input class="form-control form-control-sm" name="serie" id="serie" placeholder="Serie">
							</div>		
						</div>	
                        <div class="col-sm-4">
							<div class="form-group">
								<label for=""><b>Número</b></label>
								<input class="form-control form-control-sm" name="numero" id="numero" placeholder="Número">
							</div>		
						</div>	                      
															
					</div>		
                    <div class="row">
                        <div class="col-sm-3">
							<div class="form-group">
								<label for=""><b>Moneda</b></label>
								<select class="form-control form-control-sm select2" name="moneda" id="moneda">
									<option value="0">--Selecciones moneda--</option>
									<option value="SOLES">SOLES</option>
									<option value="DOLARES">DÓLARES</option>
								</select>
							</div>
						</div>
                        <div class="col-sm-3">
							<div class="form-group">
								<label for=""><b>Tipo de Cambio</b></label>
								<input class="form-control form-control-sm" name="tipo_cambio" id="tipo_cambio" placeholder="Tipo de Cambio" value="1">
							</div>		
						</div>	

                    </div>
                    <div class="row">
                        <div class="col-sm-3">
							<div class="form-group">
								<label for=""><b>Sub total</b></label>
								<input class="form-control form-control-sm" placeholder="Sub total" name="sub_total" id="sub_total">
							</div>		
						</div>	
                        <div class="col-sm-3">
							<div class="form-group">
								<label for=""><b>IGV</b></label>
								<input class="form-control form-control-sm" name="igv" id="igv" placeholder="IGV" readonly="">
							</div>		
						</div>	
                        <div class="col-sm-3">
							<div class="form-group">
								<label for=""><b>No Gravada</b></label>
								<input class="form-control form-control-sm" name="gravada" id="gravada" placeholder="Gravada" value="0">
							</div>		
						</div>	
                        <div class="col-sm-3">
							<div class="form-group">
								<label for=""><b>Afecto a detracción</b></label>
								<input class="form-control form-control-sm" name="detraccion" id="detraccion" type="checkbox">
							</div>		
						</div>	
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
							<div class="form-group">
								<label for=""><b>Total</b></label>
								<input class="form-control form-control-sm" name="total" id="total" placeholder="Total" readonly="">
							</div>		
						</div>
                        <div class="col-sm-8">
							<div class="form-group">
								<label for=""><b>Glosa</b></label>
								<input class="form-control form-control-sm" name="glosa" id="glosa" placeholder="Glosa">
							</div>		
						</div>
                    </div><hr>
					<div class="row" id="detraccion_bloque" style="visibility:hidden; display:none;">
                        <div class="col-sm-3">
							<div class="form-group">
								<label for=""><b>N° de Detracción</b></label>
								<input class="form-control form-control-sm" name="num_detraccion" id="num_detraccion" placeholder="Número detracción">
							</div>		
						</div>	
                        <div class="col-sm-3">
						    <div class="form-group">
								<label for=""><b>Fecha de Detracción</b></label><input value="<?= date('Y-m-d')?>" class="form-control form-control-sm" type="date" name="fecha_detraccion" id="fecha_detraccion">
							</div>
						</div>
                        <div class="col-sm-3">
							<div class="form-group">
								<label for=""><b>Cod. Detracción</b></label>
								<input class="form-control form-control-sm" name="cod_detraccion" id="cod_detraccion" placeholder="Cod. Detracción">
							</div>		
						</div>
                        <div class="col-sm-3">
							<div class="form-group">
								<label for=""><b>Monto Detracción</b></label>
								<input class="form-control form-control-sm" name="monto_detraccion" id="monto_detraccion" placeholder="Monto Detracción">
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
								<input id="importe" class="form-control form-control-sm" placeholder="Importe" name="importe" value="0">
							</div>		
						</div>
                        <div class="col-sm-2" id="cc" style="visibility:hidden;">
							<div class="form-group">
								<label for=""><b>Centro Costo</b></label><input type="hidden" id="cc_id" name="cc_id">
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
									
								</tbody>	
							</table>
						</div>	
                        <div id="totales" class="col-sm-3" style="background:#d8e3fc;">
							Total debe:<p id="total_debe" value="e"></p>
							Total debe:<p id="total_haber"></p>
							Saldo:<p id="saldo"></p>
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
	$("form[name='add_compra_venta']").submit(function(e) {
			var formData = new FormData($(this)[0]);
			$.ajax({
				
				url: "<?php echo base_url('contabilidad/compra_add'); ?>",
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
	$("#sub_total").on('keyup',function(){
		var sub_total=$(this).val();
		var gravada=Number($("#gravada").val());
		var igv=0.18*sub_total;
		var total=(sub_total*1.18)+gravada;
		$("#igv").val(igv);
		$("#total").val(total);
	});
	$("#gravada").on('keyup',function(){
		var gravada=0;var sub_total=0;var igc=0;var total=0;
		gravada=Number($(this).val());
		sub_total=Number($("#sub_total").val());
		igv=Number($("#igv").val());
		total=gravada + sub_total + igv;
		$("#total").val(total);
	});
});
$(function(){
	$('#sub_total').inputmask('Regex', {regex: "^[0-9]{1,15}(\\.\\d{1,2})?$"});
	$('#gravada').inputmask('Regex', {regex: "^[0-9]{1,15}(\\.\\d{1,2})?$"});
});
$("#detraccion").on('click',function(){
      var porId=document.getElementById("detraccion").checked
       if(porId)
       {
		document.getElementById("detraccion_bloque").style.visibility = "visible"; 
		document.getElementById("detraccion_bloque").style.display = ""; 
       }
       else {
		document.getElementById("detraccion_bloque").style.visibility = "hidden";
		document.getElementById("detraccion_bloque").style.display = "none"; 
       }
      buscar();
         
     });
$(document).on("click","#borrar", function(){
        $(this).closest("tr").remove();
    });
	$("#btn-agregar").on('click',function(){
		agregar2();
		sumar();
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
	  '<td> <input id="debe" name="debe[]" type="hidden" value="'+importe_debe+'"><p>'+importe_debe+'</p></td>'+
	  '<td> <input id="haber" name="haber[]" type="hidden" value="'+importe_haber+'"><p>'+importe_haber+'</p></td>'+	  
	  '<td> <button id="borrar" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i> </button></td>'+
	  '</tr>');
      fila_nueva.append(fila_contenido); 
      tbody.append(fila_nueva);    
}
function sumar(){
	var total_debe=0;
	var total_haber=0;
	var saldo=0;
	$("#dataTable12 tbody tr").each(function(){
		total_debe=total_debe + Number($(this).find("td:eq(3)").children("p").text());
		total_haber=total_haber + Number($(this).find("td:eq(4)").children("p").text());
	});
	saldo=total_debe-total_haber;
	document.getElementById("total_debe").innerHTML=total_debe;
	document.getElementById("total_haber").innerHTML=total_haber;
	document.getElementById("saldo").innerHTML=saldo;
	if(saldo==0){
		document.getElementById("totales").style.background="#d8e3fc";
	}else{
		document.getElementById("totales").style.background="#f6b0b4";
	}
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
