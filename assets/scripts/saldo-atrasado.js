

//input Pago
const inputPago = document.getElementById('inputPago');
//btnCobrar
const btnCobrar = document.getElementById('btnCobrar');
const inputBuscar = document.getElementById('inputBuscaProducto');
const alerta = document.getElementById('alertasSave');
//usuario
const username = document.getElementById('username');
//Cliente
let clienteCompra = '';
//array isPagado
let infoPagado = {}

listeners();

function campos_vacios(){
	if (inputPago.value==='' || inputBuscar.value ==='') {
		alerta.innerHTML=`
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
			  Completar Campos! <strong>Cliente e Importe.</strong> 
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>`
		return false;
	}else{
		alerta.innerHTML=`
			<div class="alert alert-success alert-dismissible fade show" role="alert">
			  <strong>Importe Guardado Correctamente !</strong> 
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>`
		return true;
	}
}


function listeners(){
	//click btnAdd	
	//Listeners inputs
	
	inputPago.addEventListener('keyup',checkInputPago);
	inputPago.addEventListener('click',selectPago);
	
	//Para eliminar pedido de l tabla
	btnCobrar.addEventListener('click',cobrar);
}


function selectPago(){
	inputPago.select()
}



//Add carrito de compras


let listadoclientes = [];



function cobrar(){
	if (campos_vacios()) {
		let cash = parseFloat(inputPago.value);
		//Validar solo numeros
		checkDecimals(inputPago, inputPago.value);
		//fin validar numeros

		
		guardaVentaBd();
		inputPago.value='';
		inputBuscar.value ='';
	}
	
}


function checkDecimals(fieldName, fieldValue) {

decallowed = 2; // how many decimals are allowed?

if (isNaN(fieldValue) || fieldValue == "") {
 alertify.set('notifier','position', 'top-center');
 alertify.error('Introduce un número');
fieldName.select();
fieldName.focus();
}
else {
if (fieldValue.indexOf('.') == -1) fieldValue += ".";
dectext = fieldValue.substring(fieldValue.indexOf('.')+1, fieldValue.length);

if (dectext.length > decallowed)
{
	alertify.error('Por favor, introduce un número con " + decallowed + " números decimales.');
//alert ("Por favor, entra un número con " + decallowed + " números decimales.");
fieldName.select();
fieldName.focus();
      }
else {
//alert ("Número validado satisfactoriamente.");
      }
   }
}




function checkInputPago(e){	
	checkDecimals(inputPago, inputPago.value);		
	
		if (e.keyCode === 13) {
		cobrar();
    	}
	

	
}







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
        	
            
            clienteCompra = $("#inputBuscaProducto").getSelectedItemData().nombre;
            
            

        },
        onKeyEnterEvent: function() {
        	
            clienteCompra = $("#inputBuscaProducto").getSelectedItemData().nombre;
           

        }

    }
};
cargaClientes();
$("#inputBuscaProducto").easyAutocomplete(options);



function cargaClientes(){
	$.ajax({
		url: 'http://localhost/polleria/Tbl_cliente/getAll',
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



function guardaVentaBd(){
	let info_array = {
		cliente: clienteCompra,
		pagado: inputPago.value,		
		usuario: username.value
	}
	$.ajax({
	      type: 'ajax',
	      method: 'post',
	      url: 'http://localhost/polleria/ventas/guarda_saldo_atrasado',
	      data: { info:info_array},
	      async: true,
	      dataType: 'json',
	      success: function(response){
	      	console.log('success');
			  console.log(response);
			  location.reload();
	      	
	      },
	      error: function(response){
	        console.log('error');
	        console.log(response);

	      }

	    });
	    console.log(info_array);
}

/*
* DataTable
*/
/*
* Tabla Reporte por tipo de Pollo
*/
$('#tbl_saldo_atrasado').DataTable({	           
	"responsive": true,    
	'paging'      : true,
	'lengthChange': false,
	'searching'   : true,
	'ordering'    : true,
	'info'        : false,
	'autoWidth'   : false,
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


