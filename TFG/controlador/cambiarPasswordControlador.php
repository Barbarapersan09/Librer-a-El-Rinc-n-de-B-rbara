<?php

namespace controlador;

use \modelo\Usuario;
use \modelo\Utils;

//Añadimos el código del modelo
require_once("../modelo/Usuario.php");
require_once("../modelo/Utils.php");

 //var_dump($_POST["idUsuario"]);
 //var_dump($_POST["Password"]);
 //var_dump($_POST["passConfirm"]);

 
if ( isset($_POST["Password"])&& isset($_POST["passConfirm"]) && isset($_POST["idUsuario"])) {
  
    $usuario = array();
    $usuario["idUsuario"] = $_POST["idUsuario"];
    $gestorUsu = new Usuario();

    //Creamos la conexion con la base de datos
    $conPDO = Utils::conectar();


    $usu = $gestorUsu->getUsuarioID($usuario["idUsuario"], $conPDO);

    if ($usu !== false && is_array($usu) && isset($usu["Salt"])) {
        $salt = $usu["Salt"];
        $usuario["Password"] = crypt($_POST["Password"], '$5$rounds=5000$' . $salt . '$');
    } else {
        echo "El email no existe en la base de datos o se produjo un error.";
        // Puedes mostrar un mensaje de error o tomar alguna acción apropiada.
    } 

    //Añadimos el registro a la base de datos
    $resultado = $gestorUsu->updateUsuarioPass($usuario, $conPDO);

    include_once("../Indice.php");

} else {

    include_once("../Vistas/cambiarPassword.php");
}
?>