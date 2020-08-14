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
                                    <a href="<?php echo site_url('clientes/nuevo'); ?>" class="btn btn-primary btn-sm mt-2">
                                    <i class="fas fa-user-plus"></i> Agregar Nuevo
                                    </a> 
                                        <table id="table-clientes" class="table table-bordered table-hover table-sm table-hover dt-responsive">
                                            <thead class="bg-dark text-white">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>$ Vivo</th>
                                                    <th>$ Aliñado</th>
                                                    <th>$ Procesado</th>
                                                    <th>Telefono</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($tbl_clientes as $t){ ?>
                                            <tr>
                                                <td><?php echo $t['id']; ?></td>
                                                <td><?php echo $t['nombre']; ?></td>
                                                <td><?php echo $t['precio_vivo']; ?></td>
                                                <td><?php echo $t['precio_alinado']; ?></td>
                                                <td><?php echo $t['precio_procesado']; ?></td>
                                                <td><?php echo $t['telefono']; ?></td>
                                                <td>
                                                    <!-- <a href="#">
                                                        <i class="fas fa-clipboard-list fa-lg text-primary detalles" data-id="<?php echo $t['id']; ?>"></i></a>  -->
                                                    <a href="<?php echo site_url('clientes/edit/'.$t['id']); ?>">
                                                        <i class="fas fa-user-edit fa-lg text-warning ml-3"></i></a> 
                                                    <a href="<?php echo site_url('clientes/remove/'.$t['id']); ?>">
                                                        <i class="fas fa-user-times fa-lg ml-3 text-danger"></i></a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>   

                                                
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.row -->
                        <!-- #-#-#-#-#-#-#-#-#-#--#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-  -->
                        <!-- ESTADOS DE CUENTA -->
                        
                        <!-- /ESTADOS DE CUENTA -->
                        

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
    
  

  
