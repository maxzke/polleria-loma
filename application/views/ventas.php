<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-white">
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row mt-1" id="punto-de-venta">
          <div class="col-9">  

		  	<!-- VENTA DE POLLO PROCESADO -->
			<div class="row bg-warning" id="input-form-procesado" style="display: none">
				<div class="col-md-5 mx-auto">
					<label for="inputCompletas">VENTA DE POLLO PROCESADO</label>	
					<div class="tab-content" id="v-pills-tabContent">
						<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
						<!-- Codigo -->
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">CODIGO</span>
								</div>
								<input type="text" class="form-control" id="inpuAddProcesadoCode" aria-describedby="basic-addon3">
							</div>
						<!-- /codigo -->
						</div>
						<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
							<!-- Manual -->
							<div class="form-row">                                    
								<div class="form-group col-md-4">
								<label for="inputEmail4">Categoria</label>
								<select id="inputCategoriaManual" class="form-control">
									<option selected>Seleccionar</option>
									<option value="22">R3</option>
									<option value="20">R4</option>
									<option value="18">R5</option>
								</select>
								</div>
								<div class="form-group col-md-4">
								<label for="inputEmail4">Lote</label>
								<input type="text" class="form-control" id="inputLoteManual">
								</div>
								<div class="form-group col-md-4">
									<label for="inputPassword4">Peso</label>
									<input type="number" class="form-control" id="inputPesoManual">
								</div>
							</div> 
							<!-- /Manual -->
						</div>
					</div>				
					
				</div>
				<br>
			</div>   
			<!-- /VENTA DE POLLO PROCESADO -->

			<!-- VENTA DE POLLO VIVO -->
			<div class="row" id="input-form-vivo" style="display: none">
				<div class="col-md-10 mx-auto">
					<label for="inputCompletas">VENTA DE POLLO &nbsp;</label><label id="labelTipoPollo" class="text-uppercase"></label>
					<div class="row">
						<!-- precio -->
						<div class="col-md-3">
							<div class="form-group">
								<label for="precio"><h5>Precio</h5></label>
								<input type="text" class="form-control" id="input_precio">
							</div>
						</div>
						<!-- Cantidad -->
						<div class="col-md-3">
							<div class="col">
								<div class="form-group">
									<label for="cantidad"><h5>Cantidad</h5></label>
									<input type="number" class="form-control" id="input_cantidad" min="0" step="1">
								</div>
							</div>
						</div>
						<!-- Pesos KG -->
						<div class="col-md-3">
							<div class="form-group">
								<label for="peso"><h5>Kilos</h5></label>
								<input type="text" class="form-control" id="input_kilos">
							</div>
						</div>

						<!-- Total -->
						<div class="col-md-3" style="display: none">
							<div class="form-group">
								<label for="peso"><h5>Importe</h5></label>
								<input type="text" class="form-control border-0" id="input_mostrar_importe" value="0" readonly>
							</div>
						</div>
						<!-- <div class="col text-right">
							<h1 class="mt-4"><label id="total">0.0</label></h1>
						</div> -->
						<div class="col">
							<button id="addCarrito" class="btn btn-info mt-4" style="display: none">
								<i class="fa fa-plus"></i>
							</button>
						</div>
					</div>
				</div>
			</div>  
			<!-- /VENTA DE POLLO VIVO --> 

			<!-- VENTA DE POLLO MENUDEO -->
			<div class="row  bg-secondary" id="input-form-menudeo" style="display: none">
				<div class="col-md-10 mx-auto">
					<label for="inputCompletas">VENTA DE POLLO MENUDEO ::: &nbsp;</label><label id="labelTipoPolloMenudeo" class="text-uppercase"></label>
					<div class="row">
						<!-- precio -->
						<div class="col-md-3">
							<div class="form-group">
								<label for="precio"><h5>Precio</h5></label>
								<input type="text" class="form-control" id="input_precio_menudeo" onclick="this.select()">
							</div>
						</div>
						<!-- Pesos KG -->
						<div class="col-md-3">
							<div class="form-group">
								<label for="peso"><h5>Kilos</h5></label>
								<input type="text" class="form-control" id="input_kilos_menudeo" onclick="this.select()">
							</div>
						</div>
						<!-- <div class="col text-right">
							<h1 class="mt-4"><label id="total">0.0</label></h1>
						</div> -->
						<div class="col">
							<button id="addCarrito" class="btn btn-info mt-4" style="display: none">
								<i class="fa fa-plus"></i>
							</button>
						</div>
					</div>
				</div>
			  	<div class="card card-body bg-light border border-dark">
					<section id="listaMenudeo">
						<a href="#" class="btn btn-outline-secondary mt-2 ml-2 menudeo" 
						data-pollo="POLLO SURTIDO">POLLO SURTIDO</a>

						<a href="#" class="btn btn-outline-secondary mt-2 ml-2 menudeo" 
						data-pollo="PIERNA S/CADERA">PIERNA S/CADERA</a>

						<a href="#" class="btn btn-outline-secondary mt-2 ml-2 menudeo" 
						data-pollo="PIERNA C/CADERA">PIERNA C/CADERA</a>

						<a href="#" class="btn btn-outline-secondary mt-2 ml-2 menudeo" 
						data-pollo="PECHUGA S/HUACAL">PECHUGA S/HUACAL</a>

						<a href="#" class="btn btn-outline-secondary mt-2 ml-2 menudeo" 
						data-pollo="PECHUGA C/HUACAL">PECHUGA C/HUACAL</a>

						<a href="#" class="btn btn-outline-secondary mt-2 ml-2 menudeo" 
						data-pollo="ALITAS">ALITAS</a>

						<a href="#" class="btn btn-outline-secondary mt-2 ml-2 menudeo" 
						data-pollo="FILETE">FILETE</a>

						<a href="#" class="btn btn-outline-secondary mt-2 ml-2 menudeo" 
						data-pollo="MENUDENCIA">MENUDENCIA</a>

						<a href="#" class="btn btn-outline-secondary mt-2 ml-2 menudeo" 
						data-pollo="MENUDO FRIO">MENUDO FRIO</a>
					</section>
			  </div>
			</div>
			<!-- /VENTA DE POLLO MENUDEO -->
			
			<!-- Pago -->
			<div class="container mt-1">
				<div class="row">
					<div class="col-11">
						<table id="carrito-table" class="table table-sm table-bordered table-hover">
							<thead class="thead-dark">
								<tr>
									<th scope="col" class="text-center">Cantidad</th>
									<th scope="col" class="text-center">Producto</th>
									<th scope="col" class="text-center">Kilos</th>
									<th scope="col" class="text-center">Precio</th>
									<th scope="col" class="text-center">Importe</th>
									<th scope="col" class="text-center">Opcion</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
							<tfoot>
								<tr class="border border-0">									
									<td colspan="4" class="text-right"><h5><label class="mt-2">Total a Pagar</label></h5></td>
									<td class="text-center"><h5><label class="mt-2" id="lblTotal"></label></h5></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="4" class="text-right"></td>
									<td class="text-center"  style="width:15%">
										<input id="input_pago" type="text" class="form-control form-control-sm" placeholder="Pagar" onclick="this.select();">
									</td>
									<td></td>
								</tr>								
							</tfoot>
						</table>
						<div class="row" id="alertasPagos">
							
							<!-- Agregar a deudores -->
							
						</div>
					</div>
				</div>
			</div>

			

			
          </div><!-- /col-9 -->
          <div class="col-3" id="tarjetas" style="display: none">
          	<div class="row mt-2">

	      		<div class="col-8 ml-5">
		            <!-- small box -->
		            <a href="#">
		            	<div class="small-box bg-info" id="card-vivo">
			              <div class="inner">
			                <h4><strong>Vivo</strong></h4>
			                <h4>$ <span id="card-precio_vivo">0.0</span></h4>
			              </div>
			              <div class="icon">
			                <i class="fa fa-plus"></i>
			              </div>
			            </div>
		            </a>
				</div>
				
				<div class="col-8 ml-5">
					<!-- small box -->
					<a href="#">
						<div class="small-box bg-success" id="card-alinado">
						<div class="inner">
							<h4><strong>Aliñado</strong></h4>
							<h4>$ <span id="card-precio_alinado">0.0</span></h4>
						</div>
						<div class="icon">
							<i class="fa fa-plus"></i>
						</div>
						</div>
					</a>
				</div>

				<div class="col-8 ml-5" id="card-procesado">		  	
					<!-- small box -->
					<a href="#">
						<div class="small-box bg-warning" data-toggle="modal" data-target=".procesado-modal-xl_">
						<div class="inner">
							<h4><strong>Procesado</strong></h4>
							<h4>$ <span id="card-precio_procesado">0.0</span></h4>
						</div>
						
						<div class="icon">
							<i class="fa fa-plus"></i>
						</div>
						</div>
					</a> 
				</div>

				<div class="col-8 ml-5">
					<!-- small box -->
					<a data-toggle="collapse" href="#collapseExample">
						<div class="small-box bg-secondary" id="card-menudeo">
					<div class="inner">
						<h4><strong>Menudeo</strong></h4>
						<br><br>
					</div>
					<div class="icon">
						<i class="fa fa-plus"></i>
					</div>
					</div>
					</a>
				</div>

				<div class="col-8 ml-5">
					<!-- small box -->
					<a href="#">
						<div class="small-box bg-danger" id="card-desplumado">
						<div class="inner">
							<h4><strong>Desplumado</strong></h4>
							<h4>$ <span id="card-precio_desplumado">0.0</span></h4>
						</div>
						<div class="icon">
							<i class="fa fa-plus"></i>
						</div>              
						</div>
					</a>
				</div>


          	</div>
          </div>
        </div>
        <!-- /.row -->
        

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

			<!-- Modal Editar Procesado -->
				<div class="modal fade" id="modalEditarProcesado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
					<div class="modal-header bg-warning">
						<h5 class="modal-title" id="exampleModalLabel">Editar Pollo Procesado</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<!-- precio -->
							<div class="col-md-12">
								<div class="form-group">
								<label for="peso"><h5>Cantidad Disponible <span id="spanCantidadDisponible"></span></h5></label>							
								</div>
							</div>
							<!-- Cantidad KG -->
							<div class="col-md-6">
								<div class="form-group">
									<label for="peso"><h5>Cantidad</h5></label>
									<input type="number" class="form-control" id="input_editar_cantidad_procesado" onclick="this.select()">
								</div>
							</div>
							<!-- Pesos KG -->
							<div class="col-md-6">
								<div class="form-group">
									<label for="peso"><h5>Kilos</h5></label>
									<input type="text" class="form-control" id="input_editar_kilos_procesado" onclick="this.select()">
								</div>
							</div>

						</row>
						
					</div><!-- /modal-body -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						<button type="button" class="btn btn-primary" id="btnActualizarProcesado">Guardar Cambios</button>
					</div>
					</div>
				</div>
				</div>
			<!-- /Modal Editar Procesado -->

			
  </div>
  <!-- /.content-wrapper -->