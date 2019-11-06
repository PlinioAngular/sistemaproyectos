
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
								<label for="">Tipo de Registro</label>
								<select class="form-control select2" name="moneda" id="moneda">
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
								<label for="">Tipo de Registro</label>
								<select class="form-control select2" name="moneda" id="moneda">
									<option value="0">--Selecciones Tipo--</option>
									<option value="VENTA">VENTA</option>
									<option value="COMPRA">COMPRA</option>
								</select>
							</div>
						</div>
                        <div class="col-sm-3">
						<div class="form-group">
								<label for="">CUO</label>
								<select class="form-control select2" name="moneda" id="moneda">
									<option value="0">--Selecciones Tipo--</option>
									<option value="VENTA">VENTA</option>
									<option value="COMPRA">COMPRA</option>
								</select>
							</div>
						</div>
                        <div class="col-sm-2">
						<div class="form-group">
								<label for="">Periodo</label>
								<input class="form-control">
							</div>
						</div>
						
					</div><hr>
					<div class="row">						
                    <div class="col-sm-3">
						<div class="form-group">
								<label for="">Fecha de Registro</label><input autocomplete="off" class="form-control" type="date" name="fecha_nacimiento" id="fecha_nacimiento">
							</div>
						</div>	
						<div class="col-sm-3">
						<div class="form-group">
								<label for="">Fecha de Emisión</label><input autocomplete="off" class="form-control" type="date" name="fecha_nacimiento" id="fecha_nacimiento">
							</div>
						</div>
                        <div class="col-sm-3">
						<div class="form-group">
								<label for="">Fecha de Vencimiento</label><input autocomplete="off" class="form-control" type="date" name="fecha_nacimiento" id="fecha_nacimiento">
							</div>
						</div>				
					</div>	
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Razon Social</label>
								<a href="#" id="midtipopro" data-toggle="modal" data-target="#modal_general" onclick="modaledit(this.id);"><i class="fa fa-plus-square"></i></a>
								<input id = "responsable_id"class="form-control"><input type="hidden"name="id_responsable" id="id_responsable">
								
							</div>		
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label for="">RUC</label>
								<input class="form-control" placeholder="RUC">
							</div>		
						</div>	
					</div>
					<div class="row">
                        <div class="col-sm-5">
						    <div class="form-group">
								<label for="">Tipo de documento</label>
								<select class="form-control select2" name="moneda" id="moneda">
									<option value="0">--Selecciones Tipo--</option>
									<option value="VENTA">Factura</option>
									<option value="COMPRA">Boleta</option>
								</select>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label for="">Documento</label>
								<input class="form-control" placeholder="">
							</div>		
						</div>	
                        <div class="col-sm-4">
							<div class="form-group">
								<label for=""> .</label>
								<input class="form-control" placeholder="">
							</div>		
						</div>	                      
															
					</div>		
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
								<label for="">Tipo de Cambio</label>
								<input class="form-control" placeholder="">
							</div>		
						</div>	

                    </div>
                    <div class="row">
                        <div class="col-sm-3">
							<div class="form-group">
								<label for="">Sub total</label>
								<input class="form-control" placeholder="Sub total">
							</div>		
						</div>	
                        <div class="col-sm-3">
							<div class="form-group">
								<label for="">IGV</label>
								<input class="form-control" placeholder="IGV">
							</div>		
						</div>	
                        <div class="col-sm-3">
							<div class="form-group">
								<label for="">No Grabada</label>
								<input class="form-control" placeholder="">
							</div>		
						</div>	
                        <div class="col-sm-3">
							<div class="form-group">
								<label for="">ISC</label>
								<input class="form-control" placeholder="">
							</div>		
						</div>	

                    </div>
                    <div class="row">
                        <div class="col-sm-3">
							<div class="form-group">
								<label for="">Total</label>
								<input class="form-control" placeholder="total">
							</div>		
						</div>
                        <div class="col-sm-8">
							<div class="form-group">
								<label for="">Glosa</label>
								<input class="form-control" placeholder="">
							</div>		
						</div>
                    </div><hr>
                    <div class="row">
                        <div class="col-sm-2">
							<div class="form-group">
								<label for="">Código cuenta</label>
								<input class="form-control" placeholder="">
							</div>		
						</div>
                        <div class="col-sm-4">
							<div class="form-group">
								<label for="">Descripción Cuenta</label>
								<input class="form-control" placeholder="">
							</div>		
						</div>
                        <div class="col-sm-1">
							<div class="form-group">
								<label for="">D/H</label>
								<input class="form-control" placeholder="">
							</div>		
						</div>
                        <div class="col-sm-2">
							<div class="form-group">
								<label for="">Importe</label>
								<input class="form-control" placeholder="">
							</div>		
						</div>
                        <div class="col-sm-2">
							<div class="form-group">
								<label for="">Centro Costo</label>
								<input class="form-control" placeholder="">
							</div>		
						</div>
                    </div>
					<div class="row" id="detalle_egreso">
						<div class="col-sm-8">
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
                        <div class="col-sm-4">
							<div class="form-group">
								<input class="form-control" placeholder="RUC">
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
