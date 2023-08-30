<?php

session_start();

require "connection.php";

$basicSearch = $_POST["sr"];
$basicSelect = $_POST["sl"];

$query = "SELECT * FROM book ";

if (!empty($basicSearch) && empty($basicSelect)) {
    $query .= "WHERE `title` LIKE '%" . $basicSearch . "%'";
} else if (empty($basicSearch) && $basicSelect != "0") {
    $query .= "WHERE `category_id` = '" . $basicSelect . "' ";
} else if (!empty($basicSearch) && $basicSelect != "0") {
    $query .= "WHERE `title` LIKE '%" . $basicSearch . "%' AND `category_id` = '" . $basicSelect . "'";
}

?>
<div class="row justify-content-center">
    <div class="col-12 my-3 my_div1">
        <div class="row px-5 justify-content-center">
            <?php

            if ("0" != ($_POST["page"])) {

                $pageno = $_POST["page"];
            } else {

                $pageno = 1;
            }

            $products = Database::search($query);
            $nProducts = $products->num_rows;
            $userProducts = $products->fetch_assoc();

            $results_per_page = 6;
            $number_of_pages = ceil($nProducts / $results_per_page);

            $viewed_results_count = ((int)$pageno - 1) * $results_per_page;
            $query .= "LIMIT " . $results_per_page . " OFFSET " . $viewed_results_count . " ";
            $selectedrs = Database::search($query);
            $srn = $selectedrs->num_rows;

            if ($srn == 0) {
            ?>
                <div class="col-12 col-lg-9">
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

            while ($ps = $selectedrs->fetch_assoc()) {

            ?>

                <div class="card mb-3 mt-3 col-12 col-lg-6 text-center bg-transparent border-1">
                    <div class="row my-2">
                        <div class="col-md-4">

                            <?php

                            $pimgrs = Database::search("SELECT * FROM `images` WHERE `book_id` = '" . $ps["id"] . "' ");
                            $presult = $pimgrs->fetch_assoc();

                            ?>

                            <img src="<?php echo $presult["code"]; ?>" class="img-fluid rounded-start" style="height: 14rem;">
                        </div>
                        <div class="col-md-8 align-self-center">
                            <div class="card-body">

                                <h5 class="card-title fw-bold"><?php echo $ps["title"]; ?></h5>
                                <span class="card-text text-primary fw-bold">LKR. <?php echo $ps["price"]; ?>.00</span>
                                <br />
                                <span class="card-text text-success fw-bold fs"><?php echo $ps["qty"]; ?> Items Left</span>

                                <div class="row">
                                    <div class="col-12">

                                        <?php

                                        if ($ps["qty"] > 0) {
                                        ?>
                                            <div class="row gx-2">
                                                <div class="col-4 text-center d-grid mt-1">
                                                    <a href='<?php echo "singleProductView.php?id=" . ($ps["id"]); ?>' class="btn btn-outline-primary">Buy Now</a>
                                                </div>
                                                <div class="col-4 text-center d-grid mt-1">
                                                    <a href="cart.php" onclick="addToCart(<?php echo $ps['id']; ?>);" class="btn btn-outline-primary" style="width: 100%;"><img src="icons/shopping-cart.png" class="btn_icon" /></a>
                                                </div>
                                            <?php
                                        } else {
                                            ?>

                                                <a href='<?php echo "singleProductView.php?id=" . ($ps["id"]); ?>' class="btn btn-outline-primary col-12 mt-3 disabled">Buy Now</a>
                                                <div class="row gx-2">
                                                    <div class="col-4 text-center d-grid mt-1">
                                                        <a href="#" class="btn btn-outline-primary disabled" style="width: 100%;"><img src="icons/shopping-cart.png" class="btn_icon" /></a>
                                                    </div>


                                                    <?php
                                                }
                                                if (isset($_SESSION["user"])) {
                                                    $userEmail = $_SESSION["user"]["email"];

                                                    $watchrs = Database::search("SELECT * FROM `watchlist` WHERE `book_id`='" . $ps["id"] . "' AND `user_email` = '" . $userEmail . "' ");

                                                    if ($watchrs->num_rows == 1) {
                                                    ?>
                                                        <div class="col-4 text-center d-grid mt-1">
                                                            <a onclick='addToWatchlist(<?php echo $ps["id"] ?>);' class="btn btn-outline-primary" style="width:100%;"><img src="icons/favorite1.png" class="btn_icon" id="heart" /></a>
                                                        </div>

                                                    <?php
                                                    } else {
                                                    ?>
                                                        <div class="col-4 text-center d-grid mt-1">
                                                            <a onclick='addToWatchlist(<?php echo $ps["id"] ?>);' class="btn btn-outline-primary" style="width:100%;"><img src="icons/favorite.png" class="btn_icon" id="heart" /></a>
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
                        </div>
                    </div>
                <?php

            }

                ?>
                </div>

                <?php

                if($srn>0){
                    ?>
                <div class="row justify-content-center">
                    <div class="col-12 mb-3 text-center">
                        <div class="pagination">

                            <!-- left arrow -->
                            <a <?php if ($pageno <= 1) {
                                    echo "#";
                                } else {

                                ?> onclick="advancedSearch('<?php echo ($pageno - 1); ?>');" <?php

                                                                                            } ?>> &laquo;</a>
                            <!-- left arrow -->


                            <?php

                            for ($page = 1; $page <= $number_of_pages; $page++) {

                                if ($page == $pageno) {
                            ?>

                                    <a onclick="advancedSearch('<?php echo $page; ?>');" class="active"><?php echo $page; ?></a>

                                <?php

                                } else {
                                ?>

                                    <a onclick="advancedSearch('<?php echo $page; ?>');"><?php echo $page; ?></a>

                            <?php

                                }
                            }

                            ?>

                            <!-- right arrow -->
                            <a <?php if ($pageno >= $number_of_pages) {
                                    echo "#";
                                } else {

                                ?> onclick="advancedSearch('<?php echo ($pageno + 1); ?>');" <?php

                                                                                            } ?>>&raquo;</a>
                            <!-- right arrow -->

                        </div>
                    </div>
                </div>
                
                <?php
                }
                ?>

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
        </div>
    </div>
</div>
</div>
</div>