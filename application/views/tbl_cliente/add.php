<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Nuevo Cliente:</h3>
            </div>
            <?php echo form_open('tbl_cliente/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-4">
						<label for="nombre" class="control-label"><span class="text-danger">*</span>Nombre Completo</label>
						<div class="form-group">
							<input type="text" name="nombre" value="<?php echo $this->input->post('nombre'); ?>" class="form-control" id="nombre" />
							<span class="text-danger"><?php echo form_error('nombre');?></span>
						</div>
					</div>
					<div class="col-md-2">
						<label for="precio_vivo" class="control-label">$ Vivo</label>
						<div class="form-group">
							<input type="text" name="precio_vivo" value="<?php echo $this->input->post('precio_vivo'); ?>" class="form-control" id="precio_vivo" />
							<span class="text-danger"><?php echo form_error('precio_vivo');?></span>
						</div>
					</div>
					<div class="col-md-2">
						<label for="precio_alinado" class="control-label">$ Aliñado</label>
						<div class="form-group">
							<input type="text" name="precio_alinado" value="<?php echo $this->input->post('precio_alinado'); ?>" class="form-control" id="precio_alinado" />
							<span class="text-danger"><?php echo form_error('precio_alinado');?></span>
						</div>
					</div>
					<div class="col-md-2">
						<label for="precio_procesado" class="control-label">$ Procesado</label>
						<div class="form-group">
							<input type="text" name="precio_procesado" value="<?php echo $this->input->post('precio_procesado'); ?>" class="form-control" id="precio_procesado" />
							<span class="text-danger"><?php echo form_error('precio_procesado');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="telefono" class="control-label">Telefono</label>
						<div class="form-group">
							<input type="text" name="telefono" value="<?php echo $this->input->post('telefono'); ?>" class="form-control" id="telefono" />
							<span class="text-danger"><?php echo form_error('telefono');?></span>
							<p class="font-weight-normal text-danger">10 digitos</p>
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Guardar
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
