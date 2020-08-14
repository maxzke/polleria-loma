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
                                    <button class="btn btn-sm btn-success btn-detalle-venta" data-idventa="<?php echo $key['id']; ?>">ver / abonar</button>
                                    <button class="btn btn-sm btn-danger btn-cancela-venta ml-1" data-idventa="<?php echo $key['id']; ?>">Cancelar</button>                                      
                                    
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
                
                <!-- Row efctivo - cheque - transferencia -->
                <div class="row">
                  <div class="col-12">
                    <div class="container">
                      <nav>
                      <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Efectivo</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Transferencia</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Cheque</a>
                      </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                      <!-- Efectivo -->
                      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row my-4">
                          <div class="col-4 text-right"><h4>Efectivo</h4></div>
                          <div class="col-4 text-center">
                            <input id="inputAbonoEfectivo" type="text" class="form-control efectivo" placeholder="$" min="0" step="any"></div>
                          <div class="col-4 text-center">
                            <button id="saveAbonoEfectivo" class="btn btn-success efectivo">Guardar</button>
                          </div>
                        </div>
                      </div>
                      <!-- Transferencia -->
                      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row my-4">
                          <div class="col-4 text-right"><h4>Transferencia</h4></div>
                          <div class="col-4 text-center">
                            <input id="inputAbonoTransferencia" type="text" class="form-control transferencia" placeholder="$" min="0" step="any"></div>
                          <div class="col-4 text-center">
                            <button id="saveAbonoTransferencia" class="btn btn-success transferencia">Guardar</button>
                          </div>
                        </div>
                      </div>
                      <!-- Cheque -->
                      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="row my-4">
                          <div class="col-4 text-right"><h4>Cheque</h4></div>
                          <div class="col-4 text-center">
                            <input id="inputAbonoCheque" type="text" class="form-control cheque" placeholder="$" min="0" step="any"></div>
                          <div class="col-4 text-center">
                            <button id="saveAbonoCheque" class="btn btn-success cheque">Guardar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    </div>
                  </div><!-- col-12 -->
                </div><!-- row -->
                <!-- /Row efctivo - cheque - transferencia -->
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
