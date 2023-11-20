<?php

namespace modelo;

require_once("Utils.php");

use \PDO;
use \PDOException;


class Usuario
{


    /**Funcion que nos devuelve todos los usuarios */
    public function getUsuarios($conPDO)
    {

        if ($conPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones
                $sentencia = $conPDO->prepare("SELECT * FROM biblioteca.usuarios");
                //Ejecutamos la sentencia
                $sentencia->execute();

                //Devolvemos los datos del cliente
                return $sentencia->fetchAll();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }
    }
    /**
     * Nos devuelve los Usuarios registrados en la bd
     */
    public function getUsuarioEmail($email, $conPDO)
    {
        if (isset($email)) {

            if ($conPDO != null) {
                try {
                    //Introducimos la sentencia a ejecutar con prepare statement
                    $sentencia = $conPDO->prepare("SELECT * FROM biblioteca.usuarios where Email = ?");

                    // BindParam del email
                    $sentencia->bindParam(1, $email);

                    //Ejecutamos la sentencia
                    $sentencia->execute();

                    //Devolvemos los datos de los personajes
                    return $sentencia->fetch();
                } catch (PDOException $e) {
                    print("Error al acceder a BD" . $e->getMessage());
                }
            }
        }
    }
    public function getUsuarioID($idusuarios, $conPDO){

        if ($conPDO != null) {
            try {
                // Preparamos la sentencia SQL con un parámetro de marcador de posición
                $sentencia = $conPDO->prepare("SELECT * FROM biblioteca.usuarios WHERE idUsuario = :idUsuario");

                // Asociamos el valor del parámetro a la variable $idusuarios
                $sentencia->bindParam(":idUsuario", $idusuarios);

                // Ejecutamos la sentencia
                $sentencia->execute();

                // Devolvemos los datos del usuario
                return $sentencia->fetch();
            } catch (PDOException $e) {
                echo "Error al acceder a la base de datos: " . $e->getMessage();
            }
        }
    }
    /**
     * Devuelve el usuario asociado a la clave primaria introducida
     */
    public function getUsuario($idUsuario, $conPDO)
    {
        if (isset($idUsuario) && is_numeric($idUsuario)) {


            if ($conPDO != null) {
                try {
                    //Primero introducimos la sentencia a ejecutar con prepare
                    //Ponemos en lugar de valores directamente, interrogaciones
                    $sentencia = $conPDO->prepare("SELECT * FROM biblioteca.usuarios where idUsuario=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idUsuario);
                    //Ejecutamos la sentencia
                    $sentencia->execute();

                    //Devolvemos los datos del Usuario
                    return $sentencia->fetch();
                } catch (PDOException $e) {
                    print("Error al acceder a BD" . $e->getMessage());
                }
            }
        }
    }

    // Funcion para añadir un nuevo usuario.
    function addUsuario($usuario, $conPDO)
    {

        $result = null;
        if (isset($usuario) && $conPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conPDO->prepare("INSERT INTO biblioteca.usuarios (idUsuario, Nombre, Email, Password, passConfirm, Salt, codConfirm) VALUES ( :idUsuario, :Nombre, :Email, :Password, :passConfirm, :Salt,:codConfirm)");

                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(":idUsuario", $usuario["idUsuario"]);
                $sentencia->bindParam(":Nombre", $usuario["Nombre"]);
                $sentencia->bindParam(":Email", $usuario["Email"]);
                $sentencia->bindParam(":Password", $usuario["Password"]);
                $sentencia->bindParam(":passConfirm", $usuario["passConfirm"]);
                $sentencia->bindParam(":Salt", $usuario["Salt"]);
                $sentencia->bindParam(":codConfirm", $usuario["codConfirm"]);
                

                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }



    /**
     * Funcion que actualiza los datos de un usuario recibiendo como parametros un array con los datos 
     * del usuario modificado y la conexion PDO
     */
    public function updateUsuario($usuario, $conPDO)
    {

        $result = null;
        if (isset($usuario) && $conPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conPDO->prepare("UPDATE biblioteca.usuarios set codActiv=:codActiv where idUsuario=:idUsuario");

                //Asociamos los valores a los parametros de la sentencia sql

                $sentencia->bindParam(":idUsuario", $usuario["idUsuario"]);
                $sentencia->bindParam(":codActiv", $usuario["codActiv"]);

                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }

    public function updateUsuarioPass($usuario, $conPDO)
    {

        $result = null;
        if (isset($usuario)  && $conPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conPDO->prepare("UPDATE biblioteca.usuarios set Password=:Password where idUsuario=:idUsuario");

                print($sentencia->queryString);
                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(":idUsuario", $usuario["idUsuario"]);
                $sentencia->bindParam(":Password", $usuario["Password"]);
                


                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }
}
