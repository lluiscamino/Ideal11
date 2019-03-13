<?php
require 'config/includes.php';
require 'resources/php/create_image.php';
if (isset($_POST['createLineUp'])) {
    $success = false;
    if (isset($_POST['team']) && isset($_POST['style']) && isset($_POST['formation']) && isset($_POST['kitUrl'])) {
        try {
            $response = $apiClient->request('PUT', 'lineup/create.php',
                array('json' =>
                    array(
                        'author' => isset($_SESSION['nickname']) ? $_SESSION['nickname'] : 'Guest',
                        'team' => $_POST['team'],
                        'style' => $_POST['style'],
                        'code' => $_POST['formation'],
                    ),
                ));
            $success = true;
        } catch (Exception $e) {}
    }
}
$alertText = '';
$alertType = '';
if (isset($success)) {
    if ($success) {
        $id = json_decode($response->getBody(), true)['id'];
        createFieldImage($id, json_decode($_POST['formation'], true), ROOT . '/' . $_POST['kitUrl']);
        $alertText = 'LineUp uploaded. Click <a href="lineup.php?id=' . $id . '">here</a> to see it.';
        $alertType = 'success';
    } else {
        $alertText = 'There was an error while uploading your LineUp. Please try it again.';
        $alertType = 'danger';
    }
}
$responseStyles = $apiClient->request('GET', 'formationStyle/read.php');
$responseEs = $apiClient->request('GET', 'team/read.php?country=es');
$responseEn = $apiClient->request('GET', 'team/read.php?country=en');
$responseIt = $apiClient->request('GET', 'team/read.php?country=it');
$responseDe = $apiClient->request('GET', 'team/read.php?country=de');
$responseFr = $apiClient->request('GET', 'team/read.php?country=fr');
echo $templates->render('pages::create', array(
    'defaultLineUp' => isset($_GET['code']) ? '\'' . $_GET['code'] . '\'' : 'document.getElementById(\'1-code-style\').value',
    'setTeam' => isset($_GET['team']) ? $_GET['team'] : '',
    'setStyle' => isset($_GET['style']) ? $_GET['style'] : '',
    'locatePlayers' => isset($_GET['code']),
    'alertText' => $alertText,
    'alertType' => $alertType,
    'styles' => json_decode($responseStyles->getBody(), true),
    'esTeams' => json_decode($responseEs->getBody(), true),
    'enTeams' => json_decode($responseEn->getBody(), true),
    'itTeams' => json_decode($responseIt->getBody(), true),
    'deTeams' => json_decode($responseDe->getBody(), true),
    'frTeams' => json_decode($responseFr->getBody(), true),
));