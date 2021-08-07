<?php

$db_username    = 'root';
$db_password    = '';
$db_name        = 'sparks_bank';
$db_host        = 'localhost';
/*$db_username    = 'prvaasco_user';
$db_password    = 'N0E4jbJsoVkU';
$db_name        = 'prvaasco_hope';
$db_host        = 'localhost';*/
$db = new mysqli($db_host, $db_username, $db_password,$db_name);

if(!$db) {

echo 'connection failed'; exit;

}
?>