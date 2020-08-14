<?php

 
class Caja extends CI_Controller{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Clientes_model');
    } 

    function index(){
        $this->load->view('layout/caja/header');
        $this->load->view('layout/caja/index');
        $this->load->view('layout/caja/footer');
    }
}