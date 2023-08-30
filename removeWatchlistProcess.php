<?php 

require "connection.php";

$watchlistId = $_GET["id"];

$watchlistrs = Database::search("SELECT * FROM `watchlist` WHERE `id`='".$watchlistId."' ");
$watchlist = $watchlistrs->fetch_assoc();

$bookId = $watchlist["book_id"];
$userEmail = $watchlist["user_email"];

Database::iud("INSERT INTO `recent` (`book_id`,`user_email`) VALUES('".$bookId."','".$userEmail."')");

Database::iud("DELETE FROM `watchlist` WHERE `id`='".$watchlistId."' ");

echo "success";

?>