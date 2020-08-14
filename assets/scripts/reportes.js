const fechareporte = document.getElementById('fechareporte');

EventosListeners();

function EventosListeners() {
	 getFechaInicioCaja();
	getFecha = fechareporte.value;
}

function getFechaInicioCaja(){
	$.ajax({
		url: 'http://localhost/polleria/reportes/get_start_fecha',
		success: function(respuesta) {
			let fecha = respuesta;
			asignaFechaInputPicker(fecha);
			 console.log(fecha);
		},
		error: function() {
	        //console.log("No se ha podido obtener la información");
	    }
	});
}


function asignaFechaInputPicker(fechaInicio){
	$('#inputDate').datepicker({
	    format: "dd-mm-yyyy",
	    language: "es",
	    autoclose: true,
	    startDate: fechaInicio,
	    endDate: "today"
	});
}




/*
* Tabla Reporte por tipo de Pollo
*/
$('#report-table').DataTable({	    
    'dom'  : 'Bfrtip',
    buttons: [
		{
            extend: 'print',
            orientation: 'landscape', //'portrait'
            pageSize: 'A4',
            text: 'Imprimir',
            title:'Reporte de Ventas '+ getFecha,       
        },        
        {
		    extend: 'pdfHtml5',
		    text: 'PDF',
		    filename: 'Reporte '+ getFecha,
		    pageSize: 'LEGAL',
		    orientation: 'portrait', //'landscape'
		    title:'Reporte de Ventas '+ getFecha,
		    customize: function (doc) {
		        doc.content[1].table.widths = ["10%","30%","15%","15%","15%","15%"];
		        doc.styles.tableBodyEven.alignment = 'center';
		    	doc.styles.tableBodyOdd.alignment = 'center';
	      	}
        },
        {
          extend: 'excel',
          text: 'Excel',
          title:'Reporte de Ventas '+ getFecha,
          filename: 'Reporte '+ getFecha,
        }
       
	],     
	"scrollY": 150,
	"responsive": true,    
	'paging'      : true,
	'lengthChange': false,
	'searching'   : true,
	'ordering'    : true,
	'info'        : true,
	'autoWidth'   : false,
	'columns': [
		{ "width": "10%" },//tipo pollo
		{ "width": "30%" },//cliente
		{ "width": "15%" },//pago
        { "width": "15%" },//Cantidad
        { "width": "15%" },//Kilos
        { "width": "15%" },//Precio
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