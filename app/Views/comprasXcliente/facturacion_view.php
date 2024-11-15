<br>
<div>  
<?php $session = session();
          $perfil=$session->get('perfil_id');
          $id=$session->get('id');
          ?>

</div>
<?php if($perfil==1){?>
<a class="btn btn-primary float-end" href="<?php echo base_url('compras');?>">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-back" viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2z"/>
  </svg>Volver</a>
<?php }else{?>
    <a class="btn btn-primary float-end" href="<?php echo base_url('misCompras/'.$id);?>">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-back" viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2z"/>
  </svg>Volver</a>
<?php }?>
<br><br>
<?php $total = 0; ?>
<h4 class="container comprados" align="center">Minimercadito JyR: Factura De Compras</h4>
<br>

  <div class="comprados">
  <table class="" id="users-list">
  <h3 class="">Datos del Cliente</h3>
     <br>
          <?php if($datos): ?>
          <?php foreach($datos as $vta): ?>
                <tr class="">
                    <td class="bg-light" style="color: #074A57;">
                        <u>Nombre:</u>
                    </td>
                    <td class="bg-light">
                        <?php echo $vta['nombre'] ?>
                    </td>
                </tr>
          
                <tr>
                    <td class="bg-light" style="color: #074A57;">
                        <u>Apellido:</u>
                    </td>
                    <td class="bg-light">
                        <?php echo $vta['apellido'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="bg-light" style="color: #074A57;">
                        <u>Teléfono:</u>
                    </td>
                    <td class="bg-light">
                        <?php echo $vta['telefono'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="bg-light" style="color: #074A57;">
                        <u>Direccion:</u>
                    </td>
                    <td class="bg-light">
                        <?php echo $vta['direccion'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="bg-light" style="color: #074A57;">
                        <u>Fecha de compra:</u>
                    </td>
                    <td class="bg-light">
                        <?php echo $vta['fecha'] ?>
                    </td>
                </tr>

                        <?php $total = $vta['total_venta']; ?>
                  
                <tr>
                    <td class="bg-light" style="color: #074A57;">
                        <u>Tipo de Pago:</u>
                    </td>
                    <td class="bg-light">
                        <?php echo $vta['tipo_pago'] ?>
                    </td>
                </tr>
          </tr>
         <?php endforeach; ?>
         <?php endif; ?>
         
     </table>
  <br>
  <table class="" id="users-list">
  <h3 class="">Detalle de la Compra</h3>
  <br>
       <thead>
          <tr class="">
             <th align="center">ID Producto</th>
             
             <th align="center">Nombre</th>
             
             <th align="center">Cantidad Comprada</th>
             
             <th align="center">Precio Unitario</th>
             
             <th align="center">Total</th>
          </tr>
       </thead>
       <tbody>
          <?php if($ventas): ?>
          <?php foreach($ventas as $vta): ?>
          <tr>
             <td  class="bg-light"><?php echo $vta['id']; ?></td>
             
             <td  class="bg-light"><?php echo $vta['nombre']; ?></td>
             
             <td  class="bg-light"><?php echo $vta['cantidad']; ?></td>
             
             <td  class="bg-light"><?php echo $vta['precio']; ?></td>
             
             <td  class="bg-light"><?php echo $vta['total']; ?></td>
            </tr>
         <?php endforeach; ?>
         <?php endif; ?>
         
     </table>
     <div align="end" class="">
        <br><br>
     <tr>
                    <td style="color: #074A57;">
                        Total a Pagar: ARS$
                    </td>
                    <td>
                        <?php echo $total; ?>
                    </td>
    </tr> 
    </div>
     <br>
  </div>
</div>
<br>