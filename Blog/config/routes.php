<?php
$cnf['administration']['namespace'] = 'Controllers\Admin';
$cnf['administration']['controllers']['test']['to'] = 'index';
$cnf['administration']['controllers']['index']['methods']['new'] = '_new';


$cnf['administration']['controllers']['new']['to'] = 'create';

$cnf['admin']['namespace'] = 'Controllers\Admin';
$cnf['*']['namespace'] = 'Controllers';
return $cnf;