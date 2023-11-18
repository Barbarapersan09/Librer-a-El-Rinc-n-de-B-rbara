<?php

namespace modelo;

require_once("Utils.php");

use \PDO;
use \PDOException;

class autores
{
 
    /**Funcion que nos devuelve todos los Libros */
    public function getAutores($conexPDO)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones
                $sentencia = $conexPDO->prepare("SELECT * FROM biblioteca.autores");
                //Ejecutamos la sentencia
                $sentencia->execute();

                //Devolvemos los datos del autor
                return $sentencia->fetchAll();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }
    }


    /**
     * Funcion que nos devuelve todos los libros con paginacion
     * */
    public function getAutoresPag($conexPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones

                //Query inicial
                $query = "SELECT * FROM biblioteca.autores ORDER BY ? ";

                //si esta ordenada descentemente añadimos DESC
                if (!$ordAsc) $query = $query . "DESC ";

                //Añadimos a la query la cantidad de elementos por página con LIMIT
                //Y desde que página empieza con OFFSET
                $query = $query . "LIMIT ? OFFSET ?";

                $sentencia = $conexPDO->prepare($query);
                //el primer parametro es el campo a ordenar
                $sentencia->bindParam(1, $campoOrd);
                //El segundo parametro es la cantidad de elementos por pagina
                $sentencia->bindParam(2, $cantElem, PDO::PARAM_INT);
                //El tercer parametro es desde que registro empieza a partir de la
                //pagina actual
                $offset = ($numPag - 1) * $cantElem;
                if ($numPag != 1)
                    $offset++;

                $sentencia->bindParam(3, $offset, PDO::PARAM_INT);

                //INTERESANTE 
                //queryString contiene la sentencia sql a ejecutar
                //print($sentencia->queryString);

                //Ejecutamos la sentencia
                $sentencia->execute();

                //Devolvemos los datos del cliente
                return $sentencia->fetchAll();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }
    }

    public function totalPaginas($conexPDO,$cantidad){
        if (isset($cantidad) && is_numeric($cantidad)) {


            if ($conexPDO != null) {
                try {
                    //Primero introducimos la sentencia a ejecutar con prepare
                    //Ponemos en lugar de valores directamente, interrogaciones
                    $sentencia = $conexPDO->prepare("SELECT ceil(count(*)/?) as Paginas FROM biblioteca.autores;");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $cantidad);
                    //Ejecutamos la sentencia
                    $sentencia->execute();

                    //Devolvemos los datos del libro
                    return $sentencia->fetch();
                } catch (PDOException $e) {
                    print("Error al acceder a BD" . $e->getMessage());
                }
            }
        }
    }
    /**
     * Devuelve el Autor asociado a la clave primaria introducida
     */

    public function getAutor($idAutor, $conexPDO)
    {
        if (isset($idAutor) && is_numeric($idAutor)) {


            if ($conexPDO != null) {
                try {
                    //Primero introducimos la sentencia a ejecutar con prepare
                    //Ponemos en lugar de valores directamente, interrogaciones
                    $sentencia = $conexPDO->prepare("SELECT * FROM biblioteca.autores where idAutor=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idAutor);
                    //Ejecutamos la sentencia
                    $sentencia->execute();

                    //Devolvemos los datos del autor
                    return $sentencia->fetch();
                } catch (PDOException $e) {
                    print("Error al acceder a BD" . $e->getMessage());
                }
            }
        }
    }

    function addAutor($autor, $conexPDO)
    {

        $result = null;
        if (isset($autor) && $conexPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("INSERT INTO biblioteca.autores (idAutor, Nombre, Apellido, Edad, Nacionalidad, Biografia) VALUES (:idAutor, :Nombre, :Apellido, :Edad, :Nacionalidad, :Biografia)");

                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(":idAutor", $autor["idAutor"]);
                $sentencia->bindParam(":Nombre", $autor["Nombre"]);
                $sentencia->bindParam(":Apellido", $autor["Apellido"]);
                $sentencia->bindParam(":Edad", $autor["Edad"]);
                $sentencia->bindParam(":Nacionalidad", $autor["Nacionalidad"]);
                $sentencia->bindParam(":Biografia", $autor["Biografia"]);
             


                //Ejecutamos la sentencia
                $result = $sentencia->execute();
              
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }

    function delAutor($idAutor, $conexPDO)
    {
        $result = null;

        if (isset($idAutor) && is_numeric($idAutor)) {


            if ($conexPDO != null) {
                try {
                    //Borramos el autor asociado a dicho id
                    $sentencia = $conexPDO->prepare("DELETE  FROM biblioteca.autores where idAutor=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idAutor);
                    //Ejecutamos la sentencia
                    $result = $sentencia->execute();
                } catch (PDOException $e) {
                    print("Error al borrar" . $e->getMessage());
                }
            }
        }

        return $result;
    }

    function updateAutor($autor, $conexPDO)
    {

       
        $result = null;
        if (isset($autor) && isset($autor["idAutor"]) && is_numeric($autor["idAutor"])  && $conexPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("UPDATE biblioteca.autores SET  Nombre=:Nombre, Apellido=:Apellido, Edad=:Edad, Nacionalidad=:Nacionalidad, Biografia=:Biografia  WHERE idAutor=:idAutor");

                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(":idAutor", $autor["idAutor"]);
                $sentencia->bindParam(":Nombre", $autor["Nombre"]);
                $sentencia->bindParam(":Apellido", $autor["Apellido"]);
                $sentencia->bindParam(":Edad", $autor["Edad"]);
                $sentencia->bindParam(":Nacionalidad", $autor["Nacionalidad"]);
                $sentencia->bindParam(":Biografia", $autor["Biografia"]);

                //Ejecutamos la sentencia
                // $result = $sentencia->execute();
                //print($sentencia->queryString);
                return $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }
}