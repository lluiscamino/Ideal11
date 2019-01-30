<?php
use api\objects\User;
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: access');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

include '../config/includes.php';

if (isset($_GET['nickname'])) {
    try {
        $lineUp = new User($mysqli, -1, $_GET['nickname']);
        http_response_code(200);
        echo $lineUp->toJSON();
    } catch (Exception $e) {
        http_response_code(404);
        echo json_encode(array('message' => 'User does not exist.'));
    }
} else {
    http_response_code(400);
    echo json_encode(array('message' => 'No Nickname was provided.'));
}