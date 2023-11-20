<!DOCTYPE html>
<html>

<head>
  <title>Modificar Autor</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!--<link href="css/bootstrap.min.css" rel="stylesheet">-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>

<body>

<?php
//dependiendo de la accion llamaremos a un controlador u otro con los datos
switch ($accion)
{
  case "modificar":
    $url_destino="../controlador/actualizarAutor.php";
    break;
  case "insertar":
    $url_destino="../controlador/insertarAutor.php";
    break;
  default:
  $url_destino="../mostrarAutores.php";

}



?>

  <form method="POST" action="<?= $url_destino ?>">

  <a href="../vistas/mostrarAutores.php"></a>
    <div class="container">

      <div class="row">


        <div class="col-lg-9 col-sm-9">

          <!-- Margenes con mb mr ml mt -sm-distancia-->
          <!-- Misma linea -->
          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="id" class="col-lg-3 col-form-label">ID</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="idAutor" name="idAutor"
               value=<?=(isset($autor)?$autor["idAutor"]:"") ?>>
            </div>
          </div>

          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="nombre" class="col-lg-3 col-form-label">Nombre</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="Nombre" name="Nombre"
               value="<?=(isset($autor)?$autor["Nombre"]:"") ?>">
            </div>
          </div>
        
          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="apellidos" class="col-lg-3 col-form-label">Apellido</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="Apellido" name="Apellido"
               value="<?=(isset($autor)?$autor["Apellido"]:"") ?>">
               
            </div>
          </div>

          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="apellidos" class="col-lg-3 col-form-label">Edad</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="Edad" name="Edad"
               value="<?=(isset($autor)?$autor["Edad"]:"") ?>">
               
            </div>
          </div>

          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="apellidos" class="col-lg-3 col-form-label">Nacionalidad</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="Nacionalidad" name="Nacionalidad"
               value="<?=(isset($autor)?$autor["Nacionalidad"]:"") ?>">
               
            </div>
          </div>

          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="apellidos" class="col-lg-3 col-form-label">Biografia</label>
            <div class="col-lg-6">
            <textarea class="form-control" id="Biografia" name="Biografia"><?=(isset($autor)?$autor["Biografia"]:"") ?></textarea>

               
            </div>
          </div>

            <!--Añadimos un campo oculto con el identificador del cliente para poder modificar el registro en Bd-->
          <input type="hidden" name="idAutor" value='<?=(isset($autor)?$autor["idAutor"]:"") ?>' />
          <button type="submit" name="modificar" value="true" class="btn btn-default mb-sm-2 shadow p-3 mb-5 bg-body rounded px-3 py-2">Enviar</button>


          </div>
        </div>
      </div>
  </form>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>