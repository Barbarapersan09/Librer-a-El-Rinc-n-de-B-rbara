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
//Comprobamos que idLibro no es nulo
if (isset($_POST["idLibros"]))
{
    
    //Guardamos el resultado
    $resultado = $gestorLibro->getLibro($_POST["idLibros"],$conexPDO);
    //echo "<pre>" .var_dump("hola"). "</pre>";

    //Si hubo un problema al obtener el libro mostramos un mensaje de error
    if ($resultado==null || $resultado==0)
    {
        $mensaje="Error al acceder a la Base de Datos";
        //Obtenemos los datos paginados y los guardamos.
        $datosLibros = $gestorLibro->getLibrosPag($conexPDO, true, "idLibros", 1, 10);
        //Nos envia a la vista mostrar libros.
        include("../Vistas/mostrarLibros.php");
    }
    else
    {
        //Si el resultado no es nulo nos lleva a la vista de detalles.
        require_once("../Vistas/detalleLibro.php");
    }


}




?>