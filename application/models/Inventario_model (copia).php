<?php

class Inventario_model extends CI_Model{

    function __construct(){
        parent::__construct();

    }   

    function add_descompuesto($params){
    	$this->db->insert('pollo_descompuesto',$params);
    }

    function get_id($categoria,$lote){
    	//$this->db->select('id');
    	//$this->db->get_where('lote',$lote);
    	//return $this->db->get('entrada_stock_procesado')->result_array();
    	$this->db->where('categoria',$categoria);
    	return $this->db->get_where('entrada_stock_procesado',array('lote'=>$lote))->row_array();
    }
    function eliminaRegistro($id){
        return $this->db->delete('entrada_stock_procesado', array('codigo' => $id));         
    }

    /*
    * Registra Pollo Ahogado
    */
    function trasnsaccionRegistraAhogado($kant){
        /*
        *   Guardo Registro 
        */
        $cant = intval($kant);
        $registro = array(
            'cantidad'=>$cant,
            'usuario' =>$_SESSION['name']
        );
        $this->db->insert('pollo_ahogado',$registro);
        /*
        *   Obtengo Stock VIVO
        */
        $this->db->select('cantidad');
        $stock = $this->db->get('stock_vivo')->row();
        print_r($stock);
        if($stock){
            $stockActual = intval($stock->cantidad) - intval($cant);
            $data = array(
                'id' => 1,
                'cantidad' =>$stockActual
             );
             $this->db->replace('stock_vivo', $data);
        }

    }




}