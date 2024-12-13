<?php include('./panels/header-top.php') ?>
<title> Courses </title>
<meta name="description" content="Courses">
<?php include('./panels/header-bottom.php') ?>
<?php include('./panels/menu.php') ?>

<?php

$url = isset($_GET['url']) ? mysqli_real_escape_string($conn, $_GET['url']) : '';

// Fetch courses based on the selected category slug
$coursesQuery = "
    SELECT 
        sub_category.ID as SubCategoryID,
        sub_category.Name as SubCategoryName,
        sub_category.Photo as Photo,
        sub_category.Description as SubCategoryDescription,
        sub_category.Slug as SubCategorySlug,
        category.Name as CategoryName
        FROM sub_category
        LEFT JOIN category ON sub_category.Category_ID = category.ID
        WHERE category.Slug = '$url' AND sub_category.Status = 1";

$coursesResult = mysqli_query($conn, $coursesQuery);

$courses = [];
$categoryName = '';
if ($row = mysqli_fetch_assoc($coursesResult)) {
    $categoryName = $row['CategoryName'];
    $courses[] = $row;
}
while ($row = mysqli_fetch_assoc($coursesResult)) {
    $courses[] = $row;
}


?>

<?php include('./panels/header-top.php') ?>
<title>Courses</title>
<meta name="description" content="Courses">
<?php include('./panels/header-bottom.php') ?>
<?php include('./panels/menu.php') ?>

<!--  Page Title Area Start-->
<section class="page-title-area position-relative">
    <div class="container">
        <div class="main-max-width">
            <div class="page-title-content">
                <h2><?php echo ($categoryName); ?> Programs</h2>
                <ul class="page-breadcrumb align-items-center list-unstyle">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"></li>
                    <li class="primery-link">UG Programs</li>
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
<div class="courses-section pt-5">
    <div class="container">
        <div class="main-max-width">
            <div class="row">
                <?php if (empty($courses)): ?>
                    <div class="col-12">
                        <p>No courses found for this category.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($courses as $course): ?>
                        <div class="col-lg-4 col-sm-4">
                            <div class="single-courses-box mb-25 shadow">
                                <div class="image mb-20 position-relative">
                                    <a href="course-details?url=<?php echo $course['SubCategorySlug']; ?>" class="d-block">
                                        <img src="/admin/<?php echo $course['Photo']; ?>" alt="<?php echo $course['SubCategoryName']; ?>">
                                    </a>
                                </div>
                                <div class="content">
                                    <h3 class="mb-15 fs-20 text-center">
                                        <a href="course-details?url=<?php echo $course['SubCategorySlug']; ?>">
                                            <?php echo $course['SubCategoryName']; ?>
                                        </a>
                                    </h3>
                                    <p class="mb-15 pb-3">
                                        <?php echo substr($course['SubCategoryDescription'], 0, 100); ?>...

                                    </p>
                                </div>
                                <ul class="cr-items list-unstyle ps-0 mb-0 ms-3">
                                    <li class="d-inline-block">
                                        <a href="course-details?url=<?php echo $course['SubCategorySlug']; ?>" class="btn style-one">
                                            Know Details
                                            <i class="ri-arrow-right-line"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- Courses Section End -->

<?php include('./panels/footer-top.php') ?>
<?php include('./panels/footer-bottom.php') ?>