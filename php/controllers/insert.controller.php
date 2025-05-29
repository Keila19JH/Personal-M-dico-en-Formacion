<?php
header('Content-Type: application/json; charset=utf-8');

require (__DIR__ . '/../models/database.model.php');
include (__DIR__ . '/../dbconfig.php');

$connectionDB = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

$response = [
    'status'  => 'error',
    'message' => 'No se ejecutó la petición POST'
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $Tables = [
        'informacion_academica' => 'informacion_academica',
        'dias_laborales'        => 'dias_laborales',
        'servicio'              => 'servicio',
        'capacitacion'          => 'capacitacion',
        'datos_personal'        => 'datos_personal',
        'contrato'              => 'contrato',
    ];

    // Manejo de archivo
    $foto_nombre   = $_FILES['foto']['name']     ?? '';
    $foto_tmp_name = $_FILES['foto']['tmp_name'] ?? '';
    $ruta_final    = "uploads/{$foto_nombre}";
    $ruta_final_2  = "../../uploads/{$foto_nombre}";

    if (!move_uploaded_file($foto_tmp_name, $ruta_final_2)) {
        echo json_encode([
            'status'  => 'error',
            'step'    => 'upload',
            'message' => 'Error al subir la foto'
        ]);
        exit;
    } 

    // 1. insertar dias_laborales
    $Data_dias_laborales = [
        'lunes'     => $_POST['lunes']     ?? '',
        'martes'    => $_POST['martes']    ?? '',
        'miercoles' => $_POST['miercoles'] ?? '',
        'jueves'    => $_POST['jueves']    ?? '',
        'viernes'   => $_POST['viernes']   ?? '',
        'sabado'    => $_POST['sabado']    ?? '',
        'domingo'   => $_POST['domingo']   ?? ''
    ];

    foreach ($Data_dias_laborales as $key => $value) {
        $Data_dias_laborales[$key] = $connectionDB->escapeString($value);
    }

    $Result_dias_laborales = $connectionDB->insertData($Tables['dias_laborales'], $Data_dias_laborales);

    if (!is_numeric($Result_dias_laborales)) {
        echo json_encode([
            'status'  => 'error',
            'step'    => 'dias_laborales',
            'message' => "Error al insertar en dias_laborales: $Result_dias_laborales"
        ]);
        exit;
    }

   

    // 3. Inserción en servicio
    if (!empty($_POST['Servicio'])) {
        $Result_servicio = intval($_POST['Servicio']);
    } else {
        $Result_servicio = null; 
    }

    // 4. Inserción en datos_personal
    if (empty($_POST['curp']) || empty($_POST['nombre'])) {
        echo json_encode([
            'status'  => 'error',
            'step'    => 'datos_personal',
            'message' => 'Faltan campos obligatorios en datos_personal'
        ]);
        exit;
    }

    // 5. Inserción en capacitación
    $Data_capacitacion = [
        'interculturalidad'                     => $_POST['interculturalidad'] ?? '',
        'fechaExpedicion_interculturalidad'     => $_POST['fechaExpedicion_interculturalidad'] ?? '',
        'higienemanos'                          => $_POST['higienemanos'] ?? '',
        'fechaExpedicion_higienemanos'          => $_POST['fechaExpedicion_higienemanos'] ?? '',
        'residuoshospitalarios'                 => $_POST['residuoshospitalarios'] ?? '',
        'fechaExpedicion_residuoshospitalarios' => $_POST['fechaExpedicion_residuoshospitalarios'] ?? '',
        'seguridadpaciente'                     => $_POST['seguridadpaciente'] ?? '',
        'fechaExpedicion_seguridadpaciente'     => $_POST['fechaExpedicion_seguridadpaciente'] ?? '',
        'cuidadopaliativo'                      => $_POST['cuidadopaliativo'] ?? '',
        'fechaExpedicion_cuidadopaliativo'      => $_POST['fechaExpedicion_cuidadopaliativo'] ?? '',
        'combateincendios'                      => $_POST['combateincendios'] ?? '',
        'fechaExpedicion_combateincendios'      => $_POST['fechaExpedicion_combateincendios'] ?? '',
        'evaluacioncalidad'                     => $_POST['evaluacioncalidad'] ?? '',
        'fechaExpedicion_evaluacioncalidad'     => $_POST['fechaExpedicion_evaluacioncalidad'] ?? '',
        'tratodigno'                            => $_POST['tratodigno'] ?? '',
        'fechaExpedicion_tratodigno'            => $_POST['fechaExpedicion_tratodigno'] ?? '',
        'reanimacion'                           => $_POST['reanimacion'] ?? '',
        'fechaExpedicion_reanimacion'           => $_POST['fechaExpedicion_reanimacion'] ?? '',
        'saludmental'                           => $_POST['saludmental'] ?? '',
        'fechaExpedicion_saludmental'           => $_POST['fechaExpedicion_saludmental'] ?? '',
        'emergenciasydesastres'                 => $_POST['emergenciasydesastres'] ?? '',
        'fechaExpedicion_emergenciasydesastres' => $_POST['fechaExpedicion_emergenciasydesastres'] ?? '',
        'procesoslimpieza'                      => $_POST['procesoslimpieza'] ?? '',
        'fechaExpedicion_procesoslimpieza'      => $_POST['fechaExpedicion_procesoslimpieza'] ?? ''
    ];

    foreach ($Data_capacitacion as $key => $value) {
        $Data_capacitacion[$key] = $connectionDB->escapeString($value);
    }
    $Result_capacitacion = $connectionDB->insertData($Tables['capacitacion'], $Data_capacitacion);

    if (!is_numeric($Result_capacitacion)) {
        echo json_encode([
            'status'  => 'error',
            'step'    => 'capacitacion',
            'message' => "Error al insertar en capacitacion: $Result_capacitacion"
        ]);
        exit;
    }

    // 6. Inserción en contrato
    $Data_contrato = array(
        'noempleado'      => $_POST['noempleado']   ?? '',
        'fechaIngreso'    => $_POST['fechaIngreso'] ?? '',
        'ayo_curso'       => $_POST['ayo_curso']    ?? '',
        'turno'           => $_POST['turno']        ?? '',
        'dias_laborables' => $Result_dias_laborales,
        'servicio'        => $Result_servicio,
        'horario_de'      => $_POST['horario_de']   ?? '',
        'horario_a'       => $_POST['horario_a']    ?? '',
        'foto'            => $ruta_final
    );

    foreach ($Data_contrato as $key => $value) {
        $Data_contrato[$key] = $connectionDB->escapeString($value);
    }
    $Result_contrato = $connectionDB->insertData($Tables['contrato'], $Data_contrato);

    if (!is_numeric($Result_contrato)) {
        echo json_encode([
            'status'  => 'error',
            'step'    => 'contrato',
            'message' => "Error al insertar en contrato: $Result_contrato"
        ]);
        exit;
    }

    // 7. Inserción en tabla datos_personal
    $Data_personal = [
        'curp'                   => $_POST['curp'],
        'apellidoPaterno'        => $_POST['apellidoPaterno']    ?? '',
        'apellidoMaterno'        => $_POST['apellidoMaterno']    ?? '',
        'nombre'                 => $_POST['nombre'],
        'genero'                 => $_POST['genero']             ?? '',
        'onomastico'             => $_POST['onomastico']         ?? '',
        'edad'                   => $_POST['edad']               ?? '',
        'domicilio'              => $_POST['domicilio']          ?? '',
        'email'                  => $_POST['email']              ?? '',
        'telefono_personal'      => $_POST['telefono_personal']  ?? '',
        'RFC'                    => $_POST['RFC']                ?? '',
        'guarderia'              => $_POST['guarderia']          ?? '',
        'tiempo_guarderia'       => $_POST['tiempo_guarderia']   ?? '',
        'childrens_1'            => $_POST['childrens_1']        ?? '',
        'childrens_2'            => $_POST['childrens_2']        ?? '',
        'childrens_3'            => $_POST['childrens_3']        ?? '',
        'childrens_4'            => $_POST['childrens_4']        ?? '',
        'contacto_emergencia'    => $_POST['contacto_emergencia'] ?? '',
        'contacto'               => $_POST['contacto']            ?? '',
        'no_contacto_emergencia' => $_POST['no_contacto_emergencia'] ?? '',
        'informacion_academica'  => $_POST['informacion_academica'] ?? '',
        'observaciones'          => $_POST['observaciones']       ?? '',
        'capacitacion'           => $Result_capacitacion,
        'id_contrato'            => $Result_contrato,
        'status_personal'        => 'ACTIVO',
        'fecha_baja'             => null
    ];
    
    foreach ($Data_personal as $key => $value) {
        $Data_personal[$key] = $connectionDB->escapeString($value);
    }
    $Result_datos_personal = $connectionDB->insertData($Tables['datos_personal'], $Data_personal);

    if (!is_numeric($Result_datos_personal)) {
        echo json_encode([
            'status'  => 'error',
            'step'    => 'datos_personal',
            'message' => "Error al insertar en datos_personal: $Result_datos_personal"
        ]);
        exit;
    }

    $response = [
        'status'  => 'success',
        'message' => 'Información enviada correctamente'
    ];
}

echo json_encode($response);
exit;
?>