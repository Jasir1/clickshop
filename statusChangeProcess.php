<?php

require "connection.php";

$bookId = $_GET["b"];
$status = $_GET["s"];

$statusDetails = Database::search("SELECT * FROM `book` WHERE `id`= '".$bookId."' ");
$statusCount = $statusDetails->num_rows;

if($statusCount==1){
    $bookStatus = $statusDetails->fetch_assoc();
    $statusId = $bookStatus["status_id"];

    if($statusId==1){
        Database::iud("UPDATE `book` SET `status_id`=2 WHERE `id`='".$bookId."' ");
        echo "Deactivated";
    }else if($statusId=2){
        Database::iud("UPDATE `book` SET `status_id`=1 WHERE `id`='".$bookId."' ");
        echo "Activated";
    }
}else{
    echo "Something went wrong.";
}

?>