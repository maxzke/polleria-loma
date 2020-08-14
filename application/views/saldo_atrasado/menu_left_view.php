<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?php echo base_url()?>/assets/AdminLTE3/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Polleria Loma</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url()?>/assets/AdminLTE3/dist/img/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['name']?></a>
          <input type="hidden" id="username" value="<?php echo $_SESSION['name']?>">
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->          
          <li class="nav-header">MENU</li>
          <li class="nav-item">
            <a href="<?php echo base_url('ventas')?>" class="nav-link">
              <i class="nav-icon fa fa-circle-o text-success"></i>
              <p class="text">Punto de Ventas</p>
            </a>
          </li>          
          <li class="nav-item">
            <a href="<?php echo base_url('editarventas')?>" class="nav-link">
              <i class="nav-icon fa fa-circle-o text-success"></i>
              <p>Editar </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('ventas/clientesDeudores')?>" class="nav-link">
              <i class="nav-icon fa fa-circle-o text-primary"></i>
              <p>Abonar</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('Tbl_cliente')?>" class="nav-link">
              <i class="nav-icon fa fa-circle-o text-warning"></i>
              <p>Clientes</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('Tbl_cliente')?>" class="nav-link">
              <i class="nav-icon fa fa-circle-o text-warning"></i>
              <p>Agregar Saldo Atrasado</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('gastos_diarios')?>" class="nav-link">
              <i class="nav-icon fa fa-circle-o text-danger"></i>
              <p>Gastos diarios</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('reportes')?>" class="nav-link">
              <i class="nav-icon fa fa-circle-o text-secondary"></i>
              <p>Reportes</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('usuarios/index')?>" class="nav-link">
              <i class="nav-icon fa fa-circle-o text-info"></i>
              <p>Usuarios</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>