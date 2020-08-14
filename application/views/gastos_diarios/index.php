    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid"> 
        <!-- Main content -->
        <section class="container-fluid">
            <div class="container-fluid">
                <!-- CONTENIDO PAGINA -->
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Main content -->
                    <section class="content">
                    <div class="container-fluid">
                        
                        <div class="row">
                            <div class="col-md-10 mx-auto bg-white">
                                <div class="box">
                                    <div class="box-header">
                                        <a href="<?php echo site_url('gastos_diarios/add'); ?>" class="btn btn-sm btn-success my-3">Agregar Nuevo</a>
                                    </div>
                                    <div class="box-body">
                                        <table id="table-gastos" class="table table-sm table-striped dt-responsive">
                                            <thead class="thead-dark">
                                                <th>ID</th>
                                                <th>Importe</th>
                                                <th>Descripcion</th>
                                                <th>Fecha</th>
                                                <th>Usuario</th>
                                                <th>Actions</th>
                                            </thead>
                                            <?php foreach($gastos_diarios as $g){ ?>
                                            <tr>
                                                <td><?php echo $g['id']; ?></td>
                                                <td><?php echo $g['importe']; ?></td>								
                                                <td><?php echo $g['descripcion']; ?></td>
                                                <td><?php echo $g['fecha']; ?></td>
                                                <td><?php echo $g['usuario']; ?></td>
                                                <td>
                                                    <a href="<?php echo site_url('gastos_diarios/edit/'.$g['id']); ?>" class="btn btn-warning btn-sm"><span class="fa fa-pencil"></span> Editar</a> 
                                                    <a href="<?php echo site_url('gastos_diarios/remove/'.$g['id']); ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span> Eliminar</a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </table>
                                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                    </div><!-- /.container-fluid -->
                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->

                <!-- /CONTENIDO PAGINA -->
            </div><!-- /.container -->
        </section><!-- /.content -->
        <!-- /Main content -->
    </div><!-- /.content-wrapper -->
    
  

  
