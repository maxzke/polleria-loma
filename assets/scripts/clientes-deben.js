/*
* Tabla Reporte por tipo de Pollo
*/
$('#abonar-table').DataTable({	
	"responsive": true,    
	'paging'      : true,
	'lengthChange': false,
	'searching'   : true,
	'ordering'    : true,
	'info'        : true,
	'autoWidth'   : false,
	'columns': [
		{ "width": "50%" },//tipo pollo
        { "width": "30%" },//cliente
        { "width": "20%" },//Cantidad
    ],
    /*Cambiando a espanol el lenguaje*/
	'language'  : {

	"sProcessing":     "Procesando...",
	"sLengthMenu":     "Mostrar _MENU_ registros",
	"sZeroRecords":    "No se encontraron resultados",
	"sEmptyTable":     "Ninguna venta con adeudo registrada",
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