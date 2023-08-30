<?php

require "connection.php";

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirmpassword = $_POST["confirmpassword"];
$mobile = $_POST["mobile"];
$gender = $_POST["gender"];


if (empty($username)) {
    echo "Please enter your Username";
} 
else if (strlen($username) >= 50) {
    echo "Username must be less than 50 characters";
} 
else if (empty($email)) {
    echo "Please enter your Email Address";
} 
else if (strlen($email) >= 100) {
    echo "Email address must be less than 100 characters";
} 
else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Please enter a valid Email Address";
} 
else if (empty($password)) {
    echo "Please enter your Password";
}
else if (strlen($password)<5 || strlen($password)>20) {
    echo "Password length should be between 5 to 20";
} 
else if (empty($confirmpassword)) {
    echo "Please enter your Confirm password";
}
else if ($password != $confirmpassword) {
    echo "Password didn't Match";
}  
else if (empty($mobile)) {
    echo "Please enter your Mobile";
}
else if (!preg_match("/[0|94|+94][7][0|1|2|4|5|6|7|8][0-9]{7}$/",$mobile)) {
    echo "Please enter a valid Mobile number";
}
else{
    $r = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' OR `mobile`='".$mobile."' OR `username`='".$username."' ");
    $n = $r->num_rows;

    if ($n > 0){
        echo "User Email address, Phone number or username already exists";
    } else {
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `user` (`email`,`username`,`password`,`mobile`,`gender`,`register_date`)
        VALUES('".$email."','".$username."','".$password."','".$mobile."','".$gender."','".$date."') ");

        echo "success";
    }
}

?>