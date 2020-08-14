<?php

 
class Clientes_m extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_all_clientes(){
        return $this->db->get('clientes')->result_array();
    }



}// END CLASS