<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: access');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');
if (isset($_GET['nickname']) && isset($_GET['email'])) {
    require '../../config/includes.php';
    try {
        $response = $apiClient->request('GET', 'user/read_one.php',
            array('query' =>
                array(
                    'nickname' => $_GET['nickname']
                ),
            )
        );
        $freeNickname = false;
    } catch (GuzzleHttp\Exception\ClientException $e) {
        $freeNickname = true;
    } finally {
        try {
            $response = $apiClient->request('GET', 'user/read_one.php',
                array('query' =>
                    array(
                        'email' => $_GET['email']
                    ),
                )
            );
            $freeEmail = false;
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $freeEmail = true;
        }
        http_response_code(200);
        echo json_encode(array('freeNickname' => $freeNickname, 'freeEmail' => $freeEmail));
    }
} else {
    http_response_code(400);
    echo json_encode(array('message' => 'No nickname and/or email were provided.'));
}