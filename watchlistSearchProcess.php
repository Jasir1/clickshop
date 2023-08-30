<?php

session_start();

require "connection.php";

$watchlistSearch = $_POST["sr"];

if (isset($_SESSION["user"])) {
    $userEmail = $_SESSION["user"]["email"];
}

// $w1 = Database::search("SELECT * FROM `book` INNER JOIN `watchlist` ON watchlist.book_id = book.id WHERE `title` LIKE '%" . $watchlistSearch . "%' ");
// $w = $w1->fetch_assoc();

// $s1 = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='".$userEmail."' AND `book_id`='".$w["id"]."' ");
// $s = $s1->fetch_assoc();

// INNER JOIN `watchlist` ON watchlist.user_email = '".$userEmail."';

// $s1 = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='".$userEmail."' ");
// $s = $s1->fetch_assoc();
// echo $s1->num_rows;
// echo $s["book_id"];

// $w1 = Database::search("SELECT * FROM `book` WHERE `title` LIKE '%".$watchlistSearch."%' AND `id`='".$s["book_id"]."'");
// $w1 = Database::search("SELECT * FROM `book` INNER JOIN `watchlist` ON watchlist.user_email = '".$userEmail."' WHERE book.title LIKE '%".$watchlistSearch."%' ");    //351
// $w1 = Database::search("SELECT * FROM book JOIN watchlist ON watchlist.user_email = '".$userEmail."' WHERE book.title LIKE '%".$watchlistSearch."%' ");    //351


// $w = $w1->fetch_assoc();
// echo "numrows".$w1->num_rows." ";
// echo $w["title"];


// $bookrs = Database::search("SELECT * FROM `book` WHERE `id` ='".$s["book_id"]."' ");
// $book1 = $bookrs->fetch_assoc();
// echo $bookrs->num_rows;
// echo $book1["title"];

// echo $s1["title"];
// echo $d1["title"];

// $watchlistNum = $s1->num_rows;
// echo $watchlistNum;

// $watchlist = $bookrs->fetch_assoc();

// $watchlist = $watchlistrs->fetch_assoc();

// SELECT * FROM clickshop.book WHERE `id` = (SELECT * FROM book WHERE `id`='')
// SELECT * FROM clickshop.book INNER JOIN `watchlist` ON watchlist.user_email = '".$userEmail."' WHERE book.title LIKE '%The%';

// SELECT * FROM clickshop.book INNER JOIN clickshop.watchlist ON watchlist.user_email = 'newofficial66@gmail.com' WHERE book.title LIKE '%The%';

// SELECT * FROM clickshop.watchlist WHERE `user_email` = 'newofficial66@gmail.com' AND `book_id` IN (SELECT `id` FROM clickshop.book WHERE `title` LIKE '%the%');

// echo $w1->num_rows;
// echo " ";
// echo "watclistid".$w["book_id"];
// echo "  ";

// $s= $s1->fetch_assoc();

// echo "bookNum".$s1->num_rows;
// echo "bookttle".$s["title"];

// echo $w["user_email"];
// echo $w["book_id"];

// for ($x = 0; $x < $watchlistNum; $x++) {
// while ($ps = $selectedrs->fetch_assoc()) {

?>
<div class="row">
    <div class="col-12 mt-3 my_div1">
        <div class="row px-2">
            <?php
            $w1 = Database::search("SELECT * FROM `watchlist` WHERE `user_email` = '" . $userEmail . "' AND `book_id` IN (SELECT `id` FROM `book` WHERE `title` LIKE '%" . $watchlistSearch . "%')");


            $wcount = $w1->num_rows;

            if ($wcount == 0) {
            ?>
                <div class="col-12">
                    <div class="row mt-5">
                        <div class="col-12 text-center">
                            <span class="text-black-50 fw-bold h1"><i class="bi bi-search fs-1"></i></span>
                        </div>
                        <div class="col-12 text-center">
                            <label class="form-label text-black-50 fs-1 fw-bolder mb-3">
                                Book not found.
                            </label>
                        </div>
                    </div>
                </div>

                <?php
            }

            for ($x = 0; $x < $wcount; $x++) {
                $w = $w1->fetch_assoc();

                $s1 = Database::search("SELECT * FROM `book` WHERE `id`='" . $w["book_id"] . "'");
                $scount = $s1->num_rows;

                for ($y = 0; $y < $scount; $y++) {
                    while ($book = $s1->fetch_assoc()) {

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
            }

                ?>
                        </div>
        </div>
    </div>
</div>