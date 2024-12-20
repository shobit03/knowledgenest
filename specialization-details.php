<?php include('./panels/header-top.php') ?>
<title> Specialization Details </title>
<meta name="description" content="Specialization Details">
<?php include('./panels/header-bottom.php') ?>
<?php include('./panels/menu.php') ?>

<?php
// Get the URL parameter
$url = isset($_GET['url']) ? mysqli_real_escape_string($conn, $_GET['url']) : '';

// Fetch specialization details
$getdata = "
    SELECT specializations.*, sub_category.Name AS sub_category_name
    FROM specializations
    JOIN sub_category ON sub_category.ID = specializations.Sub_Category_ID
    WHERE specializations.Slug = '$url' AND specializations.Status = 1";

$subcategory = $conn->query($getdata);
$subcategory_details = $subcategory ? $subcategory->fetch_assoc() : null;

$current_course_id = $subcategory_details['ID'] ?? null;
$current_category_id = $subcategory_details['Sub_Category_ID'] ?? null;

// Fetch related specializations
$get_recent_courses = "
    SELECT specializations.Name AS related_course_name, 
           specializations.Slug AS related_course_slug, 
           specializations.Photo AS related_course_photo
    FROM specializations
    WHERE specializations.Status = 1
      AND specializations.ID != '$current_course_id'
      AND specializations.Sub_Category_ID = '$current_category_id'
    ORDER BY specializations.Created_At DESC
    LIMIT 3";

$recent_courses = $conn->query($get_recent_courses);
?>

<!-- Page Title Area Start -->
<section class="page-title-area position-relative">
    <div class="container">
        <div class="main-max-width">
            <div class="page-title-content">
                <h2><?php echo $subcategory_details['Name'] ?? 'Specializations Details'; ?></h2>
                <ul class="page-breadcrumb align-items-center list-unstyle">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><?php echo $subcategory_details['sub_category_name'] ?? ''; ?></li>
                    <li class="primery-link"><?php echo $subcategory_details['Name'] ?? 'Specializations Details'; ?></li>
                </ul>
                <div class="shape-1 moveHorizontal"><img src="assets/img/icon/shape-2.svg" alt="image"></div>
                <div class="shape-2"><img src="assets/img/icon/section-icon-1.svg" alt="image"></div>
                <div class="shape-3 bounce"><img src="assets/img/icon/section-icon-2.svg" alt="image"></div>
            </div>
        </div>
    </div>
</section>
<!-- Page Title Area End -->

<!-- Specializations Details Section Start -->
<div class="courses-details-section pt-5">
    <div class="container">
        <div class="main-max-width">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($subcategory_details): ?>
                        <div class="single-course-desc">
                            <div class="single-course-image position-relative text-center">
                                <img src="/admin/<?=$subcategory_details['Photo']; ?>" width="1000" alt="image">
                            </div>
                            <div class="single-course-content">
                                <h2 class="fs-20 mb-20"><?=$subcategory_details['Name']; ?></h2>
                                <p class="mb-30"><?=$subcategory_details['Description']; ?></p>

                                <div class="course-details-wapper">
                                    <div class="overview-content mb-30">
                                        <h3 class="fs-20 fs-medium mb-40">Description</h3>
                                        <p class="mb-30"><?=$subcategory_details['Content']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <p>Specialization not found.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Related Courses Section -->
            <?php if ($recent_courses && $recent_courses->num_rows > 0): ?>
                <div class="related-course pt-4 mb-4 shadow rounded-3" style="background-color:#e9e9df;">
                    <div class="course-section-title mb-30 text-center">
                        <h3 class="fs-20 mb-20">Related Specializations</h3>
                        <p class="fs-15">Discover Your Perfect Program In Our Courses</p>
                    </div>
                    <div class="row">
                        <?php while ($related_course = $recent_courses->fetch_assoc()): ?>
                            <div class="col-lg-4 col-sm-6">
                                <div class="p-3 mb-25 shadow related-course-cards">
                                    <div class="image mb-20 position-relative">
                                        <a href="specialization-details?url=<?=$related_course['related_course_slug']; ?>" class="d-block">
                                            <img src="/admin/<?=$related_course['related_course_photo']; ?>" alt="image">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h3 class="mb-15 fs-20"><a href="specialization-details?url=<?=$related_course['related_course_slug']; ?>"><?=$related_course['related_course_name']; ?></a></h3>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Specializations Details Section End -->

<?php include('./panels/footer-top.php') ?>
<?php include('./panels/footer-bottom.php') ?>