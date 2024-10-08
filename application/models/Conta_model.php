<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Conta_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // FUNCTIONS

    function formatar_data($date)
    {
        $dateTime = new DateTime($date);
        return $dateTime->format('d-m-Y');
    }

    // FUNCTIONS

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


    // CAMPANHA
    public function add_campanha($campanha_data)
    {
        return $this->db->insert('campanhas', $campanha_data);
    }

    public function get_campanha($campanha_id)
    {
        $this->db->where('id', $campanha_id);
        return $this->db->get('campanhas')->row();
    }

    public function get_campanhas($limit = null, $start = null)
    {
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        return $this->db->get('campanhas')->result();
    }

    public function count_campanhas()
    {
        $this->db->where('is_deleted', 0);
        return count($this->db->get('campanhas')->result());
    }

    public function get_search_campanhas($f_data, $limit, $start)
    {
        if (strlen($f_data['campanha_interacao_tipo']) > 0) {
            $this->db->where('campanha_status', $f_data['campanha_interacao_tipo']);
        }


        if (strlen($f_data['campanha_tag_id']) > 0) {
            $this->db->where('campanha_tag_id', $f_data['campanha_tag_id']);
        }



        $this->db->limit($limit, $start);
        $this->db->where('is_deleted', 0);

        return $this->db->get('campanhas')->result();
    }

    public function count_search_campanhas($f_data)
    {


        if (strlen($f_data['campanha_interacao_tipo']) > 0) {
            $this->db->where('campanha_status', $f_data['campanha_interacao_tipo']);
        }


        if (strlen($f_data['campanha_tag_id']) > 0) {
            $this->db->where('campanha_tag_id', $f_data['campanha_tag_id']);
        }

        $this->db->where('is_deleted', 0);


        return count($this->db->get('campanhas')->result());
    }

    public function update_campanha($campanha_id, $campanha_data)
    {
        $this->db->where('id', $campanha_id);

        return $this->db->update('campanhas', $campanha_data);
    }

    public function delete_campanha($campanha_id)
    {
        $this->db->where('id', $campanha_id);
        $campanha_data = array(
            'is_deleted' => 1
        );
        return $this->db->update('campanhas', $campanha_data);
    }

    public function check_campanha($nome)
    {

        $this->db->where('nome', $nome);
        $this->db->where('is_deleted', 0);

        return $this->db->get('campanhas')->result();
    }

    // CAMPANHA


    // CAMPANHA
    public function add_campanhas_ofertas($campanhas_ofertas_data)
    {
        return $this->db->insert('campanhas_ofertas', $campanhas_ofertas_data);
    }

    public function get_campanha_ofertas($campanhas_ofertas_id)
    {
        $this->db->where('id', $campanhas_ofertas_id);
        return $this->db->get('campanhas_ofertas')->row();
    }

    public function get_campanhas_ofertas($campanhas_ofertas_id, $limit = null, $start = null)
    {
        $this->db->where('is_deleted', 0);
        $this->db->where('oferta_campanha_id', $campanhas_ofertas_id);

        $this->db->order_by('id', 'desc');
        //   $this->db->limit($limit, $start);
        return $this->db->get('campanhas_ofertas')->result();
    }

    public function count_campanhas_ofertas($campanhas_ofertas_id)
    {
        $this->db->where('is_deleted', 0);
        $this->db->where('oferta_campanha_id', $campanhas_ofertas_id);

        return count($this->db->get('campanhas_ofertas')->result());
    }

    public function get_search_campanhas_ofertas($campanhas_ofertas_id, $f_data, $limit, $start)
    {
        //   if (strlen($f_data['campanhas_ofertas_interacao_tipo']) > 0) {
        //       $this->db->where('campanhas_ofertas_status', $f_data['campanhas_ofertas_interacao_tipo']);
        //   }


        //   if (strlen($f_data['campanhas_ofertas_tag_id']) > 0) {
        //       $this->db->where('campanhas_ofertas_tag_id', $f_data['campanhas_ofertas_tag_id']);
        //   }

        $this->db->where('oferta_campanha_id', $campanhas_ofertas_id);


        $this->db->limit($limit, $start);
        $this->db->where('is_deleted', 0);

        return $this->db->get('campanhas_ofertas')->result();
    }

    public function count_search_campanhas_ofertas($campanhas_ofertas_id, $f_data)
    {


        //   if (strlen($f_data['campanhas_ofertas_interacao_tipo']) > 0) {
        //       $this->db->where('campanhas_ofertas_status', $f_data['campanhas_ofertas_interacao_tipo']);
        //   }


        //   if (strlen($f_data['campanhas_ofertas_tag_id']) > 0) {
        //       $this->db->where('campanhas_ofertas_tag_id', $f_data['campanhas_ofertas_tag_id']);
        //   }
        $this->db->where('oferta_campanha_id', $campanhas_ofertas_id);


        $this->db->where('is_deleted', 0);


        return count($this->db->get('campanhas_ofertas')->result());
    }

    public function update_campanhas_ofertas($campanhas_ofertas_id, $campanhas_ofertas_data)
    {
        $this->db->where('id', $campanhas_ofertas_id);

        return $this->db->update('campanhas_ofertas', $campanhas_ofertas_data);
    }

    public function delete_campanhas_ofertas($campanhas_ofertas_id)
    {
        $this->db->where('id', $campanhas_ofertas_id);
        $campanhas_ofertas_data = array(
            'is_deleted' => 1
        );
        return $this->db->update('campanhas_ofertas', $campanhas_ofertas_data);
    }

    public function check_campanhas_ofertas($nome)
    {

        $this->db->where('nome', $nome);
        $this->db->where('is_deleted', 0);

        return $this->db->get('campanhas_ofertas')->result();
    }

    // CAMPANHA




    // OFERTA
    public function add_oferta($oferta_data)
    {
        return $this->db->insert('ofertas', $oferta_data);
    }

    public function get_oferta($oferta_id)
    {
        $this->db->where('id', $oferta_id);
        return $this->db->get('ofertas')->row();
    }

    public function get_ofertas($limit = null, $start = null)
    {
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        return $this->db->get('ofertas')->result();
    }

    public function count_ofertas()
    {
        $this->db->where('is_deleted', 0);
        return count($this->db->get('ofertas')->result());
    }

    public function get_search_ofertas($f_data, $limit, $start)
    {

        if (strlen($f_data['nome']) > 0) {
            $this->db->like('nome', $f_data['nome']);
        }



        $this->db->limit($limit, $start);
        $this->db->where('is_deleted', 0);

        return $this->db->get('ofertas')->result();
    }

    public function count_search_ofertas($f_data)
    {


        if (strlen($f_data['nome']) > 0) {
            $this->db->like('nome', $f_data['nome']);
        }

        $this->db->where('is_deleted', 0);


        return count($this->db->get('ofertas')->result());
    }

    public function update_oferta($oferta_id, $oferta_data)
    {
        $this->db->where('id', $oferta_id);

        return $this->db->update('ofertas', $oferta_data);
    }

    public function delete_oferta($oferta_id)
    {
        $this->db->where('id', $oferta_id);
        $oferta_data = array(
            'is_deleted' => 1
        );
        return $this->db->update('ofertas', $oferta_data);
    }

    public function check_oferta($nome)
    {

        $this->db->where('nome', $nome);
        $this->db->where('is_deleted', 0);

        return $this->db->get('ofertas')->result();
    }

    // OFERTA






    // DASHBOARD

    public function report_get_ofertas_today()
    {

        $this->db->where('oferta_data', date('Y-m-d'));
        $this->db->where('oferta_status', 1);
        return $this->db->get('ofertas')->result();
    }

    public function report_get_cliques_today()
    {
        // Filtra os registros pela data de hoje
        $this->db->like('clique_data_id', date('Y-m-d'));

        // Exclui registros onde o user agent seja 'facebookexternalhit/1.1'
        $this->db->where('clique_user_agent !=', "facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)");

        // Exclui registros onde o user agent contenha a palavra 'google'
        $this->db->not_like('clique_user_agent', 'google');

        // Executa a consulta e retorna os resultados
        return $this->db->get('cliques')->result();
    }

    public function report_get_vendas_today()
    {

        $this->db->like('venda_data', date('Y-m-d'));
        return $this->db->get('vendas')->result();
    }

    public function report_get_faturamento_today()
    {

        $this->db->like('venda_data', date('Y-m-d'));
        $vendas =  $this->db->get('vendas')->result();

        $total = 0;

        foreach ($vendas as $v) {

            $total = ($total + $v->venda_valor);
        }

        return round($total, 2);
    }

    public function report_get_ofertas_month()
    {

        $this->db->like('oferta_data', date('Y-m'));
        $this->db->where('oferta_status', 1);
        return $this->db->get('ofertas')->result();
    }

    public function report_get_cliques_month()
    {

        $this->db->like('clique_data_id', date('Y-m'));
        // Exclui registros onde o user agent seja 'facebookexternalhit/1.1'
        $this->db->where('clique_user_agent !=', "facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)");

        // Exclui registros onde o user agent contenha a palavra 'google'
        $this->db->not_like('clique_user_agent', 'google');

        // Executa a consulta e retorna os resultados
        return $this->db->get('cliques')->result();
    }

    public function report_get_vendas_month()
    {

        $this->db->like('venda_data', date('Y-m'));
        return $this->db->get('vendas')->result();
    }

    public function report_get_faturamento_month()
    {

        $this->db->like('venda_data', date('Y-m'));
        $vendas =  $this->db->get('vendas')->result();

        $total = 0;

        foreach ($vendas as $v) {

            $total = ($total + $v->venda_valor);
        }

        return round($total, 2);
    }

    // DASHBOARD    




    // leads
    public function get_campanhas_leads($campanha_tag_id, $limit = null, $start = null)
    {
        $this->db->where('is_deleted', 0);
        $this->db->where('persona_tag_id', $campanha_tag_id);
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        return $this->db->get('personas_tags')->result();
    }

    public function count_campanhas_leads($campanha_tag_id)
    {
        $this->db->where('is_deleted', 0);
        $this->db->where('persona_tag_id', $campanha_tag_id);

        return count($this->db->get('personas_tags')->result());
    }

    public function get_template($template_id)
    {

        $this->db->where('id', $template_id);
        $this->db->where('is_deleted', 0);

        return $this->db->get('campanhas_ofertas')->row();
    }


    // leads


    public function check_oferta_enviada($oferta_campanha_id, $oferta_produto_id, $oferta_tag_id, $oferta_tipo, $oferta_persona_id)
    {

        $this->db->where('oferta_persona_id', $oferta_persona_id);
        $this->db->where('oferta_campanha_id', $oferta_campanha_id);
        $this->db->where('oferta_produto_id', $oferta_produto_id);
        $this->db->where('oferta_tag_id', $oferta_tag_id);
        $this->db->where('oferta_tipo', $oferta_tipo);
        // $this->db->where('oferta_status', 0);
        // $this->db->where('oferta_status', 1);

        // $campanha->id, $campanha->campanha_produto_id, $campanha->campanha_tag_id, 'sms', $persona->id

        return $this->db->get('ofertas')->row();
    }

    public function count_sms_template_by_campanha($campanha_id)
    {

        $this->db->where('oferta_campanha_id', $campanha_id);
        $this->db->where('oferta_tipo', 'sms');
        $this->db->where('is_deleted', 0);

        return $this->db->get('campanhas_ofertas')->result();
    }

    public function get_sms_template_by_campanha($campanha_id)
    {


        $this->db->where('oferta_campanha_id', $campanha_id);
        $this->db->where('oferta_tipo', 'sms');

        $this->db->order_by('RAND()');
        $this->db->where('is_deleted', 0);

        $this->db->limit(1);

        return $this->db->get('campanhas_ofertas')->result();
    }



    // PERSONAS
    public function add_persona($persona_data)
    {
        return $this->db->insert('personas', $persona_data);
    }

    public function get_persona($persona_id)
    {
        $this->db->where('id', $persona_id);
        return $this->db->get('personas')->row();
    }

    public function get_personas($limit = null, $start = null)
    {
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        return $this->db->get('personas')->result();
    }

    public function count_personas()
    {
        $this->db->where('is_deleted', 0);
        return count($this->db->get('personas')->result());
    }

    public function get_search_personas($f_data, $limit, $start)
    {

        if (strlen($f_data['persona_nome']) > 0) {
            $this->db->like('persona_nome', $f_data['persona_nome']);
        }

        $this->db->limit($limit, $start);
        $this->db->where('is_deleted', 0);

        return $this->db->get('personas')->result();
    }

    public function count_search_personas($f_data)
    {

        if (strlen($f_data['persona_nome']) > 0) {
            $this->db->like('persona_nome', $f_data['persona_nome']);
        }
        $this->db->where('is_deleted', 0);


        return count($this->db->get('personas')->result());
    }

    public function update_persona($persona_id, $persona_data)
    {
        $this->db->where('id', $persona_id);

        return $this->db->update('personas', $persona_data);
    }

    public function delete_persona($persona_id)
    {
        $this->db->where('id', $persona_id);
        $persona_data = array(
            'is_deleted' => 1
        );
        return $this->db->update('personas', $persona_data);
    }

    public function check_persona($persona_name)
    {

        $this->db->where('persona_name', $persona_name);
        $this->db->where('is_deleted', 0);

        return $this->db->get('personas')->result();
    }

    // PERSONAS


    // CLIQUES
    public function add_clique($clique_data)
    {
        return $this->db->insert('cliques', $clique_data);
    }

    public function get_clique($clique_id)
    {
        $this->db->where('id', $clique_id);
        return $this->db->get('cliques')->row();
    }

    public function get_cliques($limit = null, $start = null)
    {
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'desc');

        $this->db->where('clique_user_agent !=', "facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)");
        $this->db->not_like('clique_user_agent', 'google');

        $this->db->limit($limit, $start);
        return $this->db->get('cliques')->result();
    }

    public function count_cliques()
    {
        $this->db->where('is_deleted', 0);

        $this->db->where('clique_user_agent !=', "facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)");
        $this->db->not_like('clique_user_agent', 'google');

        return count($this->db->get('cliques')->result());
    }

    public function get_search_cliques($f_data, $limit, $start)
    {

        if (strlen($f_data['clique_nome']) > 0) {
            $this->db->like('clique_nome', $f_data['clique_nome']);
        }

        $this->db->where('clique_user_agent !=', "facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)");
        $this->db->not_like('clique_user_agent', 'google');

        $this->db->limit($limit, $start);
        $this->db->where('is_deleted', 0);

        return $this->db->get('cliques')->result();
    }

    public function count_search_cliques($f_data)
    {

        if (strlen($f_data['clique_nome']) > 0) {
            $this->db->like('clique_nome', $f_data['clique_nome']);
        }

        $this->db->where('clique_user_agent !=', "facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)");
        $this->db->not_like('clique_user_agent', 'google');

        $this->db->where('is_deleted', 0);


        return count($this->db->get('cliques')->result());
    }

    public function update_clique($clique_id, $clique_data)
    {
        $this->db->where('id', $clique_id);

        return $this->db->update('cliques', $clique_data);
    }

    public function delete_clique($clique_id)
    {
        $this->db->where('id', $clique_id);
        $clique_data = array(
            'is_deleted' => 1
        );
        return $this->db->update('cliques', $clique_data);
    }

    public function check_clique($clique_name)
    {

        $this->db->where('clique_name', $clique_name);
        $this->db->where('is_deleted', 0);

        return $this->db->get('cliques')->result();
    }

    // CLIQUES




    // Função para buscar todos os cliques ordenados por ID de forma decrescente
    public function get_all_cliques()
    {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('cliques');
        return $query->result();
    }

    public function index() {}

    // Função para deletar registros com o mesmo IP, mantendo o mais recente
    public function delete_duplicate_ips()
    {




        // Seleciona os IPs duplicados
        $duplicate_ips = $this->db->query("SELECT clique_ip, COUNT(*) as total_repeticoes FROM cliques GROUP BY clique_ip HAVING COUNT(*) > 2 ORDER BY `total_repeticoes` DESC;")->result();

        // return $duplicate_ips;



        if (count($duplicate_ips) > 0) {

            // echo count($duplicate_ips) . " ips duplicados;";

            foreach ($duplicate_ips as $ip) {

                // print($ip);
                // Mantém apenas o primeiro registro e deleta os duplicados
                $D = $this->db->query("DELETE FROM `cliques` WHERE clique_ip = '" . $ip->clique_ip . "'");

                if ($D) {
                    echo "EXCLUIDO " . $ip->clique_ip . "<br>";
                    $this->api_model->add_clique_log($ip->clique_ip, $ip->total_repeticoes);
                } else {
                    echo "ERRO AO EXCLUIR " . $ip->clique_ip . "<br>";
                    // $this->api_model->add_clique_log('-');

                }
            }

            return count($duplicate_ips) . " ips duplicados;";

        } else {
            // echo "nenhum ip duplicado;";

            return "nenhum ip duplicado;";
        }


        // return true; // Retorna true após a exclusão
    }

}
