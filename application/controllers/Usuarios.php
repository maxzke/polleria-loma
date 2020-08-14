<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller{

    public function __construct()
    {
        parent :: __construct();
        $this->load->model('myauth_model');
        $this->load->model('usuarios_model');

        $this->load->model('Entrada_efectivo_caja_model');
            date_default_timezone_set('America/Mexico_City');
            $now = date('d-m-Y');
            $data['entrada'] = $this->Entrada_efectivo_caja_model->getCaja($now);
            //Si aun no se registro la caja inicial del dia
            if (!$data['entrada']) {
                redirect('caja');
            }

    }

    public function index(){
    	if ($this->session->userdata('logged_in')) {
            $data['usuarios'] = $this->usuarios_model->get_all_users();
            
            $data['page']="usuarios";
            $this->load->view('layout/header',$data);
            $this->load->view('layout/usuarios/index',$data);
            $this->load->view('layout/usuarios/footer');

        }else{
            $this->load->view('auth/login');
        }
        
    }

    public function nuevo()
    {
        if ($this->session->userdata('logged_in')) {
            $data['page']="usuarios";
            $this->load->view('layout/header',$data);
            $this->load->view('layout/usuarios/add');
            $this->load->view('layout/usuarios/footer');

        }else{
            $this->load->view('auth/login');
        }
        
    }

    public function add()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required|is_unique[users.name]');
        //$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            return $this->vistas();
        }

        $name = $this->input->post('name');
        //$email = $this->input->post('email');
        $pass = $this->input->post('password');

        if($this->myauth_model->register($name , 'correo' , $pass)){
            $this->session->set_flashdata('message' , 'Registeration successful');
            return redirect('usuarios/index');
        }
        $this->session->set_flashdata('message' , 'Something went wrong');
        return $this->vistas();
    }

    public function vistas(){
        $data['page']="usuarios";
            $this->load->view('layout/header',$data);
        $this->load->view('layout/usuarios/add');
        $this->load->view('layout/usuarios/footer');
    }

    public function edit($id){
    	if ($this->session->userdata('logged_in')) {
            $data['usuario'] = $this->usuarios_model->get_user($id);
            $data['page']="usuarios";
            $this->load->view('layout/header',$data);
            $this->load->view('layout/usuarios/edit',$data);
            $this->load->view('layout/usuarios/footer');
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

    public function remove($id){
    	$this->usuarios_model->elimina($id);
    	return $this->index();
    }













}