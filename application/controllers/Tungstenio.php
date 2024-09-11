<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tungstenio extends CI_Controller
{

    function __construct()
    {

        parent::__construct();
        $this->load->model('stats_model');
        $this->load->model('admin_model');

    }

    public function campanhas()
    {

        $this->load->view('admin/tungstenio/campanhas');
    }

    public function campanha_adicionar()
    {

        $this->load->view('admin/tungstenio/campanha_adicionar');
    }

    public function campanha_editar($campanha_id)
    {
        $campanha_data = $this->stats_model->get_campanha($campanha_id);

        $data = array(
            'c' => $campanha_data
        );

        if ($campanha_data) {
            $this->load->view('admin/tungstenio/campanha_editar', $data);
        } else {
            redirect(base_url('tungstenio/campanhas'));
        }
    }

    public function campanhas_links($campanha_id)
    {
        $campanha_data = $this->stats_model->get_campanha($campanha_id);

        $data = array(
            'c' => $campanha_data
        );

        if ($campanha_data) {
            $this->load->view('admin/tungstenio/campanha_links', $data);
        } else {
            redirect(base_url('tungstenio/campanhas'));
        }
        

       
    }

    public function campanhas_cliques($campanha_id)
    {

        $campanha_data = $this->stats_model->get_campanha($campanha_id);

        $data = array(
            'campanha' => $campanha_data
        );

        if ($campanha_data) {
            $this->load->view('admin/tungstenio/campanha_cliques', $data);
        } else {
            redirect(base_url('tungstenio/campanhas'));
        }

    }

    public function campanhas_vendas()
    {

        $this->load->view('admin/tungstenio/campanha_vendas');
    }

    public function campanhas_banners()
    {

        $this->load->view('admin/tungstenio/campanha_banners');
    }

    public function campanhas_relatorios()
    {

        $this->load->view('admin/tungstenio/campanha_relatorios');
    }


    public function categorias()
    {

        $this->load->view('admin/tungstenio/categorias');
    }

    public function parceiros()
    {

        $this->load->view('admin/tungstenio/parceiros');
    }

    public function parceiros_adicionar()
    {

        $this->load->view('admin/tungstenio/parceiros_adicionar');
    }

    public function parceiros_editar($target_id)
    {
        $target_data = $this->stats_model->get_target($target_id);

        $data = array(
            't' => $target_data
        );

        if ($target_data) {
            $this->load->view('admin/tungstenio/parceiros_editar', $data);
        } else {
            redirect(base_url('tungstenio/parceiros'));
        }
    }

    public function produtos()
    {

        $this->load->view('admin/tungstenio/produtos');
    }

    public function produto_adicionar()
    {

        $this->load->view('admin/tungstenio/produto_adicionar');
    }

    public function produto_editar($produto_id)
    {
        $produto_data = $this->stats_model->get_produto($produto_id);

        $data = array(
            'produto' => $produto_data
        );

        if ($produto_data) {
            $this->load->view('admin/tungstenio/produto_editar', $data);
        } else {
            redirect(base_url('tungstenio/produtos'));
        }

    }


    // Actions
    // Campanhas
    public function act_add_campanha()
    {

        $data['campanha_nome'] = htmlspecialchars($this->input->post('campanha_nome'));
        $data['campanha_descricao'] = htmlspecialchars($this->input->post('campanha_descricao'));
        $data['campanha_produto_id'] = htmlspecialchars($this->input->post('campanha_produto_id'));
        $data['campanha_tipo'] = htmlspecialchars($this->input->post('campanha_tipo'));
        $data['campanha_publico_categoria'] = htmlspecialchars($this->input->post('campanha_publico_categoria'));
        $data['campanha_publico_sexo'] = htmlspecialchars($this->input->post('campanha_publico_sexo'));
        $data['campanha_publico_idade_max'] = htmlspecialchars($this->input->post('campanha_publico_idade_max'));
        $data['campanha_publico_idade_min'] = htmlspecialchars($this->input->post('campanha_publico_idade_min'));
        $data['campanha_impressoes'] = 0;
        $data['campanha_cliques'] = 0;
        $data['campanha_vendas'] = 0;
        $data['campanha_status'] = htmlspecialchars($this->input->post('campanha_status'));
        $data['campanha_criacao'] = date('d-m-Y H:i:s');
        $data['is_deleted'] = 0;


        if ($this->stats_model->add_campanha($data)) {

            $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao adicionar.');
        }

        print_r(json_encode($response));
    }

    public function act_update_campanha()
    {
        $campanha_id = htmlspecialchars($this->input->post('campanha_id'));

        $data['campanha_nome'] = htmlspecialchars($this->input->post('campanha_nome'));
        $data['campanha_descricao'] = htmlspecialchars($this->input->post('campanha_descricao'));
        $data['campanha_produto_id'] = htmlspecialchars($this->input->post('campanha_produto_id'));

        $data['campanha_tipo'] = htmlspecialchars($this->input->post('campanha_tipo'));

        $data['campanha_publico_categoria'] = htmlspecialchars($this->input->post('campanha_publico_categoria'));
        $data['campanha_publico_sexo'] = htmlspecialchars($this->input->post('campanha_publico_sexo'));
        $data['campanha_publico_idade_max'] = htmlspecialchars($this->input->post('campanha_publico_idade_max'));
        $data['campanha_publico_idade_min'] = htmlspecialchars($this->input->post('campanha_publico_idade_min'));
        $data['campanha_status'] = htmlspecialchars($this->input->post('campanha_status'));


        if ($this->stats_model->update_campanha($campanha_id, $data)) {

            $response = array('status' => 'true', 'message' => 'Atualizado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao atualizar.');
        }

        print_r(json_encode($response));
    }

    public function act_delete_campanha()
    {
        $campanha_id = htmlspecialchars($this->input->post('campanha_id'));



        if ($this->stats_model->delete_campanha($campanha_id)) {

            $response = array('status' => 'true', 'message' => 'Excluido com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao excluir');
        }

        print_r(json_encode($response));
    }
    // Campanhas

    // Target
    public function act_add_target()
    {

        $data['target_nome'] = htmlspecialchars($this->input->post('target_nome'));
        $data['target_wp_version'] = htmlspecialchars($this->input->post('target_wp_version'));
        $data['target_php_version'] = htmlspecialchars($this->input->post('target_php_version'));
        $data['target_publico_sexo'] = htmlspecialchars($this->input->post('target_publico_sexo'));
        $data['target_publico_idade_max'] = htmlspecialchars($this->input->post('target_publico_idade_max'));
        $data['target_publico_idade_min'] = htmlspecialchars($this->input->post('target_publico_idade_min'));
        $data['target_publico_categoria'] = htmlspecialchars($this->input->post('target_publico_categoria'));

        $data['target_url'] = htmlspecialchars($this->input->post('target_url'));

        $data['target_criacao'] = date('d-m-Y H:i:s');
        $data['target_ultima_atualizacao'] = date('d-m-Y H:i:s');
        $data['target_status'] = htmlspecialchars($this->input->post('target_status'));
        $data['is_deleted'] = 0;


        if ($this->stats_model->add_target($data)) {

            $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao adicionar.');
        }

        print_r(json_encode($response));
    }

    public function act_update_target()
    {
        $target_id = htmlspecialchars($this->input->post('target_id'));

        $data['target_nome'] = htmlspecialchars($this->input->post('target_nome'));
        $data['target_wp_version'] = htmlspecialchars($this->input->post('target_wp_version'));
        $data['target_php_version'] = htmlspecialchars($this->input->post('target_php_version'));
        $data['target_publico_sexo'] = htmlspecialchars($this->input->post('target_publico_sexo'));
        $data['target_publico_idade_max'] = htmlspecialchars($this->input->post('target_publico_idade_max'));
        $data['target_publico_idade_min'] = htmlspecialchars($this->input->post('target_publico_idade_min'));
        $data['target_publico_categoria'] = htmlspecialchars($this->input->post('target_publico_categoria'));

        $data['target_url'] = htmlspecialchars($this->input->post('target_url'));


        $data['target_ultima_atualizacao'] = date('d-m-Y H:i:s');
        $data['target_status'] = htmlspecialchars($this->input->post('target_status'));


        if ($this->stats_model->update_target($target_id, $data)) {

            $response = array('status' => 'true', 'message' => 'Atualizado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao atualizar.');
        }

        print_r(json_encode($response));
    }

    public function act_delete_target()
    {
        $target_id = htmlspecialchars($this->input->post('target_id'));

        if ($this->stats_model->delete_target($target_id)) {

            $response = array('status' => 'true', 'message' => 'Excluido com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao excluir');
        }

        print_r(json_encode($response));
    }
    // Target

    // Categorias

    public function act_add_categoria($data)
    {

        $data['categoria_nome'] = htmlspecialchars($this->input->post('categoria_nome'));
        $data['categoria_slug'] = htmlspecialchars($this->input->post('categoria_slug'));
        $data['categoria_descricao'] = htmlspecialchars($this->input->post('categoria_descricao'));
        $data['categoria_data'] = date('d-m-Y H:i:s');
        $data['is_deleted'] = 0;


        if ($this->stats_model->add_categoria($data)) {

            $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao adicionar.');
        }

        print_r(json_encode($response));
    }

    public function act_update_categoria()
    {
        $categoria_id = htmlspecialchars($this->input->post('categoria_id'));

        $data['categoria_nome'] = htmlspecialchars($this->input->post('categoria_nome'));
        $data['categoria_slug'] = htmlspecialchars($this->input->post('categoria_slug'));
        $data['categoria_descricao'] = htmlspecialchars($this->input->post('categoria_descricao'));
        $data['categoria_data'] = date('d-m-Y H:i:s');
        $data['is_deleted'] = 0;


        if ($this->stats_model->update_categoria($categoria_id, $data)) {

            $response = array('status' => 'true', 'message' => 'Atualizado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao atualizar.');
        }

        print_r(json_encode($response));
    }

    public function act_delete_categoria($categoria_id)
    {
        $categoria_id = htmlspecialchars($this->input->post('categoria_id'));

        if ($this->stats_model->delete_categoria($categoria_id)) {

            $response = array('status' => 'true', 'message' => 'Excluido com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao excluir');
        }

        print_r(json_encode($response));
    }

    // Categorias

    // Banners
    public function act_add_banner($data)
    {

        $data['banner_campanha_id'] = htmlspecialchars($this->input->post('banner_campanha_id'));
        $data['banner_tipo'] = htmlspecialchars($this->input->post('banner_tipo'));
        $data['banner_arquivo'] = htmlspecialchars($this->input->post('banner_arquivo'));
        $data['banner_status'] = htmlspecialchars($this->input->post('banner_status'));
        $data['banner_width_desktop'] = htmlspecialchars($this->input->post('banner_width_desktop'));
        $data['banner_width_mobile'] = htmlspecialchars($this->input->post('banner_width_mobile'));
        $data['banner_height_desktop'] = htmlspecialchars($this->input->post('banner_height_desktop'));
        $data['banner_height_mobile'] = htmlspecialchars($this->input->post('banner_height_mobile'));
        $data['banner_impressoes'] = 0;
        $data['banner_cliques'] = 0;
        $data['banners_vendas'] = 0;
        $data['banner_criacao'] =  date('d-m-Y H:i:s');
        $data['banner_ultima_atualizacao'] =  date('d-m-Y H:i:s');
        $data['is_deleted'] = 0;


        if ($this->stats_model->add_banner($data)) {

            $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao adicionar.');
        }

        print_r(json_encode($response));
    }

    public function act_update_banner()
    {
        $banner_id = htmlspecialchars($this->input->post('banner_id'));

        $data['banner_arquivo'] = htmlspecialchars($this->input->post('banner_arquivo'));
        $data['banner_status'] = htmlspecialchars($this->input->post('banner_status'));
        $data['banner_width_desktop'] = htmlspecialchars($this->input->post('banner_width_desktop'));
        $data['banner_width_mobile'] = htmlspecialchars($this->input->post('banner_width_mobile'));
        $data['banner_height_desktop'] = htmlspecialchars($this->input->post('banner_height_desktop'));
        $data['banner_height_mobile'] = htmlspecialchars($this->input->post('banner_height_mobile'));
        $data['banner_ultima_atualizacao'] =  date('d-m-Y H:i:s');

        $data['is_deleted'] = 0;


        if ($this->stats_model->update_banner($banner_id, $data)) {

            $response = array('status' => 'true', 'message' => 'Atualizado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao atualizar.');
        }

        print_r(json_encode($response));
    }

    public function act_delete_banner($banner_id)
    {
        $banner_id = htmlspecialchars($this->input->post('banner_id'));

        if ($this->stats_model->delete_banner($banner_id)) {

            $response = array('status' => 'true', 'message' => 'Excluido com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao excluir');
        }

        print_r(json_encode($response));
    }
    // Banners

    // Links
    function generate_link()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $max = strlen($characters) - 1;
        $hash = '';

        // Generate a 7-character hash
        for ($i = 0; $i < 7; $i++) {
            $randIndex = mt_rand(0, $max);
            $hash .= $characters[$randIndex];
        }

        return strtoupper($hash);
    }

    public function act_add_campanha_link()
    {

        $data['link_campanha_id'] = htmlspecialchars($this->input->post('link_campanha_id'));
        $data['link_tipo'] = htmlspecialchars($this->input->post('link_tipo'));
        $data['link_codigo'] = $this->generate_link();
        $data['is_deleted'] = 0;


        if ($this->stats_model->add_link($data)) {

            $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao adicionar.');
        }

        print_r(json_encode($response));
    }

    // Links


    // Produto
    public function act_add_produto()
    {

        $data['produto_nome'] = htmlspecialchars($this->input->post('produto_nome'));
        $data['produto_imagem'] = htmlspecialchars($this->input->post('produto_imagem'));
        $data['produto_preco'] = htmlspecialchars($this->input->post('produto_preco'));
        $data['produto_plataforma'] = htmlspecialchars($this->input->post('produto_plataforma'));
        $data['produto_data'] = date('d-m-Y H:i:s');
        $data['produto_categoria'] = htmlspecialchars($this->input->post('produto_categoria'));
        $data['produto_pagina_de_vendas'] = htmlspecialchars($this->input->post('produto_pagina_de_vendas'));
        $data['produto_descricao'] = htmlspecialchars($this->input->post('produto_descricao'));
        $data['is_deleted'] = 0;


        if ($this->stats_model->add_produto($data)) {

            $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao adicionar.');
        }

        print_r(json_encode($response));
    }

    public function act_update_produto()
    {
        $produto_id = htmlspecialchars($this->input->post('produto_id'));

        $data['produto_nome'] = htmlspecialchars($this->input->post('produto_nome'));
        $data['produto_imagem'] = htmlspecialchars($this->input->post('produto_imagem'));
        $data['produto_preco'] = htmlspecialchars($this->input->post('produto_preco'));
        $data['produto_plataforma'] = htmlspecialchars($this->input->post('produto_plataforma'));
        $data['produto_data'] = date('d-m-Y H:i:s');
        $data['produto_categoria'] = htmlspecialchars($this->input->post('produto_categoria'));
        $data['produto_pagina_de_vendas'] = htmlspecialchars($this->input->post('produto_pagina_de_vendas'));
        $data['produto_descricao'] = htmlspecialchars($this->input->post('produto_descricao'));


        if ($this->stats_model->update_produto($produto_id, $data)) {

            $response = array('status' => 'true', 'message' => 'Atualizado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao atualizar.');
        }

        print_r(json_encode($response));
    }

    public function act_delete_produto()
    {
        $produto_id = htmlspecialchars($this->input->post('produto_id'));

        if ($this->stats_model->delete_produto($produto_id)) {

            $response = array('status' => 'true', 'message' => 'Excluido com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao excluir');
        }

        print_r(json_encode($response));
    }
    // Produto



    // Cliques
    public function act_delete_clique() {

        $clique_id = htmlspecialchars($this->input->post('clique_id'));

        if ($this->stats_model->delete_clique($clique_id)) {

            $response = array('status' => 'true', 'message' => 'Excluido com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao excluir');
        }

        print_r(json_encode($response));

    }
    // Cliques


    // Vendas
    public function act_add_venda()
    {

        $campanha_id = htmlspecialchars($this->input->post('campanha_id'));
        $produto_id = htmlspecialchars($this->input->post('produto_id'));
        $lead_id = $this->input->post('lead_id')[0];
        $data = htmlspecialchars($this->input->post('data'));

        $dateString = $data;
        $dateTime = DateTime::createFromFormat('Y-m-d\TH:i', $dateString);
        $formattedDateTime = $dateTime->format('d-m-Y H:i:s');

        $data =  $formattedDateTime;

        $valor = htmlspecialchars($this->input->post('valor'));
        $provedor = htmlspecialchars($this->input->post('provedor'));
        $provedor_venda_id = htmlspecialchars($this->input->post('provedor_venda_id'));

        $tipo = htmlspecialchars($this->input->post('tipo'));

        if ($this->stats_model->add_venda($campanha_id, $produto_id, $lead_id, $data,  $valor, $provedor, $provedor_venda_id, $tipo)) {

            $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao adicionar.');
        }

        print_r(json_encode($response));
    }

    public function act_delete_vendas()
    {

        $id = htmlspecialchars($this->input->post('id'));

        if ($this->stats_model->delete_venda($id)) {

            $response = array('status' => 'true', 'message' => 'Excluido com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Excluido com sucesso.');
        }

        print_r(json_encode($response));
    }

    // Vendas

}
