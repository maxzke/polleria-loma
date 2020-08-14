<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
		    <div class="col-md-4 mx-auto bg-white">
		      	<div class="box box-info">
		            <div class="box-header with-border">
		              	<h3 class="box-title">Agregar Nuevo Gasto Diario</h3>
		            </div>
		            <?php echo form_open('gastos_diarios/add'); ?>
		          	<div class="box-body">
		          		<div class="row clearfix">
							<div class="col-md-6">
								<label for="importe" class="control-label">Importe</label>
								<div class="form-group">
									<input type="number" min="0" step="any" name="importe" value="<?php echo $this->input->post('importe'); ?>" class="form-control" id="importe" />
									<span class="text-danger"><?php echo form_error('importe');?></span>
								</div>
							</div>
							<div class="col-md-6">
								
								<div class="form-group">
									<?php 
									date_default_timezone_set('America/Mexico_City');
									$now = date('d-m-Y H:i:s');
									?>
									<input type="hidden" name="fecha" value="<?php echo $now; ?>" class="form-control" id="fecha" />
								</div>
							</div>
							<div class="col-md-6">
								
								<div class="form-group">
									<input type="hidden" name="usuario" value="<?php echo $_SESSION['name']?>" class="form-control" id="usuario" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input type="hidden" name="status" value="ok" class="form-control" id="status" />
								</div>
							</div>
							<div class="col-md-12">
								<label for="descripcion" class="control-label">Descripcion</label>
								<div class="form-group">
									<textarea name="descripcion" class="form-control" id="descripcion"><?php echo $this->input->post('descripcion'); ?></textarea>
									<span class="text-danger"><?php echo form_error('descripcion');?></span>
								</div>
							</div>
						</div>
					</div>
		          	<div class="box-footer text-center mb-3">
					  	<a href="<?php echo base_url('gastos_diarios/index') ?>">
							<button type="button" class="btn btn-sm btn-warning">
							<i class="fas fa-chevron-left"></i> Volver
							</button>
						</a>
		            	<button type="submit" class="btn btn-sm btn-success">
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
