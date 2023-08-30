<div class="row home-nav-logo">
    <div class="col-12 mt-3 d-flex justify-content-center">
        <img class="shadow home-nav-logo" src="resources/clickShop_logo.png">
    </div>
    <div class="col-12">
        <hr style="width: 100%;" />
    </div>
</div>


<div class="row shadow mt-5 home-nav-profile d-none d-lg-block">
    <div class="col-12 mt-3 d-flex justify-content-center">
        <img class="home-nav-profile-img" src="profile_images/avatar.png">
    </div>
    <div class="col-12 d-flex justify-content-center">
        <h3 class="fs-3 text-light">Mohamed Jasir</h3>
    </div>
</div>

<ul class="navbar-nav d-flex flex-column mt-5 w-100">
    <li class="nav-item home-nav-btn">
        <a href="home.php" class="nav-link text-light pl-4"><i class="bi bi-house-fill fs-2 text-white"></i>&nbsp;&nbsp;<span class="fs-5 home-nav-label">Home</span></a>
    </li>
    <li class="nav-item home-nav-btn">
        <a href="userprofile.php" class="nav-link text-light pl-4"><i class="bi bi-person-fill fs-2"></i>&nbsp;&nbsp;<span class="fs-5 home-nav-label">Profiles</span></a>
    </li>
    <li class="nav-item home-nav-btn">
        <a href="addproduct.php" class="nav-link text-light pl-4"><i class="bi bi-cash-coin fs-2"></i>&nbsp;&nbsp;<span class="fs-5 home-nav-label">My Sellings</span></a>
    </li>

    <li class="nav-item home-nav-btn">
        <a href="myProducts.php" class="nav-link text-light pl-4"><i class="fa fa-box-open fs-3"></i>&nbsp;&nbsp;<span class="fs-5 home-nav-label">My Products</span></a>
    </li>
    <li class="nav-item home-nav-btn">
        <a href="watchlist.php" class="nav-link text-light pl-4"><i class="bi bi-basket2-fill fs-2"></i>&nbsp;&nbsp;<span class="fs-5 home-nav-label">WatchList</span></a>
    </li>
    <li class="nav-item home-nav-btn">
        <a href="cart.php" class="nav-link text-light pl-4"><i class="bi bi-bookmark-heart-fill fs-3"></i>&nbsp;&nbsp;<span class="fs-5 home-nav-label">Cart</span></a>
    </li>
    <li class="nav-item home-nav-btn">
        <a href="#" class="nav-link text-light pl-4"><i class="fa fa-clipboard-list fs-3"></i>&nbsp;&nbsp;<span class="fs-5 home-nav-label">Purchase History</span></a>
    </li>
    <li class="nav-item home-nav-btn">
        <a href="#" class="nav-link text-light pl-4"><i class="bi bi-chat-dots-fill fs-2"></i>&nbsp;&nbsp;<span class="fs-5 home-nav-label">Messages</span></a>
    </li>
    <li class="nav-item home-nav-btn">
        <a href="#" class="nav-link text-light pl-4"><i class="fa fa-floppy-disk fs-3"></i>&nbsp;&nbsp;<span class="fs-5 home-nav-label">Saved</span></a>
    </li>
    <li class="nav-item home-nav-btn">
        <a href="#" class="nav-link text-light pl-4" onclick="logOut();"><i class="fa fa-arrow-right-from-bracket fs-3"></i>&nbsp;&nbsp;<span class="fs-5 home-nav-label">Log Out</span></a>
    </li>

</ul>


<!-- <?php
session_start();
if (isset($_SESSION["user"])) {
    $data = $_SESSION["user"];
?>
    <?php echo $data["username"] ?>
<?php
} else {
?>
    <a href="index.php">Sign In or Register</a>
<?php
}
?> -->