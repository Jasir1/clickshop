<?php

require "connection.php";

session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Watchlist | clickShop</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="icon" href="resources/logo new.PNG" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="navigation.css" />
</head>

<body class="my_background1" onload="emptyWatchlist();">
    <?php
    if (isset($_SESSION["user"]["email"])) {
        $userEmail = $_SESSION["user"]["email"];
    ?>
        <nav class="navbar navbar-expand d-flex flex-column align-item-start shadow" id="sidebar">

            <?php require "navigation.php"; ?>
            <script>
                var btn = document.getElementById('watchlist');
                btn.style.backgroundColor = 'rgba(122, 118, 118, 0.5)';
            </script>

        </nav>
        <section class="p-4 my-container nav-body">
            <button class="btn text-white d-block d-lg-none" id="menu-btn"><i class="bi bi-arrow-right-square-fill fs-5 text-secondary"></i></button>

            <div class="row m-2 my_div">

                <div class="col-11 mx-auto">
                    <div class="col-12">

                        <div class="col-12 pt-4">
                            <button class="btn btn-secondary" onclick="pageRefresh();">Clear search</button>
                        </div>
                        <div class="col-12 mb-3">
                            <h2 class="text-center text-white">Watchlist</h2>
                        </div>
                        <div class="row">

                            <div class="col-12 m-auto mb-4">
                                <div class="row my_div1">

                                    <div class="col-12 col-md-8 col-lg-6 m-auto mt-5">
                                        <div class="row">
                                            <div class="input-group mb-3">
                                                <input type="text" placeholder="Search in Watchlist..." class="form-control" aria-label="Text input with dropdown button" id="watchlist_search">
                                                <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="watchlistSearch();"><img src="icons/search.png" class="search_icon" /></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr class="hr1" />
                                    </div>
                                    <div class="col-12">
                                        <div class="row">


                                            <?php

                                            $bookrs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $userEmail . "' ");
                                            $bookCount = $bookrs->num_rows;
                                            if ($bookCount == 0) {
                                            ?>
                                                <!-- empty watchlist -->
                                                <div class="col-12 col-lg-12">
                                                    <div class="row">
                                                        <div class="col-12 text-center">
                                                            <img src="icons/clipboard.png" style="width: 300px;" />
                                                        </div>
                                                        <div class="col-12 text-center">
                                                            <label class="form-label fs-1 fw-bolder mb-3">
                                                                You Have no items in your Watchlist yet.
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- empty watchlist -->
                                            <?php
                                            } else {
                                            ?>
                                                <!-- have book -->
                                                <div class="col-12 col-lg-12 my-2" id="watchlistContent">

                                                    <?php

                                                    for ($x = 0; $x < $bookCount; $x++) {
                                                        $bookData = $bookrs->fetch_assoc();
                                                        $book_id = $bookData["book_id"];
                                                        $book_details = Database::search("SELECT * FROM `book` WHERE `id`='" . $book_id . "' ");
                                                        $bn = $book_details->num_rows;

                                                        if ($bn == 1) {
                                                            $book = $book_details->fetch_assoc();
                                                    ?>
                                                            <div class="card mb-3 bg-transparent">
                                                                <div class="row g-0">
                                                                    <div class="col-md-3">
                                                                        <?php

                                                                        $bookImages = Database::search("SELECT * FROM `images` WHERE `book_id`='" . $book["id"] . "' ");
                                                                        $bimg = $bookImages->fetch_assoc();

                                                                        $languageList = Database::search("SELECT * FROM `language` WHERE `id`='" . $book["language"] . "' ");
                                                                        $language = $languageList->fetch_assoc();

                                                                        $userrs = Database::search("SELECT * FROM `user` WHERE `email`='" . $userEmail . "' ");
                                                                        $user = $userrs->fetch_assoc();

                                                                        ?>
                                                                        <img src="<?php echo $bimg["code"]; ?>" style="height: 25vh;" class="p-2" />
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="card-body text-center">
                                                                            <h4 class="card-title text-black-50 fw-bold"><?php echo $book["title"]; ?></h4>
                                                                            <span class="card-text text-primary">Author :</span>
                                                                            <span class="card-text text-success"><?php echo $book["author"]; ?></span>
                                                                            <br />
                                                                            <span class="card-text text-primary">Language :</span>
                                                                            <span class="card-text text-success"><?php echo $language["name"]; ?></span>
                                                                            <br />
                                                                            <span class="card-text text-primary">ISBN :</span>
                                                                            <span class="card-text text-success"><?php echo $book["isbn"]; ?></span>
                                                                            <br />
                                                                            <span class="card-text text-primary">Release Date :</span>
                                                                            <span class="card-text text-success"><?php echo $book["published_date"]; ?></span>
                                                                            <br />
                                                                            <span class="card-text text-primary">Publisher :</span>
                                                                            <span class="card-text text-success"><?php echo $book["publisher"]; ?></span>
                                                                            <br />
                                                                            <br />
                                                                            <span class="card-text text-primary">Seller's Name : </span>
                                                                            <span class="card-text text-success"><?php echo $user["username"]; ?></span>
                                                                            <br />
                                                                            <span class="card-text text-primary">Seller's Email : </span>
                                                                            <span class="card-text text-success"><?php echo $user["email"]; ?></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 m-auto">
                                                                        <div class="card-body d-grid">

                                                                            <?php

                                                                            if ($book["qty"] > 0) {
                                                                            ?>
                                                                                <div class="row gx-2">
                                                                                    <div class="col-12 text-center d-grid mt-2">
                                                                                        <a href='<?php echo "singleProductView.php?id=" . ($book["id"]); ?>' class="btn btn-outline-primary">Buy Now</a>
                                                                                    </div>
                                                                                    <div class="col-12 text-center d-grid mt-2">
                                                                                        <a href="cart.php" onclick="addToCart(<?php echo $book['id']; ?>);" class="btn btn-outline-primary" style="width: 100%;"><img src="icons/shopping-cart.png" class="btn_icon" /></a>
                                                                                    </div>
                                                                                <?php
                                                                            } else {
                                                                                ?>

                                                                                    <a href='<?php echo "singleProductView.php?id=" . ($book["id"]); ?>' class="btn btn-outline-primary col-12 mt-3 disabled">Buy Now</a>
                                                                                    <div class="row gx-2">
                                                                                        <div class="col-12 text-center d-grid mt-2">
                                                                                            <a href="#" class="btn btn-outline-primary disabled" style="width: 100%;"><img src="icons/shopping-cart.png" class="btn_icon" /></a>
                                                                                        </div>


                                                                                    <?php
                                                                                }
                                                                                if (isset($_SESSION["user"])) {
                                                                                    $userEmail = $_SESSION["user"]["email"];

                                                                                    $watchrs = Database::search("SELECT * FROM `watchlist` WHERE `book_id`='" . $book["id"] . "' AND `user_email` = '" . $userEmail . "' ");
                                                                                    $watchrow = $watchrs->fetch_assoc();

                                                                                    ?>
                                                                                        <div class="col-12 text-center d-grid mt-2">
                                                                                            <a onclick='deleteFromWatchlist(<?php echo $watchrow["id"]; ?>);' class="btn btn-outline-primary" style="width:100%;"><img src="icons/favorite1.png" class="btn_icon" id="heart" /></a>
                                                                                        </div>
                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                        <div class="col-12 text-center d-grid mt-2">
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
                                                        <?php
                                                        }
                                                    }

                                                        ?>
                                                            </div>
                                                            <!-- have book -->
                                                        <?php
                                                    }

                                                        ?>

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