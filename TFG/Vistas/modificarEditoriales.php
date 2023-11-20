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
    $url_destino="../controlador/actualizarEditorial.php";
    break;
  case "insertar":
    $url_destino="../controlador/insertarEditorial.php";
    break;
  default:
  $url_destino="../mostrarEditoriales.php";

}



?>

<form method="POST" action="<?= $url_destino ?>">

<a href="../vistas/mostrarEditoriales.php"></a>
    <div class="container">

      <div class="row">

        <div class="col-lg-9 col-sm-9">
          <!-- Margenes con mb mr ml mt -sm-distancia-->
          <!-- Misma linea -->
          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="idEditorial" class="col-lg-3 col-form-label">ID:</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="idEditorial" name="idEditorial"
               value=<?=(isset($editorial)?$editorial["idEditorial"]:"") ?>>
            </div>
          </div>

          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="Nombre" class="col-lg-3 col-form-label">Nombre:</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="Nombre" name="Nombre"
               value="<?=(isset($editorial)?$editorial["Nombre"]:"") ?>">
            </div>
          </div>

          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="Direccion" class="col-lg-3 col-form-label">Dirección</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="Direccion" name="Direccion"
               value="<?=(isset($editorial)?$editorial["Direccion"]:"") ?>">
               
            </div>
          </div>
        
          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="Telefono" class="col-lg-3 col-form-label">Teléfono</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="Telefono" name="Telefono"
               value=<?=(isset($editorial)?$editorial["Telefono"]:"") ?>>
            </div>
          </div>
          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="web" class="col-lg-3 col-form-label">Web</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="web" name="web"
               value=<?=(isset($editorial)?$editorial["web"]:"") ?>>
            </div>
          </div>
        
         

          <br>

           <!--Añadimos un campo oculto con el identificador del cliente para poder modificar el registro en Bd-->
           <input type="hidden" name="idEditorial" value='<?=(isset($editorial)?$editorial["idEditorial"]:"") ?>' />
          <button type="submit" name="modificar" value="true" class="btn btn-default mb-sm-2 shadow p-3 mb-5 bg-body rounded px-3 py-2">Enviar</button>


        </div>
      </div>
    </div>
  </form>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>