<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li>
        <!-- SEARCH FORM -->
        <!-- add Cliente -->
        <div class="input-group mb-3 mt-2">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Buscar Cliente</span>
          </div>
          <input type="text" id="inputBuscarCliente" onClick="this.select();" aria-label="Username" aria-describedby="basic-addon1">
        </div>
      </li>
      <li>
        <div class="ml-3" id="tipoPollo">
          <h1 class="mt-0"></h1>
        </div>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Imprimir ticket -->
      <li class="nav-item">
        <button 
          id="print_last_ticket"
          class="nav-link btn btn-warning btn-sm" 
          data-toggle="tooltip" 
          data-placement="left" 
          title="última venta">
        <i class="fas fa-print"> Ticket</i>
        </button>
      </li>
      <!-- Salir -->
      <li class="nav-item">
        <a class="nav-link text-danger" href="<?php echo base_url('auth/logout')?>">
        <strong>Salir</strong>
    	</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->