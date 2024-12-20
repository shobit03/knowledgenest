<?php include('./panels/header-top.php') ?>
<title>Specializations</title>
<meta name="description" content="Specializations">
<?php include('./panels/header-bottom.php') ?>
<?php include('./panels/menu.php') ?>

<?php
$url = isset($_GET['url']) ? mysqli_real_escape_string($conn, $_GET['url']) : '';

// Fetch specialization details based on the selected course slug
$specializationsQuery = "
    SELECT 
        specializations.ID as SpecializationID,
        specializations.Name as SpecializationName,
        specializations.Photo as Photo,
        specializations.Description as Description,
        specializations.Slug as SpecializationSlug
    FROM specializations
    LEFT JOIN sub_category ON specializations.Sub_Category_ID = sub_category.ID
    WHERE sub_category.Slug = '$url' AND specializations.Status = 1";

$specializationsResult = mysqli_query($conn, $specializationsQuery);

$specializations = [];
while ($row = mysqli_fetch_assoc($specializationsResult)) {
    $specializations[] = $row;
}
?>

<!-- Page Title Area -->
<section class="page-title-area position-relative">
    <div class="container">
        <div class="main-max-width">
            <div class="page-title-content">
                <h2>Specializations</h2>
                <ul class="page-breadcrumb align-items-center list-unstyle">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"></li>
                    <li class="primery-link">Specializations</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Specializations Section -->
<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="shadow p-2 mt-4 mb-4 rounded-3" style="background-color: #584fc9;">
                    <h5 class="text-center text-white">Explore Specializations</h5>
                </div>
            </div>
        </div>

        <div class="row align-items-center">
            <?php if (empty($specializations)): ?>
                <div class="col-12">
                    <p class="text-center">No specializations found for this course.</p>
                </div>
            <?php else: ?>
                <?php foreach ($specializations as $specialization): ?>
                    <div class="col-lg-4 col-sm-6">
                        <div class="department-cards mb-4 mt-4 rounded-3 shadow">
                            <div class="image position-relative">
                                <a href="specialization-details?url=<?php echo $specialization['SpecializationSlug']; ?>">
                                    <img src="/admin/<?php echo $specialization['Photo']; ?>" alt="<?php echo $specialization['SpecializationName']; ?>">
                                </a>
                            </div>
                            <div class="p-4 text-center">
                                <h3 class="mb-15 fs-20">
                                    <a href="specialization-details?url=<?php echo $specialization['SpecializationSlug']; ?>">
                                        <?php echo $specialization['SpecializationName']; ?>
                                    </a>
                                </h3>
                                <p><?php echo substr($specialization['Description'], 0, 100); ?>...</p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include('./panels/footer-top.php') ?>
<?php include('./panels/footer-bottom.php') ?>
