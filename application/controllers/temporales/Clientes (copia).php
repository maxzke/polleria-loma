<?php

 
class Clientes extends CI_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Tbl_cliente_model');
    } 

    /*
     * Listing of tbl_clientes
     */
    function index(){
        if ($this->session->userdata('logged_in')) {
            $params['limit'] = 2; 
            $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            
            $config = $this->config->item('pagination');
            $config['base_url'] = site_url('tbl_cliente/index?');
            $config['total_rows'] = $this->Tbl_cliente_model->get_all_tbl_clientes_count();
            $this->pagination->initialize($config);

            $data['tbl_clientes'] = $this->Tbl_cliente_model->get_all_tbl_clientes();
            
            //$data['_view'] = 'tbl_cliente/index';$this->load->view('header_view');
            $this->load->view('header_view');
            $this->load->view('menu_top_clientes');
            $this->load->view('menu_left_view');
            //contenido
            $this->load->view('tbl_cliente/index',$data);
            $this->load->view('footer_view');
            }else{
            $this->load->view('auth/login');
        }
            
        
    }

   

    /*
     * Adding a new tbl_cliente
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('precio_vivo','Precio Vivo','required|numeric');
		$this->form_validation->set_rules('nombre','Nombre','required|is_unique[tbl_clientes.nombre]');
		$this->form_validation->set_rules('precio_alinado','required|Precio Alinado','numeric');
		$this->form_validation->set_rules('precio_procesado','required|Precio Procesado','numeric');
		$this->form_validation->set_rules('telefono','Telefono','exact_length[10]');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'nombre' => $this->input->post('nombre'),
				'precio_vivo' => $this->input->post('precio_vivo'),
				'precio_alinado' => $this->input->post('precio_alinado'),
				'precio_procesado' => $this->input->post('precio_procesado'),
				'telefono' => $this->input->post('telefono'),
            );
            
            $tbl_cliente_id = $this->Tbl_cliente_model->add_tbl_cliente($params);
            redirect('tbl_cliente/index');
        }
        else
        {       
            $this->load->view('header_view');
            $this->load->view('menu_top_clientes');
            $this->load->view('menu_left_view');
            //contenido
            $this->load->view('tbl_cliente/add');
            $this->load->view('footer_view');
        }
    }  

    /*
     * Editing a tbl_cliente
     */
    function edit($id)
    {   
        // check if the tbl_cliente exists before trying to edit it
        $data['tbl_cliente'] = $this->Tbl_cliente_model->get_tbl_cliente($id);
        
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
					'nombre' => $this->input->post('nombre'),
					'precio_vivo' => $this->input->post('precio_vivo'),
					'precio_alinado' => $this->input->post('precio_alinado'),
					'precio_procesado' => $this->input->post('precio_procesado'),
					'telefono' => $this->input->post('telefono'),
                );

                $this->Tbl_cliente_model->update_tbl_cliente($id,$params);            
                redirect('tbl_cliente/index');
            }
            else
            {
                $this->load->view('header_view');
                $this->load->view('menu_top_clientes');
                $this->load->view('menu_left_view');
                //contenido
                $this->load->view('tbl_cliente/edit',$data);
                $this->load->view('footer_view');
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
        $tbl_cliente = $this->Tbl_cliente_model->get_tbl_cliente($id);

        // check if the tbl_cliente exists before trying to delete it
        if(isset($tbl_cliente['id']))
        {
            $this->Tbl_cliente_model->delete_tbl_cliente($id);
            redirect('tbl_cliente/index');
        }
        else
            show_error('The tbl_cliente you are trying to delete does not exist.');
    }
    
}
