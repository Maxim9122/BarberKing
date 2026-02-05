<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso</title>
    <link rel="stylesheet" href="assets\css\login.css">
    <script src="https://kit.fontawesome.com/a25933befb.js" crossorigin="anonymous"></script>   
</head>
<style>
    /* ALERTAS FORZADAS */
.alertLogin {
    margin-top:-35px;
    padding: 12px;
    border-radius: 6px;
    margin-bottom: 15px;
    font-weight: bold;
    text-align: center;
}

/* ERROR - ROJO */
.alert-error {
    background-color: #f8d7da !important;
    color: #721c24 !important;
    border: 1px solid #f5c6cb !important;
}

/* SUCCESS - VERDE */
.alert-success {
    background-color: #d4edda !important;
    color: #155724 !important;
    border: 1px solid #c3e6cb !important;
}
</style>
<body>
    <div class="containerLogin">
        <div class="form-content">
            <h1 id="title">
                Ingreso
            </h1>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alertLogin alert-error">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alertLogin alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
          
            <form action="<?php echo base_url('enviarlogin');?>" method="post">
                <div class="input-group">
                    
                    <div class="input-field">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="text" placeholder="correo" name= "email">
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="contraseña" name="pass">
                    </div>
                    
                </div>
                <div class="">
                    <!-- Boton de ingresar -->
                    <button type="submit" class="button"> Ingresar </button>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>
