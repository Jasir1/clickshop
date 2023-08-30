<?php

session_start();
require "connection.php";

$bookid = $_GET["bid"];
$qty = $_GET["bqty"];

$user = $_SESSION["user"];

if (isset($user)) {

    $book_rs = Database::search("SELECT * FROM `book` WHERE `id`='" . $bookid . "' ");
    $book_count = $book_rs->num_rows;

    if ($book_count == 1) {
        $book_data = $book_rs->fetch_assoc();
        $book_title = $book_data["title"];
        $book_price = $book_data["price"];
        $book_delivery_fee = $book_data["delivery_fee_other"];

        $book_qty_price = ($qty*$book_price);
        $book_total_price = ($book_qty_price + $book_delivery_fee);

        $user_first_name = $user["first_name"];
        $user_last_name = $user["last_name"];
        $user_mobile = $user["last_name"];

        $j = '{"bt":"'.$book_title.'","btp":"'.$book_total_price.'","ufn":"'.$user_first_name .'","uln":"'.$user_last_name .'","um":"'.$user_mobile.'"}';

        echo $j;

        

    } else {
        echo "2";
    }
} else {
    echo "3";
}
