<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-white">
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Contenido -->
        
        <div class="row justify-content-center mt-1">

            <div class="col-12 border bg-white">

            <!-- Reporte Ventas por Tipo Pollo -->
            <table id="report-table" class="table table-hover table-bordered table-sm dataTable">
                <thead><!-- 
                    <tr>
                        <td colspan="6" class="bg-info text-center">Listado Pollo Vivo</td>
                    </tr> -->
                    <tr class="bg-info">
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
                                <td class="text-center text-capitalize"><?php echo $key['pollo']; ?></td>
                                <td class="text-center text-capitalize"><?php echo $key['cliente']; ?></td>
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
                                <td class="text-center text-capitalize"><?php echo $key['usuario']; ?></td>
                            </tr> 
                    <?php 
                        }
                    ?>                    
                </tbody>
            </table>
            <!-- /Reporte Ventas por Tipo Pollo -->

            </div><!-- /col8 -->

            <!--<div class="col-4">

                

            </div> /col-4 -->
            
        </div><!-- /row -->

        <!-- Reporte Pollo VIVO -->
        <div class="row justify-content-center mt-1">
            <div class="col-6">
                <!-- Resumen -->

                <table class="table table-bordered table-white table-hover table-sm">
                    <thead>                            
                        <tr class="bg-info">
                            <th class="text-center">RESUMEN</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Kilos</th>
                            <th class="text-center">Importe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                          <th class="text-center">Vivo</th>
                          <td class="text-center"><?php echo $resumen_vivo[0]['cantidad'] ?></td><!-- Cantidad -->
                          <td class="text-center"><?php echo $resumen_vivo[0]['kilos'] ?></td><!-- Kilos -->
                          <td class="text-center">$ <?php echo number_format($resumen_vivo[0]['total'],2)  ?></td><!-- Efectivo -->
                        </tr>
                        <tr>
                          <th class="text-center">Desplumado</th>
                          <td class="text-center"><?php echo $resumen_desplumado[0]['cantidad'] ?></td><!-- Cantidad -->
                          <td class="text-center"><?php echo $resumen_desplumado[0]['kilos'] ?></td><!-- Kilos -->
                          <td class="text-center">$ <?php echo number_format($resumen_desplumado[0]['total'],2)  ?></td><!-- Efectivo -->
                        </tr>
                        <tr>
                          <th class="text-center">Aliñado</th>
                          <td class="text-center"><?php echo $resumen_alinado[0]['cantidad'] ?></td><!-- Cantidad -->
                          <td class="text-center"><?php echo $resumen_alinado[0]['kilos'] ?></td><!-- Kilos -->
                          <td class="text-center">$ <?php echo number_format($resumen_alinado[0]['total'],2)  ?></td><!-- Efectivo -->
                        </tr>
                        <tr>
                          <th class="text-center">Procesado</th>
                          <td class="text-center"><?php echo $resumen_procesado[0]['cantidad'] ?></td><!-- Cantidad -->
                          <td class="text-center"><?php echo $resumen_procesado[0]['kilos'] ?></td><!-- Kilos -->
                          <td class="text-center">$ <?php echo number_format($resumen_procesado[0]['total'],2)  ?></td><!-- Efectivo -->
                        </tr>
                        <tr>
                          <td></td>
                          <td class="text-center"><strong><?php echo number_format($totalCantidad,2); ?></strong></td><!-- Cantidad -->
                          <td class="text-center"><strong><?php echo number_format($totalKilos,2); ?></strong></td><!-- Kilos -->
                          <td class="text-center"><strong>$ <?php echo number_format($totalImporte,2); ?></strong></td><!-- Efectivo -->
                        </tr>                        
                    </tbody>
                  </table>
            <!-- /Resumen --->
            </div>
            <div class="col-6">
                <!-- Resumen -->

                
                  <table class="table table-bordered table-white table-hover table-sm">
                    <thead>                            
                        <tr class="bg-info">
                            <th class="text-center">Entradas de Dinero</th>
                            <th class="text-center">Efectivo</th>
                        </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th class="text-center">Dinero inicial en caja</th>
                        <th class="text-center">
                          $ <?php
                                if ($caja_entrada[0]['importe']) {
                                  $caja_inicial = $caja_entrada[0]['importe'];
                                  echo number_format($caja_inicial,2);
                                }else{
                                  redirect('ventas/index');
                                }                         
                             
                            ?>                          
                        </th><!-- Cantidad -->
                      </tr>

                      <tr>
                        <th class="text-center">Ventas</th>
                        <th class="text-center">$ <?php 
                        $totalEntradaEfectivo = 0;
                        $totalEntradaEfectivo = $ventasEfectivo[0]['efectivo'];
                        echo number_format($ventasEfectivo[0]['efectivo'],2); ?></th><!-- Cantidad -->
                      </tr>
                      <!-- Efectivo -->
                      <tr>
                        <th class="text-center">Pagos Efectivo</th>
                        <th class="text-center">$ <?php 
                        $totalEntradaEfectivo = $totalEntradaEfectivo + $ventasAbonos[0]['abonos'];
                        echo number_format($ventasAbonos[0]['abonos'],2); ?></th><!-- Cantidad -->
                      </tr>
                      <!-- Transferencia -->
                      <tr>
                        <th class="text-center">Pagos Transferencia</th>
                        <th class="text-center">$ <?php 
                        $totalEntradaEfectivo = $totalEntradaEfectivo + $ventasAbonosTransferencia[0]['abonos'];
                        echo number_format($ventasAbonosTransferencia[0]['abonos'],2); ?></th><!-- Cantidad -->
                      </tr>
                      <!-- Cheque -->
                      <tr>
                        <th class="text-center">Pagos Cheque</th>
                        <th class="text-center">$ <?php 
                        $totalEntradaEfectivo = $totalEntradaEfectivo + $ventasAbonosCheque[0]['abonos'];
                        echo number_format($ventasAbonosCheque[0]['abonos'],2); ?></th><!-- Cantidad -->
                      </tr>
                      <!-- gastos diarios -->
                      <tr>
                        <th class="text-center text-danger">Gastos Diarios</th>
                        <td class="text-center text-danger"><strong>
                          $ <?php                           
                          $gastosDiarios = $gastos[0]['gastos'];
                        echo number_format($gastosDiarios,2); ?>
                        </strong></td><!-- Cantidad -->
                      </tr>
                      <!-- /Gastos diarios -->
                      <tr>
                        <th class="text-center"></th>
                        <!-- total -->
                        <td class="text-center"><strong>$ <?php echo number_format(($caja_inicial+$totalEntradaEfectivo)-$gastosDiarios,2); ?></strong></td><!-- Cantidad -->
                      </tr>
                                             
                    </tbody>
                </table>

            <!-- /Resumen --->
           
            
            </div>
        </div>
        <!-- /Reporte Pollo VIVO -->
        
        <!-- Contenido -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
