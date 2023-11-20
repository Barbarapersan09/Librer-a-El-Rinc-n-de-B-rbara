<?php

use \modelo\libros;
use \modelo\Utils;

//Añadimos el código del modelo
require_once("../modelo/Libros.php");
require_once("../modelo/Utils.php");
$mensaje = null;
if (isset($_REQUEST["pagina"])) {
    $pagina = $_REQUEST["pagina"];
} else {
    $pagina = 1;
}
$gestorLibro = new libros();

//Nos conectamos a la Bd
$conexPDO = Utils::conectar();
//Recolectamos los datos de los libros
$datosLibros = $gestorLibro->getLibrosPag($conexPDO, true, "idLibros", $pagina, 10);
$totalPaginas=$gestorLibro->totalPaginas($conexPDO,10)["Paginas"];


//var_dump($datosLibros);
include("../Vistas/mostrarLibros.php");
