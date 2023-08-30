<?php

session_start();

require "connection.php";

if(isset($_SESSION["user"])){

    $bookId = $_GET["id"];
    $userEmail = $_SESSION["user"]["email"];

    $watchlistrs = Database::search("SELECT * FROM `watchlist` WHERE `book_id`='".$bookId."' AND `user_email`='".$userEmail."' ");

    if($watchlistrs->num_rows == 1){
        
        Database::iud("DELETE FROM `watchlist` WHERE `book_id`='".$bookId."' AND `user_email`='".$userEmail."' ");
        echo "Deleted";

    }else{
        
        Database::iud("INSERT INTO `watchlist` (`book_id`,`user_email`) VALUES('".$bookId."','".$userEmail."') ");
        echo "Added";
    }

}else{
    echo "You have to Sign In first.";
}

// echo "Product added successfully.";

?>