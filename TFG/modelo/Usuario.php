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
                    $sentencia = $conPDO->prepare("SELECT * FROM biblioteca.usuarios where email = ?");

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
                $sentencia = $conPDO->prepare("SELECT * FROM biblioteca.usuarios WHERE idusuarios = :idusuarios");

                // Asociamos el valor del parámetro a la variable $idusuarios
                $sentencia->bindParam(":idusuarios", $idusuarios);

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
                    $sentencia = $conPDO->prepare("SELECT * FROM biblioteca.usuarios where idusuarios=?");
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
                $sentencia = $conPDO->prepare("INSERT INTO biblioteca.usuarios (idusuarios, nombre, email, password,salt,cod_confirm) VALUES ( :idusuarios, :nombre, :email, :password,:salt,:cod_confirm)");

                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(":idusuarios", $usuario["idusuarios"]);
                $sentencia->bindParam(":nombre", $usuario["nombre"]);
                $sentencia->bindParam(":email", $usuario["email"]);
                $sentencia->bindParam(":password", $usuario["password"]);
                $sentencia->bindParam(":salt", $usuario["salt"]);
                $sentencia->bindParam(":cod_confirm", $usuario["cod_confirm"]);

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
                $sentencia = $conPDO->prepare("UPDATE biblioteca.usuarios set cod_activ=:cod_activ where idusuarios=:idusuarios");

                //Asociamos los valores a los parametros de la sentencia sql

                $sentencia->bindParam(":idusuarios", $usuario["idusuarios"]);
                $sentencia->bindParam(":cod_activ", $usuario["cod_activ"]);

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
                $sentencia = $conPDO->prepare("UPDATE biblioteca.usuarios set password=:password where idusuarios=:idusuarios");

                print($sentencia->queryString);
                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(":idusuarios", $usuario["idusuarios"]);
                $sentencia->bindParam(":password", $usuario["password"]);
                


                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }
}
