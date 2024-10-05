<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Conta extends CI_Controller
{

    function __construct()
    {

        parent::__construct();
        $this->load->model('api_model');

        $this->load->model('conta_model');
    }

    public function dashboard()
    {
        $this->load->view('conta/dashboard');
    }

    public function personas()
    {
        if ($this->input->get()) {

            $f_data = $this->input->get();
            $base_url = base_url('conta/personas');
            $query_string = http_build_query($f_data);

            $config['base_url'] = $base_url;
            $config['total_rows'] = $this->conta_model->count_search_personas($f_data);
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = 'Primeira';
            $config['last_link'] = 'Última';
            $config['next_link'] = '&gt;';
            $config['prev_link'] = '&lt;';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';



            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data = array(
                'personas' => $this->conta_model->get_search_personas($f_data, $config['per_page'], $page),
                'pagination' => $this->pagination->create_links()
            );


            $data['pagination'] = preg_replace('/href="([^"]+)"/', 'href="$1?' . $query_string . '"', $data['pagination']);

            $this->load->view('conta/personas',  $data);
        } else {

            $config['base_url'] = base_url('conta/personas');
            $config['total_rows'] = $this->conta_model->count_personas(); // Total de registros
            $config['per_page'] = 10; // Quantidade de imóveis por página
            $config['uri_segment'] = 3; // Segmento da URL onde a página está indicada

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = 'Primeira';
            $config['last_link'] = 'Última';
            $config['next_link'] = '&gt;';
            $config['prev_link'] = '&lt;';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data = array(
                'personas' => $this->conta_model->get_personas($config['per_page'], $page),
                'pagination' => $this->pagination->create_links()
            );

            $this->load->view('conta/personas',  $data);
        }
    }

    public function cliques()
    {
        if ($this->input->get()) {

            $f_data = $this->input->get();
            $base_url = base_url('conta/cliques');
            $query_string = http_build_query($f_data);

            $config['base_url'] = $base_url;
            $config['total_rows'] = $this->conta_model->count_search_cliques($f_data);
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = 'Primeira';
            $config['last_link'] = 'Última';
            $config['next_link'] = '&gt;';
            $config['prev_link'] = '&lt;';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';



            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data = array(
                'cliques' => $this->conta_model->get_search_cliques($f_data, $config['per_page'], $page),
                'pagination' => $this->pagination->create_links()
            );


            $data['pagination'] = preg_replace('/href="([^"]+)"/', 'href="$1?' . $query_string . '"', $data['pagination']);

            $this->load->view('conta/cliques',  $data);
        } else {

            $config['base_url'] = base_url('conta/cliques');
            $config['total_rows'] = $this->conta_model->count_cliques(); // Total de registros
            $config['per_page'] = 10; // Quantidade de imóveis por página
            $config['uri_segment'] = 3; // Segmento da URL onde a página está indicada

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = 'Primeira';
            $config['last_link'] = 'Última';
            $config['next_link'] = '&gt;';
            $config['prev_link'] = '&lt;';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data = array(
                'cliques' => $this->conta_model->get_cliques($config['per_page'], $page),
                'pagination' => $this->pagination->create_links()
            );

            $this->load->view('conta/cliques',  $data);
        }
    }

    public function tarefas()
    {

        if ($this->input->get()) {

            $f_data = $this->input->get();
            $base_url = base_url('conta/tarefas');
            $query_string = http_build_query($f_data);

            $config['base_url'] = $base_url;
            $config['total_rows'] = $this->conta_model->count_search_tarefas($f_data);
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = 'Primeira';
            $config['last_link'] = 'Última';
            $config['next_link'] = '&gt;';
            $config['prev_link'] = '&lt;';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';



            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data = array(
                'tarefas' => $this->conta_model->get_search_tarefas($f_data, $config['per_page'], $page),
                'pagination' => $this->pagination->create_links()
            );


            $data['pagination'] = preg_replace('/href="([^"]+)"/', 'href="$1?' . $query_string . '"', $data['pagination']);

            $this->load->view('conta/tarefas',  $data);
        } else {

            $config['base_url'] = base_url('conta/tarefas');
            $config['total_rows'] = $this->conta_model->count_tarefas(); // Total de registros
            $config['per_page'] = 10; // Quantidade de imóveis por página
            $config['uri_segment'] = 3; // Segmento da URL onde a página está indicada

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = 'Primeira';
            $config['last_link'] = 'Última';
            $config['next_link'] = '&gt;';
            $config['prev_link'] = '&lt;';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data = array(
                'tarefas' => $this->conta_model->get_tarefas($config['per_page'], $page),
                'pagination' => $this->pagination->create_links()
            );

            $this->load->view('conta/tarefas',  $data);
        }
    }

    public function produtos()
    {
        if ($this->input->get()) {

            $f_data = $this->input->get();
            $base_url = base_url('conta/produtos');
            $query_string = http_build_query($f_data);

            $config['base_url'] = $base_url;
            $config['total_rows'] = $this->conta_model->count_search_produtos($f_data);
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = 'Primeira';
            $config['last_link'] = 'Última';
            $config['next_link'] = '&gt;';
            $config['prev_link'] = '&lt;';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';



            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data = array(
                'produtos' => $this->conta_model->get_search_produtos($f_data, $config['per_page'], $page),
                'pagination' => $this->pagination->create_links()
            );


            $data['pagination'] = preg_replace('/href="([^"]+)"/', 'href="$1?' . $query_string . '"', $data['pagination']);

            $this->load->view('conta/produtos',  $data);
        } else {

            $config['base_url'] = base_url('conta/produtos');
            $config['total_rows'] = $this->conta_model->count_produtos(); // Total de registros
            $config['per_page'] = 10; // Quantidade de imóveis por página
            $config['uri_segment'] = 3; // Segmento da URL onde a página está indicada

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = 'Primeira';
            $config['last_link'] = 'Última';
            $config['next_link'] = '&gt;';
            $config['prev_link'] = '&lt;';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data = array(
                'produtos' => $this->conta_model->get_produtos($config['per_page'], $page),
                'pagination' => $this->pagination->create_links()
            );

            $this->load->view('conta/produtos',  $data);
        }
    }


    public function agentes()
    {
        if ($this->input->get()) {

            $f_data = $this->input->get();
            $base_url = base_url('conta/agentes');
            $query_string = http_build_query($f_data);

            $config['base_url'] = $base_url;
            $config['total_rows'] = $this->conta_model->count_search_agentes($f_data);
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = 'Primeira';
            $config['last_link'] = 'Última';
            $config['next_link'] = '&gt;';
            $config['prev_link'] = '&lt;';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';



            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data = array(
                'agentes' => $this->conta_model->get_search_agentes($f_data, $config['per_page'], $page),
                'pagination' => $this->pagination->create_links()
            );


            $data['pagination'] = preg_replace('/href="([^"]+)"/', 'href="$1?' . $query_string . '"', $data['pagination']);

            $this->load->view('conta/agentes',  $data);
        } else {

            $config['base_url'] = base_url('conta/agentes');
            $config['total_rows'] = $this->conta_model->count_agentes(); // Total de registros
            $config['per_page'] = 10; // Quantidade de imóveis por página
            $config['uri_segment'] = 3; // Segmento da URL onde a página está indicada

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = 'Primeira';
            $config['last_link'] = 'Última';
            $config['next_link'] = '&gt;';
            $config['prev_link'] = '&lt;';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data = array(
                'agentes' => $this->conta_model->get_agentes($config['per_page'], $page),
                'pagination' => $this->pagination->create_links()
            );

            $this->load->view('conta/agentes',  $data);
        }
    }

    public function demandas()
    {
        if ($this->input->get()) {

            $f_data = $this->input->get();
            $base_url = base_url('conta/demandas');
            $query_string = http_build_query($f_data);

            $config['base_url'] = $base_url;
            $config['total_rows'] = $this->conta_model->count_search_demandas($f_data);
            $config['per_page'] = 50;
            $config['uri_segment'] = 3;

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = 'Primeira';
            $config['last_link'] = 'Última';
            $config['next_link'] = '&gt;';
            $config['prev_link'] = '&lt;';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';



            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data = array(
                'demandas' => $this->conta_model->get_search_demandas($f_data, $config['per_page'], $page),
                'pagination' => $this->pagination->create_links()
            );


            $data['pagination'] = preg_replace('/href="([^"]+)"/', 'href="$1?' . $query_string . '"', $data['pagination']);

            $this->load->view('conta/demandas',  $data);
        } else {

            $config['base_url'] = base_url('conta/demandas');
            $config['total_rows'] = $this->conta_model->count_demandas(); // Total de registros
            $config['per_page'] = 50; // Quantidade de imóveis por página
            $config['uri_segment'] = 3; // Segmento da URL onde a página está indicada

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = 'Primeira';
            $config['last_link'] = 'Última';
            $config['next_link'] = '&gt;';
            $config['prev_link'] = '&lt;';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data = array(
                'demandas' => $this->conta_model->get_demandas($config['per_page'], $page),
                'pagination' => $this->pagination->create_links()
            );

            $this->load->view('conta/demandas',  $data);
        }
    }

    public function ofertas()
    {
        if ($this->input->get()) {

            $f_data = $this->input->get();
            $base_url = base_url('conta/ofertas');
            $query_string = http_build_query($f_data);

            $config['base_url'] = $base_url;
            $config['total_rows'] = $this->conta_model->count_search_ofertas($f_data);
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = 'Primeira';
            $config['last_link'] = 'Última';
            $config['next_link'] = '&gt;';
            $config['prev_link'] = '&lt;';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';



            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data = array(
                'ofertas' => $this->conta_model->get_search_ofertas($f_data, $config['per_page'], $page),
                'pagination' => $this->pagination->create_links()
            );


            $data['pagination'] = preg_replace('/href="([^"]+)"/', 'href="$1?' . $query_string . '"', $data['pagination']);

            $this->load->view('conta/ofertas',  $data);
        } else {

            $config['base_url'] = base_url('conta/ofertas');
            $config['total_rows'] = $this->conta_model->count_ofertas(); // Total de registros
            $config['per_page'] = 10; // Quantidade de imóveis por página
            $config['uri_segment'] = 3; // Segmento da URL onde a página está indicada

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = 'Primeira';
            $config['last_link'] = 'Última';
            $config['next_link'] = '&gt;';
            $config['prev_link'] = '&lt;';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data = array(
                'ofertas' => $this->conta_model->get_ofertas($config['per_page'], $page),
                'pagination' => $this->pagination->create_links()
            );

            $this->load->view('conta/ofertas',  $data);
        }

        // print_r($data['ofertas']);
    }


    public function vendas()
    {
        $this->load->view('conta/vendas');
    }

    public function campanhas()
    {
        if ($this->input->get()) {

            $f_data = $this->input->get();
            $base_url = base_url('conta/campanhas');
            $query_string = http_build_query($f_data);

            $config['base_url'] = $base_url;
            $config['total_rows'] = $this->conta_model->count_search_campanhas($f_data);
            $config['per_page'] = 50;
            $config['uri_segment'] = 3;

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = 'Primeira';
            $config['last_link'] = 'Última';
            $config['next_link'] = '&gt;';
            $config['prev_link'] = '&lt;';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';



            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data = array(
                'campanhas' => $this->conta_model->get_search_campanhas($f_data, $config['per_page'], $page),
                'pagination' => $this->pagination->create_links()
            );


            $data['pagination'] = preg_replace('/href="([^"]+)"/', 'href="$1?' . $query_string . '"', $data['pagination']);

            $this->load->view('conta/campanhas',  $data);
        } else {

            $config['base_url'] = base_url('conta/campanhas');
            $config['total_rows'] = $this->conta_model->count_campanhas(); // Total de registros
            $config['per_page'] = 50; // Quantidade de imóveis por página
            $config['uri_segment'] = 3; // Segmento da URL onde a página está indicada

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = 'Primeira';
            $config['last_link'] = 'Última';
            $config['next_link'] = '&gt;';
            $config['prev_link'] = '&lt;';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';


            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data = array(
                'campanhas' => $this->conta_model->get_campanhas($config['per_page'], $page),
                'pagination' => $this->pagination->create_links()
            );


            $this->load->view('conta/campanhas',  $data);
        }
    }

    public function campanhas_ofertas($campanha_id)

    {

        if ($this->input->get()) {

            $f_data = $this->input->get();
            $base_url = base_url('conta/campanhas_ofertas');
            $query_string = http_build_query($f_data);

            $config['base_url'] = $base_url;
            $config['total_rows'] = $this->conta_model->count_search_campanhas_ofertas($campanha_id, $f_data);
            $config['per_page'] = 100;
            $config['uri_segment'] = 3;

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = 'Primeira';
            $config['last_link'] = 'Última';
            $config['next_link'] = '&gt;';
            $config['prev_link'] = '&lt;';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';



            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data = array(
                'ofertas' => $this->conta_model->get_search_campanhas_ofertas($campanha_id, $f_data, $config['per_page'], $page),
                'pagination' => $this->pagination->create_links(),
                'campanha_id' => $campanha_id

            );


            $data['pagination'] = preg_replace('/href="([^"]+)"/', 'href="$1?' . $query_string . '"', $data['pagination']);

            $this->load->view('conta/campanhas_ofertas',  $data);
        } else {

            $config['base_url'] = base_url('conta/campanhas_ofertas');
            $config['total_rows'] = $this->conta_model->count_campanhas_ofertas($campanha_id); // Total de registros
            $config['per_page'] = 100; // Quantidade de imóveis por página
            $config['uri_segment'] = 3; // Segmento da URL onde a página está indicada

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = 'Primeira';
            $config['last_link'] = 'Última';
            $config['next_link'] = '&gt;';
            $config['prev_link'] = '&lt;';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';


            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data = array(
                'ofertas' => $this->conta_model->get_campanhas_ofertas($campanha_id, $config['per_page'], $page),
                'pagination' => $this->pagination->create_links(),
                'campanha_id' => $campanha_id
            );




            $this->load->view('conta/campanhas_ofertas',  $data);
        }
    }


    public function campanhas_leads($campanha_id)

    {

        $campanha_data = $this->conta_model->get_campanha($campanha_id);

        if (!$campanha_data) {
            redirect(base_url());
        }

        // echo $campanha_data->campanha_tipo;


        $config['base_url'] = base_url('conta/campanhas_leads/' . $campanha_id);
        $config['total_rows'] = $this->conta_model->count_campanhas_leads($campanha_data->campanha_tag_id); // Total de registros
        $config['per_page'] = 10000000; // Quantidade de imóveis por página
        $config['uri_segment'] = 4; // Segmento da URL onde a página está indicada

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'Primeira';
        $config['last_link'] = 'Última';
        $config['next_link'] = '&gt;';
        $config['prev_link'] = '&lt;';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';


        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;



        $data = array(
            'leads' => $this->conta_model->get_campanhas_leads($campanha_data->campanha_tag_id, $config['per_page'], $page),
            'pagination' => $this->pagination->create_links(),
            'campanha' => $campanha_data
        );

        $this->load->view('conta/campanhas_leads',  $data);
    }

    public function tags()
    {

        if ($this->input->get()) {

            $f_data = $this->input->get();
            $base_url = base_url('conta/tags');
            $query_string = http_build_query($f_data);

            $config['base_url'] = $base_url;
            $config['total_rows'] = $this->conta_model->count_search_tags($f_data);
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = 'Primeira';
            $config['last_link'] = 'Última';
            $config['next_link'] = '&gt;';
            $config['prev_link'] = '&lt;';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';



            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data = array(
                'tags' => $this->conta_model->get_search_tags($f_data, $config['per_page'], $page),
                'pagination' => $this->pagination->create_links()
            );


            $data['pagination'] = preg_replace('/href="([^"]+)"/', 'href="$1?' . $query_string . '"', $data['pagination']);

            $this->load->view('conta/tags', $data);
        } else {

            $config['base_url'] = base_url('conta/tags');
            $config['total_rows'] = $this->conta_model->count_tags(); // Total de registros
            $config['per_page'] = 10; // Quantidade de imóveis por página
            $config['uri_segment'] = 3; // Segmento da URL onde a página está indicada

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = 'Primeira';
            $config['last_link'] = 'Última';
            $config['next_link'] = '&gt;';
            $config['prev_link'] = '&lt;';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data = array(
                'tags' => $this->conta_model->get_tags($config['per_page'], $page),
                'pagination' => $this->pagination->create_links()
            );

            $this->load->view('conta/tags', $data);
        }
    }
    // ACTIONS


    // TAGS
    public function act_add_tag()
    {
        $data['tag_name'] =  htmlspecialchars($this->input->post('tag_name'));
        $data['tag_description'] = htmlspecialchars($this->input->post('tag_description'));
        $data['is_deleted'] = 0;

        $response = array();

        if ($this->conta_model->check_tag($data['tag_name'])) {
            $response = array("status" => false, "message" => "Já existe uma TAG com este nome");
        } else {

            if ($this->conta_model->add_tag($data)) {
                $response = array("status" => true, "message" => "TAG adicionada com sucesso");
            } else {
                $response = array("status" => false, "message" => "Erro ao adicionar TAG");
            }
        }

        return print_r(json_encode($response));
    }

    public function act_update_tag()
    {
        $tag_id = htmlspecialchars($this->input->post('tag_id'));
        $data['tag_name'] =  htmlspecialchars($this->input->post('tag_name'));
        $data['tag_description'] = htmlspecialchars($this->input->post('tag_description'));
        $data['is_deleted'] = 0;

        $response = array();

        if ($this->conta_model->update_tag($tag_id, $data)) {
            $response = array("status" => true, "message" => "TAG atualizada com sucesso");
        } else {
            $response = array("status" => false, "message" => "Erro ao atualizar TAG");
        }

        return print_r(json_encode($response));
    }

    public function act_delete_tag()
    {

        $tag_id = htmlspecialchars($this->input->post('tag_id'));

        $response = array();

        if ($this->conta_model->delete_tag($tag_id)) {
            $response = array("status" => true, "message" => "TAG excluida com sucesso");
        } else {
            $response = array("status" => false, "message" => "Erro ao excluir TAG");
        }

        return print_r(json_encode($response));
    }

    public function act_get_tag()
    {
        $tag_id =  htmlspecialchars($this->input->post('tag_id'));


        $response = array();

        if ($res = $this->conta_model->get_tag($tag_id)) {

            $response = array("status" => true, "message" => "TAG pega com sucesso", "response" => $res);
        } else {


            $response = array("status" => false, "message" => "Erro ao pegar TAG");
        }

        return print_r(json_encode($response));
    }
    // TAGS

    // TAREFAS
    public function act_add_tarefa()
    {
        $data['tarefa_nome'] =  htmlspecialchars($this->input->post('tarefa_nome'));
        $data['tarefa_tag'] = htmlspecialchars($this->input->post('tarefa_tag'));
        $data['tarefa_status'] = htmlspecialchars($this->input->post('tarefa_status'));
        $data['tarefa_tipo'] = htmlspecialchars($this->input->post('tarefa_tipo'));
        $data['tarefa_url'] = htmlspecialchars($this->input->post('tarefa_url'));
        $data['is_deleted'] = 0;

        $response = array();


        if ($this->conta_model->check_tarefa($data['tarefa_url'])) {

            $response = array("status" => false, "message" => "Esta URL já existe.");
        } else {
            if ($this->conta_model->add_tarefa($data)) {
                $response = array("status" => true, "message" => "Tarefa adicionada com sucesso");
            } else {
                $response = array("status" => false, "message" => "Erro ao adicionar Tarefa");
            }
        }



        return print_r(json_encode($response));
    }

    public function act_update_tarefa()
    {
        $tarefa_id =  htmlspecialchars($this->input->post('tarefa_id'));
        $data['tarefa_nome'] =  htmlspecialchars($this->input->post('tarefa_nome'));
        $data['tarefa_tag'] = htmlspecialchars($this->input->post('tarefa_tag'));
        $data['tarefa_status'] = htmlspecialchars($this->input->post('tarefa_status'));
        $data['tarefa_tipo'] = htmlspecialchars($this->input->post('tarefa_tipo'));
        $data['tarefa_url'] = htmlspecialchars($this->input->post('tarefa_url'));
        $data['is_deleted'] = 0;

        $response = array();


        if ($this->conta_model->update_tarefa($tarefa_id, $data)) {
            $response = array("status" => true, "message" => "Tarefa atualizada com sucesso");
        } else {
            $response = array("status" => false, "message" => "Erro ao atualizar Tarefa");
        }


        return print_r(json_encode($response));
    }

    public function act_delete_tarefa()
    {

        $tarefa_id = htmlspecialchars($this->input->post('tarefa_id'));

        $response = array();

        if ($this->conta_model->delete_tarefa($tarefa_id)) {
            $response = array("status" => true, "message" => "Tarefa excluida com sucesso");
        } else {
            $response = array("status" => false, "message" => "Erro ao excluir Tarefa");
        }

        return print_r(json_encode($response));
    }

    public function act_get_tarefa()
    {
        $tarefa_id =  htmlspecialchars($this->input->post('tarefa_id'));


        $response = array();

        if ($res = $this->conta_model->get_tarefa($tarefa_id)) {

            $response = array("status" => true, "message" => "Tarefa pega com sucesso", "response" => $res);
        } else {


            $response = array("status" => false, "message" => "Erro ao pegar Tarefa");
        }

        return print_r(json_encode($response));
    }
    // TAREFAS


    // PRODUTO
    public function act_add_produto()
    {
        $data['nome'] =  htmlspecialchars($this->input->post('nome'));
        $data['descricao'] = htmlspecialchars($this->input->post('descricao'));
        $data['imagem'] = htmlspecialchars($this->input->post('imagem'));
        $data['preco'] = htmlspecialchars($this->input->post('preco'));
        $data['plataforma'] = htmlspecialchars($this->input->post('plataforma'));
        $data['status'] = htmlspecialchars($this->input->post('status'));

        $data['categoria'] = htmlspecialchars($this->input->post('categoria'));
        
        $data['pagina_de_vendas'] = $this->input->post('pagina_de_vendas');
        $data['pagina_de_vendas'] =  urldecode($data['pagina_de_vendas']); // Converte &amp; de volta para &

        $data['descricao'] = htmlspecialchars($this->input->post('descricao'));
        $data['data'] = date('Y-m-d H:i:s');
        $data['is_deleted'] = 0;

        $response = array();


        if ($this->conta_model->add_produto($data)) {
            $response = array("status" => true, "message" => "Produto adicionada com sucesso");
        } else {
            $response = array("status" => false, "message" => "Erro ao adicionar Produto");
        }


        return print_r(json_encode($response));
    }

    public function act_update_produto()
    {

        $produto_id = htmlspecialchars($this->input->post('produto_id'));
        $data['nome'] =  htmlspecialchars($this->input->post('nome'));
        $data['descricao'] = htmlspecialchars($this->input->post('descricao'));
        $data['imagem'] = htmlspecialchars($this->input->post('imagem'));
        $data['preco'] = htmlspecialchars($this->input->post('preco'));
        $data['plataforma'] = htmlspecialchars($this->input->post('plataforma'));
        $data['status'] = htmlspecialchars($this->input->post('status'));

        $data['categoria'] = htmlspecialchars($this->input->post('categoria'));
        $data['pagina_de_vendas'] = htmlspecialchars($this->input->post('pagina_de_vendas'));
        $data['descricao'] = htmlspecialchars($this->input->post('descricao'));
        $data['data'] = date('Y-m-d H:i:s');
        $data['is_deleted'] = 0;

        $response = array();


        if ($this->conta_model->update_produto($produto_id, $data)) {
            $response = array("status" => true, "message" => "Produto atualizada com sucesso");
        } else {
            $response = array("status" => false, "message" => "Erro ao atualizar Produto");
        }


        return print_r(json_encode($response));
    }

    public function act_delete_produto()
    {

        $produto_id = htmlspecialchars($this->input->post('produto_id'));

        $response = array();

        if ($this->conta_model->delete_produto($produto_id)) {
            $response = array("status" => true, "message" => "Produto excluida com sucesso");
        } else {
            $response = array("status" => false, "message" => "Erro ao excluir Produto");
        }

        return print_r(json_encode($response));
    }

    public function act_get_produto()
    {
        $produto_id =  htmlspecialchars($this->input->post('produto_id'));


        $response = array();

        if ($res = $this->conta_model->get_produto($produto_id)) {

            $response = array("status" => true, "message" => "produto pega com sucesso", "response" => $res);
        } else {


            $response = array("status" => false, "message" => "Erro ao pegar produto");
        }

        return print_r(json_encode($response));
    }
    // PRODUTO


    // AGENTES
    public function act_add_agente()
    {
        $data['agente_nome'] =  htmlspecialchars($this->input->post('agente_nome'));
        $data['agente_username'] = htmlspecialchars($this->input->post('agente_username'));
        $data['agente_email'] = htmlspecialchars($this->input->post('agente_email'));
        $data['agente_senha'] = htmlspecialchars($this->input->post('agente_senha'));
        $data['agente_ocupado'] = htmlspecialchars($this->input->post('agente_ocupado'));
        $data['agente_sexo'] = htmlspecialchars($this->input->post('agente_sexo'));

        $data['agente_status'] = htmlspecialchars($this->input->post('agente_status'));
        $data['agente_data'] = date('Y-m-d H:i:s');
        $data['is_deleted'] = 0;

        $response = array();


        if ($this->conta_model->add_agente($data)) {
            $response = array("status" => true, "message" => "agente adicionada com sucesso");
        } else {
            $response = array("status" => false, "message" => "Erro ao adicionar agente");
        }


        return print_r(json_encode($response));
    }

    public function act_update_agente()
    {

        $agente_id = htmlspecialchars($this->input->post('agente_id'));
        $data['agente_nome'] =  htmlspecialchars($this->input->post('agente_nome'));
        $data['agente_username'] = htmlspecialchars($this->input->post('agente_username'));
        $data['agente_email'] = htmlspecialchars($this->input->post('agente_email'));
        $data['agente_senha'] = htmlspecialchars($this->input->post('agente_senha'));
        $data['agente_ocupado'] = htmlspecialchars($this->input->post('agente_ocupado'));
        $data['agente_sexo'] = htmlspecialchars($this->input->post('agente_sexo'));

        $data['agente_status'] = htmlspecialchars($this->input->post('agente_status'));
        $data['is_deleted'] = 0;

        $response = array();


        if ($this->conta_model->update_agente($agente_id, $data)) {
            $response = array("status" => true, "message" => "agente atualizada com sucesso");
        } else {
            $response = array("status" => false, "message" => "Erro ao atualizar agente");
        }


        return print_r(json_encode($response));
    }

    public function act_delete_agente()
    {

        $agente_id = htmlspecialchars($this->input->post('agente_id'));

        $response = array();

        if ($this->conta_model->delete_agente($agente_id)) {
            $response = array("status" => true, "message" => "agente excluida com sucesso");
        } else {
            $response = array("status" => false, "message" => "Erro ao excluir agente");
        }

        return print_r(json_encode($response));
    }

    public function act_get_agente()
    {
        $agente_id =  htmlspecialchars($this->input->post('agente_id'));


        $response = array();

        if ($res = $this->conta_model->get_agente($agente_id)) {

            $response = array("status" => true, "message" => "agente pega com sucesso", "response" => $res);
        } else {


            $response = array("status" => false, "message" => "Erro ao pegar agente");
        }

        return print_r(json_encode($response));
    }
    // AGENTES




    // CAMPANHA
    public function act_add_campanha()
    {
        $data['campanha_nome'] =  htmlspecialchars($this->input->post('campanha_nome'));
        $data['campanha_descricao'] = htmlspecialchars($this->input->post('campanha_descricao'));
        $data['campanha_tag_id'] = htmlspecialchars($this->input->post('campanha_tag_id'));
        $data['campanha_produto_id'] = htmlspecialchars($this->input->post('campanha_produto_id'));
        $data['campanha_data'] = date('Y-m-d H:i:s');
        $data['campanha_status'] = htmlspecialchars($this->input->post('campanha_status'));
        $data['campanha_tipo'] = htmlspecialchars($this->input->post('campanha_tipo'));

        $data['is_deleted'] = 0;

        $response = array();

        if ($this->conta_model->add_campanha($data)) {
            $response = array("status" => true, "message" => "Campanha adicionada com sucesso");
        } else {
            $response = array("status" => false, "message" => "Erro ao adicionar Campanha");
        }

        return print_r(json_encode($response));
    }

    public function act_update_campanha()
    {

        $campanha_id = htmlspecialchars($this->input->post('campanha_id'));
        $data['campanha_nome'] =  htmlspecialchars($this->input->post('campanha_nome'));
        $data['campanha_descricao'] = htmlspecialchars($this->input->post('campanha_descricao'));
        $data['campanha_tag_id'] = htmlspecialchars($this->input->post('campanha_tag_id'));
        $data['campanha_produto_id'] = htmlspecialchars($this->input->post('campanha_produto_id'));
        $data['campanha_data'] = date('Y-m-d H:i:s');
        $data['campanha_status'] = htmlspecialchars($this->input->post('campanha_status'));
        $data['campanha_tipo'] = htmlspecialchars($this->input->post('campanha_tipo'));

        $data['is_deleted'] = 0;

        $response = array();

        if ($this->conta_model->update_campanha($campanha_id, $data)) {
            $response = array("status" => true, "message" => "Campanha atualizada com sucesso");
        } else {
            $response = array("status" => false, "message" => "Erro ao atualizar Campanha");
        }


        return print_r(json_encode($response));
    }

    public function act_delete_campanha()
    {

        $campanha_id = htmlspecialchars($this->input->post('campanha_id'));

        $response = array();

        if ($this->conta_model->delete_campanha($campanha_id)) {
            $response = array("status" => true, "message" => "Campanha excluida com sucesso");
        } else {
            $response = array("status" => false, "message" => "Erro ao excluir Campanha");
        }

        return print_r(json_encode($response));
    }

    public function act_get_campanha()
    {
        $campanha_id =  htmlspecialchars($this->input->post('campanha_id'));


        $response = array();

        if ($res = $this->conta_model->get_campanha($campanha_id)) {

            $response = array("status" => true, "message" => "Campanha pega com sucesso", "response" => $res);
        } else {


            $response = array("status" => false, "message" => "Erro ao pegar Campanha");
        }

        return print_r(json_encode($response));
    }
    // CAMPANHA


    // CAMPANHA OFERTA
    public function act_add_campanhas_ofertas()
    {
        $data['oferta_nome'] =  htmlspecialchars($this->input->post('oferta_nome'));
        $data['oferta_conteudo'] = htmlspecialchars($this->input->post('oferta_conteudo'));
        $data['oferta_campanha_id'] = htmlspecialchars($this->input->post('oferta_campanha_id'));
        $data['oferta_tipo'] = htmlspecialchars($this->input->post('oferta_tipo'));
        $data['oferta_data'] = date('Y-m-d H:i:s');
        $data['is_deleted'] = 0;

        $response = array();

        if ($this->conta_model->add_campanhas_ofertas($data)) {
            $response = array("status" => true, "message" => "Campanha adicionada com sucesso");
        } else {
            $response = array("status" => false, "message" => "Erro ao adicionar Campanha");
        }

        return print_r(json_encode($response));
    }

    public function act_update_campanhas_ofertas()
    {

        $oferta_id = htmlspecialchars($this->input->post('oferta_id'));
        $data['oferta_nome'] =  htmlspecialchars($this->input->post('oferta_nome'));
        $data['oferta_conteudo'] = htmlspecialchars($this->input->post('oferta_conteudo'));
        $data['oferta_campanha_id'] = htmlspecialchars($this->input->post('oferta_campanha_id'));
        $data['oferta_tipo'] = htmlspecialchars($this->input->post('oferta_tipo'));
        // $data['oferta_data'] = date('Y-m-d H:i:s');
        // $data['is_deleted'] = 0;

        $response = array();

        if ($this->conta_model->update_campanhas_ofertas($oferta_id, $data)) {
            $response = array("status" => true, "message" => "Campanha atualizada com sucesso");
        } else {
            $response = array("status" => false, "message" => "Erro ao atualizar Campanha");
        }


        return print_r(json_encode($response));
    }

    public function act_delete_campanhas_ofertas()
    {

        $oferta_id = htmlspecialchars($this->input->post('oferta_id'));

        $response = array();

        if ($this->conta_model->delete_campanhas_ofertas($oferta_id)) {
            $response = array("status" => true, "message" => "Campanha excluida com sucesso");
        } else {
            $response = array("status" => false, "message" => "Erro ao excluir Campanha");
        }

        return print_r(json_encode($response));
    }

    public function act_get_campanhas_ofertas()
    {
        $oferta_id =  htmlspecialchars($this->input->post('oferta_id'));


        $response = array();

        if ($res = $this->conta_model->get_campanha_ofertas($oferta_id)) {

            $response = array("status" => true, "message" => "Campanha pega com sucesso", "response" => $res);
        } else {


            $response = array("status" => false, "message" => "Erro ao pegar Campanha");
        }

        return print_r(json_encode($response));
    }
    // CAMPANHA OFERTA


    // criandooferta

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

    public function sms_dev($telefone, $oferta_mensagem)
    {



        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.smsdev.com.br/v1/send?key=SUA_CHAVE_KEY&type=9&number=11988887777&msg=" . urlencode("Teste de envio"),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    public function action_enviar_oferta()
    {

        if (count($this->conta_model->count_sms_template_by_campanha($this->input->post('oferta_campanha_id')))) {

            $temaplte = $this->conta_model->get_sms_template_by_campanha($this->input->post('oferta_campanha_id'));


            $data['oferta_status'] = 0;
            $data['oferta_persona_id'] =  htmlspecialchars($this->input->post('oferta_persona_id'));
            $data['oferta_insta_id'] = htmlspecialchars($this->input->post('oferta_insta_id'));
            $data['oferta_campanha_id'] = htmlspecialchars($this->input->post('oferta_campanha_id'));
            $data['oferta_oferta_id'] = $temaplte[0]->id;
            $data['oferta_tag_id'] = htmlspecialchars($this->input->post('oferta_tag_id'));
            $data['oferta_produto_id'] = htmlspecialchars($this->input->post('oferta_produto_id'));
            $data['oferta_tipo'] = htmlspecialchars($this->input->post('oferta_tipo'));

            $data['oferta_data'] = date('Y-m-d');

            $data['oferta_data_creation'] = date('Y-m-d H:i:s');
            $data['oferta_key'] = $this->get_oferta_key(htmlspecialchars($this->input->post('oferta_persona_id')), htmlspecialchars($this->input->post('oferta_campanha_id')));

            $data['oferta_time'] = date('H:i:s');
            $data['oferta_agente_id'] = 'api';
            $data['is_deleted'] = 0;


            if ($this->api_model->add_oferta($data)) {

                $response = array("status" => true, "message" => "Oferta enviada com sucesso");
            } else {

                $response = array("status" => false, "message" => "Erro ao enviar oferta");
            }


            return print_r(json_encode($response));
        } else {

            $response = array("status" => false, "message" => "Não existem templates de ofertas para esta campanha. ");

            return print_r(json_encode($response));
        }
    }
}
