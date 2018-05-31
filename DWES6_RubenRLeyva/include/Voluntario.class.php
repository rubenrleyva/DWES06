<?php

/* 
 * DWES6- Aplicaciones web dinámicas: PHP y Javascript
 * Tarea 6: Voluntarios 3
 * Autor: Rubén Ángel Rodriguez Leyva
 */

/**
 * Description of Voluntario
 *
 * @author RubenRL
 */
class Voluntario {
    
    private $login;
    private $password;
    private $email;
    private $bloqueado;
    
     /**
     * Constructor de la clase Voluntario.
     * 
     * @param type $row
     */
    public function __construct($row) {
        $this->login = $row['login'];
        $this->password = $row['password'];
        $this->email = $row['email'];
        $this->bloqueado = $row['bloqueado'];
    }

    /**
     * Método mágico que confirma datos pendientes o realizar tareas similares de limpieza.
     * @return type
     */
    public function __sleep() {
        return array('login', 'password', 'email', 'bloqueado');
    }
    
    /**
     * Método GETTER encargado de devolver el login del voluntario.
     * @return type
     */
    public function getLogin(){
        return $this->login;
    }
    
    /**
     * Método GETTER encargado de devolver el password del voluntario.
     * @return type
     */
    public function getPassword(){
        return $this->password;
    }
    
    /**
     * Método GETTER encargado de devolver el email del voluntario.
     * @return type
     */
    public function getEmail(){
        return $this->email;
    }
    
    /**
     * Método GETTER encargado de devolver si se encuentra o no bloqueado el voluntario.
     * @return type
     */
    public function getBloqueado(){
        if($this->bloqueado == "1"){
            $esta = 'Si';
        }else{
            $esta = 'No';
        }
        return $esta;
    }
    
    /**
     * Método SETTER encargado de establecer el login del voluntario.
     * 
     * @param type $login El login del usuario
     */
    public function setLogin($login){
        $this->login = $login;
    }  
    
    /**
     * Método SETTER encargado de establecer el password del voluntario.
     * 
     * @param type $password El apssword del usuario
     */
    public function setPassword($password){
        $this->password = $password;
    }  
    
    /**
     * Método SETTER encargado de establecer el email del voluntario.
     * 
     * @param type $email El email del usuario
     */
    public function setEmail($email){
        $this->email = $email;
    }  
    
    /**
     * Método SETTER encargado de establecer el bloqueo del voluntario.
     * 
     * @param type $bloqueado El bloqueo del usuario
     */
    public function setBloqueado($bloqueado){
        $this->bloqueado = $bloqueado;
    }     
}
