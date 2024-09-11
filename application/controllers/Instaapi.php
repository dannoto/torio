<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Instaapi extends CI_Controller
{

    function __construct()
    {

        parent::__construct();

        $this->load->model('admin_model');
        $this->load->model('process_model');

        $this->load->model('insta_model');
    }

    public function get_tarefas_ativas()
    {

        $response = $this->insta_model->get_tarefas_ativas();

        print_r(json_encode($response));
    }

    public function get_headers()
    {

        $response = $this->insta_model->get_headers();

        print_r(json_encode($response));
    }

    public function get_tarefas_finalizadas()
    {

        $response = $this->insta_model->get_tarefas_finalizadas();

        print_r(json_encode($response));
    }

    public function get_tarefas_leads()
    {

        $tarefa_id = htmlspecialchars($this->input->get('tarefa_id'));
        $response = $this->insta_model->get_tarefas_leads($tarefa_id);

        print_r(json_encode($response));
    }


    public function get_demandas_pendentes()
    {

        $response = $this->insta_model->get_demandas_pendentes();

        print_r(json_encode($response));
    }

    public function update_demanda_offline()
    {
        $demanda_id = htmlspecialchars($this->input->get('demanda_id'));
        $response = $this->insta_model->update_demanda_offline($demanda_id);

        print_r(json_encode($response));
    }


    public function update_demanda_pendente()
    {
        $demanda_id = htmlspecialchars($this->input->get('demanda_id'));
        $response = $this->insta_model->update_demanda_pendente($demanda_id);

        print_r(json_encode($response));
    }

    public function update_tarefa_status()
    {
        $tarefa_id = htmlspecialchars($this->input->get('tarefa_id'));
        $tarefa_status = htmlspecialchars($this->input->get('tarefa_status'));

        $response = $this->insta_model->update_tarefa_status($tarefa_id, $tarefa_status);

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

        if ($this->insta_model->check_lead_demanda($data['username'], $data['post_id'], $data['tarefa_id'], $data['tag_id'])) {

            echo "Ja existe";
        } else {

            $response = $this->insta_model->add_instalead_demanda($data);
        }

        if ($response) {
            $response = array('status' => 'true', 'message' => 'Concluido');
        } else {
            $response = array('status' => 'false', 'message' => 'Erro');
        }

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

        if ($this->insta_model->check_lead($data['username'], $data['post_id'], $data['tarefa_id'], $data['tag_id'])) {

            echo "Ja existe";
        } else {

            $response = $this->insta_model->add_instalead($data);
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


    public function add_person()
    {

        $dados_recebidos = json_decode(file_get_contents('php://input'), true);

        foreach ($dados_recebidos as $chave => $valor) {
            if ($valor === "Sem informação") {
                $dados_recebidos[$chave] = "";
            }
        }

        $dados_recebidos['nascimento'] = substr($dados_recebidos['nascimento'], 0, 10);
        $dados_recebidos['estado'] = $this->admin_model->get_uf_id($dados_recebidos['estado']);
        $dados_recebidos['cidade'] = $this->admin_model->get_cidade_id($dados_recebidos['cidade']);

        if ($dados_recebidos['sexo'] == "F") {
            $dados_recebidos['sexo'] = "feminino";
        } else if ($dados_recebidos['sexo'] == "M") {
            $dados_recebidos['sexo'] = "masculino";
        }


        // Transforme os dados em um array com as chaves desejadas
        $data = array(
            "nome" => $dados_recebidos["nome"] ?? "",
            "nascimento" => $dados_recebidos["nascimento"] ?? "",
            "rg" => $dados_recebidos["rg"] ?? "",
            "cpf" => $dados_recebidos["cpf"] ?? "",
            "sexo" => $dados_recebidos["sexo"] ?? "",
            "endereco" => $dados_recebidos["endereco"] ?? "",
            "cep" => $dados_recebidos["cep"] ?? "",
            "estado" => $dados_recebidos["estado"] ?? "",
            "cidade" => $dados_recebidos["cidade"] ?? "",
            "bairro" => $dados_recebidos["bairro"] ?? "",
            "email" => $dados_recebidos["email"] ?? "", // Supondo que você quer apenas o e-mail do Gmail
            "telefone" => $dados_recebidos["telefone"] ?? "",
            "username" => $dados_recebidos["username"] ?? "",
            "tag" => $dados_recebidos["tag"] ?? "",
            "lead_id" => $dados_recebidos["lead_id"] ?? "",
        );


        // Faça o que desejar com os dados formatados
        // print_r($data);

        if ($this->process_model->check_telefone($data['telefone'])) {

            $person_telefone = $this->process_model->check_telefone($data['telefone'])['person_id'];

            $tag_info = $this->admin_model->get_item($data['tag']);

            echo "TElefone ja existe";

            $tag_data['person_id'] = $person_telefone;
            $tag_data['categoria_id'] = $tag_info['categoria_id'];
            $tag_data['subcategoria_id'] = $tag_info['subcategoria_id'];
            $tag_data['tag_id'] = $data['tag'];
            $tag_data['data'] = date('d-m-Y H:i:s');
            $tag_data['is_deleted'] = 0;


            if ($this->admin_model->check_classificacao_tag($tag_data['tag_id'], $tag_data['person_id'])) {

                echo "<br>[!] TAG JÁ EXISTE : " . $data['tag'] . " <br>";
            } else {
                if ($this->admin_model->add_classificacao($tag_data)) {

                    echo "<br>[!] TAG ATRIBUIDA : " . $data['tag'] . " <br>";
                }
            }

        } else if ($this->process_model->check_email($data['email'])) {

            $person_email = $this->process_model->check_email($data['email'])['person_id'];

            $tag_info = $this->admin_model->get_item($data['tag']);

            echo "Email ja existe ja existe";

            $tag_data['person_id'] = $person_email;
            $tag_data['categoria_id'] = $tag_info['categoria_id'];
            $tag_data['subcategoria_id'] = $tag_info['subcategoria_id'];
            $tag_data['tag_id'] = $data['tag'];
            $tag_data['data'] = date('d-m-Y H:i:s');
            $tag_data['is_deleted'] = 0;

            if ($this->admin_model->check_classificacao_tag($tag_data['tag_id'], $tag_data['person_id'])) {

                echo "<br>[!] TAG JÁ EXISTE : " . $data['tag'] . " <br>";


            } else {

                if ($this->admin_model->add_classificacao($tag_data)) {

                    echo "<br>[!] TAG ATRIBUIDA : " . $data['tag'] . " <br>";
                }
            }
        } else {

            $person_data['nome'] = $data['nome'];
            $person_data['nascimento'] = $data['nascimento'];
            $person_data['rg'] = $data['rg'];
            $person_data['cpf'] = $data['cpf'];
            $person_data['sexo'] = $data['sexo'];
            $person_data['endereco'] = $data['endereco'];
            $person_data['cep'] = $data['cep'];
            $person_data['estado'] = $data['estado'];
            $person_data['cidade'] = $data['cidade'];
            $person_data['bairro'] = $data['bairro'];


            if (strlen($data['email']) > 0) {
                $person_data['validacao_email'] = 1;
            } else {
                $person_data['validacao_email'] = 0;
            }

            $person_data['validacao_perfil'] = 1;


            if (strlen($data['telefone']) > 0) {
                $person_data['validacao_telefone'] = 1;
            } else {
                $person_data['validacao_telefone'] = 0;
            }





            $person_data['tipo'] = "pessoa_fisica";
            $person_data['is_deleted'] = 0;

            $person_id = $this->admin_model->add_person_get_id($person_data);

            if ($person_id) {

                echo "[!] PERSONA ADICIONADA id " . $person_id . " - " . $person_data['nome'] . "";

                // Adicionando Telefone
                $data_telefone['person_id'] = $person_id;
                $data_telefone['ddd'] = "";

                $data_telefone['telefone'] = $data['telefone'];
                $data_telefone['is_validado'] = 1;
                $data_telefone['is_deleted'] = 0;

                if (strlen($data['telefone']) > 0) {


                    if ($this->admin_model->checkNumberCaptured($data['telefone'])) {
                        if ($this->admin_model->add_telefone($data_telefone)) {
                            echo "[!] TELEFONE ATRIBUIDO : " . $data['telefone'] . " ";
                        } else {
                            echo "[!] erro TELEFONE ATRIBUIDO : " . $data['telefone'] . " ";
                        }
                    } else {
                        echo "TELEFONE INVÁLIDO";
                    }
                   
                }

                // Adicionando Email
                $data_email['person_id'] = $person_id;
                $data_email['email'] = $data['email'];
                $data_email['is_validado'] = 1;
                $data_email['is_deleted'] = 0;


                if (strlen($data['email']) > 0) {


                    if ($this->admin_model->checkEmailCaptured($data['email'])) {

                        if ($this->admin_model->add_emails($data_email)) {

                            echo "<br>[!] E-MAIL ATRIBUIDO : " . $data['email'] . " <br>";
                        } else {
                            echo "[!] erro TELEFONE ATRIBUIDO : " . $data['telefone'] . " ";
                        }

                    } else {
                        echo "E-MAIL INVÁLIDO";

                    }
                    
                }


                // Adicionando Rede Social
                $data_social['person_id'] = $person_id;
                $data_social['nome'] = "instagram";
                $data_social['username'] = $data['username'];
                $data_social['url'] = "https://instagram.com/" . $data['username'];
                $data_social['intensividade'] = 1;
                $data_social['status'] = 0;

                if (strlen($data['username']) > 0) {

                    if ($this->admin_model->add_social($data_social)) {
                        echo "<br>[!] SOCIAL : " . $data['email'] . " <br>";
                    } else {
                        echo "[!] erro Social atribuido : " . $data['telefone'] . " ";
                    }
                }



                $tag_info = $this->admin_model->get_item($data['tag']);

                $tag_data['person_id'] = $person_id;
                $tag_data['categoria_id'] = $tag_info['categoria_id'];
                $tag_data['subcategoria_id'] = $tag_info['subcategoria_id'];
                $tag_data['tag_id'] = $data['tag'];
                $tag_data['data'] = date('d-m-Y H:i:s');
                $tag_data['is_deleted'] = 0;

                if ($this->admin_model->add_classificacao($tag_data)) {

                    echo "<br>[!] TAG ATRIBUIDA : " . $data['tag'] . " <br>";
                } else {
                    echo "[!] erro TAG ATRIBUIDA: " . $data['telefone'] . " ";
                }


                $lead_att = array(
                    'convertido' => 1,
                    'full_name' => $data['nome'],
                    'email' => $data_email['email'],
                    'telefone' => $data_telefone['telefone']
                );

                if ($this->admin_model->updateInstaLead($data['lead_id'], $lead_att)) {

                    echo "LEAD ATUALIZADO";
                } else {
                    echo "[!] erro ao ATUALIZAR LEADS : " . $data['telefone'] . " ";
                }
            } else {
                echo "n foi";
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
