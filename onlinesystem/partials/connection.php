<?php
$dns = 'mysql:host=localhost;dbname=onlinesystem';
$username = 'root';
$password = '';
$option = array( PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',);
try{
        $connection = new PDO($dns,$username,$password);


$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

echo "database connection successful!";
}
 catch (Exception $e){
 echo "connection failed".$e->getMessage();
 }