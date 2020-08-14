<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Template extends CI_Controller {
    public function index(){
        $this->load->view('layout/header');
        $this->load->view('layout/menu');
        $this->load->view('layout/ventas');
        $this->load->view('layout/footer');
    }
}