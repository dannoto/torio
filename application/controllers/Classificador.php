<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Classificador extends CI_Controller
{

    function __construct()
    {

        parent::__construct();

        $this->load->model('admin_model');
    }

    public function u($person_id, $imagem_id)
    {
        $arrayDeFotos = $this->admin_model->get_img_by_person($person_id);


        // Suponha que $fotoAtualId seja o ID da foto atual que você deseja exibir
        $fotoAtualId = $imagem_id;

        // Encontrar o índice da foto atual com base no ID
        $indiceAtual = array_search($fotoAtualId, array_column($arrayDeFotos, 'id'));
        $imagem_current = $this->admin_model->get_img($imagem_id);

        if ($indiceAtual !== false) {
            // Obter IDs das fotos adjacentes
            $previousId = ($indiceAtual - 1 >= 0) ? $arrayDeFotos[$indiceAtual - 1]->id : null;
            $nextId = ($indiceAtual + 1 < count($arrayDeFotos)) ? $arrayDeFotos[$indiceAtual + 1]->id : null;

            // // Botão "Previous"
            // if ($previousId !== null) {
            //     echo "<a href='$previousId'>Previous</a>";
            // }

            // // Botão "Next"
            // if ($nextId !== null) {
            //     echo "<a href='$nextId'>Next</a>";
            // }
        }



        $data = array(
            'person_id' => $person_id,
            'imagem_id' => $imagem_id,
            'previous' => $previousId,
            'next' => $nextId,
            'dados' => $imagem_current,
            'arrayFotos' => $arrayDeFotos,
            'indice' => $indiceAtual

        );

        $this->load->view('admin/persona/classificacao/classificador', $data);
    }



    // actionss

    public function act_search_tag()
    {

        $query = htmlspecialchars($this->input->post('query'));

        $person_id = htmlspecialchars($this->input->post('person_id'));
        $imagem_id = htmlspecialchars($this->input->post('imagem_id'));

        foreach ($this->admin_model->search_tag($query) as $c) {

            echo '<li class="c_item_list mt-2">
                <span onclick="addClassificao(' . $c->id . ', ' . $person_id . ',  ' . $c->categoria_id . ',  ' . $c->subcategoria_id . ', ' . $imagem_id . ')" class="bx bx-plus text-primary text" style="font-size: 23px;"></span> ' . $this->admin_model->get_categoria($c->categoria_id)['nome'] . ' <span class="bx bx-caret-right"></span> ' . $this->admin_model->get_subcategoria($c->subcategoria_id)['nome'] . ' <span class="bx bx-caret-right"></span> ' . $c->nome . ' </li>';
        }
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

    function act_et_ta_by_imae()
    {
        $imagem_id = htmlspecialchars($this->input->post('imagem_id'));
        $person_id = htmlspecialchars($this->input->post('person_id'));


        if (count($this->admin_model->get_tags_by_img($imagem_id, $person_id))  == 0) {

            echo  '<li><center><small style="color:#000">SEM TAGS ADICIONADAS.</small></center></li>';

        } else {

            foreach ($this->admin_model->get_tags_by_img($imagem_id, $person_id) as $c) {

                echo '<li><span class="tag_item " style="cursor: pointer;margin-bottom:3px" >' . $this->admin_model->get_subcategoria($c->subcategoria_id)['nome'] . ' - ' . $this->admin_model->get_item($c->tag_id)['nome'] . ' <span onclick="deleteClassificacao(' . $c->id . ')" class="bx bx-message-alt-x text-danger"></span></span></li>';
                echo "<br>";
            }
        }
    }

    public function act_add_tag()
    {

        $data['tag_id'] = htmlspecialchars($this->input->post('tag_id'));
        $data['categoria_id'] = htmlspecialchars($this->input->post('categoria_id'));
        $data['subcategoria_id'] = htmlspecialchars($this->input->post('subcategoria_id'));
        $data['imagem_id'] = htmlspecialchars($this->input->post('imagem_id'));
        $data['person_id'] = htmlspecialchars($this->input->post('person_id'));


        if ($this->admin_model->check_classificacao($data)) {
        } else {
            $this->admin_model->add_classificacao($data);
        }
    }
}
