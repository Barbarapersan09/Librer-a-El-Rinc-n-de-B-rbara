<?php


use \modelo\Utils;
use \modelo\editoriales;

//Creamos un array para guardar los datos del editorial


//Si nos llegan datos de un libro, implica que es el formulario el que llama al controlador
if (isset($_POST["idEditorial"]) && isset($_POST["Nombre"]) && isset($_POST["Direccion"]) && isset($_POST["Telefono"])&& isset($_POST["web"])) {
    //rellenamos los datos del libro que le pasaremos a la vista

    $editorial = array();

    $editorial["idEditorial"] = $_POST["idEditorial"];
    $editorial["Nombre"] = $_POST["Nombre"];
    $editorial["Direccion"] = $_POST["Direccion"];
    $editorial["Telefono"] = $_POST["Telefono"];
    $editorial["web"] = $_POST["web"];

    //Añadimos el código del modelo
    require_once("../modelo/Editoriales.php");
    require_once("../modelo/Utils.php");

    $gestorEditorial= new editoriales();

    //Nos conectamos a la Bd
    $conexPDO = Utils::conectar();

    //Añadimos el registro
    $resultado = $gestorEditorial->addEditorial($editorial, $conexPDO);

    //Si ha ido bien el mensaje sera distint
    if ($resultado != null)
        $mensaje = "La editorial se Inserto Correctamente";
    else
        $mensaje = "Ha habido un fallo al acceder a la Base de Datos\n salte por la ventana ya!";

    //Recolectamos los datos de los editorales
    $datosEditoriales = $gestorEditorial->getEditorialesPag($conexPDO, true, "idEditorial", 1, 10);


    //var_dump($datosEditoriales);
    include("../Vistas/mostrarEditoriales.php");
} else {
    //Declaramos la accion para que el formulario 
    //Sepa a que controlador llamar con los datos
    $accion = "insertar";
    //Sin datos del  editorial cargados cargamos la vista
    include("../Vistas/modificarEditoriales.php");
}