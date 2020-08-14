<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-white">
    
    <!-- Main content -->
    <section class="content">
    
      <div class="container-fluid" id="app">
      <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <button 
          id="btnAddVivo"
          class="btn btn-primary ml-2" 
          data-toggle="modal" 
          data-target="#ModalVivo" 
          data-backdrop="static" 
          data-keyboard="false">
            <i class="fas fa-plus"></i> Ingresar Pollo Vivo
            <span class="badge badge-light"><?php echo $vivo['0']['cantidad'] ?></span>
        </button>
      </li>
      <li class="nav-item">
        <button 
          id="btnAddProcesado"
          class="btn btn-primary ml-2" 
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
      </li>
    </ul>
  </nav>

        <!-- Contenido -->
        
        <!-- Pollo vivo -->
        <div class="row mt-2" style="display:none">
          <div class="col-md-12">

            <!-- Stock Vivo  -->
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
          </div>

          <div class="col-6">
            <div id="stock_procesado" style="display:none"></div>
            <!-- style="display:none" -->
          </div>


        </div>

        <!-- Stock Procesado  -->
        <div class="row">
          <!-- R#3 -->
          <div class="col-md-4">
            <table id="table-procesadoR3" class="table table-bordered table-sm table-hover">
              <thead class="thead-light">
                <tr class="text-center">
                  <th colspan="2" class="text-warning">
                    Procesado R3
                  </th>
                  <th colspan="2">
                    Disponible
                  </th>
                </tr>
                <tr class="bg-light text-white">
                  <th scope="col" class="text-center">Lote</th>
                  <th scope="col" class="text-center">Peso</th>
                  <th scope="col" class="text-center">Cantidad</th>
                  <th scope="col" class="text-center">Kilos</th>
                  <th scope="col" class="text-center"></th>
                </tr>
              </thead>
              <tbody>
              <?php if ($stock_r3) { 
                      foreach ($stock_r3 as $key) {
              ?>
                        <tr>
                        <th scope="row" class="text-center"><?php echo $key['lote'] ?></th>
                        <th class="text-center"><?php echo $key['kilos'] ?></td>
                        <th scope="row" class="text-center"><?php echo $key['stock_cantidad'] ?></th>
                        <th scope="row" class="text-center"><?php echo $key['stock_kilos'] ?></th>
                        <th scope="row" class="text-center">
                          <a href="#">
                            <i class="far fa-trash-alt text-danger elimina-inventory" data-id="<?php echo $key['codigo'] ?>"></i>
                          </a>
                        </th>
                      </tr> 
              <?php 
                      }                                          
                    } 
              ?>               
              </tbody>
            </table>
          </div>

          <!-- R#4 -->
          <div class="col-md-4">
            <table id="table-procesadoR4" class="table table-bordered table-sm table-hover">
              <thead class="thead-light">
                  <tr class="text-center">
                  <th colspan="2" class="text-warning">
                    Procesado R4
                  </th>
                  <th colspan="2">
                    Disponible
                  </th>
                </tr>
                <tr class="bg-dark text-white">
                  <th scope="col" class="text-center">Lote</th>
                  <th scope="col" class="text-center">Peso</th>
                  <th scope="col" class="text-center">Cantidad</th>
                  <th scope="col" class="text-center">Kilos</th>
                  <th scope="col" class="text-center"></th>
                </tr>
              </thead>
              <tbody>
              <?php if ($stock_r4) { 
                      foreach ($stock_r4 as $key) {
              ?>
                        <tr>
                        <th scope="row" class="text-center"><?php echo $key['lote'] ?></th>
                        <th class="text-center"><?php echo $key['kilos'] ?></td>
                        <th scope="row" class="text-center"><?php echo $key['stock_cantidad'] ?></th>
                        <th scope="row" class="text-center"><?php echo $key['stock_kilos'] ?></th>
                        <th scope="row" class="text-center">
                        <a href="#">
                            <i class="far fa-trash-alt text-danger elimina-inventory" data-id="<?php echo $key['codigo'] ?>"></i>
                          </a>
                        </th>
                      </tr> 
              <?php 
                      }                                          
                    } 
              ?>               
              </tbody>
            </table>
          </div>

          <!-- R#5 -->
          <div class="col-md-4">
            <table id="table-procesadoR5" class="table table-bordered table-sm table-hover">
              <thead class="thead-light">
                  <tr class="text-center">
                  <th colspan="2" class="text-warning">
                    Procesado R5
                  </th>
                  <th colspan="2">
                    Disponible
                  </th>
                </tr>
                <tr class="bg-dark text-white">
                  <th scope="col" class="text-center">Lote</th>
                  <th scope="col" class="text-center">Peso</th>
                  <th scope="col" class="text-center">Cantidad</th>
                  <th scope="col" class="text-center">Kilos</th>
                  <th scope="col" class="text-center"></th>
                </tr>
              </thead>
              <tbody>
              <?php if ($stock_r5) { 
                      foreach ($stock_r5 as $key) {
              ?>
                        <tr>
                        <th scope="row" class="text-center"><?php echo $key['lote'] ?></th>
                        <th class="text-center"><?php echo $key['kilos'] ?></td>
                        <th scope="row" class="text-center"><?php echo $key['stock_cantidad'] ?></th>
                        <th scope="row" class="text-center"><?php echo $key['stock_kilos'] ?></th>
                        <th scope="row" class="text-center">
                        <a href="#">
                            <i class="far fa-trash-alt text-danger elimina-inventory" data-id="<?php echo $key['codigo'] ?>"></i>
                          </a>
                        </th>
                      </tr> 
              <?php 
                      }                                          
                    } 
              ?>                                   
              </tbody>
            </table>
          </div>

        </div> <!-- /row stock procesado -->

          <!-- Modal Pollo vivo -->
          <div class="modal fade" id="ModalVivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                  <h5 class="modal-title" id="exampleModalLabel"><strong>Ingresar Pollo Vivo</strong></h5>
                  
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
                  <button type="button" class="btn btn-dark" id="cierraVivo" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
          <!-- /Modal Pollo vivo -->

          <!-- Modal Pollo vivo Ahogado -->
          <div class="modal fade" id="ModalVivoAhogado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                  <h5 class="modal-title" id="exampleModalLabel"><strong>Registrar Pollo Ahogado</strong></h5>
                  
                </div>
                <div class="modal-body">
                  <div class="card text-center">
                    <div class="card-body">
                      <form action="<?php echo base_url('Inventario/registraAhogado');?>" method="post">
                        <div class="form-group row">
                          <label for="inputPassword" class="col-sm-4 col-form-label">Cantidad</label>
                          <div class="col-sm-8">
                            <input type="number" name="inputCantidadAhogado" placeholder="cantidad" class="form-control form-control-sm mt-1" id="inputCantidadAhogado">
                          </div>
                        </div>
                        <a href="#" class="btn btn-success mt-1" id="saveAhogado" style="display:none">Guardar</a>
                        <button name="saveAhogado" class="btn btn-sm btn-success" type="submit">Guardar</button>
                      </form>
                    </div>
                  </div><!-- /card -->
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-dark" id="cierraVivo" data-dismiss="modal">Cancelar</button>
                </div>
              </div>
            </div>
          </div>
          <!-- /Modal Pollo vivo Ahogado-->

          


          <!-- Modal Procesado descompuesto-->
          <div class="modal fade" id="modal_procesado_descompuesto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header bg-danger">
                  <h5 class="modal-title" id="exampleModalLabel"><strong>Procesado Descompuesto</strong></h5>
                  
                </div>
                <div class="modal-body">

                <div class="input-group my-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">CODIGO</span>
                  </div>
                  <input type="text" class="form-control" id="inputCodigoDescompuesto" onclick="this.select()">
                </div>

                <div class="row">
                  <!-- Cantidad KG -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="peso"><h5>Cantidad</h5></label>
                      <input type="number" class="form-control" id="inputCantidadDescompuesto" onclick="this.select()">
                    </div>
                  </div>
                  <!-- Pesos KG -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="peso"><h5>Kilos</h5></label>
                      <input type="text" class="form-control" id="inputKilosDescompuesto" onclick="this.select()">
                    </div>
                  </div>                                
                </div>


                </div><!-- /Modal body -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-success" id="btnGuardaDescompuesto">Guardar</button>
                  <button type="button" class="btn btn-danger" id="btnCandelarDescompuesto">Cancelar</button>
                </div>
              </div>
            </div>
          </div>
          <!-- /Modal Procesado descompuesto-->

          <!-- Modal Procesado por Codigo -->
          <div class="modal fade" id="modal_procesado_codigo" tabindex="-1" role="dialog"     aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Ingresar Pollo Procesado</strong></h5>                    
                </div>
                <div class="modal-body">

                    <div class="input-group mt-1 input-group-sm">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Leer Código</span>
                      </div>
                      <input type="text" id="inpuAddProcesadoCode" class="form-control">                                    
                    </div>
                      <small class="text-warning">
                        Presionar ENTER si introduce el codigo manualmente
                      </small>                    
                    <table class="table" id="tableR3">
                      <thead>
                        <tr>
                          <th scope="col">Código</th>
                          <th scope="col">Categoria</th>
                          <th scope="col">Lote</th>
                          <th scope="col">Peso</th>
                          <th scope="col"><i class="far fa-trash-alt"></i></th>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                    
                </div><!-- /Body Modal -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-dark" id="cierraProcesado" data-dismiss="modal">Cerrar</button>
                  <button id="btnGuardaR3" class="btn btn-sm btn-success" onclick="postIncrementaProcesadobyCode()">Guardar Todo</button>
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
