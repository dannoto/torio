<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_stats extends CI_Controller
{
    # Api resposanvel por receber interacoes do redirecionar ofertas.run

    function __construct()
    {

        parent::__construct();
        $this->load->model('stats_model');
    }

    public function get_ad() {

        $target_url = htmlspecialchars($this->input->post('tu'));
        $banner_tipo = htmlspecialchars($this->input->post('bt'));

        $target_data = $this->stats_model->get_target_by_url($target_url);

        $campanha_ativa = $this->stats_model->get_campanha_para_exibicao($banner_tipo, $target_data);

        if ($campanha_ativa) {

        } else {
            $response = array('status' => 'false', 'message' => 'empty');

        }

    }



    public function add_imp()
    {
        $data['impressao_target_id'] = htmlspecialchars($this->input->post('t_id'));
        $data['impressao_produto_id'] = htmlspecialchars($this->input->post('p_id'));
        $data['impressao_campanha_id'] = htmlspecialchars($this->input->post('c_id'));
        $data['impressao_banner_id'] = htmlspecialchars($this->input->post('b_id'));
        $data['impressao_criacao'] = date('Y-m-d H:i:s');
        $data['impressao_os'] = $this->get_os();
        $data['impressao_pagina'] = $this->get_page();
        $data['impressao_browser'] = $this->get_browser();
        $data['impressao_useragent'] = $this->get_user_agent();
        $data['impressao_dispositivo'] = $this->get_dispostivo();
        $data['impressao_referee'] = $this->get_referer();
        $data['impressao_ip'] = $this->get_ip();
        $data['impressao_user_cookie'] = htmlspecialchars($this->input->post('uc'));
        $data['is_deleted'] = 0;

        if ($this->stats_model->add_campanha_impressao($data)) {
            $response = array('status' => 'true', 'message' => 'success');
        } else {
            $response = array('status' => 'false', 'message' => 'error');
        }

        print_r(json_encode($response));
    }

    public function add_acss()
    {

        $data['acesso_target_id'] = htmlspecialchars($this->input->post('t_id'));
        $data['acesso_produto_id'] = htmlspecialchars($this->input->post('p_id'));
        $data['acesso_campanha_id'] = htmlspecialchars($this->input->post('c_id'));
        $data['acesso_banner_id'] = htmlspecialchars($this->input->post('b_id'));
        $data['acesso_criacao'] = date('Y-m-d H:i:s');
        $data['acesso_os'] = $this->get_os();
        $data['acesso_pagina'] = $this->get_page();
        $data['acesso_browser'] = $this->get_browser();
        $data['acesso_useragent'] = $this->get_user_agent();
        $data['acesso_dispositivo'] = $this->get_dispostivo();
        $data['acesso_referee'] = $this->get_referer();
        $data['acesso_ip'] = $this->get_ip();
        $data['acesso_user_cookie'] = htmlspecialchars($this->input->post('uc'));
        $data['is_deleted'] = 0;

        if ($this->stats_model->add_campanha_acesso($data)) {
            $response = array('status' => 'true', 'message' => 'success');
        } else {
            $response = array('status' => 'false', 'message' => 'error');
        }

        print_r(json_encode($response));
    }

    public function add_clq()
    {

        $data['clique_target_id'] = htmlspecialchars($this->input->post('t_id'));
        $data['clique_produto_id'] = htmlspecialchars($this->input->post('p_id'));
        $data['clique_campanha_id'] = htmlspecialchars($this->input->post('c_id'));
        $data['clique_banner_id'] = htmlspecialchars($this->input->post('b_id'));
        $data['clique_criacao'] = date('Y-m-d H:i:s');
        $data['clique_os'] = $this->get_os();
        $data['clique_pagina'] = $this->get_page();
        $data['clique_browser'] = $this->get_browser();
        $data['clique_useragent'] = $this->get_user_agent();
        $data['clique_dispositivo'] = $this->get_dispostivo();
        $data['clique_referee'] = $this->get_referer();
        $data['clique_ip'] = $this->get_ip();
        $data['clique_user_cookie'] = htmlspecialchars($this->input->post('uc'));
        $data['is_deleted'] = 0;

        if ($this->stats_model->add_campanha_clique($data)) {
            $response = array('status' => 'true', 'message' => 'success');
        } else {
            $response = array('status' => 'false', 'message' => 'error');
        }

        print_r(json_encode($response));
    }

    // Stats
    private function get_page() {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'];
        $path = $_SERVER['REQUEST_URI'];
        
        // Combine the parts to form the complete URL
        $url = $protocol . "://" . $host . $path;

        return $url;
    }

    public function get_browser() {
        // Get the user agent string
        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        // Detect browser based on user agent
        if (strpos($userAgent, 'Firefox') !== false) {
            return "firefox";
        } elseif (strpos($userAgent, 'Chrome') !== false) {
            return "chrome";
        } elseif (strpos($userAgent, 'Safari') !== false) {
            return "safari";
        } elseif (strpos($userAgent, 'Edge') !== false) {
            return "edge";
        } else {
            return "none";
        }
    }

    private function get_user_agent() {
        if (!isset($_SERVER['HTTP_USER_AGENT']) || strpos($_SERVER['HTTP_USER_AGENT'], 'WordPress') !== false) {
            return '';
        }
        return substr($_SERVER['HTTP_USER_AGENT'], 0, 255);
    }

    private function get_ip() {
        if (!isset($_SERVER['REMOTE_ADDR'])) {
            return '';
        }
        return preg_replace('/[^0-9a-fA-F:., ]/', '', $_SERVER['REMOTE_ADDR']);
    }

    private function get_referer() {
        if (isset($_SERVER['HTTP_REFERER'])) {
            // Return the referer value
            return $_SERVER['HTTP_REFERER'];
        } else {
            // Return a default message if the referer is not set
            return "none";
        }
    }

    
}
