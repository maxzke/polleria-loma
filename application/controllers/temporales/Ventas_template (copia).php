<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require __DIR__ . '../autoload.php';
// use Mike42\Escpos\Printer;
// use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class Ventas_template extends CI_Controller {

    public function index(){
        if (!$this->session->userdata('logged_in')) {
            $this->load->view('auth/login');
        }else{
            $this->load->view('layout/header');
            $this->load->view('layout/menu');
            $this->load->view('layout/ventas');
            $this->load->view('layout/footer');
        }
    }








}//END CLASS