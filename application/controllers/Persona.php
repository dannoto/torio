<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Persona extends CI_Controller
{

    function __construct()
    {

        parent::__construct();

        $this->load->model('admin_model');
        $this->load->model('brevo_model');
        $this->load->model('process_model');
    }

    public function lista()
    {

        if (!$this->input->get('filter')) {
            redirect(base_url() . 'persona/lista?filter=pessoa_juridica');
        }

        $this->load->view('admin/persona/persona_lista');
    }

    public function tarefas()
    {

        if ($this->input->get()) {

            $tag = htmlspecialchars($this->input->get('tarefa_tag'));
            $status = htmlspecialchars($this->input->get('tarefa_status'));

            $data = array(
                'tarefas' => $this->admin_model->getTarefasSearch($tag, $status)
            );
        } else {

            $data = array(
                'tarefas' => $this->admin_model->getTarefas()
            );
        }

        $this->load->view('admin/persona/persona_tarefas', $data);
    }

    public function tarefas_adicionar()
    {
        $data = array();

        $this->load->view('admin/persona/persona_tarefas_adicionar', $data);
    }


    public function tarefas_leads($id)
    {

        // Paginacao
        $limite_por_pagina = 30;

        if (htmlspecialchars($this->input->get('p')) <= 0) {
            $pagina_atual = 0;
        } else {
            $pagina_atual = (htmlspecialchars($this->input->get('p')) - 1);
        }

        $limite_calculado =  $pagina_atual * $limite_por_pagina;
        // Paginacao

        $tarefa =  $this->admin_model->getTarefa($id);

        if ($tarefa) {

            if ($this->input->get()) {


                $inapto = htmlspecialchars($this->input->get('inapto'));
                $convertido = htmlspecialchars($this->input->get('convertido'));


                if ($this->input->get('p')) {

                    $data = array(
                        't' => $tarefa,
                        'leads' => $this->admin_model->getInstagramLeadsByTask($tarefa['id'],  $limite_calculado, $limite_por_pagina),
                        'total_pages' => intval(ceil(count($this->admin_model->getInstagramLeadsByTask($tarefa['id'])) / $limite_por_pagina)),
                    );
                } else {
                    $data = array(
                        't' => $tarefa,
                        'leads' =>  $this->admin_model->getInstagramLeadsByTaskSearch($tarefa['id'], $inapto, $convertido)
                    );
                }
            } else {

                // $data = array(
                //     't' => $tarefa,
                //     'leads' => $this->admin_model->getInstagramLeadsByTask($tarefa['id'])
                // );



                $data = array(
                    't' => $tarefa,
                    'leads' => $this->admin_model->getInstagramLeadsByTask($tarefa['id'],  $limite_calculado, $limite_por_pagina),
                    'total_pages' => intval(ceil(count($this->admin_model->getInstagramLeadsByTask($tarefa['id'])) / $limite_por_pagina)),
                );
            }

            $this->load->view('admin/persona/persona_tarefas_leads', $data);
        } else {
            redirect(base_url('persona/tarefas'));
        }
    }


    public function tarefas_editar($id)
    {

        $tarefa =  $this->admin_model->getTarefa($id);

        if ($tarefa) {

            $data = array(
                't' => $tarefa
            );

            $this->load->view('admin/persona/persona_tarefas_editar', $data);
        } else {
            redirect(base_url('persona/tarefas'));
        }
    }




    public function adicionar()
    {

        $this->load->view('admin/persona/persona_adicionar');
    }
    public function editar($id)
    {

        $persona =  $this->admin_model->get_person($id);

        if ($persona) {

            $data = array(
                'p' => $persona
            );

            $this->load->view('admin/persona/persona_editar', $data);
        } else {
            redirect(base_url('persona/lista'));
        }
    }


    public function classificacao()
    {

        $this->load->view('admin/persona/persona_classificacao');
    }

    public function categorias()
    {

        $this->load->view('admin/persona/persona_categorias');
    }

    public function subcategorias()
    {

        $this->load->view('admin/persona/persona_subcategorias');
    }

    public function intensidade()
    {

        $this->load->view('admin/persona/persona_intensidade');
    }

    public function tags()
    {

        $this->load->view('admin/persona/persona_tags');
    }

    // Actions

    // Catejoria
    public function act_delete_categoria()
    {

        $categoria_id = htmlspecialchars($this->input->post('categoria_id'));

        if ($this->admin_model->delete_categoria($categoria_id)) {

            $response = array('status' => 'true', 'message' => 'Excluido com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Excluido com sucesso.');
        }

        print_r(json_encode($response));
    }

    public function act_add_categoria()
    {
        $nome = htmlspecialchars($this->input->post('nome'));
        $slug = htmlspecialchars($this->input->post('slug'));
        $descricao = htmlspecialchars($this->input->post('descricao'));


        if ($this->admin_model->add_categoria($nome, $slug, $descricao)) {

            $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Adicionado com sucesso.');
        }

        print_r(json_encode($response));
    }

    public function act_update_categoria()
    {

        $id = htmlspecialchars($this->input->post('id'));
        $nome = htmlspecialchars($this->input->post('nome'));
        $slug = htmlspecialchars($this->input->post('slug'));
        $descricao = htmlspecialchars($this->input->post('descricao'));


        if ($this->admin_model->update_categoria($id, $nome, $slug, $descricao)) {

            $response = array('status' => 'true', 'message' => 'Atualizado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Atualizado com sucesso.');
        }

        print_r(json_encode($response));
    }

    public function act_get_categoria()
    {

        $categoria_id = htmlspecialchars($this->input->post('categoria_id'));


        if ($this->admin_model->get_categoria($categoria_id)) {

            $response = $this->admin_model->get_categoria($categoria_id);
        } else {

            $response = array('status' => 'false', 'message' => 'Atualizado com sucesso.');
        }

        print_r(json_encode($response));
    }
    // Catejoria


    // SubCatejoria
    public function act_delete_subcategoria()
    {

        $subcategoria_id = htmlspecialchars($this->input->post('subcategoria_id'));

        if ($this->admin_model->delete_subcategoria($subcategoria_id)) {

            $response = array('status' => 'true', 'message' => 'Excluido com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Excluido com sucesso.');
        }

        print_r(json_encode($response));
    }

    public function act_add_subcategoria()
    {
        $nome = htmlspecialchars($this->input->post('nome'));
        $slug = htmlspecialchars($this->input->post('slug'));
        $categoria_id = htmlspecialchars($this->input->post('categoria_id'));

        $descricao = htmlspecialchars($this->input->post('descricao'));


        if ($this->admin_model->add_subcategoria($nome, $categoria_id, $slug, $descricao)) {

            $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Adicionado com sucesso.');
        }

        print_r(json_encode($response));
    }

    public function act_update_subcategoria()
    {

        $id = htmlspecialchars($this->input->post('id'));
        $nome = htmlspecialchars($this->input->post('nome'));
        $slug = htmlspecialchars($this->input->post('slug'));
        $categoria_id = htmlspecialchars($this->input->post('categoria_id'));

        $descricao = htmlspecialchars($this->input->post('descricao'));


        if ($this->admin_model->update_subcategoria($id, $nome, $categoria_id, $slug, $descricao)) {

            $response = array('status' => 'true', 'message' => 'Atualizado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Atualizado com sucesso.');
        }

        print_r(json_encode($response));
    }

    public function act_get_subcategoria()
    {

        $subcategoria_id = htmlspecialchars($this->input->post('subcategoria_id'));


        if ($this->admin_model->get_subcategoria($subcategoria_id)) {

            $response = $this->admin_model->get_subcategoria($subcategoria_id);
        } else {

            $response = array('status' => 'false', 'message' => 'Atualizado com sucesso.');
        }

        print_r(json_encode($response));
    }
    // SubCatejoria



    // Catejoria
    public function act_delete_intensidade()
    {

        $intensidade_id = htmlspecialchars($this->input->post('intensidade_id'));

        if ($this->admin_model->delete_intensidade($intensidade_id)) {

            $response = array('status' => 'true', 'message' => 'Excluido com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Excluido com sucesso.');
        }

        print_r(json_encode($response));
    }

    public function act_add_intensidade()
    {
        $nome = htmlspecialchars($this->input->post('nome'));
        $slug = htmlspecialchars($this->input->post('slug'));
        $descricao = htmlspecialchars($this->input->post('descricao'));


        if ($this->admin_model->add_intensidade($nome, $slug, $descricao)) {

            $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Adicionado com sucesso.');
        }

        print_r(json_encode($response));
    }

    public function act_update_intensidade()
    {

        $id = htmlspecialchars($this->input->post('id'));
        $nome = htmlspecialchars($this->input->post('nome'));
        $slug = htmlspecialchars($this->input->post('slug'));
        $descricao = htmlspecialchars($this->input->post('descricao'));


        if ($this->admin_model->update_intensidade($id, $nome, $slug, $descricao)) {

            $response = array('status' => 'true', 'message' => 'Atualizado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Atualizado com sucesso.');
        }

        print_r(json_encode($response));
    }

    public function act_get_intensidade()
    {

        $intensidade_id = htmlspecialchars($this->input->post('intensidade_id'));


        if ($this->admin_model->get_intensidade($intensidade_id)) {

            $response = $this->admin_model->get_intensidade($intensidade_id);
        } else {

            $response = array('status' => 'false', 'message' => 'Atualizado com sucesso.');
        }

        print_r(json_encode($response));
    }
    // Catejoria


    // Ta
    public function act_get_subcategoria_by_categoria()
    {

        $categoria_id = htmlspecialchars($this->input->post('categoria_id'));

        echo '<option value="">Selecionar</option>';

        foreach ($this->admin_model->get_subcategorias_by_cat($categoria_id) as $c) {

            echo '<option value="' . $c->id . '">' . $c->nome . '</option>';
        }
    }

    public function act_get_tag_by_subcategoria()
    {

        $subcategoria_id = htmlspecialchars($this->input->post('subcategoria_id'));

        echo '<option value="">Selecionar</option>';
        foreach ($this->admin_model->get_tags_by_subcat($subcategoria_id) as $c) {

            echo '<option value="' . $c->id . '">' . $c->nome . '</option>';
        }
    }

    public function act_delete_tag()
    {

        $tag_id = htmlspecialchars($this->input->post('tag_id'));

        if ($this->admin_model->delete_item($tag_id)) {

            $response = array('status' => 'true', 'message' => 'Excluido com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Excluido com sucesso.');
        }

        print_r(json_encode($response));
    }

    public function act_add_tag()
    {

        $nome = htmlspecialchars($this->input->post('nome'));
        $slug = htmlspecialchars($this->input->post('slug'));
        $categoria_id = htmlspecialchars($this->input->post('categoria_id'));
        $subcategoria_id = htmlspecialchars($this->input->post('subcategoria_id'));
        $descricao = htmlspecialchars($this->input->post('descricao'));


        if ($this->admin_model->add_item($nome, $slug, $descricao, $categoria_id, $subcategoria_id)) {

            $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Adicionado com sucesso.');
        }

        print_r(json_encode($response));
    }

    public function act_update_tag()
    {

        $id = htmlspecialchars($this->input->post('id'));
        $nome = htmlspecialchars($this->input->post('nome'));
        $slug = htmlspecialchars($this->input->post('slug'));
        $categoria_id = htmlspecialchars($this->input->post('categoria_id'));
        $subcategoria_id = htmlspecialchars($this->input->post('subcategoria_id'));


        $descricao = htmlspecialchars($this->input->post('descricao'));


        if ($this->admin_model->update_item($id, $nome, $slug, $descricao, $categoria_id, $subcategoria_id)) {

            $response = array('status' => 'true', 'message' => 'Atualizado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Atualizado com sucesso.');
        }

        print_r(json_encode($response));
    }

    public function act_get_tag()
    {

        $tag_id = htmlspecialchars($this->input->post('tag_id'));


        if ($this->admin_model->get_item($tag_id)) {

            $response = $this->admin_model->get_item($tag_id);
        } else {

            $response = array('status' => 'false', 'message' => 'Atualizado com sucesso.');
        }

        print_r(json_encode($response));
    }



    public function act_get_cidades()
    {

        $estado_id = htmlspecialchars($this->input->post('estado_id'));


        foreach ($this->admin_model->get_cidades_by_estado($estado_id) as $c) {

            echo '<option value="' . $c->id . '">' . $c->nome . '</option>';
        }
    }


    //  Persona

    public function act_get_pessoa()
    {

        $id = htmlspecialchars($this->input->post('id'));

        if ($this->admin_model->get_person($id)) {

            $response = $this->admin_model->get_person($id);
        } else {

            $response = array('status' => 'false', 'message' => 'Excluido com sucesso.');
        }

        print_r(json_encode($response));
    }


    public function act_add_pessoa()
    {

        $data['nome'] = htmlspecialchars($this->input->post('nome'));
        $data['cpf'] = htmlspecialchars($this->input->post('cpf'));
        $data['nascimento'] = htmlspecialchars($this->input->post('nascimento'));
        $data['rg'] = htmlspecialchars($this->input->post('rg'));
        $data['cpf'] = htmlspecialchars($this->input->post('cpf'));
        $data['pis'] = htmlspecialchars($this->input->post('pis'));
        $data['cns'] = htmlspecialchars($this->input->post('cns'));
        $data['sexo'] = htmlspecialchars($this->input->post('sexo'));
        $data['signo'] = htmlspecialchars($this->input->post('signo'));
        $data['escolaridade'] = htmlspecialchars($this->input->post('escolaridade'));
        $data['raca'] = htmlspecialchars($this->input->post('raca'));
        $data['renda'] = htmlspecialchars($this->input->post('renda'));
        $data['estado'] = htmlspecialchars($this->input->post('estado'));
        $data['cidade'] = htmlspecialchars($this->input->post('cidade'));
        $data['tipo'] = htmlspecialchars($this->input->post('tipo'));

        $data['is_deleted'] = 0;



        if ($this->admin_model->add_person($data)) {

            $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Adicionado com sucesso.');
        }

        print_r(json_encode($response));
    }

    public function act_update_pessoa()
    {

        $id = htmlspecialchars($this->input->post('id'));
        $data['nome'] = htmlspecialchars($this->input->post('nome'));
        $data['cpf'] = htmlspecialchars($this->input->post('cpf'));
        $data['nascimento'] = htmlspecialchars($this->input->post('nascimento'));
        $data['rg'] = htmlspecialchars($this->input->post('rg'));
        $data['cpf'] = htmlspecialchars($this->input->post('cpf'));
        $data['pis'] = htmlspecialchars($this->input->post('pis'));
        $data['cns'] = htmlspecialchars($this->input->post('cns'));
        $data['sexo'] = htmlspecialchars($this->input->post('sexo'));
        $data['signo'] = htmlspecialchars($this->input->post('signo'));
        $data['escolaridade'] = htmlspecialchars($this->input->post('escolaridade'));
        $data['raca'] = htmlspecialchars($this->input->post('raca'));
        $data['renda'] = htmlspecialchars($this->input->post('renda'));
        $data['estado'] = htmlspecialchars($this->input->post('estado'));
        $data['cidade'] = htmlspecialchars($this->input->post('cidade'));
        $data['tipo'] = htmlspecialchars($this->input->post('tipo'));



        $data['validacao_telefone'] = htmlspecialchars($this->input->post('validacao_telefone'));
        $data['validacao_email'] = htmlspecialchars($this->input->post('validacao_email'));
        $data['validacao_perfil'] = htmlspecialchars($this->input->post('validacao_perfil'));


        if ($this->admin_model->update_person($id, $data)) {

            $response = array('status' => 'true', 'message' => 'Atualizado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Atualizado com sucesso.');
        }

        print_r(json_encode($response));
    }

    public function act_delete_pessoa()
    {

        $id = htmlspecialchars($this->input->post('id'));

        if ($this->admin_model->delete_person($id)) {

            $response = array('status' => 'true', 'message' => 'Excluido com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Excluido com sucesso.');
        }

        print_r(json_encode($response));
    }

    public function act_delete_email()
    {

        $email_id = htmlspecialchars($this->input->post('email_id'));

        if ($this->admin_model->delete_email($email_id)) {

            $response = array('status' => 'true', 'message' => 'Excluido com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Excluido com sucesso.');
        }

        print_r(json_encode($response));
    }

    public function act_add_email()
    {

        $data['person_id'] = htmlspecialchars($this->input->post('person_id'));
        $data['email'] = htmlspecialchars($this->input->post('email'));
        $data['is_validado'] = htmlspecialchars($this->input->post('is_validado'));

        if ($this->admin_model->add_emails($data)) {

            $response = array('status' => 'true', 'message' => 'Excluido com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Excluido com sucesso.');
        }

        print_r(json_encode($response));
    }

    public function act_add_telefone()
    {

        $data['person_id'] = htmlspecialchars($this->input->post('person_id'));
        $data['ddd'] = htmlspecialchars($this->input->post('ddd'));
        $data['telefone'] = htmlspecialchars($this->input->post('telefone'));
        $data['is_validado'] = htmlspecialchars($this->input->post('is_validado'));

        if ($this->admin_model->add_telefone($data)) {

            $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Adicionado com sucesso.');
        }

        print_r(json_encode($response));
    }

    public function act_delete_classificacao()
    {

        $classificacao_id = htmlspecialchars($this->input->post('classificacao_id'));

        if ($this->admin_model->delete_classificacao($classificacao_id)) {

            $response = array('status' => 'true', 'message' => 'Excluido com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Excluido com sucesso.');
        }

        print_r(json_encode($response));
    }

    public function act_delete_telefone()
    {

        $telefone_id = htmlspecialchars($this->input->post('telefone_id'));

        if ($this->admin_model->delete_telefone($telefone_id)) {

            $response = array('status' => 'true', 'message' => 'Excluido com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Excluido com sucesso.');
        }

        print_r(json_encode($response));
    }

    //  Persona


    public function act_delete_social()
    {

        $social_id = htmlspecialchars($this->input->post('social_id'));

        if ($this->admin_model->delete_social($social_id)) {

            $response = array('status' => 'true', 'message' => 'Excluido com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Excluido com sucesso.');
        }

        print_r(json_encode($response));
    }


    public function act_add_social()
    {

        $data['person_id'] = htmlspecialchars($this->input->post('person_id'));
        $data['nome'] = htmlspecialchars($this->input->post('nome'));
        $data['username'] = htmlspecialchars($this->input->post('username'));
        $data['url'] = htmlspecialchars($this->input->post('url'));
        $data['intensividade'] = htmlspecialchars($this->input->post('intensividade'));
        $data['status'] = htmlspecialchars($this->input->post('status'));

        if ($this->admin_model->add_social($data)) {

            $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Adicionado com sucesso.');
        }

        print_r(json_encode($response));
    }


    public function act_add_classificacao_intensidade()
    {
        $data['person_id'] = htmlspecialchars($this->input->post('person_id'));
        $data['categoria_id'] = htmlspecialchars($this->input->post('categoria_id'));
        $data['intensidade_id'] = htmlspecialchars($this->input->post('intensidade_id'));

        $dados = $this->admin_model->exist_classificacao_intensidade($data['person_id'],  $data['categoria_id']);

        if ($dados) {

            if ($this->admin_model->update_classificacao_intensidade($dados['id'], $data)) {

                $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
            } else {

                $response = array('status' => 'false', 'message' => 'Adicionado com sucesso.');
            }
        } else {

            if ($this->admin_model->add_classificacao_intensidade($data)) {

                $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
            } else {

                $response = array('status' => 'false', 'message' => 'Adicionado com sucesso.');
            }
        }

        print_r(json_encode($response));
    }

    public function act_add_classificacao()
    {

        $data['person_id'] = htmlspecialchars($this->input->post('person_id'));
        $data['categoria_id'] = htmlspecialchars($this->input->post('categoria_id'));
        $data['subcategoria_id'] = htmlspecialchars($this->input->post('subcategoria_id'));
        $data['tag_id'] = htmlspecialchars($this->input->post('tag_id'));
        $data['intensividade_id'] = htmlspecialchars($this->input->post('intensividade_id'));

        if ($this->admin_model->exist_classificacao($data['person_id'],  $data['categoria_id'], $data['subcategoria_id'],  $data['tag_id'])) {


            $response = array('status' => 'false', 'message' => 'Já existe essa classificaçao.');
        } else {
            if ($this->admin_model->add_classificacao($data)) {

                $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
            } else {

                $response = array('status' => 'false', 'message' => 'Adicionado com sucesso.');
            }
        }

        print_r(json_encode($response));
    }


    // Tarefas
    public function act_add_tarefa()
    {
        $data['tarefa_nome'] = htmlspecialchars($this->input->post('tarefa_nome'));
        $data['tarefa_tag'] = htmlspecialchars($this->input->post('tarefa_tag'));
        $data['tarefa_status'] = htmlspecialchars($this->input->post('tarefa_status'));
        $data['tarefa_tipo'] = htmlspecialchars($this->input->post('tarefa_tipo'));
        $data['tarefa_url'] = htmlspecialchars($this->input->post('tarefa_url'));


        if ($this->admin_model->checkTarefaLink($data['tarefa_url'])) {
            $response = array('status' => 'false', 'message' => 'Esta URL já foi processada.');
        } else {
            if ($this->admin_model->addTarefa($data)) {
                $response = array('status' => 'true', 'message' => 'Adicionado com sucesso.');
            } else {
                $response = array('status' => 'false', 'message' => 'Adicionado com sucesso.');
            }
        }



        print_r(json_encode($response));
    }


    public function act_update_insta_lead()
    {


        $lead_id = htmlspecialchars($this->input->post('id'));
        $data['full_name'] = htmlspecialchars($this->input->post('full_name'));
        $data['telefone'] = htmlspecialchars($this->input->post('telefone'));
        $data['email'] = htmlspecialchars($this->input->post('email'));


        if ($this->admin_model->updateInstaLead($lead_id, $data)) {

            $response = array('status' => 'true', 'message' => 'Atualizado com sucesso.');
        } else {
            $response = array('status' => 'false', 'message' => 'Erro ao atualizar.');
        }

        print_r(json_encode($response));
    }


    public function act_convert_apto()
    {

        $lead_id = htmlspecialchars($this->input->post('lead_id'));

        $data = array(
            'inapto' => 0
        );

        if ($this->admin_model->updateInstaLead($lead_id, $data)) {

            $response = array('status' => 'true', 'message' => 'Convertido para apto');
        } else {

            $response = array('status' => 'false', 'message' => 'Falha converter para apto.');
        }

        print_r(json_encode($response));
    }

    public function act_convert_inapto()
    {

        $lead_id = htmlspecialchars($this->input->post('lead_id'));

        $data = array(
            'inapto' => 1
        );

        if ($this->admin_model->updateInstaLead($lead_id, $data)) {

            $response = array('status' => 'true', 'message' => 'Convertido para inapto');
        } else {

            $response = array('status' => 'false', 'message' => 'Falha converter para inapto.');
        }

        print_r(json_encode($response));
    }

    public function act_convert_instalead_to_person()
    {

        $tarefa_id = htmlspecialchars($this->input->post('tarefa_id'));
        $tag_id = htmlspecialchars($this->input->post('tag_id'));
        $username = htmlspecialchars($this->input->post('username'));

        $lead_demanda_data = $this->admin_model->getInstaLeadDemanda($tarefa_id, $tag_id, $username);
        $lead_data = $this->admin_model->getInstaLead($tarefa_id, $tag_id, $username);


        $email_ativo = "";
        if (strlen($lead_data['email']) > 0) {
            $email_ativo = 1;
        } else {
            $email_ativo = 0;
        }

        $is_private = "";
        if ($lead_data['is_private'] == "true") {
            $is_private = 1;
        } else {
            $is_private = 0;
        }


        $telefone_ativo = "";
        if (strlen($lead_data['telefone']) > 0) {
            $telefone_ativo = 1;
        } else {
            $telefone_ativo = 0;
        }


        $intensidade = "";
        if ($lead_demanda_data['interacao_tipo'] == "comentario") {
            $intensidade = "3";
        } else if ($lead_demanda_data['interacao_tipo'] == "like") {
            $intesidade = "5";
        }

        // Verifica se existe persona com username
        $item_data = $this->admin_model->get_item($lead_data['tag_id']);
        $existe_persona = $this->admin_model->getPersonByMediaUsername($lead_data['username']);

        if ($existe_persona) {

            $tag = array(
                'person_id' => $existe_persona['person_id'],
                'categoria_id' => $item_data['categoria_id'],
                'subcategoria_id' => $item_data['subcategoria_id'],
                'tag_id' => $lead_data['tag_id'],
                'intensividade_id' => $intensidade,
                'data' => $lead_demanda_data['interacao_data'],
                'is_deleted' => 0
            );

            $this->process_model->add_classificacao($tag);

            // Status de Coinvertido
            $data = array(
                'convertido' => 1
            );

            if ($this->admin_model->updateInstaLead($lead_data['id'], $data)) {

                $response = array('status' => 'true', 'message' => 'Esta persona já existe. Torne-a inapta.');
            } else {

                $response = array('status' => 'false', 'message' => 'Falha ao adicionar demanda. Lead já existe.');
            }

            print_r(json_encode($response));
        } else {

            // Adicionar Persona

            if ($this->process_model->check_email($lead_data['email'])) {
                $response = array('status' => 'false', 'message' => 'Email ja existe.');
                print_r(json_encode($response));
            } else if ($this->process_model->check_telefone($lead_data['telefone'])) {

                $response = array('status' => 'false', 'message' => 'Telefone ja existe.');
                print_r(json_encode($response));
            } else {


                $person['nome'] = $lead_data['full_name'];
                $person['site'] = $lead_data['links'];

                $person['tipo'] = "pessoa_fisica";
                $person['validacao_email'] = $email_ativo;
                $person['validacao_telefone'] = $telefone_ativo;
                $person['validacao_perfil'] = 1;
                $person['is_deleted'] = 0;


                $person_id = $this->process_model->add_person($person);

                // Adicionar Email
                if (strlen($lead_data['email']) > 0) {

                    $email['person_id'] = $person_id;
                    $email['email'] =  $lead_data['email'];
                    $email['is_validado'] = 1;
                    $email['is_deleted'] = 0;

                    $this->process_model->add_email($email);
                }


                // Adicionar Telefone
                if (strlen($lead_data['telefone']) > 0) {

                    $telefone['person_id'] = $person_id;
                    $telefone['telefone'] = $lead_data['telefone'];
                    $telefone['is_validado'] = 1;
                    $telefone['is_deleted'] = 0;

                    $this->process_model->add_telefone($telefone);
                }

                //  Adicionando Rede Social

                if (!$this->process_model->check_social($lead_data['username'])) {

                    $social['person_id'] = $person_id;
                    $social['username'] = $lead_data['username'];
                    $social['nome'] = 'instagram';
                    $social['url'] =  'https://www.instagram.com/' . $lead_data['username'];
                    $social['status'] = $is_private;
                    $social['intensividade'] = '1';
                    $social['is_deleted'] = 0;

                    $this->process_model->add_social($social);
                }

                // Adicionando tags
                $tag = array(
                    'person_id' => $person_id,
                    'categoria_id' => $item_data['categoria_id'],
                    'subcategoria_id' => $item_data['subcategoria_id'],
                    'tag_id' => $lead_data['tag_id'],
                    'intensividade_id' => $intensidade,
                    'data' => $lead_demanda_data['interacao_data'],
                    'is_deleted' => 0
                );

                $this->process_model->add_classificacao($tag);

                $data = array(
                    'convertido' => 1
                );



                // daniel ribeiro do amaral
                //  to chegando ai ate as 18;38
                if ($this->admin_model->updateInstaLead($lead_data['id'], $data)) {

                    $response = array('status' => 'true', 'message' => 'Adicionado com sucesso');
                } else {

                    $response = array('status' => 'false', 'message' => 'Falha ao adicionar lead.');
                }

                print_r(json_encode($response));
            }
        }
    }

    public function act_delete_tarefa()
    {

        $tarefa_id = htmlspecialchars($this->input->post('tarefa_id'));

        if ($this->admin_model->deleteTarefa($tarefa_id)) {

            $response = array('status' => 'true', 'message' => 'Excluido com sucesso.');
        } else {

            $response = array('status' => 'false', 'message' => 'Excluido com sucesso.');
        }

        print_r(json_encode($response));
    }


    public function act_get_insta_lead_demanda()
    {

        $tarefa_id = htmlspecialchars($this->input->post('tarefa_id'));
        $tag_id = htmlspecialchars($this->input->post('tag_id'));
        $username = htmlspecialchars($this->input->post('username'));


        if ($this->admin_model->getInstaLeadDemanda($tarefa_id, $tag_id, $username)) {

            $lead_demanda_data = $this->admin_model->getInstaLeadDemanda($tarefa_id, $tag_id, $username);
            $lead_data = $this->admin_model->getInstaLead($tarefa_id, $tag_id, $username);

            echo '

            <div class="row">
                        <div class="col-md-12">
                            <p  style="font-weight:bold" >NOME </p>
                            <p>' . $lead_data['full_name'] . '</p>
                        </div>
                </div>

                <div class="row">
                        <div class="col-md-12">
                            <p  style="font-weight:bold" >BIOGRAFIA </p>
                            <p>' . $lead_data['biografia'] . '</p>
                        </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <p style="font-weight:bold">DATA INTERAÇÃO</p>
                    <p>' . $lead_demanda_data['interacao_data'] . '</p>

                </div>
                <div class="col-md-6">
                    <p style="font-weight:bold" >TIPO INTERAÇÃO</p>
                    <p>' . $lead_demanda_data['interacao_tipo'] . '</p>
                </div>
                </div>

                <div class="row">
                        <div class="col-md-12">
                            <p  style="font-weight:bold" >CONTEÚDO INTERAÇÃO</p>
                            <p>' . $lead_demanda_data['interacao_conteudo'] . '</p>
                        </div>
                </div>

                <hr>
                <p  style="font-weight:bold">LINKS</p>
                <div class="row" id="info-links">
                        <ul>';

            $links = explode(",", $lead_data['links']);

            foreach ($links as $l) {
                echo '<li><a target="_blank" href="' . str_replace(" ", "", $l) . '">' . str_replace(" ", "", $l) . '</a></li>';
            }


            echo    '</ul>
                </div>

                <hr>

                <p  style="font-weight:bold">MENÇÕES</p>
                <div class="row" id="info-links">
                        <ul>';

            $mencoes = explode(",", $lead_data['mencoes']);

            foreach ($mencoes as $l) {
                echo '<li><a target="_blank" href="https://instagram.com/' . str_replace(" ", "", $l) . '">' . str_replace(" ", "", $l) . '</a></li>';
            }


            echo   '</ul>
                </div>
            ';
        } else {
            echo "nada encontrado.";
        }
    }


    public function act_get_insta_lead()
    {
        $tarefa_id = htmlspecialchars($this->input->post('tarefa_id'));
        $tag_id = htmlspecialchars($this->input->post('tag_id'));
        $username = htmlspecialchars($this->input->post('username'));



        if ($this->admin_model->getInstaLead($tarefa_id, $tag_id, $username)) {

            $response = $this->admin_model->getInstaLead($tarefa_id, $tag_id, $username);
        } else {
            $response = array('status' => 'false', 'message' => 'Adicionado com sucesso.');
        }

        print_r(json_encode($response));
    }



    public function act_update_tarefa_status()
    {
        $tarefa_id = htmlspecialchars($this->input->post('tarefa_id'));
        $data['tarefa_status'] = htmlspecialchars($this->input->post('tarefa_status'));


        if ($this->admin_model->updateTarefa($tarefa_id, $data)) {
            $response = array('status' => 'true', 'message' => 'Já existe essa classificaçao.');
        } else {
            $response = array('status' => 'false', 'message' => 'Adicionado com sucesso.');
        }

        print_r(json_encode($response));
    }

    public function act_update_tarefa()
    {
        $tarefa_id = htmlspecialchars($this->input->post('tarefa_id'));

        $data['tarefa_nome'] = htmlspecialchars($this->input->post('tarefa_nome'));
        $data['tarefa_tag'] = htmlspecialchars($this->input->post('tarefa_tag'));
        $data['tarefa_status'] = htmlspecialchars($this->input->post('tarefa_status'));
        $data['tarefa_tipo'] = htmlspecialchars($this->input->post('tarefa_tipo'));
        $data['tarefa_url'] = htmlspecialchars($this->input->post('tarefa_url'));

        if ($this->admin_model->updateTarefa($tarefa_id, $data)) {
            $response = array('status' => 'true', 'message' => 'Já existe essa classificaçao.');
        } else {
            $response = array('status' => 'false', 'message' => 'Adicionado com sucesso.');
        }

        print_r(json_encode($response));
    }
}
