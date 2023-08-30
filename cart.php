<?php

require "connection.php";

session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cart | clickShop</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="icon" href="resources/logo new.PNG" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="navigation.css" />
</head>

<body class="my_background1">
    <?php

    if (isset($_SESSION["user"]["email"])) {
        $userEmail = $_SESSION["user"]["email"];

        $total = 0;
        $ship = 0;
        $subtotal = 0;
        $shipping = 0;

        $user_address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $userEmail . "' ");
        $user_address_rs_count = $user_address_rs->num_rows;

        if ($user_address_rs_count != "0") {
    ?>
            <nav class="navbar navbar-expand d-flex flex-column align-item-start shadow" id="sidebar">

                <?php require "navigation.php"; ?>
                <script>
                    var btn = document.getElementById('cart');
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
                                <h2 class="text-center text-white">Cart</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 m-auto mb-4">
                                <div class="row my_div1">


                                    <div class="col-12 col-md-8 col-lg-6 m-auto mt-5">
                                        <div class="row">
                                            <div class="input-group mb-3">
                                                <input type="text" placeholder="Search in Cart..." class="form-control" aria-label="Text input with dropdown button" id="cart_search">
                                                <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="cartSearch();"><img src="icons/search.png" class="search_icon" /></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr class="hr1" />
                                    </div>

                                    <?php

                                    $cartrs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $userEmail . "'");
                                    $cartnum = $cartrs->num_rows;

                                    if ($cartnum == 0) {
                                    ?>

                                        <!-- empty cart -->
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12 text-center mt-5">
                                                    <img src="icons/add-to-cart (2).png" style="width: 250px;" />
                                                </div>
                                                <div class="col-12 text-center my-3">
                                                    <label class="form-label fs-1 fw-bolder mb-3">
                                                        You Have no items in your basket yet.
                                                    </label>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-5 mb-3 text-center m-auto d-grid">
                                                    <a href="home.php" class="btn btn-outline-primary">Start Shopping</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- empty cart -->

                                    <?php
                                    } else {
                                    ?>
                                        <div class="col-12 col-lg-9 my-2" id="cartContent">
                                            <?php
                                            $ship = 0;

                                            for ($x = 0; $x < $cartnum; $x++) {

                                                $cartrow = $cartrs->fetch_assoc();

                                                $bookrs = Database::search("SELECT * FROM `book` WHERE `id`='" . $cartrow["book_id"] . "' ");
                                                $book = $bookrs->fetch_assoc();

                                                $bookImages = Database::search("SELECT * FROM `images` WHERE `book_id`='" . $cartrow["book_id"] . "' ");
                                                $bimg = $bookImages->fetch_assoc();

                                                $languageList = Database::search("SELECT * FROM `language` WHERE `id`='" . $book["language"] . "' ");
                                                $language = $languageList->fetch_assoc();

                                                $userrs = Database::search("SELECT * FROM `user` WHERE `email`='" . $book["user_email"] . "' ");
                                                $user = $userrs->fetch_assoc();

                                                $total = $total + ($book["price"] * $cartrow["qty"]);

                                                $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $userEmail . "' ");
                                                $ar = $addressrs->fetch_assoc();
                                                $cityId = $ar["city_id"];

                                                $districtrs = Database::search("SELECT * FROM `city` WHERE `id`='" . $cityId . "' ");
                                                $dr = $districtrs->fetch_assoc();
                                                $districtId = $dr["district_id"];

                                                if ($districtId == 9) {
                                                    $ship = $book["delivery_fee_colombo"];
                                                    $shipping = $shipping + $book["delivery_fee_colombo"];
                                                } else {
                                                    $ship = $book["delivery_fee_other"];
                                                    $shipping = $shipping + $book["delivery_fee_other"];
                                                }

                                            ?>
                                                <!-- have book -->

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
                                                                <h4 class="card-title text-black-50 fw-bold">
                                                                    <?php echo $book["title"]; ?></h4>
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
                                                                        <input type="number" class="form-control d-grid" aria-describedby="basic-addon1" min="0" value="<?php echo $cartrow["qty"]; ?>" style="max-width: 60px;">
                                                                    </div>
                                                                    <div class="col-12 text-center">
                                                                        <span class="card-text text-primary"><?php echo $book["qty"]; ?></span>&nbsp;
                                                                        <span class="card-text text-success">Available</span>
                                                                    </div>
                                                                    <div class="col-12 text-center">
                                                                        <span class="card-text text-primary">Price :</span>
                                                                        <span class="card-text text-success">LKR.
                                                                            <?php echo $book["price"]; ?>.00</span>
                                                                    </div>
                                                                    <div class="col-12 text-center">
                                                                        <span class="card-text text-primary">Delivery Fee :</span>
                                                                        <span class="card-text text-success">LKR.
                                                                            <?php echo $ship; ?>.00</span>
                                                                    </div>
                                                                    <br />
                                                                    <div class="col-12 text-center">
                                                                        <div class="row g-2">
                                                                            <div class="col-6 d-grid">
                                                                                <a href='<?php echo "singleProductView.php?id=" . ($book["id"]); ?>' class="btn btn-outline-danger">Buy Now</a>
                                                                            </div>
                                                                            <div class="col-6 d-grid">
                                                                                <a class="btn btn-outline-danger" onclick="deleteFromCart(<?php echo $cartrow['id']; ?>);">Remove</a>
                                                                            </div>
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
                                                                    <span class="fw-bold fs-5 text-black-50">LKR.
                                                                        <?php echo ($book["price"] * $cartrow["qty"]) + $ship; ?>.00</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <!-- have book -->

                                        <?php
                                        if ($cartnum > 0) {
                                        ?>
                                            <div class="col-12 col-lg-3">
                                                <div class="row">

                                                    <div class="col-12">
                                                        <label class="form-label fs-3 fw-bold">Summary</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <hr />
                                                    </div>
                                                    <div class="col-6">
                                                        <span class="fs-6 fw-bold">Items (<?php echo $cartnum; ?>)</span>
                                                    </div>
                                                    <div class="col-6 text-end mb-3">
                                                        <span class="fs-6 fw-bold">LKR. <?php echo $total; ?>.00</span>
                                                    </div>
                                                    <div class="col-6">
                                                        <span class="fs-6 fw-bold">Shipping</span>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <span class="fs-6 fw-bold">LKR. <?php echo $shipping; ?>.00</span>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <hr />
                                                    </div>
                                                    <div class="col-4 mt-2">
                                                        <span class="fs-4 fw-bold">Total</span>
                                                    </div>
                                                    <div class="col-8 mt-2 text-end">
                                                        <span class="fs-4 fw-bold">LKR. <?php echo $total + $shipping; ?>.00</span>
                                                    </div>
                                                    <div class="col-12 mt-3 mb-3 d-grid">
                                                        <button class="btn btn-primary fs-5 fw-bold" onclick="checkoutListModal();">CHECKOUT</button>
                                                    </div>

                                                    <!-- checkout list -->
                                                    <!-- <form action="checkoutList.php" method="POST"> -->
                                                    <div class="modal" tabindex="-1" id="checkoutListModal">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                                                                <div class="modal-header border-0">
                                                                    <h5 class="modal-title fs-5 fw-bold">Select Books from Cart list</h5>
                                                                    <a href="cart.php" class="btn-close"></a>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <!-- <label class="warning_message" style="height: 60px;"></label> -->
                                                                    <!-- <br /> -->
                                                                    <?php
                                                                    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $userEmail . "'");
                                                                    $cart_count = $cart_rs->num_rows;

                                                                    for ($x = 0; $x < $cart_count; $x++) {
                                                                        $cart_list = $cart_rs->fetch_assoc();
                                                                        $image_rs = Database::search("SELECT * FROM `images` WHERE `book_id`='" . $cart_list["book_id"] . "'");
                                                                        $image_data = $image_rs->fetch_assoc();

                                                                        $book_rs = Database::search("SELECT * FROM `book` WHERE `id`='" . $cart_list["book_id"] . "'");
                                                                        $book_data = $book_rs->fetch_assoc();
                                                                    ?>

                                                                        <div class="form-group mb-3">
                                                                            <div class="shadow col-12 pt-2">
                                                                                <div class="row">
                                                                                    <div class="col-4">
                                                                                        <input type="checkbox" name="books[]" class="me-3 get_value" value="<?php echo $cart_list["book_id"]; ?>" id="checked_values" />
                                                                                        <label class="form-label fs-6"><img src="<?php echo $image_data["code"]; ?>" style="height: 60px;" /> </label>
                                                                                    </div>
                                                                                    <div class="col-5">

                                                                                        <label class="form-label fs-6"><?php echo $book_data["title"]; ?></label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="modal-footer border-0">
                                                                    <!-- <a href="cart.php" class="btn btn-secondary" onclick="jdosd();">Checkout</a> -->
                                                                    <button type="button" name="submit" id="submit" onclick="checkoutList();" class="btn btn-secondary">Checkout</button>
                                                                </div>

                                                                <!-- <script>
                                                                    $(document).ready(function(){
                                                                        $('#submit').click(function (){
                                                                            var checkedBooks = [];
                                                                            $('.get_value').each(function(){
                                                                                if($(this).is(":checked")){
                                                                                    checkedBooks.push($(this).val());
                                                                                }
                                                                            });
                                                                            checkedBooks = checkedBooks.toString();
                                                                            alert(checkedBooks);
                                                                            // $ajax({
                                                                            //     url:"insert.php",
                                                                            //     method:"POST",
                                                                            //     data:{checkedBooks:checkedBooks},
                                                                            //     success:function(data){
                                                                            //         $('#result').html(data);
                                                                            //     }
                                                                            // });
                                                                        });
                                                                    });
                                                                </script> -->

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- </form> -->
                                                    <!-- checkout list -->

                                                    <div id="result"></div>

                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }

                                    ?>
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
                            <a href="cart.php" class="btn-close"></a>
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
        } else {
        ?>
            <div class="modal" tabindex="1" id="profileNotUpdatedWarningModal">
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
                            <a href="userprofile.php" class="btn btn-secondary">Ok</a>
                        </div>
                    </div>
                </div>
            </div>

            <script src="script.js"></script>
            <script src="bootstrap.bundle.js"></script>
            <script>
                var m = document.getElementById("profileNotUpdatedWarningModal");
                var svw = new bootstrap.Modal(m);
                svw.show();
            </script>
        <?php
        }

        ?>
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