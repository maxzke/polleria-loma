<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-white">
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Contenido -->
        
        <div class="row justify-content-center mt-1">

            <div class="col-10 border bg-light">

            <!-- Reporte Ventas por Tipo Pollo -->
            <table id="report-table" class="table table-hover table-bordered table-sm dataTable">
                <thead><!-- 
                    <tr>
                        <td colspan="6" class="bg-info text-center">Listado Pollo Vivo</td>
                    </tr> -->
                    <tr class="bg-warning">
                        <th class="text-center">Pollo</th>
                        <th class="text-center">Cliente</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Kilos</th>
                        <th class="text-center">Precio</th>
                        <th class="text-center">Importe</th>
                        <!--    <th class="text-center">Pagos</th> -->
                        <th class="text-center">Fecha-Hora</th>
                        <th class="text-center">Usuario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($ventas as $key) {?>
                           <tr>
                                <td class="text-center text-uppercase"><?php echo $key['pollo']; ?></td>
                                <td class="text-center"><?php echo $key['cliente']; ?></td>
                                <td class="text-center"><?php echo $key['cantidad']; ?></td>
                                <td class="text-center"><?php echo $key['kg']; ?></td>
                                <td class="text-center"><?php echo $key['precio_kg']; ?></td>
                                <td class="text-center">
                                    <?php 
                                        if ($key['pollo']=='Desplumado') {
                                            echo number_format(($key['precio_kg'])*($key['cantidad']),2);     
                                        }else{
                                            echo number_format(($key['precio_kg'])*($key['kg']),2); 
                                        }                                        
                                    ?>                                        
                                </td>                                
                                <!--   <td class="text-center"><?php //echo number_format($key['pago'],2); ?></td>-->
                                <td class="text-center"><?php echo $key['fecha']; ?></td>
                                <td class="text-center text-uppercase"><?php echo $key['usuario']; ?></td>
                            </tr> 
                    <?php 
                        }
                    ?>                    
                </tbody>
            </table>

            </div><!-- /col8 -->
            
        </div><!-- /row -->

        
        <!-- /Reporte Pollo VIVO -->
        
        <!-- Contenido -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
