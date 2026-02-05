<br>
<div class="nuevoTurno">
  <div style="width: 100%;">
    <div>
      <h2>Registro y Nuevo Turno</h2>
    </div>

<?php $validation = \Config\Services::validation(); ?>
<form method="post" action="<?php echo base_url('RegistrarTurnoOnline') ?>">
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
    <input name="nombre_cliente" type="text" placeholder="Nombre..." required>

    <?php if($validation->getError('nombre')) { ?>
      <div class='alert alert-danger mt-2'>
        <?= $validation->getError('nombre'); ?>
      </div>
    <?php } ?>
  </div>

  <div>
    <label for="exampleFormControlInput1">Email</label>
    <input name="email_cliente" type="text" placeholder="Email@..." required>

    <?php if($validation->getError('email_cliente')) { ?>
      <div class='alert alert-danger mt-2'>
        <?= $validation->getError('email_cliente'); ?>
      </div>
    <?php } ?>
  </div>

  <div>
    <label for="exampleFormControlInput1">Contraseña</label>
    <input name="pass_cliente" type="text" placeholder="Minimo de 3 caracteres..." required>

    <?php if($validation->getError('pass_cliente')) { ?>
      <div class='alert alert-danger mt-2'>
        <?= $validation->getError('pass_cliente'); ?>
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
  <br>
  <hr> 
  <h3 style="text-align: center;" class="">Datos del turno a solicitar</h3>
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
    <select id="hora" name="hora_turno" disabled required>
      <option value="">Seleccione una hora</option>
    </select>

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

<script>
/* ================= REFERENCIAS ================= */
const seccionSelect  = document.getElementById('seccion');
const servicioSelect = document.getElementById('tipo_servicio');
const fechaInput     = document.getElementById('fecha');
const horaSelect     = document.getElementById('hora');

/* ================= SERVICIOS DESDE PHP ================= */
const servicios = <?= json_encode($servicios); ?>;

/* ================= SECCIÓN → SERVICIOS ================= */
seccionSelect.addEventListener('change', () => {
    const seccionElegida = seccionSelect.value;

    servicioSelect.innerHTML = '<option value="">Seleccione un servicio</option>';
    servicioSelect.disabled = true;

    horaSelect.innerHTML = '<option value="">Seleccione una hora</option>';
    horaSelect.disabled = true;

    if (!seccionElegida) return;

    servicios.forEach(servicio => {
        if (servicio.seccion_id == seccionElegida) {
            const opt = document.createElement('option');
            opt.value = servicio.id_servi;
            opt.textContent = `${servicio.descripcion} - $${servicio.precio}`;
            servicioSelect.appendChild(opt);
        }
    });

    servicioSelect.disabled = false;
});

/* ================= EVENTOS ================= */
servicioSelect.addEventListener('change', generarHorarios);
fechaInput.addEventListener('change', generarHorarios);

/* ================= AJAX → HORARIOS DISPONIBLES ================= */
function generarHorarios() {
    const fecha    = fechaInput.value;
    const servicio = servicioSelect.value;

    horaSelect.innerHTML = '<option value="">Seleccione fecha y servicio</option>';
    horaSelect.disabled = true;

    if (!fecha || !servicio) return;

    horaSelect.innerHTML = '<option value="">Cargando horarios...</option>';

    fetch('<?= base_url("horariosDisponibles") ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `fecha=${fecha}&servicio=${servicio}`
    })
    .then(res => res.json())
    .then(horas => {
        horaSelect.innerHTML = '<option value="">Seleccione una hora</option>';

        if (!horas || horas.length === 0) {
            horaSelect.innerHTML += '<option disabled>No hay horarios disponibles</option>';
            return;
        }

        horas.forEach(hora => {
            const opt = document.createElement('option');
            opt.value = hora;
            opt.textContent = hora;
            horaSelect.appendChild(opt);
        });

        horaSelect.disabled = false;
    })
    .catch(() => {
        horaSelect.innerHTML = '<option disabled>Error al cargar horarios</option>';
    });
}

/* ================= FECHA MÍNIMA (HOY) ================= */
const today = new Date().toISOString().split('T')[0];
fechaInput.min = today;
</script>

<br>
