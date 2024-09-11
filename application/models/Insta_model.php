<?php
defined('BASEPATH') or exit('No direct script access allowed');

class insta_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
    }



    public function get_tarefas_ativas()
    {
        $this->db->where('tarefa_status', 1);
        $this->db->where('is_deleted', 0);

        return $this->db->get('persona_tarefas')->result();
    }

    public function get_headers()
    {
        $this->db->where('agente_status', 1);
        return $this->db->get('persona_tarefas_agentes')->result();
    }


    // testando2
    public function get_tarefas_leads($task_id)
    {

        $this->db->where('tarefa_id', $task_id);

        $this->db->group_start();
        $this->db->where('email IS NOT NULL AND email !=', '');
        $this->db->or_group_start();
        $this->db->where('telefone IS NOT NULL', NULL, FALSE);
        $this->db->where("LENGTH(telefone) = '13'", NULL, FALSE);
        $this->db->where("telefone LIKE '55%'", NULL, FALSE);

        $this->db->where('inapto', 0);
        $this->db->where('convertido', 0);

        $this->db->group_end();
        $this->db->or_where('links IS NOT NULL AND links !=', '');
        $this->db->or_where('mencoes IS NOT NULL AND mencoes !=', '');
        $this->db->group_end();

        $this->db->order_by('convertido', 'asc');

        return $this->db->get('insta_leads')->result();
    }


    public function get_tarefas_finalizadas()
    {
        $this->db->where('tarefa_status', 3);
        $this->db->where('is_deleted', 0);

        return $this->db->get('persona_tarefas')->result();
    }

    public function update_tarefa_status($tarefa_id, $tarefa_status)
    {
        // 3 processando
        // 4 - finalizado

        $this->db->where('id', $tarefa_id);

        $data = array(
            'tarefa_status' => $tarefa_status
        );

        return $this->db->update('persona_tarefas', $data);
    }

    public function check_lead($username, $tarefa_id, $tag_id)
    {

        $this->db->where('username', $username);
        $this->db->where('tarefa_id', $tarefa_id);
        $this->db->where('tag_id', $tag_id);

        return $this->db->get('insta_leads')->row_array();
    }

    public function get_demandas_pendentes()
    {
        $this->db->where('processado', 0);
        $this->db->order_by('id', 'rand');
        return $this->db->get('insta_leads_demandas')->result();
    }

    public function update_demanda_offline($demanda_id)
    {
        
        $this->db->where('id', $demanda_id);

        $data = array(
            'processado' => 2
        );

        return $this->db->update('insta_leads_demandas', $data);
    }

    public function update_demanda_pendente($demanda_id)
    {
        
        $this->db->where('id', $demanda_id);

        $data = array(
            'processado' => 1
        );

        return $this->db->update('insta_leads_demandas', $data);
    }

    public function check_lead_demanda($username, $post_id, $tarefa_id, $tag_id)
    {

        $this->db->where('username', $username);
        $this->db->where('tarefa_id', $tarefa_id);
        $this->db->where('tag_id', $tag_id);
        $this->db->where('post_id', $post_id);

        return $this->db->get('insta_leads_demandas')->row_array();
    }

    public function add_instalead_demanda($data)
    {
        return $this->db->insert('insta_leads_demandas', $data);
    }

    public function add_instalead($data)
    {
        return $this->db->insert('insta_leads', $data);
    }
}
