<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        
            <div class="container-fluid py-5">
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
                <div class="card col-md-8 mx-auto p-0">
                    <div class="card-header text-center"><h4>Change password</h4></div>
                    <div class="card-body">
                        <?=form_open('auth/update_password');?>
                            <input type="hidden" name="reset_pass_code" value="<?=$reset_pass_code;?>">

                            <div class="form-group">
                                <label for="name">Password:</label>
                                <input type="password" name="password" class="form-control">
                                <span class="text-danger"><?=form_error('password');?></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Confirm password:</label>
                                <input type="password" name="confirm" class="form-control">
                                <span class="text-danger"><?=form_error('confirm');?></span>
                            </div>
                            <div class="text-center">
                                <input type="submit" name="submit" value="Change password" class="btn btn-info">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->