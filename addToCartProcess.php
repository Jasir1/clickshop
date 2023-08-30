<?php

session_start();
require "connection.php";

if(isset($_SESSION["user"])){

    $userEmail = $_SESSION["user"]["email"];
    $bookId = $_GET["id"];

    $bookrs = Database::search("SELECT * FROM `cart` WHERE `user_email`='".$userEmail."' AND `book_id`='".$bookId."' ");
    $booknum = $bookrs->num_rows;

    $bookqtyrs = Database::search("SELECT `qty` FROM `book` WHERE `id`='".$bookId."' ");
    $qtyrows = $bookqtyrs->fetch_assoc();
    
    $bookqty = $qtyrows["qty"];

    if($booknum == 1){
        $bookRows = $bookrs->fetch_assoc();
        $currentqty = $bookRows["qty"];
        $newqty = (int)$currentqty +1;

        if($bookqty>=$newqty){

            Database::iud("UPDATE `cart` SET `qty`='".$newqty."' WHERE `user_email`='".$userEmail."' AND `book_id`='".$bookId."'  ");
            echo "Book quantity updated.";
        }else{
            echo "You reached the maximum quantity.";
        }
    }else{
        Database::iud("INSERT INTO `cart`(`book_id`,`user_email`,`qty`) VALUES('".$bookId."','".$userEmail."','1') ");
        echo "New book has been added to your cart.";
    }
} else{
    echo "Please Sign In first.";
}

?>