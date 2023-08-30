<?php

require "connection.php";

session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Profile | clickShop</title>

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

    if (isset($_SESSION["admin"]["email"])) {

    ?>

        <nav class="navbar navbar-expand d-flex flex-column align-item-start shadow" id="sidebar">

            <?php require "adminNavigation.php"; ?>
            <script>
                var btn = document.getElementById('adminprofile');
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

                                        $profileImage = Database::search("SELECT * FROM `admin_profile_img` WHERE `admin_email`='" . $_SESSION["admin"]["email"] . "'");
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

                                                $admin_details = Database::search("SELECT * FROM `admin` WHERE `email`='" . $_SESSION["admin"]["email"] . "'");
                                                $admin_data = $admin_details->fetch_assoc();

                                                ?>
                                                <div class="col-4 mt-3 text-center">
                                                    <label class="my_text fs-5">Username</label>
                                                </div>
                                                <div class="col-8">
                                                    <input class="inputbox_user col-10" type="text" value="<?php echo $admin_data["username"] ?>" id="username" />
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row mt-2">
                                                <div class="col-4 mt-3 text-center">
                                                    <label class="my_text fs-5">Email</label>
                                                </div>
                                                <div class="col-8">
                                                    <input readonly class="inputbox_user col-10" type="text" value="<?php echo $admin_data["email"] ?>" />
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row mt-2">
                                                <div class="col-4 mt-3 text-center">
                                                    <label class="my_text pb-2 fs-5">Password</label>
                                                </div>
                                                <div class="col-8">
                                                    <div class="input-group">
                                                        <input type="password" class="my_form_control1 my_text offset-1 col-9 text-center my_input" aria-label="enter your password" aria-describedby="button-addon2" value="<?php echo $admin_data["password"] ?>" id="password">
                                                        <button class="btn border border-dark btn-outline-light my_input" id="button-addon2" type="button" onclick="pswd_addon();"><i class="bi bi-eye-fill" id="img_show"></i><i class="bi bi-eye-slash-fill d-none" id="img_hide"></i></button>
                                                    </div>
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
                                            <input class="inputbox_user my_inputbox" type="text" placeholder="First Name" id="first_name" value="<?php echo $admin_data["first_name"] ?>" />
                                        </div>
                                        <div class="col-6">
                                            <label class="my_text fs-5">Last Name</label>
                                            <input class="inputbox_user my_inputbox" type="text" placeholder="Last Name" id="last_name" value="<?php echo $admin_data["last_name"] ?>" />
                                        </div>
                                    </div>

                                    <hr />
                                    <div class="row mt-2">
                                        <div class="col-4 mt-3 text-center">
                                            <label class="my_text fs-5">Mobile</label>
                                        </div>
                                        <div class="col-8">
                                            <input class="inputbox_user col-10" type="text" value="<?php echo $admin_data["mobile"] ?>" id="mobile" />
                                        </div>
                                    </div>
                                    <hr />

                                    <div class="row mt-2">
                                        <div class="col-4 mt-3 text-center">
                                            <label class="my_text fs-5">Registered Date</label>
                                        </div>
                                        <div class="col-8">

                                            <?php

                                            $reg_details = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $_SESSION["admin"]["email"] . "'");
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

                                            $gender_id = $_SESSION["admin"]["gender"];
                                            $gender_details = Database::search("SELECT * FROM `gender` WHERE `id`='" . $gender_id . "'");
                                            $admin_gender = $gender_details->fetch_assoc();

                                            ?>
                                            <input readonly class="inputbox_user col-10" type="text" value="<?php echo $admin_gender["name"]; ?>" />
                                        </div>
                                    </div>
                                    <hr />

                                    <div class="row mt-3 py-2">

                                        <div class="col-12">
                                            <button class="btn-orange col-4 offset-4" onclick="updateAdminProfile();">Update Profile</button>
                                        </div>
                                    </div>

                                    <div class="modal" tabindex="-1" id="updateProfileModal">
                                        <div class="modal-dialog">
                                            <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title fs-5 fw-bold">Profile Updated</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <label class="success_message" style="height: 60px;"></label>
                                                    <br />
                                                    <label class="form-label fs-6" id="updateProfileMsg">Profile updated successfully.</label>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="button" class="btn btn-secondary" onclick="window.location.reload();">Close</button>
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
        <div class="modal" tabindex="-1" id="adminLogOutConfirmationModal">
            <div class="modal-dialog">
                <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                    <div class="modal-header border-0">
                        <h5 class="modal-title fs-5 fw-bold">Confirmation</h5>
                        <a href="adminProfile.php" class="btn-close"></a>
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
                        <h5 class="modal-title fs-5 fw-bold">Information</h5>
                        <a href="adminSignin.php" class="btn-close"></a>
                    </div>
                    <div class="modal-body text-center">
                        <label class="warning_message" style="height: 60px;"></label>
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