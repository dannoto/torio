<!DOCTYPE html>
<html lang="en">

<head>
  <title>Tarefas - Tório </title>
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
          <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modal_add_tag"><i class="fa fa-plus mr-2"></i> Adicionar Tarefas</button>
          <button type="button" id="trigger_update_btn" style="display: none;" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modal_update_tag">Editar Tag</button>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card mb-4 p-3">
            <div class="pb-0">
              <div class="row">
                <div class="col-md-4">
                  <form action="">
                    <label for="">NOME DA TAREFA</label>
                    <input type="text" name="tarefa_nome" value="<?= $this->input->get('tarefa_nome') ?>" class="form-control">
                </div>
                <div class="col-md-4">
                  <form action="">
                    <label for="">STATUS DA TAREFA</label><br>
                    <select class="form-control" name="tarefa_status" id="">
                      <option <?php if ($this->input->get('tarefa_status') == "") {
                                echo "selected";
                              } ?> value="">TODOS</option>

                      <option <?php if ($this->input->get('tarefa_status') == "0") {
                                echo "selected";
                              } ?> value="0">ABERTA</option>
                      <option <?php if ($this->input->get('tarefa_status') == "1") {
                                echo "selected";
                              } ?> value="1">PROCESSANDO</option>
                      <option <?php if ($this->input->get('tarefa_status') == "2") {
                                echo "selected";
                              } ?> value="2">CONCLUÍDA</option>
                      <option <?php if ($this->input->get('tarefa_status') == "3") {
                                echo "selected";
                              } ?> value="3">ERRO</option>
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
              <h6>TAREFAS <small> (<?= count($this->conta_model->get_tarefas()) ?>)</small></h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NOME</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">TIPO</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">TAG</th>

                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">URL</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">STATUS</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2"></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($tarefas as $t) { ?>

                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div>
                              <img src="<?= base_url() ?>assets/img/small-logos/logo-webdev.svg" class="avatar avatar-sm rounded-circle me-2" alt="webdev">
                            </div>
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm" title="<?= $t->tarefa_nome ?>">#<?= $t->id ?>
                                <?php if (strlen($t->tarefa_nome) > 20) {
                                  echo substr($t->tarefa_nome, 0, 20) . "...";
                                } else {
                                  echo $t->tarefa_nome;
                                } ?>

                              </h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-sm font-weight-bold text-uppercase mb-0"> <?= $t->tarefa_tipo ?></p>
                        </td>
                        <td>
                          <p class="text-sm font-weight-bold text-uppercase mb-0" style="color:#0d55ff" title="<?= $this->conta_model->get_tag($t->tarefa_tag)->tag_name ?>">
                            <small>
                              <?php if (strlen($this->conta_model->get_tag($t->tarefa_tag)->tag_name) > 15) {
                                echo substr($this->conta_model->get_tag($t->tarefa_tag)->tag_name, 0, 15) . "...";
                              } else {
                                echo $this->conta_model->get_tag($t->tarefa_tag)->tag_name;
                              } ?>
                            </small>
                          </p>
                        </td>
                        <td>
                          <span class="text-xs font-weight-bold"><a href="<?= $t->tarefa_url ?>" target="_blank"><small>ACESSAR</small></a></span>
                        </td>
                        <td class="align-middle text-center">
                          <p class="text-sm font-weight-bold text-uppercase mb-0"> <?php if ($t->tarefa_status == 0) {
                                                                                      echo "ABERTA";
                                                                                    } else if ($t->tarefa_status == 1) {
                                                                                      echo "PROCESSANDO";
                                                                                    } else if ($t->tarefa_status == 2) {
                                                                                      echo "CONCLUÍDA";
                                                                                    } else if ($t->tarefa_status == 3) {
                                                                                      echo "ERRO";
                                                                                    } ?></p>

                          <!-- <div class="d-flex align-items-center justify-content-center">
                            <span class="me-2 text-xs font-weight-bold">80%</span>
                            <div>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="80" style="width: 80%;"></div>
                              </div>
                            </div>
                          </div> -->
                        </td>
                        <td class="align-middle">
                          <button onclick="open_modal_update_tarefa(<?= $t->id ?>)" class="btn btn-link text-secondary mb-0">
                            <i class="fa fa-pen text-xs"></i>
                          </button>

                          <button onclick="delete_tarefa(<?= $t->id ?>)" class="btn btn-link text-secondary mb-0">
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

  <!-- Modal Adicionar Tarefas -->
  <div class="modal fade" id="modal_add_tag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Adicionar Tarefas</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form_add_tarefa">

            <label for="">NOME</label>
            <input type="text" class="form-control" maxlength="200" name="tarefa_nome" id="tarefa_nome" required>
            <br>
            <div class="row">
              <div class="col-md-6">
                <label for="">TAG</label>
                <select required name="tarefa_tag" class="form-control" id="">
                  <option value="">SELECIONAR</option>
                  <?php foreach ($this->conta_model->get_tags() as $t) { ?>
                    <option value="<?= $t->id ?>"><?= $t->tag_name ?></option>
                  <?php } ?>
                </select>

              </div>
              <div class="col-md-6">
                <label for="">STATUS</label>
                <select required class="form-control" name="tarefa_status" id="">
                  <option value="">SELECIONAR</option>

                  <option value="0">ABERTA</option>
                  <option value="1">PROCESSANDO</option>
                  <option value="2">CONCLUÍDA</option>
                  <option value="3">ERRO</option>

                </select>

              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-4">
                <label for="">TIPO</label>
                <select required name="tarefa_tipo" class="form-control" id="">
                  <option value="post">POST</option>
                  <option value="feed">FEED</option>
                </select>

              </div>
              <div class="col-md-8">
                <label for="">URL</label>
                <input type="text" class="form-control" maxlength="200" name="tarefa_url">
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
  <!-- Modal Adicionar Tarefas -->


  <!-- Modal UPDATE Tag -->
  <div class="modal fade" id="modal_update_tag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">ATUALIZAR TAREFA</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" id="form_update_tarefa">

            <input type="hidden" name="tarefa_id" id="update_tarefa_id">

            <label for="">NOME</label>
            <input type="text" class="form-control" maxlength="200" name="tarefa_nome" id="update_tarefa_nome" required>
            <br>
            <div class="row">
              <div class="col-md-6">
                <label for="">TAG</label>
                <select required name="tarefa_tag" class="form-control" id="update_tarefa_tag">
                  <option value="">SELECIONAR</option>
                  <?php foreach ($this->conta_model->get_tags() as $t) { ?>
                    <option value="<?= $t->id ?>"><?= $t->tag_name ?></option>
                  <?php } ?>
                </select>

              </div>
              <div class="col-md-6">
                <label for="">STATUS</label>
                <select required class="form-control" name="tarefa_status" id="update_tarefa_status">
                  <option value="">SELECIONAR</option>

                  <option value="0">ABERTA</option>
                  <option value="1">PROCESSANDO</option>
                  <option value="2">CONCLUÍDA</option>
                  <option value="3">ERRO</option>

                </select>

              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-4">
                <label for="">TIPO</label>
                <select required name="tarefa_tipo" class="form-control" id="update_tarefa_tipo">
                  <option value="post">POST</option>
                  <option value="feed">FEED</option>
                </select>

              </div>
              <div class="col-md-8">
                <label for="">URL</label>
                <input type="text" class="form-control" maxlength="200" name="tarefa_url" id="update_tarefa_url">
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
    $('#form_add_tarefa').on('submit', function(e) {


      e.preventDefault()

      var FormData = $(this).serialize()

      $.ajax({
        url: '<?= base_url() ?>conta/act_add_tarefa',
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

    $('#form_update_tarefa').on('submit', function(e) {


      e.preventDefault()

      var FormData = $(this).serialize()

      $.ajax({
        url: '<?= base_url() ?>conta/act_update_tarefa',
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

    function open_modal_update_tarefa(tarefa_id) {

      $.ajax({
        url: '<?= base_url() ?>conta/act_get_tarefa',
        type: 'POST',
        data: {
          tarefa_id: tarefa_id
        },
        success: function(response) {

          var resp = JSON.parse(response)

          if (resp.status) {

            console.log('status ', resp.response.tarefa_status)

            $('#update_tarefa_id').val(resp.response.id)
            $('#update_tarefa_nome').val(resp.response.tarefa_nome)
            $('#update_tarefa_tag').val(resp.response.tarefa_tag)
            $('#update_tarefa_status').val(resp.response.tarefa_status)
            $('#update_tarefa_tipo').val(resp.response.tarefa_tipo)
            $('#update_tarefa_url').val(resp.response.tarefa_url)

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

    function delete_tarefa(tarefa_id) {
      swal({
          title: "Tem certeza?",
          text: "Deseja excluir esta Tarefa?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {

          if (willDelete) {

            $.ajax({
              url: '<?= base_url() ?>conta/act_delete_tarefa',
              type: 'POST',
              data: {
                tarefa_id: tarefa_id
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