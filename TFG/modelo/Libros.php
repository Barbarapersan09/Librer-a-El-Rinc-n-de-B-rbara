<?php

namespace modelo;

require_once("Utils.php");

use \PDO;
use \PDOException;

class libros
{
 
    /**Funcion que nos devuelve todos los Libros */
    public function getLibros($conexPDO)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones
                $sentencia = $conexPDO->prepare("SELECT * FROM biblioteca.libros");
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
     * Funcion que nos devuelve todos los libros con paginacion
     * */
    public function getLibrosPag($conexPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {

        if ($conexPDO != null) {
            try {
                //Primero introducimos la sentencia a ejecutar con prepare
                //Ponemos en lugar de valores directamente, interrogaciones

                //Query inicial
                $query = "SELECT * FROM biblioteca.libros ORDER BY ? ";

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
                    $sentencia = $conexPDO->prepare("SELECT ceil(count(*)/?) as Paginas FROM biblioteca.libros;");
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
     * Devuelve el libro asociado a la clave primaria introducida
     */

    public function getLibro($idLibro, $conexPDO)
    {
        if (isset($idLibro) && is_numeric($idLibro)) {


            if ($conexPDO != null) {
                try {
                    //Primero introducimos la sentencia a ejecutar con prepare
                    //Ponemos en lugar de valores directamente, interrogaciones
                    $sentencia = $conexPDO->prepare("SELECT * FROM biblioteca.libros where idLibros=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idLibro);
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

    function addLibro($libro, $conexPDO)
    {

        $result = null;
        if (isset($libro) && $conexPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("INSERT INTO biblioteca.libros (idLibros, ISBN, Imagen, Titulo, Tema, Paginas, Formato, Idioma,Fecha_publicacion, Precio, Descipcion, Editorial_idEditorial) VALUES (:idLibros, :ISBN, :Imagen, :Titulo, :Tema, :Paginas, :Formato, :Idioma,:Fecha_publicacion, :Precio, :Descripcion, :Editorial_idEditorial)");

                //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(":idLibros", $libro["idLibros"]);
                $sentencia->bindParam(":ISBN", $libro["ISBN"], PDO::PARAM_INT);
                $sentencia->bindParam(":Imagen", $libro["Imagen"]);
                $sentencia->bindParam(":Titulo", $libro["Titulo"]);
                $sentencia->bindParam(":Tema", $libro["Tema"]);
                $sentencia->bindParam(":Paginas", $libro["Paginas"], PDO::PARAM_INT);
                $sentencia->bindParam(":Formato", $libro["Formato"]);
                $sentencia->bindParam(":Idioma", $libro["Idioma"]); 
                $sentencia->bindParam(":Fecha_publicacion", $libro["Fecha_publicacion"]);
                $sentencia->bindParam(":Precio", $libro["Precio"]);
                $sentencia->bindParam(":Descripcion", $libro["Descripcion"]);
                $sentencia->bindParam(":Editorial_idEditorial", $libro["Editorial_idEditorial"], PDO::PARAM_INT);
               
                //Ejecutamos la sentencia
                $result = $sentencia->execute();
              
            } catch (PDOException $e) {
                print("Error al acceder a BD" . $e->getMessage());
            }
        }

        return $result;
    }

    function delLibro($idLibro, $conexPDO)
    {
        $result = null;

        if (isset($idLibro) && is_numeric($idLibro)) {


            if ($conexPDO != null) {
                try {
                    //Borramos el cliente asociado a dicho id
                    $sentencia = $conexPDO->prepare("DELETE  FROM biblioteca.libros where idLibros=?");
                    //Asociamos a cada interrogacion el valor que queremos en su lugar
                    $sentencia->bindParam(1, $idLibro);
                    //Ejecutamos la sentencia
                    $result = $sentencia->execute();
                } catch (PDOException $e) {
                    print("Error al borrar" . $e->getMessage());
                }
            }
        }

        return $result;
    }

    function updateLibro($libro, $conexPDO)
    {

       
        $result = null;
        if (isset($libro) && isset($libro["idLibros"]) && is_numeric($libro["idLibros"])  && $conexPDO != null) {

            try {
                //Preparamos la sentencia
                $sentencia = $conexPDO->prepare("UPDATE biblioteca.libros SET ISBN=:ISBN, Imagen=:Imagen, Titulo=:Titulo, Tema=:Tema, Paginas=:Paginas, Formato=:Formato, Idioma=:Idioma, Fecha_publicacion=:Fecha_publicacion, Precio=:Precio, Descripcion=:Descripcion, Editorial_idEditorial=:Editorial_idEditorial,  WHERE idLibros=:idLibros");

         //Asociamos los valores a los parametros de la sentencia sql
                $sentencia->bindParam(":idLibros", $libro["idLibros"]);
                $sentencia->bindParam(":ISBN", $libro["ISBN"], PDO::PARAM_INT);
                $sentencia->bindParam(":Imagen", $libro["Imagen"]);
                $sentencia->bindParam(":Titulo", $libro["Titulo"]);
                $sentencia->bindParam(":Tema", $libro["Tema"]);
                $sentencia->bindParam(":Paginas", $libro["Paginas"], PDO::PARAM_INT);
                $sentencia->bindParam(":Formato", $libro["Formato"]);
                $sentencia->bindParam(":Idioma", $libro["Idioma"]); 
                $sentencia->bindParam(":Fecha_publicacion", $libro["Fecha_publicacion"]);
                $sentencia->bindParam(":Precio", $libro["Precio"]);
                $sentencia->bindParam(":Descripcion", $libro["Descripcion"]);
                $sentencia->bindParam(":Editorial_idEditorial", $libro["Editorial_idEditorial"], PDO::PARAM_INT);

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
?>