<?php

use modelo\editoriales;
use \modelo\Utils;

//Añadimos el código del modelo
require_once("../modelo/Editoriales.php");
require_once("../modelo/Utils.php");
$mensaje = null;
if (isset($_REQUEST["pagina"])) {
    $pagina = $_REQUEST["pagina"];
} else {
    $pagina = 1;
}
$gestorEditorial = new editoriales();

//Nos conectamos a la Bd
$conexPDO = Utils::conectar();
//Recolectamos los datos de los libros
$datosEditoriales = $gestorEditorial->getEditorialesPag($conexPDO, true, "idEditorial", $pagina, 10);
$totalPaginas=$gestorEditorial->totalPaginas($conexPDO,10)["Paginas"];


//var_dump($datosLibros);
include("../Vistas/mostrarEditoriales.php");