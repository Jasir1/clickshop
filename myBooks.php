<?php

require "connection.php";

session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ClickShop | My Books</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="icon" href="resources/logo new.PNG" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="navigation.css" />
</head>

<body class="my_background1">
    <?php
    if (isset($_SESSION["user"]["email"])) {

        $status = 0;
        $pageNo;
    ?>
        <nav class="navbar navbar-expand d-flex flex-column align-item-start shadow" id="sidebar">

            <?php require "navigation.php"; ?>
            <script>
                var btn = document.getElementById('mybooks');
                btn.style.backgroundColor = 'rgba(122, 118, 118, 0.5)';
            </script>

        </nav>
        <section class="p-4 my-container nav-body">
            <button class="btn text-white d-block d-lg-none" id="menu-btn"><i class="bi bi-arrow-right-square-fill fs-5 text-secondary"></i></button>
            <div class="row m-2 my_div">
                <div class="col-11 mx-auto ">
                    <div class="col-12">

                        <div class="col-12 pt-4">
                            <button class="btn btn-secondary" onclick="pageRefresh();">Clear search</button>
                        </div>
                        <div class="col-12 mb-3">
                            <h2 class="text-center text-white">My Books</h2>
                        </div>
                    </div>
                    <div class="row my_div1">
                        <div class="col-12 col-md-8 col-lg-6 m-auto mt-5">
                            <div class="row">
                                <div class="input-group mb-3">
                                    <input type="text" placeholder="Search product here..." class="form-control" aria-label="Text input with dropdown button" id="search">
                                    <button class="btn btn-outline-primary bg-light" type="button" id="button-addon2" onclick="sortBooks();"><img src="icons/search.png" class="search_icon" /></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <h2>Sort Books</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="row pb-3">
                                <div class="col-12">
                                    <h4>Active time</h4>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault1" id="tn">
                                        <label class="form-check-label" for="tn">
                                            Newer to Oldest
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault1" id="to">
                                        <label class="form-check-label" for="to">
                                            Older to Newest
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 offset-1">
                            <div class="row pb-3">
                                <div class="col-12">
                                    <h4>By Price</h4>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault1" id="ph">
                                        <label class="form-check-label" for="ph">
                                            High to Low
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault1" id="pl">
                                        <label class="form-check-label" for="pl">
                                            Low to High
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 offset-1">
                            <div class="row pb-3">
                                <div class="col-12">
                                    <h4>By Quantity</h4>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault1" id="qh">
                                        <label class="form-check-label" for="qh">
                                            High to Low
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault1" id="ql">
                                        <label class="form-check-label" for="ql">
                                            Low to High
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <a href="#" class="btn btn-light btn-outline-primary d-grid" onclick="sortBooks();">Sort</a>
                                </div>
                                <div class="col-12 col-lg-6 d-grid">
                                    <a href="#" class="btn btn-light btn-outline-primary d-grid" onclick="clearFilters();">Clear Filters</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="hr1" />
                        </div>
                    </div>

                </div>
                <div class="col-11 mt-3 mx-auto mb-4 my_div1">
                    <div class="row mb-3">

                        <div class="col-12 ms-4 pt-3 mt-3 mt-lg-0">
                            <div class="row justify-content-center">
                                <div class="col-12" id="sort">
                                    <div class="row mx-4 justify-content-center">
                                        <!-- card -->
                                        <?php

                                        if (isset($_GET["page"])) {
                                            $pageNo = $_GET["page"];
                                        } else {
                                            $pageNo = 1;
                                        }

                                        $bookDetails = Database::search("SELECT * FROM `book` WHERE `user_email` = '" . $_SESSION["user"]["email"] . "'");
                                        $bookCount = $bookDetails->num_rows;


                                        $Book = $bookDetails->fetch_assoc();

                                        $result_per_page = 6;
                                        $number_of_pages = ceil($bookCount / $result_per_page);

                                        $page_first_result = ($pageNo - 1) * $result_per_page;
                                        $userBookDetails = Database::search("SELECT * FROM `book` WHERE `user_email`='" . $_SESSION["user"]["email"] . "' LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
                                        $userBookCount = $userBookDetails->num_rows;

                                        if ($bookCount > 0) {
                                            for ($x = 0; $x < $userBookCount; $x++) {
                                                $userBooks = $userBookDetails->fetch_assoc();

                                        ?>
                                                <div class="card mb-3 col-12 col-lg-6 bg-transparent">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <?php

                                                            $bookImage = Database::search("SELECT * FROM `images` WHERE `book_id`='" . $userBooks["id"] . "' ");
                                                            $bookCoverImage = $bookImage->fetch_assoc();

                                                            ?>
                                                            <img src="<?php echo $bookCoverImage["code"]; ?>" class="img-fluid rounded-start" style="height: 20vh;" />
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card-body text-center">
                                                                <h5 class="card-title fw-bold"><?php echo $userBooks["title"]; ?></h5>
                                                                <span class="card-text text-primary fw-bold">LKR. <?php echo $userBooks["price"]; ?></span>
                                                                <br />
                                                                <span class="card-text text-success fw-bold"><?php echo $userBooks["qty"]; ?> Items Available</span>
                                                                <br />
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" onclick="changeStatus(<?php echo $userBooks['id']; ?>);" <?php

                                                                                                                                                                                                                        if ($userBooks["status_id"] == 1) {
                                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                                        }

                                                                                                                                                                                                                        ?> />
                                                                    <label class="form-check-label" for="flexSwitchCheckChecked" id="checkLabel<?php echo $userBooks['id']; ?>">
                                                                        <?php

                                                                        if ($userBooks["status_id"] == 2) {
                                                                            echo "Make Your Product Active";
                                                                            Database::iud("UPDATE `book` SET `status_id`='2' WHERE `id`='" . $userBooks["id"] . "'"); /////////////////////////
                                                                        } else {
                                                                            echo "Make Your Product Deactive";
                                                                            Database::iud("UPDATE `book` SET `status_id`='1' WHERE `id`='" . $userBooks["id"] . "'"); /////////////////////
                                                                        }

                                                                        ?>
                                                                    </label>
                                                                </div>
                                                                <div class="row ">
                                                                    <div class="col-12">
                                                                        <div class="row g-1">

                                                                            <div class="col-12 col-lg-6 d-grid">
                                                                                <a class="btn btn-outline-success" onclick="sendId(<?php echo $userBooks['id']; ?>);">Update</a>
                                                                            </div>
                                                                            <div class="col-12 col-lg-6 d-grid">
                                                                                <button class="btn btn-outline-danger" disabled>Delete</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }

                                            ?>

                                            <!-- card -->
                                    </div>
                                </div>


                                <!-- pagination -->
                                <?php
                                            if ($status == "0") {
                                ?>

                                    <div class="col-12 my-4 text-center" id="pagination">
                                        <div class="pagination">
                                            <a href="
                                        <?php

                                                if ($pageNo <= 1) {
                                                    echo "#";
                                                } else {
                                                    echo "?page=" . ($pageNo - 1);
                                                }

                                        ?> ">&laquo;</a>

                                            <?php

                                                for ($page = 1; $page <= $number_of_pages; $page++) {
                                                    if ($page == $pageNo) {
                                            ?>

                                                    <a href="<?php echo "?page=" . ($page) ?>" class="active"><?php echo $page; ?></a>

                                                <?php
                                                    } else {
                                                ?>

                                                    <a href="<?php echo "?page=" . ($page) ?>"><?php echo $page; ?></a>

                                            <?php
                                                    }
                                                }

                                            ?>

                                            <a href="
                                        <?php

                                                if ($pageNo >= $number_of_pages) {
                                                    echo "#";
                                                } else {
                                                    echo "?page=" . ($pageNo + 1);
                                                }

                                        ?> ">&raquo;</a>
                                        </div>
                                    </div>
                                <?php
                                            }
                                        } else {
                                ?>

                            <?php
                                        }
                            ?>
                            </div>
                        </div>
                    </div>
                    <!-- pagination -->
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
                        <a href="myBooks.php" class="btn-close"></a>
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