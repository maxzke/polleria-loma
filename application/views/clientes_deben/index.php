<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-white">
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="row justify-content-center mt-1">
              
        </div><!-- /row -->
        
        <div class="row justify-content-center mt-1">

            <div class="col-10 border bg-light">

            <table id="abonar-table" class="table table-hover table-bordered table-sm dataTable">
                <thead>
                    <tr class="bg-success">
                        <th class="text-center">Cliente</th>                        
                        <th class="text-center">Saldo</th>
                        <th class="text-center">Mostrar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($clientes as $key) {?>
                           <tr>
                                <td class="text-center text-uppercase"><?php echo $key['cliente']; ?></td>
                                <td class="text-center"><?php echo number_format($key['debe'],2); ?></td>
                                <td class="text-center">
                                  <form method="post" action="<?php echo base_url('ventas/indexabono/'); ?>">
                                    <button type="submit" name="cliente" class="btn btn-sm btn-warning btn-detalle-venta" value="<?php echo $key['cliente']; ?>">Ver detalles</button>      
                                    </form>                                 
                                </td>
                            </tr> 
                    <?php 
                        }
                    ?>                    
                </tbody>
            </table>

            </div><!-- /col8 -->
            
        </div><!-- /row -->

        

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
