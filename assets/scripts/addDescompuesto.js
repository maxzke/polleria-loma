/*
**********************************************************************************************
* Declaracion de constantes
**********************************************************************************************
*/
let idCodigoDescompuesto = "";
let idcodeInterno = "";

// const btnAddAhogado = document.getElementById('btnAddAhogado');
// const btnAddProcesado = document.getElementById('btnAddProcesado');
// const btnAddVivo = document.getElementById('btnAddVivo');
// btnAddAhogado.addEventListener('click',returnMenuAnterior);
// btnAddProcesado.addEventListener('click',returnMenuAnterior);
// btnAddVivo.addEventListener('click',returnMenuAnterior);
// function returnMenuAnterior(){
// 	location.replace("http://localhost/polleria/inventario")
// }

console.log("actiualizado");
const addDescompuesto = document.getElementById('btnGuardarDescompuesto');
addDescompuesto.addEventListener('click',guardaDescompuesto);
//Clientes existentes
const listadoclientes = [];
let infoPagado = {};
//Asigna valores de cliente seleccionado
let cliente = "";
let cliente_precio_vivo = 0;
let cliente_precio_alinado = 0;
let cliente_precio_procesado = 0;
let cliente_precio_desplumado = 0;

let editarP = {};

let item_cantidad = 0;
let item_producto = "";
let item_kilos = 0;
let item_precio = 0;
let item_importe = 0;
let codigoItemActualizar=0;

const labelTipoPollo = document.getElementById('labelTipoPollo');
const lblTotal = document.getElementById('lblTotal');
let barCode = "";
let carritoArray = [];

const carrito_table = document.querySelector('#carrito-table tbody');
carrito_table.addEventListener('click',editar_quitar_Item);

const precio_desplumado_cliente = 2;
const precio_desplumado_general = 4;

const formVentasVivo = document.getElementById('input-form-vivo');

const input_precio = document.getElementById('input_precio');
const input_cantidad = document.getElementById('input_cantidad');
const input_kilos = document.getElementById('input_kilos');

const inpuAddProcesadoCode = document.getElementById('inpuAddProcesadoCode');

const input_mostrar_importe = document.getElementById('input_mostrar_importe');
const input_pago = document.getElementById('input_pago');

const formVentasProcesado = document.getElementById('input-form-procesado');

const formVentasMenudeo = document.getElementById('input-form-menudeo');
//Contiene todas las tarjetas laterales derecha
const tarjetas = document.getElementById('tarjetas');

const card_vivo = document.getElementById('card-vivo');
const label_precio_vivo = document.getElementById('card-precio_vivo');

const card_alinado = document.getElementById('card-alinado');
const label_precio_alinado = document.getElementById('card-precio_alinado');

const card_procesado = document.getElementById('card-procesado');
const label_precio_procesado = document.getElementById('card-precio_procesado');

const card_menudeo = document.getElementById('card-menudeo');

const card_desplumado = document.getElementById('card-desplumado');
const label_precio_desplumado = document.getElementById('card-precio_desplumado');

const btnActualizarProcesado = document.getElementById('btnActualizarProcesado');

const input_editar_cantidad_procesado = document.getElementById('input_editar_cantidad_procesado');
input_editar_cantidad_procesado.addEventListener('keyup',cambiaFocus);

const input_editar_kilos_procesado = document.getElementById('input_editar_kilos_procesado');
input_editar_kilos_procesado.addEventListener('keypress',funcionActualizaCantidadProcesado);

const labelTipoPolloMenudeo = document.getElementById('labelTipoPolloMenudeo');

//Listado Menudeo
const listaMenudeo = document.querySelector('#listaMenudeo');

const input_precio_menudeo = document.querySelector('#input_precio_menudeo');
const input_kilos_menudeo = document.querySelector('#input_kilos_menudeo');

let isSeletedTipoMenudeo = true;
function returnIsSeletedTipoMenudeo() {
	return isSeletedTipoMenudeo;
}
listaMenudeo.addEventListener('click',(e)=>{
	
	if (e.target.classList.contains('menudeo')) {
		let producto = e.target.dataset.pollo;
		isSeletedTipoMenudeo = false;
		console.log(producto);
		set_item_producto('menudeo ' + producto.toLowerCase());
		setLabelElemento(labelTipoPolloMenudeo,producto);
		setfocus(input_precio_menudeo);
	}
	
});

function checkVaciosMenudeo(){
	if (isInputEmpty(input_precio_menudeo) || isInputEmpty(input_kilos_menudeo) || returnIsSeletedTipoMenudeo()) {
		//campos vacios
		return false;
	}else{
		//completos
		return true;
	}
}
input_precio_menudeo.addEventListener('keyup',(e)=>{
	checkDecimals(input_precio_menudeo, input_precio_menudeo.value);
	if (e.keyCode === 13) {
		setfocus(input_kilos_menudeo);
	}
});
input_pago.addEventListener('keyup',(e)=>{
	if (e.keyCode === 13) {
		if (carritoArray.length>0 && input_pago.value >=0) {
			cobrar();
		}
		
	}
});
input_kilos_menudeo.addEventListener('keyup',(e)=>{
	checkDecimals(input_kilos_menudeo, input_kilos_menudeo.value);
	if (e.keyCode === 13) {
		if (checkVaciosMenudeo()) {

			//Agregar al Carrito
			preciototal(input_precio_menudeo.value,input_kilos_menudeo.value);	
			set_item_precio(input_precio_menudeo.value);
			set_item_cantidad(0);
			set_item_kilos(input_kilos_menudeo.value);

			let item = {
				codigo:generatePasswordRand(6),
				cantidad:get_item_cantidad(),
				producto:get_item_producto(),
				kilos:get_item_kilos(),
				precio:get_item_precio(),
				importe:get_item_importe()
			}
			carritoArray.push(item);
			pintaCarritoArray();
			input_precio_menudeo.value = "";
			input_kilos_menudeo.value = "";

		} else {
			alertify.error('Completar formulario');
		}
	}
});

function isInputEmpty(idInput) {
	//true = vacio
	let band = idInput.value;
	if(!band){
		return true;
	}else{
		return false;
	}
}
alertify.set('notifier','position', 'bottom-center');
/*
**********************************************************************************************
* Llamadas a funciones
**********************************************************************************************
*/
cargaClientes();

// Click card pollo vivo
card_vivo.addEventListener('click',()=>{

	deleteClass(formVentasVivo, "bg-success");
	deleteClass(formVentasVivo, "bg-secondary");

	setClass(formVentasVivo, "bg-info");

	set_item_producto("vivo");

	OcultarFormProcesado();
	OcultarFormMenudeo();

	setLabelElemento(labelTipoPollo, get_item_producto());

	MostrarFormVivo();
	setVal_inputPrecio(getPreciovivo());
	setfocus(input_precio);
	
});

// Click card pollo Aliñado
card_alinado.addEventListener('click',()=>{

	deleteClass(formVentasVivo,"bg-info");
	deleteClass(formVentasVivo, "bg-secondary");

	setClass(formVentasVivo, "bg-success");

	set_item_producto("aliñado");
	set_item_precio(getInputPrecio());
	OcultarFormProcesado();
	OcultarFormMenudeo();

	setLabelElemento(labelTipoPollo, get_item_producto());

	MostrarFormVivo();
	setVal_inputPrecio(getPrecioAlinado());
	setfocus(input_precio);
});

// Click card pollo Procesado
card_procesado.addEventListener('click',()=>{

	set_item_producto("procesado");
	set_item_precio(getPrecioProcesado());

	OcultarFormVivo();
	OcultarFormMenudeo();
	
	MostrarFormProcesado();
	setVal_inputPrecio(getPrecioProcesado());
	setfocus(inpuAddProcesadoCode);
});

btnActualizarProcesado.addEventListener('click',()=>{
	let cantidad = $('#input_editar_cantidad_procesado').val();
	let codigo = getCodigoActualizar();
	console.log('actualizar cambios '+cantidad);
	console.log('codigo '+codigo);
	
	actualizaProcesadoArray(codigo,cantidad);
	pintaCarritoArray();
	$('#modalEditarProcesado').modal('hide');
});
function cambiaFocus(e){
	let cantidad = input_editar_cantidad_procesado.value;
	let pesoNeto = procesado_regla_de_tres(editarP.kilos,parseFloat(editarP.cantidad),cantidad);	
	setInputValue(input_editar_kilos_procesado,pesoNeto);
	if (e.keyCode === 13) {
		setfocus(input_editar_kilos_procesado);
	}
}
function funcionActualizaCantidadProcesado(e){
	if (e.keyCode === 13) {
        let cantidad = $('#input_editar_cantidad_procesado').val();
		let codigo = getCodigoActualizar();
		console.log('actualizar cambios '+cantidad);
		console.log('codigo '+codigo);
		
		actualizaProcesadoArray(codigo,cantidad);
		pintaCarritoArray();
		$('#modalEditarProcesado').modal('hide');
    }
}
function actualizaProcesadoArray(id,nuevaCantidad){
	
	carritoArray.forEach(function (element, index) {
		if (element.codigo === id) {
			let oldCantidad = parseFloat(element.cantidad);
			let oldKilos = parseFloat(element.kilos);
			let pesoNeto = procesado_regla_de_tres(oldKilos,oldCantidad,nuevaCantidad);
			let importItem = getImporteItem(element.precio,pesoNeto);
			  element.cantidad = nuevaCantidad;
			  element.kilos = pesoNeto;
			  element.importe = importItem;
		}
	});
}

function pintaCarritoArray(){
	carrito_table.innerHTML="";
	
	carritoArray.forEach(function (pedido, index) {
		let importNum =parseFloat(pedido.importe);
		let formato = new Intl.NumberFormat("en-IN").format(importNum);
			carrito_table.innerHTML += `
				<tr>
					<td class="text-center"><h5>${pedido.codigo_interno}</h5></td>
					<td class="text-center"><h5>${pedido.categoria}</h5></td>
					<td class="text-center"><h5>${pedido.lote}</h5></td>
					<td class="text-center"><h5>${pedido.kilos}</h5></td>
					<td class="text-center"><h5>${pedido.cantidad}</h5></td>
					<td>
						<button class="ml-3 btn btn-sm btn-danger borrar-item"
							data-codigo="${pedido.codigo}"
							data-interno="${pedido.codigo_interno}">
							Descontar
						</button>
										
					</td>
				</tr>`;
	});
	setLabelElemento(lblTotal,sumaImportes());
	setfocus(input_pago);
}
function showDescontar(){
	$('#inputCantDescompuesto').val("");
	$('#inputKgDescompuesto').val("");
	$('#colDescuentaDescompuesto').show();
}
function hideDescontar(){
	$('#colDescuentaDescompuesto').hide();
}


// Click card pollo Menudeo
card_menudeo.addEventListener('click',()=>{

	deleteClass(formVentasVivo, "bg-info");
	deleteClass(formVentasVivo, "bg-success");

	setClass(formVentasVivo, "bg-secondary");

	set_item_producto("menudeo");
	OcultarFormProcesado();
	OcultarFormVivo();

	setLabelElemento(labelTipoPollo, get_item_producto());

	//MostrarFormVivo();
	MostrarFormMenudeo();
	setVal_inputPrecio(0);
	setfocus(input_precio);
});

card_desplumado.addEventListener('click',()=>{
	set_item_precio(cliente_precio_desplumado);
	set_item_cantidad(getCantidadVivo());
	set_item_kilos(getCantidadVivo());
	set_item_producto('desplumado');
	preciototal(cliente_precio_desplumado,getCantidadVivo());
	addCarrito();	
	console.log('click desplumado');
});

function getCantidadVivo() {
	let cantidad = 0;
	carritoArray.forEach(element => {
		if (element.producto === 'vivo') {
			cantidad += element.cantidad;
		}
	});
	return cantidad;
	//console.log(cantidad);
}
input_precio.addEventListener('keyup',(e)=>{
	//Validar solo numeros
	checkDecimals(input_precio, input_precio.value);
	//fin validar numeros	
	if (e.keyCode === 13) {
		//validaCamposCalculaImporte();
		if (InputsVacios()) {
			//campo vacio:		
		}else{
			//campos llenos
			preciototal(getInputPrecio(),getInputKilos());
	
			set_item_precio(getInputPrecio());
			set_item_cantidad(getInputCantidad());
			set_item_kilos(getInputKilos());
	
			addCarrito();			
			setLabelElemento(lblTotal,sumaImportes());
			//Limpiar inputs
			setInputValue(input_precio,"");
			setInputValue(input_cantidad,"");
			setInputValue(input_kilos,"");
			
		}
        setfocus(input_cantidad);
    }
});

input_cantidad.addEventListener('keyup',(e)=>{
	//Validar solo numeros
	checkDecimals(input_cantidad, input_cantidad.value);
	//fin validar numeros	
	if (e.keyCode === 13) {
		//validaCamposCalculaImporte();
		if (InputsVacios()) {
			//campo vacio:		
		}else{
			//campos llenos
			preciototal(getInputPrecio(),getInputKilos());
	
			set_item_precio(getInputPrecio());
			set_item_cantidad(getInputCantidad());
			set_item_kilos(getInputKilos());
	
			addCarrito();
			setLabelElemento(lblTotal,sumaImportes());
			//Limpiar inputs
			setInputValue(input_precio,"");
			setInputValue(input_cantidad,"");
			setInputValue(input_kilos,"");
		}
        setfocus(input_kilos);
    }
});

input_kilos.addEventListener('keyup',(e)=>{
	//Validar solo numeros
	checkDecimals(input_kilos, input_kilos.value);
	//fin validar numeros	
	if (e.keyCode === 13) {		
		//validaCamposCalculaImporte();
		if (InputsVacios()) {
			//campo vacio:		
		}else{
			//campos llenos
			preciototal(getInputPrecio(),getInputKilos());
	
			set_item_precio(getInputPrecio());
			set_item_cantidad(getInputCantidad());
			set_item_kilos(getInputKilos());
	
			addCarrito();
			setLabelElemento(lblTotal,sumaImportes());
			//Limpiar inputs
			setInputValue(input_precio,"");
			setInputValue(input_cantidad,"");
			setInputValue(input_kilos,"");
		}
        
    }
});

inpuAddProcesadoCode.addEventListener('keyup',(e)=>{
	//Validar solo numeros
	//checkDecimals(input_kilos, input_kilos.value);
	//fin validar numeros	
	if (e.keyCode === 13) {	
			
		leerBarCode(e);
        
    }
});

/*
**********************************************************************************************
* Declaracion de Funciones
**********************************************************************************************
*/
async function leerBarCode(e){
	if (e.keyCode === 13) {
	  //let identificador = inpuAddProcesadoId.value;
	  let ReadBarCode = inpuAddProcesadoCode.value;
		let longitudBarCode = ReadBarCode.length;
	  //let lote = '';
	  let categoria = '';
		switch (longitudBarCode) {
			case 9:
				addCartItems(ReadBarCode);
				break;
			case 25:
				let categoria = saberCategoriaBarCode(ReadBarCode);
				let lote = ReadBarCode.substr(6, 4);
				let peso_interno = ReadBarCode.substr(12, 4);
				let codigo_interno = categoria.substr(1, 1) + lote + peso_interno;
				addCartItems(codigo_interno);
				console.log(codigo_interno);
				break;
			default:
				inpuAddProcesadoCode.value = '';
				inpuAddProcesadoCode.focus();
				alertify.error('Codigo no Valido!');
		}
			//   if (longitudBarCode==9) {
			// 	  addCartItems(barCode);
			//   }else{
			// 	inpuAddProcesadoCode.value = '';
			// 	inpuAddProcesadoCode.focus();
			// 	alertify.error('Codigo no Valido!');
			//   }
		  
	}
  }
  
  //Recibe codigo de 9 digitos y agrega a carrito
async function addCartItems(barCode) {
	carritoArray = [];
	  categoria = saberCategoriaBarCode(barCode);
	  cantity = saberCantidadBarcode(barCode);
	  if (verificaExiste(barCode)) {
		  alertify.error('Numero ID ya existe!');
		  inpuAddProcesadoCode.select();
	  } else {


		  const respuestaAsync = await verificaProcesadoDisponible(barCode);

		  if (respuestaAsync.success) {
			  /*Obtengo 
			  *cantidad total de pollos en la tara
			  *peso total de la tara
			  *cantidad de pollos disponibles
			  */
			  let cantidadPolloTara;
			  let cantidad;
			  let pesoEnTara;

			  cantidadPolloTara = parseInt(respuestaAsync.stock.cantidad);
			  cantidad = parseInt(respuestaAsync.stock.stock_cantidad);
			  pesoEnTara = parseFloat(respuestaAsync.stock.stock_kilos);

			  if (cantidad == 0) {
				  alertify.error('Pollo Agotado No disponible');
				  setfocus(inpuAddProcesadoCode);
			  } else {
				//   console.log(respuestaAsync.stock);
				//   console.log(pesoEnTara);
				  respuestaAsync.stock.forEach(element => {
					  set_item_kilos(element.stock_kilos);
					  preciototal(get_item_precio(), get_item_kilos());
					  let item = {
						  codigo: element.codigo,
						  codigo_interno:element.codigo_interno,
						  categoria: element.categoria,
						  lote: element.lote,						  
						  kilos: element.stock_kilos,
						  stock: element.stock_cantidad,

						  cantidad: element.stock_cantidad,
						  producto: get_item_producto(),
						  precio: get_item_precio(),
						  importe: get_item_importe(),
						  
					  }
					  carritoArray.push(item);

				  });
				  pintaCarritoArray();

				  //setLabelElemento(lblTotal,sumaImportes());

				  //addHtml(categoria,barCode,pesoNeto,lote);
				  //alertify.success('Lote '+lote+' Kg '+pesoNeto+' Cat '+categoria);
				  inpuAddProcesadoCode.value = '';
				  //inpuAddProcesadoId.value = '';
				  //inpuAddProcesadoCode.focus();
				  setfocus(inpuAddProcesadoCode);
				  //alertify.success('Leido!');
			  }
		  } else {
			  alertify.error('Codigo agotado o inexistente');
		  }

	  }
  }//end addCartItems
  //para calcular los kilos dependiendo la cantidad solicitada
  function procesado_regla_de_tres(pesoTara,cantidadTara,nuevaCantidad){	 
	 let nuevoPeso = (nuevaCantidad*pesoTara)/cantidadTara;
	 return nuevoPeso.toFixed(3);
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
  function verificaExiste(id){
	//console.log(arrayProcesado.length);
	let bandera = false;
	carritoArray.forEach(function (element, index) {
	  if (element.codigo === id) {
		bandera = true;
	  }
	});
	return bandera;
  }
  function sumaImportes(){
	let total = 0;
	carritoArray.forEach(function (element, index) {
	  total += parseFloat(element.importe);
	});
	let decimales = total.toFixed(2);
	let formato = new Intl.NumberFormat("en-IN").format(decimales);
	return decimales;
  }

async function verificaProcesadoDisponible(codigo){
	const response = $.ajax({
		type: 'ajax',
		method: 'post',
		url: 'http://localhost/polleria/stock_procesado/cuentaDisponible',
		data: { codigo:codigo},
		async: true,
		dataType: 'json'
	});  
	const data = await response;
	return data;
}

function setInputValue(id_input,valor){
	id_input.value = valor;
}
function setVal_inputPrecio(precio){
	input_precio.value = parseFloat(precio).toFixed(2);
}
function setfocus(nombreInput){
	nombreInput.focus();
	nombreInput.select();
}
function setClass(elemento,clase){
	elemento.classList.add(clase);
}
function deleteClass(elemento,clase){
	elemento.classList.remove(clase);
}
function setLabelElemento(elemento,valor){
	elemento.innerHTML = valor;
}

function set_item_cantidad(cantidad){
	item_cantidad = parseFloat(cantidad);
}
function get_item_cantidad(){
	return item_cantidad;
}
function set_item_producto(producto){
	item_producto = producto;
}
function get_item_producto(){
	return item_producto;
}
function set_item_kilos(kilos){
	item_kilos = kilos;
}
function get_item_kilos(){
	return item_kilos;
}
function set_item_precio(precio){
	item_precio = precio;
}
function get_item_precio(){
	return item_precio;
}
function set_item_importe(importe){
	item_importe = importe;
}
function get_item_importe(){
	return parseFloat(item_importe).toFixed(2);
}
function setCodigoActualizar(code){
	codigoItemActualizar = code;
}
function getCodigoActualizar(){
	return codigoItemActualizar;
}
function addCarrito(){

	let item = {
		codigo:generatePasswordRand(6),
		cantidad:get_item_cantidad(),
		producto:get_item_producto(),
		kilos:get_item_kilos(),
		precio:get_item_precio(),
		importe:get_item_importe()
	}
	if (get_item_cantidad() == 0 || get_item_precio() == 0 || get_item_kilos() == 0) {
		//alertify.set('notifier','position', 'bottom-center');		
		//alertify.warning('menudeo');
	}else{
		carritoArray.push(item);
		//addCarritoHtml(item);
		pintaCarritoArray();
	}
	
}

function editar_quitar_Item(e){

	let idCode = e.target.dataset.codigo;	
	idcodeInterno = e.target.dataset.interno;	
//DESCONTAR POLLO DESCOMPUESTO
	if (e.target.classList.contains('borrar-item')) {		
		console.log(idCode);
		console.log(idcodeInterno);
		idCodigoDescompuesto = idCode;
		hideDescontar();
		setTimeout(() => {
			showDescontar();
		}, 200);
		
		//e.target.parentElement.parentElement.remove();
		//eliminarItemArray(idCode);
		//setLabelElemento(lblTotal,sumaImportes());
	}

	if (e.target.classList.contains('editar-item-procesado')) {
		editarItemProcesado(idCode);
		//console.log(e.target.dataset.codigo);	
		//console.log(e.target.parentElement.parentElement);		
	}
}
function guardaDescompuesto(){
	let cant = $('#inputCantDescompuesto').val();
	let kg = $('#inputKgDescompuesto').val();
	console.table([idCodigoDescompuesto,cant,kg]);
	$.ajax({
		method: 'post',
		url: 'http://localhost/polleria/Inventario/add_ahogado_descompuesto',
		data: { codigo:idCodigoDescompuesto,cantidad:cant,kilos:kg},
		async: true,
		dataType: 'json',
		success: function(respuesta) {
			//console.log(respuesta);
			if (respuesta.success) {
				hideDescontar();
				carrito_table.innerHTML="";
				addCartItems(idcodeInterno);
				alertify.success('Descontado exitosamente');
			}
		},
		error: function() {
	        console.log("362");
	    }
	});
}
function eliminarItemArray(id){

    carritoArray.forEach(function (element, index) {
        if (element.codigo == id) {
            carritoArray.splice(index, 1);
        }
    });
}
function getCantidadEditarProcesado(id){
	let cantEdit=0;
	let kilos = 0;
	let cantidad = 0;
	carritoArray.forEach(function (element, index) {
        if (element.codigo == id) {
			cantEdit = element.stock;
			kilos = element.kilos;
			cantidad = element.cantidad;
        }
	});
	return {
		cantidad: cantidad,
		kilos: kilos,
		stock: cantEdit
	}
}

function editarItemProcesado(id){
	setCodigoActualizar(id);	
	editarP = getCantidadEditarProcesado(id);
	console.log(editarP);

	setLabelElemento(spanCantidadDisponible,editarP.stock);	
	$('#input_editar_cantidad_procesado').val(editarP.cantidad);
	$('#input_editar_kilos_procesado').val(editarP.kilos);
	$('#modalEditarProcesado').modal({backdrop: 'static', keyboard: false}).on('shown.bs.modal', function() {
		$('#input_editar_cantidad_procesado').select();
	});
	
}

function InputsVacios(){
	let p = getInputPrecio();
	let c = getInputCantidad();
	let kg = getInputKilos();
	if (p === '' || c === '' || kg === '') {
		return true;
	}else{
		return false;
	}
}

function preciototal(precio,kilos){
	precio = parseFloat(precio);
	kilos = parseFloat(kilos);
	total_importe = precio*kilos;
	total_importe = total_importe.toFixed(2);
	setLabel_mostrarImporte(total_importe);
	set_item_importe(total_importe);
}
function getImporteItem(precio,kilos){
	precio = parseFloat(precio);
	kilos = parseFloat(kilos);
	total_importe = precio*kilos;
	total_importe = total_importe.toFixed(2);
	return total_importe;
}
// Get valores Inputs Vivo
function getInputPrecio(){
	return input_precio.value;
}
function getInputCantidad(){
	return input_cantidad.value;
}
function getInputKilos(){
	return input_kilos.value;
}
function setLabelPrecioVivo(precio){
	label_precio_vivo.innerHTML = precio;
}
function setLabelPrecioAlinado(precio){
	label_precio_alinado.innerHTML = precio;
}
function setLabelPrecioProcesado(precio){
	label_precio_procesado.innerHTML = precio;
}
function setLabelPrecioDesplumado(precio){
	label_precio_desplumado.innerHTML = precio;
}
function setPrecioDesplumado(str1){	 
	let str2 = 'PUBLICO';
	let compara = str1.localeCompare(str2);
	if (compara === 0) {
		//Es Publico General
		setLabelPrecioDesplumado(precio_desplumado_general);
		cliente_precio_desplumado = precio_desplumado_general;
	}else{
		//Precio a CLientes
		setLabelPrecioDesplumado(precio_desplumado_cliente);
		cliente_precio_desplumado = precio_desplumado_cliente;
	}
}
function setLabel_mostrarImporte(importe){
	input_mostrar_importe.value= importe;
}
// ///////////Get / Set Datos Cliente actual///////////////////////////////////////////////
function getPreciovivo(){
	return cliente_precio_vivo;
}
function getPrecioAlinado(){
	return cliente_precio_alinado;
}
function getPrecioProcesado(){
	return cliente_precio_procesado;
}
function getPrecioDesplumado(){
	return cliente_precio_desplumado;
}

function setPreciovivo(precio){
	cliente_precio_vivo = precio;
}
function setPrecioAlinado(precio){
	cliente_precio_alinado = precio;
}
function setPrecioProcesado(precio){
	cliente_precio_procesado = precio;
}

// ///////////Ocultar / Mostrar Formularios Venta///////////////////////////////////////////////
function MostrarFormVivo(){
	formVentasVivo.style.display = "block";
}
function OcultarFormVivo(){
	formVentasVivo.style.display = "none";
}
function MostrarFormProcesado(){
	formVentasProcesado.style.display = "block";
}
function OcultarFormProcesado(){
	formVentasProcesado.style.display = "none";
}
function MostrarFormMenudeo(){
	formVentasMenudeo.style.display = "block";
}
function OcultarFormMenudeo(){
	formVentasMenudeo.style.display = "none";
}
// Mostrar tarjetas //////////////////////////////
function MostrarTarjetas(){
	tarjetas.style.display = "block";
}

function checkDecimals(fieldName, fieldValue) {

	decallowed = 3; // how many decimals are allowed?

	if (isNaN(fieldValue) || fieldValue == "") {
		/*
		*	positions:
		*	top-right
		*	top-center
		*	top-left
		*	bottom-right
		*	bottom-center
		*	bottom-left
		*/
	 	alertify.set('notifier','position', 'bottom-center');
	 	alertify.error('Introduce un número');
		
		fieldName.focus();
		fieldName.select();
		}
		else {
			if (fieldValue.indexOf('.') == -1) fieldValue += ".";
				dectext = fieldValue.substring(fieldValue.indexOf('.')+1, fieldValue.length);

			if (dectext.length > decallowed)
			{
				alertify.error('Por favor, entra un número con 2 números decimales.');
	//alert ("Por favor, entra un número con " + decallowed + " números decimales.");
				
				fieldName.focus();
				fieldName.select();
	      }
	else {
	//alert ("Número validado satisfactoriamente.");
	      }
	   }
	}

/*
//////////////////////////////////////////////////////////////////////////////////////////////
* Carga Listado de Clientes ajax
//////////////////////////////////////////////////////////////////////////////////////////////
*/
function cargaClientes(){
	$.ajax({
		url: 'http://localhost/polleria/Clientes/getAll',
		success: function(respuesta) {
			let lista = JSON.parse(respuesta);
			//console.log(lista.clientes);
			 $.each(lista.clientes, function(index, producto) {
	            listadoclientes.push({
	                id: producto.id, 
	                nombre: producto.nombre.toUpperCase(), 
	                vivo: producto.precio_vivo,
	                alinado: producto.precio_alinado,
	                procesado: producto.precio_procesado,
	            });
	        });
		},
		error: function() {
	        //console.log("No se ha podido obtener la información");
	    }
	});
	//console.log(listadoclientes);
}
/*
//////////////////////////////////////////////////////////////////////////////////////////////
* Carga Opciones pluggins AutoComplete de Clientes
//////////////////////////////////////////////////////////////////////////////////////////////
*/
var options = {
    data: listadoclientes,
    getValue: function(element) {
        return element.nombre;
    },
    list: {
        match: {
            enabled: true
        },
        onClickEvent: function() {

			let precio_vivo = $("#inputBuscarCliente").getSelectedItemData().vivo;	
			setPreciovivo(precio_vivo);
			setLabelPrecioVivo(precio_vivo)	;
			let precio_alinado = $("#inputBuscarCliente").getSelectedItemData().alinado;
			setPrecioAlinado(precio_alinado);
			setLabelPrecioAlinado(precio_alinado);
			let precio_procesado = $("#inputBuscarCliente").getSelectedItemData().procesado;
			setPrecioProcesado(precio_procesado);
			setLabelPrecioProcesado(precio_procesado);

			cliente = $("#inputBuscarCliente").getSelectedItemData().nombre;
			
			setPrecioDesplumado(cliente);
			MostrarTarjetas();

        },
        onKeyEnterEvent: function() {

			let precio_vivo = $("#inputBuscarCliente").getSelectedItemData().vivo;
			setPreciovivo(precio_vivo);
			setLabelPrecioVivo(precio_vivo);
			let precio_alinado = $("#inputBuscarCliente").getSelectedItemData().alinado;
			setPrecioAlinado(precio_alinado);
			setLabelPrecioAlinado(precio_alinado);
			let precio_procesado = $("#inputBuscarCliente").getSelectedItemData().procesado;
			setPrecioProcesado(precio_procesado);
			setLabelPrecioProcesado(precio_procesado);

			cliente = $("#inputBuscarCliente").getSelectedItemData().nombre;

			setPrecioDesplumado(cliente);
			MostrarTarjetas();

        }

    }
};
$("#inputBuscarCliente").easyAutocomplete(options);

//Genera id para vivo - menudeo - aliñado
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

async function cobrar(){
	let cash = parseFloat(input_pago.value);
	//Validar solo numeros
	
	checkDecimals(input_pago, input_pago.value);
	//fin validar numeros

	let cambio=0;
	let mensaje = "";
	if (cash==='') {

	}else{
		if (cash>=sumaImportes()) {
			cambio = cash - sumaImportes();
			isPagado(sumaImportes(),'pagado');
			mensaje = "Cambio $" + cambio.toFixed(2);
	 			
		}else{
			let debe = sumaImportes() - cash;
			isPagado(cash,'debe');
			mensaje = "Saldo Pendiente $" + debe.toFixed(2);
		}
	}
	const respuestaAsyncVenta = await guardaVentaBd();
	if (respuestaAsyncVenta.success) {	
		console.log(respuestaAsyncVenta.info);
		carrito_table.innerHTML="";
		carritoArray = [];
		input_pago.value = "";
		setLabelElemento(lblTotal,0);
		alertify.set('notifier','position', 'bottom-center');
		alertify.success('Venta Guardada');
		alertify.warning(mensaje);	
	}else{		
		alertify.set('notifier','position', 'bottom-center');
		alertify.danger('Error, Intentar de nuevo...');
	}
	
}

async function guardaVentaBd(){
	let info_array = {
		cliente: cliente,
		abono: infoPagado.abono,
		pagado: infoPagado.pagado,
		detalles :  carritoArray,
		usuario: username.value
	}
	const responseVenta = $.ajax({
		type: 'ajax',
		method: 'post',
		url: 'http://localhost/polleria/ventas/guardaventa',
		data: { info:info_array},
		async: true,
		dataType: 'json'
	});
	const dataVenta = await responseVenta;
	return dataVenta;
}

function isPagado(cash,status){
	
	infoPagado = {
	   abono: cash,
	   pagado: status
   
   }
}

