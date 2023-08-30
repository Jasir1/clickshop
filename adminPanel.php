<?php

session_start();

require "connection.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard | clickShop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">


    <link rel="icon" href="resources/logo new.png" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="navigation.css">
</head>

<body class="my_background1">

    <?php
    if (isset($_SESSION["admin"])) {

    ?>

        <nav class="navbar navbar-expand d-flex flex-column align-item-start shadow" id="sidebar">

            <?php require "adminNavigation.php"; ?>
            <script>
                var btn = document.getElementById('dashboard'); btn.style.backgroundColor = 'rgba(122, 118, 118, 0.5)';
            </script>

        </nav>
        <section class="p-4 my-container nav-body">
            <button class="btn text-white d-block d-lg-none" id="menu-btn"><i class="bi bi-arrow-right-square-fill fs-5 text-secondary"></i></button>

            <div class="row m-2 my_div">
                <div class="col-12 pt-4">
                    <h2 class="text-center text-white">Dashboard</h2>
                </div>
                <!-- home content -->

                <div class="col-11 mt-3 mx-auto">
                    <div class="row my_div1">

                        <div class="col-11 mt-3 mx-auto">
                            <div class="row g-3 justify-content-center">
                                <div class="col-12 col-md-5 col-lg-4 col-xl-3 me-md-3 my_div text-center">
                                    <div class="row mb-2 my_background">
                                        <div class="col-12">
                                            <label class="form-label fs-4 fw-bold">Daily Earnings</label>

                                            <?php

                                            $today = date("Y-m-d");
                                            $this_month = date("m");
                                            $this_year = date("Y");

                                            $a = "0";
                                            $b = "0";
                                            $c = "0";
                                            $d = "0";
                                            $e = "0";

                                            $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                            $invoice_num = $invoice_rs->num_rows;

                                            for ($x = 0; $x < $invoice_num; $x++) {

                                                $invoice_data = $invoice_rs->fetch_assoc();

                                                $e = $e + $invoice_data["qty"];
                                                $f = $invoice_data["date"];
                                                $split_date = explode(" ", $f);
                                                $pdate = $split_date[0];

                                                if ($pdate == $today) {
                                                    $a = $a + $invoice_data["total"];
                                                    $c = $c + $invoice_data["qty"];
                                                }
                                                $split_result = explode("-", $pdate);
                                                $pyear = $split_result[0];
                                                $pmonth = $split_result[1];

                                                if ($pyear == $this_year) {
                                                    if ($pmonth == $this_month) {
                                                        $b = $b + $invoice_data["total"];
                                                        $d = $d + $invoice_data["qty"];
                                                    }
                                                }
                                            }

                                            ?>
                                        </div>
                                        <div class="col-5">
                                            <i class="fa-solid fa-chart-simple fs-4 text-light"></i>
                                            <i class="fa-solid fa-chart-simple fs-4 text-light" style="transform: scaleX(1);"></i>
                                        </div>
                                        <div class="col-4">
                                            <span class="text-white">LKR <?php echo $a; ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-5 col-lg-4 col-xl-3 me-md-3 my_div text-center">
                                    <div class="row my_background">
                                        <div class="col-12">
                                            <label class="form-label fs-4 fw-bold">Monthly Earnings</label>
                                        </div>
                                        <div class="col-5">
                                            <i class="fa-solid fa-chart-simple fs-4 text-light"></i>
                                            <i class="fa-solid fa-chart-simple fs-4 text-light" style="transform: scaleX(1);"></i>
                                        </div>
                                        <div class="col-4">
                                            <span class="text-white">LKR <?php echo $b; ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-5 col-lg-4 col-xl-3 my_div text-center">
                                    <div class="row my_background">
                                        <div class="col-12">
                                            <label class="form-label fs-4 fw-bold">Today Sellings</label>
                                        </div>
                                        <div class="col-5" style="margin-top: -5px;">
                                            <i class="fa-solid fa-box fs-3 text-light"></i>
                                        </div>
                                        <div class="col-4">
                                            <span class="text-white"><?php echo $c; ?> Items</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-11 my-3 mx-auto">
                            <div class="row g-3 justify-content-center">
                                <div class="col-12 col-md-5 col-lg-4 col-xl-3 ms-3 me-3 my_div text-center">
                                    <div class="row mb-2 my_background">
                                        <div class="col-12">
                                            <label class="form-label fs-4 fw-bold">Monthly Sellings</label>
                                        </div>
                                        <div class="col-5" style="margin-top: -5px;">
                                            <i class="fa-solid fa-box fs-3 text-light"></i>
                                        </div>
                                        <div class="col-4">
                                            <span class="text-white"><?php echo $d; ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-5 col-lg-4 col-xl-3 me-md-3 my_div text-center">
                                    <div class="row my_background">
                                        <div class="col-12">
                                            <label class="form-label fs-4 fw-bold">Total Sellings</label>
                                        </div>
                                        <div class="col-5" style="margin-top: -5px;">
                                            <i class="fa-solid fa-box fs-3 text-light"></i>
                                        </div>
                                        <div class="col-4">
                                            <span class="text-white"><?php echo $e; ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-5 col-lg-4 col-xl-3 me-md-3 my_div text-center">
                                    <div class="row my_background">
                                        <div class="col-12">
                                            <label class="form-label fs-4 fw-bold">Total Engagements</label>
                                        </div>
                                        <div class="col-5" style="margin-top: -10px;">
                                            <i class="bi bi-people-fill fs-3 text-light"></i>
                                        </div>
                                        <div class="col-4">
                                            <?php

                                            $user_rs = Database::search("SELECT * FROM `user`");
                                            $user_num = $user_rs->num_rows;

                                            ?>
                                            <span class="text-white"><?php echo $user_num; ?> Members</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="hr1" />

                        <div class="col-11 mb-3 mx-auto">
                            <div class="row g-3 justify-content-center">
                                <div class="col-12 col-md-5 col-lg-4 col-xl-3 ms-3 me-3 my_div text-center">
                                    <div class="row mb-2 my_background">
                                        <div class="col-12">
                                            <label class="form-label fs-4 fw-bold">Total Books</label>
                                        </div>
                                        <div class="col-5" style="margin-top: -5px;">
                                            <i class="fa fa-regular fa-book fs-2 text-light"></i>
                                        </div>
                                        <div class="col-4">
                                            <?php

                                            $totalBookrs = Database::search("SELECT COUNT(`id`) AS `count` FROM `book`");
                                            $totalBook = $totalBookrs->fetch_assoc();

                                            ?>
                                            <span class="text-white"><?php echo $totalBook["count"]; ?> Books</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-5 col-lg-4 col-xl-3 me-md-3 my_div text-center">
                                    <div class="row my_background">
                                        <div class="col-12">
                                            <label class="form-label fs-4 fw-bold">Total Users</label>
                                        </div>
                                        <div class="col-5" style="margin-top: -5px;">
                                            <i class="bi bi-people-fill fs-3 text-light"></i>
                                        </div>
                                        <div class="col-4">
                                            <?php

                                            $totalUserrs = Database::search("SELECT COUNT(`email`) AS `count` FROM `user`");
                                            $totalUser = $totalUserrs->fetch_assoc();

                                            ?>
                                            <span class="text-white"><?php echo $totalUser["count"]; ?> Users</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="col-11 mb-3 mx-auto">
                    <div class="row mt-3 justify-content-center">
                        <div class="col-12 my_div1">
                            <div class="row my-3 ">
                                <div class="col-11 mx-auto my_div text-end">
                                    <span class="text-white">Active Time :</span>
                                    <?php
                                    $start_date = new DateTime("2021-11-29 00:00:00");

                                    $tdate = new DateTime();
                                    $tz = new DateTimeZone("Asia/Colombo");
                                    $tdate->setTimezone($tz);

                                    $end_date = new DateTime($tdate->format("Y-m-d H:i:s"));
                                    $difference = $end_date->diff($start_date);

                                    ?>
                                    <span class="text-white">
                                        <?php
                                        echo $difference->format('%Y') . " Years " . $difference->format('%m') . " Months " .
                                            $difference->format('%d') . " Days " . $difference->format('%H') . " Hours " .
                                            $difference->format('%i') . " Min " . $difference->format('%s') . " Sec ";
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3 my_div1">
                            <div class="row justify-content-center">
                                <div class="offset-1 offset-lg-0 col-10 col-lg-10 mt-3 mb-3 rounded my_div">
                                    <div class="row g-1">

                                        <div class="col-12 text-center">
                                            <label class="form-label fs-4 mt-2 fw-bold">Mostly Slod Book</label>
                                        </div>

                                        <?php

                                        $freq_rs = Database::search("SELECT `book_id`, COUNT(`book_id`) AS `value_occurence`
                                FROM `invoice` GROUP BY `book_id` ORDER BY `value_occurence`
                                DESC LIMIT 1");   // WHERE `date` LIKE '%" . $this_month . "%'

                                        $freq_num = $freq_rs->num_rows;

                                        if ($freq_num > 0) {
                                            // for($y=0;$y<$freq_num;$y++){
                                            $freq_data = $freq_rs->fetch_assoc();

                                            $book_rs = Database::search("SELECT * FROM `book` INNER JOIN `images` ON 
                                        book.id=images.book_id WHERE `id`='" . $freq_data["book_id"] . "'");

                                            $book_data = $book_rs->fetch_assoc();

                                            $qty_rs = Database::search("SELECT SUM(`qty`) AS total FROM `invoice` WHERE 
                                    `book_id`='" . $freq_data["book_id"] . "' AND `date` LIKE '%" . $today . "%'");

                                            $qty_data = $qty_rs->fetch_assoc();

                                        ?>

                                    </div>

                                    <div class="row g1">
                                        <div class="col-5 text-center">
                                            <img src="<?php echo $book_data["code"]; ?>" class="img-fluid rounded-top mt-3 mb-3" style="width: 140px;" />
                                        </div>

                                        <div class="col-7 text-center align-self-center">
                                            <div class="row">
                                                <div class="col-3 text-end">
                                                    <img src="resources/rank.png">
                                                </div>
                                                <div class="col-9 text-start">
                                                    <span class="fs-5 fw-bold"><?php echo $book_data["title"]; ?></span>
                                                    <br />
                                                    <span class="fs-6"><?php echo $qty_data["total"]; ?> Items</span>
                                                    <br />
                                                    <span class="fs-6">LKR. <?php echo $book_data["price"]; ?></span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="offset-1 offset-lg-0 col-10 col-lg-10 mt-3 mb-3 rounded my_div">
                                    <div class="row g-1">

                                        <div class="col-12 text-center">
                                            <label class="form-label fs-4 mt-2 fw-bold">Most Famous Seller</label>
                                        </div>
                                        <?php

                                            $seller_rs = Database::search("SELECT * FROM `user` INNER JOIN `profile_img` ON
                                user.email=profile_img.user_email WHERE `email`='" . $book_data["user_email"] . "'");

                                            $seller_data = $seller_rs->fetch_assoc();
                                        ?>

                                    </div>

                                    <div class="row g1">
                                        <div class="col-5 text-center">
                                            <img src="<?php echo $seller_data["code"]; ?>" class="img-fluid rounded-top mt-3 mb-3" style="width: 160px;" />
                                        </div>

                                        <div class="col-7 text-center align-self-center">
                                            <div class="row">
                                                <div class="col-3 text-end">
                                                    <img src="resources/rank.png">
                                                </div>
                                                <div class="col-9 text-start">
                                                    <span class="fs-5 fw-bold"><?php echo $seller_data["first_name"] . " " . $seller_data["last_name"]; ?></span>
                                                    <br />
                                                    <span class="fs-6"><?php echo $seller_data["email"]; ?></span>
                                                    <br />
                                                    <span class="fs-6"><?php echo $seller_data["mobile"]; ?></span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php
                                        }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
            <!-- </div> -->

            <!-- =============================================== -->
            <!-- Home content -->
        </section>


        <section class="p-4 my-container nav-body bg_footer text-white">
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
                        <a href="adminPanel.php" class="btn-close"></a>
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