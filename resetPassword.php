<?php

require "connection.php";

$email = $_POST["email"];
$newPassword = $_POST["newPassword"];
$confirmPassword = $_POST["confirmPassword"];
$code = $_POST["code"];

if(empty($email)){
    echo "Missing Email Address.";
}else if(empty($newPassword)){
    echo "please enter your new password.";
}else if(strlen($newPassword)<5 || strlen($newPassword) >=20){
    echo "Password Length should be between 5 to 20.";
}else if(empty($confirmPassword)){
    echo "Please re-enter your new password.";
}else if($newPassword != $confirmPassword){
    echo "Password & Re-type Password does not match.";
}else if(empty($code)){
    echo "Please enter your verification code.";
}else{
    $resultset = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."' AND `verification_code` = '".$code."'");

    if($resultset ->num_rows==1){

        Database::iud("UPDATE `user` SET `password` = '".$newPassword."' WHERE `email`= '".$email."'");
        echo "success";
    }else{
        echo "Password reset failed";
    }

}

?>