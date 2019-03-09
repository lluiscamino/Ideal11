<?php
require 'config/includes.php';
if (isset($_GET['id'])) {
    try {
        $response = $apiClient->request('GET', 'lineup/read_one.php',
            array('query' =>
                array(
                    'id' => (int)$_GET['id']
                ),
            ));
        echo $templates->render('pages::lineup', array(
            'data' => json_decode($response->getBody(), true)
        ));
    } catch (Exception $e) {
        echo $templates->render('pages::errorpage', array(
            'url'     => 'lineup',
            'type'    => 'LineUp ID not found',
            'message' => 'The selected LineUp does not exist. Please return to the <a href="index.php">index</a>.'
        ));
    }
} else {
    echo $templates->render('pages::errorpage', array(
        'url'     => 'lineup',
        'type'    => 'LineUp ID not specified',
        'message' => 'You need to specify a LineUp ID'
    ));
}