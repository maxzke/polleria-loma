<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/AdminLTE3/dist/css/bootstrap.min.css">

    <title>Polleria Loma</title>
  </head>
  <body class="bg-light">
    
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-12">
                <?php if(!empty($this->session->flashdata())) :?>
                    <div class="alert alert-info alert-dismissible fade show" style="position:absolute;top:0;right:0;" role="alert">
                    <?php foreach($this->session->flashdata() as $error) :?>
                        <?=$error;?> <br>
                    <?php endforeach;?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>
            </div>
        </div>

        <div class="row">

            <div class="col-xs-4 col-sm-5 col-md-4 col-lg-3 text-center mx-auto">
            
            <div class="card p-0 border border-warning">
                <div class="bg-warning card-header text-center text-white">
                    <h4>POLLERIA LOMA</h4>
                </div>
                <div class="card-body">
                    <?=form_open('auth/login_user');?>

                        <div class="form-group">
                            <label for="name" class="text-white">Usuario</label>
                            <input type="text" name="email" value="<?=set_value('email');?>" class="form-control" autocomplete="off">
                            <span class="text-danger"><?=form_error('email');?></span>
                        </div>

                        <div class="form-group">
                        <label for="pass" class="text-white">Contraseña</label>
                        <input type="password" name="password" class="form-control">
                        <span class="text-danger"><?=form_error('password');?></span>
                        </div>
                       
                        <div class="text-center">
                            <input type="submit" name="submit" value="Entrar" class="btn btn-success btn-flat">
                        </div>
                    </form>
                </div><!-- /cardBody -->
            </div><!-- /card -->
        </div><!-- /col -->
    </div><!-- row -->
    </div><!-- /container -->
        
  </body>
</html>