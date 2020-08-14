<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
    <div class="col-md-12">
        <div class="box">
            
            <div class="box-body">
                <table id="table-usuarios" class="table table-striped table-sm dt-responsive">
                    <thead>
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
                            <a href="<?php echo site_url('usuarios/edit/'.$t['id']); ?>" class="btn btn-info btn-sm"><span class="fa fa-pencil"></span> Cambiar contraseña</a> 
                            <a href="<?php echo site_url('usuarios/eliminar/'.$t['id']); ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span> Eliminar</a>
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
