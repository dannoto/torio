<!DOCTYPE html>
<html lang="en">

<head>
  <title>Tags - Tório </title>
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
          <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modal_add_tag"><i class="fa fa-plus mr-2"></i> Adicionar Tag</button>
          <button type="button" id="trigger_update_btn" style="display: none;" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modal_update_tag">Editar Tag</button>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card mb-4 p-3">
            <div class="pb-0">
              <div class="row">
                <div class="col-md-6">
                  <form action="">
                    <label for="">NOME DA TAG</label>
                    <input type="text" name="tag_name" value="<?= $this->input->get('tag_name') ?>" class="form-control">
                </div>
                <div class="col-md-6">
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
              <h6>TAGS <small> (<?= count($this->conta_model->get_tags()) ?>)</small></h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NOME</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">DESCRIÇÃO</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">AÇÃO</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($tags as $t) { ?>

                      <tr>
                        
                        <td>
                          <div class="d-flex px-2">
                            <div>
                              <img src="<?= base_url() ?>assets/img/small-logos/logo-jira.svg" class="avatar avatar-sm rounded-circle me-2" alt="webdev">
                            </div>
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm" title="<?= $t->tag_name ?>">#<?= $t->id ?> <?= $t->tag_name ?></h6>

                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-sm font-weight-bold mb-0" title="<?= $t->tag_description ?>"><?php if (strlen($t->tag_description) > 35) {
                                                                                                        echo substr($t->tag_description, 0, 35) . "...";
                                                                                                      } else {
                                                                                                        echo $t->tag_description;
                                                                                                      } ?></p>
                        </td>


                        <td class="align-middle">
                          <button onclick="open_modal_update_tag(<?= $t->id ?>)" class="btn btn-link text-secondary mb-0">
                            <i class="fa fa-pen text-xs"></i>
                          </button>

                          <button onclick="delete_tag(<?= $t->id ?>)" class="btn btn-link text-secondary mb-0">
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