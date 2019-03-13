<?php
require 'config/includes.php';
if (isset($_SESSION['nickname'])) {
    header('Location: index.php');
}
$errorMessage = '';
if (isset($_POST['login'])) {
    try {
        $response = $apiClient->request('POST', 'user/login.php',
            array('json' =>
                array(
                    'emailOrNickname' => $_POST['emailOrNickname'],
                    'password' => $_POST['password'],
                )
            )
        );
        $_SESSION['nickname'] = json_decode($response->getBody(), true)['nickname'];
        header('Location: index.php');
    } catch (Exception $e) {
        $errorMessage = 'Invalid login. Please try again.';
    }
}
echo $templates->render('pages::login', array('errorMessage' => $errorMessage));