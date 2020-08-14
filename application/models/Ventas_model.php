<?php

 
class Ventas_model extends CI_Model{

    public function getDeben($nombreCliente){
		$this->db->where('status','debe');
		$this->db->like('cliente',$nombreCliente);
		return $this->db->get('ventas')->result_array();
	}

	public function getIds($id){
		$this->db->select('id,fecha');
		$this->db->where('id_cliente', $id);
		//$this->db->where('status','debe');
		$this->db->order_by('created_at', 'DESC');
		$this->db->limit(10);
		return $this->db->get('ventas')->result_array();
	}

	public function getDetalles($id){
		$this->db->where('id_venta',$id);
		return $this->db->get('ventas_detalles')->result_array();
	}

	public function getTotalAbonos($id){
		$sql="SELECT IFNULL(SUM(importe),0) abono
			FROM ventas_pagos
			WHERE id_venta =".$id;
            
        $query = $this->db->query($sql);
        return $query->row_array();
	}

	public function getHistorialAbonos($id){
		$this->db->where('id_venta',$id);
		return $this->db->get('ventas_pagos')->result_array();
	}

	public function formasDePago(){
		return $this->db->get('formas_de_pago')->result();
	}

	/*
	*	GUARDAR VENTA CON ABONO LIGADO A VENTA ACTUAL
	*/
	public function insert_datos_venta_actual($params){
		//INICIA LA TRANSACCION
		$this->db->trans_begin();
		//INSERTO EN TABLA:::VENTAS
		$this->db->insert('ventas',array(
			'id_cliente'=> $params['id_cliente'],
			'status'	=> $params['status'],
			'usuario'	=> $params['usuario'],
			'fecha'		=> $params['fecha']
		));
		//RECUPERO EL ID DE LA VENTA INSERTADA
		$id_venta = $this->db->insert_id();

		//INSERTO EN TABLA:::VENTAS_DETALLES
		foreach($params['detalles'] as $item):       
			$this->db->insert('ventas_detalles', array(      
				'id_venta'	=> $id_venta,      
				'codigo' 	=> $item['codigo'],
				'producto' 	=> $item['producto'],
				'cantidad' 	=> $item['cantidad'],
				'kilos' 	=> $item['kilos'],
				'precio' 	=> $item['precio'],
				'importe' 	=> $item['importe']
			));
			$this->decrementarProductoStock($item['producto'],$item['codigo'],$item['kilos'],$item['cantidad']);
		endforeach;

		//INSERTO EN TABLA:::VENTAS_PAGOS
		$this->db->insert('ventas_pagos', array(
				'id_venta'		=> $id_venta,
				'id_forma_pago'	=> $params['id_forma_pago'],
				'importe'		=> $params['pago'],
				'fecha'			=> $params['fecha']
		));
		//VERIFICO STATUS DE LA TRANSACCION
		if ($this->db->trans_status() === FALSE){      
			//Hubo errores en la consulta, entonces se cancela la transacción.   
			$this->db->trans_rollback();  
			$msg['success'] = false;
			return $msg;    
		 }else{      
			//Todas las consultas se hicieron correctamente.  
			$this->db->trans_commit();   
			
			$msg['success'] = true;
			$msg['id'] = $id_venta;
			return $msg;
		 }  
	}

	/*
	*	AGREGA ABONO A VENTA BY ID-VENTA
	*/
	public function addAbono($params){
		$this->db->insert('ventas_pagos',$params);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}
	public function actualizaStatusVenta($id,$status){
		$this->db->where('id', $id);
        $this->db->update('ventas',array('status' => $status));
	}

	/*
	*	OBTIENE INFO PROCESADO BY CODIGO_INTERNO PROCESADO = DISPONIBLE
	*/
	function get_stock_procesado_por_codigo($codigo){
        $this->db->where('status','disponible');
        $this->db->where('codigo_interno',$codigo);
        return $this->db->get('entrada_stock_procesado')->result_array();
	}
	/*
	*	DECREMENTA STOCK PROCESADO Y VIVO
	*	$producto 	= "PROCESADO" Y "VIVO"
	*	$codigo		= generado(25 caracteres)
	*	"VIVO" SOLO OCUPA $CANTIDAD
	*/
	function decrementarProductoStock($producto,$codigo,$kilos,$cantidad){
		switch ($producto) {
			case 'PROCESADO':
				$stock = $this->get_stock_procesado_por_codigo_unico($codigo);
				if ($stock) {
					$stock_kilos = $stock[0]->stock_kilos;
					$stock_cantidad = $stock[0]->stock_cantidad;
					$new_kilos = floatval($stock_kilos) - floatval($kilos);
					$new_cantidad = floatval($stock_cantidad) - floatval($cantidad);
					$params = array(
						'stock_kilos' => $new_kilos,
						'stock_cantidad' => $new_cantidad,
					);
					$this->update_entrada_stock_procesado($codigo,$params);  
					if ($new_cantidad <= 0) {
						$paramStatus = array(
							'status' => 'agotado'
							);
						$this->update_entrada_stock_status($codigo,$paramStatus);  
					}
				}
			break;
			case 'VIVO':   
				$id = 1;
				$stock = $this->get_stock_vivo($id);
				$stock_cantidad = $stock['cantidad'];
				$new_cantidad = floatval($stock_cantidad) - floatval($cantidad);
				$params = array(
					'cantidad' => $new_cantidad,
				);
				$this->update_stock_vivo($id,$params);
			break;
			case 'ALIÑADO':   
				$id = 1;
				$stock = $this->get_stock_vivo($id);
				$stock_cantidad = $stock['cantidad'];
				$new_cantidad = floatval($stock_cantidad) - floatval($cantidad);
				$params = array(
					'cantidad' => $new_cantidad,
				);
				$this->update_stock_vivo($id,$params);
			break;
			default:
				# code...
				break;
		}
	}
	/*
	*	OBTIENE STOCK PROCESADO BY CODIGO_UNICO
	*	USADA PARA DECREMENTAR STOCK
	*/
	function get_stock_procesado_por_codigo_unico($codigo){
        $this->db->select('stock_cantidad,stock_kilos');
        $this->db->where('codigo',$codigo);
        return $this->db->get('entrada_stock_procesado')->result();
	}
	/*     
	* USADA PARA DECREMENTAR STOCK-PROCESADO
    */
    function update_entrada_stock_procesado($codigo,$params){
        $this->db->where('codigo',$codigo);
        return $this->db->update('entrada_stock_procesado',$params);
	}
	/*     
	* USADA PARA DECREMENTAR STOCK-PROCESADO
    */
	function update_entrada_stock_status($codigo,$params){
        $this->db->where('codigo',$codigo);
        return $this->db->update('entrada_stock_procesado',$params);
	}
	/*
	* Get stock_vivo by id
	*  USADA PARA DECREMENTAR VIVO
	*/
    function get_stock_vivo($id){
        return $this->db->get_where('stock_vivo',array('id'=>$id))->row_array();
	}
	/*
	* 	function to update stock_vivo
	*	USADA PARA DECREMENTAR VIVO
	*/
    function update_stock_vivo($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('stock_vivo',$params);
	}
	
	function deleteVenta($id){
        $this->db->delete('ventas',array('id' => $id));
	}
	
	function getDetalleById($id){
		return $this->db->get_where('ventas_detalles',array('codigo'=>$id))->row_array();
	}

	function actualizaVenta($id,$params){
		$this->db->where('codigo',$id);
		return $this->db->update('ventas_detalles',$params);
	}

}//end class