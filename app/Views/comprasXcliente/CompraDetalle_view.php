<br>
<div class="comprados">
  
  <?php $session = session();
          $perfil=$session->get('perfil_id');
          $id=$session->get('id');
          ?>
  <?php if($perfil==1){?>
  <a class="btn btn-primary float-end" href="<?php echo base_url('compras');?>">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-back" viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2z"/>
  </svg> Volver</a>
  <?php }else{?>
    <a class="btn btn-primary float-end" href="<?php echo base_url('misCompras/'.$id);?>">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-back" viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2z"/>
  </svg> Volver</a>
  <?php }?>
  <br><br>

  <?php $totalVentaProdRegistrados = 0; ?>
  <?php $totalTodo = 0;?>
  <?php $TotalOtrosProd = 0;?>

  <div class="comprados">
  <h2 class="">Detalle de la Compra</h2>
  
  <table class="" id="users-list">
       <thead>
          <tr class="">
             <th>ID Producto</th>
             <th >Nombre</th>
             <th class="text-center">Cantidad Comprada</th>
             <th class="text-center">Precio Unitario</th>
             <th class="text-center">Total x Producto</th>
          </tr>
       </thead>
       <tbody>
          <?php if($ventas): ?>
          <?php foreach($ventas as $vta): ?>
          <tr>
             <td class="bg-light"><?php echo $vta['id']; ?></td>
             <td class="bg-light"><?php echo $vta['nombre']; ?></td>
             <td class="text-center bg-light"><?php echo $vta['cantidad']; ?></td>
             <td class="text-center bg-light"><?php echo $vta['precio']; ?></td>
             <td class="text-center bg-light"><?php echo $vta['total']; ?></td>
            </tr>
            <?php $totalVentaProdRegistrados= $totalVentaProdRegistrados + $vta['total']; ?>
         <?php endforeach; ?>
         <?php endif; ?>
          <!-- Hago los calculos para mostrar el monto gastado en productos no registrados y muestro-->
         <?php if($Totalcv): ?>
         <?php foreach($Totalcv as $vta): ?>
         <td>Otros Gastos</td>
         <td>Productos no registrados</td>
         <!-- Este monto es el monto total de la venta cabecera de esta venta detalle y aparte escrino Kg -->
         <td><?php $totalTodo = $vta['total_venta'];?>Por Kg</td>
         <td><?php $TotalOtrosProd = $totalTodo - $totalVentaProdRegistrados?></td>
         <td><?php echo $TotalOtrosProd ?>.00</td>
         <?php endforeach; ?>
         <?php endif; ?>
         <br>
         <!-- Este total se muestra antes de la tabla-->
         <h4>Total de la compra: $<?php echo $vta['total_venta']; ?></h4>
         <br>
     </table>
     <br>
  </div>
</div>

<br><br>