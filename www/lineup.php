<?php
require 'config\includes.php';
if (isset($_GET['id'])) {
    $response = $apiClient->request('GET', 'lineup/read_one.php',
        array('query' =>
            array(
                'id' => (int) $_GET['id'],
            ),
        ));
    echo $templates->render('pages::lineup', array(
        'data' => json_decode($response->getBody(), true),
    ));
}