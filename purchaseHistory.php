<?php

require "connection.php";

session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Purchase History | clickShop</title>
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

    ?>

        <nav class="navbar navbar-expand d-flex flex-column align-item-start shadow" id="sidebar">

            <?php require "navigation.php"; ?>
            <script>
                var btn = document.getElementById('purchasehistory');
                btn.style.backgroundColor = 'rgba(122, 118, 118, 0.5)';
            </script>

        </nav>
        <section class="p-4 my-containe nav-body">
            <button class="btn text-white d-block d-lg-none" id="menu-btn"><i class="bi bi-arrow-right-square-fill fs-5 text-secondary"></i></button>

            <div class="row m-2 my_div">
                <div class="col-12 pt-4">
                    <h2 class="text-center text-white">Purchase History</h2>
                </div>

                <div class="col-11 my_div1 mx-auto mt-3 mb-4">
                    <div class="row g-3 justify-content-center">

                        <div class="col-12">
                            <div class="row mx-2 mt-3">

                                <!-- table head -->
                                <div class="col-12 d-none d-lg-block">
                                    <div class="row rounded border border-end text-white">

                                        <div class="col-1 my_div rounded border border-end pt-2">
                                            <label class="form-label fw-bold">#</label>
                                        </div>

                                        <div class="col-4 my_div rounded border border-end pt-2">
                                            <label class="form-label fw-bold">Order Details</label>
                                        </div>

                                        <div class="col-1 my_div rounded border border-end text-end pt-2">
                                            <label class="form-label fw-bold">Quantity</label>
                                        </div>

                                        <div class="col-2 my_div rounded border border-end text-end pt-2">
                                            <label class="form-label fw-bold">Amount</label>
                                        </div>

                                        <div class="col-4 my_div rounded border text-end pt-2">
                                            <label class="form-label fw-bold">Purchase Date & Time</label>
                                        </div>

                                    </div>
                                </div>
                                <!-- table head -->
                                <!-- table body -->

                                <div class="col-12">
                                    <div class="row">

                                        <?php

                                        $invoicers = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $userEmail . "' AND `status`='0'");
                                        $invoice_count = $invoicers->num_rows;

                                        for ($x = 0; $x < $invoice_count; $x++) {
                                            $invoice_data = $invoicers->fetch_assoc();

                                            $image_rs = Database::search("SELECT * FROM `images` WHERE `book_id`='" . $invoice_data["book_id"] . "'");
                                            $image_data = $image_rs->fetch_assoc();

                                            $book_rs = Database::search("SELECT * FROM `book` WHERE `id`='" . $invoice_data["book_id"] . "'");
                                            $book_data = $book_rs->fetch_assoc();

                                        ?>

                                            <div class="col-12 col-lg-1 border border-black-50 text-center text-lg-start">
                                                <label class="form-label text-dark fs-4 py-5"><?php echo $invoice_data["order_id"]; ?></label>
                                            </div>

                                            <div class="col-12 col-lg-4 border border-black-50">
                                                <div class="row g-2 justify-content-center">

                                                    <div class="card mx-0 my-3 bg-transparent" style="max-width: 540px;">
                                                        <div class="row g-0">
                                                            <div class="col-md-4">
                                                                <img src="<?php echo $image_data["code"]; ?>" class="img-fluid rounded-start" style="width: 5rem;">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="card-body">
                                                                    <h5 class="card-title" style="word-wrap: break-word;"><?php echo $book_data["title"]; ?></h5>
                                                                    <span class="card-text text-success fw-bold"><b>Seller :</b> <?php echo $book_data["user_email"]; ?></span><br />
                                                                    <span class="card-text text-primary fw-bold"><b>Price :</b> LKR. <?php echo $book_data["price"]; ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-1 rounded border border-black-50 border-end text-center text-dark text-lg-end">
                                                <label class="form-label fs-4 pt-5"><?php echo $invoice_data["qty"]; ?></label>
                                            </div>

                                            <div class="col-12 col-lg-2 rounded border border-black-50 border-end text-center text-lg-end">
                                                <label class="form-label fs-5 fw-bold py-5 text-dark">LKR. <?php echo $invoice_data["total"]; ?></label>
                                            </div>

                                            <div class="col-12 col-lg-4 rounded border border-black-50 border-end text-center text-lg-end">
                                                <div class="row">
                                                    <div class="col-12 d-grid text-dark">
                                                        <label class="form-label fs-5 fw-bold px-3 pt-3"><?php echo $invoice_data["date"]; ?></label>
                                                    </div>
                                                    <div class="col-6 d-grid">
                                                        <button class="btn btn-secondary rounded border border-1 mt-3 fs-5 text-white" onclick="feedbackSend('<?php echo $invoice_data['book_id'] ?>');">
                                                            <i class="bi bi-info-circle-fill"></i> Feedback</button>
                                                    </div>
                                                    <div class="col-6 d-grid">
                                                        <button class="btn btn-danger rounded border border-1 mt-3 fs-5 text-white" onclick="purchaseHistoryClearModal();">
                                                            <i class="bi bi-trash-fill"></i> Delete</button>
                                                    </div>
                                                    <div class="col-12">
                                                        <hr>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <!-- table body -->

                                <!-- clear purchase history -->
                                <div class="modal" tabindex="-1" id="purchaseHistoryClearModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title fs-5 fw-bold">Confirmation</h5>
                                                <a href="purchaseHistory.php" class="btn-close"></a>
                                            </div>
                                            <div class="modal-body text-center">
                                                <label class="warning_message" style="height: 60px;"></label>
                                                <br />
                                                <label class="form-label fs-6">Do you want to remove this book from purchase history?</label>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <a class="btn btn-secondary" onclick="removeBookFromPurchaseHistory('<?php echo $invoice_data['id'] ?>');">Ok</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- clear purchase history -->

                                <!-- clear all purchase history -->
                                <div class="modal" tabindex="-1" id="purchaseHistoryClearAllModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content my_div1" style="box-shadow: 0 15px 25px; border-radius: 10px;">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title fs-5 fw-bold">Confirmation</h5>
                                                <a href="purchaseHistory.php" class="btn-close"></a>
                                            </div>
                                            <div class="modal-body text-center">
                                                <label class="warning_message" style="height: 60px;"></label>
                                                <br />
                                                <label class="form-label fs-6">Do you want to remove all from purchase history?</label>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <a class="btn btn-secondary" onclick="removeAllFromPurchaseHistory('<?php echo $userEmail ?>');">Ok</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- clear purchase history -->

                            </div>
                        </div>

                        <?php
                        if ($invoice_count > 0) {
                        ?>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-10 d-none d-lg-block"></div>
                                    <div class="col-12 col-lg-2 d-block">
                                        <button class="btn btn-danger rounded border border-1 fs-6" onclick="purchaseHistoryClearAllModal();">
                                            <i class="bi bi-trash-fill"></i>Clear All Records</button>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="col-12 text-center my-3">
                                            <label class="form-label fs-1 fw-bolder mb-3">
                                                You Have no items in your purchase History.
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>


                        <div class="col-12">
                            <hr class="hr1">
                        </div>


                        <div class="col-12" id="page">
                            <div class="row">

                                <div class="col-12 mt-3 mb-3 border border-5 border-start border-bottom-0 border-top-0 border-end-0 border-primary rounded my_div">
                                    <div class="row">
                                        <div class="col-12 mt-3 mb-3">
                                            <label class="form-label fs-5 fw-bold">NOTICE :</label><br />
                                            <label class="form-label fs-6">Purchased items can return before 7 days of delivery.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>


        <section class="p-4 my-container nav-body bg_footer text-white">
            <?php require "footer.php"; ?>
        </section>


        <!-- bootstrap js -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>
        <script src="dashboard1.js"></script>
        <!-- custom js -->
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
                        <a href="purchaseHistory.php" class="btn-close"></a>
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