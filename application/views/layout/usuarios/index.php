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
                            
                            <div class="box-body">
                            <a href="<?php echo site_url('usuarios/nuevo'); ?>" class="btn btn-primary btn-sm mt-2">
                            <i class="fas fa-user-plus"></i> Agregar Nuevo
                            </a> 
                                <table id="table-usuarios" class="table table-striped table-hover table-sm dt-responsive mt-2">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($usuarios as $t){ ?>
                                    <tr>
                                        <td><?php echo $t['id']; ?></td>
                                        <td><?php echo $t['name']; ?></td>
                                        <td>
                                            <a href="<?php echo site_url('usuarios/edit/'.$t['id']); ?>">
                                            <i class="fas fa-user-edit text-warning"></i></a> 
                                            <a href="<?php echo site_url('usuarios/remove/'.$t['id']); ?>">
                                            <i class="fas fa-user-times ml-3 text-danger"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>   

                                        
                            </div>
                        </div>
                    </div>
                </div>
                        <!-- /.row -->
                        

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
    
  

  
