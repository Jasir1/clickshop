<!DOCTYPE html>
<html>

<head>
    <title>Admin Sign In | clickShop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="icon" href="resources/logo new.png" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
</head>

<body class="my_background1">
    <div class="container-fluid vh-100 d-flex justify-content-center">
        <div class="row align-content-center">

            <!-- header -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center title1">Hi, Welcome to clickShop Admins</p>
                    </div>
                </div>
            </div>
            <!-- header -->
            <!-- content -->

            <div class="col-12 p-3">
                <div class="row">

                    <!-- sign in -->

                    <div class="col-12 col-sm-7 col-md-5 col-lg-4 mx-auto box1" id="signInBox">
                        <div class="row g-2">

                            <div class="col-12">
                                <p class="title2 text-center pt-2">Sign In to Your Admin Account</p>
                            </div>

                            <?php

                            $email = "";
                            $password = "";

                            if (isset($_COOKIE["email"])) {
                                $email = $_COOKIE["email"];
                            }
                            if (isset($_COOKIE["password"])) {
                                $password = $_COOKIE["password"];
                            }
                            ?>

                            <div class="col-12">
                                <input class="inputbox1" type="email" placeholder="Email" id="email2" value="<?php echo $email; ?>" />
                            </div>

                            <div class="col-12 gy-3">
                                <input class="inputbox1" type="password" placeholder="Password" id="password" value="<?php echo $password; ?>" />
                            </div>

                            <div class="col-6 gy-4 mx-auto">
                                <div class="form-check">
                                    <input class="form-check-input" value="1" type="checkbox" id="rememberMe">
                                    <label class="form-check-label ">Remember Me</label>
                                </div>
                            </div>

                            <div class="col-5 gy-4">
                                <a href="#" class="link-info" onclick="forgotPassword();">Forgot Password</a>
                            </div>

                            <div class="col-6 gy-3">
                                <button class="col-12 btn-orange" onclick="adminSignIn();">Sign In</button>
                            </div>

                            <div class="col-6 gy-3">
                                <button class="col-12 btn-orange"  onclick="customerLogin();">
                                    Back to Customer Log In
                                </button>
                            </div>

                            <div class="col-12"></div>

                            <!-- sign in -->

                        </div>

                    </div>
                </div>
            </div>

            <!-- content -->

            <!-- modal -->
            <div class="modal resetWindow1" tabindex="-1" id="passwordResetModal">
                <div class="modal-dialog resetWindow2">
                    <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                        <div class="modal-header border-0">
                            <h5 class="modal-title fw-bold fs-5">Password Reset</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="newPassword" />
                                        <button class="btn btn-outline-secondary" type="button" id="newPasswordShow" onclick="showbtn1();">Show</button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Confirm Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="confirmPassword" />
                                        <button class="btn btn-outline-secondary" type="button" id="confirmPasswordShow" onclick="showbtn2();">Show</button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Verification Code</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="code" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="passwordReset();">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->


            <!-- warning -->
            <div class="modal" tabindex="-1" id="adminSigninResponseModal">
                <div class="modal-dialog">
                    <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                        <div class="modal-header border-0">
                            <h5 class="modal-title fs-5 fw-bold">Warning</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <label class="warning_message" style="height: 60px;"></label>
                            <br />
                            <label class="form-label fs-6" id="responseMessage"></label>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- information -->
            <div class="modal" tabindex="-1" id="forgotPasswordModal">
                <div class="modal-dialog">
                <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                        <div class="modal-header border-0">
                            <h5 class="modal-title fs-5">Information</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                        <label class="success_message" style="height: 60px;"></label>
                            <br />
                            <label class="form-label fs-6 mt-4" id="responseMessages"></label>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>

</body>

</html>