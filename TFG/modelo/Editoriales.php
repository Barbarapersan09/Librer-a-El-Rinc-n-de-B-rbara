<?php

namespace modelo;

require_once("Utils.php");

use \PDO;
use \PDOException;

class editoriales
{
 
    /**Funcion que nos devuelve todos las editoriales */
    public function getEditoriales($conexPDO)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones
                $sentencia = $conexPDO->prepare("SELECT * FROM biblioteca.editorial");
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
     * Funcion que nos devuelve todos las editoriales con paginacion
     * */
    public function getEditorialesPag($conexPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones

                //Query inicial
                $query = "SELECT * FROM biblioteca.editorial ORDER BY ? ";

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
                    $sentencia = $conexPDO->prepare("SELECT ceil(count(*)/?) as Paginas FROM biblioteca.editorial;");
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
     * Devuelve la editorial asociado a la clave primaria introducida
     */
    public function getEditorial($idEditorial, $conexPDO)
    {
        if (isset($idEditorial) && is_numeric($idEditorial)) {


            if ($conexPDO != null) {
                try {
                    //Primero introducimos la sentencia a ejecutar con prepare
                    //Ponemos en lugar de valores directamente, interrogaciones
                    $sentencia = $conexPDO->prepare("SELECT * FROM biblioteca.editorial where idEditorial=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idEditorial);
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

    function addEditorial($editorial, $conexPDO)
    {

        $result = null;
        if (isset($editorial) && $conexPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("INSERT INTO biblioteca.editorial (idEditorial, Nombre, Direccion, Telefono, web) VALUES ( :idEditorial, :Nombre, :Direccion, :Telefono, :web)");

                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(":idEditorial", $editorial["idEditorial"]);
                $sentencia->bindParam(":Nombre", $editorial["Nombre"]);
                $sentencia->bindParam(":Direccion", $editorial["Direccion"]);
                $sentencia->bindParam(":Telefono", $editorial["Telefono"]);
                $sentencia->bindParam(":web", $editorial["web"]);
                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }

    function delEditorial($idEditorial, $conexPDO)
    {
        $result = null;

        if (isset($idEditorial) && is_numeric($idEditorial)) {



            if ($conexPDO != null) {
                try {
                    //Borramos la editorial asociado a dicho id
                    $sentencia = $conexPDO->prepare("DELETE  FROM biblioteca.editorial where idEditorial=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idEditorial);
                    //Ejecutamos la sentencia
                    $result = $sentencia->execute();
                } catch (PDOException $e) {
                    print("Error al borrar" . $e->getMessage());
                }
            }
        }

        return $result;
    }

    function updateEditorial($editorial, $conexPDO)
    {

        $result = null;
        if (isset($editorial) && isset($editorial["idEditorial"]) && is_numeric($editorial["idEditorial"])  && $conexPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("UPDATE biblioteca.editorial set idEditorial=:idEditorial, Nombre=:Nombre, Direccion=:Direccion, Telefono=:Telefono, web=:web where idEditorial=:idEditorial");

                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(":idEditorial", $editorial["idEditorial"]);
                $sentencia->bindParam(":Nombre", $editorial["Nombre"]);
                $sentencia->bindParam(":Direccion", $editorial["Direccion"]);
                $sentencia->bindParam(":Telefono", $editorial["Telefono"]);
                $sentencia->bindParam(":web", $editorial["web"]);
                
                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }
}
