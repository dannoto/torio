<?php
defined('BASEPATH') or exit('No direct script access allowed');

class stats_model extends CI_Model
{

    // Api
    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
    }

    // Impressoes
    public function get_impressao($impressao_id)
    {
        $this->db->where('id', $impressao_id);
        $this->db->where('is_deleted', 0);
        $this->db->get('hs_campanhas_impressoes')->row_array();
    }

    public function get_impressoes_by_campanha($campanha_id)
    {
        $this->db->where('impressao_campanha_id', $campanha_id);
        $this->db->where('is_deleted', 0);
        $this->db->get('hs_campanhas_impressoes')->result();
    }

    public function get_impressoes_by_banner($banner_id)
    {
        $this->db->where('impressao_banner_id', $banner_id);
        $this->db->where('is_deleted', 0);
        $this->db->get('hs_campanhas_impressoes')->result();
    }

    public function get_impressoes_by_produto($produto_id)
    {
        $this->db->where('impressao_produto_id', $produto_id);
        $this->db->where('is_deleted', 0);
        $this->db->get('hs_campanhas_impressoes')->result();
    }

    public function get_impressoes_by_target($target_id)
    {
        $this->db->where('impressao_target_id', $target_id);
        $this->db->where('is_deleted', 0);
        $this->db->get('hs_campanhas_impressoes')->result();
    }

    public function add_campanha_impressao($data)
    {
        $this->db->insert('hs_campanhas_impressoes', $data);
    }

    public function update_campanha_impressao($impressao_id, $data)
    {
        $this->db->where('id', $impressao_id);
        $this->db->update('hs_campanhas_impressoes', $data);
    }

    public function delete_impressao($impressao_id)
    {

        $this->db->where('id', $impressao_id);

        $data = array(
            'is_deleted' => 1
        );

        return $this->db->update('hs_campanhas_impressoes', $data);
    }
    // Impressoes


    // Acessos

    public function get_acesso($acesso_id)
    {
        $this->db->where('id', $acesso_id);
        $this->db->where('is_deleted', 0);
        $this->db->get('hs_campanhas_acessos')->row_array();
    }

    public function get_acessos_by_campanha($campanha_id)
    {
        $this->db->where('acesso_campanha_id', $campanha_id);
        $this->db->where('is_deleted', 0);
        $this->db->get('hs_campanhas_acessos')->result();
    }

    public function get_acessos_by_banner($banner_id)
    {
        $this->db->where('acesso_banner_id', $banner_id);
        $this->db->where('is_deleted', 0);
        $this->db->get('hs_campanhas_acessos')->result();
    }

    public function get_acessos_by_produto($produto_id)
    {
        $this->db->where('acesso_produto_id', $produto_id);
        $this->db->where('is_deleted', 0);
        $this->db->get('hs_campanhas_acessos')->result();
    }

    public function get_acessos_by_target($target_id)
    {
        $this->db->where('acesso_target_id', $target_id);
        $this->db->where('is_deleted', 0);
        $this->db->get('hs_campanhas_acessos')->result();
    }

    public function add_campanha_acesso($data)
    {
        $this->db->insert('hs_campanhas_acessos', $data);
    }

    public function update_campanha_acesso($acesso_id, $data)
    {
        $this->db->where('id', $acesso_id);
        $this->db->update('hs_campanhas_acessos', $data);
    }

    public function delete_acesso($acesso_id)
    {

        $this->db->where('id', $acesso_id);

        $data = array(
            'is_deleted' => 1
        );

        return $this->db->update('hs_campanhas_acessos', $data);
    }

    // Acessos



    // Cliques
    public function get_clique($clique_id)
    {
        $this->db->where('id', $clique_id);
        $this->db->where('is_deleted', 0);
        $this->db->get('hs_campanhas_cliques')->row_array();
    }

    public function get_cliques_by_campanha($campanha_id)
    {
        $this->db->where('clique_campanha_id', $campanha_id);
        $this->db->where('is_deleted', 0);
        return $this->db->get('hs_campanhas_cliques')->result();
    }

    public function get_cliques_by_banner($banner_id)
    {
        $this->db->where('clique_banner_id', $banner_id);
        $this->db->where('is_deleted', 0);
        $this->db->get('hs_campanhas_cliques')->result();
    }

    public function get_cliques_by_produto($produto_id)
    {
        $this->db->where('clique_produto_id', $produto_id);
        $this->db->where('is_deleted', 0);
        $this->db->get('hs_campanhas_cliques')->result();
    }

    public function get_cliques_by_target($target_id)
    {
        $this->db->where('clique_target_id', $target_id);
        $this->db->where('is_deleted', 0);
        $this->db->get('hs_campanhas_cliques')->result();
    }

    public function add_campanha_clique($data)
    {
        $this->db->insert('hs_campanhas_cliques', $data);
    }

    public function update_campanha_clique($clique_id, $data)
    {
        $this->db->where('id', $clique_id);
        $this->db->update('hs_campanhas_cliques', $data);
    }

    public function delete_clique($clique_id)
    {

        $this->db->where('id', $clique_id);

        $data = array(
            'is_deleted' => 1
        );

        return $this->db->update('hs_campanhas_cliques', $data);
    }

    // Cliques
    // Api






    // Hassio


    // Campanhas
    public function get_campanha($campanha_id)
    {
        $this->db->where('id', $campanha_id);
        $this->db->where('is_deleted', 0);
        return $this->db->get('hs_campanhas')->row_array();
    }

    public function get_campanhas()
    {
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id','desc');

        return $this->db->get('hs_campanhas')->result();
    }

    public function get_campanhas_search($campanha_status = null, $campanha_publico_sexo = null, $campanha_publico_idade_max = null, $campanha_publico_idade_min = null, $campanha_categoria = null)
    {

        $this->db->where('is_deleted', 0);

        if ($campanha_status != null) {
            $this->db->where('campanha_status', $campanha_status);
        }

        if ($campanha_publico_sexo != null) {
            $this->db->where('campanha_publico_sexo', $campanha_publico_sexo);
        }

        if ($campanha_publico_idade_max != null) {
            $this->db->where('campanha_publico_idade_max >= ', $campanha_publico_idade_max);
        }

        if ($campanha_publico_idade_min != null) {
            $this->db->where('campanha_publico_idade_min <=', $campanha_publico_idade_min);
        }

        if ($campanha_categoria != null) {
            $this->db->where('campanha_categoria', $campanha_categoria);
        }

        return $this->db->get('hs_campanhas')->result();
    }

    public function add_campanha($data)
    {
        return $this->db->insert('hs_campanhas', $data);
    }

    public function update_campanha($campanha_id, $data)
    {

        $this->db->where('id', $campanha_id);

        return $this->db->update('hs_campanhas', $data);
    }

    public function delete_campanha($campanha_id)
    {
        $this->db->where('id', $campanha_id);

        $data = array(
            'is_deleted' => 1
        );

        return $this->db->update('hs_campanhas', $data);
    }
    // Campanhas

    // Banners

    public function get_banners_by_campanha($campanha_id)
    {
        $this->db->where("banner_campanha_id", $campanha_id);
        $this->db->where('is_deleted', 0);
        return $this->db->get('hs_campanhas_banners')->result();
    }

    public function get_banner($banner_id)
    {
        $this->db->where('is_deleted', 0);
        $this->db->where('id', $banner_id);
        return $this->db->get('hs_campanhas_banners')->row_array();
    }

    public function check_banner_existe($banner_campanha_id, $banner_tipo)
    {

        $this->db->where('banner_campanha_id', $banner_campanha_id);
        $this->db->where('banner_tipo', $banner_tipo);

        if ($this->db->get('hs_campanhas_banners')->row_array()) {
            return $this->db->get('hs_campanhas_banners')->row_array();
        } else {
            return false;
        }
    }

    public function add_banner($data)
    {
        return $this->db->insert('hs_campanhas_banners', $data);
    }

    public function update_banner($banner_id, $data)
    {
        $this->db->where('id', $banner_id);
        return $this->db->update('hs_campanhas_banners', $data);
    }

    public function delete_banner($banner_id)
    {

        $this->db->where('id', $banner_id);

        $data = array(
            'is_deleted' => 1
        );

        return $this->db->update('hs_campanhas_banners', $data);
    }

    // Banners


    // Targets

    public function add_target($data) {
        return $this->db->insert('hs_campanhas_targets', $data);
    }

    public function get_target($target_id) {
        $this->db->where('is_deleted', 0 );
        $this->db->where('id', $target_id);
        return $this->db->get('hs_campanhas_targets')->row_array();
    }

    public function get_targets() {
        $this->db->where('is_deleted', 0 );
        $this->db->order_by('id','desc');

        return $this->db->get('hs_campanhas_targets')->result();
    }

    public function get_targets_search($target_nome = null, $target_url = null, $target_categoria = null, $target_publico_sexo = null, $target_publico_idade_max = null, $target_publico_idade_min = null) {
        $this->db->where('is_deleted', 0 );

        if ($target_nome != null) {
            $this->db->where('target_nome', $target_nome);
        }

        if ($target_url != null) {
            $this->db->where('target_url', $target_url);
        }

        if ($target_categoria != null) {
            $this->db->where('target_categoria', $target_categoria);
        }

        if ($target_publico_sexo != null) {
            $this->db->where('target_publico_sexo', $target_publico_sexo);
        }
        if ($target_publico_idade_max != null) {
            $this->db->where('target_publico_idade_max >=', $target_publico_idade_max);
        }

        if ($target_publico_idade_min != null) {
            $this->db->where('target_publico_idade_min <=', $target_publico_idade_min);
        }


        return $this->db->get('hs_campanhas_targets')->result();
    }

    public function update_target($target_id, $data) {
        $this->db->where('id', $target_id) ;
        return $this->db->update('hs_campanhas_targets', $data);
    }

    public function delete_target($target_id) {
        $this->db->where('id', $target_id) ;

        $data = array(
            'is_deleted' => 1
        );
        return $this->db->update('hs_campanhas_targets', $data);
    }

    // Targets


    public function add_categoria($data) {
        return $this->db->insert('hs_campanhas_categorias', $data);
    }

    public function get_categoria($categoria_id) {
        $this->db->where('is_deleted', 0 );
        $this->db->where('id', $categoria_id);
        return $this->db->get('hs_campanhas_categorias')->row_array();
    }

    public function get_categorias() {
        $this->db->where('is_deleted', 0 );
        $this->db->order_by('id','desc');

        return $this->db->get('hs_campanhas_categorias')->result();
    }

    public function update_categoria($categoria_id, $data) {
        $this->db->where('id', $categoria_id) ;
        return $this->db->update('hs_campanhas_categorias', $data);
    }

    public function delete_categoria($categoria_id) {
        $this->db->where('id', $categoria_id) ;

        $data = array(
            'is_deleted' => 1
        );
        return $this->db->update('hs_campanhas_categorias', $data);
    }

    // Links
    public function get_links_by_campanha($campanha_id)
    {
        $this->db->where('link_campanha_id', $campanha_id);
        return $this->db->get('hs_campanhas_links')->result();
    }

    public function check_link($campanha_id, $type)
    {

        $this->db->where('campanha_id', $campanha_id);
        $this->db->where('type', $type);
        return $this->db->get('hs_campanhas_links')->row_array();
    }

    public function add_link($data)
    {

      
        return $this->db->insert('hs_campanhas_links', $data);
    }
    // Links

    // Produtos

    public function get_produto($produto_id) {
        $this->db->where('is_deleted', 0 );
        $this->db->where('id', $produto_id);
        return $this->db->get('hs_campanhas_produtos')->row_array();
    }

    public function get_produtos() {
        $this->db->where('is_deleted', 0 );
        $this->db->order_by('id','desc');

        return $this->db->get('hs_campanhas_produtos')->result();
    }


    public function add_produto($data) {
        return $this->db->insert('hs_campanhas_produtos', $data);
    }

    public function update_produto($produto_id , $data) {
        $this->db->where('id', $produto_id) ;
        return $this->db->update('hs_campanhas_produtos', $data);
    }

    public function delete_produto($produto_id) {
        $this->db->where('id', $produto_id) ;

        $data = array(
            'is_deleted' => 1
        );
        return $this->db->update('hs_campanhas_produtos', $data);
    }
    // Produtos


    // Vendas
    public function get_vendas_by_campanha($campanha_id, $tipo = null)
    {

        if ($tipo != null) {
            $this->db->where('tipo', $tipo);
        }

        $this->db->where('campanha_id', $campanha_id);
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'desc');

        return $this->db->get('hs_campanha_vendas')->result();
    }

    public function add_venda($campanha_id, $produto_id, $lead_id, $data,  $valor, $provedor, $provedor_venda_id, $tipo)
    {


        $data = array(
            'campanha_id' => $campanha_id,
            'produto_id' => $produto_id,
            'lead_id' => $lead_id,
            'data' => $data,
            'valor' => $valor,
            'provedor' => $provedor,
            'tipo' => $tipo,

            'provedor_venda_id' =>  $provedor_venda_id,
            'is_deleted' => 0,
        );

        return $this->db->insert('hs_campanha_vendas', $data);
    }

    public function update_venda($id, $lead_id, $data, $valor, $provedor, $venda_id)
    {

        $this->db->where('id', $id);

        $data = array(

            'lead_id' => $lead_id,
            'data' => $data,
            'valor' => $valor,
            'provedor' => $provedor,
            'provedor_venda_id', $venda_id,

        );

        return $this->db->update('hs_campanha_vendas', $data);
    }

    public function delete_venda($id)
    {
        $this->db->where('id', $id);

        $data = array(
            'is_deleted' => 1
        );

        return $this->db->update('hs_campanha_vendas', $data);
    }


    // Vendas

    // Hassio
}
