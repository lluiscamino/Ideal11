<?php
require 'config\includes.php';
if (isset($_GET['name'])) {
    try {
        $response = $apiClient->request('GET', 'user/read_one.php',
            array('query' =>
                array(
                    'nickname' => $_GET['name'],
                ),
            ));
        $responseLineUps = $apiClient->request('GET', 'lineup/read.php',
            array('query' =>
                array(
                    'limit' => ENTRIES_PER_PAGE,
                    'author' => $_GET['name']
                ),
            ));
        echo $templates->render('pages::user', array(
            'userInfo' => json_decode($response->getBody(), true),
            'lineUps' => json_decode($responseLineUps->getBody(), true),
        ));
    } catch(Exception $e) {
        echo $templates->render('pages::errorpage', array(
            'type' => 'User not found',
            'url' => 'user',
            'message' => 'User was not found. Please return to the <a href="index.php">index</a>.'
        ));
    }
}