<?php
use api\objects\LineUp;
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include '../config/includes.php';

$values = json_decode(file_get_contents('php://input'), true);

if (isset($values['id']) && isset($values['team']) && isset($values['style']) && isset($values['code'])) {
    try {
        $lineUp = new LineUp($mysqli, $values['id']);
        if ($lineUp->update($values['team'], $values['style'], $values['code'])) {
            http_response_code(200);
            echo json_encode(array('message' => 'Line up was updated.'));
        } else {
            http_response_code(503);
            echo json_encode(array('message' => 'Unable to update Line up.'));
        }
    } catch (Exception $e) {
        http_response_code(404);
        echo json_encode(array('message' => 'Line up does not exist or invalid data.'));
    }
} else {
    http_response_code(400);
    echo json_encode(array('message' => 'No LineUp information was provided.'));
}