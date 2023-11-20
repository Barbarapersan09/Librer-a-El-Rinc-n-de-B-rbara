<?php

namespace modelo;

use model\Usuario;
use \PDO;
use \PDOException;



class Utils
{


   /**
    * Funcion que se conecta a la BD y nos devuelve una conexion PDO activa
    */
   public static function conectar()
   {
      $conPDO = null;
      try {
         require_once("../global.php");
         $conPDO = new PDO("mysql:host=" . $DB_SERVER . ";dbname=" . $DB_SCHEMA, $DB_USER, $DB_PASSWD);
         return $conPDO;
      } catch (PDOException $e) {
         print "¡Error al conectar!: " . $e->getMessage() . "<br/>";
         return $conPDO;
         die();
      }
   }

   /**
    * Limpiamos el contenido de las variables
    */
   public static function limpiar_datos($data)
   {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
   }


   /**
    * Funcion que genera una cadena aleatoria
    */
   public static function generar_salt($tam, bool $numerica = false)
   {

      //Definimos un array de caracteres
      $letras = "abcdefghijklmnopqrstuvwxyz1234567890*-.,";

      $salt = "";
      //Vamos añadiendo $tam caracteres aleatorios a la salt
      for ($i = 0; $i < $tam; $i++) {
         if ($numerica == true) {
            $salt .= rand(1, 9);
         } else {

            $salt .= $letras[rand(0, strlen($letras) - 1)];
         }
      }

      //devolvemos la salt
      return $salt;
   }

   //La funcion genera un codigo número de 4 digitos aleatorio
   public static function generar_codigo_activacion()
   {
      return rand(1111, 9999);
   }



   //Funcion que envia el correo de registro
   public static function correo_registro($usuario, $conPDO)
   {
      $to = $usuario["Email"];
      $subject = "Confirma tu Cuenta";

      $message = "<b>Bienvenido a esta Web " . $usuario["Nombre"] . "</b>";
     
      // COMO CON MI BASE DE DATOS NO ME DEJA UTILIZAR OTRO CAMPO SOLO EL IDUSUARIO LO HE TENIDO QUE HACER ASI POR LA FUERZA.

      // Insertar el usuario en la base de datos
      try {
         $sentencia = $conPDO->prepare("INSERT INTO biblioteca.usuarios (idUsuario, Nombre, Email, Password, Salt, codConfirm) VALUES ( :idUsuario, :Nombre, :Email, :Password, :Salt, :codConfirm)");
         
         //Asociamos los valores a los parametros de la sentencia sql
         $sentencia->bindParam(":idUsuario", $usuario["idUsuario"]);
         $sentencia->bindParam(":Nombre", $usuario["Nombre"]);
         $sentencia->bindParam(":Email", $usuario["Email"]);
         $sentencia->bindParam(":Password", $usuario["Password"]);
         $sentencia->bindParam(":Salt", $usuario["Salt"]);
         $sentencia->bindParam(":codConfirm", $usuario["codConfirm"]);
         $sentencia->execute();

         // Obtener el ID de usuario generado automáticamente
         $idusuarios = $conPDO->lastInsertId();

         $message .= "<h3>Tu ID de usuario es: " . $idusuarios . "</h3>";
      } catch (PDOException $e) {
         echo "Error al insertar el registro: " . $e->getMessage();
         return;
      }
      $message .= "<h3>Tu código de activación es: " . $usuario["codConfirm"] . "</h3>";
      
      $header = "From: bpersan834@g.educaand.es\r\n";
      $header .= "MIME-Version: 1.0\r\n";
      $header .= "Content-type: text/html\r\n";

      $retval = mail($to, $subject, $message, $header);

      if ($retval == true) {
         echo '<script>alert("Email enviado correctamente!");</script>';
      } else {
         echo '<script>alert("El email no se ha podido enviar!");</script>';
      }
   }

   public static function correo_cambiarPassword($email, $usuario)
   {
      // Configuración para enviar correo
      $to = $usuario['Email'];
      $subject = 'Cambio de contraseña' . $email;
      $message = 'Estimado ' . $usuario['Nombre'] . ',<br><br>Tu contraseña ha sido cambiada exitosamente. <br>Atentamente,<br>El equipo de Biblioteca';
      $headers = "From: bpersan834@g.educaand.es\r\n";
      $headers .= "Reply-To: bpersan834@g.educaand.es\r\n";
      $headers .= "Content-type: text/html\r\n";

      $retval = mail($to, $subject, $message, $headers);
      // Envío de correo electrónico
      if ($retval == true) {
         echo '<script>alert("Email enviado correctamente!");</script>';
      } else {
         echo '<script>alert("El email no se ha podido enviar!");</script>';
      }
   }
}
  
//echo Utils::generar_salt(16) . hash("sha256",1234);

// Utils::correo_registro(["email" => "thejokerjune@gmail.com", "nombre" => "Barbara"]);

//$util = new Utils();

//var_dump($util->conectar());

//echo Utils::generar_salt(16, false);
