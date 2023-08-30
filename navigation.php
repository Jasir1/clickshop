<?php

// session_start();

// require "connection.php";

?>

<div class="row home-nav-logo">
    <div class="col-12 mt-3 d-flex justify-content-center">
        <img class="shadow home-nav-logo" src="resources/clickShop_logo.png">
    </div>
</div>

<div class="col-12 mt-4">
    <hr style="width: 100%;" />
</div>

<?php
if (isset($_SESSION["user"]["email"])) {

    $userrs = Database::search("SELECT * FROM `user` WHERE `email`='" . $_SESSION["user"]["email"] . "'");
    $user = $userrs->fetch_assoc();

    $profileImage = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $_SESSION["user"]["email"] . "'");
    $profile_num = $profileImage->num_rows;
    $profile = $profileImage->fetch_assoc();

    if ($profile_num > 0) {
?>
        <div class="row mt-1 home-nav-profile d-none d-lg-block">
            <div class="col-8 mx-auto d-flex justify-content-center">
                <div class="row shadow">
                    <div class="col-12 mt-2 d-flex justify-content-center">
                        <img class="home-nav-profile-img rounded-circle" src="<?php echo $profile["code"] ?>">
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <h3 class="fs-5 text-light user-name"><?php echo $user["username"] ?></h3>
                    </div>
                </div>
            </div>
        </div>

    <?php
    } else {
    ?>
        <div class="row mt-1 home-nav-profile d-none d-lg-block">
            <div class="col-8 mx-auto d-flex justify-content-center">
                <div class="row shadow">
                    <div class="col-12 mt-2 d-flex justify-content-center">
                        <img class="home-nav-profile-img rounded-circle" src="icons/user_default.png">
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <h3 class="fs-5 text-light user-name"><?php echo $user["username"] ?></h3>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
} else {
    ?>
    <div class="row mt-1 home-nav-profile d-none d-lg-block">
        <div class="col-8 mx-auto d-flex justify-content-center">
            <div class="row shadow">
                <div class="col-12 mt-2 d-flex justify-content-center">
                    <img class="home-nav-profile-img rounded-circle" src="icons/user_default.png">
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <h3 class="fs-5 text-light user-name">User</h3>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
<ul class="navbar-nav d-flex flex-column mt-3 w-100" style="overflow-y: auto;">
    <li class="nav-item home-nav-btn" id="home">
        <a href="home.php" class="nav-link text-light px-4"><i class="bi bi-house-fill fs-2 text-white"></i>&nbsp;&nbsp;<span class="fs-5 home-nav-label">Home</span></a>
    </li>
    <li class="nav-item home-nav-btn" id="profile">
        <a href="userprofile.php" class="nav-link text-light px-4"><i class="bi bi-person-fill fs-2"></i>&nbsp;&nbsp;<span class="fs-5 home-nav-label">Profile</span></a>
    </li>
    <li class="nav-item home-nav-btn" id="mysellings">
        <a href="addBook.php" class="nav-link text-light px-4"><i class="bi bi-cash-coin fs-2"></i>&nbsp;&nbsp;<span class="fs-5 home-nav-label">Sellings</span></a>
    </li>

    <li class="nav-item home-nav-btn" id="mybooks">
        <a href="myBooks.php" class="nav-link text-light px-4"><i class="fa fa-regular fa-book fs-2"></i>&nbsp;&nbsp;<span class="fs-5 home-nav-label">My Books</span></a>
    </li>
    <li class="nav-item home-nav-btn" id="watchlist">
        <a href="watchlist.php" class="nav-link text-light px-4"><i class="bi bi-basket2-fill fs-2"></i>&nbsp;&nbsp;<span class="fs-5 home-nav-label">WatchList</span></a>
    </li>
    <li class="nav-item home-nav-btn" id="cart">
        <a href="cart.php" class="nav-link text-light px-4"><i class="bi bi-bookmark-heart-fill fs-3"></i>&nbsp;&nbsp;<span class="fs-5 home-nav-label">Cart</span></a>
    </li>
    <li class="nav-item home-nav-btn" id="purchasehistory">
        <a href="purchaseHistory.php" class="nav-link text-light px-4"><i class="fa fa-clipboard-list fs-3"></i>&nbsp;&nbsp;<span class="fs-5 home-nav-label">Purchased</span></a>
    </li>
    <li class="nav-item home-nav-btn" id="message">
        <a href="message.php" class="nav-link text-light px-4"><i class="bi bi-chat-dots-fill fs-2"></i>&nbsp;&nbsp;<span class="fs-5 home-nav-label">Messages</span></a>
    </li>
    <?php
    if (isset($_SESSION["user"]["email"])) {
    ?>
        <li class="nav-item home-nav-btn">
            <a class="nav-link text-light px-4" onclick="logOutConfirmation();"><i class="fa fa-arrow-right-from-bracket fs-3"></i>&nbsp;&nbsp;<span class="fs-5 home-nav-label">Log Out</span></a>
        </li>
    <?php
    }else{
        ?>
        <li class="nav-item home-nav-btn">
        <a href="index.php" class="nav-link text-light px-4"><i class="bi bi-door-open-fill fs-2"></i>&nbsp;&nbsp;<span class="fs-5 home-nav-label">Go to Signin</span></a>
    </li>
        <?php
    }
    ?>
</ul>