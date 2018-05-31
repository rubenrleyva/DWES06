<?php

/* 
 * DWES6- Aplicaciones web dinámicas: PHP y Javascript
 * Tarea 6: Voluntarios 3
 * Autor: Rubén Ángel Rodriguez Leyva
 */

// Archivos requeridos para el funcionamiento de la aplicación.
require_once 'xajax_core/xajax.inc.php';
require_once 'BD.class.php';
require_once 'Voluntario.class.php';

/**
 * Función encargada de mostrar los voluntarios que hay en la base de datos
 * en una tabla.
 * 
 * @return \xajaxResponse
 */
function voluntariosTabla(){
    
    $login = null;
    
    // Se instancia y utiliza para devolver al navegador los comandos resultado del procesamiento.
    $respuesta = new xajaxResponse();
    
    // Recuperamos los voluntarios que existan en la base de datos.
    $voluntarios = BD::getVoluntarios($login);
    
    // Comenzamos la creación de la tabla
    $salida = "<fieldset>".
                "<legend align='center'>Voluntarios</legend>";
    
    // Si se nos devuelven datos
    if($voluntarios){
            
            // Continuamos con la edición de la tabla.
            $salida .= "<table align='center'>".      
                "<tr>".
                    "<th>Login</th>".
                    "<th>Password</th>".
                    "<th>Email</th>".
                    "<th>¿Bloqueado?</th>".
                    "<th>Editar</th>".
                    "<th>Borrar</th>".
                "</tr>";
            
            // Recorremos el array con los voluntarios
            foreach ($voluntarios as $voluntario){
                $salida .= "</tr>".
                    "<td align='center'>".$voluntario->getLogin()."</td>".
                    "<td align='center'>*****</td>".
                    "<td align='center'>".$voluntario->getEmail()."</td>".
                    "<td align='center'>".$voluntario->getBloqueado()."</td>".
                    '<td align="center"><input type="button" onclick="mostrarVoluntario(\''.$voluntario->getLogin().'\')" value="E"></button></td>'.
                    '<td align="center"><input type="button" onclick="eliminarVoluntario(\''.$voluntario->getLogin().'\')" value="B"></button></td>'.
                "</tr>";
            }
        $salida .= "</table>";
    // en caso de que no existan voluntarios.              
    }else{
        $salida .= "<p align=center>NO HAY VOLUNTARIOS</p>";
    }
    
    $salida .= "</fieldset>";
    
    // Asignamos la salida.
    $respuesta->assign("voluntarios", "innerHTML", $salida);
    
    // Retornamos el resultado.
    return $respuesta;  
}

/**
 * Función encargada de editar el voluntario que escojamos de la tabla.
 * 
 * @param type $login El login del voluntario que escojamos de la tabla
 * @return \xajaxResponse
 */
function editaVoluntario($login){
    
    // Se instancia y utiliza para devolver al navegador los comandos resultado del procesamiento.
    $respuesta = new xajaxResponse();
    
    // Devolvemos el voluntario según su login.
    $voluntarios = BD::getVoluntarios($login);
    
    // Recorremos el array con los datos del voluntario.
    foreach ($voluntarios as $voluntario){
    
        // asignamos a usuario su valor
        $respuesta->assign("usuario", "value", $voluntario->getLogin());

        // asignamos a password su valor
        $respuesta->assign("password", "value", '******');

        // asignamos a passwordRepe su valor
        $respuesta->assign("passwordRepe", "value", '******');

        // asignamos a email su valor
        $respuesta->assign("email", "value", $voluntario->getEmail());
        
        // asignamos a bloqueo su valor
        $respuesta->assign("bloqueo", "value", $voluntario->getBloqueado());
    }

    // Retornamos el resultado.
    return $respuesta;
}

/**
 * Función encargada de eliminar el voluntario escogido de la tabla.
 * 
 * @param type $login El login del voluntario.
 * @return boolean
 */
function eliminaVoluntario($login){
    
    // Se instancia y utiliza para devolver al navegador los comandos resultado del procesamiento.
    $respuesta = new xajaxResponse();
    
    // Eliminamos el voluntario
    $voluntarios = BD::eliminarVoluntario($login);
    
    // En caso de eliminarlo correctamente.
    if($voluntarios){
        $respuesta = true; // devolvemos true.
    }else{
        $respuesta = false; // en caso contrarion false.
    }

    // Retornamos el resultado.
    return $respuesta;
}
    
/**
 * Función encargada de validar la edición del voluntario.
 * 
 * @param type $voluntario Lo datos del usuario.
 * @return \xajaxResponse
 */
function validarEdicionVoluntario($voluntario){
    
    // Se instancia y utiliza para devolver al navegador los comandos resultado del procesamiento.
    $respuesta = new xajaxResponse();
    
    // Ponemos los errores en false.
    $error = false;
    
    // Recuperamos los datos.
    $login = $voluntario['usuario']; // Recuperamos el login.
    $email = $voluntario['email']; // Recuperamos el email.
    $pass1 = $voluntario['password']; // Para el password
    $pass2 = $voluntario['passwordRepe']; // Para el passwordRepe
    $bloqueo = $voluntario['bloqueo']; // Recuperamos el bloqueo.
    
    // Validamos el nombre.
    if (!validarNombre($login)) {
        $respuesta->assign("errorLogin1", "innerHTML", "El login no debe de estar vacío.");
        $error = true;
    }else{
        $respuesta->clear("errorLogin1", "innerHTML");
    }
    
    // Validamos los password
    if (!validarPasswords($pass1, $pass2)) {
        $respuesta->assign("errorPassword1", "innerHTML", "Las contraseñas no pueden estar vacías y deben ser iguales.");
        $error = true;
    }else{
        $respuesta->clear("errorPassword1", "innerHTML");
    }

    // Validamos el bloqueo
    if(!validarBloqueo($bloqueo)){
        $respuesta->assign("errorBloqueo1", "innerHTML", "El bloqueo debe de ser Si o No.");
        $error = true;
    }else{
        $respuesta->clear("errorBloqueo1", "innerHTML");
    }
    
    // Validamos el email.
    if (!validarEmail($email)) {
        $respuesta->assign("errorEmail1", "innerHTML", "La dirección de email no es válida.");
        $error = true;
    }else{
        $respuesta->clear("errorEmail1", "innerHTML");
    }

    // En caso de no existir errores.
    if (!$error) {

        // Actualizamos la base de datos.
        BD::actualizarVoluntario($voluntario);
        
        // Devolvemos el valor a la tabla.
        $respuesta->setReturnValue(voluntariosTabla());
    }
     
    // Retornamos el resultado.
    return $respuesta;    
}

/**
 * Función encargada del validar el ingreso de un nuevo voluntario.
 * 
 * @param type $voluntario Los datos del voluntario.
 * @return \xajaxResponse
 */
function validarIngresoVoluntario($voluntario){
    
    // Se instancia y utiliza para devolver al navegador los comandos resultado del procesamiento.
    $respuesta = new xajaxResponse();
    
    // Ponemos los errores en false.
    $error = false;
    
    // Recuperamos los diferentes datos.
    $login = $voluntario['usuario']; // Para el login
    $pass1 = $voluntario['password']; // Para el password
    $pass2 = $voluntario['passwordRepe']; // Para el passwordRepe
    $email = $voluntario['email']; // Para el email
    $bloqueo = $voluntario['bloqueo']; // Para el bloqueo.
    
    // Validamos el nombre.
    if (!validarNombre($login)) {
        $respuesta->assign("errorLogin2", "innerHTML", "El login no debe de estar vacío.");
        $error = true;
    }else{
        $respuesta->clear("errorLogin2", "innerHTML");
    }
    
    // Validamos los password
    if (!validarPasswords($pass1, $pass2)) {
        $respuesta->assign("errorPassword2", "innerHTML", "Las contraseñas no pueden estar vacías y deben ser iguales.");
        $error = true;
    }else{
        $respuesta->clear("errorPassword2", "innerHTML");
    }

    // Validamos el bloqueo.
    if(!validarBloqueo($bloqueo)){
        $respuesta->assign("errorBloqueo2", "innerHTML", "El bloqueo debe de ser Si o No.");
        $error = true;
    }else{
        $respuesta->clear("errorBloqueo2", "innerHTML");
    }
    
    // Validamos el elmail.
    if (!validarEmail($email)) {
        $respuesta->assign("errorEmail2", "innerHTML", "La dirección de email no es válida.");
        $error = true;
    }else{
        $respuesta->clear("errorEmail2", "innerHTML");
    }

    // Si no existen errores.
    if (!$error) {

        // Insertamos el nuevo voluntario
        BD::insertarVoluntario($voluntario);
        
        $respuesta->setReturnValue(voluntariosTabla());
    }
     
    // Devolvemos el resultado.
    return $respuesta;  
}
/**
 * Función encargada de comprobar si los password coinciden.
 * 
 * @param type $pass1 El password uno.
 * @param type $pass2 El password dos.
 * @return boolean True o False.
 */
function validarPasswords($pass1, $pass2){
    if(strlen($pass1)){
        if($pass1 === $pass2){
            return true;
        }else{
            return false;
        }
    }
    
}

/**
 * Función encargada de validar el email de voluntario.
 * 
 * @param type $email El email.
 * @return type El formato de email.
 */
function validarEmail($email){
    return preg_match("/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i", $email);
}

/**
 * Función encargada de comprobar si se ha introducido Si o No en el bloqueo.
 * 
 * @param type $bloqueo El string con si o no
 * @return boolean True o false
 */
function validarBloqueo($bloqueo){
    if(strlen($bloqueo) == 2){
        if($bloqueo == "Si" || $bloqueo == "No"){
            return true;
        }else{
            return false;
        }
    }else{
        return false; 
    }
}
 
/**
 * Función encargada de validar el login del usuario.
 * 
 * @param type $login El login del voluntario
 * @return boolean True o False
 */
function validarNombre($login){
    if(strlen($login) > 0){
        return true;
    }else{
        return false;
    }
}

// Objeto de la clase xajax
$xajax = new xajax();

// Conjunto de funciones PHP del servidor que estarán disponibles para ser ejecutadas de forma asíncrona.

$xajax->register(XAJAX_FUNCTION, "voluntariosTabla");

$xajax->register(XAJAX_FUNCTION, "editaVoluntario");

$xajax->register(XAJAX_FUNCTION, "eliminaVoluntario");

$xajax->register(XAJAX_FUNCTION, "validarEdicionVoluntario");

$xajax->register(XAJAX_FUNCTION, "validarIngresoVoluntario");

// Configuración de la ruta de acceso a la carpeta xajax-js
$xajax->configure('javascript URI', 'include');

// Método encargado de procesaar las llamadas que reciba
$xajax->processRequest();