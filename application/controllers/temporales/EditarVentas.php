<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class EditarVentas extends CI_Controller{

    public function __construct()
    {
        parent :: __construct();
        $this->load->model('editar_ventas_model');

    }

    public function getAllVentas($fecha){    	
    	return $this->editar_ventas_model->getVentas($fecha);
    }

    public function eliminaVenta(){
        $id = $this->input->post('id');
        $this->load->model('Editar_ventas_model');
        $this->Editar_ventas_model->deleteVenta($id);
        $msg['success'] = true;
        echo json_encode($msg);
    }

    public function index(){
    	if ($this->session->userdata('logged_in')) {

            //hay fecha inputDate
            if ($this->input->get('fecha')) {
                
                $fechaReporte = $this->input->get('fecha');
                $data['fecha'] = $fechaReporte;
                $data['ventas'] = $this->getAllVentas($fechaReporte);
                $this->load->view('header_view');
                $this->load->view('editar_ventas/menu_top',$data);
                $this->load->view('menu_left_view');
                $this->load->view('editar_ventas/index',$data);
                $this->load->view('editar_ventas/footer_view');
                
            }//Si no hay fecha se genera con fecha de Hoy automatico
            else{
                date_default_timezone_set('America/Mexico_City');
                $fechaReporte = date('d-m-Y');
                $data['fecha'] = $fechaReporte;
                $data['ventas'] = $this->getAllVentas($fechaReporte);                

                $this->load->view('header_view');
                $this->load->view('editar_ventas/menu_top',$data);
                $this->load->view('menu_left_view');
                $this->load->view('editar_ventas/index',$data);
                $this->load->view('editar_ventas/footer_view');
                
            }

            
        }else{
            $this->load->view('auth/login');
        }
    }

    public function detalles(){
    	$id = $this->input->post('id_venta');
        $data['detalles'] = $this->editar_ventas_model->getdetalles($id); 
        echo json_encode($data);
    }

    public function getVentas(){
        $data['ventas'] = $this->editar_ventas_model->getReporte('02-10-2019');
        echo json_encode($data);
    }

    /*
    *Obtiene para
    * vivo
    * alinado
    * procesado
    */
    public function getResumenPollos($tipoPollo,$fecha){
        return $this->editar_ventas_model->getTotalesPollos($tipoPollo,$fecha);
        //echo json_encode($data);
    }
    /*
    *Obtiene para
    * Desplumado
    */
    public function getResumenPollosDesplumado($fecha){
        return $this->editar_ventas_model->getResumenPollosDesplumado('Desplumado',$fecha);
        //echo json_encode($data);
    }

    public function getEntradaDineroVentas($fecha){
        return $this->editar_ventas_model->getPagos($fecha);
    }

    public function getEntradaDineroAbonos($fecha){
        return $this->editar_ventas_model->getAbonos($fecha);
    }

    function updateVenta(){
        /*  
        *   tbl ventas
        *   id
        */
        $venta = $this->input->post('venta');  
        $id = $venta['id'];
        /*
        *   tbl ventas_detalles
        *   [{ id : kg }]
        */
        $detalles = $this->input->post('detalles');
        /*
        *   -Efectivo
        *   Importe
        *   total pagos
        */
        $efectivo = $this->input->post('efectivo');
        $status = $efectivo['status'];
        $importe = 0;
        $total_pago = 0;
        

        //Array respuesta
        $data = array(
                        'venta' =>$venta , 
                        'detalle' => $detalles, 
                        'efectivo' => $efectivo 
                    );
        
        //$efectivo['status'] == pagado   
        if ($status == 'pagado') {
            $total_pago = $efectivo['importe'];
        }else{
            $total_pago = $efectivo['pagado'];
        }

        $dataVenta = array(
                            'pago' => $total_pago,
                            'status' => $status
                             );  

        //Actualizo Tabla ventas
        $this->editar_ventas_model->updateVenta($id,$dataVenta); 

        //Actualizo tabla ventas_detalles
        foreach ($detalles as $key) {
            $id = $key['id'];
            $kilos = $key['kilos'];
            $dataDetalles = array(
                                    'kg' =>$kilos
                            );
            $this->editar_ventas_model->updateDetalleVenta($id,$dataDetalles);
        }          

        echo json_encode($data);
    }



}//End class