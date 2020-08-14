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
                        <th class="text-center">Fecha-Hora</th>
                        <th class="text-center">Mostrar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($ventas as $key) {?>
                           <tr>
                                <td class="text-center text-uppercase"><?php echo $key['cliente']; ?></td>
                                <td class="text-center"><?php echo $key['fecha']; ?></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success btn-detalle-venta" data-idventa="<?php echo $key['id']; ?>">Abonar</button>                                       
                                </td>
                            </tr> 
                    <?php 
                        }
                    ?>                    
                </tbody>
            </table>

            </div><!-- /col8 -->
            
        </div><!-- /row -->

        <!-- Modal -->
        <div class="row" id="contentModalEditar">
          <div id="modal-edit-ventas" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myHugeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <!-- Tabla editar -->
                <table id="detalles-table" class="table table-hover table-bordered table-sm dataTable">
                  <thead><!-- 
                      <tr>
                          <td colspan="6" class="bg-info text-center">Listado Pollo Vivo</td>
                      </tr> -->
                      <tr class="bg-success">
                          <th class="text-center">Pollo</th>                        
                          <th class="text-center">Cantidad</th>
                          <th class="text-center">Kilos</th>
                          <th class="text-center">Precio</th>
                          <th class="text-center">Importe</th>
                          
                      </tr>
                  </thead>
                  <tbody>
                    <!-- Detalles venta -->
                  </tbody>
                  <tfoot>
                    <tr>
                      <td class="text-right" colspan="4">TOTAL</td>
                      <td class="text-center"><label id="label_total"></label></td>                      
                    </tr>
                    <tr>
                      <td class="text-right" colspan="4">TOTAL PAGOS</td>
                      <td class="text-center"><label id="label_total_pagos"></label></td>
                      
                    </tr>
                  </tfoot>
              </table>
                <!-- /Tabla editar -->
                <div class="mb-4" id="cambio-editar">
                  <!-- Cambio -->
                </div>
                <div class="row mb-4">
                  <div class="col-4 text-right"><h4>Su Pago</h4></div>
                  <div class="col-4 text-center">
                    <input id="inputAbono" type="text" class="form-control" placeholder="$"></div>
                  <div class="col-4 text-center">
                    <button id="saveAbono" class="btn btn-success">Guardar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /Modal -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
