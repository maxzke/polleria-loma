<?php

 
class Clientes_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    /*
     * Get tbl_cliente by id
     */
    function get_cliente($id)
    {
        return $this->db->get_where('clientes',array('id'=>$id))->row_array();
    }

    function get_all_clientes(){
        return $this->db->get('clientes')->result_array();
    }

     /*
     * Get all clientes count
     */
    function get_all_clientes_count()
    {
        $this->db->from('clientes');
        return $this->db->count_all_results();
    }

    /*
     * function to add new tbl_cliente
     */
    function add_cliente($params)
    {
        $this->db->insert('clientes',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update tbl_cliente
     */
    function update_cliente($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('clientes',$params);
    }
    
    /*
     * function to delete tbl_cliente
     */
    function delete_cliente($id)
    {
        return $this->db->delete('clientes',array('id'=>$id));
    }



}// END CLASS