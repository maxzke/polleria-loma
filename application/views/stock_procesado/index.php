<div class="pull-right">
	<a href="<?php echo site_url('stock_procesado/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>ID</th>
		<th>Categoria</th>
		<th>Kilos</th>
		<th>Lote</th>
		<th>Cantidad</th>
		<th>Actions</th>
    </tr>
	<?php foreach($stock_procesado as $s){ ?>
    <tr>
		<td><?php echo $s['id']; ?></td>
		<td><?php echo $s['categoria']; ?></td>
		<td><?php echo $s['kilos']; ?></td>
		<td><?php echo $s['lote']; ?></td>
		<td><?php echo $s['cantidad']; ?></td>
		<td>
            <a href="<?php echo site_url('stock_procesado/edit/'.$s['id']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('stock_procesado/remove/'.$s['id']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>
