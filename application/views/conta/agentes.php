<!DOCTYPE html>
<html lang="en">

<head>
    <title>Agentes - Tório </title>
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
                    <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modal_add_agente"><i class="fa fa-plus mr-2"></i> Adicionar AGENTE</button>
                    <button type="button" id="trigger_update_btn" style="display: none;" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modal_update_agente">Editar Agente</button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 p-3">
                        <div class="pb-0">
                            <div class="row">
                                <div class="col-md-4">
                                    <form action="">
                                        <label for="">NOME DO AGENTEx</label>
                                        <input type="text" name="agente_nome" value="<?= $this->input->get('agente_nome') ?>" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <form action="">
                                        <label for="">OCUPADO</label>

                                        <select name="agente_ocupado" class="form-control" id="">
                                            <option value="">TODOS</option>
                                            <option <?php if ($this->input->get('agente_ocupado') == "1") {
                                                        echo "selected";
                                                    } ?> value="1">SIM</option>
                                            <option <?php if ($this->input->get('agente_ocupado') == "0") {
                                                        echo "selected";
                                                    } ?> value="0">NÃO</option>
                                        </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary " style="margin-top: 30px !important;"><i class="fa fa-search"></i></button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>AGENTES <small> (<?= count($this->conta_model->get_agentes()) ?>)</small></h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NOME</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">EMAIL</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">SENHA</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">SEXO</th>

                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">OCUPADO</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">STATUS</th>

                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($agentes as $p) { ?>

                                            <tr>

                                                <td>
                                                    <div class="d-flex px-2">
                                                        <div>
                                                            <img src="<?= base_url() ?>assets/img/small-logos/logo-slack.svg" style="object-fit:cover" class="avatar avatar-sm rounded-circle me-2" alt="webdev">
                                                        </div>
                                                        <div class="my-auto">
                                                            <h6 class="mb-0 text-sm" title="<?= $p->agente_nome ?>"> <?= $p->agente_nome ?></h6>

                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0" title="<?= $p->agente_email ?>"><small><?= $p->agente_email ?></small></p>
                                                </td>
                                  
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0" title="<?= $p->agente_senha ?>"><small><?= $p->agente_senha ?></small></p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold text-uppercase mb-0" title="<?= $p->agente_sexo ?>"><small><?= $p->agente_sexo ?></small></p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0"><?php if ($p->agente_ocupado == "1") {
                                                                                                    echo "SIM";
                                                                                                } else if ($p->agente_ocupado == "0") {
                                                                                                    echo "NÃO";
                                                                                                } ?></p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0"><?php if ($p->agente_status == "1") {
                                                                                                    echo "ATIVO";
                                                                                                } else if ($p->agente_status == "0") {
                                                                                                    echo "BANIDO";
                                                                                                } ?></p>
                                                </td>
                                                <td class="align-middle">
                                                    <button onclick="open_modal_update_agente(<?= $p->id ?>)" class="btn btn-link text-secondary mb-0">
                                                        <i class="fa fa-pen text-xs"></i>
                                                    </button>

                                                    <button onclick="delete_agente(<?= $p->id ?>)" class="btn btn-link text-secondary mb-0">
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
    <div class="modal fade" id="modal_add_agente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar agente</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_add_agente">


                        <div class="row">
                            <div class="col-md-6">

                                <label for="">NOME</label>
                                <input type="text" class="form-control" name="agente_nome" id="agente_nome" required>
                                <br>

                            </div>
                            <div class="col-md-6">

                                <label for="">USERNAME</label>
                                <input type="text" class="form-control" name="agente_username" id="agente_username" required>
                                <br>

                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">

                                <label for="">E-MAIL</label>
                                <input type="email" class="form-control" name="agente_email" id="agente_email" required>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <label for="">SENHA</label>
                                <input type="text" class="form-control" name="agente_senha" id="agente_senha" required>
                                <br>

                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-6">
                                <label for="">OCUPADO</label>
                                <select name="agente_ocupado" class="form-control" id="agente_ocupado">
                                    <option value="0">NÃO</option>
                                    <option value="1">SIM</option>
                                </select>
                                <br>


                            </div>
                            <div class="col-md-6">
                                <label for="">STATUS</label>
                                <select name="agente_status" class="form-control" id="agente_status">
                                    <option value="1">ATIVO</option>
                                    <option value="0">BANIDO</option>
                                </select>
                                <br>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <label for="">SEXO</label>
                                <select name="agente_sexo" class="form-control" id="agente_sexo">
                                    <option value="feminino">FEMININO</option>
                                    <option value="masculino">MASCULINO</option>
                                </select>
                                <br>


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
    <div class="modal fade" id="modal_update_agente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Atualizar AGENTE</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_update_agente">

                        <input type="hidden" class="form-control" name="agente_id" id="update_agente_id" required>

                        <div class="row">
                            <div class="col-md-6">

                                <label for="">NOME</label>
                                <input type="text" class="form-control" name="agente_nome" id="update_agente_nome" required>
                                <br>

                            </div>
                            <div class="col-md-6">

                                <label for="">USERNAME</label>
                                <input type="text" class="form-control" name="agente_username" id="update_agente_username" required>
                                <br>

                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">

                                <label for="">E-MAIL</label>
                                <input type="email" class="form-control" name="agente_email" id="update_agente_email" required>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <label for="">SENHA</label>
                                <input type="text" class="form-control" name="agente_senha" id="update_agente_senha" required>
                                <br>

                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-6">
                                <label for="">OCUPADO</label>
                                <select name="agente_ocupado" class="form-control" id="update_agente_ocupado">
                                    <option value="0">NÃO</option>
                                    <option value="1">SIM</option>
                                </select>
                                <br>


                            </div>
                            <div class="col-md-6">
                                <label for="">STATUS</label>
                                <select name="agente_status" class="form-control" id="update_agente_status">
                                    <option value="1">ATIVO</option>
                                    <option value="0">BANIDO</option>
                                </select>
                                <br>
                            </div>
                        </div>

                        

                        
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">SEXO</label>
                                <select name="agente_sexo" class="form-control" id="agente_sexo">
                                    <option value="feminino">FEMININO</option>
                                    <option value="masculino">MASCULINO</option>
                                </select>
                                <br>


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
        $('#form_add_agente').on('submit', function(e) {


            e.preventDefault()

            var FormData = $(this).serialize()

            $.ajax({
                url: '<?= base_url() ?>conta/act_add_agente',
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

        $('#form_update_agente').on('submit', function(e) {


            e.preventDefault()

            var FormData = $(this).serialize()

            $.ajax({
                url: '<?= base_url() ?>conta/act_update_agente',
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

        function open_modal_update_agente(agente_id) {

            $.ajax({
                url: '<?= base_url() ?>conta/act_get_agente',
                type: 'POST',
                data: {
                    agente_id: agente_id
                },
                success: function(response) {

                    var resp = JSON.parse(response)

                    if (resp.status) {

                        $('#update_agente_id').val(resp.response.id)
                        $('#update_agente_nome').val(resp.response.agente_nome)
                        $('#update_agente_username').val(resp.response.agente_username)
                        $('#update_agente_email').val(resp.response.agente_email)
                        $('#update_agente_senha').val(resp.response.agente_senha)
                        $('#update_agente_ocupado').val(resp.response.agente_ocupado)
                        $('#update_agente_status').val(resp.response.agente_status)

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

        function delete_agente(agente_id) {
            swal({
                    title: "Tem certeza?",
                    text: "Deseja excluir este agenteS?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {

                    if (willDelete) {

                        $.ajax({
                            url: '<?= base_url() ?>conta/act_delete_agente',
                            type: 'POST',
                            data: {
                                agente_id: agente_id
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