<?php
 
class Usuarios_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    /*
     * Get all Usuarios
     */
    function get_all_users()
    {
        $this->db->order_by('id', 'desc');
        
        return $this->db->get('users')->result_array();
    }

    /*
     * Get Usuario by id
     */
    function get_user($id)
    {
        return $this->db->get_where('users',array('id'=>$id))->row_array();
    }

    function update($id,$passw){
    	$this->db->set('password', $this->phash($passw));
		$this->db->where('id', $id);
		$this->db->update('users');
    }

    private function phash($pass)
    {
        return password_hash($pass , PASSWORD_DEFAULT);
    }

    function elimina($id){
    	$this->db->delete('users', array('id' => $id));
    }







}