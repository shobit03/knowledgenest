<?php
require('admin/includes/db-config.php');

// Fetch menus and their categories, including 'have_details' column logic
$query = "
    SELECT 
        menus.ID as menu_id, 
        menus.Name as menu_name, 
        menus.Slug as menu_slug,
        category.Have_Details as have_details,
        category.ID as category_id, 
        category.Name as category_name, 
        category.Slug as category_slug 
       FROM menus 
       LEFT JOIN category ON menus.ID = category.menu_id 
       WHERE menus.Status = 1 AND (category.Status = 1) 
       ORDER BY menus.Position ASC, menus.ID, category.ID";

$result = mysqli_query($conn, $query);

$menus = [];
while ($row = mysqli_fetch_assoc($result)) {
    $menuId = $row['menu_id'];
    if (!isset($menus[$menuId])) {
        $menus[$menuId] = [
            'name' => $row['menu_name'],
            'slug' => $row['menu_slug'],
            'categories' => []
        ];
    }
    if ($row['category_id']) {
        $menus[$menuId]['categories'][] = [
            'name' => $row['category_name'],
            'slug' => $row['category_slug'],
            'have_details' => $row['have_details']

        ];
    }
}

// Debug the $menus array
// echo "<pre>";
// print_r($menus);
// echo "</pre>";
?>







<!-- Navbar Area Start -->
<div class="navbar-area style-one style-2" id="navbar">
    <div class="container">
        <div class="main-max-width">
            <nav class="navbar insocour-nav navbar-expand-lg pt-0 pb-0">
                <a class="navbar-brand" href="index.php">
                    <img class="logo-light" src="assets/img/logo/aimsuinv-logo-removebg-preview.png" alt="logo">
                </a>
                <div class="other-options d-flex flex-wrap justify-content-end align-items-center d-lg-none">
                    <div class="option-item d-flex">
                        <a class="navbar-toggler" data-bs-toggle="offcanvas" href="#navbarOffcanvas" role="button"
                            aria-controls="navbarOffcanvas">
                            <span class="burger-menu">
                                <span class="top-bar"></span>
                                <span class="middle-bar"></span>
                                <span class="bottom-bar"></span>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="collapse navbar-collapse align-items-center justify-content-end">
                    <ul class="navbar-nav ms-1 d-flex align-items-center">
                        <!-- <li class="nav-item">
                            <a href="index.php" class="nav-link active"> Home </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="about.php" class="nav-link"> AboutUs </a>
                        </li>


                        <?php foreach ($menus as $menu): ?>
                            <li class="nav-item d-flex align-items-center gap-2">
                                <a href="javascript:void(0)" class="dropdown-toggle nav-link">
                                    <?php echo $menu['name']; ?>
                                </a>
                                <ul class="dropdown-menu-items list-unstyle">
                                    <?php foreach ($menu['categories'] as $category): ?>
                                        <li class="nav-item">
                                            <?php if ($category['have_details'] == 1): ?>
                                                <!-- Link to board_details.php if have_details is 1 -->
                                                <a href="board-details?url=<?php echo $category['slug']; ?>" class="nav-link-items">
                                                    <?php echo $category['name']; ?>
                                                </a>
                                            <?php else: ?>
                                                <!-- Normal link to courses.php -->
                                                <a href="courses?url=<?php echo $category['slug']; ?>" class="nav-link-items">
                                                    <?php echo $category['name']; ?>
                                                </a>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php endforeach; ?>




                        <li class="nav-item">
                            <a href="contact.php" class="nav-link">
                                Contact Us
                            </a>
                        </li>
                    </ul>

                    <div class="option-item style-2 d-flex align-items-center">
                        <a href="login.php" class="btn style-one style-2">Login</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar Area End -->

<!-- Responsive Navbar Start -->
<div class="responsive-navbar offcanvas offcanvas-end border-0" data-bs-backdrop="static" tabindex="-1"
    id="navbarOffcanvas">
    <div class="offcanvas-header">
        <a href="index.php" class="logo d-inline-block">
            <img class="logo-light" src="assets/img/logo/logo.svg" alt="Image">
        </a>
        <button type="button" class="close-btn bg-transparent position-relative lh-1 p-0 border-0"
            data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="ri-close-line"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <ul class="responsive-menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="courses.php">Courses</a>
            <li class="nav-item">
                <a class="dropdown-toggle text-black fs-6" id="dropdownMenu2" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Universities

                </a>
                <ul class="dropdown-menu border-0" aria-labelledby="dropdownMenu2">
                    <li class="list-unstyle"><button class="dropdown-item" type="button">Action</button></li>
                    <li class="list-unstyle"><button class="dropdown-item" type="button">Another action</button></li>
                    <li class="list-unstyle"><button class="dropdown-item" type="button">Something else here</button>
                    </li>
                </ul>
            </li>

            </li>
            <!-- <li class="responsive-menu-list"><a href="javascript:void(0);">Shop</a>
                <ul class="responsive-menu-items">
                    <li><a href="shop.html">Shop</a></li>
                    <li><a href="shop-filtter.html">Shop Sidebar</a></li>
                    <li><a href="single-product.html">Product Details</a></li>
                    <li><a href="cart.html">Cart</a></li>
                    <li><a href="checkout.html">Checkout</a></li>
                    <li><a href="success.html">Success</a></li>
                </ul>
            </li> -->
            <li><a href="blogs.php">Blog</a>

            </li>
            <!-- <li class="responsive-menu-list"><a href="javascript:void(0);">Pages</a>
                <ul class="responsive-menu-items">
                    <li><a href="sign-in.html">Sign in</a>
                    <li><a href="sign-up.html">Sign Up</a>
                    <li class="responsive-menu-list"><a href="javascript:void(0);">Instructor</a>
                        <ul class="responsive-menu-items">
                            <li><a href="instructor.html">Instructor</a></li>
                            <li><a href="instructor2.html">Instructor Tow</a></li>
                            <li><a href="instructor-sidebar.html">Instructor Sidebar</a></li>
                            <li><a href="instructor-details.html">Instructor Details</a></li>
                        </ul>
                    </li>
                    <li><a href="faq.html">FAQ</a>
                    <li class="responsive-menu-list"><a href="javascript:void(0);">Error</a>
                        <ul class="responsive-menu-items">
                            <li><a href="error-404.html">Error One</a></li>
                            <li><a href="error-sidebar-404.html">Error Tow</a></li>
                        </ul>
                    </li>
                </ul>
            </li> -->
            <li><a href="contact.php">Contact Us</a></li>
        </ul>
        <div class="other-option d-md-flex align-items-center">
            <div class="option-item  text-center">
                <a href="login.php" class="btn style-one style-2">Login</a>
            </div>
        </div>
    </div>
</div>
<!-- Responsive Navbar End -->