<?php if(session("msg")):?>
   <div class="container alert alert-success text-center" style="width: 50%;">
      <?php echo session("msg"); ?>
      </div>
  <?php endif?> 
<div class="container mt-5 fondo3 rounded">
  <br>
  <h3 class="text-center Btext text-dark">Listado de Consultas</h3>
   <a class="btn btn-danger float-end" href="<?php echo base_url('consultasResueltas');?>">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-recycle" viewBox="0 0 16 16">
  <path d="M9.302 1.256a1.5 1.5 0 0 0-2.604 0l-1.704 2.98a.5.5 0 0 0 .869.497l1.703-2.981a.5.5 0 0 1 .868 0l2.54 4.444-1.256-.337a.5.5 0 1 0-.26.966l2.415.647a.5.5 0 0 0 .613-.353l.647-2.415a.5.5 0 1 0-.966-.259l-.333 1.242-2.532-4.431zM2.973 7.773l-1.255.337a.5.5 0 1 1-.26-.966l2.416-.647a.5.5 0 0 1 .612.353l.647 2.415a.5.5 0 0 1-.966.259l-.333-1.242-2.545 4.454a.5.5 0 0 0 .434.748H5a.5.5 0 0 1 0 1H1.723A1.5 1.5 0 0 1 .421 12.24l2.552-4.467zm10.89 1.463a.5.5 0 1 0-.868.496l1.716 3.004a.5.5 0 0 1-.434.748h-5.57l.647-.646a.5.5 0 1 0-.708-.707l-1.5 1.5a.498.498 0 0 0 0 .707l1.5 1.5a.5.5 0 1 0 .708-.707l-.647-.647h5.57a1.5 1.5 0 0 0 1.302-2.244l-1.716-3.004z"/>
  </svg>Resueltas</a>
  <br><br>
  <div class="mt-3">
  <table class="table table-responsive table-hover" id="users-list">
       <thead>
          <tr class="bg-success">
             <th>Nombre</th>
             <th>Email</th>
             <th>Telefono</th>
             <th>Estado</th>
             <th>Visitante</th>
             <th>Acciones</th>          
           </tr>
       </thead>
       <tbody>
          <?php if($consultas): ?>
          <?php foreach($consultas as $cons): ?>
          <tr>
             <td><?php echo $cons['name']; ?></td>
             <td><?php echo $cons['email']; ?></td>
             <td><?php echo $cons['phone']; ?></td>
             <td><?php echo $cons['estado']; ?></td>
             <td class="text-center"><?php echo $cons['visitante']; ?></td>
             <td>
               <a class="btn btn-outline-primary" href="<?php echo base_url('ConsultaDetalle/'.$cons['id']);?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                </svg> Detalle</a>&nbsp;&nbsp;
                <a class="btn btn-outline-success" href="<?php echo base_url('ConsultaResuelta/'.$cons['id']) ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-check" viewBox="0 0 16 16">
                <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z"/>
                <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686Z"/>
                </svg> Marcar Resuelta</a>
             </td>
            </tr>
         <?php endforeach; ?>
         <?php endif; ?>
       </tbody>
     </table>
     <br>
  </div>
</div>
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
  } );
</script>
<br><br>