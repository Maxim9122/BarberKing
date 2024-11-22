<?php $session = session();
          $nombre= $session->get('nombre');
          $perfil=$session->get('perfil_id');
          $id=$session->get('id');?>
<section class="Fondo">
<div class="" style="width: 100%;">
  <section class="contenedor-titulo">
  <strong class="nombreLogo">Barber King</strong>
  
  </section>
  <div style="text-align: end;">
  
  <br><br>
   <a class="button" href="<?php echo base_url('turnos');?>">
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
    </svg> Turnos Realizados</a>
    <a class="button" href="<?php echo base_url('nuevoTurno');?>">
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
    </svg> Nuevo Turno</a>
  <br><br>
  <?php $Recaudacion = 0; ?>
  <table class="table table-responsive table-hover" id="users-list">
       <thead>
          <tr class="colorTexto2">
             <th>Nro Turno</th>
             <th>Cliente</th>
             <th>Telefono</th>
             <th>Barber</th>
             <th>Hora Turno</th>
             <th>Servicio</th>
             <th>Precio</th>             
             <th>Acciones</th>
          </tr>
       </thead>
       <tbody>
          <?php if($turnos): ?>
            <?php foreach($turnos as $trn): ?>
    <tr>
        <td><?php echo $trn['id']; ?></td>
        <td><?php echo $trn['cliente_nombre']; ?></td>
        <td><?php echo $trn['cliente_telefono']; ?></td>

        <!-- Formulario por cada turno -->
        <form action="<?php echo base_url('turno_actualizar/'.$trn['id']); ?>" method="POST">
            <!-- Dropdown para el barbero -->
            <td>
                <select class="form-control btn" name="id_barber">
                    <?php foreach ($barbers as $barber): ?>
                        <option value="<?= $barber['id']; ?>" <?= $barber['id'] == $trn['id_barber'] ? 'selected' : ''; ?>>
                            <?= $barber['nombre']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>

            <!-- Campo editable para la hora del turno -->
            <td>
                <input type="time" class="form-control btn" name="hora_turno" value="<?= $trn['hora_turno']; ?>">
            </td>

            <!-- Dropdown para el servicio -->
            <td>
                <select class="form-control btn" name="id_servi">
                    <?php foreach ($servicios as $servicio): ?>
                        <option value="<?= $servicio['id_servi']; ?>" <?= $servicio['id_servi'] == $trn['id_servi'] ? 'selected' : ''; ?>>
                            <?= $servicio['descripcion']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>

            <!-- Campo solo de visualización del precio -->
            <td><?php echo $trn['precio']; ?></td>

            <!-- Botón para enviar la actualización -->
            <td>
                <button type="submit" class="btn btn-actualizar">Actualizar</button>
                
                <a class="btn" href="<?php echo base_url('clienteListo/'.$trn['id']);?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="" viewBox="0 0 16 16">
                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                </svg> Listo</a>
            </td>
            
         </form>
         
         </tr>
         <?php endforeach; ?>

         <?php endif; ?>
       
     </table>
     
     <br>
  </div>
</div>

</section>
          <script src="<?php echo base_url('./assets/js/jquery-3.5.1.slim.min.js');?>"></script>
          <link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/css/jquery.dataTables.min.css');?>">
          <script type="text/javascript" src="<?php echo base_url('./assets/js/jquery.dataTables.min.js');?>"></script>
<script>
    
    $(document).ready( function () {
      $('#users-list').DataTable( {
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página.",
            "zeroRecords": "Lo sentimos! No hay resultados.",
            "info": "Mostrando la página e _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles.",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar: ",
            "paginate": {
              "next": "Siguiente",
              "previous": "Anterior"
            }
        }
    } );
    });

</script>
<br><br>