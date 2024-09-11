<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Conta_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // TAGS
    public function add_tag($tag_data)
    {
        return $this->db->insert('tags', $tag_data);
    }

    public function get_tag($tag_id)
    {
        $this->db->where('id', $tag_id);
        return $this->db->get('tags')->row();
    }

    public function get_tags($limit = null, $start = null)
    {
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        return $this->db->get('tags')->result();
    }

    public function count_tags()
    {
        $this->db->where('is_deleted', 0);
        return count($this->db->get('tags')->result());
    }

    public function get_search_tags($f_data, $limit, $start)
    {

        if (strlen($f_data['tag_name']) > 0) {
            $this->db->like('tag_name', $f_data['tag_name']);
        }

        $this->db->limit($limit, $start);
        $this->db->where('is_deleted', 0);

        return $this->db->get('tags')->result();
    }

    public function count_search_tags($f_data)
    {

        if (strlen($f_data['tag_name']) > 0) {
            $this->db->like('tag_name', $f_data['tag_name']);
        }
        $this->db->where('is_deleted', 0);


        return count($this->db->get('tags')->result());
    }

    public function update_tag($tag_id, $tag_data)
    {
        $this->db->where('id', $tag_id);

        return $this->db->update('tags', $tag_data);
    }

    public function delete_tag($tag_id)
    {
        $this->db->where('id', $tag_id);
        $tag_data = array(
            'is_deleted' => 1
        );
        return $this->db->update('tags', $tag_data);
    }

    public function check_tag($tag_name)
    {

        $this->db->where('tag_name', $tag_name);
        $this->db->where('is_deleted', 0);

        return $this->db->get('tags')->result();
    }

    // TAGS

    // TAREFAS
    public function add_tarefa($tarefa_data)
    {
        return $this->db->insert('tarefas', $tarefa_data);
    }

    public function get_tarefa($tarefa_id)
    {
        $this->db->where('id', $tarefa_id);
        return $this->db->get('tarefas')->row();
    }

    public function get_tarefas($limit = null, $start = null)
    {
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        return $this->db->get('tarefas')->result();
    }

    public function count_tarefas()
    {
        $this->db->where('is_deleted', 0);
        return count($this->db->get('tarefas')->result());
    }

    public function get_search_tarefas($f_data, $limit, $start)
    {

        if (strlen($f_data['tarefa_nome']) > 0) {
            $this->db->like('tarefa_nome', $f_data['tarefa_nome']);
        }

        if (strlen($f_data['tarefa_status']) > 0) {
            $this->db->like('tarefa_status', $f_data['tarefa_status']);
        }

        $this->db->limit($limit, $start);
        $this->db->where('is_deleted', 0);

        return $this->db->get('tarefas')->result();
    }

    public function count_search_tarefas($f_data)
    {


        if (strlen($f_data['tarefa_nome']) > 0) {
            $this->db->like('tarefa_nome', $f_data['tarefa_nome']);
        }

        if (strlen($f_data['tarefa_status']) > 0) {
            $this->db->like('tarefa_status', $f_data['tarefa_status']);
        }

        $this->db->where('is_deleted', 0);


        return count($this->db->get('tarefas')->result());
    }

    public function update_tarefa($tarefa_id, $tarefa_data)
    {
        $this->db->where('id', $tarefa_id);

        return $this->db->update('tarefas', $tarefa_data);
    }

    public function delete_tarefa($tarefa_id)
    {
        $this->db->where('id', $tarefa_id);
        $tarefa_data = array(
            'is_deleted' => 1
        );
        return $this->db->update('tarefas', $tarefa_data);
    }

    public function check_tarefa($tarefa_url)
    {

        $this->db->where('tarefa_url', $tarefa_url);
        $this->db->where('is_deleted', 0);

        return $this->db->get('tarefas')->result();
    }

    // TAREFAS


    // PRODUTOS
    public function add_produto($produto_data)
    {
        return $this->db->insert('produtos', $produto_data);
    }

    public function get_produto($produto_id)
    {
        $this->db->where('id', $produto_id);
        return $this->db->get('produtos')->row();
    }

    public function get_produtos($limit = null, $start = null)
    {
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        return $this->db->get('produtos')->result();
    }

    public function count_produtos()
    {
        $this->db->where('is_deleted', 0);
        return count($this->db->get('produtos')->result());
    }

    public function get_search_produtos($f_data, $limit, $start)
    {

        if (strlen($f_data['nome']) > 0) {
            $this->db->like('nome', $f_data['nome']);
        }



        $this->db->limit($limit, $start);
        $this->db->where('is_deleted', 0);

        return $this->db->get('produtos')->result();
    }

    public function count_search_produtos($f_data)
    {


        if (strlen($f_data['nome']) > 0) {
            $this->db->like('nome', $f_data['nome']);
        }

        $this->db->where('is_deleted', 0);


        return count($this->db->get('produtos')->result());
    }

    public function update_produto($produto_id, $produto_data)
    {
        $this->db->where('id', $produto_id);

        return $this->db->update('produtos', $produto_data);
    }

    public function delete_produto($produto_id)
    {
        $this->db->where('id', $produto_id);
        $produto_data = array(
            'is_deleted' => 1
        );
        return $this->db->update('produtos', $produto_data);
    }

    public function check_produto($nome)
    {

        $this->db->where('nome', $nome);
        $this->db->where('is_deleted', 0);

        return $this->db->get('produtos')->result();
    }

    // PRODUTOS


    // AGENTES
    public function add_agente($agente_data)
    {
        return $this->db->insert('agentes', $agente_data);
    }

    public function get_agente($agente_id)
    {
        $this->db->where('id', $agente_id);
        return $this->db->get('agentes')->row();
    }

    public function get_agentes($limit = null, $start = null)
    {
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        return $this->db->get('agentes')->result();
    }

    public function count_agentes()
    {
        $this->db->where('is_deleted', 0);
        return count($this->db->get('agentes')->result());
    }

    public function get_search_agentes($f_data, $limit, $start)
    {

        if (strlen($f_data['agente_nome']) > 0) {
            $this->db->like('agente_nome', $f_data['agente_nome']);
        }


        if (strlen($f_data['agente_ocupado']) > 0) {
            $this->db->like('agente_ocupado', $f_data['agente_ocupado']);
        }



        $this->db->limit($limit, $start);
        $this->db->where('is_deleted', 0);

        return $this->db->get('agentes')->result();
    }

    public function count_search_agentes($f_data)
    {


        if (strlen($f_data['agente_nome']) > 0) {
            $this->db->like('agente_nome', $f_data['agente_nome']);
        }


        if (strlen($f_data['agente_ocupado']) > 0) {
            $this->db->like('agente_ocupado', $f_data['agente_ocupado']);
        }

        $this->db->where('is_deleted', 0);


        return count($this->db->get('agentes')->result());
    }

    public function update_agente($agente_id, $agente_data)
    {
        $this->db->where('id', $agente_id);

        return $this->db->update('agentes', $agente_data);
    }

    public function delete_agente($agente_id)
    {
        $this->db->where('id', $agente_id);
        $agente_data = array(
            'is_deleted' => 1
        );
        return $this->db->update('agentes', $agente_data);
    }

    public function check_agente($nome)
    {

        $this->db->where('nome', $nome);
        $this->db->where('is_deleted', 0);

        return $this->db->get('agentes')->result();
    }

    // AGENTES


    // DEMANDAS
    public function add_demanda($demanda_data)
    {
        return $this->db->insert('demandas', $demanda_data);
    }

    public function get_demanda($demanda_id)
    {
        $this->db->where('id', $demanda_id);
        return $this->db->get('demandas')->row();
    }

    public function get_demandas($limit = null, $start = null)
    {
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        return $this->db->get('demandas')->result();
    }

    public function count_demandas()
    {
        $this->db->where('is_deleted', 0);
        return count($this->db->get('demandas')->result());
    }

    public function get_search_demandas($f_data, $limit, $start)
    {

        if (strlen($f_data['interacao_tipo']) > 0) {
            $this->db->where('interacao_tipo', $f_data['interacao_tipo']);
        }


        if (strlen($f_data['tag_id']) > 0) {
            $this->db->where('tag_id', $f_data['tag_id']);
        }



        $this->db->limit($limit, $start);
        $this->db->where('is_deleted', 0);

        return $this->db->get('demandas')->result();
    }

    public function count_search_demandas($f_data)
    {


        if (strlen($f_data['interacao_tipo']) > 0) {
            $this->db->where('interacao_tipo', $f_data['interacao_tipo']);
        }


        if (strlen($f_data['tag_id']) > 0) {
            $this->db->where('tag_id', $f_data['tag_id']);
        }

        $this->db->where('is_deleted', 0);


        return count($this->db->get('demandas')->result());
    }

    public function update_demanda($demanda_id, $demanda_data)
    {
        $this->db->where('id', $demanda_id);

        return $this->db->update('demandas', $demanda_data);
    }

    public function delete_demanda($demanda_id)
    {
        $this->db->where('id', $demanda_id);
        $demanda_data = array(
            'is_deleted' => 1
        );
        return $this->db->update('demandas', $demanda_data);
    }

    public function check_demanda($nome)
    {

        $this->db->where('nome', $nome);
        $this->db->where('is_deleted', 0);

        return $this->db->get('demandas')->result();
    }

    // DEMANDAS

}
