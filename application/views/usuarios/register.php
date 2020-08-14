<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="col-4">
        
            <div class="card-header text-center"><h4>Nuevo Usuario</h4></div>
            <div class="card-body">
                <?=form_open('auth/add_user');?>
                    <div class="form-group">
                        <label for="name">Nombre de Usuario:</label>
                        <input type="text" name="name" value="<?=set_value('name');?>" class="form-control">
                        <p class="text-monospace text-danger">Usuario sin espacios en blanco</p>
                        <span class="text-danger"><?=form_error('name');?></span>
                    </div>
                    <div class="form-group">
                        <label for="name">Password:</label>
                        <input type="password" name="password" class="form-control">
                        <p class="text-monospace text-danger">Minimo 6 caracteres</p>
                        <span class="text-danger"><?=form_error('password');?></span>
                    </div>
                    <div class="form-group">
                        <label for="name">Confirmar password:</label>
                        <input type="password" name="confirm" class="form-control">
                        <span class="text-danger"><?=form_error('confirm');?></span>
                    </div>
                    <div class="text-center">
                        <input type="submit" name="submit" value="Registrar" class="btn btn-info">
                    </div>
                </form>
            </div>
        </div><!-- col-4 -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->