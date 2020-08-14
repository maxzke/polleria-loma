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
        <h5 class="text-dark mt-2"><strong>INVENTARIO - REGISTRAR</strong></h5>
      </li> 
      <li class="nav-item">
        <button class="btn btn-info ml-2" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Pollo Vivo</button>
      </li>
      <li class="nav-item">
        <a href="<?php echo base_url('entrada_stock_procesado/add')?>" class="btn btn-warning ml-2"><i class="fas fa-plus"></i> Pollo Procesado</a>
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