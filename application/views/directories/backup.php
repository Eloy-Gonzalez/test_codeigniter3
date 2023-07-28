<!doctype html>
<html lang="en">

<head>
  <?php $this->load->view('includes/header'); ?>
  <title>Codeigniter 3 CRUD Application</title>
</head>

<body>
  <div class="container">
    <div class="row">

      <div class="col-lg-12 my-5">
        <h2 class="text-center mb-3">Test codeigniter 3</h2>
      </div>

      <div class="col-lg-12">

        <?php echo $this->session->flashdata('message'); ?>

        <div class="d-flex justify-content-between mb-3">
          <h4>Administrar backup de directorios</h4>
          <a href="<?= base_url()?>" class="btn btn-warning text-white"><i class="fas fa-angle-left"></i> Volver atras</a>
        </div>
        <table class="table table-bordered table-hover table-default">
          <thead class="thead-light">
            <tr>
              <th width="2%">#</th>
              <th width="25%">Nombres</th>
              <th width="53%">Apellidos</th>
              <th width="53%">Email</th>
              <th width="53%">Telefono</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data as $key => $directory) : ?>
              <tr>
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $directory->nombres; ?></td>
                <td><?php echo $directory->apellidos; ?></td>
                <td><?php echo $directory->email; ?></td>
                <td><?php echo $directory->telefono; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <p><?php echo $links; ?></p>
      </div>
    </div>
  </div>
  <?php $this->load->view('includes/footer'); ?>
</body>

</html>