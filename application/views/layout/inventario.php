    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid"> 
        <!-- Main content -->
        <section class="container-fluid">
            <div class="container-fluid">
                <form id="configform" name= "input" action="#" method="get">
                    <div class="row pt-4 bg-white">
                    
                        <div class="col-md-3">
                            <input class="form-control form-control-sm" type="text" placeholder="SELECCIONAR CLIENTE" id="inputBuscarCliente" onClick="this.select();">                        
                        </div>
                        <div class="col-md-3">
                            <input class="form-control form-control-sm" type="text" placeholder="SELECCIONAR POLLO" id="inputPollo" onClick="this.select();" disabled> 
                        </div>
                        <div class="col-md-3">
                            <input class="form-control form-control-sm" type="text" placeholder="CODIGO" id="inputCodigo" onClick="this.select();" disabled>
                        </div>
                        <div class="col-md-3">
                            <input id="inputFecha" placeholder="" class="form-control form-control-sm border-0 bg-light" type="text" readonly>
                        </div>
                    </div><!-- /.row -->

                    <div class="row pt-1 bg-white">
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label text-right">PRECIO</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control form-control-sm" id="inputPrecio" onClick="this.select();">
                                </div>
                            </div>                        
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label text-right">CANTIDAD</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control form-control-sm" id="inputCantidad" onClick="this.select();">
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label text-right">KILOS</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control form-control-sm" id="inputKilos" onClick="this.select();">
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-3">
                            <button type="button" id="btnAddCart" class="btn btn-sm btn-primary">AGREGAR <i class="fas fa-shopping-cart"></i></button>
                            <button type="reset" id="btnResetCart" class="btn btn-sm btn-outline-danger">LIMPIAR <i class="fas fa-shopping-cart"></i></button>
                        </div>
                    </div><!-- /.row -->

                    <!-- PRODUCTOS -->
                    <div class="row mt-1">
                        <div class="col-md-9 bg-white pt-3">
                            <div id="contenedorProductos">
                                <table id="carrito-table" class="table table-sm table-bordered table-hover fixed_header">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">Cantidad</th>
                                            <th class="text-center">Producto</th>
                                            <th class="text-center">Kilos</th>
                                            <th class="text-center">Precio</th>
                                            <th class="text-center">Importe</th>
                                            <th class="text-center">Opcion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /COL ADD TABLE CARRITO -->
                        <div class="col-md-3 bg-white pt-4">
                            <!-- TOTAL VENTA -->
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-6 col-form-label text-right"><strong>SUBTOTAL</strong></label>
                                <div class="col-sm-6">
                                    <strong><label id="lblsubTotalVenta" for="staticEmail" class="col-sm-12 col-form-label text-right">0</label></strong>
                                </div>
                            </div> 
                            <!-- /TOTAL VENTA -->
                            <!-- SALDO PENDIENTE -->
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-6 col-form-label text-right"><strong>SALDO</strong></label>
                                <div class="col-sm-6">
                                    <strong><label id="lblSaldoPendiente" for="staticEmail" class="col-sm-12 col-form-label text-right">0</label></strong>
                                </div>
                            </div> 
                            <!-- /SALDO PENDIENTE -->
                            <!-- TOTAL -->
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-6 col-form-label text-right"><strong>TOTAL</strong></label>
                                <div class="col-sm-6">
                                    <strong>
                                        <label id="lblTotal" for="staticEmail" class="col-sm-12 col-form-label text-right">0</label>
                                    </strong>
                                </div>
                            </div> 
                            <!-- /TOTAL -->
                            <div class="form-group row">
                                <div class="col-sm-8">
                                    <input id="inputImportePago" data-type="currency" type="text" class="form-control form-control-sm" min="0" placeholder=" $ PAGO RECIBIDO" onClick="this.select();">
                                </div>
                                <div class="col-sm-4 text-center">                                    
                                    <button id="btnPagar" type="button" class="btn btn-sm btn-primary btn-block" disabled>PAGAR <i class="fas fa-shopping-cart"></i></button>
                                </div>
                            </div> 
                        </div><!-- /COL TOTAL VENTA -->

                    </div><!-- /row productos -->
                </form>
                <!-- /PRODUCTOS -->
                <!-- #-#-#-#-#-#-#-#-#-#--#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-  -->
                <!-- ESTADOS DE CUENTA -->
                <div class="row mt-1 bg-white pt-3">
                    <!-- col saldo detalles -->
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- TABLA SALDOS PENDIENTES -->
                                <table id="saldos-table" class="table table-sm table-bordered table-hover fixed_header">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center">Fecha</th>
                                            <th class="text-center">Saldo</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table><!-- /TABLA SALDOS PENDIENTES -->
                            </div><!-- /COL SALDOS PENDIENTES -->
                            <div class="col-md-8">
                                <!-- /TABLE DETALLES -->
                                <table id="detalles-table" class="table table-sm table-bordered table-hover fixed_header">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th class="text-center">Cantidad</th>
                                            <th class="text-center">Producto</th>
                                            <th class="text-center">Kilos</th>
                                            <th class="text-center">Precio</th>
                                            <th class="text-center">Importe</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table><!-- /TABLE DETALLES -->
                            </div><!-- /COL DETALLES -->
                        </div>
                    </div><!-- /col saldo detalles -->
                    <div class="col-md-3">
                        <!-- TABLA HISTORIAL ABONOS -->
                        <table id="abonos-table" class="table table-sm table-bordered table-hover fixed_header">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center">Fecha</th>
                                            <th class="text-center">Abono</th>
                                            <th class="text-center">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table><!-- /TABLA HISTORIAL ABONOS -->
                    </div><!-- /col HISTORIAL ABONOS -->
                </div><!-- /row -->
                <!-- /ESTADOS DE CUENTA -->
            </div><!-- /.container -->
        </section><!-- /.content -->
        <!-- /Main content -->
    </div><!-- /.content-wrapper -->

    <!-- MODAL PAGAR / COBRAR VENTA -->
    <div id="modalPagar" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-light">SELECCIONAR OPCIONES DE PAGO </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- FORMA DE PAGO -->
                <div class="form-check form-check-inline custom-radio">
                    <input class="form-check-input custom-control-input" 
                            type="radio" 
                            name="optionsFormaPago" 
                            id="inlineRadio1" value="1" checked="">
                    <label class="form-check-label custom-control-label" 
                            for="inlineRadio1">Efectivo</label>
                </div>
                <div class="form-check form-check-inline custom-radio">
                    <input class="form-check-input custom-control-input" 
                            type="radio" 
                            name="optionsFormaPago" 
                            id="inlineRadio2" value="2">
                    <label class="form-check-label custom-control-label" 
                            for="inlineRadio2">Cheque</label>
                </div>
                <div class="form-check form-check-inline custom-radio">
                    <input class="form-check-input custom-control-input" 
                            type="radio" 
                            name="optionsFormaPago" 
                            id="inlineRadio3" value="3">
                    <label class="form-check-label custom-control-label" 
                            for="inlineRadio3">Transferencia</label>
                </div>
                <!-- /FORMA DE PAGO -->
                <!-- <hr> -->
                <div class="form-check form-check-inline custom-radio" style="display:none">
                    <input class="form-check-input custom-control-input" 
                            type="radio" 
                            name="optionsAbonarVenta" 
                            id="abonarVenta1" value="venta_actual" checked="">
                    <label class="form-check-label custom-control-label" 
                            for="abonarVenta1">Abonar a Venta</label>
                </div>
                <div class="form-check form-check-inline custom-radio" style="display:none">
                    <input class="form-check-input custom-control-input" 
                            type="radio" 
                            name="optionsAbonarVenta" 
                            id="abonarVenta2" value="saldo_pendiente">
                    <label class="form-check-label custom-control-label" 
                            for="abonarVenta2">Abonar a Saldo Pendiente</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                <button id="btnGuardarVenta" type="button" class="btn btn-success btn-sm">Guardar</button>
            </div>
            </div>
        </div>
        </div>
    <!-- /MODAL PAGAR / COBRAR VENTA -->

    <!-- MODAL ABONAR VENTA  -->
    <div id="modalAbonar" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-light">SELECCIONAR OPCIONES DE ABONO </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- FORMA DE PAGO -->
                <div class="form-check form-check-inline custom-radio">
                    <input class="form-check-input custom-control-input" 
                            type="radio" 
                            name="optionsAbono" 
                            id="abono1" value="1" checked="">
                    <label class="form-check-label custom-control-label" 
                            for="abono1">Efectivo</label>
                </div>
                <div class="form-check form-check-inline custom-radio">
                    <input class="form-check-input custom-control-input" 
                            type="radio" 
                            name="optionsAbono" 
                            id="abono2" value="2">
                    <label class="form-check-label custom-control-label" 
                            for="abono2">Cheque</label>
                </div>
                <div class="form-check form-check-inline custom-radio">
                    <input class="form-check-input custom-control-input" 
                            type="radio" 
                            name="optionsAbono" 
                            id="abono3" value="3">
                    <label class="form-check-label custom-control-label" 
                            for="abono3">Transferencia</label>
                </div>
                <!-- /FORMA DE PAGO -->
                <!-- <hr> -->
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-4 col-form-label text-right">SALDO PENDIENTE</label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" id="inputMostrarSaldo" value="">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-4 col-form-label text-right">ABONO</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control form-control-sm" id="inputAbono" placeholder="IMPORTE" data-type="currency" onClick="this.select();">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                <button id="btnGuardarAbono" data-id="" type="button" class="btn btn-success btn-sm">Guardar</button>
            </div>
            </div>
        </div>
        </div>
    <!-- /MODAL ABONAR VENTA -->
  

  
