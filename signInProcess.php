<?php

session_start();

require "connection.php";

$email = $_POST["email"];
$password = $_POST["password"];
$rememberMe = $_POST["rememberMe"];

if (empty($email)) {
    echo "Please enter your Email Address";
}
else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Please enter a valid Email Address";
}
else if (empty($password)) {
    echo "Please enter your Password";
}
else{
    $resultset =  Database::search("SELECT * FROM `user` WHERE `email`='".$email."' AND `password`='".$password."' AND `status_id`='1'");
    $count = $resultset->num_rows;

    if($count==1){

        echo "success";
        $data = $resultset->fetch_assoc();
        $_SESSION["user"] = $data;

        if($rememberMe=="true"){
            setcookie("email",$email,time()+(60*60*24*30*6));
            setcookie("password",$password,time()+(60*60*24*30*6));
        }else{
            setcookie("email","",-1);
            setcookie("password","",-1);
        }
        
    }
    else{
        echo "Invalid Email or Password";
    }
}

?>