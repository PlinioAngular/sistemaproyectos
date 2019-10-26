<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Listado de Empresas</h1>
    <p class="mb-4">La presente tabla muestra los datos de las distintas empresas dentro del <a target="_blank" href="http://sistemas.sattelital.com.pe/">Grupo Satelital</a> con opciones a registrar, editar y dar de baja.<a target="_blank" href="https://datatables.net"></a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Grupo Satelital</h6>
            </div><hr>
            <div class="row">
              <div class="col col-sm-10"></div>
                <div class="col col-sm-2">
                <a class="btn btn-primary" href="<?php echo base_url(); ?>empresa/registrar">Agregar Empresa</a>
                </div>
                </div>
            <div class="card-body">
              
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Área</th>                        
                      <th>Acciones</th>                    
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Área</th>                     
                      <th>Acciones</th>   
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php foreach($datos as $dato) { ?>
                    <tr>
                      <td><?php echo $dato->id_empresa; ?></td>
                      <td><?php echo $dato->empresa; ?></td>
                      <td><button aria-expanded="false" aria-haspopup="true" class="btn btn dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton1" type="button">Opción</button>
			<div aria-labelledby="dropdownMenuButton1" class="dropdown-menu">
			<a class="dropdown-item" href="<?php echo base_url('empresa/edit/').$dato->id_empresa; ?>" >Editar</a><a class="dropdown-item" href="#">Dar de Baja</a>
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