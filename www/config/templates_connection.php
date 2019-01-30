<?php
$templates = new League\Plates\Engine();
$templates->addFolder('global', ROOT . '/resources/templates/global');
$templates->addFolder('pages', ROOT . '/resources/templates/pages');
$templates->addFolder('components', ROOT . '/resources/templates/components');
$templates->addData(array(
    'sitetitle' => SITETITLE,
    'root'      => ROOT
), 'global::main');