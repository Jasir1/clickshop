<?php
session_start();
require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Single Product View | clickShop</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="icon" href="resources/logo new.png">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="navigation.css" />
</head>

<body class="my_background1" onload="viewOptionOnload();">
    <?php
    if (isset($_SESSION["user"]["email"])) {
        $userEmail = $_SESSION["user"]["email"];

        if (isset($_GET["id"])) {

            $bookid = $_GET["id"];

            $bookrs = Database::search("SELECT book.id,book.category_id,book.category_has_genre_id,book.title,book.overview,book.author,book.publisher,book.published_date,
    book.isbn,book.language,book.qty,book.page_count,book.description,book.price,book.status_id,book.user_email,book.date_time_added,
    book.delivery_fee_colombo,book.delivery_fee_other,category.name AS `cname` , genre.name AS `gname` FROM book INNER JOIN category_has_genre ON 
    category_has_genre.id = book.category_has_genre_id INNER JOIN category ON category.id = category_has_genre.category_id  
    INNER JOIN genre ON genre.id = category_has_genre.genre_id WHERE book.id ='" . $bookid . "' ");

            $bn = $bookrs->num_rows;

            if ($bn == 1) {

                $book = $bookrs->fetch_assoc();

    ?>

                <nav class="navbar navbar-expand d-flex flex-column align-item-start shadow" id="sidebar">

                    <?php require "navigation.php"; ?>

                </nav>
                <section class="p-4 my-containe nav-body">

                    <div class="row m-2 my_div">
                        <div class="col-11 mx-auto">

                            <div class="col-12 mb-3 pt-4">
                                <h2 class="text-center text-white">Single Product View</h2>
                            </div>
                            <div class="row my_div1 pe-1">

                                <div class="col-12 col-lg-8 px-5 px-lg-0 my-3">
                                    <div class="row justify-content-center">
                                        <div class="col-12 col-lg-6 p-3 text-center border border-top-0 border-bottom-0 border-start-0">

                                            <?php

                                            $bookImage = Database::search("SELECT * FROM images INNER JOIN book ON book.id = images.book_id 
                                        WHERE book.title= '" . $book["title"] . "' ");

                                            $bimg = $bookImage->fetch_assoc();

                                            ?>
                                            <img src="<?php echo $bimg["code"]; ?>" style="height: 30vh;" />
                                        </div>
                                        <div class="col-12 col-lg-6 text-center align-items-center d-flex border border-top-0 border-bottom-0 border-start-0 border-end-0">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="fs-4 fw-bold"><?php echo $book["title"]; ?></label>
                                                </div>
                                                <div class="col-12">
                                                    <label class="fs-5 text-primary fw-bold">By &nbsp; <label class="fs-5 text-success"><?php echo $book["author"]; ?></label></label>
                                                </div>
                                                <?php

                                                $userrs = Database::search("SELECT * FROM `user` WHERE `email`='" . $book["user_email"] . "' ");
                                                $user = $userrs->fetch_assoc();

                                                ?>
                                                <div class="col-12 mt-3">
                                                    <label class="fs-5 text-primary fw-bold">Seller's Name : <label class="fs-5 text-success"><?php echo $user["username"]; ?></label></label>
                                                </div>
                                                <div class="col-12">
                                                    <label class="fs-5 text-primary fw-bold">Seller's Email : <label class="fs-5 text-success"><?php echo $user["email"]; ?></label></label>
                                                </div>
                                                <div class="col-12">
                                                    <label class="fs-5 text-primary fw-bold">Seller's Mobile : <label class="fs-5 text-success"><?php echo $user["mobile"]; ?></label></label>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <label class="fs-5 text-primary fw-bold">Delivery Fee : <label class="fs-5 text-success">LKR. <?php echo $book["delivery_fee_other"]; ?>.00</label></label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 my-3 align-self-center border border-bottom-0 border-end-0 border-top-0">
                                    <div class="row text-center">
                                        <div class="col-12">
                                            <label class="fs-5">LKR. <?php echo $book["price"]; ?></label>&nbsp;&nbsp;
                                            <label class="fs-6 text-danger"><del>LKR. <?php $price = $book["price"];
                                                                                        $cal = ($book["price"] / 100) * 8;
                                                                                        $newprice = $price + $cal;
                                                                                        echo $newprice; ?></del></label>
                                        </div>
                                        <div class="col-12">
                                            <label class="fs-6 text-success">Save &nbsp;<label class="fs-5">LKR. <?php echo ($newprice - $price); ?> !</label></label>
                                        </div>
                                    </div>
                                    <div class="row mt-3 text-center">
                                        <div class="col-12">
                                            <label class="fs-5"><?php echo $book["qty"]; ?> Available</label>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="input-group mb-3 col-5 justify-content-center">
                                            <span class="input-group-text bg-transparent border border-0 fs-5" id="basic-addon1">Quantity :</span>
                                            <input type="number" onchange='check_qty(<?php echo $book["qty"]; ?>);' class="form-control d-grid fs-5" aria-describedby="basic-addon1" style="max-width: 70px;" value="1" min="1" id="qtyinput">
                                        </div>
                                    </div>
                                    <div class="row text-center my-3">
                                        <div class="col-12">
                                            <!-- <button class="col-4 btn btn-outline-primary">Add to cart</button>
                                        <button class="col-3 btn btn-outline-primary">Watchlist</button>
                                        <button class="col-3 btn btn-outline-primary">Buy now</button> -->

                                            <?php

                                            $bookTitleList = Database::search("SELECT `title` FROM `book` WHERE `id`='" . $book["id"] . "'");
                                            $bookTitle = $bookTitleList->fetch_assoc();

                                            $user_address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $userEmail . "' ");
                                            $user_address_rs_count = $user_address_rs->num_rows;

                                            if ($book["qty"] > 0) {
                                            ?>
                                                <div class="row gx-2">
                                                    <div class="col-4 text-center d-grid mt-1">
                                                        <!-- <a href='<?php echo "singleProductView.php?id=" . ($book["id"]); ?>' class="btn btn-outline-primary">Buy Now</a> -->
                                                        <!-- <a onclick="buynowprocess('<?php echo $bookid; ?>');" class="btn btn-outline-primary">Buy Now</a> -->

                                                        <?php
                                                        if ($user_address_rs_count == 0) {
                                                        ?>
                                                            <a onclick="buynowWarning();" class="btn btn-outline-primary">Buy Now</a>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <a onclick="buynow('<?php echo $bookid; ?>');" class="btn btn-outline-primary">Buy Now</a>
                                                        <?php
                                                        }
                                                        ?>

                                                        <div class="modal" tabindex="-1" id="buynowWarningModal">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                                                                    <div class="modal-header border-0">
                                                                        <h5 class="modal-title fs-5 fw-bold">Warning</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body text-center">
                                                                        <label class="warning_message" style="height: 60px;"></label>
                                                                        <br />
                                                                        <label class="form-label fs-6">Please update your profile details first</label>
                                                                    </div>
                                                                    <div class="modal-footer border-0">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="col-4 text-center d-grid mt-1">
                                                        <a href="cart.php" onclick="addToCart(<?php echo $book['id']; ?>);" class="btn btn-outline-primary" style="width: 100%;"><img src="icons/shopping-cart.png" class="btn_icon" /></a>
                                                    </div>
                                                <?php
                                            } else {
                                                ?>

                                                    <a href='<?php echo "singleProductView.php?id=" . ($book["id"]); ?>' class="btn btn-outline-primary col-12 mt-3 disabled">Buy Now</a>
                                                    <div class="row gx-2">
                                                        <div class="col-4 text-center d-grid mt-1">
                                                            <a href="#" class="btn btn-outline-primary disabled" style="width: 100%;"><img src="icons/shopping-cart.png" class="btn_icon" /></a>
                                                        </div>


                                                        <?php
                                                    }
                                                    if (isset($_SESSION["user"])) {
                                                        $userEmail = $_SESSION["user"]["email"];

                                                        $watchrs = Database::search("SELECT * FROM `watchlist` WHERE `book_id`='" . $book["id"] . "' AND `user_email` = '" . $userEmail . "' ");

                                                        if ($watchrs->num_rows == 1) {
                                                        ?>
                                                            <div class="col-4 text-center d-grid mt-1">
                                                                <a onclick='addToWatchlist(<?php echo $book["id"] ?>);' class="btn btn-outline-primary" style="width:100%;"><img src="icons/favorite1.png" class="btn_icon" id="heart" /></a>
                                                            </div>

                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div class="col-4 text-center d-grid mt-1">
                                                                <a onclick='addToWatchlist(<?php echo $book["id"] ?>);' class="btn btn-outline-primary" style="width:100%;"><img src="icons/favorite.png" class="btn_icon" id="heart" /></a>
                                                            </div>

                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <div class="col-4 text-center d-grid mt-1">
                                                            <a class="btn btn-outline-primary" onclick="emptyWatchlist();" style="width:100%;"><img src="icons/favorite.png" class="btn_icon" id="heart" /></a>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my_div1 mt-3">
                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-12 btn-toolbar justify-content-center">

                                                <ul class="nav nav-tabs">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" aria-current="page" href="#" onclick="overviewOption();">Book Overview</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#" onclick="detailsOption();">Book Details</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#" onclick="reviewsOption();">Book Reviews</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#" onclick="feedbackOption();">Book Feedback</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-12">
                                                <hr class="hr1" />
                                            </div>

                                            <div class="col-12 mb-3">
                                                <div class="row">

                                                    <!-- overview -->
                                                    <div class="col-12 text-center" id="overview">
                                                        <span class="fs-6">
                                                            <?php echo $book["overview"]; ?>
                                                        </span>
                                                    </div>
                                                    <!-- overview -->

                                                    <!-- details -->
                                                    <div class="col-12 text-center" id="details">
                                                        <span class="fs-5">
                                                            <div class="col-12">
                                                                <label class="fs-5">Language :</label>

                                                                <?php

                                                                $languageList = Database::search("SELECT * FROM `language` WHERE `id`='" . $book["language"] . "' ");
                                                                $language = $languageList->fetch_assoc();

                                                                ?>
                                                                <label class="fs-5"><?php echo $language["name"]; ?></label>
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="fs-5">ISBN :</label>
                                                                <label class="fs-5"><?php echo $book["isbn"]; ?></label>
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="fs-5">Release Date :</label>
                                                                <label class="fs-5"><?php echo $book["published_date"]; ?></label>
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="fs-5">Publisher :</label>
                                                                <label class="fs-5"><?php echo $book["publisher"]; ?></label>
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="fs-5">Page Count :</label>
                                                                <label class="fs-5"><?php echo $book["page_count"]; ?></label>
                                                            </div>
                                                        </span>
                                                    </div>
                                                    <!-- details -->


                                                    <!-- reviews -->
                                                    <div class="col-12 text-center" id="reviews">
                                                        <span class="fs-5">
                                                            <span class="badge">
                                                                <i class="fa fa-star mt-1 text-warning fs-3"></i>
                                                                <i class="fa fa-star mt-1 text-warning fs-3"></i>
                                                                <i class="fa fa-star mt-1 text-warning fs-3"></i>
                                                                <i class="fa fa-star mt-1 text-warning fs-3"></i>
                                                                <i class="fa fa-star-half mt-1 text-warning fs-3"></i>
                                                                <br />
                                                                <br />
                                                                <label class="text-dark fs-5"> 4.5 Stars</label>
                                                                <br />
                                                                <br />
                                                                <label class="text-dark fs-5"> 32 | 35 Ratings & Reviews</label>
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <!-- reviews -->

                                                    <!-- feedback -->
                                                    <div class="col-12 col-md-11 mx-auto text-center overflow-auto" id="feedback">
                                                        <div class="row g-2">

                                                            <?php

                                                            $feedback_rs = Database::search("SELECT * FROM `feedback` WHERE `book_id`='" . $bookid . "'");
                                                            $feedback_num = $feedback_rs->num_rows;

                                                            if ($feedback_num > 0) {

                                                                for ($x = 0; $x < $feedback_num; $x++) {
                                                                    $feedback_data = $feedback_rs->fetch_assoc();

                                                                    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $feedback_data["user_email"] . "'");
                                                                    $user_data = $user_rs->fetch_assoc();

                                                            ?>
                                                                    <div class="col-12 col-lg-6 shadow border border-1 border-black-50 rounded">
                                                                        <div class="row">
                                                                            <div class="col-12 text-center">
                                                                                <span class="text-center fs-5 fw-bold"><?php echo $user_data["first_name"] . " " . $user_data["last_name"]; ?></span>
                                                                                <br />
                                                                                <span class="fs-6 fw-bold text-secondary"><?php echo $feedback_data["user_email"]; ?></span>
                                                                            </div>
                                                                            <div class="offset-1 col-10 text-center border border-1 border-warning rounded overflow-auto mt-2">
                                                                                <p class="fs-6 text-black">
                                                                                    <?php echo $feedback_data["feed"]; ?>
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-12 text-center mt-2">
                                                                                <span class="fs-6 text-black-50 fw-bold"><?php echo $feedback_data["date"]; ?></span>
                                                                            </div>
                                                                            <div class="col-12 mt-3 mb-3">
                                                                                <div class="row">

                                                                                    <?php

                                                                                    if ($feedback_data["type"] == 1) {
                                                                                    ?>
                                                                                        <div class="offset-1 col-10 bg-success text-center">
                                                                                            <span class="fs-5 fw-bold text-white">Positive Feedback</span>
                                                                                        </div>

                                                                                    <?php
                                                                                    } else if ($feedback_data["type"] == 2) {
                                                                                    ?>
                                                                                        <div class="offset-1 col-10 bg-warning text-center">
                                                                                            <span class="fs-5 fw-bold text-white">Neutral Feedback</span>
                                                                                        </div>
                                                                                    <?php
                                                                                    } else if ($feedback_data["type"] == 3) {
                                                                                    ?>
                                                                                        <div class="offset-1 col-10 bg-danger text-center">
                                                                                            <span class="fs-5 fw-bold text-white">Negative Feedback</span>
                                                                                        </div>
                                                                                    <?php
                                                                                    }

                                                                                    ?>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                </span>
                                                                <div class="col-12 mx-auto col-lg-9">
                                                                    <div class="row">
                                                                        <div class="col-12 text-center">
                                                                            <label class="form-label fs-1 fw-bolder mb-3">
                                                                                No Feedback posted yet.
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php
                                                            }

                                                            ?>
                                                        </div>
                                                    </div>
                                                    <!-- feedback -->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my_div1 mb-4 mt-3">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fs-3">Related Books</label>
                                            </div>
                                            <hr class="hr1" />
                                            <div class="col-11 m-auto">
                                                <div class="row px-3 mb-3 border border-1">

                                                    <?php

                                                    $bookList = Database::search("SELECT * FROM `book` WHERE `category_id`='" . $book["category_id"] . "' AND `id`!='" . $book["id"] . "' LIMIT 5 ");
                                                    $bookCount = $bookList->num_rows;

                                                    for ($a = 0; $a < $bookCount; $a++) {
                                                        $bf = $bookList->fetch_assoc();

                                                    ?>

                                                        <div class="card my_card col-6 col-lg-2 mt-2 mb-2 mx-1" style="width: 13rem;">
                                                            <div class="product-image">
                                                                <?php

                                                                $bookImage = Database::search("SELECT * FROM `images` WHERE `book_id`='" . $bf["id"] . "' ");
                                                                $image = $bookImage->fetch_assoc();

                                                                ?>
                                                                <img class="card-img-top card-img-top mt-2" src="<?php echo $image["code"] ?>">

                                                            </div>

                                                            <div class="card-body justify-content-center text-center">
                                                                <h6 class="card-title text-center"><?php echo $bf["title"] ?></h6>
                                                                <span class="card-text text-center">LKR. <?php echo $bf["price"] ?></span>

                                                                <?php

                                                                if ($bf["qty"] > 0) {
                                                                ?>
                                                                    <a href='<?php echo "singleProductView.php?id=" . ($bf["id"]); ?>' class="btn btn-outline-primary col-12 mt-3">Buy Now</a>
                                                                    <div class="row gx-2">
                                                                        <div class="col-6 text-center d-grid mt-1">
                                                                            <a onclick="addToCart(<?php echo $bf['id']; ?>);" class="btn btn-outline-primary" style="width: 100%;"><img src="icons/shopping-cart.png" class="btn_icon" /></a>
                                                                        </div>
                                                                    <?php
                                                                } else {
                                                                    ?>

                                                                        <a href='<?php echo "singleProductView.php?id=" . ($bf["id"]); ?>' class="btn btn-outline-primary col-12 mt-3 disabled">Buy Now</a>
                                                                        <div class="row gx-2">
                                                                            <div class="col-6 text-center d-grid mt-1">
                                                                                <a href="#" class="btn btn-outline-primary disabled" style="width: 100%;"><img src="icons/shopping-cart.png" class="btn_icon" /></a>
                                                                            </div>


                                                                            <?php
                                                                        }
                                                                        if (isset($_SESSION["user"])) {
                                                                            $userEmail = $_SESSION["user"]["email"];

                                                                            $watchrs = Database::search("SELECT * FROM `watchlist` WHERE `book_id`='" . $bf["id"] . "' AND `user_email` = '" . $userEmail . "' ");

                                                                            if ($watchrs->num_rows == 1) {
                                                                            ?>
                                                                                <div class="col-6 text-center d-grid mt-1">
                                                                                    <a onclick='addToWatchlist(<?php echo $bf["id"] ?>);' class="btn btn-outline-primary" style="width:100%;"><img src="icons/favorite1.png" class="btn_icon" id="heart" /></a>
                                                                                </div>

                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <div class="col-6 text-center d-grid mt-1">
                                                                                    <a onclick='addToWatchlist(<?php echo $bf["id"] ?>);' class="btn btn-outline-primary" style="width:100%;"><img src="icons/favorite.png" class="btn_icon" id="heart" /></a>
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

                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row my_div1 my-3">
                                        <div class="col-12 mt-3">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fs-3">Feedback</label>
                                                </div>
                                                <hr class="hr1" />
                                                <div class="col-12 col-md-2 mt-3">
                                                    <div class="row">
                                                        <div class="col-12 fw-bold">
                                                            <label>Feedback Type</label>
                                                        </div>
                                                        <div class="col-12 mt-3 px-5">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="r1" checked>
                                                                <label class="form-check-label text-success fw-bold" for="r1">
                                                                    Positive
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-3 px-5">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="r2">
                                                                <label class="form-check-label text-warning fw-bold" for="r2">
                                                                    Neutral
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-3 px-5">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="r3">
                                                                <label class="form-check-label text-danger fw-bold" for="r3">
                                                                    Negative
                                                                </label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-8 mt-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label class="form-label fw-bold">Customer's Feedback</label>
                                                        </div>
                                                        <div class="col-12 col-lg-10 px-5">
                                                            <textarea id="f" cols="30" rows="8" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="my-3 col-md-6 offset-1 col-12 d-grid">
                                                    <button class="btn btn-outline-primary" onclick="saveFeed(<?php echo $bookid; ?>);">Send Feedback</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

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
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal" tabindex="-1" id="saveFeedbackModal">
                            <div class="modal-dialog">
                                <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title fs-5 fw-bold">Success</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <label class="success_message" style="height: 60px;"></label>
                                        <br />
                                        <label class="form-label fs-6" id="saveFeedbackMsg">Feedback posted successfully.</label>
                                        <label class="form-label fs-6" id="saveFeedbackMsg">Thanks for your Feedback.</label>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal" tabindex="-1" id="feedbackErrorModal">
                            <div class="modal-dialog">
                                <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title fs-5 fw-bold">Information</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <label class="warning_message" style="height: 60px;"></label>
                                        <br />
                                        <label class="form-label fs-6" id="feedbackErrorMsg"></label>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal" tabindex="-1" id="addToCartModal">
                            <div class="modal-dialog">
                                <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title fs-5 fw-bold">Success</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <label class="success_message" style="height: 60px;"></label>
                                        <br />
                                        <label class="form-label fs-6" id="addToCartMsg">Book added to cart successfully.</label>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal" tabindex="-1" id="singleProductModal">
                            <div class="modal-dialog">
                                <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title fs-5 fw-bold">Information</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <label class="success_message" style="height: 60px;"></label>
                                        <br />
                                        <label class="form-label fs-6">Please signin first.</label>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                <div class="modal" tabindex="-1" id="logOutConfirmationModal">
                    <div class="modal-dialog">
                        <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                            <div class="modal-header border-0">
                                <h5 class="modal-title fs-5 fw-bold">Confirmation</h5>
                                <a href="watchlist.php" class="btn-close"></a>
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
            }
        }
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

    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" type="text/javascript"></script>
    <!-- <script src="plugins/star-ratting/jquery.barrating.min.js" type="text/javascript"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/jquery.barrating.min.js" integrity="sha512-nUuQ/Dau+I/iyRH0p9sp2CpKY9zrtMQvDUG7iiVY8IBMj8ZL45MnONMbgfpFAdIDb7zS5qEJ7S056oE7f+mCXw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>