<?php

session_start();
require "connection.php";

$receiver = $_POST["r"];

// $rm=$_POST["r"];
$mt=$_POST["m"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `message`(`from`,`to`,`content`,`date_time`,`status`) 
VALUES('newofficial66@gmail.com','".$receiver."','".$mt."','".$date."','0')");

echo "success";

?>