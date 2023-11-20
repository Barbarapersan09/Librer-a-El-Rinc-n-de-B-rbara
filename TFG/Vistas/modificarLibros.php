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
    $url_destino="../controlador/actualizarLibro.php";
    break;
  case "insertar":
    $url_destino="../controlador/insertarLibro.php";
    break;
  default:
  $url_destino="../mostrarLibros.php";

}



?>

<form method="POST" action="<?= $url_destino ?>">

<a href="../Vistas/mostrarLibros.php"></a>
    <div class="container">

      <div class="row">

        <div class="col-lg-9 col-sm-9">
          <!-- Margenes con mb mr ml mt -sm-distancia-->
          <!-- Misma linea -->
          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="idLibros" class="col-lg-3 col-form-label">ID:</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="idLibros" name="idLibros"
               value=<?=(isset($libro)?$libro["idLibros"]:"") ?>>
            </div>
          </div>

          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="ISBN" class="col-lg-3 col-form-label">ISBN:</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="ISBN" name="ISBN"
               value=<?=(isset($libro)?$libro["ISBN"]:"") ?>>
            </div>
          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="ISBN" class="col-lg-3 col-form-label">Portada:</label>
            <div class="col-lg-6">
              <input type="file" class="form-control" id="Imagen" name="Imagen"
               value=<?=(isset($libro)?$libro["Imagen"]:"") ?>>
            </div>
          </div>

          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="Titulo" class="col-lg-3 col-form-label">Título</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="Titulo" name="Titulo"
               value="<?=(isset($libro)?$libro["Titulo"]:"") ?>">
               
            </div>
          </div>
        
          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="Tema" class="col-lg-3 col-form-label">Tema</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="Tema" name="Tema"
               value=<?=(isset($libro)?$libro["Tema"]:"") ?>>
            </div>
          </div>
        
          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="Paginas" class="col-lg-3 col-form-label">Páginas</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="Paginas" name="Paginas"
               value=<?=(isset($libro)?$libro["Paginas"]:"") ?>>
            </div>
          </div>
          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="Formato" class="col-lg-3 col-form-label">Formato</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="Formato" name="Formato"
               value=<?=(isset($libro)?$libro["Formato"]:"") ?>>
            </div>
          </div>

          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="Idioma" class="col-lg-3 col-form-label">Idioma</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="Idioma" name="Idioma"
               value=<?=(isset($libro)?$libro["Idioma"]:"") ?>>
            </div>
          </div>

          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="Precio" class="col-lg-3 col-form-label">Precio</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="Precio" name="Precio"
               value=<?=(isset($libro)?$libro["Precio"]:"") ?>>
            </div>
          </div>
          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="Descripcion" class="col-lg-3 col-form-label">Descripcion</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="Descripcion" name="Descripcion"
               value=<?=(isset($libro)?$libro["Descripcion"]:"") ?>>
            </div>
          </div>

          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="Editorial_idEditorial" class="col-lg-3 col-form-label">Editorial</label>
            <div class="col-lg-6">
              <input type="text" class="form-control" id="Editorial_idEditorial" name="Editorial_idEditorial"
               value=<?=(isset($libro)?$libro["Editorial_idEditorial"]:"") ?>>
            </div>
          </div>

          <div class="form-group row mb-sm-2 mt-sm-2">
            <label for="Fecha_publicacion" class="col-lg-3 col-form-label">Fecha de publicación</label>
            <div class="col-lg-6">
              <input type="date" class="form-control" id="Fecha_publicacion" name="Fecha_publicacion"
               value=<?=(isset($libro)?$libro["Fecha_publicacion"]:"") ?>>
            </div>
          </div>

          <br>

           <!--Añadimos un campo oculto con el identificador del cliente para poder modificar el registro en Bd-->
           <input type="hidden" name="idlibros" value='<?=(isset($libro)?$libro["idLibros"]:"") ?>' />
          <button type="submit" name="modificar" value="true" class="btn btn-default mb-sm-2 shadow p-3 mb-5 bg-body rounded px-3 py-2">Enviar</button>


        </div>
      </div>
    </div>
  </form>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>