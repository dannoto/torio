<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_run extends CI_Controller {
    # Api resposanvel por receber interacoes do redirecionar ofertas.run

	function __construct() {

		parent::__construct();

		$this->load->model('admin_model');


	}

	public function check_link()
	{

        if ($this->input->get('code')) {

        
            if ($this->admin_model->getLinkByCode($this->input->get('code'))) {
                $response = $this->admin_model->getLinkByCode($this->input->get('code'));
            } else {
                $response = false;
            }
           
        }

		print_r(json_encode($response));
	}

    public function check_campanha() {

        if ($this->input->get('id')) {

        
            if ($this->admin_model->get_campanha($this->input->get('id'))) {
                $response = $this->admin_model->get_campanha($this->input->get('id'));
            } else {
                $response = false;
            }
           
        }

		print_r(json_encode($response));
    }

    public function find_lead_telefone() {

        if ($this->input->get('telefone')) {

        
            if ($this->admin_model->findLeadByTelefone($this->input->get('telefone'))) {
                $response = $this->admin_model->findLeadByTelefone($this->input->get('telefone'));
            } else {
                $response = false;
            }
           
        }

		print_r(json_encode($response));
    }

    public function find_lead_email() {

        if ($this->input->get('email')) {

        
            if ($this->admin_model->findLeadByEmail($this->input->get('email'))) {
                $response = $this->admin_model->findLeadByEmail($this->input->get('email'));
            } else {
                $response = false;
            }
           
        }

		print_r(json_encode($response));
    }

    public function find_lead_id() {

        if ($this->input->get('id')) {

        
            if ($this->admin_model->findLeadById($this->input->get('id'))) {
                $response = $this->admin_model->findLeadById($this->input->get('id'));
            } else {
                $response = false;
            }
           
        }

		print_r(json_encode($response));
    }

    public function find_produto() {

        if ($this->input->get('id')) {

        
            if ($this->admin_model->get_produto($this->input->get('id'))) {
                $response = $this->admin_model->get_produto($this->input->get('id'));
            } else {
                $response = false;
            }
           
        }

		print_r(json_encode($response));
    }

    public function add_prospecto() {
        

        if ($this->input->get()) {

            $campanha_id = $this->input->get('campanha_id');
            $produto_id = $this->input->get('produto_id');
            $encurtador_url = $this->input->get('encurtador_url');
            $lead_id = $this->input->get('lead_id');
            $origem_url =$this->input->get('origem_url'); 
            $origem_type = $this->input->get('origem_type');
            $lead_dispositivo = $this->input->get('lead_dispositivo');
            $lead_ip = $this->input->get('lead_ip');

            if ($this->admin_model->add_prospecto($campanha_id, $produto_id, $encurtador_url, $lead_id, $origem_url, $origem_type, $lead_dispositivo, $lead_ip)) {
                $response = array("status" => "true");
            } else {
                $response = array("status" => "false");
            }
           
        }

		print_r(json_encode($response));
    }

    
}