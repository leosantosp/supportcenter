<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DBNAME', 'centralsuporte');

$connect = new PDO('mysql:host='.HOST.';dbname='.DBNAME.';', USER, PASS);