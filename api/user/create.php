<?php
use api\objects\User;
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include '../config/includes.php';

$values = json_decode(file_get_contents('php://input'), true);

if (isset($values['email']) && isset($values['password']) && isset($values['passwordAgain']) && isset($values['nickname'])) {
    try {
        http_response_code(201);
        echo json_encode(array('message' => 'User was created.', 'nickname' => User::create($mysqli, $values['email'], $values['password'], $values['passwordAgain'], $values['nickname'])));
    } catch (Exception $e) {
        http_response_code(403);
        echo json_encode(array('message' => $e->getMessage()));
    }
} else {
    http_response_code(400);
    echo json_encode(array('message' => 'No user information was provided.'));
}