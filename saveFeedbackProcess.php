<?php
session_start();
require "connection.php";

$type = $_POST["t"];
$mail = $_SESSION["user"]["email"];
$bookid = $_POST["i"];

if (empty($_POST["f"])) {
    echo "Please enter feed.";
} else {
    $feedback = $_POST["f"];
    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `feedback` (`user_email`,`book_id`,`feed`,`date`,`type`) 
VALUES('" . $mail . "','" . $bookid . "','" . $feedback . "','" . $date . "','" . $type . "')");

    echo "success";
}

?>
