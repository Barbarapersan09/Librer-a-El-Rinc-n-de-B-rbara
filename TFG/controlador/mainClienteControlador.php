<?php

use modelo\cliente;
use \modelo\Utils;

//Añadimos el código del modelo
require_once("../modelo/Cliente.php");
require_once("../modelo/Utils.php");
$mensaje = null;
if (isset($_REQUEST["pagina"])) {
    $pagina = $_REQUEST["pagina"];
} else {
    $pagina = 1;
}
$gestorCliente = new cliente();

//Nos conectamos a la Bd
$conexPDO = Utils::conectar();
//Recolectamos los datos de los libros
$datosClientes = $gestorCliente->getClientesPag($conexPDO, true, "idCliente", $pagina, 10);
$totalPaginas=$gestorCliente->totalPaginas($conexPDO,10)["Paginas"];


//var_dump($datosLibros);
include("../Vistas/mostrarClientes.php");
