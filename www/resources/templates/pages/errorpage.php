<?php
$this->layout('global::main', array('title' => 'Error: ' . $this->e($type), 'url' => $url));
echo $message;