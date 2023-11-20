<?php

namespace modelo;

require_once("Utils.php");

use \PDO;
use \PDOException;

class cliente
{
 
    /**Funcion que nos devuelve todos las temas */
    public function getClientes($conexPDO)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones
                $sentencia = $conexPDO->prepare("SELECT * FROM biblioteca.cliente");
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
     * Funcion que nos devuelve todos las socios con paginacion
     * */
    public function getClientesPag($conexPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones

                //Query inicial
                $query = "SELECT * FROM biblioteca.cliente ORDER BY ? ";

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
                    $sentencia = $conexPDO->prepare("SELECT ceil(count(*)/?) as Paginas FROM biblioteca.cliente;");
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
     * Devuelve la socio asociado a la clave primaria introducida
     */
    public function getCliente($idCliente, $conexPDO)
    {
        if (isset($idCliente) && is_numeric($idCliente)) {


            if ($conexPDO != null) {
                try {
                    //Primero introducimos la sentencia a ejecutar con prepare
                    //Ponemos en lugar de valores directamente, interrogaciones
                    $sentencia = $conexPDO->prepare("SELECT * FROM biblioteca.cliente where idCliente=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idCliente);
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

    function addCliente($cliente, $conexPDO)
    {

        $result = null;
        if (isset($cliente) && $conexPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("INSERT INTO biblioteca.cliente (idCliente, Nombre, Apellidos, Dirección, DNI, Teléfono) VALUES ( :idCliente, :Nombre, :Apellidos, :Dirección, :DNI, :Teléfono)");

                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(":idCliente", $cliente["idSocio"]);
                $sentencia->bindParam(":Nombre", $cliente["Nombre"]);
                $sentencia->bindParam(":Apellidos", $cliente["Apellidos"]);
                $sentencia->bindParam(":Dirección", $cliente["Dirección"]);
                $sentencia->bindParam(":DNI", $cliente["DNI"]);
                $sentencia->bindParam(":Teléfono", $cliente["Teléfono"]);
                
                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }

    function delCliente($idCliente, $conexPDO)
    {
        $result = null;

        if (isset($idCliente) && is_numeric($idCliente)) {



            if ($conexPDO != null) {
                try {
                    //Borramos la editorial asociado a dicho id
                    $sentencia = $conexPDO->prepare("DELETE  FROM biblioteca.cliente where idCliente=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idCliente);
                    //Ejecutamos la sentencia
                    $result = $sentencia->execute();
                } catch (PDOException $e) {
                    print("Error al borrar" . $e->getMessage());
                }
            }
        }

        return $result;
    }

    function updateCliente($cliente, $conexPDO)
    {

        $result = null;
        if (isset($cliente) && isset($cliente["idCliente"]) && is_numeric($cliente["idCliente"])  && $conexPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("UPDATE biblioteca.cliente set idCliente=:idCliente, Nombre=:Nombre, Apellidos=:Apellidos, Dirección=:Dirección, DNI=:DNI, Teléfono=:Teléfono where idCliente=:idCliente");

                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(":idCliente", $cliente["idCliente"]);
                $sentencia->bindParam(":Nombre", $cliente["Nombre"]);
                $sentencia->bindParam(":Apellidos", $cliente["Apellidos"]);
                $sentencia->bindParam(":Dirección", $cliente["Dirección"]);
                $sentencia->bindParam(":DNI", $cliente["DNI"]);
                $sentencia->bindParam(":Teléfono", $cliente["Teléfono"]);
                
                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }
}



?>