<?php
require (__DIR__ . '/../models/database.model.php');
include (__DIR__ . '/../dbconfig.php');

$connectionDB = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

$query_escuelas = "SELECT * FROM informacion_academica";
$data_escuelas = $connectionDB->getRows($query_escuelas);

$query_servicio = "SELECT * FROM servicio";
$data_servicio = $connectionDB->getRows($query_servicio);

$query_capacitacion = "SELECT * FROM capacitacion";
$data_capacitacion  = $connectionDB->getRows($query_capacitacion);


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id_enfermero = $_GET['id'];

    $query = "SELECT 
                dp.*, 
                ia.*,
                cap.*, 
                ctr.*, 
                dl.*,
                ctr.foto
                FROM datos_personal dp
                JOIN informacion_academica ia 
                ON dp.informacion_academica = ia.id
                JOIN capacitacion cap 
                ON dp.capacitacion = cap.id_capacitacion
                JOIN contrato ctr 
                ON dp.id_contrato = ctr.id_contrato
                JOIN dias_laborales dl 
                ON ctr.dias_laborables = dl.id_dias_laborables
                WHERE dp.id_enfermero = '$id_enfermero'";

    $AllData = $connectionDB->getRows($query);

    if (!empty($AllData)) {
        foreach ($AllData as $data) {
            $id_enfermero            = $data['id_enfermero'];
            $curp                    = $data['curp'];
            $apellidoPaterno         = $data['apellidoPaterno'];
            $apellidoMaterno         = $data['apellidoMaterno'];
            $nombre                  = $data['nombre'];
            $genero                  = $data['genero'];
            $onomastico              = $data['onomastico'];
            $edad                    = $data['edad'];
            $domicilio               = $data['domicilio'];
            $email                   = $data['email'];
            $telefono_personal       = $data['telefono_personal'];
            $RFC                     = $data['RFC'];
            $guarderia               = $data['guarderia'];
            $tiempo_guarderia        = $data['tiempo_guarderia'];
            $childrens_1             = $data['childrens_1'];
            $childrens_2             = $data['childrens_2'];
            $childrens_3             = $data['childrens_3'];
            $childrens_4             = $data['childrens_4'];
            $contacto_emergencia     = $data['contacto_emergencia'];
            $contacto                = $data['contacto'];
            $no_contacto_emergencia  = $data['no_contacto_emergencia'];
            $informacion_academica   = $data['informacion_academica'];
            $observaciones           = $data['observaciones'];
            $id_contrato             = $data['id_contrato'];
            $noempleado              = $data['noempleado'];
            $fechaIngreso            = $data['fechaIngreso'];
            $ayo_curso               = $data['ayo_curso'];
            $turno                   = $data['turno'];
            $id_dias_laborables      = $data['id_dias_laborables'];
            $lunes                   = $data['lunes'];
            $martes                  = $data['martes'];
            $miercoles               = $data['miercoles'];
            $jueves                  = $data['jueves'];
            $viernes                 = $data['viernes'];
            $sabado                  = $data['sabado'];
            $domingo                 = $data['domingo'];
            $servicio                = $data['servicio'];
            $horario_de              = $data['horario_de'];
            $horario_a               = $data['horario_a'];
            $foto                    = $data['foto']; // Ruta de la foto
            $id_capacitacion         = $data['id_capacitacion'];
            $interculturalidad       = $data['interculturalidad'];
            $fechaExpedicion_interculturalidad = $data['fechaExpedicion_interculturalidad'];
            $higienemanos                           = $data['higienemanos'];
            $fechaExpedicion_higienemanos           = $data['fechaExpedicion_higienemanos'];
            $residuoshospitalarios                  = $data['residuoshospitalarios'];
            $fechaExpedicion_residuoshospitalarios  = $data['fechaExpedicion_residuoshospitalarios'];
            $seguridadpaciente                      = $data['seguridadpaciente'];
            $fechaExpedicion_seguridadpaciente      = $data['fechaExpedicion_seguridadpaciente'];
            $cuidadopaliativo                       = $data['cuidadopaliativo'];
            $fechaExpedicion_cuidadopaliativo       = $data['fechaExpedicion_cuidadopaliativo'];
            $combateincendios                       = $data['combateincendios'];
            $fechaExpedicion_combateincendios       = $data['fechaExpedicion_combateincendios'];
            $evaluacioncalidad                      = $data['evaluacioncalidad'];
            $fechaExpedicion_evaluacioncalidad      = $data['fechaExpedicion_evaluacioncalidad'];
            $tratodigno                             = $data['tratodigno'];
            $fechaExpedicion_tratodigno             = $data['fechaExpedicion_tratodigno'];
            $reanimacion                            = $data['reanimacion'];
            $fechaExpedicion_reanimacion            = $data['fechaExpedicion_reanimacion'];
            $saludmental                            = $data['saludmental'];
            $fechaExpedicion_saludmental            = $data['fechaExpedicion_saludmental'];
            $emergenciasydesastres                  = $data['emergenciasydesastres'];
            $fechaExpedicion_emergenciasydesastres  = $data['fechaExpedicion_emergenciasydesastres'];
            $procesoslimpieza                       = $data['procesoslimpieza'];
            $fechaExpedicion_procesoslimpieza       = $data['fechaExpedicion_procesoslimpieza'];
        }
    }
}
?>