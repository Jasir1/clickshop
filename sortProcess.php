<?php

session_start();
$user = $_SESSION["user"];

require "connection.php";

$search = $_POST["s"];
$time = $_POST["t"];
$price = $_POST["p"];
$qty = $_POST["q"];

$query = "SELECT * FROM `book` WHERE `user_email` = '" . $user["email"] . "' ";

if ($time == "1") {
    $query .= "ORDER BY `date_time_added` DESC";
} else if ($time == "2") {
    $query .= "ORDER BY `date_time_added` ASC";
} else if (!empty($search)) {
    $query .= "AND `title` LIKE '%" . $search . "%'  ";
    $status = "0";
} else if ($price == "1") {
    $query .= "ORDER BY `price` DESC";
} else if ($price == "2") {
    $query .= "ORDER BY `price` ASC";
} else if ($qty == "1") {
    $query .= "ORDER BY `qty` DESC";
} else if ($qty == "2") {
    $query .= "ORDER BY `qty` ASC";
}

$newQuery = $query;
?>

<div class="row mx-4 justify-content-center">

    <?php

    if (isset($_GET["page"])) {
        $pageNo = $_GET["page"];
    } else {
        $pageNo = 1;
    }

    $bookDetails = Database::search($query);
    $bookCount = $bookDetails->num_rows;
    $Book = $bookDetails->fetch_assoc();

    $result_per_page = 6;
    $number_of_pages = ceil($bookCount / $result_per_page);

    $page_first_result = ($pageNo - 1) * $result_per_page;
    $userBookDetails = Database::search($newQuery . " LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
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
                            <h5 class="card-title"><?php echo $userBooks["title"]; ?></h5>
                            <span class="card-text">LKR. <?php echo $userBooks["price"]; ?></span>
                            <br />
                            <span class="card-text"><?php echo $userBooks["qty"]; ?> Items Available</span>
                            <br />
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" onclick="changeStatus(<?php echo $userBooks['id']; ?>);" <?php

                                                                                                                                                                                    if ($userBooks["status_id"] == 2) {
                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                    }

                                                                                                                                                                                    ?> />
                                <label class="form-check-label" for="flexSwitchCheckChecked" id="checkLabel<?php echo $userBooks['id']; ?>">
                                    <?php

                                    if ($userBooks["status_id"] == 2) {
                                        echo "Make Your Product Active";
                                    } else {
                                        echo "Make Your Product Deactive";
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
    } else {
        ?>
        <div class="col-11 mx-auto">
            <div class="row mt-3 justify-content-center d-none">
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
    <?php
    }
    ?>
</div>