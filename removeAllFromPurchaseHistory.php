<?php

session_start();

require "connection.php";

$mail = $_POST["email"];

Database::iud("UPDATE `invoice` SET `status`='1' WHERE `user_email`='".$mail."'");

echo "success";
?>
