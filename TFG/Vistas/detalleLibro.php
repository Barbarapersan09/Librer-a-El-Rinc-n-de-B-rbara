<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de libros</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>

<body>
    
    <div class="container">
    <h1 class="my-5">Detalles</h1>
        <div class="row">
            <div class="col-lg-9 col-sm-9">
                <table class="table">
                    <tbody >
                        <tr>
                            <th class="table-dark col-1" scope="col">ID</th>
                            <td><?=$resultado["idLibros"]?></td>
                        </tr>
                        <tr>
                            <th class="table-dark col-1" scope="col">ISBN</th>
                            <td><?=$resultado["ISBN"]?></td>
                        </tr>
                        <tr>
                            <th class="table-dark col-1" scope="col">Portada</th>
                            <td><?=$resultado["Imagen"]?></td>
                        </tr>
                        <tr>
                            <th class="table-dark col-1" scope="col">Título</th>
                            <td><?=$resultado["Titulo"]?></td>
                        </tr>
                        <tr>
                            <th class="table-dark col-1" scope="col">Tema</th>
                            <td><?=$resultado["Tema"]?></td>
                        </tr>
                        <tr>
                            <th class="table-dark col-1" scope="col">Páginas</th>
                            <td><?=$resultado["Paginas"]?></td>
                        </tr>
                        <tr>
                            <th class="table-dark col-1" scope="col">Formato</th>
                            <td><?=$resultado["Formato"]?></td>
                        </tr>
                        <tr>
                            <th class="table-dark col-1" scope="col">Idioma</th>
                            <td><?=$resultado["Idioma"]?></td>
                        </tr>
                        <tr>
                            <th class="table-dark col-1" scope="col">Precio</th>
                            <td><?=$resultado["Precio"]?></td>
                        </tr>
                        <tr>
                            <th class="table-dark col-1" scope="col">Descripcion</th>
                            <td><?=$resultado["Descripcion"]?></td>
                        </tr>
                        <tr>
                            <th class="table-dark col-1" scope="col">Fecha de publicación</th>
                            <td><?=$resultado["Fecha_publicacion"]?></td>
                        </tr>

                        <tr>
                            <th class="table-dark col-1" scope="col">Id Editorial</th>
                            <td><?=$resultado["Editorial_idEditorial"]?></td>
                        </tr>
                        
                        
                    </tbody>
                    
                </table>
            </div>
            <a href="../controlador/mainLibroControlador.php">Volver a página anterior.</a>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>