<?php


class Corte_model extends CI_Model{



    function getPago($tipo,$fecha){
        $this->db->where('id_forma_pago',$tipo);
        $this->db->like('fecha',$fecha);
        return $this->db->get('ventas_pagos')->result_array();
    }
    function obtieneGastos($fecha){
        $this->db->select_sum('importe');
        $this->db->like('fecha',$fecha);
        return $this->db->get('gastos_diarios')->result_array();
    }


    function obtenerVentasPorFecha($fecha){
        // $sql="SELECT ventas.id,LOWER(clientes.nombre) cliente,clientes.id id_cliente,ventas.status,ventas.fecha
		// 	FROM ventas
		// 	JOIN clientes
		// 	ON ventas.id_cliente = clientes.id
		// 	WHERE ventas.fecha LIKE '%".$fecha."%' GROUP BY ventas.id_cliente";
        // $query = $this->db->query($sql);
        // return $query->result_array();
        $this->db->select('ventas.id,ventas.status,ventas.fecha, clientes.nombre');
        $this->db->from('ventas');
        $this->db->join('clientes', 'clientes.id = ventas.id_cliente');
        $this->db->where('fecha',$fecha);
        return $this->db->get()->result_array();
    }

    function getImporte($id){
        $this->db->select_sum('importe');
        $this->db->where('id_venta',$id);
        return $this->db->get('ventas_detalles')->result_array();
    }
    function getPagos($id){
        $this->db->select_sum('importe');
        $this->db->where('id_venta',$id);
        return $this->db->get('ventas_pagos')->result_array();
    }

    function sumaEntradas($tipoEntrada,$fecha){
        $this->db->select_sum('importe');
        $this->db->where('id_forma_pago',$tipoEntrada);
        $this->db->where('fecha',$fecha);
        return $this->db->get('ventas_pagos')->result_array();
    }

    function getTotalesPollos($pollo,$fecha){
        $this->db->select_sum('ventas_detalles.cantidad');
        $this->db->select_sum('ventas_detalles.kilos');
        $this->db->select_sum('ventas_detalles.importe');
        $this->db->from('ventas');
        $this->db->join('ventas_detalles', 'ventas.id = ventas_detalles.id_venta');
        $this->db->where('ventas_detalles.producto',$pollo);
        $this->db->where('ventas.fecha',$fecha);
        return $this->db->get()->result_array();

		// $sql="SELECT SUM(ventas_detalles.cantidad) cantidad,
		// 		SUM(ventas_detalles.kilos) kilos,
		// 		SUM(ventas_detalles.importe) total
		// 	FROM ventas
		// 	JOIN ventas_detalles
		// 	ON ventas.id = ventas_detalles.id_venta
		// 	WHERE ventas_detalles.pollo = '".$pollo."'
		// 	AND ventas.fecha ='".$fecha."';
            
        // $query = $this->db->query($sql);
        // return $query->result_array();
    }
    

}