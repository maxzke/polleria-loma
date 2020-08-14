<?php

class Reportes_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }    

    function getGastos($fecha){
        $sql = "SELECT SUM(importe) gastos
                FROM gastos_diarios
                WHERE fecha LIKE '%".$fecha."%'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function getReporte($fecha){
    	$sql="SELECT ventas.id,LOWER(ventas.cliente) cliente, LOWER(ventas_detalles.pollo) pollo,ventas_detalles.cantidad,ventas_detalles.kg,ventas_detalles.precio_kg ,ventas.fecha,ventas.usuario,ventas.pago
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

    function getAbonos($fecha,$tipo){

    	$sql="SELECT SUM(abono) abonos
			FROM ventas_abonos
			WHERE tipo = '".$tipo."'
            AND ventas_abonos.fecha LIKE '%".$fecha."%'";
    	            
        $query = $this->db->query($sql);
        return $query->result_array();
    }

/*
SELECT ventas.id,ventas.cliente, ventas_detalles.pollo,ventas_detalles.cantidad,ventas_detalles.kg,ventas_detalles.precio_kg FROM ventas,ventas_detalles WHERE ventas.fecha LIKE '%26-09-2019%' ORDER by ventas_detalles.pollo
*/





}