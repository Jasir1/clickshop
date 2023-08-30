<?php

session_start();
require "connection.php";

if (isset($_SESSION["user"])) {

    $userEmail = $_SESSION["user"]["email"];
    $bookId = $_GET["id"];

    //////////////////////////
    if (isset($_POST['checkout'])) {
        $brands = $_POST['books'];
        // echo $brands;

        foreach ($brands as $item) {
            // echo $item . "<br>";
            $query = "INSERT INTO demo (name) VALUES ('$item')";
            $query_run = mysqli_query($con, $query);
        }

        if ($query_run) {
            $_SESSION['status'] = "Inserted Successfully";
            header("Location: index.php");
        } else {
            $_SESSION['status'] = "Data Not Inserted";
            header("Location: index.php");
        }
    }
    ////////////////////

} else {
    echo "Please Sign In first.";
}
