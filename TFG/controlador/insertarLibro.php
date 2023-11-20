<?php


use \modelo\Utils;
use \modelo\libros;

//Creamos un array para guardar los datos del libro


//Si nos llegan datos de un libro, implica que es el formulario el que llama al controlador
if (isset($_POST["idLibros"]) &&isset($_POST["ISBN"]) && isset($_POST["Imagen"]) && isset($_POST["Titulo"]) && isset($_POST["Tema"]) && isset($_POST["Paginas"])&& isset($_POST["Formato"])  && isset($_POST["Idioma"])&& isset($_POST["Fecha_publicacion"]) && isset($_POST["Precio"])&& isset($_POST["Descipcion"]) && isset($_POST["Editorial_idEditorial"]) ) {
    //rellenamos los datos del libro que le pasaremos a la vista

    $libro = array();

    $libro["idLibros"] = $_POST["idLibros"];
    $libro["ISBN"] = $_POST["ISBN"];
    $libro["Imagen"] = $_POST["Imagen"];
    $libro["Titulo"] = $_POST["Titulo"];
    $libro["Tema"] = $_POST["Tema"];
    $libro["Paginas"] = $_POST["Paginas"];
    $libro["Formato"] = $_POST["Formato"]; 
    $libro["Idioma"] = $_POST["Idioma"];
    $libro["Fecha_publicacion"] = $_POST["Fecha_publicacion"];
    $libro["Precio"] = $_POST["Precio"];
    $libro["Descripcion"] = $_POST["Descripcion"];
    $libro["Editorial_idEditorial"] = $_POST["Editorial_idEditorial"];
   
    //Añadimos el código del modelo
    require_once("../modelo/Libros.php");
    require_once("../modelo/Utils.php");

    $gestorLibro = new libros();

    //Nos conectamos a la Bd
    $conexPDO = Utils::conectar();

    //Añadimos el registro
    $resultado = $gestorLibro->addLibro($libro, $conexPDO);

    //Si ha ido bien el mensaje sera distint
    if ($resultado != null)
        $mensaje = "El Libro se Inserto Correctamente";
    else
        $mensaje = "Ha habido un fallo al acceder a la Base de Datos\n salte por la ventana ya!";

    //Recolectamos los datos de los libros
    $pagina= 1;
    $datosLibros = $gestorLibro->getLibrosPag($conexPDO, true, "idLibros", $pagina, 10);
    $totalPaginas= $gestorLibro->totalPaginas($conexPDO,10)["Paginas"];


    //var_dump($datosLibros);
    include("../Vistas/mostrarLibros.php");
} else {
    //Declaramos la accion para que el formulario 
    //Sepa a que controlador llamar con los datos
    $accion = "insertar";
    //Sin datos del  libro cargados cargamos la vista
    include("../Vistas/modificarLibros.php");
}