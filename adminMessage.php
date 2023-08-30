<?php

require "connection.php";

session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Messages | clickShop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="icon" href="resources/logo new.PNG" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="navigation.css" />
    <link rel="stylesheet" href="style.css" />
</head>


<body onload="viewAdminRecent();" class="my_background1">

    <?php

    if (isset($_SESSION["admin"]["email"])) {
        $adminEmail = $_SESSION["admin"]["email"];

    ?>

        <nav class="navbar navbar-expand d-flex flex-column align-item-start shadow" id="sidebar">

            <?php require "adminNavigation.php"; ?>
            <script>
                var btn = document.getElementById('Messages');
                btn.style.backgroundColor = 'rgba(122, 118, 118, 0.5)';
            </script>

        </nav>
        <section class="p-4 my-container nav-body">
            <button class="btn text-white d-block d-lg-none" id="menu-btn"><i class="bi bi-arrow-right-square-fill fs-5 text-secondary"></i></button>
            <div class="row m-2 my_div">
                <div class="col-12 pt-4 mb-3">
                    <h2 class="text-center text-white">Message</h2>
                </div>
                <div class="col-11 mb-3 mx-auto">
                    <div class="row">
                        <div class="col-12 col-lg-5 px-0 my_div1" style="height: 500px; overflow-y: scroll;">
                            <div class="my_div1">
                                <div class="my_div1 px-4 py-2">
                                    <h5 class="mb-0 py-1">Recent</h5>
                                </div>

                                <div class="col-12">
                                    <?php

                                    $sender_rs = Database::search("SELECT * FROM `user` WHERE `email`!='" . $adminEmail . "' ");
                                    $sender_count = $sender_rs->num_rows;

                                    for ($y = 0; $y < $sender_count; $y++) {
                                        $sender_data = $sender_rs->fetch_assoc();

                                        $profile_rs = Database::search("SELECT * FROM `user` INNER JOIN `profile_img` ON `user`.`email`=`profile_img`.`user_email` INNER JOIN `message` WHERE `email`='" . $sender_data["email"] . "' ORDER BY `date_time` DESC");
                                        $profile_count = $profile_rs->num_rows;

                                        $profile_data = $profile_rs->fetch_assoc();


                                        // $message_rs = Database::search("SELECT DISTINCT `from`,`content`,`date_time`,`status`,`to` FROM `message` WHERE `to`='" . $adminEmail . "' OR `from`='" . $adminEmail . "' ORDER BY `date_time` DESC");
                                        $message_rs = Database::search("SELECT DISTINCT `from`,`content`,`date_time`,`status`,`to` FROM `message` WHERE `to`='" . $sender_data["email"] . "' OR `from`='" . $sender_data["email"] . "' ORDER BY `date_time` DESC");
                                        $message_num = $message_rs->num_rows;
                                        $message_data = $message_rs->fetch_assoc();


                                    ?>
                                        <div class="list-group rounded-0" onclick="viewAdminMessages('<?php echo $sender_data['email']; ?>');">
                                            <a class="list-group-item list-group-item-action text-white rounded-0 message_unreaded">

                                                <div>
                                                    <?php
                                                    if ($profile_count > 0) {
                                                    ?>
                                                        <img src="<?php echo $profile_data["code"]; ?>" height="50px" style="border-radius: 50%;"/>
                                                    <?php
                                                    }else{
                                                    ?>
                                                    <img src="icons/user_default.png" height="50px" class="rounded-circle rounded" />
                                                    <?php
                                                    }
                                                    ?>
                                                    <div class="me-4">
                                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                                            <h6 class="mb-0"><?php echo $sender_data["first_name"] . " " . $sender_data["last_name"]; ?></h6>
                                                            <?php
                                                            if ($message_num > 0) {
                                                            ?>
                                                                <small class="small fw-bold"><?php echo $message_data["date_time"]; ?></small>
                                                            <?php
                                                            }
                                                            ?>
                                                            <small class="small fw-bold"></small>
                                                        </div>
                                                        <!-- <p class="mb-0"><?php echo $message_data["content"]; ?></p> -->
                                                        <p class="mb-0"></p>

                                                    </div>
                                                </div>

                                            </a>
                                        </div>
                                    <?php
                                    }

                                    ?>
                                    

                                </div>


                            </div>
                        </div>
                        <div class="col-12 col-lg-7 px-0">
                            <div class="row px-4 py-5 text-white chat_box">

                                <div class="col-12" id="chat_box">
                                </div>

                            </div>
                            <!-- text -->
                            <div class="col-11 mx-auto align-bottom">
                                <div class="row">
                                    <div class="input-group">
                                        <input type="text" placeholder="Type your message..." aria-describedby="sendbtn" class="form-control rounded-0 border-0 py-3 bg-light" id="msgTxt" />
                                        <button id="sendbtn" class="btn btn-link fs-2 bg-dark text-white" onclick="sendAdminMsg('<?php echo $message_data['from']; ?>');">
                                            <i class="bi bi-send-fill"></i></button>
                                    </div>
                                </div>
                            </div>
                            <!-- text -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="p-4 my-containe nav-body bg_footer text-white">
            <?php require "footer.php"; ?>
        </section>

        <script>
            var menu_btn = document.querySelector("#menu-btn")
            var sidebar = document.querySelector("#sidebar")
            var container = document.querySelector(".my-container")
            menu_btn.addEventListener("click", () => {
                sidebar.classList.toggle("navbar")
                container.classList.toggle("cont")
            })
        </script>

        <!-- logout -->
        <div class="modal" tabindex="-1" id="adminLogOutConfirmationModal">
            <div class="modal-dialog">
                <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                    <div class="modal-header border-0">
                        <h5 class="modal-title fs-5 fw-bold">Confirmation</h5>
                        <a href="adminMessage.php" class="btn-close"></a>
                    </div>
                    <div class="modal-body text-center">
                        <label class="warning_message" style="height: 60px;"></label>
                        <br />
                        <label class="form-label fs-6">Do you want to logout?.</label>
                    </div>
                    <div class="modal-footer border-0">
                        <a href="adminSignin.php" class="btn btn-secondary" onclick="logOut();">Ok</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
    <?php
    } else if (!isset($_SESSION["admin"]["email"])) {
    ?>

        <!-- warning -->
        <div class="modal" tabindex="-1" id="userErrorModal">
            <div class="modal-dialog">
                <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold fs-5">Information</h5>
                        <a href="adminSignin.php" class="btn-close"></a>
                    </div>
                    <div class="modal-body text-center">
                        <label class="bi bi-exclamation-triangle-fill fs-1" style="color: #ff7e5f;"></label>
                        <br />
                        <label class="form-label fs-6">Please Sign In first.</label>
                    </div>
                    <div class="modal-footer border-0">
                        <a href="adminSignin.php" class="btn btn-secondary">Ok</a>
                    </div>
                </div>
            </div>
        </div>


        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script>
            var m = document.getElementById("userErrorModal");
            var svw = new bootstrap.Modal(m);
            svw.show();
        </script>
    <?php
    }
    ?>

</body>

</html>