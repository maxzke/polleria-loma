<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Tbl Cliente Edit</h3>
            </div>
			<?php echo form_open('tbl_cliente/edit/'.$tbl_cliente['id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="nombre" class="control-label"><span class="text-danger">*</span>Nombre</label>
						<div class="form-group">
							<input type="text" name="nombre" value="<?php echo ($this->input->post('nombre') ? $this->input->post('nombre') : $tbl_cliente['nombre']); ?>" class="form-control" id="nombre" />
							<span class="text-danger"><?php echo form_error('nombre');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="precio_vivo" class="control-label">Precio Vivo</label>
						<div class="form-group">
							<input type="text" name="precio_vivo" value="<?php echo ($this->input->post('precio_vivo') ? $this->input->post('precio_vivo') : $tbl_cliente['precio_vivo']); ?>" class="form-control" id="precio_vivo" />
							<span class="text-danger"><?php echo form_error('precio_vivo');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="precio_alinado" class="control-label">Precio Alinado</label>
						<div class="form-group">
							<input type="text" name="precio_alinado" value="<?php echo ($this->input->post('precio_alinado') ? $this->input->post('precio_alinado') : $tbl_cliente['precio_alinado']); ?>" class="form-control" id="precio_alinado" />
							<span class="text-danger"><?php echo form_error('precio_alinado');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="precio_procesado" class="control-label">Precio Procesado</label>
						<div class="form-group">
							<input type="text" name="precio_procesado" value="<?php echo ($this->input->post('precio_procesado') ? $this->input->post('precio_procesado') : $tbl_cliente['precio_procesado']); ?>" class="form-control" id="precio_procesado" />
							<span class="text-danger"><?php echo form_error('precio_procesado');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="telefono" class="control-label">Telefono</label>
						<div class="form-group">
							<input type="text" name="telefono" value="<?php echo ($this->input->post('telefono') ? $this->input->post('telefono') : $tbl_cliente['telefono']); ?>" class="form-control" id="telefono" />
							<span class="text-danger"><?php echo form_error('telefono');?></span>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> Save
				</button>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
