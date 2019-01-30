<?php
use api\objects\LineUp;
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: access');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

include '../config/includes.php';

try {
    http_response_code(200);
    echo json_encode(array('numEntries' => LineUp::getNumLineUps($mysqli)));
} catch (Exception $e) {
    http_response_code(503);
    echo json_encode(array('message' => 'Information could not be extracted.'));
}