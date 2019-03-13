<?php
require 'config/includes.php';
if (isset($_SESSION['nickname'])) {
    unset($_SESSION['nickname']);
    header('Location: index.php');
    session_destroy();
}