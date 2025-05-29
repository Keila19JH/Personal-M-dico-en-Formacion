<?php
header('Content-Type: application/json; charset=utf-8');

require(__DIR__ . '/../models/database.model.php');
include(__DIR__ . '/../dbconfig.php');

$connectionDB = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

$response = [
    'status'  => 'error',
    'message' => 'No se ejecutó la petición POST'
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Validar IDs necesarios para las actualizaciones
    $requiredIds = [
        'id_enfermero'              => $_POST['id_enfermero'],
        'id_informacion_academica'  => $_POST['informacion_academica'],
        'id_dias_laborables'        => $_POST['id_dias_laborables'],
        'id_capacitacion'           => $_POST['id_capacitacion'],
        'id_contrato'               => $_POST['id_contrato'],
        'id_servicio'               => $_POST['Servicio']
    ];

    // Validar que todos los IDs sean numéricos
    foreach ($requiredIds as $key => $value) {
        if (!is_numeric($value)) {
            echo json_encode([
                'status' => 'error',
                'message' => "ID inválido para $key"
            ]);
            exit;
        }
    }
    // file_put_contents('debug.log', "Llegó a validación de IDs\n", FILE_APPEND);

     // Definimos rutas unificadas
    $uploadDirServer = __DIR__ . '/../../uploads/';  // ruta absoluta en el servidor
    $uploadDirWeb    = 'uploads/';                  // ruta pública para el HTML

    $fotoData = [];
    if (!empty($_FILES['foto']['name'])) {
        // Nombre limpio del archivo
        $fotoNombre = basename($_FILES['foto']['name']);

        // Ruta del servidor donde va a almacenarse el fichero
        $serverPath = $uploadDirServer . $fotoNombre;

        // Ruta pública que guardaremos en la BD (igual que en insert.controller.php)
        $publicPath = $uploadDirWeb . $fotoNombre;

        // Movemos el archivo
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $serverPath)) {
            // Lo mismo que haces en insert: guardamos la ruta relativa
            $fotoData['foto'] = $publicPath;
        } else {
            echo json_encode([
                'status'  => 'error',
                'step'    => 'upload',
                'message' => 'Error al subir la foto'
            ]);
            exit;
        }
    }
    // file_put_contents('debug.log', "Llegó a subida de foto\n\n", FILE_APPEND);

    // 1. Actualizar dias_laborales
    $Data_dias_laborales = [
        'lunes'     => $_POST['lunes'] ?? '',
        'martes'    => $_POST['martes'] ?? '',
        'miercoles' => $_POST['miercoles'] ?? '',
        'jueves'    => $_POST['jueves'] ?? '',
        'viernes'   => $_POST['viernes'] ?? '',
        'sabado'    => $_POST['sabado'] ?? '',
        'domingo'   => $_POST['domingo'] ?? ''
    ];

    $Result_dias_laborales = $connectionDB->updateData(
        'dias_laborales',
        $Data_dias_laborales,
        'id_dias_laborables',
        $requiredIds['id_dias_laborables']
    );

    if (!is_numeric($Result_dias_laborales)) {
        echo json_encode([
            'status'  => 'error',
            'step'    => 'dias_laborales',
            'message' => "Error al actualizar días laborales: $Result_dias_laborales"
        ]);
        exit;
    }
    // file_put_contents('debug.log', "Actualizó dias_laborales\n", FILE_APPEND);
    
    // 3. Actualizar servicio
    $servicioValue = !empty($_POST['Servicio']) ? intval($_POST['Servicio']) : null;
    
    // file_put_contents('debug.log', "Actualizó en servicio\n", FILE_APPEND);


    // 4. Actualizar capacitacion
    $interculturalidad                      = $_POST['interculturalidad'] ?? '';
    $fechaExpedicion_interculturalidad      = $_POST['fechaExpedicion_interculturalidad'] ?? '';
    $higienemanos                           = $_POST['higienemanos'] ?? '';
    $fechaExpedicion_higienemanos           = $_POST['fechaExpedicion_higienemanos'] ?? '';
    $residuoshospitalarios                  = $_POST['residuoshospitalarios'] ?? '';
    $fechaExpedicion_residuoshospitalarios  = $_POST['fechaExpedicion_residuoshospitalarios'] ?? '';
    $seguridadpaciente                      = $_POST['seguridadpaciente'] ?? '';
    $fechaExpedicion_seguridadpaciente      = $_POST['fechaExpedicion_seguridadpaciente'] ?? '';
    $cuidadopaliativo                       = $_POST['cuidadopaliativo'] ?? '';
    $fechaExpedicion_cuidadopaliativo       = $_POST['fechaExpedicion_cuidadopaliativo'] ?? '';
    $combateincendios                       = $_POST['combateincendios'] ?? '';
    $fechaExpedicion_combateincendios       = $_POST['fechaExpedicion_combateincendios'] ?? '';
    $evaluacioncalidad                      = $_POST['evaluacioncalidad'] ?? '';
    $fechaExpedicion_evaluacioncalidad      = $_POST['fechaExpedicion_evaluacioncalidad'] ?? '';
    $tratodigno                             = $_POST['tratodigno'] ?? '';
    $fechaExpedicion_tratodigno             = $_POST['fechaExpedicion_tratodigno'] ?? '';
    $reanimacion                            = $_POST['reanimacion'] ?? '';
    $fechaExpedicion_reanimacion            = $_POST['fechaExpedicion_reanimacion'] ?? '';
    $saludmental                            = $_POST['saludmental'] ?? '';
    $fechaExpedicion_saludmental            = $_POST['fechaExpedicion_saludmental'] ?? '';
    $emergenciasydesastres                  = $_POST['emergenciasydesastres'] ?? '';
    $fechaExpedicion_emergenciasydesastres  = $_POST['fechaExpedicion_emergenciasydesastres'] ?? '';
    $procesoslimpieza                       = $_POST['procesoslimpieza'] ?? '';
    $fechaExpedicion_procesoslimpieza       = $_POST['fechaExpedicion_procesoslimpieza'] ?? '';


    if ( $interculturalidad === 'No' ) {
        $fechaExpedicion_interculturalidad = '';
    }

    if ($higienemanos === 'No') {
    $fechaExpedicion_higienemanos = '';
    }

    if ($residuoshospitalarios === 'No') {
        $fechaExpedicion_residuoshospitalarios = '';
    }

    if ($seguridadpaciente === 'No') {
        $fechaExpedicion_seguridadpaciente = '';
    }

    if ($cuidadopaliativo === 'No') {
        $fechaExpedicion_cuidadopaliativo = '';
    }

    if ($combateincendios === 'No') {
        $fechaExpedicion_combateincendios = '';
    }

    if ($evaluacioncalidad === 'No') {
        $fechaExpedicion_evaluacioncalidad = '';
    }

    if ($tratodigno === 'No') {
        $fechaExpedicion_tratodigno = '';
    }

    if ($reanimacion === 'No') {
        $fechaExpedicion_reanimacion = '';
    }

    if ($saludmental === 'No') {
        $fechaExpedicion_saludmental = '';
    }

    if ($emergenciasydesastres === 'No') {
        $fechaExpedicion_emergenciasydesastres = '';
    }

    if ($procesoslimpieza === 'No') {
        $fechaExpedicion_procesoslimpieza = '';
    }

    $Data_capacitacion = [
        'interculturalidad'                     => $interculturalidad,
        'fechaExpedicion_interculturalidad'     => $fechaExpedicion_interculturalidad,
        'higienemanos'                          => $higienemanos,
        'fechaExpedicion_higienemanos'          => $fechaExpedicion_higienemanos,
        'residuoshospitalarios'                 => $residuoshospitalarios,
        'fechaExpedicion_residuoshospitalarios' => $fechaExpedicion_residuoshospitalarios,
        'seguridadpaciente'                     => $seguridadpaciente,
        'fechaExpedicion_seguridadpaciente'     => $fechaExpedicion_seguridadpaciente,
        'cuidadopaliativo'                      => $cuidadopaliativo,
        'fechaExpedicion_cuidadopaliativo'      => $fechaExpedicion_cuidadopaliativo,
        'combateincendios'                      => $combateincendios,
        'fechaExpedicion_combateincendios'      => $fechaExpedicion_combateincendios,
        'evaluacioncalidad'                     => $evaluacioncalidad,
        'fechaExpedicion_evaluacioncalidad'     => $fechaExpedicion_evaluacioncalidad,
        'tratodigno'                            => $tratodigno,
        'fechaExpedicion_tratodigno'            => $fechaExpedicion_tratodigno,
        'reanimacion'                           => $reanimacion,
        'fechaExpedicion_reanimacion'           => $fechaExpedicion_reanimacion,
        'saludmental'                           => $saludmental,
        'fechaExpedicion_saludmental'           => $fechaExpedicion_saludmental,
        'emergenciasydesastres'                 => $emergenciasydesastres,
        'fechaExpedicion_emergenciasydesastres' => $fechaExpedicion_emergenciasydesastres,
        'procesoslimpieza'                      => $procesoslimpieza,
        'fechaExpedicion_procesoslimpieza'      => $fechaExpedicion_procesoslimpieza
    ];

    $Result_capacitacion = $connectionDB->updateData(
        'capacitacion',
        $Data_capacitacion,
        'id_capacitacion',
        $requiredIds['id_capacitacion']
    );

    if (!is_numeric($Result_capacitacion)){
        echo json_encode([
            'status' => 'error',
            'step'   => 'capacitacion',
            'message' => "Error al actualizar capacitación: $Result_capacitacion"
        ]);
        exit;
    }
    // file_put_contents('debug.log', "Actualizó capacitacion\n", FILE_APPEND);



    // 5. Actualizar contrato (incluye foto si se subió)
    $Data_contrato = [
        'noempleado'      => $_POST['noempleado'] ?? '',
        'fechaIngreso'    => $_POST['fechaIngreso'] ?? '',
        'ayo_curso'       => $_POST['ayo_curso'] ?? '',
        'turno'           => $_POST['turno'] ?? '',
        'dias_laborables' => $requiredIds['id_dias_laborables'],
        'servicio'        => $servicioValue,
        'horario_de'      => $_POST['horario_de'] ?? '',
        'horario_a'       => $_POST['horario_a'] ?? ''
    ] + $fotoData; // Combina con datos de foto si existen

    $Result_contrato = $connectionDB->updateData(
        'contrato',
        $Data_contrato,
        'id_contrato',
        $requiredIds['id_contrato']
    );

    if (!is_numeric($Result_contrato)) {
        echo json_encode([
            'status'  => 'error',
            'step'    => 'contrato',
            'message' => "Error al actualizar contrato: $Result_contrato"
        ]);
        exit;
    }
    // file_put_contents('debug.log', "Actualizó contrato\n", FILE_APPEND);

    // 6. Actualizar datos_personal
    $Data_personal = [
        'curp'                   => $_POST['curp'] ?? '',
        'apellidoPaterno'        => $_POST['apellidoPaterno'] ?? '',
        'apellidoMaterno'        => $_POST['apellidoMaterno'] ?? '',
        'nombre'                 => $_POST['nombre'] ?? '',
        'genero'                 => $_POST['genero'] ?? '',
        'onomastico'             => $_POST['onomastico'] ?? '',
        'edad'                   => $_POST['edad'] ?? '',
        'domicilio'              => $_POST['domicilio'] ?? '',
        'email'                  => $_POST['email'] ?? '',
        'telefono_personal'      => $_POST['telefono_personal'] ?? '',
        'RFC'                    => $_POST['RFC'] ?? '',
        'guarderia'              => $_POST['guarderia'] ?? '',
        'tiempo_guarderia'       => $_POST['tiempo_guarderia'] ?? '',
        'childrens_1'            => $_POST['childrens_1'] ?? '',
        'childrens_2'            => $_POST['childrens_2'] ?? '',
        'childrens_3'            => $_POST['childrens_3'] ?? '',
        'childrens_4'            => $_POST['childrens_4'] ?? '',
        'contacto_emergencia'    => $_POST['contacto_emergencia'] ?? '',
        'contacto'               => $_POST['contacto'] ?? '',
        'no_contacto_emergencia' => $_POST['no_contacto_emergencia'] ?? '',
        'informacion_academica'  => $requiredIds['id_informacion_academica'],
        'observaciones'          => $_POST['observaciones'] ?? '',
        'capacitacion'           => $requiredIds['id_capacitacion'],
        'id_contrato'            => $requiredIds['id_contrato']
    ];

    // Validar campos obligatorios
    if (empty($Data_personal['curp']) || empty($Data_personal['nombre'])) {
        echo json_encode([
            'status'  => 'error',
            'step'    => 'datos_personal',
            'message' => 'Curp y nombre son campos obligatorios'
        ]);
        exit;
    }
    file_put_contents('debug.log', "Actualizó personal\n", FILE_APPEND);

    $Result_datos_personal = $connectionDB->updateData(
        'datos_personal',
        $Data_personal,
        'id_enfermero',
        $requiredIds['id_enfermero']
    );

    if (!is_numeric($Result_datos_personal)) {
        echo json_encode([
            'status'  => 'error',
            'step'    => 'datos_personal',
            'message' => "Error al actualizar datos personales: $Result_datos_personal"
        ]);
        exit;
    }
    // file_put_contents('debug.log', "Actualizó datos_personal\n", FILE_APPEND);

    // Respuesta exitosa
    $response = [
        'status'  => 'success',
        'message' => 'Actualización realizada correctamente',
        'affected_ids' => $requiredIds
    ];
}
echo json_encode($response);

exit;
?>