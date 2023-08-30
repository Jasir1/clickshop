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


<body onload="viewRecent();" class="my_background1">

    <?php

    if (isset($_SESSION["user"]["email"])) {
        $userEmail = $_SESSION["user"]["email"];

    ?>

        <nav class="navbar navbar-expand d-flex flex-column align-item-start shadow" id="sidebar">

            <?php require "navigation.php"; ?>
            <script>
                var btn = document.getElementById('message');
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
                        <div class="col-12 col-lg-5 px-0 my_div1">
                            <div class="my_div1">
                                <div class="my_div1 px-4 py-2">
                                    <h5 class="mb-0 py-1">Recent</h5>
                                </div>

                                <div class="col-12">
                                    <?php

                                    $message_rs = Database::search("SELECT DISTINCT `from`,`content`,`date_time`,`status`,`to` FROM `message` WHERE `from`='" . $userEmail . "' OR `to`='" . $userEmail . "'  ORDER BY `date_time` DESC LIMIT 1");
                                    $message_num = $message_rs->num_rows;

                                    ?>
                                    <!--  -->
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Chat</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                                            <!--  -->

                                            <div class="message_box" id="message_box">
                                                <?php

                                                for ($x = 0; $x < $message_num; $x++) {
                                                    $message_data = $message_rs->fetch_assoc();

                                                    if ($message_data["status"] == "0") {
                                                        //unreaded
                                                ?>
                                                        <?php
                                                        $user_rs = Database::search("SELECT * FROM `user` INNER JOIN `profile_img` ON `user`.`email`=`profile_img`.`user_email` WHERE `email`='" . $message_data["to"] . "' OR `email`='" . $message_data["from"] . "' ");

                                                        $user_count = $user_rs->num_rows;

                                                        if ($user_count > 0) {

                                                            $user_data = $user_rs->fetch_assoc();
                                                        ?>

                                                            <?php

                                                            if (is_null('<?php echo $message_data["to"]; ?>')) {
                                                            ?>
                                                                <div class="list-group rounded-0" onclick="viewMessages('<?php echo $message_data['from']; ?>');">
                                                                    <a class="list-group-item list-group-item-action text-white rounded-0 message_unreaded">

                                                                        <div>
                                                                            <img src="<?php echo $user_data["code"]; ?>" width="60px" class="rounded-circle" />
                                                                            <div class="me-4">
                                                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                                                    <h6 class="mb-0"><?php echo $user_data["first_name"] . " " . $user_data["last_name"]; ?></h6>
                                                                                    <small class="small fw-bold"><?php echo $message_data["date_time"]; ?></small>
                                                                                </div>
                                                                                <p class="mb-0"><?php echo $message_data["content"]; ?></p>
                                                                            </div>
                                                                        </div>

                                                                    </a>
                                                                </div>

                                                            <?php
                                                            } else {
                                                            ?>
                                                                <div class="list-group rounded-0" onclick="viewMessages('<?php echo $message_data['to']; ?>');">
                                                                    <a class="list-group-item list-group-item-action text-white rounded-0 message_unreaded">

                                                                        <div>
                                                                            <img src="<?php echo $user_data["code"]; ?>" width="60px" class="rounded-circle" />
                                                                            <div class="me-4">
                                                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                                                    <h6 class="mb-0"><?php echo $user_data["first_name"] . " " . $user_data["last_name"]; ?></h6>
                                                                                    <small class="small fw-bold"><?php echo $message_data["date_time"]; ?></small>
                                                                                </div>
                                                                                <p class="mb-0"><?php echo $message_data["content"]; ?></p>
                                                                            </div>
                                                                        </div>

                                                                    </a>
                                                                </div>

                                                        <?php
                                                            }
                                                        }
                                                        ?>

                                                    <?php
                                                    } else {
                                                        //readed
                                                    ?>
                                                        <?php
                                                        $user_rs = Database::search("SELECT * FROM `user` INNER JOIN `profile_img` ON `user`.`email`=`profile_img`.`user_email` WHERE `email`='" . $message_data["to"] . "' OR `email`='" . $message_data["from"] . "'");
                                                        $user_count = $user_rs->num_rows;

                                                        if ($user_count > 0) {

                                                            $user_data = $user_rs->fetch_assoc();
                                                        ?>

                                                            <?php

                                                            if (is_null('<?php echo $message_data["to"]; ?>')) {
                                                            ?>
                                                                <div class="list-group rounded-0" onclick="viewMessages('<?php echo $message_data['from']; ?>');">
                                                                    <a class="list-group-item list-group-item-action text-white rounded-0 message_readed">


                                                                        <div>
                                                                            <img src="<?php echo $user_data["code"]; ?>" width="60px" class="rounded-circle" />
                                                                            <div class="me-4">
                                                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                                                    <h6 class="mb-0"><?php echo $user_data["first_name"] . " " . $user_data["last_name"]; ?></h6>
                                                                                    <small class="small fw-bold"><?php echo $message_data["date_time"]; ?></small>
                                                                                </div>
                                                                                <p class="mb-0"><?php echo $message_data["content"]; ?></p>
                                                                            </div>
                                                                        </div>

                                                                    </a>
                                                                </div>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <div class="list-group rounded-0" onclick="viewMessages('<?php echo $message_data['to']; ?>');">
                                                                    <a class="list-group-item list-group-item-action text-white rounded-0 message_readed">


                                                                        <div>
                                                                            <img src="<?php echo $user_data["code"]; ?>" width="60px" class="rounded-circle" />
                                                                            <div class="me-4">
                                                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                                                    <h6 class="mb-0"><?php echo $user_data["first_name"] . " " . $user_data["last_name"]; ?></h6>
                                                                                    <small class="small fw-bold"><?php echo $message_data["date_time"]; ?></small>
                                                                                </div>
                                                                                <p class="mb-0"><?php echo $message_data["content"]; ?></p>
                                                                            </div>
                                                                        </div>

                                                                    </a>
                                                                </div>
                                                            <?php
                                                            }
                                                        }
                                                        ?>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <!--  -->
                                        </div>

                                    </div>
                                    <!--  -->

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
                                        <button id="sendbtn" class="btn fs-2 bg-dark text-white" onclick="sendMsg();">
                                            <i class="bi bi-send-fill"></i>
                                        </button>
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
        <div class="modal" tabindex="-1" id="logOutConfirmationModal">
            <div class="modal-dialog">
                <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                    <div class="modal-header border-0">
                        <h5 class="modal-title fs-5 fw-bold">Confirmation</h5>
                        <a href="message.php" class="btn-close"></a>
                    </div>
                    <div class="modal-body text-center">
                        <label class="warning_message" style="height: 60px;"></label>
                        <br />
                        <label class="form-label fs-6">Do you want to logout?.</label>
                    </div>
                    <div class="modal-footer border-0">
                        <a href="index.php" class="btn btn-secondary" onclick="logOut();">Ok</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
    <?php
    } else if (!isset($_SESSION["user"]["email"])) {
    ?>

        <!-- warning -->
        <div class="modal" tabindex="-1" id="userErrorModal">
            <div class="modal-dialog">
                <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                    <div class="modal-header border-0">
                        <h5 class="modal-title fs-5 fw-bold">Information</h5>
                        <a href="home.php" class="btn-close"></a>
                    </div>
                    <div class="modal-body text-center">
                        <label class="warning_message" style="height: 60px;"></label>
                        <br />
                        <label class="form-label fs-6">Please Sign In first.</label>
                    </div>
                    <div class="modal-footer border-0">
                        <a href="index.php" class="btn btn-secondary">Ok</a>
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