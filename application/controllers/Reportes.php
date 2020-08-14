<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller{

    public function __construct()
    {
        parent :: __construct();
        $this->load->model('reportes_model');

    }

    public function index(){
        $resumen_cantidad =0;
        $resumen_kilos=0;
        $resumen_importe=0;

    	if ($this->session->userdata('logged_in')) {

            //hay fecha inputDate
            if ($this->input->get('fecha')) {
                
                $fechaReporte = $this->input->get('fecha');

                $this->load->model('Entrada_efectivo_caja_model');    
                $data['caja_entrada'] = $this->Entrada_efectivo_caja_model->getCaja($fechaReporte);

                $data['fecha'] = $fechaReporte;
                //Suma gastos del dia
                $data['gastos'] = $this->getGastos($fechaReporte);
                $data['ventas'] = $this->reportes_model->getReporte($fechaReporte);
                $data['resumen_vivo'] = $this->getResumenPollos('vivo',$fechaReporte);
                $data['resumen_alinado'] = $this->getResumenPollos('alinado',$fechaReporte);
                $data['resumen_procesado'] = $this->getResumenPollos('procesado',$fechaReporte);
                $data['resumen_desplumado'] = $this->getResumenPollosDesplumado($fechaReporte);

                //Tabla RESUMEN - Cantidad
                $resumen_cantidad = $data['resumen_vivo'][0]['cantidad'] + $data['resumen_alinado'][0]['cantidad'] + $data['resumen_procesado'][0]['cantidad'] + $data['resumen_desplumado'][0]['cantidad'];
                $data['totalCantidad'] = $resumen_cantidad;
                //Tabla RESUMEN - Kilos
                $resumen_kilos = $data['resumen_vivo'][0]['kilos'] + $data['resumen_alinado'][0]['kilos'] + $data['resumen_procesado'][0]['kilos'] + $data['resumen_desplumado'][0]['kilos'];
                $data['totalKilos'] = $resumen_kilos;
                //Tabla RESUMEN - Importe
                $resumen_total = $data['resumen_vivo'][0]['total'] + $data['resumen_alinado'][0]['total'] + $data['resumen_procesado'][0]['total'] + $data['resumen_desplumado'][0]['total'];
                $data['totalImporte'] = $resumen_total;

                //Tabla Entradas Dinero / Ventas
                $data['ventasEfectivo'] = $this->getEntradaDineroVentas($fechaReporte);
                //Tabla Entradas Dinero / Ventas
                $data['ventasAbonos'] = $this->getEntradaDineroAbonos($fechaReporte,'efectivo');
                //Tabla Entradas Dinero / Ventas Transferencia
                $data['ventasAbonosTransferencia'] = $this->getEntradaDineroAbonos($fechaReporte,'transferencia');
                //Tabla Entradas Dinero / Cheque
                $data['ventasAbonosCheque'] = $this->getEntradaDineroAbonos($fechaReporte,'cheque');

                

                $this->load->view('header_view');
                $this->load->view('reportes/menu_top',$data);
                $this->load->view('menu_left_view');
                $this->load->view('reportes/index',$data);
                $this->load->view('reportes/footer_view');
                
            }//Si no hay fecha se genera con fecha de Hoy automatico
            else{
                date_default_timezone_set('America/Mexico_City');
                $fechaReporte = date('d-m-Y');

                $this->load->model('Entrada_efectivo_caja_model');    
                $data['caja_entrada'] = $this->Entrada_efectivo_caja_model->getCaja($fechaReporte);

                $data['fecha'] = $fechaReporte;
                $data['gastos'] = $this->getGastos($fechaReporte);
                $data['ventas'] = $this->reportes_model->getReporte($fechaReporte);
                $data['resumen_vivo'] = $this->getResumenPollos('vivo',$fechaReporte);
                $data['resumen_alinado'] = $this->getResumenPollos('alinado',$fechaReporte);
                $data['resumen_procesado'] = $this->getResumenPollos('procesado',$fechaReporte);
                $data['resumen_desplumado'] = $this->getResumenPollosDesplumado($fechaReporte);

                //Tabla RESUMEN - Cantidad
                $resumen_cantidad = $data['resumen_vivo'][0]['cantidad'] + $data['resumen_alinado'][0]['cantidad'] + $data['resumen_procesado'][0]['cantidad'] + $data['resumen_desplumado'][0]['cantidad'];
                $data['totalCantidad'] = $resumen_cantidad;
                //Tabla RESUMEN - Kilos
                $resumen_kilos = $data['resumen_vivo'][0]['kilos'] + $data['resumen_alinado'][0]['kilos'] + $data['resumen_procesado'][0]['kilos'] + $data['resumen_desplumado'][0]['kilos'];
                $data['totalKilos'] = $resumen_kilos;
                //Tabla RESUMEN - Importe
                $resumen_total = $data['resumen_vivo'][0]['total'] + $data['resumen_alinado'][0]['total'] + $data['resumen_procesado'][0]['total'] + $data['resumen_desplumado'][0]['total'];
                $data['totalImporte'] = $resumen_total;

                

                //Tabla Entradas Dinero / Ventas
                $data['ventasEfectivo'] = $this->getEntradaDineroVentas($fechaReporte);
                //Tabla Entradas Dinero / Ventas
                $data['ventasAbonos'] = $this->getEntradaDineroAbonos($fechaReporte,'efectivo');
                //Tabla Entradas Dinero / Ventas Transferencia
                $data['ventasAbonosTransferencia'] = $this->getEntradaDineroAbonos($fechaReporte,'transferencia');
                //Tabla Entradas Dinero / Cheque
                $data['ventasAbonosCheque'] = $this->getEntradaDineroAbonos($fechaReporte,'cheque');

                $this->load->view('header_view');
                $this->load->view('reportes/menu_top',$data);
                $this->load->view('menu_left_view');
                $this->load->view('reportes/index',$data);
                $this->load->view('reportes/footer_view');
                
            }

            
        }else{
            $this->load->view('auth/login');
        }
        
    }

    public function getVentas(){
        $data['ventas'] = $this->reportes_model->getReporte('02-10-2019');
        echo json_encode($data);
    }

    /*
    *Obtiene para
    * vivo
    * alinado
    * procesado
    */
    public function getResumenPollos($tipoPollo,$fecha){
        return $this->reportes_model->getTotalesPollos($tipoPollo,$fecha);
        //echo json_encode($data);
    }
    /*
    *Obtiene para
    * Desplumado
    */
    public function getResumenPollosDesplumado($fecha){
        return $this->reportes_model->getResumenPollosDesplumado('Desplumado',$fecha);
        //echo json_encode($data);
    }

    public function getEntradaDineroVentas($fecha){
        return $this->reportes_model->getPagos($fecha);
    }

    public function getEntradaDineroAbonos($fecha,$tipo){
        return $this->reportes_model->getAbonos($fecha,$tipo);
    }

    public function getGastos($fecha){
        return $this->reportes_model->getGastos($fecha);
        
    }

    public function get_start_fecha(){
        $this->load->model('Entrada_efectivo_caja_model');
        $data['entrada_efectivo_caja'] = $this->Entrada_efectivo_caja_model->get_inicio_entrada_efectivo_caja();
        $inicio = substr($data['entrada_efectivo_caja'][0]['fecha'], 0, 10);
        echo json_encode($inicio);
    }
}