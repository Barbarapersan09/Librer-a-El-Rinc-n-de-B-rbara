<!DOCTYPE html>
<html>

<head>
  <title>Lista de Autores</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!--<link href="css/bootstrap.min.css" rel="stylesheet">-->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  <!-- color para el titulo al pasar por encima de el -->
  <style>
    button:hover {
      color: red;
    }

    button {
      float: right;
    }

    h1 {
      float: left;
    }
  </style>
</head>

<body>

  <div id="aviso" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Aviso</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p><?= $mensaje ?></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="container">

    <div class="row">
      <div class="col-lg-9 col-sm-9">
        <h1 class="my-5">Tabla de Autores.</h1>
        <br><br><br>
        <?php
        print("<form method='POST' action='../controlador/insertarAutor.php'>");
        print("<button class='btn btn-success'>Insertar Autor.</button>");
        print("</form>");
        ?>
        <table class="table">
          <thead class="table-dark">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nombre</th>
              <th scope="col">Apellido</th>

              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
            </tr>
          </thead>
          <tbody>

            <?php

            //var_dump($datosAutores);
            //Tenemos que generar una fila tr para cada cliente
            //que tenga el array de datoslibros.
            for ($i = 0; $i < count($datosAutores); $i++) {
              //Comienzo de fila
              print("<tr>");

              //Id de autor
              print("<td scope='row'>" . $datosAutores[$i]["idAutor"] . "</td>");
              //Nombre
              print("<td>");
              print("<form action='../controlador/detalleAutor.php' method='POST'>");
              print("<input type='hidden' name='idAutor' value='" . $datosAutores[$i]["idAutor"] . "'>");
              print("<button type='submit' class='bg-transparent border-0'  >" . $datosAutores[$i]["Nombre"] . "</button>");
              print("<input type='hidden' name='Apellido' value='" . $datosAutores[$i]["Apellido"] . "'>");
              print("</form>");
              print("</td>");

              //Para cada cliente creamos un boton para eliminarlo
              //que llamara al controlador borrarAutor y le pasara el id
              print("<td>");
              print("<form method='POST' action='../controlador/borrarAutor.php'>");
              print("<input type='hidden' name='idAutor' value='" . $datosAutores[$i]["idAutor"] . "'/>");
              print("<button class='btn btn-danger' type='submit'>Eliminar</button>");
              print("</form>");
              print("</td>");


              print("<td>");
              print("<form method='POST' action='../controlador/actualizarAutor.php'>");
              print("<input type='hidden' name='idAutor' value='" . $datosAutores[$i]["idAutor"] . "'/>");
              print("<input type='hidden' name='Nombre' value='" . $datosAutores[$i]["Nombre"] . "'/>");
              print("<input type='hidden' name='Apellido' value='" . $datosAutores[$i]["Apellido"] . "'/>");
              print("<input type='hidden' name='Edad' value='" . $datosAutores[$i]["Edad"] . "'/>");
              print("<input type='hidden' name='Nacionalidad' value='" . $datosAutores[$i]["Nacionalidad"] . "'/>");
              print("<input type='hidden' name='Biografia' value='" . $datosAutores[$i]["Biografia"] . "'/>");
              print("<button name='modificar' value='false' class='btn btn-primary'>Modificar</button>");
              print("</form>");
              print("</td>");
              //Final de fila
              print("</tr>");
            }


            ?>


          </tbody>
        </table>
      </div>

    </div>
    <div class="row">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <?php
          if ($pagina == 1) {
            print("<li class='page-item disabled' ><a class='page-link' href='#' disabled >Anterior</a></li>");
          } else {
            print("<li class='page-item'><a class='page-link' href='../controlador/mainAutorControlador.php?pagina=" . ($pagina - 1) . "'>Anterior</a></li>");
          }
          for ($i = 1; $i <= $totalPaginas; $i++) {

            print("<li class='page-item'><a class='page-link' href='../controlador/mainAutorControlador.php?pagina=$i'>$i</a></li>");
          }
          if ($pagina == $totalPaginas) {
            print("<li class='page-item disabled'><a class='page-link' href='#' disabled >Siguiente</a></li>");
          } else {
            print("<li class='page-item'><a class='page-link' href='../controlador/mainAutorControlador.php?pagina=" . ($pagina + 1) . "'>Siguiente</a></li>");
          }
          ?>


        </ul>
      </nav>

    </div>
    <a href="../Indice.php">Volver a página Indice.</a>

  </div>

  </form>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <?php
  //Si llega el mensaje implica que se ha modificado o borrado un cliente

  if ($mensaje != null && isset($mensaje)) {
    print("<script>
    \$(document).ready(function(){
        \$('#aviso').modal({show:true});
    });
</script>");
  }
  ?>

</body>

</html>