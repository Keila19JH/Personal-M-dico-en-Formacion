<?php
require (__DIR__ . '/../models/database.model.php');
include (__DIR__ . '/../dbconfig.php');


$connectionDB = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id_enfermero = $_GET['id'];


    $query = 
    "SELECT 
        dp.*,
        ia.*,
        ctr.noempleado,
        ctr.fechaIngreso,
        ctr.ayo_curso,
        ctr.foto,
        ctr.turno,
        ctr.horario_de,
        ctr.horario_a,
        ctr.dias_laborables,
        dl.*,
        cap.*,
        s.servicio,
    IF(dp.fecha_baja = '0000-00-00', 'ACTIVO', dp.status_personal) AS status_personal_active
    FROM datos_personal dp
    JOIN informacion_academica ia 
        ON dp.informacion_academica = ia.id
    JOIN contrato ctr 
        ON dp.id_contrato = ctr.id_contrato
    JOIN dias_laborales dl 
        ON ctr.dias_laborables = dl.id_dias_laborables
    JOIN servicio s 
        ON ctr.servicio = s.id_servicio
    LEFT JOIN capacitacion cap
        ON dp.capacitacion = cap.id_capacitacion
    WHERE dp.id_enfermero ='$id_enfermero'";


    $AllData = $connectionDB->getRows($query);


    if (!empty($AllData)) {
        foreach ($AllData as $data) {

            $id_enfermero = $data['id_enfermero'];
            $curp = $data['curp'];
            $apellidoPaterno = $data['apellidoPaterno'];
            $apellidoMaterno = $data['apellidoMaterno'];
            $nombre = $data['nombre'];
            $genero = $data['genero'];
            $onomastico = $data['onomastico'];
            $edad = $data['edad'];
            $domicilio = $data['domicilio'];
            $email = $data['email'];
            $telefono_personal = $data['telefono_personal'];
            $RFC = $data['RFC'];
            $status_personal = $data['status_personal_active'];
            $contacto_emergencia = $data['contacto_emergencia'];
            $contacto = $data['contacto'];
            $no_contacto_emergencia = $data['no_contacto_emergencia'];
            $escuela_procedencia = $data['escuela_procedencia'];
            $observaciones = $data['observaciones']; 
            $noempleado = $data['noempleado'];
            $fechaIngreso = $data['fechaIngreso'];
            $ayo_curso = $data['ayo_curso'];
            $turno = $data['turno'];
            $dias = [
                $data['lunes'],
                $data['martes'],
                $data['miercoles'],
                $data['jueves'],
                $data['viernes'],
                $data['sabado'],
                $data['domingo']
            ];
            $diasLaborales = implode(', ', array_filter($dias));
            $servicio = $data['servicio'];
            $horario_de = $data['horario_de'];
            $horario_a = $data['horario_a'];
            $foto = $data['foto'];
            
        }
    }
}

?>