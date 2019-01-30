<?php
use api\objects\Team;
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: access');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

include '../config/includes.php';

if (isset($_GET['country'])) {
    try {
        http_response_code(200);
        $teams = Team::listOfTeams($mysqli, $_GET['country']);
        foreach ($teams as $i => $team) {
            $teams[$i] = $team->toArray();
        }
        echo json_encode($teams);
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode(array('message' => 'Wrong country code.'));
        echo $e;
    }
} else {
    http_response_code(400);
    echo json_encode(array('message' => 'No country code was provided.'));
}