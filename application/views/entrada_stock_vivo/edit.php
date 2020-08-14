<?php echo form_open('entrada_stock_vivo/edit/'.$entrada_stock_vivo['id'],array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="cantidad" class="col-md-4 control-label"><span class="text-danger">*</span>Cantidad</label>
		<div class="col-md-8">
			<input type="text" name="cantidad" value="<?php echo ($this->input->post('cantidad') ? $this->input->post('cantidad') : $entrada_stock_vivo['cantidad']); ?>" class="form-control" id="cantidad" />
			<span class="text-danger"><?php echo form_error('cantidad');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="fecha" class="col-md-4 control-label">Fecha</label>
		<div class="col-md-8">
			<input type="text" name="fecha" value="<?php echo ($this->input->post('fecha') ? $this->input->post('fecha') : $entrada_stock_vivo['fecha']); ?>" class="form-control" id="fecha" />
		</div>
	</div>
	<div class="form-group">
		<label for="usuario" class="col-md-4 control-label">Usuario</label>
		<div class="col-md-8">
			<input type="text" name="usuario" value="<?php echo ($this->input->post('usuario') ? $this->input->post('usuario') : $entrada_stock_vivo['usuario']); ?>" class="form-control" id="usuario" />
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>
	
<?php echo form_close(); ?>