<!doctype html>
<html lang="en">
<head>
  <?php $this->load->view('includes/header'); ?>
  <title>Actualizar directorio</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 my-5">
        <h2 class="text-center mb-3">Directorio</h2>
      </div>
      <div class="col-lg-12">
        <div class="d-flex justify-content-between ">
          <h4>Editar directorio</h4>
          <a class="btn btn-warning text-white" href="<?php echo base_url(); ?>"> <i class="fas fa-angle-left"></i> Volver atras</a>
        </div>

        <form method="post" action="<?php echo base_url('directories/update/' . $data->id); ?>">
          <div class="form-group">
            <label>Nombres</label>
            <input class="form-control" type="text" name="nombres" value="<?= $data->nombres; ?>">
          </div>

          <div class="form-group">
            <label>Apellidos</label>
            <input class="form-control" type="text" name="apellidos" value="<?= $data->apellidos; ?>">
          </div>

          <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="email" name="email" value="<?= $data->email; ?>">
          </div>

          <div class="form-group">
            <label>Telefono</label>
            <input class="form-control" type="tel" name="telefono" value="<?= $data->telefono; ?>">
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-success"> <i class="fas fa-check"></i> Actualizar directorio </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php $this->load->view('includes/footer'); ?>
</body>
</html>