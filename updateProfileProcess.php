<?php

require "connection.php";

session_start();

if (isset($_SESSION["user"])) {

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $add1 = $_POST["add1"];
    $add2 = $_POST["add2"];
    $city = $_POST["city"];
    $pcode = $_POST["pcode"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $mobile = $_POST["mobile"];

    if (empty($username)) {
        echo "Please enter username.";
    }else if (empty($password)) {
        echo "Please enter password.";
    } else if (empty($mobile)) {
        echo "Please enter mobile.";
    } else if (empty($fname)) {
        echo "Please enter first name.";
    } else if (empty($lname)) {
        echo "Please enter last name.";
    } else if (empty($add1)) {
        echo "Please enter address.";
    } else if (empty($city)) {
        echo "Please select city.";
    } else {
        if (isset($_FILES["image"])) {
            $image = $_FILES["image"];
        }
        if (isset($image)) {

            $allowed_image_extention = array("image/jpg", "image/png", "image/jpeg", "image/svg");
            $fileExtention = $image["type"];

            if (!in_array($fileExtention, $allowed_image_extention)) {

                echo "Please select a valid image.";
            } else {

                $newImageExtention;
                if ($fileExtention == "image/jpg") {
                    $newImageExtention = ".jpg";
                } else if ($fileExtention == "image/png") {
                    $newImageExtention = ".png";
                } else if ($fileExtention == "image/jpeg") {
                    $newImageExtention = ".jpeg";
                } else if ($fileExtention == "image/svg") {
                    $newImageExtention = ".svg";
                }

                $fileName = "profile_images//" . uniqid() . $newImageExtention;
                move_uploaded_file($image["tmp_name"], $fileName);

                $profile = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '" . $_SESSION["user"]["email"] . "' ");
                $imageCount = $profile->num_rows;

                if ($imageCount == 1) {
                    Database::iud("UPDATE `profile_img` SET `code`='" . $fileName . "' WHERE `user_email` = '" . $_SESSION["user"]["email"] . "'");
                    // echo "Profile Image updated successfully";
                    echo "success";
                } else {
                    Database::iud("INSERT INTO `profile_img` (`code`,`user_email`) VALUES('" . $fileName . "','" . $_SESSION["user"]["email"] . "')");
                    // echo "New profile image saved Successfully.";
                    echo "success";
                }
            }
        } else {
            Database::iud("UPDATE `user` SET `username`='" . $username . "',`password`='" . $password . "',`mobile`='" . $mobile . "',`first_name`='" . $fname . "',`last_name`='" . $lname . "' WHERE `email`='" . $_SESSION["user"]["email"] . "'");
            $address_details =  Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $_SESSION["user"]["email"] . "'");
            $address_count = $address_details->num_rows;

            if ($address_count == 1) {
                Database::iud("UPDATE `user_has_address` SET `line1`='" . $add1 . "',`line2`='" . $add2 . "',`city_id`='" . $city . "' WHERE `user_email` = '" . $_SESSION["user"]["email"] . "' ");
                echo "success";
            } else {
                Database::iud("INSERT INTO `user_has_address`(`user_email`,`line1`,`line2`,`city_id`) VALUES('" . $_SESSION["user"]["email"] . "','" . $add1 . "','" . $add2 . "','" . $city . "')");
                echo "success";
            }
        }
    }
} else {
    echo "Error";
}
