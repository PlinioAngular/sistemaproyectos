<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/jszip.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/xlsx.js"></script>
<script>
    var ExcelToJSON = function() {
        
      $('#dataTable12').dataTable().fnClearTable();
    $('#dataTable12').dataTable().fnDestroy();
        var hoja=$("#hoja").val();
        var total;
      this.parseExcel = function(file) {
        var reader = new FileReader();

        reader.onload = function(e) {
          var data = e.target.result;
          var workbook = XLSX.read(data, {
            type: 'binary'
          });
            // Here is your object
            var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[hoja]);
            var json_object = JSON.stringify(XL_row_object);
            total=JSON.parse(json_object);
            console.log(total.length);
            jQuery( '#xlx_json' ).val( json_object );
            for(var i=0;i<total.length -1 ;i++){
                agregar(total[i].Fecha,total[i].RUC,total[i].Comprobante,total[i].Serie,
                total[i].Numero,total[i].Descripcion,total[i].Cant,total[i].Precio,total[i].Total);
            }
         
        };

        reader.onerror = function(ex) {
          console.log(ex);
        };

        reader.readAsBinaryString(file);
      };
      
      
      
  };

  function handleFileSelect(evt) {
    
    var files = evt.target.files; // FileList object
    var xl2json = new ExcelToJSON();
    xl2json.parseExcel(files[0]);
  }


 
</script>
<div class="row">
<form enctype="multipart/form-data">
    <input id="upload" type=file  name="files[]">
    <input id="hoja" name="hoja" type="text" placeholder="Hoja">
</form>
</div>
<div class="row">
    <div class="col-sm-12">
        <textarea class="form-control" rows=20 id="xlx_json"></textarea>
    </div>
</div>
<div class="col-sm-12">
    <table id="dataTable12" style="display: block;overflow-x: auto;" class="dataTable table table-bordered table table-hover table-reponsive" width="100px">
		<thead>
			<tr>               
				<th>Fecha</th>
				<th>Periodo</th>
				<th>RUC</th>
				<th>Comprobante</th>
				<th>Serie</th>
				<th>Número</th>
				<th>Proyecto</th>
				<th>Clasificación</th>
				<th>Tipo de Actividad</th>
				<th>Descripción</th>
				<th>Cantidad</th>
				<th>Precio</th>
				<th>Total</th>
				<th></th>            
			</tr>
		</thead>
		<tbody>						
									
		</tbody>	
		</table>
</div>


    <script>
    document.getElementById('upload').addEventListener('change', handleFileSelect, false);
   
        
        function agregar(fecha,ruc,comprobante,serie,numero,descripcion,cantidad,precio,total) {
    var tbody = $('#dataTable12 tbody'); 
    
   var fila_contenido ;
   //Agregar fila nueva. 
   
      var fila_nueva = $('<tr id="filadatos" class="filadatos table">'+
	  '<td> <input name="fechas[]" type="date" value="10/10/2019"></td>'+
	  '<td> <input name="periodos[]" value="" placeholder="Periodo"></td>'+
	  '<td> <input name="ruc[]" value="'+ruc+'" placeholder="RUC"></td>'+
	  '<td> <select name="comprobantes[]"><option>'+comprobante+'</option>'+
	'<?php foreach($comprobantes as $comprobante){ ?><option value="<?php echo $comprobante->id_comprobante; ?>"><?php echo $comprobante->comprobante; ?></option><?php } ?></select></td>'+
	  '<td> <input name="serie[]" value="'+serie+'" placeholder="Serie"></td>'+
	  '<td> <input name="numero[]" value="'+numero+'" placeholder="Número"></td>'+
	  '<td> <select name="proyectos[]"><option value=""></option>'+
      <?php foreach ($proyectos as $proyecto) { ?>							
									'<option value="<?php echo $proyecto->id_proyecto;?>"><?php echo $proyecto->nombre_proyecto;?></option>'+
									<?php } ?>'</select></td>'+
		'<td> <select name="clasificaciones[]"><option>Seleccione una clasificación</option>'+
		'<?php foreach($clasificaciones as $clasificacion){ ?><option value="<?php echo $clasificacion->id_clasificacion; ?>"><?php echo $clasificacion->clasificacion; ?></option><?php } ?></select></td>'+
		'<td> <select name="tipo_actividad[]"><option>Seleccione una tipo</option>'+
		'<?php foreach($tipos_actividad as $tipo_actividad){ ?><option value="<?php echo $tipo_actividad->id_tipo_actividad; ?>"><?php echo $tipo_actividad->tipo_actividad; ?></option><?php } ?></select></td>'+
		'<td> <input autocomplete="off" name="detalles[]" value="'+fecha+'" placeholder="Detalle" ></td>'+
	  '<td> <input id="cantidad" name="cantidad[]" value="'+cantidad+'" placeholder="Cantidad"><p hidden="hidden"></p></td>'+
	  '<td> <input id="precio" name="precio[]" value="'+precio+'" placeholder="Precio"><p hidden="hidden"></p></td>'+
	  '<td> <p>'+total+'</p></td>'+  
	  
	  '<td> <a href="#" id="borrar" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i> </a></td>'+
	  '</tr>');
      fila_nueva.append(fila_contenido); 
      tbody.append(fila_nueva); 
    
}

    </script>