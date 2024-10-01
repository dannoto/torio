<!DOCTYPE html>
<html lang="en">

<head>
  <title>CAMPANHAS - Tório </title>
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
          <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modal_add_campanha"><i class="fa fa-plus mr-2"></i> Adicionar Campanha</button>
          <button type="button" id="trigger_update_btn" style="display: none;" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modal_update_campanha">Editar Campanha</button>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card mb-4 p-3">
            <div class="pb-0">
              <form action="">
                <div class="row">

                  <div class="col-md-4">

                    <label for="">STATUS</label>
                    <select class="form-control" name="campanha_interacao_tipo" class="form-control" id="">
                      <option value="">TODOS</option>
                      <option <?php if ($this->input->get('campanha_interacao_tipo') == "1") {
                                echo "selected";
                              } ?> value="1">ATIVO</option>
                      <option <?php if ($this->input->get('campanha_interacao_tipo') == "0") {
                                echo "selected";
                              } ?> value="0">INATIVO</option>
                    </select>
                  </div>
                  <div class="col-md-4">

                    <label for="">TAG</label>
                    <select class="form-control" name="campanha_tag_id" class="form-control" id="">
                      <option value="">TODOS</option>
                      <?php foreach ($this->conta_model->get_tags() as $t) { ?>
                        <option <?php if ($this->input->get('campanha_tag_id') == $t->id) {
                                  echo "selected";
                                } ?> value="<?= $t->id ?>"><?= $t->tag_name ?></option>
                      <?php } ?>

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
            <h6>CAMPANHAS <small> (<?= count($campanhas) ?>)</small></h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center justify-content-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NOME</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">TIPO</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">OFERTAS</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">TAG</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">PRODUTO</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">DATA</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">STATUS</th>

                    <th></th>
                  </tr>
                </thead>
                <tbody>

                  <?php foreach ($campanhas as $t) { ?>

                    <tr>

                      <td>
                        <div class="d-flex px-2">
                          <div>
                            <img src="<?= base_url() ?>assets/img/small-logos/logo-jira.svg" class="avatar avatar-sm rounded-circle me-2" alt="webdev">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm" title="<?= $t->campanha_nome ?>"> #<?= $t->id ?> <?php if (strlen($t->campanha_nome) > 14) {
                                                                                                        echo substr($t->campanha_nome, 0, 14) . "...";
                                                                                                      } else {
                                                                                                        echo $t->campanha_nome;
                                                                                                      } ?></h6>

                          </div>
                        </div>
                      </td>
                      <td>
                        <small class="text-uppercase"><?= $t->campanha_tipo ?></small>
                      </td>
                      <td>
                        <small><a href="<?= base_url() ?>conta/campanhas_ofertas/<?= $t->id ?>">
                            VER OFERTAS
                          </a></small>
                      </td>
                      <td>

                        <p title="<?= $this->conta_model->get_tag($t->campanha_tag_id)->tag_name ?>"> <small>
                            <?php if (strlen($this->conta_model->get_tag($t->campanha_tag_id)->tag_name) > 14) {
                              echo substr($this->conta_model->get_tag($t->campanha_tag_id)->tag_name, 0, 14) . "...";
                            } else {
                              echo $this->conta_model->get_tag($t->campanha_tag_id)->tag_name;
                            } ?>
                          </small>
                        </p>

                      <td>
                        <p title="<?= $this->conta_model->get_produto($t->campanha_produto_id)->nome ?>"> <small>
                            <?php if (strlen($this->conta_model->get_produto($t->campanha_produto_id)->nome) > 14) {
                              echo substr($this->conta_model->get_produto($t->campanha_produto_id)->nome, 0, 14) . "...";
                            } else {
                              echo $this->conta_model->get_produto($t->campanha_produto_id)->nome;
                            } ?>


                          </small></p>
                      </td>
                      <td>
                        <p class=""> <small><?= $this->conta_model->formatar_data($t->campanha_data) ?></small></p>
                      </td>
                      <td>
                        <p class=""> <small><?php if ($t->campanha_status == "1") {
                                              echo "ATIVO";
                                            } else if ($t->campanha_status == "0") {
                                              echo "INATIVO";
                                            } ?></small></p>
                      </td>
                      <td class="align-middle">
                        <button onclick="open_modal_update_campanha(<?= $t->id ?>)" class="btn btn-link text-secondary mb-0">
                          <i class="fa fa-pen text-xs"></i>
                        </button>

                        <button onclick="delete_campanha(<?= $t->id ?>)" class="btn btn-link text-secondary mb-0">
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
  <div class="modal fade" id="modal_add_campanha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Adicionar CAMPANHA</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form_add_campanha">

            <label for="">NOME</label>
            <input type="text" class="form-control" name="campanha_nome" id="campanha_nome" required>
            <br>
            <label for="">DESCRIÇÃO</label>
            <textarea maxlength="200" name="campanha_descricao" required class="form-control" id="campanha_descricao"></textarea>
            <br>
            <div class="row">
              <div class="col-md-6">
                <label for="">PRODUTO</label>
                <select class="form-control" name="campanha_produto_id" required id="campanha_produto_id">
                  <option value="">SELECIONAR</option>

                  <?php foreach ($this->conta_model->get_produtos() as $p) { ?>
                    <option value="<?= $p->id ?>"><?= $p->nome ?></option>
                  <?php } ?>
                </select>

              </div>
              <div class="col-md-6">
                <label for="">TAG</label>
                <select class="form-control" name="campanha_tag_id" required id="campanha_tag_id">
                  <option value="">SELECIONAR</option>

                  <?php foreach ($this->conta_model->get_tags() as $p) { ?>
                    <option value="<?= $p->id ?>"><?= $p->tag_name ?></option>
                  <?php } ?>
                </select>
              </div>

            </div>
            <br>

            <div class="row">
              <div class="col-md-6">
                <label for="">STATUS</label>
                <select class="form-control" name="campanha_status" required id="campanha_status">
                  <option value="">SELECIONAR</option>
                  <option value="1">ATIVA</option>
                  <option value="0">INATIVA</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="">TIPO</label>
                <select class="form-control" name="campanha_tipo" required id="campanha_tipo">
                  <option value="">SELECIONAR</option>
                  <option value="instagram">INSTAGRAM</option>
                  <option value="sms">SMS</option>
                  <option value="email">EMAIL</option>
                </select>
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
    <div class="modal fade" id="modal_update_campanha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">ATUALIZAR CAMPANHA</h5>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="form_update_campanha">

              <input type="hidden" class="form-control" name="campanha_id" id="update_campanha_id" required>

              <label for="">NOME</label>
              <input type="text" class="form-control" name="campanha_nome" id="update_campanha_nome" required>
              <br>
              <label for="">DESCRIÇÃO</label>
              <textarea maxlength="200" name="campanha_descricao" required class="form-control" id="update_campanha_descricao"></textarea>
              <br>
              <div class="row">
                <div class="col-md-6">
                  <label for="">PRODUTO</label>
                  <select class="form-control" name="campanha_produto_id" required id="update_campanha_produto_id">
                    <option value="">SELECIONAR</option>

                    <?php foreach ($this->conta_model->get_produtos() as $p) { ?>
                      <option value="<?= $p->id ?>"><?= $p->nome ?></option>
                    <?php } ?>
                  </select>

                </div>
                <div class="col-md-6">
                  <label for="">TAG</label>
                  <select class="form-control" name="campanha_tag_id" required id="update_campanha_tag_id">
                    <option value="">SELECIONAR</option>

                    <?php foreach ($this->conta_model->get_tags() as $p) { ?>
                      <option value="<?= $p->id ?>"><?= $p->tag_name ?></option>
                    <?php } ?>
                  </select>
                </div>

              </div>
              <br>


              <div class="row">
                <div class="col-md-6">
                  <label for="">STATUS</label>
                  <select class="form-control" name="campanha_status" required id="update_campanha_status">
                    <option value="">SELECIONAR</option>
                    <option value="1">ATIVA</option>
                    <option value="0">INATIVA</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="">TIPO</label>
                  <select class="form-control" name="update_campanha_tipo" required id="update_campanha_tipo">
                    <option value="">SELECIONAR</option>
                    <option value="instagram">INSTAGRAM</option>
                    <option value="sms">SMS</option>
                    <option value="email">EMAIL</option>
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
      $('#form_add_campanha').on('submit', function(e) {


        e.preventDefault()

        var FormData = $(this).serialize()

        $.ajax({
          url: '<?= base_url() ?>conta/act_add_campanha',
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

      $('#form_update_campanha').on('submit', function(e) {


        e.preventDefault()

        var FormData = $(this).serialize()

        $.ajax({
          url: '<?= base_url() ?>conta/act_update_campanha',
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

      function open_modal_update_campanha(campanha_id) {

        $.ajax({
          url: '<?= base_url() ?>conta/act_get_campanha',
          type: 'POST',
          data: {
            campanha_id: campanha_id
          },
          success: function(response) {

            var resp = JSON.parse(response)

            if (resp.status) {

              $('#update_campanha_id').val(resp.response.id)
              $('#update_campanha_descricao').val(resp.response.campanha_descricao)
              $('#update_campanha_nome').val(resp.response.campanha_nome)
              $('#update_campanha_tag_id').val(resp.response.campanha_tag_id)
              $('#update_campanha_produto_id').val(resp.response.campanha_produto_id)
              $('#update_campanha_status').val(resp.response.campanha_status)
              $('#update_campanha_tipo').val(resp.response.campanha_tipo)

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

      function delete_campanha(campanha_id) {
        swal({
            title: "Tem certeza?",
            text: "Deseja excluir esta CAMPANHA?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {

            if (willDelete) {

              $.ajax({
                url: '<?= base_url() ?>conta/act_delete_campanha',
                type: 'POST',
                data: {
                  campanha_id: campanha_id
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