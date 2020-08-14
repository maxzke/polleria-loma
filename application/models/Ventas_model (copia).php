<?php

 
class Ventas_model extends CI_Model{

    //Inserta datos a tabla: ventas-----------------------------------------
	public function insert_ventas($datos){

		$this->db->insert('ventas',$datos);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}

	}

 	//Inserta datos a tabla: ventas-----------------------------------------
	public function insert_ventas_abonos($datos){

		$this->db->insert('ventas_abonos',$datos);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}

	}

	//Inserta datos a tabla: ventas-----------------------------------------
	public function insert_ventas_detalles($datos){

		$this->db->insert('ventas_detalles',$datos);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}

	}

	/*
    *   ABONOS --------------------------------------------------------------------
    */

	public function getDeben($nombreCliente){
		$this->db->where('status','debe');
		$this->db->like('cliente',$nombreCliente);
		return $this->db->get('ventas')->result_array();
	}
	public function getclientsDeben(){
		$this->db->select('cliente');
		$this->db->where('status','debe');
		$this->db->group_by('cliente');
		return $this->db->get('ventas')->result_array();
	}

	public function actualizaStatus($id,$status){
		$this->db->where('id', $id);
        $this->db->update('ventas',array('status' => $status));
	}

	public function getsumaabonos($id){
		$sql="SELECT IFNULL(SUM(abono),0) abono
			FROM ventas_abonos
			WHERE id_venta =".$id;
            
        $query = $this->db->query($sql);
        return $query->row();
	}

	public function getTotalAbonos($id){
		$sql="SELECT IFNULL(SUM(abono),0) abono
			FROM ventas_abonos
			WHERE id_venta =".$id;
            
        $query = $this->db->query($sql);
        return $query->row_array();
	}
	
	public function getDetalles($id){
		$this->db->where('id_venta',$id);
		return $this->db->get('ventas_detalles')->result_array();
	}
	public function getIds($cliente){
		$this->db->select('id,pago');
		$this->db->like('cliente', $cliente);
		$this->db->where('status','debe');
		return $this->db->get('ventas')->result_array();
	}

	//Obtiene el ultimo id de venta guardado en
	//tabla ventas_detalles
	function getLastInsert(){
		$this->db->select('id_venta');
		$this->db->order_by('id_venta','DESC');
		$this->db->limit(1);
		return $this->db->get('ventas_detalles')->result_array();
	}
	/*
	*	Obtiene datos de ultima venta
	*	tabla VENTAS
	*/
	public function getVenta($id){
		$this->db->where('id',$id);
		return $this->db->get('ventas')->result_array();
	}

	/*
	* get Saldos Atrasados
	*/
	public function saldos_atrasados(){
		$sql="SELECT ventas.id,LOWER(ventas.cliente) cliente, ventas_detalles.precio_kg
			FROM ventas
			JOIN ventas_detalles
			ON ventas.id = ventas_detalles.id_venta
			WHERE ventas.fecha LIKE '%".'saldo atrasado'."%' ORDER by ventas_detalles.id";
        $query = $this->db->query($sql);
        return $query->result();
	}
	public function eliminaAtrasado($id){
		$res = $this->db->delete('ventas', array('id' => $id));
		return $res;
	}

}//end class