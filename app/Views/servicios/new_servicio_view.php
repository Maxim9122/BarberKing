<br>
<div class="nuevoTurno">
  <div style="width: 100%;" >
    <div>
      <h2>Nuevo Servicio</h2>
    </div>
  
 <?php $validation = \Config\Services::validation(); ?>
     <form method="post" action="<?php echo base_url('agregar_Servicio') ?>">
      <?=csrf_field();?>
      <?php if(!empty (session()->getFlashdata('fail'))):?>
      <div class="alert alert-danger"><?=session()->getFlashdata('fail');?></div>
 <?php endif?>
           <?php if(!empty (session()->getFlashdata('success'))):?>
      <div class="alert alert-danger"><?=session()->getFlashdata('success');?></div>
  <?php endif?>     
<div media="(max-width:768px)">

  <div>
   <label for="exampleFormControlInput1">Descripcion</label>
   <input name="descripcion" type="text" placeholder="Descripcion" >
     <!-- Error -->
        <?php if($validation->getError('descripcion')) {?>
            <div class='alert alert-danger mt-2'>
              <?= $error = $validation->getError('descripcion'); ?>
            </div>
        <?php }?>
  </div>

  <div>
    <label for="seccion">Sección:</label>
    <select name="seccion_id" id="seccion" required>
      <option value="">Seleccione una sección</option>
      <option value="1">Barbería</option>
      <option value="2">Peluquería</option>
    </select>
  </div>

  <div>
   <label for="exampleFormControlInput1">Precio</label>
   <input name="precio" type="text" placeholder="Precio" >
     <!-- Error -->
        <?php if($validation->getError('precio')) {?>
            <div class='alert alert-danger mt-2'>
              <?= $error = $validation->getError('precio'); ?>
            </div>
        <?php }?>
  </div>

    <br>
  <div class="button-container">
  <a href="<?php echo base_url('Lista_servicios'); ?>" class="button" type="reset">Cancelar</a>
  <button type="submit" class="button">Registrar</button>
  </div>

      <br>
 </div>
</form>
</div>
</div>
<br>