<?php

session_start();

require "connection.php";

$receiver_email = $_SESSION["user"]["email"];
$sender_email = $_GET["email"];

$message_rs = Database::search("SELECT * FROM `message` WHERE `from`='" . $receiver_email . "' OR `to`='" . $receiver_email . "' ");
$message_num = $message_rs->num_rows;

for ($x = 0; $x < $message_num; $x++) {
    $message_data = $message_rs->fetch_assoc();

    $user_rs = Database::search("SELECT * FROM `user` INNER JOIN `profile_img` ON `user`.`email`=`profile_img`.`user_email` WHERE `email`='" . $message_data["from"] . "'");
    $user_count = $user_rs->num_rows;
    $user_data = $user_rs->fetch_assoc();

    if ($message_data["from"] == $sender_email & $message_data["to"] == $receiver_email) {
?>
        <!-- receiver's message -->
        <div class="mb-3 col-6">
            <?php
            if ($user_count > 0) {
            ?>
                <img src="<?php echo $user_data["code"]; ?>" height="50px" style="border-radius: 50%;" class="mb-1" />
            <?php
            } else {
            ?>
                <img src="icons/user_default.png" height="50px" class="rounded-circle rounded" />
            <?php
            }
            ?>
            <div>
                <div class="bg-light rounded py-2 px-3 mb-2">
                    <p class="mb-0 text-dark"><?php echo $message_data["content"]; ?></p>
                </div>
                <p class="small text-black-50 text-end"><?php echo $message_data["date_time"]; ?></p>
                <!-- <p class="invisible" id="rmail"><?php echo $message_data["from"]; ?></p> -->
            </div>
        </div>
        <!-- receiver's message -->
    <?php
    }
    if ($message_data["to"] == $sender_email & $message_data["from"] == $receiver_email) {
    ?>
        <!-- sender's message -->
        <div class="mb-3 offset-6 col-6">
            <div>
                <div class="bg-primary rounded py-2 px-3 mb-2">
                    <p class="mb-0 text-white"><?php echo $message_data["content"]; ?></p>
                </div>
                <p class="small text-black-50 text-end"><?php echo $message_data["date_time"]; ?></p>
            </div>
        </div>
        <!-- sender's message -->
<?php
    }
}
Database::iud("UPDATE `message` SET `status`='1' WHERE `from`='" . $sender_email . "' AND `to`='" . $receiver_email . "' ");
?>