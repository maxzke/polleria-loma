const table_procesadoR3 = document.querySelector('#table-procesadoR3');
const table_procesadoR4 = document.querySelector('#table-procesadoR4');
const table_procesadoR5 = document.querySelector('#table-procesadoR5');
table_procesadoR3.addEventListener('click',eliminaInventarioById);
table_procesadoR4.addEventListener('click',eliminaInventarioById);
table_procesadoR5.addEventListener('click', eliminaInventarioById);

function eliminaInventarioById(e) {
  //e.target.classList.contains('elimina-inventory')
  //console.log(e.target.parentElement);
  if (e.target.classList.contains('elimina-inventory')) {
    let codigoRegistro = e.target.dataset.id;
    alertify.confirm('Desea Eliminar El Registro?', 'Presione OK para Borrar', function () { 
      
      $.ajax({
        type: 'ajax',
        method: 'post',
        url: 'http://localhost/polleria/inventario/eliminaRegistroProcesado',
        data: { id: codigoRegistro },
        async: true,
        dataType: 'json',
        success: function (response) {
          //console.log(response);           
          if (response.success) {
            document.location.reload();
          } else {
            alertify.set('notifier', 'position', 'bottom-center');
            alertify.error('Error, Intentar de nuevo !');
          }
        },
        error: function (response) {
          alertify.set('notifier', 'position', 'bottom-center');
          alertify.error('Error #256');

        }

      });
    }//end PRESS OK
      , function () { alertify.error('Cancel') });
  }
  
}
const p_procesado = document.getElementById('stock_procesado');
/*
* Pollo Ahogado
*/
const btnGuardaAhogado = document.getElementById('saveAhogado');
const inputCantidadAhogado = document.getElementById('inputCantidadAhogado');

/*
*   Pollo Vivo
*/
const saveVivo = document.getElementById('saveVivo');
const inputCantidadVivo = document.getElementById('inputCantidadVivo');
const table_vivo = document.querySelector('#table-vivo tbody');
/*
*   Pollo Procesado
*/
const table_procesado = document.querySelector('#table-procesado tbody');

const inputCantidadDescompuesto = document.querySelector('#inputCantidadDescompuesto');
const inputKilosDescompuesto = document.querySelector('#inputKilosDescompuesto');
const inputCodigoDescompuesto = document.querySelector('#inputCodigoDescompuesto');

const btnGuardaDescompuesto = document.querySelector('#btnGuardaDescompuesto');
btnGuardaDescompuesto.addEventListener('click',guardaDescompuesto);
btnCandelarDescompuesto = document.querySelector('#btnCandelarDescompuesto');
btnCandelarDescompuesto.addEventListener('click',cancelarDescompuesto);


const lote_r3 = document.getElementById('inputLoteR3');
const kilos_r3 = document.getElementById('inputKilosR3');
const btnGuarda_r3 = document.getElementById('btnGuardaR3');
//descompuesto
const lote_r3_2 = document.getElementById('inputLoteR3_2');
const cantidad_r3_2 = document.getElementById('inputCantidadR3_2');
const kilos_r3_2 = document.getElementById('inputKilosR3_2');
const btnGuarda_r3_2 = document.getElementById('btnGuardaR3_2');


const btnCerrarModal_vivo = document.getElementById('cierraVivo');
const btnCerrarModal_procesado = document.getElementById('cierraProcesado');

let existe_lote = 0;

btnCerrarModal_vivo.addEventListener('click',refrescarVivo);
btnCerrarModal_procesado.addEventListener('click',refrescarProcesado);

saveVivo.addEventListener('click',guardaVivo);
btnGuardaAhogado.addEventListener('click',guardaAhogado);


// arrayProcesado para insert by BarCode
let arrayProcesado = [];


function getTaras(e){
  let thislote = e.dataset.lote;
  let categoria = e.dataset.categoria;
  console.log(thislote);
  muestraTaras(thislote,categoria);
}

function muestraTaras(lote,categoria){
  $.ajax({
          type: 'ajax',
          method: 'post',
          url: 'http://localhost/polleria/inventario/get_por_lote_y_categoria',
          data: {categoria:categoria,lote:lote},
          async: true,
          dataType: 'json',
          success: function(response){      
            console.log(response);
            if (response.success) {
                alertify.set('notifier','position', 'bottom-center');
                alertify.success('Stock Procesado Actualizado !');
                console.log(response);
                
            }else{
              alertify.set('notifier','position', 'bottom-center');
              alertify.error('Verificar lote !');    
                    
            }            
          },
          error: function(response){
            console.log('error');
            console.log(response);

          }

        });
}

function refrescarVivo(){
    getVivo();    
}

function refrescarProcesado(){
    //actualizaModalProcesado();
    console.log('cerrado modal procesado add');
    document.location.reload();

}

function enterGuardar3(e){
    if (e.keyCode === 13) {
        guardaR3();
    }
}
function enterGuardar4(e){
    if (e.keyCode === 13) {
        guardaR4();
    }
}
function enterGuardar5(e){
    if (e.keyCode === 13) {
        guardaR5();
    }
}

function checkEnter3(e){
    if (e.keyCode === 13) {
        setfocus3();
    }
}
function setfocus3(){
    kilos_r3.focus();
}
function checkEnter4(e){
    if (e.keyCode === 13) {
        setfocus4();
    }
}
function setfocus4(){
    kilos_r4.focus();
}
function checkEnter5(e){
    if (e.keyCode === 13) {
        setfocus5();
    }
}
function setfocus5(){
    kilos_r5.focus();
}

function guardaR3(){
    cantidadR3 = 22;
    postGuardaProcesado('r3',kilos_r3.value,lote_r3.value,cantidadR3);
    postIncrementaProcesado('r3',kilos_r3.value,cantidadR3);
    kilos_r3.value = '';
    lote_r3.value = '';
}
function guardaR4(){
    cantidadR4 = 20;
    postGuardaProcesado('r4',kilos_r4.value,lote_r4.value,cantidadR4);
    postIncrementaProcesado('r4',kilos_r4.value,cantidadR4);
    kilos_r4.value = '';
    lote_r4.value = '';
}
function guardaR5(){
    cantidadR5 = 18
    postGuardaProcesado('r5',kilos_r5.value,lote_r5.value,cantidadR5);
    postIncrementaProcesado('r5',kilos_r5.value,cantidadR5);
    kilos_r5.value = '';
    lote_r5.value = '';
}

function guardaVivo(){
    console.log(inputCantidadVivo.value);
    postGuardaVivo(inputCantidadVivo.value);
    postIncrementaVivo(inputCantidadVivo.value);
    inputCantidadVivo.value = '';
    document.location.reload();
}

function guardaAhogado(){
  //(pollo,lote,cantidad,kilos)
  postGuardaRegistro(0,'ahogado',0,inputCantidadAhogado.value,0);
  postDecrementaVivo(inputCantidadAhogado.value);
  getVivo();
  inputCantidadAhogado.value = '';
}

function guardaDescompuestoR3(){
  console.log('r3');
  //(lote,kilos,cantidad)
  postDecrementaDescompuesto('descompuesto','r3',lote_r3_2.value,kilos_r3_2.value,cantidad_r3_2.value);
  refrescarProcesado();
}
function guardaDescompuestoR4(){
  console.log('r4');
  //(lote,kilos,cantidad)
  postDecrementaDescompuesto('descompuesto','r4',lote_r4_2.value,kilos_r4_2.value,cantidad_r4_2.value);
  refrescarProcesado();
}
function guardaDescompuestoR5(){
  
  postDecrementaDescompuesto('descompuesto','r5',lote_r5_2.value,kilos_r5_2.value,cantidad_r5_2.value);  
  refrescarProcesado();
}
function cancelarDescompuesto(){
  inputCantidadDescompuesto.value = "";
  inputCodigoDescompuesto.value = "";
  inputKilosDescompuesto.value = "";
  $('#modal_procesado_descompuesto').modal('hide');
}
/*
*   Ajax Post Decrementa Pollo Procesado Descompuesto
*/
function guardaDescompuesto(){
  let cantidad = inputCantidadDescompuesto.value;
  let codigo = inputCodigoDescompuesto.value;
  let kilos = inputKilosDescompuesto.value;
  postDecrementaDescompuesto(codigo,kilos,cantidad);
}
function postDecrementaDescompuesto(codigo,kilos,cantidad){
    $.ajax({
          type: 'ajax',
          method: 'post',
          url: 'http://localhost/polleria/Ventas/decrementaDescompuesto',
          data: {codigo:codigo,kilos:kilos,cantidad:cantidad},
          async: true,
          dataType: 'json',
          success: function(response){      
            console.log(response);
            if (response.success) {
                alertify.set('notifier','position', 'bottom-center');
                alertify.success('Stock Procesado Actualizado !');
                inputCantidadDescompuesto.value = "";
                inputCodigoDescompuesto.value = "";
                inputKilosDescompuesto.value = "";
                $('#modal_procesado_descompuesto').modal('hide');
                
            }else{
              alertify.set('notifier','position', 'bottom-center');
              alertify.error('Código No válido  !');    
                    
            }            
          },
          error: function(response){
            console.log('Error, Notificar al Administrador');
            console.log(response);

          }

        });
}

/*
*   Ajax Post Guarda Registro Pollo Vivo Ahogado
*/
function postGuardaRegistro(categoria,pollo,lote,cantidad,kilos){
    $.ajax({
          type: 'ajax',
          method: 'post',
          url: 'http://localhost/polleria/inventario/add_ahogado_descompuesto',
          data: { categoria:categoria,pollo:pollo,lote:lote,cantidad:cantidad,kilos:kilos },
          async: true,
          dataType: 'json',
          success: function(response){      
            console.log(response);
            if (response.success) {
                alertify.set('notifier','position', 'bottom-center');
                alertify.success('Registro Guardado !');
            }            
          },
          error: function(response){
            console.log('error');
            console.log(response);

          }

        });
}
/*
*   Ajax Post Decrementa Pollo Vivo Ahogado
*/
function postDecrementaVivo(cantidad){
    $.ajax({
          type: 'ajax',
          method: 'post',
          url: 'http://localhost/polleria/ventas/decrementa_vivo_post',
          data: {cantidad:cantidad},
          async: true,
          dataType: 'json',
          success: function(response){      
            console.log(response);
            if (response.success) {
                alertify.set('notifier','position', 'bottom-center');
                alertify.success('Stock Actualizado !');
            }            
          },
          error: function(response){
            console.log('error');
            console.log(response);

          }

        });
}


/*
*   Ajax Post Guarda Pollo Vivo
*/
function postGuardaVivo(cantidadPollo){
    $.ajax({
          type: 'ajax',
          method: 'post',
          url: 'http://localhost/polleria/entrada_stock_vivo/add',
          data: { cantidad:cantidadPollo},
          async: true,
          dataType: 'json',
          success: function(response){      
            console.log(response);
            if (response.success) {
                alertify.set('notifier','position', 'bottom-center');
                alertify.success('Entrada Guardada !');
            }            
          },
          error: function(response){
            console.log('error');
            console.log(response);

          }

        });
}
/*
*   Ajax Post Incrementa Pollo Vivo
*/
function postIncrementaVivo(cantidad){
    $.ajax({
          type: 'ajax',
          method: 'post',
          url: 'http://localhost/polleria/stock_vivo/incrementa',
          data: { cantidad:cantidad},
          async: true,
          dataType: 'json',
          success: function(response){ 
          console.log(response);           
            if (response.success) {
                alertify.set('notifier','position', 'bottom-center');
                alertify.success('Stock Actualizado !');
            }            
          },
          error: function(response){
            console.log('error');
            console.log(response);

          }

        });
}
/*
*   Ajax Post Guarda Pollo Procesado
*/
function postGuardaProcesado(categoria,kilos,lote,cantidad){
    $.ajax({
          type: 'ajax',
          method: 'post',
          url: 'http://localhost/polleria/entrada_stock_procesado/add',
          data: { categoria:categoria,kilos:kilos,lote:lote,cantidad:cantidad},
          async: true,
          dataType: 'json',
          success: function(response){ 
          console.log(response);           
            if (response.success) {
                alertify.set('notifier','position', 'bottom-center');
                alertify.success('Entrada Pollo Procesado Guardada !');
            }            
          },
          error: function(response){
            console.log('error');
            console.log(response);

          }

        });
}
/*
*   Ajax Post Incrementa Pollo Procesado
*/
function postIncrementaProcesado(categoria,kilos,cantidad){
    $.ajax({
          type: 'ajax',
          method: 'post',
          url: 'http://localhost/polleria/stock_procesado/incrementa',
          data: { categoria:categoria,kilos:kilos,cantidad:cantidad},
          async: true,
          dataType: 'json',
          success: function(response){ 
          console.log(response);           
            if (response.success) {
                alertify.set('notifier','position', 'bottom-center');
                alertify.success('Stock Actualizado !');
            }            
          },
          error: function(response){
            console.log('error');
            console.log(response);

          }

        });
}

function insertarTableVivo(cantidad){
    table_vivo.innerHTML = `
        <tr>
            <th scope="row" class="text-center">Vivo</th>
            <td class="text-center">${cantidad}</td>
        </tr>`;  
    
}

/*
*   Ajax Get Pollo Vivo
*/
function getVivo(){
    $.ajax({
          type: 'ajax',
          method: 'get',
          url: 'http://localhost/polleria/inventario/getVivo',          
          async: true,
          dataType: 'json',
          success: function(response){ 
            console.log(response.vivo[0].cantidad);           
            insertarTableVivo(response.vivo[0].cantidad);
          },
          error: function(response){
            console.log('error');
            console.log(response);

          }

        });
}

actualizaModalProcesado();
// actualiza inventario procesado
function templateModalProcesado(r3,r4,r5){
  p_procesado.innerHTML='';
  p_procesado.innerHTML += `
        <div class="row text-center">
      <div class="col">
        <h3>R3</h3>
        <div class="btn-group-vertical">
          ${r3}
        </div>
      </div>
          <div class="col">
            <h3>R4</h3>
        <div class="btn-group-vertical">
          ${r4}
        </div>
          </div>
          <div class="col">
            <h3>R5</h3>
        <div class="btn-group-vertical">
          ${r5}
        </div>
          </div>
    </div>`;  
}

function actualizaModalProcesado(){
  let r3='';
  let r4 = '';
  let r5 = '';
  $.ajax({
        type: 'ajax',       
        url: 'http://localhost/polleria/Ventas/getStock',       
        async: true,
        dataType: 'json',
        success: function(response){
          console.log('success');
          console.log(response);       

          $.each(response, function(index, producto) {
              console.log(producto.categoria);
              if (producto.categoria === 'r3') {
                r3 += `
            <button class="btn btn-warning mt-2 polloProcesado procesado-r3" data-caja="${producto.id}">
                ${producto.kilos}
                <span class="badge badge-light">${producto.stock_cantidad} p</span>   
                <span class="badge badge-light">${producto.stock_kilos} kg</span>
              </button>
                `;
              }
              if (producto.categoria === 'r4') {
                r4 += `
            <button class="btn btn-warning mt-2 polloProcesado procesado-r3" data-caja="${producto.id}">
                ${producto.kilos}
                <span class="badge badge-light">${producto.stock_cantidad} p</span>   
                <span class="badge badge-light">${producto.stock_kilos} kg</span>
              </button>
                `;
              }
              if (producto.categoria === 'r5') {
                r5 += `
            <button class="btn btn-warning mt-2 polloProcesado procesado-r3" data-caja="${producto.id}">
                ${producto.kilos}
                <span class="badge badge-light">${producto.stock_cantidad} p</span>   
                <span class="badge badge-light">${producto.stock_kilos} kg</span>
              </button>
                `;
              }
          });
          templateModalProcesado(r3,r4,r5);

        },
        error: function(response){
          console.log('error');
          console.log(response);

        }

      });
}

/*
* Agregar Procesado Por codigo de Barras
*/
$(document).ready(function() {
  $('#modal_procesado_codigo').on('shown.bs.modal', function() {
    $('#inpuAddProcesadoCode').trigger('focus');
  });
});

//lee Id barcode Procesado
//const inpuAddProcesadoId = document.getElementById('inpuAddProcesadoId');
//inpuAddProcesadoId.addEventListener('keypress',setfocusCodigo);
//lee datos pollo procesado
const inpuAddProcesadoCode = document.getElementById('inpuAddProcesadoCode');
inpuAddProcesadoCode.addEventListener('keypress',leerBarCode);

  const tableR3 = document.querySelector('#tableR3 tbody');
  const tableR4 = document.querySelector('#tableR4 tbody');
  const tableR5 = document.querySelector('#tableR5 tbody');

  tableR3.addEventListener('click',eliminaIngresoPollo);
  function eliminaIngresoPollo(e){
    e.preventDefault();
    //let idcurso;
    //console.log(e.target);    
    if (e.target.classList.contains('elimina-curso')) {
      console.log(e.target.dataset.id);  
      console.log(e.target.parentElement.parentElement);
        idcurso = e.target.dataset.id;
        e.target.parentElement.parentElement.remove();

        //Eliminar De arrayIngreso
        eliminiarArrayIngreso(idcurso);
    }
  }
  function eliminiarArrayIngreso(id){
    
    arrayProcesado.forEach(function (element, index) {
      if (element.id === id) {
        arrayProcesado.splice(index, 1);
          console.log(element);
      }
  });
  }
/*
function setfocusCodigo(e){
  if (e.keyCode === 13) {
    inpuAddProcesadoCode.focus();
}
}
*/
function addProcesadoManual(codigo) {
  /*
  * codigo Interno de 9 digitos
  * 1-1111-1111
  * 1 ->    Categoria
  * 1111 -> Lote
  * 1111 -> Peso con 2 decimales
  */

  const codeCategoria = codigo.substr(0,1);
  const lote = codigo.substr(1, 4);
  let peso = codigo.substr(5, 4);
  //peso = Number(peso).toFixed(2);
  //peso = myRound(Number(peso), 2)
  //console.log(codigoGeneradoManual);
  console.log(codeCategoria);
  console.log(lote);
  console.log(peso);
  let category = "";
  let canPollos = 0;
  if (codeCategoria == 3) {
    category = 'r3';
    canPollos = 22;
  }
  if (codeCategoria == 4) {
    category = 'r4';
    canPollos = 20;
  }
  if (codeCategoria == 5) {
    category = 'r5';
    canPollos = 18;
  }
  let pesoConPunto = peso.substr(0, 2) + "." + peso.substr(2, 2)+"0";
  const code = generatePasswordRand(25);
  const codigoGeneradoManual = codeCategoria + lote + peso;
  storeProcesadoByCode(code, codigoGeneradoManual, category, pesoConPunto, lote, canPollos);
  addHtml(category, codigoGeneradoManual, pesoConPunto, lote,code);

}// end Function addProcesadoManual

function leerBarCode(e){
  

  if (e.keyCode === 13) {
    //let identificador = inpuAddProcesadoId.value;
    let barCode = inpuAddProcesadoCode.value;
    let longitudBarCode = barCode.length;
    let pesoNeto = 0;
    let lote = '';
    let categoria = '';
    switch (longitudBarCode) {
      //25 CODIGO DE BARA ESCANEADO
      case 25:
        lote = barCode.substr(6, 4);

        pesoNeto = parseFloat(barCode.substr(12, 5));
        peso_interno = barCode.substr(12, 4);
        pesoNeto = (pesoNeto / 1000).toFixed(3);
        let categoria_interna = 0;
        categoria = saberCategoriaBarCode(barCode);

        let codigo_interno = "";
        cantity = saberCantidadBarcode(barCode);
        if (verificaExiste(barCode)) {
          alertify.error('Numero ID ya existe!');
          inpuAddProcesadoCode.select();
        } else {
          const code = generatePasswordRand(25);
          codigo_interno = categoria.substr(1, 1) + lote + peso_interno;
          storeProcesadoByCode(code, codigo_interno, categoria, pesoNeto, lote, cantity);
          addHtml(categoria, code, pesoNeto, lote,code);
          //alertify.success('Lote '+lote+' Kg '+pesoNeto+' Cat '+categoria);
          inpuAddProcesadoCode.value = '';
          //inpuAddProcesadoId.value = '';
          //inpuAddProcesadoId.focus();
          //alertify.success('Leido!');
        }
        break;
        //CODIGO MANUALMENTE
        case 9:
          addProcesadoManual(barCode);
        break;
    
        default:
          inpuAddProcesadoCode.focus();
          alertify.error('Codigo no Valido!');
        break;
    }
        
  }
}
function verificaExiste(id){
  //console.log(arrayProcesado.length);
  let bandera = false;
  arrayProcesado.forEach(function (element, index) {
    if (element.id === id) {
      bandera = true;
    }
  });
  return bandera;
}

function addHtml(categoria,identificador,pesoNeto,lote,code){
    tableR3.innerHTML+=`
                          <tr>
                            <td>${identificador}</td>
                            <td>${categoria}</td>
                            <td>${lote}</td>
                            <td>${pesoNeto}</td>
                            <td><i class="far fa-trash-alt text-danger elimina-curso" data-id="${code}"></i></td>
                        </tr>`;
}
function storeProcesadoByCode(id,codigo_interno,categoria,peso,lote,cantity){  
  arrayProcesado.push({
    id: id,
    id_interno: codigo_interno,
    categoria: categoria,
    peso: peso,
    lote: lote,
    cantidad: cantity
  });
}

function saberCategoriaBarCode(codigo){
  let cantidad = parseFloat(codigo.substr(10,2));
  let category = 'null';
  if (cantidad===22) {
    category = 'r3';    
  }
  if (cantidad===20) {
    category = 'r4';    
  }
  if (cantidad===18) {
    category = 'r5';    
  }
  return category;
}

function saberCantidadBarcode(codigo){
  let cantidad = parseFloat(codigo.substr(10,2));
  return cantidad;
}


/*
*   Ajax Post Add Procesado Por codigo
*   mando el array y guardo el registro e incremento procesado
*   desde el controlador
*/
function postIncrementaProcesadobyCode(){
  $.ajax({
        type: 'ajax',
        method: 'post',
        url: 'http://localhost/polleria/entrada_stock_procesado/addByCode',
        data: { arreglo:arrayProcesado},
        async: true,
        dataType: 'json',
        success: function(response){ 
          //console.log(response);           
          if (response.success) {
              alertify.set('notifier','position', 'bottom-center');
              alertify.success('Stock Actualizado !');
              tableR3.innerHTML = '';
              arrayProcesado=[];
          }else{
            alertify.set('notifier','position', 'bottom-center');
            alertify.error('Error, Intentar de nuevo !');
          }            
        },
        error: function(response){
          console.log('error');
          console.log(response);
          alertify.set('notifier','position', 'bottom-center');
          alertify.error('Error, Intentar de nuevo !');

        }

      });
}


/*
* Tabla Procesado R3
*/
$('#table-procesadoR3').DataTable({
  "responsive": true,
  'paging': true,
  'lengthChange': false,
  'searching': true,
  'ordering': true,
  'info': true,
  'autoWidth': false,
  //'columns': [
    //{ "width": "50%" },//tipo pollo
    //{ "width": "30%" },//cliente
    //{ "width": "20%" },//Cantidad
  //],
  /*Cambiando a espanol el lenguaje*/
  'language': {

    "sProcessing": "Procesando...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Vacio",
    "sInfo": " _START_ al _END_ de _TOTAL_ registros",
    "sInfoEmpty": "0 al 0 de 0 registros",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix": "",
    "sSearch": "Buscar:",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
      "sFirst": "Primero",
      "sLast": "Último",
      "sNext": "Siguiente",
      "sPrevious": "Anterior"
    },
    "oAria": {
      "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
  }
});


/*
* Tabla Procesado R4
*/
$('#table-procesadoR4').DataTable({
  "responsive": true,
  'paging': true,
  'lengthChange': false,
  'searching': true,
  'ordering': true,
  'info': true,
  'autoWidth': false,
  //'columns': [
  //{ "width": "50%" },//tipo pollo
  //{ "width": "30%" },//cliente
  //{ "width": "20%" },//Cantidad
  //],
  /*Cambiando a espanol el lenguaje*/
  'language': {

    "sProcessing": "Procesando...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Vacio",
    "sInfo": " _START_ al _END_ de _TOTAL_ registros",
    "sInfoEmpty": "0 al 0 de 0 registros",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix": "",
    "sSearch": "Buscar:",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
      "sFirst": "Primero",
      "sLast": "Último",
      "sNext": "Siguiente",
      "sPrevious": "Anterior"
    },
    "oAria": {
      "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
  }
});


/*
* Tabla Procesado R3
*/
$('#table-procesadoR5').DataTable({
  "responsive": true,
  'paging': true,
  'lengthChange': false,
  'searching': true,
  'ordering': true,
  'info': true,
  'autoWidth': false,
  //'columns': [
  //{ "width": "50%" },//tipo pollo
  //{ "width": "30%" },//cliente
  //{ "width": "20%" },//Cantidad
  //],
  /*Cambiando a espanol el lenguaje*/
  'language': {

    "sProcessing": "Procesando...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Vacio",
    "sInfo": " _START_ al _END_ de _TOTAL_ registros",
    "sInfoEmpty": "0 al 0 de 0 registros",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix": "",
    "sSearch": "Buscar:",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
      "sFirst": "Primero",
      "sLast": "Último",
      "sNext": "Siguiente",
      "sPrevious": "Anterior"
    },
    "oAria": {
      "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
  }
});

//const inputPesoManual = document.getElementById('inputPesoManual');
//inputPesoManual.addEventListener('keyup',addProcesadoManual);



//2 Decimales sin redondear
function myRound(num, dec) {
  var exp = Math.pow(10, dec || 2); // 2 decimales por defecto
  return parseInt(num * exp, 10) / exp;
}
//Elimina el caracter de cadena
//se usa para quitar punto(.) de PESO
function replaceAll( text, busca, reemplaza ){
  while (text.toString().indexOf(busca) != -1)
      text = text.toString().replace(busca,reemplaza);
  return text;
}

//Genera codigo para Procesado Ingresado Manualmente
function generatePasswordRand(length,type) {
  switch(type){
      case 'num':
          characters = "0123456789";
          break;
      case 'alf':
          characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
          break;
      case 'rand':
          //FOR ↓
          break;
      default:
          characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
          break;
  }
  var pass = "";
  for (i=0; i < length; i++){
      if(type == 'rand'){
          pass += String.fromCharCode((Math.floor((Math.random() * 100)) % 94) + 33);
      }else{
          pass += characters.charAt(Math.floor(Math.random()*characters.length));   
      }
  }
  return pass;
}