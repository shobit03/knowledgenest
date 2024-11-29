<?php include('./panels/header-top.php') ?>
<title> School Of Technology </title>
<meta name="description" content="Courses">
<?php include('./panels/header-bottom.php') ?>
<?php include('./panels/menu.php') ?>

<!--  Page Title Area Start-->
<section class="page-title-area position-relative">
    <div class="container">
        <div class="main-max-width">
            <div class="page-title-content">
                <h2>School Of Law</h2>
                <ul class="page-breadcrumb align-items-center list-unstyle">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"></li>
                    <li class="primery-link">School Of Law</li>
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
                            <button class="nav-link active text-black" id="BALLB" data-bs-toggle="pill" data-bs-target="#BALLBcourse" type="button" role="tab" aria-controls="BALLBcourse" aria-selected="true">BA LL.B (Bachelor of Arts and Bachelor of Law Hons)</button>
                        </li>
                        <li class="nav-item list-unstyle courses-card" role="presentation">
                            <button class="nav-link rounded-3 p-2 border-0 bg-transparent text-black" id="BBALLB" data-bs-toggle="pill" data-bs-target="#BBALLBcourse" type="button" role="tab" aria-controls="BBALLBcourse" aria-selected="false">BBA LL.B (Bachelor of Business Administration and Bachelor of Legislative Law)</button>
                        </li>
                        <li class="nav-item list-unstyle courses-card" role="presentation">
                            <button class="nav-link rounded-3 p-2 border-0 bg-transparent text-black" id="b-tech-lateral" data-bs-toggle="pill" data-bs-target="#btechlateralentry" type="button" role="tab" aria-controls="btechlateralentry" aria-selected="false">LL.B(Bachelor of Law)</button>
                        </li>
                    </ul>

                    <h3 class="text-center pb-3">Specialization</h3>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="BALLBcourse" role="tabpanel" aria-labelledby="BALLB">
                            <div class="row">
                                <div class="col-lg-6 mx-auto col-sm-4">
                                    <div class="single-courses-box mb-25 box-shadow-2">
                                        <div class="image mb-20 position-relative">
                                            <a href="course-details.php" class="d-block">
                                                <img src="./assets/img/ballb.jpg" class="rounded-3" alt="image">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="BBALLBcourse" role="tabpanel" aria-labelledby="BBALLB">
                            <div class="row">
                                <div class="col-lg-6 mx-auto col-sm-4">
                                    <div class="single-courses-box mb-25 box-shadow-2">
                                        <div class="image mb-20 position-relative">
                                            <a href="course-details.php" class="d-block">
                                                <img src="./assets/img/BBALL.B.webp" class="rounded-3" alt="image">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="btechlateralentry" role="tabpanel" aria-labelledby="b-tech-lateral">
                            <div class="row">
                                <div class="col-lg-6 mx-auto col-sm-4">
                                    <div class="single-courses-box mb-25 box-shadow-2">
                                        <div class="image mb-20 position-relative">
                                            <a href="course-details.php" class="d-block">
                                                <img src="./assets/img/Bacheloroflaw.jpeg" class="rounded-3" alt="image">
                                            </a>
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