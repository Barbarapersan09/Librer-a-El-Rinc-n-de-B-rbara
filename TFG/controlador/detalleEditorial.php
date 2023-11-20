<?php

use modelo\editoriales;
use \modelo\Utils;

//Añadimos el código del modelo
require_once("../modelo/Editoriales.php");
require_once("../modelo/Utils.php");

$gestorEditorial = new editoriales();

//Nos conectamos a la Bd
$conexPDO = Utils::conectar();

//echo "<pre>" .var_dump($_POST). "</pre>";
//Comprobamos que idLibro no es nulo
if (isset($_POST["idEditorial"]))
{
    
    //Guardamos el resultado
    $resultado = $gestorEditorial->getEditorial($_POST["idEditorial"],$conexPDO);
    //echo "<pre>" .var_dump("hola"). "</pre>";

    //Si hubo un problema al obtener el libro mostramos un mensaje de error
    if ($resultado==null || $resultado==0)
    {
        $mensaje="Error al acceder a la Base de Datos";
        //Obtenemos los datos paginados y los guardamos.
        $datosEditoriales = $gestorEditorial->getEditorialesPag($conexPDO, true, "idEditorial", 1, 10);
        //Nos envia a la vista mostrar libros.
        include("../Vistas/mostrarEditoriales.php");
    }
    else
    {
        //Si el resultado no es nulo nos lleva a la vista de detalles.
        require_once("../Vistas/detalleEditorial.php");
    }


}




?>