<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

// require __DIR__ . '../autoload.php';
// use Mike42\Escpos\Printer;
// use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class Ventas extends CI_Controller {

    

	public function index(){

	 	if ($this->session->userdata('logged_in')) {
            
            //Efectivo inicial en Caja
            $this->load->model('Entrada_efectivo_caja_model');
            date_default_timezone_set('America/Mexico_City');
            $now = date('d-m-Y');
            $data['entrada'] = $this->Entrada_efectivo_caja_model->getCaja($now);
            $data['r3'] = $this->getStockByCategoria('r3');
            $data['r4'] = $this->getStockByCategoria('r4');
            $data['r5'] = $this->getStockByCategoria('r5');
            
            //Si ya se registro la caja inicial del dia
            if ($data['entrada']) {
                $this->load->view('header_view');
                $this->load->view('menu_top_ventas');
                $this->load->view('menu_left_view');
                $this->load->view('ventas',$data);
                $this->load->view('footer_view_ventas');
            //si aun no se registra 
            }else{
                $this->load->view('header_view');
                $this->load->view('menu_top_caja');
                $this->load->view('menu_left_view');
                $this->load->view('caja');
                $this->load->view('footer_view_caja');
            }
            
        }else{
            $this->load->view('auth/login');
        }
	}

    public function getStockByCategoria($categoria){
        $this->load->model('Entrada_stock_procesado_model');
        return $this->Entrada_stock_procesado_model->getStock($categoria);
    }

    public function getStock(){
        $this->load->model('Entrada_stock_procesado_model');
        //return $this->Entrada_stock_procesado_model->getAllStock();
        echo json_encode($this->Entrada_stock_procesado_model->getAllStock());
    }
    /*
    *   OBTIEN ID DE LA ULTIMA VENTA GUARDADA
    */
     public function obtieneId_UltimaVentaGuardada(){

        $this->load->model('Ventas_model');
        $id = $this->Ventas_model->getLastInsert();
        return $id[0]['id_venta'];
    }
    /*
    *   Obtiene Datos de La Ultima Venta
    */
    function getDatosVenta($id){
        $this->load->model('Ventas_model');
        $datos['venta'] = $this->Ventas_model->getVenta($id);
        $datos['productos'] = $this->getDetallesLastVenta($id);
        //echo json_encode($productos);
        echo json_encode($datos);
    }
    /*
    *   MUESTRA DATOS VENTA POR ID
    */
    function mostrarVenta(){
        $id = $this->obtieneId_UltimaVentaGuardada();
        $this->getDatosVenta($id);
    }
    /*
    *   GET PRODUCTOS DE LA ULTIMA VENTA
    */
    function getDetallesLastVenta($id){
        $productos = $this->Ventas_model->getDetalles($id);
        return $productos;
    }

    /*
    *   Funcion IMPRIMIR TICKET
    */
    public function printTicket($productos){

        try {

                //Fecha y hora actual
                date_default_timezone_set('America/Mexico_City');
                $fecha= date("d/m/Y H:i:s");

                

                $connector = NULL;
                //El nombre de la impresora es POS-58
                $connector = new WindowsPrintConnector("POS-58");
                $printer = new Printer($connector);   

                //Establecemos los datos del TICKET a imprimir

                $printer -> setJustification(Printer::JUSTIFY_CENTER);
                $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
                $printer -> feed(2); 
                $printer -> text("POLLERIA LOMA\n");
                $printer -> selectPrintMode(); // Reset   

                $printer -> feed(1);   
                $printer -> text("Calle Mexico #44\n");
                $printer -> text("Colonia Centro\n");
                $printer -> text("Loma Bonita Oaxaca\n");
                $printer -> text($fecha);        
                $printer->text("\n--------------------\n");
                $printer -> text($productos['cliente']);
                $printer->text("\n--------------------");
                $printer -> feed(1); 
                
                $charset='UTF-8'; // o 'UTF-8' setea  
                $toalapagar =0;
                $printer -> setJustification(Printer::JUSTIFY_LEFT);
                //*********************************************************************************
                foreach ($productos['detalles'] as $item) {
                    //Asigno el abono guardado en la variable sesion
                    $CantAbono = $productos['abono'];

                    /*$descripcion = $item['cantidad']." ".$item['producto']." ".$item['kilos']." ".$item['precio'];
                    */
                    //Mayuscula la primer letra
                    $nombreDescM=ucwords($item['producto']);
                    //Elimino acentos y ñ        
                    $str = iconv($charset, 'ASCII//TRANSLIT', $nombreDescM);
                    $nuevo = preg_replace("/[^A-Za-z0-9 ]/", '', $str);
                    $printer -> text("Pollo: "); 
                    $printer -> text(wordwrap(utf8_encode($nuevo), 29, "\n    " ,TRUE)); 

                    //$printer -> text("\nPollo: ".$item['producto']); 
                    $printer -> text("\nCantidad: ".$item['cantidad']);
                    $printer -> text("\nKilos: ".$item['kilos']); 
                    $printer -> text("\nPrecio: ".$item['precio']); 
                    
                    
                    $printer -> feed();    
                    $printer -> setJustification(Printer::JUSTIFY_RIGHT);  
                    $printer -> text("Importe $ ".number_format($item['importe'],2,".","," )."\n");
                    $printer -> text("\n"); 
                    $printer -> setJustification(); // Reset
                    $toalapagar+=$item['importe'];
                }
                //*********************************************************************************
                $printer -> setJustification(Printer::JUSTIFY_RIGHT); 
                $printer -> feed(2);    
                $printer -> text("Subtotal $ ".number_format($toalapagar,2,".","," )."\n");
                $printer -> text("Abono $ ".number_format($CantAbono,2,".","," )."\n");
                $printer -> text("Restante $ ".number_format($toalapagar-$CantAbono,2,".","," )."\n");
                $printer -> feed(2);    
                $printer -> setJustification(Printer::JUSTIFY_CENTER);
                $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
                $printer -> text("Gracias por\n");
                $printer -> text("su compra\n");

                //$printer -> text("Loma Bonita Oaxaca\n"); 
                $printer -> feed(5);
                /* Pulse Manda un PULSO y abre la caja registradora
                pulse($pin, $on_ms, $off_ms)
                Generate a pulse, for opening a cash drawer if one is connected. The default settings (0, 120, 240) should open an Epson drawer.*/
                $printer -> pulse();
                /* Close printer */
                $printer -> close();
                //$this->cart->destroy();
               // echo "Ticket Impreso";
            } catch (Exception $e) {
                echo "No se pudo imprimir el Ticket" . $e -> getMessage() . "\n";
            }
    }
    /*
    *   FIN Funcion IMPRIMIR TICKET
    */

    
	public function guardaVenta(){

		$this->load->model('ventas_model');
        $this->load->model('Entrada_stock_procesado_model');
		
		date_default_timezone_set('America/Mexico_City');
		$now = date('d-m-Y H:i:s');

        $info = $this->input->post('info');
        
		
        
        /*
		* Guardar en Tabla:::Ventas
		*/
		$datosVenta = array(
			'cliente'=>$info['cliente'],
			'status'=>$info['pagado'],
			'usuario'=>$info['usuario'],
			'fecha'=>$now,
			'pago' =>$info['abono']
		);
        $resultVenta = $this->ventas_model->insert_ventas($datosVenta);
        /*
        * Si la venta se guardó
        */
        if($resultVenta){
			//si se guardó la venta recupero el id de la venta recien insertada
            $idVenta = $this->db->insert_id();

            /*
            * Guardar en Ventas_Detalles
            */
            foreach ($info['detalles'] as $item) {
                
                $longCode = strlen($item['codigo']);
                $categoriaPollo = "";

                if ($longCode>20) {
                    /*
                    * POLLO PROCESADO
                    */
                    $cantidadCategory = $item['cantidad'];

                    if ($cantidadCategory==22) {
                        $categoriaPollo = 'Procesado-R3';    
                    }
                    if ($cantidadCategory==20) {
                    $categoriaPollo = 'Procesado-R4';    
                    }
                    if ($cantidadCategory==18) {
                    $categoriaPollo = 'Procesado-R5';    
                    }

                    $datosVentaDetalles = array(
                        'id_venta'=>$idVenta,
                        'pollo'=>$categoriaPollo,
                        'cantidad'=>$item['cantidad'],
                        'kg'=>$item['kilos'],
                        'precio_kg'=>$item['precio']
                    );

                    $resultAbono = $this->ventas_model->insert_ventas_detalles($datosVentaDetalles);
                    //Decrementa Procesado
                    $this->decrementa($item['cantidad'],$item['kilos'],$item['codigo']);


                }else{
                    
                    $categoriaPollo = $item['producto'];
                    $datosVentaDetalles = array(
                        'id_venta'=>$idVenta,
                        'pollo'=>$categoriaPollo,
                        'cantidad'=>$item['cantidad'],
                        'kg'=>$item['kilos'],
                        'precio_kg'=>$item['precio']
                    );                    
                    if ( (strpos($categoriaPollo, 'desplumado') !== false) || (strpos($categoriaPollo, 'menudeo') !== false )) {
                        /*
                        * POLLO DESPLUMADO / MENUDEO
                        * NO SE DESCUENTA DE INVENTARIO VIVO
                        */
                        $resultAbono = $this->ventas_model->insert_ventas_detalles($datosVentaDetalles);
                    }
                    else{                    
                        /*
                        * POLLO VIVO / ALIÑADO
                        * DESCUENTA DE INVENTARIO VIVO
                        */
                        $resultAbono = $this->ventas_model->insert_ventas_detalles($datosVentaDetalles);
                        $this->decrementa_vivo($item['cantidad']);
                    }
                }                                
            }//forEach

            //imprime ticket
            //$this->printTicket($info);

            $msg['success'] = TRUE;	
        }else {
            $msg['success'] = TRUE;	
        }
        $msg['info'] = $info;
        echo json_encode($msg);
    }//funcion GuardarVenta

    /*  Usada en Inventario
    *   Descontar Pollo Descompuesto
    *   Descontar de Stock
    */
    function decrementaDescompuesto(){
        $cantidad = $this->input->post('cantidad');
        $kilos = $this->input->post('kilos');
        $codigo = $this->input->post('codigo');
        $valida = $this->decrementa($cantidad,$kilos,$codigo);
        if ($valida) {
            $this->registraDescompuesto($cantidad,$kilos,$codigo);
            $msg['success'] = TRUE;               
        }else{
            $msg['success'] = FALSE;               
        }
        echo json_encode($msg);        
    }
    /*  Usada en Inventario
    *   Descontar Pollo Descompuesto
    *   guardar Registro
    *   tabla 'stock_ahogado_descompuesto'
    */
    function registraDescompuesto($cantidad,$kilos,$codigo){
        $this->load->model('Inventario_model');
        date_default_timezone_set('America/Mexico_City');
        $now = date('d-m-Y H:i:s');
        $params = array(
            'cantidad' => $cantidad,
            'kilos' => $kilos,
            'codigo' => $codigo,
            'usuario' => $_SESSION['name'],
            'fecha' => $now
        );
        $this->Inventario_model->add_ahogado_descompuesto($params);
    }

    /* 
    *   Funcion decrementa Stock Procesado Por CodigoBarras
    */    
    function decrementa($cantidad,$kilos,$codigo){
        $this->load->model('Entrada_stock_procesado_model');
        $stock = $this->Entrada_stock_procesado_model->get_entrada_stock_procesado($codigo);
        if ($stock) {
            $stock_kilos = $stock['stock_kilos'];
            $stock_cantidad = $stock['stock_cantidad'];
            $new_kilos = floatval($stock_kilos) - floatval($kilos);
            $new_cantidad = floatval($stock_cantidad) - floatval($cantidad);
            $params = array(
                'stock_kilos' => $new_kilos,
                'stock_cantidad' => $new_cantidad,
            );
            $this->Entrada_stock_procesado_model->update_entrada_stock_procesado($codigo,$params);  
            if ($new_cantidad <= 0) {
                $paramStatus = array(
                    'status' => 'agotado'
                    );
                $this->Entrada_stock_procesado_model->update_entrada_stock_status($codigo,$paramStatus);  
            }
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /* 
    *   Funcion decrementa Stock Vivo
    */
    function decrementa_vivo($cantidad){    
        $this->load->model('Stock_vivo_model');    
        $id = 1;
        $stock = $this->Stock_vivo_model->get_stock_vivo($id);

        $stock_cantidad = $stock['cantidad'];
        $new_cantidad = floatval($stock_cantidad) - floatval($cantidad);

        $params = array(
            'cantidad' => $new_cantidad,
        );

        $this->Stock_vivo_model->update_stock_vivo($id,$params);

    
    }

    function decrementa_vivo_post(){    
        $cantidad = $this->input->post('cantidad');
        $this->load->model('Stock_vivo_model');    
        $id = 1;
        $stock = $this->Stock_vivo_model->get_stock_vivo($id);

        $stock_cantidad = $stock['cantidad'];
        $new_cantidad = floatval($stock_cantidad) - floatval($cantidad);

        $params = array(
            'cantidad' => $new_cantidad,
        );

        $this->Stock_vivo_model->update_stock_vivo($id,$params);
        $msg['success'] = true;
        echo json_encode($msg);
    
    }

	/*
    *   ABONOS --------------------------------------------------------------------
    */
	function abonar(){
		$this->load->model('ventas_model');
		date_default_timezone_set('America/Mexico_City');
		$now = date('d-m-Y H:i:s');

		$id = $this->input->post('id');
		$abono = $this->input->post('abono');
		$restante = $this->input->post('restante');
        $tipo = $this->input->post('tipo');


		
		
		if ($abono>=$restante) {
			$this->updateStatusVenta($id,'pagado');
			$abono = $restante;
		}

		$data = array(
			'id_venta' => $id,
			'abono' => $abono,
			'fecha' => $now,
            'tipo' => $tipo
			 );

		$response = $this->ventas_model->insert_ventas_abonos($data);
		
		echo json_encode($data);
	}

	public function getAllDeben($cliente){    
		$this->load->model('ventas_model');	
    	return $this->ventas_model->getDeben($cliente);
    }


    function indexAbono(){
    	if ($this->session->userdata('logged_in')) {
    		$cliente = $this->input->post('cliente');
            $data['ventas'] = $this->getAllDeben($cliente);
            $this->load->view('header_view');
            $this->load->view('abonos_ventas/menu_top');
            $this->load->view('menu_left_view');
            $this->load->view('abonos_ventas/index',$data);
            $this->load->view('abonos_ventas/footer_view');
            
       	}else{
            $this->load->view('auth/login');
        }
    }

    function clientesDeudores(){
    	if ($this->session->userdata('logged_in')) {

            $data['clientes'] = $this->getClientesDeben();
            
            $arrayobject = [];
            foreach ($data['clientes'] as $key => $value) {
            	//echo json_encode($value['cliente']);
            	$nombre = $value['cliente'];
    			$debe = $this->getSaldoDebeCliente($value['cliente']); 	
    			//array_push($arrayClientes,$value['cliente'],$debe);
    			$arrayClientes = array(
    									'cliente'=> $nombre,
    									'debe' => $debe
    								);
    			//$arrayobject = new ArrayObject($arrayClientes);
    			array_push($arrayobject,$arrayClientes);
    			
            }

            
            $dataClientes['clientes'] = $arrayobject;
            //echo json_encode($dataClientes);
            //$clientes['info'] = $arrayClientes;

            $this->load->view('header_view');
            $this->load->view('clientes_deben/menu_top');
            $this->load->view('menu_left_view');
            $this->load->view('clientes_deben/index',$dataClientes);
            $this->load->view('clientes_deben/footer_view');

        }else{
            $this->load->view('auth/login');
        }
    }

    public function getClientesDeben(){    
		$this->load->model('ventas_model');			
    	return $this->ventas_model->getclientsDeben();
    }

    function updateStatusVenta($id,$status){
    	$this->load->model('ventas_model');	
    	$this->ventas_model->actualizaStatus($id,$status);    	
    }

    function sumaabonos(){
    	$this->load->model('ventas_model');	

    	$id = $this->input->post('id');
    	$data = $this->ventas_model->getsumaabonos($id);

    	echo json_encode($data);
    }

//obtiene total venta por id
    //irá dentro de un for para obtener la suma total x cliente
    function getTotalVenta($id){
    	//$id = $this->input->post('id');
    	$this->load->model('ventas_model');
    	$data['detalles'] = $this->ventas_model->getDetalles($id);
    	$total = 0;
    	foreach ($data['detalles'] as $key => $value) {
    		//echo json_encode($value);
    		if ($value['pollo']==='Desplumado') {
    			$total += $value['cantidad'] * $value['precio_kg'];
    		}else{
    			$total += $value['kg'] * $value['precio_kg'];
    		}
    	}
    	//echo json_encode($total);
    	return $total;
    }
//obtiene todas las compras de un cliente x id-cliente
    //recibe -nombre-cliente
    function getIdsVentasByCliente($cliente){
    	//$cliente = $this->input->post('cliente');
    	$this->load->model('ventas_model');
    	$data['idsVentas'] = $this->ventas_model->getIds($cliente);
    	//echo json_encode($data);
    	return $data;
    }
    //Total abonos de una venta especifico x id
    function totalAbonos($idVenta){    	 
    	$this->load->model('ventas_model');	    	
    	$data = $this->ventas_model->getTotalAbonos($idVenta);
    	return $data['abono'];
    }
//Suma el total de ventas que aparece debiendo
    function getSaldoDebeCliente($cliente){    	
    	$arrayIdVentas = $this->getIdsVentasByCliente($cliente);
    	$debe = 0;
    	$pagos =0;
    	$abonos = 0;
    	foreach ($arrayIdVentas['idsVentas'] as $key => $value) {
    		//echo json_encode($value['id']);
    		$id = $value['id'];    		
    		$pagos += floatval($value['pago']);
    		$debe += floatval($this->getTotalVenta($id));
    		$abonos += floatval($this->totalAbonos($id));
    	}
    	
    	$total = $debe - ($pagos + $abonos) ;
    	return $total;
    }


//Guarda saldo atrasado
    public function guarda_saldo_atrasado(){

        $this->load->model('ventas_model');
        
        date_default_timezone_set('America/Mexico_City');
        $now = date('d-m-Y H:i:s');

        $info = $this->input->post('info');
        //$msg['success'] = $info['cliente'];
        $msg['success'] = $info;       
        /*
        * Guardar en Ventas
        */
        $datosVenta = array(
            'cliente'=>$info['cliente'],
            'status'=>'debe',
            'usuario'=>$info['usuario'],
            'fecha'=>'saldo atrasado',
            'pago' =>0
        );

        $resultVenta = $this->ventas_model->insert_ventas($datosVenta);
        //si Model guarda $result = true
        if($resultVenta){
            //si se guardo la venta recupero el id de la venta recien insertada
            $idVenta = $this->db->insert_id();            
                /*
                * Guardar en Ventas_Detalles
                */            
                    $datosVentaDetalles = array(
                            'id_venta'=>$idVenta,
                            'pollo'=>'Saldo Atrasado',
                            'cantidad'=>1,
                            'kg'=>1,
                            'precio_kg'=>$info['pagado']
                        );

                    $resultAbono = $this->ventas_model->insert_ventas_detalles($datosVentaDetalles);
                    
                
            

        }//If $resultVenta

        echo json_encode($msg);

    }

    public function saldos_atrasados(){
        if ($this->session->userdata('logged_in')) {
            $datos['clientes'] = $this->getSaldosAtrasados();            
            $this->load->view('header_view');
            $this->load->view('saldo_atrasado/menu_top_ventas');
            $this->load->view('menu_left_view');
            $this->load->view('saldo_atrasado/ventas',$datos);
            $this->load->view('saldo_atrasado/footer_view_ventas');
        }else{
            $this->load->view('auth/login');
        }
    }
    function getSaldosAtrasados(){
        $this->load->model('Ventas_model');
        $saldos = $this->Ventas_model->saldos_atrasados();
        return $saldos;
    }
    function eliminaSaldoAtrasado($id){
        $this->load->model('Ventas_model');
        $response = $this->Ventas_model->eliminaAtrasado($id);
        if($response){
            $this->session->set_flashdata("success","Registro Cancelado");
            redirect(base_url('ventas/saldos_atrasados'));
        }else{
            $this->session->set_flashdata("error","No se pudo cancelar el registro");
            redirect(base_url('ventas/saldos_atrasados'));
        }
    }



    public function registrar($data)
   {
      //Iniciamos la transacción.    
      $this->db->trans_begin();    
      //Intenta insertar un cliente.    
      $this->db->insert('clientes', array(      
         'nombre' => $data['nombre'],      
         'apellido' => $data['apellido'],      
         'domicilio' => $data['domicilio'],       
         'telefono' => $data['telefono'],       
         'email' => $data['email'],      
         'fecha_registro' => date('Y-m-d H:i:s')    
      ));    
      //Recuperamos el id del cliente registrado.    
      $cliente_id = $this->db->insert_id();    
      //Insertamos los servicios que desea adquirir el cliente.    
      foreach($data['servicios'] as $servicio_id){        
         $this->db->insert('servicios_clientes', array(      
            'servicio_id' => $servicio_id,      
            'cliente_id' => $cliente_id      
         ));    
      }    
      if ($this->db->trans_status() === FALSE){      
         //Hubo errores en la consulta, entonces se cancela la transacción.   
         $this->db->trans_rollback();      
         return false;    
      }else{      
         //Todas las consultas se hicieron correctamente.  
         $this->db->trans_commit();    
         return true;    
      }  
   }


}// end class