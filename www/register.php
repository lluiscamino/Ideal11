<?php
require 'config/includes.php';
if (isset($_SESSION['nickname'])) {
    header('Location: index.php');
}
$errorMessage = '';
if (isset($_POST['register'])) {
    try {
        $response = $apiClient->request('POST', 'user/create.php',
            array('json' =>
                array(
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    'passwordAgain' => $_POST['passwordAgain'],
                    'nickname' => $_POST['nickname']
                )
            )
        );
        $_SESSION['nickname'] = json_decode($response->getBody(), true)['nickname'];
        header('Location: index.php');
    } catch (Exception $e) {
        $errorMessage = 'Some of the fields you entered are not valid.';
    }
}
echo $templates->render('pages::register', array('errorMessage' => $errorMessage));