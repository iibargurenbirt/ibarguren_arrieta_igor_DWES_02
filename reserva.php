<?php
    require_once "usuarios_y_coches.php";
    session_start();

    var_dump($_POST);

    $ok = true;
    $datos_nok = [];

    if(isset($_POST['nombre']) && strlen($_POST['nombre'])>0){
        $nombre = $_POST['nombre'];
    }
    else{
        $nombre = "";
        $datos_nok['nombre'] = true;
        $ok = false;
    }

    if(isset($_POST['apellido']) && strlen($_POST['apellido'])>0){
        $apellido = $_POST['apellido'];
    }
    else{
        $apellido = "";
        $datos_nok['apellido'] = true;
        $ok = false;
    }

    if(isset($_POST['dni'])){
        if(comprobarDNI($_POST['dni']) && usuarioExiste($_POST['dni'])){
            $dni = $_POST['dni'];
        }
        else{
            $dni = $_POST['dni'];
            $datos_nok['dni'] = true;
            $ok = false;
        }
    }
    else{
        $dni = "";
        $datos_nok['dni'] = true;
        $ok = false;
    }


    
    if(isset($_POST['idVehiculo'])){
        if(comprobarDNI($_POST['dni'])){
            $idVehiculo = $_POST['idVehiculo'];
        }
        else{
            $idVehiculo = $_POST['idVehiculo'];
            $datos_nok['idVehiculo'] = true;
            $ok = false;
        }
    }
    else{
        $idVehiculo = "";
        $datos_nok['idVehiculo'] = true;
        $ok = false;
    }

    $vehiculo = buscarVehiculo($coches, $idVehiculo);



    if(!$vehiculo != null | !$vehiculo['disponible']){
        $datos_nok['idVehiculo'] = true;
        $ok = false;
    }

    if(isset($_POST['fInicio'])){
        if(esFechaCorrecta($_POST['fInicio'])){
            $fInicio = $_POST['fInicio'];
        }
        else{
            $fInicio = $_POST['fInicio'];
            $datos_nok['fInicio'] = true;
            $ok = false;
        }
    }
    else{
        $fInicio = "";
        $datos_nok['fInicio'] = true;
        $ok = false;
    }

    if(isset($_POST['nDias'])){
        $nDias = intval($_POST['nDias']);
        if(!($nDias > 0 && $nDias <= 30)){
            $nDias = intval($_POST['nDias']);
            $datos_nok['nDias'] = true;
            $ok = false;
        }
    }
    else{
        $nDias = intval($_POST['nDias']);
        $datos_nok['nDias'] = true;
        $ok = false;
    }
    

    if($ok){
        unset($_SESSION['datos_nok']);
        $_SESSION['nombre'] = $nombre.' '.$apellido;
        $_SESSION['idVehiculo'] = $idVehiculo;


        header("Location: reservaok.php");
    }
    else{
        $_SESSION['datos_nok'] = $datos_nok;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['apellido'] = $apellido;
        $_SESSION['dni'] = $dni;
        $_SESSION['vehiculo'] =  isset($vehiculo) ? $vehiculo['modelo'] : $idVehiculo;
        $_SESSION['fInicio'] = $nombre;
        $_SESSION['nDias'] = $nombre;
        
        header("Location: reservanok.php");
    }


    function comprobarDNI($dni){
        $letrasDNI = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E'];

        $numDNI = intval(substr($dni,0,8));
        $letraDNI = substr($dni,8);
        if(strlen($dni) != 9 || !is_int($numDNI) || is_int($letraDNI)){
            return false;
        }
        $moduloDNI = $numDNI % 23;
        return strcmp(strtoupper($letraDNI),$letrasDNI[$moduloDNI]) == 0;
    }

    function usuarioExiste($dni){
        foreach(USUARIOS as $usuario){
            if(strcmp($usuario['dni'],$dni) == 0){
                return true;
            }
        }
        return false;
    }

    function esFechaCorrecta($fecha){
        $manana = new DateTime('tomorrow');
        return new DateTime($fecha) >= $manana;
    }

    function buscarVehiculo($coches, $id){
        $vehiculoEncontrado = false;
        $vehiculo;
        $i = 0;
        $id = intval($id);

        while($i < count($coches) && !$vehiculoEncontrado){
            if($coches[$i]['id'] == $id){
                $vehiculoEncontrado = true;
                $vehiculo = $coches[$i];
                
            }
            $i++;
        }
        if(isset($vehiculo)){
            return $vehiculo;
        }
        else{
            return null;
        }
    }

    function reservarVehiculo($coches,$id,$fInicio,$nDias){
        $vehiculo = buscarVehiculo($coches,$id);

        $vehiculo['disponible'] = false;
        $vehiculo['fecha_inicio'] = $fInicio;
        $vehiculo['fecha_fin'] = date_add($fInicio, date_interval_create_from_date_string($nDias." days"));
    }