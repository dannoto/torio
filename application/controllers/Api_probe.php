<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_probe extends CI_Controller {

    
    public function __construct() {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->model('probe_model');

    }

    public function index()
    {
        // Display a message
        echo "Welcome to the API!";
    }

    public function  get_oferta_historico()
    {
        $dados = array (
            'oferta_id' => htmlspecialchars($this->input->post('oferta_id')),
        );

    

        $oferta = $this->probe_model->get_oferta_historico($dados['oferta_id']);

        if ($oferta) {

            $data = $oferta;

        } else {

            $data = array(
                'status' => 'false',

            );
        }

        print_r(json_encode($data));
        // return $data;
    }

    public function registrar_evento() 
    {
        // 1 - visitou o site
        // 2 - clicou nos botoes de call to action
        // 3 - abriu a faq
        // 5 - clicou no whatsapp
        // 6 - abriu checkout
        // 7 - comprou
        $dados = array (
            'evento_oferta_id' => htmlspecialchars($this->input->post('oferta_id')),
            'evento_lead_id' => htmlspecialchars($this->input->post('lead_id')),
            'evento_agente_id' => htmlspecialchars($this->input->post('oferta_agente')),
            'evento_tipo' => htmlspecialchars($this->input->post('evento_tipo')),
            'evento_data' => date('Y-m-d H:i:s')
        );

        $oferta = $this->probe_model->registrar_evento($dados);

        if ($oferta) {

            $data = $oferta;

        } else {

            $data = array(
                'status' => 'false',

            );
        }

        print_r(json_encode($data));
    }
    

    public function get_ofertas()
    {
        $ofertas = $this->probe_model->get_ofertas();

        if ($ofertas) {

            $data = $ofertas;

        } else {

            $data = array(
                'status' => 'false',

            );
        }

        print_r(json_encode($data));
    }

    public function  get_oferta()
    {
        $dados = array (
            'oferta_id' => htmlspecialchars($this->input->post('oferta_id')),
        );

        $oferta = $this->probe_model->get_oferta($dados['oferta_id']);

        if ($oferta) {

            $data = $oferta;

        } else {

            $data = array(
                'status' => 'false',

            );
        }

        print_r(json_encode($data));
    }

    public function get_agente()
    {
        $dados = array (
            'agente_id' => htmlspecialchars($this->input->post('agente_id')),
        );

        $agente_data = $this->probe_model->get_agente($dados['agente_id']);

        if ($agente_data) {

            $data = $agente_data;

        } else {

            $data = array(
                'status' => 'false',
            );
        }

        print_r(json_encode($data));
    }

    public function get_agentes()
    {
        
        $agente_data = $this->probe_model->get_agentes();

        if ($agente_data) {

            $data = $agente_data;

        } else {

            $data = array(
                'status' => 'false',
            );
        }

        print_r(json_encode($data));
    }


    public function check_envios_qtd()
    {
        $dados = array (
            'agente_id' => htmlspecialchars($this->input->post('agente_id')),
            'oferta_id' => htmlspecialchars($this->input->post('oferta_id')),
            
        );

        $response = $this->probe_model->check_envios_qtd($dados['agente_id'], $dados['oferta_id']);

        if ($response) {

            $data = $response;

        } else {

            $data = 0;
        }

        print_r(json_encode($data));
    }

    public function get_leads()
    {
        $dados = array (
            'oferta_id' => htmlspecialchars($this->input->post('oferta_id')),
            'limite' => htmlspecialchars($this->input->post('limite')),
            'publico_id' => $this->probe_model->get_oferta( htmlspecialchars($this->input->post('oferta_id')))['oferta_publico_id']
        );

        $response = $this->probe_model->get_leads($dados['oferta_id'], $dados['limite'], $dados['publico_id']);

        if ($response) {

            $data = $response;

        } else {

           $data = 0;
        }

        print_r(json_encode($data));
    }

    public function get_lead()

    {
        $dados = array (
            'lead_id' => htmlspecialchars($this->input->post('lead_id')),
            
        );

        $response = $this->probe_model->get_lead($dados['lead_id']);

        if ($response) {

            $data = $response;

        } else {

            $data = array(
                'status' => 'false',
            );
        }

        print_r(json_encode($data));
    }

    public function check_envio()
    {
        $dados = array (
            'lead_id' => htmlspecialchars($this->input->post('lead_id')),
            'oferta_id' => htmlspecialchars($this->input->post('oferta_id')),
        );

        $response = $this->probe_model->check_envio($dados['lead_id'], $dados['oferta_id']);

        if ($response) {

            $data = $response;

        } else {

            $data = array(
                'status' => 'false',
            );
        }

        print_r(json_encode($data));
    }

    public function oferta_enviada() 
    {

        $dados = array (
            'lead_id' => htmlspecialchars($this->input->post('lead_id')),
            'oferta_id' => htmlspecialchars($this->input->post('oferta_id')),
            'agente_id' => htmlspecialchars($this->input->post('agente_id')),

        );

        $response = $this->probe_model->oferta_enviada($dados['lead_id'], $dados['oferta_id'], $dados['agente_id']);

        if ($response) {

            $data = $response;

        } else {

            $data = array(
                'status' => 'false',
            );
        }

        print_r(json_encode($data));

    }


    public function get_leads_fase_dois() {

        $dados = array (
            'oferta_id' => htmlspecialchars($this->input->post('oferta_id')),
            'agente_id' => htmlspecialchars($this->input->post('agente_id')),

        );

        $response = $this->probe_model->get_leads_fase_dois( $dados['oferta_id'], $dados['agente_id']);

        if ($response) {

            $data = $response;

        } else {

            $data = 0;
        }

        print_r(json_encode($data));

    }

    public function check_envio_fase_dois()
    {
        $dados = array (
            'lead_id' => htmlspecialchars($this->input->post('lead_id')),
            'oferta_id' => htmlspecialchars($this->input->post('oferta_id')),
        );

        $response = $this->probe_model->check_envio_fase_dois($dados['lead_id'], $dados['oferta_id']);

        if ($response) {

            $data = $response;

        } else {

            $data = array(
                'status' => 'false',
            );
        }

        print_r(json_encode($data));
    }

    public function oferta_enviada_fase_dois() {

        $dados = array (
            'lead_id' => htmlspecialchars($this->input->post('lead_id')),
            'oferta_id' => htmlspecialchars($this->input->post('oferta_id')),
            'agente_id' => htmlspecialchars($this->input->post('agente_id')),

        );

        $response = $this->probe_model->oferta_enviada_fase_dois($dados['lead_id'], $dados['oferta_id'], $dados['agente_id']);

        if ($response) {

            $data = $response;

        } else {

            $data = array(
                'status' => 'false',
            );
        }

        print_r(json_encode($data));

    }


    public function ativar_agente()
    {
        $dados = array (
            'agente_id' => htmlspecialchars($this->input->post('agente_id')),
        );

        $response = $this->probe_model->ativar_agente($dados['agente_id']);

        if ($response) {

            $data = $response;

        } else {

            $data = array(
                'status' => 'false',
            );
        }

        print_r(json_encode($data));
    }

    
    public function desativar_agente()
    {
        $dados = array (
            'agente_id' => htmlspecialchars($this->input->post('agente_id')),
        );

        $response = $this->probe_model->desativar_agente($dados['agente_id']);

        if ($response) {

            $data = $response;

        } else {

            $data = array(
                'status' => 'false',
            );
        }

        print_r(json_encode($data));
    }


    public function convertEnvios() {

        $antigos = $this->main_model->getAntigosEnvios();


        foreach ($antigos as $c) {

            $this->main_model->insertNovosEnvios($c->prospeccao_cliente, $c->prospeccao_data);
        }
    }
    
}
