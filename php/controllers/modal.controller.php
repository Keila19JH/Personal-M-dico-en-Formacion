<?php

require(__DIR__ . '/../models/database.model.php');
include(__DIR__ . '/../dbconfig.php');

$connectionDB = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $idEnfermero = $_POST[ 'id_unregisteringdate' ] ?? null;
    $fechaBaja   = $_POST[ 'fechaBaja' ] ?? null;

    $result = $connectionDB->sendDateTermination( $idEnfermero, $fechaBaja );

    if( is_numeric( $result ) && $result >0 ){
        echo "success";
    }else{
        echo "error";
    }

}

?>