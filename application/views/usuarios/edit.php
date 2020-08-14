<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
    <div class="col-md-4">
        <div class="box">
            
            <div class="box-body">
                <table id="table-clientes" class="table table-striped table-sm dt-responsive">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Password</th>
                            <th>confirmar Password</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    <tr>
                    	<?=form_open('usuarios/update');?>
	                        <td><?php echo $usuario['name']; ?></td>
	                        <td><input type="password" name="password"></td>
	                        <td>
	                        	<input type="password" name="confirm">
								<input type="hidden" name="id" value="<?php echo $usuario['id'];?>">
	                        </td>
	                        <td>
	                        	<button class="btn btn-success">Guardar</button>
	                        </td>
                        </form>
                    </tr>

                    </tbody>
                </table>   

                          
            </div>
        </div>
    </div>
</div>
        <!-- /.row -->
        

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
