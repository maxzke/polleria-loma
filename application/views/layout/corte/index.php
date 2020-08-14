    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid"> 
        <!-- Main content -->
        <section class="container-fluid">
            <div class="container-fluid">
                <!-- CONTENIDO PAGINA -->
                <div class="row">
                    <div class="col-md-12 bg-white mx-auto">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <!-- HACER CORTE POR FECHA -->
                                <form action="<?php echo base_url('corte') ?>" method="post" class="form-inline my-3">
                                    <div class="form-group">
                                        <input type="text" id="inputDate" name="fecha" class="form-control form-control-sm" placeholder="Fecha">
                                        <input type="hidden" id="fechareporte" value="">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">HACER CORTE</button>
                                    <span class="ml-5 bg-light text-warning"><strong>CORTE DEL DIA <?php echo $fecha ?></strong></span>
                                </form>
                                <!-- /HACER CORTE POR FECHA -->
                            </div><!-- /col fecha -->
                        </div><!-- /row fecha -->
                        <div class="row">
                            <div class="col-md-4">
                                <table class="table table-sm table-responsive">
                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="4" class="text-center">Movimientos</th>
                                        </tr>
                                        <tr>
                                            <th>Salida</th>
                                            <th>Importe</th>
                                            <th>Entrada</th>
                                            <th>Importe</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Gastos</td>
                                                <td><strong>$ <?php echo number_format($gastos,2,".","," ) ?></td>
                                                <td scope="row" class="border-left">Caja Inicial</td>
                                                <td class="text-right">$ <?php echo number_format($caja,2,".","," );?></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td scope="row" class="border-left">Efectivo</td>
                                                <td class="text-right">$ <?php echo number_format($entrada_efectivo,2,".","," ) ?></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td scope="row" class="border-left">Transferencias</td>
                                                <td class="text-right">$ <?php echo number_format($entrada_transferencia,2,".","," ) ?></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td scope="row" class="border-left">Cheques</td>
                                                <td class="text-right">$ <?php echo number_format($entrada_cheque,2,".","," ) ?></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td class="text-danger"><strong>$ <?php echo number_format($gastos,2,".","," ) ?></strong></td>
                                                <td scope="row" class="border-left"></td>
                                                <td class="text-right">
                                                    <strong>
                                                        $ <?php 
                                                        $totalEntrada =$entrada_efectivo + $entrada_transferencia + $entrada_cheque;
                                                        echo number_format($totalEntrada+$caja,2,".","," ) ?>
                                                    </strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                </table>
                            </div><!-- /col corte -->
                                                                                   
                            <!-- TOTALES -->
                            <?php 
                                $totalVentas =0;
                                $totalSaldo=0; 
                                $pagos_a_venta = 0;
                                $abonos_a_ventas = 0;
                                foreach ($clientes as $key => $value){
                                    $newImporte = str_replace(",","",$value['importe']);
                                    $newSaldo = str_replace(",","",$value['saldo']);
                                    $newPagoAVenta = str_replace(",","",$value['pago']);

                                    $totalVentas = $totalVentas + floatval($newImporte);
                                    $totalSaldo = $totalSaldo + floatval($newSaldo);
                                    $pagos_a_venta = $pagos_a_venta + floatval($newPagoAVenta);
                                }
                                $abonos_a_ventas = $totalEntrada - $pagos_a_venta;
                            ?>                                            
                            <div class="col-md-4 mx-auto table-responsive">
                                <table class="table table-sm">
                                    <tbody>
                                        <tr>
                                            <td scope="row">Importe Total De Ventas</td>
                                            <td class="text-right">$ <?php echo number_format($totalVentas,2,".","," ) ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Importe total De Saldo Pendiente</td>
                                            <td class="text-right">$ <?php echo number_format($totalSaldo,2,".","," ) ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Pagos a Ventas</td>
                                            <td class="text-right">$ <?php echo number_format($pagos_a_venta,2,".","," ) ?></td>
                                        </tr> 
                                        <tr>
                                            <td scope="row">Abonos a Ventas</td>
                                            <td class="text-right">$ <?php echo number_format($abonos_a_ventas,2,".","," ) ?></td>
                                        </tr> 
                                    </tbody>
                                </table>
                            </div>
                            <!-- /TOTALES -->

                            <!-- COL VENTAS -->
                            <div class="col-md-4">
                                <table class="table table-sm table-responsive">
                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="4" class="text-center">
                                                Total Ventas
                                            </th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th>Cantidad</th>
                                            <th>Kilos</th>
                                            <th>Importe</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td scope="row"><strong>Vivo</strong></td>
                                            <td><?php echo $vivo[0]['cantidad'] ?></td>
                                            <td><?php echo $vivo[0]['kilos'] ?></td>
                                            <td>$ <?php echo number_format($vivo[0]['importe'],2,".","," ) ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row"><strong>Desplumado</strong></td>
                                            <td><?php echo $desplumado[0]['cantidad'] ?></td>
                                            <td><?php echo $desplumado[0]['kilos'] ?></td>
                                            <td>$ <?php echo number_format($desplumado[0]['importe'],2,".","," ) ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row"><strong>Aliñado</strong></td>
                                            <td><?php echo $alinado[0]['cantidad'] ?></td>
                                            <td><?php echo $alinado[0]['kilos'] ?></td>
                                            <td>$ <?php echo number_format($alinado[0]['importe'],2,".","," ) ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row"><strong>Procesado</strong></td>
                                            <td><?php echo $procesado[0]['cantidad'] ?></td>
                                            <td><?php echo $procesado[0]['kilos'] ?></td>
                                            <td>$ <?php echo number_format($procesado[0]['importe'],2,".","," ) ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row"></td>
                                            <td></td>
                                            <td></td>
                                            <td><strong>
                                                <?php 
                                                    $sumatoria = $vivo[0]['importe'] +$desplumado[0]['importe'] +$alinado[0]['importe']+$procesado[0]['importe'];
                                                    echo "$ ".number_format($sumatoria,2,".","," );
                                                ?>
                                            </strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /COL VENTAS -->

                        </div><!-- /row corte -->
                        <div class="row">
                            <div class="col-md-12">    
                            <hr>                        
                                <table class="table table-bordered table-hover table-sm table-hover dt-responsive" id="report-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>CLIENTE</th>
                                            <th>IMPORTE</th>
                                            <th>PAGOS</th>
                                            <th>SALDO</th>
                                            <th>FECHA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $item=1; foreach ($clientes as $key => $value):?>
                                            <tr>
                                                <td scope="row"><?php echo $item; $item++; ?></td>
                                                <td class="text-capitalize"><?php echo $value['cliente'] ?></td>
                                                <td><?php echo $value['importe'] ?></td>
                                                <td><?php echo $value['pago'] ?></td>
                                                <td><?php echo $value['saldo'] ?></td>
                                                <td><?php echo $value['fecha'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div><!-- /col -->
                </div><!-- /row -->
                <!-- /SELECCIONAR FECHA CORTE -->
                <div class="row">
                    <div class="col-md-10 bg-white mx-auto">
                    
                    </div>
                </div>
                <!-- /CONTENIDO PAGINA -->
            </div><!-- /.container -->
        </section><!-- /.content -->
        <!-- /Main content -->
    </div><!-- /.content-wrapper -->