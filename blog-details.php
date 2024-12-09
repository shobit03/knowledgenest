<?php
require 'admin/includes/db-config.php';

$url = $conn->real_escape_string($_GET['url']);

$query = "
    SELECT blogs.*, blogsfaq.questions, blogsfaq.answers
    FROM blogs
    LEFT JOIN blogsfaq ON blogs.ID = blogsfaq.blog_id
    WHERE blogs.Slug = '$url'
";
$blogs = $conn->query($query);
$blog_details = $blogs->fetch_assoc();

if (!$blog_details) {
    echo "Blog not found!";
    exit;
}

// Fetch the recent blogs
$recentBlogs = [];
$recentBlogsQuery = $conn->query("SELECT * FROM blogs WHERE Status = 1 ORDER BY ID DESC LIMIT 5");
while ($recentBlog = $recentBlogsQuery->fetch_assoc()) {
    $recentBlogs[] = $recentBlog;
}
?>

<?php include('./panels/header-top.php') ?>
<title> Blog Details </title>
<meta name="description" content="Blog Details">
<?php include('./panels/header-bottom.php') ?>
<?php include('./panels/menu.php') ?>


<?php include('./panels/header-top.php') ?>
<title><?= $blog_details['Name'] ?></title>
<meta name="description" content="<?= $blog_details['Meta_Description'] ?>">
<?php include('./panels/header-bottom.php') ?>
<?php include('./panels/menu.php') ?>

<!-- Page Title Area Start -->
<section class="page-title-area position-relative">
    <div class="container">
        <div class="main-max-width">
            <div class="page-title-content">
            <h2>Blog Details</h2>
            <ul class="page-breadcrumb align-items-center list-unstyle">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"></li>
                    <li class="primery-link"><?= $blog_details['Name'] ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- Page Title Area End -->

<!-- Blog Details Section Start -->
<div class="blog-details-section ptb-100">
    <div class="container">
        <div class="main-max-width">
            <div class="row">
                <div class="col-lg-8">
                    <div class="b-details-content">
                        <div class="image">
                            <img src="/admin/<?= $blog_details['Photo'] ?>" alt="<?= $blog_details['Name'] ?>">
                            <span><?= date('F d, Y', strtotime($blog_details['Updated_At'])) ?></span>
                        </div>
                        <div class="content">
                            <!-- <h2 class="fs-20"><?= $blog_details['Name'] ?></h2> -->
                            <p><?= $blog_details['Content'] ?></p>


                        </div>
                    </div>
                </div>
                <div class="col-lg-4 sticky-card" >
                    <aside class="course-sidebar-widgets">
                        <!-- Recent Blogs -->
                        <div class="widget widget-recent-blog">
                            <h3 class="widget-title">Related Blogs</h3>
                            <?php foreach ($recentBlogs as $recent): ?>
                                <article class="item">
                                    <a href="blog-details?url=<?= $recent['Slug'] ?>" class="thumb">
                                        <img src="/admin/<?= $recent['Photo'] ?>" alt="<?= $recent['Name'] ?>">
                                    </a>
                                    <div class="info">
                                        <span><?= date('F d, Y', strtotime($recent['Updated_At'])) ?></span>
                                        <h6 class="title">
                                            <a href="blog-details?url=<?= $recent['Slug'] ?>"><?= $recent['Name'] ?></a>
                                        </h6>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog Details Section End -->

<?php include('./panels/footer-top.php') ?>
<?php include('./panels/footer-bottom.php') ?>