<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-white">
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" id="app">

        <!-- Contenido -->

        
<div class="pull-right">
	<a href="<?php echo site_url('entrada_stock_procesado/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>ID</th>
		<th>Categoria</th>
		<th>Kilos</th>
		<th>Lote</th>
		<th>Cantidad</th>
		<th>Fecha</th>
		<th>Usuario</th>
		<th>Actions</th>
    </tr>
	<?php foreach($entrada_stock_procesados as $e){ ?>
    <tr>
		<td><?php echo $e['id']; ?></td>
		<td><?php echo $e['categoria']; ?></td>
		<td><?php echo $e['kilos']; ?></td>
		<td><?php echo $e['lote']; ?></td>
		<td><?php echo $e['cantidad']; ?></td>
		<td><?php echo $e['fecha']; ?></td>
		<td><?php echo $e['usuario']; ?></td>
		<td>
            <a href="<?php echo site_url('entrada_stock_procesado/edit/'.$e['id']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('entrada_stock_procesado/remove/'.$e['id']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>
<div class="pull-right">
    <?php echo $this->pagination->create_links(); ?>    
</div>

<!-- /Contenido -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
