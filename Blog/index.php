<?php
error_reporting(E_ALL ^ E_NOTICE);
include_once '../gf/App.php';

$app = \GF\App::getInstance();


$app->run();