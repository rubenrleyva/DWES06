# DWES06
Desarrollo Web Entorno Servidor: Tarea 6

En la página principal de la aplicación (index.php) se debe visualizar el contenido de la tabla voluntarios de la base de datos.

Todas las acciones que se enumeran a continuación deben ser realizadas en esta misma página (independientemente de que se creen otras para funciones, clases, etc). Las funciones javascript deben estar en un fichero llamado funciones.js.

La página mostrará la consulta de la tabla voluntarios obteniendo todos los datos de la misma. La lista de voluntarios se visualizará en una tabla de 6 columnas, una para cada uno de los 4 campos de ésta (login, password, email, bloqueado), una quinta columna que tenga un botón para modificar (botón o imagen) y la sexta para borrar.
Al pinchar en modificar se deben cargar los datos editables (correspondientes a esa fila) en un formulario que previamente estaba oculto (en la misma página, debajo de la tabla). Al pulsar sobre el botón del formulario se actualizarán los datos de la clase en la base de datos y en la lista, y se ocultará el formulario.
Al pinchar en eliminar se deberá eliminar la fila seleccionada de la tabla. La eliminación debe realizarse mediante AJAX. Antes de realizar la eliminación completa se pedirá confirmación al usuario mediante una ventana emergente. Una vez realizada la eliminación de un elemento, la tabla deberá actualizarse sin que la página deba recargarse completamente.
Implementar la opción de insertar nuevos registros (utilizando AJAX) usando un formulario oculto como se solicita con la opción de modificar. Una vez realizada la inserción de un elemento, la tabla deberá actualizarse sin que la página deba recargarse completamente. Recordad que tanto para modificar, como para insertar, previamente debéis validar los campos, mostrando errores en caso de que sea necesario. La contraseña deberá ser de tipo password (****) y deberá haber un segundo campo de confirmación de contraseña (tal y como hemos visto en anteriores tareas).
Deberás emplear la clase DB (para los accesos a base de datos) y la clase voluntario, tal y como vimos en unidades anteriores.
Las librerías utilizadas para la tarea deben incluirse dentro del propio proyecto, en una carpeta llamada include, y hacerse referencia a esta ruta (Rutas relativas).
