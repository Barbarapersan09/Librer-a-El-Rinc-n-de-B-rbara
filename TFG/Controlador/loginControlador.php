<?php

namespace controlador;

use \modelo\Usuario;
use \modelo\Utils;

//Añadimos el código del modelo
require_once("../modelo/Usuario.php");
require_once("../modelo/Utils.php");

// Inicio sesion
session_start();

//Si nos llegan datos de un cliente, implica que es el formulario el que llama al controlador
if (isset($_POST["Email"]) && isset($_POST["Password"])) {
    $usuario = array();

    //Limpiamos los datos de posibles caracteres o codigo malicioso
    $email = Utils::limpiar_datos($_POST["Email"]);

    $gestorUsu = new Usuario();

    //Nos conectamos a la Bd
    $conPDO = Utils::conectar();

    //Saco los datos del usuario que va a confirmar 
    $usuario = $gestorUsu->getUsuarioEmail($email,$conPDO);
// Compruebo que la password sea la misma que la guardada en la bd
    // cogiendo el salt y encriptando la password introducida por el usuario y viendo si es igual que la guardada
    
    $passEncript= crypt($_POST["Password"],'$5$rounds=5000$'.$usuario["Salt"].'$');
    $passEncript = explode ("$", $passEncript);

    // Si el password 
    if($passEncript[4]==$usuario["Password"]&& ($usuario["codActiv"]==1)){

        // Guardo el id del usuario en la sesion y el nombre
        $_SESSION["id"] = $usuario["idUsuario"];
        $_SESSION["Nombre"] = $usuario["Nombre"];
        // si es asi redirecciono al mainController
        header("Location:../Indice.php");
    }else{
        // Si no lo mando a login nuevamente 
        include("../Vistas/loginView.php");
    }

}else{
    // Si no llegan datos del formulario redirijo al login
    include("../Vistas/loginView.php");

}   
?>