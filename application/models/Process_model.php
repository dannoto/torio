<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Process_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
    }

    public function c_cidade_estado($cidade)
	{
        $this->db->like('nome', $cidade);
        return $this->db->get('cidade')->row_array();

    }


    function getLeadsValidos($profissao) {


        $this->db->where('segmento', $profissao);
        $this->db->where('telefone !=', '');
        $this->db->where('email !=', '');
        $this->db->where('nome !=', '');


        return $this->db->get('leads')->result();
    }

    public function add_person($person_data)
    {

        $this->db->insert('person', $person_data);
        return $this->db->insert_id();
    }


    public function add_social($data) {
    
        return $this->db->insert('person_socialmedia', $data);

    }



public function check_social($username) {
    $this->db->where('username', $username);
    $this->db->where('is_deleted', 0);

    return $this->db->get('person_socialmedia')->row_array();
}

    public function check_email($email) {
        $this->db->where('email', $email);
        $this->db->where('is_deleted', 0);

        return $this->db->get('person_email')->row_array();
    }

    public function check_telefone($telefone) {
        $this->db->where('telefone', $telefone);
        $this->db->where('is_deleted', 0);
        return $this->db->get('person_telefone')->row_array();
    }

    public function add_email($data) {

        return $this->db->insert('person_email', $data);

    }

    public function add_telefone($data) {
    
        return $this->db->insert('person_telefone', $data);

    }

    public function add_classificacao($data)
    {

     
        return $this->db->insert('person_classificacao', $data);
    }

    public function updateEmpressaProcesso($id, $status ) {
        $this->db->where('id', $id);
        $data = array(
            'processado' => $status,
        );
        return $this->db->update('x_estabelecimentos', $data);

    }
    public function getEmpresasByCnaeTotal($cnae) {
        $data = $this->db->query("SELECT * FROM x_estabelecimentos WHERE (`cnae_fiscal_principal` LIKE '%".$cnae."%' OR `cnae_fiscal_secundario` LIKE '%".$cnae."%') AND LENGTH(ddd_1) = 2 AND processado= 0 AND situacao_cadastral=02 AND ddd_1 REGEXP '^[0-9]+$' AND LENGTH(telefone_1) = 8 AND telefone_1 REGEXP '^[0-9]+$' ;");
        return $data->result();
    }
    public function getEmpresasByCnae($cnae) {
        $data = $this->db->query("SELECT * FROM x_estabelecimentos WHERE (`cnae_fiscal_principal` LIKE '%".$cnae."%' OR `cnae_fiscal_secundario` LIKE '%".$cnae."%') AND LENGTH(ddd_1) = 2 AND processado= 0 AND situacao_cadastral=02 AND ddd_1 REGEXP '^[0-9]+$' AND LENGTH(telefone_1) = 8 AND telefone_1 REGEXP '^[0-9]+$' LIMIT 10000;");
        return $data->result();
    }
}