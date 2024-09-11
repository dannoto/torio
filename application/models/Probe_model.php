

<?php


class probe_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_ofertas()
    {
        $this->db->where('oferta_status', 0);
        $this->db->where('is_deleted', 0);

        return $this->db->get('probe_ofertas')->result();
    }

    public function get_oferta($oferta_id)
    {
        $this->db->where('id', $oferta_id);
        // $this->db->where('oferta_status', 0);

        return $this->db->get('probe_ofertas')->row_array();
    }

    public function get_oferta_historico($oferta_id)
    {
        $this->db->where('id', $oferta_id);
        // $this->db->where('oferta_status', 0);

        return $this->db->get('probe_ofertas_historico')->row_array();
    }

    public function get_agentes()
    {
        return $this->db->get('probe_agentes')->result();
    }

    public function get_agente($agente_id)
    {
        $this->db->where('id', $agente_id);

        return $this->db->get('probe_agentes')->row_array();
    }

    public function check_envios_qtd($oferta_agente, $oferta_id) {

        // $this->db->select('COUNT(*) as qtd');
        // $this->db->from('probe_ofertas_historico');
        $this->db->where('oferta_agente', $oferta_agente); // Replace $lead_id with the actual lead ID you're searching for
        $this->db->where('oferta_id', $oferta_id);
        $this->db->like('oferta_data', date('Y-m-d')); // Replace $oferta_id with the actual oferta ID you're searching for

        return count( $this->db->get('probe_ofertas_historico')->result() );
        // $query = $this->db->get();
        // $result = $query->row();
  
        // // $qrt = $result->qrt; // This will hold the count of matching records
        // return $result;

    }

    public function get_lead($lead_id) {
        $this->db->where('id', $lead_id);
        return $this->db->get('probe_leads')->row_array();
    }

    public function get_leads($oferta_id,  $limite, $publico_id) {
        
        // $limite = 10; // Defina o limite de busca como desejar
        // $oferta_id = 123; // Substitua pelo ID da oferta que deseja verificar
        $this->db->select('l.id, l.nome, l.telefone');
        $this->db->from('leads l');
        $this->db->join('probe_ofertas_historico oh', 'l.id = oh.lead_id AND oh.oferta_id = '.$oferta_id.'', 'left');
        $this->db->where('l.publico_id', $publico_id);
        $this->db->where('CHAR_LENGTH(l.telefone) = 13'); // Filter leads with telefone having 13 characters
        $this->db->where('oh.lead_id IS NULL', null, false); // Filter leads that don't have entries in probe_ofertas_historico
        $this->db->limit($limite);
        
        $query = $this->db->get()->result();
        
        return $query;
        
        

        // if ($query->num_rows() > 0) {
        //     foreach ($query->result() as $row) {
        //         // Faça o que desejar com os dados encontrados
        //         echo "Lead ID: " . $row->id . ", Nome: " . $row->nome . "<br>";
        //     }
        // } else {
        //     echo "Nenhum lead encontrado.";
        // }
        

    }

    public function check_envio($lead_id, $oferta_id) {

        $this->db->where('oferta_id', $oferta_id);
        $this->db->where('lead_id', $lead_id);

        return $this->db->get('probe_ofertas_historico')->row_array();

    }

    public function oferta_enviada($lead_id, $oferta_id, $agente_id) {

        $data = array(
            'oferta_id' => $oferta_id,
            'lead_id' => $lead_id,
            'oferta_agente' => $agente_id,
            'oferta_fase_1' => 1,
            'oferta_fase_2' => 0,
            'oferta_data' => date('Y-m-d H:i:s')
        );
        return $this->db->insert('probe_ofertas_historico', $data);

    }

    public function get_leads_fase_dois( $oferta_id, $agente_id) {

        $this->db->where('oferta_id', $oferta_id);
        $this->db->where('oferta_agente', $agente_id);
        $this->db->where('oferta_fase_1', 1);
        $this->db->where('oferta_fase_2', 0);

        return $this->db->get('probe_ofertas_historico')->result();
    }

    public function check_envio_fase_dois($lead_id, $oferta_id) {

        $this->db->where('oferta_id', $oferta_id);
        $this->db->where('lead_id', $lead_id);
        $this->db->where('oferta_fase_1', 1);
        $this->db->where('oferta_fase_2', 1);

        return $this->db->get('probe_ofertas_historico')->row_array();

    }

    public function registrar_evento($dados) {
        return $this->db->insert('probe_leads_eventos', $dados);
    }

    public function get_evento($tipo, $oferta_id) {
        $this->db->where('evento_tipo', $tipo);
        $this->db->where('evento_oferta_id', $oferta_id);
       
        return count($this->db->get('probe_leads_eventos')->result());
    }

       // 1 - visitou o site
        // 2 - clicou nos botoes de call to action
        // 3 - abriu a faq
        // 5 - clicou no whatsapp
        // 6 - abriu checkout
        // 7 - comprou

    public function oferta_enviada_fase_dois($lead_id, $oferta_id, $oferta_agente) {

        $this->db->where('lead_id', $lead_id);
        $this->db->where('oferta_id', $oferta_id);
        $this->db->where('oferta_agente', $oferta_agente);

        $data = array(

            'oferta_fase_1' => 1,
            'oferta_fase_2' => 1,
            'oferta_data' => date('Y-m-d H:i:s')
        );
        return $this->db->update('probe_ofertas_historico', $data);

    }

    public function ativar_agente($agente_id) {

        $this->db->where('id', $agente_id);

        $data = array(
            'agente_status' => 0,
        );
        return $this->db->update('probe_agentes', $data);

    }

    public function desativar_agente($agente_id) {

        $this->db->where('id', $agente_id);

        $data = array(
            'agente_status' => 1,
        );
        return $this->db->update('probe_agentes', $data);

    }

}
