<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-white">
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
        	<div class="col-4 mx-auto">
        		<div class="card text-white mt-4 mb-3" style="max-width: 18rem;">
				  <div class="card-header bg-primary"><h4>Dinero en Caja</h4></div>
				  <div class="card-body">
				    <?php echo form_open('entrada_efectivo_caja/add'); ?>

					  <div class="form-group">
					    <label for="input_caja" class="text-dark">Efectivo Inicial En Caja</label>
					    
					    <input type="number" 
					    name="efectivo" 
					    class="form-control" 
					    id="input_caja" 
					    placeholder="Importe" 
					    min="0" 
					    step="any" 
					    onClick="this.select();">

					    <span class="text-danger"><?php echo form_error('importe');?></span>
					    <small class="form-text text-muted">
					    	Dinero inicial en caja para iniciar el turno
					    </small>
					  </div>
					  <button type="submit" class="btn btn-block btn-success">GUARDAR</button>

					<?php echo form_close(); ?>
				  </div><!-- /card-body -->
				</div><!-- /card -->        		
        	</div><!-- /col-4 -->
        </div><!-- /row -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->