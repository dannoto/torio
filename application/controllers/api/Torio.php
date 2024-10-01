<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Torio extends CI_Controller
{

    function __construct()
    {

        parent::__construct();

        $this->load->model('conta_model');

        $this->load->model('api_model');
    }

    public function get_tarefas_ativas()
    {

        $response = $this->api_model->get_tarefas_ativas();
        print_r(json_encode($response));
    }

    public function update_agente_ocupado()
    {

        $agente_id = htmlspecialchars($this->input->get('agente_id'));

        $agente_data = array(
            "agente_ocupado" => htmlspecialchars($this->input->get('agente_ocupado'))
        );

        $response = $this->api_model->update_agente_ocupado($agente_id, $agente_data);

        if ($response) {
            $response = array('status' => 'true', 'message' => 'Concluido');
        } else {
            $response = array('status' => 'false', 'message' => 'Erro');
        }

        print_r(json_encode($response));
    }

    public function update_agente_banido()
    {

        $agente_id = htmlspecialchars($this->input->get('agente_id'));

        $agente_data = array(
            "agente_status" => htmlspecialchars($this->input->get('agente_status'))
        );

        $response = $this->api_model->update_agente_banido($agente_id, $agente_data);

        if ($response) {
            $response = array('status' => 'true', 'message' => 'Concluido');
        } else {
            $response = array('status' => 'false', 'message' => 'Erro');
        }

        print_r(json_encode($response));
    }

    public function update_tarefa_status()
    {
        $tarefa_id = htmlspecialchars($this->input->get('tarefa_id'));
        $tarefa_status = htmlspecialchars($this->input->get('tarefa_status'));

        $response = $this->api_model->update_tarefa_status($tarefa_id, $tarefa_status);

        if ($response) {
            $response = array('status' => 'true', 'message' => 'Concluido');
        } else {
            $response = array('status' => 'false', 'message' => 'Erro');
        }

        print_r(json_encode($response));
    }

    public function add_instalead_demanda()
    {
        $data['tarefa_id'] = htmlspecialchars($this->input->post('tarefa_id'));
        $data['tag_id'] = htmlspecialchars($this->input->post('tag_id'));
        $data['username'] = htmlspecialchars($this->input->post('username'));
        $data['is_private'] = htmlspecialchars($this->input->post('is_private'));
        $data['full_name'] = htmlspecialchars($this->input->post('full_name'));
        $data['interacao_tipo'] = htmlspecialchars($this->input->post('interacao_tipo'));
        $data['interacao_conteudo'] = htmlspecialchars($this->input->post('interacao_conteudo'));
        $data['interacao_data'] = htmlspecialchars($this->input->post('interacao_data'));
        $data['post_id'] = htmlspecialchars($this->input->post('post_id'));
        $data['post_slug'] = htmlspecialchars($this->input->post('post_slug'));
        $data['post_data'] = htmlspecialchars($this->input->post('post_data'));
        $data['post_descricao'] = htmlspecialchars($this->input->post('post_descricao'));
        $data['post_imagem'] = htmlspecialchars($this->input->post('post_imagem'));
        $data['processado'] = htmlspecialchars($this->input->post('processado'));

        if ($this->api_model->check_lead_demanda($data['username'], $data['post_id'], $data['tarefa_id'], $data['tag_id'])) {

            echo "Ja existe";
        } else {

            $response = $this->api_model->add_instalead_demanda($data);
        }

        if ($response) {
            $response = array('status' => 'true', 'message' => 'Concluido');
        } else {
            $response = array('status' => 'false', 'message' => 'Erro');
        }

        print_r(json_encode($response));
    }
    
    public function get_agente()
    {
        $data['agente_email'] = htmlspecialchars($this->input->get('agente_email'));

        if ($this->api_model->get_agente($data['agente_email'])) {
            $response = $this->api_model->get_agente($data['agente_email']);
        } else {
            $response = array('status' => 'false', 'message' => 'Erro');
        }

        print_r(json_encode($response));
    }
 
    public function add_agente()
    {
        $data['agente_email'] = htmlspecialchars($this->input->get('agente_email'));
        $data['agente_senha'] = htmlspecialchars($this->input->get('agente_senha'));
        $data['agente_nome'] = htmlspecialchars($this->input->get('agente_nome'));
        $data['agente_username'] = htmlspecialchars($this->input->get('agente_email'));
        $data['agente_ocupado'] = 0;
        $data['agente_status'] = 1;
        $data['agente_sexo'] = 'masculino';
        $data['agente_data'] = date('Y-m-d H:i:s');
        $data['is_deleted'] = 0;



        if ($this->api_model->add_agente($data)) {
            $response = array('status' => 'true', 'message' => 'Concluido');
        } else {
            $response = array('status' => 'false', 'message' => 'Erro');
        }

        print_r(json_encode($response));
    }

    public function get_campanhas_ativas()
    {
        $response = $this->api_model->get_campanhas_ativas();
        print_r(json_encode($response));
    }

    public function get_demandas_por_campanha()
    {
        $campanha_id = htmlspecialchars($this->input->get('campanha_id'));

        $campanha_data = $this->conta_model->get_campanha($campanha_id);

        $response = $this->api_model->get_demandas_abertas($campanha_data->campanha_tag_id);

        print_r(json_encode($response));
    }

    public function get_ofertas_pendentes()
    {
        $agente_id = htmlspecialchars($this->input->get('agente_id'));

        $response = $this->api_model->get_ofertas_pendentes($agente_id);

        print_r(json_encode($response));
    }

    public function update_oferta()
    {
        $oferta_id = htmlspecialchars($this->input->get('oferta_id'));
        $oferta_status = htmlspecialchars($this->input->get('oferta_status'));

        $demanda_id = htmlspecialchars($this->input->get('demanda_id'));

        $demanda_data = array(
            'processado' => 1
        );

        $this->api_model->update_demanda($demanda_id, $demanda_data);

        $data = array(
            'oferta_status' =>  $oferta_status
        );

        $response = $this->api_model->update_oferta($oferta_id, $data);

        print_r(json_encode($response));
    }

    public function update_oferta_data()
    {
        $oferta_id = htmlspecialchars($this->input->get('oferta_id'));

        $demanda_id = htmlspecialchars($this->input->get('demanda_id'));
        $demanda_data = array(
            'processado' => 1
        );
        $this->api_model->update_demanda($demanda_id, $demanda_data);

        $data = array(
            'oferta_data' =>  date('Y-m-d')

        );

        $response = $this->api_model->update_oferta($oferta_id, $data);

        print_r(json_encode($response));
    }

    function get_oferta_key($oferta_id, $campanha_id)
    {

        // Gera 3 letras aleatórias do alfabeto
        $random_letters = '';
        for ($i = 0; $i < 3; $i++) {
            // Gera uma letra aleatória (A-Z)
            $random_letters .= chr(rand(65, 90));
        }

        // Concatena o oferta_id, as letras aleatórias e o campanha_id
        $key = $oferta_id . $random_letters . $campanha_id;

        return $key;
    }

    public function criar_oferta_pendente()
    {

        $data['oferta_status'] = 0;
        $data['oferta_persona_id'] =  htmlspecialchars($this->input->get('oferta_persona_id'));
        $data['oferta_insta_id'] = htmlspecialchars($this->input->get('oferta_insta_id'));
        $data['oferta_campanha_id'] = htmlspecialchars($this->input->get('oferta_campanha_id'));
        $data['oferta_oferta_id'] = htmlspecialchars($this->input->get('oferta_oferta_id'));
        $data['oferta_tag_id'] = htmlspecialchars($this->input->get('oferta_tag_id'));
        $data['oferta_produto_id'] = htmlspecialchars($this->input->get('oferta_produto_id'));
        $data['oferta_data'] = date('Y-m-d');

        $data['oferta_data_creation'] = date('Y-m-d H:i:s');
        $data['oferta_key'] = $this->get_oferta_key(htmlspecialchars($this->input->get('oferta_persona_id')), htmlspecialchars($this->input->get('oferta_campanha_id')));

        $data['oferta_time'] = date('H:i:s');
        $data['oferta_agente_id'] = htmlspecialchars($this->input->get('oferta_agente_id'));
        $data['is_deleted'] = 0;

        $res = $this->api_model->criar_oferta_pendente($data);

        if ($res) {
            $oferta_data = $this->api_model->get_oferta($res);

            print_r(json_encode($oferta_data));
        } else {

            $response = false;

            print_r(json_encode($response));
        }
    }

    public function get_templates_oferta()
    {

        $campanha_id = htmlspecialchars($this->input->get('campanha_id'));
        $response = $this->api_model->get_templates_oferta($campanha_id);

        print_r(json_encode($response));
    }

    public function count_agentes_oferta()
    {

        $agente_id = htmlspecialchars($this->input->get('agente_id'));
        $response = $this->api_model->count_agentes_oferta($agente_id);

        print_r(json_encode($response));
    }

    public function get_agentes_livres()
    {
        $response = $this->api_model->get_agentes_livres();
        print_r(json_encode($response));
    }

    public function get_campanha_ofertas()
    {
        $campanha_id = htmlspecialchars($this->input->get('campanha_id'));

        $response = $this->api_model->get_campanha_ofertas($campanha_id);

        if ($response) {

            print_r(json_encode($response));
        } else {
            $response = array('status' => 'false', 'message' => 'Erro');
        }

        print_r(json_encode($response));
    }

    // 

    # oferta run

    public function off_get_oferta_by_key()
	{

        if ($this->input->get('oferta_key')) {

        
            if ($this->api_model->off_get_oferta_by_key($this->input->get('oferta_key'))) {
                $response = $this->api_model->off_get_oferta_by_key($this->input->get('oferta_key'));
            } else {
                // echo "ai papai";
                $response = false;
            }
           
        }

		print_r(json_encode($response));
	}


    public function off_get_produto()
	{

        if ($this->input->get('produto_id')) {

        
            if ($this->api_model->off_get_produto($this->input->get('produto_id'))) {
                $response = $this->api_model->off_get_produto($this->input->get('produto_id'));
            } else {
                $response = false;
            }
           
        }

		print_r(json_encode($response));
	}


    public function off_add_clique()
	{

        
        if ($this->input->get()) {

            $data['clique_user_agent'] = $this->input->get('clique_user_agent');
            $data['clique_persona_id'] = $this->input->get('clique_persona_id');
            $data['clique_campanha_id'] = $this->input->get('clique_campanha_id');
            $data['clique_oferta_id'] = $this->input->get('clique_oferta_id');
            $data['clique_oferta_template_id'] = $this->input->get('clique_oferta_template_id'); 
            $data['clique_produto_id'] = $this->input->get('clique_produto_id');
            $data['clique_data_id'] = $this->input->get('clique_data_id');
            $data['clique_ip'] = $this->input->get('clique_ip');
            $data['clique_device'] = $this->input->get('clique_device');
            $data['clique_origem'] = $this->input->get('clique_origem');
            $data['clique_tag_id'] = $this->input->get('clique_tag_id');

            if ($this->api_model->off_add_clique($data)) {
                $response = true;
            } else {
                $response = false;
            }
           
        }

		print_r(json_encode($response));
	}

    # oferta run

    // public function get_headers()
    // {

    //     $response = $this->api_model->get_headers();

    //     print_r(json_encode($response));
    // }

    // public function get_tarefas_finalizadas()
    // {

    //     $response = $this->api_model->get_tarefas_finalizadas();

    //     print_r(json_encode($response));
    // }

    // public function get_tarefas_leads()
    // {

    //     $tarefa_id = htmlspecialchars($this->input->get('tarefa_id'));
    //     $response = $this->api_model->get_tarefas_leads($tarefa_id);

    //     print_r(json_encode($response));
    // }


    // public function get_demandas_pendentes()
    // {

    //     $response = $this->api_model->get_demandas_pendentes();

    //     print_r(json_encode($response));
    // }

    // public function update_demanda_offline()
    // {
    //     $demanda_id = htmlspecialchars($this->input->get('demanda_id'));
    //     $response = $this->api_model->update_demanda_offline($demanda_id);

    //     print_r(json_encode($response));
    // }


    public function update_demanda_pendente()
    {
        $demanda_id = htmlspecialchars($this->input->get('demanda_id'));
        $response = $this->api_model->update_demanda_pendente($demanda_id);

        print_r(json_encode($response));
    }


    public function add_instalead()
    {
        $data['tarefa_id'] = htmlspecialchars($this->input->post('tarefa_id'));
        $data['tag_id'] = htmlspecialchars($this->input->post('tag_id'));
        $data['username'] = htmlspecialchars($this->input->post('username'));
        $data['full_name'] = htmlspecialchars($this->input->post('full_name'));
        $data['is_private'] = htmlspecialchars($this->input->post('is_private'));
        $data['biografia'] = htmlspecialchars($this->input->post('biografia'));
        $data['links'] = htmlspecialchars($this->input->post('links'));
        $data['mencoes'] = htmlspecialchars($this->input->post('mencoes'));
        $data['categoria'] = htmlspecialchars($this->input->post('categoria'));
        $data['email'] = htmlspecialchars($this->input->post('email'));
        $data['telefone'] = htmlspecialchars($this->input->post('telefone'));
        $data['convertido'] = htmlspecialchars($this->input->post('convertido'));

        if ($data['email'] == "False") {
            $data['email'] = "";
        }

        if ($data['telefone'] == "False") {
            $data['telefone'] = "";
        }

        if ($this->api_model->check_lead($data['username'], $data['post_id'], $data['tarefa_id'], $data['tag_id'])) {

            echo "Ja existe";
        } else {

            $response = $this->api_model->add_instalead($data);
        }

        if ($response) {
            $response = array('status' => 'true', 'message' => 'Concluido');
        } else {
            $response = array('status' => 'false', 'message' => 'Erro');
        }

        print_r(json_encode($response));
    }

    public function add_convertido()
    {
        $data['lead_id'] = htmlspecialchars($this->input->get('lead_id'));
        $convertido_idata = array(
            'convertido' => 1,
        );

        if ($this->admin_model->updateInstaLead($data['lead_id'], $convertido_idata)) {

            echo "convertido";
        } else {
            echo "[!] erro ao CONVERTER : " . $data['lead_id'] . " ";
        }
    }



    public function add_inapto()
    {
        $data['lead_id'] = htmlspecialchars($this->input->get('lead_id'));

        $inapto_data = array(
            'inapto' => 1,

        );

        if ($this->admin_model->updateInstaLead($data['lead_id'], $inapto_data)) {

            echo "convertido";
        } else {
            echo "[!] erro ao CONVERTER : " . $data['lead_id'] . " ";
        }
    }

    public function add_concluido()
    {
        $data['tarefa_id'] = htmlspecialchars($this->input->get('tarefa_id'));

        $tarefa_data = array(
            'tarefa_status' => 5,

        );

        if ($this->admin_model->updateTarefa($data['tarefa_id'], $tarefa_data)) {

            echo "TAREFA CONCLUIDA";
        } else {
            echo "[!] erro ao CONCLUIR TAREFA : " . $data['tarefa_id'] . " ";
        }
    }


    // public function add_person()
    // {

    //     $dados_recebidos = json_decode(file_get_contents('php://input'), true);

    //     foreach ($dados_recebidos as $chave => $valor) {
    //         if ($valor === "Sem informação") {
    //             $dados_recebidos[$chave] = "";
    //         }
    //     }

    //     $dados_recebidos['nascimento'] = substr($dados_recebidos['nascimento'], 0, 10);
    //     $dados_recebidos['estado'] = $this->admin_model->get_uf_id($dados_recebidos['estado']);
    //     $dados_recebidos['cidade'] = $this->admin_model->get_cidade_id($dados_recebidos['cidade']);

    //     if ($dados_recebidos['sexo'] == "F") {
    //         $dados_recebidos['sexo'] = "feminino";
    //     } else if ($dados_recebidos['sexo'] == "M") {
    //         $dados_recebidos['sexo'] = "masculino";
    //     }


    //     // Transforme os dados em um array com as chaves desejadas
    //     $data = array(
    //         "nome" => $dados_recebidos["nome"] ?? "",
    //         "nascimento" => $dados_recebidos["nascimento"] ?? "",
    //         "rg" => $dados_recebidos["rg"] ?? "",
    //         "cpf" => $dados_recebidos["cpf"] ?? "",
    //         "sexo" => $dados_recebidos["sexo"] ?? "",
    //         "endereco" => $dados_recebidos["endereco"] ?? "",
    //         "cep" => $dados_recebidos["cep"] ?? "",
    //         "estado" => $dados_recebidos["estado"] ?? "",
    //         "cidade" => $dados_recebidos["cidade"] ?? "",
    //         "bairro" => $dados_recebidos["bairro"] ?? "",
    //         "email" => $dados_recebidos["email"] ?? "", // Supondo que você quer apenas o e-mail do Gmail
    //         "telefone" => $dados_recebidos["telefone"] ?? "",
    //         "username" => $dados_recebidos["username"] ?? "",
    //         "tag" => $dados_recebidos["tag"] ?? "",
    //         "lead_id" => $dados_recebidos["lead_id"] ?? "",
    //     );


    //     // Faça o que desejar com os dados formatados
    //     // print_r($data);

    //     if ($this->process_model->check_telefone($data['telefone'])) {

    //         $person_telefone = $this->process_model->check_telefone($data['telefone'])['person_id'];

    //         $tag_info = $this->admin_model->get_item($data['tag']);

    //         echo "TElefone ja existe";

    //         $tag_data['person_id'] = $person_telefone;
    //         $tag_data['categoria_id'] = $tag_info['categoria_id'];
    //         $tag_data['subcategoria_id'] = $tag_info['subcategoria_id'];
    //         $tag_data['tag_id'] = $data['tag'];
    //         $tag_data['data'] = date('d-m-Y H:i:s');
    //         $tag_data['is_deleted'] = 0;


    //         if ($this->admin_model->check_classificacao_tag($tag_data['tag_id'], $tag_data['person_id'])) {

    //             echo "<br>[!] TAG JÁ EXISTE : " . $data['tag'] . " <br>";
    //         } else {
    //             if ($this->admin_model->add_classificacao($tag_data)) {

    //                 echo "<br>[!] TAG ATRIBUIDA : " . $data['tag'] . " <br>";
    //             }
    //         }

    //     } else if ($this->process_model->check_email($data['email'])) {

    //         $person_email = $this->process_model->check_email($data['email'])['person_id'];

    //         $tag_info = $this->admin_model->get_item($data['tag']);

    //         echo "Email ja existe ja existe";

    //         $tag_data['person_id'] = $person_email;
    //         $tag_data['categoria_id'] = $tag_info['categoria_id'];
    //         $tag_data['subcategoria_id'] = $tag_info['subcategoria_id'];
    //         $tag_data['tag_id'] = $data['tag'];
    //         $tag_data['data'] = date('d-m-Y H:i:s');
    //         $tag_data['is_deleted'] = 0;

    //         if ($this->admin_model->check_classificacao_tag($tag_data['tag_id'], $tag_data['person_id'])) {

    //             echo "<br>[!] TAG JÁ EXISTE : " . $data['tag'] . " <br>";


    //         } else {

    //             if ($this->admin_model->add_classificacao($tag_data)) {

    //                 echo "<br>[!] TAG ATRIBUIDA : " . $data['tag'] . " <br>";
    //             }
    //         }
    //     } else {

    //         $person_data['nome'] = $data['nome'];
    //         $person_data['nascimento'] = $data['nascimento'];
    //         $person_data['rg'] = $data['rg'];
    //         $person_data['cpf'] = $data['cpf'];
    //         $person_data['sexo'] = $data['sexo'];
    //         $person_data['endereco'] = $data['endereco'];
    //         $person_data['cep'] = $data['cep'];
    //         $person_data['estado'] = $data['estado'];
    //         $person_data['cidade'] = $data['cidade'];
    //         $person_data['bairro'] = $data['bairro'];


    //         if (strlen($data['email']) > 0) {
    //             $person_data['validacao_email'] = 1;
    //         } else {
    //             $person_data['validacao_email'] = 0;
    //         }

    //         $person_data['validacao_perfil'] = 1;


    //         if (strlen($data['telefone']) > 0) {
    //             $person_data['validacao_telefone'] = 1;
    //         } else {
    //             $person_data['validacao_telefone'] = 0;
    //         }





    //         $person_data['tipo'] = "pessoa_fisica";
    //         $person_data['is_deleted'] = 0;

    //         $person_id = $this->admin_model->add_person_get_id($person_data);

    //         if ($person_id) {

    //             echo "[!] PERSONA ADICIONADA id " . $person_id . " - " . $person_data['nome'] . "";

    //             // Adicionando Telefone
    //             $data_telefone['person_id'] = $person_id;
    //             $data_telefone['ddd'] = "";

    //             $data_telefone['telefone'] = $data['telefone'];
    //             $data_telefone['is_validado'] = 1;
    //             $data_telefone['is_deleted'] = 0;

    //             if (strlen($data['telefone']) > 0) {


    //                 if ($this->admin_model->checkNumberCaptured($data['telefone'])) {
    //                     if ($this->admin_model->add_telefone($data_telefone)) {
    //                         echo "[!] TELEFONE ATRIBUIDO : " . $data['telefone'] . " ";
    //                     } else {
    //                         echo "[!] erro TELEFONE ATRIBUIDO : " . $data['telefone'] . " ";
    //                     }
    //                 } else {
    //                     echo "TELEFONE INVÁLIDO";
    //                 }

    //             }

    //             // Adicionando Email
    //             $data_email['person_id'] = $person_id;
    //             $data_email['email'] = $data['email'];
    //             $data_email['is_validado'] = 1;
    //             $data_email['is_deleted'] = 0;


    //             if (strlen($data['email']) > 0) {


    //                 if ($this->admin_model->checkEmailCaptured($data['email'])) {

    //                     if ($this->admin_model->add_emails($data_email)) {

    //                         echo "<br>[!] E-MAIL ATRIBUIDO : " . $data['email'] . " <br>";
    //                     } else {
    //                         echo "[!] erro TELEFONE ATRIBUIDO : " . $data['telefone'] . " ";
    //                     }

    //                 } else {
    //                     echo "E-MAIL INVÁLIDO";

    //                 }

    //             }


    //             // Adicionando Rede Social
    //             $data_social['person_id'] = $person_id;
    //             $data_social['nome'] = "instagram";
    //             $data_social['username'] = $data['username'];
    //             $data_social['url'] = "https://instagram.com/" . $data['username'];
    //             $data_social['intensividade'] = 1;
    //             $data_social['status'] = 0;

    //             if (strlen($data['username']) > 0) {

    //                 if ($this->admin_model->add_social($data_social)) {
    //                     echo "<br>[!] SOCIAL : " . $data['email'] . " <br>";
    //                 } else {
    //                     echo "[!] erro Social atribuido : " . $data['telefone'] . " ";
    //                 }
    //             }



    //             $tag_info = $this->admin_model->get_item($data['tag']);

    //             $tag_data['person_id'] = $person_id;
    //             $tag_data['categoria_id'] = $tag_info['categoria_id'];
    //             $tag_data['subcategoria_id'] = $tag_info['subcategoria_id'];
    //             $tag_data['tag_id'] = $data['tag'];
    //             $tag_data['data'] = date('d-m-Y H:i:s');
    //             $tag_data['is_deleted'] = 0;

    //             if ($this->admin_model->add_classificacao($tag_data)) {

    //                 echo "<br>[!] TAG ATRIBUIDA : " . $data['tag'] . " <br>";
    //             } else {
    //                 echo "[!] erro TAG ATRIBUIDA: " . $data['telefone'] . " ";
    //             }


    //             $lead_att = array(
    //                 'convertido' => 1,
    //                 'full_name' => $data['nome'],
    //                 'email' => $data_email['email'],
    //                 'telefone' => $data_telefone['telefone']
    //             );

    //             if ($this->admin_model->updateInstaLead($data['lead_id'], $lead_att)) {

    //                 echo "LEAD ATUALIZADO";
    //             } else {
    //                 echo "[!] erro ao ATUALIZAR LEADS : " . $data['telefone'] . " ";
    //             }
    //         } else {
    //             echo "n foi";
    //         }
    //     }
    // }



    public function add_persona()
    {

        $persona_data['persona_nome'] = htmlspecialchars($this->input->get('persona_nome'));
        $persona_data['persona_username'] = htmlspecialchars($this->input->get('persona_username'));
        $persona_data['persona_email'] = htmlspecialchars($this->input->get('persona_email'));
        $persona_data['persona_telefone'] = htmlspecialchars($this->input->get('persona_telefone'));
        $persona_data['persona_data'] = date('Y-m-d H:i:s');
        $persona_data['is_deleted'] = 0;

        if ($persona_data['persona_telefone'] == "None") {
            $persona_data['persona_telefone'] == "";
        } 


        if ($persona_data['persona_email'] == "None") {
            $persona_data['persona_email'] == "";
        } 


        if ($persona_id = $this->api_model->check_persona($persona_data['persona_username'])) {


            // Já existe persona, adicionando nova TAG.
            if ($this->api_model->check_persona_tag($persona_data['persona_username'], $persona_data['persona_tag_id'])) {

                $this->api_model->update_persona($persona_id, $persona_data);

                // Já existe tag associada.
                $response = array('persona_id' => $persona_id);
                return print_r(json_encode($response));
                
            } else {


                $tag['persona_tag_id'] = htmlspecialchars($this->input->get('persona_tag_id'));
                $tag['persona_id'] = $persona_id;
                $tag['persona_username'] = htmlspecialchars($this->input->get('persona_username'));
                $tag['persona_data'] = date('Y-m-d H:i:s');
                $tag['is_deleted'] = 0;

                $this->api_model->add_persona_tag($tag);

                $response = array('persona_id' => $persona_id);
                return print_r(json_encode($response));
            }
        } else {

            if ($persona_id = $this->api_model->add_persona($persona_data)) {

                // Persona adicionada com sucesso.
                $tag['persona_tag_id'] = htmlspecialchars($this->input->get('persona_tag_id'));
                $tag['persona_id'] = $persona_id;
                $tag['persona_username'] = htmlspecialchars($this->input->get('persona_username'));
                $tag['persona_data'] = date('Y-m-d H:i:s');
                $tag['is_deleted'] = 0;

                $this->api_model->add_persona_tag($tag);

                $response = array('persona_id' => $persona_id);
                return print_r(json_encode($response));
            }
        }
    }





    // public function teste_email() {
    //     $email = htmlspecialchars($this->input->get('email'));

    //     if ($this->admin_model->checkEmailCaptured($email)) {
    //         echo "valido: ".$email;
    //     } else {
    //         echo "invalido: ".$email;
    //     }
    // }

    // public function teste_telefone() {
    //     $telefone = htmlspecialchars($this->input->get('telefone'));

    //     if ($this->admin_model->checkNumberCaptured($telefone)) {
    //         echo "valido: ".$telefone;
    //     } else {
    //         echo "invalido: ".$telefone;
    //     }
    // }


}
