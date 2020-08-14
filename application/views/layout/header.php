<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title>Polleria | Loma</title>
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Font Awesome 
  <link rel="stylesheet" href="<?php //echo base_url()?>assets/AdminLTE3/plugins/font-awesome/css/font-awesome.min.css">-->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/css/fontAwesome/css/all.min.css">
  
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/AdminLTE3/plugins/ionicons/2.0.1/css/ionicons.min.css">
  
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/AdminLTE3/plugins/datatables/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/AdminLTE3/plugins/datatables/Buttons-1.5.1/css/buttons.bootstrap4.min.css"/>
  <link rel="stylesheet" href="<?php echo base_url()?>assets/AdminLTE3/plugins/datatables/Responsive-2.2.1/css/responsive.bootstrap4.min.css"/>
 
  <!-- alertify -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/css/alertify.min.css"/>
  <!-- Default theme -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/css/default.min.css"/>
  <!-- Semantic UI theme -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/css/semantic.min.css"/>
  

  <!-- Theme style
  <link rel="stylesheet" href="<?php //echo base_url()?>assets/AdminLTE3/dist/css/adminlte.min.css"> -->

  <link rel="stylesheet" href="<?php echo base_url()?>assets/css/easy-autocomplete.min.css">

  <!-- Bootstrap theme -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.min.css"/>
  
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap-datepicker.min.css">

  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/AdminLTE3/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="<?php echo base_url()?>assets/AdminLTE3/plugins/googleFonts/css.css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/css/easy-autocomplete.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery-ui.css">

  <link rel="stylesheet" href="<?php echo base_url()?>assets/css/ventas.css">
</head>
<body class="fondo">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-dark navbar-dark border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item d-none d-sm-inline-block">
                <strong class="nav-link text-warning">POLLERIA LOMA ::: SISTEMA DE VENTAS</strong>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('ventas'); ?>">
                    <button class="btn btn-outline-warning ml-2 <?php echo $page=="ventas"?"active":"" ?>">VENTAS</button> 
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('clientes'); ?>">
                    <button class="btn btn-outline-warning ml-2 <?php echo $page=="clientes"?"active":"" ?>">CLIENTES</button> 
                </a> 
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('inventario'); ?>">
                    <button class="btn btn-outline-warning ml-2 <?php echo $page=="inventario"?"active":"" ?>">INVENTARIO</button> 
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('gastos_diarios'); ?>">
                    <button class="btn btn-outline-warning ml-2 <?php echo $page=="gastos"?"active":"" ?>">GASTOS</button> 
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('corte'); ?>">
                    <button class="btn btn-outline-warning ml-2 <?php echo $page=="corte"?"active":"" ?>">CORTE</button>
                </a> 
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('usuarios'); ?>">
                    <button class="btn btn-outline-warning ml-2 <?php echo $page=="usuarios"?"active":"" ?>">USUARIOS</button> 
                </a> 
            </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
        <!-- USER -->
        <li class="nav-item">
            <a class="nav-link text-success" href="#">
                <strong><i class="fas fa-user"></i></strong>
                <?php echo $_SESSION['name']; ?>
            </a>
        </li>
        <!-- Salir -->
        <li class="nav-item">
            <a class="nav-link text-danger" href="<?php echo base_url('auth/logout')?>">
            Salir
            </a>
        </li>
        </ul>
    </nav>
    <!-- /.navbar -->
