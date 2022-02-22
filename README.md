# Panel para manejo de bases de datos con PHP #

Para que este panel funcione con tu base de datos, primero tenés que asegurarte de realizar ciertas ***modificaciones***: 
* Crear una base de datos con el nombre ***123***, y agregarle una tabla llamada "usuarios"
* Crear las columnas de la tabla "usuarios", estas serán: id, usuario, pass, nombre, apellido, tipo_cuenta, mail, fecha_cuenta, numero, foto.
* Modificar la función conectar() del archivo "funciones.php" --> La línea 6 será $db = "***123***";
  * Este cambio aplica para aquellos que usamos localhost/phpmyadmin. Para otros casos, quizás haya que modificar más lineas de conectar().
* Hasta ahora vamos bien, ahora hay que aplicar correctamente su uso. 

___>>>___ __Uso de la Interfaz__ --> LA INTERFAZ TODAVÍA ESTÁ EN DESARROLLO.

*Si seguiste con las indicaciones de arriba, entonces ahora falta lo más importante: Crear una página que permita modificar la base de datos que necesitemos.*

>>> La INTERFAZ todavía está en DESARROLLO. Pronto será actualizada.
