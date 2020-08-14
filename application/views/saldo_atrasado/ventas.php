<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-white">    
    <div class="row mt-1">
      <div class="col-3 ml-3 border">
      
        <!-- add Cliente -->
        <div class="input-group mb-3 mt-2">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Cliente</span>
          </div>
          <input type="text" id="inputBuscaProducto" onClick="this.select();" class="form-control"  aria-label="Username" aria-describedby="basic-addon1">
        </div>					
        <!-- add saldo -->
        <div class="form-group">
          <label for="exampleInputEmail1">Agregar Saldo Atrasado</label>
          <input id="inputPago" value="" type="number" min="0" step="any" class="form form-control col-8" placeholder="$" autocomplete="off">
          <button id="btnCobrar" class="btn btn-success btn-block col-5 mt-3">Guardar</button>
        </div>
        <div class="row" id="alertasSave"></div>

        <!-- Alerta Error -->
        <?php if ($this->session->flashdata("error")):?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong><?php echo $this->session->flashdata("error") ?></strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>
        <!-- Fin alerta Error -->

        <!-- Alerta success -->
        <?php if ($this->session->flashdata("success")):?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong><?php echo $this->session->flashdata("success") ?></strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>
        <!-- Fin alerta success -->
      </div><!-- /col- -->



      <div class="col-8">
      <table id="tbl_saldo_atrasado" class="table table-bordered table-sm table-hover dataTables">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Cliente</th>
            <th scope="col">Saldo atrasado</th>
            <th scope="col">Opcion</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($clientes)): 
          $itera =0;?>
            <?php foreach($clientes as $item): ?>
              <tr>
                <th scope="row"><?php echo $itera+=1; ?></th>
                <td><?php echo $item->cliente; ?></td>
                <td><?php echo $item->precio_kg; ?></td>
                <td><a href="<?php echo base_url('Ventas/eliminaSaldoAtrasado/').$item->id;?>" class="btn btn-sm btn-danger">Cancelar</a></td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>         
        </tbody>
      </table>
      </div>
    </div><!-- /row -->
  </div><!-- content -->

			
          
     