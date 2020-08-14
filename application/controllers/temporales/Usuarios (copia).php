<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller{

    public function __construct()
    {
        parent :: __construct();
        $this->load->model('myauth_model');
        $this->load->model('usuarios_model');

    }

    public function index(){
    	if ($this->session->userdata('logged_in')) {
            $data['usuarios'] = $this->usuarios_model->get_all_users();
	        $this->load->view('header_view');
	        $this->load->view('menu_top_usuarios');
	        $this->load->view('menu_left_view');
	        $this->load->view('usuarios/index',$data);
	        $this->load->view('footer_view');
        }else{
            $this->load->view('auth/login');
        }
        
    }

    public function register()
    {
        if ($this->session->userdata('logged_in')) {
            //die('already logged in');
            $this->load->view('header_view');
            $this->load->view('menu_top_usuarios');
            $this->load->view('menu_left_view');
            $this->load->view('usuarios/register');
            $this->load->view('footer_view');
        }else{
            $this->load->view('auth/login');
        }
        
    }

    public function edit($id){
    	if ($this->session->userdata('logged_in')) {
            $data['usuario'] = $this->usuarios_model->get_user($id);
            //print_r($data['usuario']);
            //die();
	        $this->load->view('header_view');
	        $this->load->view('menu_top_usuarios');
	        $this->load->view('menu_left_view');
	        $this->load->view('usuarios/edit',$data);
	        $this->load->view('footer_view');
        }else{
            $this->load->view('auth/login');
        }
    }

    public function update(){

    	$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm', 'Confirm Password', 'required|matches[password]');
        $id = $this->input->post('id');
            if ($this->form_validation->run()) {
                
                $passw = $this->input->post('password');

                $this->usuarios_model->update($id,$passw);
                return redirect('usuarios/index');
            }else{
                $ruta = "usuarios/edit/".$id;
            	return redirect($ruta);
            }
    	
    }

    public function eliminar($id){
    	$this->usuarios_model->elimina($id);
    	return $this->index();
    }













}