<?php include('./panels/header-top.php'); ?>
<?php include('./panels/menu.php'); ?>
<?php
$url = $_GET['url'] ?? '';

$getdata = "SELECT Name,ID, Photo, Description, Content, Heading FROM category WHERE Slug = '$url' AND    Status = 1";
$result = $conn->query($getdata);

if ($result && $result->num_rows > 0) {
    $board = $result->fetch_assoc();
    $categoryID = $board['ID'];
}
?>
<title><?= $board['Name']; ?> -Details</title>
<meta name="description" content="<?= $board['Description']; ?>">
<?php include('./panels/header-bottom.php'); ?>
<!-- Page Title Area Start -->
<section class="page-title-area position-relative">
    <div class="container">
        <div class="main-max-width">
            <div class="page-title-content">
                <h2><?= $board['Name']; ?> -Details</h2>
                <ul class="page-breadcrumb align-items-center list-unstyle">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><?= $board['Name']; ?> -Details</li>
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
<!-- Page Title Area End -->
<?php
// echo "<pre>";
// echo "Category ID: $categoryID"; 
// echo "</pre>";
?>
<section>
    <div class="container">
        <div class="row">
            <!-- Board Photo -->
            <div class="col-lg-6">
                <div class="p-2 text-center">
                    <img src="/admin/<?= $board['Photo']; ?>" height="400" alt="Board Image">
                </div>
            </div>

            <!-- Board Details -->
            <div class="col-lg-6">
                <div class="shadow p-4 mt-4 mb-4"
                    style="background-image: url(./assets/img/light-red-blurred-background-vector.jpg); background-repeat:no-repeat; background-size:cover;">
                    <h3 class="text-center fw-bold" style="line-height: 2.5rem;"><?= $board['Heading']; ?></h3>
                    <p class="text-justify"><?= $board['Description']; ?></p>
                </div>
            </div>
        </div>

        <!-- Additional Content -->
        <section class="shadow mb-4 mt-3">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="content-area p-4 mb-3">
                            <?php echo $board['Content']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <?php
        $subCategoryQuery = "
            SELECT Name, Photo,Slug 
            FROM sub_category 
            WHERE Category_ID = '$categoryID' AND Status = 1";
        $subCategoryResult = $conn->query($subCategoryQuery);
        ?>

        <?php if (isset($subCategoryResult) && $subCategoryResult->num_rows > 0): ?>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center mb-3">
                                <h3>Specialization in <?= $board['Name']; ?></h3>
                            </div>
                        </div>

                        <?php while ($subcategory = $subCategoryResult->fetch_assoc()): ?>
                            <?php
                            // echo "<pre>";
                            // print_r($subcategory); 
                            // echo "</pre>";
                            ?>

                            <div class="col-lg-4 mt-4 mb-4">
                                <div>
                                    <a href="course-details?url=<?= $subcategory['Slug']; ?>" class="d-block text-center">

                                        <div>
                                            <img src="/admin/<?= $subcategory['Photo']; ?>" alt="<?= $subcategory['Name']; ?>">
                                        </div>
                                        <div class="shadow p-1 d-flex align-items-center" style="height: 50px;">
                                            <p class="text-center w-100 m-0"><?= $subcategory['Name']; ?></p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

    </div>
</section>

<?php include('./panels/footer-top.php'); ?>
<?php include('./panels/footer-bottom.php'); ?>