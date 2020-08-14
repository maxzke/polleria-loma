/*
**********************************************************************************************
* Declaracion de Funciones
**********************************************************************************************
*/
inputCodigo.addEventListener('keyup',(e)=>{    
    if (e.keyCode === 13){
            leerBarCode();
        }
});

async function leerBarCode(){
	    let ReadBarCode = inputCodigo.value;
        let longitudBarCode = ReadBarCode.length;
        let precio_procesado = parseFloat(inputPrecio.value);
            switch (longitudBarCode) {
                case 9:
                    addCartItems(ReadBarCode,precio_procesado);
                    break;
                case 25:
                    let categoria = saberCategoriaBarCode(ReadBarCode);
                    let lote = ReadBarCode.substr(6, 4);
                    let peso_interno = ReadBarCode.substr(12, 4);
                    let codigo_interno = categoria.substr(1, 1) + lote + peso_interno;
                    addCartItems(codigo_interno,precio_procesado);
                    console.log(codigo_interno);
                    break;
                default:
                    inputCodigo.value = '';
                    inputCodigo.focus();
                    alertify.error('Codigo no Valido!');
            }
			
  }
  
  //Recibe codigo de 9 digitos y agrega a carrito
async function addCartItems(barCode,precio) {
    categoria = saberCategoriaBarCode(barCode);
	  cantity = saberCantidadBarcode(barCode);
	    
    const respuestaAsync = await getInfoProcesadoDisponible(barCode);          
    if (!respuestaAsync.success) {
        alertify.error('Pollo Agotado, No disponible');
        setfocus(inputCodigo);                
    } 
    else {        
            let existe = false;
            respuestaAsync.stock.forEach(element => {
                if (verificaExiste(element.codigo)) {
                    existe = true;
                }
                else{
                    let importe = obtenerImporte(precio,element.stock_kilos);
                    addArrayCarrito(
                        element.codigo,
                        element.stock_cantidad,
                        'PROCESADO',
                        element.stock_kilos,
                        precio,
                        importe,
                        element.stock_cantidad,
                        //para regla de 3
                        element.stock_kilos,
                        element.stock_cantidad
                        );
                }
                
            });//endforeach
            if(existe){
                //alertify.error('Codigo se encuentra mostrado !');                    
            }
            inputCodigo.value = '';
            setfocus(inputCodigo);
        } 
  }//end addCartItems

  async function getInfoProcesadoDisponible(codigo){
	const response = $.ajax({
		type: 'ajax',
		method: 'post',
		url: 'http://localhost/polleria/Ventas/getDataProcesado',
		data: { codigo:codigo},
		async: true,
		dataType: 'json'
	});  
	const data = await response;
	return data;
}

function verificaExiste(id){
	//console.log(arrayProcesado.length);
	let bandera = false;
	carritoArray.forEach(function (element, index) {
	  if (element.codigo == id) {
		bandera = true;
	  }
	});
	return bandera;
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

  function preciototal(precio,kilos){
	precio = parseFloat(precio);
	kilos = parseFloat(kilos);
	total_importe = precio*kilos;
	total_importe = total_importe.toFixed(2);
	return total_importe;
}