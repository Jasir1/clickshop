<?php
if (isset($_GET["cid"])) {

    require "connection.php";

    session_start();

?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>All Books | clickShop</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="icon" href="resources/logo new.PNG" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="seeAllStyle.css">
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="navigation.css">
    </head>

    <body class="my_background1">

        <nav class="navbar navbar-expand d-flex flex-column align-item-start shadow" id="sidebar">

            <?php require "navigation.php"; ?>

        </nav>
        <section class="p-4 my-containe nav-body">
            <button class="btn text-white d-block d-lg-none" id="menu-btn"><i class="bi bi-arrow-right-square-fill fs-5 text-secondary"></i></button>

            <!-- =============================================== -->
            <!-- Home content -->
            <div class="row m-2 my_div">

                <!-- home content -->
                <div class="col-11 mx-auto" id="homeContent">

                        <div class="col-12 mt-3">
                            <button class="btn btn-secondary" onclick="gohome();">Back</button>
                        </div>
                    <?php

                    $category = Database::search("SELECT * FROM `category` WHERE `id`='" . $_GET["cid"] . "'");
                    $categoryCount = $category->num_rows;

                    for ($x = 0; $x < $categoryCount; $x++) {
                        $categoryDetails = $category->fetch_assoc();

                    ?>
                        <div class="row my_div1 my-3">

                            <div class="col-12 mt-3">
                                <div class="col-12 col-sm-11 col-md-9 col-lg-6 my_banner">

                                    <h2 class="ps-5 d-inline-block "><?php echo $categoryDetails["name"]; ?>&nbsp;&nbsp;&nbsp;</h2>

                                    <!-- <img src="resources/Banner 1.jpeg"/> -->
                                </div>
                                <?php

                                $resultset = Database::search("SELECT * FROM `book` WHERE `category_id` = '" . $categoryDetails["id"] . "' AND `status_id`='1'  ORDER BY `date_time_added`");
                                $norows = $resultset->num_rows;

                                ?>

                                <!-- start -->
                                <div class="col-12 col-lg-11 mb-2" style="margin-left: auto; margin-right: auto;">
                                    <div class="row border border-white">

                                        <div class="col-sm-12 col-lg-12">
                                            <div class="row justify-content-center gap-2">

                                                <!-- //////////////////////////// -->


                                                <div class="col-sm-12 col-lg-12">
                                                    <div class="row justify-content-center gap-2">

                                                        <?php

                                                        for ($y = 0; $y < $norows; $y++) {
                                                            $book = $resultset->fetch_assoc();

                                                        ?>

                                                            <!-- 1 -->
                                                            <div class="card my_card col-6 col-lg-2 mt-2 mb-2" style="width: 13rem;">
                                                                <div class="product-image">
                                                                    <?php

                                                                    $bookImage = Database::search("SELECT * FROM `images` WHERE `book_id`='" . $book["id"] . "' ");
                                                                    $image = $bookImage->fetch_assoc();

                                                                    ?>
                                                                    <img class="card-img-top card-img-top mt-2" src="<?php echo $image["code"] ?>">
                                                                    <div class="info mt-2">

                                                                    </div>
                                                                </div>

                                                                <div class="card-body justify-content-center text-center">

                                                                    <?php

                                                                    $bookTitleList = Database::search("SELECT `title` FROM `book` WHERE `id`='" . $book["id"] . "'");
                                                                    $bookTitle = $bookTitleList->fetch_assoc();

                                                                    ?>
                                                                    <h6 class="card-title text-center"><?php echo $bookTitle["title"]; ?></h6>
                                                                    <span class="card-text text-primary fw-bold">LKR. <?php echo $book["price"]; ?>.00</span>
                                                                    <br />
                                                                    <span class="card-text text-success fw-bold fs"><?php echo $book["qty"]; ?> Items Left</span>

                                                                    <?php

                                                                    if ($book["qty"] > 0) {
                                                                    ?>
                                                                        <a href='<?php echo "singleProductView.php?id=" . ($book["id"]); ?>' class="btn btn-outline-primary col-12 mt-3">Buy Now</a>
                                                                        <div class="row gx-2">
                                                                            <div class="col-6 text-center d-grid mt-1">
                                                                                <a onclick="addToCart(<?php echo $book['id']; ?>);" class="btn btn-outline-primary" style="width: 100%;"><img src="icons/shopping-cart.png" class="btn_icon" /></a>
                                                                            </div>
                                                                        <?php
                                                                    } else {
                                                                        ?>

                                                                            <a href='<?php echo "singleProductView.php?id=" . ($book["id"]); ?>' class="btn btn-outline-primary col-12 mt-3 disabled">Buy Now</a>
                                                                            <div class="row gx-2">
                                                                                <div class="col-6 text-center d-grid mt-1">
                                                                                    <a href="#" class="btn btn-outline-primary disabled" style="width: 100%;"><img src="icons/shopping-cart.png" class="btn_icon" /></a>
                                                                                </div>


                                                                                <?php
                                                                            }
                                                                            if (isset($_SESSION["user"])) {
                                                                                $userEmail = $_SESSION["user"]["email"];

                                                                                $watchrs = Database::search("SELECT * FROM `watchlist` WHERE `book_id`='" . $book["id"] . "' AND `user_email` = '" . $userEmail . "' ");

                                                                                if ($watchrs->num_rows == 1) {
                                                                                ?>
                                                                                    <div class="col-6 text-center d-grid mt-1">
                                                                                        <a onclick="addToWatchlist(<?php echo $book['id'] ?>);" class="btn btn-outline-primary" style="width:100%;"><img src="icons/favorite1.png" class="btn_icon" id="heart" /></a>
                                                                                    </div>

                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <div class="col-6 text-center d-grid mt-1">
                                                                                        <a onclick="addToWatchlist(<?php echo $book['id'] ?>);" class="btn btn-outline-primary" style="width:100%;"><img src="icons/favorite.png" class="btn_icon" id="heart" /></a>
                                                                                    </div>

                                                                                <?php
                                                                                }
                                                                            } else {
                                                                                ?>
                                                                                <div class="col-6 text-center d-grid mt-1">
                                                                                    <a class="btn btn-outline-primary" onclick="emptyWatchlist();" style="width:100%;"><img src="icons/favorite.png" class="btn_icon" id="heart" /></a>
                                                                                </div>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                            <?php

                                                        }

                                                            ?>
                                                            <!-- 1 -->

                                                            </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>



                                        <!-- //////////////////////////// -->

                                    </div>

                                </div>

                            </div>
                        <?php

                    }

                        ?>
                        </div>
                </div>
                <div class="col-11 mx-auto">
                    <div class="row mt-3 justify-content-center d-none" id="advanceShow">
                        <div class="col-12 mb-3 my_div1">
                            <div class="row mt-3 justify-content-center">
                                <div class="col-2 text-center">
                                    <span class="text-black-50 fw-bold h1"><i class="bi bi-search fs-1"></i></span>
                                </div>
                            </div>
                            <div class="row my-3 justify-content-center">
                                <div class="col-8 text-center">
                                    <span class="text-black-50 fw-bold h1">Nothing Searched Yet.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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


<div class="modal" tabindex="-1" id="addToWatclistModal">
        <div class="modal-dialog">
            <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                <div class="modal-header border-0">
                    <h5 class="modal-title fs-5 fw-bold">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <label class="success_message" style="height: 60px;"></label>
                    <br />
                    <label class="form-label fs-6" id="addToWatclistMsg">Book added to watchlist successfully.</label>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" id="closeModal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" tabindex="-1" id="addToCartModal">
        <div class="modal-dialog">
            <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                <div class="modal-header border-0">
                    <h5 class="modal-title fs-5">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <label class="success_message" style="height: 60px;"></label>
                    <br />
                    <label class="form-label fs-6" id="addToCartMsg">Book added to cart successfully.</label>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" id="closeModal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- logout -->
    <div class="modal" tabindex="-1" id="logOutConfirmationModal">
        <div class="modal-dialog">
            <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                <div class="modal-header border-0">
                    <h5 class="modal-title fs-5">Confirmation</h5>
                    <a href="home.php" class="btn-close"></a>
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

        <!-- bootstrap js -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>
        <!-- custom js -->

        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="seeAllJScript.js"></script>
        <!-- <script>
            var m = document.getElementById("userErrorModal");
            var svw = new bootstrap.Modal(m);
            svw.show();
        </script> -->

    </body>

    </html>

<?php
}
?>