<?php

require "connection.php";

session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home | clickShop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="icon" href="resources/logo new.PNG" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="navigation.css">
</head>

<body class="my_background1">

    <nav class="navbar navbar-expand d-flex flex-column align-item-start shadow" id="sidebar">

        <?php require "navigation.php"; ?>
        <script>
            var btn = document.getElementById('home');
            btn.style.backgroundColor = 'rgba(122, 118, 118, 0.5)';
        </script>

    </nav>
    <section class="p-4 my-container nav-body">
        <button class="btn text-white d-block d-lg-none" id="menu-btn"><i class="bi bi-arrow-right-square-fill fs-5 text-secondary"></i></button>

        <!-- =============================================== -->
        <!-- Home content -->
        <div class="row m-2 my_div">
            <div class="col-11 mt-3 mx-auto">
                <div class="col-12">
                    <button class="btn btn-secondary" onclick="pageRefresh();">Clear search</button>
                </div>
                <div class="row mt-3 my_div1">

                    <div class="col-12 px-5 col-lg-6 px-lg-0 align-items-center d-flex">
                        <div class="row justify-content-center">
                            <div class="col-12 col-lg-11 mt-4 text-center">
                                <span class="fs-1">Online Book Download</span>
                            </div>
                            <div class="col-12 col-lg-10 mt-3 text-center">
                                <span class="">Find thousands of books to download free eBooks.
                                    Browse categories to find your favorite literature genres: Romance, Fantasy, Thriller, Short Stories, Young Adult and Children's Books…</span>
                            </div>
                            <div class="col-12 col-lg-10 offset-lg-1 mt-4">
                                <div class="input-group mb-3">
                                    <input type="text" placeholder="Find Your Book Here" class="form-control" aria-label="Text input with dropdown button" id="basic_search">
                                    <select class="btn btn-outline-primary rounded" id="basic_select" onchange="basicSearch(0);">

                                        <option value="0">Select Category</option>

                                        <?php

                                        $categoryList = Database::search("SELECT * FROM category ");
                                        $nCategory = $categoryList->num_rows;

                                        for ($a = 0; $a < $nCategory; $a++) {
                                            $category = $categoryList->fetch_assoc();

                                        ?>

                                            <option value="<?php echo $category["id"]; ?>"><?php echo $category["name"]; ?></option>

                                        <?php
                                        }

                                        ?>
                                    </select>

                                    <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="basicSearch(0);"><img src="icons/search.png" class="search_icon" /></button>

                                </div>
                            </div>
                            <div class="col-12 col-lg-5 mt-2 mt-xl-5 mb-3 mb-lg-0 text-center">
                                <!-- <button class="btn btn-outline-green" onclick="advancedSearchButton();">Advanced Search</button> -->
                                <a href="advanceSearch.php" class="btn btn-outline-green" >Advanced Search</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 d-none d-lg-block">
                        <img src="resources/book_coverpage.jpg" class="col-12" />
                    </div>
                </div>
            </div>

            <!-- advanced search -->
            <!-- <div class="col-12" id="showQuery"></div> -->
            <div class="col-11 mx-auto">
                <div class="row my_div1 mt-3 d-none" id="advancedDiv">
                    <div class="row justify-content-center mt-2">
                        <div class="col-12 col-lg-5 my-2">
                            <input type="text" placeholder="Find Your Book by Title" class="form-control" id="searchTitle">
                        </div>
                        <div class="col-12 col-lg-5 my-2">
                            <input type="text" placeholder="Find Your Book by Author" class="form-control" id="searchAuthor">
                        </div>
                        <div class="col-12 col-lg-2 my-2 d-grid">
                            <button class="btn btn-outline-primary" type="button" id="searchButton" onclick="advancedSearch(0);"><img src="icons/search.png" class="search_icon" /> Search</button>
                        </div>

                        <hr class="hr1 mt-1" />
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-4 mb-2">
                            <select class="form-select" id="selectCategory" onchange="advancedSearch(0);">
                                <option value="0">Select Category</option>
                                <?php

                                $categoryList = Database::search("SELECT * FROM category ");
                                $nCategory = $categoryList->num_rows;

                                for ($a = 0; $a < $nCategory; $a++) {
                                    $category = $categoryList->fetch_assoc();

                                ?>

                                    <option value="<?php echo $category["id"]; ?>"><?php echo $category["name"]; ?></option>

                                <?php
                                }

                                ?>

                            </select>
                        </div>
                        <div class="col-12 col-lg-4 mb-2">
                            <select class="form-select" id="selectGenre" onchange="advancedSearch(0);">
                                <option value="0">Select Genre</option>
                                <?php

                                $genreList = Database::search("SELECT * FROM genre ");
                                $ngenre = $genreList->num_rows;

                                for ($b = 0; $b < $ngenre; $b++) {
                                    $genre = $genreList->fetch_assoc();

                                ?>

                                    <option value="<?php echo $genre["id"]; ?>"><?php echo $genre["name"]; ?></option>

                                <?php
                                }

                                ?>
                            </select>
                        </div>
                        <div class="col-12 col-lg-4 mb-2">
                            <select class="form-select" id="selectLanguage" onchange="advancedSearch(0);">
                                <option value="0">Select Language</option>
                                <?php

                                $languageList = Database::search("SELECT * FROM language ");
                                $nlanguage = $languageList->num_rows;

                                for ($c = 0; $c < $nlanguage; $c++) {
                                    $language = $languageList->fetch_assoc();

                                ?>

                                    <option value="<?php echo $language["id"]; ?>"><?php echo $language["name"]; ?></option>

                                <?php
                                }

                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-12 col-lg-6 my-3">
                            <div class="row">
                                <div class="col-12 col-lg-2 mt-2">
                                    <label>Price</label>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <input type="number" class="form-control" placeholder="Price From" id="priceFrom" onkeyup="advancedSearch(0);" />
                                </div>
                                <div class="col-12 col-lg-1 mt-1">
                                    <label> - </label>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <input type="number" class="form-control" placeholder="Price To" id="priceTo" onkeyup="advancedSearch(0);" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 my-3">
                            <div class="row">
                                <div class="col-12 col-lg-2 mt-2">
                                    <label>Page Count</label>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <input type="number" class="form-control" placeholder="Page Count From" id="pageFrom" onkeyup="advancedSearch(0);" />
                                </div>
                                <div class="col-12 col-lg-1 mt-1">
                                    <label> - </label>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <input type="number" class="form-control" placeholder="Page Count To" id="pageTo" onkeyup="advancedSearch(0);" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center text-center">
                        <div class="col-6 col-md-4 col-lg-3 d-grid mt-2 mb-4">
                            <button class="btn btn-secondary" onclick="clearSearch();">Clear</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- advanced search -->

            <!-- home content -->
            <div class="col-11 mx-auto" id="homeContent">
                <?php

                $category = Database::search("SELECT * FROM `category`");
                $categoryCount = $category->num_rows;

                for ($x = 0; $x < $categoryCount; $x++) {
                    $categoryDetails = $category->fetch_assoc();

                ?>
                    <div class="row my_div1 my-3">

                        <div class="col-12 mt-3">
                            <div class="col-12 col-sm-11 col-md-9 col-lg-6 my_banner">

                                <h2 class="ps-5 d-inline-block "><?php echo $categoryDetails["name"]; ?>&nbsp;&nbsp;&nbsp;</h2>

                                <!-- <img src="resources/Banner 1.jpeg"/> -->
                                <a class="link-dark link-3" style="cursor: pointer;" onclick="seeAllBooks('<?php echo $categoryDetails['id']; ?>');">See All&nbsp; &rarr;</a>
                            </div>
                            <?php

                            $resultset = Database::search("SELECT * FROM `book` WHERE `category_id` = '" . $categoryDetails["id"] . "' AND `status_id`='1' ORDER BY `date_time_added` DESC LIMIT 5 OFFSET 0 ");
                            $norows = $resultset->num_rows;

                            ?>

                            <!-- start -->
                            <div class="col-12 col-lg-11 mb-2" style="margin-left: auto; margin-right: auto;">
                                <div class="row border border-white">

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
                                                        <h6 class="card-title text-center" style="width: 10rem; line-break: loose;"><?php echo $bookTitle["title"]; ?></h6>
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

                        </div>
                    <?php

                }

                    ?>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- logout -->
    <div class="modal" tabindex="-1" id="logOutConfirmationModal">
        <div class="modal-dialog">
            <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                <div class="modal-header border-0">
                    <h5 class="modal-title fs-5 fw-bold">Confirmation</h5>
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
    <!-- <script>
            var m = document.getElementById("userErrorModal");
            var svw = new bootstrap.Modal(m);
            svw.show();
        </script> -->

</body>

</html>