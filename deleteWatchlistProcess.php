<?php

require "connection.php";

$bookId = $_GET["id"];

$watchrs = Database::search("SELECT * FROM `watchlist` WHERE `id`='".$bookId."' ");
$watch_num = $watchrs->num_rows;

if($watch_num == 0){
    echo "Sorry for the inconvinient...";
}else{
    $watchlist = $watchrs->fetch_assoc();

    $id = $watchlist["book_id"];
    $email = $watchlist["user_email"];

    Database::iud("INSERT INTO `recent` (`book_id`,`user_email`) VALUES('".$id."','".$email."')");

    Database::iud("DELETE FROM `watchlist` WHERE `id`='".$bookId."' ");

    echo "success";
}

?>