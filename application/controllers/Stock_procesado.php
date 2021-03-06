<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Stock_procesado extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Stock_procesado_model');
    } 

    function incrementa(){

        $categoria = $this->input->post('categoria');
        $kilos = $this->input->post('kilos');
        $cantidad = $this->input->post('cantidad');

        $stock = $this->Stock_procesado_model->get_stock_procesado($categoria);

        $id = $stock['id'];
        $stock_kilos = $stock['kilos'];
        $stock_cantidad = $stock['cantidad'];

        $new_kilos = floatval($kilos) + floatval($stock_kilos);
        $new_cantidad = floatval($cantidad) + floatval($stock_cantidad);

        $params = array(
            'kilos' => $new_kilos,
            'cantidad' => $new_cantidad,
        );

        $this->Stock_procesado_model->update_stock_procesado($id,$params);  

        $stock = $this->Stock_procesado_model->get_stock_procesado($categoria);
        $msg['success'] = true;
        $msg['pollo'] = $stock;
        echo json_encode($msg);
    }

    function decrementa(){

        $categoria = $this->input->post('categoria');
        /*
        * Categoria solo recibe:
        *   r3,r4,r5 (string)
        */
        $kilos = $this->input->post('kilos');
        $cantidad = $this->input->post('cantidad');

        $stock = $this->Stock_procesado_model->get_stock_procesado($categoria);

        $id = $stock['id'];
        $stock_kilos = $stock['kilos'];
        $stock_cantidad = $stock['cantidad'];

        $new_kilos = floatval($stock_kilos) - floatval($kilos);
        $new_cantidad = floatval($stock_cantidad) - floatval($cantidad);

        $params = array(
            'kilos' => $new_kilos,
            'cantidad' => $new_cantidad,
        );

        $this->Stock_procesado_model->update_stock_procesado($id,$params);  

        $stock = $this->Stock_procesado_model->get_stock_procesado($categoria);
        $msg['success'] = true;
        $msg['pollo'] = $stock;
        echo json_encode($msg);
    }

    /*
     * Listing of stock_procesado
     */
    function index()
    {
        $data['stock_procesado'] = $this->Stock_procesado_model->get_all_stock_procesado();
        
        $data['_view'] = 'stock_procesado/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new stock_procesado
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'categoria' => $this->input->post('categoria'),
				'kilos' => $this->input->post('kilos'),
				'lote' => $this->input->post('lote'),
				'cantidad' => $this->input->post('cantidad'),
            );
            
            $stock_procesado_id = $this->Stock_procesado_model->add_stock_procesado($params);
            redirect('stock_procesado/index');
        }
        else
        {            
            $data['_view'] = 'stock_procesado/add';
            $this->load->view('layouts/main',$data);
        }
    }  

     

    /*
     * Editing a stock_procesado
     */
    function edit($id)
    {   
        // check if the stock_procesado exists before trying to edit it
        $data['stock_procesado'] = $this->Stock_procesado_model->get_stock_procesado($id);
        
        if(isset($data['stock_procesado']['id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'categoria' => $this->input->post('categoria'),
					'kilos' => $this->input->post('kilos'),
					'lote' => $this->input->post('lote'),
					'cantidad' => $this->input->post('cantidad'),
                );

                $this->Stock_procesado_model->update_stock_procesado($id,$params);            
                redirect('stock_procesado/index');
            }
            else
            {
                $data['_view'] = 'stock_procesado/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The stock_procesado you are trying to edit does not exist.');
    } 

    /*
     * Deleting stock_procesado
     */
    function remove($id)
    {
        $stock_procesado = $this->Stock_procesado_model->get_stock_procesado($id);

        // check if the stock_procesado exists before trying to delete it
        if(isset($stock_procesado['id']))
        {
            $this->Stock_procesado_model->delete_stock_procesado($id);
            redirect('stock_procesado/index');
        }
        else
            show_error('The stock_procesado you are trying to delete does not exist.');
    }

    function getDataProcesado(){
        $codigo = $this->input->post('codigo');
        $stock = $this->Stock_procesado_model->get_stock_procesado_por_codigo($codigo);
        if ($stock) {
            $msg['success'] = true;
            $msg['stock'] = $stock;
        }else{
            $msg['success'] = false;
        }
        echo json_encode($msg);
    }

    function cuentaDisponible(){
        $codigo = $this->input->post('codigo');
        $stock = $this->Stock_procesado_model->get_stock_procesado_por_codigo($codigo);
        if ($stock) {
            $msg['success'] = true;
            $msg['stock'] = $stock;
        }else{
            $msg['success'] = false;
        }
        echo json_encode($msg);
    }
    
}
