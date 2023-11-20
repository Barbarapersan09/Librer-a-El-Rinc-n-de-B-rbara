<!DOCTYPE html>
<html>

<head>
  <title>Lista de Libros</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
    h1{
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
        <h1 class="my-5">Tabla de libros.</h1>
        <br><br><br>
        <?php
        print("<form method='POST' action='../controlador/insertarLibro.php'>");
        print("<button class='btn btn-success'>Insertar Libros.</button>");
        print("</form>");
        ?>
        
        <table class="table">
          <thead class="table-dark">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">ISBN</th>
              <th scope="col">Título</th>

              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>

            <?php

            //var_dump($datosLibros);
            //Tenemos que generar una fila tr para cada cliente
            //que tenga el array de datoslibros.
            for ($i = 0; $i < count($datosLibros); $i++) {
              //Comienzo de fila
              print("<tr>");

              //ID de Libro
              print("<td scope='row'>" . $datosLibros[$i]["idLibros"] . "</td>");
              //ISBN de Libro
              print("<td >" . $datosLibros[$i]["ISBN"] . "</td>");
              //Título

              print("<td>");
              print("<form action='../controlador/detalleLibro.php' method='POST'>");
              print("<input type='hidden' name='idLibros' value='" . $datosLibros[$i]["idLibros"] . "'>");
              print("<button type='submit' class='bg-transparent border-0'  >" . $datosLibros[$i]["Titulo"] . "</button>");
              print("</form>");
              print("</td>");


              //Para cada cliente creamos un boton para eliminarlo
              //que llamara al controlador borrarLibro y le pasara el id

              print("<td>");
              print("<form method='POST' action='../controlador/borrarLibro.php'>");
              print("<input type='hidden' name='idLibros' value='" . $datosLibros[$i]["idLibros"] . "'/>");
              print("<button class='btn btn-danger' type='submit'>Eliminar</button>");
              print("</form>");
              print("</td>");

              print("<td>");
              print("<form method='POST' action='../controlador/actualizarLibro.php'>");
              print("<input type='hidden' name='idLibros' value='" . $datosLibros[$i]["idLibros"] . "'/>");
              print("<input type='hidden' name='ISBN' value='" . $datosLibros[$i]["ISBN"] . "'/>");
              print("<input type='hidden' name='Imagen' value='" . $datosLibros[$i]["Imagen"] . "'/>");
              print("<input type='hidden' name='Titulo' value='" . $datosLibros[$i]["Titulo"] . "'/>");
              print("<input type='hidden' name='Tema' value='" . $datosLibros[$i]["Tema"] . "'/>");
              print("<input type='hidden' name='Paginas' value='" . $datosLibros[$i]["Paginas"] . "'/>");
              print("<input type='hidden' name='Formato' value='" . $datosLibros[$i]["Formato"] . "'/>");
              print("<input type='hidden' name='Idioma' value='" . $datosLibros[$i]["Idioma"] . "'/>");
              print("<input type='hidden' name='Precio' value='" . $datosLibros[$i]["Precio"] . "'/>");
              print("<input type='hidden' name='Descripcion' value='" . $datosLibros[$i]["Descripcion"] . "'/>");
              print("<input type='hidden' name='Fecha_publicacion' value='" . $datosLibros[$i]["Fecha_publicacion"] . "'/>");
              print("<input type='hidden' name='Editorial_idEditorial' value='" . $datosLibros[$i]["Editorial_idEditorial"] . "'/>");
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
            print("<li class='page-item'><a class='page-link' href='../controlador/mainLibroControlador.php?pagina=" . ($pagina - 1) . "'>Anterior</a></li>");
          }
          for ($i = 1; $i <= $totalPaginas; $i++) {

            print("<li class='page-item'><a class='page-link' href='../controlador/mainLibroControlador.php?pagina=$i'>$i</a></li>");
          }
          if ($pagina == $totalPaginas) {
            print("<li class='page-item disabled'><a class='page-link' href='#' disabled >Siguiente</a></li>");
          } else {
            print("<li class='page-item'><a class='page-link' href='../controlador/mainLibroControlador.php?pagina=" . ($pagina + 1) . "'>Siguiente</a></li>");
          }
          ?>


        </ul>
      </nav>

    </div>
    <a href="../Indice.php">Volver a página Indice.</a>

  </div>



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