<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets\css\contacto.css">
    <script src="https://kit.fontawesome.com/a25933befb.js" crossorigin="anonymous"></script>   
</head>
<body>

<?php $session = session();
          $nombre= $session->get('nombre');
          $email=$session->get('email');
          $id=$session->get('id');
          $tel=$session->get('telefono');?>

    <section class="contact-bg">
        <div class="container-form">
            <div class="content">
                <div class="left-side">
                    <div class="address details">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="topic">Dirección</div>
                        <div class="text-one">Junin 2265</div>
                        <div class="text-two">Corrientes, Corrientes. 3400</div>
                    </div>
                    <div class="phone details">
                        <i class="fas fa-phone-alt"></i>
                        <div class="topic">Teléfonos</div>
                        <div class="text-one">+54 123-456-7890</div>
                        <div class="text-two">+54 009-012-2018</div>
                    </div>
                    <div class="email details">
                        <i class="fas fa-envelope"></i>
                        <div class="topic">Email</div>
                        <div class="text-one">sportclub@gmail.com</div>
                    </div>
                </div>
                <?php $validation = \Config\Services::validation(); ?>
                <div class="right-side">
                    <div class="topic-text">Contactanos</div>
                    <p>Si queres solicitar información sobre algun producto, saber sobre nuestra franquicia o formar parte, dejános un mensaje. Te contestaremos lo antes posible</p>
                    <form method="post"  action="<?php echo base_url('/submit-form') ?>">
                    <?php if($nombre != null){?>
                    <div class="input-box">
                    <input type="text" name="name" value="<?php echo $nombre ?>" readonly="true" required="required">
                    
                    <?php }else{?>
                        <div class="input-box">
                        <input name="name" type="text" placeholder="Tu nombre">
                        </div>
                        <?php }?>
                        <?php if($validation->getError('name')) {?>
                            <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('name'); ?>
                            </div>
                        <?php }?>
                        <?php if($email != null){?>
                            <div class="input-box">
                        <input type="text" name="email" value="<?php echo $email ?>" readonly="true" required="required">
                        
                        <?php }else{?>
                        <div class="input-box">
                            <input name="email" type="text" placeholder="correo@correo.com">
                        </div>
                        <?php }?>
                        <!-- Error -->
                        <?php if($validation->getError('email')) {?>
                            <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('email'); ?>
                            </div>
                        <?php }?>
                        <div class="input-box message-box">
                            <textarea name="mensaje" placeholder="Dejanos tu mensaje" type="text" cols="30" rows="10"></textarea>
                        </div>
                                        <!-- Error -->
                        <?php if($validation->getError('mensaje')) {?>
                            <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('mensaje'); ?>
                            </div>
                        <?php }?>

                                        <?php if($tel != null){?>
                        <label for="exampleFormControlTextarea1">Teléfono</label>
                        <input type="text" name="phone" value="<?php echo $tel ?>" readonly="true" required="required">
                        <input type="hidden" name="visitante" value="No">

                        <?php }?>
                        <div class="button">
                            <input type="submit" value="Enviar" >
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
