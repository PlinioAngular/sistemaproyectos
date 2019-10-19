
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables area</h6>
            </div>
            <div class="row">
              <div class="col col-sm-10"></div>                
                </div>
            <form action="<?php echo base_url('rendicion/suma');?>"  id="add_rendicion" name="add_rendicion" accept-charset="utf-8" enctype="multipart/form-data" method="post">  
            <div class="row">
              <div class="col-sm-2">
							  <div class="form-group">
							  <label for="">&nbsp;</label>
                 <button id="btn-agregar" type="submit" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Sumar</button></div>
						  </div>
            </div>
            <div class="card-body">              
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Suma</th>
                      <th>Responsable</th>                        
                      <th>Total</th> 
                      <th>Rendir</th>                   
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Suma</th>
                      <th>Responsable</th>                        
                      <th>Total</th> 
                      <th>Rendir</th>    
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php foreach($datos as $dato) { ?>
                    <tr>
                      <td><input name="select[]" class="form-control" type="checkbox" onclick="$this.id_detalle_caja.value=20"  ><input type="hidden" name="id_detalle_caja[]" value="<?php echo $dato->id_detalle_caja; ?>"></td>
                      <td><?php echo $dato->apellido_paterno.' '.$dato->apellido_paterno.' '.$dato->nombres; ?></td>
                      <td><?php echo $dato->total; ?></td>
                      <td>
			                    <a href="<?php echo base_url('rendicion/registrar/').$dato->id_detalle_caja; ?>" class="btn btn-info btn-circle btn-sm">
                          <i class="fas fa-eye"></i>
                          </a>
			                </td>
                    </tr>    
                  <?php } ?>                
                  </tbody>
                </table>
              </div>
          </div>
          </form>
    </div>
</div>
</div>
</div>
</div>