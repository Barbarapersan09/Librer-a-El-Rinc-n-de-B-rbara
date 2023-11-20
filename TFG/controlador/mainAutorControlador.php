<?php

use \modelo\autores;
use \modelo\Utils;

//Añadimos el código del modelo
require_once("../modelo/Autores.php");
require_once("../modelo/Utils.php");
$mensaje = null;
if (isset($_REQUEST["pagina"])) {
    $pagina = $_REQUEST["pagina"];
} else {
    $pagina = 1;
}
$gestorAutor = new autores();

//Nos conectamos a la Bd
$conexPDO = Utils::conectar();
//Recolectamos los datos de los libros
$datosAutores = $gestorAutor->getAutoresPag($conexPDO, true, "idAutor", $pagina, 10);
$totalPaginas=$gestorAutor->totalPaginas($conexPDO,10)["Paginas"];


//var_dump($datosLibros);
include("../Vistas/mostrarAutores.php");