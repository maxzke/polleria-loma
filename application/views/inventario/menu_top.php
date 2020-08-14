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
        <h5 class="text-dark mt-2"><strong>INVENTARIO</strong></h5>
      </li> 
      <li class="nav-item">
        <button 
          id="btnAddVivo"
          class="btn btn-sm btn-info ml-2" 
          data-toggle="modal" 
          data-target="#ModalVivo" 
          data-backdrop="static" 
          data-keyboard="false">
            <i class="fas fa-plus"></i> Ingresar Pollo Vivo
        </button>
      </li>
      <li class="nav-item">
        <button 
          id="btnAddProcesado"
          class="btn btn-sm btn-warning ml-2" 
          data-toggle="modal" 
          data-target="#modal_procesado_codigo" 
          data-backdrop="static" 
          data-keyboard="false">
            <i class="fas fa-plus"></i> Ingresar Pollo Procesado
        </button>
      </li>
      <li class="nav-item">
        <button 
          id="btnAddAhogado"
          class="btn btn-sm btn-danger ml-5" 
          data-toggle="modal" 
          data-target="#ModalVivoAhogado" 
          data-backdrop="static" 
          data-keyboard="false">
            <i class="fas fa-plus"></i> Ahogado
        </button>
      </li>
      <li class="nav-item">
        <a class="btn  btn-sm btn-danger ml-2" href="<?php echo base_url('Inventario/addDecompuestoView')?>"><i class="fas fa-plus"></i> Descompuesto</a>
        <!-- <button class="btn btn-danger ml-2" 
        data-toggle="modal" 
        data-target="#modal_procesado_descompuesto" 
        data-backdrop="static" 
        data-keyboard="false">
        <i class="fas fa-plus"></i> Descontar Pollo Descompuesto</button> -->
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