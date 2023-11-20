<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cambio de contraseña</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="../css/login.css" rel="stylesheet">
</head>

<body class="text-center">

    <form id="formulario" class="form-signin" action="../controlador/cambiarPasswordControlador.php" method="post">
        <h1 class="display-4 text-primary ">Cambia tu contraseña</h1>
        <div class="text-center container">
            <div class="row">
                <div class="form-floating mb-3 mt-3">

                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="idUsuario" name="idUsuario" value='' required>
                        <label for="idUsuario" class="col-lg-3 col-form-label">ID de usuario:</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="password" class="form-control" id="Password" name="Password" value='' required>
                        <label for="Password" class="col-lg-3 col-form-label">Nueva contraseña:</label>
                        <span id="error-password"></span>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="password" class="form-control" id="passConfirm" name="passConfirm" value='' required>
                        <label for="passConfirm" class="col-lg-3 col-form-label">Confirma tu contraseña:</label>
                        <span id="error-confirmPass"></span>
                    </div>


                    <button type="submit" class="btn btn-default mb-sm-2 shadow p-3 mb-5 bg-body rounded px-3 py-2">Cambiar contraseña</button>
                    <p class="mt-3 mb-3 text-muted">&copy; 2022-2023</p>

                </div>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../js/validacion.js"></script>
</body>

</html>