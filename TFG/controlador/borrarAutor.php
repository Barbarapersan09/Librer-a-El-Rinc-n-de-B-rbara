
<?php

use \modelo\Utils;
use \modelo\autores;

//Añadimos el código del modelo
require_once("../modelo/Autores.php");
require_once("../modelo/Utils.php");

$gestorAutor = new autores();

//Nos conectamos a la Bd
$conexPDO = Utils::conectar();

//Borramos el autor
if (isset($_POST["idAutor"]))
{
    //Borramos y guardamos el resultado
    $resultado = $gestorAutor->delAutor($_POST["idAutor"],$conexPDO);
    //echo "<pre>" .var_dump("hola"). "</pre>";
    //Si hubo un problema al borrarlo guardamos un mensaje de error
    if ($resultado==null || $resultado==0)
    {
        $mensaje="Error al acceder a la Base de Datos";
    }
    else
    {
        $mensaje="Autor Eliminado Correctamente";
    }


}


//Recolectamos los datos de los autores
$pagina= 1;
$datosAutores = $gestorAutor->getAutoresPag($conexPDO, true, "idAutor", $pagina, 10);
$totalPaginas= $gestorAutor->totalPaginas($conexPDO,10)["Paginas"];

//var_dump($datosAutores);
include("../Vistas/mostrarAutores.php");

?>