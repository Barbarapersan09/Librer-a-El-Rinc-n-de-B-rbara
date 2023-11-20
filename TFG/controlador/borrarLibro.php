<?php

use \modelo\Utils;
use \modelo\libros;

//Añadimos el código del modelo
require_once("../modelo/Libros.php");
require_once("../modelo/Utils.php");

$gestorLibro = new libros();

//Nos conectamos a la Bd
$conexPDO = Utils::conectar();

//echo "<pre>" .var_dump($_POST). "</pre>";
//Borramos el libro
if (isset($_POST["idLibros"]))
{
    //Borramos y guardamos el resultado
    $resultado = $gestorLibro->delLibro($_POST["idLibros"],$conexPDO);
    //echo "<pre>" .var_dump("hola"). "</pre>";

    //Si hubo un problema al borrarlo guardamos un mensaje de error
    if ($resultado==null || $resultado==0)
    {
        $mensaje="Error al acceder a la Base de Datos";
    }
    else
    {
        $mensaje="Libro Eliminado Correctamente";
    }


}


//Recolectamos los datos de los libros
$pagina= 1;
$datosLibros = $gestorLibro->getLibrosPag($conexPDO, true, "idLibros", $pagina, 10);
$totalPaginas= $gestorLibro->totalPaginas($conexPDO,10)["Paginas"];


//var_dump($datosLibros);
include("../Vistas/mostrarLibros.php");

?>