<?php

use modelo\editoriales;
use \modelo\Utils;
//Creamos un array para guardar los datos del editorial
$editorial = array();

//Borramos el libro
if (isset($_POST["idEditorial"]) && isset($_POST["Nombre"]) && isset($_POST["Direccion"])  && isset($_POST["Telefono"])&& isset($_POST["web"])) {
    //rellenamos los datos del socio que le pasaremos a la vista

    $editorial["idEditorial"] = $_POST["idEditorial"];
    $editorial["Nombre"] = $_POST["Nombre"];
    $editorial["Direccion"] = $_POST["Direccion"];
    $editorial["Telefono"] = $_POST["Telefono"];
    $editorial["web"] = $_POST["web"];

    if (isset($_POST["modificar"]) && $_POST["modificar"] == "false") {
        //Declaramos la accion para que el formulario 
        //Sepa a que controlador llamar con los datos
        $accion = "modificar";
        //Con los datos del libro cargados cargamos la vista

        //Con los datos del editoriales cargados cargamos la vista
        include("../Vistas/modificarEditoriales.php");
    } else {

        //Añadimos el código del modelo
        require_once("../modelo/Editoriales.php");
        require_once("../modelo/Utils.php");

        $gestorEditorial = new editoriales();

        //Nos conectamos a la Bd
        $conexPDO = Utils::conectar();

        //Modificamos el registro
        $resultado = $gestorEditorial->updateEditorial($editorial, $conexPDO);

        //Si ha ido bien el mensaje sera distint
        if ($resultado != null)
            $mensaje = "La editorial se Actualizo Correctamente";
        else
            $mensaje = "Ha habido un fallo al acceder a la Base de Datos\n salte por la ventana ya!";

        //Recolectamos los datos de los clientes
        $datosEditoriales = $gestorEditorial->getEditorialesPag($conexPDO, true, "idEditorial", 1, 10);


        //var_dump($datosLibros);
        include("../Vistas/mostrarEditoriales.php");
    }
} else {

    //Añadimos el código del modelo
    require_once("../modelo/Editoriales.php");
    require_once("../modelo/Utils.php");

    $gestorEditorial = new editoriales();

    //Nos conectamos a la Bd
    $conexPDO = Utils::conectar();


    //Recolectamos los datos de los editoriales
    $datosEditoriales = $gestorEditorial->getEditorialesPag($conexPDO, true, "idEditorial", 1, 10);

    //var_dump($datosEditoriales);
    include("../Vistas/mostrarEditoriales.php");
}
