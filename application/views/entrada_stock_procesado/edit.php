<?php echo form_open('entrada_stock_procesado/edit/'.$entrada_stock_procesado['id'],array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="categoria" class="col-md-4 control-label"><span class="text-danger">*</span>Categoria</label>
		<div class="col-md-8">
			<select name="categoria" class="form-control">
				<option value="">select</option>
				<?php 
				$categoria_values = array(
					'r3'=>'R3',
					'r4'=>'R4',
					'r5'=>'R5',
				);

				foreach($categoria_values as $value => $display_text)
				{
					$selected = ($value == $entrada_stock_procesado['categoria']) ? ' selected="selected"' : "";

					echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
				} 
				?>
			</select>
			<span class="text-danger"><?php echo form_error('categoria');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="kilos" class="col-md-4 control-label"><span class="text-danger">*</span>Kilos</label>
		<div class="col-md-8">
			<input type="text" name="kilos" value="<?php echo ($this->input->post('kilos') ? $this->input->post('kilos') : $entrada_stock_procesado['kilos']); ?>" class="form-control" id="kilos" />
			<span class="text-danger"><?php echo form_error('kilos');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="lote" class="col-md-4 control-label"><span class="text-danger">*</span>Lote</label>
		<div class="col-md-8">
			<input type="text" name="lote" value="<?php echo ($this->input->post('lote') ? $this->input->post('lote') : $entrada_stock_procesado['lote']); ?>" class="form-control" id="lote" />
			<span class="text-danger"><?php echo form_error('lote');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="cantidad" class="col-md-4 control-label">Cantidad</label>
		<div class="col-md-8">
			<input type="text" name="cantidad" value="<?php echo ($this->input->post('cantidad') ? $this->input->post('cantidad') : $entrada_stock_procesado['cantidad']); ?>" class="form-control" id="cantidad" />
			<span class="text-danger"><?php echo form_error('cantidad');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="fecha" class="col-md-4 control-label">Fecha</label>
		<div class="col-md-8">
			<input type="text" name="fecha" value="<?php echo ($this->input->post('fecha') ? $this->input->post('fecha') : $entrada_stock_procesado['fecha']); ?>" class="form-control" id="fecha" />
		</div>
	</div>
	<div class="form-group">
		<label for="usuario" class="col-md-4 control-label">Usuario</label>
		<div class="col-md-8">
			<input type="text" name="usuario" value="<?php echo ($this->input->post('usuario') ? $this->input->post('usuario') : $entrada_stock_procesado['usuario']); ?>" class="form-control" id="usuario" />
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>
	
<?php echo form_close(); ?>