<!doctype html>
<html lang="en">

<head>
  <?php $this->load->view('includes/header'); ?>
  <title>Codeigniter 3 CRUD</title>
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
          <h4>Administrar directorios</h4>
          <a href='<?= base_url('/directories/exportCSV'); ?>' class="btn btn-success"><i class="fas fa-file"></i> Exportar CSV</a>
          <a href='<?= base_url('/directories/backup'); ?>' class="btn btn-success"><i class="fas fa-file"></i> Ver respaldo</a>
          <a href='<?= base_url('/directories/createbackup'); ?>' class="btn btn-success"><i class="fas fa-file"></i> Crear respaldo</a>
          <a href="<?= base_url('directories/create') ?>" class="btn btn-success"> <i class="fas fa-plus"></i> Nuevo directorio</a>
        </div>
        <table class="table table-bordered table-hover table-default">
          <thead class="thead-light">
            <tr>
              <th width="2%">#</th>
              <th width="25%">Nombres</th>
              <th width="53%">Apellidos</th>
              <th width="53%">Email</th>
              <th width="53%">Telefono</th>
              <th width="20%">Acciones</th>
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
                <td class="d-flex">
                  <a href="<?= base_url('directories/edit/' . $directory->id) ?>"> <i class="fas fa-edit"></i> </a>
                  <a href="<?= base_url('directories/delete/' . $directory->id) ?>" onclick="return confirm('Are you sure you want to delete this record?')"> <i class="fas fa-trash"></i></a>
                </td>
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