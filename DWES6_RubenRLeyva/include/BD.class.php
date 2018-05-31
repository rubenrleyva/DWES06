<?php

/* 
 * DWES6- Aplicaciones web dinámicas: PHP y Javascript
 * Tarea 6: Voluntarios 3
 * Autor: Rubén Ángel Rodriguez Leyva
 */

/*
 * Clase encargada de manejar la conexión a la base de datos además
 * de manejar las diferentes consultas.
 */

/**
 * Description of BD
 *
 * @author RubenRL
 */
class BD {
    
    
     /**
     * Método público encargado de crear la conexión a la base de datos.
     * 
     * @return \PDO
     */ 
    public function accesoBD(){
        
        $localhost = "localhost"; // El localhost
        $nombreBD = "voluntarios3"; // Nombre de la DB
        $usuario = "dwes"; // Nombre del usuario de ls BD
        $clave = "dwes"; // Clave del usuarion de la BD
        
        try{
        
            // Creamos e instanciamos el objeto de la conexión
            $conexion = new PDO('mysql:host='.$localhost.'; dbname='.$nombreBD, $usuario, $clave);
            
            // Le pasamos algunos atributos
            $conexion->exec("set names utf-8");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $conexion; // Devolvemos la conexión.
            
        // en caso de que se produzca una excepción la controlamos.    
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

     /**
     * Método público que se encarga de recoger los diferentes voluntarios
     * que hay en la base de datos.
     * 
     * @return boolean devolvemos un booleano o un array
     */ 
    public function getVoluntarios($login){
        
        try{
            
            $conexion = self::accesoBD(); // Conectamos con la base de datos.
            
             if($login){
                $sql = "SELECT login, password, email, bloqueado FROM anunciantes WHERE login=:login"; // Creamos la consulta
                $consulta = $conexion->prepare($sql); // Preparamos la consulta
                $consulta->bindParam(":login", $login);
                
            }else{
                $sql = "SELECT login, password, email, bloqueado FROM anunciantes"; // Creamos la consulta
                $consulta = $conexion->prepare($sql); // Preparamos la consulta
            }
            
            $consulta->execute(); // Ejecutamos la consulta
			
            // Creamos un array para los movimientos del cliente/usuario
            $movimientos = array();
            
            //$consulta->bindParam(":login", $login);

            
            if($consulta){
                 // Mientras existan movimientos
                $row = $consulta->fetch();
                while($row != null){
                    
                    // Creamos un array de movimientos pasandole los datos de cada movimiento
                    $movimientos[] = new Voluntario($row);
                    $row = $consulta->fetch();
                }
            }else{
                
                $movimientos = false;
            }
            
            return $movimientos;
            
        // en caso de que se produzca una excepción la controlamos.    
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    
    /**
     * Método público que se encarga de eliminar al voluntario de que se elija.
     * 
     * @return boolean devolvemos un booleano o un array
     */ 
    public function eliminarVoluntario($login){
        
        try{
            
            $conexion = self::accesoBD(); // Conectamos con la base de datos.
            
            $sql = "DELETE FROM anunciantes WHERE login=:login"; // Creamos la consulta
            $consulta = $conexion->prepare($sql); // Preparamos la consulta
            $consulta->bindParam(":login", $login);
            $consulta->execute(); // Ejecutamos la consulta
            
            if($consulta){
                return true;
            }else{
                return false;
            }
            
        // en caso de que se produzca una excepción la controlamos.    
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    
    /**
     * Método público para actualizar la información del voluntario.
     * 
     * @param type $voluntario Array con los datos del voluntario.
     * @return boolean Retorna una booleano
     */
    public function actualizarVoluntario($voluntario){
        
        try{
            
            // Usamos la función crypt para convertir el password
            //$hash = crypt($voluntario['password'], '');
            
            // Si el bloqueo es igual a no
            if($voluntario['bloqueo'] == "No"){
                $bloqueado = "0"; // ponemos el valor a cero
                
            // en caso contrario     
            }else{
                $bloqueado = "1"; // ponemos el valor en uno
            }
            
            $conexion = self::accesoBD(); // Conectamos con la base de datos.
            
            // Preparamos la sentencia de la consulta.
            $sql = "UPDATE anunciantes SET email=:email , bloqueado=:bloqueado WHERE login=:login";
            $consulta = $conexion->prepare($sql); // Preparamos la consulta
            $consulta->bindParam(":login", $voluntario['usuario']); // Indicamos el login del voluntario.
            //$consulta->bindParam(":pass", $hash); // Indicamos el password del voluntario.
            $consulta->bindParam(":email", $voluntario['email']); // Indicamos el email del voluntario.
            $consulta->bindParam(":bloqueado", $bloqueado); // Indicamos si el voluntario se encuentra bloqueado.

            $consulta->execute(); // Ejecutamos la consulta
           
            // Si la consulta es correcta
            if($consulta){
                return true; // devuelve true.
            }else{
                return false; // en caso contrario devuelve false.
            }
            
        // en caso de que se produzca una excepción la controlamos.    
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    
    /**
     * Función pública encargada de insertar un nuevo voluntario en la BD.
     * 
     * @param type $voluntario Array con los datos del voluntario a introducir.
     * @return boolean Retorna una booleano
     */
    public function insertarVoluntario($voluntario){
        
        try{
            
            // Usamos la función crypt para convertir el password
            $hash = crypt($voluntario['password'], '');

            $conexion = self::accesoBD(); // Conectamos con la base de datos.
            
            // Preparamos la sentencia de la consulta, en este caso como deben estar bloqueados desde el principio le damos el valor de uno.
            $sql = "INSERT INTO anunciantes (login, password, email, bloqueado) VALUES (:login, :pass, :email, 1)";
            $consulta = $conexion->prepare($sql); // Preparamos la consulta
            $consulta->bindParam(":login", $voluntario['usuario']); // Indicamos el login del voluntario.
            $consulta->bindParam(":pass", $hash); // Indicamos el password del voluntario.
            $consulta->bindParam(":email", $voluntario['email']); // Indicamos el email del voluntario.

            $consulta->execute(); // Ejecutamos la consulta.
           
            // Si se realiza correctamente la consulta.
            if($consulta){
                return true; // devolvemos true.
            }else{
                return false; // en caso contrario false.
            }
            
        // en caso de que se produzca una excepción la controlamos.    
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
}
