<?php
use api\objects\LineUp;
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: access');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

include '../config/includes.php';

if (isset($_GET['id'])) {
    try {
        $lineUp = new LineUp($mysqli, $_GET['id']);
        http_response_code(200);
        echo $lineUp->toJSON();
    } catch (Exception $e) {
        http_response_code(404);
        echo json_encode(array('message' => 'Line up does not exist.'));
    }
} else {
    http_response_code(400);
    echo json_encode(array('message' => 'No LineUp ID was provided.'));
}