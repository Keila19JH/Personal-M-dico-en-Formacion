<?php
// Incluir el archivo de configuración de la base de datos
include ('dbconfig.php');

// Conectar a la base de datos
$conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

$fechaInicio    = isset($_POST[ 'fechaInicio' ]) ? mysqli_real_escape_string($conn, $_POST[ 'fechaInicio' ]) : '';
$fechaFin       = isset($_POST[ 'fechaFin' ])    ? mysqli_real_escape_string($conn, $_POST[ 'fechaFin' ]) : '';
$statusArray    = isset($_POST[ 'estatus' ])     ? $_POST[ 'estatus' ] : array();

//Construir claúsula WHERE dinámica
$whereClauses = array();

// Filtrar por rango de fechas 
if( !empty( $fechaInicio ) && !empty( $fechaFin ) ){
    $whereClauses[] = "ctr.fechaIngreso BETWEEN '$fechaInicio' AND '$fechaFin'" ;
}

if( !empty( $statusArray ) ){
    $statusClean = array();
    foreach( $statusArray as $status ){
        $statusClean[] = "'" . mysqli_real_escape_string( $conn, $status ) . "'";
    }
    $whereClauses[] = "dp.status_personal IN (" . implode( ',', $statusClean ). ")";
}

$whereQuery = '';
if( count( $whereClauses ) > 0 ){
    $whereQuery = " WHERE " . implode( " AND ", $whereClauses );
}

error_log("Consulta SQL: " . $query_pacientes);
error_log("Fecha inicio: " . $fechaInicio);
error_log("Fecha fin: " . $fechaFin);
error_log("Estatus: " . print_r($statusArray, true));

// Consulta SQL
$query_pacientes = "SELECT 
    dp.id_enfermero,
    ctr.noempleado,
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
    dp.fecha_baja,
    dp.status_personal,
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
    ctr.fechaIngreso,
    ctr.ayo_curso,
    ctr.turno,
    dl.lunes,
    dl.martes,
    dl.miercoles,
    dl.jueves,
    dl.viernes,
    dl.sabado,
    dl.domingo,
    s.servicio,
    ctr.horario_de,
    ctr.horario_a,
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
" . $whereQuery; 


// Ejecutar la consulta
$result = mysqli_query($conn, $query_pacientes);


// Verificar si se obtuvieron resultados
if ($result) {
    // Importar la biblioteca PhpSpreadsheet
    require '../vendor/autoload.php';

    // Crear un nuevo objeto de hoja de cálculo
    $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Agregar los encabezados de las columnas
    $columns = array(
        'ID Pasante',
        'No. Pasante Médico',
        'CURP',
        'Apellido Paterno',
        'Apellido Materno',
        'Nombre(s)',
        'Género',
        'Onomástico',
        'Edad',
        'Domicilio',
        'Correo personal',
        'Teléfono personal',
        'RFC',
        'Fecha formal de la baja',
        'Status del Pasante',
        'Guarderia',
        'Hora guardería',
        '0 a 5 años',
        '6 a 10 años',
        '11 a 15 años',
        'Más de 15 años',
        'Contacto Emergencia',
        'Nombre Contacto Emergencia',
        'Número Contacto Emergencia',
        'Instutución Académica',
        'Observaciones',
        'Fecha Ingreso',
        'Año en Curso',
        'Turno',
        'Lunes',
        'Martes',
        'Miércoles',
        'Jueves',
        'Viernes',
        'Sábado',
        'Domingo',
        'Servicio',
        'Horario (De)',
        'Horario (A)',
        'Interculturalidad',
        'Fecha Expedición Interculturalidad',
        'Higiene de Manos',
        'Fecha Expedición Higiene de Manos',
        'Residuos Hospitalarios',
        'Fecha Expedición Residuos Hospitalarios',
        'Seguridad del Paciente',
        'Fecha Expedición Seguridad del Paciente',
        'Cuidado Paliativo',
        'Fecha Expedición Cuidado Paliativo',
        'Combate de Incendios',
        'Fecha Expedición Combate de Incendios',
        'Evaluación de Calidad',
        'Fecha Expedición Evaluación de Calidad',
        'Trato Digno',
        'Fecha Expedición Trato Digno',
        'Reanimación',
        'Fecha Expedición Reanimación',
        'Salud Mental',
        'Fecha Expedición Salud Mental',
        'Emergencias y Desastres',
        'Fecha Expedición Emergencias y Desastres',
        'Procesos de Limpieza',
        'Fecha Expedición Procesos de Limpieza'
    );


    $sheet->fromArray([$columns], null, 'A1');

    // Ajustar el tamaño de las columnas automáticamente
    foreach ($sheet->getColumnIterator() as $column) {
        $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
    }

    // Establecer estilos para los encabezados
    $styleArray = [
        'font' => [
            'bold' => true,
            'color' => ['rgb' => 'ffffff'],
            'size' => 10,
            'name' => 'Avenir Next LT Pro'
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => '20485f']
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['rgb' => '000000'],
            ],
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            'wrapText' => true
        ]
    ];


    $sheet->getStyle('A1:DV1')->applyFromArray($styleArray);

    // Agregar los datos desde la base de datos
    $row = 2;
    while ($fila = mysqli_fetch_assoc($result)) {
        $sheet->fromArray([$fila], null, 'A' . $row);
        $row++;
    }

    // Crear un objeto Writer para guardar el archivo Excel
    $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

    // Definir la ubicación del archivo Excel
    $excel_file = 'Datos_Personal_Formacion.xlsx';
    // Guardar el archivo Excel
    $writer->save($excel_file);
    $file_path = realpath($excel_file);
    if (ob_get_length()) ob_end_clean();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $excel_file . '"');
    header('Cache-Control: max-age=0');
    readfile($file_path);
    unlink($file_path);
    exit();
} else {
    echo "Error al ejecutar la consulta SQL: " . mysqli_error($conn);
}
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>