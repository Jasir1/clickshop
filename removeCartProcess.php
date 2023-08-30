<?php 

require "connection.php";

$cartId = $_GET["id"];

$cartrs = Database::search("SELECT * FROM `cart` WHERE `id`='".$cartId."' ");
$cart = $cartrs->fetch_assoc();

$bookId = $cart["book_id"];
$userEmail = $cart["user_email"];

Database::iud("INSERT INTO `recent` (`book_id`,`user_email`) VALUES('".$bookId."','".$userEmail."')");

Database::iud("DELETE FROM `cart` WHERE `id`='".$cartId."' ");

echo "success";

?>