<!DOCTYPE html>
<html>

<head>
  <title>Modificar Libro</title>
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
    $url_destino="../controlador/actualizarCliente.php";
    break;
  case "insertar":
    $url_destino="../controlador/insertarCliente.php";
    break;
  default:
  $url_destino="../mostrarCliente.php";

}



?>

<form method="POST" action="<?= $url_destino ?>">

<a href="../vistas/mostrarClientes.php"></a>
    <div class="container">

      <div class="row">

        <div class="col-lg-9 col-sm-9">
          <!-- Margenes con mb mr ml mt -sm-distancia-->
          <!-- Misma linea -->
          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="id" class="col-lg-3 col-form-label">ID:</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="idCliente" name="idCliente"
               value=<?=(isset($cliente)?$cliente["idCliente"]:"") ?>>
            </div>
          </div>

          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="nombre" class="col-lg-3 col-form-label">Nombre:</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="Nombre" name="Nombre"
               value=<?=(isset($cliente)?$cliente["Nombre"]:"") ?>>
            </div>
          </div>

          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="apellidos" class="col-lg-3 col-form-label">Apellidos:</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="Apellidos" name="Apellidos"
               value="<?=(isset($cliente)?$cliente["Apellidos"]:"") ?>">
               
            </div>
          </div>
        
          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="direccion" class="col-lg-3 col-form-label">Dirección:</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="Direccion" name="Direccion"
               value="<?=(isset($cliente)?$cliente["Direccion"]:"") ?>">
            </div>
          </div>
        
          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="dni" class="col-lg-3 col-form-label">DNI:</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="DNI" name="DNI"
               value=<?=(isset($cliente)?$cliente["DNI"]:"") ?>>
            </div>
          </div>

          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="idioma" class="col-lg-3 col-form-label">Teléfono:</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="Telefono" name="Telefono"
               value=<?=(isset($cliente)?$cliente["Telefono"]:"") ?>>
            </div>
          </div>
          <br>

           <!--Añadimos un campo oculto con el identificador del cliente para poder modificar el registro en Bd-->
           <input type="hidden" name="idCliente" value='<?=(isset($cliente)?$cliente["idCliente"]:"") ?>' />
          <button type="submit" name="modificar" value="true" class="btn btn-default mb-sm-2 shadow p-3 mb-5 bg-body rounded px-3 py-2">Enviar</button>


        </div>
      </div>
    </div>
  </form>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>