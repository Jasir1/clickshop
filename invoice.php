<?php

require "connection.php";

session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Invoice | Clickshop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">


    <link rel="icon" href="resources/logo new.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="navigation.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body class="my_background1">

    <?php
    if (isset($_SESSION["user"]["email"])) {
        $userEmail = $_SESSION["user"]["email"];

        $iid = $_GET["order_id"];

        if (isset($_GET["id"])) {

            $bookid = $_GET["id"];
        }
    ?>
        <nav class="navbar navbar-expand d-flex flex-column align-item-start shadow" id="sidebar">

            <?php require "navigation.php"; ?>

        </nav>
        <section class="p-4 my-containe nav-body">

            <div class="row m-2 my_div">
                <div class="col-12 mb-3 pt-4">
                    <h2 class="text-center text-white">Invoice</h2>
                </div>

                <div class="col-11 my_div1 mx-auto mb-4">
                    <div class="row g-3 justify-content-center">

                        <div class="col-12">
                            <hr />
                        </div>

                        <div class="col-12 btn-toolbar justify-content-start">
                            <button class="btn btn-orange me-2 fs-5 fw-bold" onclick="printInvoice();">Print</button>
                            <button class="btn btn-orange-fill fs-5 me-2 fw-bold">Export as PDF</button>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>

                        <div class="col-12" id="page">
                            <div class="row">

                                <!-- <div class="col-6">
                            <img src="resources/logo new.png" class="ms-3" style="width: 90px;">
                            </div> -->

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12 text-end text-primary text-decoration-underline">
                                            <h2>clickShop</h2>
                                        </div>

                                        <div class="col-12 text-end fw-bold">
                                            <span>Mawanella,Kegalle,Sri Lanka</span> <br />
                                            <span>+94 762 684 595</span> <br />
                                            <span>newofficial66@gmail.com</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border border-1 border-primary" />
                                </div>

                                <div class="col-12 mb-4">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="fw-bold">INVOICE TO :</h5>
                                            <h2><?php echo $_SESSION["user"]["first_name"] . " " . $_SESSION["user"]["last_name"]; ?></h2>

                                            <?php
                                            $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON `user_has_address`.`city_id`=`city`.`id` 
                                            WHERE `user_email`='" . $_SESSION["user"]["email"] . "'");
                                            $address_data = $address_rs->fetch_assoc();
                                            ?>
                                            <span><?php echo $address_data["line1"] . ", " . $address_data["line2"] . ", " . $address_data["name"]; ?></span><br />
                                            <span class="fw-bold"><?php echo $_SESSION["user"]["email"]; ?></span>
                                        </div>

                                        <div class="col-6 text-end mt-4">
                                            <h1 class="text-primary">INVOICE 01</h1>
                                            <?php
                                            $order_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $iid . "'");
                                            $order_data = $order_rs->fetch_assoc();
                                            ?>
                                            <span class="fw-bold">Date :</span>&nbsp;
                                            <span class="fw-bold">
                                                <?php $row = $order_data["date"];
                                                $splited = explode(" ", $row);
                                                echo $splited[0]; ?>
                                            </span>
                                            <br />
                                            <span class="fw-bold">Time :</span>&nbsp;
                                            <span class="fw-bold">
                                                <?php $row = $order_data["date"];
                                                $splited = explode(" ", $row);
                                                echo $splited[1]; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <table class="table">
                                        <thead class="my_div rounded-3">
                                            <tr class="my_div rounded-3 text-white">
                                                <th class="border border-end">#</th>
                                                <th class="border border-end">Order ID & Product</th>
                                                <th class="border border-end text-end">Unit Price</th>
                                                <th class="border border-end text-end">Quantity</th>
                                                <th class="border border-end text-end">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="my_div rounded-3 border border-end">
                                            <tr style="height: 72px;">
                                                <td class="border border-end text-white fs-3"><?php echo $order_data["id"]; ?></td>
                                                <td class="border border-end">
                                                    <span class="fw-bold p-2 text-white text-decoration-underline"><?php echo $order_data["order_id"]; ?></span><br />

                                                    <?php
                                                    $book_rs = Database::search("SELECT * FROM `book` WHERE `id`='" . $order_data["book_id"] . "' ");
                                                    $book_data = $book_rs->fetch_assoc();

                                                    ?>
                                                    <span class="fw-bold p-2 fs-4 text-white"><?php echo $book_data["title"]; ?></span>
                                                </td>
                                                <td class="fs-6 text-end border border-end pt-3 text-white">LKR. <?php echo $book_data["price"]; ?>.00</td>
                                                <td class="fs-6 text-end border border-end pt-3 text-white"><?php echo $order_data["qty"]; ?></td>
                                                <td class="fs-6 text-end border border-end text-white">LKR. <?php echo $order_data["total"]; ?>.00</td>
                                            </tr>
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <td colspan="3" class="border-0"></td>
                                                <td class="fs-5 text-end">Shipping</td>
                                                <td class="text-end">LKR. <?php $book_delivery_fee = $book_data["delivery_fee_other"];
                                                                            echo $book_delivery_fee ?>.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="border-0"></td>
                                                <td class="fs-5 text-end">SUBTOTAL</td>
                                                <td class="text-end">LKR. <?php echo $order_data["total"] + $book_delivery_fee; ?>.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="border-0"></td>
                                                <td class="fs-5 text-end border-primary">DISCOUNT</td>
                                                <td class="text-end border-primary">LKR. <?php
                                                                                            $discount;

                                                                                            if ($order_data["total"] > "250000") {
                                                                                                $discount = ($order_data["total"] / 100) * 1;
                                                                                                echo $discount;
                                                                                            } else if ($order_data["total"] > "500000") {
                                                                                                $discount = ($order_data["total"] / 100) * 2;
                                                                                                echo $discount;
                                                                                            } else if ($order_data["total"] > "1000000") {
                                                                                                $discount = ($order_data["total"] / 100) * 5;
                                                                                                echo $discount;
                                                                                            } else {
                                                                                                echo $discount = "0";
                                                                                            }
                                                                                            ?>.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="border-0"></td>
                                                <td class="fs-5 fw-bold text-end border-primary text-primary">GRAND TOTAL</td>
                                                <td class="fs-5 fw-bold text-end border-primary text-primary">LKR. <?php echo $order_data["total"] - $discount  + $book_delivery_fee; ?>.00</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="col-4 text-center" style="margin-top: -100px; margin-bottom: 50px;">
                                    <span class="fs-1">Thank You!</span>
                                </div>

                                <div class="col-12 mt-3 mb-3 border border-5 border-start border-bottom-0 border-top-0 border-end-0 border-primary rounded my_div">
                                    <div class="row">
                                        <div class="col-12 mt-3 mb-3">
                                            <label class="form-label fs-5 fw-bold">NOTICE :</label><br />
                                            <label class="form-label fs-6">Purchased items can return before 7 days of delivery.</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border border-1 border-primary" />
                                </div>

                                <div class="col-12 mb-3 text-center">
                                    <label class="form-label fs-5 text-black-50 fw-bold">
                                        Invoice was created on a computer and is valid without the Signature and Seal
                                    </label>
                                </div>
                            </div>
                        </div>
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
                    <div class="modal-footer fw-bold">
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