<?php
    define('HOST', 'localhost');
    define('USER', 'Brad');
    define('PASS', '123456');
    define('NAME', 'php_dev');
//create connection
$connection= new mysqli(HOST,USER,PASS,NAME);

//check connection
if($connection ->connect_error){
    die('Connection Failed' . $conn->connect_error);

}
?>