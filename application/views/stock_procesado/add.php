<?php echo form_open('stock_procesado/add',array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="categoria" class="col-md-4 control-label">Categoria</label>
		<div class="col-md-8">
			<input type="text" name="categoria" value="<?php echo $this->input->post('categoria'); ?>" class="form-control" id="categoria" />
		</div>
	</div>
	<div class="form-group">
		<label for="kilos" class="col-md-4 control-label">Kilos</label>
		<div class="col-md-8">
			<input type="text" name="kilos" value="<?php echo $this->input->post('kilos'); ?>" class="form-control" id="kilos" />
		</div>
	</div>
	<div class="form-group">
		<label for="lote" class="col-md-4 control-label">Lote</label>
		<div class="col-md-8">
			<input type="text" name="lote" value="<?php echo $this->input->post('lote'); ?>" class="form-control" id="lote" />
		</div>
	</div>
	<div class="form-group">
		<label for="cantidad" class="col-md-4 control-label">Cantidad</label>
		<div class="col-md-8">
			<input type="text" name="cantidad" value="<?php echo $this->input->post('cantidad'); ?>" class="form-control" id="cantidad" />
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>

<?php echo form_close(); ?>