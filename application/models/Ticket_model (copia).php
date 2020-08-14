<?php
 
class Ticket_model extends CI_Model{

    /*
    *   Datos venta
    */
    function datosVenta($id){
        $this->db->select('cliente,pago,status,fecha');
        $this->db->where('id',$id);
        return  $this->db->get('ventas')->result();         
    }
    /*
    *   Historial de abonos > 0
    */
    function abonos($id){
        $sql = "SELECT abono,fecha FROM ventas_abonos WHERE id_venta =".$id." AND abono>0";
        return $this->db->query($sql)->result();
    }
    /*
    *   Suma Abonos
    */
    function sumaAbonos($id){
        $sql = "SELECT SUM(abono) total FROM ventas_abonos WHERE id_venta =".$id;
        return $this->db->query($sql)->result();
    }
    /*
    *   Detalles Venta
    */
    function detalles($id){
        $sql = "SELECT pollo,cantidad,kg,precio_kg FROM ventas_detalles WHERE id_venta =".$id;
        return $this->db->query($sql)->result();
    }
    





}//end class