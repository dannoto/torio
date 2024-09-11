<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales extends CI_Controller
{

    function __construct()
    {

        parent::__construct();

        $this->load->model('admin_model');
        $this->load->model('brevo_model');
    }



    public function produtos()
    {

        $this->load->view('admin/sales/produtos');
    }

    public function listas()
    {

        $this->load->view('admin/sales/listas');
    }

    public function lista_adicionar()
    {

        $this->load->view('admin/sales/lista_adicionar');
    }


    public function lista_leads($id)
    {

        // Paginacao
        $limite_por_pagina = 10;

		if (htmlspecialchars($this->input->get('p')) <= 0) {
			$pagina_atual = 0;
		} else {
			$pagina_atual = (htmlspecialchars($this->input->get('p')) - 1);
		}

		$limite_calculado =  $pagina_atual * $limite_por_pagina;
        // Paginacao


        $id = htmlspecialchars($id);

        $lista = $this->admin_model->get_lista($id);

        if ($lista) {



            if ($lista['provedor'] == 3) {

                $data = array(
                    'lista' => $lista,
                    'leads' => $this->admin_model->get_leads_by_tags($lista['tag'],  $limite_calculado, $limite_por_pagina),
                    'total_pages' => intval(ceil(count($this->admin_model->get_leads_by_tags($lista['tag'])) / $limite_por_pagina)),
                );

                
                $this->load->view('admin/sales/lista_leads_xmailer', $data);

            } else {

                $data = array(
                    'lista' => $lista,
                    'leads' => $this->admin_model->get_leads_by_tags($lista['tag'],  $limite_calculado, $limite_por_pagina),
                    'total_pages' => intval(ceil(count($this->admin_model->get_leads_by_tags($lista['tag'])) / $limite_por_pagina)),
                );

                $this->load->view('admin/sales/lista_leads', $data);
            }

        } else {

            redirect(base_url('sales/listas'));
        }
    }

    public function listas_tags($tag_id)
    {

        $tag = $this->admin_model->get_item($tag_id);

        if ($tag) {


            $data = array(
                'tag' => $tag_id
            );

            $this->load->view('admin/sales/listas_tags', $data);
        } else {
            redirect(base_url('sales/listas'));
        }
    }


    public function lista_editar($id)
    {
        $id = htmlspecialchars($id);

        $lista = $this->admin_model->get_lista($id);

        if ($lista) {



            $data = array(
                'lista' => $lista,
            );

            $this->load->view('admin/sales/lista_editar', $data);
        } else {

            redirect(base_url('sales/listas'));
        }
    }

    public function campanhas()
    {
        $this->load->view('admin/sales/campanhas');
    }

    public function campanhas_produtos($produt_id)
    {
        $produto = $this->admin_model->get_produto($produt_id);

        if ($produto) {


            $data = array(
                'produto' => $produt_id

            );

            $this->load->view('admin/sales/campanhas_produtos', $data);
        } else {
            redirect(base_url('sales/campanhas'));
        }
    }

    public function campanhas_adicionar()
    {

        $this->load->view('admin/sales/campanhas_adicionar');
    }

    public function campanhas_editar($id)
    {

        $id = htmlspecialchars($id);

        $campanha = $this->admin_model->get_campanha($id);

        if ($campanha) {

            $data = array(
                'campanha' => $campanha,
            );

            $this->load->view('admin/sales/campanhas_editar', $data);
        } else {

            redirect(base_url('sales/campanhas'));
        }
    }

    public function campanhas_reports($id)
    {

        $id = htmlspecialchars($id);

        $campanha = $this->admin_model->get_campanha($id);

        if ($campanha) {


            $data = array(
                'campanha' => $campanha,
            );

            $this->load->view('admin/sales/campanhas_reports', $data);
        } else {

            redirect(base_url('sales/campanhas'));
        }
    }

    public function campanhas_links($id)
    {

        $id = htmlspecialchars($id);

        $campanha = $this->admin_model->get_campanha($id);

        if ($campanha) {


            $data = array(
                'campanha' => $campanha,
            );

            $this->load->view('admin/sales/campanhas_links', $data);
        } else {

            redirect(base_url('sales/campanhas'));
        }
    }

    public function campanhas_sales($id)
    {

        $id = htmlspecialchars($id);

        $campanha = $this->admin_model->get_campanha($id);

        if ($campanha) {


            $data = array(
                'campanha' => $campanha,
            );

            $this->load->view('admin/sales/campanhas_sales', $data);
        } else {

            redirect(base_url('sales/campanhas'));
        }
    }
    public function campanhas_prospection($id)
    {

        $id = htmlspecialchars($id);

        $campanha = $this->admin_model->get_campanha($id);

        if ($campanha) {


            $data = array(
                'campanha' => $campanha,
            );

            $this->load->view('admin/sales/campanhas_prospection', $data);
        } else {

            redirect(base_url('sales/campanhas'));
        }
    }

    public function produtos_adicionar()
    {

        $this->load->view('admin/sales/produtos_adicionar');
    }


    public function produtos_editar($id)
    {

        $id = htmlspecialchars($id);

        $produto = $this->admin_model->get_produto($id);

        if ($produto) {


            $data = array(
                'produto' => $produto,
            );

            $this->load->view('admin/sales/produtos_editar', $data);
        } else {

            redirect(base_url('sales/produtos'));
        }
    }


    public function act_add_produto()
    {

        $nome = htmlspecialchars($this->input->post('nome'));
        $imagem = htmlspecialchars($this->input->post('imagem'));
        $preco = htmlspecialchars($this->input->post('preco'));
        $plataforma = htmlspecialchars($this->input->post('plataforma'));
        $categoria = htmlspecialchars($this->input->post('categoria'));
        $pagina_de_vendas  = htmlspecialchars($this->input->post('pagina_de_vendas'));
        $descricao = htmlspecialchars($this->input->post('descricao'));



        if ($this->admin_model->add_produto($nome, $imagem, $preco, $plataforma, $categoria, $pagina_de_vendas, $descricao)) {

            $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao adicionar.');
        }

        print_r(json_encode($response));
    }

    public function act_update_produto()
    {
        $id = htmlspecialchars($this->input->post('id'));

        $nome = htmlspecialchars($this->input->post('nome'));
        $imagem = htmlspecialchars($this->input->post('imagem'));
        $preco = htmlspecialchars($this->input->post('preco'));
        $plataforma = htmlspecialchars($this->input->post('plataforma'));
        $categoria = htmlspecialchars($this->input->post('categoria'));
        $pagina_de_vendas  = htmlspecialchars($this->input->post('pagina_de_vendas'));
        $descricao = htmlspecialchars($this->input->post('descricao'));



        if ($this->admin_model->update_produto($id,  $nome, $imagem, $preco, $plataforma, $categoria, $pagina_de_vendas, $descricao)) {

            $response = array('status' => 'true', 'message' => 'Atualizado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao Atualizar.');
        }

        print_r(json_encode($response));
    }

    public function act_delete_classificacao_special() {
        $person_id = htmlspecialchars($this->input->post('person_id'));
        $tag_id = htmlspecialchars($this->input->post('tag_id'));

        if ($this->admin_model->delete_classificacao_especial($person_id, $tag_id)) {

            $response = array('status' => 'true', 'message' => 'Excluido com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Excluido com sucesso.');
        }

        print_r(json_encode($response));
    }

    public function act_delete_produto()
    {

        $id = htmlspecialchars($this->input->post('id'));

        if ($this->admin_model->delete_produto($id)) {

            $response = array('status' => 'true', 'message' => 'Excluido com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Excluido com sucesso.');
        }

        print_r(json_encode($response));
    }

    public function act_add_campanha()
    {

        $nome = htmlspecialchars($this->input->post('nome'));
        $descricao = htmlspecialchars($this->input->post('descricao'));
        $produto = htmlspecialchars($this->input->post('produto'));
        $tipo = htmlspecialchars($this->input->post('tipo'));
        $provedor = htmlspecialchars($this->input->post('provedor'));
        $email_content = htmlspecialchars($this->input->post('email_content'));
        $status = htmlspecialchars($this->input->post('status'));

        $provedor_campanha_id = htmlspecialchars($this->input->post('provedor_campanha_id'));
        $lista = htmlspecialchars($this->input->post('lista'));
        $classificacao = htmlspecialchars($this->input->post('classificacao'));




        if ($this->admin_model->add_campanha($nome, $descricao, $produto, $tipo, $provedor, $email_content, $status, $provedor_campanha_id, $lista, $classificacao)) {

            $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao adicionar.');
        }

        print_r(json_encode($response));
    }

    public function act_update_campanha()
    {


        $id = htmlspecialchars($this->input->post('id'));

        $nome = htmlspecialchars($this->input->post('nome'));
        $descricao = htmlspecialchars($this->input->post('descricao'));
        $produto = htmlspecialchars($this->input->post('produto'));
        $tipo = htmlspecialchars($this->input->post('tipo'));
        $provedor = htmlspecialchars($this->input->post('provedor'));
        $email_content = htmlspecialchars($this->input->post('email_content'));
        $status = htmlspecialchars($this->input->post('status'));

        $provedor_campanha_id = htmlspecialchars($this->input->post('provedor_campanha_id'));
        $lista = htmlspecialchars($this->input->post('lista'));
        $classificacao = htmlspecialchars($this->input->post('classificacao'));



        if ($this->admin_model->update_campanha($id, $nome, $descricao, $produto, $tipo,  $provedor, $email_content, $status,  $provedor_campanha_id, $lista, $classificacao)) {

            $response = array('status' => 'true', 'message' => 'Atualizado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao adicionar.');
        }

        print_r(json_encode($response));
    }

    public function act_delete_campanha()
    {

        $id = htmlspecialchars($this->input->post('id'));

        if ($this->admin_model->delete_campanha($id)) {

            $response = array('status' => 'true', 'message' => 'Excluido com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Excluido com sucesso.');
        }

        print_r(json_encode($response));
    }



    public function act_add_lista()
    {

        $nome = htmlspecialchars($this->input->post('nome'));
        $descricao = htmlspecialchars($this->input->post('descricao'));
        $tag = htmlspecialchars($this->input->post('tag'));
        $classificacao = htmlspecialchars($this->input->post('classificacao'));
        $importacao = htmlspecialchars($this->input->post('importacao'));

        $provedor = htmlspecialchars($this->input->post('provedor'));

        $campanha_associada = htmlspecialchars($this->input->post('campanha_associada'));

        if ($classificacao == 1) {
            $nome =  "[prosp] " . $nome;
        } else if ($classificacao == 2) {
            $nome =  "[atv] " . $nome;
        } else if ($classificacao == 3) {
            $nome =  "[rec] " . $nome;
        }

        if ($importacao == 2 && strlen($campanha_associada) == 0) {

            $response = array('status' => 'false', 'message' => 'Adicione uma campanha associada para importação manual..');

            
        } else {

            $lista_id = $this->brevo_model->createList($nome)['id'];

            if ($this->admin_model->add_lista($nome, $descricao, $tag, $lista_id, $classificacao, $importacao, $campanha_associada, $provedor)) {
                $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
            } else {
                $response = array('status' => 'false', 'message' => 'Erro ao adicionar.');
            }

        }

        print_r(json_encode($response));
    }

    public function act_update_lista()
    {
        $id = htmlspecialchars($this->input->post('id'));
        $nome = htmlspecialchars($this->input->post('nome'));
        $descricao = htmlspecialchars($this->input->post('descricao'));
        $tag = htmlspecialchars($this->input->post('tag'));
        $importacao = htmlspecialchars($this->input->post('importacao'));

        $provedor = htmlspecialchars($this->input->post('provedor'));

        $classificacao = htmlspecialchars($this->input->post('classificacao'));
        $campanha_associada = htmlspecialchars($this->input->post('campanha_associada'));


        if ($importacao == 2 && strlen($campanha_associada) == 0) {

            $response = array('status' => 'false', 'message' => 'Adicione uma campanha associada para importação manual..');
         
        } else {

            if ($this->admin_model->update_lista($id, $nome, $descricao, $tag, $classificacao, $importacao, $campanha_associada, $provedor)) {

                $response = array('status' => 'true', 'message' => 'Atualizado com sucesso.');
            } else {

                $response = array('status' => 'false', 'message' => 'Erro ao adicionar.');
            }

        }

        print_r(json_encode($response));
    }


    public function act_delete_lista()
    {

        $id = htmlspecialchars($this->input->post('id'));

        if ($this->admin_model->delete_lista($id)) {

            $response = array('status' => 'true', 'message' => 'Excluido com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Excluido com sucesso.');
        }

        print_r(json_encode($response));
    }



    public function act_update_prospeccao()
    {


        $id = htmlspecialchars($this->input->post('id'));

        $contactado = htmlspecialchars($this->input->post('contactado'));
        $contactado_via = htmlspecialchars($this->input->post('contactado_via'));
        $contactado_data = htmlspecialchars($this->input->post('contactado_data'));



        if ($this->admin_model->update_prospeccao($id,  $contactado, $contactado_via, $contactado_data)) {

            $response = array('status' => 'true', 'message' => 'Atuaflizado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao Atualizar.');
        }

        print_r(json_encode($response));
    }

    public function act_get_prospeccao_data()
    {

        $id = htmlspecialchars($this->input->post('id'));



        if ($this->admin_model->get_prospeccao($id)) {

            $response = $this->admin_model->get_prospeccao($id);
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao adicionar.');
        }

        print_r(json_encode($response));
    }



    public function act_delete_prospeccao()
    {

        $id = htmlspecialchars($this->input->post('id'));

        if ($this->admin_model->delete_prospeccao($id)) {

            $response = array('status' => 'true', 'message' => 'Excluido com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Excluido com sucesso.');
        }

        print_r(json_encode($response));
    }

    public function act_delete_vendas()
    {

        $id = htmlspecialchars($this->input->post('id'));

        if ($this->admin_model->delete_venda($id)) {

            $response = array('status' => 'true', 'message' => 'Excluido com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Excluido com sucesso.');
        }

        print_r(json_encode($response));
    }

    public function act_seach_leads()
    {
        $query = htmlspecialchars($this->input->post('query'));


        if (count($this->admin_model->searchLeads($query)) > 0) {

            foreach ($this->admin_model->searchLeads($query) as $c) {


                echo '<li style="padding-top: 5px;"> 
                        <input style="width:22px;height:22px" name="lead_id[]" value="' . $c . '" type="radio">
                        <small>[';


                if ($this->admin_model->get_emails_validated($c)) {
                    echo $this->admin_model->get_emails_validated($c)['email'];
                } else {
                    echo "-";
                }

                echo "] - [";

                if ($this->admin_model->get_telefones_validated($c)) {
                    echo $this->admin_model->get_telefones_validated($c)['telefone'];
                } else {
                    echo "-";
                }
                echo ']</small>';

                echo '</li>';
            }
        } else {

            echo "<center><p class='mt-5 mb-5'>NENHUM LEAD ENCONTRADO</p></center>";
        }
    }

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

        if ($this->admin_model->add_venda($campanha_id, $produto_id, $lead_id, $data,  $valor, $provedor, $provedor_venda_id, $tipo)) {

            $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Erro ao adicionar.');
        }

        print_r(json_encode($response));
    }

    public function act_add_link()
    {

        $campanha_id = htmlspecialchars($this->input->post('campanha_id'));
        $type = htmlspecialchars($this->input->post('type'));


        if (!$this->admin_model->check_link($campanha_id, $type)) {

            if ($this->admin_model->add_link($campanha_id, $type)) {
                $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
            } else {
                $response = array('status' => 'false', 'message' => 'Erro ao adicionar.');
            }
        } else {
            $response = array('status' => 'false', 'message' => 'Já existe.');
        }

        print_r(json_encode($response));
    }

    public function act_add_sincronizacao()
    {

        // $lista_id = htmlspecialchars($this->input->post('lista_id'));
        // $quantidade_max =  htmlspecialchars($this->input->post('quantidade_max'));
        // $importacao =  htmlspecialchars($this->input->post('importacao'));
        // $campanha_associada =  htmlspecialchars($this->input->post('campanha_associada'));

        $lista_id = htmlspecialchars($this->input->get('lista_id'));
        $quantidade_max =  htmlspecialchars($this->input->get('quantidade_max'));
        $importacao =  htmlspecialchars($this->input->get('importacao'));
        $campanha_associada =  htmlspecialchars($this->input->get('campanha_associada'));

        //   $lista_id = 8;
        //   $quantidade_max = 100;

        $lista_data = $this->admin_model->get_lista($lista_id);

        // Capturando os leads baseado na lista e que ainda nao foram processados.

        if ($importacao == 1) {

            // echo "IMPORTACAO 1";


            $persons = $this->admin_model->getLeadsToSynchronize($lista_id, $lista_data['tag'], $quantidade_max);

        } else if ($importacao == 2) {


            // echo "IMPORTACAO 2";

            $persons = $this->admin_model->getLeadsToSynchronizeCampanhaAssociada($lista_id, $campanha_associada, $quantidade_max);

        }


        // print_r($json_data);
        if ($importacao == 1) {

            if (count($persons) > 0) {


                //  Sincronizando leads com a Brevo 
                $json_data = "NOME;SOBRENOME;EMAIL;WHATSAPP;SMS";
    
                foreach ($persons as $p) {
    
                    $leads_data = $this->admin_model->get_person($p->person_id);
    
                    $n = explode(" ", $leads_data['nome']);
    
    
                    $json_data .= "\\n" . $n[0] . ";" . $n[1] . "" . $leads_data['email'] . ";" . $this->admin_model->get_emails_validated($p->person_id)['email'] . ";" . $this->admin_model->get_telefones_validated($p->person_id)['telefone'] . ";" . $this->admin_model->get_telefones_validated($p->person_id)['telefone'];
    
                    // print_r($leads_data);
                }
    
                $import_process = $this->brevo_model->importContatos($lista_data['provedor_lista_id'], $json_data);
    
                // print_r($import_process);
    
                if ($import_process['processId']) {
    
                    $data = array(
                        'process_id' => $import_process['processId'],
                        'quantidade' => count($persons),
                        'quantidade_max' => $quantidade_max,
                        'lista_id' => $lista_id,
                        // 'lista_provedor_id' => $lista_data['provedor_lista_id'],
                        'process_data' => date('d-m-Y H:i:s'),
                        'status' => 1,
                    );
    
                    if ($this->admin_model->addSincronizacao($data)) {
    
                        foreach ($persons as $p) {
    
                            $data = array(
                                'provedor' => 'brevo',
                                'person_id' => $p->person_id,
                                'lista_id' => $lista_id,
                                'lista_provedor_id' => $lista_data['provedor_lista_id'],
                                'data' => date('d-m-Y H:i:s'),
                                'process_id' => $import_process['processId'],
                                'is_deleted' => 0
                            );
    
                            $this->admin_model->addLeadsSincronizado($data);
                        }
    
                        $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
                    } else {
    
                        $data = array(
                            'process_id' => 0,
                            'quantidade' => count($persons),
                            'quantidade_max' => $quantidade_max,
                            'lista_id' => $lista_id,
                            'process_data' => date('d-m-Y H:i:s'),
                            'status' => 0,
                        );
    
    
                        // Faljou 
                        $this->admin_model->addSincronizacao($data);
                        $response = array('status' => 'false', 'message' => 'Erro ao adicionar.');
                    }
                } else {
    
                    $data = array(
                        'process_id' => 0,
                        'quantidade' => count($persons),
                        'quantidade_max' => $quantidade_max,
                        'lista_id' => $lista_id,
                        'process_data' => date('d-m-Y H:i:s'),
                        'status' => 0,
                    );
    
    
    
                    // Faljou 
                    $this->admin_model->addSincronizacao($data);
    
                    $response = array('status' => 'false', 'message' => 'Erro ao adicionar.');
                }
            } else {
    
                $response = array('status' => 'false', 'message' => 'Nao existem mais leads para serem adicionados.');
            }

        } else if ($importacao == 2) {

            if (count($persons) > 0) {


                //  Sincronizando leads com a Brevo 
                $json_data = "NOME;SOBRENOME;EMAIL;WHATSAPP;SMS";
    
                foreach ($persons as $p) {
    
                    $leads_data = $this->admin_model->get_person($p->lead_id);
    
                    $n = explode(" ", $leads_data['nome']);
    
    
                    $json_data .= "\\n" . $n[0] . ";" . $n[1] . "" . $leads_data['email'] . ";" . $this->admin_model->get_emails_validated($p->lead_id)['email'] . ";" . $this->admin_model->get_telefones_validated($p->lead_id)['telefone'] . ";" . $this->admin_model->get_telefones_validated($p->lead_id)['telefone'];
    
                    // print_r($leads_data);
                }
    
                $import_process = $this->brevo_model->importContatos($lista_data['provedor_lista_id'], $json_data);
    
                // print_r($import_process);
    
                if ($import_process['processId']) {
    
                    $data = array(
                        'process_id' => $import_process['processId'],
                        'quantidade' => count($persons),
                        'quantidade_max' => $quantidade_max,
                        'lista_id' => $lista_id,
                        // 'lista_provedor_id' => $lista_data['provedor_lista_id'],
                        'process_data' => date('d-m-Y H:i:s'),
                        'status' => 1,
                    );
    
                    if ($this->admin_model->addSincronizacao($data)) {
    
                        foreach ($persons as $p) {
    
                            $data = array(
                                'provedor' => 'brevo',
                                'person_id' => $p->lead_id,
                                'lista_id' => $lista_id,
                                'lista_provedor_id' => $lista_data['provedor_lista_id'],
                                'data' => date('d-m-Y H:i:s'),
                                'process_id' => $import_process['processId'],
                                'is_deleted' => 0
                            );
    
                            $this->admin_model->addLeadsSincronizado($data);
                        }
    
                        $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
                    } else {
    
                        $data = array(
                            'process_id' => 0,
                            'quantidade' => count($persons),
                            'quantidade_max' => $quantidade_max,
                            'lista_id' => $lista_id,
                            'process_data' => date('d-m-Y H:i:s'),
                            'status' => 0,
                        );
    
    
                        // Faljou 
                        $this->admin_model->addSincronizacao($data);
                        $response = array('status' => 'false', 'message' => 'Erro ao adicionar.');
                    }
                } else {
    
                    $data = array(
                        'process_id' => 0,
                        'quantidade' => count($persons),
                        'quantidade_max' => $quantidade_max,
                        'lista_id' => $lista_id,
                        'process_data' => date('d-m-Y H:i:s'),
                        'status' => 0,
                    );
    
    
    
                    // Faljou 
                    $this->admin_model->addSincronizacao($data);
    
                    $response = array('status' => 'false', 'message' => 'Erro ao adicionar.');
                }
            } else {
    
                $response = array('status' => 'false', 'message' => 'Nao existem mais leads para serem adicionados.');
            }

        }


        //  Adicionando os leads processados



        //  Adicionando o processo de leads
        print_r(json_encode($response));
    }

    public function act_add_sincronizacao_probe()
    {

        $lista_id = htmlspecialchars($this->input->post('lista_id'));
        $quantidade_max =  htmlspecialchars($this->input->post('quantidade_max'));

        //   $lista_id = 8;
        //   $quantidade_max = 100;

        $lista_data = $this->admin_model->get_lista($lista_id);

        // Capturando os leads baseado na lista e que ainda nao foram processados.
        $persons = $this->admin_model->getLeadsToSynchronize($lista_id, $lista_data['tag'], $quantidade_max);


        // print_r($json_data);
        if (count($persons) > 0) {


            $import_process = mt_rand();

            if ($import_process) {

                $data = array(
                    'process_id' => $import_process,
                    'quantidade' => count($persons),
                    'quantidade_max' => $quantidade_max,
                    'lista_id' => $lista_id,
                    // 'lista_provedor_id' => $lista_data['provedor_lista_id'],
                    'process_data' => date('d-m-Y H:i:s'),
                    'status' => 1,
                );

                if ($this->admin_model->addSincronizacao($data)) {

                    foreach ($persons as $p) {

                        $data = array(
                            'provedor' => 'probe',
                            'person_id' => $p->person_id,
                            'lista_id' => $lista_id,
                            'lista_provedor_id' => $lista_data['provedor_lista_id'],
                            'data' => date('d-m-Y H:i:s'),
                            'process_id' => $import_process,
                            'is_deleted' => 0
                        );

                        $this->admin_model->addLeadsSincronizado($data);
                        #
                        $this->admin_model->addLeadsProbe($data);
                    }

                    $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
                } else {

                    $data = array(
                        'process_id' => 0,
                        'quantidade' => count($persons),
                        'quantidade_max' => $quantidade_max,
                        'lista_id' => $lista_id,
                        'process_data' => date('d-m-Y H:i:s'),
                        'status' => 0,
                    );


                    // Faljou 
                    $this->admin_model->addSincronizacao($data);
                    $response = array('status' => 'false', 'message' => 'Erro ao adicionar.');
                }
            } else {

                $data = array(
                    'process_id' => 0,
                    'quantidade' => count($persons),
                    'quantidade_max' => $quantidade_max,
                    'lista_id' => $lista_id,
                    'process_data' => date('d-m-Y H:i:s'),
                    'status' => 0,
                );



                // Faljou 
                $this->admin_model->addSincronizacao($data);

                $response = array('status' => 'false', 'message' => 'Erro ao adicionar.');
            }
        } else {

            $response = array('status' => 'false', 'message' => 'Nao existem mais leads para serem adicionados.');
        }


        //  Adicionando os leads processados



        //  Adicionando o processo de leads
        print_r(json_encode($response));
    }
}
