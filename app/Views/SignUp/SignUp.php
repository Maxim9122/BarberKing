<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets\css\signUp.css">
    <script src="https://kit.fontawesome.com/a25933befb.js" crossorigin="anonymous"></script>   
</head>
<body>
    <div class="containerLogin">
        <div class="form-content">
            <h1 id="title">
                Registro 
            </h1>
            <?php $validation = \Config\Services::validation(); ?>
            <form action="<?php echo base_url('/enviar-form');?>" method="post">
                <div class="input-group">
                    <div class="input-field">
                        <i class="fa-solid fa-user"></i>
                        <input id="nameInput" type="text" placeholder="nombre" name="nombre">
                        <!-- Error -->
                        <?php if($validation->getError('nombre')) { ?>
                            <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('nombre'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-user"></i>
                        <input id="nameInput" type="text" placeholder="apellido" name="apellido">
                        <!-- Error -->
                        <?php if($validation->getError('apellido')) { ?>
                            <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('apellido'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-user"></i>
                        <input id="nameInput" type="text" placeholder="usuario" name="usuario">
                        <!-- Error -->
                        <?php if($validation->getError('usuario')) { ?>
                            <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('usuario'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-user"></i>
                        <input id="nameInput" type="int" placeholder="telefono" name="telefono">
                        <!-- Error -->
                        <?php if($validation->getError('telefono')) { ?>
                            <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('telefono'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="text" placeholder="email" name="email">
                        <!-- Error -->
                        <?php if($validation->getError('email')) { ?>
                            <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('email'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="text" placeholder="direccion" name="direccion">
                        <!-- Error -->
                        <?php if($validation->getError('direccion')) { ?>
                            <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('direccion'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="text" placeholder="contraseña" name="pass">
                        <!-- Error -->
                        <?php if($validation->getError('pass')) { ?>
                            <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('pass'); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="btn-field">
                    <button id="signUp" type="submit"> Registrate </button>
                    <button id="signIn" type="button" class="disable"> Cancelar </button>
                </div>
            </form>
        </div>
    </div>
    <!-- <script>
        // Get references to the DOM elements
        let signUp = document.getElementById("signUp");
        let signIn = document.getElementById("signIn");
        let nameInput = document.getElementById("nameInput");
        let title = document.getElementById("title");

        // Add event listeners to the sign up and sign in buttons
        signUp.addEventListener("click", function() {
            // Hide the name input field
            nameInput.parentElement.style.maxHeight = "0";

            // Change the title to "Registro"
            title.innerHTML = "Login";

            // Add the "disable" class to the sign in button
            signIn.classList.add("disable");

            // Remove the "disable" class from the sign up button
            signUp.classList.remove("disable");
        });

        signIn.addEventListener("click", function() {
            // Show the name input field
            nameInput.parentElement.style.maxHeight = "60px";

            // Change the title to "Login"
            title.innerHTML = "Registro";

            // Add the "disable" class to the sign up button
            signUp.classList.add("disable");

            // Remove the "disable" class from the sign in button
            signIn.classList.remove("disable");
        });
    </script> -->
</body>
</html>
