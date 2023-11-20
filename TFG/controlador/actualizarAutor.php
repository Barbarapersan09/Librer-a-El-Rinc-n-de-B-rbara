<?php

use \modelo\autores;
use \modelo\Utils;
//Creamos un array para guardar los datos del autor
$autor = array();

//Borramos el libro
if (isset($_POST["idAutor"]) && isset($_POST["Nombre"]) && isset($_POST["Apellido"])&& isset($_POST["Edad"])&& isset($_POST["Nacionalidad"])&& isset($_POST["Biografia"]))
{
//rellenamos los datos del autor que le pasaremos a la vista

$autor["idAutor"] = $_POST["idAutor"];
$autor["Nombre"] = $_POST["Nombre"];
$autor["Apellido"] = $_POST["Apellido"];
$autor["Edad"] = $_POST["Edad"];
$autor["Nacionalidad"] = $_POST["Nacionalidad"];
$autor["Biografia"] = $_POST["Biografia"];


if (isset($_POST["modificar"]) && $_POST["modificar"] == "false") {
    //Declaramos la accion para que el formulario 
    //Sepa a que controlador llamar con los datos
    $accion = "modificar";
    //Con los datos del libro cargados cargamos la vista
    include("../Vistas/modificarAutores.php");
    
} else {

    //Si modificar es true implica que nos ha llamado el formulario y nos ha pasado los datos cambiados
    //Para que los modifiquemos en BD.
    //Añadimos el código del modelo
    require_once("../modelo/Autores.php");
    require_once("../modelo/Utils.php");

    $gestorAutor = new autores();

    //Nos conectamos a la Bd
    $conexPDO = Utils::conectar();

    //Modificamos el registro
    $resultado = $gestorAutor->updateAutor($autor, $conexPDO);

    //Si ha ido bien el mensaje sera distint
    if ($resultado != null)
        $mensaje = "El Autor se Actualizo Correctamente";
    else
        $mensaje = "Ha habido un fallo al acceder a la Base de Datos\n salte por la ventana ya!";

    //Recolectamos los datos de los clientes
    $datosAutores = $gestorAutor->getAutoresPag($conexPDO, true, "idAutor", 1, 10);


    //var_dump($datosLibros);
    include("../Vistas/mostrarAutores.php");
}
} else {

//Añadimos el código del modelo
require_once("../modelo/Autores.php");
require_once("../modelo/Utils.php");

$gestorAutor = new autores();

//Nos conectamos a la Bd
$conexPDO = Utils::conectar();

//Recolectamos los datos de los clientes
$datosAutores = $gestorAutor->getAutoresPag($conexPDO, true, "idAutor", 1, 10);


//var_dump($datosLibros);
include("../Vistas/mostrarAutores.php");
}