<?php
$server="localhost";
$user="root";
$pass="";
$dbname="digikaladb";

$dsn="mysql:host=$server;dbname=$dbname";

try{

    $connect=new PDO($dsn,$user,$pass);
    $connect->exec("SET character_set_connection = 'utf8'");// in 2ta baraye ine ke farsi sazi anjam she
    $connect->exec("SET NAMES 'UTF8'");


}catch (PDOException $error){
    echo "unable to connect".$error->getMessage();
}

