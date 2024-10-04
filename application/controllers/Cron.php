<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cron extends CI_Controller
{

    function __construct()
    {

        parent::__construct();
        $this->load->model('api_model');

        $this->load->model('conta_model');
    }

    public function delete_duplicate_ips()
    {
        print_r($this->conta_model->delete_duplicate_ips());

        
    }

}

