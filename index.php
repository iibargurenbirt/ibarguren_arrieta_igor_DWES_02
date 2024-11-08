<?php
    require_once "usuarios_y_coches.php";
    session_start();
?>
<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <form action="reserva.php" method="post">
            Nombre: <input type="text" name="nombre"/><br>
            Apellido: <input type="text" name="apellido"/><br>
            DNI: <input type="text" name="dni"/><br>
            Modelo: <select name="idVehiculo">
                <?php
                    foreach ($coches as $coche){
                        echo '<option value="'.$coche['id'].'">'.$coche['modelo'].'</option>';
                    }
                    ?>
            </select><br>
            Fecha de Inicio: <input type="date" name="fInicio"/><br>
            Número de días: <input type="text" name="nDias"/><br>
            <input type="submit" value="Reservar"/>
        </form>
    </body>
</html>
