<?php

session_start();

require "connection.php";

$id = $_POST["id"];

Database::iud("UPDATE `invoice` SET `status`='1' WHERE `id`='".$id."'");

echo "success";
?>
