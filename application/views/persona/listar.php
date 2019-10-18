<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables persona</h6>
            </div>
            <div class="row">
              <div class="col col-sm-10"></div>
                <div class="col col-sm-2">
                <a class="btn btn-primary" href="<?php echo base_url(); ?>persona/registrar">Agregar persona</a>
                </div>
                </div>
            <div class="card-body">
              
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Apellidos</th>  
                      <th>Nombres</th>
                      <th>DNI</th>                                
                      <th>Acciones</th>                    
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Apellidos</th>  
                      <th>Nombres</th>
                      <th>DNI</th>                                
                      <th>Acciones</th>  
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php foreach($datos as $dato) { ?>
                    <tr>
                      <td><?php echo $dato->id_persona; ?></td>
                      <td><?php echo $dato->apellido_paterno.' '.$dato->apellido_materno; ?></td>
                      <td><?php echo $dato->nombres; ?></td>
                      <td><?php echo $dato->dni; ?></td>
                      <td><button aria-expanded="false" aria-haspopup="true" class="btn btn dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton1" type="button">Opción</button>
			<div aria-labelledby="dropdownMenuButton1" class="dropdown-menu">
			<a class="dropdown-item" href="<?php echo base_url('persona/edit/').$dato->id_persona; ?>" >Editar</a><a class="dropdown-item" href="#">Dar de Baja</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="#">Eliminar</a>
			</div></td>
                    </tr>    
                  <?php } ?>                
                  </tbody>
                </table>
              </div>
        </div>
    </div>
</div>
</div>
</div>
</div>