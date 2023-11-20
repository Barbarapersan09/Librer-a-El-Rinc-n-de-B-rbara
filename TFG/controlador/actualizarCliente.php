<?php

use \modelo\cliente;
use \modelo\Utils;
//Creamos un array para guardar los datos del socio
$cliente = array();

//Borramos el libro
if (isset($_POST["idCliente"]) && isset($_POST["Nombre"]) && isset($_POST["Apellidos"]) && isset($_POST["Direccion"]) && isset($_POST["DNI"]) && isset($_POST["Telefono"]) ){
//rellenamos los datos del socio que le pasaremos a la vista

$cliente["idCliente"] = $_POST["idCliente"];
$cliente["Nombre"] = $_POST["Nombre"];
$cliente["Apellidos"] = $_POST["Apellidos"];
$cliente["Direccion"] = $_POST["Direccion"];
$cliente["DNI"] = $_POST["DNI"];
$cliente["Telefono"] = $_POST["Telefono"];

if (isset($_POST["modificar"]) && $_POST["modificar"] == "false") {
    //Declaramos la accion para que el formulario 
    //Sepa a que controlador llamar con los datos
    $accion = "modificar";
    //Con los datos del socio cargados cargamos la vista
    include("../Vistas/modificar.php");


} else{
//Si modificar es true implica que nos ha llamado el formulario y nos ha pasado los datos cambiados
//Para que los modifiquemos en BD.
//Añadimos el código del modelo
require_once("../modelo/Cliente.php");
require_once("../modelo/Utils.php");

$gestorCliente = new cliente();

//Nos conectamos a la Bd
$conexPDO = Utils::conectar();

 //Modificamos el registro
 $resultado = $gestorCliente->updateCliente($cliente, $conexPDO);

 //Si ha ido bien el mensaje sera distint
 if ($resultado != null)
     $mensaje = "El Cliente se Actualizo Correctamente";
 else
     $mensaje = "Ha habido un fallo al acceder a la Base de Datos\n salte por la ventana ya!";


//Recolectamos los datos de los socios
$datosClientes = $gestorCliente->getClientesPag($conexPDO, true, "idCliente", 1, 10);
$totalPaginas= $gestorCliente->totalPaginas($conexPDO,10);
//var_dump($datosSocios);
include("../Vistas/mostrarClientes.php");

}
}else {
    //Añadimos el código del modelo
    require_once("../modelo/Cliente.php");
    require_once("../modelo/Utils.php");

    $gestorCliente = new cliente();

    //Nos conectamos a la Bd
    $conexPDO = Utils::conectar();

    //Recolectamos los datos de los clientes

    $datosClientes = $gestorCliente->getClientesPag($conexPDO, true, "idCliente", $pagina, 10);
    $totalPaginas= $gestorCliente->totalPaginas($conexPDO,10)["Paginas"];

    //var_dump($datosSocios);
    include("../Vistas/mostrarClientes.php");
}