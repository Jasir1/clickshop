<?php

require "connection.php";

session_start();

$book = $_SESSION["userBooks"];

if (isset($book)) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Update Book | clickShop</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/logo new.png" />

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="navigation.css" />
    </head>

    <body class="my_background1">
        <?php
        if (isset($_SESSION["user"]["email"])) {
        ?>
            <nav class="navbar navbar-expand d-flex flex-column align-item-start shadow" id="sidebar">

                <?php require "navigation.php"; ?>

            </nav>
            <section class="p-4 my-container nav-body">
                <button class="btn text-white d-block d-lg-none" id="menu-btn"><i class="bi bi-arrow-right-square-fill fs-5 text-secondary"></i></button>

                <div class="row m-2 my_div">

                    <div class="col-12 mb-3 pt-4">
                        <h2 class="text-center text-white">Update Book</h2>
                    </div>
                    <div class="col-11 mb-3 mx-auto">
                        <div class="row m-2 my_div1">
                            <span class="text-danger" id="msg"></span>

                            <div class="col-12 pb-4 pt-4">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="my_heading">Select Book Category</label>
                                            </div>
                                            <div class="col-12 my-3">
                                                <select class="col-12 my_inputbox cursor_no_drop" id="category" disabled>

                                                    <?php

                                                    $categoryGenre = Database::search("SELECT * FROM `category_has_genre` WHERE `id`='" . $book["category_has_genre_id"] . "'  ");
                                                    $cg = $categoryGenre->fetch_assoc();

                                                    $c = Database::search("SELECT * FROM `category` WHERE `id`='" . $cg["category_id"] . "' ");
                                                    $cd = $c->fetch_assoc();

                                                    ?>

                                                    <option value="0"><?php echo $cd["name"]; ?></option>


                                                    <?php

                                                    $categoryList = Database::search("SELECT * FROM `category`");
                                                    $categoryCount = $categoryList->num_rows;

                                                    for ($x = 0; $x < $categoryCount; $x++) {
                                                        $category = $categoryList->fetch_assoc();

                                                    ?>
                                                        <option value="<?php echo $category["id"] ?>"><?php echo $category["name"]; ?></option>

                                                    <?php
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="my_heading">Select Book Genres</label>
                                            </div>
                                            <div class="col-12 my-3">
                                                <select class="col-12 my_inputbox cursor_no_drop" id="genre" disabled>

                                                    <?php

                                                    $genre = Database::search("SELECT * FROM `genre` WHERE `id`='" . $cg["genre_id"] . "' ");
                                                    $g = $genre->fetch_assoc();

                                                    ?>
                                                    <option value="0"><?php echo $g["name"]; ?></option>

                                                    <?php

                                                    $genreList = Database::search("SELECT * FROM `genre`");
                                                    $genreCount = $genreList->num_rows;

                                                    for ($y = 0; $y < $genreCount; $y++) {
                                                        $genre = $genreList->fetch_assoc();

                                                    ?>

                                                        <option value="<?php echo $genre["id"] ?>"><?php echo $genre["name"]; ?></option>

                                                    <?php
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 pb-4 pt-4">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="my_heading">Title of Book</label>
                                            </div>
                                            <div class="col-12 col-lg-10 offset-lg-1">
                                                <input type="text" class="col-12 my_inputbox_1" id="title" value="<?php echo $book["title"]; ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="my_heading">Author Name</label>
                                            </div>
                                            <div class="col-12 col-lg-10 offset-lg-1">
                                                <input type="text" class="col-12 my_inputbox_1" id="author" value="<?php echo $book["author"]; ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="my_heading">Publisher Name</label>
                                            </div>
                                            <div class="col-12 col-lg-10 offset-lg-1">
                                                <input type="text" class="col-12 my_inputbox_1" id="publisher" value="<?php echo $book["publisher"]; ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="my_heading">Date of Published</label>
                                            </div>
                                            <div class="col-12 col-lg-10 offset-lg-1">
                                                <input type="month" class="col-12 my_inputbox_1" placeholder="Month - Year" id="publishedDate" value="<?php echo $book["published_date"]; ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="my_heading">ISBN</label>
                                            </div>
                                            <div class="col-12 col-lg-10 offset-lg-1">
                                                <input type="number" class="col-12 my_inputbox_1" min="0" id="isbn" value="<?php echo $book["isbn"]; ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="my_heading">Language</label>
                                            </div>
                                            <div class="col-12 col-lg-10 offset-lg-1">
                                                <select class="col-12 my_inputbox cursor_no_drop" id="language" disabled>
                                                    <?php
                                                    $dLanguageList = Database::search("SELECT * FROM `book` WHERE `language` = '" . $book["language"] . "' ");
                                                    $dLanguage = $dLanguageList->fetch_assoc();

                                                    $dLanguageNameList = Database::search("SELECT * FROM `language` WHERE `id` ='" . $book["language"] . "' ");
                                                    $dLanguageName = $dLanguageNameList->fetch_assoc();
                                                    ?>
                                                    <option value="<?php echo $book["language"]; ?>"><?php echo $dLanguageName["name"]; ?></option>



                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="my_heading">Add Quantity</label>
                                            </div>
                                            <div class="col-12 col-lg-10 offset-lg-1">
                                                <input type="number" class="col-12 my_inputbox" min="0" id="qty" value="<?php echo $book["qty"]; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="my_heading">Add Pages Count</label>
                                            </div>
                                            <div class="col-12 col-lg-10 offset-lg-1">
                                                <input type="number" class="col-12 my_inputbox" min="0" id="pageCount" value="<?php echo $book["page_count"]; ?>" />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 py-4">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="my_heading">Cost Per Book</label>
                                            </div>
                                            <div class="col-12 col-lg-10">
                                                <div class="input-group mb-3 pt-2">
                                                    <span class="input-group-text">LKR.</span>
                                                    <input type="text" class="my_form_control_cost" aria-label="Amount (to the nearest rupee)" id="price" value="<?php echo $book["price"]; ?>" />
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="my_heading">Delivery Cost Within Colombo</label>
                                            </div>
                                            <div class="col-12 col-lg-10">
                                                <div class="input-group mb-3 pt-2">
                                                    <span class="input-group-text">LKR.</span>
                                                    <input type="text" class="my_form_control_cost" aria-label="Amount (to the nearest rupee)" id="dwc" value="<?php echo $book["delivery_fee_colombo"]; ?>" />
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="my_heading">Delivery Cost Out Of Colombo</label>
                                            </div>
                                            <div class="col-12 col-lg-10">
                                                <div class="input-group mb-3 pt-2">
                                                    <span class="input-group-text">LKR.</span>
                                                    <input type="text" class="my_form_control_cost" aria-label="Amount (to the nearest rupee)" id="doc" value="<?php echo $book["delivery_fee_other"]; ?>" />
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 py-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="my_heading">Book Description</label>
                                    </div>
                                    <div class="col-12">
                                        <textarea class="my_textarea" cols="30" rows="5" id="description"><?php echo $book["description"]; ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 py-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="my_heading">Book Overview</label>
                                    </div>
                                    <div class="col-12">
                                        <textarea class="my_textarea" cols="30" rows="10" id="overview"><?php echo $book["overview"]; ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 py-4">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="my_heading">Add Book Cover Image</label>
                                            </div>
                                            <div class="col-12 my-4">
                                                <input type="file" class="d-none" accept="img/*" id="imageUploader" />
                                                <label for="imageUploader" class="col-5 col-md-3 col-lg-2" onclick="changeCoverImage();">
                                                    <?php
                                                    $coverImageDetails = Database::search("SELECT * FROM `images` WHERE `book_id`='" . $book["id"] . "'");
                                                    $coverImage = $coverImageDetails->fetch_assoc();
                                                    ?>
                                                    <img src="<?php echo $coverImage["code"]; ?>" class="ms-4" id="imagePrev" style="height: 25vh; cursor: pointer;" />
                                                </label>
                                            </div>
                                            <div class="col-12">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="my_heading">Add Book PDF File</label>
                                            </div>
                                            <div class="col-12 my-4">
                                                <input type="file" class="d-none" accept="pdf/*" id="pdfUploader" />
                                                <label for="pdfUploader" class="col-5 col-md-3 col-lg-2" onclick="changePdf();">
                                                    <img src="icons/pdf.png" id="pdfPrev" style="height: 25vh; cursor: pointer;" />
                                                </label>
                                            </div>
                                            <div class="col-12">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="col-12 py-4">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="my_heading">Add Book Cover Image</label>
                                        </div>
                                        <div class="col-12 my-4">
                                            <input type="file" class="d-none" accept="img/*" id="imageUploader" />
                                            <label for="imageUploader" class="col-5 col-md-3 col-lg-2" onclick="changeCoverImage();">
                                                <?php
                                                $coverImageDetails = Database::search("SELECT * FROM `images` WHERE `book_id`='" . $book["id"] . "'");
                                                $coverImage = $coverImageDetails->fetch_assoc();
                                                ?>
                                                <img src="<?php echo $coverImage["code"]; ?>" class="ms-4" id="prev" style="height: 25vh; cursor: pointer;" />
                                            </label>
                                        </div>
                                        <div class="col-12">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="my_heading">Add Book PDF File</label>
                                        </div>
                                        <div class="col-12 my-4">
                                            <input type="file" class="d-none" accept="img/*" id="pdfUploader" />
                                            <label for="pdfUploader" class="col-5 col-md-3 col-lg-2"><img src="icons/pdf.png" style="height: 25vh; cursor: pointer;" /></label>
                                        </div>
                                        <div class="col-12">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                            <div class="col-12 mt-3 mb-3 border border-5 border-start border-bottom-0 border-top-0 border-end-0 border-primary rounded my_div">
                                <div class="row">
                                    <div class="col-12 mt-3 mb-3">
                                        <label class="form-label fs-5 fw-bold">NOTICE :</label><br />
                                        <label class="form-label fs-6">We are taking 5% of the product from price from every product as a service charge.</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 py-4">
                                <button class="col-12 col-lg-4 offset-lg-4 btn1 btn-orange" onclick="updateBook();">Update</button>
                            </div>

                            <!-- success message modal -->
                            <div class="modal" tabindex="-1" id="updateBookModal">
                                <div class="modal-dialog">
                                    <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title fs-5 fw-bold">Success</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <label class="success_message" style="height: 60px;"></label>
                                            <br />
                                            <label class="form-label fs-6">Book updated successfully.</label>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- success message modal -->

                            <!-- error message modal -->
                            <div class="modal" tabindex="-1" id="errorMsgModal">
                                <div class="modal-dialog">
                                    <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title fs-5 fw-bold">Warning</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <label class="warning_message" style="height: 60px;"></label>
                                            <br />
                                            <label class="form-label fs-6" id="errorMessages"></label>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- error message modal -->

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
    } else {
        ?>
        <!-- warning -->
        <div class="modal" tabindex="-1" id="bookErrorModal">
            <div class="modal-dialog">
                <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                    <div class="modal-header border-0">
                        <h5 class="modal-title fs-5 fw-bold">Information</h5>
                        <a href="addproduct.php" class="btn-close"></a>
                    </div>
                    <div class="modal-body text-center">
                        <label class="warning_message" style="height: 60px;"></label>
                        <br />
                        <label class="form-label fs-6">Something Went Wrong.</label>
                    </div>
                    <div class="modal-footer border-0">
                        <a href="index.php" class="btn btn-secondary" onclick="logOut();">Ok</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script>
            var m = document.getElementById("bookErrorModal");
            var svw = new bootstrap.Modal(m);
            svw.show();
        </script>
    <?php
    }
    ?>

    </body>

    </html>