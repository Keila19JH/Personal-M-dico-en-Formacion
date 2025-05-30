<?php
require (__DIR__ . '/../models/database.model.php');
include (__DIR__ . '/../dbconfig.php');


$connectionDB = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id_enfermero = $_GET['id'];


    $query = 
    "SELECT 
        dp.id_enfermero,
        dp.curp,
        dp.apellidoPaterno,
        dp.apellidoMaterno,
        dp.nombre,
        dp.genero,
        dp.onomastico,
        dp.edad,
        dp.domicilio,
        dp.email,
        dp.telefono_personal,
        dp.RFC,
        dp.guarderia,
        dp.tiempo_guarderia,
        dp.childrens_1,
        dp.childrens_2,
        dp.childrens_3,
        dp.childrens_4,
        dp.contacto_emergencia,
        dp.contacto,
        dp.no_contacto_emergencia,
        ia.escuela_procedencia,
        dp.observaciones,
        dp.fecha_baja,
        IF(dp.fecha_baja = '0000-00-00', 'ACTIVO', dp.status_personal) AS status_personal_active,
        ctr.noempleado,
        ctr.fechaIngreso,
        ctr.ayo_curso,
        ctr.foto,
        ctr.turno,
        ctr.horario_de,
        ctr.horario_a,
        dl.lunes,
        dl.martes,
        dl.miercoles,
        dl.jueves,
        dl.viernes,
        dl.sabado,
        dl.domingo,
        s.servicio,
        cap.interculturalidad,
        cap.fechaExpedicion_interculturalidad,
        cap.higienemanos,
        cap.fechaExpedicion_higienemanos,
        cap.residuoshospitalarios,
        cap.fechaExpedicion_residuoshospitalarios,
        cap.seguridadpaciente,
        cap.fechaExpedicion_seguridadpaciente,
        cap.cuidadopaliativo,
        cap.fechaExpedicion_cuidadopaliativo,
        cap.combateincendios,
        cap.fechaExpedicion_combateincendios,
        cap.evaluacioncalidad,
        cap.fechaExpedicion_evaluacioncalidad,
        cap.tratodigno,
        cap.fechaExpedicion_tratodigno,
        cap.reanimacion,
        cap.fechaExpedicion_reanimacion,
        cap.saludmental,
        cap.fechaExpedicion_saludmental,
        cap.emergenciasydesastres,
        cap.fechaExpedicion_emergenciasydesastres,
        cap.procesoslimpieza,
        cap.fechaExpedicion_procesoslimpieza
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
    WHERE dp.id_enfermero = '$id_enfermero'";


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
            $guarderia = $data['guarderia'];
            $tiempo_guarderia = $data['tiempo_guarderia'];
            $childrens_1 = $data['childrens_1'];
            $childrens_2 = $data['childrens_2'];
            $childrens_3 = $data['childrens_3'];
            $childrens_4 = $data['childrens_4'];
            $interculturalidad = $data['interculturalidad'];
            $fechaExpedicion_interculturalidad = $data['fechaExpedicion_interculturalidad'];
            $higienemanos = $data['higienemanos'];
            $fechaExpedicion_higienemanos = $data['fechaExpedicion_higienemanos'];
            $residuoshospitalarios = $data['residuoshospitalarios'];
            $fechaExpedicion_residuoshospitalarios = $data['fechaExpedicion_residuoshospitalarios'];
            $seguridadpaciente = $data['seguridadpaciente'];
            $fechaExpedicion_seguridadpaciente = $data['fechaExpedicion_seguridadpaciente'];
            $cuidadopaliativo = $data['cuidadopaliativo'];
            $fechaExpedicion_cuidadopaliativo = $data['fechaExpedicion_cuidadopaliativo'];
            $combateincendios = $data['combateincendios'];
            $fechaExpedicion_combateincendios = $data['fechaExpedicion_combateincendios'];
            $evaluacioncalidad = $data['evaluacioncalidad'];
            $fechaExpedicion_evaluacioncalidad = $data['fechaExpedicion_evaluacioncalidad'];
            $tratodigno = $data['tratodigno'];
            $fechaExpedicion_tratodigno = $data['fechaExpedicion_tratodigno'];
            $reanimacion = $data['reanimacion'];
            $fechaExpedicion_reanimacion = $data['fechaExpedicion_reanimacion'];
            $saludmental = $data['saludmental'];
            $fechaExpedicion_saludmental = $data['fechaExpedicion_saludmental'];
            $emergenciasydesastres = $data['emergenciasydesastres'];
            $fechaExpedicion_emergenciasydesastres = $data['fechaExpedicion_emergenciasydesastres'];
            $procesoslimpieza = $data['procesoslimpieza'];
            $fechaExpedicion_procesoslimpieza = $data['fechaExpedicion_procesoslimpieza'];
        }
    }
}

?>