<?php
define('DB_DRIVER','mysql');
define('DB_HOST','localhost');
define('DB_NAME','lesson-15');
define('DB_USER','IlyaRodionov');
define('DB_PASS','MySQL2602');

$connect_str = DB_DRIVER . ':host=' . DB_HOST . '; dbname=' . DB_NAME;
$db = new PDO($connect_str, DB_USER, DB_PASS);
$db->exec("SET NAMES UTF8");

//$db = "INSERT INTO `irodionov`(`id`, `description`, `is_done`, `date_added`) VALUES;
