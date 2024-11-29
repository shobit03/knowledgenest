<?php include('./panels/header-top.php') ?>
<title> School Of Agricultural Science </title>
<meta name="description" content="Courses">
<?php include('./panels/header-bottom.php') ?>
<?php include('./panels/menu.php') ?>

<!--  Page Title Area Start-->
<section class="page-title-area position-relative">
    <div class="container">
        <div class="main-max-width">
            <div class="page-title-content">
                <h2>School Of Agricultural Science</h2>
                <ul class="page-breadcrumb align-items-center list-unstyle">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"></li>
                    <li class="primery-link">School Of Agricultural Science</li>
                </ul>
                <div class="shape-1 moveHorizontal">
                    <img src="assets/img/icon/shape-2.svg" alt="image">
                </div>
                <div class="shape-2">
                    <img src="assets/img/icon/section-icon-1.svg" alt="image">
                </div>
                <div class="shape-3 bounce">
                    <img src="assets/img/icon/section-icon-2.svg" alt="image">
                </div>
            </div>
        </div>
    </div>
</section>
<!--  Page Title Area End-->






<!-- Courses Section Start -->
<div class="courses-section pt-4">
    <div class="container">
        <div class="main-max-width">

            <div class="row">
                <div class="col-12">
                    <div class="text-center pb-3">
                        <h3>Courses</h3>
                    </div>
                </div>
                <div class="col-lg-12">
                    <ul class="nav nav-pills mb-3 d-flex gap-3 p-4 flex-row justify-content-center courses-dynamic-section mb-4 rounded-5" id="pills-tab" role="tablist">
                        <li class="nav-item list-unstyle" role="presentation">
                            <button class="nav-link active text-black" id="bsc" data-bs-toggle="pill" data-bs-target="#bsccouse" type="button" role="tab" aria-controls="B.sc" aria-selected="true">B. SC(Bachelor of Science)</button>
                        </li>
                        <li class="nav-item list-unstyle courses-card" role="presentation">
                            <button class="nav-link rounded-3 p-2 border-0 bg-transparent text-black" id="msc" data-bs-toggle="pill" data-bs-target="#msccourse" type="button" role="tab" aria-controls="D.pharma" aria-selected="false">M. SC(Master of Science)</button>
                        </li>
                        <li class="nav-item list-unstyle courses-card" role="presentation">
                            <button class="nav-link rounded-3 p-2 border-0 bg-transparent text-black" id="diploma" data-bs-toggle="pill" data-bs-target="#diplomacourse" type="button" role="tab" aria-controls="M.pharma" aria-selected="false">Diploma in Agriculture</button>
                        </li>
                    </ul>

                    <h3 class="text-center pb-3">Specialization</h3>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="bsccouse" role="tabpanel" aria-labelledby="bsc">
                            <div class="row">
                                <div class="col-lg-6 mx-auto">
                                    <div class="single-courses-box mb-25 box-shadow-2">
                                        <div class="image mb-20 position-relative">
                                            <a href="course-details.php" class="d-block">
                                                <img src="assets/img/Agriculture.jpg" alt="image">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h3 class="mb-15 fs-20 text-center"><a href="blog-details.php">Agriculture</a></h3>
                                            <p class="mb-15 pb-3 ms-2">
                                                <a href="blog-details.php">
                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi quis alias, cumque sed ratione animi reiciendis omnis est aperiam facere....
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="tab-pane fade" id="msccourse" role="tabpanel" aria-labelledby="msc">
                            <div class="row">
                                <div class="col-lg-6 mx-auto">
                                    <div class="single-courses-box mb-25 box-shadow-2">
                                        <div class="image mb-20 position-relative">
                                            <a href="course-details.php" class="d-block">
                                                <img src="assets/img/Environmental Science.jpg" alt="image">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h3 class="mb-15 fs-20 text-center"><a href="blog-details.php">Environmental Science</a></h3>
                                            <p class="mb-15 pb-3 ms-2">
                                                <a href="blog-details.php">
                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi quis alias, cumque sed ratione animi reiciendis omnis est aperiam facere....
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="tab-pane fade" id="diplomacourse" role="tabpanel" aria-labelledby="diploma">
                        <div class="row">
                                <div class="col-lg-6 mx-auto">
                                    <div class="single-courses-box mb-25 box-shadow-2">
                                        <div class="image mb-20 position-relative">
                                            <a href="course-details.php" class="d-block">
                                                <img src="assets/img/Agronomy.avif" alt="image">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h3 class="mb-15 fs-20 text-center"><a href="blog-details.php">Agronomy</a></h3>
                                            <p class="mb-15 pb-3 ms-2">
                                                <a href="blog-details.php">
                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi quis alias, cumque sed ratione animi reiciendis omnis est aperiam facere....
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
</div>
<!-- Courses Section End -->





<?php include('./panels/footer-top.php') ?>
<?php include('./panels/footer-bottom.php') ?>