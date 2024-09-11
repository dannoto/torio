<?php
defined('BASEPATH') OR exit('No direct script access allowed');



require './vendor/autoload.php';


class Brevo extends CI_Controller {

    function __construct() {

		parent::__construct();

		$this->load->model('brevo_model');

	}

    public function transporte()
	{

    
      $curl = curl_init();
          
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.brevo.com/v3//contacts/import',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
        "fileBody": "NAME;SURNAME;EMAIL;WHATSAPP;SMS\\nSmith;John;cxzcd.smith@example.com\\nRoger;Ellie;dffff@example.com",
        "listIds": [17],
        "emailBlacklist": false,
        "smsBlacklist": false,
        "updateExistingContacts": true,
        "emptyContactsAttributes": true
      }',
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json',
          'Accept: application/json',
          'api-key: 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',
          'Cookie: __cf_bm=8_U5BMJQKq5DX19tJSTGvQ9bQae.0xO3Jrm7w53YPmI-1703351408-1-AQQlcdYSrjGDmTWDqyOhNNixRn8paTKiauuKhrWFJEcVIIgzdWcARkVgrrOyXPR66ik1QchIx3D3dFgXSmmPO8o='
        ),
      ));
      
      $response = curl_exec($curl);
      
      curl_close($curl);
      print_r(get_object_vars(json_decode($response)));

    
       
    }

}