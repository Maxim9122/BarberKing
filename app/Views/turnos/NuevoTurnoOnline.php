<br>
<div class="nuevoTurno">
  <div style="width: 100%;">
    <div>
      <h2>Nuevo Turno</h2>
    </div>

<?php $validation = \Config\Services::validation(); ?>
<form method="post" action="<?php echo base_url('RegistrarTurno') ?>">
<?= csrf_field(); ?>

<?php if(!empty (session()->getFlashdata('fail'))): ?>
  <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
<?php endif ?>

<?php if(!empty (session()->getFlashdata('success'))): ?>
  <div class="alert alert-danger"><?= session()->getFlashdata('success'); ?></div>
<?php endif ?>

<div media="(max-width:768px)">

  <div>
    <label for="exampleFormControlInput1">Nombre</label>
    <input name="nombre_cliente" type="text" placeholder="Nombre del Cliente" required>

    <?php if($validation->getError('nombre')) { ?>
      <div class='alert alert-danger mt-2'>
        <?= $validation->getError('nombre'); ?>
      </div>
    <?php } ?>
  </div>

  <div>
    <label for="exampleFormControlInput1" class="form-label">Telefono</label>
    <input type="text" name="telefono" class="form-control" placeholder="Telefono" required>

    <?php if($validation->getError('telefono')) { ?>
      <div class='alert alert-danger mt-2'>
        <?= $validation->getError('telefono'); ?>
      </div>
    <?php } ?>
  </div>

  <div>
    <label for="exampleFormControlTextarea1" class="form-label">Foto (Opcional)</label>
    <input name="foto" type="file">

    <?php if($validation->getError('imagen')) { ?>
      <div class='alert alert-danger mt-2'>
        <?= $validation->getError('imagen'); ?>
      </div>
    <?php } ?>
  </div>

  <!-- ================= SECCIÓN ================= -->
  <div>
    <label for="seccion">Sección:</label>
    <select name="seccion_id" id="seccion" required>
      <option value="">Seleccione una sección</option>
      <option value="1">Barbería</option>
      <option value="2">Peluquería</option>
    </select>
  </div>

  <!-- ================= SERVICIOS ================= -->
  <div>
    <label for="tipo_servicio">Tipo Servicio:</label>
    <select name="tipo_servicio" id="tipo_servicio" disabled required>
      <option value="">Seleccione un servicio</option>
    </select>

    <?php if($validation->getError('servicio')) { ?>
      <div class='alert alert-danger mt-2'>
        <?= $validation->getError('servicio'); ?>
      </div>
    <?php } ?>
  </div>

  <div class="nuevoTurno">
    <label for="fecha">Fecha:</label>
    <input type="date" class="form-control" id="fecha" name="fecha_turno">

    <label for="hora">Hora:</label>
    <input type="time" class="form-control" id="hora" name="hora_turno">

    <?php if($validation->getError('fecha') || $validation->getError('hora')) { ?>
      <div class='alert alert-danger mt-2'>
        <?= $validation->getError('fecha'); ?>
        <?= $validation->getError('hora'); ?>
      </div>
    <?php } ?>
  </div>

  <br>
  <div class="button-container">
    <a href="<?php echo base_url('turnos'); ?>" class="button" type="reset">Cancelar</a>
    <button type="submit" class="button">Registrar</button>
  </div>

  <br>
</div>
</form>
</div>
</div>

<!-- ====== PASO SERVICIOS A JS ====== -->
<script>
  const servicios = <?= json_encode($servicios); ?>;
</script>

<!-- ====== FILTRO POR SECCIÓN_ID ====== -->
<script>
  const seccionSelect = document.getElementById('seccion');
  const servicioSelect = document.getElementById('tipo_servicio');

  seccionSelect.addEventListener('change', function () {
    const seccionElegida = parseInt(this.value);

    servicioSelect.innerHTML = '<option value="">Seleccione un servicio</option>';
    servicioSelect.disabled = true;

    if (!seccionElegida) {
      return;
    }

    servicios.forEach(servicio => {
      if (parseInt(servicio.seccion_id) === seccionElegida) {
        const option = document.createElement('option');
        option.value = servicio.id_servi;
        option.textContent = servicio.descripcion + ' - $' + servicio.precio;
        servicioSelect.appendChild(option);
      }
    });

    servicioSelect.disabled = false;
  });
</script>

<!-- ====== FECHA Y HORA ACTUAL ====== -->
<script>
  const today = new Date();
  const options = { timeZone: 'America/Argentina/Buenos_Aires', hour12: false };

  const formatter = new Intl.DateTimeFormat('es-AR', {
    ...options,
    year: 'numeric',
    month: '2-digit',
    day: '2-digit'
  });

  const formattedDate = formatter.format(today).split('/').reverse().join('-');

  const formattedTime = new Intl.DateTimeFormat('es-AR', {
    ...options,
    hour: '2-digit',
    minute: '2-digit'
  }).format(today);

  document.getElementById('fecha').value = formattedDate;
  document.getElementById('hora').value = formattedTime;
</script>
<br>
