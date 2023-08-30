<?php

require "connection.php";

session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>User Profile | clickShop</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="icon" href="resources/logo new.PNG" />

    <link rel="stylesheet" href="progress.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="navigation.css">

</head>

<body class="my_background1">
    <?php

    if (isset($_SESSION["user"]["email"])) {

    ?>

        <nav class="navbar navbar-expand d-flex flex-column align-item-start shadow" id="sidebar">

            <?php require "navigation.php"; ?>
            <script>
                var btn = document.getElementById('profile');
                btn.style.backgroundColor = 'rgba(122, 118, 118, 0.5)';
            </script>

        </nav>
        <section class="p-4 my-container nav-body">
            <button class="btn text-white d-block d-lg-none" id="menu-btn"><i class="bi bi-arrow-right-square-fill fs-5 text-secondary"></i></button>
            <div class="row m-2 my_div">

                <div class="col-12 mb-3 pt-4">
                    <h2 class="text-center text-white">Profile</h2>
                </div>
                <div class="col-11 mx-auto">
                    <div class="row">
                        <!-- 1 -->
                        <div class="col-12 col-xl-5 mb-md-4 my_div1 div_one">
                            <div class="row justify-content-center">
                                <div class="col-12 mt-5" style="width: 135px;">

                                    <div class="align-items-center">

                                        <?php

                                        $profileImage = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $_SESSION["user"]["email"] . "'");
                                        $imgCount = $profileImage->num_rows;

                                        if ($imgCount == 1) {

                                            $profile = $profileImage->fetch_assoc();
                                        ?>
                                            <img src="<?php echo $profile["code"]; ?>" class="avatar_img" id="prev" />

                                        <?php
                                        } else {
                                        ?>

                                            <img src="icons/user_default.png" class="avatar_img" id="prev" />
                                        <?php
                                        }

                                        ?>
                                        <label class="image_btn" for="profile_img" onclick="changeImg();"><input type="file" class="d-none" id="profile_img" accept="img/*" />
                                            <img src="icons/camera.png" class="image_addon" />
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row mt-4 mb-4 justify-content-center">
                                        <div class="col-12 text-center">
                                            <div class="row">

                                                <?php

                                                $user_details = Database::search("SELECT * FROM `user` WHERE `email`='" . $_SESSION["user"]["email"] . "'");
                                                $user_data = $user_details->fetch_assoc();

                                                ?>
                                                <div class="col-4 mt-3 text-center">
                                                    <label class="my_text fs-5">Username</label>
                                                </div>
                                                <div class="col-8">
                                                    <input class="inputbox_user col-10" disabled type="text" value="<?php echo $user_data["username"] ?>" id="username" />
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row mt-2">
                                                <div class="col-4 mt-3 text-center">
                                                    <label class="my_text fs-5">Email</label>
                                                </div>
                                                <div class="col-8">
                                                    <input readonly class="inputbox_user col-10" type="text" value="<?php echo $user_data["email"] ?>" />
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row mt-2">
                                                <div class="col-4 mt-3 text-center">
                                                    <label class="my_text pb-2 fs-5">Password</label>
                                                </div>
                                                <div class="col-8">
                                                    <div class="input-group">
                                                        <input type="password" class="my_form_control1 my_text offset-1 col-9 text-center my_input" aria-label="enter your password" aria-describedby="button-addon2" value="<?php echo $user_data["password"] ?>" id="password">
                                                        <button class="btn border border-dark btn-outline-light my_input" id="button-addon2" type="button" onclick="pswd_addon();"><i class="bi bi-eye-fill" id="img_show"></i><i class="bi bi-eye-slash-fill d-none" id="img_hide"></i></button>
                                                    </div>
                                                </div>

                                            </div>
                                            <hr />
                                            <div class="row mt-2">
                                                <div class="col-4 mt-3 text-center">
                                                    <label class="my_text fs-5">Mobile</label>
                                                </div>
                                                <div class="col-8">
                                                    <input class="inputbox_user col-10" type="text" value="<?php echo $user_data["mobile"] ?>" id="mobile" />
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row mt-2">
                                                <div class="col-4 mt-3 text-center">
                                                    <label class="my_text fs-5">Registered Date</label>
                                                </div>
                                                <div class="col-8">

                                                    <?php

                                                    $reg_details = Database::search("SELECT * FROM `user` WHERE `email` = '" . $_SESSION["user"]["email"] . "'");
                                                    $reg_date = $reg_details->fetch_assoc();

                                                    ?>
                                                    <input readonly class="inputbox_user col-10" type="text" value="<?php echo $reg_date["register_date"]; ?>" />

                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row mt-2">
                                                <div class="col-4 mt-3 text-center">
                                                    <label class="my_text fs-5">Gender</label>
                                                </div>
                                                <div class="col-8">
                                                    <?php

                                                    $gender_id = $_SESSION["user"]["gender"];
                                                    $gender_details = Database::search("SELECT * FROM `gender` WHERE `id`='" . $gender_id . "'");
                                                    $user_gender = $gender_details->fetch_assoc();

                                                    ?>
                                                    <input readonly class="inputbox_user col-10" type="text" value="<?php echo $user_gender["name"]; ?>" />
                                                </div>
                                            </div>
                                            <hr />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 1 -->

                        <!-- 2 -->
                        <div class="col-12 col-xl-7 mt-4 mt-md-0 mb-md-4 ps-lg-4 div_two">
                            <div class="row">
                                <div class="col-12 pt-3 pb-4 my_div1">
                                    <div class="row mt-5">

                                        <div class="col-6">
                                            <label class="my_text fs-5">First Name</label>
                                            <input class="inputbox_user my_inputbox" type="text" placeholder="First Name" id="first_name" value="<?php echo $user_data["first_name"] ?>" />
                                        </div>
                                        <div class="col-6">
                                            <label class="my_text fs-5">Last Name</label>
                                            <input class="inputbox_user my_inputbox" type="text" placeholder="Last Name" id="last_name" value="<?php echo $user_data["last_name"] ?>" />
                                        </div>
                                    </div>

                                    <div class="row mt-3 justify-content-center">
                                        <?php

                                        $usermail = $_SESSION["user"]["email"];
                                        $address = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $usermail . "' ");
                                        $n = $address->num_rows;

                                        if ($n > 0) {
                                            $d = $address->fetch_assoc();

                                            $city = Database::search("SELECT * FROM `city` WHERE `id`='" . $d["city_id"] . "'");
                                            $cf = $city->fetch_assoc();

                                            $district = Database::search("SELECT * FROM `district` WHERE `id`='" . $cf["district_id"] . "'");
                                            $df = $district->fetch_assoc();

                                            $province = Database::search("SELECT * FROM `province` WHERE `id`='" . $df["province_id"] . "'");
                                            $pf = $province->fetch_assoc();

                                        ?>
                                            <div class="col-8 mt-3">
                                                <label class="my_text fs-5">Address</label>
                                                <input class="inputbox_user my_inputbox" type="text" placeholder="Address Line 01" id="address1" value="<?php echo $d["line1"] ?>" />
                                                <input class="inputbox_user" type="text" placeholder="Address Line 02" id="address2" value="<?php echo $d["line2"] ?>" />
                                            </div>
                                    </div>

                                    <div class="row mt-3 justify-content-center">
                                        <div class="col-8 mt-3">
                                            <label class="my_text fs-5">Province</label>
                                            <select class="inputbox">
                                                <option value="<?php echo $pf["id"]; ?>"><?php echo $pf["name"]; ?></option>
                                                <?php

                                                $pall = Database::search("SELECT * FROM `province` WHERE `name` != '" . $pf["name"] . "' ");
                                                $num1 = $pall->num_rows;

                                                for ($x = 1; $x <= $num1; $x++) {
                                                    $row1 = $pall->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $row1["id"] ?>" disabled><?php echo $row1["name"] ?></option>

                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-3 justify-content-center">
                                        <div class="col-8 mt-3">
                                            <label class="my_text fs-5">District</label>
                                            <select class="inputbox">
                                                <option value="<?php echo $df["id"] ?>"><?php echo $df["name"] ?></option>
                                                <?php

                                                $pall = Database::search("SELECT * FROM `district` WHERE `name` != '" . $pf["name"] . "' ");
                                                $num1 = $pall->num_rows;

                                                for ($x = 1; $x <= $num1; $x++) {
                                                    $row1 = $pall->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $row1["id"] ?>" disabled><?php echo $row1["name"] ?></option>

                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-3 justify-content-center">
                                        <div class="col-8 mt-3">
                                            <label class="my_text fs-5">City</label>
                                            <select class="inputbox" id="city">
                                                <option value="<?php echo $cf["id"] ?>"><?php echo $cf["name"] ?></option>
                                                <?php

                                                $pall = Database::search("SELECT * FROM `city` WHERE `name` != '" . $pf["name"] . "' ");
                                                $num1 = $pall->num_rows;

                                                for ($x = 1; $x <= $num1; $x++) {
                                                    $row1 = $pall->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $row1["id"] ?>"><?php echo $row1["name"] ?></option>

                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-3 justify-content-center">
                                        <div class="col-8 mt-3">
                                            <label class="my_text fs-5">Postal Code</label>
                                            <input class="inputbox_user" style="margin-top: -5px;" type="text" placeholder="Postal Code" id="postal_code" value="<?php echo $cf["postal_code"] ?>" />
                                        </div>
                                    </div>
                                <?php
                                        } else {

                                ?>
                                    <div class="row mt-3 justify-content-center">
                                        <div class="col-8">
                                            <label class="my_text fs-5">Address</label>
                                            <input class="inputbox_user my_inputbox" type="text" placeholder="Address Line 01" id="address1" value="" />
                                            <input class="inputbox_user" type="text" placeholder="Address Line 02" id="address2" value="" />
                                        </div>
                                    </div>

                                    <div class="row mt-3 justify-content-center">
                                        <div class="col-8 mt-3">
                                            <label class="my_text fs-5">Province</label>
                                            <select class="inputbox">
                                                <option>Select Your Province</option>

                                                <?php
                                                $pall = Database::search("SELECT * FROM `province`");
                                                $num1 = $pall->num_rows;

                                                for ($x = 1; $x <= $num1; $x++) {
                                                    $row1 = $pall->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $row1["id"] ?>" disabled><?php echo $row1["name"] ?></option>

                                                <?php

                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-3 justify-content-center">
                                        <div class="col-8 mt-3">
                                            <label class="my_text fs-5">District</label>
                                            <select class="inputbox">
                                                <option>Select Your District</option>

                                                <?php

                                                // $pall = Database::search("SELECT * FROM `district` WHERE `province_id`='".$row1["name"]."'");
                                                $pall = Database::search("SELECT * FROM `district`");
                                                $num1 = $pall->num_rows;

                                                for ($y = 0; $y <= $num1; $y++) {
                                                    $row2 = $pall->fetch_assoc();
                                                ?>

                                                    <option value="<?php echo $row2["id"] ?>" disabled><?php echo $row2["name"] ?></option>

                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-3 justify-content-center">
                                        <div class="col-8 mt-3">
                                            <label class="my_text fs-5">City</label>
                                            <select class="inputbox" id="city">
                                                <option>Select Your City</option>
                                                <?php

                                                $pall = Database::search("SELECT * FROM `city`");
                                                $num1 = $pall->num_rows;

                                                for ($z = 0; $z <= $num1; $z++) {
                                                    $row3 = $pall->fetch_assoc();
                                                ?>

                                                    <option value="<?php echo $row3["id"] ?>"><?php echo $row3["name"] ?></option>

                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-3 justify-content-center">
                                        <div class="col-8 mt-3">
                                            <label class="my_text fs-5">Postal Code</label>
                                            <input class="inputbox_user" style="margin-top: -5px;" type="text" placeholder="Postal Code" id="postal_code" value="" />
                                        </div>
                                    </div>

                                <?php
                                        }
                                ?>
                                <div class="row mt-3 py-2">

                                    <div class="col-12">
                                        <button class="btn-orange col-4 offset-4" onclick="updateProfile();">Update Profile</button>
                                    </div>
                                </div>

                                <div class="modal" tabindex="-1" id="updateProfileModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title text-dark fs-5">Profile Updated</h5>
                                                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <label id="modalStatus" style="height: 60px;"></label>
                                                <br />
                                                <label class="form-label fs-6 text-dark" id="updateProfileModalMsg"></label>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <a href="userprofile.php" class="btn btn-secondary" onclick="window.location.reload();">Close</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- 2 -->

                    <!-- 3 -->
                    <div class="row">

                        <div class="col-12 mb-4 mt-3 mt-lg-0 p-4 my_div1 div_three">
                            <div class="wrapper">

                                <div class="row d-flex justify-content-center">
                                    <h3 class="my_heading">Ratings</h3>

                                    <div class="col-4 col-lg-2 align-self-center">
                                        <div class="card border-0 ">
                                            <div class="circle c1">
                                                <div class="bar"></div>
                                                <div class="box"><span></span></div>
                                                <div class="text">1 Star</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-lg-2 align-self-center">
                                        <div class="card border border-0">
                                            <div class="circle c2">
                                                <div class="bar"></div>
                                                <div class="box"><span></span></div>
                                                <div class="text">2 Star</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-lg-2 align-self-center">
                                        <div class="card border-0">
                                            <div class="circle c3">
                                                <div class="bar"></div>
                                                <div class="box"><span></span></div>
                                                <div class="text">3 Star</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-lg-2 align-self-center">
                                        <div class="card border-0">
                                            <div class="circle c4">
                                                <div class="bar"></div>
                                                <div class="box"><span></span></div>
                                                <div class="text">4 Star</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-lg-2 align-self-center">
                                        <div class="card border-0">
                                            <div class="circle c5">
                                                <div class="bar"></div>
                                                <div class="box"><span></span></div>
                                                <div class="text">5 Star</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <section class="p-4 my-container nav-body bg_footer text-white">
            <?php require "footer.php"; ?>
        </section>
        <script>
            let options = {
                startAngle: -1.55,
                size: 100,
                value: 0.05,
                fill: {
                    gradient: ['#a445b2', '#fa4299']
                }
            }
            $(".circle .bar").circleProgress(options).on('circle-animation-progress',
                function(event, progress, stepValue) {
                    $(this).parent().find("span").text(String(stepValue.toFixed(2).substr(2)) + "%");
                });

            $(".c2 .bar").circleProgress({
                value: 0.10
            });
            $(".c3 .bar").circleProgress({
                value: 0.20
            });
            $(".c4 .bar").circleProgress({
                value: 0.25
            });
            $(".c5 .bar").circleProgress({
                value: 0.40
            });
        </script>

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
                        <a href="userprofile.php" class="btn-close"></a>
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