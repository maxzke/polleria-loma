<?php

class Editar_ventas_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }    

    function getVentas($fecha){
        $this->db->like('fecha', $fecha);
        $query = $this->db->get('ventas');
        return $query->result_array();
    }

    function getdetalles($id){
        $sql="SELECT ventas.id as idventa,ventas.status,ventas.pago,ventas_detalles.id as iddetalle,ventas_detalles.pollo,ventas_detalles.cantidad,ventas_detalles.kg,ventas_detalles.precio_kg
            FROM ventas
            JOIN ventas_detalles
            ON ventas.id = ventas_detalles.id_venta
            WHERE ventas.id =".$id;
            
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function getReporte($fecha){
    	$sql="SELECT ventas.id,ventas.cliente, ventas_detalles.pollo,ventas_detalles.cantidad,ventas_detalles.kg,ventas_detalles.precio_kg ,ventas.fecha,ventas.usuario,ventas.pago
			FROM ventas
			JOIN ventas_detalles
			ON ventas.id = ventas_detalles.id_venta
			WHERE ventas.fecha LIKE '%".$fecha."%' ORDER by ventas_detalles.pollo";

    	
            
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function getTotalesPollos($pollo,$fecha){

		$sql="SELECT SUM(ventas_detalles.cantidad) cantidad,
				SUM(ventas_detalles.kg) kilos,
				SUM(ventas_detalles.precio_kg*ventas_detalles.kg) total
			FROM ventas
			JOIN ventas_detalles
			ON ventas.id = ventas_detalles.id_venta
			WHERE ventas_detalles.pollo LIKE '%".$pollo."%'
			AND ventas.fecha LIKE '%".$fecha."%'";

    	
            
        $query = $this->db->query($sql);
        return $query->result_array();
       // return $sql;
    }

    function getResumenPollosDesplumado($pollo,$fecha){

		$sql="SELECT SUM(ventas_detalles.cantidad) cantidad,
				SUM(ventas_detalles.kg) kilos,
				SUM(ventas_detalles.precio_kg*ventas_detalles.cantidad) total
			FROM ventas
			JOIN ventas_detalles
			ON ventas.id = ventas_detalles.id_venta
			WHERE ventas_detalles.pollo LIKE '%".$pollo."%'
			AND ventas.fecha LIKE '%".$fecha."%'";

    	
            
        $query = $this->db->query($sql);
        return $query->result_array();
       // return $sql;
    }

    function getPagos($fecha){

    	$sql="SELECT SUM(ventas.pago) efectivo
			FROM ventas
			WHERE ventas.fecha LIKE '%".$fecha."%'";
    	            
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function getAbonos($fecha){

    	$sql="SELECT SUM(abono) abonos
			FROM ventas_abonos
			WHERE ventas_abonos.fecha LIKE '%".$fecha."%'";
    	            
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function updateVenta($id,$data){
        $this->db->where('id', $id);
        $this->db->update('ventas', $data);
    }

    function updateDetalleVenta($id,$data){
        $this->db->where('id', $id);
        $this->db->update('ventas_detalles', $data);
    }

    function deleteVenta($id){
        $this->db->delete('ventas',array('id' => $id));
    }
    

    





}