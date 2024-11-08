<?php
    session_start();
    //var_dump($_SESSION['datos_nok']);
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
        .ok{
            color: green;
        }
        .nok{
            color: red;
        }
        </style>
    </head>
    <body>
        <h1>Reserva valida</h1>
        <span>Nombre: <?=$_SESSION['nombre']?></span><br>
        <img src="img/<?=$_SESSION['idVehiculo']?>.jpg"></img>
        <a href="index.php">Volver</a>
    </body>
</html>