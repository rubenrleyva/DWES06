<?php

/* 
 * DWES6- Aplicaciones web dinámicas: PHP y Javascript
 * Tarea 6: Voluntarios 3
 * Autor: Rubén Ángel Rodriguez Leyva
 */

// Archivos requeridos
require_once("./include/funciones.php");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>DWES 6 - Aplicaciones web dinámicas: PHP y JavaScript</title>
    
    <?php 
    // Código propio javascript
    $xajax->printJavascript();
    ?>
    
    <script type="text/javascript" src="include/funciones.js"></script>
</head>

<body>
    <header>
        <h1 align="center">DWES 6 - Voluntarios 3</h1>
    </header>
    
    <div id="voluntarios">
        <script type="text/javascript">muestraVoluntarios();</script>
    </div>
    
    <div id='edicion' style="display: none">
        </br>
        <form id="modificarvoluntario" action="javascript:void(null);" onsubmit="editarVoluntario();">
            <fieldset >
                <legend align="center">Modificar Voluntario</legend>
                <div align="center">
                    <span id="errorLogin1" class="error" for="usuario" style="color: red"></span></br>
                    <label for='usuario' >Usuario:</label><br/>
                    <input type='text' name='usuario' id='usuario' readonly maxlength="50" /><br/>
                    <span id="errorPassword1" class="error" for="password" style="color: red"></span></br>
                    <label for='password' >Contraseña:</label><br/>
                    <input type='password' name='password' id='password' readonly maxlength="50" /><br/>
                    <span id="errorPasswordRepe1" class="error" for="passwordRepe" style="color: red"></span></br>
                    <label for='passwordRepe' >Repetir Contraseña:</label><br/>
                    <input type='password' name='passwordRepe' id='passwordRepe' readonly maxlength="50" /><br/>
                    <span id="errorEmail1" class="error" for="email" style="color: red"></span></br>
                    <label for='email' >Email:</label><br/>
                    <input type='email' name='email' id='email' value='' maxlength="50" /><br/>               
                    <span id="errorBloqueo1" class="error" for="bloqueo" style="color: red"></span></br>
                    <label for='bloqueo' >¿Bloqueado?</label><br/>
                    <input type='text' name='bloqueo' id='bloqueo' maxlength="2" /><br/><br/>    
                    <input type='submit' name='guardar' value='Guardar' /><input type='button' onclick="cancelarEdicionVoluntario();" value='Cancelar' />
                </div>
            </fieldset>
        </form>
    </div>
    
    <div id='nuevo' style="display: none">
        </br>
        <form id="nuevovoluntario" action="javascript:void(null);" onsubmit="ingresarVoluntario();">
            <fieldset >
                <legend align="center">Nuevo Voluntario</legend>
                <div align="center">
                    <span id="errorLogin2" class="error" for="usuario" style="color: red"></span></br>
                    <label for='usuario' >Usuario:</label><br/>
                    <input type='text' name='usuario' id='usuario' maxlength="50" /><br/>
                    <span id="errorPassword2" class="error" for="password" style="color: red"></span></br>
                    <label for='password' >Contraseña:</label><br/>
                    <input type='password' name='password' id='password' maxlength="50" /><br/>
                    <span id="errorPasswordRepe2" class="error" for="passwordRepe" style="color: red"></span></br>
                    <label for='passwordRepe' >Repetir Contraseña:</label><br/>
                    <input type='password' name='passwordRepe' id='passwordRepe' maxlength="50" /><br/>
                    <span id="errorEmail2" class="error" for="email" style="color: red"></span></br>
                    <label for='email' >Email:</label><br/>
                    <input type='email' name='email' id='email' value='' maxlength="50" /><br/>               
                    <span id="errorBloqueo2" class="error" for="bloqueo" style="color: red"></span></br>
                    <label for='bloqueo' >¿Bloqueado?</label><br/>
                    <input type='text' name='bloqueo' id='bloqueo' maxlength="2" readonly value="Si"/><br/><br/>      
                    <input type='submit' name='guardar' value='Guardar' /><input type='button' onclick="cancelarNuevoVoluntario();" value='Cancelar' />
                </div>
            </fieldset>
        </form>
    </div>
    
    <div id="nuevovoluntario" align="center">
        </br>
        <input type='button' id="botonnuevo" onclick="nuevoVoluntario();" value='Nuevo Voluntario' />
    </div>
    
    <footer>
        <h2 align="center">Rubén Ángel Rodriguez Leyva</h2>
    </footer>
</body>
</html>