<?php

use \modelo\Utils;
use modelo\cliente;

//Añadimos el código del modelo
require_once("../modelo/Cliente.php");
require_once("../modelo/Utils.php");

$gestorCliente= new cliente();

//Nos conectamos a la Bd
$conexPDO = Utils::conectar();

//echo "<pre>" .var_dump($_POST). "</pre>";
//Comprobamos que idLibro no es nulo
if (isset($_POST["idCliente"]))
{
    
    //Guardamos el resultado
    $resultado = $gestorCliente->getCliente($_POST["idCliente"],$conexPDO);
    //echo "<pre>" .var_dump("hola"). "</pre>";

    //Si hubo un problema al obtener el libro mostramos un mensaje de error
    if ($resultado==null || $resultado==0)
    {
        $mensaje="Error al acceder a la Base de Datos";
        //Obtenemos los datos paginados y los guardamos.
        $datosClientes = $gestorCliente->getClientesPag($conexPDO, true, "idCliente", 1, 10);
        //Nos envia a la vista mostrar libros.
        include("../Vistas/mostrarClientes.php");
    }
    else
    {
        //Si el resultado no es nulo nos lleva a la vista de detalles.
        require_once("../Vistas/detalleCliente.php");
    }


}




?>