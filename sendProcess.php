<?php

session_start();

require "connection.php";

$userEmail = $_SESSION["user"]["email"];
$bid = $_GET["id"];

$book = Database::search("SELECT * FROM `book` WHERE `user_email`='".$userEmail."' AND `id` = '".$bid."' ");

$count = $book->num_rows;

if($count==1){
    $row = $book->fetch_assoc();
    $_SESSION["userBooks"] = $row;
    echo "success";
}
else{
    echo "error";
}

?>