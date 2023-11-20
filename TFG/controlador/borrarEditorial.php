<?php

use \modelo\Utils;
use \modelo\editoriales;

//Añadimos el código del modelo
require_once("../modelo/Editoriales.php");
require_once("../modelo/Utils.php");

$gestorEditorial = new editoriales();

//Nos conectamos a la Bd
$conexPDO = Utils::conectar();

//Borramos el editorial
if (isset($_POST["idEditorial"]))
{
    //Borramos y guardamos el resultado
    $resultado = $gestorEditorial->delEditorial($_POST["idEditorial"],$conexPDO);

    //Si hubo un problema al borrarlo guardamos un mensaje de error
    if ($resultado==null || $resultado==0)
    {
        $mensaje="Error al eliminar la editorial, elimine antes todos los libros con esta editorial!!!( AL ESTAR RELACIONADO CON LA TABLA LIBROS NO SE PUEDE ELIMINAR A NO SER QUE SE ELIMINEN ANTES LOS LIBROS RELACIONADOS)";
    }
    else
    {
        $mensaje="Editorial Eliminado Correctamente";
    }


}


//Recolectamos los datos de los clientes
$pagina= 1;
$datosEditoriales = $gestorEditorial->getEditorialesPag($conexPDO, true, "idEditorial", $pagina, 10);
$totalPaginas= $gestorEditorial->totalPaginas($conexPDO,10)["Paginas"];


//var_dump($datosEditoriales);
include("../Vistas/mostrarEditoriales.php");

?>