<?php
defined('BASEPATH') or exit('No direct script access allowed');

// att 4
class Admin_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
    }

    function genLink()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $max = strlen($characters) - 1;
        $hash = '';

        // Generate a 7-character hash
        for ($i = 0; $i < 7; $i++) {
            $randIndex = mt_rand(0, $max);
            $hash .= $characters[$randIndex];
        }

        return strtoupper($hash);
    }

    function convertDate($dateString)
    {


        if (strlen($dateString) > 0) {
            // Create a DateTime object from the given date string
            $date = DateTime::createFromFormat('d-m-Y H:i:s', $dateString);

            // Format the date as dd-mm-YYYY
            $formattedDate = $date->format('d-m-Y');

            return $formattedDate; // Output: 19-12-2023
        } else {
            return "";
        }
    }
    //  Persona Categoria

    public function get_categoria($id)
    {
        $this->db->where('id', $id);
        $this->db->order_by('id', 'desc');

        return $this->db->get('database_tags_categorias')->row_array();
    }

    public function get_categorias()
    {
        $this->db->where('is_deleted', 0);
        return $this->db->get('database_tags_categorias')->result();
    }

    public function add_categoria($nome, $slug, $descricao)
    {

        $data = array(
            'nome' => $nome,
            'slug' => $slug,
            'descricao' => $descricao,
            'is_deleted' => 0
        );

        return $this->db->insert('database_tags_categorias', $data);
    }

    public function update_categoria($id, $nome, $slug, $descricao)
    {

        $this->db->where('id', $id);

        $data = array(
            'nome' => $nome,
            'slug' => $slug,
            'descricao' => $descricao,
        );

        return $this->db->update('database_tags_categorias', $data);
    }

    public function delete_categoria($id)
    {
        $this->db->where('id', $id);

        $data = array(
            'is_deleted' => 1
        );

        return $this->db->update('database_tags_categorias', $data);
    }

    //  Persona Categoria


    //  Persona Categoria

    public function get_subcategoria($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('database_tags_subcategorias')->row_array();
    }

    public function get_subcategorias_by_cat($categoria_id)
    {
        $this->db->where('is_deleted', 0);
        $this->db->where('categoria_id', $categoria_id);
        return $this->db->get('database_tags_subcategorias')->result();
    }


    function countTageddImages($person_id)
    {
        $this->db->where('is_deleted', 0);
        $this->db->where('person_id', $person_id);
        return $this->db->get('person_classificacao')->result();
    }

    function getLastTageddImage($person_id)
    {
        $this->db->where('is_deleted', 0);
        $this->db->where('person_id', $person_id);
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);

        return $this->db->get('person_classificacao')->result();
    }

    function getLastTageddImagex($person_id)
    {
        $this->db->where('is_deleted', 0);
        $this->db->where('person_id', $person_id);
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);

        return $this->db->get('person_classificacao')->row_array();
    }


    function getFirstTageddImage($person_id)
    {
        $this->db->where('is_deleted', 0);
        $this->db->where('person_id', $person_id);
        $this->db->order_by('id', 'asc');
        $this->db->limit(1);

        return $this->db->get('person_classificacao_imagem')->result();
    }

    function getFirstTageddImagex($person_id)
    {
        $this->db->where('is_deleted', 0);
        $this->db->where('person_id', $person_id);
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);

        return $this->db->get('person_classificacao_imagem')->row_array();
    }


    public function get_img($image_id)
    {
        $this->db->where('id', $image_id);
        return $this->db->get('person_classificacao_imagem')->row_array();
    }


    public function get_img_by_person($person_id)
    {
        $this->db->where('is_deleted', 0);
        // $this->db->order_by('id', 'desc');

        $this->db->where('person_id', $person_id);
        return $this->db->get('person_classificacao_imagem')->result();
    }


    function check_classificacao_tag($tag_id, $person_id)
    {
        $this->db->where('tag_id', $tag_id);
        $this->db->where('person_id', $person_id);

        $this->db->where('is_deleted', 0);

        return $this->db->get('person_classificacao')->row_array();
    }

    function check_classificacao($data)
    {
        $this->db->where('tag_id', $data['tag_id']);
        $this->db->where('person_id', $data['person_id']);
        $this->db->where('imagem_id', $data['imagem_id']);

        $this->db->where('is_deleted', 0);

        return $this->db->get('person_classificacao')->row_array();
    }
    public function get_tags_by_subcat($subcategoria_id)
    {
        $this->db->where('is_deleted', 0);
        $this->db->where('subcategoria_id', $subcategoria_id);
        return $this->db->get('database_tags_items')->result();
    }

    public function get_tags_by_img($image_id, $person_id)
    {
        $this->db->where('is_deleted', 0);
        $this->db->where('imagem_id', $image_id);
        $this->db->where('person_id', $person_id);

        return $this->db->get('person_classificacao')->result();
    }
    public function get_subcategorias()
    {
        $this->db->where('is_deleted', 0);
        return $this->db->get('database_tags_subcategorias')->result();
    }
    public function add_subcategoria($nome, $categoria_id, $slug, $descricao)
    {

        $data = array(
            'nome' => $nome,
            'slug' => $slug,
            'descricao' => $descricao,
            'categoria_id' => $categoria_id,
            'is_deleted' => 0
        );

        return $this->db->insert('database_tags_subcategorias', $data);
    }

    public function update_subcategoria($id, $nome, $categoria_id, $slug, $descricao)
    {

        $this->db->where('id', $id);

        $data = array(
            'nome' => $nome,
            'slug' => $slug,
            'categoria_id' => $categoria_id,
            'descricao' => $descricao,
        );

        return $this->db->update('database_tags_subcategorias', $data);
    }

    public function delete_subcategoria($id)
    {
        $this->db->where('id', $id);

        $data = array(
            'is_deleted' => 1
        );

        return $this->db->update('database_tags_subcategorias', $data);
    }

    //  Persona Categoria


    //  Persona Intensidade

    public function get_intensidade($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('database_tags_intensidade')->row_array();
    }

    public function get_intensidades()
    {
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'desc');

        return $this->db->get('database_tags_intensidade')->result();
    }

    public function add_intensidade($nome, $slug, $descricao)
    {

        $data = array(
            'nome' => $nome,
            'slug' => $slug,
            'descricao' => $descricao,
            'is_deleted' => 0
        );

        return $this->db->insert('database_tags_intensidade', $data);
    }

    public function update_intensidade($id, $nome, $slug, $descricao)
    {

        $this->db->where('id', $id);

        $data = array(
            'nome' => $nome,
            'slug' => $slug,
            'descricao' => $descricao,
        );

        return $this->db->update('database_tags_intensidade', $data);
    }

    public function delete_intensidade($id)
    {
        $this->db->where('id', $id);

        $data = array(
            'is_deleted' => 1
        );

        return $this->db->update('database_tags_intensidade', $data);
    }

    //  Persona Intensidade


    //  Persona Itens

    public function get_item($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('database_tags_items')->row_array();
    }

    public function get_itens()
    {

        $this->db->where('is_deleted', 0);
        $this->db->order_by('nome', 'asc');

        return $this->db->get('database_tags_items')->result();
    }


    public function get_itens_by_cat($categoria_id, $subcategoria_id)
    {
        $this->db->where('categoria_id', $categoria_id);
        $this->db->where('subcategoria_id', $subcategoria_id);
        $this->db->where('is_deleted', 0);

        return $this->db->get('database_tags_items')->result();
    }

    public function add_item($nome, $slug, $descricao, $categoria_id, $subcategoria_id)
    {

        $data = array(
            'nome' => $nome,
            'slug' => $slug,
            'categoria_id' => $categoria_id,
            'subcategoria_id' => $subcategoria_id,
            'descricao' => $descricao,

            'is_deleted' => 0
        );

        return $this->db->insert('database_tags_items', $data);
    }



    public function update_item($id, $nome, $slug, $descricao, $categoria_id, $subcategoria_id)
    {

        $this->db->where('id', $id);
        $data = array(
            'nome' => $nome,
            'slug' => $slug,
            'categoria_id' => $categoria_id,
            'subcategoria_id' => $subcategoria_id,
            'descricao' => $descricao,
        );

        return $this->db->update('database_tags_items', $data);
    }

    public function delete_item($id)
    {
        $this->db->where('id', $id);

        $data = array(
            'is_deleted' => 1
        );

        return $this->db->update('database_tags_items', $data);
    }

    //  Persona Itens


    //  Persona Person

    public function get_person($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('person')->row_array();
    }

    public function get_persons($type = null)
    {

        if ($type != null) {
            $this->db->where('tipo', $type);
        }

        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'desc');

        return $this->db->get('person')->result();
    }

    public function get_intensividade()
    {

        $this->db->where('is_deleted', 0);

        return $this->db->get('database_tags_intensidade')->result();
    }

    public function add_person($person_data)
    {


        return $this->db->insert('person', $person_data);
    }


    public function add_classificacao($data)
    {


        return $this->db->insert('person_classificacao', $data);
    }



    public function add_classificacao_intensidade($data)
    {


        return $this->db->insert('person_classificacao_intensidade', $data);
    }


    public function update_classificacao_intensidade($id, $data)
    {

        $this->db->where('id', $id);

        return $this->db->update('person_classificacao_intensidade', $data);
    }


    public function update_person($person_id, $person_data)
    {

        $this->db->where('id', $person_id);


        return $this->db->update('person', $person_data);
    }

    public function delete_person($person_id)
    {
        $this->db->where('id', $person_id);

        $person_data = array(
            'is_deleted' => 1
        );

        return $this->db->update('person', $person_data);
    }

    //  Persona Person


    public function get_estados()
    {


        return $this->db->get('estado')->result();
    }

    public function get_classificacoes()
    {

        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'desc');

        return $this->db->get('person_classificacao')->result();
    }

    public function get_classificacoes_by_cat($cat_id, $person_id)
    {

        $this->db->where('is_deleted', 0);
        $this->db->where('categoria_id', $cat_id);
        $this->db->where('person_id', $person_id);

        return $this->db->get('person_classificacao')->result();
    }

    public function search_tag($query)
    {
        $this->db->where('is_deleted', 0);

        $this->db->like('nome', $query);
        return $this->db->get('database_tags_items')->result();
    }

    public function get_cidades_by_estado($estado_id)
    {

        $this->db->where('uf', $estado_id);

        return $this->db->get('cidade')->result();
    }

    public function get_cidade_label($cidade_id)
    {

        $this->db->where('id', $cidade_id);
        return $this->db->get('cidade')->row_array()['nome'];
    }

    public function get_uf_id($nome)
    {
        $this->db->where('uf', $nome);
        return $this->db->get('estado')->row_array()['id'];
    }

    public function get_cidade_id($nome)
    {
        $this->db->like('nome', $nome);
        return $this->db->get('cidade')->row_array()['id'];
    }

    public function get_estado_label($estado_id)
    {

        $this->db->where('id', $estado_id);
        return $this->db->get('estado')->row_array()['nome'];
    }

    public function get_emails($person_id)
    {
        $this->db->where('person_id', $person_id);
        $this->db->where('is_deleted', 0);


        return $this->db->get('person_email')->result();
    }
    public function get_telefones($person_id)
    {
        $this->db->where('person_id', $person_id);
        $this->db->where('is_deleted', 0);


        return $this->db->get('person_telefone')->result();
    }

    public function get_telefones_validated($person_id)
    {
        $this->db->where('person_id', $person_id);
        $this->db->where('is_validado', 1);
        $this->db->where('is_deleted', 0);

        $this->db->limit(1);
        return $this->db->get('person_telefone')->row_array();
    }

    public function get_emails_validated($person_id)
    {
        $this->db->where('person_id', $person_id);
        $this->db->where('is_validado', 1);
        $this->db->where('is_deleted', 0);
        $this->db->limit(1);
        return $this->db->get('person_email')->row_array();
    }

    public function get_sociais($person_id)
    {
        $this->db->where('person_id', $person_id);
        $this->db->where('is_deleted', 0);


        return $this->db->get('person_socialmedia')->result();
    }

    public function add_emails($data)
    {

        return $this->db->insert('person_email', $data);
    }

    public function delete_email($email_id)
    {


        $this->db->where('id', $email_id);

        $person_data = array(
            'is_deleted' => 1
        );

        return $this->db->update('person_email', $person_data);
    }

    public function add_telefone($data)
    {

        return $this->db->insert('person_telefone', $data);
    }



    public function add_social($data)
    {

        return $this->db->insert('person_socialmedia', $data);
    }

    public function exist_classificacao($person_id,  $categoria_id, $subcategoria_id,  $tag_id)
    {

        $this->db->where('person_id', $person_id);
        $this->db->where('categoria_id', $categoria_id);
        $this->db->where('subcategoria_id', $subcategoria_id);
        $this->db->where('tag_id', $tag_id);
        $this->db->where('is_deleted', 0);



        return $this->db->get('person_classificacao')->row_array();
    }


    public function get_classificacao_intensidade($person_id,  $categoria_id)
    {

        $this->db->where('person_id', $person_id);
        $this->db->where('categoria_id', $categoria_id);


        return $this->db->get('person_classificacao_intensidade')->row_array();
    }


    public function exist_classificacao_intensidade($person_id,  $categoria_id)
    {

        $this->db->where('person_id', $person_id);
        $this->db->where('categoria_id', $categoria_id);


        return $this->db->get('person_classificacao_intensidade')->row_array();
    }
    public function delete_classificacao_especial($person_id, $tag_id)
    {
        $this->db->where('person_id', $person_id);
        $this->db->where('tag_id', $tag_id);

        $person_data = array(
            'is_deleted' => 1
        );

        return $this->db->update('person_classificacao', $person_data);
    }

    public function delete_classificacao($classificacao_id)
    {


        $this->db->where('id', $classificacao_id);

        $person_data = array(
            'is_deleted' => 1
        );

        return $this->db->update('person_classificacao', $person_data);
    }

    public function delete_telefone($telefone_id)
    {


        $this->db->where('id', $telefone_id);

        $person_data = array(
            'is_deleted' => 1
        );

        return $this->db->update('person_telefone', $person_data);
    }

    public function delete_social($social_id)
    {


        $this->db->where('id', $social_id);

        $person_data = array(
            'is_deleted' => 1
        );

        return $this->db->update('person_socialmedia', $person_data);
    }




    //  Produtos

    public function get_produto($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('produtos')->row_array();
    }

    public function get_produtos()
    {
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'desc');
        return $this->db->get('produtos')->result();
    }

    public function get_produto_plataformas()
    {
        $this->db->where('is_deleted', 0);
        return $this->db->get('produtos_plataformas')->result();
    }

    public function get_produto_categorias()
    {
        $this->db->where('is_deleted', 0);
        return $this->db->get('produtos_categorias')->result();
    }

    public function get_produto_plataforma($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('produtos_plataformas')->row_array();
    }

    public function get_produto_categoria($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('produtos_categorias')->row_array();
    }

    public function add_produto($nome, $imagem, $preco, $plataforma, $categoria, $pagina_de_vendas, $descricao)
    {

        $data = array(
            'nome' => $nome,
            'imagem' => $imagem,
            'preco' => $preco,
            'plataforma	' => $plataforma,
            'data' => date('Y-m-d H:i:s'),
            'categoria' => $categoria,
            'pagina_de_vendas' => $pagina_de_vendas,
            'descricao' => $descricao,
            'is_deleted' => 0
        );

        return $this->db->insert('produtos', $data);
    }

    public function update_produto($id, $nome, $imagem, $preco, $plataforma, $categoria, $pagina_de_vendas, $descricao)
    {

        $this->db->where('id', $id);

        $data = array(
            'nome' => $nome,
            'imagem' => $imagem,
            'preco' => $preco,
            'plataforma	' => $plataforma,
            'categoria' => $categoria,
            'pagina_de_vendas' => $pagina_de_vendas,
            'descricao' => $descricao,
        );

        return $this->db->update('produtos', $data);
    }

    public function delete_produto($id)
    {
        $this->db->where('id', $id);

        $data = array(
            'is_deleted' => 1
        );

        return $this->db->update('produtos', $data);
    }

    //  Produtos
    public function get_campanhas()
    {
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'desc');

        return $this->db->get('campanhas')->result();
    }

    public function get_campanhas_by_produto($produto_id)
    {
        $this->db->where('is_deleted', 0);
        $this->db->where('produto', $produto_id);

        $this->db->order_by('id', 'desc');

        return $this->db->get('campanhas')->result();
    }
    public function get_campanha($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('campanhas')->row_array();
    }




    public function get_campanha_provedor()
    {
        // $this->db->where('is_deleted', 0);
        return $this->db->get('campanha_provedor')->result();
    }
    public function get_provedor($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('campanha_provedor')->row_array();
    }

    public function get_tipo($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('campanha_tipo')->row_array();
    }

    public function get_campanha_tipo()
    {
        // $this->db->where('is_deleted', 0);
        return $this->db->get('campanha_tipo')->result();
    }


    public function add_campanha($nome, $descricao, $produto, $tipo, $provedor, $email_content, $status, $provedor_campanha_id, $lista, $classificacao)
    {

        $data = array(
            'nome' => $nome,
            'descricao' => $descricao,
            'produto' => $produto,
            'tipo' => $tipo,
            'data' => date('Y-m-d H:i:s'),
            'provedor' => $provedor,
            'email_content' => $email_content,
            'status' => $status,

            'provedor_campanha_id' => $provedor_campanha_id,
            'lista' => $lista,
            'classificacao' => $classificacao,

            // 'url_email' => $this->genLink() ,
            // 'url_whatsapp' => $this->genLink() ,
            // 'url_instagram' => $this->genLink() ,
            // 'url_twitter' => $this->genLink() ,
            // 'url_tiktok' => $this->genLink() ,
            // 'url_facebook' => $this->genLink() ,


            'is_deleted' => 0
        );

        return $this->db->insert('campanhas', $data);
    }

    public function getLeadsToSynchronizeCampanhaAssociada($lista_id, $campanha_id, $quantidade_max)
    {
        // echo "lista_id: ". $lista_id;
        // echo "campanha_id: ". $campanha_id;
        // echo "quantidade_max: ". $quantidade_max;

        $sql = 'SELECT DISTINCT pc.lead_id
                    FROM campanha_prospection pc
                    WHERE pc.campanha_id = ' . $campanha_id . '
                    AND pc.is_deleted = 0
                    AND pc.lead_id NOT IN (
                        SELECT li.person_id
                        FROM leads_import li
                        WHERE li.lista_id = ' . $lista_id . '
                    )  LIMIT ' . $quantidade_max . '';

        $query = $this->db->query($sql);

        return $query->result();
    }
    //     public function getLeadsToSynchronizeCampanhaAssociada($campanha_id, $lista_id, $quantidade_max)
    // {
    //     $this->db->distinct();
    //     $this->db->select('pc.lead_id');
    //     $this->db->from('campanha_prospection pc');
    //     $this->db->where('pc.campanha_id', $campanha_id);
    //     $this->db->where('pc.is_deleted', 0);
    //     $this->db->where_not_in('pc.lead_id', "(SELECT li.person_id FROM leads_import li WHERE li.lista_id = $lista_id)");
    //     $this->db->limit($quantidade_max);
    //     $query = $this->db->get();

    //     return $query->result();
    // }




    public function getLeadsToSynchronize($lista_id, $tag_id, $quantidade_max)
    {
        $sql = 'SELECT DISTINCT pc.person_id
                    FROM person_classificacao pc
                    WHERE pc.tag_id = ' . $tag_id . '
                    AND is_deleted = 0
                    AND pc.person_id NOT IN (
                        SELECT li.person_id
                        FROM leads_import li
                        WHERE li.lista_id = ' . $lista_id . '
                    )  LIMIT ' . $quantidade_max . '';

        $query = $this->db->query($sql);

        return $query->result();
    }


    public function get_leads_by_tags($tag_id, $limite_calculado = null, $limite_por_pagina = null)
    {
        $this->db->distinct();
        $this->db->select('person_id'); // Seleciona apenas o person_id para resultados distintos
        $this->db->where('tag_id', $tag_id);
        $this->db->where('is_deleted', 0);

        if ($limite_por_pagina != null) {

            $this->db->limit($limite_por_pagina, $limite_calculado);
        }


        $query = $this->db->get('person_classificacao');

        // Retorna os resultados únicos como um array de objetos
        return $query->result();
    }

    public function get_leads_by_campanha_associada($tag_id)
    {
        $this->db->distinct();
        $this->db->select('lead_id'); // Seleciona apenas o person_id para resultados distintos
        $this->db->where('campanha_id', $tag_id);
        $this->db->where('is_deleted', 0);


        $query = $this->db->get('campanha_prospection');

        return $query->result();
    }

    public function update_campanha($id, $nome, $descricao, $produto, $tipo, $provedor, $email_content, $status, $provedor_campanha_id, $lista, $classificacao)
    {

        $this->db->where('id', $id);


        $data = array(
            'nome' => $nome,
            'descricao' => $descricao,
            'produto' => $produto,
            'tipo' => $tipo,
            'data' => date('Y-m-d H:i:s'),
            'provedor' => $provedor,
            'email_content' => $email_content,
            'status' => $status,

            'provedor_campanha_id' => $provedor_campanha_id,
            'lista' => $lista,
            'classificacao' => $classificacao

        );

        return $this->db->update('campanhas', $data);
    }

    public function delete_campanha($id)
    {
        $this->db->where('id', $id);

        $data = array(
            'is_deleted' => 1
        );

        return $this->db->update('campanhas', $data);
    }

    public function get_listas()
    {
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'desc');

        return $this->db->get('listas')->result();
    }

    public function get_tag_by_listas()
    {

        $this->db->distinct();
        $this->db->select('tag');
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'desc');

        return $this->db->get('listas')->result();
    }

    public function get_listas_by_tag($tag_id)
    {
        $this->db->where('is_deleted', 0);
        $this->db->where('tag', $tag_id);


        $this->db->order_by('id', 'desc');

        return $this->db->get('listas')->result();
    }

    public function get_lista($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('listas')->row_array();
    }

    public function add_lista($nome, $descricao, $tag, $lista_id, $classificacao, $importacao, $campanha_associada, $provedor)
    {

        $data = array(
            'nome' => $nome,
            'descricao' => $descricao,
            'provedor_lista_id' => $lista_id,
            'tag' => $tag,
            'classificacao' => $classificacao,
            'data' => date('Y-m-d H:i:s'),
            'importacao' => $importacao,
            'campanha_associada' => $campanha_associada,
            'provedor' => $provedor,

            'is_deleted' => 0
        );

        return $this->db->insert('listas', $data);
    }

    public function update_lista($id, $nome, $descricao, $tag, $classificacao, $importacao, $campanha_associada, $provedor)
    {

        $this->db->where('id', $id);


        $data = array(
            'nome' => $nome,
            'descricao' => $descricao,
            'tag' => $tag,
            'classificacao' => $classificacao,
            'importacao' => $importacao,
            'campanha_associada' => $campanha_associada,
            'provedor' => $provedor,

            'data' => date('Y-m-d H:i:s'),
            'is_deleted' => 0
        );

        return $this->db->update('listas', $data);
    }

    public function delete_lista($id)
    {
        $this->db->where('id', $id);

        $data = array(
            'is_deleted' => 1
        );

        return $this->db->update('listas', $data);
    }



    public function get_prospecoes_by_campanha($campanha_id)
    {
        $this->db->select('*');
        $this->db->from('campanha_prospection');
        $this->db->where('campanha_id', $campanha_id);
        $this->db->order_by('id', 'desc');
        $this->db->where('is_deleted', 0);

        // Subconsulta para selecionar apenas um registro para cada lead_id diferente de zero
        $subQuery = '(SELECT MIN(id) AS min_id FROM campanha_prospection WHERE campanha_id = ' . $campanha_id . ' AND is_deleted = 0 AND lead_id != 0 GROUP BY lead_id)';
        $this->db->group_start();
        $this->db->where("id IN $subQuery", NULL, FALSE);
        $this->db->or_where('lead_id', 0);
        $this->db->group_end();



        $query = $this->db->get();

        return $query->result();
    }


    public function searchLeads($query)
    {


        if (strlen($query) > 0) {

            $this->db->select('person_id');
            $this->db->from('person_email');
            $this->db->where('is_deleted', 0);
            $this->db->where('is_validado', 1);
            $this->db->like('email', $query);

            $queryEmail = $this->db->get();

            $this->db->reset_query(); // Reinicia a construção da query

            $this->db->select('person_id');
            $this->db->from('person_telefone');
            $this->db->where('is_deleted', 0);
            $this->db->where('is_validado', 1);
            $this->db->like('telefone', $query);

            $queryTelefone = $this->db->get();

            $results = [];

            if ($queryEmail->num_rows() > 0) {
                foreach ($queryEmail->result() as $row) {
                    $results[] = $row->person_id;
                }
            }

            if ($queryTelefone->num_rows() > 0) {
                foreach ($queryTelefone->result() as $row) {
                    $results[] = $row->person_id;
                }
            }

            // Remover duplicatas e manter somente os IDs únicos
            $results = array_unique($results);

            return $results;
        } else {

            $this->db->select('person_id');
            $this->db->from('person_email');
            $this->db->where('is_deleted', 0);
            $this->db->where('is_validado', 1);
            // $this->db->like('email', $query);

            $queryEmail = $this->db->get();

            $this->db->reset_query(); // Reinicia a construção da query

            $this->db->select('person_id');
            $this->db->from('person_telefone');
            $this->db->where('is_deleted', 0);
            $this->db->where('is_validado', 1);
            // $this->db->like('telefone', $query);

            $queryTelefone = $this->db->get();

            $results = [];

            if ($queryEmail->num_rows() > 0) {
                foreach ($queryEmail->result() as $row) {
                    $results[] = $row->person_id;
                }
            }

            if ($queryTelefone->num_rows() > 0) {
                foreach ($queryTelefone->result() as $row) {
                    $results[] = $row->person_id;
                }
            }

            // Remover duplicatas e manter somente os IDs únicos
            $results = array_unique($results);

            return $results;
        }
    }


    public function get_prospeccao($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('campanha_prospection')->row_array();
    }

    public function add_prospeccao($campanha_id, $produto_id, $encurtador_url, $lead_id,  $origem_url, $origem_type, $lead_dispositivo, $lead_ip)
    {


        $data = array(
            'campanha_id' => $campanha_id,
            'produto_id' => $produto_id,
            'encurtador_url' => $encurtador_url,
            'lead_id' => $lead_id,
            'data_acesso' => date('Y-m-d H:i:s'),
            'origem_url' => $origem_url,
            'origem_type' => $origem_type,
            'lead_dispositivo' => $lead_dispositivo,
            'lead_ip' => $lead_ip,


        );

        return $this->db->insert('campanha_prospection', $data);
    }

    public function update_prospeccao($id, $contactado, $contactado_via, $contactado_data)
    {

        $this->db->where('id', $id);


        $data = array(
            'contactado' => $contactado,
            'contactado_via' => $contactado_via,
            'contactado_data' => $contactado_data,

        );

        return $this->db->update('campanha_prospection', $data);
    }

    public function delete_prospeccao($id)
    {
        $this->db->where('id', $id);

        $data = array(
            'is_deleted' => 1
        );

        return $this->db->update('campanha_prospection', $data);
    }



    public function get_vendas_totais($tipo = null)
    {

        if ($tipo != null) {
            $this->db->where('tipo', $tipo);
        }


        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'desc');

        return $this->db->get('campanha_vendas')->result();
    }


    public function get_vendas_by_campanha($campanha_id, $tipo = null)
    {

        if ($tipo != null) {
            $this->db->where('tipo', $tipo);
        }

        $this->db->where('campanha_id', $campanha_id);
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'desc');

        return $this->db->get('campanha_vendas')->result();
    }

    public function get_venda($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('campanha_vendas')->row_array();
    }

    public function add_venda($campanha_id, $produto_id, $lead_id, $data,  $valor, $provedor, $provedor_venda_id, $tipo)
    {


        $data = array(
            'campanha_id' => $campanha_id,
            'produto_id' => $produto_id,
            'lead_id' => $lead_id,
            'data' => $data,
            'valor' => $valor,
            'provedor' => $provedor,
            'tipo' => $tipo,

            'provedor_venda_id' =>  $provedor_venda_id,
            'is_deleted' => 0,
        );

        return $this->db->insert('campanha_vendas', $data);
    }

    public function update_venda($id, $lead_id, $data, $valor, $provedor, $venda_id)
    {

        $this->db->where('id', $id);

        $data = array(

            'lead_id' => $lead_id,
            'data' => $data,
            'valor' => $valor,
            'provedor' => $provedor,
            'provedor_venda_id', $venda_id,

        );

        return $this->db->update('campanha_vendas', $data);
    }

    public function delete_venda($id)
    {
        $this->db->where('id', $id);

        $data = array(
            'is_deleted' => 1
        );

        return $this->db->update('campanha_vendas', $data);
    }


    public function getLinkByCode($code)
    {
        $this->db->where('code', $code);
        return $this->db->get('campanha_links')->row_array();
    }

    public function getLinkByCampanha($campanha_id)
    {
        $this->db->where('campanha_id', $campanha_id);
        return $this->db->get('campanha_links')->result();
    }




    public function findLeadByTelefone($telefone)
    {
        $this->db->where('telefone', $telefone);
        $this->db->where('is_deleted', 0);

        $d = $this->db->get('person_telefone')->row_array();
        return $d;
    }
    public function findLeadByEmail($email)
    {
        $this->db->where('email', $email);
        $this->db->where('is_deleted', 0);

        return $this->db->get('person_email')->row_array();
    }
    public function findLeadById($id)
    {
        $this->db->where('id', $id);
        $this->db->where('is_deleted', 0);

        $d =  $this->db->get('person')->row_array();
        return $d;
    }


    public function add_prospecto($campanha_id, $produto_id, $encurtador_url, $lead_id, $origem_url, $origem_type, $lead_dispositivo, $lead_ip)
    {


        $data = array(
            'campanha_id' => $campanha_id,
            'produto_id' => $produto_id,
            'encurtador_url	' => $encurtador_url,
            'lead_id' => $lead_id,
            'data_acesso' => date('d-m-Y H:i:s'),
            'origem_url' => $origem_url,
            'origem_type' => $origem_type,
            'lead_dispositivo' =>  $lead_dispositivo,
            'contactado' => 0,
            'lead_ip' => $lead_ip,
            'is_deleted' => 0,
        );

        return $this->db->insert('campanha_prospection', $data);
    }


    public function check_link($campanha_id, $type)
    {

        $this->db->where('campanha_id', $campanha_id);
        $this->db->where('type', $type);
        return $this->db->get('campanha_links')->row_array();
    }

    public function add_link($campanha_id, $type)
    {

        $data = array(
            'campanha_id' => $campanha_id,
            'type' => $type,
            'code' => $this->genLink()

        );

        return $this->db->insert('campanha_links', $data);
    }

    //  Sincronizaçao

    public function getSincronizacoes($campanha_id)
    {
        $this->db->where('id', $campanha_id);
        return $this->db->get('leads_import_process')->result();
    }

    public function getSincronizacao($id)
    {
        $this->db->where('id', $id);

        return $this->db->get('leads_import_process')->row_array();
    }


    public function updateSincronizacao($id, $data)
    {
        $this->db->where('id', $id);

        return $this->db->get('leads_import_process')->row_array();
    }

    public function addSincronizacao($data)
    {

        return $this->db->insert('leads_import_process', $data);
    }



    public function addLeadsSincronizado($data)
    {
        return $this->db->insert('leads_import', $data);
    }

    //  Sincronizaçao

    // Tarefas

    public function getTarefasDistinct()
    {

        $this->db->distinct();
        $this->db->select('tarefa_tag'); // Seleciona apenas o person_id para resultados distintos
        $this->db->where('is_deleted', 0);
        $query = $this->db->get('persona_tarefas');

        // Retorna os resultados únicos como um array de objetos
        return $query->result();
    }

    public function getTarefasByTag($tag_id)
    {
        $this->db->where('is_deleted', 0);
        $this->db->where('tarefa_tag', $tag_id);

        $this->db->order_by('id', 'desc');
        return $this->db->get('persona_tarefas')->result();
    }
    public function getTarefas()
    {

        $this->db->where('is_deleted', 0);

        $this->db->where('tarefa_status !=', 5);


        $this->db->order_by('id', 'desc');
        return $this->db->get('persona_tarefas')->result();
    }

    public function getTarefasSearch($tag, $status)
    {

        if (strlen($tag) > 0) {
            $this->db->where('tarefa_tag', $tag);
        }

        if (strlen($status) > 0) {
            $this->db->where('tarefa_status', $status);
        } else {
            $this->db->where('tarefa_status !=', 5);
        }

        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'desc');
        return $this->db->get('persona_tarefas')->result();
    }






    public function getTarefa($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('persona_tarefas')->row_array();
    }

    public function checkTarefaLink($tarefa_url)
    {

        $this->db->where('tarefa_url', $tarefa_url);
        $this->db->where('is_deleted', 0);

        return $this->db->get('persona_tarefas')->row_array();
    }

    public function addTarefa($data)
    {
        return $this->db->insert('persona_tarefas', $data);
    }

    public function updateTarefa($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('persona_tarefas', $data);
    }

    public function deleteTarefa($id)
    {

        $this->db->where('id', $id);

        $data = array(
            'is_deleted' => 1
        );

        return $this->db->update('persona_tarefas', $data);
    }

    // Instagram Leads

    public function add_person_get_id($person_data)
    {

        $this->db->insert('person', $person_data);
        return $this->db->insert_id();
    }


    public function get_instagram_demanda_leads_count($task_id) {

        $this->db->where('tarefa_id', $task_id);

        return $this->db->get('insta_leads')->result();
    }

    public function getInstagramLeadsByTaskSearch($task_id, $inapto, $convertido)
    {
        $this->db->where('tarefa_id', $task_id);

        if (strlen($inapto) > 0) {

            $this->db->where('inapto', $inapto);
        } else {
            $this->db->where('inapto', 0);
        }

        if (strlen($convertido) > 0) {

            $this->db->where('convertido', $convertido);
        }
        // $this->db->limit(100);
        $this->db->group_start();
        $this->db->where('email IS NOT NULL AND email !=', '');
        $this->db->or_where('telefone IS NOT NULL AND telefone !=', '');
        $this->db->or_where('links IS NOT NULL AND links !=', '');
        $this->db->or_where('mencoes IS NOT NULL AND mencoes !=', '');
        $this->db->group_end();

        $this->db->order_by('convertido', 'asc');

        return $this->db->get('insta_leads')->result();
    }

    public function getInstagramLeadsByTask($task_id,  $limite_calculado = null, $limite_por_pagina = null)
    {
        $this->db->where('tarefa_id', $task_id);

        $this->db->where('inapto', 0);


        // $this->db->limit(100);
        $this->db->group_start();
        $this->db->where('email IS NOT NULL AND email !=', '');
        $this->db->or_where('telefone IS NOT NULL AND telefone !=', '');
        $this->db->or_where('links IS NOT NULL AND links !=', '');
        $this->db->or_where('mencoes IS NOT NULL AND mencoes !=', '');
        $this->db->group_end();

            if ($limite_por_pagina != null) {
                $this->db->limit($limite_por_pagina, $limite_calculado);
        }

        $this->db->order_by('convertido', 'asc');

        return $this->db->get('insta_leads')->result();
    }
    public function getInstagramLeadsByTaskValid($task_id)
    {
        $this->db->where('tarefa_id', $task_id);
        $data =  $this->db->get('insta_leads')->result();

        $valid = array();

        foreach ($data as $d) {


            if (strlen($d->email) > 0 || strlen($d->telefone) > 0) {
                array_push($valid, $d);
            }
        }

        return $valid;
    }

    public function addInstagramLead($data)
    {
        return $this->db->insert('insta_leads', $data);
    }

    public function updateInstaLead($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('insta_leads', $data);
    }

    public function deleteInstagramLeads($id)
    {

        $this->db->where('id', $id);

        $data = array(
            'is_deleted' => 1
        );

        return $this->db->update('insta_leads', $data);
    }

    public function getInstaLeadDemanda($tarefa_id, $tag_id, $username)
    {
        $this->db->where('tarefa_id', $tarefa_id);
        $this->db->where('tag_id', $tag_id);
        $this->db->where('username', $username);

        return $this->db->get('insta_leads_demandas')->row_array();
    }


    public function getPersonByMediaUsername($username)
    {
        $this->db->where('username', $username);
        $this->db->where('nome', 'instagram');
        $this->db->where('is_deleted', 0);

        return $this->db->get('person_socialmedia')->row_array();
    }
    public function getInstaLead($tarefa_id, $tag_id, $username)
    {
        $this->db->where('tarefa_id', $tarefa_id);
        $this->db->where('tag_id', $tag_id);
        $this->db->where('username', $username);

        return $this->db->get('insta_leads')->row_array();
    }

    // Instagram Leads

    // Tarefas

    public function checkEmailCaptured($email)
    {
        // Extrai o domínio do e-mail
        $domain = substr(strrchr($email, "@"), 1);

        // Verifica se o domínio pertence a um dos provedores mencionados
        if ($domain === 'gmail.com' || $domain === 'hotmail.com' || $domain === 'outlook.com') {
            return true;
        } else {
            return false;
        }
    }

    public function checkNumberCaptured($numero)
    {

        // Remover todos os caracteres que não sejam dígitos
        $numero = preg_replace("/[^0-9]/", "", $numero);

        // Verificar se o número tem o tamanho esperado após a remoção dos caracteres não numéricos
        if (strlen($numero) != 13) {
            return false;
        }

        // Verificar se o número começa com "55" (código do Brasil)
        if (substr($numero, 0, 2) != "55") {
            return false;
        }

        // Verificar se os próximos dois dígitos são o DDD (código de área) com 2 dígitos
        $ddd = substr($numero, 2, 2);
        if (!preg_match("/^[1-9][0-9]$/", $ddd)) {
            return false;
        }

        // Verificar se o próximo dígito é "9" (código obrigatório)
        if (substr($numero, 4, 1) != "9") {
            return false;
        }

        // Verificar se os próximos 8 dígitos formam o número final
        $numeroFinal = substr($numero, 5);
        if (!preg_match("/^[0-9]{8}$/", $numeroFinal)) {
            return false;
        }

        // Se todas as verificações passarem, o número é válido
        return true;
    }

    public function add_abertura($data)
    {

        return $this->db->insert('campanha_aberturas', $data);
    }

    public function get_aberturas($campanha_id)
    {
        $this->db->where('abertura_lead_campanha_id', $campanha_id);
        return $this->db->get('campanha_aberturas')->result();
    }
}
