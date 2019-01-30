<?php
use api\objects\LineUp;
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: access');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

include '../config/includes.php';

$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 20;
$offSet = isset($_GET['offset']) ? (int) $_GET['offset'] : 0;
$orderBy = isset($_GET['order_by']) ? (int) $_GET['order_by'] : 0;
$direction = isset($_GET['direction']) ? $_GET['direction'] : 'DESC';
$user= isset($_GET['author']) ? $_GET['author'] : '';
$teamId = isset($_GET['team']) ? (int) $_GET['team'] : 0;
$style = isset($_GET['style']) ? $_GET['style'] : '';

try {
    http_response_code(200);
    $lineUps = LineUp::listOfLineUps($mysqli, $limit, $offSet, $orderBy, $direction, $user, $teamId, $style);
    foreach ($lineUps as $i => $lineUp) {
        $lineUps[$i] = $lineUp->toArray();
    }
    echo json_encode($lineUps);
} catch(Exception $e) {
    http_response_code(400);
    echo json_encode(array('message' => 'Wrong details or user does not exist. Check the documentation.'));
}