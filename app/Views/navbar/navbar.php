<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barberia King</title>
  <link rel="icon" href="<?php echo base_url('./assets/img/carrito2.png');?>">
  <link rel="stylesheet" href="<?php echo base_url();?>./assets/css/navbar.css">
  <link rel="stylesheet" href="<?php echo base_url();?>./assets/css/clock.css">
  <script src="https://kit.fontawesome.com/a25933befb.js" crossorigin="anonymous"></script>

</head>
<body>

<?php $session = session();
          $nombre= $session->get('nombre');
          $perfil=$session->get('perfil_id');
          $id=$session->get('id');?>

  <section class="navBarSection">
    <div class="headernav">
      <div class="logoDiv">
        <a href="<?= base_url('catalogo')?>" class="logo">
          <div class="clock" id="clock"></div>
        </a>

      </div>
      
      <div id="navBar" class="navBar">
        <ul class="navList flex">
        <?php if( ($perfil =='1')) { ?>
          <li>
          <h5 class="colorTexto2"><?php echo "Bienvenida ".$nombre?></h5>
          </li>
          <li class="nnavItem">
            <a class="btn signUp" href="<?php echo base_url('compras');?>">VENTAS</a>
          </li>
          <li class="nnavItem">
            <a href="<?= base_url('usuarios-list')?>" class="btn signUp">USUARIOS</a>
          </li>
          <li class="nnavItem">
            <a href="<?= base_url('Lista_Productos')?>" class="btn">PRODUCTOS</a>
          </li>
          <li class="nnavItem">
            <a href="<?= base_url('turnos')?>" class="button">TURNOS</a>
          </li>
          <li class="navItem">
            <button class="btn signUp">
              <a href="<?= base_url('/logout')?>" class="signUp">Salir</a>
            </button>
          </li>
          <?php } else if( (($perfil =='2')) ) { ?>
          <li class="nnavItem">
            <h5 class="colorTexto2"><?php echo "Bienvenido ".$nombre?></h5>
          <li class="nnavItem">
            <a href="<?= base_url('/catalogo')?>" class="btn signUp">Productos</a>
          </li>
          <li class="navItem">
          <a href="<?php echo base_url('CarritoList') ?>"> <img src=" <?php echo base_url('assets/img/icons/carrito2.png')?>"> </a>
          </li>
          <li class="nnavItem">
            <a class="button" href="<?php echo base_url('turnos');?>">Turnos</a>
          </li>
            <li class="navItem">
            <button class="btn signUp">
              <a href="<?= base_url('/logout')?>" class="signUp">Salir</a>
            </button>
          </li>
          <?php } else { ?>
          
          <li class="navItem">
            <button class="btn loginBtn">
              <a href="<?= base_url('/login')?>" class="login">Ingresar</a>
            </button>
          </li>
          
         <?php } ?> 
        </ul>
      </div>
    </div>
  </section>

  <script>

    function handleScroll() {
      var headernav = document.querySelector('.headernav');
      var scrollPosition = window.scrollY;

      if (scrollPosition > 0) {
          headernav.classList.add('scrolled');
      } else {
          headernav.classList.remove('scrolled');
      }
    }

    window.addEventListener('scroll', handleScroll);
  </script>

<script>

  function clock() {
    var now = new Date();
    var hour = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();

    hour = hour < 10 ? "0" + hour : hour;
    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;
    
    var Time = hour + ":" + minutes + ":" + seconds;
    document.getElementById("clock").innerHTML = Time;
  }

  // Actualizar el reloj cada segundo
  setInterval(clock, 1000);

  // Llamar a la función una vez para que el reloj se muestre de inmediato
  clock();
</script>


</body>
</html>
