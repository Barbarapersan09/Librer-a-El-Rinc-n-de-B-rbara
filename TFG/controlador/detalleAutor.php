<?php

use \modelo\Utils;
use \modelo\autores;
//Añadimos el código del modelo
require_once("../modelo/Autores.php");
require_once("../modelo/Utils.php");

$gestorAutor = new autores();

//Nos conectamos a la Bd
$conexPDO = Utils::conectar();

//echo "<pre>" .var_dump($_POST). "</pre>";
//Comprobamos que idLibro no es nulo
if (isset($_POST["idAutor"]))
{
    
    //Guardamos el resultado
    $resultado = $gestorAutor->getAutor($_POST["idAutor"],$conexPDO);
    //echo "<pre>" .var_dump("hola"). "</pre>";

    //Si hubo un problema al obtener el libro mostramos un mensaje de error
    if ($resultado==null || $resultado==0)
    {
        $mensaje="Error al acceder a la Base de Datos";
        //Obtenemos los datos paginados y los guardamos.
        $datosAutor = $gestorAutor->getAutoresPag($conexPDO, true, "idAutor", 1, 10);
        //Nos envia a la vista mostrar autores.
        include("../vistas/mostrarAutores.php");
    }
    else
    {
        //Si el resultado no es nulo nos lleva a la vista de detalles.
        require_once("../vistas/detalleAutor.php");
    }


}




?>