<?php
use api\objects\LineUp;
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include '../config/includes.php';

$values = json_decode(file_get_contents('php://input'), true);

if (isset($values['id'])) {
    try {
        $lineUp = new LineUp($mysqli, $values['id']);
        if ($lineUp->delete()) {
            http_response_code(200);
            echo json_encode(array('message' => 'Line up was deleted.'));
        } else {
            http_response_code(503);
            echo json_encode(array('message' => 'LineUp could not be deleted.'));
        }
    } catch(Exception $e) {
        http_response_code(404);
        echo json_encode(array('message' => 'Line up does not exist.'));
    }
} else {
    http_response_code(400);
    echo json_encode(array('message' => 'No LineUp information was provided.'));
}