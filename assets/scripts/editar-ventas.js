const btnGenera = document.getElementById('btnGenera');
const inputDate = document.getElementById('inputDate');
const fechareporte = document.getElementById('fechareporte');
const btnClickDetalles = document.querySelector('#editar-table tbody');
const btnClickGuardar = document.querySelector('#detalles-table tfoot');
const btnActualiza = document.getElementById('btnActualiza');
const modalEditarVenta = document.querySelector('#detalles-table tbody');
const labelTotal = document.getElementById('label_total');
const labelTotalPagos = document.getElementById('label_total_pagos');
const labelImporteVivo = document.getElementById('label_importe_vivo');
const divCambio = document.getElementById('cambio-editar');

modalEditarVenta.addEventListener('keyup', keyUpKilos);
modalEditarVenta.addEventListener('click', clickKilos);

let total = 0;
let actualImporte;

let total_importe = 0;
let total_pagos =0;

let precio = 0;
let oldImporte =0;
let fechaActual='';

let import_vivo =0;
let import_procesado = 0;
let import_alinado = 0;
let import_desplumado = 0;

let detalles_venta = [];
let efectivo = [];
let iddv = 0;
let status_venta;
let ventaarray ={};
function addDetalles(id_detalle,kg){
	detalles_venta.push({id:id_detalle,kilos:kg});
}
function editDetalles(id,kg){
	detalles_venta.forEach(element =>{
		if (element.id === id) {
			element.kilos = kg;
		}
	});
}

EventosListeners();

//Selecciona el kilo al dar click en el input
function clickKilos(e){
	e.preventDefault();     
     // Delegation para editar kilos
     if(e.target.classList.contains('editar-kilos')) {          
          let datainput = e.target;
          datainput.select();    
          precio = e.target.dataset.precio;     
          
     }

     //click Btn ACEPTAR
     if(e.target.classList.contains('btn-guarda-edicion')) {
     	
     		darCambio(total_importe,total_pagos);
     	     
          
          
     }
     //click Btn GUARDAR CAMBIOS UPDATE
    /* if(e.target.classList.contains('guarda-cambios')) { 
     	console.log('click update')    	;
     	updateVenta(ventaarray,detalles_venta);
     }*/
}

//click btn Guardar Cambios
function guardaCambiosUpdate(e){
	//click Btn GUARDAR CAMBIOS UPDATE
     if(e.target.classList.contains('guarda-cambios')) { 
     	console.log('click update')    	;
     	updateVenta(ventaarray,detalles_venta);
     	$('#modal-edit-ventas').modal('hide');
     }
}


function darCambio(importe,pagado){
	let cambio;
	
	//pagado
	if (importe<pagado) {
 		cambio = pagado - importe;
		insertModalCambio('Cambio',cambio);
		status_venta = 'pagado';
 	}
 	//pagado
 	if (importe==pagado) {
 		cambio = pagado - importe;
 		insertModalCambio('Pagado',cambio);
 		status_venta = 'pagado';
 	}
 	//debe
 	if (importe>pagado) {
 		cambio = importe -pagado;
 		insertModalCambio('Debe',cambio);
 		status_venta = 'debe';
 	}
 	efectivo = {
		importe: importe,
		pagado:pagado,
		status:status_venta
	}

}

/*
*status -pagado - debe
*pagado -Cantidad pagada
*kilos -Nuevos kilos editados
*/


function insertModalCambio(status,cambio){
	divCambio.innerHTML ="";
 	divCambio.innerHTML += 
 	`<div class="row">
	    <div class="col-6 text-right"><h3>${status}</h3></div>
	    <div class="col-6 text-left"><h3>${cambio.toFixed(2)}</h3></div>	    
	  </div>`
                                  
}//InsertMOdalCAmbio

function keyUpKilos(e) {
     e.preventDefault();
     let diferencia = 0;
     actualImporte = 0;
     // Delegation para editar kilos
     if(e.target.classList.contains('editar-kilos')) {
          //const curso = e.target.parentElement.parentElement;
          let totaltemp = total;
          let datainput = e.target;
          nuevoKilo = datainput.value;
          console.log(nuevoKilo);
          let nuevoImporte = precio*nuevoKilo;
          let columna = e.target.parentElement.parentElement.querySelector('.td-importe');
          let labelValor = columna.querySelector('#label_importe_vivo');           

          diferencia = oldImporte - nuevoImporte;
          actualImporte = totaltemp - diferencia;
          //console.log(columna.querySelector('#label_importe_vivo').innerHTML);
          labelValor.innerHTML = nuevoImporte.toFixed(2);
          

          let tipoPollo = e.target.dataset.tipodepollo;
          let detalle_id = e.target.dataset.iddetalle;
          //Actualizo detalles ventas
          editDetalles(detalle_id,nuevoKilo);

          
          arrayVenta(iddv,total_pagos);          

          let importetotal = importesPollos(tipoPollo,nuevoImporte);
          console.log(importetotal);
          setLabelTotal(importetotal.toFixed(2));
          darCambio(total_importe,total_pagos);
           if (e.keyCode === 13) {
//		        darCambio(total_importe,total_pagos);
		        btnActualiza.style.display = "block";
		    }
          
     }
}

function arrayVenta(id,pago){
	ventaarray = {
          	id: id,
          	pago: pago
          }
}

function importesPollos(pollo,importe){
	
	if (pollo === 'vivo') {
		import_vivo = importe;
	}
	if (pollo === 'alinado') {
		import_alinado = importe;
	}
	if (pollo === 'procesado') {
		import_procesado = importe;
	}
	if (pollo === 'Desplumado') {
		import_desplumado = importe;
	}
	let total = 0;
	total = import_vivo + import_alinado + import_procesado + import_desplumado;
	total_importe = total;
	return total;

}

function EventosListeners() {

	btnClickDetalles.addEventListener('click',getDetallesVenta);
	btnClickGuardar.addEventListener('click',guardaCambiosUpdate);
	//btnActualiza.addEventListener('click',actualizaClick);
	btnGenera.addEventListener('click', clickBtnGenera);
	/*
	*FEcha actual
	
	var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	var f=new Date();
	fechaActual = f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();
	*/
	getFecha = fechareporte.value;
}

function setLabelTotal(cantidad){
	labelTotal.innerHTML = cantidad;
}

function setLabelTotalPagos(cantidad){
	labelTotalPagos.innerHTML = cantidad;
}

function setLabelImporteVivo(cantidad){
	labelImporteVivo.innerHTML = cantidad;
}

function getDetallesVenta(e){
	e.preventDefault();
    if (e.target.classList.contains('btn-detalle-venta')) {
        console.log(e.target.dataset.idventa);
        iddv = e.target.dataset.idventa;
        //insertModalEditarVenta();
        
        cargaDetallesVenta(iddv);
        $('#modal-edit-ventas').modal('show');
	}
	if (e.target.classList.contains('btn-cancela-venta')) {
		let idv = e.target.dataset.idventa;
		console.log('cancelar: '+idv);
		alertify.confirm('Desea Eliminar El Registro?', 'Presione OK para Borrar', function () { 
      
			$.ajax({
			  type: 'ajax',
			  method: 'post',
			  url: 'http://localhost/polleria/EditarVentas/eliminaVenta',
			  data: { id: idv },
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
				alertify.error('Error #257');
	  
			  }
	  
			});
		  }//end PRESS OK
			, function () { alertify.error('Cancel') });
	}//end if CANCELAR VENTA
}

function clickBtnGenera(){
	//console.log(inputDate.value);
}

$('#inputDate').datepicker({
    format: "dd-mm-yyyy",
    language: "es",
    autoclose: true,
    endDate: "today"
});

$('#btnEditar').on('click',function(){
	console.log('click boton');
});

function insertModalEditarVenta(detalles){
	btnActualiza.style.display = "none";
	divCambio.innerHTML ="";
	detalles_venta = [];
	modalEditarVenta.innerHTML = "";
	total = 0;
	total_pagos =0;
	precio = 0;
	$.each(detalles, function(index, producto) {
		const row = document.createElement('tr');
			 let importe = 0;
			 if (producto.pollo ==='Desplumado'){
			 	importe = (producto.precio_kg)*(producto.cantidad);
			 	total = total + importe;
			 }else{
			 	importe = (producto.precio_kg)*(producto.kg);
			 	
			 	total = total + importe;
			 }
			 if (producto.pollo ==='vivo' || producto.pollo ==='alinado' || producto.pollo ==='procesado') {
			 	oldImporte = importe.toFixed(2);
			 	importesPollos(producto.pollo,importe);
			 	row.innerHTML = `
			      <td class="text-center text-uppercase">${producto.pollo}</td><!-- pollo -->
			      <td class="text-center">${producto.cantidad}</td><!-- cantidad -->
			      <td class="text-center">
			      	<input type="text" id="inputKilos" value="${producto.kg}" class="editar-kilos form-control form-control-sm"
			      	data-idventa="${producto.idventa}" 
			      	data-iddetalle="${producto.iddetalle}"
			      	data-precio="${producto.precio_kg}"
			      	data-tipodepollo="${producto.pollo}">
			      </td><!-- kilos -->
			      <td class="text-center">${producto.precio_kg}</td><!-- precio_kg -->
			      <td class="text-center td-importe"><label id="label_importe_vivo">${importe.toFixed(2)}</label></td><!-- importe kilos*precio_kg -->
			      <td class="text-center">
			          <!-- <button class="btn btn-sm btn-info btn-guarda-edicion">Aceptar</button>   -->                                     
			      </td>
			  `
			 addDetalles(producto.iddetalle,producto.kg);
			}else{
				importesPollos(producto.pollo,importe);
				row.innerHTML = `
			      <td class="text-center text-uppercase">${producto.pollo}</td><!-- pollo -->
			      <td class="text-center">${producto.cantidad}</td><!-- cantidad -->
			      <td class="text-center">${producto.kg}</td><!-- kilos -->
			      <td class="text-center">${producto.precio_kg}</td><!-- precio_kg -->
			      <td class="text-center">${importe.toFixed(2)}</td><!-- imoporte kilos*precio_kg -->
			      <td class="text-center"></td>`
			}
			modalEditarVenta.appendChild(row);
			total_pagos = producto.pago;
	});
	setLabelTotal(total.toFixed(2));
	setLabelTotalPagos(total_pagos);
                                  
}//InsertMOdal

function cargaDetallesVenta(idventa){
	$.ajax({
		type: 'ajax',
	      method: 'post',
	      url: 'http://localhost/polleria/EditarVentas/detalles',
	      data: { id_venta:idventa},
	      async: true,
	      dataType: 'json',
		
		success: function(respuesta) {
			//let lista = JSON.parse(respuesta);
			console.log(respuesta.detalles[0].pago);
			insertModalEditarVenta(respuesta.detalles);
			arrayVenta(idventa,respuesta.detalles[0].pago);
			//eventosListeners2();
			
			 /*$.each(respuesta.detalles, function(index, producto) {
	            console.log(producto.pollo);
	        });*/
			 
		},
		error: function() {
	        console.log("No se ha podido obtener la información");
	    }
	});
	//console.log(listadoclientes);
}


function updateVenta(venta,detalles){
	$.ajax({
		type: 'ajax',
	      method: 'post',
	      url: 'http://localhost/polleria/EditarVentas/updateVenta',
	      data: { venta:venta,detalles:detalles,efectivo:efectivo},
	      async: true,
	      dataType: 'json',
		
		success: function(respuesta) {
			//let lista = JSON.parse(respuesta);
			console.log('update');
			console.log(respuesta);
			 
		},
		error: function() {
	        console.log("No se ha podido obtener la información update");
	    }
	});
	//console.log(listadoclientes);
}

/*
* Tabla Reporte por tipo de Pollo
*/
$('#report-table').DataTable({	
	"responsive": true,    
	'paging'      : true,
	'lengthChange': false,
	'searching'   : true,
	'ordering'    : true,
	'info'        : true,
	'autoWidth'   : false,
	'columns': [
		{ "width": "10%" },//tipo pollo
        { "width": "25%" },//cliente
        { "width": "5%" },//Cantidad
        { "width": "5%" },//Kilos
        { "width": "10%" },//Precio
        { "width": "10%" },//Importe
        //{ "width": "10%" },//Pagos
        { "width": "20%" },//Fecha-Hora
        { "width": "10%" }//Usuario
    ],
    /*Cambiando a espanol el lenguaje*/
	'language'  : {

	"sProcessing":     "Procesando...",
	"sLengthMenu":     "Mostrar _MENU_ registros",
	"sZeroRecords":    "No se encontraron resultados",
	"sEmptyTable":     "Ninguna venta registrada",
	"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
	"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	"sInfoPostFix":    "",
	"sSearch":         "Buscar:",
	"sUrl":            "",
	"sInfoThousands":  ",",
	"sLoadingRecords": "Cargando...",
	"oPaginate": {
	    "sFirst":    "Primero",
	    "sLast":     "Último",
	    "sNext":     "Siguiente",
	    "sPrevious": "Anterior"
	},
    "oAria": {
    	        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
             }
    }
});

/*
* Tabla Editar Venta
*/
$('#editar-table').DataTable({	
	"responsive": true,    
	'paging'      : true,
	'lengthChange': false,
	'searching'   : true,
	'ordering'    : true,
	'info'        : true,
	'autoWidth'   : false,
	'columns': [
		{ "width": "50%" },//cliente
        { "width": "25%" },//fecha
        { "width": "25%" },//btn detalles
    ],
    /*Cambiando a espanol el lenguaje*/
	'language'  : {

	"sProcessing":     "Procesando...",
	"sLengthMenu":     "Mostrar _MENU_ registros",
	"sZeroRecords":    "No se encontraron resultados",
	"sEmptyTable":     "Ninguna venta registrada",
	"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
	"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	"sInfoPostFix":    "",
	"sSearch":         "Buscar:",
	"sUrl":            "",
	"sInfoThousands":  ",",
	"sLoadingRecords": "Cargando...",
	"oPaginate": {
	    "sFirst":    "Primero",
	    "sLast":     "Último",
	    "sNext":     "Siguiente",
	    "sPrevious": "Anterior"
	},
    "oAria": {
    	        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
             }
    }
});