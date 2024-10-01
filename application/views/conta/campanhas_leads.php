<!DOCTYPE html>
<html lang="en">

<head>
    <title>Leads - Tório </title>
    <?php $this->load->view('comp/css'); ?>
</head>
<style>
    .pagination {
        display: flex;
        justify-content: center;
        padding: 20px 0;
        list-style: none;
        border-radius: 10px;
    }

    .pagination a,
    .pagination strong {
        color: #fff;
        background-color: #FF0080;
        border: 1px solid #FF0080;
        padding: 10px 15px;
        margin: 0 5px;
        text-decoration: none;
        border-radius: 10px;
        transition: background-color 0.3s, color 0.3s;
    }

    .pagination a:hover {
        background-color: #FF0080;
        color: #fff;
    }

    .pagination strong {
        background-color: #FF0080;
    }

    .pagination li.disabled a,
    .pagination li.disabled strong {
        background-color: #ccc;
        border-color: #ccc;
        color: #6c757d;
        pointer-events: none;
    }

    .pagination li.active a {
        background-color: #FF0072;
        color: white;
        border: 5px solid gray;
    }
</style>

<body class="g-sidenav-show  bg-gray-100">
    <?php $this->load->view('comp/sidebar'); ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <?php $this->load->view('comp/navbar'); ?>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6 d-flex justify-content-end">
                    <!-- <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modal_add_produto"><i class="fa fa-plus mr-2"></i> Adicionar Produto</button> -->
                    <button type="button" id="trigger_update_btn" style="display: none;" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modal_update_produto">Editar Produto</button>
                </div>
            </div>
            <div class="row">
                <!-- <div class="col-12">
          <div class="card mb-4 p-3">
            <div class="pb-0">
              <div class="row">
                <div class="col-md-6">
                  <form action="">
                    <label for="">NOME DO PRODUTO</label>
                    <input type="text" name="nome" value="<?= $this->input->get('nome') ?>" class="form-control">
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-primary " style="margin-top: 30px !important;"><i class="fa fa-search"></i></button>
                </div>
                </form>
              </div>
            </div>
          </div> -->
                <!-- </div> -->
            </div>
            <div class="row">

                <div class="mb-3">
                    <a href="<?= base_url('conta/campanhas') ?>">
                        <button class="btn btn-light p-3"><i class="fa fa-arrow-left"></i></button>
                    </a>
                </div>
                <div class="card-header pb-0 mb-3">
                    <h6>#<?= $campanha->id ?> <?= $campanha->campanha_nome ?></small></h6>
                </div>
                <div class="col-12">
                    <div class="card mb-4">

                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder  ps-2">NOME</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder  ps-2">USERNAME</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder  ps-2">E-MAIL</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder  ps-2">TELEFONE</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder  ps-2">DATA</th>

                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($leads as $p) { ?>

                                            <?php $persona = $this->conta_model->get_persona($p->persona_id) ?>
                                            <?php if ($campanha->campanha_tipo == "instagram") { ?>

                                                <tr>

                                                    <td>
                                                        <p class="text-sm font-weight-bold mb-0" title="<?= $persona->persona_nome ?>"><small class="text-uppercase"><?= substr($persona->persona_nome, 0, 12) . "..." ?></small></p>
                                                    </td>
                                                    <td>
                                                        <p class="text-sm font-weight-bold mb-0" title="<?= $persona->persona_username ?>"><small class="text-uppercase"><?= $persona->persona_username ?></small></p>
                                                    </td>
                                                    <td>
                                                        <p class="text-sm font-weight-bold mb-0" title="<?= $persona->persona_email ?>"><small class="text-uppercase"><?= $persona->persona_email ?></small></p>
                                                    </td>
                                                    <td>
                                                        <p class="text-sm font-weight-bold mb-0" title="<?= $persona->persona_telefone ?>"><small class="text-uppercase"><?= $persona->persona_telefone ?></small></p>
                                                    </td>
                                                    <td>
                                                        <p class="text-sm font-weight-bold mb-0" title="<?= $persona->persona_data ?>"><small class="text-uppercase"><?= $persona->persona_data ?></small></p>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-primary"><small>ENVIAR</small></button>
                                                    </td>
                                                </tr>

                                            <?php } else if ($campanha->campanha_tipo == "sms") { ?>

                                                <?php if (strlen($persona->persona_telefone) > 0) { ?>

                                                    <tr>

                                                        <td>
                                                            <p class="text-sm font-weight-bold mb-0" title="<?= $persona->persona_nome ?>"><small class="text-uppercase"><?= substr($persona->persona_nome, 0, 12) . "..." ?></small></p>
                                                        </td>
                                                        <td>
                                                            <p class="text-sm font-weight-bold mb-0" title="<?= $persona->persona_username ?>"><small class="text-uppercase"><?= $persona->persona_username ?></small></p>
                                                        </td>
                                                        <td>
                                                            <p class="text-sm font-weight-bold mb-0" title="<?= $persona->persona_email ?>"><small class="text-uppercase"><?= $persona->persona_email ?></small></p>
                                                        </td>
                                                        <td>
                                                            <p class="text-sm font-weight-bold mb-0" title="<?= $persona->persona_telefone ?>"><small class="text-uppercase"><?= $persona->persona_telefone ?></small></p>
                                                        </td>
                                                        <td>
                                                            <p class="text-sm font-weight-bold mb-0" title="<?= $persona->persona_data ?>"><small class="text-uppercase"><?= $persona->persona_data ?></small></p>
                                                        </td>
                                                        <td>

<?php if ($this->conta_model->check_oferta_enviada($campanha->id, $campanha->campanha_produto_id, $campanha->campanha_tag_id, 'sms', $persona->id)) { ?>

    <span style="color:green"><i class="fa fa-check"></i> <small>ENVIADA</small></span>
    
    <?php } else { ?>
        
        <button onclick="add_oferta('<?=$persona->id?>', '<?=$persona->persona_username?>', '<?=$campanha->id?>', '<?=$campanha->campanha_tag_id?>', '<?=$campanha->campanha_produto_id?>')" class="btn btn-primary"><small>ENVIAR</small></button>
<?php } ?>
</td>
                                                    </tr>

                                                <?php } ?>

                                            <?php } else if ($campanha->campanha_tipo == "email") { ?>


                                                <?php if (strlen($persona->persona_email) > 0) { ?>

                                                    <tr>

                                                        <td>
                                                            <p class="text-sm font-weight-bold mb-0" title="<?= $persona->persona_nome ?>"><small class="text-uppercase"><?= substr($persona->persona_nome, 0, 12) . "..." ?></small></p>
                                                        </td>
                                                        <td>
                                                            <p class="text-sm font-weight-bold mb-0" title="<?= $persona->persona_username ?>"><small class="text-uppercase"><?= $persona->persona_username ?></small></p>
                                                        </td>
                                                        <td>
                                                            <p class="text-sm font-weight-bold mb-0" title="<?= $persona->persona_email ?>"><small class="text-uppercase"><?= $persona->persona_email ?></small></p>
                                                        </td>
                                                        <td>
                                                            <p class="text-sm font-weight-bold mb-0" title="<?= $persona->persona_telefone ?>"><small class="text-uppercase"><?= $persona->persona_telefone ?></small></p>
                                                        </td>
                                                        <td>
                                                            <p class="text-sm font-weight-bold mb-0" title="<?= $persona->persona_data ?>"><small class="text-uppercase"><?= $persona->persona_data ?></small></p>
                                                        </td>
                                                        <td>

                                                            <?php if ($this->conta_model->check_oferta_enviada($campanha->id, $campanha->campanha_produto_id, $campanha->campanha_tag_id, 'email', $persona->id)) { ?>

                                                                <span style="color:green"><i class="fa fa-check"></i> <small>ENVIADA</small></span>
                                                                
                                                                <?php } else { ?>
                                                                    
                                                                    <button onclick="add_oferta('<?=$persona->id?>', '<?=$persona->persona_username?>', '<?=$campanha->id?>', '<?=$campanha->campanha_tag_id?>', '<?=$campanha->campanha_produto_id?>')" class="btn btn-primary"><small>ENVIAR</small></button>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>

                                                <?php } ?>


                                            <?php } ?>


                                        <?php } ?>
                                    </tbody>
                                </table>
                                <!-- <div class="pt-5">
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view('comp/footer'); ?>
        </div>
    </main>

    <!-- Modal Adicionar Tag -->
    <div class="modal fade" id="modal_add_produto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar PRODUTO</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_add_produto">

                        <label for="">NOME</label>
                        <input type="text" class="form-control" name="nome" id="nome" required>
                        <br>
                        <label for="">DESCRIÇÃO</label>
                        <textarea maxlength="200" name="descricao" required class="form-control" id="descricao"></textarea>
                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="">PREÇO</label>
                                <input type="text" class="form-control" name="preco" id="preco" required>

                            </div>
                            <div class="col-md-6">
                                <label for="">PLATAFORMA</label>
                                <select name="plataforma" class="form-control" required id="plataforma">
                                    <option value="">SELECIONAR</option>
                                    <option value="hotmart">HOTMART</option>
                                    <option value="kiwify">KIWIFY</option>
                                    <option value="monetizze">MONETIZZE</option>
                                    <option value="edduz">EDUZZ</option>

                                </select>

                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">URL DA IMAGEM</label>
                                <input type="text" class="form-control" name="imagem" id="imagem" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">PÁGINA DE VENDAS</label>
                                <input type="text" class="form-control" name="pagina_de_vendas" id="pagina_de_vendas" required>

                            </div>

                        </div>
                        <br>
                        <div class="row">

                            <div class="col-md-6">
                                <label for="">STATUS</label>
                                <select name="status" class="form-control" required id="">
                                    <option value="">SELECIONAR</option>
                                    <option value="1">ATIVO</option>
                                    <option value="0">INATIVO</option>

                                </select>

                            </div>

                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">FECHAR</button>
                    <button type="submit" class="btn bg-gradient-primary">ADICIONAR</button>

                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Adicionar Tag -->


    <!-- Modal UPDATE Tag -->
    <div class="modal fade" id="modal_update_produto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Atualizar PRODUTO</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_update_produto">
                        <input type="hidden" class="form-control" name="produto_id" id="update_produto_id" required>

                        <label for="">NOME</label>
                        <input type="text" class="form-control" name="nome" id="update_nome" required>
                        <br>
                        <label for="">DESCRIÇÃO</label>
                        <textarea maxlength="200" name="descricao" required class="form-control" id="update_descricao"></textarea>
                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="">PREÇO</label>
                                <input type="text" class="form-control" name="preco" id="update_preco" required>

                            </div>
                            <div class="col-md-6">
                                <label for="">PLATAFORMA</label>
                                <select name="plataforma" class="form-control" required id="update_plataforma">
                                    <option value="">SELECIONAR</option>
                                    <option value="hotmart">HOTMART</option>
                                    <option value="kiwify">KIWIFY</option>
                                    <option value="monetizze">MONETIZZE</option>
                                    <option value="edduz">EDUZZ</option>

                                </select>

                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">URL DA IMAGEM</label>
                                <input type="text" class="form-control" name="imagem" id="update_imagem" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">PÁGINA DE VENDAS</label>
                                <input type="text" class="form-control" name="pagina_de_vendas" id="update_pagina_de_vendas" required>

                            </div>

                        </div>
                        <br>
                        <div class="row">

                            <div class="col-md-6">
                                <label for="">STATUS</label>
                                <select name="status" class="form-control" required id="update_status">
                                    <option value="">SELECIONAR</option>
                                    <option value="1">ATIVO</option>
                                    <option value="0">INATIVO</option>


                                </select>

                            </div>

                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">FECHAR</button>
                    <button type="submit" class="btn bg-gradient-primary">ATUALIZAR</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal UPDATE Tag -->


    <!--   Core JS Files   -->
    <?php $this->load->view('comp/js'); ?>

    <script>
        $('#form_add_produto').on('submit', function(e) {


            e.preventDefault()

            var FormData = $(this).serialize()

            $.ajax({
                url: '<?= base_url() ?>conta/act_add_produto',
                type: 'POST',
                data: FormData,
                success: function(response) {

                    var resp = JSON.parse(response)

                    if (resp.status) {

                        swal({
                                title: 'Uhuu!',
                                text: resp.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            })
                            .then((e) => {

                                location.reload()

                                // window.location.href = "<?= base_url() ?>conta/taf"
                            })


                    } else {


                        swal({
                            title: 'Ops!',
                            text: resp.message,
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });

                    }

                },
                error: function(xhr, status, error) {
                    swal({
                        title: 'Ops!',
                        text: "Houve um erro inesperado. Tente novamente",
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                }
            });

        })

        $('#form_update_produto').on('submit', function(e) {


            e.preventDefault()

            var FormData = $(this).serialize()

            $.ajax({
                url: '<?= base_url() ?>conta/act_update_produto',
                type: 'POST',
                data: FormData,
                success: function(response) {

                    var resp = JSON.parse(response)

                    if (resp.status) {

                        swal({
                                title: 'Uhuu!',
                                text: resp.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            })
                            .then((e) => {

                                location.reload()

                                // window.location.href = "<?= base_url() ?>conta/taf"
                            })


                    } else {


                        swal({
                            title: 'Ops!',
                            text: resp.message,
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });

                    }

                },
                error: function(xhr, status, error) {
                    swal({
                        title: 'Ops!',
                        text: "Houve um erro inesperado. Tente novamente",
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                }
            });

        })

        function add_oferta(persona_id, persona_username, campanha_id, campanha_tag_id, campanha_produto_id) {
            $.ajax({
                url: '<?= base_url() ?>conta/action_enviar_oferta',
                type: 'POST',
                data: {
                    oferta_persona_id: persona_id,
                    oferta_insta_id:persona_username,
                    oferta_campanha_id:campanha_id,
                    oferta_tag_id:campanha_tag_id,
                    oferta_produto_id:campanha_produto_id,
                    oferta_tipo:'<?=$campanha->campanha_tipo?>'
                },
                success: function(response) {

                    var resp = JSON.parse(response)

                    if (resp.status) {

                        location.reload()


                    } else {


                        swal({
                            title: 'Ops!',
                            text: resp.message,
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });

                    }

                },
                error: function(xhr, status, error) {
                    swal({
                        title: 'Ops!',
                        text: "Houve um erro inesperado. Tente novamente",
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }

        function open_modal_update_produto(produto_id) {

            $.ajax({
                url: '<?= base_url() ?>conta/act_get_produto',
                type: 'POST',
                data: {
                    produto_id: produto_id
                },
                success: function(response) {

                    var resp = JSON.parse(response)

                    if (resp.status) {

                        $('#update_produto_id').val(resp.response.id)
                        $('#update_nome').val(resp.response.nome)
                        $('#update_imagem').val(resp.response.imagem)
                        $('#update_preco').val(resp.response.preco)
                        $('#update_plataforma').val(resp.response.plataforma)
                        $('#update_status').val(resp.response.status)

                        // $('#update_categoria').val(resp.response.categoria)
                        $('#update_pagina_de_vendas').val(resp.response.pagina_de_vendas)
                        $('#update_descricao').val(resp.response.descricao)

                        $('#trigger_update_btn').click()


                    } else {


                        swal({
                            title: 'Ops!',
                            text: resp.message,
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });

                    }

                },
                error: function(xhr, status, error) {
                    swal({
                        title: 'Ops!',
                        text: "Houve um erro inesperado. Tente novamente",
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                }
            });


        }

        function delete_produto(produto_id) {
            swal({
                    title: "Tem certeza?",
                    text: "Deseja excluir este PRODUTOS?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {

                    if (willDelete) {

                        $.ajax({
                            url: '<?= base_url() ?>conta/act_delete_produto',
                            type: 'POST',
                            data: {
                                produto_id: produto_id
                            },
                            success: function(response) {

                                var resp = JSON.parse(response)

                                if (resp.status) {

                                    location.reload()


                                } else {


                                    swal({
                                        title: 'Ops!',
                                        text: resp.message,
                                        icon: 'warning',
                                        confirmButtonText: 'OK'
                                    });

                                }

                            },
                            error: function(xhr, status, error) {
                                swal({
                                    title: 'Ops!',
                                    text: "Houve um erro inesperado. Tente novamente",
                                    icon: 'warning',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });

                    }
                });




        }
    </script>


</body>

</html>