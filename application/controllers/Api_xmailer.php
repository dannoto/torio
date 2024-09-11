<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_xmailer extends CI_Controller {
    # Api resposanvel por receber interacoes do redirecionar ofertas.run

	function __construct() {

		parent::__construct();
		$this->load->model('admin_model');
	}


    public function get_campanhas() {
        
        $campanhas = $this->admin_model->get_campanhas();


        if ($campanhas) {
            print_r(json_encode($campanhas));
        }
    }

    public function add_abertura() {
         
        $data['abertura_lead_campanha_id'] = htmlspecialchars($this->input->get('ci'));
        $data['abertura_lead_email'] = htmlspecialchars($this->input->get('le'));
        $data['abertura_lead_telefone'] = htmlspecialchars($this->input->get('lt'));
        $data['abertura_lead_cnpj'] = htmlspecialchars($this->input->get('lc'));
        $data['abertura_lead_abertura_data'] = date('Y-m-d H:i:s');
        $data['is_deleted'] = 0;

        if ($this->admin_model->add_abertura($data)) {
            $imagemSubstituta = './assets/img/icons/brands/slack.png';
            header('Content-Type: image/svg+xml');
            readfile($imagemSubstituta);
        } else {
            $imagemSubstituta = './assets/img/icons/brands/slack.png';
            header('Content-Type: image/svg+xml');
            readfile($imagemSubstituta);
        }
    }

}