<?php

session_start();
require "connection.php";

$bookid = $_GET["bid"];
$qty = $_GET["bqty"];

$usermail = $_SESSION["user"]["email"];


$order_id = mt_rand(100000, 999999);

$book_rs = Database::search("SELECT * FROM `book` WHERE `id`='" . $bookid . "' ");
$book_data = $book_rs->fetch_assoc();

$unit_price = $book_data["price"];
$total = $unit_price * $qty;

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `invoice` (`order_id`,`book_id`,`user_email`,`date`,`total`,`qty`,`status`)
VALUES('" . $order_id . "','" . $bookid . "','" . $usermail . "','" . $date . "','" . $total . "','" . $qty . "','0')");

Database::iud("UPDATE `book` SET `qty`='" . $book_data["qty"] - $qty . "' WHERE `id`='" . $bookid . "' ");

echo $order_id;


?>