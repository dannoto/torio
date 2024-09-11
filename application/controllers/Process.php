<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process extends CI_Controller {

    function __construct() {

		parent::__construct();

		$this->load->model('process_model');
		$this->load->model('admin_model');


	}

    public function EmpresasToPersona() {
       
        $cnae = "6911701";

        echo "COMEÇOU AS: ".date('d-m-Y H:i:s');

        // echo count($this->process_model->getEmpresasByCnaeTotal($cnae));
        // echo count($this->process_model->getEmpresasByCnae($cnae));


        foreach ($this->process_model->getEmpresasByCnae($cnae) as $p) {


            $check_telefone = "";
            $check_telefone_1 = "";
            $check_telefone_2 = "";
            $check_email = "";
            $contabil = "";

            echo "<br>=======================<br>";


                if (strlen($p->nome_fantasia) > 0) {
                    $person['nome'] = $p->nome_fantasia;
                
                } else {
                    $person['nome'] = "ADVOCACIA";
           
                }

                
                $person['cnpj'] = $p->cnpj_basico."". $p->cnpj_ordem."". $p->cnpj_dv;
                $person['data']= date('d-m-Y H:i:s');
                $person['endereco'] =  $p->tipo_logradouro." ".$p->logradouro;
                $person['bairro'] =  $p->bairro;
                $person['cidade'] =  $p->municipio;
                $person['estado'] =  $p->uf;
                $person['pais'] = $p->pais;
                $person['cep'] = $p->cep;
                $person['complemento'] = $p->complemento;

                $person['tipo'] = "pessoa_juridica";
                $person['validacao_email'] = 1;
                $person['validacao_telefone'] = 1;
                $person['validacao_perfil'] = 1;
                $person['is_deleted'] = 0;


                $data['telefone_1'] =  "55".$p->ddd_1."9".$p->telefone_1;	
                $data['telefone_2'] =  "55".$p->ddd_2."9".$p->telefone_2;
                $data['email'] =  strtolower($p->email);


                if (strpos($data['email'] , "contabil") != false || strpos( $data['email'], "contabilidade" ) != false || strpos( $data['email'], "contador") != false) {
                    $contabil = 1;
                } else {
                    $contabil = 0;
                }



            if ($contabil == 0) {

            
                    if ($this->process_model->check_email($data['email'])) {
                        $this->process_model->updateEmpressaProcesso($p->id, 6 );

                        echo "<br>[!] O EMAIL ".$data['email']." JÁ EXISTE NO SISTEMA.<br>";
                        // $this->admin_model->delete_email($this->process_model->check_email($data['email'])['id']);

                    } else if ($this->process_model->check_telefone($data['telefone_1'])) {
                        $this->process_model->updateEmpressaProcesso($p->id, 7 );

                        echo "<br>[!] O TELEFONE ".$data['telefone_1']." JÁ EXISTE NO SISTEMA.<br>";

                        // $this->admin_model->delete_telefone($this->process_model->check_telefone($data['telefone_1'])['id']);

                    } else {

                    

                        // Verificando Telefone
                        if (strlen($data['telefone_1']) == '13') {

                            echo "<br>[!] O TELEFONE 1: ".$data['telefone_1']." É VALIDO.<br>";

            
                            $check_telefone = 1;
                            $check_telefone_1 = 1;

                        } else if (strlen($data['telefone_2']) == '13') {

                            echo "<br>[!] O TELEFONE 2: ".$data['telefone_2']." É VALIDO    .<br>";

                            $check_telefone = 1;
                            $check_telefone_2 = 1;


                        } else {

                            echo "<br>[!] TODOS OS TELEFONES : ".$data['telefone_1']." ".$data['telefone_2']." SAO INVALIDOS.<br>";

                            $check_telefone = 0;
                            $check_telefone_1 = 0;
                            $check_telefone_2 = 0;

                        }


                        // Verificando Email
                        echo "<br> ==== [!!!] EMAIL NAO É DE  CONTABILIDADE ====<br>";

                        if ($this->checkEmailValido($data['email'])) {

                            if ($this->verificarProvedor($data['email'])) {

                                echo "<br>[!] EMAIL PUBLICO : ".$data['email']." É VALIDO.<br>";
                                

                                $check_email = 1;

                            } else {

                            


                                if ($this->checkEmailDominio($data['email'])) {

                                    echo "<br>[!] EMAIL PARTICULAR : ".$data['email']." É ATIVO.<br>";

                                    $check_email = 0;


                                    // $check_email = 1;

                                } else {

                                    echo "<br>[!] EMAIL PARTICULAR : ".$data['email']." É INATIVO.<br>";

                                    $check_email = 0;
                                }

                                

                            }

                        } else {

                            echo "<br>[!] EMAIL MAL-FORMATADO : ".$data['email']." É INVÁLIDO.<br>";
                            $check_email = 0;

                        }


                    


                        if ($check_telefone == '1'  && $check_email == '1'){

                            if (strlen($p->nome_fantasia) > 0) {
                                $person['nome'] = $p->nome_fantasia;
                            
                            } else {
                                $person['nome'] = "ADVOCACIA";
                    
                            }
                            $person['cnpj'] = $p->cnpj_basico."". $p->cnpj_ordem."". $p->cnpj_dv;
            
                            $person['endereco'] =  $p->tipo_logradouro." ".$p->logradouro;
                            $person['bairro'] =  $p->bairro;
                            $person['cidade'] =  $p->municipio;
                            $person['estado'] =  $p->uf;
                            $person['pais'] = $p->pais;
                            $person['cep'] = $p->cep;
                            $person['complemento'] = $p->complemento;
            
                            $person['tipo'] = "pessoa_juridica";
                            $person['validacao_email'] = 1;
                            $person['validacao_telefone'] = 1;
                            $person['validacao_perfil'] = 1;
                            $person['is_deleted'] = 0;
            
            
                            $data['telefone_1'] =  "55".$p->ddd_1."9".$p->telefone_1;	
                            $data['telefone_2'] =  "55".$p->ddd_2."9".$p->telefone_2;
                            $data['email'] =  strtolower($p->email);
            
                            $person_id = $this->process_model->add_person($person);

                            if ($person_id) {

                                echo "<br>[!] PESSOA CRIADA COM SUCESSO : ".$person['nome']." <br>";

                            }
                        
                            // Telefone

                            if ($check_telefone_1 == "1") {

                                $telefone['person_id'] = $person_id;
                                $telefone['telefone'] = $data['telefone_1'];
                                $telefone['is_validado'] = 1;
                                $telefone['is_deleted'] = 0;
        
                                $check_telefone = 1;
        
                                $this->process_model->add_telefone($telefone);
                                echo "<br>[!] TELEFONE ATRIBUIDO 1: ".$data['telefone_1']." <br>";


                            } else if ($check_telefone_2 == "1" ) {

                                $telefone['person_id'] = $person_id;
                                $telefone['telefone'] = $data['telefone_2'];
                                $telefone['is_validado'] = 1;
                                $telefone['is_deleted'] = 0;
        
                                $check_telefone = 1;
        
                                $this->process_model->add_telefone($telefone);

                                echo "<br>[!] TELEFONE ATRIBUIDO 2: ".$data['telefone_2']." <br>";

                            }
                        

                            // Email
                            $email['person_id'] = $person_id;
                            $email['email'] = $data['email'];
                            $email['is_validado'] = 1;
                            $email['is_deleted'] = 0;
                    
                            if ($this->process_model->add_email($email)) {
                                
                                echo "<br>[!] E-MAIL ATRIBUIDO : ".$data['email']." <br>";

                            }


                            // tag_id
                            $tag['person_id'] = $person_id;
                            $tag['categoria_id'] = 42;
                            $tag['subcategoria_id'] = 87;
                            $tag['tag_id'] = 156;
                            $tag['data'] = date('d-m-Y H:i:s');
                            $tag['is_deleted'] = 0;
            
                            if ($this->process_model->add_classificacao($tag)) {
                                
                                echo "<br>[!] TAG ATRIBUIDA : ". $tag['tag_id']." <br>";

                            }
            

                            // 1- > processado com sucesso 2 -> email inválido 3 -> telefone invalido 4 -> telefone e email invalido	

                            $this->process_model->updateEmpressaProcesso($p->id, 1 );

                        } else if ($check_telefone == '1'    && $check_email == '0') {

                            $this->process_model->updateEmpressaProcesso($p->id, 2 );
                            echo "<br> ==== [!!!] SEM EMAIL VALIDO ====<br>";

                        } else if ($check_telefone == '0'    && $check_email == '1') {

                            $this->process_model->updateEmpressaProcesso($p->id, 3 );
                            echo "<br> ==== [!!!] SEM TELEFONE VALIDO ====<br>";


                        } else if ($check_telefone == '0'   && $check_email == '0') {

                            $this->process_model->updateEmpressaProcesso($p->id, 4 );
                            echo "<br> ==== [!!!] SEM EMAIL & TELEFONE VALIDO ====<br>";


                        }


                    }

                    echo "<br>CHECK TELEFONE: ".$check_telefone;
                    echo "<br>CHECK EMAIL: ".$check_email;

            } else if ($contabil == 1) {

                $this->process_model->updateEmpressaProcesso($p->id, 5 );
                echo "<br> ==== [!!!] EMAIL DE CONTABILIDADE ====<br>";

            }

            echo "<br>=======================<br>";
        }



        // Header("Location:".base_url('process/EmpresasToPersona'));
    }


    function checkEmailDominio($email) {


        // Extrai o domínio do e-mail
        $dominio = explode('@', $email)[1];
    
        // Faz uma requisição HEAD para o domínio

        try {
            //code...
         
            $headers = @get_headers('http://' . $dominio);

            echo "<br>dominio: ".$dominio."<br>";

            echo "<br>CODIGO DE RESPOSTA: ".$headers[0]."<br>";
        
            // Verifica se a requisição foi bem-sucedida e o domínio está ativo (código 200)
            if ($headers && (strpos($headers[0], '200') !== false 
            ||  strpos($headers[0], '301') !== false 
            || strpos($headers[0], '302') !== false
            || strpos($headers[0], '303') !== false
            || strpos($headers[0], '403') !== false
            
            )) {
                return true; // Retorna true se o domínio estiver ativo
            } else {
                return false; // Retorna false se o domínio estiver inativo ou a requisição falhou
            }

        } catch (\Throwable $th) {
            return false;
        }
    }

    function checkEmailValido($email) {
        // Verifica se o formato do e-mail é válido usando uma expressão regular
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true; // Retorna true se o e-mail for válido
        } else {
            return false; // Retorna false se o e-mail for inválido
        }
    }
    

    function  verificarProvedor($email) {
        // $provedoresPublicos = ['hotmail.com','', 'yahoo.com.br', 'outlook.com', 'gmail.com', 'ig.com.br', 'terra.com.br','uol.com.br'];
        $provedoresPublicos = ['hotmail.com','',  'outlook.com', 'gmail.com'];

        $dominio = explode('@', $email)[1]; // Obtém o domínio do e-mail
    
        if (in_array($dominio, $provedoresPublicos)) {
            // echo "O provedor do e-mail $email é público: $dominio";
            return true;
        } else {
            // echo "O provedor do e-mail $email é um domínio personalizado: $dominio";
            return false;
        }
    }



    public function transporte()
	{

        echo count($this->process_model->getLeadsValidos("advogado"));


        foreach ($this->process_model->getLeadsValidos("advogado") as $c) {



            if ($this->process_model->check_email($c->email)) {

                echo "email ja existe";

            } else if ($this->process_model->check_telefone($c->telefone)) {

                echo "telefone ja existe";

            } else {

                // Adicionar Persona
                $person['nome'] = $c->nome;
                $person['site'] = $c->site;
                $person['endereco'] = $c->endereco;
                $person['cidade'] = $this->process_model->c_cidade_estado($c->cidade)['id']? : "";
                $person['estado'] = $this->process_model->c_cidade_estado($c->cidade)['uf']? : "";
                $person['tipo'] = "pessoa_juridica";
                $person['validacao_email'] = 1;
                $person['validacao_telefone'] = 1;
                $person['validacao_perfil'] = 1;
                $person['is_deleted'] = 0;


                $person_id = $this->process_model->add_person($person);

                // Adicionar Email
                $email['person_id'] = $person_id;
                $email['email'] = $c->email;
                $email['is_validado'] = 1;
                $email['is_deleted'] = 0;

                $this->process_model->add_email($email);

                // Adicionar Telefone
                $telefone['person_id'] = $person_id;
                $telefone['telefone'] = $c->telefone;
                $telefone['is_validado'] = 1;
                $telefone['is_deleted'] = 0;

                $this->process_model->add_telefone($telefone);


                // Adicionando tags
                $tag['person_id'] = $person_id;
                $tag['categoria_id'] = 42;
                $tag['subcategoria_id'] = 87;
                $tag['tag_id'] = 156;
                $tag['data'] = date('d-m-Y H:i:s');
                $tag['is_deleted'] = 0;

                $this->process_model->add_classificacao($tag);


                echo "<br>";
                print_r($person);

                echo "<br>";

            }

            
        }

	}

  
}