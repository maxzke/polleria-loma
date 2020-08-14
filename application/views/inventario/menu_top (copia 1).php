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
        <button class="btn btn-info ml-2" data-toggle="modal" data-target="#ModalVivo" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus"></i> Vivo</button>
      </li>
      <li class="nav-item">
        <button class="btn btn-warning ml-2" data-toggle="modal" data-target="#modal_procesado" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus"></i> Procesado MANUAL</button>
      </li>
      <li class="nav-item">
        <button class="btn btn-warning ml-2" data-toggle="modal" data-target="#modal_procesado_codigo" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus"></i> Procesado CODIGO</button>
      </li>
      <li class="nav-item">
        <button class="btn btn-danger ml-5" data-toggle="modal" data-target="#ModalVivoAhogado" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus"></i> Pollo Ahogado</button>
      </li>
      <li class="nav-item">
        <button class="btn btn-danger ml-2" data-toggle="modal" data-target="#modal_procesado_descompuesto" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus"></i> Pollo Descompuesto</button>
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