<!DOCTYPE html>
<html lang="en">

<head>
    <title>OFERTAS - Tório </title>
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

<body class="g-sidenav-show  bg-gray-100"  style="overflow-x: hidden;">
    <?php $this->load->view('comp/sidebar'); ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg "  style="overflow-x: hidden;">
        <?php $this->load->view('comp/navbar'); ?>
        <div class="container-fluid py-4"  style="overflow-x: hidden;">
            <!-- <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6 d-flex justify-content-end">
          <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modal_add_tag"><i class="fa fa-plus mr-2"></i> Adicionar Tag</button>
          <button type="button" id="trigger_update_btn" style="display: none;" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modal_update_tag">Editar Tag</button>
        </div>
      </div> -->
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6 d-flex justify-content-end">
                    <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modal_add_oferta"><i class="fa fa-plus mr-2"></i> Adicionar Oferta</button>
                    <button type="button" id="trigger_update_btn" style="display: none;" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modal_update_oferta">Editar Oferta</button>
                </div>
            </div>
           
        </div>
        <div class="row p-5" style="overflow-x: hidden;">
            <div class="col-12" style="overflow-x: hidden;">
                <div class="card mb-4" style="overflow-x: hidden;">
                    <div class="card-header pb-0">
                        <h6>OFERTAS <small> (<?= count($ofertas) ?>)</small></h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2" style="overflow-x: hidden;">
                        <div class="table-responsive p-0"  style="overflow-x: hidden;">
                            <table class="table align-items-center justify-content-center mb-0"  style="overflow-x: hidden;">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NOME</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">CONTEÚDO</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">TIPO</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">DATA</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($ofertas as $t) { ?>

                                        <tr>

                                            <td>
                                                <div class="d-flex px-2">
                                                    <div>
                                                        <img src="<?= base_url() ?>assets/img/small-logos/logo-jira.svg" class="avatar avatar-sm rounded-circle me-2" alt="webdev">
                                                    </div>
                                                    <div class="my-auto">
                                                        <h6 class="mb-0 text-sm" title="<?= $t->oferta_nome ?>"> #<?= $t->id ?> <?php if (strlen($t->oferta_nome) > 14) {
                                                                                                                                    echo substr($t->oferta_nome, 0, 14) . "...";
                                                                                                                                } else {
                                                                                                                                    echo $t->oferta_nome;
                                                                                                                                } ?></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-sm" title="<?= $t->oferta_conteudo ?>"> #<?= $t->id ?> <?php if (strlen($t->oferta_conteudo) > 14) {
                                                                                                                                echo substr($t->oferta_conteudo, 0, 14) . "...";
                                                                                                                            } else {
                                                                                                                                echo $t->oferta_conteudo;
                                                                                                                            } ?></p>
                                            </td>
                                            <td>
                                                <p class="text-uppercase"><small><?= $t->oferta_tipo ?></small></p>
                                            </td>
                                            <td>
                                                <p><small><?= $this->conta_model->formatar_data($t->oferta_data); ?></small></p>
                                            </td>
                                            <td>

                                            </td>
                                            <td class="align-middle">
                                                <button onclick="open_modal_update_oferta(<?= $t->id ?>)" class="btn btn-link text-secondary mb-0">
                                                    <i class="fa fa-pen text-xs"></i>
                                                </button>

                                                <button onclick="delete_oferta(<?= $t->id ?>)" class="btn btn-link text-secondary mb-0">
                                                    <i class="fa fa-close text-lg" style="color:red"></i>
                                                </button>
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
    <div class="modal fade" id="modal_add_oferta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar OFERTA</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_add_oferta">

                        <input type="hidden" class="form-control" name="oferta_campanha_id" value="<?= $campanha_id ?>" required>

                        <label for="">NOME</label>
                        <input type="text" class="form-control" name="oferta_nome" id="oferta_nome" required>
                        <br>
                        <label for="">DESCRIÇÃO</label>
                        <textarea style="height:250px;" name="oferta_conteudo" required class="form-control" id="oferta_conteudo"></textarea>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">TIPO</label>
                                <select class="form-control" name="oferta_tipo" required id="oferta_tipo">
                                    <option value="">SELECIONAR</option>
                                    <option value="instagram">INSTAGRAM</option>
                                    <option value="sms">SMS</option>
                                    <option value="email">E-MAIL</option>
                                </select>
                            </div>
                        </div>
                        <br>

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
    <div class="modal fade" id="modal_update_oferta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ATUALIZAR CAMPANHA</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_update_oferta">

                        <input type="hidden" class="form-control" name="oferta_id" id="update_oferta_id" required>
                        <input type="hidden" class="form-control" name="oferta_campanha_id" id="update_oferta_campanha_id" required>


                        <label for="">NOME</label>
                        <input type="text" class="form-control" name="oferta_nome" id="update_oferta_nome" required>
                        <br>
                        <label for="">DESCRIÇÃO</label>
                        <textarea  style="height:250px;" name="oferta_conteudo" required class="form-control" id="update_oferta_conteudo"></textarea>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">TIPO</label>
                                <select class="form-control" name="oferta_tipo" required id="update_oferta_tipo">
                                    <option value="">SELECIONAR</option>
                                    <option value="instagram">INSTAGRAM</option>
                                    <option value="sms">SMS</option>
                                    <option value="email">E-MAIL</option>

                                </select>
                            </div>
                        </div>
                        <br>

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
        $('#form_add_oferta').on('submit', function(e) {


            e.preventDefault()

            var FormData = $(this).serialize()

            $.ajax({
                url: '<?= base_url() ?>conta/act_add_campanhas_ofertas',
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

        $('#form_update_oferta').on('submit', function(e) {


            e.preventDefault()

            var FormData = $(this).serialize()

            $.ajax({
                url: '<?= base_url() ?>conta/act_update_campanhas_ofertas',
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

        function open_modal_update_oferta(oferta_id) {

            $.ajax({
                url: '<?= base_url() ?>conta/act_get_campanhas_ofertas',
                type: 'POST',
                data: {
                    oferta_id: oferta_id
                },
                success: function(response) {

                    var resp = JSON.parse(response)

                    if (resp.status) {

                        $('#update_oferta_id').val(resp.response.id)
                        $('#update_oferta_nome').val(resp.response.oferta_nome)
                        $('#update_oferta_conteudo').val(resp.response.oferta_conteudo)
                        $('#update_oferta_tipo').val(resp.response.oferta_tipo)
                        $('#update_oferta_campanha_id').val(resp.response.oferta_campanha_id)

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

        function delete_oferta(oferta_id) {
            swal({
                    title: "Tem certeza?",
                    text: "Deseja excluir esta OFERTA?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {

                    if (willDelete) {

                        $.ajax({
                            url: '<?= base_url() ?>conta/act_delete_campanhas_ofertas',
                            type: 'POST',
                            data: {
                                oferta_id: oferta_id
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