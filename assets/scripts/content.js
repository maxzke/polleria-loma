$('#example2').DataTable({
     
          'dom'  : 'Bfrtip',
          buttons: [
        {
            extend: 'print',
              text: 'Imprimir'          
        },
        {
          extend: 'pdf',
          text: 'PDF'
        },
        {
          extend: 'excel',
          text: 'Excel'
        }
               
    ],     
    	  "responsive": true,    
          'paging'      : true,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false,
          'columns': [
                      { "width": "20%" },
                      { "width": "20%" },
                      { "width": "20%" },
                      { "width": "20%" },
                      { "width": "20%" }
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


$('#table-clientes').DataTable({
     
          'dom'  : 'Bfrtip',
          buttons: [
        {
            extend: 'print',
              text: 'Imprimir'          
        },
        {
          extend: 'pdf',
          text: 'PDF'
        },
        {
          extend: 'excel',
          text: 'Excel'
        }
               
    ],     
        "responsive": true,    
          'paging'      : true,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false,
          'columns': [
                      { "width": "5%" },
                      { "width": "20%" },
                      { "width": "10%" },
                      { "width": "10%" },
                      { "width": "10%" },
                      { "width": "10%" },
                      { "width": "35%" }
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

