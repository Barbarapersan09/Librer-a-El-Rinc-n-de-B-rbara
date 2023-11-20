<?php

namespace controlador;

use \modelo\Usuario;
use \modelo\Utils;
//Creamos un array para guardar los datos del cliente

//Añadimos el código del modelo
require_once("../modelo/Usuario.php");
require_once("../modelo/Utils.php");

/**
 * Los datos que llegan de la vista registro por POST ya deberían de estar validados
 * en javascript, forma email, contraseña correcta, contraseñas iguales, telefono etc
 */

//Si nos llegan datos de un cliente, implica que es el formulario el que llama al controlador
if (isset($_POST["Nombre"]) && isset($_POST["Email"]) && isset($_POST["Password"])) {
    $usuario = array();

    //var_dump($_POST["nombre"]);
    //Limpiamos los datos de posibles caracteres o codigo malicioso
    //Segun los asignamos al array de datos del usuario a registrar
    $usuario["Nombre"] = Utils::limpiar_datos($_POST["Nombre"]);
    $usuario["Email"] = Utils::limpiar_datos($_POST["Email"]);


    //Generamos una salt de 16 posiciones
    $salt = Utils::generar_salt(16, true);
    $usuario["Salt"] = $salt;


    //Encriptamos el password del formulario con la funcion crypt
    $passEncript = crypt($_POST["Password"], '$5$rounds=5000$' . $salt . '$');
    $passEncript = explode("$", $passEncript);

    $usuario["Password"] = $passEncript[4];

    //Por defecto el usuario esta deshabilitado
    $usuario["codActiv"] = 0;

    //Generamos el codigo de activacion
    $usuario["codConfirm"] = Utils::generar_codigo_activacion();

    // Creamos un objeto de usuario
    $gestorUsu = new Usuario();

    //Nos conectamos a la Bd
    $conPDO = Utils::conectar();

    //Enviamos el gmail con el codigo de activacion
    $mail = Utils::correo_registro($usuario, $conPDO);

    //Si ha ido bien el mensaje sera distint
    if ($mail != null)
        $mensaje = "El Usuario se Registro Correctamente";
    else
        $mensaje = "Ha habido un fallo al acceder a la Base de Datos\n salte por la ventana ya!";

    // Incluimos el archivo de vistas codigoActivacion.php
    include("../Vistas/codigoActivacion.php");
} else {
    //Requiere el archivo de vistas registroUsuario.php
    require_once("../Vistas/registroUsuario.php");
}
