    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid"> 
        <!-- Main content -->
        <section class="container-fluid">
            <div class="container-fluid">
                <!-- CONTENIDO PAGINA -->
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    
                    <!-- Main content -->
                    <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                    <div class="col-md-4 mx-auto bg-white">

                        <div class="card-header text-center"><h4><strong>EDITAR USUARIO</strong></h4></div>
                            <div class="card-body">
                                <?php echo form_open('usuarios/update');?>
                                    <div class="form-group">
                                        <label for="name">Nombre de Usuario:</label>
                                        <input type="text" name="name" value="<?php echo $usuario['name']; ?>" class="form-control" readonly>                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Password:</label>
                                        <input type="password" name="password" class="form-control">
                                        <p class="text-monospace text-danger">Minimo 6 caracteres</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Confirmar password:</label>
                                        <input type="password" name="confirm" class="form-control">
                                        <input type="hidden" name="id" value="<?php echo $usuario['id'];?>">
                                    </div>
                                    <div class="text-center">
                                        <a href="<?php echo base_url('usuarios/index') ?>">
                                            <button type="button" class="btn btn-sm btn-warning">
                                            <i class="fas fa-chevron-left"></i> Volver
                                            </button>
                                        </a>
                                        <input type="submit" name="submit" value="Guardar" class="btn btn-sm btn-success">
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
                        <!-- /.row -->
                        

                    </div><!-- /.container-fluid -->
                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->

                <!-- /CONTENIDO PAGINA -->
            </div><!-- /.container -->
        </section><!-- /.content -->
        <!-- /Main content -->
    </div><!-- /.content-wrapper -->
    
  

  
