<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Autores</title>
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
                            <td><?=$resultado["idAutor"]?></td>
                        </tr>
                        <tr>
                            <th class="table-dark col-1" scope="col">Nombre</th>
                            <td><?=$resultado["Nombre"]?></td>
                        </tr>
                        <tr>
                            <th class="table-dark col-1" scope="col">Apellido</th>
                            <td><?=$resultado["Apellido"]?></td>
                        </tr>
                        <tr>
                            <th class="table-dark col-1" scope="col">Edad</th>
                            <td><?=$resultado["Edad"]?></td>
                        </tr>
                        <tr>
                            <th class="table-dark col-1" scope="col">Nacionalidad</th>
                            <td><?=$resultado["Nacionalidad"]?></td>
                        </tr>
                        <tr>
                            <th class="table-dark col-1" scope="col">Biografia</th>
                            <td><?=$resultado["Biografia"]?></td>
                        </tr>
                        
                    </tbody>
                    
                </table>
            </div>
            <a href="../controlador/mainAutorControlador.php">Volver a página anterior.</a>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>