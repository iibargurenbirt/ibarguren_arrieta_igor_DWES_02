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
        <h1>Reserva NO valida</h1>
        <span class="<?=isset($_SESSION['datos_nok']['nombre'])? "nok" : "ok"?>">Nombre: <?=$_SESSION['nombre']?></span><br>
        <span class="<?=isset($_SESSION['datos_nok']['apellido'])? "nok" : "ok"?>">Apellidos: <?=$_SESSION['apellido']?></span><br>
        <span class="<?=isset($_SESSION['datos_nok']['dni'])? "nok" : "ok"?>">DNI: <?=$_SESSION['dni']?></span><br>
        <span class="<?=isset($_SESSION['datos_nok']['idVehiculo'])? "nok" : "ok"?>">Vehículo: <?=$_SESSION['vehiculo']?></span><br>
        <span class="<?=isset($_SESSION['datos_nok']['fInicio'])? "nok" : "ok"?>">Fecha de Inicio: <?=$_SESSION['fInicio']?></span><br>
        <span class="<?=isset($_SESSION['datos_nok']['nDias'])? "nok" : "ok"?>">Número de días: <?=$_SESSION['nDias']?></span><br>
        <a href="index.php">Volver</a>
    </body>
</html>