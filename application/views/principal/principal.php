<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="row">
              <div class="col col-sm-10"></div>
                <div class="col col-sm-2">
                <a class="btn btn-primary" href="<?php echo base_url(); ?>welcome/registrar">Nuevo Proyecto</a>
                </div>
                </div>
            <div class="card-body">
              
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Código</th>
                      <th>Cliente</th>
                      <th>Gerencia</th>
                      <th>Área</th>
                      <th>Sub Área</th>
                      <th>Tipo de Actividad</th>   
                      <th>Acciones</th>                    
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Nombre</th>
                      <th>Código</th>
                      <th>Cliente</th>
                      <th>Gerencia</th>
                      <th>Área</th>
                      <th>Sub Área</th>
                      <th>Tipo de Actividad</th>   
                      <th>Acciones</th>   
                      
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php foreach($datos as $dato) { ?>
                    <tr>
                      <td><?php echo $dato->nombre_proyecto; ?></td>
                      <td><?php echo $dato->codigo_proyecto; ?></td>
                      <td><?php echo $dato->cliente; ?></td>
                      <td><?php echo $dato->gerencia; ?></td>
                      <td><?php echo $dato->area; ?></td>
                      <td><?php echo $dato->sub_area; ?></td>
                      <td><?php echo $dato->tipo_actividad; ?></td>
                      <td><button aria-expanded="false" aria-haspopup="true" class="btn btn dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton1" type="button">Opción</button>
			<div aria-labelledby="dropdownMenuButton1" class="dropdown-menu">
			<a class="dropdown-item" href="<?php echo base_url('welcome/edit/').$dato->id_proyecto; ?>" >Editar</a><a class="dropdown-item" href="#">Dar de Baja</a>
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