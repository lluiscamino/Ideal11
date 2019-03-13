<?php
use api\objects\User;
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: access');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

include '../config/includes.php';

if (isset($_GET['nickname']) || isset($_GET['email'])) {
    try {
        $nickname = isset($_GET['nickname']) ? $_GET['nickname'] : '';
        $email = isset($_GET['email']) ? $_GET['email'] : '';
        $lineUp = new User($mysqli, -1, $nickname, $email);
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