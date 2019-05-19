<?php
// $db_server = 'sql209.byethost.com';
// $db_user = 'b32_23777822';
// $db_password = '234apple';
// $db_name = 'b32_23777822_a8133441951';
$db_server = 'localhost';
$db_user = 'a8133441951';
$db_password = '234apple';
$db_name = 'a8133441951';
 
try {
    $dsn = "mysql:host=$db_server;dbname=$db_name";
    $dbh = new PDO($dsn, $db_user, $db_password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch (Exception $e){
    die('無法對資料庫連線');
}
 
$dbh->exec("SET NAMES utf8");
?>