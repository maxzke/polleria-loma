<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario extends CI_Controller{

    public function __construct()
    {
        parent :: __construct();
        $this->load->model('Stock_vivo_model');
        $this->load->model('Stock_procesado_model');
        $this->load->model('inventario_model');

    }

    /* 
    *   Procesado Descompuesto
    *   Funcion decrementa Stock Procesado Por CodigoBarras
    */    
    

    /* 
    *   Funcion decrementa Stock Procesado por Descompuesto
    */    
    function decrementa(){

        $categoria = $this->input->post('categoria');
        $lote = $this->input->post('lote');
        $kilos = $this->input->post('kilos');
        $cantidad = $this->input->post('cantidad');

        $response = $this->inventario_model->get_id($categoria,$lote);
        $id = floatval($response['id']); 

        $this->load->model('Entrada_stock_procesado_model');                    

        $stock = $this->Entrada_stock_procesado_model->get_entrada_stock_procesado($id);
        $stock_kilos = $stock['stock_kilos'];
        $stock_cantidad = $stock['stock_cantidad'];

        $new_kilos = floatval($stock_kilos) - floatval($kilos);
        $new_cantidad = floatval($stock_cantidad) - floatval($cantidad);

        $params = array(
            'stock_kilos' => $new_kilos,
            'stock_cantidad' => $new_cantidad,
        );

        $this->Entrada_stock_procesado_model->update_entrada_stock_procesado($id,$params);  

        if ($new_cantidad <= 0) {
            $paramStatus = array(
                'status' => 'agotado'
                );
            $this->Entrada_stock_procesado_model->update_entrada_stock_status($id,$paramStatus);  
        }
        if ($id) {
            $msg['success'] = true;
        }else{
            $msg['success'] = false;
        }
        
        echo json_encode($msg);
       
    }

    /*
    *   Agrega ahogado_descompuesto
    *   tabla: stock_ahogado_descompuesto
    */
    function add_ahogado_descompuesto(){
        /*
        *   Guarda Registro descompuesto
        */
        $code = $this->input->post('codigo');
        $cantidad = $this->input->post('cantidad');
        $kilos = $this->input->post('kilos');

        $params = array(
            'codigo'=> $code,
            'cantidad' => $cantidad,
            'kilos' => $kilos,
            'usuario' => $_SESSION['name']
        );
        $this->inventario_model->add_descompuesto($params);
        /*
        *    Decrementa Procesado
        */
        $this->decrementaDescompuesto($cantidad,$kilos,$code);
        $msg['success'] = true;
        echo json_encode($msg);

    } 
    /* 
    *   Funcion decrementa Stock Procesado Por CodigoBarras
    */    
    function decrementaDescompuesto($cantidad,$kilos,$codigo){

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
    * Registra Pollo Ahogado
    */
    function registraAhogado(){
        $this->load->model('Inventario_model');
        $cantidad = $this->input->post('inputCantidadAhogado');
        $this->Inventario_model->trasnsaccionRegistraAhogado($cantidad);
        redirect(base_url('inventario'));
        
    }

    function addDecompuestoView(){
        if ($this->session->userdata('logged_in')) {

            $this->load->view('header_view');
            $this->load->view('inventario/menu_top');
            $this->load->view('menu_left_view');
            $this->load->view('inventario/descompuesto');
            $this->load->view('inventario/footer_view_descompuesto');
        }else{
            $this->load->view('auth/login');
        }
    }

    public function index(){

    	if ($this->session->userdata('logged_in')) {

            $data['vivo'] = $this->Stock_vivo_model->get_all_stock_vivo();
            $data['procesado'] = $this->Stock_procesado_model->get_all_stock_procesado();
            //Lotes
            $data['loteR3'] = $this->getStockLotes('r3');
            $data['loteR4'] = $this->getStockLotes('r4');
            $data['loteR5'] = $this->getStockLotes('r5');
            $data['stock_r3']  = $this->getStockProcesado('r3');
            $data['stock_r4']  = $this->getStockProcesado('r4');
            $data['stock_r5']  = $this->getStockProcesado('r5');

    		$this->load->view('header_view');
            $this->load->view('inventario/menu_top');
            $this->load->view('menu_left_view');
            $this->load->view('inventario/index',$data);
            $this->load->view('inventario/footer_view');

    	}else{
    		$this->load->view('auth/login');
    	}
    }

    public function getStockLotes($categoria){        
        $this->load->model('Entrada_stock_procesado_model');
        return $this->Entrada_stock_procesado_model->getLotes($categoria);
    }

    public function get_por_lote_y_categoria(){
        $lote = $this->input->post('lote');
        $categoria = $this->input->post('categoria');
        $this->load->model('Entrada_stock_procesado_model');
        $data['pollo'] = $this->Entrada_stock_procesado_model->get_por_lote_y_categoria($lote,$categoria);
        echo json_encode($data);

    }

    public function getVivo(){
        $data['vivo'] = $this->Stock_vivo_model->get_all_stock_vivo();
        echo json_encode($data);
    }

    public function getProcesado(){
        $data['procesado'] = $this->Stock_procesado_model->get_all_stock_procesado();
        echo json_encode($data);
    }

    public function getStockProcesado($categoria){        
        return $this->Stock_procesado_model->get_stock_procesado_by_category($categoria);
    }

    public function eliminaRegistroProcesado()
    {
        $id = $this->input->post('id');
        $this->load->model('Inventario_model');        
        $response = $this->Inventario_model->eliminaRegistro($id);
        $msg['success'] = true;      
        echo json_encode($msg);

    }






}