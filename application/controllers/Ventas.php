<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 require __DIR__ . '../autoload.php';
 use Mike42\Escpos\Printer;
 use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class Ventas extends CI_Controller {

    
    public function __construct()
    {
        parent :: __construct();
        $this->load->model('ventas_model');

        $this->load->model('Entrada_efectivo_caja_model');
            date_default_timezone_set('America/Mexico_City');
            $now = date('d-m-Y');
            $data['entrada'] = $this->Entrada_efectivo_caja_model->getCaja($now);
            //Si aun no se registro la caja inicial del dia
            if (!$data['entrada']) {
                redirect('caja');
            }

    }

    /*
    *   Funcion IMPRIMIR TICKET
    */
    public function printTicketPost(){
        $params = $this->input->post('id');
        $this->printTicket($params);
        $data['success'] = true;
        echo json_encode($data);
    }
    
    public function printTicket($productos){

        try {

                //Fecha y hora actual
                date_default_timezone_set('America/Mexico_City');
                $fecha= date("d/m/Y H:i:s");
                $connector = NULL;
                //El nombre de la impresora es POS-58
                $connector = new WindowsPrintConnector("ticket");
                //$connector = new WindowsPrintConnector("POS-58");
                $printer = new Printer($connector);   

                //Establecemos los datos del TICKET a imprimir

                $printer -> setJustification(Printer::JUSTIFY_CENTER);
                $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
                //$printer -> feed(1); 
                $printer -> setTextSize(3, 1);
                $printer -> text("POLLERIA LOMA\n");
                $printer -> feed(1);   
                $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
                $printer -> text("CALLE MEXICO #44\n");
                $printer -> text("COLONIA CENTRO\n");
                $printer -> text("TEL 281 87 2 19 00\n");
                $printer -> text("TEL 281 87 2 17 02\n");
                $printer -> text("LOMA BONITA, OAX\n");
                $printer -> text($fecha);        
                $printer->text("\n--------------------\n");
                $textMayusc = mb_strtoupper($productos['nombreCliente']);
                $tam = strlen($textMayusc);
                if ($tam>20) {
                    $printer -> setEmphasis(true);
                    $printer -> setTextSize(1, 1);
                    $printer -> text($textMayusc);
                }else{
                    $printer -> setTextSize(2, 1);
                    $printer -> text($textMayusc);
                }
                $printer -> setEmphasis(false);
                $printer -> setTextSize(2, 1);
                $printer->text("\n--------------------");
                //$printer->text("\nDESCRIPCION\n");
                $printer -> feed(1); 
                $printer -> setJustification(); // Reset

                $charset='UTF-8'; // o 'UTF-8' setea  
                $toalapagar =0;
                $printer -> setJustification(Printer::JUSTIFY_LEFT);
                //*********************************************************************************
                $CantAbono = $productos['pago'];
                $printer -> setTextSize(1, 1);
                //$printer -> text(" KG     PRECIO  CANT POLLO\n");
                $printer -> text("CANT  POLLO            KG     PRECIO\n");
                foreach ($productos['detalles'] as $item) {
                    //Mayuscula la primer letra
                    $nombreDescM=ucwords($item['producto']);
                    //Elimino acentos y ñ        
                    $str = iconv($charset, 'ASCII//TRANSLIT', $nombreDescM);
                    $nuevo = preg_replace("/[^A-Za-z0-9 ]/", '', $str);

                    switch ($nuevo) {
                        case 'BOLSA':
                            //$descripcion = "         ".$item['precio']."   ".$item['cantidad']." ".$nuevo;
                            break;
                        case 'DESPLUMADO':
                            if ($item['cantidad']<10) {
                                $descripcion = $item['cantidad']."  ".$nuevo." "."          "."    ".$item['precio'];
                            }else{
                                $descripcion = $item['cantidad']." ".$nuevo." "."          "."    ".$item['precio'];
                            }     
                            $printer -> text("\n".$descripcion);                                       
                            $printer -> feed();    
                            $printer -> setJustification(Printer::JUSTIFY_RIGHT);  
                            $printer -> setEmphasis(true);
                            if ($nuevo != "BOLSA") {
                                $printer -> text("Importe $ ".number_format($item['importe'],2,".","," )."\n");
                            }                    
                            $printer -> setEmphasis(false);
                            $printer -> setJustification(); // Reset            
                            break;
                        case 'SALDO ATRASADO':
                            //$descripcion = "         "."    "."   ".""."".$nuevo;
                            break; 
                        case 'VIVO':
                            $longKilos = strlen($item['kilos']);
                            if ($longKilos == 6) {
                                if ($item['cantidad']<10) {
                                    $descripcion = $item['cantidad']."  ".$nuevo."            ".$item['kilos']."  ".$item['precio'];
                                }else{
                                    $descripcion = $item['cantidad']." ".$nuevo."            ".$item['kilos']." ".$item['precio'];
                                }                                
                            }
                            if ($longKilos == 5) {
                                $descripcion = $item['cantidad']." ".$nuevo."            ".$item['kilos']."   ".$item['precio'];
                            }
                            if ($longKilos == 4) {
                                if ($item['cantidad']<10) {
                                    $descripcion = $item['cantidad']."  ".$nuevo."             ".$item['kilos']."   ".$item['precio'];
                                }
                            }  
                            $printer -> text("\n".$descripcion);                                       
                            $printer -> feed();    
                            $printer -> setJustification(Printer::JUSTIFY_RIGHT);  
                            $printer -> setEmphasis(true);
                            if ($nuevo != "BOLSA") {
                                $printer -> text("Importe $ ".number_format($item['importe'],2,".","," )."\n");
                            }                    
                            $printer -> setEmphasis(false);
                            $printer -> setJustification(); // Reset
                                                     
                            break;      
                        case 'ALINADO':
                            $longKilos = strlen($item['kilos']);
                            if ($longKilos == 6) {
                                $descripcion = $item['cantidad']." ".$nuevo."         ".$item['kilos']."  ".$item['precio'];
                            }
                            if ($longKilos == 5) {
                                $descripcion = $item['cantidad']." ".$nuevo."         ".$item['kilos']."   ".$item['precio'];
                            }
                            if ($longKilos == 4) {
                                if ($item['cantidad']<10) {
                                    $descripcion = $item['cantidad']."  ".$nuevo."          ".$item['kilos']."    ".$item['precio'];
                                }
                            }   
                            $printer -> text("\n".$descripcion);                                       
                            $printer -> feed();    
                            $printer -> setJustification(Printer::JUSTIFY_RIGHT);  
                            $printer -> setEmphasis(true);
                            if ($nuevo != "BOLSA") {
                                $printer -> text("Importe $ ".number_format($item['importe'],2,".","," )."\n");
                            }                    
                            $printer -> setEmphasis(false);
                            $printer -> setJustification(); // Reset                 
                            break;   
                        case 'PROCESADO':
                            $longKilos = strlen($item['kilos']);
                            if ($longKilos == 6) {
                                $descripcion = $item['cantidad']." ".$nuevo."        ".$item['kilos']."  ".$item['precio'];
                            }
                            if ($longKilos == 5) {
                                $descripcion = $item['cantidad']." ".$nuevo."        ".$item['kilos']."  ".$item['precio'];
                            }
                            if ($longKilos == 4) {
                                if ($item['cantidad']<10) {
                                    $descripcion = $item['cantidad']."  ".$nuevo."        ".$item['kilos']."   ".$item['precio'];
                                }
                            }   
                            $printer -> text("\n".$descripcion);                                       
                            $printer -> feed();    
                            $printer -> setJustification(Printer::JUSTIFY_RIGHT);  
                            $printer -> setEmphasis(true);
                            if ($nuevo != "BOLSA") {
                                $printer -> text("Importe $ ".number_format($item['importe'],2,".","," )."\n");
                            }                    
                            $printer -> setEmphasis(false);
                            $printer -> setJustification(); // Reset                   
                            break;      
                        case 'POLLO SURTIDO':
                            $longKilos = strlen($item['kilos']);
                            if ($longKilos == 6) { 
                                $descripcion = $item['cantidad']." ".$nuevo."  ".$item['kilos']."  ".$item['precio'];
                            }
                            if ($longKilos == 5) {
                                $descripcion = $item['cantidad']." ".$nuevo."   ".$item['kilos']."   ".$item['precio'];
                            }
                            if ($longKilos == 4) {
                                if ($item['cantidad']<10) {
                                    $descripcion = $item['cantidad']."  ".$nuevo."    ".$item['kilos']."    ".$item['precio'];
                                }
                            }  
                            $printer -> text("\n".$descripcion);                                       
                            $printer -> feed();    
                            $printer -> setJustification(Printer::JUSTIFY_RIGHT);  
                            $printer -> setEmphasis(true);
                            if ($nuevo != "BOLSA") {
                                $printer -> text("Importe $ ".number_format($item['importe'],2,".","," )."\n");
                            }                    
                            $printer -> setEmphasis(false);
                            $printer -> setJustification(); // Reset                   
                            break;    
                        case 'PIERNA SCADERA':
                            $longKilos = strlen($item['kilos']);
                            if ($longKilos == 6) { 
                                $descripcion = $item['cantidad']." ".$nuevo." ".$item['kilos']."  ".$item['precio'];
                            }
                            if ($longKilos == 5) {
                                $descripcion = $item['cantidad']." ".$nuevo."  ".$item['kilos']."   ".$item['precio'];
                            }
                            if ($longKilos == 4) {
                                if ($item['cantidad']<10) {
                                    $descripcion = $item['cantidad']."  ".$nuevo."   ".$item['kilos']."   ".$item['precio'];
                                }
                            }  
                            $printer -> text("\n".$descripcion);                                       
                            $printer -> feed();    
                            $printer -> setJustification(Printer::JUSTIFY_RIGHT);  
                            $printer -> setEmphasis(true);
                            if ($nuevo != "BOLSA") {
                                $printer -> text("Importe $ ".number_format($item['importe'],2,".","," )."\n");
                            }                    
                            $printer -> setEmphasis(false);
                            $printer -> setJustification(); // Reset                   
                            break;   
                        case 'PIERNA CCADERA':
                            $longKilos = strlen($item['kilos']);
                            if ($longKilos == 6) { 
                                $descripcion = $item['cantidad']." ".$nuevo."  ".$item['kilos']."  ".$item['precio'];
                            }
                            if ($longKilos == 5) {
                                $descripcion = $item['cantidad']." ".$nuevo."  ".$item['kilos']."   ".$item['precio'];
                            }
                            if ($longKilos == 4) {
                                if ($item['cantidad']<10) {
                                    $descripcion = $item['cantidad']."  ".$nuevo."   ".$item['kilos']."   ".$item['precio'];
                                }
                            }  
                            $printer -> text("\n".$descripcion);                                       
                            $printer -> feed();    
                            $printer -> setJustification(Printer::JUSTIFY_RIGHT);  
                            $printer -> setEmphasis(true);
                            if ($nuevo != "BOLSA") {
                                $printer -> text("Importe $ ".number_format($item['importe'],2,".","," )."\n");
                            }                    
                            $printer -> setEmphasis(false);
                            $printer -> setJustification(); // Reset                   
                            break;
                        case 'PECHUGA SHUACAL':
                            $longKilos = strlen($item['kilos']);
                            if ($longKilos == 6) { 
                                $descripcion = $item['cantidad']." ".$nuevo." ".$item['kilos']."  ".$item['precio'];
                            }
                            if ($longKilos == 5) {
                                $descripcion = $item['cantidad']." ".$nuevo." ".$item['kilos']."   ".$item['precio'];
                            }
                            if ($longKilos == 4) {
                                if ($item['cantidad']<10) {
                                    $descripcion = $item['cantidad']."  ".$nuevo."  ".$item['kilos']."   ".$item['precio'];
                                }
                            }  
                            $printer -> text("\n".$descripcion);                                       
                            $printer -> feed();    
                            $printer -> setJustification(Printer::JUSTIFY_RIGHT);  
                            $printer -> setEmphasis(true);
                            if ($nuevo != "BOLSA") {
                                $printer -> text("Importe $ ".number_format($item['importe'],2,".","," )."\n");
                            }                    
                            $printer -> setEmphasis(false);
                            $printer -> setJustification(); // Reset                   
                            break;  
                        case 'PECHUGA CHUACAL':
                            $longKilos = strlen($item['kilos']);
                            if ($longKilos == 6) { 
                                $descripcion = $item['cantidad']." ".$nuevo." ".$item['kilos']."  ".$item['precio'];
                            }
                            if ($longKilos == 5) {
                                $descripcion = $item['cantidad']." ".$nuevo." ".$item['kilos']."   ".$item['precio'];
                            }
                            if ($longKilos == 4) {
                                if ($item['cantidad']<10) {
                                    $descripcion = $item['cantidad']."  ".$nuevo."  ".$item['kilos']."    ".$item['precio'];
                                }
                            }  
                            $printer -> text("\n".$descripcion);                                       
                            $printer -> feed();    
                            $printer -> setJustification(Printer::JUSTIFY_RIGHT);  
                            $printer -> setEmphasis(true);
                            if ($nuevo != "BOLSA") {
                                $printer -> text("Importe $ ".number_format($item['importe'],2,".","," )."\n");
                            }                    
                            $printer -> setEmphasis(false);
                            $printer -> setJustification(); // Reset                   
                            break; 
                        case 'ALITAS':
                            $longKilos = strlen($item['kilos']);
                            if ($longKilos == 6) { 
                                $descripcion = $item['cantidad']." ".$nuevo."           ".$item['kilos']."  ".$item['precio'];
                            }
                            if ($longKilos == 5) {
                                $descripcion = $item['cantidad']." ".$nuevo."          ".$item['kilos']."   ".$item['precio'];
                            }
                            if ($longKilos == 4) {
                                if ($item['cantidad']<10) {
                                    $descripcion = $item['cantidad']."  ".$nuevo."            ".$item['kilos']."    ".$item['precio'];
                                }
                            }  
                            $printer -> text("\n".$descripcion);                                       
                            $printer -> feed();    
                            $printer -> setJustification(Printer::JUSTIFY_RIGHT);  
                            $printer -> setEmphasis(true);
                            if ($nuevo != "BOLSA") {
                                $printer -> text("Importe $ ".number_format($item['importe'],2,".","," )."\n");
                            }                    
                            $printer -> setEmphasis(false);
                            $printer -> setJustification(); // Reset                   
                            break;
                        case 'FILETE':
                            $longKilos = strlen($item['kilos']);
                            if ($longKilos == 6) { 
                                $descripcion = $item['cantidad']." ".$nuevo."           ".$item['kilos']."  ".$item['precio'];
                            }
                            if ($longKilos == 5) {
                                $descripcion = $item['cantidad']." ".$nuevo."          ".$item['kilos']."  ".$item['precio'];
                            }
                            if ($longKilos == 4) {
                                if ($item['cantidad']<10) {
                                    $descripcion = $item['cantidad']."  ".$nuevo."           ".$item['kilos']."    ".$item['precio'];
                                }
                            }  
                            $printer -> text("\n".$descripcion);                                       
                            $printer -> feed();    
                            $printer -> setJustification(Printer::JUSTIFY_RIGHT);  
                            $printer -> setEmphasis(true);
                            if ($nuevo != "BOLSA") {
                                $printer -> text("Importe $ ".number_format($item['importe'],2,".","," )."\n");
                            }                    
                            $printer -> setEmphasis(false);
                            $printer -> setJustification(); // Reset                   
                            break;
                        case 'MENUDENCIA':
                            if ($item['cantidad']<10) {
                                $descripcion = $item['cantidad']."  ".$nuevo." "."      ".$item['kilos']."  ".$item['precio'];
                            }else{
                                $descripcion = $item['cantidad']." ".$nuevo." "."        ".$item['kilos']."   ".$item['precio'];
                            }     
                            $printer -> text("\n".$descripcion);                                       
                            $printer -> feed();    
                            $printer -> setJustification(Printer::JUSTIFY_RIGHT);  
                            $printer -> setEmphasis(true);
                            if ($nuevo != "BOLSA") {
                                $printer -> text("Importe $ ".number_format($item['importe'],2,".","," )."\n");
                            }                    
                            $printer -> setEmphasis(false);
                            $printer -> setJustification(); // Reset                     
                            break;
                        case 'MENUDO FRIO':
                            if ($item['cantidad']<10) {
                                $descripcion = $item['cantidad']."  ".$nuevo." "."     ".$item['kilos']."  ".$item['precio'];
                            }else{
                                $descripcion = $item['cantidad']." ".$nuevo." "."     ".$item['kilos']."   ".$item['precio'];
                            }     
                            $printer -> text("\n".$descripcion);                                       
                            $printer -> feed();    
                            $printer -> setJustification(Printer::JUSTIFY_RIGHT);  
                            $printer -> setEmphasis(true);
                            if ($nuevo != "BOLSA") {
                                $printer -> text("Importe $ ".number_format($item['importe'],2,".","," )."\n");
                            }                    
                            $printer -> setEmphasis(false);
                            $printer -> setJustification(); // Reset                     
                            break;
                    }
                
                    $toalapagar+=$item['importe']; 
                    
                    
                }
                $printer -> setTextSize(2, 1);
                //*********************************************************************************
                $printer -> setJustification(Printer::JUSTIFY_RIGHT); 
                $printer -> feed(2);    
                $printer -> text("Subtotal $ ".number_format($toalapagar,2,".","," )."\n");
                $printer -> text("Abono $ ".number_format($CantAbono,2,".","," )."\n");
                $printer -> text("S. Pendiente $ ".number_format($toalapagar-$CantAbono,2,".","," )."\n");
                $printer -> feed(2);    
                $printer -> setJustification(Printer::JUSTIFY_CENTER);
                $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
                $printer -> text("Gracias por\n");
                $printer -> text("su compra\n");

                //$printer -> text("Loma Bonita Oaxaca\n"); 
                $printer -> feed(1);
                /* Pulse Manda un PULSO y abre la caja registradora
                pulse($pin, $on_ms, $off_ms)
                Generate a pulse, for opening a cash drawer if one is connected. The default settings (0, 120, 240) should open an Epson drawer.*/
                $printer -> pulse();
                $printer->cut();
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

    public function index(){
        if (!$this->session->userdata('logged_in')) {
            $this->load->view('auth/login');
        }else{
            //$this->testSize();
            $data['formasPago'] = $this->getListadoFormasDePago();
            $data['page']="ventas";
            $this->load->view('layout/header',$data);
            $this->load->view('layout/ventas_view',$data);
            $this->load->view('layout/footer');
        }
    }

    /*
    *   Recibe ID cliente
    *   Retorna Listado: fecha e importe deuda venta
    */
    function getSaldoDebeCliente(){    	
        $id = $this->input->post('id');
        $arrayIdVentas = $this->getIdsVentasByCliente($id);
        //echo json_encode($id);
    	$debe = 0;
        $abonos = 0;
        $arrayobject = [];
        $data['success'] = false;
    	foreach ($arrayIdVentas['idsVentas'] as $key => $value) {
    		$id = $value['id'];    		
    		$debe = floatval($this->getTotalVenta($id));
            $abonos = floatval($this->totalAbonos($id));
            $total = $debe -  $abonos;
            $arrayClientes = array(
                                        'id' => $id,
    									'fecha'=> $value['fecha'],
    									'saldo' =>$total //number_format($total,2,".","," )
                                    );
            array_push($arrayobject,$arrayClientes);
            $data['success'] = true;
    	}
    	$data['data'] = $arrayobject;
    	echo json_encode($data);
    }
    /*
    *   obtiene todas las ventas de un cliente x id-cliente
    */
    function getIdsVentasByCliente($id){
    	$data['idsVentas'] = $this->ventas_model->getIds($id);
    	return $data;
    }
    /*
    *   obtiene total venta por id
    */
    function getTotalVenta($id){
    	$data['detalles'] = $this->ventas_model->getDetalles($id);
    	$total = 0;
    	foreach ($data['detalles'] as $key => $value) {
    		if ($value['producto']==='Desplumado') {
    			$total += $value['cantidad'] * $value['precio'];
    		}else{
    			$total += $value['kilos'] * $value['precio'];
    		}
    	}
    	return $total;
    }
    /*
    *   Total abonos de una venta especifico x id
    */
    function totalAbonos($idVenta){    	 	
    	$data = $this->ventas_model->getTotalAbonos($idVenta);
    	return $data['abono'];
    }
    function sumatotalAbonos(){ 
        $idVenta = $this->input->post('id');    	 	
    	$data = $this->ventas_model->getTotalAbonos($idVenta);
    	echo json_encode($data['abono']);
    }
    function getDetallesVenta(){
        $id = $this->input->post('id');
        $data['data'] = $this->ventas_model->getDetalles($id);
        $data['success'] = false;
        if ($data['data']) {
            $data['success'] = true;
        }
        echo json_encode($data);
    }

    function getListadoAbonos(){
        $id = $this->input->post('id');
        $data['data'] = $this->ventas_model->getHistorialAbonos($id);
        $data['success'] = false;
        if ($data['data']) {
            $data['success'] = true;
        }
        echo json_encode($data);
    }

    function getListadoFormasDePago(){
        $data['data'] = $this->ventas_model->formasDePago();
        $data['success'] = false;
        if ($data['data']) {
            $data['success'] = true;
        }
        return $data;
    }

    /*
    *   GUARDAR VENTA
    */
    public function guardaVenta(){

        $this->load->model('Entrada_stock_procesado_model');
		date_default_timezone_set('America/Mexico_City');
		$now = date('d/m/Y');
        $info = $this->input->post('id');       
        $sumaImportes = $this->getImporteCart($info['carrito']);
        /*
        *   TIPO DE ABONOS = ABONAR VENTA ACTUAL
        */
        $importe_pagado = floatval($info['pago']);
        $importe_venta_actual = floatval($sumaImportes);
        date_default_timezone_set('America/Mexico_City');
        $fecha = date('d/m/Y');
        $usuario = $_SESSION['name'];
        /*
        *   SABER STATUS ->DEBE  ->PAGADO
        *   ABONO A VENTA ACTUAL
        */
        if ($info['tipoAbono']=="venta_actual") {
            # code...ABONO LIGADO A VENTA ACTUAL
            if ($importe_pagado<$importe_venta_actual) {
                $status_venta = "debe";
            }else{
                $status_venta = "pagado";
                $importe_pagado = $importe_venta_actual;    
            }
            /*
            * DATOS PARA TICKET
            */
            $this->load->model('Clientes_model');
            $nombreCliente = $this->Clientes_model->get_cliente($info['cliente']);

            /*
            *   GUARDAR DATOS TABLA:
            *   VENTAS:::VENTAS_DETALLES_VENTAS_PAGOS
            */
            $params = array(
                'nombreCliente' => $nombreCliente['nombre'],
                'id_cliente'=>$info['cliente'],
                'id_forma_pago'=>$info['tipoPago'],
                'pago' => $importe_pagado,
                'status'=>$status_venta,
                'usuario'=>$usuario,
                'fecha'=>$fecha,
                'detalles' => $info['carrito']
            ); 
            $response = $this->ventas_model->insert_datos_venta_actual($params);
            $msg['data'] = $params;
        }else {
            # code...ABONO DIFERIDO ENTRE SALDOS PENDIENTES
        }
        
        if ($response['success']){
            //TRUE ::: TRANSACCION SUCCESS
            $msg['success'] = true;    
            $msg['id'] = $response['id'];        
            //$this->printTicket($params);
        }else{
            //FALSE ::: TRANSACCION ERROR
            $msg['success'] = false;        
        }
        echo json_encode($msg);
        
    }//  FIN GUARDA VENTA

      
    /*
    *   TOTAL IMPORTE CARRITO
    */
    function getImporteCart($carrito){
        $importe = 0;
        foreach($carrito as $item){
            $importe += floatval($item['importe']);
        }
        return $importe;
    }

    /*
    *   ABONAR VENTA ESPECIFICA BY ID-VENTA
    */
    public function abonarVenta(){
        date_default_timezone_set('America/Mexico_City');
        $fecha = date('d/m/Y');
        
        $info = $this->input->post('id');
        
        $saldo = $this->getSaldoVenta($info['id']);
        $importe_pagado = $info['importe'];

        $importe = 0;
        $cambio = 0;

        if ($importe_pagado>$saldo) {
            $importe = $saldo;
            $cambio = $importe_pagado - $saldo;
            $status = "pagado";
            $this->ventas_model->actualizaStatusVenta($info['id'],$status);
        }else{
            $importe = $importe_pagado;
        }
        $params = array(
            'id_venta' => $info['id'],
            'id_forma_pago' => $info['id_forma_pago'],
            'importe' => $importe,
            'fecha' => $fecha
        );
        
        $response = $this->ventas_model->addAbono($params);
        $msg['cambio'] = $cambio;
        if ($response) {           
            $msg['success'] = true;
        }else{
            $msg['success'] = false;
        }
        echo json_encode($msg);
    }

    /*
    *   GET SALDO VENTA BY ID-VENTA
    */
    function getSaldoVenta($id_venta){
        $debe = floatval($this->getTotalVenta($id_venta));
        $abonos = floatval($this->totalAbonos($id_venta));
        $saldo = $debe -  $abonos;
        return $saldo;
    }

    /*
	*	OBTIENE ALL INFO PROCESADO BY CODIGO_INTERNO(9 DIGITOS) PROCESADO & = DISPONIBLE
	*/
    function getDataProcesado(){
        $codigo = $this->input->post('codigo');
        $stock = $this->ventas_model->get_stock_procesado_por_codigo($codigo);
        if ($stock) {
            $msg['success'] = true;
            $msg['stock'] = $stock;
        }else{
            $msg['success'] = false;
        }
        echo json_encode($msg);
    }
    /*
    *	OBTIENE STOCK PROCESADO BY CODIGO-UNICO(25 DIGITOS-GENERADOS)
    *   RETORNA 
    *   STOCK-CANTIDAD
    *   STOCK-KILOS
	*/
    function getDataStockProcesado(){
        $codigo = $this->input->post('codigo');
        $stock = $this->ventas_model->get_stock_procesado_por_codigo_unico($codigo);
        if ($stock) {
            $msg['success'] = true;
            $msg['stock'] = $stock;
        }else{
            $msg['success'] = false;
        }
        echo json_encode($msg);
        //return $msg;
    }
    /*
    *   USADA EN SECCION INVENTARIO
    */
    public function getStock(){
        $this->load->model('Entrada_stock_procesado_model');
        //return $this->Entrada_stock_procesado_model->getAllStock();
        echo json_encode($this->Entrada_stock_procesado_model->getAllStock());
    }
    /*
    *   RECIBE ID DE VENTA
    */
    public function eliminaVenta(){
        $id = $this->input->post('id');
        $this->load->model('Editar_ventas_model');
        $this->ventas_model->deleteVenta($id);
        $msg['success'] = true;
        echo json_encode($msg);
    }
    /*
    *   EDITAR VENTA
    */
    function editarVenta(){
        $params = $this->input->post('id');

        $id = $params['id'];
        $q1 = floatval($params['cantidad']);
        if ($q1=="") {
            $q1=0;
        }
        $k1 = floatval($params['kilos']);
        if ($k1=="") {
            $k1=0;
        }
        $data = $this->getDetalleVentaByIdDetalle($id);
        $q2 = floatval($data['cantidad']);
        $k2 = floatval($data['kilos']);
        $price = floatval($data['precio']);

        $newCantidad = $q2-$q1;
        $newKilos = $k2-$k1;
        $newImporte = $price*$newKilos;

        $msg['cant'] = $newCantidad;
        $msg['kilos'] = $newKilos;
        $msg['precio'] = $newImporte;

        $msg['success'] = true;
        $msg['params'] = $params;
        $datos = array('cantidad' => $newCantidad,
                        'kilos'=> $newKilos,
                        'importe' => $newImporte );
        $this->updateVenta($id,$datos);
        echo json_encode($msg);
    }
    function getDetalleVentaByIdDetalle($idDetalle){
        return $this->ventas_model->getDetalleById($idDetalle);
    }
    function updateVenta($id,$params){
        $this->ventas_model->actualizaVenta($id,$params);
    }




}//END CLASS