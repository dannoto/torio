<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cliques - Tório </title>
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
      

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>CLIQUES <small> (<?= count($this->conta_model->get_cliques()) ?>)</small></h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NOME</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">DISPOSITIVO</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">HORA</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">PRODUTO</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">CAMPANHA</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">U_AGENTE</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($cliques as $p) { ?>

                                        <tr>

                                            <td>
                                                <div class="d-flex px-2">
                                                    <div>
                                                        <img src="https://images.vexels.com/content/129616/preview/businessman-avatar-silhouette-ae719c.png" style="object-fit:cover" class="avatar avatar-sm rounded-circle me-2" alt="webdev">
                                                    </div>
                                                    <div class="my-auto">
                                                        <a href="https://instagram.com/<?=$this->conta_model->get_persona($p->clique_persona_id)->persona_username ?>" target="_blank">

                                                            <small class="mb-0 text-sm" title="<?= $this->conta_model->get_persona($p->clique_persona_id)->persona_nome ?>">

                                                                <?php if (strlen($this->conta_model->get_persona($p->clique_persona_id)->persona_nome) > 14) {
                                                                    echo substr($this->conta_model->get_persona($p->clique_persona_id)->persona_nome, 0, 14) . "...";
                                                                } else {
                                                                    echo $this->conta_model->get_persona($p->clique_persona_id)->persona_nome;
                                                                } ?>
                                                            </small>
                                                        </a>

                                                    </div>
                                                </div>
                                            </td>
                                            <td>

                                                <small class="mb-0 text-uppercase text-sm" title="<?= $p->clique_device ?>">

                                                    <?php if (strlen($p->clique_device) > 14) {
                                                        echo substr($p->clique_device, 0, 14) . "...";
                                                    } else {
                                                        echo $p->clique_device;
                                                    } ?>
                                                </small>

                                            </td>
                                            <td>

                                                <small class="mb-0 text-sm" title="<?= $p->clique_data_id ?>">
                                                    <?=$p->clique_data_id?>
                                                </small>

                                            </td>
                                            <td>

                                                <small class="mb-0 text-sm" title="<?= $this->conta_model->get_produto($p->clique_produto_id)->nome ?>">

                                                    <?php if (strlen($this->conta_model->get_produto($p->clique_produto_id)->nome) > 14) {
                                                        echo substr($this->conta_model->get_produto($p->clique_produto_id)->nome, 0, 14) . "...";
                                                    } else {
                                                        echo $this->conta_model->get_produto($p->clique_produto_id)->nome;
                                                    } ?>
                                                </small>

                                            </td>
                                            <td>

                                                <small class="mb-0 text-sm" title="<?= $this->conta_model->get_campanha($p->clique_campanha_id)->campanha_nome ?>">

                                                    <?php if (strlen($this->conta_model->get_campanha($p->clique_campanha_id)->campanha_nome) > 14) {
                                                        echo substr($this->conta_model->get_campanha($p->clique_campanha_id)->campanha_nome, 0, 14) . "...";
                                                    } else {
                                                        echo $this->conta_model->get_campanha($p->clique_campanha_id)->campanha_nome;
                                                    } ?>
                                                </small>

                                            </td>
                                            <td>

                                                <small class="mb-0 text-sm" title="<?= $p->clique_user_agent ?> | <?=$p->clique_ip?>">

                                                    <?php if (strlen($p->clique_user_agent) > 14) {
                                                        echo substr($p->clique_user_agent, 0, 14) . "...";
                                                    } else {
                                                        echo $p->clique_user_agent;
                                                    } ?>
                                                </small>

                                            </td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="pt-5">
                                <?php print_r($pagination); ?>
                            </div>
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