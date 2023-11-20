<!DOCTYPE html>

<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">

  <title>Registro Usuario</title>

  <!--<link href="css/bootstrap.min.css" rel="stylesheet">-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link href="../assets/css/login.css" rel="stylesheet">

</head>

<body class="text-center">

  <?php
  //Definimos el destino de el formulario
  $url_destino = "../controlador/registroUsuarioController.php";
  ?>

  <form id="formulario" class="form-signin" method="POST" action="<?= $url_destino ?>">
    <h1 class="display-4 text-primary ">Registro</h1>
    <div class="text-center container">

      <div class="row">

        <div class="form-floating mb-3 mt-3">

          <!-- Margenes con mb mr ml mt -sm-distancia-->
          <!-- Misma linea -->

          <!-- Nombre -->
          <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" id="Nombre" name="Nombre" value='' required/>
            <label for="Nombre" class="col-lg-3 col-form-label">Nombre</label>
            <span id="error-nombre"></span>
          </div>
          <!-- Email -->
          <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" id="Email" name="Email" value='' required/>
            <label for="Email" class="col-lg-3 col-form-label">Email</label>
            <span id="error-email"></span>
          </div>
          <!-- Password -->
          <div class="form-floating mb-3 mt-3">
            <input type="password" class="form-control" id="Password" name="Password" value='' required/>
            <label for="Password" class="col-lg-3 col-form-label">Password</label>
            <span id="error-password"></span>
          </div>

          <!-- Confirmar password -->
          <div class="form-floating mb-3 mt-3">
            <input type="password" class="form-control" id="passConfirm" name="passConfirm" value='' required/>
            <label for="passConfirm" class="col-lg-3 col-form-label">Confirmar Password</label>
            <span id="error-confirmPass"></span>
          </div>
          <p>¿Ya tienes una cuenta? <a href="../Vistas/LoginView.php">Inicia sesión aquí</a></p>

          <br>
         
          <?php
          print("<form method='POST' action='../Vistas/codigoActivacion.php'>");
          print("<button type='submit' name='registro' value='true' class='btn btn-default mb-sm-2 shadow p-3 mb-5 bg-body rounded px-3 py-2 '>Registrate</button>");
          print("</form>");
          ?>
          <p class="mt-3 mb-3 text-muted">&copy; 2022-2023</p>



        </div>
      </div>
    </div>
  </form>
  <script src="../js/validacion.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>