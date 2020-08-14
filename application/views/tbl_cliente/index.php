<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
    <div class="col-md-12">
        <div class="box">
            
            <div class="box-body">
                <table id="table-clientes" class="table table-striped table-sm dt-responsive">
                    <thead>
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
                            <a href="<?php echo site_url('tbl_cliente/edit/'.$t['id']); ?>" class="btn btn-info btn-sm"><span class="fa fa-pencil"></span> Editar</a> 
                            <a href="<?php echo site_url('tbl_cliente/remove/'.$t['id']); ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span> Borrar</a>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>$ Vivo</th>
                            <th>$ Aliñado</th>
                            <th>$ Procesado</th>
                            <th>Telefono</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
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
