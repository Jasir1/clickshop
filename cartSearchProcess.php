<?php

session_start();

require "connection.php";

$cartSearch = $_POST["sr"];

if (isset($_SESSION["user"])) {
    $userEmail = $_SESSION["user"]["email"];
}

$total = 0;

$w1 = Database::search("SELECT * FROM `cart` WHERE `user_email` = '" . $userEmail . "' AND `book_id` IN (SELECT `id` FROM `book` WHERE `title` LIKE '%" . $cartSearch . "%')");

$wcount = $w1->num_rows;

if ($wcount == 0) {
?>
    <div class="col-12 col-lg-12">
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
            $bookImages = Database::search("SELECT * FROM `images` WHERE `book_id`='" . $book["id"] . "' ");
            $bimg = $bookImages->fetch_assoc();

            $languageList = Database::search("SELECT * FROM `language` WHERE `id`='" . $book["language"] . "' ");
            $language = $languageList->fetch_assoc();

            $userrs = Database::search("SELECT * FROM `user` WHERE `email`='" . $book["user_email"] . "' ");
            $user = $userrs->fetch_assoc();

            $total = $total + ($book["price"] * $w["qty"]);

            $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $userEmail . "' ");
            $ar = $addressrs->fetch_assoc();
            $cityId = $ar["city_id"];

            $districtrs = Database::search("SELECT * FROM `city` WHERE `id`='" . $cityId . "' ");
            $dr = $districtrs->fetch_assoc();
            $districtId = $dr["district_id"];

            $ship = 0;

            if ($districtId == 9) {
                $ship = $book["delivery_fee_colombo"];
                $shipping = $ship + $book["delivery_fee_colombo"];
            } else {
                $ship = $book["delivery_fee_other"];
                $shipping = $ship + $book["delivery_fee_other"];
            }

    ?>
            <!--  -->
            <div class="card mb-3 bg-transparent">
                <div class="row g-0 px-2">
                    <div class="col-md-12 mt-3">
                        <div class="row">
                            <div class="col-12">
                                <span class="fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
                                <span class="fw-bold text-black fs-5"><?php echo $user["username"]; ?></span>&nbsp;
                            </div>
                        </div>

                        <hr />
                    </div>
                    <div class="col-md-3 mb-3">
                        <img src="<?php echo $bimg["code"]; ?>" style="height: 25vh;" class="px-2" />
                    </div>
                    <div class="col-md-5 align-self-center">
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
                        </div>
                    </div>
                    <div class="col-md-4 m-auto">
                        <div class="row">
                            <div class="card-body d-grid">
                                <div class="input-group mb-2 col-5 justify-content-center">
                                    <span class="input-group-text bg-transparent border border-0 text-primary" id="basic-addon1">Quantity :</span>
                                    <input type="number" class="form-control d-grid" aria-describedby="basic-addon1" min="0" value="<?php echo $w["qty"]; ?>" style="max-width: 60px;">
                                </div>
                                <div class="col-12 text-center">
                                    <span class="card-text text-primary"><?php echo $book["qty"]; ?></span>&nbsp;
                                    <span class="card-text text-success">Available</span>
                                </div>
                                <div class="col-12 text-center">
                                    <span class="card-text text-primary">Price :</span>
                                    <span class="card-text text-success">LKR. <?php echo $book["price"]; ?>.00</span>
                                </div>
                                <div class="col-12 text-center">
                                    <span class="card-text text-primary">Delivery Fee :</span>
                                    <span class="card-text text-success">LKR. <?php echo $ship; ?>.00</span>
                                </div>
                                <br />
                                <div class="col-12 text-center">
                                    <div class="row g-2">
                                        <?php

                                        if ($book["qty"] > 0) {
                                        ?>
                                            <div class="col-6 d-grid">
                                                <a href='<?php echo "singleProductView.php?id=" . ($book["id"]); ?>' class="btn btn-outline-danger">Buy Now</a>
                                            </div>
                                            <div class="col-6 d-grid">
                                                <a class="btn btn-outline-danger" onclick="deleteFromCart(<?php echo $w['id']; ?>);">Remove</a>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="col-6 d-grid">
                                                <a href='<?php echo "singleProductView.php?id=" . ($book["id"]); ?>' class="btn btn-outline-danger disabled">Buy Now</a>
                                            </div>
                                            <div class="col-6 d-grid">
                                                <a class="btn btn-outline-danger" onclick="deleteFromCart(<?php echo $w['id']; ?>);">Remove</a>
                                            </div>

                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <hr />
                    <div class="col-md-12 mb-3">
                        <div class="row">
                            <div class="col-6 col-md-6">
                                <span class="fw-bold fs-5 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                            </div>
                            <div class="col-6 col-md-6 text-end">
                                <span class="fw-bold fs-5 text-black-50">Rs. <?php echo ($book["price"] * $w["qty"]) + $ship; ?>.00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  -->

<?php
        }
    }
}

?>