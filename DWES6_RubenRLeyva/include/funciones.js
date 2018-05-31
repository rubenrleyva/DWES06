/* 
 * DWES6- Aplicaciones web dinámicas: PHP y Javascript
 * Tarea 6: Voluntarios 3
 * Autor: Rubén Ángel Rodriguez Leyva
 */

/**
 * Función encargada de mostrar los voluntarios.
 */
function muestraVoluntarios(){
    xajax_voluntariosTabla();
}

/**
 * Función encargada de mostrar un voluntario según su login.
 * @param {type} login El login del voluntario.
 */
function mostrarVoluntario(login){
    document.getElementById('edicion').style.display = 'block';
    document.getElementById('nuevo').style.display = 'none';
    xajax_editaVoluntario(login);
}

/**
 * Función encargada de cancelar la edición o la introducción de un nuevo voluntario.
 */
function cancelarEdicionVoluntario(){
    document.getElementById('edicion').style.display = 'none';
}

/**
 * Función encargada de eliminar al voluntario según su login.
 * @param {type} login El login del voluntario.
 */
function eliminarVoluntario(login){
    if(confirm('¿Estás seguro de querer eliminar al voluntario de nombre: '+login+'?')){
        xajax_eliminaVoluntario(login);
        muestraVoluntarios();
    }
}

/**
 * Función encargada de editar el voluntario.
 */
function editarVoluntario(){
    
    var respuesta = xajax.request({xjxfun:"validarEdicionVoluntario"}, {mode:'synchronous', parameters: [xajax.getFormValues("modificarvoluntario")]});

    if(respuesta){
        alert('Usuario modificado con éxito.');
        cancelarEdicionVoluntario();
    }else{
        alert('No se ha modificado el usuario.');
    }
    
    muestraVoluntarios();
}

/**
 * Función encargada de expandir el formulario para el nuevo voluntario.
 */
function nuevoVoluntario(){
    document.getElementById('nuevo').style.display = 'block';
    document.getElementById('edicion').style.display = 'none';
    document.getElementById('botonnuevo').style.display = 'none';
    xajax_ingresarVoluntario();
}

/**
 * Función encargada de cancelar la introducción de un nuevo voluntario.
 */
function cancelarNuevoVoluntario(){
    document.getElementById('nuevo').style.display = 'none';
    document.getElementById('botonnuevo').style.display = 'block';
}

/**
 * Función encargada de ingresar un nuevo voluntario.
 */
function ingresarVoluntario(){
    
    var respuesta = xajax.request({xjxfun:"validarIngresoVoluntario"}, {mode:'synchronous', parameters: [xajax.getFormValues("nuevovoluntario")]});

    if(respuesta){
        alert('Se ha ingresado un nuevo voluntario con exito.');
        cancelarNuevoVoluntario();
    }else{
        alert('No se ha podido ingresar el nuevo voluntario con exito.');
    }
    
    muestraVoluntarios();
}