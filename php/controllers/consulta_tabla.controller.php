<?php
require (__DIR__ . '/../models/database.model.php');
include (__DIR__ . '/../dbconfig.php');


$connectionDB = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);



$query_personales = "SELECT dp.*, co.noempleado, co.foto 
                     FROM datos_personal AS dp 
                     JOIN contrato AS co 
                     ON dp.id_contrato = co.id_contrato 
                     WHERE dp.status_personal = 'ACTIVO';";

$data = $connectionDB->getRows($query_personales);

echo json_encode($data);

?>