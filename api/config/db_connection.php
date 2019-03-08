<?php
$credentials = json_decode(file_get_contents(ROOT . '/db_credentials.json'), true);
@$mysqli = new mysqli($credentials['server'], $credentials['user'], $credentials['password'], $credentials['db']);
if ($mysqli->connect_error) {
    http_response_code(400);
    echo json_encode(array('message' => 'Database connection error.'));
    die();
}
unset($credentials);