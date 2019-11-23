<div class="container-fluid">
    <!-- Page Heading -->
    
    <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Grupo Satelital</h6>
    </div><hr>
            
    <div class="card-body">              
      <div class="row">
        <div class="col-sm-6" style="border-right: 2px solid black;">
          <div class="row">
            <div class="col col-sm-2">
              <button id="nuevo" class="btn btn-success">Nuevo</button>
            </div>
            <div class="col col-sm-2">
              <button id="modificar" class="btn btn-info">Modificar</button>
            </div>
            <div class="col col-sm-2">
              <button id="guardar" class="btn btn-primary fas fa-save"><span>Guardar</span></button>
            </div>
            <div class="col col-sm-2">
              <button id="cancelar" class="btn btn-danger far fa-window-close">Cancelar</button>
            </div>              
          </div><hr>                   
          <div class="row" >
            <div class="col-sm-11">
              <form id="cuenta_registro" name="cuenta_registro" accept-charset="utf-8" enctype="multipart/form-data" method="post" >                   
                <div class="row"><input type="hidden" name="id_cuenta" id="id_cuenta">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="">Cógido</label><input autocomplete="off" class="form-control form-control-sm form-control form-control-sm-sm" placeholder="Codigo:" type="text" name="cuenta" id="cuenta">
                    </div>
                  </div>	
                  <div class="col-sm-8">
                    <div class="form-group">
                      <label for="">Descripción</label><input autocomplete="off" class="form-control form-control-sm" placeholder="Cuenta:" type="text" name="descripcion" id="descripcion">
                    </div>
                  </div>	
                </div>
                <div class="row">					
                  <div class="col-sm-6" style="border:1px dotted blue;">
                    <label style="border:white;" for="">Destino Automático</label>
                    <div class="row" >
                      <div class="col-sm-12" >
                        <div class="form-group">
                          <label for="">Debe:</label><input autocomplete="off" class="form-control form-control-sm" placeholder="Debe" type="text" name="debe" id="debe">
                        </div>
                      </div>	
                    </div>
                    <div class="row">
                      <div class="col-sm-12" >
                        <div class="form-group">
                          <label for="">Haber:</label><input autocomplete="off" class="form-control form-control-sm" placeholder="Haber" type="text" name="haber" id="haber">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">.
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="">Situación:</label><input autocomplete="off" class="form-control form-control-sm" placeholder="Situación:" type="text" name="situacion" id="situacion">
                        </div>
                      </div>	
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="">Resultado</label><input autocomplete="off" class="form-control form-control-sm" placeholder="Resultado:" type="text" name="resultado" id="resultado">
                        </div>
                      </div>
                    </div>
                  </div>	
                </div><hr>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Nivel:</label><input autocomplete="off" class="form-control form-control-sm" placeholder="Nivel:" type="text" name="nivel" id="nivel">
                    </div>
                  </div>	
                  <div class="col-sm-3">Centro
                    <div class="form-group">
                      <label for="">SI</label>
                      <input  type="radio" name="centro_costo" id="centro_costo" value="SI"> 						
                    </div>
                  </div>
                  <div class="col-sm-3"> de Costo 
                    <div class="form-group">
                      <label for="">NO</label>
                      <input type="radio" name="centro_costo" id="centro_costo" checked="" value="NO">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Tipo:</label>
                      <input autocomplete="off" class="form-control form-control-sm" placeholder="Tipo:" type="text" name="tipo" id="tipo">
                    </div>
                  </div>
                  <div class="col-sm-3">Presupuesto
                    <div class="form-group">
                      <label for="">SI</label>
                      <input  type="radio" name="presupuesto" id="presupuesto" value="SI"> 						
                    </div>
                  </div>
                  <div class="col-sm-3"> . 
                    <div class="form-group">
                      <label for="">NO</label>
                      <input type="radio" name="presupuesto" id="presupuesto" checked="" value="NO">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Análisis:</label>
                      <input autocomplete="off" class="form-control form-control-sm" placeholder="Análisis:" type="text" name="analisis" id="analisis">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Cuenta cierre:</label>
                      <input autocomplete="off" class="form-control form-control-sm" placeholder="Cierre:" type="text" name="cierre" id="cierre">
                    </div>
                  </div>
                </div>											
                <div class="form-buttons-w">             
                  <input  id="errormsg" name="errormsg" value="" type="hidden" hidden="" readonly="">
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Cuenta</th> 
                  <th>Descripción</th>
                  <th>Seleccionar</th>                     
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>#</th>
                  <th>Cuenta</th>
                  <th>Descripción</th>
                  <th>Seleccionar</th>       
                </tr>
              </tfoot>                      
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>   
<script>
$(document).ready(function () {
  habilitar(true);
  botones(true);
 
$('#dataTable').DataTable({
        "ajax":{
          "type":"post",
          "url":"<?php echo base_url('cuenta/ajax'); ?> "
          },
          "scrollY":        '50vh',
        "scrollCollapse": true,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });
  
});

$(document).on("click","#ver", function(){
  var id_cuenta = $(this).closest("tr").find("td:eq(0)").text();
       var cuenta = $(this).closest("tr").find("td:eq(1)").text();
       var descripcion = $(this).closest("tr").find("td:eq(2)").text();
       var datos = $(this).closest("tr").find("td:eq(3)").text();
       var split=datos.split('_');
       $("#id_cuenta").val(id_cuenta);
       $("#cuenta").val(cuenta);
       $("#descripcion").val(descripcion);
       $("#cierre").val(split[0]);
       $("#debe").val(split[1]);
       $("#haber").val(split[2]);
       $("#tipo").val(split[3]);
       $("#analisis").val(split[4]);
       if(split[5]=="SI"){
        document.cuenta_registro.centro_costo[0].checked="true";
       }else{
        document.cuenta_registro.centro_costo[1].checked="true";
       }

       if(split[6]=="SI"){
        document.cuenta_registro.presupuesto[0].checked="true";
       }else{
        document.cuenta_registro.presupuesto[1].checked="true";
       }
       $("#nivel").val(split[7]);
       $("#situacion").val(split[8]);
       $("#resultado").val(split[9]);
       botones(true);
       habilitar(true);
       $('#nuevo').prop('disabled',true);
       $('#modificar').prop('disabled',false);
    });
    function limpiar(){
      $("#id_cuenta").val(null);
       $("#cuenta").val(null);
       $("#descripcion").val(null);
       $("#cierre").val(null);
       $("#debe").val(null);
       $("#haber").val(null);
       $("#tipo").val(null);
       $("#analisis").val(null);
        document.cuenta_registro.centro_costo[1].checked="true";
        document.cuenta_registro.presupuesto[1].checked="true";
       
       $("#nivel").val(null);
       $("#situacion").val(null);
       $("#resultado").val(null);
    }
    function habilitar(opcion){
      $("#id_cuenta").prop('disabled',opcion);
       $("#cuenta").prop('disabled',opcion);
       $("#descripcion").prop('disabled',opcion);
       $("#cierre").prop('disabled',opcion);
       $("#debe").prop('disabled',opcion);
       $("#haber").prop('disabled',opcion);
       $("#tipo").prop('disabled',opcion);
       $("#analisis").prop('disabled',opcion);
       $("#centro_costo").prop('disabled',opcion);
       $("#presupuesto").prop('disabled',opcion);       
       $("#nivel").prop('disabled',opcion);
       $("#situacion").prop('disabled',opcion);
       $("#resultado").prop('disabled',opcion);
    }

    function botones(condicion){
      $('#modificar').prop('disabled',condicion);
      $('#cancelar').prop('disabled',condicion);
      $('#nuevo').prop('disabled',!condicion);
      $('#guardar').prop('disabled',condicion);
    }
    
    $("#cancelar").on('click',function(){
      limpiar();      
      habilitar(true);
      botones(true);
    });
    $("#modificar").on('click',function(){    
      habilitar(false);
      botones(false);
      $('#nuevo').prop('disabled',true);
      $('#modificar').prop('disabled',true);
    });
    $("#nuevo").on('click',function(){      
      habilitar(false);
      limpiar();
      botones(false);
      $('#modificar').prop('disabled',true);
    });
    $("#guardar").on('click',function(){
      guardar();
      habilitar(true);
      limpiar();
      botones();
    });
    
    function guardar(){
      var formData = new FormData($("#cuenta_registro")[0]);
      var url="";
      if($("#id_cuenta").val()>0){
        url="<?php echo base_url('cuenta/cuenta_edit'); ?>";
      }
      else{
        url="<?php echo base_url('cuenta/cuenta_add'); ?>";
      }
			$.ajax({
				
				url: url,
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
						window.location.href="<?php echo base_url('cuenta' ); ?>/";
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