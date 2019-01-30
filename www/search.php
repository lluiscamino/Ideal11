<?php
require 'config\includes.php';
$responseStyles = $apiClient->request('GET', 'formationStyle/read.php');
$responseEs = $apiClient->request('GET', 'team/read.php?country=es');
$responseEn = $apiClient->request('GET', 'team/read.php?country=en');
$responseIt = $apiClient->request('GET', 'team/read.php?country=it');
$responseDe = $apiClient->request('GET', 'team/read.php?country=de');
$responseFr = $apiClient->request('GET', 'team/read.php?country=fr');
echo $templates->render('pages::search', array(
    'styles' => json_decode($responseStyles->getBody(), true),
    'esTeams' => json_decode($responseEs->getBody(), true),
    'enTeams' => json_decode($responseEn->getBody(), true),
    'itTeams' => json_decode($responseIt->getBody(), true),
    'deTeams' => json_decode($responseDe->getBody(), true),
    'frTeams' => json_decode($responseFr->getBody(), true),
));