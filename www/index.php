<?php 
require 'config/includes.php';
$orderBy = isset($_GET['order']) ? (int) $_GET['order'] : 0;
$direction = isset($_GET['direction']) ? $_GET['direction'] : 'DESC';
$numPages = ceil((json_decode($apiClient->request('GET', 'lineup/info.php')->getBody(), true)['numEntries'])/ENTRIES_PER_PAGE);
$page = isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $numPages ? (int) $_GET['p'] : 1;
$response = $apiClient->request('GET', 'lineup/read.php',
    array('query' =>
        array(
            'author' => isset($_GET['searchAuthor']) && $_GET['searchAuthor'] !== '' ? $_GET['searchAuthor'] : '',
            'team' => isset($_GET['searchTeam']) ? (int) $_GET['searchTeam'] : 0,
            'style' => isset($_GET['searchStyle']) ? $_GET['searchStyle'] : '',
            'order_by' => $orderBy,
            'direction' => $direction,
            'limit' => $page*ENTRIES_PER_PAGE,
            'offset' =>  ($page-1)*ENTRIES_PER_PAGE
        ),
));
echo $templates->render('pages::index', array(
    'entries' => json_decode($response->getBody(), true),
    'orderBy' => $orderBy,
    'direction' => $direction,
    'page' => $page,
    'numPages' => $numPages
    ));