<?php

namespace controlador;

use \modelo\Usuario;
use \modelo\Utils;


//Añadimos el código del modelo
require_once("../modelo/Usuario.php");
require_once("../modelo/Utils.php");


if (isset($_POST["codConfirm"])) {

    $usuario = array();

     //se le insertan los datos 
     $usuario["idUsuario"] = $_POST["idUsuario"];

     $usuario["codActiv"]=1;

    // Las variables adquieren el valor sin informacion dañina
    $codConfirm = Utils::limpiar_datos($_POST["codConfirm"]);

    
    $gestorUsu = new Usuario();

    //creamos la conexion con la base de datos
    $conPDO = Utils::conectar();


    //actualizamos el estado del usuario
    $resultado = $gestorUsu->updateUsuario($usuario, $conPDO);

    //Si ha ido bien el mensaje sera distint
    if ($resultado != null)
        echo '<script>alert("El usuario se registro correctamente!");</script>';
    else
        echo '<script>alert("Ha habido un error!");</script>';

    //redirigimos a la pagina de login
    include("../Vistas/LoginView.php");
}else{
    include("../Vistas/codigoActivacion.php");
}
    

    
?>