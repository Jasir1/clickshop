<?php

require "connection.php";

$search_title = $_POST["st"];
$search_author = $_POST["sa"];
$select_category = $_POST["sc"];
$select_genre = $_POST["sg"];
$select_language = $_POST["sl"];
$price_from = $_POST["pf"];
$price_to = $_POST["pt"];
$page_from = $_POST["pgf"];
$page_to = $_POST["pgt"];


$query = "SELECT * FROM book ";

// all of 3 selecters not selected
$status = 0;

// price range not selected
$status2 = 0;

// title or author not selected
$status3 = 0;

// if (!empty($search_title) && empty($search_author)) {
//     $query .= "WHERE `title` LIKE '%" . $search_title . "%'";
//     $status3 = 1;
// } else if (empty($search_title) && !empty($search_author)) {
//     $query .= "WHERE `author` LIKE '%" . $search_author . "%'";
//     $status3 = 1;
// } else if (!empty($search_title) && !empty($search_author)) {
//     $query .= "WHERE `title` LIKE '%" . $search_title . "%' AND `author` LIKE '%" . $search_author . "%'";
//     $status3 = 1;
// }


$categoryHasGenreList = Database::search("SELECT * FROM category_has_genre WHERE `category_id` = '" . $select_category . "' AND `genre_id` = '" . $select_genre . "'");
$categoryHasGenre = $categoryHasGenreList->fetch_assoc();

// can't select genre without category...

if ($select_category != "0" && empty($select_genre) && empty($select_language)) {
    $query .= "WHERE `category_id` = '" . $select_category . "'";
    $status = 1;
    $status3 = 1;
} else if ($select_category != "0" && empty($select_genre) && $select_language != "0") {
    $query .= "WHERE `category_id` = '" . $select_category . "' AND `language` = '" . $select_language . "'";
    $status = 1;
    $status3 = 1;
} else if (empty($select_category) && $select_genre != "0" && empty($select_language)) {
    echo "Can't select genre without category...";
    $status = 1;
    $status3 = 1;
} else if (empty($select_category) && $select_genre != "0" && $select_language != "0") {
    echo "Can't select genre without category...";
    $status = 1;
    $status3 = 1;
} else if ($select_category != "0" && $select_genre != "0" && empty($select_language)) {
    $query .= "WHERE `category_has_genre_id` = '" . $categoryHasGenre["id"] . "'";
    $status = 1;
    $status3 = 1;
} else if ($select_category != "0" && $select_genre != "0" && $select_language != "0") {
    $query .= "WHERE `category_has_genre_id` = '" . $categoryHasGenre["id"] . "' AND `language` = '" . $select_language . "'";
    $status = 1;
    $status3 = 1;
} else if (empty($select_category) && empty($select_genre) && $select_language != "0") {
    $query .= "WHERE `language` = '" . $select_language . "'";
    $status = 1;
    $status3 = 1;
}



if ($status == 0) {
    if (!empty($price_from) && empty($price_to)) {
        $query .= "WHERE `price` >= '" . $price_from . "'";
        $status2 = 1;
        $status3 = 1;
    } else if (empty($price_from) && !empty($price_to)) {
        $query .= "WHERE `price` <= '" . $price_to . "'";
        $status2 = 1;
        $status3 = 1;
    } else if (!empty($price_from) && !empty($price_to)) {
        $query .= "WHERE `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "' ";
        $status2 = 1;
        $status3 = 1;
    }


    if (!empty($page_from) && empty($page_to)) {
        $query .= "WHERE `page_count` >= '" . $page_from . "'";
        $status2 = 1;
        $status3 = 1;
    } else if (empty($page_from) && !empty($page_to)) {
        $query .= "WHERE `page_count` <= '" . $page_to . "'";
        $status2 = 1;
        $status3 = 1;
    } else if (!empty($page_from) && !empty($page_to)) {
        $query .= "WHERE `page_count` BETWEEN '" . $page_from . "' AND '" . $page_to . "' ";
        $status2 = 1;
        $status3 = 1;
    }
} else if ($status == 1) {
    if (!empty($price_from) && empty($price_to)) {
        $query .= " AND `price` >= '" . $price_from . "'";
        $status2 = 1;
        $status3 = 1;
    } else if (empty($price_from) && !empty($price_to)) {
        $query .= " AND `price` <= '" . $price_to . "'";
        $status2 = 1;
        $status3 = 1;
    } else if (!empty($price_from) && !empty($price_to)) {
        $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "' ";
        $status2 = 1;
        $status3 = 1;
    }


    if (!empty($page_from) && empty($page_to)) {
        $query .= "AND `page_count` >= '" . $page_from . "'";
        $status2 = 1;
        $status3 = 1;
    } else if (empty($page_from) && !empty($page_to)) {
        $query .= "AND `page_count` <= '" . $page_to . "'";
        $status2 = 1;
        $status3 = 1;
    } else if (!empty($page_from) && !empty($page_to)) {
        $query .= "AND `page_count` BETWEEN '" . $page_from . "' AND '" . $page_to . "' ";
        $status2 = 1;
        $status3 = 1;
    }
}

if ($status3 == 0) {
    if (!empty($search_title) && empty($search_author)) {
        $query .= "WHERE `title` LIKE '%" . $search_title . "%'";
    } else if (empty($search_title) && !empty($search_author)) {
        $query .= "WHERE `author` LIKE '%" . $search_author . "%'";
    } else if (!empty($search_title) && !empty($search_author)) {
        $query .= "WHERE `title` LIKE '%" . $search_title . "%' AND `author` LIKE '%" . $search_author . "%'";
    }
}

if ($status3 == 1) {
    if (!empty($search_title) && empty($search_author)) {
        $query .= "AND `title` LIKE '%" . $search_title . "%'";
    } else if (empty($search_title) && !empty($search_author)) {
        $query .= "AND `author` LIKE '%" . $search_author . "%'";
    } else if (!empty($search_title) && !empty($search_author)) {
        $query .= "AND `title` LIKE '%" . $search_title . "%' AND `author` LIKE '%" . $search_author . "%'";
    }
}

// echo "category".$select_category;
// echo " / ";
// echo "genre".$select_genre;
// echo " / ";
// echo "language".$select_language;
// echo " / ";
// echo "status".$status;

$query1 = $query;
// echo $query;

?>

<div class="col-12 mb-3 my_div1">
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
        $query1 .= "LIMIT " . $results_per_page . " OFFSET " . $viewed_results_count . " ";
        $selectedrs = Database::search($query1);
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

            <div class="card bg-transparent mb-3 mt-3 col-12 col-lg-6 text-center">
                <div class="row">
                    <div class="col-md-4">

                        <?php

                        $pimgrs = Database::search("SELECT * FROM `images` WHERE `book_id` = '" . $ps["id"] . "' ");
                        $presult = $pimgrs->fetch_assoc();

                        ?>

                        <img src="<?php echo $presult["code"]; ?>" class="img-fluid rounded-start" style="height: 14rem;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">

                            <h5 class="card-title fw-bold"><?php echo $ps["title"]; ?></h5>
                            <span class="card-text text-primary fw-bold"><?php echo $ps["price"]; ?></span>
                            <br />
                            <span class="card-text text-success fw-bold fs"><?php echo $ps["qty"]; ?> Items Left</span>

                            <div class="row">
                                <div class="col-12">

                                    <div class="row g-1">
                                        <div class="col-12 col-lg-4 d-grid">
                                            <a href='<?php echo "singleProductView.php?id=" . ($userProducts["id"]); ?>' class="btn btn-success fs">Buy Now</a>
                                        </div>
                                        <div class="col-12 col-lg-4 d-grid">
                                            <a onclick="addToCart(<?php echo $userProducts['id']; ?>);" class="btn btn-primary fs">Add to Cart</a>
                                        </div>
                                        <div class="col-12 col-lg-4 d-grid">
                                            <a onclick="addToWatchlist(<?php echo $userProducts['id'] ?>);" class="btn btn-light fs"><i class="bi bi-heart-fill"></i></a>
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
        <?php

        if ($srn > 0) {

        ?>
            <div class="col-12 mb-3 justify-content-center">
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

        <?php
        }

        ?>
    </div>
</div>