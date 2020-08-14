<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Corte extends CI_Controller{

    public function __construct()
    {
        parent :: __construct();
        $this->load->model('myauth_model');
        $this->load->model('usuarios_model');

        $this->load->model('Entrada_efectivo_caja_model');
            date_default_timezone_set('America/Mexico_City');
            $now = date('d-m-Y');
            $data['entrada'] = $this->Entrada_efectivo_caja_model->getCaja($now);
            //Si aun no se registro la caja inicial del dia
            if (!$data['entrada']) {
                redirect('caja');
            }

    }

    function index(){
        //RECIBE FECHA dd-mm-yyyy      
        if(isset($_POST['fecha'])){
            $fecha = $this->input->post('fecha');              
            $this->cargaDatosCorteByFecha($fecha);
        }else{
            date_default_timezone_set('America/Mexico_City');
            $fecha = date('d-m-Y');
            $this->cargaDatosCorteByFecha($fecha);            
        }
        
    }

    function cargaDatosCorteByFecha($fecha){
        
        //ENTRADA IMPORTE CAJA INICIAL POR FECHA
        $data['caja'] = $this->getImporteCaja($fecha);
        /*  Forma pago
        * 1 Efectivo
        * 2 Echeque
        * 3 Transferencia
        */
        //ENTRADA IMPORTE EFECTIVO FECHA
        $data['entrada_efectivo'] = $this->sumaEntradasByTipo("1",$fecha);
        //ENTRADA IMPORTE CHEQUES
        $data['entrada_cheque'] = $this->sumaEntradasByTipo("2",$fecha);
        //ENTRADA IMPORTE TRANSFERENCIAS
        $data['entrada_transferencia'] = $this->sumaEntradasByTipo("3",$fecha);
        //OBTIENE GASTOS
        $data['gastos'] = $this->getGastos($fecha);
        //RESUMEN POLLOS POR TIPO
        $data['vivo'] = $this->getResumenPollos("vivo",$fecha);
        $data['desplumado'] = $this->getResumenPollos("desplumado",$fecha);
        $data['alinado'] = $this->getResumenPollos("aliñado",$fecha);
        $data['procesado'] = $this->getResumenPollos("procesado",$fecha);

        $data['clientes'] = $this->reporteVentas($fecha);
        $data['fecha'] = $this->formateaFecha($fecha);
        $data['page']="corte";
        $this->load->view('layout/header',$data);
        $this->load->view('layout/corte/index',$data);
        $this->load->view('layout/corte/footer');
    }
    function sumaEntradasByTipo($tipoEntrada,$fecha){
        $this->load->model('corte_model');
        $f = $this->formateaFecha($fecha);
        $response = $this->corte_model->sumaEntradas($tipoEntrada,$f);
        if ($response) {
            return $response[0]['importe'];
        }else{
            return 0;
        }
    }
    function getGastos($fecha){
        $this->load->model('corte_model');
        $response = $this->corte_model->obtieneGastos($fecha);
        if ($response) {
            return $response[0]['importe'];
        }else{
            return 0;
        }
    }

    function getImporteCaja($fecha){        
        //fecha formato(dd-mm-yyyy)
        $this->load->model('Entrada_efectivo_caja_model');
        $data['caja'] = $this->Entrada_efectivo_caja_model->getCaja($fecha);
        $response = $data['caja'];
        
        if ($response) {
            return $response[0]['importe'];
        }else{
            return 0;
        }
    }
    function sumaPagos($tipo,$fecha){
        $this->load->model('corte_model');
        $response = $this->corte_model->getPago($tipo,$fecha);
        
        if ($response) {
            return $response;
        }else{
            return 0;
        }
    }
    function formateaFecha($fecha){
        $newFecha = str_replace("-","/",$fecha);
        return $newFecha;
    }

    /*
    *   REPORTE LISTADO DE VENTAS BY FECHA
    *   RETURN ->idCLIENTE-CLIENTE-SALDO-FECHA
    */
    function reporteVentas($fecha){
        //$fecha = $this->input->post('fecha');
        $data['clientes'] = $this->getVentasByFecha($fecha);
        $arrayobject = [];
        foreach ($data['clientes'] as $key => $value) {
            $id = $value['id'];    		
    		$totalVenta = $this->getImporteVentaByIdVenta($id);//floatval($this->getImporteVentaByIdVenta($id));
            $abonos = $this->getPagosVentaByIdVenta($id);//floatval($this->getPagosVentaByIdVenta($id));
            $saldo = floatval($totalVenta[0]['importe']) -  floatval($abonos[0]['importe']);
            $arrayClientes = array(
                                        'cliente' => $value['nombre'],
                                        'importe' =>number_format($totalVenta[0]['importe'],2,".","," ),
                                        'pago' =>number_format($abonos[0]['importe'],2,".","," ),
                                        'saldo' => number_format($saldo,2,".","," ),
    									'fecha'=> $value['fecha'],    									
                                    );
            array_push($arrayobject,$arrayClientes);
            
        }
        return $arrayobject;
    }

    function getVentasByFecha($dato){
        //$dato = $this->input->post('fecha');
        $fecha = $fecha = $this->formateaFecha($dato);
        $this->load->model('corte_model');
        return $this->corte_model->obtenerVentasPorFecha($fecha);
        //echo json_encode($this->corte_model->obtenerVentasPorFecha($fecha));
    }
    function getImporteVentaByIdVenta($id){
        //$id = $this->input->post('id');
        $this->load->model('corte_model');
        return $this->corte_model->getImporte($id);
        //echo json_encode($this->corte_model->getImporte($id));
    }
    function getPagosVentaByIdVenta($id){
        //$id = $this->input->post('id');
        $this->load->model('corte_model');
        return $this->corte_model->getPagos($id);
        //echo json_encode($this->corte_model->getPagos($id));
    }
    /*
    *OBTIENE TOTALES VENDIDO POR TIPO-POLLO Y FECHA
    * vivo
    * alinado
    * procesado
    */
    public function getResumenPollos($tipoPollo,$fecha){
        $this->load->model('corte_model');
        $fech = $this->formateaFecha($fecha);
        return $this->corte_model->getTotalesPollos($tipoPollo,$fech);
    }




}//End class