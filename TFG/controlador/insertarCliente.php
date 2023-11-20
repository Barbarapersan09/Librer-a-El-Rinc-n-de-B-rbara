<?php


use \modelo\Utils;
use \modelo\cliente;

//Creamos un array para guardar los datos de los socios


//Si nos llegan datos de un socio, implica que es el formulario el que llama al controlador
if (isset($_POST["idCliente"]) && isset($_POST["Nombre"]) && isset($_POST["Apellidos"]) && isset($_POST["Direccion"]) && isset($_POST["DNI"]) && isset($_POST["Telefono"])) {
    //rellenamos los datos del libro que le pasaremos a la vista

    $cliente = array();

    $cliente["idCliente"] = $_POST["idCliente"];
    $cliente["Nombre"] = $_POST["Nombre"];
    $cliente["Apellidos"] = $_POST["Apellidos"];
    $cliente["Direccion"] = $_POST["Direccion"];
    $cliente["DNI"] = $_POST["DNI"];
    $cliente["Telefono"] = $_POST["Telefono"];

    //Añadimos el código del modelo
    require_once("../modelo/Cliente.php");
    require_once("../modelo/Utils.php");

    $gestorCliente= new cliente();

    //Nos conectamos a la Bd
    $conexPDO = Utils::conectar();

    //Añadimos el registro
    $resultado = $gestorCliente->addCliente($socio, $conexPDO);

    //Si ha ido bien el mensaje sera distint
    if ($resultado != null)
        $mensaje = "El Cliente se Inserto Correctamente";
    else
        $mensaje = "Ha habido un fallo al acceder a la Base de Datos\n salte por la ventana ya!";

    //Recolectamos los datos de los editorales
    $pagina= 1;
    $datosClientes = $gestorCliente->getClientesPag($conexPDO, true, "idCliente", $pagina, 10);
    $totalPaginas= $gestorCliente->totalPaginas($conexPDO,10)["Paginas"];

    //var_dump($datosSocios);
    include("../Vistas/mostrarSocios.php");
} else {
    //Declaramos la accion para que el formulario 
    //Sepa a que controlador llamar con los datos
    $accion = "insertar";
    //Sin datos del  editorial cargados cargamos la vista
    include("../Vistas/modificarSocios.php");
}