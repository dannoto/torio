<?php
defined('BASEPATH') or exit('No direct script access allowed');

class api_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
    }


    public function get_tarefas_ativas()
    {
        $this->db->where('tarefa_status', 0);
        $this->db->where('is_deleted', 0);

        return $this->db->get('tarefas')->result();
    }

    public function update_tarefa_status($tarefa_id, $tarefa_status)
    {

        $this->db->where('id', $tarefa_id);

        $data = array(
            'tarefa_status' => $tarefa_status
        );

        return $this->db->update('tarefas', $data);
    }

    public function update_agente_banido($agente_id, $agente_data)
    {

        $this->db->where('id', $agente_id);
        return $this->db->update('agentes', $agente_data);
    }
    public function update_agente_ocupado($agente_id, $agente_data)
    {

        $this->db->where('id', $agente_id);
        return $this->db->update('agentes', $agente_data);
    }

    public function check_lead_demanda($username, $post_id, $tarefa_id, $tag_id)
    {

        $this->db->where('username', $username);
        $this->db->where('tarefa_id', $tarefa_id);
        $this->db->where('tag_id', $tag_id);
        $this->db->where('post_id', $post_id);

        return $this->db->get('demandas')->row_array();
    }

    public function add_instalead_demanda($data)
    {
        return $this->db->insert('demandas', $data);
    }


    public function get_campanhas_ativas()
    {

        $this->db->where('campanha_status', 1);
        $this->db->where('is_deleted', 0);
        $this->db->order_by('RAND()');
        return $this->db->get('campanhas')->result();
    }

    public function count_agentes_oferta($agente_id)
    {
        $this->db->where('oferta_agente_id', $agente_id);
        $this->db->like('oferta_data', date('Y-m-d'));
        // $this->db->where('oferta_status', 1);

        $this->db->where('is_deleted', 0);
        return $this->db->get('ofertas')->result();
    }

    public function get_templates_oferta($campanha_id)
    {
        $this->db->where('oferta_campanha_id', $campanha_id);
        $this->db->where('is_deleted', 0);
        return $this->db->get('campanhas_ofertas')->result();
    }

  

    public function dash_get_oferta_concluidas_by_campanha($campanha_id)
    {
        $this->db->where('oferta_campanha_id', $campanha_id);
        // $this->db->like('oferta_data', date('Y-m-d'));
        // $this->db->where('oferta_status', 1);
        $this->db->where('oferta_status', 1);

        $this->db->where('is_deleted', 0);
        return $this->db->get('ofertas')->result();
    }


    public function dash_get_demandas_abertas($campanha_tag_id)
    {

        $this->db->where('tag_id', $campanha_tag_id);

        // $this->db->order_by('RAND()');
        $this->db->where('processado', 0);
        $this->db->where('is_deleted', 0);

        // $this->db->limit(50);
        return $this->db->get('demandas')->result();
    }



    public function get_demandas_abertas($campanha_tag_id)
    {

        $this->db->where('tag_id', $campanha_tag_id);

        $this->db->order_by('RAND()');
        $this->db->where('processado', 0);
        $this->db->where('is_deleted', 0);

        $this->db->limit(3000);
        return $this->db->get('demandas')->result();
    }

    
    public function add_clique_log($clique_ip, $total_repeticoes){

        $data = array(
            'clique_ip' => $clique_ip,
            'total_repeticoes' => $total_repeticoes
        );

        return $this->db->insert('cliques_log', $data);

    }

    public function get_agentes_livres()
    {

        $this->db->where('agente_ocupado', 0);
        $this->db->where('agente_status', 1);
        $this->db->where('is_deleted', 0);

        return $this->db->get('agentes')->result();
    }


    public function get_campanha_ofertas($campanha_id)
    {
        $this->db->where('oferta_campanha_id', $campanha_id);
        $this->db->where('is_delete', 0);
        return $this->db->get('campanhas_ofertas')->result();
    }


    public function add_oferta($oferta_data)
    {
        return $this->db->insert('ofertas', $oferta_data);
    }

    public function criar_oferta_pendente($oferta_data)
    {
        $this->db->insert('ofertas', $oferta_data);
        return $this->db->insert_id();
    }
    public function update_oferta($oferta_id, $oferta_data)
    {
        $this->db->where('id', $oferta_id);
        return $this->db->update('ofertas', $oferta_data);
    }


    public function get_ofertas()
    {
        $this->db->where('is_delete', 0);
        return $this->db->get('ofertas')->result();
    }

    public function get_sms_ofertas_pendentes()
    {
        $this->db->where('oferta_status', 0);
        $this->db->where('oferta_tipo', 'sms');
        $this->db->where('is_deleted', 0);

        return $this->db->get('ofertas')->result();
    }

    public function get_ofertas_pendentes($agente_id)
    {
        $this->db->where('oferta_agente_id', $agente_id);
        $this->db->where('oferta_data !=', date('Y-m-d'));
        $this->db->where('oferta_status', 0);
        $this->db->where('is_deleted', 0);
        return $this->db->get('ofertas')->result();
    }

    public function get_oferta($oferta_id)
    {
        $this->db->where('id', $oferta_id);
        return $this->db->get('ofertas')->row_array();
    }


    // ==========


    public function add_persona($persona_data)
    {
        $this->db->insert('personas', $persona_data);
        return $this->db->insert_id();
    }

    public function update_persona($persona_id, $persona_data)
    {
        $this->db->where('id', $persona_id);
        return $this->db->update('personas', $persona_data);
      
    }

    public function check_persona($persona_username)
    {
        $this->db->where('persona_username', $persona_username);
        $this->db->where('is_deleted', 0);
        $data =  $this->db->get('personas')->row();

        if ($data) {
            return $data->id;
        } else {
            return false;
        }
    }

    public function add_persona_tag($persona_data)
    {
        return $this->db->insert('personas_tags', $persona_data);
    }

    public function check_persona_tag($persona_username, $persona_tag_id)
    {

        $this->db->where('persona_username', $persona_username);
        $this->db->where('persona_tag_id', $persona_tag_id);

        $this->db->where('is_deleted', 0);

        return $this->db->get('personas_tags')->row();
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

        return $this->db->update('demandas', $data);
    }


    public function update_demanda($demanda_id, $demanda_data)
    {

        $this->db->where('id', $demanda_id);
        return $this->db->update('demandas', $demanda_data);
    }



    public function add_instalead($data)
    {
        return $this->db->insert('insta_leads', $data);
    }


    public function off_get_oferta_by_key($oferta_key)
    {
        $this->db->where('oferta_key', $oferta_key);
        return $this->db->get('ofertas')->row_array();
    }

    public function off_get_produto($produto_id)
    {
        $this->db->where('id', $produto_id);
        return $this->db->get('produtos')->row_array();
    }

    public function off_add_clique($clique_data)
    {
        return $this->db->insert('cliques', $clique_data);
    }

    public function get_agente($agente_email)
    {

        $this->db->where('agente_email', $agente_email);
        return $this->db->get('agentes')->row_array();
    }

    public function add_agente($data)
    {
        return $this->db->insert('agentes',$data);
    }
}
