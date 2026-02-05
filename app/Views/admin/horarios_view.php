<br>
<div class="nuevoTurno">
  <div style="width: 100%;">
<form method="post" action="<?= base_url('admin/horarios/guardar') ?>">
<?= csrf_field() ?>

<table>
  <tr>
    <th>Día</th>
    <th>Inicio</th>
    <th>Fin</th>
    <th>Habilitado</th>
  </tr>

<?php foreach ($horarios as $i => $h): ?>
<tr>
  <td>
    <?= ucfirst($h['dia']) ?>
    <input type="hidden" name="dia[]" value="<?= $h['dia'] ?>">
  </td>

  <td>
    <input type="time" name="hora_inicio[]" value="<?= $h['hora_inicio'] ?>">
  </td>

  <td>
    <input type="time" name="hora_fin[]" value="<?= $h['hora_fin'] ?>">
  </td>

  <td>
    <input type="checkbox" name="habilitado[<?= $i ?>]" <?= $h['habilitado'] ? 'checked' : '' ?>>
  </td>
</tr>
<?php endforeach ?>
</table>
<div class="button-container">
<button type="submit" class="button" align="end">Guardar horarios</button>
</div>
</form>
</div>
</div>