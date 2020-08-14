<div class="pull-right">
	<a href="<?php echo site_url('entrada_stock_vivo/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>ID</th>
		<th>Cantidad</th>
		<th>Fecha</th>
		<th>Usuario</th>
		<th>Actions</th>
    </tr>
	<?php foreach($entrada_stock_vivo as $e){ ?>
    <tr>
		<td><?php echo $e['id']; ?></td>
		<td><?php echo $e['cantidad']; ?></td>
		<td><?php echo $e['fecha']; ?></td>
		<td><?php echo $e['usuario']; ?></td>
		<td>
            <a href="<?php echo site_url('entrada_stock_vivo/edit/'.$e['id']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('entrada_stock_vivo/remove/'.$e['id']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>
