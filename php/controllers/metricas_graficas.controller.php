<?php
require (__DIR__ . '/../models/database.model.php');
include (__DIR__ . '/../dbconfig.php');

$connectionDB = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

$query_informacion_academica = "SELECT ia.escuela_procedencia, COUNT(dp.id_enfermero) AS conteo FROM datos_personal dp JOIN informacion_academica ia ON dp.informacion_academica = ia.id GROUP BY ia.escuela_procedencia";
$data_informacion_academica = $connectionDB->getRows($query_informacion_academica);

$query_genero = "SELECT genero,COUNT(genero) as conteo FROM datos_personal GROUP BY genero";
$data_genero = $connectionDB->getRows($query_genero);

$data = array(
    'informacion_academica' => $data_informacion_academica,
    'genero' => $data_genero
);

echo json_encode($data);
?>