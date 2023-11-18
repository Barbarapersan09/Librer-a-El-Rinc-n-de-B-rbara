<?php

namespace modelo;

require_once("Utils.php");

use \PDO;
use \PDOException;

class socios
{
 
    /**Funcion que nos devuelve todos las temas */
    public function getSocios($conexPDO)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones
                $sentencia = $conexPDO->prepare("SELECT * FROM biblioteca.socio");
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
    public function getSociosPag($conexPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones

                //Query inicial
                $query = "SELECT * FROM biblioteca.socio ORDER BY ? ";

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
                    $sentencia = $conexPDO->prepare("SELECT ceil(count(*)/?) as Paginas FROM biblioteca.socio;");
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
    public function getSocio($idSocio, $conexPDO)
    {
        if (isset($idSocio) && is_numeric($idSocio)) {


            if ($conexPDO != null) {
                try {
                    //Primero introducimos la sentencia a ejecutar con prepare
                    //Ponemos en lugar de valores directamente, interrogaciones
                    $sentencia = $conexPDO->prepare("SELECT * FROM biblioteca.socio where idSocio=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idSocio);
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

    function addSocio($socio, $conexPDO)
    {

        $result = null;
        if (isset($socio) && $conexPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("INSERT INTO biblioteca.socio (idSocio, Nombre, Apellidos, Dirección, DNI, Teléfono, Fecha_nacimiento) VALUES ( :idSocio, :Nombre, :Apellidos, :Dirección, :DNI, :Teléfono, :Fecha_nacimiento)");

                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(":idSocio", $socio["idSocio"]);
                $sentencia->bindParam(":Nombre", $socio["Nombre"]);
                $sentencia->bindParam(":Apellidos", $socio["Apellidos"]);
                $sentencia->bindParam(":Dirección", $socio["Dirección"]);
                $sentencia->bindParam(":DNI", $socio["DNI"]);
                $sentencia->bindParam(":Teléfono", $socio["Teléfono"]);
                $sentencia->bindParam(":Fecha_nacimiento", $socio["Fecha_nacimiento"]);
                
                //Ejecutamos la sentencia
                $result = $sentencia->execute();
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }

    function delSocio($idSocio, $conexPDO)
    {
        $result = null;

        if (isset($idSocio) && is_numeric($idSocio)) {



            if ($conexPDO != null) {
                try {
                    //Borramos la editorial asociado a dicho id
                    $sentencia = $conexPDO->prepare("DELETE  FROM biblioteca.socio where idSocio=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idSocio);
                    //Ejecutamos la sentencia
                    $result = $sentencia->execute();
                } catch (PDOException $e) {
                    print("Error al borrar" . $e->getMessage());
                }
            }
        }

        return $result;
    }

    function updateSocio($socio, $conexPDO)
    {

        $result = null;
        if (isset($socio) && isset($socio["idSocio"]) && is_numeric($socio["idSocio"])  && $conexPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("UPDATE biblioteca.socio set idSocio=:idSocio, Nombre=:Nombre, Apellidos=:Apellidos, Dirección=:Dirección, DNI=:DNI, Teléfono=:Teléfono, Fecha_nacimiento=:Fecha_nacimiento where idSocio=:idSocio");

                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(":idSocio", $socio["idSocio"]);
                $sentencia->bindParam(":Nombre", $socio["Nombre"]);
                $sentencia->bindParam(":Apellidos", $socio["Apellidos"]);
                $sentencia->bindParam(":Dirección", $socio["Dirección"]);
                $sentencia->bindParam(":DNI", $socio["DNI"]);
                $sentencia->bindParam(":Teléfono", $socio["Teléfono"]);
                $sentencia->bindParam(":Fecha_nacimiento", $socio["Fecha_nacimiento"]);
                
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