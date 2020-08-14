<div class="pull-right">
	<a href="<?php echo site_url('stock_vivo/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>ID</th>
		<th>Cantidad</th>
		<th>Actions</th>
    </tr>
	<?php foreach($stock_vivo as $s){ ?>
    <tr>
		<td><?php echo $s['id']; ?></td>
		<td><?php echo $s['cantidad']; ?></td>
		<td>
            <a href="<?php echo site_url('stock_vivo/edit/'.$s['id']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('stock_vivo/remove/'.$s['id']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>
