<?php

use \modelo\Utils;
use \modelo\cliente;

//Añadimos el código del modelo
require_once("../modelo/Cliente.php");
require_once("../modelo/Utils.php");

$gestorCliente = new cliente();

//Nos conectamos a la Bd
$conexPDO = Utils::conectar();

//Borramos el socio
if (isset($_POST["idCliente"]))
{
    //Borramos y guardamos el resultado
    $resultado = $gestorCliente->delCliente($_POST["idCliente"],$conexPDO);

    //Si hubo un problema al borrarlo guardamos un mensaje de error
    if ($resultado==null || $resultado==0)
    {
        $mensaje="Error al acceder a la Base de Datos";
    }
    else
    {
        $mensaje="Cliente Eliminado Correctamente";
    }


}


//Recolectamos los datos de los clientes

$pagina= 1;
$datosClientes = $gestorCliente->getClientesPag($conexPDO, true, "idCliente", $pagina, 10);
$totalPaginas= $gestorCliente->totalPaginas($conexPDO,10)["Paginas"];


//var_dump($datosSocios);
include("../Vistas/mostrarClientes.php");


?>