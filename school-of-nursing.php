<?php include('./panels/header-top.php') ?>
<title>School Of Nursing </title>
<meta name="description" content="Courses">
<?php include('./panels/header-bottom.php') ?>
<?php include('./panels/menu.php') ?>

<!--  Page Title Area Start-->
<section class="page-title-area position-relative">
    <div class="container">
        <div class="main-max-width">
            <div class="page-title-content">
                <h2>School Of Nursing</h2>
                <ul class="page-breadcrumb align-items-center list-unstyle">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"></li>
                    <li class="primery-link">School Of Nursing</li>
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
                            <button class="nav-link active text-black" id="GNM" data-bs-toggle="pill" data-bs-target="#GNMCourse" type="button" role="tab" aria-controls="GNM1" aria-selected="true">GNM(General Nursing and Midwifery)</button>
                        </li>
                        <li class="nav-item list-unstyle courses-card" role="presentation">
                            <button class="nav-link rounded-3 p-2 border-0 bg-transparent text-black" id="ANM" data-bs-toggle="pill" data-bs-target="#anmcourse" type="button" role="tab" aria-controls="ANM2" aria-selected="false">ANM(Auxiliary Nursing Midwifery)</button>
                        </li>
                      
                    </ul>

                  
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="GNMCourse" role="tabpanel" aria-labelledby="GNM">
                            <div class="row">
                                <div class="col-lg-6 mx-auto">
                                    <div class="single-courses-box mb-25 box-shadow-2">
                                        <div class="image mb-20 position-relative">
                                            <a href="course-details.php" class="d-block">
                                                <img src="assets/img/General Nursing and Midwifery.jpg" alt="image">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h3 class="mb-15 fs-20 text-center"><a href="#">General Nursing and Midwifery</a></h3>
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
                        <div class="tab-pane fade" id="anmcourse" role="tabpanel" aria-labelledby="ANM">
                            <div class="row">
                                <div class="col-lg-6 mx-auto">
                                    <div class="single-courses-box mb-25 box-shadow-2">
                                        <div class="image mb-20 position-relative">
                                            <a href="course-details.php" class="d-block">
                                                <img src="assets/img/Auxiliary Nursing Midwifery.jpg" alt="image">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h3 class="mb-15 fs-20 text-center"><a href="blog-details.php">Auxiliary Nursing Midwifery</a></h3>
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