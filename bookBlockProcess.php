<?php

require "connection.php";


if(isset($_GET["id"])){
    
    $book_id = $_GET["id"];
    $book_rs = Database::search("SELECT * FROM `book` WHERE `id`='".$book_id."'");
    $book_num  = $book_rs->num_rows;

    if($book_num==1){
        $book_data = $book_rs->fetch_assoc();
        $book_status = $book_data["status_id"];

        if($book_status=="1"){
            Database::iud("UPDATE `book` SET `status_id`='2' WHERE `id`='".$book_id."'");
            echo "success1";

        }else if($book_status=="2"){
            Database::iud("UPDATE `book` SET `status_id`='1' WHERE `id`='".$book_id."'");
            echo "success2";

        }
    }

}

?>