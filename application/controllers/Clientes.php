<?php

 
class Clientes extends CI_Controller{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Clientes_model');
        $this->load->model('Entrada_efectivo_caja_model');
            date_default_timezone_set('America/Mexico_City');
            $now = date('d-m-Y');
            $data['entrada'] = $this->Entrada_efectivo_caja_model->getCaja($now);
            //Si ya se registro la caja inicial del dia
            if (!$data['entrada']) {
                redirect('caja');
            //si aun no se registra 
            }
    } 

    function index(){
        if ($this->session->userdata('logged_in')) {
            $params['limit'] = 2; 
            $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            
            $config = $this->config->item('pagination');
            $config['base_url'] = site_url('tbl_cliente/index?');
            $config['total_rows'] = $this->Clientes_model->get_all_clientes_count();
            $this->pagination->initialize($config);

            $data['tbl_clientes'] = $this->Clientes_model->get_all_clientes();

            $data['page']="clientes";
            $this->load->view('layout/header',$data);
            $this->load->view('layout/clientes/index',$data);
            $this->load->view('layout/clientes/footer');


            }else{
            $this->load->view('auth/login');
        }
            
        
    }

    function nuevo(){
        if ($this->session->userdata('logged_in')) {
            $data['page']="clientes";
            $this->load->view('layout/header',$data);
            $this->load->view('layout/clientes/add');
            $this->load->view('layout/clientes/footer');
            }else{
            $this->load->view('auth/login');
        }
    }

    /*
     * obtengo todos los clientes
     */
    public function getAll(){
        $data['clientes'] = $this->Clientes_model->get_all_clientes();
        if ($data['clientes']) {
            $data['success'] = true;
        }else{
            $data['success'] = false;
        }
        echo json_encode($data);
    }

    /*
     * Adding a new tbl_cliente
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('precio_vivo','Precio Vivo','required|numeric');
		$this->form_validation->set_rules('nombre','Nombre','required|is_unique[clientes.nombre]');
		$this->form_validation->set_rules('precio_alinado','Precio Aliñado','required|numeric');
		$this->form_validation->set_rules('precio_procesado','Precio Procesado','required|numeric');
		$this->form_validation->set_rules('telefono','Telefono','exact_length[10]');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'nombre' => strtolower($this->input->post('nombre')),
				'precio_vivo' => $this->input->post('precio_vivo'),
				'precio_alinado' => $this->input->post('precio_alinado'),
				'precio_procesado' => $this->input->post('precio_procesado'),
				'telefono' => $this->input->post('telefono'),
            );
            
            $tbl_cliente_id = $this->Clientes_model->add_cliente($params);
            redirect('clientes/index');
        }
        else
        {       
            $data['page']="clientes";
            $this->load->view('layout/header',$data);
            $this->load->view('layout/clientes/add');
            $this->load->view('layout/clientes/footer');
        }
    }  

    /*
     * Editing a tbl_cliente
     */
    function edit($id)
    {   
        // check if the tbl_cliente exists before trying to edit it
        $data['tbl_cliente'] = $this->Clientes_model->get_cliente($id);
        
        if(isset($data['tbl_cliente']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('precio_vivo','Precio Vivo','numeric');
			$this->form_validation->set_rules('nombre','Nombre','required');
			$this->form_validation->set_rules('precio_alinado','Precio Alinado','numeric');
			$this->form_validation->set_rules('precio_procesado','Precio Procesado','numeric');
			$this->form_validation->set_rules('telefono','Telefono','exact_length[10]');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'nombre' => strtolower($this->input->post('nombre')),
					'precio_vivo' => $this->input->post('precio_vivo'),
					'precio_alinado' => $this->input->post('precio_alinado'),
					'precio_procesado' => $this->input->post('precio_procesado'),
					'telefono' => $this->input->post('telefono'),
                );

                $this->Clientes_model->update_cliente($id,$params);            
                redirect('clientes/index');
            }
            else
            {
                $data['page']="clientes";
                $this->load->view('layout/header',$data);
                $this->load->view('layout/clientes/edit',$data);
                $this->load->view('layout/clientes/footer');
            }
        }
        else
            show_error('The tbl_cliente you are trying to edit does not exist.');
    } 

    /*
     * Deleting tbl_cliente
     */
    function remove($id)
    {
        $tbl_cliente = $this->Clientes_model->get_cliente($id);

        // check if the tbl_cliente exists before trying to delete it
        if(isset($tbl_cliente['id']))
        {
            $this->Clientes_model->delete_cliente($id);
            redirect('Clientes/index');
        }
        else
            show_error('The tbl_cliente you are trying to delete does not exist.');
    }
    
    
    
}
