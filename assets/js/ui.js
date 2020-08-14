

/*
*	POST ID
*	RECIBE URL E ID
*/
async function postId(url,id){
	const response = $.ajax({
		url: url,
		data:{id:id},
		method:'post',
		async:true,
		dataType: 'json',		
	});
	const data = await response;
	return data;
}
function resetTables(){

    saldos_table.innerHTML="";
    detalles_table.innerHTML="";
    abonos_table.innerHTML="";
}
/*
//// SALDOS TABLE /////// FECHA - SALDO ///////////////////////////////////////
*/

async function pintaSaldos(id){
    const url = 'http://localhost/polleria/Ventas/getSaldoDebeCliente';
    const respAsyncSaldos = await postId(url,id);    
    datosClienteSeleccionado.saldo_pendiente = 0; 
    saldos_table.innerHTML = "";
	if (respAsyncSaldos.success) {  
        respAsyncSaldos.data.forEach(function (element, index) {
            datosClienteSeleccionado.saldo_pendiente += parseFloat(element.saldo);
            saldos_table.innerHTML += `
                        <tr>
                            <td class="text-center">${element.fecha}</td>
                            <td class="text-center verDetalles" data-id="${element.id}" style="cursor: pointer;">${formatoMoneda(element.saldo)}</td>
                            <td class="text-center">
                            <a href="#">
                                <i class="far fa-trash-alt fa-lg text-danger eliminarVenta" data-idventa="${element.id}" data-cliente="${id}"></i>
                            </a>
                            <a href="#">
                                <i class="fas fa-plus-circle fa-lg addAbono ml-1" data-id="${element.id}" data-cliente="${id}" data-saldo="${formatoMoneda(element.saldo)}"></i>
                            </a>
                            <a href="#">
                                <i class="fas fa-file-alt fa-lg  text-warning printTicket ml-1" data-id="${element.id}" data-cliente="${id}" data-saldo="${formatoMoneda(element.saldo)}"></i>                          
                            </td>
                        </tr>`;
        });
    }
    //label subtotal venta
    setLabelMoney(lblsubTotalVenta, 0);
    //label pendiente venta
    setLabelMoney(lblSaldoPendiente, datosClienteSeleccionado.saldo_pendiente);
    //label total venta
    setLabelMoney(lblTotal, datosClienteSeleccionado.saldo_pendiente);
}


/*
//// DETALLES TABLE //////////////////////////////////////////////
*/

/*
*	OBTIENE DETALLES DE LA VENTA BY ID-VENTA
*/
saldos_table.addEventListener('click',mostrarDetalles);
function mostrarDetalles(e){
    
	if (e.target.classList.contains('verDetalles')) {	
        let idCode =e.target.dataset.id;	
		console.log(idCode);
        pintaDetalles(idCode);
        pintaAbonos(idCode)
    }
    if (e.target.classList.contains('addAbono')) {	
        let id_venta = e.target.dataset.id;	
        let id_cliente = e.target.dataset.cliente;	
        btnGuardarAbono.dataset.id = id_venta;
        btnGuardarAbono.dataset.cliente = id_cliente;
        let saldo = e.target.dataset.saldo;	
        inputMostrarSaldo.value = saldo;
        inputAbono.value = "";
		$('#modalAbonar').modal({backdrop: 'static', keyboard: false});
    }
    if (e.target.classList.contains('eliminarVenta')) {
        let idv = e.target.dataset.idventa;
        let id_cliente = e.target.dataset.cliente;
		console.log('cancelar: '+idv);
        alertify.confirm('Desea Eliminar La Venta?', 
            'Se Eliminará la venta completa<br>Se Eliminarán sus Abonos si tiene<br><br>Presione OK para Borrar', function () { 
      
			$.ajax({
			  type: 'ajax',
			  method: 'post',
			  url: 'http://localhost/polleria/Ventas/eliminaVenta',
			  data: { id: idv },
			  async: true,
			  dataType: 'json',
			  success: function (response) {        
				if (response.success) {
                    setTimeout(() => {
                        pintaSaldos(id_cliente);
                    }, 100);
				} else {
				  alertify.set('notifier', 'position', 'bottom-center');
				  alertify.error('Error, Intentar de nuevo !');
				}
			  },
			  error: function (response) {
				alertify.set('notifier', 'position', 'bottom-center');
                alertify.error('Error #257');
                alertify.error('No se pudo borrar la venta, intente recargar la pagina');
	  
			  }
	  
			});
		  }//end PRESS OK
			, function () { 
                //PRESS CANCEL
                //alertify.error('Cancel') 
            });
    }
    //print ticket
    if (e.target.classList.contains('printTicket')) {
        console.log('click re print');
        let idv = e.target.dataset.id;
        rePrintTicket(idv);
    }

    
}
async function rePrintTicket(id) {
    const urlDetalles = 'http://localhost/polleria/Ventas/getDetallesVenta';
    const respAsyncDetalles = await postId(urlDetalles, id);
    let params = {
        'nombreCliente': datosClienteSeleccionado.nombreCliente,
        'detalles':'',
        'pago':''
    }
    if (respAsyncDetalles.success) {
        console.log(respAsyncDetalles.data);
        params.detalles = respAsyncDetalles.data;
    }
    const urlAbono = 'http://localhost/polleria/Ventas/sumatotalAbonos';
    const respAsyncAbonos = await postId(urlAbono, id);  
    params.pago = respAsyncAbonos; 
    console.log(params);
    //NO IMPRIMIR TICKET SI ES SALDO ATRASADO
    if (params.detalles[0].producto == 'SALDO ATRASADO') {
        console.log('saldo atrasado');
    }else{
        console.log('no saldo atrasado');
        const urlPrintTicketPost = 'http://localhost/polleria/Ventas/printTicketPost';
        const respAsyncPrint = await postId(urlPrintTicketPost, params); 
    }
    
    

}
async function pintaDetalles(id){
    const url = 'http://localhost/polleria/Ventas/getDetallesVenta';
	const respAsyncSaldos = await postId(url,id);
	if (respAsyncSaldos.success) {
        detalles_table.innerHTML = "";
        respAsyncSaldos.data.forEach(function (element, index) {
            switch (element.producto) {
                case 'SALDO ATRASADO':
                    detalles_table.innerHTML += `
                                <tr>
                                    <td class="text-center"></td>
                                    <td class="text-center">${element.producto}</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center">${formatoMoneda(element.importe)}</td>
                                    <td class="text-center"></td>
                                </tr>`;
                    break;
                case 'BOLSA':
                    detalles_table.innerHTML += `
                                <tr>
                                    <td class="text-center">${element.cantidad}</td>
                                    <td class="text-center">${element.producto}</td>
                                    <td class="text-center"></td>
                                    <td class="text-center">${element.precio}</td>
                                    <td class="text-center">${formatoMoneda(element.importe)}</td>
                                    <td class="text-center"></td>
                                </tr>`;
                    break;
            
                default:
                    detalles_table.innerHTML += `
                                <tr>
                                    <td class="text-center">${element.cantidad}</td>
                                    <td class="text-center">${element.producto}</td>
                                    <td class="text-center">${element.kilos}</td>
                                    <td class="text-center">${element.precio}</td>
                                    <td class="text-center">${formatoMoneda(element.importe)}</td>
                                    <td class="text-center">
                                        <a href="#">
                                            <i class="ml-1 fas fa-edit editar-item-venta text-warning" data-codigo="${element.codigo}"></i>
                                        </a>
                                    </td>
                                </tr>`;
                    break;
            }           
                                
        });
	}
}

async function obtenerDetallesVenta(id){
	const url = 'http://localhost/polleria/Ventas/getDetallesVenta';
	const respAsyncDetalles = await postId(url,id);
	if (respAsyncDetalles.success) {
		return respAsyncDetalles.data;
	}
}
/*
//// ABONOS TABLE //////////////////////////////////////////////
*/

/*
*	OBTIENE LISTADO DE ABONOS DE LA VENTA BY ID-VENTA
*/

async function pintaAbonos(id){
    const url = 'http://localhost/polleria/Ventas/getListadoAbonos';
    const respAsyncSaldos = await postId(url,id);
    abonos_table.innerHTML = "";
	if (respAsyncSaldos.success) {
       
        respAsyncSaldos.data.forEach(function (element, index) {
            abonos_table.innerHTML += `
                                <tr>
                                    <td>${element.fecha}</td>
                                    <td>${formatoMoneda(element.importe)}</td>
                                    <td class="text-center">
                                        <a href="#">
                                            <i class="far fa-trash-alt text-danger" data-id="${element.id}" data-cliente=""></i>
                                        </a>
                                    </td>
                                </tr>`;
        });
	}
}

