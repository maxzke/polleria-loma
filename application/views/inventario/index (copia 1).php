<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-white">
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" id="app">

        <!-- Contenido -->
        <?php 
          //print_r($vivo);
          //print_r($procesado);
        ?>

        <div class="row mt-2">
          <div class="col-4">
            <!-- Vivo  -->
            <div class="row">
              <div class="col-md-12">
                <table id="table-vivo" class="table table-bordered table-sm table-hover">
                  <thead>
                    <tr class="bg-info">
                      <th scope="col" class="text-center">Pollo</th>
                      <th scope="col" class="text-center">Cantidad</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row" class="text-center">Vivo</th>
                      <td class="text-center"><?php echo $vivo['0']['cantidad'] ?></td>
                    </tr>                
                  </tbody>
                </table>
              </div>
            </div> 
            
            <!-- Procesado Stock Lotes -->
            <div class="row">
              <div class="col-md-12">
                <span class="h3 text-primary">Descontar Manualmente Inventario</span>
              </div>
              <div class="col-md-4 text-center">
                <span class="h3">R3</span>
                <br>
                <div class="btn-group-vertical btn-block">
                  <?php 
                  foreach ($loteR3 as $key) {?>
                   <button class="btn btn-primary mt-2" data-lote="<?php echo $key['lote'];?>" data-categoria="r3" onclick="getTaras(this)">
                      <?php echo $key['lote'];?>                      
                   </button>
                  <?php 
                  }
                  ?>                  
                </div>
                
              </div>
              <div class="col-md-4 text-center">
                <span class="h3">R4</span>
                <br>
                <div class="btn-group-vertical btn-block">
                  <?php 
                  foreach ($loteR4 as $key) {?>
                   <button class="btn btn-primary mt-2" data-lote="<?php echo $key['lote'];?>" data-categoria="r4" onclick="getTaras(this)">
                    <?php echo $key['lote'];?></button>
                  <?php 
                  }
                  ?>
                </div>
              </div>
              <div class="col-md-4 text-center">
                <span class="h3">R5</span>
                <br>
                <div class="btn-group-vertical btn-block">
                  <?php 
                  foreach ($loteR5 as $key) {?>
                   <button class="btn btn-primary mt-2" data-lote="<?php echo $key['lote'];?>" data-categoria="r5"  onclick="getTaras(this)">
                    <?php echo $key['lote'];?></button>
                  <?php 
                  }
                  ?>
                </div>
              </div>
            </div> 
                      
          </div>

          <div class="col-6">
            <div id="stock_procesado"></div>
          </div><!-- /col-4 -->
        </div>

          <!-- Modal Pollo vivo -->
          <div class="modal fade" id="ModalVivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-info">
                  <h5 class="modal-title" id="exampleModalLabel"><strong>Pollo Vivo</strong></h5>
                  
                </div>
                <div class="modal-body">
                  <div class="card text-center">
                    <div class="card-body">
                      <div class="form-group row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Cantidad</label>
                        <div class="col-sm-8">
                          <input type="number" placeholder="cantidad" class="form-control form-control-sm mt-1" id="inputCantidadVivo">
                        </div>
                      </div>
                      <a href="#" class="btn btn-success mt-1" id="saveVivo">Guardar</a>
                    </div>
                  </div><!-- /card -->
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" id="cierraVivo" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
          <!-- /Modal Pollo vivo -->

          <!-- Modal Pollo vivo Ahogado -->
          <div class="modal fade" id="ModalVivoAhogado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-danger">
                  <h5 class="modal-title" id="exampleModalLabel"><strong>Pollo Ahogado</strong></h5>
                  
                </div>
                <div class="modal-body">
                  <div class="card text-center">
                    <div class="card-body">
                      <div class="form-group row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Cantidad</label>
                        <div class="col-sm-8">
                          <input type="number" placeholder="cantidad" class="form-control form-control-sm mt-1" id="inputCantidadAhogado">
                        </div>
                      </div>
                      <a href="#" class="btn btn-success mt-1" id="saveAhogado">Guardar</a>
                    </div>
                  </div><!-- /card -->
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" id="cierraVivo" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
          <!-- /Modal Pollo vivo Ahogado-->

          <!-- Modal Procesado -->
          <div class="modal fade" id="modal_procesado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header bg-warning">
                  <h5 class="modal-title" id="exampleModalLabel"><strong>Pollo Procesado</strong></h5>
                  
                </div>
                <div class="modal-body">
                  <div class="card text-center">
                    <div class="card-body">

                      <div class="row">

                        <div class="col-4">
                          <div class="card text-center">
                            <div class="card-header bg-secondary">
                              <h5><strong>R 3</strong></h5>
                            </div>
                            <div class="card-body">
                              
                              <div class="form-group row">
                              <label for="inputPassword" class="col-sm-4 col-form-label">Lote</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputLoteR3" placeholder="Lote">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputPassword" class="col-sm-4 col-form-label">Peso</label>
                              <div class="col-sm-8">
                                <input type="number" id="inputKilosR3" placeholder="Kilogramos" class="form-control form-control-sm mt-1">
                              </div>
                            </div>
                            <button id="btnGuardaR3" class="btn btn-sm btn-success mt-1">Guardar</button>

                            </div>
                          </div><!-- /card -->
                        </div><!-- /col-3 -->

                        <div class="col-4">
                          <div class="card text-center">
                            <div class="card-header bg-secondary">
                              <h5><strong>R 4</strong></h5>
                            </div>
                            <div class="card-body">
                              
                              <div class="form-group row">
                              <label for="inputPassword" class="col-sm-4 col-form-label">Lote</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputLoteR4" placeholder="Lote">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputPassword" class="col-sm-4 col-form-label">Peso</label>
                              <div class="col-sm-8">
                                <input type="number" id="inputKilosR4" placeholder="Kilogramos" class="form-control form-control-sm mt-1">
                              </div>
                            </div>
                            <button id="btnGuardaR4" class="btn btn-sm btn-success mt-1">Guardar</button>

                            </div>
                          </div><!-- /card -->
                        </div>

                        <div class="col-4">
                          <div class="card text-center">
                            <div class="card-header bg-secondary">
                              <h5><strong>R 5</strong></h5>
                            </div>
                            <div class="card-body">
                              
                              <div class="form-group row">
                              <label for="inputPassword" class="col-sm-4 col-form-label">Lote</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Lote" id="inputLoteR5">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputPassword" class="col-sm-4 col-form-label">Peso</label>
                              <div class="col-sm-8">
                                <input type="number" id="inputKilosR5" placeholder="Kilogramos" class="form-control form-control-sm mt-1">
                              </div>
                            </div>
                            <button id="btnGuardaR5" class="btn btn-sm btn-success mt-1">Guardar</button>

                            </div>
                          </div><!-- /card -->
                        </div>

                      </div>
                      

                    </div>
                  </div><!-- /card -->
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" id="cierraProcesado" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
          <!-- /Modal Procesado -->


          <!-- Modal Procesado descompuesto-->
          <div class="modal fade" id="modal_procesado_descompuesto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header bg-danger">
                  <h5 class="modal-title" id="exampleModalLabel"><strong>Pollo Procesado Descompuesto</strong></h5>
                  
                </div>
                <div class="modal-body">
                  <div class="card text-center">
                    <div class="card-body">

                      <div class="row">

                        <div class="col-4">
                          <div class="card text-center">
                            <div class="card-header bg-secondary">
                              <h5><strong>R 3</strong></h5>
                            </div>
                            <div class="card-body">
                              
                              <div class="form-group row">
                              <label for="inputPassword" class="col-sm-4 col-form-label">Lote</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputLoteR3_2" placeholder="Lote">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputPassword" class="col-sm-5 col-form-label">Cantidad</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="inputCantidadR3_2" placeholder="Cantidad">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputPassword" class="col-sm-4 col-form-label">Peso</label>
                              <div class="col-sm-8">
                                <input type="number" id="inputKilosR3_2" placeholder="Kilogramos" class="form-control form-control-sm mt-1">
                              </div>
                            </div>
                            <button id="btnGuardaR3_2" class="btn btn-sm btn-success mt-1">Guardar</button>

                            </div>
                          </div><!-- /card -->
                        </div><!-- /col-3 -->

                        <div class="col-4">
                          <div class="card text-center">
                            <div class="card-header bg-secondary">
                              <h5><strong>R 4</strong></h5>
                            </div>
                            <div class="card-body">
                              
                              <div class="form-group row">
                              <label for="inputPassword" class="col-sm-4 col-form-label">Lote</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputLoteR4_2" placeholder="Lote">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputPassword" class="col-sm-5 col-form-label">Cantidad</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="inputCantidadR4_2" placeholder="Cantidad">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputPassword" class="col-sm-4 col-form-label">Peso</label>
                              <div class="col-sm-8">
                                <input type="number" id="inputKilosR4_2" placeholder="Kilogramos" class="form-control form-control-sm mt-1">
                              </div>
                            </div>
                            <button id="btnGuardaR4_2" class="btn btn-sm btn-success mt-1">Guardar</button>

                            </div>
                          </div><!-- /card -->
                        </div>

                        <div class="col-4">
                          <div class="card text-center">
                            <div class="card-header bg-secondary">
                              <h5><strong>R 5</strong></h5>
                            </div>
                            <div class="card-body">
                              
                              <div class="form-group row">
                              <label for="inputPassword" class="col-sm-4 col-form-label">Lote</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Lote" id="inputLoteR5_2">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputPassword" class="col-sm-5 col-form-label">Cantidad</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="inputCantidadR5_2" placeholder="Cantidad">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputPassword" class="col-sm-4 col-form-label">Peso</label>
                              <div class="col-sm-8">
                                <input type="number" id="inputKilosR5_2" placeholder="Kilogramos" class="form-control form-control-sm mt-1">
                              </div>
                            </div>
                            <button id="btnGuardaR5_2" class="btn btn-sm btn-success mt-1">Guardar</button>

                            </div>
                          </div><!-- /card -->
                        </div>

                      </div>
                      

                    </div>
                  </div><!-- /card -->
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" id="cierraProcesado" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
          <!-- /Modal Procesado descompuesto-->

          <!-- Modal Procesado por Codigo -->
          <div class="modal fade" id="modal_procesado_codigo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header bg-warning">
                  <h5 class="modal-title" id="exampleModalLabel"><strong>Pollo Procesado por Codigo</strong></h5>
                </div>
                <div class="modal-body">
                  <div class="card text-center">
                    <div class="card-body">

                      <div class="row">
                        <!-- <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Leer ID</span>
                          </div>
                          <input type="text" id="inpuAddProcesadoId" class="form-control">
                        </div> -->
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Leer Código</span>
                          </div>
                          <input type="text" id="inpuAddProcesadoCode" class="form-control">
                        </div>
                      </div>

                      <div class="row justify-content-md-center">

                        <div class="col-md-9">
                          <div class="card text-center">
                            <div class="card-header bg-secondary">
                              <h5><strong>Agregar Procesado</strong></h5>
                            </div>
                            <div class="card-body">
                              <table class="table" id="tableR3">
                                <thead>
                                  <tr>
                                    <th scope="col-md-1">Categoria</th>
                                    <th scope="col-md-2">Código</th>
                                    <th scope="col-md-1">Peso</th>
                                    <th scope="col-md-1">Lote</th>
                                    <th scope="col-md-1"><i class="far fa-trash-alt"></i></th>
                                  </tr>
                                </thead>
                                <tbody>

                                </tbody>
                              </table>
                            <button id="btnGuardaR3" class="btn btn-sm btn-success mt-1" onclick="postIncrementaProcesadobyCode()">Guardar Todo</button>
                            </div>
                          </div><!-- /card -->
                        </div><!-- /col-3 -->

                        <!-- <div class="col-4">
                          <div class="card text-center">
                            <div class="card-header bg-secondary">
                              <h5><strong>R 4</strong></h5>
                            </div>
                            <div class="card-body">
                              
                              <table class="table" id="tableR4">
                                <thead>
                                  <tr>
                                    <th scope="col">Peso</th>
                                    <th scope="col">Lote</th>
                                    <th scope="col"><i class="far fa-trash-alt"></i></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  
                                </tbody>
                              </table>
                            <button id="btnGuardaR4" class="btn btn-sm btn-success mt-1">Guardar</button>

                            </div>
                          </div>
                        </div> -->

                        <!-- <div class="col-4">
                          <div class="card text-center">
                            <div class="card-header bg-secondary">
                              <h5><strong>R 5</strong></h5>
                            </div>
                            <div class="card-body">
                              
                              <table class="table" id="tableR5">
                                <thead>
                                  <tr>
                                    <th scope="col">Peso</th>
                                    <th scope="col">Lote</th>
                                    <th scope="col"><i class="far fa-trash-alt"></i></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  
                                </tbody>
                              </table>
                            <button id="btnGuardaR5" class="btn btn-sm btn-success mt-1">Guardar</button>

                            </div>
                          </div>
                        </div> -->

                      </div>
                      

                    </div>
                  </div><!-- /card -->
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" id="cierraProcesado" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
          <!-- /Modal Procesado por Codigo -->

        <!-- Contenido -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
