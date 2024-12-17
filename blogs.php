<?php include('./panels/header-top.php') ?>
<title> Blogs </title>
<meta name="description" content="Blogs">
<?php include('./panels/header-bottom.php') ?>
<?php include('./panels/menu.php') ?>

<?php require('admin/includes/db-config.php'); ?>

<?php
// Fetch the blogs
$blogData = [];
$blogs = $conn->query("SELECT * FROM blogs WHERE Status = 1 ORDER BY ID DESC  ");
while ($blog = $blogs->fetch_assoc()) {
    $blogData[] = $blog;
}
?>

<!--  Page Title Area Start-->
<section class="page-title-area position-relative">
    <div class="container">
        <div class="main-max-width">
            <div class="page-title-content">
                <h2> Blogs </h2>
                <ul class="page-breadcrumb align-items-center list-unstyle">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"></li>
                    <li class="primery-link">Blogs</li>
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

<!-- Blog Section Start -->
<div class="blog-section ptb-100">
    <div class="container">
        <div class="main-max-width">
            <div class="row justify-content-center">
                <?php if (!empty($blogData)): ?>
                    <?php foreach ($blogData as $blog): ?>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-blog-box">
                                <div class="image position-relative">
                                    <a href="blog-details?url=<?= $blog['Slug'] ?>">
                                        <img src="/admin/<?= $blog['Photo'] ?>" alt="image">
                                    </a>

                                </div>
                                <div class="content">
                                    <ul class="cr-items d-flex list-unstyle">
                                        <li>
                                            <i class="ri-calendar-2-line"></i>
                                            <span><?= date("d F Y", strtotime($blog['Updated_At'])) ?></span>
                                        </li>
                                    </ul>
                                    <h3 class="mb-15 fs-20">
                                        <a href="blog-details?url=<?= $blog['Slug'] ?>"><?php echo $blog['Name']; ?></a>

                                    </h3>
                                    <p>
                                        <?php echo substr($blog['Description'], 0, 100); ?>...</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No blogs found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- Blog Section End -->

<?php include('./panels/footer-top.php') ?>
<?php include('./panels/footer-bottom.php') ?>