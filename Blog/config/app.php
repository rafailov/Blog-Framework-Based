<?php
$cnf['default_method'] = 'index';
$cnf['default_controller'] = 'Index';
$cnf['namespace']['Controllers'] = realpath('./Controllers/');
$cnf['namespace']['Models'] = realpath('./Models/');

$cnf['session']['autostart'] = true;
$cnf['session']['type'] = 'native';
$cnf['session']['name'] = '__sess';
$cnf['session']['lifetime'] = 3600;
$cnf['session']['path'] = '/';
$cnf['session']['domain'] = '';
$cnf['session']['secure'] = false;
$cnf['session']['dbConnection'] = 'default';
$cnf['session']['dbTable'] = 'sessions';

return $cnf;