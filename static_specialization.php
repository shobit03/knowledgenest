<?php include('./panels/header-top.php') ?>
<title> Courses </title>
<meta name="description" content="Courses">
<?php include('./panels/header-bottom.php') ?>
<?php include('./panels/menu.php') ?>
<?php
$url = isset($_GET['url']) ? mysqli_real_escape_string($conn, $_GET['url']) : '';


?>

<!--  Page Title Area Start-->
<section class="page-title-area position-relative">
    <div class="container">
        <div class="main-max-width">
            <div class="page-title-content">
                <h2>UG Programs</h2>
                <ul class="page-breadcrumb align-items-center list-unstyle">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"></li>
                    <li class="primery-link">UG Programs</li>
                </ul>

            </div>
        </div>
    </div>
</section>
<!--  Page Title Area End-->


<section>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="shadow p-2 mt-4 mb-4 rounded-3" style="background-color: #584fc9;">
                    <h5 class="text-center text-white">Specialization In B.Tech</h5>
                </div>

            </div>

            <div class="row align-items-center">
                            <div class="col-lg-4 col-sm-6">
                                <div class="Department-cards mb-4 mt-4 rounded-3 shadow">
                                    <div class="image position-relative">
                                        <a href="blog-details.php">
                                            <img src="./assets/img/Bachelor of Pharmacy.jpeg" alt="image">
                                        </a>
                                        
                                    </div>
                                    <div class="p-4 text-center">
                                        
                                        <h3 class="mb-15 fs-20"><a href="blog-details.php">Bachelor of Pharmacy(B.Pharma)</a></h3>
                                        <p>This immersive course is crafted to provide participants.......</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="Department-cards mb-4 mt-4 rounded-3 shadow">
                                    <div class="image position-relative">
                                        <a href="blog-details.php">
                                            <img src="./assets/img/Diploma in Pharmacy.webp" alt="image">
                                        </a>
                                        
                                    </div>
                                    <div class="p-4 text-center">
                                        
                                        <h3 class="mb-15 fs-20"><a href="blog-details.php">Diploma in Pharmacy(D.Pharma)</a></h3>
                                        <p>This immersive course is crafted to provide participants.......</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="Department-cards mb-4 mt-4 rounded-3 shadow">
                                    <div class="image position-relative shadow">
                                        <a href="blog-details.php">
                                            <img src="./assets/img/m-pharm-pharmaceutics.jpeg " alt="image">
                                        </a>
                                        
                                    </div>
                                    <div class="p-4 text-center">
                                        
                                        <h3 class="mb-15 fs-20"><a href="blog-details.php">Master of Pharmacy(M.Pharma) </a></h3>
                                        <p>This immersive course is crafted to provide participants.......</p>
                                    </div>
                                </div>
                            </div>
                        </div>
        </div>
    </div>
</section>








<?php include('./panels/footer-top.php') ?>
<?php include('./panels/footer-bottom.php') ?>