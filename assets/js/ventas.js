
//const inputBuscarCliente = document.getElementById('inputBuscarCliente');
const inputTipoPollo = document.getElementById('inputPollo');
const inputCodigo = document.getElementById('inputCodigo');
const inputPrecio = document.getElementById('inputPrecio');
const inputCantidad = document.getElementById('inputCantidad');
const inputKilos = document.getElementById('inputKilos');
const btnAddCart = document.getElementById('btnAddCart');
const fecha = document.getElementById('inputFecha');
let idVentaEditar = 0;
const carrito_table = document.querySelector('#carrito-table tbody');
const saldos_table = document.querySelector('#saldos-table tbody');
const detalles_table = document.querySelector('#detalles-table tbody');
const abonos_table = document.querySelector('#abonos-table tbody');

const btnSendData = document.getElementById('btnSendData');

const precio_desplumado_cliente = 2;
const precio_desplumado_general = 4;
const btnPagar = document.getElementById('btnPagar');
const btnGuardarVenta = document.getElementById('btnGuardarVenta');
const btnActualizarProcesado = document.getElementById('btnActualizarProcesado');
//Labels Venta
const lblSaldoPendiente = document.getElementById('lblSaldoPendiente');
const lblsubTotalVenta = document.getElementById('lblsubTotalVenta');
const lblTotal = document.getElementById('lblTotal');
//ABONAR VENTA
const inputMostrarSaldo = document.getElementById('inputMostrarSaldo');
const inputAbono = document.getElementById('inputAbono');
const btnGuardarAbono = document.getElementById('btnGuardarAbono');

carrito_table.addEventListener('click',opcionCarrito);
var f=new Date();
let carritoArray = [];
const listadoclientes = [];
const listadoTipoPollos = [
				{
					'nombre':'VIVO'
				},
				{	
					'nombre':'ALIÑADO'
				},
				{
					'nombre':'PROCESADO'
				},
				{
					'nombre':'MENUDEO'
				},
				{
					'nombre':'DESPLUMADO'
				},
				{
					'nombre':'BOLSA'
				},
				{
					'nombre': 'POLLO SURTIDO'
				},
				{
					'nombre': 'PIERNA S/CADERA'
				},
				{
					'nombre': 'PIERNA C/CADERA'
				},
				{
					'nombre': 'PECHUGA S/HUACAL'
				},
				{
					'nombre':'PECHUGA C/HUACAL'
				},
				{
					'nombre':'ALITAS'
				},
				{
					'nombre':'FILETE'
				},
				{
					'nombre':'MENUDENCIA'
				},
				{
					'nombre': 'MENUDO FRIO'
				}
			];
let datosClienteSeleccionado = {
				'precio_vivo':0,
				'precio_alinado':0,
				'precio_procesado':0,
				'precio_desplumado':precio_desplumado_general,
				'cliente':'',
				'saldo_pendiente':0,
				'nombreCliente':''
			}
let dataProcesado = {
	'oldKilos' :0,
	'oldCantidad':0

}

fechaActual = f.getDate() + " / " + (f.getMonth()+1) + " / " + f.getFullYear();
fecha.placeholder=fechaActual;
llenarListadoClientes();
llenarSelectTipoPollo();

btnAddCart.addEventListener('click',()=>{
	if (vacios_pollo_precio_cant_kg()) {
		//alertify.warning('Completar Campos<br>POLLO<br>PRECIO<br>CANTIDAD<br>KILOS');
		alertify.set('notifier','position', 'top-right');
		alertify.error('Completar Campos');
	}else{
		let importe = obtenerImporte(getInputValue(inputPrecio),getInputValue(inputKilos));
		addArrayCarrito(generatePasswordRand(25),getInputValue(inputCantidad),getInputValue(inputTipoPollo),getInputValue(inputKilos),getInputValue(inputPrecio),importe,0);
		inputCantidad.value = "";
		inputKilos.value = "";
		inputPrecio.value = "";
	}
	
});
//MOSTRAR TIPOS MENUDEO
function mostrarMenudeo() {
	$('#modalTipoMenudeo').modal({ backdrop: 'static', keyboard: false });
}
btnPagar.addEventListener('click',()=>{
	$('#modalPagar').modal({backdrop: 'static', keyboard: false});
});
/*
*	EDITAR ITEM PROCESADO EN CARRITO DE COMPRAS
*/
function mostrarModalEditarProducto(codigo){
	editarItemProcesado(codigo);
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
			dataProcesado.oldKilos = element.oldkg;
			dataProcesado.oldCant = element.oldCant;
        }
	});
	return {
		cantidad: cantidad,
		kilos: kilos,
		stock: cantEdit
	}
}

function editarItemProcesado(id){
	editarP = getCantidadEditarProcesado(id);
	$('#input_editar_cantidad_procesado').val(editarP.cantidad);
	$('#input_editar_kilos_procesado').val(editarP.kilos);	
	$('#input_code_procesado').val(id);	
	
	$('#modalEditarProcesado').modal({backdrop: 'static', keyboard: false}).on('shown.bs.modal', function() {
		$('#input_editar_cantidad_procesado').select();
	});	
}
$("#input_editar_cantidad_procesado").keyup(function () {
	let nuevaCantidad = $("#input_editar_cantidad_procesado").val();
	let kg = procesado_regla_de_tres(dataProcesado.oldKilos, dataProcesado.oldCant, nuevaCantidad);
	$("#input_editar_kilos_procesado").val(kg);
});
//--------------------------------------------------------
//editar venta
detalles_table.addEventListener('click',(e)=>{
	if (e.target.classList.contains('editar-item-venta')) {
		let idCode = e.target.dataset.codigo;
		idVentaEditar = idCode;
		$('#modalEditarVenta').modal({ backdrop: 'static', keyboard: false }).on('shown.bs.modal', function () {
			$('#inputEditarCantidad').select();
		});	
	}
}) 
btnSendData.addEventListener('click',()=>{
	console.log('click');
	let q = $('#inputEditarCantidad').val();
	let k = $('#inputEditarKilos').val();
	let sendParams = {
		'id':idVentaEditar,
		'cantidad':q,
		'kilos':k
	}
	responseEditarVenta(sendParams);
});
async function responseEditarVenta(id) {
	const url = 'http://localhost/polleria/Ventas/editarVenta';
	const respAsyncDetalles = await postId(url, id);
	if (respAsyncDetalles.success) {
		$('#inputEditarCantidad').val('');
		$('#inputEditarKilos').val('');
		$('#modalEditarVenta').modal('hide');
		pintaSaldos(datosClienteSeleccionado.cliente);
		detalles_table.innerHTML="";
		console.log(respAsyncDetalles);
		//idVentaEditar = 0;
	}
}
//--------------------------------------------------------
btnActualizarProcesado.addEventListener('click',()=>{
	let cantidad = $('#input_editar_cantidad_procesado').val();
	let kilos = $('#input_editar_kilos_procesado').val();
	let codigo = $('#input_code_procesado').val();
	
	actualizaProcesadoArray(codigo,cantidad,kilos);
	pintaCarritoArray();
	$('#modalEditarProcesado').modal('hide');
});
function actualizaProcesadoArray(id,nuevaCantidad,nuevoKilos){
	
	carritoArray.forEach(function (element, index) {
		if (element.codigo === id) {
			let oldCantidad = parseFloat(element.cantidad);
			let oldKilos = parseFloat(element.kilos);
			//let pesoNeto = procesado_regla_de_tres(nuevoKilos,oldCantidad,nuevaCantidad);
			let importItem = obtenerImporte(element.precio,nuevoKilos);
			  element.cantidad = nuevaCantidad;
			  element.kilos = nuevoKilos;
			  element.importe = importItem;
		}
	});
}
/*
*	/FIN EDITAR ITEM PROCESADO EN CARRITO DE COMPRAS
*/

/*
*	CLICK BTN RESET
*/
$('#btnResetCart').click(function(){
	$('#configform')[0].reset();
	resetAll();
});

function obtenerImporte(precio,kilos){
	precio = parseFloat(precio);
	kilos = parseFloat(kilos);
	total_importe = (precio)*(kilos);
	total_importe = total_importe.toFixed(2);
	return total_importe;
}



function cargaDatosClienteSeleccionado(vivo,alinado,procesado,desplumado,cliente){
	datosClienteSeleccionado.precio_vivo = vivo;
	datosClienteSeleccionado.precio_Alinado = alinado;
	datosClienteSeleccionado.precio_procesado = procesado;
	datosClienteSeleccionado.precio_desplumado = desplumado;
	datosClienteSeleccionado.cliente = cliente;
}
/*
//////////////////////////////////////////////////////////////////////////////////////////////
* Carga Listado de Clientes ajax
//////////////////////////////////////////////////////////////////////////////////////////////
*/
async function llenarListadoClientes(){
	const respAsyncClientes = await cargaClientes();
	if (respAsyncClientes.success) {
		$.each(respAsyncClientes.clientes, function(index, producto) {
			listadoclientes.push({
				id: producto.id, 
				nombre: producto.nombre.toUpperCase(), 
				vivo: producto.precio_vivo,
				alinado: producto.precio_alinado,
				procesado: producto.precio_procesado,
			});
		});
		llenarSelectClientes();
	}
}
async function cargaClientes(){
	const response = $.ajax({
		url: 'http://localhost/polleria/clientes/getAll',
		method:'get',
		async:true,
		dataType: 'json',		
	});
	const data = await response;
	return data;
}

/*
//////////////////////////////////////////////////////////////////////////////////////////////
* Carga Opciones pluggins AutoComplete de Clientes
//////////////////////////////////////////////////////////////////////////////////////////////
*/
function llenarSelectClientes(){
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
				
				resetAll();
				let precio_vivo = $("#inputBuscarCliente").getSelectedItemData().vivo;
				let precio_alinado = $("#inputBuscarCliente").getSelectedItemData().alinado;
				let precio_procesado = $("#inputBuscarCliente").getSelectedItemData().procesado;
				let cliente = $("#inputBuscarCliente").getSelectedItemData().id;
				datosClienteSeleccionado.nombreCliente = $("#inputBuscarCliente").getSelectedItemData().nombre;
				if (datosClienteSeleccionado.nombreCliente == 'PUBLICO') {
					cargaDatosClienteSeleccionado(precio_vivo, precio_alinado, precio_procesado, precio_desplumado_general, cliente);
				}else{
					cargaDatosClienteSeleccionado(precio_vivo, precio_alinado, precio_procesado, precio_desplumado_cliente, cliente);
				}
								
				$('#inputClienteSaldo').val(datosClienteSeleccionado.nombreCliente);
				inputTipoPollo.disabled = false;
				setfocus(inputTipoPollo);
				pintaSaldos(cliente);
				

			},
			onKeyEnterEvent: function() {
				
				resetAll();
				let precio_vivo = $("#inputBuscarCliente").getSelectedItemData().vivo;
				let precio_alinado = $("#inputBuscarCliente").getSelectedItemData().alinado;
				let precio_procesado = $("#inputBuscarCliente").getSelectedItemData().procesado;
				let cliente = $("#inputBuscarCliente").getSelectedItemData().id;
				datosClienteSeleccionado.nombreCliente = $("#inputBuscarCliente").getSelectedItemData().nombre;
				if (datosClienteSeleccionado.nombreCliente == 'PUBLICO') {
					cargaDatosClienteSeleccionado(precio_vivo, precio_alinado, precio_procesado, precio_desplumado_general, cliente);
				} else {
					cargaDatosClienteSeleccionado(precio_vivo, precio_alinado, precio_procesado, precio_desplumado_cliente, cliente);
				}
				inputTipoPollo.disabled = false;
				setfocus(inputTipoPollo);
				pintaSaldos(cliente);

				
			}

		}
	};
	$("#inputBuscarCliente").easyAutocomplete(options);
}
/*
//////////////////////////////////////////////////////////////////////////////////////////////
* Carga Opciones pluggins AutoComplete de TIPO DE POLLO
//////////////////////////////////////////////////////////////////////////////////////////////
*/
function activa_desactiva_btnPagar(subtotal){
	let num = parseFloat(subtotal);
	if (num>0) {
		btnPagar.disabled = false;
	}else{
		btnPagar.disabled = true;
	}
}
function llenarSelectTipoPollo(){
	var options = {
		data: listadoTipoPollos,
		getValue: function(element) {
			return element.nombre;
		},
		list: {
			match: {
				enabled: true
			},
			onClickEvent: function() {

				let pollo = $("#inputPollo").getSelectedItemData().nombre;		
				switch (pollo) {
					case "BOLSA":
						saldoAtrasado();
						break;
					// case "MENUDEO":
					// 	mostrarMenudeo();
					// 	break;
				
					default:
						let precio = buscaPrecioPolloSeleccionado(pollo, datosClienteSeleccionado);
						setInputValue(inputPrecio, precio);
						activa_input_codigo(pollo);
						break;
				}

			},
			onKeyEnterEvent: function() {

				let pollo = $("#inputPollo").getSelectedItemData().nombre;		
				if (pollo == "BOLSA") {
					saldoAtrasado();
				}else{
					let precio = buscaPrecioPolloSeleccionado(pollo,datosClienteSeleccionado);
					setInputValue(inputPrecio,precio);
					activa_input_codigo(pollo);
				}

			}

		}
	};
	$("#inputPollo").easyAutocomplete(options);
}
/*
//////////////////////////////////////////////////////////////////////////////////////////////
* FIN Carga Opciones pluggins AutoComplete de TIPO DE POLLO
//////////////////////////////////////////////////////////////////////////////////////////////
*/
function saldoAtrasado(){
	inputCantidad.value=1;
	inputKilos.value = 1;
	inputPrecio.value = 1;
	// inputCantidad.disabled = true;
	// inputKilos.disabled = true;
	// inputPrecio.disabled = true;
	//setfocus(inputPrecio);
	let importe = obtenerImporte(getInputValue(inputPrecio), getInputValue(inputKilos));
	addArrayCarrito(generatePasswordRand(25), getInputValue(inputCantidad), getInputValue(inputTipoPollo), getInputValue(inputKilos), getInputValue(inputPrecio), importe, 0);
	inputCantidad.value = "";
	inputKilos.value = "";
	inputPrecio.value = "";
}
function activa_input_codigo(pollo){
	if (pollo == "PROCESADO") {
		inputCodigo.disabled = false;
		setfocus(inputCodigo);
	}else{
		inputCodigo.disabled = true;
		setfocus(inputPrecio);
	}
}
function buscaPrecioPolloSeleccionado(tipoPollo,datosPrecios){
	let precio = 0;
	switch (tipoPollo) {
		case 'VIVO':
			precio = datosPrecios.precio_vivo;
			break;
		case 'ALIÑADO':
			precio = datosPrecios.precio_alinado;
			break;
		case 'PROCESADO':
		precio = datosPrecios.precio_procesado;
		break;
		case 'DESPLUMADO':
			//alertify.error('servicio desplumado');
			servicioDesplumado();
		break;
	
		default:
			break;
	}
	return precio;
}
function setfocus(nombreInput){
	nombreInput.focus();
	nombreInput.select();
}
function setInputValue(id_input,valor){
	id_input.value = valor;
}
function getInputValue(input){
	return input.value;
}
function vacios_pollo_precio_cant_kg(){
	let pollo = getInputValue(inputTipoPollo);
	let p = getInputValue(inputPrecio);
	let c = getInputValue(inputCantidad);
	let kg = getInputValue(inputKilos);
	if (pollo === '' || p === '' || c === '' || kg === '') {
		return true;
	}else{
		return false;
	}
}
function resetAll(){
	carritoArray = [];
	inputPrecio.value = "";
	inputCantidad.value = "";
	inputKilos.value = "";
	inputTipoPollo.value ="";
	inputCodigo.value = "";
	inputTipoPollo.disabled = true;
	inputCodigo.disabled = true;
	pintaCarritoArray();
	cargaDatosClienteSeleccionado(0,0,0,precio_desplumado_general,datosClienteSeleccionado.cliente);	
	//label subtotal venta
    setLabelMoney(lblsubTotalVenta, 0);
    //label pendiente venta
    setLabelMoney(lblSaldoPendiente, 0);
    //label total venta
    setLabelMoney(lblTotal, 0);
	resetTables();
	$("#inputCambio").val(0);
	
	
}
function addArrayCarrito(codigo,cantidad,pollo,kilos,precio,importe,stock,oldKg=0,oldCant=0){
	let item = {
		'codigo': codigo,
		'cantidad': cantidad,
		'producto': pollo,
		'kilos': kilos,
		'precio': precio,
		'importe': importe,
		'stock':stock,
		'oldkg':oldKg,
		'oldCant': oldCant
	}
	carritoArray.push(item);
	pintaCarritoArray();
}
function servicioDesplumado(){
	let cantDesplumado = 0;
	carritoArray.forEach(function (pedido, index) {
		if (pedido.producto == 'VIVO') {
			cantDesplumado = pedido.cantidad;
		}		
	});
	if (cantDesplumado>0) {
		let importe = obtenerImporte(datosClienteSeleccionado.precio_desplumado,cantDesplumado);
		addArrayCarrito(generatePasswordRand(25), cantDesplumado, 'DESPLUMADO', cantDesplumado, datosClienteSeleccionado.precio_desplumado,importe,0);	
	} 
	
}
function pintaCarritoArray(){
	carrito_table.innerHTML="";
	let subtotal = 0;
	carritoArray.forEach(function (pedido, index) {
		let importNum =parseFloat(pedido.importe);
		let formato = new Intl.NumberFormat("en-IN").format(importNum);
		subtotal += importNum;
		if(pedido.producto != 'PROCESADO'){
			//Pollo procesado
			carrito_table.innerHTML += `
				<tr>
					<td class="text-center">${pedido.cantidad}</td>
					<td class="text-center">${pedido.producto}</td>
					<td class="text-center">${pedido.kilos}</td>
					<td class="text-center">${pedido.precio}</td>
					<td class="text-center">${formato}</td>
					<td class="text-center">
						<a href="#">
							<i class="far fa-trash-alt borrar-item text-danger" data-codigo="${pedido.codigo}"></i>
						</a>
					</td>
				</tr>`;
		}else{
			//Pollo Vivo
			carrito_table.innerHTML += `
				<tr>
					<td class="text-center">${pedido.cantidad}</td>
					<td class="text-center">${pedido.producto}</td>
					<td class="text-center">${pedido.kilos}</td>
					<td class="text-center">${pedido.precio}</td>
					<td class="text-center">${formato}</td>
					<td class="text-center">
						<a href="#">
							<i class="far fa-trash-alt borrar-item text-danger" data-codigo="${pedido.codigo}"></i>
						</a>
						<a href="#">
							<i class="ml-2 fas fa-edit editar-item-procesado text-warning" data-codigo="${pedido.codigo}"></i>									
						</a>
					</td>
				</tr>`;
		}
	});
	//label subtotal venta
	setLabelMoney(lblsubTotalVenta, subtotal);
	activa_desactiva_btnPagar(subtotal);
	//label total venta
	setLabelMoney(lblTotal, datosClienteSeleccionado.saldo_pendiente + subtotal);
	
}

function opcionCarrito(e){
	let idCode =e.target.dataset.codigo;
	if (e.target.classList.contains('borrar-item')) {		
		e.target.parentElement.parentElement.remove();
		eliminarItemArray(idCode);
		pintaCarritoArray();
	}
	if (e.target.classList.contains('editar-item-procesado')) {		
		mostrarModalEditarProducto(idCode);
	}
	
}
function eliminarItemArray(id){
    carritoArray.forEach(function (element, index) {
        if (element.codigo == id) {
            carritoArray.splice(index, 1);
        }
    });
}
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

/*
*	GUARDAR VENTA
*/
btnGuardarVenta.addEventListener('click',()=>{
	//cliente
	let id_cliente = datosClienteSeleccionado.cliente;
	let tipo_pago = obtenerFormaPago();
	let tipo_abono = obtenerTipoAbono();
	let importe_pago = obtenerImportePagado();

	let params = dataVentaCarrito(id_cliente,tipo_pago,tipo_abono,importe_pago,carritoArray);
	sendDataVenta(params);
});

async function sendDataVenta(params){
	const url = 'http://localhost/polleria/Ventas/guardaVenta';
	const respAsyncSaldos = await postId(url,params);
	if (respAsyncSaldos.success) {
		rePrintTicket(respAsyncSaldos.id);
		$('#modalPagar').modal('hide');
		resetAll();
		alertify.success('Guardado!');
		inputCantidad.disabled = false;
		inputKilos.disabled = false;
		$("#inputImportePago").val("");
		$("#inputSaldo").val("");
		$("#inputBuscarCliente").select();
	}else{
		console.log(respAsyncSaldos);
	}
}

function obtenerFormaPago(){
	const radios =  document.getElementsByName('optionsFormaPago');
	let formaPago = "null";
	for (let i = 0, length = radios.length; i < length; i++) {
		if (radios[i].checked) {
			formaPago = radios[i].value;
			break;
		}
	}
	return formaPago;
}
//ABONAR A VENTA ACTUAL
function obtenerTipoAbono(){
	const radios =  document.getElementsByName('optionsAbonarVenta');
	let tipoAbono = "null";
	for (let i = 0, length = radios.length; i < length; i++) {
		if (radios[i].checked) {
			tipoAbono = radios[i].value;
			break;
		}
	}
	return tipoAbono;
}

$("#inputKilos").keyup(function (e) {
	if (e.keyCode === 13) {
		if (vacios_pollo_precio_cant_kg()) {
			//alertify.warning('Completar Campos<br>POLLO<br>PRECIO<br>CANTIDAD<br>KILOS');
			alertify.set('notifier', 'position', 'top-right');
			alertify.error('Completar Campos');
		} else {
			let importe = obtenerImporte(getInputValue(inputPrecio), getInputValue(inputKilos));
			addArrayCarrito(generatePasswordRand(25), getInputValue(inputCantidad), getInputValue(inputTipoPollo), getInputValue(inputKilos), getInputValue(inputPrecio), importe, 0);
			inputCantidad.value = "";
			inputKilos.value = "";
			inputPrecio.value = "";
		}
	}
});
$("#inputCantidad").keyup(function (e) {
	if (e.keyCode === 13) {
		setfocus(inputKilos);
	}
});
$("#inputPrecio").keyup(function (e) {
	if (e.keyCode === 13) {
		setfocus(inputCantidad);
	}
});

$("#inputImportePago").keyup(function (e) {
	if (e.keyCode === 13) {
		if (carritoArray.length > 0){
			$('#modalPagar').modal({ backdrop: 'static', keyboard: false });
		}		
	}else{
		let pago = $("#inputImportePago").val();
		let mun = eliminarSimbolosMoneda(pago);
		let subtotal = 0;
		let cambio = 0;

		carritoArray.forEach(function (pedido, index) {
			let importNum = parseFloat(pedido.importe);
			//let formato = new Intl.NumberFormat("en-IN").format(importNum);
			subtotal += importNum;
		});
		let a = parseFloat(mun);
		let b = parseFloat(subtotal);
		if (a > b) {

			cambio = (a) - (b);
			$("#inputCambio").val(cambio);
		} else {
			$("#inputCambio").val(0);
		}
	}
	
});

function obtenerImportePagado(){
	const importe = document.getElementById('inputImportePago');
	let cadena = importe.value;
	// //Elimino $
	// let patron_peso = "$";
	// let nuevoValor="";
	// let sinMoneda = cadena.replace(patron_peso,nuevoValor);
	// //Elimino la coma
	// let patron_coma = ",";
	// let sinComa = sinMoneda.replace(patron_coma,nuevoValor);
	return eliminarSimbolosMoneda(cadena);
}
function eliminarSimbolosMoneda(cadena){
	//Elimino $
	let patron_peso = "$";
	let nuevoValor="";
	let sinMoneda = cadena.replace(patron_peso,nuevoValor);
	//Elimino la coma
	let patron_coma = ",";
	let sinComa = sinMoneda.replace(patron_coma,nuevoValor);
	return sinComa;
}
function dataVentaCarrito(id_cliente,tipoPago,tipoAbono,importe,carrito){
	let datosProcesarVenta = {
		'cliente':id_cliente,
		'tipoPago':tipoPago,
		'tipoAbono':tipoAbono,
		'pago':importe,
		'carrito':carrito
	}
	return datosProcesarVenta;
}
function setLabelMoney(elemento, valor) {	
	elemento.innerHTML = formatoMoneda(valor);	
}

function formatoMoneda(valor){
	let importNum = parseFloat(valor);
	let num = importNum.toFixed(2);
	let formato = new Intl.NumberFormat("en-IN").format(num);
	return formato;
}

btnGuardarAbono.addEventListener('click',(e)=>{
	e.preventDefault();
	let id_venta = e.target.dataset.id;
	let id_cliente = e.target.dataset.cliente;
	let radios =  document.getElementsByName('optionsAbono');
	let importe_abono = inputAbono.value;
	let importe = eliminarSimbolosMoneda(importe_abono);
	let tipoAbono = "null";
	for (let i = 0, length = radios.length; i < length; i++) {
		if (radios[i].checked) {
			tipoAbono = radios[i].value;
			break;
		}
	}
	addAbono(id_cliente,id_venta,tipoAbono,importe)
});
//AGREGA ABONO A VENTA ESPECIFICA BY ID-VENTA
async function addAbono(id_cliente,id_venta,id_forma_pago,importe_abono){
	let params = {
		'id':id_venta,
		'id_forma_pago':id_forma_pago,
		'importe':importe_abono
	}
	const url = 'http://localhost/polleria/Ventas/abonarVenta';
	const respAsyncAbono = await postId(url,params);
	if (respAsyncAbono.success) {
		$('#modalAbonar').modal('hide');
		alertify.set('notifier','delay', 10);		
		alertify.set('notifier','position', 'bottom-center');
		alertify.success('CAMBIO: '+(respAsyncAbono.cambio).toFixed(2));		
		setTimeout(() => {
			pintaSaldos(id_cliente);
		}, 100);
		
	}else{
		alertify.error('OCURRIO UN ERROR #504');
	}
}


 //para calcular los kilos dependiendo la cantidad solicitada
  function procesado_regla_de_tres(pesoTara,cantidadTara,nuevaCantidad){	 
	 let nuevoPeso = (nuevaCantidad*pesoTara)/cantidadTara;
	 return nuevoPeso.toFixed(3);
  }

//SALDO ATRASADO
$('#btnGuardarSaldo').click(function () {
	let val = $('#inputSaldo').val();
	console.log(val);
	let id_cliente = datosClienteSeleccionado.cliente;
	let tipo_pago = 1;
	let tipo_abono = 'venta_actual';
	let importe_pago = 0;
	let datas = {
		'codigo':generatePasswordRand(25),
		'cantidad':1,
		'producto':'SALDO ATRASADO',
		'kilos':1,
		'precio':eliminarSimbolosMoneda(val),
		'importe': eliminarSimbolosMoneda(val),		
	}
	let params = [];
	params.push(datas);
	let sendparams = dataVentaCarrito(id_cliente, tipo_pago, tipo_abono, importe_pago, params);
	console.log(datas);

	sendDataVenta(sendparams);
});
  
/*
*	TABLA CARRITO
*/
$('#carrito-table').DataTable(
	{

		//     'dom'  : 'Bfrtip',
		//     buttons: [
		//   {
		//       extend: 'print',
		//         text: 'Imprimir'          
		//   },
		//   {
		//     extend: 'pdf',
		//     text: 'PDF'
		//   },
		//   {
		//     extend: 'excel',
		//     text: 'Excel'
		//   }

		// ],     
		"scrollY": 150,
		"responsive": true,
		'paging': false,
		'lengthChange': false,
		'searching': false,
		'ordering': false,
		'info': false,
		'autoWidth': true,
		// 'columns': [
		//             { "width": "10%" },
		//             { "width": "30%" },
		//             { "width": "10%" },
		//             { "width": "10%" },
		//             { "width": "10%" },
		//             { "width": "10%" },
		//             { "width": "10%" }
		//           ],
		/*Cambiando a espanol el lenguaje*/
		'language': {

			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "Ningun producto agregado",
			"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
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
*	TABLA SALDOS
*/
$('#saldos-table').DataTable(
	{

		//     'dom'  : 'Bfrtip',
		//     buttons: [
		//   {
		//       extend: 'print',
		//         text: 'Imprimir'          
		//   },
		//   {
		//     extend: 'pdf',
		//     text: 'PDF'
		//   },
		//   {
		//     extend: 'excel',
		//     text: 'Excel'
		//   }

		// ],     
		"scrollY": 150,
		"responsive": true,
		'paging': false,
		'lengthChange': false,
		'searching': false,
		'ordering': false,
		'info': false,
		'autoWidth': false,
		'columns': [
		            { "width": "40%" },
		            { "width": "30%" },
		            { "width": "30%" }
		          ],
		/*Cambiando a espanol el lenguaje*/
		'language': {

			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "Ningun saldo pendiente",
			"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
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
*	TABLA DETALLES SALDO PENDIENTE
*/
$('#detalles-table').DataTable(
	{

		//     'dom'  : 'Bfrtip',
		//     buttons: [
		//   {
		//       extend: 'print',
		//         text: 'Imprimir'          
		//   },
		//   {
		//     extend: 'pdf',
		//     text: 'PDF'
		//   },
		//   {
		//     extend: 'excel',
		//     text: 'Excel'
		//   }

		// ],     
		"scrollY": 150,
		"responsive": true,
		'paging': false,
		'lengthChange': false,
		'searching': false,
		'ordering': false,
		'info': false,
		'autoWidth': true,
		// 'columns': [
		//             { "width": "10%" },
		//             { "width": "30%" },
		//             { "width": "10%" },
		//             { "width": "10%" },
		//             { "width": "10%" },
		//             { "width": "10%" },
		//             { "width": "10%" }
		//           ],
		/*Cambiando a espanol el lenguaje*/
		'language': {

			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "Ningun saldo seleccionado",
			"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
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
*	TABLA HISTORIAL ABONOS DE SALDO PENDIENTE
*/
$('#abonos-table').DataTable(
	{

		//     'dom'  : 'Bfrtip',
		//     buttons: [
		//   {
		//       extend: 'print',
		//         text: 'Imprimir'          
		//   },
		//   {
		//     extend: 'pdf',
		//     text: 'PDF'
		//   },
		//   {
		//     extend: 'excel',
		//     text: 'Excel'
		//   }

		// ],     
		"scrollY": 150,
		"responsive": true,
		'paging': false,
		'lengthChange': false,
		'searching': false,
		'ordering': false,
		'info': false,
		'autoWidth': false,
		'columns': [
			{ "width": "40%" },
			{ "width": "30%" },
			{ "width": "30%" }
		],
		/*Cambiando a espanol el lenguaje*/
		'language': {

			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "Ningun abono",
			"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
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