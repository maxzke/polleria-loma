<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item">
        <h5 class="text-dark mt-1">EDITAR VENTAS <?php echo $fecha; ?></h5>
        <input type="hidden" id="fechareporte" value="<?php echo $fecha; ?>">
      </li>      
      <li>
          <form method="get"accept-charset="utf-8" action="<?php echo base_url('EditarVentas'); ?>">
            <div class="input-group input-group-sm ml-5 mt-1 ">
                <input id="inputDate" type="text" class="form-control" name="fecha" autocomplete="off" placeholder="Seleccionar fecha">
                <span class="input-group-btn">
                  <button id="btnGenera" type="submit" class="btn btn-warning btn-sm">Buscar por Fecha</button>
                </span>          
            </div>
          </form>
      </li>
    </ul>
<!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Salir -->
      <li class="nav-item">
        <a class="nav-link text-danger" href="<?php echo base_url('auth/logout')?>">
        <strong>Salir</strong>
    	</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->