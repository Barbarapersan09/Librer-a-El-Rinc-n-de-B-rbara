<?php


use \modelo\Utils;
use \modelo\autores;

//Creamos un array para guardar los datos del autor


//Si nos llegan datos de un autor, implica que es el formulario el que llama al controlador
if (isset($_POST["idAutor"]) && isset($_POST["Nombre"]) && isset($_POST["Apellido"])&& isset($_POST["Edad"])&& isset($_POST["Nacionalidad"])&& isset($_POST["Biografia"])) {
    //rellenamos los datos del autor que le pasaremos a la vista

    $autor = array();

    $autor["idAutor"] = $_POST["idAutor"];
    $autor["Nombre"] = $_POST["Nombre"];
    $autor["Apellido"] = $_POST["Apellido"];
    $autor["Edad"] = $_POST["Edad"];
    $autor["Nacionalidad"] = $_POST["Nacionalidad"];
    $autor["Biografia"] = $_POST["Biografia"];

    //Añadimos el código del modelo
    require_once("../modelo/Autores.php");
    require_once("../modelo/Utils.php");

    $gestorAutor = new autores();

    //Nos conectamos a la Bd
    $conexPDO = Utils::conectar();

    //Añadimos el registro
    $resultado = $gestorAutor->addAutor($autor, $conexPDO);

    //Si ha ido bien el mensaje sera distint
    if ($resultado != null)
        $mensaje = "El autor se Inserto Correctamente";
    else
        $mensaje = "Ha habido un fallo al acceder a la Base de Datos\n salte por la ventana ya!";

    //Recolectamos los datos de los autor
    $datosAutores = $gestorAutor->getAutoresPag($conexPDO, true, "idAutor", 1, 10);


    //var_dump($datosAutores);
    include("../Vistas/mostrarAutores.php");
} else {
    //Declaramos la accion para que el formulario 
    //Sepa a que controlador llamar con los datos
    $accion = "insertar";
    //Sin datos del  autor cargados cargamos la vista
    include("../Vistas/modificarAutores.php");
}