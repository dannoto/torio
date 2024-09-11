<!DOCTYPE html>
<html lang="en">

<head>
  <title>Demandas - Tório </title>
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
        <div class="col-12">
          <div class="card mb-4 p-3">
            <div class="pb-0">
            <form action="">
              <div class="row">
            
                  <div class="col-md-4">

                    <label for="">TIPO</label>
                    <select name="interacao_tipo" class="form-control" id="">
                      <option value="">TODOS</option>
                      <option <?php if ($this->input->get('interacao_tipo') == "like") {
                                echo "selected";
                              } ?> value="like">LIKE</option>
                      <option <?php if ($this->input->get('interacao_tipo') == "comentario") {
                                echo "selected";
                              } ?> value="comentario">COMENTÁRIO</option>
                    </select>
                  </div>
                  <div class="col-md-4">

                    <label for="">TAG</label>
                    <select name="tag_id" class="form-control" id="">
                      <option value="">TODOS</option>
                      <?php foreach ($this->conta_model->get_tags() as $t) { ?>
                        <option <?php if ($this->input->get('tag_id') == $t->id) { echo "selected"; }?>  value="<?=$t->id?>"><?=$t->tag_name?></option>
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
              <h6>DEMANDAS <small> (<?= count($this->conta_model->get_demandas()) ?>)</small></h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NOME</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">USUÁRIO</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">TAG</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">TIPO</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">DATA</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">FONTE</th>

                      <th></th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($demandas as $t) { ?>

                      <tr>

                        <td>
                          <div class="d-flex px-2">
                            <div>
                              <img src="<?= base_url() ?>assets/img/small-logos/logo-jira.svg" class="avatar avatar-sm rounded-circle me-2" alt="webdev">
                            </div>
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm" title="<?= $t->full_name ?>"> <?php if (strlen($t->full_name) > 14) {
                                                                                        echo substr($t->full_name, 0, 14) . "...";
                                                                                      } else {
                                                                                        echo $t->full_name;
                                                                                      } ?></h6>

                            </div>
                          </div>
                        </td>
                        <td>
                          <p class=""> <a href="https://instagram.com/<?= $t->username ?>" target="_blank"><small><?= $t->username ?></small></a></p>
                        </td>
                        <td>
                          <p class="text-uppercase" style="color:blue;font-weight:bold;font-size:10px"> <small><?= $this->conta_model->get_tag($t->tag_id)->tag_name ?></small></p>
                        </td>
                        <td>
                          <p class="text-uppercase"><small> <?= $t->interacao_tipo ?></small></p>
                        </td>
                        <td>
                          <p class="text-uppercase"> <small><?= $t->interacao_data ?></small></p>
                        </td>
                        <td>
                          <small><a href="https://instagram.com/p/<?= $t->post_slug ?>" target="_blank">ACESSAR</a></small>
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
  <div class="modal fade" id="modal_add_tag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Adicionar TAG</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form_add_tag">

            <label for="">NOME</label>
            <input type="text" class="form-control" name="tag_name" id="tag_name" required>
            <br>
            <label for="">DESCRIÇÃO</label>
            <textarea maxlength="200" name="tag_description" required class="form-control" id="tag_description"></textarea>
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
  <div class="modal fade" id="modal_update_tag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">ATUALIZAR TAG</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" id="form_update_tag">

            <input type="hidden" class="form-control" name="tag_id" id="update_tag_id" required>

            <label for="">NOME</label>
            <input type="text" class="form-control" name="tag_name" id="update_tag_name" required>
            <br>
            <label for="">DESCRIÇÃO</label>
            <textarea maxlength="200" name="tag_description" class="form-control" id="update_tag_description"></textarea>
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
    $('#form_add_tag').on('submit', function(e) {


      e.preventDefault()

      var FormData = $(this).serialize()

      $.ajax({
        url: '<?= base_url() ?>conta/act_add_tag',
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

    $('#form_update_tag').on('submit', function(e) {


      e.preventDefault()

      var FormData = $(this).serialize()

      $.ajax({
        url: '<?= base_url() ?>conta/act_update_tag',
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

    function open_modal_update_tag(tag_id) {

      $.ajax({
        url: '<?= base_url() ?>conta/act_get_tag',
        type: 'POST',
        data: {
          tag_id: tag_id
        },
        success: function(response) {

          var resp = JSON.parse(response)

          if (resp.status) {

            $('#update_tag_id').val(resp.response.id)
            $('#update_tag_name').val(resp.response.tag_name)
            $('#update_tag_description').val(resp.response.tag_description)

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

    function delete_tag(tag_id) {
      swal({
          title: "Tem certeza?",
          text: "Deseja excluir esta TAG?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {

          if (willDelete) {

            $.ajax({
              url: '<?= base_url() ?>conta/act_delete_tag',
              type: 'POST',
              data: {
                tag_id: tag_id
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