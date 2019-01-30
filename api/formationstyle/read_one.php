<?php
use api\objects\FormationStyle;
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: access');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

include '../config/includes.php';

if (isset($_GET['id']) || isset($_GET['title'])) {
    if (isset($_GET['id'])) {
        $title = '';
        $id = (int) $_GET['id'];
    } else {
        $title = $_GET['title'];
        $id = -1;
    }
    $style = new FormationStyle($mysqli, $id, $title);
    try {
        http_response_code(200);
        echo $style->toJSON();
    } catch (Exception $e) {
        http_response_code(404);
        echo json_encode(array('message' => 'Style does not exist.'));
    }
} else {
    http_response_code(400);
    echo json_encode(array('message' => 'No Style ID or title was provided.'));
}