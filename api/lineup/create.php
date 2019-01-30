<?php
use api\objects\LineUp;
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include '../config/includes.php';

$values = json_decode(file_get_contents('php://input'), true);

if (isset($values['author']) && isset($values['team']) && isset($values['style']) && isset($values['code'])) {
    try {
        http_response_code(201);
        echo json_encode(array('message' => 'LineUp was created.', 'id' => LineUp::create($mysqli, $values['author'], $values['team'], $values['style'], $values['code'])));
    } catch (Exception $e) {
        echo json_encode(array('message' => 'LineUp could not be created.'));
    }
} else {
    http_response_code(400);
    echo json_encode(array('message' => 'No LineUp information was provided.'));
}