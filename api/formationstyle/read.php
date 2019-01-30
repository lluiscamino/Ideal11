<?php
use api\objects\FormationStyle;
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

try {
    http_response_code(200);
    $styles = FormationStyle::listOfStyles($mysqli, $limit, $offSet, $orderBy, $direction);
    foreach ($styles as $i => $style) {
        $styles[$i] = $style->toArray();
    }
    echo json_encode($styles);
} catch(Exception $e) {
    http_response_code(400);
    echo json_encode(array('message' => 'Wrong details. Check the documentation.'));
}