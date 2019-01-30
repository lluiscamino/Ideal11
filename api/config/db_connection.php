<?php
$credentials = json_decode(file_get_contents(ROOT . '/db_credentials.json'), true);
$mysqli = new mysqli($credentials['server'], $credentials['user'], $credentials['password'], $credentials['db']);
unset($credentials);