<?php

namespace vistas;
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">

    <title>Login</title>

    <!--<link href="css/bootstrap.min.css" rel="stylesheet">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="../assets/css/login.css" rel="stylesheet">
</head>

<body class="text-center">
    <form class="form-signin">
        <img class="mb-4" src="../assets/img/logoUser.svg" alt="" width="72" height="72">

        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" id="Email" name="Email" value="" required>
            <label for="Email" class="col-lg-3 col-form-label">Email</label>
        </div>

        <div class="form-floating mt-3 mb-3">
            <input type="password" class="form-control" id="Password" name="Password" value="" required>
            <label for="Password" class="col-lg-3 col-form-label">Contraseña</label>
        </div>
        <div class="form-floating mt-3 mb-3">
            <input type="password" class="form-control" id="passConfirm" name="passConfirm" value="" required>
            <label for="passConfirm" class="col-lg-3 col-form-label">Corfirma la contraseña:</label>
        </div>
        <p>¿Olvidaste tu contraseña? <a href="../controlador/cambiarPasswordControlador.php">Restablecer contraseña</a></p>

        <div class="checkbox mb-3">
            <label>
                <a href="../Vistas/registroUsuario.php"> Registrarse </a>
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">
            <a href="../Indice.php" style="color: white; text-decoration: none;">Iniciar Sesión</a>
        </button>
        
        <p class="mt-5 mb-3 text-muted">&copy; 2022-2023</p>
    </form>
</body>

</html>