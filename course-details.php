<?php include('./panels/header-top.php') ?>
<title> Course Details </title>
<meta name="description" content="Course Details">
<?php include('./panels/header-bottom.php') ?>
<?php include('./panels/menu.php') ?>

<?php
$url = isset($_GET['url']) ? mysqli_real_escape_string($conn, $_GET['url']) : '';

$getdata = "
    SELECT sub_category.*, 
    category.Name AS category_name
    FROM sub_category
    JOIN category ON category.ID = sub_category.Category_ID
    WHERE sub_category.Slug = '$url' AND sub_category.Status = 1";

$subcategory = $conn->query($getdata);

$subcategory_details = $subcategory->fetch_assoc();

$current_course_id = $subcategory_details['ID'];
$current_category_id = $subcategory_details['Category_ID'];


$get_recent_courses = "
    SELECT sub_category.Name AS related_course_name, 
    sub_category.Slug AS related_course_slug, 
    sub_category.Photo AS related_course_photo
    FROM sub_category
    WHERE sub_category.Status = 1
    AND sub_category.ID != $current_course_id
    AND sub_category.Category_ID = $current_category_id
    ORDER BY sub_category.Created_At DESC
    LIMIT 3";

$recent_courses = $conn->query($get_recent_courses);
?>

<!-- Page Title Area Start-->
<section class="page-title-area position-relative">
    <div class="container">
        <div class="main-max-width">
            <div class="page-title-content">
                <h2>Courses Details</h2>
                <ul class="page-breadcrumb align-items-center list-unstyle">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"></li>
                    <li class="primery-link">Courses Details</li>
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
<!-- Page Title Area End-->

<!-- Courses Details Section Start -->
<div class="courses-details-section pt-5">
    <div class="container">
        <div class="main-max-width">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($subcategory_details): ?>
                        <div class="single-course-desc">
                            <div class="single-course-image position-relative text-center">
                                <img src="/admin/<?php echo $subcategory_details['Photo']; ?>" width="1000" alt="image">
                            </div>
                            <div class="single-course-content">
                                <h2 class="fs-20 mb-20"><?php echo $subcategory_details['Name']; ?></h2>
                                <p class="mb-30"><?php echo $subcategory_details['Description']; ?></p>

                                <div class="course-details-wapper">
                                    <div class="overview-content mb-30">
                                        <h3 class="fs-20 fs-medium mb-40">Description</h3>
                                        <p class="mb-30"><?php echo $subcategory_details['Content']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <p>Course not found.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="related-course pt-4 mb-4 shadow rounded-3 " style="background-color:#e9e9df;">
                <div class="course-section-title mb-30 text-center">
                    <h3 class="fs-20 mb-20">Related Courses</h3>
                    <p class="fs-15">Discover Your Perfect Program In Our Courses</p>
                </div>
                <div class="row">
                    <?php while ($related_course = $recent_courses->fetch_assoc()): ?>
                        <div class="col-lg-4 col-sm-6">
                            <div class="p-3 mb-25 shadow related-course-cards">
                                <div class="image mb-20 position-relative">
                                    <a href="course-details?url=<?php echo $related_course['related_course_slug']; ?>" class="d-block">
                                        <img src="/admin/<?php echo $related_course['related_course_photo']; ?>" alt="image">
                                    </a>
                                </div>
                                <div class="content">
                                    <h3 class="mb-15 fs-20"><a href="course-details?url=<?php echo $related_course['related_course_slug']; ?>"><?php echo $related_course['related_course_name']; ?></a></h3>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Courses Details Section End -->

<?php include('./panels/footer-top.php') ?>
<?php include('./panels/footer-bottom.php') ?>